<?php

use yii\db\Migration;

/**
 * Tablas checklist_items (maestro) y checklist_status (por requisición)
 */
class m250302100005_create_checklist_tables extends Migration
{
    public function safeUp()
    {
        if ($this->db->getSchema()->getTableSchema('checklist_item') !== null) {
            return; // ya aplicada parcialmente
        }
        $this->createTable('checklist_item', [
            'id' => $this->primaryKey(),
            'codigo' => $this->string(50)->notNull(),
            'nombre' => $this->string(190)->notNull(),
            'descripcion' => $this->text()->null(),
            'es_obligatorio' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            'orden' => $this->smallInteger()->notNull()->defaultValue(0),
            'is_active' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            'created_at' => $this->datetime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->datetime()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

        $this->createIndex('idx_ci_codigo', 'checklist_item', 'codigo', true);
        $this->createIndex('idx_ci_active', 'checklist_item', 'is_active');

        $this->createTable('checklist_status', [
            'id' => $this->primaryKey(),
            'requisicion_id' => $this->integer()->notNull(),
            'checklist_item_id' => $this->integer()->notNull(),
            'completado' => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'completado_por' => $this->integer()->null(),
            'completado_at' => $this->datetime()->null(),
            'observacion' => $this->text()->null(),
            'archivo_id' => $this->bigInteger()->unsigned()->null(),
            'created_at' => $this->datetime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->datetime()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

        $this->createIndex('idx_cs_requisicion', 'checklist_status', 'requisicion_id');
        $this->createIndex('idx_cs_item', 'checklist_status', 'checklist_item_id');
        $this->createIndex('uq_cs_req_item', 'checklist_status', ['requisicion_id', 'checklist_item_id'], true);

        $this->addForeignKey('fk_cs_requisicion', 'checklist_status', 'requisicion_id', 'requisicion', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_cs_item', 'checklist_status', 'checklist_item_id', 'checklist_item', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_cs_completado_por', 'checklist_status', 'completado_por', 'user', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_cs_archivo', 'checklist_status', 'archivo_id', 'archivos', 'id', 'SET NULL', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('checklist_status');
        $this->dropTable('checklist_item');
    }
}
