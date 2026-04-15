<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language' => 'es',
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => array_merge([
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '3nnFLL-fN8rdekwmQbVnN6SoSrZ75QNe',
        ], !empty($params['baseUrl']) ? ['hostInfo' => $params['baseUrl']] : []),

        'session' => [
            'name' => 'STAFFING_CLIENTE_SID',  // Nombre único para no compartir sesión con otros proyectos Yii que usen la misma BD
        ],

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        /** Fechas, números y moneda según español (p. ej. nombres de mes en tablas y vistas). */
        'formatter' => [
            'class' => yii\i18n\Formatter::class,
            'locale' => 'es-CO',
            'currencyCode' => 'COP',
            'defaultTimeZone' => 'America/Bogota',
        ],
        'user' => [
            'class' => app\components\WebUser::class,
            'identityClass' => app\models\User::class,
            'enableAutoLogin' => true,
            'loginUrl' => ['/user/security/login'],
        ],
        'authManager' => [
            'class' => yii\rbac\DbManager::class,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'sitemap.xml' => 'seo/sitemap',
                'login' => 'user/security/login',
                'logout' => 'user/security/logout',
                'profile' => 'profile/index',
                'profile/<action:[\w-]+>' => 'profile/<action>',
                'sistema/contratos' => 'contrato/index',
                'sistema/contratos/<action:[\w-]+>' => 'contrato/<action>',
                'sistema/novedades' => 'novedad/index',
                'sistema/novedades/<action:[\w-]+>' => 'novedad/<action>',
                'sistema/novedad-conceptos' => 'novedad-concepto-empresa/index',
                'sistema/novedad-conceptos/<action:[\w-]+>' => 'novedad-concepto-empresa/<action>',
                'sistema/novedad' => 'novedad/index',
                'sistema/novedad/<action:[\w-]+>' => 'novedad/<action>',
                'novedad/<action:[\w-]+>' => 'novedad/<action>',
                'sistema/requisicion' => 'requisicion/index',
                'sistema/requisicion/<action:[\w-]+>' => 'requisicion/<action>',
                'sistema/soporte/tickets' => 'support-ticket/index',
                'sistema/soporte/tickets/create' => 'support-ticket/create',
                'sistema/soporte/ticket' => 'support-ticket/view',
                'support-ticket/<action:[\w-]+>' => 'support-ticket/<action>',
                'sistema/presupuesto' => 'presupuesto/index',
                'sistema/presupuesto/<action:[\w-]+>' => 'presupuesto/<action>',
                'sistema/empleados' => 'empleados/index',
                'sistema/empleados/<action:[\w-]+>' => 'empleados/<action>',
                'mallas/list' => 'mallas/index',
                'mallas/crear' => 'mallas/create',
                'mallas/view' => 'mallas/view',
                'mallas/cargo-asignacion' => 'malla-cargo-asignacion/index',
                'mallas/profile-asignacion' => 'malla-profile-asignacion/index',
                'usuarios' => 'user-management/index',
                'usuarios/roles' => 'rbac/roles',
                'usuarios/permisos' => 'rbac/permissions',
                'usuarios/<action:[\w-]+>' => 'user-management/<action>',
                'reclutamiento/candidatos' => 'candidatos/index',
                'reclutamiento/candidatos/<action:[\w-]+>' => 'candidatos/<action>',
                'configuracion/areas' => 'area/index',
                'configuracion/areas/<action:[\w-]+>' => 'area/<action>',
                'configuracion/sedes' => 'location-sedes/index',
                'configuracion/sedes/<action:[\w-]+>' => 'location-sedes/<action>',
                'configuracion/categoria-sedes' => 'location-sedes-category/index',
                'configuracion/categoria-sedes/<action:[\w-]+>' => 'location-sedes-category/<action>',
                'configuracion/cargos' => 'cargos/index',
                'configuracion/cargos/<action:[\w-]+>' => 'cargos/<action>',
                'configuracion/contratos' => 'contrato-tipos/index',
                'configuracion/contratos/<action:[\w-]+>' => 'contrato-tipos/<action>',
                'configuracion/novedad-flujo' => 'novedad-flujo/index',
                'configuracion/novedad-flujo/<action:[\w-]+>' => 'novedad-flujo/<action>',
                'configuracion/novedad-tipo' => 'novedad-tipo/index',
                'configuracion/novedad-tipo/<action:[\w-]+>' => 'novedad-tipo/<action>',
            ],
        ],

    ],
    'modules' => [
        'user' => [
            'class' => Da\User\Module::class,
            'administrators' => ['admin'],
            'viewPath' => '@app/views/user',
            'enableRegistration' => true,
            'enableEmailConfirmation' => false,
            'allowPasswordRecovery' => true,
            'enableFlashMessages' => true,
            'mailParams' => [
                'fromEmail' => 'noreply@' . ($_SERVER['HTTP_HOST'] ?? 'localhost'),
                'welcomeMailSubject' => 'Bienvenido',
            ],
            'classMap' => [
                'User' => app\models\User::class,
                'Profile' => app\models\Profile::class,
            ],
            'controllerMap' => [
                'admin' => app\controllers\user\AdminController::class,
                'security' => app\controllers\user\SecurityController::class,
                'role' => app\controllers\user\RoleController::class,
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
