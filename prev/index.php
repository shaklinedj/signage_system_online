
<!DOCTYPE html>
<html>
<head>
  <title>Accidentes  Dreams</title>
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../admin/styles.css">
  
</head>
<body>
  <?php include("navbar.php");
        include("../login-master/config.php");
  ?>
        
 
<div class="container">
    <h3 class="text-center font-weight-bold text-white mt-2 mb-">Accidentes Dreams Coyhaique</h3>

    <form action="guardar_accidente.php" method="POST" class="mt-3">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="persona">Nombre</label>
                <input type="text" class="form-control" id="persona" name="persona" placeholder="Nombre" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="fecha">fecha</label>
                <div class="input-group">
                    <input type="datetime-local" class="form-control" id="fecha" name="fecha" style="margin-right: 20px;"
                        value="<?php echo date('Y-m-d\TH:i'); ?>">
                    <div class="input-group-append">
                        <a href="tabla_accidentes.php" class="btn btn-primary" style="padding-left: 20px;">Ver Tabla de Accidentes</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col mb-3">
                <label for="descripcion">Descripción del accidente</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required
                    placeholder="inserte todos los datos posibles aquí" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Accidente</button>
        </div>
    </form>
</div>
</body>
</html>
