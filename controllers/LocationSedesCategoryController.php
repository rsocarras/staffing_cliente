<?php

namespace app\controllers;

use app\components\TenantContext;
use app\models\EmpresaCliente;
use app\models\LocationSedes;
use app\models\LocationSedesCategory;
use Yii;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * CRUD de categorías para agrupar sedes (tenant por empresa).
 */
class LocationSedesCategoryController extends Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'create-ajax' => ['POST'],
                    'update-ajax' => ['POST'],
                    'delete' => ['POST'],
                    'sedes-by-empresa-cliente' => ['GET'],
                ],
            ],
        ]);
    }

    public function actionIndex(): string
    {
        $empresaId = TenantContext::requireEmpresaId();

        $base = LocationSedesCategory::find()->alias('c')
            ->where(['c.empresas_id' => $empresaId]);

        $total = (int) (clone $base)->count();
        $pivotInfo = $this->resolvePivotColumns();

        $withCount = (new Query())
            ->select([
                'category_id' => 'c.id',
                'sedes_count' => 'COUNT(DISTINCT p.' . $pivotInfo['sedeColumn'] . ')',
            ])
            ->from(['c' => LocationSedesCategory::tableName()])
            ->leftJoin(
                ['p' => $pivotInfo['table']],
                'p.' . $pivotInfo['categoryColumn'] . ' = c.id'
            )
            ->where(['c.empresas_id' => $empresaId])
            ->groupBy('c.id');

        $withSedes = (int) (new Query())
            ->from(['x' => $withCount])
            ->where(['>', 'x.sedes_count', 0])
            ->count();

        $withoutSedes = max(0, $total - $withSedes);

        return $this->render('index', [
            'total' => $total,
            'withSedes' => $withSedes,
            'withoutSedes' => $withoutSedes,
            'sedesMap' => $this->buildSedesMap($empresaId),
            'empresaClientesMap' => $this->buildEmpresaClientesMap($empresaId),
        ]);
    }

    public function actionData(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $empresaId = TenantContext::requireEmpresaId();
        $request = Yii::$app->request;

        $draw = (int) $request->get('draw', 1);
        $start = (int) $request->get('start', 0);
        $length = (int) $request->get('length', 10);
        $searchValue = trim((string) ($request->get('search', [])['value'] ?? ''));
        $orderCol = (int) (($request->get('order', [])[0]['column'] ?? 1));
        $orderDir = (($request->get('order', [])[0]['dir'] ?? 'asc') === 'asc') ? SORT_ASC : SORT_DESC;

        $pivotInfo = $this->resolvePivotColumns();

        $query = (new Query())
            ->select([
                'id' => 'c.id',
                'nombre' => 'c.nombre',
                'sedes_count' => 'COUNT(DISTINCT p.' . $pivotInfo['sedeColumn'] . ')',
            ])
            ->from(['c' => LocationSedesCategory::tableName()])
            ->leftJoin(
                ['p' => $pivotInfo['table']],
                'p.' . $pivotInfo['categoryColumn'] . ' = c.id'
            )
            ->where(['c.empresas_id' => $empresaId])
            ->groupBy(['c.id', 'c.nombre']);

        $totalCount = (int) LocationSedesCategory::find()
            ->where(['empresas_id' => $empresaId])
            ->count();

        if ($searchValue !== '') {
            $query->andWhere([
                'or',
                ['like', 'c.nombre', $searchValue],
                ['like', 'CAST(c.id AS CHAR)', $searchValue],
            ]);
        }

        $filteredCount = (int) (clone $query)->count();

        $orderColumns = [
            'c.id',
            'c.nombre',
            'sedes_count',
            null,
        ];
        $orderBy = $orderColumns[$orderCol] ?? 'c.nombre';
        if ($orderBy !== null) {
            $query->orderBy([$orderBy => $orderDir]);
        }

        $rows = $query->offset($start)->limit($length)->all();
        $data = [];

        foreach ($rows as $row) {
            $id = (int) ($row['id'] ?? 0);
            $model = new LocationSedesCategory();
            $model->id = $id;
            $model->nombre = (string) ($row['nombre'] ?? '');
            $count = (int) ($row['sedes_count'] ?? 0);

            $data[] = [
                $id,
                '<span class="fw-medium text-dark">' . Html::encode((string) ($row['nombre'] ?? '')) . '</span>',
                '<span class="badge badge-soft-primary">' . $count . '</span>',
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

    public function actionViewAjax(int $id): string
    {
        $model = $this->findModel($id);
        $empresaId = TenantContext::requireEmpresaId();

        $selectedSedeIds = $this->getCategorySedeIds((int) $model->id);
        $sedes = LocationSedes::find()
            ->where(['empresa_id' => $empresaId, 'id' => $selectedSedeIds])
            ->orderBy(['nombre' => SORT_ASC])
            ->all();

        return $this->renderPartial('_view_modal', [
            'model' => $model,
            'sedes' => $sedes,
        ]);
    }

    public function actionFormAjax(int $id): string
    {
        $model = $this->findModel($id);
        $empresaId = TenantContext::requireEmpresaId();
        $model->sedeIds = $this->getCategorySedeIds((int) $model->id);

        return $this->renderPartial('_form_modal', [
            'model' => $model,
            'sedesMap' => $this->buildSedesMap($empresaId),
            'empresaClientesMap' => $this->buildEmpresaClientesMap($empresaId),
        ]);
    }

    public function actionCreateAjax(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $empresaId = TenantContext::requireEmpresaId();

        $model = new LocationSedesCategory();
        $model->empresas_id = $empresaId;

        $post = Yii::$app->request->post();
        if (!$model->load($post)) {
            return ['success' => false, 'errors' => ['general' => ['Datos inválidos.']]];
        }
        $model->empresas_id = $empresaId;
        $model->sedeIds = ArrayHelper::getValue($post, 'LocationSedesCategory.sedeIds', []);

        if (!$model->validate()) {
            return ['success' => false, 'errors' => $model->getErrors()];
        }

        $tx = Yii::$app->db->beginTransaction();
        try {
            if (!$model->save(false)) {
                $tx->rollBack();
                return ['success' => false, 'errors' => ['general' => ['No se pudo crear la categoría.']]];
            }

            $this->syncCategorySedes((int) $model->id, $empresaId, $model->sedeIds);
            $tx->commit();

            return [
                'success' => true,
                'message' => Yii::t('app', 'Categoría creada correctamente.'),
            ];
        } catch (\Throwable $e) {
            $tx->rollBack();
            Yii::error($e->getMessage(), __METHOD__);

            return ['success' => false, 'errors' => ['general' => ['No se pudo crear la categoría.']]];
        }
    }

    public function actionUpdateAjax(int $id): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $empresaId = TenantContext::requireEmpresaId();
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();

        if (!$model->load($post)) {
            return ['success' => false, 'errors' => ['general' => ['Datos inválidos.']]];
        }
        $model->empresas_id = $empresaId;
        $model->sedeIds = ArrayHelper::getValue($post, 'LocationSedesCategory.sedeIds', []);

        if (!$model->validate()) {
            return ['success' => false, 'errors' => $model->getErrors()];
        }

        $tx = Yii::$app->db->beginTransaction();
        try {
            if (!$model->save(false)) {
                $tx->rollBack();
                return ['success' => false, 'errors' => ['general' => ['No se pudo actualizar la categoría.']]];
            }

            $this->syncCategorySedes((int) $model->id, $empresaId, $model->sedeIds);
            $tx->commit();

            return [
                'success' => true,
                'message' => Yii::t('app', 'Categoría actualizada correctamente.'),
            ];
        } catch (\Throwable $e) {
            $tx->rollBack();
            Yii::error($e->getMessage(), __METHOD__);

            return ['success' => false, 'errors' => ['general' => ['No se pudo actualizar la categoría.']]];
        }
    }

    public function actionDelete(int $id)
    {
        $model = $this->findModel($id);
        $pivotInfo = $this->resolvePivotColumns();

        $tx = Yii::$app->db->beginTransaction();
        try {
            Yii::$app->db->createCommand()
                ->delete($pivotInfo['table'], [$pivotInfo['categoryColumn'] => (int) $model->id])
                ->execute();
            $model->delete();
            $tx->commit();
        } catch (\Throwable $e) {
            $tx->rollBack();
            Yii::error($e->getMessage(), __METHOD__);
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['success' => false];
            }
            return $this->redirect(['index']);
        }

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => true];
        }

        return $this->redirect(['index']);
    }

    /**
     * Returns JSON list of sedes assigned to an empresa_cliente via empresa_cliente_sedes (GET).
     *
     * @return array{id:int,nombre:string}[]
     */
    public function actionSedesByEmpresaCliente(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $empresaClienteId = (int) Yii::$app->request->get('empresa_cliente_id', 0);
        $empresaId = TenantContext::requireEmpresaId();

        if (!$empresaClienteId) {
            return [];
        }

        $ec = EmpresaCliente::findOne(['id' => $empresaClienteId, 'empresas_id' => $empresaId]);
        if ($ec === null) {
            return [];
        }

        $sedeIds = (new \yii\db\Query())
            ->select('ecs.location_sede_id')
            ->from(['ecs' => 'empresa_cliente_sedes'])
            ->where(['ecs.empresa_cliente_id' => $empresaClienteId])
            ->column();

        if (empty($sedeIds)) {
            return [];
        }

        $sedes = LocationSedes::find()
            ->where(['empresa_id' => $empresaId, 'id' => $sedeIds])
            ->orderBy(['nombre' => SORT_ASC])
            ->all();

        return array_map(static fn(LocationSedes $s) => [
            'id' => (int) $s->id,
            'nombre' => (string) $s->nombre,
        ], $sedes);
    }

    private function findModel(int $id): LocationSedesCategory
    {
        $empresaId = TenantContext::requireEmpresaId();
        $model = LocationSedesCategory::findOne(['id' => $id, 'empresas_id' => $empresaId]);
        if ($model === null) {
            throw new NotFoundHttpException('La categoría solicitada no existe.');
        }

        return $model;
    }

    /**
     * @return array{table:string,sedeColumn:string,categoryColumn:string}
     */
    private function resolvePivotColumns(): array
    {
        $table = 'location_sede_category';
        $schema = Yii::$app->db->schema->getTableSchema($table, true);
        if ($schema === null) {
            throw new \RuntimeException('No existe la tabla pivote location_sede_category.');
        }

        $columns = array_keys($schema->columns);
        $sedeCandidates = ['location_sede_id', 'location_sedes_id', 'sede_id'];
        $categoryCandidates = ['location_sedes_category_id', 'location_sede_category_id', 'category_id'];

        $sedeColumn = null;
        foreach ($sedeCandidates as $candidate) {
            if (in_array($candidate, $columns, true)) {
                $sedeColumn = $candidate;
                break;
            }
        }

        $categoryColumn = null;
        foreach ($categoryCandidates as $candidate) {
            if (in_array($candidate, $columns, true)) {
                $categoryColumn = $candidate;
                break;
            }
        }

        if ($sedeColumn === null || $categoryColumn === null) {
            throw new \RuntimeException('No se pudieron resolver columnas de la tabla pivote location_sede_category.');
        }

        return [
            'table' => $table,
            'sedeColumn' => $sedeColumn,
            'categoryColumn' => $categoryColumn,
        ];
    }

    /**
     * @param int[]|string[]|null $rawIds
     */
    private function syncCategorySedes(int $categoryId, int $empresaId, $rawIds): void
    {
        $pivotInfo = $this->resolvePivotColumns();
        $allowed = LocationSedes::find()
            ->select('id')
            ->where(['empresa_id' => $empresaId])
            ->column();
        $allowedSet = array_flip(array_map('intval', $allowed));

        $ids = [];
        if (is_array($rawIds)) {
            foreach ($rawIds as $rawId) {
                if ($rawId === '' || $rawId === null) {
                    continue;
                }
                $sid = (int) $rawId;
                if (isset($allowedSet[$sid])) {
                    $ids[$sid] = true;
                }
            }
        }
        $ids = array_keys($ids);

        Yii::$app->db->createCommand()->delete(
            $pivotInfo['table'],
            [$pivotInfo['categoryColumn'] => $categoryId]
        )->execute();

        foreach ($ids as $sedeId) {
            Yii::$app->db->createCommand()->insert($pivotInfo['table'], [
                $pivotInfo['categoryColumn'] => $categoryId,
                $pivotInfo['sedeColumn'] => (int) $sedeId,
            ])->execute();
        }
    }

    /**
     * @return int[]
     */
    private function getCategorySedeIds(int $categoryId): array
    {
        $pivotInfo = $this->resolvePivotColumns();
        $rows = (new Query())
            ->select('p.' . $pivotInfo['sedeColumn'])
            ->from(['p' => $pivotInfo['table']])
            ->where(['p.' . $pivotInfo['categoryColumn'] => $categoryId])
            ->column();

        return array_values(array_unique(array_map('intval', $rows)));
    }

    /**
     * @return array<int,string>
     */
    private function buildSedesMap(int $empresaId): array
    {
        $rows = LocationSedes::find()
            ->select(['id', 'nombre'])
            ->where(['empresa_id' => $empresaId])
            ->orderBy(['nombre' => SORT_ASC])
            ->asArray()
            ->all();

        $map = [];
        foreach ($rows as $row) {
            $map[(int) $row['id']] = (string) $row['nombre'];
        }

        return $map;
    }

    /**
     * @return array<int,string>
     */
    private function buildEmpresaClientesMap(int $empresaId): array
    {
        $rows = EmpresaCliente::find()
            ->select(['id', 'nombre'])
            ->where(['empresas_id' => $empresaId, 'is_active' => 1])
            ->orderBy(['nombre' => SORT_ASC])
            ->asArray()
            ->all();

        $map = [];
        foreach ($rows as $row) {
            $map[(int) $row['id']] = (string) $row['nombre'];
        }

        return $map;
    }
}
