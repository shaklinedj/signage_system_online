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

<!DOCTYPE html >
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
    var counter;
    var counterInterval;
    var intervalTime = 30; // 45 seconds for images
    var lastUpdate = null; // Definimos lastUpdate como null inicialmente

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

    function updateCounterDisplay() {
      $counterDisplay.text(counter);
    }

    function startCounter(duration) {
      counter = duration;
      updateCounterDisplay();
      clearInterval(counterInterval);
      counterInterval = setInterval(function () {
        counter--;
        updateCounterDisplay();
        if (counter <= 0) {
          clearInterval(counterInterval);
          $('#carousel1').carousel('next');
        }
      }, 1000);
    }

    function handleVideoPlayback() {
      var $activeItem = $('.carousel-inner .item.active');
      var $video = $activeItem.find('video');

      if ($video.length > 0) {
        $('#carousel1').carousel('pause'); // Pausar el carrusel si es un video
        $video[0].play();
        $video[0].onended = function () {
          $('#carousel1').carousel('cycle');
          $('#carousel1').carousel('next');
        };
        startCounter(Math.ceil($video[0].duration)); // Iniciar el contador con la duraci�n del video
      } else {
        startCounter(intervalTime); // Iniciar el contador con el tiempo de intervalo de im�genes
      }
    }

    $('#carousel1').on('slid.bs.carousel', function () {
      handleVideoPlayback();
    });

    $('#carousel1').carousel({
      interval: false
    });

    var selectedCasino = Cookies.get("casino_id");
    if (selectedCasino === undefined) {
      $('#casinoModal').modal('show');
    } else {
      handleVideoPlayback();
    }

    $('#carousel1').on('slide.bs.carousel', function (e) {
      if (counter > 0) {
        e.preventDefault(); // Prevenir el cambio de slide si el contador no ha llegado a cero
      }
    });
  });

  // Manejar errores en la carga de im�genes y videos
    $('img, video').on('error', function () {
      console.error('Error loading:', this.src);
      location.reload();
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
  <h4 class="alert alert-warning">No hay imagenes ni videos</h4>
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
