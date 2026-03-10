<?php

use yii\db\Migration;

class m260310090100_create_contrato_table extends Migration
{
    public function safeUp()
    {
        if ($this->db->schema->getTableSchema('contrato', true) !== null) {
            return;
        }

        $this->createTable('contrato', [
            'id' => $this->bigPrimaryKey()->unsigned(),
            'empresa_id' => $this->integer()->notNull(),
            'profile_id' => $this->integer()->notNull(),
            'contrato_tipo_id' => $this->bigInteger()->unsigned()->notNull(),
            'area_id' => $this->integer()->notNull(),
            'sub_area_id' => $this->integer()->null(),
            'cargo_id' => $this->bigInteger()->unsigned()->notNull(),
            'sede_id' => $this->bigInteger()->unsigned()->null(),
            'estado' => "ENUM('activo','inactivo','suspendido','licencia','incapacidad','liquidado','cancelado') NOT NULL DEFAULT 'activo'",
            'fecha_inicio' => $this->date()->notNull(),
            'fecha_fin' => $this->date()->null(),
            'created_at' => "DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP",
            'updated_at' => "DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
            'created_by' => $this->integer()->null(),
            'updated_by' => $this->integer()->null(),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

        $this->createIndex('idx_contrato_empresa', 'contrato', 'empresa_id');
        $this->createIndex('idx_contrato_profile', 'contrato', 'profile_id');
        $this->createIndex('idx_contrato_tipo', 'contrato', 'contrato_tipo_id');
        $this->createIndex('idx_contrato_estado', 'contrato', 'estado');
        $this->createIndex('idx_contrato_fechas', 'contrato', ['fecha_inicio', 'fecha_fin']);
        $this->createIndex('idx_contrato_sede', 'contrato', 'sede_id');
        $this->createIndex('idx_contrato_area', 'contrato', 'area_id');
        $this->createIndex('idx_contrato_sub_area', 'contrato', 'sub_area_id');
        $this->createIndex('idx_contrato_cargo', 'contrato', 'cargo_id');
        $this->createIndex('idx_contrato_empresa_estado_fecha', 'contrato', ['empresa_id', 'estado', 'fecha_inicio', 'fecha_fin']);

        $this->addForeignKey('fk_contrato_empresa', 'contrato', 'empresa_id', 'empresas', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_contrato_profile', 'contrato', 'profile_id', 'profile', 'user_id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_contrato_tipo', 'contrato', 'contrato_tipo_id', 'contrato_tipos', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_contrato_area', 'contrato', 'area_id', 'area', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_contrato_sub_area', 'contrato', 'sub_area_id', 'area', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_contrato_cargo', 'contrato', 'cargo_id', 'cargos', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_contrato_sede', 'contrato', 'sede_id', 'location_sedes', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_contrato_created_by', 'contrato', 'created_by', 'user', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_contrato_updated_by', 'contrato', 'updated_by', 'user', 'id', 'SET NULL', 'CASCADE');
    }

    public function safeDown()
    {
        if ($this->db->schema->getTableSchema('contrato', true) === null) {
            return;
        }

        foreach ([
            'fk_contrato_updated_by',
            'fk_contrato_created_by',
            'fk_contrato_sede',
            'fk_contrato_cargo',
            'fk_contrato_sub_area',
            'fk_contrato_area',
            'fk_contrato_tipo',
            'fk_contrato_profile',
            'fk_contrato_empresa',
        ] as $foreignKey) {
            $this->dropForeignKey($foreignKey, 'contrato');
        }

        $this->dropTable('contrato');
    }
}
