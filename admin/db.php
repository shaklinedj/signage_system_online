<?php

/**
* Conexion a la base de datos y funciones
* Autor: evilnapsis
**/
// Initialize the session
//obtener casino de usuario logueado
$casino_id= isset($_SESSION["casino_id"])?$_SESSION["casino_id"]:NULL;


function con(){
	return new mysqli("localhost","root","","carousel");
}

function insert_img($casino_id, $folder, $image, $fecha) {
    $con = con();

    // Validar y escapar los datos
    $casino_id = htmlspecialchars($casino_id);
    $folder = htmlspecialchars($folder);
    $image = htmlspecialchars($image);
    $fecha = htmlspecialchars($fecha);

    // Utilizar consulta preparada para evitar la inyección de SQL
    $stmt = $con->prepare("INSERT INTO image (casino_id, folder, src, created_at, fecha) VALUES (?, ?, ?, NOW(), ?)");

    // Verificar si la consulta preparada se realizó con éxito
    if ($stmt) {
        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param("isss", $casino_id, $folder, $image, $fecha);

        // Verificar si la ejecución de la consulta fue exitosa
        if ($stmt->execute()) {
            // Éxito al ejecutar la consulta
            $stmt->close();
        } else {
            // Manejar errores
            echo "Error al ejecutar la consulta: " . $stmt->error;
            $stmt->close();
        }
    } else {
        // Manejar errores si la consulta preparada falla
        echo "Error en la preparación de la consulta: " . $con->error;
    }
}

//funcion inserta  video
function insert_vid($casino_id, $folder, $video, $fecha) {
    $con = con();

    // Validar y escapar los datos
    $casino_id = htmlspecialchars($casino_id);
    $folder = htmlspecialchars($folder);
    $video = htmlspecialchars($video);
    $fecha = htmlspecialchars($fecha);

    // Utilizar consulta preparada para evitar la inyección de SQL
    $stmt = $con->prepare("INSERT INTO video (casino_id, folder, src, created_at, fecha) VALUES (?, ?, ?, NOW(), ?)");

    // Verificar si la consulta preparada se realizó con éxito
    if ($stmt) {
        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param("isss", $casino_id, $folder, $video, $fecha);

        // Verificar si la ejecución de la consulta fue exitosa
        if ($stmt->execute()) {
            // Éxito al ejecutar la consulta
            $stmt->close();
        } else {
            // Manejar errores
            echo "Error al ejecutar la consulta: " . $stmt->error;
            $stmt->close();
        }
    } else {
        // Manejar errores si la consulta preparada falla
        echo "Error en la preparación de la consulta: " . $con->error;
    }
}


