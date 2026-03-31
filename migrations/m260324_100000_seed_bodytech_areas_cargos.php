<?php

use yii\db\Migration;

/**
 * Seed: Áreas, sub-áreas y cargos de Bodytech Colombia.
 *
 * Ejecutar: php yii migrate/up --migrationPath=@app/migrations
 */
class m260324_100000_seed_bodytech_areas_cargos extends Migration
{
    public function safeUp()
    {
        // ------------------------------------------------------------------ //
        // Empresa Bodytech
        // ------------------------------------------------------------------ //
        $empresa = (new \yii\db\Query())
            ->from('empresas')
            ->where(['slug' => 'bodytech-colombia'])
            ->one($this->db);

        if (!$empresa) {
            throw new \Exception('Empresa Bodytech no encontrada. Ejecuta primero m260323_200000_seed_bodytech_sedes.');
        }

        $empresaId = (int) $empresa['id'];

        // Usuario admin (id=5) para user_create en area
        $adminUser = (new \yii\db\Query())
            ->select('id')
            ->from('user')
            ->where(['username' => 'admin'])
            ->scalar($this->db);
        $adminUserId = (int) ($adminUser ?: 5);

        // ------------------------------------------------------------------ //
        // 1. Áreas principales (area_padre = NULL)
        // ------------------------------------------------------------------ //
        $areas = [
            'Operaciones',
            'VP Comercial',
        ];

        foreach ($areas as $nombre) {
            $this->insert('area', [
                'empresas_id' => $empresaId,
                'nombre'      => $nombre,
                'area_padre'  => null,
                'user_create' => $adminUserId,
            ]);
        }

        // ------------------------------------------------------------------ //
        // 2. Mapa área nombre → id
        // ------------------------------------------------------------------ //
        $areaRows = (new \yii\db\Query())
            ->select(['id', 'nombre'])
            ->from('area')
            ->where(['empresas_id' => $empresaId, 'area_padre' => null])
            ->all($this->db);

        $areaMap = [];
        foreach ($areaRows as $row) {
            $areaMap[$row['nombre']] = (int) $row['id'];
        }

        $idOperaciones = $areaMap['Operaciones'];
        $idVpComercial = $areaMap['VP Comercial'];

        // ------------------------------------------------------------------ //
        // 3. Sub-áreas (area_padre = área padre)
        // ------------------------------------------------------------------ //
        $subAreas = [
            ['nombre' => 'Operación Sedes',     'padre' => $idOperaciones],
            ['nombre' => 'Área Médica',          'padre' => $idOperaciones],
            ['nombre' => 'SMC Nuevos Productos', 'padre' => $idOperaciones],
            ['nombre' => 'Mantenimiento',        'padre' => $idOperaciones],
            ['nombre' => 'Ventas Counter',       'padre' => $idVpComercial],
        ];

        foreach ($subAreas as $sub) {
            $this->insert('area', [
                'empresas_id' => $empresaId,
                'nombre'      => $sub['nombre'],
                'area_padre'  => $sub['padre'],
                'user_create' => $adminUserId,
            ]);
        }

        // ------------------------------------------------------------------ //
        // 4. Mapa sub-área nombre → id
        // ------------------------------------------------------------------ //
        $subAreaRows = (new \yii\db\Query())
            ->select(['id', 'nombre'])
            ->from('area')
            ->where(['empresas_id' => $empresaId])
            ->andWhere(['is not', 'area_padre', null])
            ->all($this->db);

        $subAreaMap = [];
        foreach ($subAreaRows as $row) {
            $subAreaMap[$row['nombre']] = (int) $row['id'];
        }

        // ------------------------------------------------------------------ //
        // 5. Cargos
        // Formato: [nombre, area_id, sub_area_id]
        // ------------------------------------------------------------------ //
        $cargos = [
            ['Gerente / Director de sede',                          $idOperaciones, $subAreaMap['Operación Sedes']],
            ['Recepcionista / Agente de servicio al cliente',       $idOperaciones, $subAreaMap['Operación Sedes']],
            ['Auxiliar administrativo',                             $idOperaciones, $subAreaMap['Operación Sedes']],
            ['Entrenador personal (Personal Trainer)',              $idOperaciones, $subAreaMap['Área Médica']],
            ['Entrenador de planta',                                $idOperaciones, $subAreaMap['Área Médica']],
            ['Instructor de clases grupales',                       $idOperaciones, $subAreaMap['SMC Nuevos Productos']],
            ['Nutricionista',                                       $idOperaciones, $subAreaMap['Área Médica']],
            ['Auxiliar de mantenimiento / Técnico de equipos',      $idOperaciones, $subAreaMap['Mantenimiento']],
            ['Médico deportivo',                                    $idOperaciones, $subAreaMap['Área Médica']],
            ['Fisioterapeuta / Kinesiólogo',                        $idOperaciones, $subAreaMap['Área Médica']],
            ['Asesor comercial / Ejecutivo de ventas',              $idVpComercial, $subAreaMap['Ventas Counter']],
        ];

        foreach ($cargos as [$nombre, $areaId, $subAreaId]) {
            $this->insert('cargos', [
                'empresa_id'  => $empresaId,
                'area_id'     => $areaId,
                'sub_area_id' => $subAreaId,
                'nombre'      => $nombre,
                'activo'      => 1,
            ]);
        }

        echo "    > {$empresaId} empresa Bodytech encontrada.\n";
        echo "    > " . count($areas) . " áreas principales insertadas.\n";
        echo "    > " . count($subAreas) . " sub-áreas insertadas.\n";
        echo "    > " . count($cargos) . " cargos insertados.\n";
    }

    public function safeDown()
    {
        $empresa = (new \yii\db\Query())
            ->from('empresas')
            ->where(['slug' => 'bodytech-colombia'])
            ->one($this->db);

        if (!$empresa) {
            echo "    > Empresa Bodytech no encontrada, nada que revertir.\n";
            return;
        }

        $empresaId = (int) $empresa['id'];

        $this->delete('cargos', ['empresa_id' => $empresaId]);
        $this->delete('area',   ['empresas_id' => $empresaId]);

        echo "    > Cargos y áreas de Bodytech eliminados.\n";
    }
}
