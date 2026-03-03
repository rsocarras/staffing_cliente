<?php

use yii\db\Migration;

/**
 * Tabla esquema_variable (maestro para requisiciones)
 */
class m250302100002_create_esquema_variable_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('esquema_variable', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(100)->notNull(),
            'descripcion' => $this->text()->null(),
            'is_active' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            'created_at' => $this->datetime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->datetime()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

        $this->createIndex('idx_ev_active', 'esquema_variable', 'is_active');
    }

    public function safeDown()
    {
        $this->dropTable('esquema_variable');
    }
}
