<?php

use app\models\SupportTicket;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var app\models\search\SupportTicketSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var array<string, int|string> $stats */

$this->title = 'Tickets de soporte';
$models = $dataProvider->getModels();
?>

<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
    <div class="my-auto mb-2">
        <h2 class="mb-1"><?= Html::encode($this->title) ?></h2>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= Url::to(['/']) ?>"><i class="ti ti-smart-home"></i></a></li>
                <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
            </ol>
        </nav>
    </div>
    <div class="mb-2">
        <a href="<?= Url::to(['/support-ticket/create']) ?>" class="btn btn-primary">
            <i class="ti ti-ticket me-1"></i>Nueva solicitud
        </a>
    </div>
</div>

<?php foreach (['success' => 'success', 'error' => 'danger'] as $flashKey => $alertClass): ?>
    <?php if (Yii::$app->session->hasFlash($flashKey)): ?>
        <div class="alert alert-<?= $alertClass ?>"><?= Html::encode(Yii::$app->session->getFlash($flashKey)) ?></div>
    <?php endif; ?>
<?php endforeach; ?>

<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <p class="text-muted mb-1">Total</p>
                <h4 class="mb-0"><?= (int) $stats['total'] ?></h4>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <p class="text-muted mb-1">Abiertos</p>
                <h4 class="mb-0"><?= (int) $stats['abiertos'] ?></h4>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <p class="text-muted mb-1">Resueltos</p>
                <h4 class="mb-0"><?= (int) $stats['resueltos'] ?></h4>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <p class="text-muted mb-1">Cerrados</p>
                <h4 class="mb-0"><?= (int) $stats['cerrados'] ?></h4>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <?= $this->render('_search', ['model' => $searchModel]) ?>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>Ticket</th>
                        <th>Cliente</th>
                        <th>Asunto</th>
                        <th>Prioridad</th>
                        <th>Estado</th>
                        <th>Actualizado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($models as $model): ?>
                        <?php /** @var SupportTicket $model */ ?>
                        <tr>
                            <td><?= Html::encode($model->ticket_number ?: ('#' . $model->id)) ?></td>
                            <td><?= Html::encode($model->empresaCliente?->nombre ?: 'Sin cliente') ?></td>
                            <td>
                                <div class="fw-semibold"><?= Html::encode($model->subject) ?></div>
                                <small class="text-muted"><?= Html::encode(StringHelper::truncate((string) $model->description, 90)) ?></small>
                            </td>
                            <td><span class="badge <?= Html::encode($model->priorityBadgeClass()) ?>"><?= Html::encode($model->displayPriority()) ?></span></td>
                            <td><span class="badge <?= Html::encode($model->statusBadgeClass()) ?>"><?= Html::encode($model->displayStatus()) ?></span></td>
                            <td><?= Html::encode(Yii::$app->formatter->asRelativeTime((int) $model->updated_at)) ?></td>
                            <td class="text-end">
                                <a href="<?= Url::to(['/support-ticket/view', 'id' => $model->id]) ?>" class="btn btn-sm btn-outline-primary">Ver</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if ($models === []): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No hay tickets registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="p-3">
            <?= LinkPager::widget(['pagination' => $dataProvider->pagination]) ?>
        </div>
    </div>
</div>
