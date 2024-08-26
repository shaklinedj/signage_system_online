<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../");
    exit;
}

// Redirigir según el rol
if ($_SESSION["role"] !== "user") {
    if ($_SESSION["role"] === "admin") {
        header("location: ../administrador");
        exit;
    } elseif ($_SESSION["role"] === "prev") {
        header("location: ../prev");
        exit;
    } else {
        header("location: ../");
        exit;
    }
}

// Include config file
require_once "../login-master/config.php";

// Function to get the casino name by casino_id
function getCasinoName($link, $casino_id) {
    $sql = "SELECT casino FROM casino WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $casino_id);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $nombre);
                if (mysqli_stmt_fetch($stmt)) {
                    mysqli_stmt_close($stmt);
                    return $nombre;
                }
            }
        }
    }
    return "Sin resultados";
}

// Function to get all casinos
function getAllCasinos($link) {
    $sql = "SELECT id, casino FROM casino";
    $result = mysqli_query($link, $sql);
    $casinos = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $casinos[] = $row;
    }
    return $casinos;
}

// Handle casino change
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["casino_id"])) {
    $_SESSION["casino_id"] = $_POST["casino_id"];
    header("Location: " . $_SERVER["REQUEST_URI"]);
    exit;
}

$casino_id = $_SESSION["casino_id"];
$casino_name = getCasinoName($link, $casino_id);
$casinos = getAllCasinos($link);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    
    <link rel="shortcut icon" href="../slotmachine.ico">
    <style>
        .navbar-custom {
            background-color: #333;
            border-color: #080808;
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .navbar-nav > li > a {
            color: #bbb;
        }
        .navbar-custom .navbar-brand:hover,
        .navbar-custom .navbar-nav > li > a:hover {
            color: white;
        }
        .dropdown-casino .dropdown-toggle {
            background-color: #444;
            border-color: #333;
            color: #fff;
        }
        .dropdown-casino .dropdown-menu {
            background-color: #444;
            border-color: #333;
        }
        .dropdown-casino .dropdown-menu > li > a {
            color: #fff;
        }
        .dropdown-casino .dropdown-menu > li > a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-custom navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Sistema de Publicidad</a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <p class="navbar-text">Hola, <?php echo htmlspecialchars($_SESSION["username"]); ?> - Bienvenido al sistema de publicidad Dreams</p>
                </li>
                <li class="dropdown dropdown-casino">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="glyphicon glyphicon-home"></i> <?php echo $casino_name; ?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach ($casinos as $casino): ?>
                            <li>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('casinoForm<?php echo $casino['id']; ?>').submit();">
                                    <?php echo htmlspecialchars($casino['casino']); ?>
                                </a>
                                <form id="casinoForm<?php echo $casino['id']; ?>" action="" method="POST" style="display: none;">
                                    <input type="hidden" name="casino_id" value="<?php echo $casino['id']; ?>">
                                </form>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li><a href="./">Inicio</a></li>
                <li><a href="../carrusel" target="_blank">Ver carousel</a></li>
                <li><a href="../login-master/logout.php">Salir</a></li>
            </ul>
        </div>
    </div>
</nav>

<script src="../bootstrap/js/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
