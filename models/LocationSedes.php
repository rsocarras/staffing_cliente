<?php

namespace app\models;

use yii\db\Query;

/**
 * This is the model class for table "location_sedes".
 *
 * @property int $id
 * @property int $empresa_id
 * @property int|null $city_id
 * @property string|null $codigo
 * @property string $nombre
 * @property string|null $direccion
 * @property int $activo
 * @property string $tipo_sede
 * @property float|string|null $max_horas_clases_grupales
 * @property float|string|null $valor_hora_base
 * @property float|string|null $valor_hora_domingo_festivos
 * @property float|string|null $valor_hora_nocturna
 * @property float|string|null $valor_hora_nocturna_festiva
 * @property float|string|null $valor_hora_nocturna_dominical_festiva
 * @property float|string|null $valor_movilizacion
 * @property float|string|null $valor_hora_especial
 * @property int|null $centro_costo
 * @property int|null $centro_costo_staffing
 * @property string|null $codigo_externo
 * @property string $created_at
 * @property string $updated_at
 */
class LocationSedes extends \yii\db\ActiveRecord
{
    const TIPO_SEDE_OPERATIVA = 'operativa';
    const TIPO_SEDE_ADMINISTRATIVA = 'administrativa';



    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'location_sedes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo', 'direccion', 'codigo_externo'], 'default', 'value' => null],
            [[
                'max_horas_clases_grupales',
                'valor_hora_base',
                'valor_hora_domingo_festivos',
                'valor_hora_nocturna',
                'valor_hora_nocturna_festiva',
                'valor_hora_nocturna_dominical_festiva',
                'valor_movilizacion',
                'valor_hora_especial',
            ], 'default', 'value' => null],
            [['tipo_sede'], 'default', 'value' => self::TIPO_SEDE_OPERATIVA],
            [['codigo', 'codigo_externo'], 'filter', 'filter' => function ($v) { return $v === '' ? null : $v; }],
            [['activo'], 'default', 'value' => 1],
            [['empresa_id', 'nombre'], 'required'],
            [['empresa_id', 'activo', 'city_id', 'centro_costo', 'centro_costo_staffing'], 'integer'],
            [[
                'max_horas_clases_grupales',
                'valor_hora_base',
                'valor_hora_domingo_festivos',
                'valor_hora_nocturna',
                'valor_hora_nocturna_festiva',
                'valor_hora_nocturna_dominical_festiva',
                'valor_movilizacion',
                'valor_hora_especial',
            ], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['codigo', 'codigo_externo'], 'string', 'max' => 50],
            [['nombre'], 'string', 'max' => 190],
            [['direccion'], 'string', 'max' => 255],
            [['tipo_sede'], 'string', 'max' => 20],
            [['tipo_sede'], 'in', 'range' => array_keys(self::optsTipoSede())],
            [['empresa_id', 'codigo'], 'unique', 'targetAttribute' => ['empresa_id', 'codigo']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'empresa_id' => 'Empresa ID',
            'city_id' => 'Ciudad',
            'codigo' => 'Código',
            'nombre' => 'Nombre',
            'direccion' => 'Dirección',
            'activo' => 'Activo',
            'tipo_sede' => 'Tipo de Sede',
            'max_horas_clases_grupales' => 'Máx. horas clases grupales',
            'valor_hora_base' => 'Valor hora base',
            'valor_hora_domingo_festivos' => 'Valor hora domingo/festivos',
            'valor_hora_nocturna' => 'Valor hora nocturna',
            'valor_hora_nocturna_festiva' => 'Valor hora nocturna festiva',
            'valor_hora_nocturna_dominical_festiva' => 'Valor hora nocturna dominical/festiva',
            'valor_movilizacion' => 'Valor movilización',
            'valor_hora_especial' => 'Valor hora especial',
            'centro_costo' => 'Centro de Costo',
            'centro_costo_staffing' => 'Centro de Costo Staffing',
            'codigo_externo' => 'Código Externo',
            'created_at' => 'Creado el',
            'updated_at' => 'Actualizado el',
        ];
    }

    public static function optsTipoSede()
    {
        return [
            self::TIPO_SEDE_OPERATIVA => 'Operativa',
            self::TIPO_SEDE_ADMINISTRATIVA => 'Administrativa',
        ];
    }

    public function getTipoSedeLabel()
    {
        $items = self::optsTipoSede();

        return isset($items[$this->tipo_sede]) ? $items[$this->tipo_sede] : $this->tipo_sede;
    }

    /**
     * Sedes que puede usar un cliente empresa: las ya vinculadas en requisiciones o presupuestos;
     * si no hay historial, todas las sedes activas del tenant. Incluye $includeSedeId si aplica.
     *
     * @return static[]
     */
    public static function findSelectableForEmpresaCliente(int $empresaClienteId, int $tenantEmpresaId, ?int $includeSedeId = null): array
    {
        $sedeIdsReq = (new Query())
            ->select('sede_id')
            ->distinct()
            ->from('requisicion')
            ->where([
                'empresa_cliente_id' => $empresaClienteId,
                'empresas_id' => $tenantEmpresaId,
            ])
            ->andWhere(['not', ['sede_id' => null]])
            ->andWhere(['>', 'sede_id', 0])
            ->column();

        $sedeIdsPres = (new Query())
            ->select('location_sede_id')
            ->distinct()
            ->from('presupuesto')
            ->where([
                'empresa_cliente_id' => $empresaClienteId,
                'empresa_id' => $tenantEmpresaId,
            ])
            ->andWhere(['not', ['location_sede_id' => null]])
            ->andWhere(['>', 'location_sede_id', 0])
            ->column();

        $merged = array_values(array_unique(array_merge(
            array_map('intval', $sedeIdsReq),
            array_map('intval', $sedeIdsPres)
        )));

        $q = static::find()
            ->where(['empresa_id' => $tenantEmpresaId, 'activo' => 1]);

        if ($merged !== []) {
            $q->andWhere(['id' => $merged]);
        }

        /** @var static[] $models */
        $models = $q->orderBy(['nombre' => SORT_ASC])->all();

        if ($includeSedeId !== null && $includeSedeId > 0) {
            $ids = array_map(static function ($m) {
                return (int) $m->id;
            }, $models);
            if (!in_array($includeSedeId, $ids, true)) {
                $extra = static::find()
                    ->where([
                        'id' => $includeSedeId,
                        'empresa_id' => $tenantEmpresaId,
                        'activo' => 1,
                    ])
                    ->one();
                if ($extra !== null) {
                    $models[] = $extra;
                    usort($models, static function ($a, $b) {
                        return strcmp($a->nombre, $b->nombre);
                    });
                }
            }
        }

        return $models;
    }

}
