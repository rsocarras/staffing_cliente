<?php

use yii\db\Migration;

/**
 * Tabla empresa_cliente (cliente/solicitante con NIT para requisiciones)
 */
class m250302100001_create_empresa_cliente_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('empresa_cliente', [
            'id' => $this->primaryKey(),
            'nit' => $this->string(20)->notNull(),
            'nombre' => $this->string(190)->notNull(),
            'is_active' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            'created_at' => $this->datetime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->datetime()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

        $this->createIndex('idx_ec_nit', 'empresa_cliente', 'nit', true);
        $this->createIndex('idx_ec_active', 'empresa_cliente', 'is_active');
    }

    public function safeDown()
    {
        $this->dropTable('empresa_cliente');
    }
}
