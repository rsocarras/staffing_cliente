<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Pivote: sedes asignadas a un perfil (`profile_id` → columna en `profile` según FK, ver {@see Profile::profileSedePivotReferencedProfileColumn()}).
 *
 * @property int $id
 * @property int $profile_id
 * @property int $location_sede_id
 * @property string $created_at
 *
 * @property Profile $profile
 * @property LocationSedes $locationSede
 */
class ProfileSede extends ActiveRecord
{
    public static function tableName()
    {
        return 'profile_sedes';
    }

    public function rules()
    {
        return [
            [['profile_id', 'location_sede_id'], 'required'],
            [['profile_id', 'location_sede_id'], 'integer'],
            [['created_at'], 'safe'],
            [['profile_id'], 'validateProfileId'],
            [['location_sede_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocationSedes::class, 'targetAttribute' => ['location_sede_id' => 'id']],
        ];
    }

    public function validateProfileId(string $attribute): void
    {
        $v = (int) $this->$attribute;
        if ($v <= 0) {
            return;
        }
        $schema = Profile::getTableSchema();
        if ($schema !== null && isset($schema->columns['id']) && Profile::find()->where(['id' => $v])->exists()) {
            return;
        }
        if (Profile::find()->where(['user_id' => $v])->exists()) {
            return;
        }
        $this->addError($attribute, 'El perfil indicado no existe.');
    }

    public function getProfile()
    {
        $fk = Profile::profileSedePivotReferencedProfileColumn();

        return $this->hasOne(Profile::class, [$fk => 'profile_id']);
    }

    public function getLocationSede()
    {
        return $this->hasOne(LocationSedes::class, ['id' => 'location_sede_id']);
    }

    /**
     * IDs de sedes asignadas leyendo por los posibles `profile_id` del perfil (compat. migraciones).
     *
     * @return int[]
     */
    public static function locationSedeIdsForProfileModel(Profile $profile): array
    {
        $pids = $profile->profileSedePivotProfileIdCandidates();
        if ($pids === []) {
            return [];
        }

        $rows = static::find()
            ->select('location_sede_id')
            ->where(['profile_id' => $pids])
            ->column();

        return array_values(array_unique(array_map('intval', $rows)));
    }

    /**
     * @deprecated Preferir {@see locationSedeIdsForProfileModel()} con el AR Profile.
     * @param int $profileId Valor exacto almacenado en `profile_sedes.profile_id`
     * @return int[]
     */
    public static function locationSedeIdsForProfile(int $profileId): array
    {
        $ids = static::find()
            ->select('location_sede_id')
            ->where(['profile_id' => $profileId])
            ->column();

        return array_values(array_unique(array_map('intval', $ids)));
    }
}
