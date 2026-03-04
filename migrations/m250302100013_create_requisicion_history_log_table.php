<?php

use yii\db\Migration;

/**
 * Tabla requisicion_history_log para registrar cambios de estado y comentarios.
 */
class m250302100013_create_requisicion_history_log_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('requisicion_history_log', [
            'id' => $this->primaryKey(),
            'requisicion_id' => $this->integer()->notNull(),
            'estado_anterior' => $this->string(50)->null(),
            'estado_nuevo' => $this->string(50)->notNull(),
            'comentario' => $this->text()->null(),
            'usuario_id' => $this->integer()->null(),
            'created_at' => $this->datetime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

        $this->createIndex('idx_rhl_requisicion', 'requisicion_history_log', 'requisicion_id');
        $this->createIndex('idx_rhl_created', 'requisicion_history_log', 'created_at');

        $this->addForeignKey('fk_rhl_requisicion', 'requisicion_history_log', 'requisicion_id', 'requisicion', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_rhl_usuario', 'requisicion_history_log', 'usuario_id', 'user', 'id', 'SET NULL', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('requisicion_history_log');
    }
}
