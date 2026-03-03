<?php

use yii\db\Migration;

/**
 * Tabla motivo_vinculacion (maestro para requisiciones)
 */
class m250302100000_create_motivo_vinculacion_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('motivo_vinculacion', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(100)->notNull(),
            'descripcion' => $this->text()->null(),
            'is_active' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            'created_at' => $this->datetime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->datetime()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

        $this->createIndex('idx_mv_active', 'motivo_vinculacion', 'is_active');
    }

    public function safeDown()
    {
        $this->dropTable('motivo_vinculacion');
    }
}
