<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "staffing_planta_historial".
 *
 * @property int $id
 * @property int $planta_id
 * @property string $campo
 * @property string|null $valor_anterior
 * @property string|null $valor_nuevo
 * @property string $accion
 * @property int|null $user_id
 * @property string $created_at
 *
 * @property StaffingPlanta $planta
 * @property User $user
 */
class StaffingPlantaHistorial extends ActiveRecord
{
    public static function tableName()
    {
        return 'staffing_planta_historial';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function rules()
    {
        return [
            [['valor_anterior', 'valor_nuevo', 'user_id'], 'default', 'value' => null],
            [['planta_id', 'campo', 'accion'], 'required'],
            [['planta_id', 'user_id'], 'integer'],
            [['valor_anterior', 'valor_nuevo', 'created_at'], 'safe'],
            [['campo'], 'string', 'max' => 100],
            [['accion'], 'string', 'max' => 30],
            [['planta_id'], 'exist', 'skipOnError' => true, 'targetClass' => StaffingPlanta::class, 'targetAttribute' => ['planta_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'planta_id' => 'Registro de planta',
            'campo' => 'Campo',
            'valor_anterior' => 'Valor anterior',
            'valor_nuevo' => 'Valor nuevo',
            'accion' => 'Acción',
            'user_id' => 'Usuario',
            'created_at' => 'Fecha',
        ];
    }

    public static function registerChanges(StaffingPlanta $planta, $insert, array $changedAttributes)
    {
        $trackedFields = [
            'cantidad_autorizada',
            'location_sede_id',
            'area_id',
            'sub_area_id',
            'cargo_id',
            'activo',
        ];

        if ($insert) {
            foreach ($trackedFields as $field) {
                static::createLog($planta, $field, null, $planta->{$field}, 'create');
            }

            return;
        }

        foreach ($trackedFields as $field) {
            if (!array_key_exists($field, $changedAttributes)) {
                continue;
            }

            $oldValue = $changedAttributes[$field];
            $newValue = $planta->{$field};
            $action = 'update';

            if ($field === 'activo') {
                $action = (int) $newValue === 1 ? 'activate' : 'deactivate';
            }

            static::createLog($planta, $field, $oldValue, $newValue, $action);
        }
    }

    public function getPlanta()
    {
        return $this->hasOne(StaffingPlanta::class, ['id' => 'planta_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    private static function createLog(StaffingPlanta $planta, $field, $oldValue, $newValue, $action)
    {
        $log = new static();
        $log->planta_id = $planta->id;
        $log->campo = $field;
        $log->accion = $action;
        $log->user_id = \Yii::$app->user && !\Yii::$app->user->isGuest ? \Yii::$app->user->id : null;
        $log->valor_anterior = static::formatFieldValue($field, $oldValue);
        $log->valor_nuevo = static::formatFieldValue($field, $newValue);
        $log->save(false);
    }

    private static function formatFieldValue($field, $value)
    {
        if ($value === null || $value === '') {
            return null;
        }

        switch ($field) {
            case 'location_sede_id':
                $model = LocationSedes::findOne($value);
                return $model ? $model->nombre : (string) $value;
            case 'area_id':
            case 'sub_area_id':
                $model = Area::findOne($value);
                return $model ? $model->nombre : (string) $value;
            case 'cargo_id':
                $model = Cargos::findOne($value);
                return $model ? $model->nombre : (string) $value;
            case 'activo':
                return (int) $value === 1 ? 'Activo' : 'Inactivo';
            case 'cantidad_autorizada':
                return number_format((float) $value, 2, '.', '');
            default:
                return is_scalar($value) ? (string) $value : json_encode($value);
        }
    }
}
