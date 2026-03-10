<?php

use yii\db\Migration;

class m260310090300_create_staffing_planta_tables extends Migration
{
    public function safeUp()
    {
        if ($this->db->schema->getTableSchema('staffing_planta', true) === null) {
            $this->createTable('staffing_planta', [
                'id' => $this->bigPrimaryKey()->unsigned(),
                'empresa_id' => $this->integer()->notNull(),
                'location_sede_id' => $this->bigInteger()->unsigned()->notNull(),
                'area_id' => $this->integer()->notNull(),
                'sub_area_id' => $this->integer()->notNull(),
                'cargo_id' => $this->bigInteger()->unsigned()->notNull(),
                'cantidad_autorizada' => $this->decimal(10, 2)->notNull()->defaultValue(0),
                'activo' => $this->tinyInteger(1)->notNull()->defaultValue(1),
                'created_at' => "DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP",
                'updated_at' => "DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
                'created_by' => $this->integer()->null(),
                'updated_by' => $this->integer()->null(),
            ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

            $this->createIndex(
                'uq_staffing_planta_dimension',
                'staffing_planta',
                ['empresa_id', 'location_sede_id', 'area_id', 'sub_area_id', 'cargo_id'],
                true
            );
            $this->createIndex('idx_staffing_planta_empresa', 'staffing_planta', 'empresa_id');
            $this->createIndex('idx_staffing_planta_sede', 'staffing_planta', 'location_sede_id');
            $this->createIndex('idx_staffing_planta_area', 'staffing_planta', 'area_id');
            $this->createIndex('idx_staffing_planta_sub_area', 'staffing_planta', 'sub_area_id');
            $this->createIndex('idx_staffing_planta_cargo', 'staffing_planta', 'cargo_id');
            $this->createIndex('idx_staffing_planta_activo', 'staffing_planta', ['empresa_id', 'activo']);

            $this->addForeignKey('fk_staffing_planta_empresa', 'staffing_planta', 'empresa_id', 'empresas', 'id', 'RESTRICT', 'CASCADE');
            $this->addForeignKey('fk_staffing_planta_sede', 'staffing_planta', 'location_sede_id', 'location_sedes', 'id', 'RESTRICT', 'CASCADE');
            $this->addForeignKey('fk_staffing_planta_area', 'staffing_planta', 'area_id', 'area', 'id', 'RESTRICT', 'CASCADE');
            $this->addForeignKey('fk_staffing_planta_sub_area', 'staffing_planta', 'sub_area_id', 'area', 'id', 'RESTRICT', 'CASCADE');
            $this->addForeignKey('fk_staffing_planta_cargo', 'staffing_planta', 'cargo_id', 'cargos', 'id', 'RESTRICT', 'CASCADE');
            $this->addForeignKey('fk_staffing_planta_created_by', 'staffing_planta', 'created_by', 'user', 'id', 'SET NULL', 'CASCADE');
            $this->addForeignKey('fk_staffing_planta_updated_by', 'staffing_planta', 'updated_by', 'user', 'id', 'SET NULL', 'CASCADE');
        }

        if ($this->db->schema->getTableSchema('staffing_planta_historial', true) === null) {
            $this->createTable('staffing_planta_historial', [
                'id' => $this->bigPrimaryKey()->unsigned(),
                'planta_id' => $this->bigInteger()->unsigned()->notNull(),
                'campo' => $this->string(100)->notNull(),
                'valor_anterior' => $this->text()->null(),
                'valor_nuevo' => $this->text()->null(),
                'accion' => $this->string(30)->notNull(),
                'user_id' => $this->integer()->null(),
                'created_at' => "DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP",
            ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

            $this->createIndex('idx_staffing_planta_historial_planta', 'staffing_planta_historial', 'planta_id');
            $this->createIndex('idx_staffing_planta_historial_accion', 'staffing_planta_historial', 'accion');
            $this->createIndex('idx_staffing_planta_historial_created', 'staffing_planta_historial', 'created_at');

            $this->addForeignKey(
                'fk_staffing_planta_historial_planta',
                'staffing_planta_historial',
                'planta_id',
                'staffing_planta',
                'id',
                'CASCADE',
                'CASCADE'
            );
            $this->addForeignKey(
                'fk_staffing_planta_historial_user',
                'staffing_planta_historial',
                'user_id',
                'user',
                'id',
                'SET NULL',
                'CASCADE'
            );
        }
    }

    public function safeDown()
    {
        if ($this->db->schema->getTableSchema('staffing_planta_historial', true) !== null) {
            foreach ([
                'fk_staffing_planta_historial_user',
                'fk_staffing_planta_historial_planta',
            ] as $foreignKey) {
                $this->dropForeignKey($foreignKey, 'staffing_planta_historial');
            }

            $this->dropTable('staffing_planta_historial');
        }

        if ($this->db->schema->getTableSchema('staffing_planta', true) !== null) {
            foreach ([
                'fk_staffing_planta_updated_by',
                'fk_staffing_planta_created_by',
                'fk_staffing_planta_cargo',
                'fk_staffing_planta_sub_area',
                'fk_staffing_planta_area',
                'fk_staffing_planta_sede',
                'fk_staffing_planta_empresa',
            ] as $foreignKey) {
                $this->dropForeignKey($foreignKey, 'staffing_planta');
            }

            $this->dropTable('staffing_planta');
        }
    }
}
