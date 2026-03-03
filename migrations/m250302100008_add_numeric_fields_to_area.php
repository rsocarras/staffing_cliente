<?php

use yii\db\Migration;

/**
 * Agrega campos numéricos a area: centro_utilidad, referencia_externa, centro_utilidad_staffing
 */
class m250302100008_add_numeric_fields_to_area extends Migration
{
    public function safeUp()
    {
        $this->addColumn('area', 'centro_utilidad', $this->integer()->null()->after('empresas_id'));
        $this->addColumn('area', 'referencia_externa', $this->integer()->null()->after('centro_utilidad'));
        $this->addColumn('area', 'centro_utilidad_staffing', $this->integer()->null()->after('referencia_externa'));
    }

    public function safeDown()
    {
        $this->dropColumn('area', 'centro_utilidad_staffing');
        $this->dropColumn('area', 'referencia_externa');
        $this->dropColumn('area', 'centro_utilidad');
    }
}
