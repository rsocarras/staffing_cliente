<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    // Base URL absoluta para redirecciones (evita redirigir al puerto/host incorrecto)
    // Ejemplo: 'http://localhost:8886' o 'https://tudominio.com'
    'baseUrl' => getenv('APP_BASE_URL') ?: null,
    // Webhook MyBodytech para activación (POST con persona_id, num_documento, sede, cargo, etc.)
    'webhookMyBodytechUrl' => getenv('WEBHOOK_MYBODYTECH_URL') ?: null,
];
