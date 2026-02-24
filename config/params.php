<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    // Base URL absoluta para redirecciones (evita redirigir al puerto/host incorrecto)
    // Ejemplo: 'http://localhost:8886' o 'https://tudominio.com'
    'baseUrl' => getenv('APP_BASE_URL') ?: 'http://localhost:8886',
];
