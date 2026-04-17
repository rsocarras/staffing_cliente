<?php

declare(strict_types=1);

namespace app\models;

use Throwable;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Json;

/**
 * Historial de cambios en tablas (vía ActiveRecord en la app web).
 *
 * @property int $id
 * @property string $table_name
 * @property string $record_pk JSON con la clave primaria
 * @property string $action insert|update|delete
 * @property string|null $old_values JSON fila anterior (null en insert)
 * @property string|null $new_values JSON fila nueva (null en delete)
 * @property int|null $user_id
 * @property string|null $username
 * @property string|null $ip
 * @property string|null $request_route
 * @property string $created_at
 */
class AuditLog extends ActiveRecord
{
    public const ACTION_INSERT = 'insert';

    public const ACTION_UPDATE = 'update';

    public const ACTION_DELETE = 'delete';

    public static function tableName(): string
    {
        return '{{%audit_log}}';
    }

    public function rules(): array
    {
        return [
            [['table_name', 'record_pk', 'action', 'created_at'], 'required'],
            [['old_values', 'new_values'], 'string'],
            [['user_id'], 'integer'],
            [['table_name'], 'string', 'max' => 191],
            [['action'], 'string', 'max' => 16],
            [['username'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 45],
            [['request_route'], 'string', 'max' => 255],
            [['created_at'], 'safe'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'table_name' => Yii::t('app', 'Tabla'),
            'record_pk' => Yii::t('app', 'Clave del registro'),
            'action' => Yii::t('app', 'Acción'),
            'old_values' => Yii::t('app', 'Valores anteriores'),
            'new_values' => Yii::t('app', 'Valores nuevos'),
            'user_id' => Yii::t('app', 'Usuario (ID)'),
            'username' => Yii::t('app', 'Usuario'),
            'ip' => 'IP',
            'request_route' => Yii::t('app', 'Ruta'),
            'created_at' => Yii::t('app', 'Fecha'),
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function actionOptions(): array
    {
        return [
            self::ACTION_INSERT => Yii::t('app', 'Crear'),
            self::ACTION_UPDATE => Yii::t('app', 'Modificación'),
            self::ACTION_DELETE => Yii::t('app', 'Eliminar'),
        ];
    }

    public function getActionLabel(): string
    {
        return self::actionOptions()[$this->action] ?? $this->action;
    }

    /**
     * @return array<string, mixed>
     */
    public static function decodeValuesJson(?string $json): array
    {
        if ($json === null || $json === '') {
            return [];
        }
        try {
            $decoded = Json::decode($json, true);

            return is_array($decoded) ? $decoded : [];
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * Resume el contenido a mostrar: solo lo relevante por tipo de acción.
     *
     * @return array{
     *   kind: 'insert'|'update'|'delete',
     *   insert_fields?: array<string, mixed>,
     *   delete_fields?: array<string, mixed>,
     *   update_changes?: list<array{attribute: string, old: mixed, new: mixed}>
     * }
     */
    public static function buildDiffPresentation(self $log): array
    {
        $old = self::decodeValuesJson($log->old_values);
        $new = self::decodeValuesJson($log->new_values);

        if ($log->action === self::ACTION_INSERT) {
            $insertFields = [];
            foreach ($new as $k => $v) {
                if ($v === null) {
                    continue;
                }
                $insertFields[$k] = $v;
            }
            if ($insertFields === [] && $new !== []) {
                $insertFields = $new;
            }

            return [
                'kind' => 'insert',
                'insert_fields' => $insertFields,
            ];
        }

        if ($log->action === self::ACTION_DELETE) {
            $deleteFields = [];
            foreach ($old as $k => $v) {
                if ($v === null) {
                    continue;
                }
                $deleteFields[$k] = $v;
            }
            if ($deleteFields === [] && $old !== []) {
                $deleteFields = $old;
            }

            return [
                'kind' => 'delete',
                'delete_fields' => $deleteFields,
            ];
        }

        $changes = [];
        $keys = array_values(array_unique(array_merge(array_keys($old), array_keys($new))));
        sort($keys, SORT_STRING);
        foreach ($keys as $key) {
            $hasOld = array_key_exists($key, $old);
            $hasNew = array_key_exists($key, $new);
            $ov = $hasOld ? $old[$key] : null;
            $nv = $hasNew ? $new[$key] : null;
            if (!$hasOld && $hasNew) {
                $changes[] = ['attribute' => $key, 'old' => null, 'new' => $nv];

                continue;
            }
            if ($hasOld && !$hasNew) {
                $changes[] = ['attribute' => $key, 'old' => $ov, 'new' => null];

                continue;
            }
            if ($hasOld && $hasNew && !self::valuesAreEqual($ov, $nv)) {
                $changes[] = ['attribute' => $key, 'old' => $ov, 'new' => $nv];
            }
        }

        return [
            'kind' => 'update',
            'update_changes' => $changes,
        ];
    }

    private static function valuesAreEqual(mixed $a, mixed $b): bool
    {
        try {
            return Json::encode($a, JSON_UNESCAPED_UNICODE) === Json::encode($b, JSON_UNESCAPED_UNICODE);
        } catch (Throwable) {
            return $a === $b;
        }
    }
}
