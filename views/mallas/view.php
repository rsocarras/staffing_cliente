<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\MallaCargoAsignacion;
use app\models\MallaProfileAsignacion;

/** @var yii\web\View $this */
/** @var app\models\Mallas $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mallas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$auth = Yii::$app->authManager;
$currentUserId = Yii::$app->user->id;
$roleNames = [];
$permissionNames = [];
if ($auth !== null && $currentUserId !== null) {
    $roleNames = array_keys($auth->getRolesByUser($currentUserId));
    $permissionNames = array_keys($auth->getPermissionsByUser($currentUserId));
}

$isAssigned = MallaCargoAsignacion::find()
    ->where(['malla_id' => $model->id, 'estado_aprobacion' => MallaCargoAsignacion::ESTADO_APROBADA, 'activo' => 1])
    ->exists()
    || MallaProfileAsignacion::find()
        ->where(['malla_id' => $model->id, 'estado_aprobacion' => MallaProfileAsignacion::ESTADO_APROBADA, 'activo' => 1])
        ->exists();
?>
<div class="mallas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-info" role="alert">
        <strong>Usuario logueado:</strong> <?= Html::encode((string) $currentUserId) ?><br>
        <strong>Roles:</strong> <?= Html::encode(empty($roleNames) ? '(sin roles)' : implode(', ', $roleNames)) ?><br>
        <strong>Permisos:</strong> <?= Html::encode(empty($permissionNames) ? '(sin permisos)' : implode(', ', $permissionNames)) ?>
    </div>

    <p>
        <?php if (!$isAssigned): ?>
            <?= Html::a('Editar Kanban', ['create-kanban', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if ((Yii::$app->user->can('malla.aprobar') || Yii::$app->user->can('admin') || Yii::$app->user->can('administrator')) && $model->estado_aprobacion === \app\models\Mallas::ESTADO_PENDIENTE): ?>
            <?= Html::beginForm(['approve', 'id' => $model->id], 'post', ['class' => 'd-inline']) ?>
                <?= Html::submitButton('Aprobar', ['class' => 'btn btn-success']) ?>
            <?= Html::endForm() ?>
            <?= Html::beginForm(['reject', 'id' => $model->id], 'post', ['class' => 'd-inline']) ?>
                <?= Html::textInput('motivo_rechazo', '', ['class' => 'form-control d-inline-block mx-2', 'style' => 'width: 280px;', 'placeholder' => 'Motivo de rechazo']) ?>
                <?= Html::submitButton('Rechazar', ['class' => 'btn btn-warning']) ?>
            <?= Html::endForm() ?>
        <?php endif; ?>
        <?php if (!$isAssigned): ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <?php if ($isAssigned): ?>
        <div class="alert alert-warning">Esta malla tiene asignaciones aprobadas activas y no se puede editar ni eliminar.</div>
    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'empresa_id',
            'nombre',
            'descripcion',
            'tipo',
            'activo',
            'config_json',
            [
                'attribute' => 'estado_aprobacion',
                'value' => $model->displayEstadoAprobacion(),
            ],
            'motivo_rechazo',
            'solicitado_por',
            'solicitado_at',
            'aprobado_por',
            'aprobado_at',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
