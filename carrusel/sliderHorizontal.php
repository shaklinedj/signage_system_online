  
  <?php
include "admin/db.php";
 $images = get_imgs();
 $videos = get_vids();
?>
<!-- Powered by Evilnapsis http://evilnapsis.com/ -->
<!DOCTYPE html>
<html>
  
<style>

.contenedor {
     
     position: fixed;
     display: flex;
     width: 800px;
     height: 500px;
     max-width: 1000px;
     max-height: 400px;

     top: 70%;
     left: 50%;
     transform: translate(-50%, -50%);
     text-align: center;
     color: white;
     font-size: 34px;
     background-color: rgba(0, 0, 0, 0.7);
     padding: 60px;
   }



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
    <div class="contenedor"></div>
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

function obtenerDatos() {
      fetch('http://172.20.82.141/intermediario.php')
        .then(response => response.text())
        .then(data => {
          // Separamos la respuesta por comas y la guardamos en un array
          const elementos = data.split(',');

          // Obtenemos solo los primeros dos elementos
          const elementosSeleccionados = elementos.slice(0, 2);
           // Limpiamos el contenido del elemento HTML
      const elementoHTML = document.querySelector('.contenedor');
      elementoHTML.innerHTML = '';

          // Recorremos cada elemento y establecemos el contenido del elemento HTML correspondiente
          elementosSeleccionados.forEach((elemento, index) => {
            // Convertimos el elemento a número y añadimos el signo $ y el separador de miles
            const elementoFormateado = Number(elemento).toLocaleString('en-US', { style: 'currency', currency: 'USD' });

            // Establecemos el contenido del elemento HTML
            const elementoHTML = document.querySelector('.contenedor');
            elementoHTML.innerHTML += `<div><h1>Pagados ultimos ${index === 0 ? '7 Dias' : '30 Dias'}</h1><p>${elementoFormateado}</p></div>`;
          });
        });
    }
    setInterval(obtenerDatos, 5000);


    function moverTexto() {
  const elemento = document.querySelector('.contenedor');
  let posicion = 60;

  setInterval(() => {
    posicion -= 1;
    elemento.style.left = `${posicion}px`;

    if (posicion < -elemento.offsetWidth) {
      posicion = window.innerWidth;
    }
  }, 50);
}

moverTexto();


</script>



</body>
</html>