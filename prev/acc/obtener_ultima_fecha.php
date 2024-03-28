<?php
// Establecer la conexión con la base de datos.
$servername = "localhost";
$username = "root";
$password = "";
$database = "accidentes";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener la última fecha de accidente ingresada
$sql = "SELECT MAX(fecha) AS ultima_fecha FROM accidentes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ultima_fecha = $row["ultima_fecha"];
} else {
    $ultima_fecha = "No hay accidentes registrados.";
}

// Cerrar la conexión a la base de datos
$conn->close();

// Devolver la última fecha como JSON
echo json_encode(["ultima_fecha" => $ultima_fecha]);

