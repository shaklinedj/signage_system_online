<?php
include "navbar_2.php";
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["casino_id"])) {
  $_SESSION["casino_id"] = $_POST["casino_id"];
  header("Location: " . $_SERVER["PHP_SELF"]);
  exit;
}

$casino_id = $_SESSION["casino_id"];
$images = get_imgs($casino_id); // Considera generar thumbnails al subir imágenes
$videos = get_vids($casino_id);
?>
<!DOCTYPE html>
<html>

<head>
  <title>Publicidad Dreams Coyhaique</title>
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="styles.css">
  <link rel="shortcut icon" href="slotmachine.ico" />
  <meta http-equiv="Cache-Control" content="max-age=86400"> <!-- Cachea por 1 día -->
</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Imágenes y videos</h1>
        <a href="./form_image.php" class="btn btn-default">Agregar imagen</a>
        <a href="./form_video.php" class="btn btn-default">Agregar video</a>
        <br><br>
        <div class="image-grid">
          <?php if (count($images) > 0 || count($videos) > 0): ?>
            <?php foreach ($images as $img): ?>
  <div class="grid-item">
    <!-- WebP Thumbnail -->
    <img src="<?php echo $img->folder . 'webp/' . $img->src; ?>" style="width:100%;" loading="lazy" data-full="<?php echo $img->folder . $img->src; ?>" onclick="loadFullImage(this)">
    <p><?php echo $img->fecha; ?></p>
    <div>
      <a class="btn btn-success" href="./download.php?id=<?php echo $img->id; ?>">Descargar</a>
      <a class="btn btn-danger" href="./delete.php?id=<?php echo $img->id; ?>">Eliminar</a>
      <a class="btn btn-danger" href="javascript:void(0);" onclick="deleteItem(<?php echo $img->id; ?>, 'image')">Eliminar</a>
    </div>
  </div>
<?php endforeach; ?>

            <?php foreach ($videos as $vid): ?>
              <div class="grid-item">
                <video controls width="100%" preload="none" loading="lazy">
                  <source src="<?php echo $vid->folder . $vid->src; ?>">
                  Tu navegador no soporta el elemento de video.
                </video>
                <p><?php echo $vid->fecha; ?></p>
                <div>
                  <a class="btn btn-success" href="./download.php?id=<?php echo $vid->id; ?>">Descargar</a>
                  <a class="btn btn-danger" href="javascript:void(0);" onclick="deleteItem(<?php echo $vid->id; ?>, 'video')">Eliminar</a>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <h4 class="alert alert-warning">No hay imágenes ni videos.</h4>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <script>
$(document).ready(function() {
  $('.delete-btn').click(function(e) {
    e.preventDefault(); // Evita que el enlace se siga de manera tradicional

    var itemId = $(this).data('id');
    var itemElement = $('#item-' + itemId); // Selecciona el elemento por id

    console.log(itemElement); // Verifica que sea el elemento correcto

    if (confirm('¿Estás seguro de que deseas eliminar este elemento?')) {
      $.ajax({
        url: './delete.php',
        type: 'POST',
        data: { id: itemId },
        
        success: function(response) {
          console.log(response); // Verifica la respuesta del servidor
          if (response.trim() === "exito") {
            itemElement.fadeOut(500, function() { // Desvanece el elemento
              $(this).remove(); // Luego lo elimina del DOM
            });
          } else {
            alert('Error: al eliminar');
          }
        },
        error: function(xhr, status, error) {
          alert('Hubo un problema al eliminar el elemento.');
        }
      });
    }
  });
});
</script>
</body>

</html>
