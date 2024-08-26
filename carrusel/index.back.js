
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
