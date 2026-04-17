<?php

declare(strict_types=1);

namespace app\bootstrap;

use app\models\AuditLog;
use app\services\AuditLogWriter;
use Throwable;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\db\ActiveRecord;
use yii\web\Application as WebApplication;

/**
 * Registra listeners globales en {@see ActiveRecord} para auditar INSERT / UPDATE / DELETE.
 *
 * Solo tiene efecto en {@see WebApplication} y si existe la tabla `audit_log`.
 */
final class ActiveRecordAuditBootstrap implements BootstrapInterface
{
    /** @var array<int, array<string, mixed>> */
    private static array $updateOldByOid = [];

    /** @var array<int, array<string, mixed>> */
    private static array $deleteOldByOid = [];

    public function bootstrap($app): void
    {
        if (!$app instanceof WebApplication) {
            return;
        }

        Event::on(ActiveRecord::class, ActiveRecord::EVENT_BEFORE_UPDATE, static function (Event $event): void {
            try {
                $model = $event->sender;
                if (!$model instanceof ActiveRecord || !self::shouldAudit($model)) {
                    return;
                }
                $oid = spl_object_id($model);
                self::$updateOldByOid[$oid] = $model->getOldAttributes();
            } catch (Throwable) {
                // no bloquear guardado
            }
        });

        Event::on(ActiveRecord::class, ActiveRecord::EVENT_AFTER_UPDATE, static function (Event $event): void {
            try {
                $model = $event->sender;
                if (!$model instanceof ActiveRecord || !self::shouldAudit($model)) {
                    return;
                }
                $oid = spl_object_id($model);
                $old = self::$updateOldByOid[$oid] ?? $model->getOldAttributes();
                unset(self::$updateOldByOid[$oid]);
                $schema = $model->getTableSchema();
                $table = $schema !== null ? $schema->name : $model::tableName();
                AuditLogWriter::write(
                    $table,
                    'update',
                    $model->getPrimaryKey(true),
                    $old,
                    $model->getAttributes()
                );
            } catch (Throwable) {
                // no bloquear guardado
            }
        });

        Event::on(ActiveRecord::class, ActiveRecord::EVENT_AFTER_INSERT, static function (Event $event): void {
            try {
                $model = $event->sender;
                if (!$model instanceof ActiveRecord || !self::shouldAudit($model)) {
                    return;
                }
                $schema = $model->getTableSchema();
                $table = $schema !== null ? $schema->name : $model::tableName();
                AuditLogWriter::write(
                    $table,
                    'insert',
                    $model->getPrimaryKey(true),
                    null,
                    $model->getAttributes()
                );
            } catch (Throwable) {
            }
        });

        Event::on(ActiveRecord::class, ActiveRecord::EVENT_BEFORE_DELETE, static function (Event $event): void {
            try {
                $model = $event->sender;
                if (!$model instanceof ActiveRecord || !self::shouldAudit($model)) {
                    return;
                }
                $oid = spl_object_id($model);
                self::$deleteOldByOid[$oid] = $model->getAttributes();
            } catch (Throwable) {
            }
        });

        Event::on(ActiveRecord::class, ActiveRecord::EVENT_AFTER_DELETE, static function (Event $event): void {
            try {
                $model = $event->sender;
                if (!$model instanceof ActiveRecord || !self::shouldAudit($model)) {
                    return;
                }
                $oid = spl_object_id($model);
                $old = self::$deleteOldByOid[$oid] ?? [];
                unset(self::$deleteOldByOid[$oid]);
                $schema = $model->getTableSchema();
                $table = $schema !== null ? $schema->name : $model::tableName();
                AuditLogWriter::write(
                    $table,
                    'delete',
                    $model->getPrimaryKey(true),
                    $old,
                    null
                );
            } catch (Throwable) {
            }
        });
    }

    private static function shouldAudit(ActiveRecord $model): bool
    {
        if (!AuditLogWriter::isTableAvailable()) {
            return false;
        }
        if ($model instanceof AuditLog) {
            return false;
        }
        $excluded = Yii::$app->params['auditLog']['excludedTables'] ?? [];
        if (!is_array($excluded)) {
            $excluded = [];
        }
        $schema = $model->getTableSchema();
        $physical = $schema !== null ? $schema->name : null;
        if ($physical !== null && in_array($physical, $excluded, true)) {
            return false;
        }

        return true;
    }
}
