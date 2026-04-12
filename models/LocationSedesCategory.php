<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "location_sedes_categories".
 *
 * @property int $id
 * @property string $nombre
 * @property int|null $empresas_id
 * @property int|null $empresa_cliente_id
 * @property int $activo
 * @property float|null $valor_hora_base
 * @property float|null $valor_hora_domingo_festivos
 * @property float|null $valor_hora_nocturna
 * @property float|null $valor_hora_nocturna_festiva
 * @property float|null $valor_hora_nocturna_dominical_festiva
 * @property float|null $valor_movilizacion
 * @property float|null $valor_hora_especial
 * @property string $created_at
 * @property string $updated_at
 *
 * @property int[] $sedeIds
 * @property Empresas|null $empresa
 * @property EmpresaCliente|null $empresaCliente
 * @property LocationSedeCategory[] $locationSedeCategoryPivots
 * @property LocationSedes[] $locationSedes
 */
class LocationSedesCategory extends \yii\db\ActiveRecord
{
    /**
     * @var int[]
     */
    public array $sedeIds = [];

    public static function tableName()
    {
        return 'location_sedes_categories';
    }

    public function rules()
    {
        return [
            [['nombre', 'empresas_id', 'empresa_cliente_id'], 'required'],
            [['valor_hora_base', 'valor_hora_domingo_festivos', 'valor_hora_nocturna', 'valor_hora_nocturna_festiva', 'valor_hora_nocturna_dominical_festiva', 'valor_movilizacion', 'valor_hora_especial'], 'default', 'value' => null],
            [['activo'], 'default', 'value' => 1],
            [['activo', 'empresas_id', 'empresa_cliente_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['valor_hora_base', 'valor_hora_domingo_festivos', 'valor_hora_nocturna', 'valor_hora_nocturna_festiva', 'valor_hora_nocturna_dominical_festiva', 'valor_movilizacion', 'valor_hora_especial'], 'number', 'min' => 0, 'max' => 9999999999.9999],
            [['nombre'], 'string', 'max' => 190],
            [['nombre'], 'unique'],
            [['sedeIds'], 'default', 'value' => []],
            [['sedeIds'], 'each', 'rule' => ['integer']],
            [['empresas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresas_id' => 'id']],
            [['empresa_cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => EmpresaCliente::class, 'targetAttribute' => ['empresa_cliente_id' => 'id']],
            [['empresa_cliente_id'], 'validateEmpresaClienteEmpresa'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => Yii::t('app', 'Nombre'),
            'empresas_id' => Yii::t('app', 'Organización'),
            'empresa_cliente_id' => Yii::t('app', 'Empresa cliente'),
            'activo' => Yii::t('app', 'Activa'),
            'valor_hora_base' => Yii::t('app', 'Valor hora base'),
            'valor_hora_domingo_festivos' => Yii::t('app', 'Valor hora domingo/festivos'),
            'valor_hora_nocturna' => Yii::t('app', 'Valor hora nocturna'),
            'valor_hora_nocturna_festiva' => Yii::t('app', 'Valor hora nocturna festiva'),
            'valor_hora_nocturna_dominical_festiva' => Yii::t('app', 'Valor hora nocturna dominical/festiva'),
            'valor_movilizacion' => Yii::t('app', 'Valor movilización'),
            'valor_hora_especial' => Yii::t('app', 'Valor hora especial'),
            'created_at' => Yii::t('app', 'Creada'),
            'updated_at' => Yii::t('app', 'Actualizada'),
            'sedeIds' => Yii::t('app', 'Sedes asignadas'),
        ];
    }

    public function validateEmpresaClienteEmpresa(string $attribute, ?array $params = null): void
    {
        if ($this->empresa_cliente_id === null || $this->empresa_cliente_id === '' || $this->empresas_id === null || $this->empresas_id === '') {
            return;
        }

        $ec = EmpresaCliente::findOne((int) $this->empresa_cliente_id);
        if ($ec === null) {
            $this->addError($attribute, Yii::t('app', 'Empresa cliente no válida.'));

            return;
        }

        if ((int) $ec->empresas_id !== (int) $this->empresas_id) {
            $this->addError($attribute, Yii::t('app', 'La empresa cliente no pertenece a la organización seleccionada.'));
        }
    }

    public function getEmpresa()
    {
        return $this->hasOne(Empresas::class, ['id' => 'empresas_id']);
    }

    public function getEmpresaCliente()
    {
        return $this->hasOne(EmpresaCliente::class, ['id' => 'empresa_cliente_id']);
    }

    public function getLocationSedeCategoryPivots()
    {
        return $this->hasMany(LocationSedeCategory::class, ['location_sede_category_id' => 'id']);
    }

    public function getLocationSedes()
    {
        return $this->hasMany(LocationSedes::class, ['id' => 'location_sede_id'])
            ->via('locationSedeCategoryPivots');
    }

    /**
     * @return int[]
     */
    public function getSedeIds(): array
    {
        return array_map(
            'intval',
            (new \yii\db\Query())
                ->select('location_sede_id')
                ->from('location_sede_category')
                ->where(['location_sede_category_id' => $this->id])
                ->column()
        );
    }

    /**
     * @param int[] $sedeIds
     */
    public function assignSedes(array $sedeIds): void
    {
        $categoryId = (int) $this->id;
        $newIds = array_unique(array_map('intval', array_filter($sedeIds)));

        $db = static::getDb();
        $transaction = $db->beginTransaction();
        try {
            $db->createCommand()->delete('location_sede_category', ['location_sede_category_id' => $categoryId])->execute();
            foreach ($newIds as $sedeId) {
                $db->createCommand()->insert('location_sede_category', [
                    'location_sede_id' => $sedeId,
                    'location_sede_category_id' => $categoryId,
                ])->execute();
            }
            $transaction->commit();
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
}
