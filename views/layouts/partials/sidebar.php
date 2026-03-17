<?php

use yii\helpers\Url;

$path = Yii::$app->request->getPathInfo();
$page = empty($path) ? 'index' : basename($path);
$controllerId = Yii::$app->controller ? Yii::$app->controller->id : '';
$actionId = (Yii::$app->controller && Yii::$app->controller->action) ? Yii::$app->controller->action->id : '';
$isDashboardActive = ($controllerId === 'site' && $actionId === 'index')
    || ($controllerId === 'pages' && $actionId === 'index')
    || ($path === '')
    || ($path === 'index');
$isMallasActive = in_array($controllerId, ['mallas', 'malla-cargo-asignacion', 'malla-profile-asignacion'], true);

$plantillaDir = Yii::getAlias('@app/views/plantilla');
$plantillaFiles = glob($plantillaDir . '/*.php') ?: [];
$plantillaPages = [];
foreach ($plantillaFiles as $file) {
    $plantillaPages[] = basename($file, '.php');
}
sort($plantillaPages);

$plantillaGroups = [
    'User' => [],
    'UI' => [],
    'Forms' => [],
    'Icons' => [],
    'Charts' => [],
    'Otros' => [],
];

foreach ($plantillaPages as $slug) {
    if (strpos($slug, 'user-') === 0) {
        $plantillaGroups['User'][] = $slug;
    } elseif (strpos($slug, 'ui-') === 0) {
        $plantillaGroups['UI'][] = $slug;
    } elseif (strpos($slug, 'form-') === 0) {
        $plantillaGroups['Forms'][] = $slug;
    } elseif (strpos($slug, 'icon-') === 0) {
        $plantillaGroups['Icons'][] = $slug;
    } elseif (strpos($slug, 'chart-') === 0) {
        $plantillaGroups['Charts'][] = $slug;
    } else {
        $plantillaGroups['Otros'][] = $slug;
    }
}

$isPlantillaActive = in_array($page, $plantillaPages, true) || strpos($path, 'pages/') !== false;
?>

<div class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <a href="<?= Url::to(['/']) ?>" class="logo logo-normal">
            <img src="/assets/img/logo.svg" alt="Logo">
        </a>
        <a href="<?= Url::to(['/']) ?>" class="logo-small">
            <img src="/assets/img/logo-small.svg" alt="Logo">
        </a>
        <a href="<?= Url::to(['/']) ?>" class="dark-logo">
            <img src="/assets/img/logo-white.svg" alt="Logo">
        </a>
        <button class="sidebar-close">
            <i class="ti ti-x align-middle"></i>
        </button>
    </div>

    <div class="sidebar-inner" data-simplebar>
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title"><span>Sistema</span></li>
                <li>
                    <a href="<?= Url::to(['/']) ?>" class="<?= $isDashboardActive ? 'active' : '' ?>">
                        <i class="ti ti-layout-grid-add"></i><span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/novedad-tipo/index']) ?>" class="<?= (strpos($path, 'novedad-tipo') !== false) ? 'active' : '' ?>">
                        <i class="ti ti-list-details"></i><span>Tipo de Novedad</span>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/requisicion/index']) ?>" class="<?= (strpos($path, 'requisicion') !== false) ? 'active' : '' ?>">
                        <i class="ti ti-file-certificate"></i><span>Requisiciones</span>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/profile/index']) ?>" class="<?= ($controllerId === 'profile') ? 'active' : '' ?>">
                        <i class="ti ti-users"></i><span>Empleados / colaboradores</span>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/location-sedes/index']) ?>" class="<?= (strpos($path, 'location-sedes') !== false) ? 'active' : '' ?>">
                        <i class="ti ti-building"></i><span>Sedes</span>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/area/index']) ?>" class="<?= (strpos($path, 'area') !== false) ? 'active' : '' ?>">
                        <i class="ti ti-folders"></i><span>Áreas</span>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/contrato/index']) ?>" class="<?= (strpos($path, 'contrato') !== false && strpos($path, 'contrato-tipos') === false) ? 'active' : '' ?>">
                        <i class="ti ti-id-badge-2"></i><span>Contratos</span>
                    </a>
                </li>

                <li class="menu-title"><span>Mallas</span></li>
                <li class="submenu">
                    <a href="javascript:void(0);" class="<?= $isMallasActive ? 'active subdrop' : '' ?>">
                        <i class="ti ti-calendar-time"></i><span>Módulo mallas</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?= Url::to(['/mallas/index']) ?>" class="<?= ($controllerId === 'mallas' && $actionId === 'index') ? 'active' : '' ?>">
                                Mallas
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::to(['/mallas/create']) ?>" class="<?= ($controllerId === 'mallas' && $actionId === 'create') ? 'active' : '' ?>">
                                Crear malla
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::to(['/mallas/view', 'id' => 1]) ?>" class="<?= ($controllerId === 'mallas' && $actionId === 'view') ? 'active' : '' ?>">
                                Ver malla (ejemplo ID 1)
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::to(['/malla-cargo-asignacion/index']) ?>" class="<?= ($controllerId === 'malla-cargo-asignacion') ? 'active' : '' ?>">
                                Asignación por cargo
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::to(['/malla-profile-asignacion/index']) ?>" class="<?= ($controllerId === 'malla-profile-asignacion') ? 'active' : '' ?>">
                                Asignación por empleado
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-title"><span>Plantilla</span></li>
                <li class="submenu">
                    <a href="javascript:void(0);" class="<?= $isPlantillaActive ? 'active subdrop' : '' ?>">
                        <i class="ti ti-layout-list"></i><span>Vistas de plantilla</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <?php foreach ($plantillaGroups as $group => $items): ?>
                            <?php if (empty($items)) {
                                continue;
                            } ?>
                            <li class="submenu submenu-two">
                                <a href="javascript:void(0);" class="<?= in_array($page, $items, true) ? 'active subdrop' : '' ?>">
                                    <?= $group ?>
                                    <span class="menu-arrow inside-submenu"></span>
                                </a>
                                <ul>
                                    <?php foreach ($items as $slug): ?>
                                        <li>
                                            <a href="<?= Url::to(['/pages/' . $slug]) ?>" class="<?= ($page === $slug) ? 'active' : '' ?>">
                                                <?= ucwords(str_replace('-', ' ', $slug)) ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
