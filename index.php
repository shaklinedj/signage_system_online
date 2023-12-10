<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: admin/");
    exit;
}

// Include config file
require_once "login-master/config.php";

// Define variables and initialize with empty values
$usuario = $password = "";
$usuario_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["usuario"]))) {
        $usuario_err = "Por favor ingrese su usuario.";
    } else {
        $usuario = trim($_POST["usuario"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor ingrese su contraseña.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($usuario_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, password, casino_id FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_usuario);

            // Set parameters
            $param_usuario = $usuario;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password,$casino_id);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["casino_id"]= $casino_id;
                            

                            // Redirect user to welcome page
                            // Después de verificar la contraseña es correcta y antes de la redirección
                            if ($username === "admin") {
                                // Usuario "admin"
                                $_SESSION["role"] = "admin";
                                header("location: administrador/");
                            } else {
                                // Otros usuarios
                                $_SESSION["role"] = "user";
                                header("location: admin/");
                            }


                        } else {
                            // Display an error message if password is not valid
                            $password_err = "La contraseña que has ingresado no es válida.";
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $usuario_err = "No existe cuenta registrada con ese nombre de usuario.";
                }
            } else {
                echo "Algo salió mal, por favor vuelve a intentarlo.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="login-master/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="login-master/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./admin/slotmachine.ico" />
    <title>Inicio de sesión</title>
</head>

<body>
    <img class="wave" src="login-master/img/wave.png">
    <div class="container">
        <div class="img">
            <img src="login-master/img/bg.svg">
        </div>
        <div class="login-content">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <img src="login-master/img/avatar.svg">
                <h2 class="title">BIENVENIDO</h2>
                
               


                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Usuario</h5>
                        <input id="usuario" type="text" class="input" name="usuario" value="<?php echo $usuario; ?>">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input type="password" id="input" class="input" name="password">
                    </div>
                </div>
                <div class="view">
                    <div class="fas fa-eye verPassword" onclick="vista()" id="verPassword"></div>
                </div>

                <div class="text-center">
                    <a class="font-italic isai5" href="">Olvidé mi contraseña</a>
                    <?php
    // Mostrar el mensaje de error si existe
    if (!empty($password_err)) {
        echo '<div class="error-message">' . $password_err . '</div>';
    }
    ?>
                   
                </div>
                <input name="btningresar" class="btn" type="submit" value="INICIAR SESION">
            </form>
        </div>
    </div>
    <script src="login-master/js/fontawesome.js"></script>
    <script src="login-master/js/main.js"></script>
    <script src="login-master/js/main2.js"></script>
    <script src="login-master/js/jquery.min.js"></script>
    <script src="login-master/js/bootstrap.js"></script>
    <script src="login-master/js/bootstrap.bundle.js"></script>

</body>

</html>