<?php

namespace app\services;

use app\components\TenantContext;
use app\models\Area;
use app\models\Cargos;
use app\models\CompanySetting;
use app\models\Contrato;
use app\models\LocationSedes;
use app\models\Profile;
use app\models\StaffingPlanta;
use app\models\StaffingPlantaHistorial;
use app\models\search\AdministracionPlantaDashboardSearch;
use app\models\search\StaffingPlantaSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\Expression;
use yii\db\Query;
use yii\web\ForbiddenHttpException;

class AdministracionPlantaService
{
    const MODO_PONDERADO = 'ponderado';
    const MODO_ENTERO = 'entero';
    const DEFAULT_COVERAGE_THRESHOLD = 80.0;

    public function getCurrentProfile()
    {
        if (Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException('Debe iniciar sesión para acceder al módulo.');
        }

        $profile = Profile::findOne(['user_id' => Yii::$app->user->id]);
        if ($profile === null || empty($profile->empresas_id)) {
            throw new ForbiddenHttpException('El usuario actual no tiene una empresa asociada.');
        }

        return $profile;
    }

    public function getCurrentEmpresaId()
    {
        $tenantId = TenantContext::currentEmpresaId();
        if ($tenantId !== null && $tenantId > 0) {
            return $tenantId;
        }

        return (int) $this->getCurrentProfile()->empresas_id;
    }

    public function getScopeContext()
    {
        $profile = $this->getCurrentProfile();
        $tenantId = TenantContext::currentEmpresaId();
        $empresaId = ($tenantId !== null && $tenantId > 0) ? $tenantId : (int) $profile->empresas_id;
        $fullAccess = $this->hasAnyRole(['admin_total', 'rrhh', 'admin', 'administrator', 'rrhh_interno', 'rrhh_cliente']);
        $readonly = $this->hasAnyRole(['gerente_sede']) && !$fullAccess;
        $allowedSedeIds = [];
        $allowedAreaIds = [];

        if (!$fullAccess) {
            if ($this->hasAnyRole(['gerente_sede', 'operaciones_regionales'])) {
                $allowedSedeIds = $this->resolveAssignedSedeIds($profile);
            }

            if ($this->hasAnyRole(['director_area'])) {
                $allowedAreaIds = $this->resolveAssignedAreaIds($profile);
            }
        }

        return [
            'empresa_id' => $empresaId,
            'readonly' => $readonly,
            'full_access' => $fullAccess,
            'allowedSedeIds' => array_values(array_unique(array_filter($allowedSedeIds))),
            'allowedAreaIds' => array_values(array_unique(array_filter($allowedAreaIds))),
            'roles' => [
                'admin_total' => $this->hasAnyRole(['admin_total']),
                'rrhh' => $this->hasAnyRole(['rrhh', 'rrhh_interno', 'rrhh_cliente']),
                'operaciones_regionales' => $this->hasAnyRole(['operaciones_regionales']),
                'director_area' => $this->hasAnyRole(['director_area']),
                'gerente_sede' => $this->hasAnyRole(['gerente_sede']),
            ],
        ];
    }

    public function ensureViewAccess()
    {
        if (!$this->hasAnyRole(['administracion_planta_view', 'administracion_planta_dashboard', 'admin', 'administrator'])) {
            throw new ForbiddenHttpException('No tiene permisos para consultar administración de planta.');
        }
    }

    public function ensureManageAccess()
    {
        $this->ensureViewAccess();

        if (!$this->hasAnyRole(['administracion_planta_manage', 'admin', 'administrator'])) {
            throw new ForbiddenHttpException('No tiene permisos para administrar la planta autorizada.');
        }

        $scope = $this->getScopeContext();
        if (!empty($scope['readonly'])) {
            throw new ForbiddenHttpException('Su alcance actual es de solo lectura.');
        }
    }

    public function ensureHistoryAccess()
    {
        if (!$this->hasAnyRole(['administracion_planta_history', 'admin', 'administrator'])) {
            throw new ForbiddenHttpException('No tiene permisos para consultar historial.');
        }
    }

    public function ensureExportAccess()
    {
        if (!$this->hasAnyRole(['administracion_planta_export', 'admin', 'administrator'])) {
            throw new ForbiddenHttpException('No tiene permisos para exportar información.');
        }
    }

    public function assertModelScope(StaffingPlanta $model, $forWrite = false)
    {
        $scope = $this->getScopeContext();

        if ((int) $model->empresa_id !== (int) $scope['empresa_id']) {
            throw new ForbiddenHttpException('El registro no pertenece al tenant actual.');
        }

        if (!$scope['full_access']) {
            if (!empty($model->location_sede_id)
                && !empty($scope['allowedSedeIds'])
                && !in_array((int) $model->location_sede_id, $scope['allowedSedeIds'], true)
            ) {
                throw new ForbiddenHttpException('El registro no pertenece a una sede dentro de su alcance.');
            }

            if (!empty($model->area_id)
                && !empty($scope['allowedAreaIds'])
                && !in_array((int) $model->area_id, $scope['allowedAreaIds'], true)
            ) {
                throw new ForbiddenHttpException('El registro no pertenece a un área dentro de su alcance.');
            }
        }

        if ($forWrite && !empty($scope['readonly'])) {
            throw new ForbiddenHttpException('Su alcance actual no permite edición.');
        }
    }

