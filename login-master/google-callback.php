<?php
// Incluir el archivo de configuración
require_once 'config.php';

if (isset($_GET['code'])) {
    // Intercambiar el código de autorización por un token de acceso
    $token_url = 'https://oauth2.googleapis.com/token';
    $token_params = [
        'code' => $_GET['code'],
        'client_id' => GOOGLE_CLIENT_ID,
        'client_secret' => GOOGLE_CLIENT_SECRET,
        'redirect_uri' => GOOGLE_REDIRECT_URL,
        'grant_type' => 'authorization_code'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $token_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($token_params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $token_data = json_decode($response, true);

    if (isset($token_data['access_token'])) {
        // Usar el token de acceso para obtener la información del usuario
        $userinfo_url = 'https://www.googleapis.com/oauth2/v2/userinfo';
        $userinfo_headers = [
            'Authorization: Bearer ' . $token_data['access_token']
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $userinfo_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $userinfo_headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $userinfo_response = curl_exec($ch);
        curl_close($ch);

        $userinfo_data = json_decode($userinfo_response, true);

        if (isset($userinfo_data['id'])) {
            // Conectarse a la base de datos
            $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
            if ($link === false) {
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }

            // Verificar si el usuario ya existe
            $sql = "SELECT id, username FROM users WHERE google_id = ?";
            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $userinfo_data['id']);
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        // El usuario ya existe, iniciar sesión
                        mysqli_stmt_bind_result($stmt, $id, $username);
                        if (mysqli_stmt_fetch($stmt)) {
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            header("location: ../admin/");
                        }
                    } else {
                        // El usuario no existe, crear una nueva cuenta
                        $sql_insert = "INSERT INTO users (username, google_id, email) VALUES (?, ?, ?)";
                        if ($stmt_insert = mysqli_prepare($link, $sql_insert)) {
                            mysqli_stmt_bind_param($stmt_insert, "sss", $userinfo_data['name'], $userinfo_data['id'], $userinfo_data['email']);
                            if (mysqli_stmt_execute($stmt_insert)) {
                                // Iniciar sesión con la nueva cuenta
                                session_start();
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = mysqli_insert_id($link);
                                $_SESSION["username"] = $userinfo_data['name'];
                                header("location: ../admin/");
                            } else {
                                echo "Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
                            }
                            mysqli_stmt_close($stmt_insert);
                        }
                    }
                }
                mysqli_stmt_close($stmt);
            }
            mysqli_close($link);
        } else {
            echo "No se pudo obtener la información del usuario de Google.";
        }
    } else {
        echo "No se pudo obtener el token de acceso de Google.";
    }
} else {
    echo "No se recibió el código de autorización de Google.";
}
?>
