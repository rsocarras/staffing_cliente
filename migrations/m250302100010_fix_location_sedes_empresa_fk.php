<?php

use yii\db\Migration;

/**
 * Corrige empresa_id en location_sedes para que coincida con empresas.id y crea la FK.
 * empresa_id puede ser bigint unsigned mientras empresas.id es int(11); MySQL exige tipos idénticos.
 */
class m250302100010_fix_location_sedes_empresa_fk extends Migration
{
    public function safeUp()
    {
        $table = 'location_sedes';
        $fkName = 'fk_sede_empresa';

        // Ajustar tipo de empresa_id para que coincida con empresas.id (int(11) signed)
        $this->alterColumn($table, 'empresa_id', $this->integer()->notNull());

        // Eliminar la FK solo si existe
        $fkExists = $this->db->createCommand(
            "SELECT 1 FROM information_schema.TABLE_CONSTRAINTS 
             WHERE CONSTRAINT_SCHEMA = DATABASE() AND TABLE_NAME = :tbl AND CONSTRAINT_NAME = :fk AND CONSTRAINT_TYPE = 'FOREIGN KEY'",
            [':tbl' => $table, ':fk' => $fkName]
        )->queryScalar();
        if ($fkExists) {
            $this->dropForeignKey($fkName, $table);
        }

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
        $this->dropForeignKey('fk_sede_empresa', 'location_sedes');
        $this->alterColumn('location_sedes', 'empresa_id', $this->bigInteger()->unsigned()->notNull());
    }
}
