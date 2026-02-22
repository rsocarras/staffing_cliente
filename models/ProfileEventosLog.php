<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile_eventos_log".
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $profile_id
 * @property string $event_type
 * @property string|null $entity_type
 * @property int|null $entity_id
 * @property int|null $actor_user_id
 * @property string|null $before_json
 * @property string|null $after_json
 * @property string|null $contexto_json
 * @property string $created_at
 *
 * @property User $actorUser
 * @property Empresas $empresa
 * @property Profile $profile
 */
class ProfileEventosLog extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile_eventos_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_type', 'entity_id', 'actor_user_id', 'before_json', 'after_json', 'contexto_json'], 'default', 'value' => null],
            [['empresa_id', 'profile_id', 'event_type'], 'required'],
            [['empresa_id', 'profile_id', 'entity_id', 'actor_user_id'], 'integer'],
            [['before_json', 'after_json', 'contexto_json', 'created_at'], 'safe'],
            [['event_type'], 'string', 'max' => 120],
            [['entity_type'], 'string', 'max' => 80],
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
            'event_type' => 'Event Type',
            'entity_type' => 'Entity Type',
            'entity_id' => 'Entity ID',
            'actor_user_id' => 'Actor User ID',
            'before_json' => 'Before Json',
            'after_json' => 'After Json',
            'contexto_json' => 'Contexto Json',
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
