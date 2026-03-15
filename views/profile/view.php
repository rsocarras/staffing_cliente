<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Profile $model */
/** @var array $weekSchedule */
/** @var string $anchorDate */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'user_id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_id',
            'tipo_doc',
            'num_doc',
            'name',
            'public_email:email',
            'gravatar_email:email',
            'gravatar_id',
            'location',
            'timezone',
            'bio:ntext',
            'sexo',
            'empresas_id',
            'about:ntext',
            'estado',
            'telefono',
            'birthday',
            'position',
            'photo_',
            'instagram',
            'tiktok',
            'linkedin',
            'youtube',
            'website',
            'address',
            'data_json',
            'sede_id',
            'cargo_id',
            'centro_costo_id',
            'centro_utilidad_id',
            'city',
            'area_id',
        ],
    ]) ?>

    <hr>
    <h3>Malla semanal</h3>
    <form method="get" action="<?= Url::to(['profile/view', 'user_id' => $model->user_id]) ?>" class="mb-3 d-flex align-items-center gap-2">
        <label for="week-date" class="mb-0">Semana de:</label>
        <input id="week-date" type="date" name="date" class="form-control w-auto" value="<?= Html::encode($anchorDate) ?>">
        <button type="submit" class="btn btn-primary btn-sm">Ver</button>
    </form>
    <?php if (empty($weekSchedule['malla'])): ?>
        <div class="alert alert-warning">Sin malla asignada.</div>
    <?php else: ?>
        <p>
            <strong>Malla:</strong> <?= Html::encode($weekSchedule['malla']->nombre) ?>
            <small class="text-muted">(origen: <?= Html::encode($weekSchedule['source']) ?>)</small>
        </p>
    <?php endif; ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <?php foreach ($weekSchedule['dates'] as $date): ?>
                        <th><?= Html::encode(date('D d M', strtotime($date))) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($weekSchedule['dates'] as $date): ?>
                        <?php $day = $weekSchedule['days'][$date] ?? ['segments' => [], 'total_minutes' => 0]; ?>
                        <td>
                            <?php if (empty($day['segments'])): ?>
                                <span class="text-muted">Sin turno</span>
                            <?php else: ?>
                                <?php foreach ($day['segments'] as $segment): ?>
                                    <div>
                                        <?= Html::encode(sprintf('%02d:%02d', intdiv($segment['start'], 60), $segment['start'] % 60)) ?>
                                        -
                                        <?= Html::encode(sprintf('%02d:%02d', intdiv($segment['end'], 60), $segment['end'] % 60)) ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
    </div>

</div>
