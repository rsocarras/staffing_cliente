<?php

use yii\db\Migration;

/**
 * Tabla requisicion con soporte N vacantes (group_uuid + vacante_index)
 */
class m250302100004_create_requisicion_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('requisicion', [
            'id' => $this->primaryKey(),
            'group_uuid' => $this->char(36)->notNull()->comment('UUID del grupo de N vacantes'),
            'vacante_index' => $this->integer()->notNull()->defaultValue(1)->comment('Índice 1..N dentro del grupo'),
            'parent_id' => $this->integer()->null()->comment('ID requisición maestra si es hija'),
            'estado' => $this->string(50)->notNull()->defaultValue('DRAFT'),
            'motivo_vinculacion_id' => $this->integer()->null(),
            'empresa_id' => $this->integer()->notNull()->comment('empresa_cliente FK'),
            'fecha_ingreso' => $this->datetime()->notNull(),
            'ciudad_id' => $this->integer()->unsigned()->notNull(),
            'sede_id' => $this->bigInteger()->unsigned()->notNull(),
            'area_id' => $this->integer()->notNull(),
            'sub_area_id' => $this->integer()->null()->comment('area con area_padre=area_id'),
            'cargo_id' => $this->bigInteger()->unsigned()->notNull(),
            'jornada' => $this->decimal(5, 2)->notNull(),
            'salario' => $this->decimal(14, 2)->notNull()->defaultValue(0),
            'auxilio' => $this->decimal(14, 2)->notNull()->defaultValue(0),
            'esquema_variable_id' => $this->integer()->null(),
            'numero_vacantes' => $this->integer()->notNull()->defaultValue(1)->comment('Solo en maestra: total vacantes del grupo'),
            'profile_id' => $this->integer()->null()->comment('Persona asignada (user_id de profile)'),
            'motivo_rechazo' => $this->text()->null(),
            'vinculacion_aprobada' => $this->tinyInteger(1)->null()->comment('1=Sí, 0=No, NULL=pendiente'),
            'vinculacion_motivo_rechazo' => $this->text()->null(),
            'nombres' => $this->string(250)->null(),
            'apellidos' => $this->string(250)->null(),
            'tipo_documento' => $this->string(10)->null(),
            'num_documento' => $this->string(30)->null(),
            'correo' => $this->string(255)->null(),
            'telefono' => $this->string(45)->null(),
            'birthday' => $this->date()->null(),
            'sexo' => $this->string(2)->null(),
            'creado_por' => $this->integer()->null(),
            'actualizado_por' => $this->integer()->null(),
            'fecha_creacion' => $this->datetime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'fecha_update' => $this->datetime()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

        $this->createIndex('idx_req_group_uuid', 'requisicion', 'group_uuid');
        $this->createIndex('idx_req_estado', 'requisicion', 'estado');
        $this->createIndex('idx_req_empresa', 'requisicion', 'empresa_id');
        $this->createIndex('idx_req_ciudad', 'requisicion', 'ciudad_id');
        $this->createIndex('idx_req_sede', 'requisicion', 'sede_id');
        $this->createIndex('idx_req_area', 'requisicion', 'area_id');
        $this->createIndex('idx_req_cargo', 'requisicion', 'cargo_id');
        $this->createIndex('idx_req_fecha_ingreso', 'requisicion', 'fecha_ingreso');
        $this->createIndex('idx_req_profile', 'requisicion', 'profile_id');
        $this->createIndex('idx_req_parent', 'requisicion', 'parent_id');

        $this->addForeignKey('fk_req_motivo', 'requisicion', 'motivo_vinculacion_id', 'motivo_vinculacion', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_req_empresa', 'requisicion', 'empresa_id', 'empresa_cliente', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_req_ciudad', 'requisicion', 'ciudad_id', 'city', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_req_sede', 'requisicion', 'sede_id', 'location_sedes', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_req_area', 'requisicion', 'area_id', 'area', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_req_sub_area', 'requisicion', 'sub_area_id', 'area', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_req_cargo', 'requisicion', 'cargo_id', 'cargos', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_req_esquema', 'requisicion', 'esquema_variable_id', 'esquema_variable', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_req_profile', 'requisicion', 'profile_id', 'profile', 'user_id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_req_parent', 'requisicion', 'parent_id', 'requisicion', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_req_creado_por', 'requisicion', 'creado_por', 'user', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_req_actualizado_por', 'requisicion', 'actualizado_por', 'user', 'id', 'SET NULL', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('requisicion');
    }
}
