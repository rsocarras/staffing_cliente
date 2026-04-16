<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\AuditLog;
use app\models\search\AuditLogSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

final class AuditLogController extends Controller
{
    public function behaviors(): array
    {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'denyCallback' => static function (): void {
                    throw new ForbiddenHttpException(Yii::t('app', 'No tiene permiso para ver la auditoría.'));
                },
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'modal'],
                        'roles' => ['@'],
                        'matchCallback' => static function (): bool {
                            return Yii::$app->user->can('audit_log.view');
                        },
                    ],
                ],
            ],
        ]);
    }

    public function actionIndex(): string
    {
        $searchModel = new AuditLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionModal(int $id): string
    {
        return $this->renderPartial('_modal', [
            'model' => $this->findModel($id),
        ]);
    }

    private function findModel(int $id): AuditLog
    {
        $model = AuditLog::findOne(['id' => $id]);
        if ($model === null) {
            throw new NotFoundHttpException(Yii::t('app', 'El registro de auditoría no existe.'));
        }

        return $model;
    }
}
