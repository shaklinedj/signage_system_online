<?php
// Incluir el archivo de configuración
require_once 'config.php';

// Parámetros de la solicitud de autenticación de Google
$params = [
    'response_type' => 'code',
    'client_id' => GOOGLE_CLIENT_ID,
    'redirect_uri' => GOOGLE_REDIRECT_URL,
    'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
    'access_type' => 'offline',
    'prompt' => 'consent'
];

// Construir la URL de autenticación de Google
$authUrl = 'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query($params);

// Redirigir al usuario a la página de autorización de Google
header('Location: ' . $authUrl);
exit;
?>
