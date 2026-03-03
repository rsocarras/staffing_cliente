<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "area".
 *
 * @property int $id
 * @property string|null $uuid
 * @property int $user_create
 * @property string|null $nombre
 * @property string|null $descripcion
 * @property int|null $area_padre
 * @property int $empresas_id
 * @property int|null $centro_utilidad
 * @property int|null $referencia_externa
 * @property int|null $centro_utilidad_staffing
 *
 * @property Area $areaPadre
 * @property Area[] $areas
 * @property Empresas $empresas
 * @property Profile[] $profiles
 * @property \Da\User\Model\User $userCreate
 */
class Area extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'area';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uuid', 'nombre', 'descripcion', 'area_padre', 'centro_utilidad', 'referencia_externa', 'centro_utilidad_staffing'], 'default', 'value' => null],
            [['nombre'], 'required'],
            [['user_create', 'area_padre', 'empresas_id', 'centro_utilidad', 'referencia_externa', 'centro_utilidad_staffing'], 'integer'],
            [['uuid'], 'string', 'max' => 36],
            [['nombre', 'descripcion'], 'string', 'max' => 45],
            [['area_padre'], 'exist', 'skipOnError' => true, 'targetClass' => Area::class, 'targetAttribute' => ['area_padre' => 'id']],
            [['empresas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresas_id' => 'id']],
            [['user_create'], 'exist', 'skipOnError' => true, 'targetClass' => \Da\User\Model\User::class, 'targetAttribute' => ['user_create' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uuid' => 'Uuid',
            'user_create' => 'User Create',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'area_padre' => 'Area Padre',
            'empresas_id' => 'Empresas ID',
            'centro_utilidad' => 'Centro de Utilidad',
            'referencia_externa' => 'Referencia Externa',
            'centro_utilidad_staffing' => 'Centro de Utilidad Staffing',
        ];
    }

    /**
     * Gets query for [[AreaPadre]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAreaPadre()
    {
        return $this->hasOne(Area::class, ['id' => 'area_padre']);
    }

    /**
     * Gets query for [[Areas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAreas()
    {
        return $this->hasMany(Area::class, ['area_padre' => 'id']);
    }

    /**
     * Gets query for [[Empresas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresas()
    {
        return $this->hasOne(Empresas::class, ['id' => 'empresas_id']);
    }

    /**
     * Gets query for [[Profiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::class, ['area_id' => 'id']);
    }

    /**
     * Gets query for [[UserCreate]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserCreate()
    {
        return $this->hasOne(\Da\User\Model\User::class, ['id' => 'user_create']);
    }

}
