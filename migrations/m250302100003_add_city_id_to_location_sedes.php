<?php

use yii\db\Migration;

/**
 * Agrega city_id a location_sedes para validar sede pertenece a ciudad
 */
class m250302100003_add_city_id_to_location_sedes extends Migration
{
    public function safeUp()
    {
        $this->addColumn('location_sedes', 'city_id', $this->integer()->unsigned()->null()->after('empresa_id'));
        $this->createIndex('idx_sede_city', 'location_sedes', 'city_id');
        $this->addForeignKey(
            'fk_sede_city',
            'location_sedes',
            'city_id',
            'city',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_sede_city', 'location_sedes');
        $this->dropColumn('location_sedes', 'city_id');
    }
}
