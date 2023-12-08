  
  <?php
include "admin/db.php";

 $images = get_imgs_back();
 $videos = get_vids_back();

 function get_casinos1()
  {
      $casinos = array();
      $con = con();
      $sql = "SELECT id, casino FROM casino";  // Añadí el campo 'id' a la consulta SQL
      $result = $con->query($sql);
  
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $casinos[$row['id']] = $row['casino']; 
          }
      }
  
      return $casinos;
  }



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
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"> 
  <link rel="shortcut icon" href="slotmachine.ico" />
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
<!-- Aquí está el código HTML sin la barra de navegación -->

<!--<div class="container"> -->
  <!--<div class="row"> -->
    <!--<div class="col-md-12">-->
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
            <img src="<?php echo 'admin/'.$img->folder.$img->src; ?>" alt="Imagen">
            <div class="carousel-caption"><?php echo $img->title; ?></div>
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
              <source src="<?php echo 'admin/'.$vid->folder.$vid->src; ?>" type="video/mp4">
            </>
            <div class="carousel-caption"><?php echo $vid->title; ?></div>
          </div>
          <?php endforeach; ?>
        </div>
        

      </div>
      <?php else:?>
      <h4 class="alert alert-warning">No hay imágenes</h4>
      <?php endif; ?>
    </div>
   
</div>
  </div>
</div>

<!-- Modal para seleccionar casino -->
<div class="modal fade" id="casinoModal" tabindex="-1" role="dialog" aria-labelledby="casinoModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="casinoModalLabel">Seleccionar Casino</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Contenido del modal -->
        <form id="casinoForm">
          <div class="form-group">
            <label for="selectCasino">Selecciona un casino:</label>
            <select class="form-control" id="selectCasino" name="selectCasino">
              <?php
                $casinos = get_casinos1();
                foreach ($casinos as $id => $casino) {
                  echo "<option value='$id'>$casino</option>";
                }
              ?>
            </select>
          </div>
          <button type="button" class="btn btn-primary" onclick="guardarCasino()">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!--Agregar el siguiente script en la parte inferior de la página-->
<script>
  <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
<script>

  $(document).ready(function() {
    // Recuperar la cookie al cargar la página
    var selectedCasino = Cookies.get("selectedCasino");
    if (selectedCasino === undefined) {
      // Si no hay una cookie, abre el modal automáticamente
      $('#casinoModal').modal('show');
    }

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
        reloadWithDelay(5000); // Recarga la página con delay de 5 segundos
      }
    });

    // Resto de tu código...
  });

  
  function reloadWithDelay(delay) {
    setTimeout(() => {
      location.reload();
    }, delay);
  }

  function guardarCasino() {
    var selectedCasinoId = document.getElementById("selectCasino").value;
    Cookies.set("selectedCasino", selectedCasinoId, { expires: 7 }); // Guarda el id del casino en la cookie por 7 días
    $('#casinoModal').modal('hide'); // Cierra el modal
    location.reload(); // Recarga la página para mostrar las imágenes del casino seleccionado
  }
</script>
</script>



</body>
</html>