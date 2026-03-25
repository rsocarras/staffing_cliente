<?php

use yii\helpers\Url;

$path = Yii::$app->request->getPathInfo();
$homeUrl = Yii::$app->homeUrl;

?>

<div class="sidebar bg-primary" id="sidebar">
    <div class="sidebar-logo">
        <!-- Logo Normal -->
        <a href="<?= $homeUrl ?>" class="logo logo-normal">
            <img src="<?= $homeUrl ?>assets/img/logo.png" alt="Logo">
        </a>

        <!-- Logo Small (iniciales cuando está minimizado) -->
        <a href="<?= $homeUrl ?>" class="logo-small logo-initials">
            <span class="logo-initials-text">SG</span>
        </a>

        <button class="sidebar-close">
            <i class="ti ti-x align-middle"></i>
        </button>
    </div>

    <div class="sidebar-inner" data-simplebar>
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title"><span>Sistema</span></li>
                <li><a href="<?= Url::to(['/']) ?>" class="<?php echo ($path == '/') ? 'active' : ''; ?>"><i class="ti ti-layout-grid-add"></i><span>Dashboard</span></a></li>
<<<<<<< HEAD
                <li class="submenu">
                    <a href="javascript:void(0);">
                        <i class="ti ti-building-community"></i><span>Administración de Planta</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="<?= Url::to(['/administracion-planta/dashboard']) ?>" class="<?php echo ($path == 'administracion-planta/dashboard') ? 'active' : ''; ?>">Dashboard</a></li>
                        <li><a href="<?= Url::to(['/administracion-planta/resumen-sede']) ?>" class="<?php echo ($path == 'administracion-planta/resumen-sede') ? 'active' : ''; ?>">Resumen por sede</a></li>
                        <li><a href="<?= Url::to(['/administracion-planta/resumen-area']) ?>" class="<?php echo ($path == 'administracion-planta/resumen-area') ? 'active' : ''; ?>">Resumen por área</a></li>
                        <li><a href="<?= Url::to(['/administracion-planta/index']) ?>" class="<?php echo ($path == 'administracion-planta/index') ? 'active' : ''; ?>">Planta autorizada</a></li>
                        <li><a href="<?= Url::to(['/administracion-planta/historial']) ?>" class="<?php echo ($path == 'administracion-planta/historial') ? 'active' : ''; ?>">Historial</a></li>
                    </ul>
                </li>
                <li><a href="<?= Url::to(['/sistema/novedades']) ?>" class="<?php echo (strpos($path, 'sistema/novedades') === 0) ? 'active' : ''; ?>"><i class="ti ti-list-details"></i><span>Novedades</span></a></li>
=======
                <li><a href="<?= Url::to(['/sistema/novedades']) ?>" class="<?php echo (strpos($path, 'sistema/novedades') === 0 || $path === 'sistema/novedad' || str_starts_with($path, 'sistema/novedad/')) ? 'active' : ''; ?>"><i class="ti ti-list-details"></i><span>Novedades</span></a></li>
