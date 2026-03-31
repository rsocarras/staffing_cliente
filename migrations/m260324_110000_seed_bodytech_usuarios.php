<?php

use yii\db\Migration;

/**
 * Seed: ~201 usuarios, perfiles y contratos para Bodytech Colombia.
 *
 * Distribución por sede (10 sedes: IDs 11-20):
 *   - 1  Gerente / Director de sede
 *   - 4-5 Asesor comercial / Ejecutivo de ventas
 *   - 4-5 Entrenador personal (Personal Trainer)
 *   - 4-5 Entrenador de planta
 *   - 1  Recepcionista
 *   - 1  Instructor de clases grupales
 *   - 1  Nutricionista
 *   - 1  Fisioterapeuta / Kinesiólogo
 *   - 1  Auxiliar administrativo
 *   + 6  Médicos deportivos con distribución en 2-3 sedes c/u
 *
 * Contraseña por defecto: Bodytech2026!
 * Ejecutar: php yii migrate/up --migrationPath=@app/migrations
 */
class m260324_110000_seed_bodytech_usuarios extends Migration
{
    // ------------------------------------------------------------------ //
    // Estado interno del generador de identidades
    // ------------------------------------------------------------------ //
    private int   $docSeq  = 1000000001;
    private int   $nameIdx = 0;
    private array $usedUsernames = [];
    private string $pwdHash = '';

    private array $maleNames = [
        'Juan', 'Carlos', 'Miguel', 'Andres', 'David', 'Luis', 'Jorge', 'Sergio',
        'Daniel', 'Felipe', 'Alejandro', 'Diego', 'Nicolas', 'Sebastian', 'Camilo',
        'Gabriel', 'Mauricio', 'Ricardo', 'Eduardo', 'Fernando', 'Hernan', 'Oscar',
        'Gustavo', 'Roberto', 'Jaime', 'Ivan', 'Pablo', 'Santiago', 'Rodrigo', 'Manuel',
    ];

    private array $femaleNames = [
        'Maria', 'Ana', 'Carolina', 'Valentina', 'Isabella', 'Mariana', 'Laura',
        'Daniela', 'Paula', 'Juliana', 'Natalia', 'Camila', 'Andrea', 'Paola',
        'Sandra', 'Diana', 'Claudia', 'Monica', 'Catalina', 'Alejandra', 'Ximena',
        'Lina', 'Adriana', 'Vanessa', 'Veronica', 'Luisa', 'Karen', 'Jessica',
        'Stephanie', 'Tatiana',
    ];

    private array $lastNames = [
        'Garcia', 'Rodriguez', 'Martinez', 'Hernandez', 'Lopez', 'Gonzalez', 'Perez',
        'Sanchez', 'Ramirez', 'Torres', 'Flores', 'Rivera', 'Gomez', 'Diaz', 'Reyes',
        'Morales', 'Jimenez', 'Vargas', 'Castillo', 'Mendoza', 'Ruiz', 'Alvarez',
        'Romero', 'Herrera', 'Medina', 'Suarez', 'Guerrero', 'Munoz', 'Ortega', 'Rios',
        'Delgado', 'Rojas', 'Pena', 'Vega', 'Cruz', 'Acosta', 'Pinto', 'Cardenas',
        'Ramos', 'Escobar', 'Valencia', 'Ospina', 'Arango', 'Mejia', 'Quintero',
        'Salazar', 'Figueroa', 'Castro', 'Moreno', 'Cortes',
    ];

    // ------------------------------------------------------------------ //
    // Cargos / Áreas / Sub-áreas  (IDs de la BD después del seed anterior)
    // ------------------------------------------------------------------ //
    // cargo_id => [area_id, sub_area_id]
    private array $cargoMeta = [
        8  => [6, 8],  // Gerente               → Operaciones / Operación Sedes
        9  => [6, 8],  // Recepcionista          → Operaciones / Operación Sedes
        10 => [6, 8],  // Auxiliar administrativo→ Operaciones / Operación Sedes
        11 => [6, 9],  // Entrenador PT          → Operaciones / Área Médica
        12 => [6, 9],  // Entrenador de planta   → Operaciones / Área Médica
        13 => [6, 10], // Instructor             → Operaciones / SMC Nuevos Productos
        14 => [6, 9],  // Nutricionista          → Operaciones / Área Médica
        15 => [6, 11], // Auxiliar mantenimiento → Operaciones / Mantenimiento
        16 => [6, 9],  // Médico deportivo       → Operaciones / Área Médica
        17 => [6, 9],  // Fisioterapeuta         → Operaciones / Área Médica
        18 => [7, 12], // Asesor comercial       → VP Comercial / Ventas Counter
    ];

