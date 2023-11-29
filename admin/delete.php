<?php
include("navbar.php");

if(isset($_GET["id"])){
	include "db.php";
	$img = get_img($_GET["id"]);
	if($img!=null){
		del($img->id);
		unlink($img->folder.$img->src);
		header("Location: ../");



	}
    $vid = get_vid($_GET["id"]);
	if($vid!=null){
		delvid($vid->id);
		unlink($vid->folder.$vid->src);
		header("Location: ../");

	}
	
}



?>