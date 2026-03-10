<?php

use yii\db\Migration;

class m260310090000_add_tipo_sede_to_location_sedes extends Migration
{
    public function safeUp()
    {
        if ($this->db->schema->getTableSchema('location_sedes', true) === null) {
            return;
        }

        if ($this->db->schema->getTableSchema('location_sedes', true)->getColumn('tipo_sede') === null) {
            $this->addColumn(
                'location_sedes',
                'tipo_sede',
                "ENUM('operativa','administrativa') NOT NULL DEFAULT 'operativa' AFTER `activo`"
            );
        }

        if ($this->db->schema->getTableSchema('location_sedes', true)->getColumn('tipo_sede') !== null
            && !$this->indexExists('idx_location_sedes_tipo_sede', 'location_sedes')
        ) {
            $this->createIndex('idx_location_sedes_tipo_sede', 'location_sedes', ['empresa_id', 'tipo_sede']);
        }
    }

    public function safeDown()
    {
        if ($this->db->schema->getTableSchema('location_sedes', true) === null) {
            return;
        }

        if ($this->indexExists('idx_location_sedes_tipo_sede', 'location_sedes')) {
            $this->dropIndex('idx_location_sedes_tipo_sede', 'location_sedes');
        }

        if ($this->db->schema->getTableSchema('location_sedes', true)->getColumn('tipo_sede') !== null) {
            $this->dropColumn('location_sedes', 'tipo_sede');
        }
    }

    private function indexExists($name, $table)
    {
        $database = $this->db->createCommand('SELECT DATABASE()')->queryScalar();

        return (bool) $this->db->createCommand(
            'SELECT 1
             FROM information_schema.STATISTICS
             WHERE TABLE_SCHEMA = :schema
               AND TABLE_NAME = :table
               AND INDEX_NAME = :index
             LIMIT 1',
            [
                ':schema' => $database,
                ':table' => $table,
                ':index' => $name,
            ]
        )->queryScalar();
    }
}
