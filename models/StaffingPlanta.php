<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "staffing_planta".
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $location_sede_id
 * @property int $area_id
 * @property int $sub_area_id
 * @property int $cargo_id
 * @property float $cantidad_autorizada
 * @property int $activo
 * @property string $created_at
 * @property string $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Area $area
 * @property Cargos $cargo
 * @property Empresas $empresa
 * @property StaffingPlantaHistorial[] $historiales
 * @property LocationSedes $locationSede
 * @property Area $subArea
 * @property User $createdBy
 * @property User $updatedBy
 */
class StaffingPlanta extends ActiveRecord
{
    public static function tableName()
    {
        return 'staffing_planta';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    public function rules()
    {
        return [
            [['activo'], 'default', 'value' => 1],
            [['created_by', 'updated_by'], 'default', 'value' => null],
            [['empresa_id', 'location_sede_id', 'area_id', 'sub_area_id', 'cargo_id', 'cantidad_autorizada'], 'required'],
            [['empresa_id', 'area_id', 'sub_area_id', 'activo', 'created_by', 'updated_by'], 'integer'],
            [['location_sede_id', 'cargo_id'], 'integer'],
            [['cantidad_autorizada'], 'number', 'min' => 0],
            [['created_at', 'updated_at'], 'safe'],
            [['location_sede_id', 'area_id', 'sub_area_id', 'cargo_id'], 'validateTenantConsistency'],
            [['sub_area_id'], 'validateSubArea'],
            [['cargo_id'], 'validateTenantConsistency'],
            [['empresa_id', 'location_sede_id', 'area_id', 'sub_area_id', 'cargo_id'], 'unique', 'targetAttribute' => ['empresa_id', 'location_sede_id', 'area_id', 'sub_area_id', 'cargo_id']],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresa_id' => 'id']],
            [['location_sede_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocationSedes::class, 'targetAttribute' => ['location_sede_id' => 'id']],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => Area::class, 'targetAttribute' => ['area_id' => 'id']],
            [['sub_area_id'], 'exist', 'skipOnError' => true, 'targetClass' => Area::class, 'targetAttribute' => ['sub_area_id' => 'id']],
            [['cargo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cargos::class, 'targetAttribute' => ['cargo_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'empresa_id' => 'Empresa',
            'location_sede_id' => 'Sede',
            'area_id' => 'Área',
            'sub_area_id' => 'Subárea',
            'cargo_id' => 'Cargo',
            'cantidad_autorizada' => 'Planta autorizada',
            'activo' => 'Activo',
            'created_at' => 'Creado el',
            'updated_at' => 'Actualizado el',
            'created_by' => 'Creado por',
            'updated_by' => 'Actualizado por',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        StaffingPlantaHistorial::registerChanges($this, $insert, $changedAttributes);
    }

    public function validateSubArea($attribute)
    {
        if (empty($this->area_id) || empty($this->sub_area_id)) {
            return;
        }

        $subArea = $this->subArea ?: Area::findOne($this->sub_area_id);
        if ($subArea === null) {
            return;
        }

        if ((int) $subArea->id === (int) $this->area_id && !$this->areaHasChildren($this->area_id)) {
            return;
        }

        if ((int) $subArea->area_padre !== (int) $this->area_id) {
            $this->addError($attribute, 'La subárea debe pertenecer al área seleccionada.');
        }
    }

    public function validateTenantConsistency($attribute)
    {
        if (empty($this->empresa_id)) {
            return;
        }

        if ($attribute === 'location_sede_id' && !empty($this->location_sede_id)) {
            $sede = $this->locationSede ?: LocationSedes::findOne($this->location_sede_id);
            if ($sede !== null && (int) $sede->empresa_id !== (int) $this->empresa_id) {
                $this->addError($attribute, 'La sede debe pertenecer a la empresa actual.');
            }
        }

        if ($attribute === 'area_id' && !empty($this->area_id)) {
            $area = $this->area ?: Area::findOne($this->area_id);
            if ($area !== null && (int) $area->empresas_id !== (int) $this->empresa_id) {
                $this->addError($attribute, 'El área debe pertenecer a la empresa actual.');
            }
        }

        if ($attribute === 'sub_area_id' && !empty($this->sub_area_id)) {
            $subArea = $this->subArea ?: Area::findOne($this->sub_area_id);
            if ($subArea !== null && (int) $subArea->empresas_id !== (int) $this->empresa_id) {
                $this->addError($attribute, 'La subárea debe pertenecer a la empresa actual.');
            }
        }

        if ($attribute === 'cargo_id' && !empty($this->cargo_id)) {
            $cargo = $this->cargo ?: Cargos::findOne($this->cargo_id);
            if ($cargo !== null && (int) $cargo->empresa_id !== (int) $this->empresa_id) {
                $this->addError($attribute, 'El cargo debe pertenecer a la empresa actual.');
            }
        }
    }

    public function getCargoStructureWarning()
    {
        if ($this->cargo === null) {
            return null;
        }

        $messages = [];

        if ($this->cargo->area_id !== null && (int) $this->cargo->area_id !== (int) $this->area_id) {
            $messages[] = 'El cargo pertenece a un área distinta. Para analítica prevalecerá la planta capturada manualmente.';
        }

        if ($this->cargo->sub_area_id !== null && (int) $this->cargo->sub_area_id !== (int) $this->sub_area_id) {
            $messages[] = 'El cargo pertenece a una subárea distinta. Para analítica prevalecerá la planta capturada manualmente.';
        }

        return empty($messages) ? null : implode(' ', $messages);
    }

    public function getEmpresa()
    {
        return $this->hasOne(Empresas::class, ['id' => 'empresa_id']);
    }

    public function getLocationSede()
    {
        return $this->hasOne(LocationSedes::class, ['id' => 'location_sede_id']);
    }

    public function getArea()
    {
        return $this->hasOne(Area::class, ['id' => 'area_id']);
    }

    public function getSubArea()
    {
        return $this->hasOne(Area::class, ['id' => 'sub_area_id']);
    }

    public function getCargo()
    {
        return $this->hasOne(Cargos::class, ['id' => 'cargo_id']);
    }

    public function getHistoriales()
    {
        return $this->hasMany(StaffingPlantaHistorial::class, ['planta_id' => 'id'])
            ->orderBy(['created_at' => SORT_DESC, 'id' => SORT_DESC]);
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    public function getDimensionLabel()
    {
        return implode(' / ', array_filter([
            $this->locationSede ? $this->locationSede->nombre : null,
            $this->area ? $this->area->nombre : null,
            $this->subArea ? $this->subArea->nombre : null,
            $this->cargo ? $this->cargo->nombre : null,
        ]));
    }

    private function areaHasChildren($areaId)
    {
        return Area::find()->where(['area_padre' => $areaId])->exists();
    }
}
