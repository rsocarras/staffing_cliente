<?php

use yii\db\Migration;

/**
 * Módulo Presupuestos: cabecera, pivote concepto, detalle por día, historial.
 */
class m250322_100000_create_presupuesto_tables extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci';

        $this->createTable('{{%presupuesto}}', [
            'id' => $this->primaryKey(),
            'empresa_id' => $this->integer()->notNull(),
            'empresa_cliente_id' => $this->integer()->null(),
            'location_sede_id' => $this->bigInteger()->unsigned()->notNull(),
            'nombre' => $this->string(190)->notNull(),
            'fecha_inicio_vigencia' => $this->date()->notNull(),
            'fecha_fin_vigencia' => $this->date()->notNull(),
            'estado' => $this->string(32)->notNull(),
            'version' => $this->integer()->notNull()->defaultValue(1),
            'observacion' => $this->text()->null(),
            'aprobado_por' => $this->integer()->null(),
            'aprobado_at' => $this->dateTime()->null(),
            'rechazado_por' => $this->integer()->null(),
            'rechazado_at' => $this->dateTime()->null(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'created_by' => $this->integer()->null(),
            'updated_by' => $this->integer()->null(),
            'activo' => $this->tinyInteger(1)->notNull()->defaultValue(1),
        ], $tableOptions);

        $this->createIndex('idx_presupuesto_empresa_estado_activo', '{{%presupuesto}}', ['empresa_id', 'estado', 'activo']);
        $this->createIndex('idx_presupuesto_empresa_sede', '{{%presupuesto}}', ['empresa_id', 'location_sede_id']);
        $this->createIndex('idx_presupuesto_vigencia', '{{%presupuesto}}', ['fecha_inicio_vigencia', 'fecha_fin_vigencia']);
        $this->createIndex('idx_presupuesto_created_by', '{{%presupuesto}}', ['created_by']);

        $this->addForeignKey(
            'fk_presupuesto_empresa',
            '{{%presupuesto}}',
            'empresa_id',
            '{{%empresas}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_presupuesto_empresa_cliente',
            '{{%presupuesto}}',
            'empresa_cliente_id',
            '{{%empresa_cliente}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_presupuesto_location_sede',
            '{{%presupuesto}}',
            'location_sede_id',
            '{{%location_sedes}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_presupuesto_aprobado_por',
            '{{%presupuesto}}',
            'aprobado_por',
            '{{%user}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_presupuesto_rechazado_por',
            '{{%presupuesto}}',
            'rechazado_por',
            '{{%user}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_presupuesto_created_by',
            '{{%presupuesto}}',
            'created_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_presupuesto_updated_by',
            '{{%presupuesto}}',
            'updated_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'CASCADE'
        );

        $this->createTable('{{%presupuesto_concepto}}', [
            'id' => $this->primaryKey(),
            'presupuesto_id' => $this->integer()->notNull(),
            'novedad_concepto_id' => $this->integer()->unsigned()->notNull(),
            'observacion' => $this->text()->null(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'created_by' => $this->integer()->null(),
            'updated_by' => $this->integer()->null(),
            'activo' => $this->tinyInteger(1)->notNull()->defaultValue(1),
        ], $tableOptions);

        $this->createIndex('idx_presupuesto_concepto_presupuesto', '{{%presupuesto_concepto}}', ['presupuesto_id']);
        $this->createIndex('idx_presupuesto_concepto_novedad', '{{%presupuesto_concepto}}', ['novedad_concepto_id']);
        $this->createIndex(
            'uq_presupuesto_concepto_presupuesto_novedad',
            '{{%presupuesto_concepto}}',
            ['presupuesto_id', 'novedad_concepto_id'],
            true
        );

        $this->addForeignKey(
            'fk_presupuesto_concepto_presupuesto',
            '{{%presupuesto_concepto}}',
            'presupuesto_id',
            '{{%presupuesto}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_presupuesto_concepto_novedad',
            '{{%presupuesto_concepto}}',
            'novedad_concepto_id',
            '{{%novedad_concepto}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_presupuesto_concepto_created_by',
            '{{%presupuesto_concepto}}',
            'created_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_presupuesto_concepto_updated_by',
            '{{%presupuesto_concepto}}',
            'updated_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'CASCADE'
        );

        $this->createTable('{{%presupuesto_concepto_dia}}', [
            'id' => $this->primaryKey(),
            'presupuesto_concepto_id' => $this->integer()->notNull(),
            'dia_semana' => $this->tinyInteger()->notNull()->comment('1=lunes … 7=domingo (ISO)'),
            'horas_maximas' => $this->decimal(8, 2)->notNull()->defaultValue(0),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'created_by' => $this->integer()->null(),
            'updated_by' => $this->integer()->null(),
            'activo' => $this->tinyInteger(1)->notNull()->defaultValue(1),
        ], $tableOptions);

        $this->createIndex('idx_presupuesto_concepto_dia_pivot', '{{%presupuesto_concepto_dia}}', ['presupuesto_concepto_id']);
        $this->createIndex(
            'uq_presupuesto_concepto_dia_pivot_dia',
            '{{%presupuesto_concepto_dia}}',
            ['presupuesto_concepto_id', 'dia_semana'],
            true
        );

        $this->addForeignKey(
            'fk_presupuesto_concepto_dia_pivot',
            '{{%presupuesto_concepto_dia}}',
            'presupuesto_concepto_id',
            '{{%presupuesto_concepto}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_presupuesto_concepto_dia_created_by',
            '{{%presupuesto_concepto_dia}}',
            'created_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_presupuesto_concepto_dia_updated_by',
            '{{%presupuesto_concepto_dia}}',
            'updated_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'CASCADE'
        );

        $this->execute('ALTER TABLE {{%presupuesto_concepto_dia}} ADD CONSTRAINT chk_presupuesto_concepto_dia_horas CHECK (`horas_maximas` >= 0 AND `horas_maximas` <= 24)');
        $this->execute('ALTER TABLE {{%presupuesto_concepto_dia}} ADD CONSTRAINT chk_presupuesto_concepto_dia_dia CHECK (`dia_semana` >= 1 AND `dia_semana` <= 7)');

        $this->createTable('{{%presupuesto_historial}}', [
            'id' => $this->primaryKey(),
            'presupuesto_id' => $this->integer()->notNull(),
            'accion' => $this->string(40)->notNull(),
            'estado_anterior' => $this->string(32)->null(),
            'estado_nuevo' => $this->string(32)->null(),
            'comentario' => $this->text()->null(),
            'actor_user_id' => $this->integer()->null(),
            'created_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx_presupuesto_historial_presupuesto_fecha', '{{%presupuesto_historial}}', ['presupuesto_id', 'created_at']);

        $this->addForeignKey(
            'fk_presupuesto_historial_presupuesto',
            '{{%presupuesto_historial}}',
            'presupuesto_id',
            '{{%presupuesto}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_presupuesto_historial_actor',
            '{{%presupuesto_historial}}',
            'actor_user_id',
            '{{%user}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_presupuesto_historial_actor', '{{%presupuesto_historial}}');
        $this->dropForeignKey('fk_presupuesto_historial_presupuesto', '{{%presupuesto_historial}}');
        $this->dropTable('{{%presupuesto_historial}}');

        $this->dropForeignKey('fk_presupuesto_concepto_dia_updated_by', '{{%presupuesto_concepto_dia}}');
        $this->dropForeignKey('fk_presupuesto_concepto_dia_created_by', '{{%presupuesto_concepto_dia}}');
        $this->dropForeignKey('fk_presupuesto_concepto_dia_pivot', '{{%presupuesto_concepto_dia}}');
        $this->dropTable('{{%presupuesto_concepto_dia}}');

        $this->dropForeignKey('fk_presupuesto_concepto_updated_by', '{{%presupuesto_concepto}}');
        $this->dropForeignKey('fk_presupuesto_concepto_created_by', '{{%presupuesto_concepto}}');
        $this->dropForeignKey('fk_presupuesto_concepto_novedad', '{{%presupuesto_concepto}}');
        $this->dropForeignKey('fk_presupuesto_concepto_presupuesto', '{{%presupuesto_concepto}}');
        $this->dropTable('{{%presupuesto_concepto}}');

        $this->dropForeignKey('fk_presupuesto_updated_by', '{{%presupuesto}}');
        $this->dropForeignKey('fk_presupuesto_created_by', '{{%presupuesto}}');
        $this->dropForeignKey('fk_presupuesto_rechazado_por', '{{%presupuesto}}');
        $this->dropForeignKey('fk_presupuesto_aprobado_por', '{{%presupuesto}}');
        $this->dropForeignKey('fk_presupuesto_location_sede', '{{%presupuesto}}');
        $this->dropForeignKey('fk_presupuesto_empresa_cliente', '{{%presupuesto}}');
        $this->dropForeignKey('fk_presupuesto_empresa', '{{%presupuesto}}');
        $this->dropTable('{{%presupuesto}}');
    }
}
