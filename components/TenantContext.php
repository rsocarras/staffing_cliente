<?php

namespace app\components;

use Yii;
use yii\web\ForbiddenHttpException;

final class TenantContext
{
    public static function currentEmpresaId(): ?int
    {
        $empresaId = Yii::$app->user->empresas_id ?? null;
        if ($empresaId === null || !is_numeric($empresaId) || (int) $empresaId <= 0) {
            return null;
        }

        return (int) $empresaId;
    }

    public static function requireEmpresaId(): int
    {
        $empresaId = static::currentEmpresaId();
        if ($empresaId === null) {
            throw new ForbiddenHttpException('No se pudo resolver la empresa actual de la sesión.');
        }

        return $empresaId;
    }

    public static function applyFilter($query, string $column = 'empresa_id', bool $allowGlobal = false)
    {
        $empresaId = static::currentEmpresaId();
        if ($empresaId === null) {
            $query->andWhere('0=1');
            return $query;
        }

        if ($allowGlobal) {
            $query->andWhere(['or', [$column => $empresaId], [$column => null]]);
            return $query;
        }

        $query->andWhere([$column => $empresaId]);
        return $query;
    }

    public static function matchesModel($model, string $attribute = 'empresa_id', bool $allowGlobal = false): bool
    {
        $empresaId = static::currentEmpresaId();
        if ($empresaId === null || !$model->hasAttribute($attribute)) {
            return false;
        }

        $value = $model->getAttribute($attribute);
        if ($allowGlobal && $value === null) {
            return true;
        }

        return (int) $value === $empresaId;
    }
}