    // ------------------------------------------------------------------ //
    public function safeUp(): void
    // ------------------------------------------------------------------ //
    {
        $this->pwdHash = password_hash('Bodytech2026!', PASSWORD_BCRYPT);

        $sedeIds = [11, 12, 13, 14, 15, 16, 17, 18, 19, 20];

        // Variación 4-5 por sede para llegar a exactamente 45 en cada rol
        //                   s0  s1  s2  s3  s4  s5  s6  s7  s8  s9
        $cntAsesores = [5,  4,  5,  4,  5,  4,  5,  4,  5,  4]; // 45
        $cntPT       = [5,  4,  5,  4,  4,  5,  5,  4,  4,  5]; // 45
        $cntEP       = [4,  5,  4,  5,  5,  4,  4,  5,  5,  4]; // 45

        $total = 0;

        foreach ($sedeIds as $idx => $sedeId) {

            // 1 Gerente
            $this->crearEmpleado(8, $sedeId, '2021-01-15');
            $total++;

            // 4-5 Asesores comerciales
            for ($i = 0; $i < $cntAsesores[$idx]; $i++) {
                $this->crearEmpleado(18, $sedeId, '2022-03-01');
                $total++;
            }

            // 4-5 Entrenadores Personal Trainer
            for ($i = 0; $i < $cntPT[$idx]; $i++) {
                $this->crearEmpleado(11, $sedeId, '2022-06-01');
                $total++;
            }

            // 4-5 Entrenadores de planta
            for ($i = 0; $i < $cntEP[$idx]; $i++) {
                $this->crearEmpleado(12, $sedeId, '2021-08-01');
                $total++;
            }

            // 1 Recepcionista
            $this->crearEmpleado(9, $sedeId, '2023-01-10');
            $total++;

            // 1 Instructor de clases grupales
            $this->crearEmpleado(13, $sedeId, '2022-09-01');
            $total++;

            // 1 Nutricionista
            $this->crearEmpleado(14, $sedeId, '2023-04-01');
            $total++;

            // 1 Fisioterapeuta / Kinesiólogo
            $this->crearEmpleado(17, $sedeId, '2023-02-01');
            $total++;

            // 1 Auxiliar administrativo
            $this->crearEmpleado(10, $sedeId, '2022-11-01');
            $total++;
        }

        // ---------------------------------------------------------------- //
        // 6 Médicos deportivos — distribuidos en 2-3 sedes c/u
        // [sede_principal, [sede_id => porcentaje, ...]]  (suma = 100)
        // ---------------------------------------------------------------- //
        $medicosConfig = [
            [11, [11 => 34, 12 => 33, 13 => 33]],  // Médico 1: sedes 11-13
            [14, [14 => 50, 15 => 50]],             // Médico 2: sedes 14-15
            [16, [16 => 34, 17 => 33, 18 => 33]],  // Médico 3: sedes 16-18
            [19, [19 => 50, 20 => 50]],             // Médico 4: sedes 19-20
            [11, [11 => 34, 13 => 33, 15 => 33]],  // Médico 5: sedes 11,13,15
            [12, [12 => 34, 16 => 33, 20 => 33]],  // Médico 6: sedes 12,16,20
        ];

        foreach ($medicosConfig as [$sedePrincipal, $distribucion]) {
            $userId = $this->crearEmpleado(16, $sedePrincipal, '2021-03-01');
            $total++;

            $contratoId = (new \yii\db\Query())
                ->select('id')
                ->from('contrato')
                ->where(['profile_id' => $userId, 'empresa_id' => 3])
                ->scalar($this->db);

            foreach ($distribucion as $distSedeId => $porcentaje) {
                $this->db->createCommand()->insert('contrato_distribucion_sede', [
                    'contrato_id' => $contratoId,
                    'sede_id'     => $distSedeId,
                    'porcentaje'  => $porcentaje,
                    'created_by'  => 5,
                    'updated_by'  => 5,
                ])->execute();
            }
        }

        echo "\n    ✓ {$total} usuarios Bodytech creados (user + profile + contrato).\n";
        echo "    ✓ 6 médicos con distribución multi-sede en contrato_distribucion_sede.\n";
        echo "    ✓ Contraseña por defecto: Bodytech2026!\n\n";
    }

