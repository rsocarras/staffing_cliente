<?php

use yii\db\Migration;

/**
 * Seed: staffing_planta para Bodytech Colombia.
 *
 * 10 sedes × 22 posiciones autorizadas = 220 total.
 *
 * Distribución por sede:
 *   1  Gerente / Director de sede
 *   5  Asesor comercial / Ejecutivo de ventas
 *   5  Entrenador personal (Personal Trainer)
 *   5  Entrenador de planta
 *   1  Recepcionista / Agente de servicio al cliente
 *   1  Instructor de clases grupales
 *   1  Nutricionista
 *   1  Fisioterapeuta / Kinesiólogo
 *   1  Auxiliar administrativo
 *   1  Médico deportivo
 *  --
 *  22  por sede × 10 sedes = 220
 */
class m260324_120000_seed_bodytech_staffing_planta extends Migration
{
    public function safeUp(): void
    {
        $empresa = (new \yii\db\Query())
            ->from('empresas')
            ->where(['slug' => 'bodytech-colombia'])
            ->one($this->db);

        if (!$empresa) {
            throw new \Exception('Empresa Bodytech no encontrada.');
        }

        $empresaId = (int) $empresa['id'];

        // Las 10 sedes usadas en el seed de usuarios
        $sedeIds = [11, 12, 13, 14, 15, 16, 17, 18, 19, 20];

        // cargo_id => [area_id, sub_area_id, cantidad_autorizada]
        $plantaPorCargo = [
            8  => [6,  8,  1],   // Gerente
            18 => [7,  12, 5],   // Asesor comercial
            11 => [6,  9,  5],   // Entrenador PT
            12 => [6,  9,  5],   // Entrenador de planta
            9  => [6,  8,  1],   // Recepcionista
            13 => [6,  10, 1],   // Instructor
            14 => [6,  9,  1],   // Nutricionista
            17 => [6,  9,  1],   // Fisioterapeuta
            10 => [6,  8,  1],   // Auxiliar administrativo
            16 => [6,  9,  1],   // Médico deportivo
        ];

        $totalFilas = 0;
        $totalAutorizados = 0;

        foreach ($sedeIds as $sedeId) {
            foreach ($plantaPorCargo as $cargoId => [$areaId, $subAreaId, $cantidad]) {
                $this->insert('staffing_planta', [
                    'empresa_id'          => $empresaId,
                    'location_sede_id'    => $sedeId,
                    'area_id'             => $areaId,
                    'sub_area_id'         => $subAreaId,
                    'cargo_id'            => $cargoId,
                    'cantidad_autorizada' => $cantidad,
                    'activo'              => 1,
                    'created_by'          => 5,
                    'updated_by'          => 5,
                ]);
                $totalFilas++;
                $totalAutorizados += $cantidad;
            }
        }

        echo "    > {$totalFilas} filas en staffing_planta.\n";
        echo "    > {$totalAutorizados} posiciones autorizadas en total.\n";
    }

    public function safeDown(): void
    {
        $empresa = (new \yii\db\Query())
            ->from('empresas')
            ->where(['slug' => 'bodytech-colombia'])
            ->one($this->db);

        if (!$empresa) {
            echo "    > Empresa Bodytech no encontrada.\n";
            return;
        }

        $deleted = $this->delete('staffing_planta', [
            'empresa_id'       => $empresa['id'],
            'location_sede_id' => [11, 12, 13, 14, 15, 16, 17, 18, 19, 20],
        ]);

        echo "    > staffing_planta de Bodytech eliminado.\n";
    }
}
