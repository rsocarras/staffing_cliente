<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property int $id
 * @property int $country_id
 * @property string $code
 * @property string $name
 * @property string|null $type
 * @property int|null $parent_region_id
 * @property int $is_active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property City[] $cities
 * @property LocationCountry $country
 * @property Region $parentRegion
 * @property Region[] $regions
 */
class Region extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'parent_region_id'], 'default', 'value' => null],
            [['is_active'], 'default', 'value' => 1],
            [['country_id', 'code', 'name'], 'required'],
            [['country_id', 'parent_region_id', 'is_active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['code'], 'string', 'max' => 12],
            [['name'], 'string', 'max' => 150],
            [['type'], 'string', 'max' => 60],
            [['country_id', 'code'], 'unique', 'targetAttribute' => ['country_id', 'code']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocationCountry::class, 'targetAttribute' => ['country_id' => 'id']],
            [['parent_region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::class, 'targetAttribute' => ['parent_region_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_id' => 'Country ID',
            'code' => 'Code',
            'name' => 'Name',
            'type' => 'Type',
            'parent_region_id' => 'Parent Region ID',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Cities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::class, ['region_id' => 'id']);
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(LocationCountry::class, ['id' => 'country_id']);
    }

    /**
     * Gets query for [[ParentRegion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParentRegion()
    {
        return $this->hasOne(Region::class, ['id' => 'parent_region_id']);
    }

    /**
     * Gets query for [[Regions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegions()
    {
        return $this->hasMany(Region::class, ['parent_region_id' => 'id']);
    }

}
