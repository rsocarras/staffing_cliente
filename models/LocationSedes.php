<?php

namespace app\models;

use yii\db\Query;
use yii\helpers\ArrayHelper;

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
 * @property int|null $centro_costo
 * @property int|null $centro_costo_staffing
 * @property string|null $codigo_externo
 * @property string $created_at
 * @property string $updated_at
 *
 * @property-read Empresas|null $empresa
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
            [['tipo_sede'], 'default', 'value' => self::TIPO_SEDE_OPERATIVA],
            [['codigo', 'codigo_externo'], 'filter', 'filter' => function ($v) {
                return $v === '' ? null : $v;
            }],
            [['activo'], 'default', 'value' => 1],
            [['empresa_id', 'nombre'], 'required'],
            [['empresa_id', 'activo', 'city_id', 'centro_costo', 'centro_costo_staffing'], 'integer'],
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
     * Organización (tenant) a la que pertenece la sede.
     */
    public function getEmpresa()
    {
        return $this->hasOne(Empresas::class, ['id' => 'empresa_id']);
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

    /**
     * Ciudades activas donde la organización tiene al menos una sede activa con ciudad asignada.
     *
     * @return array<int, string> id ciudad => nombre
     */
    public static function mapCiudadesConSedeActivaParaEmpresa(int $empresaId): array
    {
        if ($empresaId <= 0) {
            return [];
        }

        $cityIds = static::find()
            ->select('city_id')
            ->where(['empresa_id' => $empresaId, 'activo' => 1])
            ->andWhere(['not', ['city_id' => null]])
            ->distinct()
            ->column();

        if ($cityIds === []) {
            return [];
        }

        return City::sortMapWithPriority(ArrayHelper::map(
            City::find()
                ->where(['id' => $cityIds, 'is_active' => 1])
                ->orderBy(['name' => SORT_ASC])
                ->all(),
            'id',
            'name'
        ));
    }

    /**
     * Incluye la ciudad del registro actual si ya no tiene sedes (p. ej. edición de borrador).
     *
     * @param array<int, string> $ciudades
     * @return array<int, string>
     */
    public static function mapCiudadesIncluirActualSiFalta(array $ciudades, ?int $ciudadId): array
    {
        $cid = (int) ($ciudadId ?? 0);
        if ($cid <= 0 || array_key_exists($cid, $ciudades)) {
            return $ciudades;
        }
        $c = City::findOne($cid);
        if ($c === null) {
            return $ciudades;
        }
        $ciudades[$cid] = $c->name;

        return City::sortMapWithPriority($ciudades);
    }

    /**
     * Ciudades (activas) donde la empresa cliente tiene al menos una sede activa vinculada en empresa_cliente_sedes.
     *
     * @return array<int, string> id ciudad => nombre
     */
    public static function mapCiudadesConSedeActivaParaEmpresaCliente(int $empresaClienteId, int $tenantEmpresaId, ?int $incluirCiudadId = null): array
    {
        if ($empresaClienteId <= 0 || $tenantEmpresaId <= 0) {
            return [];
        }

        $ec = EmpresaCliente::findOne(['id' => $empresaClienteId, 'empresas_id' => $tenantEmpresaId, 'is_active' => 1]);
        if ($ec === null) {
            return [];
        }

        $sedeIds = (new Query())
            ->select('location_sede_id')
            ->from('empresa_cliente_sedes')
            ->where(['empresa_cliente_id' => $empresaClienteId])
            ->column();

        // Sin filas en pivote: mismo criterio histórico (ciudades con sede activa del tenant).
        if ($sedeIds === []) {
            $fallback = static::mapCiudadesConSedeActivaParaEmpresa($tenantEmpresaId);

            return static::mapCiudadesIncluirActualSiFalta($fallback, $incluirCiudadId);
        }

        $cityIds = static::find()
            ->select('city_id')
            ->where(['id' => $sedeIds, 'empresa_id' => $tenantEmpresaId, 'activo' => 1])
            ->andWhere(['not', ['city_id' => null]])
            ->distinct()
            ->column();

        // Sedes vinculadas pero sin ciudad en catálogo: permitir elegir ciudad del tenant.
        if ($cityIds === []) {
            $fallback = static::mapCiudadesConSedeActivaParaEmpresa($tenantEmpresaId);

            return static::mapCiudadesIncluirActualSiFalta($fallback, $incluirCiudadId);
        }

        $map = City::sortMapWithPriority(ArrayHelper::map(
            City::find()
                ->where(['id' => $cityIds, 'is_active' => 1])
                ->orderBy(['name' => SORT_ASC])
                ->all(),
            'id',
            'name'
        ));

        return static::mapCiudadesIncluirActualSiFalta($map, $incluirCiudadId);
    }

    public function getLocationSedeCargoTarifas()
    {
        return $this->hasMany(LocationSedeCargoTarifa::class, ['location_sede_id' => 'id']);
    }
}
