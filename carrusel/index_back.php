  
  <?php
include "../admin/db.php";
 $casinos = get_casinos(); 
 $images = get_imgs_back();
 $videos = get_vids_back();
?>
<!-- Powered by Evilnapsis http://evilnapsis.com/ -->
<!DOCTYPE html>
<html>
  
<style>





   h1 {
 color: red;
 font-weight:bold;
 font-size: 44px;
 padding: 20px;
}

   p {
 color: orange;
 font-weight:bold;
 font-size: 42px;
 padding: 20px;
}



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

      <?php if(count($images)>0 || count($videos)>0):?>
      <!-- aquí insertaremos el slider -->
      <div id="carousel1" class="carousel slide" data-ride="carousel">
        <!-- Indicadores -->
        <!--<ol class="carousel-indicators">
          <?php $cnt=0; $total = count($images) + count($videos);
          foreach($images as $img):?>
          <li data-target="#carousel1" data-slide-to="<?php echo $cnt; ?>" class="<?php if($cnt==0){ echo 'active'; }?>"></li>
          <?php $cnt++; endforeach; 
          foreach($videos as $vid):?>
          <li data-target="#carousel1" data-slide-to="<?php echo $cnt; ?>"></li>
          <?php $cnt++; endforeach; ?>
        </ol>
          
        Contenedor de las imágenes y videos -->
        <div class="carousel-inner" role="listbox" >
          <?php $cnt = 0; foreach($images as $img): ?>
          <div class="item <?php if($cnt == 0) {echo 'active';} ?>">
            <img src="<?php echo '../admin/'.$img->folder.$img->src; ?>" alt="Imagen">
         
          </div>
          <?php $cnt++; endforeach; ?>
          <?php foreach($videos as $vid): ?>
          <div class="item">
          <video class="full-width-video"
            
               id="video <?php echo $cnt; ?>"
               style="/*min-width: 100%; min-height: 100%*/"
               autoplay
               muted
              
               
               >
              <source src="<?php echo '../admin/'.$vid->folder.$vid->src; ?>" type="video/mp4">
            </>
  
          </div>
          <?php endforeach; ?>
        </div>
        

      </div>
      <?php else:?>
      <h4 class="alert alert-warning">No hay imágenes</h4>
      <?php endif; ?>
    </div>
    <div class="contenedor"></div>
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
          <?php foreach ($casinos as $casino): ?>
            <option value="<?php echo $casino; ?>"><?php echo $casino; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="guardarCasino()">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!--Agregar el siguiente script en la parte inferior de la página-->
<script>
  $(document).ready(function() {
    var videos = document.getElementsByTagName("video");

    for (var i = 0; i < videos.length; i++) {
      videos[i].addEventListener('play', function() {
        $('#carousel1').carousel('pause');
       
      });

      videos[i].addEventListener('ended', function() {
        $('#carousel1').carousel('next');
       
      });
    }
    
    // Recarga la página si el slide se detiene
    $('#carousel1').on('slid.bs.carousel', function () {
      var currentSlide = $('.carousel-inner .item.active');
      if (!currentSlide.next().length) {
        reloadWithDelay(5000); // Recarga la página con delay de 2 segundos
      }
    });
  });

  
  $(document).ready(function () {
    // Muestra el modal al cargar la página si no hay casino guardado
    if (!localStorage.getItem('casino_id')) {
      $('#casinoModal').modal('show');
    }
  });

  function guardarCasino() {
  var selectedCasino = $('#casinoSelect').val();
  var selectedCasinoId = $('#casinoSelect option:selected').val();

  // Almacena el casino_id en el localStorage
  localStorage.setItem('casino_id', selectedCasinoId);

  // Cierra el modal
  $('#casinoModal').modal('hide');

  // Realiza una petición AJAX al servidor para guardar el valor
  $.ajax({
    url: 'procesar_casino.php', // Reemplaza con la ruta correcta a tu script PHP
    type: 'POST',
    data: { id: selectedCasinoId },
    success: function(response) {
      console.log('Valor del casino_id enviado al servidor');
    },
    error: function(error) {
      console.error('Error al enviar el valor del casino_id al servidor: ', error);
    }
  });

  // Recarga la página para aplicar el filtro del casino seleccionado
  location.reload();
}






</script>



</body>
</html>