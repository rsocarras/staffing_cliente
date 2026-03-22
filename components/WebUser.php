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
        $this->refreshTenantState($identity);
    }

    protected function afterLogout($identity)
    {
        parent::afterLogout($identity);
        Yii::$app->session->remove(self::STATE_EMPRESA_ID);
    }

    public function refreshTenantState(?IdentityInterface $identity = null): ?int
    {
        $empresaId = $this->extractEmpresaId($identity ?? $this->identity);
        if ($empresaId === null) {
            Yii::$app->session->remove(self::STATE_EMPRESA_ID);
            return null;
        }

        Yii::$app->session->set(self::STATE_EMPRESA_ID, $empresaId);
        return $empresaId;
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

        return $this->refreshTenantState();
    }

    private function extractEmpresaId(?IdentityInterface $identity): ?int
    {
        if ($identity === null) {
            return null;
        }

        if (isset($identity->empresas_id) && (int) $identity->empresas_id > 0) {
            return (int) $identity->empresas_id;
        }

        try {
            $profile = $identity->profile ?? null;
        } catch (\Throwable $exception) {
            $profile = null;
        }

        if ($profile !== null && isset($profile->empresas_id) && (int) $profile->empresas_id > 0) {
            return (int) $profile->empresas_id;
        }

        return null;
    }
}
