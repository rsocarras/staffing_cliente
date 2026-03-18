<?php

namespace app\controllers\user;

use Da\User\Controller\SecurityController as BaseSecurityController;

/**
 * Extiende SecurityController de yii2-usuario para usar layout de login.
 */
class SecurityController extends BaseSecurityController
{
    /**
     * Layout sin sidebar/topbar para páginas de autenticación.
     */
    public $layout = '@app/views/layouts/auth_main';
}
