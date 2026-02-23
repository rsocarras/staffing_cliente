<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SearchLocationCountry $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="location-country-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'official_name') ?>

    <?= $form->field($model, 'common_name') ?>

    <?= $form->field($model, 'iso_alpha2') ?>

    <?php // echo $form->field($model, 'iso_alpha3') ?>

    <?php // echo $form->field($model, 'iso_numeric') ?>

    <?php // echo $form->field($model, 'calling_code_primary') ?>

    <?php // echo $form->field($model, 'calling_codes') ?>

    <?php // echo $form->field($model, 'flag_emoji') ?>

    <?php // echo $form->field($model, 'flag_svg_url') ?>

    <?php // echo $form->field($model, 'flag_png_url') ?>

    <?php // echo $form->field($model, 'capital') ?>

    <?php // echo $form->field($model, 'region') ?>

    <?php // echo $form->field($model, 'subregion') ?>

    <?php // echo $form->field($model, 'currencies') ?>

    <?php // echo $form->field($model, 'languages') ?>

    <?php // echo $form->field($model, 'tld') ?>

    <?php // echo $form->field($model, 'timezones') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
