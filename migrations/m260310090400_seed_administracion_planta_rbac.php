<?php

use yii\db\Migration;
use yii\rbac\DbManager;

class m260310090400_seed_administracion_planta_rbac extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        if (!$auth instanceof DbManager) {
            return;
        }

        $permissions = [
            'administracion_planta_dashboard' => 'Ver dashboard y resúmenes de administración de planta',
            'administracion_planta_view' => 'Ver administración de planta',
            'administracion_planta_manage' => 'Crear y editar planta autorizada',
            'administracion_planta_export' => 'Exportar reportes de administración de planta',
            'administracion_planta_history' => 'Ver historial de administración de planta',
        ];

        foreach ($permissions as $name => $description) {
            if ($auth->getPermission($name) !== null) {
                continue;
            }

            $permission = $auth->createPermission($name);
            $permission->description = $description;
            $auth->add($permission);
        }

        $roles = [
            'admin_total' => 'Acceso global a administración de planta',
            'rrhh' => 'Gestión corporativa de administración de planta',
            'operaciones_regionales' => 'Gestión regional de administración de planta',
            'director_area' => 'Gestión por área de administración de planta',
            'gerente_sede' => 'Consulta por sede de administración de planta',
        ];

        foreach ($roles as $name => $description) {
            if ($auth->getRole($name) !== null) {
                continue;
            }

            $role = $auth->createRole($name);
            $role->description = $description;
            $auth->add($role);
        }

        $grantMap = [
            'admin_total' => array_keys($permissions),
            'rrhh' => array_keys($permissions),
            'operaciones_regionales' => [
                'administracion_planta_dashboard',
                'administracion_planta_view',
                'administracion_planta_manage',
                'administracion_planta_export',
            ],
            'director_area' => [
                'administracion_planta_dashboard',
                'administracion_planta_view',
                'administracion_planta_manage',
                'administracion_planta_export',
            ],
            'gerente_sede' => [
                'administracion_planta_dashboard',
                'administracion_planta_view',
                'administracion_planta_export',
            ],
        ];

        foreach ($grantMap as $roleName => $permissionNames) {
            $role = $auth->getRole($roleName);
            if ($role === null) {
                continue;
            }

            foreach ($permissionNames as $permissionName) {
                $permission = $auth->getPermission($permissionName);
                if ($permission !== null && !$auth->hasChild($role, $permission)) {
                    $auth->addChild($role, $permission);
                }
            }
        }

        foreach (['admin', 'administrator', 'rrhh_interno', 'rrhh_cliente'] as $existingRoleName) {
            $existingRole = $auth->getRole($existingRoleName);
            if ($existingRole === null) {
                continue;
            }

            foreach (array_keys($permissions) as $permissionName) {
                $permission = $auth->getPermission($permissionName);
                if ($permission !== null && !$auth->hasChild($existingRole, $permission)) {
                    $auth->addChild($existingRole, $permission);
                }
            }
        }
    }

    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        if (!$auth instanceof DbManager) {
            return;
        }

        foreach ([
            'admin_total',
            'rrhh',
            'operaciones_regionales',
            'director_area',
            'gerente_sede',
        ] as $roleName) {
            $role = $auth->getRole($roleName);
            if ($role !== null) {
                $auth->remove($role);
            }
        }

        foreach ([
            'administracion_planta_history',
            'administracion_planta_export',
            'administracion_planta_manage',
            'administracion_planta_view',
            'administracion_planta_dashboard',
        ] as $permissionName) {
            $permission = $auth->getPermission($permissionName);
            if ($permission !== null) {
                $auth->remove($permission);
            }
        }
    }
}
