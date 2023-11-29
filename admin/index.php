<?php



include "db.php";


$images = get_imgs();
$videos = get_vids();
?>

<html>
<head>

  <title>publicidad Dreams Coyhaique</title>
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
  
<link rel="shortcut icon" href="slotmachine.ico" />
</head>
<body>
<?php include("navbar.php");?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Imágenes y videos</h1>
        <a href="./form_image.php" class="btn btn-default">Agregar imagen</a> 
        <a href="./form_video.php" class="btn btn-default">Agregar video</a> 
        <br><br>
        <?php if (count($images) > 0 || count($videos) > 0): ?>
        <table class="table table-bordered">
          <thead>
            <th>Archivo</th>
            <th>Tipo</th>
            <th>Fecha de termino</th>
            <th>Acciones</th>
          </thead>
          <?php foreach($images as $img): ?>
          <tr>
            <td><img src="<?php echo $img->folder.$img->src; ?>" style="width:180px;"></td>
            <td>Imagen</td>
            <td><?php echo $img->fecha; ?></td>
            <td>
              <a class="btn btn-success" href="./download.php?id=<?php echo $img->id; ?>">Descargar</a> 
              <a class="btn btn-danger" href="./delete.php?id=<?php echo $img->id; ?>">Eliminar</a>
            </td>
          </tr>
          <?php endforeach; ?>
          <?php foreach($videos as $vid): ?>
          <tr>
            <td>
              <video controls width="180">
                <source src="<?php echo $vid->folder.$vid->src; ?>" >
                Tu navegador no soporta el elemento de video.
              </video>
            </td>
            <td>Video</td>
            <td><?php echo $vid->fecha; ?></td>
            <td>
              <a class="btn btn-success" href="./download.php?id=<?php echo $vid->id; ?>">Descargar</a> 
              <a class="btn btn-danger" href="./delete.php?id=<?php echo $vid->id; ?>">Eliminar</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </table>
        <?php else: ?>
        <h4 class="alert alert-warning">No hay imágenes ni videos.</h4>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>
</html>