<?php

use yii\db\Migration;

/**
 * Corrige empresa_id en cargos para que coincida con empresas.id y crea la FK.
 * La FK actual puede apuntar a `empresa` (singular) en lugar de `empresas`.
 * empresa_id puede ser bigint unsigned mientras empresas.id es int(11); MySQL exige tipos idénticos.
 */
class m250302100012_fix_cargos_empresa_fk extends Migration
{
    public function safeUp()
    {
        $table = 'cargos';
        $fkName = 'fk_cargo_empresa';

        // Eliminar la FK primero (requerido para alterar la columna)
        $fkExists = $this->db->createCommand(
            "SELECT 1 FROM information_schema.TABLE_CONSTRAINTS 
             WHERE CONSTRAINT_SCHEMA = DATABASE() AND TABLE_NAME = :tbl AND CONSTRAINT_NAME = :fk AND CONSTRAINT_TYPE = 'FOREIGN KEY'",
            [':tbl' => $table, ':fk' => $fkName]
        )->queryScalar();
        if ($fkExists) {
            $this->dropForeignKey($fkName, $table);
        }

        // Ajustar tipo de empresa_id para que coincida con empresas.id (int(11) signed)
        $this->alterColumn($table, 'empresa_id', $this->integer()->notNull());

        // Crear la FK apuntando a empresas
        $this->addForeignKey(
            $fkName,
            $table,
            'empresa_id',
            'empresas',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_cargo_empresa', 'cargos');
        $this->alterColumn('cargos', 'empresa_id', $this->bigInteger()->unsigned()->notNull());
    }
}
