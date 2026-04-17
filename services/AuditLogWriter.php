<?php

declare(strict_types=1);

namespace app\services;

use Throwable;
use Yii;
use yii\db\Connection;
use yii\helpers\Json;
use yii\web\Application as WebApplication;

/**
 * Persiste filas en {@see \app\models\AuditLog} sin usar ActiveRecord (evita bucles al auditar).
 */
final class AuditLogWriter
{
    private static ?bool $tableExists = null;

    public static function resetCacheForTests(): void
    {
        self::$tableExists = null;
    }

    public static function isTableAvailable(?Connection $db = null): bool
    {
        if (self::$tableExists !== null) {
            return self::$tableExists;
        }
        $conn = $db ?? Yii::$app->get('db', false);
        if (!$conn instanceof Connection) {
            self::$tableExists = false;

            return self::$tableExists;
        }
        try {
            self::$tableExists = $conn->schema->getTableSchema('{{%audit_log}}', true) !== null;
        } catch (Throwable) {
            self::$tableExists = false;
        }

        return self::$tableExists;
    }

    /**
     * @param array<string, mixed> $primaryKey
     * @param array<string, mixed>|null $oldRow
     * @param array<string, mixed>|null $newRow
     */
    public static function write(
        string $tableName,
        string $action,
        array $primaryKey,
        ?array $oldRow,
        ?array $newRow
    ): void {
        if (!self::isTableAvailable()) {
            return;
        }

        $app = Yii::$app;
        $userId = null;
        $username = null;
        $ip = null;
        $route = null;
        if ($app instanceof WebApplication) {
            if (!$app->user->isGuest) {
                $userId = (int) $app->user->id;
                $identity = $app->user->identity;
                if ($identity !== null) {
                    $username = (string) ($identity->username ?? $identity->email ?? '');
                    if ($username === '') {
                        $username = null;
                    }
                }
            }
            $ip = $app->request->getUserIP();
            $route = $app->requestedRoute ?? ($app->controller !== null ? $app->controller->route : null);
        }

        $redact = self::redactAttributeNames();
        $pkJson = self::encodeJson($primaryKey);
        $oldJson = $oldRow !== null ? self::encodeJson(self::redactRow($oldRow, $redact)) : null;
        $newJson = $newRow !== null ? self::encodeJson(self::redactRow($newRow, $redact)) : null;

        try {
            Yii::$app->db->createCommand()->insert('{{%audit_log}}', [
                'table_name' => $tableName,
                'record_pk' => $pkJson,
                'action' => $action,
                'old_values' => $oldJson,
                'new_values' => $newJson,
                'user_id' => $userId ?: null,
                'username' => $username,
                'ip' => $ip !== null && $ip !== '' ? $ip : null,
                'request_route' => $route,
            ])->execute();
        } catch (Throwable $e) {
            Yii::error('AuditLogWriter: ' . $e->getMessage(), __METHOD__);
        }
    }

    /**
     * @return list<string>
     */
    private static function redactAttributeNames(): array
    {
        $fromParams = Yii::$app->params['auditLog']['redactAttributes'] ?? [];
        $extra = is_array($fromParams) ? $fromParams : [];

        return array_values(array_unique(array_merge(
            [
                'password_hash',
                'auth_key',
                'password_reset_token',
                'access_token',
                'otp_secret',
            ],
            array_map('strval', $extra)
        )));
    }

    /**
     * @param array<string, mixed> $row
     * @param list<string> $names
     * @return array<string, mixed>
     */
    private static function redactRow(array $row, array $names): array
    {
        foreach ($names as $name) {
            if (array_key_exists($name, $row)) {
                $row[$name] = '[REDACTED]';
            }
        }

        return $row;
    }

    /**
     * @param array<string, mixed> $data
     */
    private static function encodeJson(array $data): string
    {
        try {
            return Json::encode($data);
        } catch (Throwable) {
            return '{"_error":"encode_failed"}';
        }
    }
}
