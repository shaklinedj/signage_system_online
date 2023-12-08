<?php
// Initialize the session
session_start();

// Include config file
require_once "../login-master/config.php";

$casino_name = $action = $new_casino_name = "";
$casino_name_err = $action_err = $new_casino_name_err = "";

// Check if the user is an administrator
if ($_SESSION["role"] !== "admin") {
    // Redirect to a suitable page or display an error message
    header("location: index.php");
    exit();
}

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate casino name
    if (empty(trim($_POST["new_casino_name"]))) {
        $new_casino_name_err = "Por favor, ingrese el nombre del casino.";
    } else {
        $new_casino_name = trim($_POST["new_casino_name"]);
    }

    // Validate action (create or delete)
    if (empty($_POST["action"])) {
        $action_err = "Por favor, seleccione una acción.";
    } else {
        $action = $_POST["action"];
    }

    // Check input errors before updating the database
    if (empty($new_casino_name_err) && empty($action_err)) {
        if ($action === "create") {
            // Action: Create Casino
            create_casino($link, $new_casino_name);
        } elseif ($action === "delete") {
            // Action: Delete Casino
            delete_casino($link, $new_casino_name);
        }
    }
}

// Función para crear un casino
function create_casino($link, $new_casino_name)
{
    $sql = "INSERT INTO casino (casino) VALUES (?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_casino_name);
        $param_casino_name = $new_casino_name;

        if (mysqli_stmt_execute($stmt)) {
            // Casino created successfully. Redirect to a suitable page or display a success message.
            header("location: index.php");
            exit();
        } else {
            echo "Algo salió mal, por favor vuelva a intentarlo.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error en la preparación de la consulta: " . $link->error;
    }
}

// Función para eliminar un casino
function delete_casino($link, $new_casino_name)
{
    $sql = "DELETE FROM casino WHERE casino = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_casino_name);
        $param_casino_name = $new_casino_name;

        if (mysqli_stmt_execute($stmt)) {
            // Casino deleted successfully. Redirect to a suitable page or display a success message.
            header("location: success.php");
            exit();
        } else {
            echo "Algo salió mal, por favor vuelva a intentarlo.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error en la preparación de la consulta: " . $link->error;
    }
}

// Obtener la lista de casinos existentes para mostrar al eliminar
$casinos = get_casinos($link);

// Función para obtener la lista de casinos
function get_casinos($link)
{
    $casinos = array();
    $sql = "SELECT casino FROM casino";
    $result = $link->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $casinos[] = $row['casino'];
        }
    }

    return $casinos;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear o Eliminar Casinos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <?php include("../admin/navbar.php");?>
    <div class="wrapper">
        <h2>Crear o Eliminar Casinos</h2>
        <p>Complete este formulario para crear o eliminar un casino</p>
    
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="form-group <?php echo (!empty($action_err)) ? 'has-error' : ''; ?>">
        <label>Acción</label>
        <select name="action" class="form-control" id="actionSelect">
            <option value="">Seleccione una acción</option>
            <option value="create">Crear Casino</option>
            <option value="delete">Eliminar Casino</option>
        </select>
        <span class="help-block"><?php echo $action_err; ?></span>
    </div>

    <div id="casinoNameGroup" class="form-group" style="display: none;">
        <label>Nombre del casino</label>
        <select name="casino_named" class="form-control">
            <option value="">Seleccione un casino</option>
            <?php foreach ($casinos as $casino) : ?>
                <option value="<?php echo $casino; ?>"><?php echo $casino; ?></option>
            <?php endforeach; ?>
        </select>
        <span class="help-block"><?php echo $casino_name_err; ?></span>
    </div>

    <!-- Nuevo campo para el nombre del casino al crear -->
    <div id="newCasinoGroup" class="form-group" style="display: none;">
        <label>Nuevo Casino</label>
        <input type="text" name="new_casino_name" class="form-control" value="<?php echo $new_casino_name; ?>">
        <span class="help-block"><?php echo $new_casino_name_err; ?></span>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Enviar">
        <a class="btn btn-link" href="index.php">Cancelar</a>
    </div>
</form>

<script>
    // Script para mostrar/ocultar los campos según la acción seleccionada
    document.getElementById("actionSelect").addEventListener("change", function () {
        var casinoNameGroup = document.getElementById("casinoNameGroup");
        var newCasinoGroup = document.getElementById("newCasinoGroup");

        if (this.value === "delete") {
            casinoNameGroup.style.display = "block";
            newCasinoGroup.style.display = "none";
        } else if (this.value === "create") {
            casinoNameGroup.style.display = "none";
            newCasinoGroup.style.display = "block";
        } else {
            casinoNameGroup.style.display = "none";
            newCasinoGroup.style.display = "none";
        }
    });
</script>

    </div>    
</body>
</html>
