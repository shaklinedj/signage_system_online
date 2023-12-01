

<html>
	<head>
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
    <label for="exampleInputPassword1">Fecha Termino</label>
   <!-- <input type="text"  name="title" class="form-control"  placeholder="Texto a mostrar">-->
	<input type="date" name="fecha" class="form-group" >
  </div>
  <div class="form-group">
    <label for="exampleInputFile">Imagen</label>
    <input type="file" name="image" required>
  </div>

		<input type="submit" value="Subir imagen" class="btn btn-primary">
		</form>
	</div>
</div>
</div>
	</body>

</html>
