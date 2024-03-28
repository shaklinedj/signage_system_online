

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/accidentes/assets/css/style.css">
    <!-- Incluye la librería de Bootstrap desde un CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <title>Formulario de Accidente</title>
</head>

<body>


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

   

  


    <!-- Incluye los archivos JavaScript de Bootstrap desde un CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>