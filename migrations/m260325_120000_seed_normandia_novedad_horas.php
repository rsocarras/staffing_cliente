<?php

use yii\db\Migration;

/**
 * Seed para pruebas de solicitud web de novedad tipo Horas (empresa 1, sede Normandía).
 *
 * - Verifica empresa_cliente id=2 activa para empresas_id=1.
 * - Enlaza un concepto del tipo «horas» con un cargo en `novedad_concepto_cargo` y `empresa_novedad_concepto`.
 * - Crea 5 empleados (user + profile + contrato) con contrato activo y sede Normandía.
 *
 * Documentos: NORMHD001 … NORMHD005 · contraseña: NormandiaNovedad2026!
 *
 * Ejecutar: php yii migrate/up --migrationPath=@app/migrations
 */
class m260325_120000_seed_normandia_novedad_horas extends Migration
{
    private const EMPRESA_ID = 1;
    private const EMPRESA_CLIENTE_ID = 2;
    private const DOC_PREFIX = 'NORMHD';
    private const PASSWORD_PLAIN = 'NormandiaNovedad2026!';

    public function safeUp(): void
    {
        $db = $this->db;

        $ecOk = (new \yii\db\Query())
            ->from('empresa_cliente')
            ->where([
                'id' => self::EMPRESA_CLIENTE_ID,
                'empresas_id' => self::EMPRESA_ID,
                'is_active' => 1,
            ])
            ->exists($db);
        if (!$ecOk) {
            echo "    ! Omitido: empresa_cliente id=" . self::EMPRESA_CLIENTE_ID
                . " no existe, no pertenece a empresa " . self::EMPRESA_ID . " o no está activa.\n";

            return;
        }

        $sedeId = (new \yii\db\Query())
            ->select('id')
            ->from('location_sedes')
            ->where(['empresa_id' => self::EMPRESA_ID, 'activo' => 1])
            ->andWhere(new \yii\db\Expression('LOWER([[nombre]]) LIKE :norm', [':norm' => '%normand%']))
            ->scalar($db);
        if (!$sedeId) {
            echo "    ! Omitido: no hay sede activa para empresa " . self::EMPRESA_ID
                . " cuyo nombre contenga «Normand» (Normandía).\n";

            return;
        }
        $sedeId = (int) $sedeId;

        $tipoHorasQ = (new \yii\db\Query())
            ->select('id')
            ->from('novedad_tipo')
            ->where(['activo' => 1, 'codigo' => 'horas']);
        $tipoSchema = $db->getTableSchema('novedad_tipo', true);
        if ($tipoSchema && $tipoSchema->getColumn('empresa_id') !== null) {
            $tipoHorasQ->andWhere([
                'or',
                ['empresa_id' => self::EMPRESA_ID],
                ['empresa_id' => null],
            ]);
        }
        $tipoHorasId = (int) ($tipoHorasQ->scalar($db) ?: 0);
        if ($tipoHorasId <= 0) {
            echo "    ! Omitido: no existe novedad_tipo activo con codigo «horas» para la empresa.\n";

            return;
        }

        $conceptoId = (new \yii\db\Query())
            ->select('nc.id')
            ->from(['nc' => 'novedad_concepto'])
            ->where([
                'nc.novedad_tipo_id' => $tipoHorasId,
                'nc.activo' => 1,
            ])
            ->orderBy(['nc.id' => SORT_ASC])
            ->scalar($db);
        if (!$conceptoId) {
            echo "    ! Omitido: no hay novedad_concepto activo para el tipo horas (id {$tipoHorasId}).\n";

            return;
        }
        $conceptoId = (int) $conceptoId;

        $cargoRow = (new \yii\db\Query())
            ->from('cargos')
            ->where(['empresa_id' => self::EMPRESA_ID, 'activo' => 1])
            ->orderBy(['id' => SORT_ASC])
            ->one($db);
        if (!$cargoRow) {
            echo "    ! Omitido: no hay cargo activo para empresa " . self::EMPRESA_ID . ".\n";

            return;
        }
        $cargoId = (int) $cargoRow['id'];
        $areaId = isset($cargoRow['area_id']) && $cargoRow['area_id'] !== null
            ? (int) $cargoRow['area_id']
            : null;
        $subAreaId = isset($cargoRow['sub_area_id']) && $cargoRow['sub_area_id'] !== null
            ? (int) $cargoRow['sub_area_id']
            : null;

        if ($areaId === null || $areaId <= 0) {
            $areaId = (new \yii\db\Query())
                ->select('id')
                ->from('area')
                ->where(['empresas_id' => self::EMPRESA_ID])
                ->orderBy(['id' => SORT_ASC])
                ->scalar($db);
            $areaId = $areaId ? (int) $areaId : null;
        }
        if ($areaId === null || $areaId <= 0) {
            echo "    ! Omitido: no se pudo resolver area_id para el contrato.\n";

            return;
        }

        $tipoContratoId = (new \yii\db\Query())
            ->select('id')
            ->from('contrato_tipos')
            ->where(['empresa_id' => self::EMPRESA_ID, 'activo' => 1])
            ->orderBy(['id' => SORT_ASC])
            ->scalar($db);
        if (!$tipoContratoId) {
            $tipoContratoId = (new \yii\db\Query())
                ->select('id')
                ->from('contrato_tipos')
                ->where(['activo' => 1])
                ->orderBy(['id' => SORT_ASC])
                ->scalar($db);
        }
        if (!$tipoContratoId) {
            echo "    ! Omitido: no hay contrato_tipos.\n";

            return;
        }
        $tipoContratoId = (int) $tipoContratoId;

        // Tenant habilita el concepto (idempotente)
        try {
            $this->db->createCommand()->insert('empresa_novedad_concepto', [
                'empresa_id' => self::EMPRESA_ID,
                'novedad_concepto_id' => $conceptoId,
                'created_at' => date('Y-m-d H:i:s'),
            ])->execute();
        } catch (\yii\db\IntegrityException $e) {
            echo "    > empresa_novedad_concepto ya existía para empresa/concepto.\n";
        }

        try {
            $this->db->createCommand()->insert('novedad_concepto_cargo', [
                'novedad_concepto_id' => $conceptoId,
                'cargo_id' => $cargoId,
            ])->execute();
        } catch (\yii\db\IntegrityException $e) {
            echo "    > novedad_concepto_cargo ya existía para concepto/cargo.\n";
        }

        $hash = password_hash(self::PASSWORD_PLAIN, PASSWORD_BCRYPT);
        $now = time();
        $nombres = [
            'Ana Normandía Ruiz',
            'Luis Normandía Pérez',
            'Marta Normandía Gómez',
            'Jorge Normandía Díaz',
            'Laura Normandía Soto',
        ];

        for ($i = 1; $i <= 5; $i++) {
            $doc = self::DOC_PREFIX . str_pad((string) $i, 3, '0', STR_PAD_LEFT);
            $exists = (new \yii\db\Query())
                ->from('profile')
                ->where(['num_doc' => $doc])
                ->exists($db);
            if ($exists) {
                echo "    > Ya existe profile con num_doc {$doc}, se omite.\n";
                continue;
            }

            $nombre = $nombres[$i - 1];
            $username = 'seed.normandia.' . $i;
            $email = "seed.normandia.{$i}@example.test";

            $this->db->createCommand()->insert('user', [
                'username' => $username,
                'email' => $email,
                'password_hash' => $hash,
                'auth_key' => substr(bin2hex(random_bytes(16)), 0, 32),
                'confirmed_at' => $now,
                'empresas_id' => self::EMPRESA_ID,
                'created_at' => $now,
                'updated_at' => $now,
                'flags' => 0,
            ])->execute();
            $userId = (int) $this->db->getLastInsertID();

            // profile.sede_id → FK legacy `sedes`; location_sede_id → `location_sedes` (Normandía).
            $this->db->createCommand()->insert('profile', [
                'user_id' => $userId,
                'tipo_doc' => 'CC',
                'num_doc' => $doc,
                'name' => $nombre,
                'empresas_id' => self::EMPRESA_ID,
                'estado' => 'activo',
                'sede_id' => null,
                'location_sede_id' => $sedeId,
                'cargo_id' => $cargoId,
                'area_id' => $areaId,
            ])->execute();

            $this->db->createCommand()->insert('contrato', [
                'empresa_id' => self::EMPRESA_ID,
                'profile_id' => $userId,
                'contrato_tipo_id' => $tipoContratoId,
                'area_id' => $areaId,
                'sub_area_id' => $subAreaId,
                'cargo_id' => $cargoId,
                'sede_id' => $sedeId,
                'estado' => 'activo',
                'fecha_inicio' => '2024-01-01',
                'fecha_fin' => null,
                'created_by' => null,
                'updated_by' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ])->execute();
        }

        echo "\n    ✓ empresa_novedad_concepto + novedad_concepto_cargo: concepto_id={$conceptoId}, cargo_id={$cargoId}\n";
        echo "    ✓ 5 empleados location_sede_id={$sedeId} (Normandía), empresa " . self::EMPRESA_ID . "\n";
        echo "    ✓ Use empresa cliente id " . self::EMPRESA_CLIENTE_ID . " en el formulario de novedad.\n";
        echo "    ✓ Docs: " . self::DOC_PREFIX . "001 … " . self::DOC_PREFIX . "005 · Clave: " . self::PASSWORD_PLAIN . "\n\n";
    }

    public function safeDown(): void
    {
        $docs = [];
        for ($i = 1; $i <= 5; $i++) {
            $docs[] = self::DOC_PREFIX . str_pad((string) $i, 3, '0', STR_PAD_LEFT);
        }
        $userIds = (new \yii\db\Query())
            ->select('user_id')
            ->from('profile')
            ->where(['num_doc' => $docs])
            ->column($this->db);
        if ($userIds === []) {
            echo "    > No hay empleados seed Normandía para eliminar.\n";

            return;
        }
        $cids = (new \yii\db\Query())
            ->select('id')
            ->from('contrato')
            ->where(['profile_id' => $userIds, 'empresa_id' => self::EMPRESA_ID])
            ->column($this->db);
        if ($cids !== []) {
            $this->delete('contrato_distribucion_sede', ['contrato_id' => $cids]);
            $this->delete('contrato', ['id' => $cids]);
        }
        $this->delete('profile', ['user_id' => $userIds]);
        $this->delete('user', ['id' => $userIds]);
        echo "    > Eliminados " . count($userIds) . " usuarios seed Normandía.\n";
        echo "    > (No se revierten empresa_novedad_concepto / novedad_concepto_cargo; quitar manualmente si aplica.)\n";
    }
}
