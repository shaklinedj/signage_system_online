<?php
include "../admin/db.php";
$casinos = get_casinos(); 
$images = get_imgs_back();
$videos = get_vids_back();

$selectedCasinoId = isset($_COOKIE['casino_id']) ? $_COOKIE['casino_id'] : null;
$filteredImages = array_filter($images, function ($img) use ($selectedCasinoId) {
    return $img->casino_id == $selectedCasinoId;
});
$filteredVideos = array_filter($videos, function ($vid) use ($selectedCasinoId) {
  return $vid->casino_id == $selectedCasinoId;
});
?>

<!-- Powered by Evilnapsis http://evilnapsis.com/ -->
<!DOCTYPE html>
<html>

<style>
   .carousel-inner{
    position: fixed !important;
  }
   
  .carousel-inner img,
  .carousel-inner video {
    
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  video {
  width: 100%;
  height: 100%;
  padding: 0;
  margin: 0;
}



</style>

<head>
  <title>Carouseles</title>
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">

  <link rel="shortcut icon" href="../admin/slotmachine.ico" />
  <!-- Incluimos jQuery y Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
  
  <script>
    // Función para recargar la página con delay
    function reloadWithDelay(delay) {
      setTimeout(() => {
        location.reload();
      }, delay);
    }
  </script>
</head>

<body>

  <?php if(count($filteredImages) > 0 || count($videos) > 0): ?>
  <!-- aquí insertaremos el slider -->
  <div id="carousel1" class="carousel slide" data-ride="carousel">
    <!-- Indicadores -->
    <div class="carousel-inner" role="listbox">
      <?php $cnt = 0; foreach($filteredImages as $img): ?>
      <div class="item <?php if($cnt == 0) {echo 'active';} ?>">
        <img src="<?php echo '../admin/'.$img->folder.$img->src; ?>" alt="Imagen">
      </div>
      <?php $cnt++; endforeach; ?>
      <?php foreach($filteredVideos as $vid): ?>
      <div class="item">
        <video class="full-width-video" id="video<?php echo $cnt; ?>" autoplay muted>
          <source src="<?php echo '../admin/'.$vid->folder.$vid->src; ?>" type="video/mp4">
        </>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php else: ?>
  <h4 class="alert alert-warning">No hay imágenes</h4>
  <?php endif; ?>
  </div>
  </div>

  <!-- Modal para elegir casino -->
  <div class="modal fade" id="casinoModal" tabindex="-1" role="dialog" aria-labelledby="casinoModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="casinoModalLabel">Selecciona un casino</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Elige tu casino favorito:</p>
          <select id="casinoSelect" class="form-control">
          <?php
                $casinos = get_casinos();
                foreach ($casinos as $id => $casino) {
                  echo "<option value='$id'>$casino</option>";
                }
              ?>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="guardarCasino()">Guardar</button>
        </div>
      </div>
    </div>
  </div>

  

  <script>
    $(document).ready(function () {
      var videos = document.getElementsByTagName("video");

      for (var i = 0; i < videos.length; i++) {
        videos[i].addEventListener('play', function () {
          $('#carousel1').carousel('pause');
        });

        videos[i].addEventListener('ended', function () {
          $('#carousel1').carousel('next');
        });
      }

      // Recarga la página si el slide se detiene
      $('#carousel1').on('slid.bs.carousel', function () {
        var currentSlide = $('.carousel-inner .item.active');
        if (!currentSlide.next().length) {
          reloadWithDelay(5000); // Recarga la página con delay de 5 segundos
        }
      });
    });

    $(document).ready(function () {
      var selectedCasino = Cookies.get("casino_id");
    if (selectedCasino === undefined) {
      // Si no hay una cookie, abre el modal automáticamente
      $('#casinoModal').modal('show');
    }
    });

   
    function guardarCasino() {
      var selectedCasinoId = document.getElementById("casinoSelect").value;
    Cookies.set("casino_id", selectedCasinoId, { expires: 365 }); // Guarda el id del casino en la cookie por 7 días
    $('#casinoModal').modal('hide'); // Cierra el modal
    location.reload();
    }

  </script>
</body>

</html>
