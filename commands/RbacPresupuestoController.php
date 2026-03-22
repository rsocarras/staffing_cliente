<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * RBAC: permisos del módulo Presupuestos.
 */
class RbacPresupuestoController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $perms = [
            'presupuesto_index' => 'Listado de presupuestos',
            'presupuesto_view' => 'Ver detalle presupuesto',
            'presupuesto_create' => 'Crear presupuesto',
            'presupuesto_update' => 'Editar borrador / rechazado',
            'presupuesto_submit' => 'Enviar a aprobación',
            'presupuesto_approve' => 'Aprobar presupuesto',
            'presupuesto_reject' => 'Rechazar presupuesto',
            'presupuesto_reopen' => 'Reabrir rechazado como borrador',
            'presupuesto_cancel' => 'Anular presupuesto',
            'presupuesto_clone' => 'Clonar presupuesto',
            'presupuesto_history' => 'Ver historial (alias view)',
        ];

        $permObjects = [];
        foreach ($perms as $name => $desc) {
            $p = $auth->getPermission($name);
            if (!$p) {
                $p = $auth->createPermission($name);
                $p->description = $desc;
                $auth->add($p);
            }
            $permObjects[$name] = $p;
        }

        $linkChild = function ($roleName, array $permNames) use ($auth, $permObjects) {
            $role = $auth->getRole($roleName);
            if (!$role) {
                return;
            }
            foreach ($permNames as $pn) {
                if (!isset($permObjects[$pn])) {
                    continue;
                }
                if (!$auth->hasChild($role, $permObjects[$pn])) {
                    $auth->addChild($role, $permObjects[$pn]);
                }
            }
        };

        // Gerente sede: operación en su sede (la app filtra por alcance)
        $linkChild('gerente_sede', [
            'presupuesto_index',
            'presupuesto_view',
            'presupuesto_create',
            'presupuesto_update',
            'presupuesto_submit',
            'presupuesto_clone',
            'presupuesto_cancel',
            'presupuesto_history',
        ]);

        $linkChild('rrhh_cliente', [
            'presupuesto_index',
            'presupuesto_view',
            'presupuesto_approve',
            'presupuesto_reject',
            'presupuesto_history',
        ]);

        $linkChild('rrhh_interno', [
            'presupuesto_index',
            'presupuesto_view',
            'presupuesto_approve',
            'presupuesto_reject',
            'presupuesto_history',
        ]);

        $linkChild('rrhh', [
            'presupuesto_index',
            'presupuesto_view',
            'presupuesto_approve',
            'presupuesto_reject',
            'presupuesto_clone',
            'presupuesto_history',
        ]);

        $admin = $auth->getRole('admin');
        if (!$admin) {
            $admin = $auth->createRole('admin');
            $admin->description = 'Administrador';
            $auth->add($admin);
        }
        foreach ($permObjects as $p) {
            if (!$auth->hasChild($admin, $p)) {
                $auth->addChild($admin, $p);
            }
        }

        $administrator = $auth->getRole('administrator');
        if ($administrator) {
            foreach ($permObjects as $p) {
                if (!$auth->hasChild($administrator, $p)) {
                    $auth->addChild($administrator, $p);
                }
            }
        }

        $adminTotal = $auth->getRole('admin_total');
        if ($adminTotal) {
            foreach ($permObjects as $p) {
                if (!$auth->hasChild($adminTotal, $p)) {
                    $auth->addChild($adminTotal, $p);
                }
            }
        }

        $this->stdout("RBAC Presupuestos inicializado.\n");
        $this->stdout("Permisos: " . implode(', ', array_keys($perms)) . "\n");

        return ExitCode::OK;
    }
}
