<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "novedad_concepto".
 *
 * @property int $id
 * @property int|null $novedad_tipo_id
 * @property int|null $novedad_concepto_form_id
 * @property string $nombre
 * @property string|null $descripcion
 * @property string|null $icono
 * @property string|null $codigo
 * @property string|null $categoria
 * @property int $permite_masivo
 * @property string|null $modo_masivo_ext
 * @property int $sync_temporapp
 * @property int $va_a_nomina
 * @property string|null $correo_notif
 * @property int $tiene_handler
 * @property int $activo
 * @property string $created_at
 * @property string $updated_at
 *
 * @property NovedadTipo $novedadTipo
 * @property NovedadConceptoForm|null $novedadConceptoForm
 * @property NovedadConceptoRol[] $novedadConceptoRols
 * @property NovedadConceptoCargo[] $novedadConceptoCargos
 * @property Novedad[] $novedads
 */
class NovedadConcepto extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'novedad_concepto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['novedad_tipo_id', 'novedad_concepto_form_id', 'descripcion', 'icono', 'codigo', 'categoria', 'correo_notif'], 'default', 'value' => null],
            [['modo_masivo_ext'], 'default', 'value' => 'xlsx'],
            [['activo'], 'default', 'value' => 1],
            [['novedad_tipo_id', 'novedad_concepto_form_id', 'permite_masivo', 'sync_temporapp', 'va_a_nomina', 'tiene_handler', 'activo'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'required'],
            [['descripcion'], 'string'],
            [['nombre'], 'string', 'max' => 100],
            [['icono', 'codigo', 'categoria'], 'string', 'max' => 50],
            [['modo_masivo_ext'], 'string', 'max' => 10],
            [['correo_notif'], 'string', 'max' => 200],
            [['codigo'], 'unique'],
            [['novedad_tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => NovedadTipo::class, 'targetAttribute' => ['novedad_tipo_id' => 'id']],
            [['novedad_concepto_form_id'], 'exist', 'skipOnError' => true, 'targetClass' => NovedadConceptoForm::class, 'targetAttribute' => ['novedad_concepto_form_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'novedad_tipo_id' => Yii::t('app', 'Novedad Tipo ID'),
            'novedad_concepto_form_id' => Yii::t('app', 'Formulario'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'icono' => Yii::t('app', 'Icono'),
            'codigo' => Yii::t('app', 'Codigo'),
            'categoria' => Yii::t('app', 'Categoria'),
            'permite_masivo' => Yii::t('app', 'Permite Masivo'),
            'modo_masivo_ext' => Yii::t('app', 'Modo Masivo Ext'),
            'sync_temporapp' => Yii::t('app', 'Sync Temporapp'),
            'va_a_nomina' => Yii::t('app', 'Va A Nomina'),
            'correo_notif' => Yii::t('app', 'Correo Notif'),
            'tiene_handler' => Yii::t('app', 'Tiene Handler'),
            'activo' => Yii::t('app', 'Activo'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[NovedadTipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNovedadTipo()
    {
        return $this->hasOne(NovedadTipo::class, ['id' => 'novedad_tipo_id']);
    }

    /**
     * Gets query for [[Novedads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNovedads()
    {
        return $this->hasMany(Novedad::class, ['concepto_id' => 'id']);
    }

    public function getNovedadConceptoForm(): \yii\db\ActiveQuery
    {
        return $this->hasOne(NovedadConceptoForm::class, ['id' => 'novedad_concepto_form_id']);
    }

    public function getNovedadConceptoRols(): \yii\db\ActiveQuery
    {
        return $this->hasMany(NovedadConceptoRol::class, ['novedad_concepto_id' => 'id']);
    }

    public function getNovedadConceptoCargos(): \yii\db\ActiveQuery
    {
        return $this->hasMany(NovedadConceptoCargo::class, ['novedad_concepto_id' => 'id']);
    }

    public static function findIdByCodigo(string $codigo): ?int
    {
        $id = static::find()->select('id')->where(['codigo' => $codigo, 'activo' => 1])->scalar();

        return $id !== false && $id !== null ? (int) $id : null;
    }
}
