<?php
include "db.php";



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ids"])) {
    $ids = $_POST["ids"];
    $success  = true;
    

    foreach($ids as $id){
    // Verificar si es una imagen
    $img = get_img($id);
    if ($img != null) {
        del($img->id);
        if (file_exists($img->folder . $img->src)) {
            unlink($img->folder . $img->src);
        } 
      
    }



    // Verificar si es un video
    $vid = get_vid($id);
    if ($vid != null) {
        delvid($vid->id);
        if (file_exists($vid->folder . $vid->src)) {
            unlink($vid->folder . $vid->src);
        }
       
    }

    // Verificar si es un usuario
    $user = get_user($id);
    if ($user != null) {
        deluser($user->id);
      
    }
}

// Devolver la respuesta en formato JSON
echo $success ? "exito" : "error";

}