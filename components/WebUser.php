<?php

namespace app\components;

use Yii;
use yii\web\IdentityInterface;
use yii\web\User;

class WebUser extends User
{
    private const STATE_EMPRESA_ID = '__empresa_id';

    protected function afterLogin($identity, $cookieBased, $duration)
    {
        parent::afterLogin($identity, $cookieBased, $duration);
        Yii::$app->session->set(self::STATE_EMPRESA_ID, $this->extractEmpresaId($identity));
    }

    protected function afterLogout($identity)
    {
        parent::afterLogout($identity);
        Yii::$app->session->remove(self::STATE_EMPRESA_ID);
    }

    /**
     * Exponer empresa_id directo en sesión: Yii::$app->user->empresas_id
     */
    public function getEmpresas_id(): ?int
    {
        $value = Yii::$app->session->get(self::STATE_EMPRESA_ID, null);
        if ($value !== null && $value !== '') {
            return (int) $value;
        }

        if ($this->identity !== null) {
            $identityEmpresa = $this->extractEmpresaId($this->identity);
            if ($identityEmpresa !== null) {
                // Si no estaba cargado en estado de sesión, lo persistimos.
                Yii::$app->session->set(self::STATE_EMPRESA_ID, $identityEmpresa);
                return $identityEmpresa;
            }
        }

        return null;
    }

    private function extractEmpresaId(?IdentityInterface $identity): ?int
    {
        if ($identity === null) {
            return null;
        }

        if (isset($identity->empresas_id) && (int) $identity->empresas_id > 0) {
            return (int) $identity->empresas_id;
        }

        return null;
    }
}
