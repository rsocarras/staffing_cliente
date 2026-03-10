<?php

use yii\db\Migration;
use yii\db\Query;

class m260310150000_seed_administracion_planta_demo_data extends Migration
{
    private const SEED_TYPE_CODE = 'SEED-PLANTA-INDEF';
    private const SEED_CARGO_CODE = 'SEED-PLANTA-OPS';
    private const SEED_SEDES = [
        'north' => [
            'codigo' => 'SEED-PLANTA-NORTE',
            'nombre' => 'Sede Operativa Norte Seed',
            'tipo_sede' => 'operativa',
        ],
        'south' => [
            'codigo' => 'SEED-PLANTA-SUR',
            'nombre' => 'Sede Operativa Sur Seed',
            'tipo_sede' => 'operativa',
        ],
        'corp' => [
            'codigo' => 'SEED-PLANTA-CORP',
            'nombre' => 'Sede Corporativa Seed',
            'tipo_sede' => 'administrativa',
        ],
    ];
    private const SEED_EMPLOYEES = [
        'seed_planta_activo' => [
            'email' => 'seed_planta_activo@example.com',
            'doc' => 'SEED1001',
            'name' => 'Empleado Seed Activo',
            'position' => 'Analista Planta Seed',
        ],
        'seed_planta_licencia' => [
            'email' => 'seed_planta_licencia@example.com',
            'doc' => 'SEED1002',
            'name' => 'Empleado Seed Licencia',
            'position' => 'Especialista Planta Seed',
        ],
        'seed_planta_suspendido' => [
            'email' => 'seed_planta_suspendido@example.com',
            'doc' => 'SEED1003',
            'name' => 'Empleado Seed Suspendido',
            'position' => 'Lider Planta Seed',
        ],
        'seed_planta_incapacidad' => [
            'email' => 'seed_planta_incapacidad@example.com',
            'doc' => 'SEED1004',
            'name' => 'Empleado Seed Incapacidad',
            'position' => 'Analista Operaciones Seed',
        ],
    ];

    private $empresaId;
    private $cityId;
    private $adminUserId;
    private $areaId;
    private $subAreaPrincipalId;
    private $subAreaSecundariaId;
    private $cargoManagerId;
    private $cargoDevId;
    private $cargoOpsId;
    private $contratoTipoId;
    private $sedeNorthId;
    private $sedeSouthId;
    private $sedeCorpId;

    public function safeUp()
    {
        if (!$this->resolveContext()) {
            echo "No se encontro contexto base para sembrar administracion de planta.\n";
            return;
        }

        $this->contratoTipoId = $this->ensureContratoTipo();
        $this->ensureSedes();
        $this->ensureCargos();

        $employees = $this->ensureEmployees();
        $contracts = $this->ensureContracts($employees);
        $plantaRows = $this->ensurePlantaRows();
        $this->ensureHistory($plantaRows);

        echo "Seed de administracion de planta aplicado sobre empresa {$this->empresaId}.\n";
        echo "Contratos seed: " . count($contracts) . ". Registros de planta seed: " . count($plantaRows) . ".\n";
    }

    public function safeDown()
    {
        $empresaId = $this->resolveEmpresaId();
        if ($empresaId === null) {
            return;
        }

        $seedUserIds = (new Query())
            ->select('id')
            ->from('user')
            ->where(['username' => array_keys(self::SEED_EMPLOYEES)])
            ->column($this->db);

        if (!empty($seedUserIds)) {
            $contractIds = (new Query())
                ->select('id')
                ->from('contrato')
                ->where(['profile_id' => $seedUserIds])
                ->column($this->db);

            $plantaIds = (new Query())
                ->select('id')
                ->from('staffing_planta')
                ->where(['location_sede_id' => $this->findSeedSedeIds($empresaId)])
                ->column($this->db);

            if (!empty($plantaIds)) {
                $this->delete('staffing_planta_historial', ['planta_id' => $plantaIds]);
                $this->delete('staffing_planta', ['id' => $plantaIds]);
            }

            if (!empty($contractIds)) {
                $this->delete('contrato_distribucion_sede', ['contrato_id' => $contractIds]);
                $this->delete('contrato', ['id' => $contractIds]);
            }

            $this->delete('profile', ['user_id' => $seedUserIds]);
            $this->delete('user', ['id' => $seedUserIds]);
        }

        $this->delete('cargos', [
            'empresa_id' => $empresaId,
            'codigo' => self::SEED_CARGO_CODE,
        ]);

        $this->delete('location_sedes', [
            'empresa_id' => $empresaId,
            'codigo' => array_column(self::SEED_SEDES, 'codigo'),
        ]);

        $this->delete('contrato_tipos', [
            'empresa_id' => null,
            'code' => self::SEED_TYPE_CODE,
        ]);
    }