    public function buildPlantaDataProvider(StaffingPlantaSearch $searchModel, array $params)
    {
        $scope = $this->getScopeContext();
        $query = StaffingPlanta::find()->alias('planta');
        $query->andWhere(['planta.empresa_id' => $scope['empresa_id']]);
        $this->applyScopeToActiveQuery($query, $scope);

        $provider = $searchModel->search($params, $query);

        return $provider;
    }

    public function buildHistoryDataProvider(array $params)
    {
        $scope = $this->getScopeContext();

        $query = StaffingPlantaHistorial::find()
            ->alias('hist')
            ->joinWith([
                'planta planta',
                'planta.locationSede sede',
                'planta.locationSede.city city',
                'planta.locationSede.city.region region',
                'planta.area area',
                'planta.subArea subArea',
                'planta.cargo cargo',
                'user user',
            ])
            ->andWhere(['planta.empresa_id' => $scope['empresa_id']]);

        $this->applyScopeToHistoryQuery($query, $scope);

        $search = new AdministracionPlantaDashboardSearch();
        $search->load($params);

        if ($search->sede_id) {
            $query->andWhere(['planta.location_sede_id' => $search->sede_id]);
        }
        if ($search->region_id) {
            $query->andWhere(['region.id' => $search->region_id]);
        }
        if ($search->city_id) {
            $query->andWhere(['city.id' => $search->city_id]);
        }
        if ($search->area_id) {
            $query->andWhere(['planta.area_id' => $search->area_id]);
        }
        if ($search->sub_area_id) {
            $query->andWhere(['planta.sub_area_id' => $search->sub_area_id]);
        }
        if ($search->cargo_id) {
            $query->andWhere(['planta.cargo_id' => $search->cargo_id]);
        }
        if (!empty($search->texto)) {
            $query->andWhere([
                'or',
                ['like', 'sede.nombre', $search->texto],
                ['like', 'cargo.nombre', $search->texto],
            ]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_DESC, 'id' => SORT_DESC],
                'attributes' => [
                    'id' => [
                        'asc' => ['hist.id' => SORT_ASC],
                        'desc' => ['hist.id' => SORT_DESC],
                    ],
                    'created_at' => [
                        'asc' => ['hist.created_at' => SORT_ASC],
                        'desc' => ['hist.created_at' => SORT_DESC],
                    ],
                    'campo' => [
                        'asc' => ['hist.campo' => SORT_ASC],
                        'desc' => ['hist.campo' => SORT_DESC],
                    ],
                    'accion' => [
                        'asc' => ['hist.accion' => SORT_ASC],
                        'desc' => ['hist.accion' => SORT_DESC],
                    ],
                ],
            ],
            'pagination' => ['pageSize' => 50],
        ]);
    }

    public function getDashboardData(AdministracionPlantaDashboardSearch $searchModel)
    {
        $scope = $this->getScopeContext();
        $rows = $this->getDetailedSummaryRows($searchModel, $scope);

        return [
            'rows' => $rows,
            'kpis' => $this->buildKpis($rows),
            'resumenSede' => $this->sortRows($rows, ['sede_nombre', 'area_nombre', 'sub_area_nombre', 'cargo_nombre']),
            'resumenArea' => $this->sortRows($rows, ['area_nombre', 'sub_area_nombre', 'cargo_nombre', 'sede_nombre']),
            'chartBySede' => $this->buildAggregatedSeries($rows, 'sede_id', 'sede_nombre'),
            'chartByArea' => $this->buildAggregatedSeries($rows, 'area_id', 'area_nombre'),
            'topCargosVacantes' => $this->buildTopCargoRows($rows, true),
            'topCargosSobredotacion' => $this->buildTopCargoRows($rows, false),
            'topSedesMenorCobertura' => $this->buildTopCoverageRows($rows),
            'alerts' => $this->buildAlerts($rows),
            'coverageThreshold' => $this->getCoverageThreshold($scope['empresa_id']),
        ];
    }

    public function getFilterOptions(?AdministracionPlantaDashboardSearch $searchModel = null)
    {
        $scope = $this->getScopeContext();
        $empresaId = $scope['empresa_id'];

        $regionsQuery = (new Query())
            ->select(['region.id', 'region.name'])
            ->distinct()
            ->from(['sede' => 'location_sedes'])
            ->leftJoin(['city' => 'city'], 'city.id = sede.city_id')
            ->leftJoin(['region' => 'region'], 'region.id = city.region_id')
            ->where(['sede.empresa_id' => $empresaId]);
        $this->applyScopeToDimensionQuery($regionsQuery, 'sede.id', '0', $scope);

        $citiesQuery = (new Query())
            ->select(['city.id', 'city.name'])
            ->distinct()
            ->from(['sede' => 'location_sedes'])
            ->leftJoin(['city' => 'city'], 'city.id = sede.city_id')
            ->where(['sede.empresa_id' => $empresaId]);
        if ($searchModel && $searchModel->region_id) {
            $citiesQuery->leftJoin(['region' => 'region'], 'region.id = city.region_id');
            $citiesQuery->andWhere(['region.id' => $searchModel->region_id]);
        }
        $this->applyScopeToDimensionQuery($citiesQuery, 'sede.id', '0', $scope);

        $sedesQuery = LocationSedes::find()
            ->where(['empresa_id' => $empresaId])
            ->orderBy(['nombre' => SORT_ASC]);
        if ($searchModel && $searchModel->region_id) {
            $sedesQuery->joinWith(['city city', 'city.region region']);
            $sedesQuery->andWhere(['region.id' => $searchModel->region_id]);
        }
        if ($searchModel && $searchModel->city_id) {
            $sedesQuery->andWhere(['city_id' => $searchModel->city_id]);
        }
        if (!empty($scope['allowedSedeIds'])) {
            $sedesQuery->andWhere(['id' => $scope['allowedSedeIds']]);
        }

        // Todas las áreas del tenant (tabla `area`); no filtrar solo por raíz
        // porque muchos datos solo tienen jerarquía vía area_padre o el primer nivel no es null/0.
        $areasQuery = Area::find()
            ->where(['empresas_id' => $empresaId])
            ->orderBy(['nombre' => SORT_ASC]);
        if (!empty($scope['allowedAreaIds'])) {
            $areasQuery->andWhere(['id' => $scope['allowedAreaIds']]);
        }

        return [
            'regiones' => $regionsQuery->orderBy(['name' => SORT_ASC])->all(),
            'ciudades' => $citiesQuery->orderBy(['name' => SORT_ASC])->all(),
            'sedes' => $sedesQuery->all(),
            'areas' => $areasQuery->all(),
            'subAreas' => $searchModel && $searchModel->area_id ? $this->getSubAreaOptions($searchModel->area_id, $empresaId) : [],
            'cargos' => $this->getCargoOptions($empresaId, $searchModel ? $searchModel->area_id : null, $searchModel ? $searchModel->sub_area_id : null),
            'tipoSede' => LocationSedes::optsTipoSede(),
            'estadosCobertura' => [
                'alta' => 'Cobertura alta',
                'media' => 'Cobertura media',
                'baja' => 'Cobertura baja',
            ],
            'modosOcupacion' => [
                self::MODO_PONDERADO => 'Conteo ponderado',
                self::MODO_ENTERO => 'Conteo entero por sede principal',
            ],
        ];
    }

    public function getSubAreaOptions($areaId, $empresaId = null)
    {
        $empresaId = $empresaId ?: $this->getCurrentEmpresaId();
        $children = Area::find()
            ->where(['area_padre' => $areaId, 'empresas_id' => $empresaId])
            ->orderBy(['nombre' => SORT_ASC])
            ->all();

        if (!empty($children)) {
            return $children;
        }

        $area = Area::findOne(['id' => $areaId, 'empresas_id' => $empresaId]);
        return $area ? [$area] : [];
    }

    public function getCargoOptions($empresaId, $areaId = null, $subAreaId = null)
    {
        $query = Cargos::find()
            ->where(['empresa_id' => $empresaId, 'activo' => 1])
            ->orderBy(['nombre' => SORT_ASC]);

        if ($areaId) {
            $query->andWhere(['area_id' => $areaId]);
        }

        if ($subAreaId) {
            $query->andWhere([
                'or',
                ['sub_area_id' => $subAreaId],
                ['and', ['sub_area_id' => null], ['area_id' => $areaId]],
            ]);
        }

        return $query->all();
    }

    public function getExportPayload($scopeName, AdministracionPlantaDashboardSearch $searchModel)
    {
        $dashboard = $this->getDashboardData($searchModel);

        switch ($scopeName) {
            case 'resumen-area':
                return [
                    'title' => 'Resumen por área',
                    'columns' => $this->getSummaryColumns(),
                    'rows' => $dashboard['resumenArea'],
                ];
            case 'historial':
                $historyProvider = $this->buildHistoryDataProvider([ $searchModel->formName() => $searchModel->attributes ]);
                $historyRows = $historyProvider->query->all();
                return [
                    'title' => 'Historial de planta',
                    'columns' => [
                        'dimension' => 'Registro',
                        'campo' => 'Campo',
                        'accion' => 'Acción',
                        'valor_anterior' => 'Valor anterior',
                        'valor_nuevo' => 'Valor nuevo',
                        'usuario' => 'Usuario',
                        'created_at' => 'Fecha',
                    ],
                    'rows' => array_map(function (StaffingPlantaHistorial $item) {
                        return [
                            'dimension' => $item->planta ? $item->planta->getDimensionLabel() : '#'.$item->planta_id,
                            'campo' => $item->campo,
                            'accion' => $item->accion,
                            'valor_anterior' => $item->valor_anterior,
                            'valor_nuevo' => $item->valor_nuevo,
                            'usuario' => $item->user ? $item->user->username : '-',
                            'created_at' => $item->created_at,
                        ];
                    }, $historyRows),
                ];
            case 'planta':
                $search = new StaffingPlantaSearch();
                $provider = $this->buildPlantaDataProvider($search, [ $search->formName() => [] ]);
                $plantaRows = $provider->query->all();
                return [
                    'title' => 'Administración de planta',
                    'columns' => [
                        'sede' => 'Sede',
                        'tipo_sede' => 'Tipo sede',
                        'area' => 'Área',
                        'sub_area' => 'Subárea',
                        'cargo' => 'Cargo',
                        'cantidad_autorizada' => 'Planta autorizada',
                        'activo' => 'Activo',
                        'updated_at' => 'Actualizado',
                    ],
                    'rows' => array_map(function (StaffingPlanta $item) {
                        return [
                            'sede' => $item->locationSede ? $item->locationSede->nombre : '-',
                            'tipo_sede' => $item->locationSede ? $item->locationSede->getTipoSedeLabel() : '-',
                            'area' => $item->area ? $item->area->nombre : '-',
                            'sub_area' => $item->subArea ? $item->subArea->nombre : '-',
                            'cargo' => $item->cargo ? $item->cargo->nombre : '-',
                            'cantidad_autorizada' => $item->cantidad_autorizada,
                            'activo' => (int) $item->activo === 1 ? 'Sí' : 'No',
                            'updated_at' => $item->updated_at,
                        ];
                    }, $plantaRows),
                ];
            case 'resumen-sede':
            default:
                return [
                    'title' => 'Resumen por sede',
                    'columns' => $this->getSummaryColumns(),
                    'rows' => $dashboard['resumenSede'],
                ];
        }
    }

    private function getDetailedSummaryRows(AdministracionPlantaDashboardSearch $searchModel, array $scope)
    {
        $threshold = $this->getCoverageThreshold($scope['empresa_id']);
        $query = $this->buildDetailedSummaryQuery($searchModel, $scope);
        $rows = $query->all();

        foreach ($rows as &$row) {
            $row = $this->normalizeSummaryRow($row, $threshold);
        }
        unset($row);

        return $this->applySummaryPostFilters($rows, $searchModel);
    }

    private function buildDetailedSummaryQuery(AdministracionPlantaDashboardSearch $searchModel, array $scope)
    {
        $empresaId = (int) $scope['empresa_id'];
        $plantQuery = $this->buildPlantContributionQuery($searchModel, $scope);
        $occupancyQuery = $this->buildOccupancyContributionQuery($searchModel, $scope);
        $unionQuery = $plantQuery->union($occupancyQuery, true);

        $query = (new Query())
            ->select([
                'base.empresa_id',
                'sede_id' => 'base.sede_id',
                'sede_nombre' => 'sede.nombre',
                'tipo_sede' => new Expression("COALESCE(sede.tipo_sede, 'operativa')"),
                'city_id' => 'city.id',
                'city_name' => 'city.name',
                'region_id' => 'region.id',
                'region_name' => 'region.name',
                'area_id' => 'base.area_id',
                'area_nombre' => 'area.nombre',
                'sub_area_id' => 'base.sub_area_id',
                'sub_area_nombre' => new Expression('COALESCE(subArea.nombre, area.nombre)'),
                'cargo_id' => 'base.cargo_id',
                'cargo_nombre' => 'cargo.nombre',
                'planta_autorizada' => new Expression('ROUND(SUM(base.planta_autorizada), 2)'),
                'ocupados' => new Expression('ROUND(SUM(base.ocupados), 2)'),
                'activos_normales' => new Expression('ROUND(SUM(base.activos_normales), 2)'),
                'incapacidad' => new Expression('ROUND(SUM(base.incapacidad), 2)'),
                'licencia' => new Expression('ROUND(SUM(base.licencia), 2)'),
                'suspendidos' => new Expression('ROUND(SUM(base.suspendidos), 2)'),
            ])
            ->from(['base' => $unionQuery])
            ->leftJoin(['sede' => 'location_sedes'], 'sede.id = base.sede_id')
            ->leftJoin(['city' => 'city'], 'city.id = sede.city_id')
            ->leftJoin(['region' => 'region'], 'region.id = city.region_id')
            ->leftJoin(['area' => 'area'], 'area.id = base.area_id')
            ->leftJoin(['subArea' => 'area'], 'subArea.id = base.sub_area_id')
            ->leftJoin(['cargo' => 'cargos'], 'cargo.id = base.cargo_id')
            ->where(['base.empresa_id' => $empresaId])
            ->groupBy([
                'base.empresa_id',
                'base.sede_id',
                'sede.nombre',
                'sede.tipo_sede',
                'city.id',
                'city.name',
                'region.id',
                'region.name',
                'base.area_id',
                'area.nombre',
                'base.sub_area_id',
                'subArea.nombre',
                'base.cargo_id',
                'cargo.nombre',
            ]);

        if ($searchModel->region_id) {
            $query->andWhere(['region.id' => $searchModel->region_id]);
        }
        if ($searchModel->city_id) {
            $query->andWhere(['city.id' => $searchModel->city_id]);
        }
        if ($searchModel->sede_id) {
            $query->andWhere(['base.sede_id' => $searchModel->sede_id]);
        }
        if ($searchModel->tipo_sede) {
            $query->andWhere(['sede.tipo_sede' => $searchModel->tipo_sede]);
        }
        if ($searchModel->area_id) {
            $query->andWhere(['base.area_id' => $searchModel->area_id]);
        }
        if ($searchModel->sub_area_id) {
            $query->andWhere(['base.sub_area_id' => $searchModel->sub_area_id]);
        }
        if ($searchModel->cargo_id) {
            $query->andWhere(['base.cargo_id' => $searchModel->cargo_id]);
        }
        if (!empty($searchModel->texto)) {
            $query->andWhere([
                'or',
                ['like', 'sede.nombre', $searchModel->texto],
                ['like', 'cargo.nombre', $searchModel->texto],
            ]);
        }

        return $query;
    }

    private function buildPlantContributionQuery(AdministracionPlantaDashboardSearch $searchModel, array $scope)
    {
        $query = (new Query())
            ->select([
                'empresa_id' => 'planta.empresa_id',
                'sede_id' => 'planta.location_sede_id',
                'area_id' => 'planta.area_id',
                'sub_area_id' => 'planta.sub_area_id',
                'cargo_id' => 'planta.cargo_id',
                'planta_autorizada' => new Expression('SUM(planta.cantidad_autorizada)'),
                'ocupados' => new Expression('0'),
                'activos_normales' => new Expression('0'),
                'incapacidad' => new Expression('0'),
                'licencia' => new Expression('0'),
                'suspendidos' => new Expression('0'),
            ])
            ->from(['planta' => 'staffing_planta'])
            ->where(['planta.empresa_id' => $scope['empresa_id']])
            ->groupBy(['planta.empresa_id', 'planta.location_sede_id', 'planta.area_id', 'planta.sub_area_id', 'planta.cargo_id']);

        if ($searchModel->planta_activa !== null && $searchModel->planta_activa !== '') {
            $query->andWhere(['planta.activo' => (int) $searchModel->planta_activa]);
        }

        $this->applyScopeToDimensionQuery($query, 'planta.location_sede_id', 'planta.area_id', $scope);

        return $query;
    }

    private function buildOccupancyContributionQuery(AdministracionPlantaDashboardSearch $searchModel, array $scope)
    {
        $source = $this->buildOccupancySourceQuery($scope['empresa_id'], $searchModel->modo_ocupacion, $scope);

        return (new Query())
            ->select([
                'empresa_id' => 'src.empresa_id',
                'sede_id' => 'src.sede_id',
                'area_id' => 'src.area_id',
                'sub_area_id' => 'src.sub_area_id',
                'cargo_id' => 'src.cargo_id',
                'planta_autorizada' => new Expression('0'),
                'ocupados' => new Expression('SUM(src.factor)'),
                'activos_normales' => new Expression("SUM(CASE WHEN src.estado = 'activo' THEN src.factor ELSE 0 END)"),
                'incapacidad' => new Expression("SUM(CASE WHEN src.estado = 'incapacidad' THEN src.factor ELSE 0 END)"),
                'licencia' => new Expression("SUM(CASE WHEN src.estado = 'licencia' THEN src.factor ELSE 0 END)"),
                'suspendidos' => new Expression("SUM(CASE WHEN src.estado = 'suspendido' THEN src.factor ELSE 0 END)"),
            ])
            ->from(['src' => $source])
            ->groupBy(['src.empresa_id', 'src.sede_id', 'src.area_id', 'src.sub_area_id', 'src.cargo_id']);
    }

    private function buildOccupancySourceQuery($empresaId, $mode, array $scope)
    {
        $today = date('Y-m-d');
        $baseConditions = [
            'and',
            ['c.empresa_id' => $empresaId],
            ['c.estado' => Contrato::occupyingStatuses()],
            ['<=', 'c.fecha_inicio', $today],
            [
                'or',
                ['c.fecha_fin' => null],
                ['>=', 'c.fecha_fin', $today],
            ],
        ];

        $areaExpression = new Expression('COALESCE(c.area_id, cargo.area_id)');
        $subAreaExpression = new Expression('COALESCE(c.sub_area_id, cargo.sub_area_id, c.area_id, cargo.area_id)');

        if ($mode === self::MODO_ENTERO) {
            $query = (new Query())
                ->select([
                    'empresa_id' => 'c.empresa_id',
                    'sede_id' => 'c.sede_id',
                    'area_id' => $areaExpression,
                    'sub_area_id' => $subAreaExpression,
                    'cargo_id' => 'c.cargo_id',
                    'estado' => 'c.estado',
                    'factor' => new Expression('1'),
                ])
                ->from(['c' => 'contrato'])
                ->leftJoin(['cargo' => 'cargos'], 'cargo.id = c.cargo_id')
                ->where($baseConditions)
                ->andWhere(['not', ['c.sede_id' => null]]);

            $this->applyScopeToDimensionQuery($query, 'c.sede_id', $areaExpression, $scope);

            return $query;
        }

        $distributionTotals = (new Query())
            ->select([
                'contrato_id',
                'total_porcentaje' => new Expression('ROUND(SUM(porcentaje), 2)'),
            ])
            ->from('contrato_distribucion_sede')
            ->groupBy('contrato_id');

        $distributed = (new Query())
            ->select([
                'empresa_id' => 'c.empresa_id',
                'sede_id' => 'dist.sede_id',
                'area_id' => $areaExpression,
                'sub_area_id' => $subAreaExpression,
                'cargo_id' => 'c.cargo_id',
                'estado' => 'c.estado',
                'factor' => new Expression('dist.porcentaje / 100'),
            ])
            ->from(['c' => 'contrato'])
            ->innerJoin(['totals' => $distributionTotals], 'totals.contrato_id = c.id AND totals.total_porcentaje = 100.00')
            ->innerJoin(['dist' => 'contrato_distribucion_sede'], 'dist.contrato_id = c.id')
            ->leftJoin(['cargo' => 'cargos'], 'cargo.id = c.cargo_id')
            ->where($baseConditions);
        $this->applyScopeToDimensionQuery($distributed, 'dist.sede_id', $areaExpression, $scope);

        $fallback = (new Query())
            ->select([
                'empresa_id' => 'c.empresa_id',
                'sede_id' => 'c.sede_id',
                'area_id' => $areaExpression,
                'sub_area_id' => $subAreaExpression,
                'cargo_id' => 'c.cargo_id',
                'estado' => 'c.estado',
                'factor' => new Expression('1'),
            ])
            ->from(['c' => 'contrato'])
            ->leftJoin(['totals' => $distributionTotals], 'totals.contrato_id = c.id')
            ->leftJoin(['cargo' => 'cargos'], 'cargo.id = c.cargo_id')
            ->where($baseConditions)
            ->andWhere(['or', ['totals.contrato_id' => null], ['<>', 'totals.total_porcentaje', 100.00]])
            ->andWhere(['not', ['c.sede_id' => null]]);
        $this->applyScopeToDimensionQuery($fallback, 'c.sede_id', $areaExpression, $scope);

        return $distributed->union($fallback, true);
    }

    private function applyScopeToActiveQuery(ActiveQuery $query, array $scope)
    {
        if (empty($scope['full_access']) && !empty($scope['allowedSedeIds'])) {
            $query->andWhere(['planta.location_sede_id' => $scope['allowedSedeIds']]);
        }

        if (empty($scope['full_access']) && !empty($scope['allowedAreaIds'])) {
            $query->andWhere(['planta.area_id' => $scope['allowedAreaIds']]);
        }
    }

    private function applyScopeToHistoryQuery(ActiveQuery $query, array $scope)
    {
        if (empty($scope['full_access']) && !empty($scope['allowedSedeIds'])) {
            $query->andWhere(['planta.location_sede_id' => $scope['allowedSedeIds']]);
        }

        if (empty($scope['full_access']) && !empty($scope['allowedAreaIds'])) {
            $query->andWhere(['planta.area_id' => $scope['allowedAreaIds']]);
        }
    }

    private function applyScopeToDimensionQuery($query, $sedeColumn, $areaColumn, array $scope)
    {
        if (!empty($scope['full_access'])) {
            return;
        }

        if (!empty($scope['allowedSedeIds'])) {
            $query->andWhere(['in', $sedeColumn, $scope['allowedSedeIds']]);
        }

        if (!empty($scope['allowedAreaIds']) && !empty($areaColumn) && $areaColumn !== '0') {
            $query->andWhere(['in', $areaColumn, $scope['allowedAreaIds']]);
        }
    }

    private function normalizeSummaryRow(array $row, $coverageThreshold)
    {
        $planta = round((float) $row['planta_autorizada'], 2);
        $ocupados = round((float) $row['ocupados'], 2);
        $vacantes = round($planta - $ocupados, 2);
        $cobertura = $planta > 0 ? round(($ocupados / $planta) * 100, 2) : 0.0;

        $estadoVisual = 'completa';
        $badgeClass = 'success';

        if ($vacantes > 0) {
            $estadoVisual = 'con vacantes';
            $badgeClass = 'warning';
        } elseif ($vacantes < 0) {
            $estadoVisual = 'sobredotada';
            $badgeClass = 'danger';
        }

        if ($cobertura >= $coverageThreshold) {
            $estadoCobertura = 'alta';
        } elseif ($cobertura >= ($coverageThreshold * 0.5)) {
            $estadoCobertura = 'media';
        } else {
            $estadoCobertura = 'baja';
        }

        $row['planta_autorizada'] = $planta;
        $row['ocupados'] = $ocupados;
        $row['activos_normales'] = round((float) $row['activos_normales'], 2);
        $row['incapacidad'] = round((float) $row['incapacidad'], 2);
        $row['licencia'] = round((float) $row['licencia'], 2);
        $row['suspendidos'] = round((float) $row['suspendidos'], 2);
        $row['vacantes'] = $vacantes;
        $row['cobertura'] = $cobertura;
        $row['estado_visual'] = $estadoVisual;
        $row['badge_class'] = $badgeClass;
        $row['estado_cobertura'] = $estadoCobertura;
        $row['can_create_requisicion'] = $vacantes > 0;

        return $row;
    }

    private function applySummaryPostFilters(array $rows, AdministracionPlantaDashboardSearch $searchModel)
    {
        return array_values(array_filter($rows, function ($row) use ($searchModel) {
            if ((int) $searchModel->solo_vacantes === 1 && $row['vacantes'] <= 0) {
                return false;
            }

            if ((int) $searchModel->solo_sobredotacion === 1 && $row['vacantes'] >= 0) {
                return false;
            }

            if (!empty($searchModel->estado_cobertura) && $row['estado_cobertura'] !== $searchModel->estado_cobertura) {
                return false;
            }

            return true;
        }));
    }

    private function buildKpis(array $rows)
    {
        $totals = [
            'planta_total' => 0.0,
            'ocupados_total' => 0.0,
            'vacantes_total' => 0.0,
            'cobertura_total' => 0.0,
            'sobredotacion_total' => 0.0,
            'sedes_con_vacantes' => 0,
            'sedes_sobredotadas' => 0,
        ];

        $bySede = [];

        foreach ($rows as $row) {
            $totals['planta_total'] += $row['planta_autorizada'];
            $totals['ocupados_total'] += $row['ocupados'];
            $totals['vacantes_total'] += $row['vacantes'];
            if ($row['vacantes'] < 0) {
                $totals['sobredotacion_total'] += abs($row['vacantes']);
            }

            if (!isset($bySede[$row['sede_id']])) {
                $bySede[$row['sede_id']] = [
                    'vacantes' => 0.0,
                ];
            }
            $bySede[$row['sede_id']]['vacantes'] += $row['vacantes'];
        }

        $totals['planta_total'] = round($totals['planta_total'], 2);
        $totals['ocupados_total'] = round($totals['ocupados_total'], 2);
        $totals['vacantes_total'] = round($totals['vacantes_total'], 2);
        $totals['sobredotacion_total'] = round($totals['sobredotacion_total'], 2);
        $totals['cobertura_total'] = $totals['planta_total'] > 0
            ? round(($totals['ocupados_total'] / $totals['planta_total']) * 100, 2)
            : 0.0;

        foreach ($bySede as $item) {
            if ($item['vacantes'] > 0) {
                $totals['sedes_con_vacantes']++;
            }
            if ($item['vacantes'] < 0) {
                $totals['sedes_sobredotadas']++;
            }
        }

        return $totals;
    }

    private function buildAggregatedSeries(array $rows, $idField, $labelField)
    {
        $grouped = [];

        foreach ($rows as $row) {
            $key = $row[$idField] ?: '0';
            if (!isset($grouped[$key])) {
                $grouped[$key] = [
                    'id' => $row[$idField],
                    'label' => $row[$labelField] ?: '-',
                    'planta_autorizada' => 0.0,
                    'ocupados' => 0.0,
                    'vacantes' => 0.0,
                    'cobertura' => 0.0,
                ];
            }

            $grouped[$key]['planta_autorizada'] += $row['planta_autorizada'];
            $grouped[$key]['ocupados'] += $row['ocupados'];
            $grouped[$key]['vacantes'] += $row['vacantes'];
        }

        foreach ($grouped as &$item) {
            $item['planta_autorizada'] = round($item['planta_autorizada'], 2);
            $item['ocupados'] = round($item['ocupados'], 2);
            $item['vacantes'] = round($item['vacantes'], 2);
            $item['cobertura'] = $item['planta_autorizada'] > 0
                ? round(($item['ocupados'] / $item['planta_autorizada']) * 100, 2)
                : 0.0;
        }
        unset($item);

        usort($grouped, function ($a, $b) {
            return strcmp($a['label'], $b['label']);
        });

        return array_values($grouped);
    }

    private function buildTopCargoRows(array $rows, $positiveVacancies = true)
    {
        $grouped = $this->buildAggregatedSeries($rows, 'cargo_id', 'cargo_nombre');

        if ($positiveVacancies) {
            $grouped = array_filter($grouped, function ($item) {
                return $item['vacantes'] > 0;
            });
            usort($grouped, function ($a, $b) {
                return $b['vacantes'] <=> $a['vacantes'];
            });
        } else {
            $grouped = array_filter($grouped, function ($item) {
                return $item['vacantes'] < 0;
            });
            usort($grouped, function ($a, $b) {
                return $a['vacantes'] <=> $b['vacantes'];
            });
        }

        return array_slice(array_values($grouped), 0, 10);
    }

    private function buildTopCoverageRows(array $rows)
    {
        $grouped = $this->buildAggregatedSeries($rows, 'sede_id', 'sede_nombre');
        usort($grouped, function ($a, $b) {
            return $a['cobertura'] <=> $b['cobertura'];
        });

        return array_slice($grouped, 0, 10);
    }

    private function buildAlerts(array $rows)
    {
        $coverageThreshold = $this->getCoverageThreshold($this->getCurrentEmpresaId());

        return [
            'vacantes' => array_slice(array_values(array_filter($rows, function ($row) {
                return $row['vacantes'] > 0;
            })), 0, 10),
            'sobredotacion' => array_slice(array_values(array_filter($rows, function ($row) {
                return $row['vacantes'] < 0;
            })), 0, 10),
            'baja_cobertura' => array_slice(array_values(array_filter($rows, function ($row) use ($coverageThreshold) {
                return $row['cobertura'] < $coverageThreshold;
            })), 0, 10),
            'criticas_operativas' => array_slice(array_values(array_filter($rows, function ($row) use ($coverageThreshold) {
                return $row['tipo_sede'] === LocationSedes::TIPO_SEDE_OPERATIVA
                    && $row['vacantes'] > 0
                    && $row['cobertura'] < $coverageThreshold;
            })), 0, 10),
        ];
    }

    private function sortRows(array $rows, array $keys)
    {
        usort($rows, function ($a, $b) use ($keys) {
            foreach ($keys as $key) {
                $comparison = strcmp((string) $a[$key], (string) $b[$key]);
                if ($comparison !== 0) {
                    return $comparison;
                }
            }

            return 0;
        });

        return $rows;
    }

    private function getSummaryColumns()
    {
        return [
            'sede_nombre' => 'Sede',
            'tipo_sede' => 'Tipo sede',
            'area_nombre' => 'Área',
            'sub_area_nombre' => 'Subárea',
            'cargo_nombre' => 'Cargo',
            'planta_autorizada' => 'Planta autorizada',
            'ocupados' => 'Ocupados ponderados',
            'vacantes' => 'Vacantes',
            'activos_normales' => 'Activos',
            'incapacidad' => 'Incapacidad',
            'licencia' => 'Licencia',
            'suspendidos' => 'Suspendidos',
            'cobertura' => '% cobertura',
            'estado_visual' => 'Estado',
        ];
    }

    public function getCoverageThreshold($empresaId)
    {
        $setting = CompanySetting::findOne([
            'empresa_id' => $empresaId,
            'key' => 'staffing.coverage_threshold',
        ]);

        if ($setting === null || empty($setting->value_json)) {
            return self::DEFAULT_COVERAGE_THRESHOLD;
        }

        $decoded = json_decode($setting->value_json, true);
        if (is_array($decoded) && isset($decoded['value']) && is_numeric($decoded['value'])) {
            return (float) $decoded['value'];
        }

        if (is_numeric($setting->value_json)) {
            return (float) $setting->value_json;
        }

        return self::DEFAULT_COVERAGE_THRESHOLD;
    }

    private function resolveAssignedSedeIds(Profile $profile)
    {
        $json = $this->decodeProfileDataJson($profile);
        if (isset($json['staffing_scope_sede_ids']) && is_array($json['staffing_scope_sede_ids'])) {
            return array_map('intval', $json['staffing_scope_sede_ids']);
        }

        if (!empty($profile->sede_id)) {
            return [(int) $profile->sede_id];
        }

        return [];
    }

    private function resolveAssignedAreaIds(Profile $profile)
    {
        $json = $this->decodeProfileDataJson($profile);
        if (isset($json['staffing_scope_area_ids']) && is_array($json['staffing_scope_area_ids'])) {
            return array_map('intval', $json['staffing_scope_area_ids']);
        }

        if (!empty($profile->area_id)) {
            return [(int) $profile->area_id];
        }

        return [];
    }

    private function decodeProfileDataJson(Profile $profile)
    {
        if (empty($profile->data_json)) {
            return [];
        }

        $decoded = json_decode($profile->data_json, true);
        return is_array($decoded) ? $decoded : [];
    }

    private function hasAnyRole(array $names)
    {
        foreach ($names as $name) {
            if (Yii::$app->user->can($name)) {
                return true;
            }
        }

        return false;
    }
}
