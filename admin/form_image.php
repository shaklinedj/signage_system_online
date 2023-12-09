<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	
		<title>Subir Multiples Imagenes y/o Archivos - By Evilnapsis</title>
	  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
</head>
	<body>
<?php include("navbar_2.php");?>

		<div class="container">
			<div class="row">
				<div class="col-md-12">		
		<h1>Subir imagenes o archivos</h1>
		<form enctype="multipart/form-data" method="post" action="upload.php">

  <div class="form-group">
    <label for="fecha">Fecha Termino</label>
   <!-- <input type="text"  name="title" class="form-control"  placeholder="Texto a mostrar">-->
	<input type="date"  id="fecha"name="fecha" class="form-group" >
  </div>
  <div class="form-group">
    <label for="image">Imagen</label>
    <input type="file" id="image" name="image" required>
  </div>

		<input type="submit" value="Subir imagen" class="btn btn-primary">
		</form>
	</div>
</div>
</div>
	</body>

</DOC>
