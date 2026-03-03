<?php

namespace tests\unit\models;

use app\models\Area;
use app\models\Empresas;

class AreaTest extends \Codeception\Test\Unit
{
    public function testNombreRequired()
    {
        $model = new Area();
        $model->nombre = '';
        $model->validate(['nombre']);
        verify($model->hasErrors('nombre'))->true();

        $model->nombre = 'Ventas';
        $model->validate(['nombre']);
        verify($model->hasErrors('nombre'))->false();
    }

    public function testNombreMaxLength()
    {
        $model = new Area();
        $model->nombre = str_repeat('x', 46);
        $model->validate(['nombre']);
        verify($model->hasErrors('nombre'))->true();

        $model->nombre = str_repeat('x', 45);
        $model->validate(['nombre']);
        verify($model->hasErrors('nombre'))->false();
    }

    public function testDescripcionMaxLength()
    {
        $model = new Area();
        $model->descripcion = str_repeat('x', 46);
        $model->validate(['descripcion']);
        verify($model->hasErrors('descripcion'))->true();
    }

    public function testAttributeLabels()
    {
        $model = new Area();
        $labels = $model->attributeLabels();
        verify($labels)->arrayHasKey('nombre');
        verify($labels)->arrayHasKey('descripcion');
        verify($labels)->arrayHasKey('area_padre');
        verify($labels['nombre'])->equals('Nombre');
        verify($labels['descripcion'])->equals('Descripcion');
    }

    public function testTableName()
    {
        verify(Area::tableName())->equals('area');
    }

    public function testGetAreaPadreRelation()
    {
        $model = new Area();
        $relation = $model->getAreaPadre();
        verify($relation)->isInstanceOf(\yii\db\ActiveQuery::class);
    }

    public function testGetEmpresasRelation()
    {
        $model = new Area();
        $relation = $model->getEmpresas();
        verify($relation)->isInstanceOf(\yii\db\ActiveQuery::class);
    }

    public function testGetUserCreateRelation()
    {
        $model = new Area();
        $relation = $model->getUserCreate();
        verify($relation)->isInstanceOf(\yii\db\ActiveQuery::class);
    }

    public function testDefaultValues()
    {
        $model = new Area();
        $model->loadDefaultValues();
        verify($model->uuid)->null();
        verify($model->descripcion)->null();
        verify($model->area_padre)->null();
    }
}