    private function resolveContext()
    {
        $this->empresaId = $this->resolveEmpresaId();
        if ($this->empresaId === null) {
            return false;
        }

        $this->cityId = (new Query())
            ->select('city_id')
            ->from('location_sedes')
            ->where(['empresa_id' => $this->empresaId])
            ->andWhere(['not', ['city_id' => null]])
            ->orderBy(['id' => SORT_ASC])
            ->scalar($this->db);

        $this->adminUserId = (new Query())
            ->select('id')
            ->from('user')
            ->where(['username' => 'admin', 'empresas_id' => $this->empresaId])
            ->scalar($this->db);

        if ($this->adminUserId === false || $this->adminUserId === null) {
            $this->adminUserId = (new Query())
                ->select('user_id')
                ->from('profile')
                ->where(['empresas_id' => $this->empresaId])
                ->orderBy(['user_id' => SORT_ASC])
                ->scalar($this->db);
        }

        $this->areaId = (new Query())
            ->select('id')
            ->from('area')
            ->where(['empresas_id' => $this->empresaId])
            ->andWhere(['or', ['area_padre' => null], ['area_padre' => 0]])
            ->orderBy(['id' => SORT_ASC])
            ->scalar($this->db);

        if ($this->areaId === false || $this->areaId === null) {
            return false;
        }

        $subAreas = (new Query())
            ->select(['id'])
            ->from('area')
            ->where(['empresas_id' => $this->empresaId, 'area_padre' => $this->areaId])
            ->orderBy(['id' => SORT_ASC])
            ->column($this->db);

        $this->subAreaPrincipalId = !empty($subAreas) ? (int) $subAreas[0] : (int) $this->areaId;
        $this->subAreaSecundariaId = count($subAreas) > 1 ? (int) $subAreas[1] : (int) $this->subAreaPrincipalId;

        return true;
    }

    private function resolveEmpresaId()
    {
        $empresaId = (new Query())
            ->select('id')
            ->from('empresas')
            ->where(['id' => 1])
            ->scalar($this->db);

        if ($empresaId !== false && $empresaId !== null) {
            return (int) $empresaId;
        }

        $empresaId = (new Query())
            ->select('empresas_id')
            ->from('profile')
            ->orderBy(['empresas_id' => SORT_ASC])
            ->scalar($this->db);

        return $empresaId !== false && $empresaId !== null ? (int) $empresaId : null;
    }

