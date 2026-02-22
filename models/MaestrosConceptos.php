<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "maestros_conceptos".
 *
 * @property int $id
 * @property int $empresa_id
 * @property string $code
 * @property string $name
 * @property string $category
 * @property int $active
 * @property string|null $config_json
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ConceptoIntegracionMap[] $conceptoIntegracionMaps
 * @property NominaItem[] $nominaItems
 */
class MaestrosConceptos extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const CATEGORY_INGRESO = 'ingreso';
    const CATEGORY_DEDUCCION = 'deduccion';
    const CATEGORY_APORTE = 'aporte';
    const CATEGORY_PROVISION = 'provision';
    const CATEGORY_OTRO = 'otro';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'maestros_conceptos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['config_json'], 'default', 'value' => null],
            [['category'], 'default', 'value' => 'otro'],
            [['active'], 'default', 'value' => 1],
            [['empresa_id', 'code', 'name'], 'required'],
            [['empresa_id', 'active'], 'integer'],
            [['category'], 'string'],
            [['config_json', 'created_at', 'updated_at'], 'safe'],
            [['code'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 190],
            ['category', 'in', 'range' => array_keys(self::optsCategory())],
            [['empresa_id', 'code'], 'unique', 'targetAttribute' => ['empresa_id', 'code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'empresa_id' => 'Empresa ID',
            'code' => 'Code',
            'name' => 'Name',
            'category' => 'Category',
            'active' => 'Active',
            'config_json' => 'Config Json',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[ConceptoIntegracionMaps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConceptoIntegracionMaps()
    {
        return $this->hasMany(ConceptoIntegracionMap::class, ['concepto_id' => 'id']);
    }

    /**
     * Gets query for [[NominaItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNominaItems()
    {
        return $this->hasMany(NominaItem::class, ['concepto_id' => 'id']);
    }


    /**
     * column category ENUM value labels
     * @return string[]
     */
    public static function optsCategory()
    {
        return [
            self::CATEGORY_INGRESO => 'ingreso',
            self::CATEGORY_DEDUCCION => 'deduccion',
            self::CATEGORY_APORTE => 'aporte',
            self::CATEGORY_PROVISION => 'provision',
            self::CATEGORY_OTRO => 'otro',
        ];
    }

    /**
     * @return string
     */
    public function displayCategory()
    {
        return self::optsCategory()[$this->category];
    }

    /**
     * @return bool
     */
    public function isCategoryIngreso()
    {
        return $this->category === self::CATEGORY_INGRESO;
    }

    public function setCategoryToIngreso()
    {
        $this->category = self::CATEGORY_INGRESO;
    }

    /**
     * @return bool
     */
    public function isCategoryDeduccion()
    {
        return $this->category === self::CATEGORY_DEDUCCION;
    }

    public function setCategoryToDeduccion()
    {
        $this->category = self::CATEGORY_DEDUCCION;
    }

    /**
     * @return bool
     */
    public function isCategoryAporte()
    {
        return $this->category === self::CATEGORY_APORTE;
    }

    public function setCategoryToAporte()
    {
        $this->category = self::CATEGORY_APORTE;
    }

    /**
     * @return bool
     */
    public function isCategoryProvision()
    {
        return $this->category === self::CATEGORY_PROVISION;
    }

    public function setCategoryToProvision()
    {
        $this->category = self::CATEGORY_PROVISION;
    }

    /**
     * @return bool
     */
    public function isCategoryOtro()
    {
        return $this->category === self::CATEGORY_OTRO;
    }

    public function setCategoryToOtro()
    {
        $this->category = self::CATEGORY_OTRO;
    }
}
