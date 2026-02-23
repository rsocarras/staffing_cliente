<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\LocationCountry $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Location Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$formatScalarOrList = static function (mixed $value): string {
    if ($value === null) {
        return '';
    }

    if (is_array($value)) {
        $items = array_values(array_filter($value, static fn($v) => $v !== null && $v !== ''));
        $items = array_map(static fn($v) => is_scalar($v) ? (string)$v : json_encode($v, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), $items);
        return implode(', ', $items);
    }

    if (is_object($value)) {
        return (string)json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    if (is_string($value)) {
        $trim = trim($value);
        if ($trim !== '' && ($trim[0] === '[' || $trim[0] === '{')) {
            $decoded = json_decode($trim, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $formatScalarOrList($decoded);
            }
        }
    }

    return (string)$value;
};
?>
    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">
<div class="location-country-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'name',
            'official_name',
            'common_name',
            'iso_alpha2',
            'iso_alpha3',
            'iso_numeric',
            'calling_code_primary',
            [
                'attribute' => 'calling_codes',
                'format' => 'text',
                'value' => static fn($m) => $formatScalarOrList($m->calling_codes),
            ],
            'flag_emoji',
            'flag_svg_url:url',
            'flag_png_url:url',
            'capital',
            'region',
            'subregion',
            [
                'attribute' => 'currencies',
                'format' => 'text',
                'value' => static fn($m) => $formatScalarOrList($m->currencies),
            ],
            [
                'attribute' => 'languages',
                'format' => 'text',
                'value' => static fn($m) => $formatScalarOrList($m->languages),
            ],
            [
                'attribute' => 'tld',
                'format' => 'text',
                'value' => static fn($m) => $formatScalarOrList($m->tld),
            ],
            [
                'attribute' => 'timezones',
                'format' => 'text',
                'value' => static fn($m) => $formatScalarOrList($m->timezones),
            ],
            'is_active',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
</div></div>
