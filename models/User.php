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
     * Datos del perfil a crear (empresas_id, num_doc, name, etc.).
     * Se establece desde el controlador antes de guardar.
     * @var array|null
     */
    public $pendingProfileData = [];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['new_password'], 'string', 'min' => 6, 'max' => 72],
            [['new_password'], 'safe'],
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

        $raw = $this->pendingProfileData['empresas_id'] ?? null;
        $empresasId = ($raw !== null && $raw !== '' && (int) $raw > 0)
            ? (int) $raw
            : $this->resolveDefaultEmpresasId();
        $numDoc = $this->pendingProfileData['num_doc'] ?? '0000000';
        $name = $this->pendingProfileData['name'] ?? $this->username;

        $profile->empresas_id = (int) $empresasId;
        $profile->num_doc = (string) $numDoc;
        $profile->name = $name;
        $profile->tipo_doc = $this->pendingProfileData['tipo_doc'] ?? Profile::TIPO_DOC_CC;
        $profile->estado = $this->pendingProfileData['estado'] ?? Profile::ESTADO_ACTIVO;

        if (isset($this->pendingProfileData['telefono'])) {
            $profile->telefono = $this->pendingProfileData['telefono'];
        }
        if (isset($this->pendingProfileData['position'])) {
            $profile->position = $this->pendingProfileData['position'];
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