    // ------------------------------------------------------------------ //
    private function crearEmpleado(int $cargoId, int $sedeId, string $fechaInicio): int
    // ------------------------------------------------------------------ //
    {
        [$areaId, $subAreaId] = $this->cargoMeta[$cargoId];
        [$nombre, $username, $email] = $this->generarIdentidad();
        $doc = (string) $this->docSeq++;
        $now = time();

        // user
        $this->db->createCommand()->insert('user', [
            'username'      => $username,
            'email'         => $email,
            'password_hash' => $this->pwdHash,
            'auth_key'      => substr(md5($username . $doc . $now), 0, 32),
            'confirmed_at'  => $now,
            'empresas_id'   => 3,
            'created_at'    => $now,
            'updated_at'    => $now,
            'flags'         => 0,
        ])->execute();

        $userId = (int) $this->db->getLastInsertID();

        // profile  (sede_id → tabla legacy 'sedes', se deja NULL)
        $this->db->createCommand()->insert('profile', [
            'user_id'          => $userId,
            'tipo_doc'         => 'CC',
            'num_doc'          => $doc,
            'name'             => $nombre,
            'empresas_id'      => 3,
            'estado'           => 'activo',
            'location_sede_id' => $sedeId,
            'cargo_id'         => $cargoId,
            'area_id'          => $areaId,
        ])->execute();

        // contrato
        $this->db->createCommand()->insert('contrato', [
            'empresa_id'       => 3,
            'profile_id'       => $userId,
            'contrato_tipo_id' => 2,
            'area_id'          => $areaId,
            'sub_area_id'      => $subAreaId,
            'cargo_id'         => $cargoId,
            'sede_id'          => $sedeId,
            'estado'           => 'activo',
            'fecha_inicio'     => $fechaInicio,
            'created_by'       => 5,
            'updated_by'       => 5,
        ])->execute();

        return $userId;
    }

    // ------------------------------------------------------------------ //
    private function generarIdentidad(): array
    // ------------------------------------------------------------------ //
    {
        $esMasculino = ($this->nameIdx % 2 === 0);
        $pool   = $esMasculino ? $this->maleNames : $this->femaleNames;
        $nCount = count($pool);
        $lCount = count($this->lastNames);

        $fn = $pool[$this->nameIdx % $nCount];
        $l1 = $this->lastNames[$this->nameIdx % $lCount];
        $l2 = $this->lastNames[($this->nameIdx + 7) % $lCount];

        $nombre   = "{$fn} {$l1} {$l2}";
        $baseUser = strtolower("{$fn}.{$l1}");

        if (!isset($this->usedUsernames[$baseUser])) {
            $this->usedUsernames[$baseUser] = 0;
            $username = $baseUser;
        } else {
            $this->usedUsernames[$baseUser]++;
            $username = $baseUser . $this->usedUsernames[$baseUser];
        }

        $this->nameIdx++;

        return [$nombre, $username, "{$username}@bodytech.com.co"];
    }

    // ------------------------------------------------------------------ //
    public function safeDown(): void
    // ------------------------------------------------------------------ //
    {
        $userIds = (new \yii\db\Query())
            ->select('id')
            ->from('user')
            ->where(['empresas_id' => 3])
            ->column($this->db);

        if (empty($userIds)) {
            echo "    > No hay usuarios Bodytech para eliminar.\n";
            return;
        }

        $contratoIds = (new \yii\db\Query())
            ->select('id')
            ->from('contrato')
            ->where(['empresa_id' => 3, 'profile_id' => $userIds])
            ->column($this->db);

        if (!empty($contratoIds)) {
            $this->delete('contrato_distribucion_sede', ['contrato_id' => $contratoIds]);
            $this->delete('contrato', ['id' => $contratoIds]);
        }

        $this->delete('profile', ['user_id' => $userIds]);
        $this->delete('user',    ['id'       => $userIds]);

        echo "    > " . count($userIds) . " usuarios Bodytech eliminados.\n";
    }
}
