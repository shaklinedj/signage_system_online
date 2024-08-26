<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imágenes</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
    
    <style>
        .dropzone {
            border: 2px dashed #007bff;
            border-radius: 5px;
            background: #f9f9f9;
            padding: 20px;
            text-align: center;
            font-size: 16px;
            color: #555;
            width: 100%;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php include("navbar_2.php");?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Subir imágenes</h1>
                <form action="upload.php" class="dropzone" id="my-dropzone">
                    <div class="form-group">
                        <label for="fecha">Fecha Término</label>
                        <input type="date" id="fecha" name="fecha" class="form-group">
                    </div>
                    <div class="dz-message">
                        Arrastra y suelta tus imágenes aquí o haz clic para seleccionar
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    
    
    <script>
        Dropzone.options.myDropzone = {
            acceptedFiles: 'image/*',
            autoProcessQueue: true,
            init: function () {
                this.on("sending", function(file, xhr, formData) {
                    formData.append("fecha", $("#fecha").val());
                });
                this.on("success", function (file, response) {
                    console.log("Archivo subido con éxito:", response);
                });
                this.on("error", function (file, response) {
                    console.log("Error al subir el archivo:", response);
                });
                this.on("queuecomplete", function() {
					setTimeout(function() {
                        window.location.href = "../";
                    }, 4000); // Espera 4 segundos y redirige
                    
                });
            }
        };
<<<<<<< HEAD
   
        // Function to set the minimum date and pre-select a date
        function setupDateInput() {
            const today = new Date();
            const nextMonth = new Date(today.getFullYear(), today.getMonth() + 1, today.getDate());
            const dateString = nextMonth.toISOString().split('T')[0];
            
            const dateInput = document.getElementById('fecha');
            dateInput.min = dateString;
            dateInput.value = dateString;  // This pre-selects the date
        }

        // Call the function when the page loads
        window.onload = setupDateInput;
=======
>>>>>>> 8f0917a70f0fd481e63be9ae0a0b5a11e478a490
    </script>
</body>
</html>
