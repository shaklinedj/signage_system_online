<?php



include "db.php";

/*
// Obtener las imágenes que coincidan con la fecha actual
date_default_timezone_set("America/Santiago");

$fecha_actual = date_format(date_create(), 'Y-m-d');

$imgs = get_imgs_fecha($fecha_actual);

foreach ($imgs as $img) {
	del($img->id);
	unlink($img->folder . $img->src);
  }
  
/*

// Si hay imágenes, mostrarlas
if (count($images) > 0) {
    echo '<h2>Imágenes a eliminar:</h2>';
    echo '<ul>';
    foreach ($images as $img) {
        echo '<li>' . $img->src . '</li>';
    }
    echo '</ul>';

    // Eliminar las imágenes
    foreach ($images as $img) {
        // Mostrar un mensaje indicando la imagen que se está eliminando
        echo 'Eliminando ' . $img->src . '<br>';

        // Ejecutar el archivo delete.php para eliminar la imagen
        // Nota: asegúrate de que delete.php reciba el ID de la imagen a eliminar
        exec('php delete.php'. $img->id);
    }
} else {
    echo '<p>No hay imágenes para eliminar.</p>';
}
*/
 

$images = get_imgs();
$videos = get_vids();


?>
<html>
	<head>
		<title>Subir Multiples Imagenes - Evilnapsis</title>
		  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">

	</head>
	<body>

<?php include("navbar.php");?>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
		<h1>Imagenes</h1>
		<a href="./form.php" class="btn btn-default">Agregar Imagen</a> 
		<a href="./formv.php" class="btn btn-default">Agregar Video</a> 
		<br><br>

       



		<?php if(count($images)>0):?>




				<table class="table table-bordered">
					<thead>
						<th>Imagen</th>
						<th>Fecha Termino</th>
						<th>
					</thead>




			<?php foreach($images as $img):?>
				 
				
				<tr>
				<td><img src="<?php echo $img->folder.$img->src; ?>" style="width:240px;"></td>
				<td><?php echo $img->fecha; ?></td>
				<td>
				<a class="btn btn-success" href="./download.php?id=<?php echo $img->id; ?>">Descargar</a> 
				
				<a class="btn btn-danger" href="./delete.php?id=<?php echo $img->id; ?>">Eliminar</a>
				
</div>
</div>
</div>
			</td>
				</tr>
			<?php endforeach;?>
</table>
		<?php else:?>

			<h4 class="alert alert-warning">No hay imagenes!</h4>
		<?php endif; ?>
</div>
</div>
</div>
	</body>

</html>
