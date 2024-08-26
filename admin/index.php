<?php
include "navbar_2.php";
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["casino_id"])) {
  $_SESSION["casino_id"] = $_POST["casino_id"];
  header("Location: " . $_SERVER["PHP_SELF"]);
  exit;
}

$casino_id = $_SESSION["casino_id"];
$images = get_imgs($casino_id);
$videos = get_vids($casino_id);
?>
<!DOCTYPE html>
<html>

<head>
  <title>Publicidad Dreams Coyhaique</title>
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="styles.css"> <!-- Asegúrate de tener un archivo de estilos CSS -->
  <link rel="shortcut icon" href="slotmachine.ico" />
  
  <script src="../sweetalert2/sweetalert2.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Incluye jQuery -->
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
            <?php foreach($images as $img): ?>
              <div class="grid-item">
                <img src="<?php echo $img->folder.$img->src; ?>" style="width:100%;">
                <p><?php echo $img->fecha; ?></p>
                <div>
                  <a class="btn btn-success" href="./download.php?id=<?php echo $img->id; ?>">Descargar</a> 
                  <a class="btn btn-danger" href="./delete.php?id=<?php echo $img->id; ?>">Eliminar</a>
                </div>
              </div>
            <?php endforeach; ?>
            <?php foreach($videos as $vid): ?>
              <div class="grid-item">
                <video controls width="100%">
                  <source src="<?php echo $vid->folder.$vid->src; ?>" >
                  Tu navegador no soporta el elemento de video.
                </video>
                <p><?php echo $vid->fecha; ?></p>
                <div>
                  <a class="btn btn-success" href="./download.php?id=<?php echo $vid->id; ?>">Descargar</a> 
                  <a class="btn btn-danger" href="./delete.php?id=<?php echo $vid->id; ?>">Eliminar</a>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <h4 class="alert alert-warning">No hay imagenes ni videos.</h4>
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
      var itemElement = $('#item-' + itemId);

      Swal.fire({
        title: "Estas Seguro(a)?",
        text: "No podras volver atras!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Borralo!"
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: './delete.php',
            type: 'POST',
            data: { id: itemId },
            success: function(response) {
              console.log(response); // Verifica la respuesta del servidor
              if (response.trim() === "exito") { // Compara con "exito"
                itemElement.fadeOut(500, function() { // Desvanece el elemento
                  $(this).remove(); // Luego lo elimina del DOM
                });
                Swal.fire({
                  title: "Borrada!",
                  text: "Tu Archivo fue eliminado.",
                  icon: "success"
                });
              } else {
                Swal.fire({
                  title: "Error!",
                  text: "Hubo un error borando tu archivo.",
                  icon: "error"
                });
              }
            },
            error: function(xhr, status, error) {
              Swal.fire({
                title: "Error!",
                text: "There was a problem deleting your file.",
                icon: "error"
              });
            }
          });
        }
      });
    });
  });
  </script>



 
</body>

</html>