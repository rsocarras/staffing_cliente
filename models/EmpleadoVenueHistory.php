<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empleado_venue_history".
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $profile_id
 * @property string $fecha_efectiva
 * @property int|null $sede_id
 * @property int|null $centro_costo_id
 * @property int|null $centro_utilidad_id
 * @property string|null $motivo
 * @property int|null $actor_user_id
 * @property string $created_at
 *
 * @property User $actorUser
 * @property ContabilidadCentroCosto $centroCosto
 * @property ContabilidadCentroUtilidad $centroUtilidad
 * @property Empresas $empresa
 * @property Profile $profile
 */
class EmpleadoVenueHistory extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empleado_venue_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sede_id', 'centro_costo_id', 'centro_utilidad_id', 'motivo', 'actor_user_id'], 'default', 'value' => null],
            [['empresa_id', 'profile_id', 'fecha_efectiva'], 'required'],
            [['empresa_id', 'profile_id', 'sede_id', 'centro_costo_id', 'centro_utilidad_id', 'actor_user_id'], 'integer'],
            [['fecha_efectiva', 'created_at'], 'safe'],
            [['motivo'], 'string', 'max' => 255],
            [['actor_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['actor_user_id' => 'id']],
            [['centro_costo_id'], 'exist', 'skipOnError' => true, 'targetClass' => ContabilidadCentroCosto::class, 'targetAttribute' => ['centro_costo_id' => 'id']],
            [['centro_utilidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => ContabilidadCentroUtilidad::class, 'targetAttribute' => ['centro_utilidad_id' => 'id']],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['profile_id' => 'user_id']],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresa_id' => 'id']],
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
            'profile_id' => 'Profile ID',
            'fecha_efectiva' => 'Fecha Efectiva',
            'sede_id' => 'Sede ID',
            'centro_costo_id' => 'Centro Costo ID',
            'centro_utilidad_id' => 'Centro Utilidad ID',
            'motivo' => 'Motivo',
            'actor_user_id' => 'Actor User ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[ActorUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getActorUser()
    {
        return $this->hasOne(User::class, ['id' => 'actor_user_id']);
    }

    /**
     * Gets query for [[CentroCosto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCentroCosto()
    {
        return $this->hasOne(ContabilidadCentroCosto::class, ['id' => 'centro_costo_id']);
    }

    /**
     * Gets query for [[CentroUtilidad]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCentroUtilidad()
    {
        return $this->hasOne(ContabilidadCentroUtilidad::class, ['id' => 'centro_utilidad_id']);
    }

    /**
     * Gets query for [[Empresa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa()
    {
        return $this->hasOne(Empresas::class, ['id' => 'empresa_id']);
    }

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'profile_id']);
    }

}
