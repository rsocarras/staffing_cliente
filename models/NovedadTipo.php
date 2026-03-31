<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * @property int $id
 * @property int|null $empresa_id Tenant (si la columna existe en BD)
 * @property string $nombre
 * @property string $codigo slug estable para permiso RBAC novedad.crear.tipo.{codigo}
 * @property string|null $descripcion
 * @property string|null $icono
 * @property int $orden
 * @property int $activo
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Empresas|null $empresa
 * @property NovedadConcepto[] $novedadConceptos
 * @property NovedadFlujoPaso[] $novedadFlujoPasos
 * @property Novedad[] $novedads
 */
class NovedadTipo extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function tableName(): string
    {
        return 'novedad_tipo';
    }

    public static function hasEmpresaIdColumn(): bool
    {
        static $cached = null;
        if ($cached === null) {
            $cached = static::getTableSchema()->getColumn('empresa_id') !== null;
        }
        return $cached;
    }

    public function beforeValidate(): bool
    {
        if (!parent::beforeValidate()) {
            return false;
        }
        // Siempre derivar el código del nombre en altas; en edición se conserva el código existente (estabilidad RBAC).
        if ($this->isNewRecord && !empty($this->nombre)) {
            $this->codigo = self::generarCodigoDesdeNombre((string) $this->nombre);
        } elseif (
            !$this->isNewRecord
            && ($this->codigo === '' || $this->codigo === null)
            && !empty($this->nombre)
        ) {
            $this->codigo = self::generarCodigoDesdeNombre((string) $this->nombre);
        }
        if (!empty($this->codigo)) {
            $base = $this->codigo;
            $s = 0;
            while (true) {
                $q = static::find()->where(['codigo' => $this->codigo]);
                if (!$this->isNewRecord) {
                    $q->andWhere(['<>', 'id', $this->id]);
                }
                if (!$q->exists()) {
                    break;
                }
                $s++;
                $this->codigo = substr($base . '_' . $s, 0, 64);
            }
        }
        return true;
    }

    public function rules(): array
    {
        $rules = [
            [['descripcion', 'icono'], 'default', 'value' => null],
            [['activo'], 'default', 'value' => 1],
            [['descripcion'], 'string'],
            [['orden', 'activo'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'required'],
            // `codigo` se asigna en beforeValidate a partir de `nombre` (altas) o permanece en BD (ediciones).
            [['codigo'], 'required', 'when' => static function (self $m) {
                return !$m->isNewRecord;
            }],
            [['nombre'], 'string', 'max' => 100],
            [['codigo'], 'string', 'max' => 64],
            [['codigo'], 'match', 'pattern' => '/^[a-z0-9_]+$/', 'message' => Yii::t('app', 'Solo minúsculas, números y guión bajo.')],
            [['codigo'], 'unique'],
            [['icono'], 'string', 'max' => 50],
        ];
        if (static::hasEmpresaIdColumn()) {
            $rules[] = [['empresa_id'], 'required'];
            $rules[] = [['empresa_id'], 'integer'];
            $rules[] = [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresa_id' => 'id']];
        }
        return $rules;
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'codigo' => Yii::t('app', 'Código (permiso RBAC)'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'icono' => Yii::t('app', 'Icono'),
            'orden' => Yii::t('app', 'Orden'),
            'activo' => Yii::t('app', 'Activo'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'empresa_id' => Yii::t('app', 'Empresa'),
        ];
    }

    public function getEmpresa(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Empresas::class, ['id' => 'empresa_id']);
    }

    public function getNovedadConceptos(): \yii\db\ActiveQuery
    {
        return $this->hasMany(NovedadConcepto::class, ['novedad_tipo_id' => 'id']);
    }

    public function getNovedadFlujoPasos(): \yii\db\ActiveQuery
    {
        return $this->hasMany(NovedadFlujoPaso::class, ['novedad_tipo_id' => 'id']);
    }

    /**
     * Indica si el tipo tiene al menos un paso configurado en {@see novedad_flujo_paso} (flujo de aprobación).
     */
    public static function tipoTieneFlujoAprobacion(int $novedadTipoId): bool
    {
        if ($novedadTipoId <= 0) {
            return false;
        }

        return NovedadFlujoPaso::find()->where(['novedad_tipo_id' => $novedadTipoId])->exists();
    }

    public function getNovedads(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Novedad::class, ['novedad_tipo_id' => 'id']);
    }

    /** Nombre del permiso hijo de novedad.crear */
    public function getPermisoCrearNombre(): string
    {
        return 'novedad.crear.tipo.' . $this->codigo;
    }

    public function esTipoHoras(?string $codigoHorasParam = null): bool
    {
        $expected = $codigoHorasParam ?? (\Yii::$app->params['novedad_horas_tipo_codigo'] ?? 'horas');
        $c = $this->codigo;

        return $c !== null && $c !== '' && strcasecmp((string) $c, (string) $expected) === 0;
    }

    public function afterSave($insert, $changedAttributes): void
    {
        parent::afterSave($insert, $changedAttributes);
        if (!Yii::$app->has('authManager')) {
            return;
        }
        /** @var \yii\rbac\DbManager $auth */
        $auth = Yii::$app->authManager;
        $parent = $auth->getPermission('novedad.crear');
        if ($parent === null) {
            $p = $auth->createPermission('novedad.crear');
            $p->description = Yii::t('app', 'Crear novedades (agrupador por tipo)');
            $auth->add($p);
            $parent = $p;
        }
        if ($insert) {
            $this->syncTipoPermission($auth, $parent);
            return;
        }
        if (isset($changedAttributes['codigo']) && (string) $changedAttributes['codigo'] !== (string) $this->codigo) {
            $oldName = 'novedad.crear.tipo.' . $changedAttributes['codigo'];
            $oldPerm = $auth->getPermission($oldName);
            if ($oldPerm !== null) {
                $auth->remove($oldPerm);
            }
            $this->syncTipoPermission($auth, $parent);
        }
    }

    public function afterDelete(): void
    {
        parent::afterDelete();
        if (!Yii::$app->has('authManager')) {
            return;
        }
        /** @var \yii\rbac\DbManager $auth */
        $auth = Yii::$app->authManager;
        $name = 'novedad.crear.tipo.' . $this->codigo;
        $perm = $auth->getPermission($name);
        if ($perm !== null) {
            $auth->remove($perm);
        }
    }

    /** Genera slug para `codigo` a partir del nombre (único debe validarse aparte). */
    public static function generarCodigoDesdeNombre(string $nombre): string
    {
        $s = @iconv('UTF-8', 'ASCII//TRANSLIT', $nombre) ?: $nombre;
        $s = strtolower((string) $s);
        $s = preg_replace('/[^a-z0-9]+/', '_', $s);
        $s = trim((string) $s, '_');
        if ($s === '') {
            $s = 'tipo_' . substr(sha1($nombre . microtime(true)), 0, 10);
        }
        return substr($s, 0, 60);
    }

    private function syncTipoPermission(\yii\rbac\DbManager $auth, \yii\rbac\Permission $parent): void
    {
        $name = $this->getPermisoCrearNombre();
        if ($auth->getPermission($name) !== null) {
            return;
        }
        $child = $auth->createPermission($name);
        $child->description = Yii::t('app', 'Crear novedades del tipo: {n}', ['n' => $this->nombre]);
        $auth->add($child);
        if (!$auth->hasChild($parent, $child)) {
            $auth->addChild($parent, $child);
        }
    }
}
