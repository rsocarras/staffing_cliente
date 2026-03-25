<?php

namespace app\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "profile".
 *
 * @property int $user_id
 * @property string $tipo_doc
 * @property string $num_doc
 * @property string|null $name
 * @property string|null $public_email
 * @property string|null $gravatar_email
 * @property string|null $gravatar_id
 * @property string|null $location
 * @property string|null $timezone
 * @property string|null $bio
 * @property string|null $sexo
 * @property int $empresas_id
 * @property string|null $about
 * @property string $estado
 * @property string|null $telefono
 * @property string|null $birthday
 * @property string|null $position
 * @property string|null $photo_
 * @property \yii\web\UploadedFile|null $photoFile Subida de imagen para el formulario (no persistida en BD)
 * @property string|null $instagram
 * @property string|null $tiktok
 * @property string|null $linkedin
 * @property string|null $youtube
 * @property string|null $website
 * @property string|null $address
 * @property string|null $data_json
 * @property int|null $sede_id
 * @property int|null $location_sede_id FK {@see LocationSedes} para reglas de novedad / gerente de sede
 * @property int|null $cargo_id
 * @property int|null $centro_costo_id
 * @property int|null $centro_utilidad_id
 * @property string|null $city
 * @property int|null $area_id
 *
 * @property Area $area
 * @property Cargos $cargo
 * @property ContabilidadCentroCosto $centroCosto
 * @property ContabilidadCentroUtilidad $centroUtilidad
 * @property EmpleadoVenueHistory[] $empleadoVenueHistories
 * @property Empresas $empresas
 * @property LocationSedes|null $locationSede
 * @property MallaDistribucionHoras[] $mallaDistribucionHoras
 * @property NominaItem[] $nominaItems
 * @property ProfileEventosLog[] $profileEventosLogs
 * @property ProfileSalarios[] $profileSalarios
 * @property Contrato[] $contratos
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /** @var \yii\web\UploadedFile|null Foto de perfil en formulario (no se persiste en BD) */
    public $photoFile;

    /**
     * ENUM field values
     */
    const TIPO_DOC_CC = 'CC';
    const TIPO_DOC_CE = 'CE';
    const TIPO_DOC_NIT = 'NIT';
    const TIPO_DOC_PAS = 'PAS';
    const TIPO_DOC_TI = 'TI';
    const TIPO_DOC_OTRO = 'OTRO';
    const SEXO_M = 'M';
    const SEXO_F = 'F';
    const SEXO_X = 'X';
    const ESTADO_ACTIVO = 'activo';
    const ESTADO_INACTIVO = 'inactivo';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->on(self::EVENT_BEFORE_VALIDATE, [$this, 'ensureUser']);
    }

    /**
     * Si es registro nuevo y no hay user_id (o el User no existe), crea el User y asigna user_id.
     */
    public function ensureUser(): void
    {
        if (!$this->getIsNewRecord()) {
            return;
        }
        $needUser = empty($this->user_id) || User::findOne($this->user_id) === null;
        if (!$needUser) {
            return;
        }
        $baseUsername = !empty($this->num_doc) ? preg_replace('/[^a-zA-Z0-9._-]/', '_', $this->num_doc) : ('profile_' . uniqid());
        $username = $baseUsername;
        $n = 0;
        while (User::find()->andWhere(['username' => $username])->exists()) {
            $username = $baseUsername . '_' . (++$n);
        }
        $email = !empty($this->public_email) ? $this->public_email : ($username . '@profile.local');
        if (User::find()->andWhere(['email' => $email])->exists()) {
            $email = $username . '+' . uniqid() . '@profile.local';
        }
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->password_hash = Yii::$app->security->generatePasswordHash(Yii::$app->security->generateRandomString(12));
        // empresas_id no se asigna al User; debe setearse manualmente
        if ($user->auth_key === null || $user->auth_key === '') {
            $user->auth_key = Yii::$app->security->generateRandomString(32);
        }
        User::$skipProfileCreation = true;
        try {
            if (!$user->save(false)) {
                return;
            }
            $this->user_id = $user->id;
        } finally {
            User::$skipProfileCreation = false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'public_email', 'gravatar_email', 'gravatar_id', 'location', 'timezone', 'bio', 'sexo', 'about', 'telefono', 'birthday', 'position', 'photo_', 'instagram', 'tiktok', 'linkedin', 'youtube', 'website', 'address', 'data_json', 'sede_id', 'location_sede_id', 'cargo_id', 'centro_costo_id', 'centro_utilidad_id', 'city', 'area_id'], 'default', 'value' => null],
            [['tipo_doc'], 'default', 'value' => 'CC'],
            [['estado'], 'default', 'value' => 'activo'],
            [['user_id', 'num_doc'], 'required'],
            [['user_id', 'empresas_id', 'sede_id', 'location_sede_id', 'cargo_id', 'centro_costo_id', 'centro_utilidad_id', 'area_id'], 'integer'],
            [['tipo_doc', 'bio', 'sexo', 'about', 'estado'], 'string'],
            [['birthday', 'data_json', 'photoFile'], 'safe'],
            [['photoFile'], 'file', 'skipOnEmpty' => true, 'extensions' => ['jpg', 'jpeg', 'png', 'gif', 'webp'], 'maxSize' => 2 * 1024 * 1024],
            [['num_doc', 'timezone'], 'string', 'max' => 40],
            [['name', 'public_email', 'gravatar_email', 'location'], 'string', 'max' => 255],
            [['gravatar_id'], 'string', 'max' => 32],
            [['telefono', 'city'], 'string', 'max' => 45],
            [['position', 'photo_'], 'string', 'max' => 245],
            [
                ['photoFile'],
                'file',
                'skipOnEmpty' => true,
                'extensions' => ['png', 'jpg', 'jpeg', 'gif', 'webp'],
                'maxSize' => 2 * 1024 * 1024,
                'wrongExtension' => 'Solo se permiten imágenes PNG, JPG, GIF o WebP.',
            ],
            [['instagram', 'tiktok', 'linkedin', 'youtube', 'website', 'address'], 'string', 'max' => 145],
            ['tipo_doc', 'in', 'range' => array_keys(self::optsTipoDoc())],
            ['sexo', 'in', 'range' => array_keys(self::optsSexo())],
            ['estado', 'in', 'range' => array_keys(self::optsEstado())],
            [['user_id'], 'unique'],
            [['cargo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cargos::class, 'targetAttribute' => ['cargo_id' => 'id']],
            [['centro_costo_id'], 'exist', 'skipOnError' => true, 'targetClass' => ContabilidadCentroCosto::class, 'targetAttribute' => ['centro_costo_id' => 'id']],
            [['centro_utilidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => ContabilidadCentroUtilidad::class, 'targetAttribute' => ['centro_utilidad_id' => 'id']],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => Area::class, 'targetAttribute' => ['area_id' => 'id']],
            [['empresas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresas_id' => 'id']],
            [['location_sede_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocationSedes::class, 'targetAttribute' => ['location_sede_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'tipo_doc' => 'Tipo Doc',
            'num_doc' => 'Num Doc',
            'name' => 'Name',
            'public_email' => 'Public Email',
            'gravatar_email' => 'Gravatar Email',
            'gravatar_id' => 'Gravatar ID',
            'location' => 'Location',
            'timezone' => 'Timezone',
            'bio' => 'Bio',
            'sexo' => 'Sexo',
            'empresas_id' => 'Empresas ID',
            'about' => 'About',
            'estado' => 'Estado',
            'telefono' => 'Telefono',
            'birthday' => 'Birthday',
            'position' => 'Position',
            'photo_' => 'Photo',
            'photoFile' => 'Foto de perfil',
            'instagram' => 'Instagram',
            'tiktok' => 'Tiktok',
            'linkedin' => 'Linkedin',
            'youtube' => 'Youtube',
            'website' => 'Website',
            'address' => 'Address',
            'data_json' => 'Data Json',
            'sede_id' => 'Sede ID',
            'cargo_id' => 'Cargo ID',
            'centro_costo_id' => 'Centro Costo ID',
            'centro_utilidad_id' => 'Centro Utilidad ID',
            'city' => 'City',
            'area_id' => 'Area ID',
        ];
    }

    /**
     * Gets query for [[Area]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(Area::class, ['id' => 'area_id']);
    }

    /**
     * Gets query for [[Cargo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCargo()
    {
        return $this->hasOne(Cargos::class, ['id' => 'cargo_id']);
    }

    /**
     * Gets query for [[Sede]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSede()
    {
        return $this->hasOne(LocationSedes::class, ['id' => 'sede_id']);
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
     * Gets query for [[EmpleadoVenueHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleadoVenueHistories()
    {
        return $this->hasMany(EmpleadoVenueHistory::class, ['profile_id' => 'user_id']);
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

    public function getLocationSede()
    {
        return $this->hasOne(LocationSedes::class, ['id' => 'location_sede_id']);
    }

    /**
     * Gets query for [[MallaDistribucionHoras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMallaDistribucionHoras()
    {
        return $this->hasMany(MallaDistribucionHoras::class, ['profile_id' => 'user_id']);
    }

    public function getMallaProfileAsignacions()
    {
        return $this->hasMany(MallaProfileAsignacion::class, ['profile_id' => 'user_id']);
    }

    /**
     * Gets query for [[NominaItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNominaItems()
    {
        return $this->hasMany(NominaItem::class, ['profile_id' => 'user_id']);
    }

    /**
     * Gets query for [[ProfileEventosLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfileEventosLogs()
    {
        return $this->hasMany(ProfileEventosLog::class, ['profile_id' => 'user_id']);
    }

    /**
     * Gets query for [[ProfileSalarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfileSalarios()
    {
        return $this->hasMany(ProfileSalarios::class, ['profile_id' => 'user_id']);
    }

    /**
     * Gets query for [[Contratos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContratos()
    {
        return $this->hasMany(Contrato::class, ['profile_id' => 'user_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * URL pública de la foto (ruta relativa, absoluta al sitio o URL externa).
     */
    public function getPhotoPublicUrl(): string
    {
        if ($this->photo_ === null || $this->photo_ === '') {
            return Url::to('@web/assets/img/users/user-13.jpg');
        }
        $raw = trim((string) $this->photo_);
        if (preg_match('#^https?://#i', $raw) || str_starts_with($raw, '/')) {
            return $raw;
        }

        return '/' . ltrim($raw, '/');
    }

    /**
     * column tipo_doc ENUM value labels
     * @return string[]
     */
    public static function optsTipoDoc()
    {
        return [
            self::TIPO_DOC_CC => Yii::t('app', 'CC'),
            self::TIPO_DOC_CE => Yii::t('app', 'CE'),
            self::TIPO_DOC_NIT => Yii::t('app', 'NIT'),
            self::TIPO_DOC_PAS => Yii::t('app', 'PAS'),
            self::TIPO_DOC_TI => Yii::t('app', 'TI'),
            self::TIPO_DOC_OTRO => Yii::t('app', 'OTRO'),
        ];
    }

    /**
     * column sexo ENUM value labels
     * @return string[]
     */
    public static function optsSexo()
    {
        return [
            self::SEXO_M => Yii::t('app', 'M'),
            self::SEXO_F => Yii::t('app', 'F'),
            self::SEXO_X => Yii::t('app', 'X'),
        ];
    }

    /**
     * column estado ENUM value labels
     * @return string[]
     */
    public static function optsEstado()
    {
        return [
            self::ESTADO_ACTIVO => Yii::t('app', 'activo'),
            self::ESTADO_INACTIVO => Yii::t('app', 'inactivo'),
        ];
    }

    /**
     * Clase Bootstrap (variante badge-soft-*) para el estado del colaborador.
     */
    public static function estadoBadgeSoftClass(?string $estado): string
    {
        if ($estado === self::ESTADO_ACTIVO) {
            return 'success';
        }
        if ($estado === self::ESTADO_INACTIVO) {
            return 'danger';
        }

        return 'secondary';
    }

    /**
     * @return string
     */
    public function displayTipoDoc()
    {
        return self::optsTipoDoc()[$this->tipo_doc];
    }

    /**
     * @return bool
     */
    public function isTipoDocCc()
    {
        return $this->tipo_doc === self::TIPO_DOC_CC;
    }

    public function setTipoDocToCc()
    {
        $this->tipo_doc = self::TIPO_DOC_CC;
    }

    /**
     * @return bool
     */
    public function isTipoDocCe()
    {
        return $this->tipo_doc === self::TIPO_DOC_CE;
    }

    public function setTipoDocToCe()
    {
        $this->tipo_doc = self::TIPO_DOC_CE;
    }

    /**
     * @return bool
     */
    public function isTipoDocNit()
    {
        return $this->tipo_doc === self::TIPO_DOC_NIT;
    }

    public function setTipoDocToNit()
    {
        $this->tipo_doc = self::TIPO_DOC_NIT;
    }

    /**
     * @return bool
     */
    public function isTipoDocPas()
    {
        return $this->tipo_doc === self::TIPO_DOC_PAS;
    }

    public function setTipoDocToPas()
    {
        $this->tipo_doc = self::TIPO_DOC_PAS;
    }

    /**
     * @return bool
     */
    public function isTipoDocTi()
    {
        return $this->tipo_doc === self::TIPO_DOC_TI;
    }

    public function setTipoDocToTi()
    {
        $this->tipo_doc = self::TIPO_DOC_TI;
    }

    /**
     * @return bool
     */
    public function isTipoDocOtro()
    {
        return $this->tipo_doc === self::TIPO_DOC_OTRO;
    }

    public function setTipoDocToOtro()
    {
        $this->tipo_doc = self::TIPO_DOC_OTRO;
    }

    /**
     * @return string
     */
    public function displaySexo()
    {
        return self::optsSexo()[$this->sexo];
    }

    /**
     * @return bool
     */
    public function isSexoM()
    {
        return $this->sexo === self::SEXO_M;
    }

    public function setSexoToM()
    {
        $this->sexo = self::SEXO_M;
    }

    /**
     * @return bool
     */
    public function isSexoF()
    {
        return $this->sexo === self::SEXO_F;
    }

    public function setSexoToF()
    {
        $this->sexo = self::SEXO_F;
    }

    /**
     * @return bool
     */
    public function isSexoX()
    {
        return $this->sexo === self::SEXO_X;
    }

    public function setSexoToX()
    {
        $this->sexo = self::SEXO_X;
    }

    /**
     * @return string
     */
    public function displayEstado()
    {
        return self::optsEstado()[$this->estado];
    }

    /**
     * @return bool
     */
    public function isEstadoActivo()
    {
        return $this->estado === self::ESTADO_ACTIVO;
    }

    public function setEstadoToActivo()
    {
        $this->estado = self::ESTADO_ACTIVO;
    }

    /**
     * @return bool
     */
    public function isEstadoInactivo()
    {
        return $this->estado === self::ESTADO_INACTIVO;
    }

    public function setEstadoToInactivo()
    {
        $this->estado = self::ESTADO_INACTIVO;
    }
}
