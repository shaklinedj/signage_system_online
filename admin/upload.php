<?php

include "db.php";
include "class.upload.php";

// Mostrar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$token = uniqid();

// Inicia sesión
session_start();
// Obtener casino de usuario logueado
$casino_id = isset($_SESSION["casino_id"]) ? $_SESSION["casino_id"] : NULL;

if ($casino_id !== null) {
  if (isset($_FILES['file'])) {
    $handle = new Upload($_FILES['file']);

    if ($handle->uploaded) {
      $token = bin2hex(random_bytes(16));
      $handle->file_new_name_body = 'img_' . $token;
       // Obtener la fecha seleccionada del input
    $fecha = $_POST["fecha"];
    $fecha_mysql = date("Y-m-d", strtotime($fecha));

      // Procesar la imagen original
      $handle->Process("uploads/");

       // Usar la función insert_img de la librería db.php para la imagen original
       insert_img($casino_id, "uploads/", $handle->file_dst_name, $fecha_mysql);
       echo 'La imagen se ha subido correctamente con su versión WebP.';
      

      // Liberar recursos
      unset($handle);
    } else {
      echo 'Error: ' . $handle->error;
    }
  } else {
    echo 'No se ha seleccionado ningún archivo.';
  }
} else {
  echo "Error: No se pudo obtener el casino_id del usuario.";
}

// Función para el video (sin cambios)
$handle = new Upload($_FILES["video"]);
if ($handle->uploaded) {
  $handle->file_new_name_body = 'vid_' . $token;
  $handle->Process("uploads/");
  if ($handle->processed) {
    // Obtener la fecha seleccionada del input
    $fecha = $_POST["fecha"];
    $fecha_mysql = date("Y-m-d", strtotime($fecha));

    // Usar la función insert_vid de la librería db.php
    insert_vid($casino_id, "uploads/", $handle->file_dst_name, $fecha_mysql);
  } else {
    echo 'Error: ' . $handle->error;
  }
}
unset($handle);

header("Location: ../");
