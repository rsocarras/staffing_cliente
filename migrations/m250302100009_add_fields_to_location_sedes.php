<?php

use yii\db\Migration;

/**
 * Agrega campos a location_sedes: centro_costo, centro_costo_staffing, codigo_externo
 */
class m250302100009_add_fields_to_location_sedes extends Migration
{
    public function safeUp()
    {
        $this->addColumn('location_sedes', 'centro_costo', $this->integer()->null()->after('activo'));
        $this->addColumn('location_sedes', 'centro_costo_staffing', $this->integer()->null()->after('centro_costo'));
        $this->addColumn('location_sedes', 'codigo_externo', $this->string(50)->null()->after('centro_costo_staffing'));
    }

    public function safeDown()
    {
        $this->dropColumn('location_sedes', 'codigo_externo');
        $this->dropColumn('location_sedes', 'centro_costo_staffing');
        $this->dropColumn('location_sedes', 'centro_costo');
    }
}
