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

<!DOCTYPE html>
<html>
<head>
  <title>Carouseles</title>
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
  <link rel="shortcut icon" href="../admin/slotmachine.ico" />
  <style>
    .carousel-inner {
      position: fixed !important;
    }
    .carousel-inner img,
    .carousel-inner video {
      object-position: center top;
      width: 100%;
      height: 100vh !important;
      object-fit: fill;
    }
    video {
      width: 100%;
      height: 100%;
      padding: 0;
      margin: 0;
    }
    .counter {
      position: fixed;
      top: 10px;
      right: 10px;
      background-color: rgba(0, 0, 0, 0.5);
      color: white;
      padding: 5px 10px;
      border-radius: 5px;
      font-size: 18px;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
  <script>
    $(document).ready(function () {
      var lastUpdate;
      var counter;
      var counterInterval;
      var intervalTime = 25000; // 45 seconds for images

      // Función para verificar actualizaciones
      function checkForUpdates() {
        $.ajax({
          url: '../admin/check_updates.php',
          method: 'GET',
          success: function (data) {
            var newUpdate = data.last_update;
            if (lastUpdate && lastUpdate !== newUpdate) {
              location.reload();
            } else {
              lastUpdate = newUpdate;
            }
          }
        });
      }

      setInterval(checkForUpdates, 30000); // Verificar cada 30 segundos

      var $counterDisplay = $('<div class="counter">45</div>');
      $('body').append($counterDisplay);

      // Función para actualizar la visualización del contador
      function updateCounterDisplay() {
        $counterDisplay.text(counter);
      }

      // Función para reiniciar el contador
      function resetCounter(newCounter) {
        if (counterInterval) {
          clearInterval(counterInterval);
        }
        counter = newCounter;
        updateCounterDisplay();
        counterInterval = setInterval(function () {
          counter--;
          updateCounterDisplay();
          if (counter <= 0) {
            clearInterval(counterInterval);
            $('#carousel1').carousel('next');
          }
        }, 1000);
      }

      // Función para manejar la reproducción de videos
      function handleVideoPlayback() {
        var $activeItem = $('.carousel-inner .item.active');
        var $video = $activeItem.find('video');

        if ($video.length > 0) {
          $('#carousel1').carousel('pause'); // Pausar el carrusel si es un video
          $video[0].play();
          $video.on('ended', function () {
            $('#carousel1').carousel('cycle');
            $('#carousel1').carousel('next');
          });
          resetCounter(Math.ceil($video[0].duration)); // Reiniciar el contador con la duración del video
        } else {
          resetCounter(intervalTime / 1000); // Reiniciar el contador con el tiempo de intervalo de imágenes
        }
      }

      $('#carousel1').on('slid.bs.carousel', function () {
        handleVideoPlayback();
      });

      $('#carousel1').carousel({
        interval: false // Desactivar el cambio automático de slides
      });

      var selectedCasino = Cookies.get("casino_id");
      if (selectedCasino === undefined) {
        $('#casinoModal').modal('show');
      } else {
        handleVideoPlayback();
      }

      // Añadir un pequeño retraso antes de cambiar de slide para evitar que se salte
      $('#carousel1').on('slide.bs.carousel', function () {
        clearInterval(counterInterval); // Limpiar el contador al cambiar de slide
      });
    });

    function guardarCasino() {
      var selectedCasinoId = document.getElementById("casinoSelect").value;
      Cookies.set("casino_id", selectedCasinoId, { expires: 365 });
      $('#casinoModal').modal('hide');
      location.reload();
    }

    function reloadWithDelay(delay) {
      setTimeout(() => {
        location.reload();
      }, delay);
    }
  </script>
</head>
<body>
  <?php if(count($filteredImages) > 0 || count($filteredVideos) > 0): ?>
  <div id="carousel1" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
      <?php $cnt = 0; foreach($filteredImages as $img): ?>
      <div class="item <?php if($cnt == 0) {echo 'active';} ?>">
        <img src="<?php echo '../admin/'.$img->folder.$img->src; ?>" alt="Imagen" loading="lazy">
      </div>
      <?php $cnt++; endforeach; ?>
      <?php foreach($filteredVideos as $vid): ?>
      <div class="item">
        <video class="full-width-video" id="video<?php echo $cnt; ?>" muted>
          <source src="<?php echo '../admin/'.$vid->folder.$vid->src; ?>" type="video/mp4">
        </video>
      </div>
      <?php $cnt++; endforeach; ?>
    </div>
  </div>
  <?php else: ?>
  <h4 class="alert alert-warning">No hay imágenes</h4>
  <?php endif; ?>

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
</body>
</html>
