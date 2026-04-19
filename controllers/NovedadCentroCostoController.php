<?php

namespace app\controllers;

use app\components\TenantContext;
use app\models\EmpresaCliente;
use app\models\LocationSedes;
use app\models\NovedadCentroCosto;
use yii\db\Query;
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
 * CRUD centros de costo (novedad), acotado por empresa (sede).
 */
class NovedadCentroCostoController extends Controller
{
    public function behaviors(): array
    {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'denyCallback' => static function (): void {
                    throw new ForbiddenHttpException(Yii::t('app', 'No tiene permiso para acceder a centros de costo.'));
                },
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'data'],
                        'roles' => ['@'],
                        'matchCallback' => fn (): bool => $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_costo.index'),
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view-ajax'],
                        'roles' => ['@'],
                        'matchCallback' => fn (): bool => $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_costo.view'),
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create-ajax'],
                        'roles' => ['@'],
                        'matchCallback' => fn (): bool => $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_costo.create'),
                    ],
                    [
                        'allow' => true,
                        'actions' => ['sedes-options'],
                        'roles' => ['@'],
                        'matchCallback' => fn (): bool => $this->esAdminCatalogo()
                            || Yii::$app->user->can('novedad_centro_costo.create')
                            || Yii::$app->user->can('novedad_centro_costo.update'),
                    ],
                    [
                        'allow' => true,
                        'actions' => ['form-ajax', 'update-ajax'],
                        'roles' => ['@'],
                        'matchCallback' => fn (): bool => $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_costo.update'),
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['@'],
                        'matchCallback' => fn (): bool => $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_costo.delete'),
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
        $baseQuery = NovedadCentroCosto::find()->alias('ncc')
            ->innerJoin('{{%location_sedes}} ls', 'ls.id = ncc.location_sede_id')
            ->where(['ls.empresa_id' => $empresaId]);
        $summaryCounts = [
            'total' => (int) (clone $baseQuery)->count(),
            'activos' => (int) (clone $baseQuery)->andWhere(['ncc.activo' => 1])->count(),
            'inactivos' => (int) (clone $baseQuery)->andWhere(['ncc.activo' => 0])->count(),
        ];

        $modelModal = new NovedadCentroCosto();
        $modelModal->loadDefaultValues();
        if ($modelModal->activo === null) {
            $modelModal->activo = 1;
        }

        return $this->render('index', [
            'summaryCounts' => $summaryCounts,
            'modelModal' => $modelModal,
            'sedeOptions' => $this->sedeOptionsForForm(null),
            'empresaClienteOptions' => $this->empresaClienteOptionsForTenant(),
            'sedesOptionsUrl' => Url::to(['novedad-centro-costo/sedes-options']),
            'puedeCrear' => $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_costo.create'),
            'puedeVer' => $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_costo.view'),
            'puedeEditar' => $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_costo.update'),
            'puedeEliminar' => $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_costo.delete'),
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

        $query = NovedadCentroCosto::find()->alias('ncc')
            ->innerJoin('{{%location_sedes}} ls', 'ls.id = ncc.location_sede_id')
            ->leftJoin('{{%empresa_cliente}} ec', 'ec.id = ncc.empresa_cliente_id')
            ->where(['ls.empresa_id' => $empresaId])
            ->with(['locationSede', 'empresaCliente']);

        $totalCount = (int) (clone $query)->count();

        if ($searchValue !== '') {
            $query->andWhere([
                'or',
                ['like', 'ncc.codigo', $searchValue],
                ['like', 'ncc.nombre', $searchValue],
                ['like', 'ls.nombre', $searchValue],
                ['like', 'ec.nombre', $searchValue],
                ['like', 'ec.nit', $searchValue],
            ]);
        }
        $filteredCount = (int) (clone $query)->count();

        $orderColumns = ['ncc.id', 'ls.nombre', 'ec.nombre', 'ncc.codigo', 'ncc.nombre', 'ncc.activo', null];
        $orderBy = $orderColumns[$orderCol] ?? 'ncc.id';
        if ($orderBy) {
            $query->orderBy([$orderBy => $orderDir]);
        }

        $models = $query->offset($start)->limit($length)->all();

        $puedeEditar = $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_costo.update');
        $puedeEliminar = $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_costo.delete');
        $puedeVer = $this->esAdminCatalogo() || Yii::$app->user->can('novedad_centro_costo.view');
        $anyAccion = $puedeVer || $puedeEditar || $puedeEliminar;

        $data = [];
        foreach ($models as $model) {
            $sedeNombre = $model->locationSede
                ? (trim((string) ($model->locationSede->nombre ?? '')) ?: ('#' . $model->locationSede->id))
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
                '<span class="fw-medium text-dark">' . Html::encode($sedeNombre) . '</span>',
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

    public function actionSedesOptions(): Response
    {
        $ecRaw = Yii::$app->request->get('empresa_cliente_id');
        $ecid = $ecRaw !== null && $ecRaw !== '' ? (int) $ecRaw : null;

        return $this->asJson($this->sedeOptionsForForm($ecid));
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
            'sedeOptions' => $this->sedeOptionsForForm($ecid),
            'empresaClienteOptions' => $this->empresaClienteOptionsForTenant(),
            'sedesOptionsUrl' => Url::to(['novedad-centro-costo/sedes-options']),
        ]);
    }

    public function actionCreateAjax(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new NovedadCentroCosto();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->activo === null || $model->activo === '') {
                $model->activo = 1;
            }
            if (!$this->validateSedePermitida((int) $model->location_sede_id)) {
                return ['success' => false, 'errors' => ['location_sede_id' => [Yii::t('app', 'Sede no válida.')]]];
            }
            if ($model->save()) {
                return ['success' => true, 'message' => Yii::t('app', 'Centro de costo creado.')];
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
            if (!$this->validateSedePermitida((int) $model->location_sede_id)) {
                return ['success' => false, 'errors' => ['location_sede_id' => [Yii::t('app', 'Sede no válida.')]]];
            }
            if ($model->save()) {
                return ['success' => true, 'message' => Yii::t('app', 'Centro de costo actualizado.')];
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

    protected function findModel(int $id): NovedadCentroCosto
    {
        $empresaId = TenantContext::requireEmpresaId();
        $model = NovedadCentroCosto::find()->alias('ncc')
            ->innerJoin('{{%location_sedes}} ls', 'ls.id = ncc.location_sede_id')
            ->where(['ncc.id' => $id, 'ls.empresa_id' => $empresaId])
            ->with(['locationSede.empresa', 'empresaCliente'])
            ->one();
        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'El centro de costo no existe.'));
    }

    /**
     * @param int|null $empresaClienteId Si se indica, solo sedes del pivote empresa_cliente_sedes para ese cliente (y tenant).
     *
     * @return array<int, string>
     */
    private function sedeOptionsForForm(?int $empresaClienteId): array
    {
        $q = LocationSedes::find()->alias('ls')->orderBy(['ls.nombre' => SORT_ASC]);
        TenantContext::applyFilter($q, 'empresa_id');

        if ($empresaClienteId !== null && $empresaClienteId > 0) {
            $eid = TenantContext::requireEmpresaId();
            $ec = EmpresaCliente::findOne($empresaClienteId);
            if ($ec === null || (int) $ec->empresas_id !== (int) $eid) {
                $q->andWhere('0=1');
            } else {
                $pivotIds = (new Query())
                    ->select('location_sede_id')
                    ->from('{{%empresa_cliente_sedes}}')
                    ->where(['empresa_cliente_id' => $empresaClienteId])
                    ->column();
                if ($pivotIds === []) {
                    $q->andWhere('0=1');
                } else {
                    $q->andWhere(['ls.id' => $pivotIds]);
                }
            }
        }

        return ArrayHelper::map(
            $q->all(),
            'id',
            static fn (LocationSedes $s) => trim((string) ($s->nombre ?? '')) ?: ('#' . $s->id)
        );
    }

    private function validateSedePermitida(int $locationSedeId): bool
    {
        if ($locationSedeId <= 0) {
            return false;
        }
        $sede = LocationSedes::findOne($locationSedeId);
        if ($sede === null) {
            return false;
        }

        return TenantContext::matchesModel($sede, 'empresa_id');
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
