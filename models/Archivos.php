<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "archivos".
 *
 * @property int $id
 * @property int $empresa_id
 * @property string $storage
 * @property string $path
 * @property string $filename
 * @property string|null $mime
 * @property int|null $size_bytes
 * @property string|null $sha256
 * @property int|null $uploaded_by
 * @property string $created_at
 *
 * @property ArchivoLink[] $archivoLinks
 * @property Empresas $empresa
 * @property PlanillaImport[] $planillaImports
 * @property User $uploadedBy
 */
class Archivos extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const STORAGE_LOCAL = 'local';
    const STORAGE_S3 = 's3';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'archivos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mime', 'size_bytes', 'sha256', 'uploaded_by'], 'default', 'value' => null],
            [['storage'], 'default', 'value' => 's3'],
            [['empresa_id', 'path', 'filename'], 'required'],
            [['empresa_id', 'size_bytes', 'uploaded_by'], 'integer'],
            [['storage'], 'string'],
            [['created_at'], 'safe'],
            [['path'], 'string', 'max' => 1024],
            [['filename'], 'string', 'max' => 255],
            [['mime'], 'string', 'max' => 120],
            [['sha256'], 'string', 'max' => 64],
            ['storage', 'in', 'range' => array_keys(self::optsStorage())],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresa_id' => 'id']],
            [['uploaded_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['uploaded_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'empresa_id' => Yii::t('app', 'Empresa ID'),
            'storage' => Yii::t('app', 'Storage'),
            'path' => Yii::t('app', 'Path'),
            'filename' => Yii::t('app', 'Filename'),
            'mime' => Yii::t('app', 'Mime'),
            'size_bytes' => Yii::t('app', 'Size Bytes'),
            'sha256' => Yii::t('app', 'Sha256'),
            'uploaded_by' => Yii::t('app', 'Uploaded By'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[ArchivoLinks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArchivoLinks()
    {
        return $this->hasMany(ArchivoLink::class, ['archivo_id' => 'id']);
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
     * Gets query for [[PlanillaImports]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlanillaImports()
    {
        return $this->hasMany(PlanillaImport::class, ['archivo_id' => 'id']);
    }

    /**
     * Gets query for [[UploadedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUploadedBy()
    {
        return $this->hasOne(User::class, ['id' => 'uploaded_by']);
    }


    /**
     * column storage ENUM value labels
     * @return string[]
     */
    public static function optsStorage()
    {
        return [
            self::STORAGE_LOCAL => Yii::t('app', 'local'),
            self::STORAGE_S3 => Yii::t('app', 's3'),
        ];
    }

    /**
     * @return string
     */
    public function displayStorage()
    {
        return self::optsStorage()[$this->storage];
    }

    /**
     * @return bool
     */
    public function isStorageLocal()
    {
        return $this->storage === self::STORAGE_LOCAL;
    }

    public function setStorageToLocal()
    {
        $this->storage = self::STORAGE_LOCAL;
    }

    /**
     * @return bool
     */
    public function isStorageS3()
    {
        return $this->storage === self::STORAGE_S3;
    }

    public function setStorageToS3()
    {
        $this->storage = self::STORAGE_S3;
    }
}
