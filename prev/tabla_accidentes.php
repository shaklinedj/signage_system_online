<!DOCTYPE html>


<html lang="pt-br">
<head>
  <title>Accidentes  Dreams</title>
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../admin/styles.css">
  
</head>
<body>
<?php include("./navbar.php");
       
  ?>
    <div class="container">
        <h1 class="mt-5">Tabla de Accidentes Pasados</h1>
        <div class="input-group mb-3">
            <input type="text" id="busquedaNombre" class="form-control" placeholder="Buscar por nombre">
            <button class="btn btn-primary" id="botonBusqueda">Buscar</button>
            <button class="btn btn-primary" id="volver" >volver</button>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Conectar a la base de datos y recuperar los registros de accidentes
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "accidentes";
                
                $conn = new mysqli($servername, $username, $password, $database);
                
                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }
                
                $sql = "SELECT persona, fecha, descripcion FROM accidentes ORDER BY fecha DESC";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["persona"] . "</td>";
                        echo "<td>" . $row["fecha"] . "</td>";
                        echo "<td>" . $row["descripcion"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No hay accidentes registrados.</td></tr>";
                }
                
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById("botonBusqueda").addEventListener("click", function () {
            var inputNombre = document.getElementById("busquedaNombre").value.toLowerCase();
            var tabla = document.querySelector("table");
            var filas = tabla.getElementsByTagName("tr");
    
            for (var i = 1; i < filas.length; i++) {
                var nombre = filas[i].getElementsByTagName("td")[0].textContent.toLowerCase();
                if (nombre.includes(inputNombre)) {
                    filas[i].style.display = "";
                } else {
                    filas[i].style.display = "none";
                }
            }
        });

        document.getElementById("volver").addEventListener("click", function () {
            location.href = 'index.php';
        })
    </script>
</body>
   



</html>
