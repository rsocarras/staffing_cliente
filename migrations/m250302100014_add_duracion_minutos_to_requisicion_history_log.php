<?php

use yii\db\Migration;

/**
 * Añade duracion_minutos: tiempo en estado_anterior antes del cambio (minutos).
 */
class m250302100014_add_duracion_minutos_to_requisicion_history_log extends Migration
{
    public function safeUp()
    {
        $this->addColumn('requisicion_history_log', 'duracion_minutos', $this->integer()->null()->comment('Minutos en estado_anterior antes del cambio'));
    }

    public function safeDown()
    {
        $this->dropColumn('requisicion_history_log', 'duracion_minutos');
    }
}
