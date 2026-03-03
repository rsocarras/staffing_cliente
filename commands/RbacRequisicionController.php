<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Inicializa roles y permisos RBAC para el módulo Requisición
 */
class RbacRequisicionController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // Permisos (crear solo si no existen)
        $permRequisicionIndex = $auth->getPermission('requisicion_index') ?: $auth->createPermission('requisicion_index');
        $permRequisicionIndex->description = 'Ver listado requisiciones';
        if (!$auth->getPermission('requisicion_index')) $auth->add($permRequisicionIndex);

        $permRequisicionCreate = $auth->getPermission('requisicion_create') ?: $auth->createPermission('requisicion_create');
        $permRequisicionCreate->description = 'Crear requisiciones';
        if (!$auth->getPermission('requisicion_create')) $auth->add($permRequisicionCreate);

        $permRequisicionSubmit = $auth->getPermission('requisicion_submit') ?: $auth->createPermission('requisicion_submit');
        $permRequisicionSubmit->description = 'Enviar a aprobación';
        if (!$auth->getPermission('requisicion_submit')) $auth->add($permRequisicionSubmit);

        $permRequisicionApprove = $auth->getPermission('requisicion_approve') ?: $auth->createPermission('requisicion_approve');
        $permRequisicionApprove->description = 'Aprobar/Rechazar requisiciones';
        if (!$auth->getPermission('requisicion_approve')) $auth->add($permRequisicionApprove);

        $permRequisicionAssign = $auth->getPermission('requisicion_assign') ?: $auth->createPermission('requisicion_assign');
        $permRequisicionAssign->description = 'Asignar persona a vacante';
        if (!$auth->getPermission('requisicion_assign')) $auth->add($permRequisicionAssign);

        $permRequisicionVinculacion = $auth->getPermission('requisicion_vinculacion') ?: $auth->createPermission('requisicion_vinculacion');
        $permRequisicionVinculacion->description = 'Gestionar paso vinculación y checklist';
        if (!$auth->getPermission('requisicion_vinculacion')) $auth->add($permRequisicionVinculacion);

        $permRequisicionReportes = $auth->getPermission('requisicion_reportes') ?: $auth->createPermission('requisicion_reportes');
        $permRequisicionReportes->description = 'Ver reportes RRHH';
        if (!$auth->getPermission('requisicion_reportes')) $auth->add($permRequisicionReportes);

        // Roles
        $cliente = $auth->getRole('cliente') ?: $auth->createRole('cliente');
        $cliente->description = 'Cliente - crea y envía requisiciones';
        if (!$auth->getRole('cliente')) $auth->add($cliente);
        if (!$auth->hasChild($cliente, $permRequisicionIndex)) $auth->addChild($cliente, $permRequisicionIndex);
        if (!$auth->hasChild($cliente, $permRequisicionCreate)) $auth->addChild($cliente, $permRequisicionCreate);
        if (!$auth->hasChild($cliente, $permRequisicionSubmit)) $auth->addChild($cliente, $permRequisicionSubmit);

        $rrhhCliente = $auth->getRole('rrhh_cliente') ?: $auth->createRole('rrhh_cliente');
        $rrhhCliente->description = 'RRHH Cliente - aprueba/rechaza';
        if (!$auth->getRole('rrhh_cliente')) $auth->add($rrhhCliente);
        if (!$auth->hasChild($rrhhCliente, $permRequisicionIndex)) $auth->addChild($rrhhCliente, $permRequisicionIndex);
        if (!$auth->hasChild($rrhhCliente, $permRequisicionApprove)) $auth->addChild($rrhhCliente, $permRequisicionApprove);

        $analistaAtraccion = $auth->getRole('analista_atraccion') ?: $auth->createRole('analista_atraccion');
        $analistaAtraccion->description = 'Analista atracción - asigna persona';
        if (!$auth->getRole('analista_atraccion')) $auth->add($analistaAtraccion);
        if (!$auth->hasChild($analistaAtraccion, $permRequisicionIndex)) $auth->addChild($analistaAtraccion, $permRequisicionIndex);
        if (!$auth->hasChild($analistaAtraccion, $permRequisicionAssign)) $auth->addChild($analistaAtraccion, $permRequisicionAssign);

        $analistaVinculacion = $auth->getRole('analista_vinculacion') ?: $auth->createRole('analista_vinculacion');
        $analistaVinculacion->description = 'Analista vinculación - checklist y activación';
        if (!$auth->getRole('analista_vinculacion')) $auth->add($analistaVinculacion);
        if (!$auth->hasChild($analistaVinculacion, $permRequisicionIndex)) $auth->addChild($analistaVinculacion, $permRequisicionIndex);
        if (!$auth->hasChild($analistaVinculacion, $permRequisicionVinculacion)) $auth->addChild($analistaVinculacion, $permRequisicionVinculacion);

        $rrhhInterno = $auth->getRole('rrhh_interno') ?: $auth->createRole('rrhh_interno');
        $rrhhInterno->description = 'RRHH Interno - reportes';
        if (!$auth->getRole('rrhh_interno')) $auth->add($rrhhInterno);
        if (!$auth->hasChild($rrhhInterno, $permRequisicionIndex)) $auth->addChild($rrhhInterno, $permRequisicionIndex);
        if (!$auth->hasChild($rrhhInterno, $permRequisicionReportes)) $auth->addChild($rrhhInterno, $permRequisicionReportes);

        // Admin tiene todos los permisos
        $admin = $auth->getRole('admin');
        if (!$admin) {
            $admin = $auth->createRole('admin');
            $admin->description = 'Administrador';
            $auth->add($admin);
        }
        foreach ([$permRequisicionIndex, $permRequisicionCreate, $permRequisicionSubmit, $permRequisicionApprove, $permRequisicionAssign, $permRequisicionVinculacion, $permRequisicionReportes] as $p) {
            if (!$auth->hasChild($admin, $p)) {
                $auth->addChild($admin, $p);
            }
        }

        $this->stdout("RBAC Requisición inicializado.\n");
        $this->stdout("Roles: cliente, rrhh_cliente, analista_atraccion, analista_vinculacion, rrhh_interno\n");
        $this->stdout("Asigne roles con: php yii rbac/assign <rol> <username>\n");

        return ExitCode::OK;
    }
}
