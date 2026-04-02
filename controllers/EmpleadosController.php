<?php

namespace app\controllers;

use app\components\ContratoFormSupport;
use app\components\ProfileFormOptionsProvider;
use app\components\TenantContext;
use app\models\Contrato;
use app\models\LocationSedes;
use app\models\Profile;
use app\models\ProfileSede;
use app\services\AdministracionPlantaService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;

/**
 * Listado de colaboradores (perfiles) de la empresa actual.
 * No confundir con {@see ProfileController} (/profile), reservado al usuario logueado.
 */
class EmpleadosController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [],
                ],
            ]
        );
    }

    /**
     * Listado de perfiles de la empresa.
     */
    public function actionIndex(): string
    {
        return $this->render('index', [
            'summaryCounts' => $this->getProfileSummaryCounts(),
        ]);
    }

    /**
     * Conteos por estado para las tarjetas superiores.
     *
     * @return array{total: int, activos: int, inactivos: int}
     */
    protected function getProfileSummaryCounts(): array
    {
        $empresaId = TenantContext::currentEmpresaId();
        if ($empresaId === null) {
            return ['total' => 0, 'activos' => 0, 'inactivos' => 0];
        }

        $base = ['empresas_id' => $empresaId];

        return [
            'total' => (int) Profile::find()->where($base)->count(),
            'activos' => (int) Profile::find()->where($base + ['estado' => Profile::ESTADO_ACTIVO])->count(),
            'inactivos' => (int) Profile::find()->where($base + ['estado' => Profile::ESTADO_INACTIVO])->count(),
        ];
    }

    /**
     * JSON para DataTables (perfiles de la empresa).
     *
     * @return array
     */
    public function actionData(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;

        $draw = (int) $request->get('draw', 1);
        $start = (int) $request->get('start', 0);
        $length = (int) $request->get('length', 10);
        $searchValue = $request->get('search', [])['value'] ?? '';
        $orderCol = (int) ($request->get('order', [])[0]['column'] ?? 1);
        $orderDir = ($request->get('order', [])[0]['dir'] ?? 'asc') === 'asc' ? SORT_ASC : SORT_DESC;

        $query = Profile::find()->alias('p')
            ->with(['cargo', 'area', 'sede']);
        TenantContext::applyFilter($query, 'p.empresas_id');
        $query->leftJoin(['carg' => '{{%cargos}}'], 'p.cargo_id = carg.id')
            ->leftJoin(['ar' => '{{%area}}'], 'p.area_id = ar.id')
            ->leftJoin(['ls' => '{{%location_sedes}}'], 'p.sede_id = ls.id');
        $totalCount = (int) (clone $query)->count();

        if ($searchValue !== '') {
            $query->andWhere([
                'or',
                ['like', 'p.name', $searchValue],
                ['like', 'p.num_doc', $searchValue],
                ['like', 'p.public_email', $searchValue],
                ['like', 'p.telefono', $searchValue],
                ['like', 'p.estado', $searchValue],
                ['like', 'carg.nombre', $searchValue],
                ['like', 'ar.nombre', $searchValue],
                ['like', 'ls.nombre', $searchValue],
            ]);
        }
        $filteredCount = (int) (clone $query)->count();

        $orderColumns = [
            'p.user_id',
            'p.name',
            'p.tipo_doc',
            'p.num_doc',
            'carg.nombre',
            'ar.nombre',
            'ls.nombre',
            'p.estado',
            null,
        ];
        $orderBy = $orderColumns[$orderCol] ?? 'p.name';
        if ($orderBy) {
            $query->orderBy([$orderBy => $orderDir]);
        } else {
            $query->orderBy(['p.name' => SORT_ASC]);
        }

        $models = $query->offset($start)->limit($length)->all();

        $data = [];
        foreach ($models as $model) {
            $nombre = $model->name ?: '-';
            $cargoNombre = $model->cargo ? $model->cargo->nombre : ($model->position ?: '-');
            $tipoLabel = $model->tipo_doc ? (Profile::optsTipoDoc()[$model->tipo_doc] ?? $model->tipo_doc) : '-';
            $estadoLabel = $model->estado ? (Profile::optsEstado()[$model->estado] ?? $model->estado) : '-';
            $estadoCell = $model->estado
                ? '<span class="badge badge-soft-' . Profile::estadoBadgeSoftClass($model->estado) . '">' . \yii\helpers\Html::encode($estadoLabel) . '</span>'
                : '-';

            $data[] = [
                $model->user_id,
                '<span class="fw-medium text-dark">' . \yii\helpers\Html::encode($nombre) . '</span>',
                \yii\helpers\Html::encode($tipoLabel),
                \yii\helpers\Html::encode($model->num_doc ?: '-'),
                \yii\helpers\Html::encode($cargoNombre),
                $model->area ? \yii\helpers\Html::encode($model->area->nombre) : '-',
                $model->sede ? \yii\helpers\Html::encode($model->sede->nombre) : '-',
                $estadoCell,
                $this->renderPartial('_actions_dropdown', ['model' => $model]),
            ];
        }

        return [
            'draw' => $draw,
            'recordsTotal' => $totalCount,
            'recordsFiltered' => $filteredCount,
            'data' => $data,
        ];
    }

    /**
     * HTML del modal Ver (solo lectura).
     *
     * @param int $id user_id del perfil
     */
    public function actionViewAjax($id): string
    {
        $eid = TenantContext::requireEmpresaId();
        $profile = $this->findProfileModel((int) $id);
        $profileFormOptions = ProfileFormOptionsProvider::forEmpresaId($eid);
        $profileFormOptions['empresaId'] = $eid;

        $contratos = Contrato::find()
            ->where(['empresa_id' => $eid, 'profile_id' => (int) $profile->user_id])
            ->with(['contratoTipo', 'area', 'cargo'])
            ->orderBy(['fecha_inicio' => SORT_DESC])
            ->all();

        $contratoNew = new Contrato();
        $contratoNew->empresa_id = $eid;
        $contratoNew->profile_id = (int) $profile->user_id;
        $contratoNew->estado = Contrato::ESTADO_ACTIVO;
        $contratoNew->fecha_inicio = date('Y-m-d');
        $planta = new AdministracionPlantaService();
        $contratoOptions = ContratoFormSupport::buildFormOptions($contratoNew, $planta);

        $sedeIds = ProfileSede::locationSedeIdsForProfileModel($profile);
        $sedesAsignadas = [];
        if ($sedeIds !== []) {
            $sedesAsignadas = LocationSedes::find()
                ->where(['id' => $sedeIds])
                ->andWhere(['empresa_id' => (int) $profile->empresas_id])
                ->orderBy(['nombre' => SORT_ASC])
                ->all();
        }

        return $this->renderPartial('_view_modal', [
            'model' => $profile,
            'profileFormOptions' => $profileFormOptions,
            'contratos' => $contratos,
            'contratoNew' => $contratoNew,
            'contratoOptions' => $contratoOptions,
            'canManageContratos' => ContratoFormSupport::currentUserCanManageContratos(),
            'userId' => (int) $profile->user_id,
            'sedesAsignadas' => $sedesAsignadas,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    protected function findProfileModel(int $userId): Profile
    {
        $query = Profile::find()->alias('p')
            ->with(['cargo', 'area', 'sede', 'empresas', 'locationSede', 'centroCosto', 'centroUtilidad'])
            ->where(['p.user_id' => $userId]);
        TenantContext::applyFilter($query, 'p.empresas_id');
        $model = $query->one();
        if ($model === null) {
            throw new NotFoundHttpException('El colaborador solicitado no existe o no pertenece a su empresa.');
        }

        return $model;
    }
}
