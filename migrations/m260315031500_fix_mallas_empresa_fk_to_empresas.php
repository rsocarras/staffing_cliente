<?php

use yii\db\Migration;

class m260315031500_fix_mallas_empresa_fk_to_empresas extends Migration
{
    public function safeUp()
    {
        $mallasTable = $this->db->schema->getTableSchema('mallas', true);
        $empresasTable = $this->db->schema->getTableSchema('empresas', true);

        if ($mallasTable === null) {
            return true;
        }

        if ($empresasTable === null) {
            throw new \RuntimeException('La tabla `empresas` no existe. No se puede crear la FK correcta para `mallas.empresa_id`.');
        }

        // Elimina cualquier FK existente sobre mallas.empresa_id (sin asumir nombre).
        $rows = $this->db->createCommand(
            "SELECT CONSTRAINT_NAME
             FROM information_schema.KEY_COLUMN_USAGE
             WHERE TABLE_SCHEMA = DATABASE()
               AND TABLE_NAME = 'mallas'
               AND COLUMN_NAME = 'empresa_id'
               AND REFERENCED_TABLE_NAME IS NOT NULL"
        )->queryAll();

        foreach ($rows as $row) {
            $fkName = $row['CONSTRAINT_NAME'] ?? null;
            if (!$fkName) {
                continue;
            }
            $this->dropForeignKey($fkName, 'mallas');
        }

        // Asegura índice para empresa_id antes de crear FK.
        $indexRows = $this->db->createCommand(
            "SELECT INDEX_NAME
             FROM information_schema.STATISTICS
             WHERE TABLE_SCHEMA = DATABASE()
               AND TABLE_NAME = 'mallas'
               AND COLUMN_NAME = 'empresa_id'"
        )->queryAll();

        if (empty($indexRows)) {
            $this->createIndex('idx_mallas_empresa_id', 'mallas', 'empresa_id');
        }

        // Crea FK apuntando a `empresas`.
        $this->addForeignKey(
            'fk_mallas_empresa_id_to_empresas',
            'mallas',
            'empresa_id',
            'empresas',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $mallasTable = $this->db->schema->getTableSchema('mallas', true);
        if ($mallasTable === null) {
            return true;
        }

        // Elimina FK creada en safeUp si existe.
        try {
            $this->dropForeignKey('fk_mallas_empresa_id_to_empresas', 'mallas');
        } catch (\Throwable $e) {
        }

        // Si existe tabla `empresa`, restaura una FK de reversa.
        $empresaLegacyTable = $this->db->schema->getTableSchema('empresa', true);
        if ($empresaLegacyTable !== null) {
            $this->addForeignKey(
                'fk_mallas_empresa_id_to_empresa',
                'mallas',
                'empresa_id',
                'empresa',
                'id',
                'RESTRICT',
                'CASCADE'
            );
        }

        return true;
    }
}
