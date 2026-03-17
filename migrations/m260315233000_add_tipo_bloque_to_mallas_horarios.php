<?php

use yii\db\Migration;

class m260315233000_add_tipo_bloque_to_mallas_horarios extends Migration
{
    public function safeUp()
    {
        $table = $this->db->schema->getTableSchema('mallas_horarios', true);
        if ($table === null) {
            return true;
        }

        if (!isset($table->columns['tipo_bloque'])) {
            $this->addColumn('mallas_horarios', 'tipo_bloque', $this->string(20)->notNull()->defaultValue('WORK')->after('dia_semana'));
        }

        if (!isset($table->columns['orden'])) {
            $this->addColumn('mallas_horarios', 'orden', $this->integer()->notNull()->defaultValue(0)->after('tipo_bloque'));
        }

        $this->createIndex('idx_mallas_horarios_malla_dia_tipo', 'mallas_horarios', ['malla_id', 'dia_semana', 'tipo_bloque']);
    }

    public function safeDown()
    {
        $table = $this->db->schema->getTableSchema('mallas_horarios', true);
        if ($table === null) {
            return true;
        }

        try {
            $this->dropIndex('idx_mallas_horarios_malla_dia_tipo', 'mallas_horarios');
        } catch (\Throwable $e) {
        }

        if (isset($table->columns['orden'])) {
            $this->dropColumn('mallas_horarios', 'orden');
        }
        if (isset($table->columns['tipo_bloque'])) {
            $this->dropColumn('mallas_horarios', 'tipo_bloque');
        }

        return true;
    }
}
