<?php

use yii\db\Migration;

/**
 * Seed: Empresa Bodytech Colombia + ciudades faltantes + 84 sedes operativas.
 *
 * Ejecutar: php yii migrate/up --migrationPath=@app/migrations
 */
class m260323_200000_seed_bodytech_sedes extends Migration
{
    public function safeUp()
    {
        // ------------------------------------------------------------------ //
        // 1. Empresa Bodytech
        // ------------------------------------------------------------------ //
        $this->insert('empresas', [
            'name'        => 'Bodytech',
            'social_name' => 'Bodytech Colombia S.A.S.',
            'status'      => 1,
            'idu'         => 'BdTch-Col-' . substr(md5('bodytech-colombia'), 0, 26),
            'slug'        => 'bodytech-colombia',
            'user_owner'  => 1,
        ]);

        $empresaId = (int) $this->db->getLastInsertID();

        // ------------------------------------------------------------------ //
        // 2. Ciudades colombianas faltantes (country_id = 50 = Colombia)
        // ------------------------------------------------------------------ //
        $newCities = [
            // nombre              region_id   capital
            ['Pereira',        101, 1],   // Risaralda
            ['Manizales',       82, 1],   // Caldas
            ['Armenia',        100, 1],   // Quindío
            ['Ibagué',         105, 1],   // Tolima
            ['Cúcuta',          98, 1],   // Norte de Santander
            ['Tunja',           81, 1],   // Boyacá
            ['Villavicencio',   96, 1],   // Meta
            ['Soacha',          89, 0],   // Cundinamarca
            ['Chía',            89, 0],   // Cundinamarca
            ['Bello',           77, 0],   // Antioquia
            ['Envigado',        77, 0],   // Antioquia
            ['Floridablanca',  102, 0],   // Santander
            ['Rionegro',        77, 0],   // Antioquia
            ['Soledad',         79, 0],   // Atlántico
            ['Palmira',        106, 0],   // Valle del Cauca
            ['Tuluá',          106, 0],   // Valle del Cauca
            ['Dosquebradas',   101, 0],   // Risaralda
            ['Montería',        88, 1],   // Córdoba
            ['Valledupar',      86, 1],   // Cesar
            ['Pasto',           97, 1],   // Nariño
        ];

        foreach ($newCities as [$nombre, $regionId, $capital]) {
            $this->insert('city', [
                'country_id' => 50,
                'region_id'  => $regionId,
                'name'       => $nombre,
                'is_capital' => $capital,
                'is_active'  => 1,
            ]);
        }

        // ------------------------------------------------------------------ //
        // 3. Mapa nombre → id de todas las ciudades colombianas
        // ------------------------------------------------------------------ //
        $cityRows = (new \yii\db\Query())
            ->select(['id', 'name'])
            ->from('city')
            ->where(['country_id' => 50])
            ->all($this->db);

        $cityMap = [];
        foreach ($cityRows as $row) {
            $cityMap[$row['name']] = (int) $row['id'];
        }

        $bog = $cityMap['Bogotá']         ?? null;
        $med = $cityMap['Medellín']       ?? null;
        $cal = $cityMap['Cali']           ?? null;
        $baq = $cityMap['Barranquilla']   ?? null;
        $ctg = $cityMap['Cartagena']      ?? null;
        $buc = $cityMap['Bucaramanga']    ?? null;
        $per = $cityMap['Pereira']        ?? null;
        $man = $cityMap['Manizales']      ?? null;
        $arm = $cityMap['Armenia']        ?? null;
        $iba = $cityMap['Ibagué']         ?? null;
        $cuc = $cityMap['Cúcuta']         ?? null;
        $tun = $cityMap['Tunja']          ?? null;
        $vil = $cityMap['Villavicencio']  ?? null;
        $soa = $cityMap['Soacha']         ?? null;
        $chi = $cityMap['Chía']           ?? null;
        $bel = $cityMap['Bello']          ?? null;
        $env = $cityMap['Envigado']       ?? null;
        $flo = $cityMap['Floridablanca']  ?? null;
        $rio = $cityMap['Rionegro']       ?? null;
        $sol = $cityMap['Soledad']        ?? null;
        $pal = $cityMap['Palmira']        ?? null;
        $tul = $cityMap['Tuluá']          ?? null;
        $dos = $cityMap['Dosquebradas']   ?? null;
        $mon = $cityMap['Montería']       ?? null;
        $val = $cityMap['Valledupar']     ?? null;
        $pas = $cityMap['Pasto']          ?? null;

        // ------------------------------------------------------------------ //
        // 4. Sedes Bodytech (84 sedes)
        // ------------------------------------------------------------------ //
        // Formato: [nombre, city_id, direccion]
        $sedes = [
            // ── BOGOTÁ (33) ─────────────────────────────────────────────── //
            ['Autopista 135',      $bog, 'Calle 134A # 23-72, Barrio Alcalá'],
            ['Autopista 170',      $bog, 'Carrera 23 # 166-59, Barrio Toberín'],
            ['Bulevar',            $bog, 'Av. Carrera 58 # 127-59 Local 181B, CC Bulevar'],
            ['Cabrera',            $bog, 'Calle 85 # 7-13, La Cabrera'],
            ['Carrera 7B',         $bog, 'Carrera 7B Bis # 132-38 Piso 9 Torre B, Bella Suiza'],
            ['Carrera 11',         $bog, 'Calle 96 # 10-38'],
            ['Cedritos',           $bog, 'Calle 147 # 7-52, CC Show Place Piso 2'],
            ['Centro Mayor',       $bog, 'Calle 38 Sur # 34D-51, Villa Mayor'],
            ['Chicó',              $bog, 'Avenida 19 # 102-31 Piso 3, El Chicó'],
            ['Chapinero',          $bog, 'Carrera 7 # 63-25, Chapinero'],
            ['Colina',             $bog, 'Calle 138 # 58-74, CC Plaza 138'],
            ['Connecta',           $bog, 'CC Connecta, Engativá'],
            ['Country 138',        $bog, 'Calle 138 # 10A-42'],
            ['Diverplaza',         $bog, 'Transversal 96 # 70A-85 Terraza Cuarto Piso'],
            ['Ensueño',            $bog, 'Carrera 51 # 59C Sur-93, CC Gran Plaza El Ensueño Piso 2 Local 206'],
            ['Floresta',           $bog, 'Av. Carrera 68 # 90-88, CC Floresta Nivel 0'],
            ['Galerías',           $bog, 'Carrera 24 # 53-73 Piso 6, Galerías'],
            ['Gran Estación',      $bog, 'Av. Calle 26 # 62-47, CC Gran Estación'],
            ['Hayuelos',           $bog, 'Calle 20 # 82-52, CC Hayuelos Local 4-59'],
            ['Kennedy',            $bog, 'Transversal 78J # 41F-05, Los Periodistas'],
            ['Normandía',          $bog, 'Avenida Boyacá # 49-29 Piso 2'],
            ['Pablo VI',           $bog, 'Carrera 52 Bis # 56B-29, Pablo VI Etapa 1'],
            ['Pasadena',           $bog, 'Carrera 53 # 101A-37, CC Los Tres Elefantes'],
            ['Paseo Villa del Río', $bog, 'Calle 57C Sur # 62-60, CC Paseo Villa del Río Terraza 4 Piso'],
            ['Plaza Bosa',         $bog, 'Calle 65 Sur # 78H-51 Local 314, Bosa'],
            ['Plaza Central',      $bog, 'Carrera 65 # 11-50 Piso 3 Local 3-28'],
            ['Portal 80',          $bog, 'Transversal 100A # 80A-20, CC Portal 80 Local 3001'],
            ['Santa Ana',          $bog, 'Avenida 9 # 110-20, CC Santa Ana'],
            ['Suba',               $bog, 'Av. Carrera 104 # 148-07, CC Plaza Imperial Local 269'],
            ['Sultana',            $bog, 'Calle 12 Sur # 31-33, Santa Isabel'],
            ['Titán',              $bog, 'Av. Carrera 72 # 80-94 Local 427, Pontevedra'],
            ['Torre Central',      $bog, 'Calle 26 # 68C-61, CC y Negocios Torre Central'],
            ['Calle 90',           $bog, 'Calle 90 # 15-34'],

            // ── MEDELLÍN (12) ────────────────────────────────────────────── //
            ['Avenida Colombia',   $med, 'Calle 50 # 66-50, Laureles'],
            ['Belén',              $med, 'Calle 32 # 75-50'],
            ['Camino Real',        $med, 'Av. Oriental Carrera 46 # 52-92 Local 402'],
            ['Las Américas',       $med, 'Carrera 84 # 44-54 Interior 2, San Juan'],
            ['Laureles',           $med, 'Avenida 33 # 74B-127'],
            ['Mall del Este',      $med, 'Carrera 25 # 3-45, El Poblado'],
            ['Premium Plaza',      $med, 'Carrera 43 # 30-25, El Poblado'],
            ['Robledo',            $med, 'Carrera 80 # 64-61, Éxito Robledo Segundo Piso'],
            ['San Juan',           $med, 'Carrera 71A # 53-11'],
            ['San Lucas',          $med, 'Calle 20 Sur # 27-115'],
            ['Vegas',              $med, 'Carrera 46, El Poblado'],
            ['Vizcaya',            $med, 'Calle 10 # 32-115 Sótano 3, CC Vizcaya'],

            // ── ÁREA METROPOLITANA MEDELLÍN ──────────────────────────────── //
            ['City Plaza',         $env, 'Calle 36D Sur # 27A-105 Local 340, Envigado'],
            ['Villagrande',        $env, 'Transversal 27A Sur # 42B-80, Envigado'],
            ['Niquía',             $bel, 'Diagonal 55 # 37-41 Piso 14, CC Estación Niquía, Bello'],
            ['Llanogrande',        $rio, 'CC Jardines Llanogrande, Rionegro'],

            // ── BARRANQUILLA (4) + SOLEDAD (1) ──────────────────────────── //
            ['Parque Washington',  $baq, 'CC Royal Washington, Carrera 53 # 79-279'],
            ['Miramar',            $baq, 'Carrera 43 # 99-50, CC Miramar Piso 3 Local 301-302'],
            ['Viva Barranquilla',  $baq, 'Carrera 51B # 87-50, CC Viva'],
            ['Recreo',             $baq, 'Carrera 43 # 60-25'],
            ['Soledad',            $sol, 'Carrera 32 # 30-15 Piso 3, CC Gran Plaza del Sol, Soledad'],

            // ── CARTAGENA (5) ────────────────────────────────────────────── //
            ['Bocagrande',         $ctg, 'Carrera 1 # 12-118, CC Plaza Bocagrande Piso 5'],
            ['Caribe Plaza',       $ctg, 'CC Caribe Plaza Local 225'],
            ['Gran Manzana',       $ctg, 'CC Gran Manzana, junto a Terminal de Transporte'],
            ['Los Ejecutivos',     $ctg, null],
            ['Plazuela',           $ctg, 'Calle 71 # 29-236 Locales 1-5'],

            // ── CALI (4) ─────────────────────────────────────────────────── //
            ['Caney',              $cal, 'Calle 48 # 85-54'],
            ['Chipichape',         $cal, 'Calle 38N # 6N-35 Local 8-246 Piso 2, CC Chipichape'],
            ['Jardín Plaza',       $cal, 'Carrera 98 # 16-200 Local 202, CC Jardín Plaza'],
            ['Oeste',              $cal, 'Calle 7 Oeste # 1A-59'],

            // ── ÁREA METROPOLITANA CALI / EJE CAFETERO ───────────────────── //
            ['Palmira',            $pal, 'Calle 31 # 44-239, CC Llanogrande Plaza, Palmira'],
            ['Tuluá',              $tul, 'Carrera 40 # 37-51, CC Tuluá La 14 Local Mezzanine H'],
            ['Armenia',            $arm, 'Carrera 6 # 3-180, CC Calima, Armenia'],
            ['Pereira',            $per, 'Av. Circunvalar Carrera 13 # 12B-25, Edificio Uniplex Pisos 5-6'],
            ['Dosquebradas',       $dos, 'Carrera 16 # 43, CC El Progreso Local 208, Dosquebradas'],
            ['Manizales',          $man, 'Carrera 27A # 66-30, CC Sancancio, Manizales'],

            // ── BUCARAMANGA (2) + FLORIDABLANCA (1) ─────────────────────── //
            ['Cacique',            $buc, 'CC Cacique, Bucaramanga'],
            ['Megamall',           $buc, 'Carrera 33A # 30A-19, CC Megamall, Bucaramanga'],
            ['Caracolí',           $flo, 'Carrera 27 # 29-145 Local 503, Parque Caracolí, Floridablanca'],

            // ── OTRAS CIUDADES ────────────────────────────────────────────── //
            ['Cúcuta',             $cuc, 'Calle 11 # 2E-10 Barrio Caobos, CC Quinta Vélez Piso 3 Local 301'],
            ['Ibagué',             $iba, 'Calle 60 con Av. Ambala, CC La Estación Local 302'],
            ['Tunja',              $tun, 'Calle 37 # 6-20 Pisos 2-3'],
            ['Antares',            $soa, 'Carrera 4 Este # 31-40, CC Gran Plaza Soacha Local 302, Soacha'],
            ['Terreros',           $soa, 'Carrera 1 # 38-53 Local 4-16, CC Ventura Terreros Piso 3, Soacha'],
            ['Chía',               $chi, null],
            ['Fontanar',           $chi, 'Km 2.5 Vía Chía, CC Fontanar, Chía'],
            ['Llanocentro',        $vil, 'Carrera 39C # 29C-15, CC Llanocentro Local 3001, Villavicencio'],
            ['Viva Villavicencio', $vil, 'Calle 7 # 45-185, CC Viva Villavicencio'],
            ['Montería',           $mon, 'Transversal 29 # 29-69, Montería'],
            ['Mayales',            $val, 'CC Mayales Plaza I, Valledupar'],
            ['Pasto',              $pas, 'Carrera 22B # 2-57, Avenida Panamericana, Pasto'],
        ];

        foreach ($sedes as [$nombre, $cityId, $direccion]) {
            $this->insert('location_sedes', [
                'empresa_id' => $empresaId,
                'city_id'    => $cityId,
                'nombre'     => $nombre,
                'direccion'  => $direccion,
                'activo'     => 1,
                'tipo_sede'  => 'operativa',
            ]);
        }

        echo "    > Empresa Bodytech creada con ID {$empresaId}.\n";
        echo "    > " . count($newCities) . " ciudades colombianas insertadas.\n";
        echo "    > " . count($sedes) . " sedes de Bodytech insertadas.\n";
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

        $empresaId = $empresa['id'];

        $this->delete('location_sedes', ['empresa_id' => $empresaId]);
        $this->delete('empresas', ['id' => $empresaId]);

        $cityNames = [
            'Pereira', 'Manizales', 'Armenia', 'Ibagué', 'Cúcuta', 'Tunja',
            'Villavicencio', 'Soacha', 'Chía', 'Bello', 'Envigado',
            'Floridablanca', 'Rionegro', 'Soledad', 'Palmira', 'Tuluá',
            'Dosquebradas', 'Montería', 'Valledupar', 'Pasto',
        ];
        $this->delete('city', ['name' => $cityNames, 'country_id' => 50]);

        echo "    > Seed de Bodytech revertido correctamente.\n";
    }
}