function get_imgs_back() {
    $images = array();
    $con = con();

    $query = $con->prepare("SELECT * FROM image ORDER BY created_at DESC");
    $query->execute();

    $result = $query->get_result();

    while ($r = $result->fetch_object()) {
        $images[] = $r;
    }

    $query->close();
    $con->close();

    return $images;
}
//funcion get video
function get_vids_back(){
	$videos = array();
	$con = con();

	$query = $con->prepare("SELECT * FROM video ORDER BY created_at DESC");
	$query->execute();

    $result = $query->get_result();
    
    while($r=$result->fetch_object()){
		$videos[] = $r;
	}
	

    $query->close();
    $con->close();

    return $videos;
}
function get_imgs($casino_id) {
    $images = array();
    $con = con();
    $casino_id = htmlspecialchars($casino_id);

    // Utiliza la consulta preparada para evitar la inyección de SQL
    $stmt = $con->prepare("SELECT * FROM image WHERE casino_id = ? ORDER BY created_at DESC");

    // Verifica si la consulta preparada se realizó con éxito
    if ($stmt) {
        // Vincula parámetros y ejecuta la consulta
        $stmt->bind_param("i", $casino_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($r = $result->fetch_object()) {
            $images[] = $r;
        }

        $stmt->close();
    } else {
        // Maneja errores si la consulta preparada falla
        echo "Error en la preparación de la consulta: " . $con->error;
    }

    return $images;
}
function get_vids($casino_id) {
    $videos = array();
    $con = con();
    $casino_id = htmlspecialchars($casino_id);

    // Utiliza la consulta preparada para evitar la inyección de SQL
    $stmt = $con->prepare("SELECT * FROM video WHERE casino_id = ? ORDER BY created_at DESC");

    // Verifica si la consulta preparada se realizó con éxito
    if ($stmt) {
        // Vincula parámetros y ejecuta la consulta
        $stmt->bind_param("i", $casino_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($r = $result->fetch_object()) {
            $videos[] = $r;
        }

        $stmt->close();
    } else {
        // Maneja errores si la consulta preparada falla
        echo "Error en la preparación de la consulta: " . $con->error;
    }

    return $videos;
}
function get_img($id){
	$image = null;
    $con = con();
    
    // Utilizar consulta preparada para evitar inyección de SQL
    $stmt = $con->prepare("SELECT * FROM image WHERE id = ?");
    
    // Verificar si la consulta preparada se realizó con éxito
    if ($stmt) {
        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($r = $result->fetch_object()) {
            $image = $r;
        }
        
        $stmt->close();
    } else {
        // Manejar errores de manera segura
        error_log("Error en la preparación de la consulta: " . $con->error);
}
 // Cerrar conexión después de su uso
 mysqli_close($con);

 return $image;
}


//funcion get video by id
function get_vid($id){
    $video = null;
    $con = con();

    $stmt = $con->prepare("SELECT * FROM video WHERE id = ?");

    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($r = $result->fetch_object()) {
            $video = $r;
        }

        $stmt->close();
    } else {
        error_log("Error en la preparación de la consulta: " . $con->error);
    }

    mysqli_close($con);

    return $video;
}
//funcion delete video


function del($id){
    $con = con();

    // Utilizar consulta preparada para evitar inyección de SQL
    $stmt = $con->prepare("DELETE FROM image WHERE id = ?");

    // Verificar si la consulta preparada se realizó con éxito
    if ($stmt) {
        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    } else {
        // Manejar errores de manera segura
        error_log("Error en la preparación de la consulta: " . $con->error);
    }

    // Cerrar conexión después de su uso
    mysqli_close($con);
}
function delvid($id){
    $con = con();

    $stmt = $con->prepare("DELETE FROM video WHERE id = ?");

    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    } else {
        error_log("Error en la preparación de la consulta: " . $con->error);
    }

    mysqli_close($con);
}






function get_user($id){
    $user = null;
    $con = con();

    $stmt = $con->prepare("SELECT * FROM users WHERE id = ?");

    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($r = $result->fetch_object()) {
            $user = $r;
        }

        $stmt->close();
    } else {
        error_log("Error en la preparación de la consulta: " . $con->error);
    }

    mysqli_close($con);

    return $user;
}
function deluser($id){
    $con = con();

    $stmt = $con->prepare("DELETE FROM users WHERE id = ?");

    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    } else {
        error_log("Error en la preparación de la consulta: " . $con->error);
    }

    mysqli_close($con);
    
}
function get_imgs_fecha($fecha) {
	$mysqli = new mysqli("localhost", "root", "", "carousel");
  
	if ($mysqli->connect_errno) {
	  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
	  exit();
	}
  
	$sql = "select * FROM image WHERE fecha = ?";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("s", $fecha);
	$stmt->execute();
	$result = $stmt->get_result();
  
	$imagenes = array();
  
	while ($row = $result->fetch_object()) {
	  $imagenes[] = $row;
	}
  
	$stmt->close();
	$mysqli->close();
  
	return $imagenes;
  }
  function get_casinos()
  {
      $casinos = array();
      $con = con();
      $sql = "SELECT id, casino FROM casino";  // Añadí el campo 'id' a la consulta SQL
      $result = $con->query($sql);
  
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $casinos[$row['id']] = $row['casino']; 
          }
      }
  
      return $casinos;
  }
  function get_casino_name($casino_id)
{
  $con = con();
  $sql = "SELECT casino FROM casino WHERE id = $casino_id";
  $result = $con->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    return $row['casino'];
  } else {
    return null;
  }
}
  
  // Función para obtener la última actualización de las tablas
function get_last_update() {
    $con = con();
    $result = mysqli_query($con, "SELECT MAX(created_at) as last_update FROM (
        SELECT created_at FROM image
        UNION ALL
        SELECT created_at FROM video
    ) as updates");

    $row = mysqli_fetch_assoc($result);
    return $row['last_update'];
}
