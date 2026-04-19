<?php

namespace app\controllers;

use app\components\TenantContext;
use app\models\Area;
use app\models\EmpresaCliente;
use app\models\NovedadCentroUtilidad;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * CRUD centros de utilidad (novedad), acotado por empresa (área).
 */
class NovedadCentroUtilidadController extends Controller
{
    public function behaviors(): array
    {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'denyCallback' => static function (): void {
                    throw new ForbiddenHttpException(Yii::t('app', 'No tiene permiso para acceder a centros de utilidad.'));
                },
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'data'],
                        'roles' => ['@'],
                        'matchCallback' => fn (): bool => $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_utilidad.index'),
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view-ajax'],
                        'roles' => ['@'],
                        'matchCallback' => fn (): bool => $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_utilidad.view'),
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create-ajax'],
                        'roles' => ['@'],
                        'matchCallback' => fn (): bool => $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_utilidad.create'),
                    ],
                    [
                        'allow' => true,
                        'actions' => ['form-ajax', 'update-ajax'],
                        'roles' => ['@'],
                        'matchCallback' => fn (): bool => $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_utilidad.update'),
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['@'],
                        'matchCallback' => fn (): bool => $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_utilidad.delete'),
                    ],
                    [
                        'allow' => true,
                        'actions' => ['areas-options'],
                        'roles' => ['@'],
                        'matchCallback' => fn (): bool => $this->esAdminCatalogo()
                            || Yii::$app->user->can('novedad_centro_utilidad.create')
                            || Yii::$app->user->can('novedad_centro_utilidad.update'),
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'create-ajax' => ['POST'],
                    'update-ajax' => ['POST'],
                ],
            ],
        ]);
    }

    private function esAdminCatalogo(): bool
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }
        $roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
        foreach (['admin', 'administrator'] as $r) {
            if (isset($roles[$r])) {
                return true;
            }
        }

        return false;
    }

    public function actionIndex(): string
    {
        $empresaId = TenantContext::requireEmpresaId();
        $baseQuery = NovedadCentroUtilidad::find()->alias('ncu')
            ->innerJoin('{{%area}} a', 'a.id = ncu.area_id')
            ->where(['a.empresas_id' => $empresaId]);
        $summaryCounts = [
            'total' => (int) (clone $baseQuery)->count(),
            'activos' => (int) (clone $baseQuery)->andWhere(['ncu.activo' => 1])->count(),
            'inactivos' => (int) (clone $baseQuery)->andWhere(['ncu.activo' => 0])->count(),
        ];

        $modelModal = new NovedadCentroUtilidad();
        $modelModal->loadDefaultValues();
        if ($modelModal->activo === null) {
            $modelModal->activo = 1;
        }

        return $this->render('index', [
            'summaryCounts' => $summaryCounts,
            'modelModal' => $modelModal,
            'areaOptions' => $this->areaOptionsForForm(null),
            'empresaClienteOptions' => $this->empresaClienteOptionsForTenant(),
            'areasOptionsUrl' => Url::to(['novedad-centro-utilidad/areas-options']),
            'puedeCrear' => $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_utilidad.create'),
            'puedeVer' => $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_utilidad.view'),
            'puedeEditar' => $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_utilidad.update'),
            'puedeEliminar' => $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_utilidad.delete'),
        ]);
    }

    public function actionData(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $empresaId = TenantContext::requireEmpresaId();

        $draw = (int) $request->get('draw', 1);
        $start = (int) $request->get('start', 0);
        $length = (int) $request->get('length', 10);
        $searchValue = $request->get('search', [])['value'] ?? '';
        $orderCol = (int) ($request->get('order', [])[0]['column'] ?? 0);
        $orderDir = ($request->get('order', [])[0]['dir'] ?? 'asc') === 'asc' ? SORT_ASC : SORT_DESC;

        $query = NovedadCentroUtilidad::find()->alias('ncu')
            ->innerJoin('{{%area}} a', 'a.id = ncu.area_id')
            ->leftJoin('{{%empresa_cliente}} ec', 'ec.id = ncu.empresa_cliente_id')
            ->where(['a.empresas_id' => $empresaId])
            ->with(['area', 'empresaCliente']);

        $totalCount = (int) (clone $query)->count();

        if ($searchValue !== '') {
            $query->andWhere([
                'or',
                ['like', 'ncu.codigo', $searchValue],
                ['like', 'ncu.nombre', $searchValue],
                ['like', 'a.nombre', $searchValue],
                ['like', 'ec.nombre', $searchValue],
                ['like', 'ec.nit', $searchValue],
            ]);
        }
        $filteredCount = (int) (clone $query)->count();

        $orderColumns = ['ncu.id', 'a.nombre', 'ec.nombre', 'ncu.codigo', 'ncu.nombre', 'ncu.activo', null];
        $orderBy = $orderColumns[$orderCol] ?? 'ncu.id';
        if ($orderBy) {
            $query->orderBy([$orderBy => $orderDir]);
        }

        $models = $query->offset($start)->limit($length)->all();

        $puedeEditar = $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_utilidad.update');
        $puedeEliminar = $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_utilidad.delete');
        $puedeVer = $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_utilidad.view');
        $anyAccion = $puedeVer || $puedeEditar || $puedeEliminar;

        $data = [];
        foreach ($models as $model) {
            $areaNombre = $model->area
                ? (trim((string) ($model->area->nombre ?? '')) ?: ('#' . $model->area->id))
                : '—';
            $ecNombre = $model->empresaCliente
                ? (trim((string) ($model->empresaCliente->nombre ?? '')) ?: ('#' . $model->empresaCliente->id))
                : '—';
            $actionsCell = $anyAccion
                ? $this->renderPartial('_actions_dropdown', [
                    'model' => $model,
                    'puedeVer' => $puedeVer,
                    'puedeEditar' => $puedeEditar,
                    'puedeEliminar' => $puedeEliminar,
                ])
                : '<span class="text-muted">—</span>';
            $data[] = [
                $model->id,
                '<span class="fw-medium text-dark">' . Html::encode($areaNombre) . '</span>',
                '<span class="fw-medium text-dark">' . Html::encode($ecNombre) . '</span>',
                Html::encode($model->codigo ?? ''),
                '<span class="fw-medium text-dark">' . Html::encode($model->nombre) . '</span>',
                $model->activo ? '<span class="badge badge-soft-success">Sí</span>' : '<span class="badge badge-soft-danger">No</span>',
                $actionsCell,
            ];
        }

        return [
            'draw' => $draw,
            'recordsTotal' => $totalCount,
            'recordsFiltered' => $filteredCount,
            'data' => $data,
        ];
    }

    public function actionAreasOptions(): Response
    {
        $ecRaw = Yii::$app->request->get('empresa_cliente_id');
        $ecid = $ecRaw !== null && $ecRaw !== '' ? (int) $ecRaw : null;

        return $this->asJson($this->areaOptionsForForm($ecid));
    }

    public function actionViewAjax(int $id): string
    {
        return $this->renderPartial('_view_modal', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionFormAjax(int $id): string
    {
        $model = $this->findModel($id);
        $ecid = $model->empresa_cliente_id !== null && $model->empresa_cliente_id !== '' ? (int) $model->empresa_cliente_id : null;

        return $this->renderPartial('_form_modal', [
            'model' => $model,
            'areaOptions' => $this->areaOptionsForForm($ecid),
            'empresaClienteOptions' => $this->empresaClienteOptionsForTenant(),
            'areasOptionsUrl' => Url::to(['novedad-centro-utilidad/areas-options']),
        ]);
    }

    public function actionCreateAjax(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new NovedadCentroUtilidad();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->activo === null || $model->activo === '') {
                $model->activo = 1;
            }
            if (!$this->validateAreaPermitida((int) $model->area_id)) {
                return ['success' => false, 'errors' => ['area_id' => [Yii::t('app', 'Área no válida.')]]];
            }
            if ($model->save()) {
                return ['success' => true, 'message' => Yii::t('app', 'Centro de utilidad creado.')];
            }

            return ['success' => false, 'errors' => $model->getErrors()];
        }

        return ['success' => false, 'errors' => ['general' => [Yii::t('app', 'Datos inválidos.')]]];
    }

    public function actionUpdateAjax(int $id): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->activo === null || $model->activo === '') {
                $model->activo = 0;
            }
            if (!$this->validateAreaPermitida((int) $model->area_id)) {
                return ['success' => false, 'errors' => ['area_id' => [Yii::t('app', 'Área no válida.')]]];
            }
            if ($model->save()) {
                return ['success' => true, 'message' => Yii::t('app', 'Centro de utilidad actualizado.')];
            }

            return ['success' => false, 'errors' => $model->getErrors()];
        }

        return ['success' => false, 'errors' => ['general' => [Yii::t('app', 'Datos inválidos.')]]];
    }

    public function actionDelete(int $id): array|Response
    {
        $this->findModel($id)->delete();
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ['success' => true];
        }

        return $this->redirect(['index']);
    }

    protected function findModel(int $id): NovedadCentroUtilidad
    {
        $empresaId = TenantContext::requireEmpresaId();
        $model = NovedadCentroUtilidad::find()->alias('ncu')
            ->innerJoin('{{%area}} a', 'a.id = ncu.area_id')
            ->where(['ncu.id' => $id, 'a.empresas_id' => $empresaId])
            ->with(['area.empresas', 'empresaCliente'])
            ->one();
        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'El centro de utilidad no existe.'));
    }

    /**
     * @param int|null $empresaClienteId Si se indica, solo áreas de la organización de ese cliente (y tenant).
     *
     * @return array<int, string>
     */
    private function areaOptionsForForm(?int $empresaClienteId): array
    {
        $q = Area::find()->alias('a')->orderBy(['a.nombre' => SORT_ASC]);
        TenantContext::applyFilter($q, 'a.empresas_id');

        if ($empresaClienteId !== null && $empresaClienteId > 0) {
            $eid = TenantContext::requireEmpresaId();
            $ec = EmpresaCliente::findOne($empresaClienteId);
            if ($ec === null || (int) $ec->empresas_id !== (int) $eid) {
                $q->andWhere('0=1');
            } else {
                $q->andWhere(['a.empresas_id' => (int) $ec->empresas_id]);
            }
        }

        return ArrayHelper::map(
            $q->all(),
            'id',
            static fn (Area $a) => trim((string) ($a->nombre ?? '')) ?: ('#' . $a->id)
        );
    }

    private function validateAreaPermitida(int $areaId): bool
    {
        if ($areaId <= 0) {
            return false;
        }
        $area = Area::findOne($areaId);
        if ($area === null) {
            return false;
        }

        return TenantContext::matchesModel($area, 'empresas_id');
    }

    /**
     * @return array<int, string>
     */
    private function empresaClienteOptionsForTenant(): array
    {
        $eid = TenantContext::requireEmpresaId();

        return ArrayHelper::map(
            EmpresaCliente::getActivos($eid),
            'id',
            static function (EmpresaCliente $m) {
                $nombre = trim((string) $m->nombre);
                $nit = trim((string) ($m->nit ?? ''));

                return $nit !== '' ? ($nombre . ' (' . $nit . ')') : $nombre;
            }
        );
    }
}
