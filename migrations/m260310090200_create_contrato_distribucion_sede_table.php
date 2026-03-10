<?php

use yii\db\Migration;

class m260310090200_create_contrato_distribucion_sede_table extends Migration
{
    public function safeUp()
    {
        if ($this->db->schema->getTableSchema('contrato_distribucion_sede', true) !== null) {
            return;
        }

        $this->createTable('contrato_distribucion_sede', [
            'id' => $this->bigPrimaryKey()->unsigned(),
            'contrato_id' => $this->bigInteger()->unsigned()->notNull(),
            'sede_id' => $this->bigInteger()->unsigned()->notNull(),
            'porcentaje' => $this->decimal(5, 2)->notNull(),
            'created_at' => "DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP",
            'updated_at' => "DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
            'created_by' => $this->integer()->null(),
            'updated_by' => $this->integer()->null(),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

        $this->createIndex('idx_contrato_distribucion_contrato', 'contrato_distribucion_sede', 'contrato_id');
        $this->createIndex('idx_contrato_distribucion_sede', 'contrato_distribucion_sede', 'sede_id');
        $this->createIndex('uq_contrato_distribucion_sede', 'contrato_distribucion_sede', ['contrato_id', 'sede_id'], true);

        $this->addForeignKey(
            'fk_contrato_distribucion_contrato',
            'contrato_distribucion_sede',
            'contrato_id',
            'contrato',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_contrato_distribucion_sede',
            'contrato_distribucion_sede',
            'sede_id',
            'location_sedes',
            'id',
            'RESTRICT',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_contrato_distribucion_created_by',
            'contrato_distribucion_sede',
            'created_by',
            'user',
            'id',
            'SET NULL',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_contrato_distribucion_updated_by',
            'contrato_distribucion_sede',
            'updated_by',
            'user',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        if ($this->db->schema->getTableSchema('contrato_distribucion_sede', true) === null) {
            return;
        }

        foreach ([
            'fk_contrato_distribucion_updated_by',
            'fk_contrato_distribucion_created_by',
            'fk_contrato_distribucion_sede',
            'fk_contrato_distribucion_contrato',
        ] as $foreignKey) {
            $this->dropForeignKey($foreignKey, 'contrato_distribucion_sede');
        }

        $this->dropTable('contrato_distribucion_sede');
    }
}
