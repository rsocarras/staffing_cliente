<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "location_country".
 *
 * @property int $id
 * @property string $name
 * @property string|null $official_name
 * @property string|null $common_name
 * @property string $iso_alpha2
 * @property string $iso_alpha3
 * @property string|null $iso_numeric
 * @property string|null $calling_code_primary
 * @property string|null $calling_codes
 * @property string|null $flag_emoji
 * @property string|null $flag_svg_url
 * @property string|null $flag_png_url
 * @property string|null $capital
 * @property string|null $region
 * @property string|null $subregion
 * @property string|null $currencies
 * @property string|null $languages
 * @property string|null $tld
 * @property string|null $timezones
 * @property int $is_active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property City[] $cities
 * @property Region[] $regions
 */
class LocationCountry extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'location_country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['official_name', 'common_name', 'iso_numeric', 'calling_code_primary', 'calling_codes', 'flag_emoji', 'flag_svg_url', 'flag_png_url', 'capital', 'region', 'subregion', 'currencies', 'languages', 'tld', 'timezones'], 'default', 'value' => null],
            [['is_active'], 'default', 'value' => 1],
            [['name', 'iso_alpha2', 'iso_alpha3'], 'required'],
            [['calling_codes', 'currencies', 'languages', 'tld', 'timezones', 'created_at', 'updated_at'], 'safe'],
            [['is_active'], 'integer'],
            [['name', 'capital', 'subregion'], 'string', 'max' => 100],
            [['official_name', 'common_name'], 'string', 'max' => 150],
            [['iso_alpha2'], 'string', 'max' => 2],
            [['iso_alpha3', 'iso_numeric'], 'string', 'max' => 3],
            [['calling_code_primary', 'flag_emoji'], 'string', 'max' => 8],
            [['flag_svg_url', 'flag_png_url'], 'string', 'max' => 255],
            [['region'], 'string', 'max' => 50],
            [['iso_alpha2'], 'unique'],
            [['iso_alpha3'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'official_name' => 'Official Name',
            'common_name' => 'Common Name',
            'iso_alpha2' => 'Iso Alpha2',
            'iso_alpha3' => 'Iso Alpha3',
            'iso_numeric' => 'Iso Numeric',
            'calling_code_primary' => 'Calling Code Primary',
            'calling_codes' => 'Calling Codes',
            'flag_emoji' => 'Flag Emoji',
            'flag_svg_url' => 'Flag Svg Url',
            'flag_png_url' => 'Flag Png Url',
            'capital' => 'Capital',
            'region' => 'Region',
            'subregion' => 'Subregion',
            'currencies' => 'Currencies',
            'languages' => 'Languages',
            'tld' => 'Tld',
            'timezones' => 'Timezones',
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
        return $this->hasMany(City::class, ['country_id' => 'id']);
    }

    /**
     * Gets query for [[Regions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegions()
    {
        return $this->hasMany(Region::class, ['country_id' => 'id']);
    }

}
