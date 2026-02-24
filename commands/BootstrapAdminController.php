<?php

namespace app\commands;

use Da\User\Model\User;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

/**
 * Comando para crear el usuario administrador inicial.
 * Ejecutar: php yii bootstrap-admin/create [email] [username] [password]
 *
 * Ejemplo: php yii bootstrap-admin/create admin@example.com admin MiPasswordSeguro
 *
 * Si no se pasan argumentos, usa valores por defecto (cambiar en producción).
 */
class BootstrapAdminController extends Controller
{
    /**
     * Crea usuario admin + empresa inicial + perfil.
     *
     * @param string $email    Email del admin
     * @param string $username Username
     * @param string $password Contraseña (mínimo 8 caracteres recomendado)
     * @return int
     */
    public function actionCreate($email = 'admin@example.com', $username = 'admin', $password = 'AdminPass123')
    {
        $db = Yii::$app->db;

        if (User::find()->where(['username' => $username])->one()) {
            $this->stdout("El usuario '{$username}' ya existe.\n", Console::FG_YELLOW);
            return ExitCode::OK;
        }

        $transaction = $db->beginTransaction();
        try {
            $security = Yii::$app->security;
            $now = time();

            $db->createCommand()->insert('user', [
                'username' => $username,
                'email' => $email,
                'password_hash' => $security->generatePasswordHash($password),
                'auth_key' => $security->generateRandomString(32),
                'flags' => 0,
                'confirmed_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ])->execute();

            $userId = (int) $db->getLastInsertID();

            $empresaExists = $db->createCommand('SELECT id FROM empresas LIMIT 1')->queryScalar();
            if (!$empresaExists) {
                $slug = 'empresa-sistema-' . substr($security->generateRandomString(8), 0, 8);
                $db->createCommand()->insert('empresas', [
                    'name' => 'Empresa Sistema',
                    'idu' => $security->generateRandomString(36),
                    'user_owner' => $userId,
                    'slug' => $slug,
                ])->execute();
                $empresaId = (int) $db->getLastInsertID();
            } else {
                $empresaId = (int) $empresaExists;
            }

            $db->createCommand()->insert('profile', [
                'user_id' => $userId,
                'tipo_doc' => 'CC',
                'num_doc' => '0000000',
                'name' => $username,
                'empresas_id' => $empresaId,
                'estado' => 'activo',
            ])->execute();

            $auth = Yii::$app->getAuthManager();
            if ($auth) {
                $adminRole = $auth->getRole('administrator');
                if (!$adminRole) {
                    $adminRole = $auth->createRole('administrator');
                    $auth->add($adminRole);
                }
                $auth->assign($adminRole, $userId);
            }

            $transaction->commit();
            $this->stdout("Usuario '{$username}' creado correctamente.\n", Console::FG_GREEN);
            $this->stdout("Login: /user/security/login\n", Console::FG_CYAN);
        } catch (\Throwable $e) {
            $transaction->rollBack();
            $this->stdout("Error: " . $e->getMessage() . "\n", Console::FG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        return ExitCode::OK;
    }
}
