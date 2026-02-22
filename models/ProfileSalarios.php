<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile_salarios".
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $profile_id
 * @property string $fecha_efectiva
 * @property float $salario_base
 * @property string $moneda
 * @property string|null $motivo
 * @property int|null $actor_user_id
 * @property string $created_at
 *
 * @property User $actorUser
 * @property Empresas $empresa
 * @property Profile $profile
 */
class ProfileSalarios extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile_salarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['motivo', 'actor_user_id'], 'default', 'value' => null],
            [['moneda'], 'default', 'value' => 'COP'],
            [['empresa_id', 'profile_id', 'fecha_efectiva', 'salario_base'], 'required'],
            [['empresa_id', 'profile_id', 'actor_user_id'], 'integer'],
            [['fecha_efectiva', 'created_at'], 'safe'],
            [['salario_base'], 'number'],
            [['moneda'], 'string', 'max' => 3],
            [['motivo'], 'string', 'max' => 255],
            [['actor_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['actor_user_id' => 'id']],
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
            'salario_base' => 'Salario Base',
            'moneda' => 'Moneda',
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
