<?php

/**
* Conexion a la base de datos y funciones
* Autor: evilnapsis
**/

function con(){
	return new mysqli("localhost","root","","carousel");
}

function insert_img($title, $folder, $image, $fecha ){
	$con = con(); 
	$con->query("insert into image (title, folder,src,created_at,fecha) value (\"$title\",\"$folder\",\"$image\",NOW(),\"$fecha\")");
}



function get_imgs(){
	$images = array();
	$con = con();
	$query=$con->query("select * from image order by created_at desc");
	while($r=$query->fetch_object()){
		$images[] = $r;
	}
	return $images;
}

function get_img($id){
	$image = null;
	$con = con();
	$query=$con->query("select * from image where id=$id");
	while($r=$query->fetch_object()){
		$image = $r;
	}
	return $image;
}

function del($id){
	$con = con();
	$con->query("delete from image where id=$id");
}


//funcion inserta  video
function insert_vid($title, $folder, $video ,$fecha){
	$con = con();
	$con->query("insert into video (title, folder,src,created_at,fecha) value (\"$title\",\"$folder\",\"$video\",NOW(),\"$fecha\")");
}

//funcion get video
function get_vids(){
	$videos = array();
	$con = con();
	$query=$con->query("select * from video order by created_at desc");
	while($r=$query->fetch_object()){
		$videos[] = $r;
	}
	return $videos;
}
//funcion get video by id
function get_vid($id){
	$video = null;
	$con = con();
	$query=$con->query("select * from video where id=$id");
	while($r=$query->fetch_object()){
		$video = $r;
	}
	return $video;
}
//funcion delete video
function delvid($id){
	$con = con();
	$con->query("delete from video where id=$id");
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
  
  

?>