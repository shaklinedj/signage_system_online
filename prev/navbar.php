<?php
// Initialize the session
include("sesion.php");
?>
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../admin/styles.css">
<link rel="shortcut icon" href="../slotmachine.ico" />
<nav class="navbar navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
   
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a>  Hola, <?php echo htmlspecialchars($_SESSION["username"]); ?> - bienvenido al Registro de accidentes Dreams </a></li>
        <li><a href="./">Inicio</a></li>
        <li><a href="acc/principal.html" target="_blank">ver Dias Accidentes</a></li>
        <li><a href="../login-master/logout.php">Salir</a></li>

      </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>