<?php

include "db.php";
include "class.upload.php";

/// mostrar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$token = uniqid();

//inicia sesion
session_start();
//obtener casino de usuario logueado
$casino_id= isset($_SESSION["casino_id"])?$_SESSION["casino_id"]:NULL;


 // Verificar si el casino_id está disponible
if ($casino_id !== null) {
  $handle = new Upload($_FILES["image"]);

  if ($handle->uploaded) {
      // Configurar el nombre del archivo y procesar la imagen
      $handle->file_new_name_body = 'img_' . $token;
      $handle->Process("uploads/");

      if ($handle->processed) {
          // Obtener la fecha seleccionada del input
          $fecha = $_POST["fecha"];

          // Convertir la fecha seleccionada al formato de MySQL
          $fecha_mysql = date("Y-m-d", strtotime($fecha));

          // Usar la función insert_img de la librería db.php
          insert_img($casino_id, "uploads/", $handle->file_dst_name, $fecha_mysql);
      } else {
          echo 'Error: ' . $handle->error;
      }

      // Liberar recursos
      unset($handle);
  } else {
    echo 'Error: ' . $handle->error;
  }
  unset($handle);
  header("Location: ../");

}else {
  echo "Error: No se pudo obtener el casino_id del usuario.";
}

  //funcion para el video
  $handle = new Upload($_FILES["video"]);
  if ($handle->uploaded) {
    $handle->file_new_name_body = 'vid_'. $token;
    $handle->Process("uploads/");
    if ($handle->processed) {

       // Obtenemos la fecha seleccionada del input
       $fecha = $_POST["fecha"];

       // Convertimos la fecha seleccionada al formato de MySQL
       $fecha_mysql = date("Y-m-d", strtotime($fecha));
    	// usamos la funcion insert_img de la libreria db.php
    	insert_vid($casino_id,"uploads/",$handle->file_dst_name, $fecha_mysql);
    } else {
      echo 'Error: ' . $handle->error;
    }
  } else {
    echo 'Error: ' . $handle->error;
  }
  unset($handle);
  header("Location: ../");
?>