
<!DOCTYPE html>
<html>
	<head>
		<title>Subir Video</title>
	  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	</head>
	<body>
		<?php include("navbar_2.php");?>

		<div class="container">
			<div class="row">
				<div class="col-md-12">		
					<h1>Subir Video</h1>
					<h2>videos de hasta 60Mb</h2>
					<form enctype="multipart/form-data" method="post" action="upload.php">

					  <div class="form-group">
					    <label for="fecha">Fecha Termino</label>
					    <input type="date" id="fecha" name="fecha" class="form-control">
					  </div>
					  <div class="form-group">
					    <label for="video">Video</label>
					    <input type="file" id="video" name="video" required>
					  </div>

					  <input type="submit" value="Subir video" class="btn btn-primary">
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
