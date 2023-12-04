<?php

session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../");
    exit;
}

// Include config file
require_once "../login-master/config.php";

// Function to get the casino name by casino_id
function getCasinoName($link, $casino_id)
{
    $sql = "SELECT casino FROM casino WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $casino_id);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);

            // Añade este bloque para manejar el caso en que no hay resultados
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $nombre);
                if (mysqli_stmt_fetch($stmt)) {
                    mysqli_stmt_close($stmt);
                    return $nombre;
                }
            } else {
                // Maneja el caso en que no hay resultados
                echo "No se encontraron resultados para el casino ID: " . $casino_id;
                mysqli_stmt_close($stmt);
                return "Sin resultados";
            }
        } else {
            // Maneja el caso de error en la ejecución
            echo "Error en la ejecución de la consulta: " . mysqli_stmt_error($stmt);
            mysqli_stmt_close($stmt);
            return "Error en la consulta";
        }
    } else {
        // Maneja el caso de error en la preparación de la consulta
        echo "Error al preparar la consulta: " . mysqli_error($link);
        return "Error en la consulta";
    }
}

?>

<nav class="navbar navbar-inverse">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <?php
                    $casino_id = $_SESSION["casino_id"];
                    $casino_name = getCasinoName($link, $casino_id);
                    echo "<a>Hola, " . htmlspecialchars($_SESSION["username"]) . " - bienvenido al sistema de publicidad Dreams  " . $casino_name . "</a>";
                    ?>
                </li>
                <li><a href="./">Inicio</a></li>
                <li><a href="../carrusel" target="_blank">Ver carousel</a></li>
                <li><a href="../login-master/logout.php">Salir</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
