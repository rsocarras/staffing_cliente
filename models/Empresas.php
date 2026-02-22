<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empresas".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $social_name
 * @property int|null $entity
 * @property string|null $ref_int
 * @property string|null $ref_ext
 * @property int|null $status
 * @property string $tms
 * @property string|null $datec
 * @property string|null $dateu
 * @property string|null $code
 * @property string|null $address
 * @property string|null $url
 * @property string|null $twitter
 * @property string|null $instagram
 * @property string|null $phone_1
 * @property string|null $phone_2
 * @property string|null $email
 * @property string|null $description_s
 * @property string|null $description_l
 * @property string $idu
 * @property int|null $supplier_only
 * @property string|null $slug
 * @property int $user_owner
 *
 * @property ArchivoLink[] $archivoLinks
 * @property Archivos[] $archivos
 * @property Area[] $areas
 * @property ConceptoIntegracionMap[] $conceptoIntegracionMaps
 * @property EmpleadoVenueHistory[] $empleadoVenueHistories
 * @property IntegrationLog[] $integrationLogs
 * @property MallaDistribucionHoras[] $mallaDistribucionHoras
 * @property NominaItem[] $nominaItems
 * @property NominaRun[] $nominaRuns
 * @property NovedadTipo[] $novedadTipos
 * @property Novedad[] $novedads
 * @property PlanillaError[] $planillaErrors
 * @property PlanillaImport[] $planillaImports
 * @property ProfileEventosLog[] $profileEventosLogs
 * @property ProfileSalarios[] $profileSalarios
 * @property Profile[] $profiles
 * @property User[] $users
 */
class Empresas extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empresas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'social_name', 'entity', 'ref_int', 'ref_ext', 'status', 'datec', 'dateu', 'code', 'address', 'url', 'twitter', 'instagram', 'phone_1', 'phone_2', 'email', 'description_s', 'description_l', 'slug'], 'default', 'value' => null],
            [['supplier_only'], 'default', 'value' => 0],
            [['entity', 'status', 'supplier_only', 'user_owner'], 'integer'],
            [['tms', 'datec', 'dateu'], 'safe'],
            [['description_l'], 'string'],
            [['idu', 'user_owner'], 'required'],
            [['name', 'social_name', 'address', 'url', 'slug'], 'string', 'max' => 245],
            [['ref_int'], 'string', 'max' => 60],
            [['ref_ext', 'email'], 'string', 'max' => 128],
            [['code', 'idu'], 'string', 'max' => 36],
            [['twitter', 'instagram'], 'string', 'max' => 45],
            [['phone_1', 'phone_2'], 'string', 'max' => 20],
            [['description_s'], 'string', 'max' => 140],
            [['slug'], 'unique'],
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
            'social_name' => 'Social Name',
            'entity' => 'Entity',
            'ref_int' => 'Ref Int',
            'ref_ext' => 'Ref Ext',
            'status' => 'Status',
            'tms' => 'Tms',
            'datec' => 'Datec',
            'dateu' => 'Dateu',
            'code' => 'Code',
            'address' => 'Address',
            'url' => 'Url',
            'twitter' => 'Twitter',
            'instagram' => 'Instagram',
            'phone_1' => 'Phone 1',
            'phone_2' => 'Phone 2',
            'email' => 'Email',
            'description_s' => 'Description S',
            'description_l' => 'Description L',
            'idu' => 'Idu',
            'supplier_only' => 'Supplier Only',
            'slug' => 'Slug',
            'user_owner' => 'User Owner',
        ];
    }

    /**
     * Gets query for [[ArchivoLinks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArchivoLinks()
    {
        return $this->hasMany(ArchivoLink::class, ['empresa_id' => 'id']);
    }

    /**
     * Gets query for [[Archivos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArchivos()
    {
        return $this->hasMany(Archivos::class, ['empresa_id' => 'id']);
    }

    /**
     * Gets query for [[Areas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAreas()
    {
        return $this->hasMany(Area::class, ['empresas_id' => 'id']);
    }

    /**
     * Gets query for [[ConceptoIntegracionMaps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConceptoIntegracionMaps()
    {
        return $this->hasMany(ConceptoIntegracionMap::class, ['empresa_id' => 'id']);
    }

    /**
     * Gets query for [[EmpleadoVenueHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleadoVenueHistories()
    {
        return $this->hasMany(EmpleadoVenueHistory::class, ['empresa_id' => 'id']);
    }

    /**
     * Gets query for [[IntegrationLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIntegrationLogs()
    {
        return $this->hasMany(IntegrationLog::class, ['empresa_id' => 'id']);
    }

    /**
     * Gets query for [[MallaDistribucionHoras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMallaDistribucionHoras()
    {
        return $this->hasMany(MallaDistribucionHoras::class, ['empresa_id' => 'id']);
    }

    /**
     * Gets query for [[NominaItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNominaItems()
    {
        return $this->hasMany(NominaItem::class, ['empresa_id' => 'id']);
    }

    /**
     * Gets query for [[NominaRuns]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNominaRuns()
    {
        return $this->hasMany(NominaRun::class, ['empresa_id' => 'id']);
    }

    /**
     * Gets query for [[NovedadTipos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNovedadTipos()
    {
        return $this->hasMany(NovedadTipo::class, ['empresa_id' => 'id']);
    }

    /**
     * Gets query for [[Novedads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNovedads()
    {
        return $this->hasMany(Novedad::class, ['empresa_id' => 'id']);
    }

    /**
     * Gets query for [[PlanillaErrors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlanillaErrors()
    {
        return $this->hasMany(PlanillaError::class, ['empresa_id' => 'id']);
    }

    /**
     * Gets query for [[PlanillaImports]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlanillaImports()
    {
        return $this->hasMany(PlanillaImport::class, ['empresa_id' => 'id']);
    }

    /**
     * Gets query for [[ProfileEventosLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfileEventosLogs()
    {
        return $this->hasMany(ProfileEventosLog::class, ['empresa_id' => 'id']);
    }

    /**
     * Gets query for [[ProfileSalarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfileSalarios()
    {
        return $this->hasMany(ProfileSalarios::class, ['empresa_id' => 'id']);
    }

    /**
     * Gets query for [[Profiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::class, ['empresas_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['empresas_id' => 'id']);
    }

}
