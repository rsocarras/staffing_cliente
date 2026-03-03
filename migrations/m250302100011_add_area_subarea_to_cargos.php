<?php

use yii\db\Migration;

/**
 * Agrega area_id y sub_area_id a cargos para vincular con la tabla area.
 * Sub-áreas son áreas hijas (area_padre = area_id).
 */
class m250302100011_add_area_subarea_to_cargos extends Migration
{
    public function safeUp()
    {
        $this->addColumn('cargos', 'area_id', $this->integer()->null()->after('empresa_id'));
        $this->addColumn('cargos', 'sub_area_id', $this->integer()->null()->after('area_id'));

        $this->createIndex('idx_cargo_area', 'cargos', 'area_id');
        $this->createIndex('idx_cargo_subarea', 'cargos', 'sub_area_id');

        $this->addForeignKey(
            'fk_cargo_area',
            'cargos',
            'area_id',
            'area',
            'id',
            'SET NULL',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_cargo_subarea',
            'cargos',
            'sub_area_id',
            'area',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_cargo_subarea', 'cargos');
        $this->dropForeignKey('fk_cargo_area', 'cargos');
        $this->dropColumn('cargos', 'sub_area_id');
        $this->dropColumn('cargos', 'area_id');
    }
}
