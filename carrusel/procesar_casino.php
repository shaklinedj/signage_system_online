<?php
// procesar_casino.php

// Incluir el archivo que contiene la lógica de la base de datos (db.php)
include "../admin/db.php";

// Obtener el valor del parámetro casino_id enviado por JavaScript
$casino_id = $_GET['id'] ?? '';

// Obtener las imágenes y videos según el casino_id
$images = get_imgs($casino_id);
$videos = get_vids($casino_id);

// Puedes hacer más cosas con los datos si es necesario

// Devolver una respuesta (puedes personalizar según tus necesidades)
echo "Datos procesados para el casino con ID: $casino_id";
?>
