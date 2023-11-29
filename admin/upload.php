<?php

include "db.php";
include "class.upload.php";

/// mostrar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$token = uniqid();


  $handle = new Upload($_FILES["image"]);
  if ($handle->uploaded) {
    $handle->file_new_name_body = 'img_'. $token;
    $handle->Process("uploads/");
    if ($handle->processed) {
      // Obtenemos la fecha seleccionada del input
      $fecha = $_POST["fecha"];

      // Convertimos la fecha seleccionada al formato de MySQL
      $fecha_mysql = date("Y-m-d", strtotime($fecha));
   
    	// usamos la funcion insert_img de la libreria db.php
    	insert_img($_POST["title"],"uploads/",$handle->file_dst_name, $fecha_mysql);
    } else {
      echo 'Error: ' . $handle->error;
    }
  } else {
    echo 'Error: ' . $handle->error;
  }
  unset($handle);
  header("Location: ../");



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
    	insert_vid($_POST["title"],"uploads/",$handle->file_dst_name, $fecha_mysql);
    } else {
      echo 'Error: ' . $handle->error;
    }
  } else {
    echo 'Error: ' . $handle->error;
  }
  unset($handle);
  header("Location: ../");
?>