>>>>>>> ac4d779dc8d20512466fb3a9bd6da4801dc06934
                <li><a href="<?= Url::to(['/sistema/novedad-tipo']) ?>" class="<?php echo ($path == 'sistema/novedad-tipo') ? 'active' : ''; ?>"><i class="ti ti-list-details"></i><span>Tipo de Novedad</span></a></li>
                <li><a href="<?= Url::to(['/sistema/requisicion']) ?>" class="<?php echo ($path == 'sistema/requisicion') ? 'active' : ''; ?>"><i class="ti ti-file-certificate"></i><span>Requisiciones</span></a></li>
                <li class="submenu">
                    <a href="javascript:void(0);">
                        <i class="ti ti-calculator"></i><span>Presupuestos</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="<?= Url::to(['/sistema/presupuesto']) ?>" class="<?php echo (strpos($path, 'sistema/presupuesto') === 0 && $path !== 'sistema/presupuesto/pending') ? 'active' : ''; ?>">Listado</a></li>
                        <li><a href="<?= Url::to(['/sistema/presupuesto/create']) ?>" class="<?php echo ($path == 'sistema/presupuesto/create') ? 'active' : ''; ?>">Crear presupuesto</a></li>
                        <li><a href="<?= Url::to(['/sistema/presupuesto/pending']) ?>" class="<?php echo ($path == 'sistema/presupuesto/pending') ? 'active' : ''; ?>">Pendientes por aprobar</a></li>
                    </ul>
                </li>
                <li><a href="<?= Url::to(['/sistema/empleados']) ?>" class="<?php echo (strpos($path, 'sistema/empleados') === 0) ? 'active' : ''; ?>"><i class="ti ti-users"></i><span>Empleados / colaboradores</span></a></li>
                <li><a href="<?= Url::to(['/sistema/contratos']) ?>" class="<?php echo ($path == 'sistema/contratos') ? 'active' : ''; ?>"><i class="ti ti-id-badge-2"></i><span>Contratos</span></a></li>

                <li class="menu-title"><span>Mallas</span></li>
                <li class="submenu">
                    <a href="javascript:void(0);">
                        <i class="ti ti-calendar-time"></i><span>Gestion de mallas</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="<?= Url::to(['/mallas/list']) ?>" class="<?php echo ($path == 'mallas/list') ? 'active' : ''; ?>">Listado</a></li>
                        <li><a href="<?= Url::to(['/mallas/crear']) ?>" class="<?php echo ($path == 'mallas/crear') ? 'active' : ''; ?>">Crear malla</a></li>
                        <li><a href="<?= Url::to(['/mallas/view', 'id' => 1]) ?>" class="<?php echo ($path == 'mallas/view') ? 'active' : ''; ?>">Ver malla (ejemplo ID 1)</a></li>
                        <li><a href="<?= Url::to(['/mallas/cargo-asignacion']) ?>" class="<?php echo ($path == 'mallas/cargo-asignacion') ? 'active' : ''; ?>">Asignación por cargo</a></li>
                        <li><a href="<?= Url::to(['/mallas/profile-asignacion']) ?>" class="<?php echo ($path == 'mallas/profile-asignacion') ? 'active' : ''; ?>">Asignación por empleado</a></li>
                    </ul>
                </li>

                <li class="menu-title"><span>Administración</span></li>
                <li class="submenu">
                    <a href="javascript:void(0);">
                        <i class="ti ti-user-star"></i><span>Gestion de usuarios</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="<?= Url::to(['/usuarios']) ?>" class="<?php echo ($path == 'usuarios') ? 'active' : ''; ?>">Usuarios</a></li>
                        <li><a href="<?= Url::to(['/usuarios/roles']) ?>" class="<?php echo ($path == 'usuarios/roles') ? 'active' : ''; ?>">Roles</a></li>
                        <li><a href="<?= Url::to(['/usuarios/permisos']) ?>" class="<?php echo ($path == 'usuarios/permisos') ? 'active' : ''; ?>">Permisos</a></li>
                    </ul>
                </li>

                <li class="menu-title"><span>Reclutamiento</span></li>
                <li>
                    <a href="<?= Url::to(['/reclutamiento/candidatos']) ?>" class="<?php echo ($path == 'reclutamiento/candidatos') ? 'active' : ''; ?>">
                        <i class="ti ti-user-shield"></i><span>Candidatos</span>
                    </a>
                </li>

                <li class="menu-title"><span>Configuración</span></li>
                <li><a href="<?= Url::to(['/configuracion/areas']) ?>" class="<?php echo ($path == 'configuracion/areas') ? 'active' : ''; ?>"><i class="ti ti-folders"></i><span>Áreas</span></a></li>
                <li><a href="<?= Url::to(['/configuracion/cargos']) ?>" class="<?php echo ($path == 'configuracion/cargos') ? 'active' : ''; ?>"><i class="ti ti-briefcase"></i><span>Cargos</span></a></li>
                <li><a href="<?= Url::to(['/configuracion/contratos']) ?>" class="<?php echo ($path == 'configuracion/contratos') ? 'active' : ''; ?>"><i class="ti ti-id-badge-2"></i><span>Tipos de Contratos</span></a></li>
                <li><a href="<?= Url::to(['/configuracion/sedes']) ?>" class="<?php echo ($path == 'configuracion/sedes') ? 'active' : ''; ?>"><i class="ti ti-building"></i><span>Sedes</span></a></li>
                <li><a href="<?= Url::to(['/configuracion/novedad-flujo']) ?>" class="<?php echo (strpos($path, 'configuracion/novedad-flujo') === 0) ? 'active' : ''; ?>"><i class="ti ti-route"></i><span>Flujos de novedad</span></a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Sidenav Menu End -->