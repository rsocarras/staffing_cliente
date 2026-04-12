<?php

namespace app\controllers;

use app\components\TenantContext;
use app\models\EmpresaCliente;
use app\models\SupportTicket;
use app\models\search\SupportTicketSearch;
use app\services\SupportTicketService;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class SupportTicketController extends Controller
{
    private SupportTicketService $service;

    public function init(): void
    {
        parent::init();
        $this->service = new SupportTicketService();
    }

    public function behaviors(): array
    {
        return array_merge(parent::behaviors(), [
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
                'class' => VerbFilter::class,
                'actions' => [
                    'reply' => ['POST'],
                ],
            ],
        ]);
    }

    public function actionIndex(): string
    {
        $searchModel = new SupportTicketSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $query = SupportTicket::find()->where(['empresas_id' => TenantContext::requireEmpresaId()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'stats' => [
                'total' => (clone $query)->count(),
                'abiertos' => (clone $query)->andWhere(['status' => [
                    SupportTicket::STATUS_NEW,
                    SupportTicket::STATUS_OPEN,
                    SupportTicket::STATUS_IN_PROGRESS,
                    SupportTicket::STATUS_PENDING_CUSTOMER,
                ]])->count(),
                'resueltos' => (clone $query)->andWhere(['status' => SupportTicket::STATUS_RESOLVED])->count(),
                'cerrados' => (clone $query)->andWhere(['status' => SupportTicket::STATUS_CLOSED])->count(),
            ],
        ]);
    }

    public function actionCreate()
    {
        $model = new SupportTicket();
        $model->scenario = 'default';
        $empresaId = TenantContext::requireEmpresaId();

        if (Yii::$app->request->isPost) {
            $ticket = $this->service->createTicket(
                $empresaId,
                (int) Yii::$app->user->id,
                Yii::$app->request->post('SupportTicket', [])
            );
            if (!$ticket->hasErrors()) {
                Yii::$app->session->setFlash('success', 'La solicitud fue enviada a Staffing.');
                return $this->redirect(['/support-ticket/view', 'id' => $ticket->id]);
            }
            $model = $ticket;
        }

        return $this->render('create', [
            'model' => $model,
            'empresaClienteOptions' => $this->empresaClienteOptions($empresaId),
        ]);
    }

    public function actionView(int $id): string
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionReply(int $id): Response
    {
        $ticket = $this->findModel($id);
        if ($ticket->status === SupportTicket::STATUS_CLOSED) {
            Yii::$app->session->setFlash('error', 'El ticket está cerrado y no admite nuevas respuestas.');
            return $this->redirect(['/support-ticket/view', 'id' => $ticket->id]);
        }

        $body = trim((string) Yii::$app->request->post('body', ''));
        if ($body === '') {
            Yii::$app->session->setFlash('error', 'El mensaje no puede estar vacío.');
            return $this->redirect(['/support-ticket/view', 'id' => $ticket->id]);
        }

        $message = $this->service->addClientReply($ticket, (int) Yii::$app->user->id, $body);
        if ($message->hasErrors()) {
            Yii::$app->session->setFlash('error', 'No se pudo registrar la respuesta.');
        } else {
            Yii::$app->session->setFlash('success', 'Respuesta enviada.');
        }

        return $this->redirect(['/support-ticket/view', 'id' => $ticket->id]);
    }

    private function findModel(int $id): SupportTicket
    {
        $model = SupportTicket::find()
            ->with([
                'empresaCliente',
                'createdBy.profile',
                'assignedTo.profile',
                'messages.authorUser.profile',
                'statusLogs.changedBy.profile',
            ])
            ->where([
                'id' => $id,
                'empresas_id' => TenantContext::requireEmpresaId(),
            ])
            ->one();

        if ($model === null) {
            throw new NotFoundHttpException('Ticket no encontrado.');
        }

        return $model;
    }

    /**
     * @return array<int, string>
     */
    private function empresaClienteOptions(int $empresaId): array
    {
        return ArrayHelper::map(EmpresaCliente::getActivos($empresaId), 'id', 'nombre');
    }
}