    private function ensureContratoTipo()
    {
        $id = (new Query())
            ->select('id')
            ->from('contrato_tipos')
            ->where([
                'empresa_id' => null,
                'code' => self::SEED_TYPE_CODE,
            ])
            ->scalar($this->db);

        if ($id !== false && $id !== null) {
            return (int) $id;
        }

        $this->insert('contrato_tipos', [
            'empresa_id' => null,
            'code' => self::SEED_TYPE_CODE,
            'nombre' => 'Contrato indefinido seed planta',
            'descripcion' => 'Tipo de contrato semilla para el modulo de administracion de planta',
            'requiere_fecha_fin' => 0,
            'es_indefinido' => 1,
            'duracion_dias_default' => null,
            'activo' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return (int) $this->db->getLastInsertID();
    }

    private function ensureSedes()
    {
        $this->sedeNorthId = $this->ensureSede(self::SEED_SEDES['north']);
        $this->sedeSouthId = $this->ensureSede(self::SEED_SEDES['south']);
        $this->sedeCorpId = $this->ensureSede(self::SEED_SEDES['corp']);
    }

    private function ensureSede(array $data)
    {
        $id = (new Query())
            ->select('id')
            ->from('location_sedes')
            ->where([
                'empresa_id' => $this->empresaId,
                'codigo' => $data['codigo'],
            ])
            ->scalar($this->db);

        if ($id !== false && $id !== null) {
            $this->update('location_sedes', [
                'nombre' => $data['nombre'],
                'tipo_sede' => $data['tipo_sede'],
                'activo' => 1,
                'city_id' => $this->cityId,
                'updated_at' => date('Y-m-d H:i:s'),
            ], ['id' => $id]);

            return (int) $id;
        }

        $this->insert('location_sedes', [
            'empresa_id' => $this->empresaId,
            'city_id' => $this->cityId,
            'codigo' => $data['codigo'],
            'nombre' => $data['nombre'],
            'direccion' => 'Seed administracion de planta',
            'activo' => 1,
            'tipo_sede' => $data['tipo_sede'],
            'centro_costo' => null,
            'centro_costo_staffing' => null,
            'codigo_externo' => $data['codigo'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return (int) $this->db->getLastInsertID();
    }

    private function ensureCargos()
    {
        $principalCargoIds = (new Query())
            ->select('id')
            ->from('cargos')
            ->where([
                'empresa_id' => $this->empresaId,
                'sub_area_id' => $this->subAreaPrincipalId,
                'activo' => 1,
            ])
            ->orderBy(['id' => SORT_ASC])
            ->column($this->db);

        $this->cargoManagerId = !empty($principalCargoIds)
            ? (int) $principalCargoIds[0]
            : $this->createCargo('SEED-PLANTA-MANAGER', 'Lider tecnico seed planta', $this->subAreaPrincipalId);

        $this->cargoDevId = count($principalCargoIds) > 1
            ? (int) $principalCargoIds[1]
            : $this->findOrCreateCargo($this->subAreaPrincipalId, 'SEED-PLANTA-DEV', 'Desarrollador full stack seed planta');

        $this->cargoOpsId = $this->findOrCreateCargo(
            $this->subAreaSecundariaId,
            self::SEED_CARGO_CODE,
            'Analista debito automatico seed'
        );
    }

    private function findOrCreateCargo($subAreaId, $codigo, $nombre)
    {
        $id = (new Query())
            ->select('id')
            ->from('cargos')
            ->where([
                'empresa_id' => $this->empresaId,
                'sub_area_id' => $subAreaId,
                'activo' => 1,
            ])
            ->orderBy(['id' => SORT_ASC])
            ->scalar($this->db);

        if ($id !== false && $id !== null && $codigo !== self::SEED_CARGO_CODE) {
            return (int) $id;
        }

        $id = (new Query())
            ->select('id')
            ->from('cargos')
            ->where([
                'empresa_id' => $this->empresaId,
                'codigo' => $codigo,
            ])
            ->scalar($this->db);

        if ($id !== false && $id !== null) {
            $this->update('cargos', [
                'area_id' => $this->areaId,
                'sub_area_id' => $subAreaId,
                'nombre' => $nombre,
                'activo' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
            ], ['id' => $id]);

            return (int) $id;
        }

        return $this->createCargo($codigo, $nombre, $subAreaId);
    }

    private function createCargo($codigo, $nombre, $subAreaId)
    {
        $this->insert('cargos', [
            'empresa_id' => $this->empresaId,
            'area_id' => $this->areaId,
            'sub_area_id' => $subAreaId,
            'codigo' => $codigo,
            'nombre' => $nombre,
            'descripcion' => 'Cargo seed para visualizacion del modulo de administracion de planta',
            'activo' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return (int) $this->db->getLastInsertID();
    }

    private function ensureEmployees()
    {
        $employees = [];

        foreach (self::SEED_EMPLOYEES as $username => $data) {
            $employees[$username] = $this->ensureEmployee($username, $data);
        }

        return $employees;
    }

    private function ensureEmployee($username, array $data)
    {
        $userId = (new Query())
            ->select('id')
            ->from('user')
            ->where(['username' => $username])
            ->scalar($this->db);

        $nowUnix = time();

        if ($userId === false || $userId === null) {
            $this->insert('user', [
                'uuid' => null,
                'username' => $username,
                'email' => $data['email'],
                'phone' => null,
                'password_hash' => Yii::$app->security->generatePasswordHash('SeedPlanta#2026'),
                'auth_key' => substr(Yii::$app->security->generateRandomString(), 0, 32),
                'unconfirmed_email' => null,
                'registration_ip' => '127.0.0.1',
                'flags' => 0,
                'confirmed_at' => $nowUnix,
                'blocked_at' => null,
                'updated_at' => $nowUnix,
                'created_at' => $nowUnix,
                'last_login_at' => null,
                'last_login_ip' => null,
                'auth_tf_key' => null,
                'auth_tf_enabled' => 0,
                'auth_tf_type' => null,
                'auth_tf_mobile_phone' => null,
                'password_changed_at' => $nowUnix,
                'gdpr_consent' => 0,
                'gdpr_consent_date' => null,
                'gdpr_deleted' => 0,
                'empresas_id' => $this->empresaId,
            ]);
            $userId = (int) $this->db->getLastInsertID();
        } else {
            $userId = (int) $userId;
            $this->update('user', [
                'email' => $data['email'],
                'updated_at' => $nowUnix,
                'empresas_id' => $this->empresaId,
            ], ['id' => $userId]);
        }

        $profileExists = (new Query())
            ->from('profile')
            ->where(['user_id' => $userId])
            ->exists($this->db);

        $profileData = [
            'tipo_doc' => 'CC',
            'num_doc' => $data['doc'],
            'name' => $data['name'],
            'public_email' => $data['email'],
            'gravatar_email' => null,
            'gravatar_id' => null,
            'location' => null,
            'timezone' => 'America/Bogota',
            'bio' => 'Empleado seed para validacion visual del modulo de administracion de planta',
            'sexo' => null,
            'empresas_id' => $this->empresaId,
            'about' => null,
            'estado' => 'activo',
            'telefono' => null,
            'birthday' => null,
            'position' => $data['position'],
            'photo_' => null,
            'instagram' => null,
            'tiktok' => null,
            'linkedin' => null,
            'youtube' => null,
            'website' => null,
            'address' => null,
            'data_json' => null,
            'sede_id' => null,
            'cargo_id' => null,
            'centro_costo_id' => null,
            'centro_utilidad_id' => null,
            'city' => null,
            'area_id' => $this->areaId,
        ];

        if ($profileExists) {
            $this->update('profile', $profileData, ['user_id' => $userId]);
        } else {
            $profileData['user_id'] = $userId;
            $this->insert('profile', $profileData);
        }

        return $userId;
    }

    private function ensureContracts(array $employees)
    {
        $today = new DateTimeImmutable('today');
        $startDate = $today->modify('-45 days')->format('Y-m-d');

        $contracts = [];
        $contracts['activo'] = $this->upsertContract([
            'profile_id' => $employees['seed_planta_activo'],
            'cargo_id' => $this->cargoDevId,
            'sub_area_id' => $this->subAreaPrincipalId,
            'sede_id' => $this->sedeNorthId,
            'estado' => 'activo',
            'fecha_inicio' => $startDate,
        ]);
        $contracts['licencia'] = $this->upsertContract([
            'profile_id' => $employees['seed_planta_licencia'],
            'cargo_id' => $this->cargoDevId,
            'sub_area_id' => $this->subAreaPrincipalId,
            'sede_id' => $this->sedeNorthId,
            'estado' => 'licencia',
            'fecha_inicio' => $today->modify('-20 days')->format('Y-m-d'),
        ]);
        $contracts['suspendido'] = $this->upsertContract([
            'profile_id' => $employees['seed_planta_suspendido'],
            'cargo_id' => $this->cargoManagerId,
            'sub_area_id' => $this->subAreaPrincipalId,
            'sede_id' => $this->sedeSouthId,
            'estado' => 'suspendido',
            'fecha_inicio' => $today->modify('-12 days')->format('Y-m-d'),
        ]);
        $contracts['incapacidad'] = $this->upsertContract([
            'profile_id' => $employees['seed_planta_incapacidad'],
            'cargo_id' => $this->cargoOpsId,
            'sub_area_id' => $this->subAreaSecundariaId,
            'sede_id' => $this->sedeCorpId,
            'estado' => 'incapacidad',
            'fecha_inicio' => $today->modify('-8 days')->format('Y-m-d'),
        ]);

        $this->upsertDistribution($contracts['licencia'], $this->sedeNorthId, 50.00);
        $this->upsertDistribution($contracts['licencia'], $this->sedeSouthId, 50.00);

        return $contracts;
    }

    private function upsertContract(array $data)
    {
        $id = (new Query())
            ->select('id')
            ->from('contrato')
            ->where(['profile_id' => $data['profile_id']])
            ->scalar($this->db);

        $payload = [
            'empresa_id' => $this->empresaId,
            'profile_id' => $data['profile_id'],
            'contrato_tipo_id' => $this->contratoTipoId,
            'area_id' => $this->areaId,
            'sub_area_id' => $data['sub_area_id'],
            'cargo_id' => $data['cargo_id'],
            'sede_id' => $data['sede_id'],
            'estado' => $data['estado'],
            'fecha_inicio' => $data['fecha_inicio'],
            'fecha_fin' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->adminUserId,
            'updated_by' => $this->adminUserId,
        ];

        if ($id !== false && $id !== null) {
            $this->update('contrato', $payload, ['id' => $id]);
            return (int) $id;
        }

        $this->insert('contrato', $payload);
        return (int) $this->db->getLastInsertID();
    }

    private function upsertDistribution($contratoId, $sedeId, $porcentaje)
    {
        $exists = (new Query())
            ->from('contrato_distribucion_sede')
            ->where([
                'contrato_id' => $contratoId,
                'sede_id' => $sedeId,
            ])
            ->exists($this->db);

        $payload = [
            'porcentaje' => $porcentaje,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->adminUserId,
            'updated_by' => $this->adminUserId,
        ];

        if ($exists) {
            $this->update('contrato_distribucion_sede', $payload, [
                'contrato_id' => $contratoId,
                'sede_id' => $sedeId,
            ]);
            return;
        }

        $payload['contrato_id'] = $contratoId;
        $payload['sede_id'] = $sedeId;
        $this->insert('contrato_distribucion_sede', $payload);
    }

    private function ensurePlantaRows()
    {
        return [
            'north_dev' => $this->upsertPlanta([
                'location_sede_id' => $this->sedeNorthId,
                'area_id' => $this->areaId,
                'sub_area_id' => $this->subAreaPrincipalId,
                'cargo_id' => $this->cargoDevId,
                'cantidad_autorizada' => 3.00,
            ]),
            'south_dev' => $this->upsertPlanta([
                'location_sede_id' => $this->sedeSouthId,
                'area_id' => $this->areaId,
                'sub_area_id' => $this->subAreaPrincipalId,
                'cargo_id' => $this->cargoDevId,
                'cantidad_autorizada' => 0.25,
            ]),
            'south_manager' => $this->upsertPlanta([
                'location_sede_id' => $this->sedeSouthId,
                'area_id' => $this->areaId,
                'sub_area_id' => $this->subAreaPrincipalId,
                'cargo_id' => $this->cargoManagerId,
                'cantidad_autorizada' => 0.50,
            ]),
            'corp_ops' => $this->upsertPlanta([
                'location_sede_id' => $this->sedeCorpId,
                'area_id' => $this->areaId,
                'sub_area_id' => $this->subAreaSecundariaId,
                'cargo_id' => $this->cargoOpsId,
                'cantidad_autorizada' => 1.00,
            ]),
        ];
    }

    private function upsertPlanta(array $data)
    {
        $id = (new Query())
            ->select('id')
            ->from('staffing_planta')
            ->where([
                'empresa_id' => $this->empresaId,
                'location_sede_id' => $data['location_sede_id'],
                'area_id' => $data['area_id'],
                'sub_area_id' => $data['sub_area_id'],
                'cargo_id' => $data['cargo_id'],
            ])
            ->scalar($this->db);

        $payload = [
            'empresa_id' => $this->empresaId,
            'location_sede_id' => $data['location_sede_id'],
            'area_id' => $data['area_id'],
            'sub_area_id' => $data['sub_area_id'],
            'cargo_id' => $data['cargo_id'],
            'cantidad_autorizada' => $data['cantidad_autorizada'],
            'activo' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->adminUserId,
            'updated_by' => $this->adminUserId,
        ];

        if ($id !== false && $id !== null) {
            $this->update('staffing_planta', $payload, ['id' => $id]);
            return (int) $id;
        }

        $this->insert('staffing_planta', $payload);
        return (int) $this->db->getLastInsertID();
    }

    private function ensureHistory(array $plantaRows)
    {
        $labels = [
            'location_sede_id' => [
                $plantaRows['north_dev'] => self::SEED_SEDES['north']['nombre'],
                $plantaRows['south_dev'] => self::SEED_SEDES['south']['nombre'],
                $plantaRows['south_manager'] => self::SEED_SEDES['south']['nombre'],
                $plantaRows['corp_ops'] => self::SEED_SEDES['corp']['nombre'],
            ],
            'area_id' => array_fill_keys(array_values($plantaRows), $this->findAreaName($this->areaId)),
            'sub_area_id' => [
                $plantaRows['north_dev'] => $this->findAreaName($this->subAreaPrincipalId),
                $plantaRows['south_dev'] => $this->findAreaName($this->subAreaPrincipalId),
                $plantaRows['south_manager'] => $this->findAreaName($this->subAreaPrincipalId),
                $plantaRows['corp_ops'] => $this->findAreaName($this->subAreaSecundariaId),
            ],
            'cargo_id' => [
                $plantaRows['north_dev'] => $this->findCargoName($this->cargoDevId),
                $plantaRows['south_dev'] => $this->findCargoName($this->cargoDevId),
                $plantaRows['south_manager'] => $this->findCargoName($this->cargoManagerId),
                $plantaRows['corp_ops'] => $this->findCargoName($this->cargoOpsId),
            ],
        ];

        $quantities = [
            $plantaRows['north_dev'] => '3.00',
            $plantaRows['south_dev'] => '0.25',
            $plantaRows['south_manager'] => '0.50',
            $plantaRows['corp_ops'] => '1.00',
        ];

        foreach ($plantaRows as $plantaId) {
            $hasHistory = (new Query())
                ->from('staffing_planta_historial')
                ->where(['planta_id' => $plantaId])
                ->exists($this->db);

            if ($hasHistory) {
                continue;
            }

            $this->insertHistory($plantaId, 'cantidad_autorizada', null, $quantities[$plantaId], 'create');
            $this->insertHistory($plantaId, 'location_sede_id', null, $labels['location_sede_id'][$plantaId], 'create');
            $this->insertHistory($plantaId, 'area_id', null, $labels['area_id'][$plantaId], 'create');
            $this->insertHistory($plantaId, 'sub_area_id', null, $labels['sub_area_id'][$plantaId], 'create');
            $this->insertHistory($plantaId, 'cargo_id', null, $labels['cargo_id'][$plantaId], 'create');
            $this->insertHistory($plantaId, 'activo', null, 'Activo', 'create');
        }

        $updateExists = (new Query())
            ->from('staffing_planta_historial')
            ->where([
                'planta_id' => $plantaRows['north_dev'],
                'campo' => 'cantidad_autorizada',
                'accion' => 'update',
            ])
            ->exists($this->db);

        if (!$updateExists) {
            $this->insertHistory($plantaRows['north_dev'], 'cantidad_autorizada', '2.50', '3.00', 'update');
        }
    }

    private function insertHistory($plantaId, $campo, $valorAnterior, $valorNuevo, $accion)
    {
        $this->insert('staffing_planta_historial', [
            'planta_id' => $plantaId,
            'campo' => $campo,
            'valor_anterior' => $valorAnterior,
            'valor_nuevo' => $valorNuevo,
            'accion' => $accion,
            'user_id' => $this->adminUserId,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    private function findAreaName($areaId)
    {
        return (new Query())
            ->select('nombre')
            ->from('area')
            ->where(['id' => $areaId])
            ->scalar($this->db);
    }

    private function findCargoName($cargoId)
    {
        return (new Query())
            ->select('nombre')
            ->from('cargos')
            ->where(['id' => $cargoId])
            ->scalar($this->db);
    }

    private function findSeedSedeIds($empresaId)
    {
        return (new Query())
            ->select('id')
            ->from('location_sedes')
            ->where([
                'empresa_id' => $empresaId,
                'codigo' => array_column(self::SEED_SEDES, 'codigo'),
            ])
            ->column($this->db);
    }
}
