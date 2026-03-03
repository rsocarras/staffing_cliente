<?php

use yii\db\Migration;

/**
 * Tabla webhook_log para auditoría de webhooks (MyBodytech, etc.)
 */
class m250302100006_create_webhook_log_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('webhook_log', [
            'id' => $this->primaryKey(),
            'requisicion_id' => $this->integer()->null(),
            'profile_id' => $this->integer()->null(),
            'evento' => $this->string(80)->notNull(),
            'url' => $this->string(500)->notNull(),
            'method' => $this->string(10)->notNull()->defaultValue('POST'),
            'request_body' => $this->text()->null(),
            'response_code' => $this->integer()->null(),
            'response_body' => $this->text()->null(),
            'error_message' => $this->string(500)->null(),
            'intentos' => $this->integer()->notNull()->defaultValue(1),
            'created_at' => $this->datetime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

        $this->createIndex('idx_wl_requisicion', 'webhook_log', 'requisicion_id');
        $this->createIndex('idx_wl_profile', 'webhook_log', 'profile_id');
        $this->createIndex('idx_wl_evento', 'webhook_log', 'evento');
        $this->createIndex('idx_wl_created', 'webhook_log', 'created_at');

        $this->addForeignKey('fk_wl_requisicion', 'webhook_log', 'requisicion_id', 'requisicion', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_wl_profile', 'webhook_log', 'profile_id', 'profile', 'user_id', 'SET NULL', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('webhook_log');
    }
}
