<?php
// Include config file
require_once "../login-master/config.php";

// Inicializar variables
$usuario_eliminar = "";
$usuario_eliminar_err = "";

// Procesar datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar nombre de usuario a eliminar
    if (empty(trim($_POST["usuario_eliminar"]))) {
        $usuario_eliminar_err = "Por favor, ingresa el nombre de usuario a eliminar.";
    } else {
        $usuario_eliminar = trim($_POST["usuario_eliminar"]);
    }

    // Verificar si hay errores antes de proceder
    if (empty($usuario_eliminar_err)) {
        // Preparar la declaración de eliminación
        $sql = "DELETE FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "s", $param_usuario_eliminar);

            // Establecer parámetros
            $param_usuario_eliminar = $usuario_eliminar;

            // Intentar ejecutar la declaración preparada
            if (mysqli_stmt_execute($stmt)) {
                // Redirigir a la página principal después de eliminar el usuario
                header("location: index.php");
            } else {
                echo "Algo salió mal. Por favor, inténtalo de nuevo.";
            }
        }

        // Cerrar la declaración preparada
        mysqli_stmt_close($stmt);
    }

    // Cerrar la conexión
    mysqli_close($link);
}
?>
