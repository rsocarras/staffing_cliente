<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $nombre
 * @property int|null $empresas_id
 * @property int|null $empresa_cliente_id
 * @property int $activo
 * @property string $created_at
 * @property string $updated_at
 *
 * @property int[] $sedeIds
 * @property Empresas|null $empresa
 * @property EmpresaCliente|null $empresaCliente
 * @property LocationSedeCategory[] $locationSedeCategoryPivots
 * @property LocationSedes[] $locationSedes
 */
class LocationSedesCategory extends ActiveRecord
{
    /** @var int[] */
    public array $sedeIds = [];

    public static function tableName(): string
    {
        return 'location_sedes_categories';
    }

    public function rules(): array
    {
        return [
            [['nombre', 'empresas_id', 'empresa_cliente_id'], 'required'],
            [['activo'], 'default', 'value' => 1],
            [['activo', 'empresas_id', 'empresa_cliente_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 190],
            [['nombre'], 'unique'],
            [['sedeIds'], 'default', 'value' => []],
            [['sedeIds'], 'each', 'rule' => ['integer']],
            [['empresas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresas_id' => 'id']],
            [['empresa_cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => EmpresaCliente::class, 'targetAttribute' => ['empresa_cliente_id' => 'id']],
            [['empresa_cliente_id'], 'validateEmpresaClienteEmpresa'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'nombre' => Yii::t('app', 'Nombre'),
            'empresas_id' => Yii::t('app', 'Organización'),
            'empresa_cliente_id' => Yii::t('app', 'Empresa cliente'),
            'activo' => Yii::t('app', 'Activa'),
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

    public function getEmpresa(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Empresas::class, ['id' => 'empresas_id']);
    }

    public function getEmpresaCliente(): \yii\db\ActiveQuery
    {
        return $this->hasOne(EmpresaCliente::class, ['id' => 'empresa_cliente_id']);
    }

    public function getLocationSedeCategoryPivots(): \yii\db\ActiveQuery
    {
        return $this->hasMany(LocationSedeCategory::class, ['location_sede_category_id' => 'id']);
    }

    public function getLocationSedes(): \yii\db\ActiveQuery
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
     * @return array<int, array<string, float|string|null>>
     */
    public function getPivotTariffsBySedeId(): array
    {
        if ($this->isNewRecord) {
            return [];
        }

        $fields = LocationSedeCargoTarifa::tariffColumnNames();
        $rows = LocationSedeCategory::find()
            ->where(['location_sede_category_id' => (int) $this->id])
            ->asArray()
            ->all();
        $out = [];
        foreach ($rows as $r) {
            $sid = (int) $r['location_sede_id'];
            $out[$sid] = [];
            foreach ($fields as $f) {
                $out[$sid][$f] = $r[$f] ?? null;
            }
        }

        return $out;
    }

    /**
     * @param int[] $sedeIds
     * @param array<int|string, array<string, mixed>> $pivotTariffPost
     */
    public function assignSedes(array $sedeIds, array $pivotTariffPost = []): void
    {
        $categoryId = (int) $this->id;
        $newIds = array_unique(array_map('intval', array_filter($sedeIds)));
        $fields = LocationSedeCargoTarifa::tariffColumnNames();

        $db = static::getDb();
        $transaction = $db->beginTransaction();
        try {
            $db->createCommand()->delete('location_sede_category', ['location_sede_category_id' => $categoryId])->execute();
            foreach ($newIds as $sedeId) {
                $t = $pivotTariffPost[$sedeId] ?? $pivotTariffPost[(string) $sedeId] ?? [];
                $row = [
                    'location_sede_id' => $sedeId,
                    'location_sede_category_id' => $categoryId,
                ];
                foreach ($fields as $f) {
                    $v = $t[$f] ?? null;
                    if ($v === '' || $v === null) {
                        $row[$f] = null;
                    } else {
                        $row[$f] = is_numeric($v) ? $v : null;
                    }
                }
                $db->createCommand()->insert('location_sede_category', $row)->execute();
            }
            $transaction->commit();
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
}
