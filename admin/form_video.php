<html>
	<head>
		<title>Subir Video</title>
	  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	</head>
	<body>
<?php include("navbar.php");?>

		<div class="container">
			<div class="row">
				<div class="col-md-12">		
		<h1>Subir Video</h1>
		<h2>videos de hasta 30Mb</h2>
		<form enctype="multipart/form-data" method="post" action="upload.php">

  <div class="form-group">
    <label for="exampleInputPassword1">fecha termino</label>
    <input type="date"  name="fecha" class="form-control"  >
  </div>
  <div class="form-group">
    <label for="exampleInputFile">Video</label>
    <input type="file" name="video" required>
  </div>

		<input type="submit" value="Subir video" class="btn btn-primary">
		</form>
	</div>
</div>
</div>
	</body>

</html>
