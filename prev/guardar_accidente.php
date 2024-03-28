<?php
// Establecer la conexión con la base de datos. Debes modificar estas credenciales según tu configuración.
$servername = "localhost";
$username = "root";
$password = "";
$database = "accidentes";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST["fecha"];
    $persona =$_POST["persona"];
    $descripcion = $_POST["descripcion"];
    
    // Insertar los datos en la base de datos
    $sql = "INSERT INTO accidentes (fecha, descripcion, persona) VALUES ('$fecha', '$descripcion', '$persona')";


    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        
        exit();
    } else {
        echo "Error al guardar el accidente: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();

