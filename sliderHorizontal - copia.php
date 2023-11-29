<?php
include "admin/db.php";
 $images = get_imgs();
?>
<!DOCTYPE html>
<html>

<style>
     .contenedor {
     
      position: absolute;
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
      background-color: rgba(0, 0, 0, 0.5);
      padding: 60px;
    }



    h1 {
  color: red;
  font-size: 34px;
  padding: 20px;
}

    p {
  color: orange;
  font-size: 32px;
  padding: 36px;
}

    

</style>

<head>
  <title>Carrusel</title>
 <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css"> 

 

 
<!-- refrescamos cada 30 seg -->
  <meta http-equiv="refresh" content="360"> 
</head>
<body>
    

<?php if(count($images)>0):?>
<!-- aqui insertaremos el slider -->

<div id="carousel1" class="carousel slide" data-ride="carousel" data-interval="10000" >

  <!-- Indicatodores -->
 <!-- <ol class="carousel-indicators">
<?php $cnt=0; foreach($images as $img):?>
    <li data-target="#carousel1" data-slide-to="0" class="<?php if($cnt==0){ echo 'active'; }?>"></li>
<?php $cnt++; endforeach; ?>
  </ol> -->

  <!-- Contenedor de las imagenes -->
  <div class="carousel-inner" role="listbox">
<?php $cnt=0; foreach($images as $img):?>
    <div class="item <?php if($cnt==0){ echo 'active'; }?>" >
      <img src="<?php echo 'admin/'.$img->folder.$img->src; ?>" alt="Imagen 1">
      
    </div>
<?php $cnt++; endforeach; ?>
  </div>
  <div class="contenedor"></div>
  <!-- Controls -->
 <!-- <a class="left carousel-control" href="#carousel1" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Anterior</span>
  </a>
  <a class="right carousel-control" href="#carousel1" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Siguiente</span>
  </a> -->

</div>

<?php else:?>
  <h4 class="alert alert-warning">No hay imagenes</h4>
<?php endif; ?>
</div>
</div>
</div>


<script>
    function obtenerDatos() {
      fetch('http://localhost/intermediario.php')
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
            elementoHTML.innerHTML += `<div><h1>Premios ${index === 0 ? 'semana' : 'mes'}</h1><p>${elementoFormateado}</p></div>`;
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


/*const texto = document.querySelector('.contenedor');
//const texto = document.querySelector('.texto');

// Posición inicial del texto
texto.style.left = '-100%';

// Función que mueve el texto de izquierda a derecha
function mover() {
  // Calcula la posición actual del texto
  let posicion = parseInt(texto.style.left);

  // Si el texto ha llegado al final de la pantalla, vuelve a la posición inicial
  if (posicion >= 68) {
    posicion = -100;
  }

  // Aumenta la posición del texto en 1%
  posicion += 1;

  // Establece la nueva posición del texto
  texto.style.left = `${posicion}%`;
}

// Ejecuta la función "mover" cada 20 milisegundos (5 veces por segundo)
setInterval(mover, 200);*/

  
  </script>





<script src="jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>


   
</body>
</html>