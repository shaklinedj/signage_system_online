<!DOCTYPE html>
<html>
	<head>
		<title>Subir Video</title>
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
		<style>
			/* Estilos para la barra de progreso */
			.progress {
				position: relative;
				width: 100%;
				border: 1px solid #ddd;
				padding: 1px;
				border-radius: 3px;
				margin-top: 20px; /* Añadido para un poco de espacio */
			}

			.bar {
				background-color: #4caf50;
				width: 0%;
				height: 30px;
				border-radius: 3px;
			}

			.percent {
				position: absolute;
				display: inline-block;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
				color: white;
			}
		</style>
	</head>
	<body>
		<?php include("navbar_2.php");?>

		<div class="container">
			<div class="row">
				<div class="col-md-12">		
					<h1>Subir Video</h1>
					<h2>videos de hasta 60Mb</h2>
					<form id="uploadForm" enctype="multipart/form-data" method="post" action="upload.php">
						<div class="form-group">
							<label for="fecha">Fecha Termino</label>
							<input type="date" id="fecha" name="fecha" class="form-control">
						</div>
						<div class="form-group">
							<label for="video">Video</label>
							<input type="file" id="video" name="video" required>
						</div>
						<div class="form-group">
							<input type="submit" value="Subir video" class="btn btn-primary">
						</div>
						<!-- Barra de progreso -->
						<div class="progress">
							<div class="bar"></div>
							<div class="percent">0%</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!-- Incluye jQuery -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<!-- Incluye el plugin jquery.form -->
		<script src="jquery.form.min.js"></script> <!-- Asegúrate de actualizar esta ruta -->

		<script>
			$(document).ready(function() {
				var bar = $('.bar');
				var percent = $('.percent');
				var form = $('#uploadForm');

				form.ajaxForm({
					beforeSend: function() {
						var percentVal = '0%';
						bar.width(percentVal);
						percent.html(percentVal);
					},
					uploadProgress: function(event, position, total, percentComplete) {
						var percentVal = percentComplete + '%';
						bar.width(percentVal);
						percent.html(percentVal);
					},
					complete: function(xhr) {
						alert('Archivo subido con éxito');
					}
				});
			});

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
		</script>
	</body>
</html>
