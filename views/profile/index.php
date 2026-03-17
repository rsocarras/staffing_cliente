<?php

use app\models\Profile;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\search\ProfileSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Empleados / colaboradores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-wrapper">
    <div class="content pb-0">
        <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-3">
            <div class="flex-grow-1">
                <h4 class="mb-0"><?= Html::encode($this->title) ?></h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="<?= Url::to(['/']) ?>">Home</a></li>
                    <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Filtros</h5>
            </div>
            <div class="card-body">
                <?= $this->render('_search', ['model' => $searchModel]) ?>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <div class="table-responsive">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'summary' => 'Mostrando {begin} - {end} de {totalCount} empleados',
                        'emptyText' => 'No se encontraron empleados.',
                        'tableOptions' => ['class' => 'table table-nowrap align-middle mb-0'],
                        'layout' => "{summary}\n{items}\n<div class=\"mt-3\">{pager}</div>",
                        'columns' => [
                            [
                                'attribute' => 'user_id',
                                'headerOptions' => ['style' => 'width: 90px'],
                            ],
                            'tipo_doc',
                            'num_doc',
                            [
                                'attribute' => 'name',
                                'label' => 'Nombre',
                                'format' => 'raw',
                                'value' => static function (Profile $model) {
                                    return Html::a(
                                        Html::encode($model->name ?: '(Sin nombre)'),
                                        ['view', 'user_id' => $model->user_id],
                                        ['class' => 'fw-semibold text-dark']
                                    );
                                },
                            ],
                            [
                                'attribute' => 'public_email',
                                'label' => 'Correo',
                                'format' => 'email',
                                'value' => static function (Profile $model) {
                                    return $model->public_email ?: null;
                                },
                            ],
                            [
                                'attribute' => 'telefono',
                                'label' => 'Teléfono',
                                'value' => static function (Profile $model) {
                                    return $model->telefono ?: '-';
                                },
                            ],
                            [
                                'label' => 'Empresa',
                                'value' => static function (Profile $model) {
                                    return $model->empresas->name ?? '-';
                                },
                            ],
                            [
                                'label' => 'Sede',
                                'value' => static function (Profile $model) {
                                    return $model->sede->nombre ?? '-';
                                },
                            ],
                            [
                                'label' => 'Área',
                                'value' => static function (Profile $model) {
                                    return $model->area->nombre ?? '-';
                                },
                            ],
                            [
                                'label' => 'Cargo',
                                'value' => static function (Profile $model) {
                                    return $model->cargo->nombre ?? '-';
                                },
                            ],
                            [
                                'attribute' => 'estado',
                                'label' => 'Estado',
                                'format' => 'raw',
                                'value' => static function (Profile $model) {
                                    $badgeClass = $model->estado === Profile::ESTADO_ACTIVO ? 'bg-success' : 'bg-secondary';

                                    return Html::tag('span', Html::encode($model->displayEstado()), ['class' => 'badge ' . $badgeClass]);
                                },
                            ],
                            [
                                'class' => ActionColumn::class,
                                'header' => 'Acciones',
                                'template' => '{view}',
                                'contentOptions' => ['class' => 'text-end'],
                                'headerOptions' => ['class' => 'text-end', 'style' => 'width: 90px'],
                                'buttons' => [
                                    'view' => static function ($url, Profile $model) {
                                        return Html::a('<i class="ti ti-eye"></i>', ['view', 'user_id' => $model->user_id], [
                                            'class' => 'btn btn-icon btn-sm btn-soft-info rounded-pill',
                                            'title' => 'Ver',
                                        ]);
                                    },
                                ],
                            ],
                        ],
                        'pager' => [
                            'options' => ['class' => 'pagination mb-0'],
                            'linkContainerOptions' => ['class' => 'page-item'],
                            'linkOptions' => ['class' => 'page-link'],
                            'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link'],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <?= $this->render('//layouts/partials/footer') ?>
</div>
