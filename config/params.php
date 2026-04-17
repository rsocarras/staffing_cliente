<?php

return [
    /**
     * Auditoría global (ActiveRecord, solo app web).
     * - excludedTables: nombres físicos de tabla (con prefijo si aplica) a ignorar.
     * - redactAttributes: atributos adicionales a enmascarar en JSON (además de los por defecto en {@see \app\services\AuditLogWriter}).
     */
    'auditLog' => [
        'excludedTables' => [],
        'redactAttributes' => [],
    ],

    /** ISO alpha-2 para resolver {@see SettingLaboral} cuando la empresa no tiene país. */
    'defaultLocationCountryIso' => getenv('DEFAULT_LOCATION_COUNTRY_ISO') ?: 'CO',

    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    // Base URL absoluta para redirecciones (evita redirigir al puerto/host incorrecto)
    // Ejemplo: 'http://localhost:8886' o 'https://tudominio.com'
    'baseUrl' => getenv('APP_BASE_URL') ?: null,
    // Webhook MyBodytech para activación (POST con persona_id, num_documento, sede, cargo, etc.)
    'webhookMyBodytechUrl' => getenv('WEBHOOK_MYBODYTECH_URL') ?: null,

    /** Importe fijo COP para novedad de auxilio de movilización (solicitud web). */
    'novedad_auxilio_movilizacion_importe' => (float) (getenv('NOVEDAD_AUXILIO_MOVILIZACION_IMPORTE') ?: 50000),

    /**
     * Código de {@see NovedadConcepto} usado para saber si un cargo “aplica clases grupales”
     * vía tabla `novedad_concepto_cargo` (sin flags en `cargos`).
     */
    'novedad_concepto_codigo_clases_grupales' => getenv('NOVEDAD_CONCEPTO_CG') ?: 'CLASES_GRUPALES',

    /** Código del concepto de la novedad de auxilio de movilización. */
    'novedad_concepto_codigo_auxilio_movilizacion' => getenv('NOVEDAD_CONCEPTO_AUXILIO') ?: 'AUXILIO_MOVILIZACION',

    /** Código del tipo de novedad “Horas” (plantilla con troceo). */
    'novedad_horas_tipo_codigo' => getenv('NOVEDAD_HORAS_TIPO_CODIGO') ?: 'horas',

    /** Código del concepto asignado a cada fragmento generado por el troceo de horas. */
    'novedad_horas_concepto_codigo_fragmento' => getenv('NOVEDAD_HORAS_FRAG_CODIGO') ?: 'HORAS_FRAGMENTO',
];
