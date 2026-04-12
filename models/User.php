<?php

namespace app\models;

use app\components\TenantContext;
use Da\User\Model\User as BaseUser;

/**
 * Extiende Da\User\Model\User para integrar con Profile (empresas_id, num_doc).
 * Al crear usuario, se crea el perfil con los datos requeridos por la app.
 */
class User extends BaseUser
{
    /**
     * Contraseña nueva (solo para formularios; no se persiste en BD).
     * @var string
     */
    public $new_password = '';

    /**
     * Si true, afterInsert no crea Profile (evita doble creación cuando el User lo crea Profile).
     * @var bool
     */
    public static $skipProfileCreation = false;

    /**
     * Roles RBAC asignados (formularios; no es columna de BD).
     * @var string[]
     */
    public $roleNames = [];

    /**
     * Datos del perfil a crear (empresas_id, num_doc, name, etc.).
     * Se establece desde el controlador antes de guardar.
     * @var array|null
     */
    public $pendingProfileData = [];

    /**
     * {@inheritdoc}
     * Incluye atributos de formulario usados en UserManagementController (modal Ajax).
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        foreach (['create', 'update'] as $scenario) {
            if (isset($scenarios[$scenario])) {
                $scenarios[$scenario] = array_values(array_unique(array_merge(
                    $scenarios[$scenario],
                    ['new_password', 'roleNames']
                )));
            }
        }

        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['new_password'], 'string', 'min' => 6, 'max' => 72, 'skipOnEmpty' => true],
            [['new_password', 'roleNames'], 'safe'],
            [['phone'], 'string', 'max' => 45, 'skipOnEmpty' => true],
            [['phone'], 'safe', 'on' => ['create', 'update']],
        ]);
    }

    /**
     * {@inheritdoc}
     * Sobrescribe para crear Profile con empresas_id y num_doc requeridos por la app.
     */
    public function afterSave($insert, $changedAttributes)
    {
        \yii\db\ActiveRecord::afterSave($insert, $changedAttributes);

        if ($insert && $this->profile === null) {
            $profile = $this->createProfileWithAppData();
            if ($profile) {
                $profile->save(false);
            }
        }
    }

    /**
     * Crea instancia de Profile con empresas_id, num_doc y demás campos requeridos.
     * @return \app\models\Profile|null
     */
    protected function createProfileWithAppData()
    {
        $profile = new Profile();
        $profile->user_id = $this->id;

        $data = is_array($this->pendingProfileData) ? $this->pendingProfileData : [];

        foreach (Profile::persistableAttributeNames() as $attr) {
            if (!array_key_exists($attr, $data)) {
                continue;
            }
            $profile->setAttribute($attr, $data[$attr]);
        }

        if ($profile->empresas_id === null || (int) $profile->empresas_id <= 0) {
            $profile->empresas_id = (int) $this->resolveDefaultEmpresasId();
        }
        if ($profile->num_doc === null || $profile->num_doc === '') {
            $profile->num_doc = '0000000';
        }
        if ($profile->name === null || $profile->name === '') {
            $profile->name = $this->username;
        }
        if ($profile->tipo_doc === null || $profile->tipo_doc === '') {
            $profile->tipo_doc = Profile::TIPO_DOC_CC;
        }
        if ($profile->estado === null || $profile->estado === '') {
            $profile->estado = Profile::ESTADO_ACTIVO;
        }

        return $profile;
    }

    /**
     * Obtiene empresas_id por defecto (primera empresa o la del admin actual).
     * @return int
     */
    protected function resolveDefaultEmpresasId()
    {
        $tenantId = TenantContext::currentEmpresaId();
        if ($tenantId !== null) {
            return $tenantId;
        }

        $profile = \Yii::$app->user->identity && \Yii::$app->user->identity->profile
            ? \Yii::$app->user->identity->profile
            : null;

        if ($profile && $profile->empresas_id) {
            return (int) $profile->empresas_id;
        }

        $first = Empresas::find()->select('id')->limit(1)->scalar();
        return $first ? (int) $first : 1;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'id']);
    }

    public function getEmpresas_id(): ?int
    {
        $profile = $this->profile;
        if ($profile === null || !$profile->empresas_id) {
            return null;
        }

        return (int) $profile->empresas_id;
    }

    public function getPhone(): ?string
    {
        return $this->profile ? $this->profile->telefono : null;
    }

    public function setPhone($value): void
    {
        if ($this->profile !== null) {
            $this->profile->telefono = $value !== null ? (string) $value : null;
        }
    }
}
