<?php

use yii\db\Migration;

/**
 * Seed de permisos, roles y reglas RBAC para el módulo Requisición.
 * Basado en RbacRequisicionController::actionInit()
 *
 * auth_item: type 1 = rol, type 2 = permiso
 * auth_item_child: parent -> child (rol contiene permiso, o rol contiene rol)
 * auth_rule: reglas opcionales (vacío si no se usan)
 */
class m250303100000_seed_rbac_auth_tables extends Migration
{
    public function safeUp()
    {
        $ts = time();

        // auth_item: permisos (type=2) y roles (type=1)
        $items = [
            // Permisos
            ['requisicion_index', 2, 'Ver listado requisiciones', null, null, $ts, $ts],
            ['requisicion_create', 2, 'Crear requisiciones', null, null, $ts, $ts],
            ['requisicion_submit', 2, 'Enviar a aprobación', null, null, $ts, $ts],
            ['requisicion_approve', 2, 'Aprobar/Rechazar requisiciones', null, null, $ts, $ts],
            ['requisicion_assign', 2, 'Asignar persona a vacante', null, null, $ts, $ts],
            ['requisicion_vinculacion', 2, 'Gestionar paso vinculación y checklist', null, null, $ts, $ts],
            ['requisicion_reportes', 2, 'Ver reportes RRHH', null, null, $ts, $ts],
            // Roles
            ['cliente', 1, 'Cliente - crea y envía requisiciones', null, null, $ts, $ts],
            ['rrhh_cliente', 1, 'RRHH Cliente - aprueba/rechaza', null, null, $ts, $ts],
            ['analista_atraccion', 1, 'Analista atracción - asigna persona', null, null, $ts, $ts],
            ['analista_vinculacion', 1, 'Analista vinculación - checklist y activación', null, null, $ts, $ts],
            ['rrhh_interno', 1, 'RRHH Interno - reportes', null, null, $ts, $ts],
            ['admin', 1, 'Administrador', null, null, $ts, $ts],
        ];

        foreach ($items as $row) {
            $exists = $this->db->createCommand(
                'SELECT 1 FROM auth_item WHERE name = :name',
                [':name' => $row[0]]
            )->queryScalar();
            if (!$exists) {
                $this->insert('auth_item', [
                    'name' => $row[0],
                    'type' => $row[1],
                    'description' => $row[2],
                    'rule_name' => $row[3],
                    'data' => $row[4],
                    'created_at' => $row[5],
                    'updated_at' => $row[6],
                ]);
            }
        }

        // auth_item_child: parent -> child
        $children = [
            // cliente
            ['cliente', 'requisicion_index'],
            ['cliente', 'requisicion_create'],
            ['cliente', 'requisicion_submit'],
            // rrhh_cliente
            ['rrhh_cliente', 'requisicion_index'],
            ['rrhh_cliente', 'requisicion_approve'],
            // analista_atraccion
            ['analista_atraccion', 'requisicion_index'],
            ['analista_atraccion', 'requisicion_assign'],
            // analista_vinculacion
            ['analista_vinculacion', 'requisicion_index'],
            ['analista_vinculacion', 'requisicion_vinculacion'],
            // rrhh_interno
            ['rrhh_interno', 'requisicion_index'],
            ['rrhh_interno', 'requisicion_reportes'],
            // admin tiene todos los permisos
            ['admin', 'requisicion_index'],
            ['admin', 'requisicion_create'],
            ['admin', 'requisicion_submit'],
            ['admin', 'requisicion_approve'],
            ['admin', 'requisicion_assign'],
            ['admin', 'requisicion_vinculacion'],
            ['admin', 'requisicion_reportes'],
        ];

        foreach ($children as [$parent, $child]) {
            $exists = $this->db->createCommand(
                'SELECT 1 FROM auth_item_child WHERE parent = :p AND child = :c',
                [':p' => $parent, ':c' => $child]
            )->queryScalar();
            if (!$exists) {
                $this->insert('auth_item_child', ['parent' => $parent, 'child' => $child]);
            }
        }

        // auth_rule: vacío por defecto (no se usan reglas en el módulo Requisición)
        // Si en el futuro se añaden reglas, se pueden insertar aquí
    }

    public function safeDown()
    {
        $children = [
            ['cliente', 'requisicion_index'],
            ['cliente', 'requisicion_create'],
            ['cliente', 'requisicion_submit'],
            ['rrhh_cliente', 'requisicion_index'],
            ['rrhh_cliente', 'requisicion_approve'],
            ['analista_atraccion', 'requisicion_index'],
            ['analista_atraccion', 'requisicion_assign'],
            ['analista_vinculacion', 'requisicion_index'],
            ['analista_vinculacion', 'requisicion_vinculacion'],
            ['rrhh_interno', 'requisicion_index'],
            ['rrhh_interno', 'requisicion_reportes'],
            ['admin', 'requisicion_index'],
            ['admin', 'requisicion_create'],
            ['admin', 'requisicion_submit'],
            ['admin', 'requisicion_approve'],
            ['admin', 'requisicion_assign'],
            ['admin', 'requisicion_vinculacion'],
            ['admin', 'requisicion_reportes'],
        ];

        foreach ($children as [$parent, $child]) {
            $this->delete('auth_item_child', ['parent' => $parent, 'child' => $child]);
        }

        $itemNames = [
            'requisicion_index', 'requisicion_create', 'requisicion_submit',
            'requisicion_approve', 'requisicion_assign', 'requisicion_vinculacion', 'requisicion_reportes',
            'cliente', 'rrhh_cliente', 'analista_atraccion', 'analista_vinculacion', 'rrhh_interno', 'admin',
        ];

        foreach ($itemNames as $name) {
            $this->delete('auth_assignment', ['item_name' => $name]);
            $this->delete('auth_item', ['name' => $name]);
        }
    }
}
