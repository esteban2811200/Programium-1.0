<?php
require_once __DIR__ . '/php/Controller.php'; //Clase que genera el backend
$data = Controller::singleton();

if (isset($_REQUEST['registrar']) && !empty($_REQUEST['registrar'])) {

	$result = $data->register($_REQUEST['nombre'], $_REQUEST['apellido'], $_REQUEST['email'], $_REQUEST['pais'], $_REQUEST['estado'], $_REQUEST['ciudad'], $_REQUEST['nacimiento'], $_REQUEST['password'], $_REQUEST['ocupacion']); 
	if ($result) {
		?>
		<script>
			alert('Gracias por su registro ahora puede ingresar al panel con su correo y contraseña');
			window.location = '/admin';
		</script>
		<?php
	} else { ?>
		<script>
			alert('Error generado, intente mas tarde');
		</script>
		<?php
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta http-equiv="x-ua-compatible" content="ie-edge" />
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
	<!-- <link rel="stylesheet" type="text/css" href="css/carousel.css" /> -->
	<!-- <link rel="stylesheet" href="assets/css/style.css" /> -->
	<link rel="stylesheet" href="assets/css/styles.css" />

	<title>Registro</title>
</head>

<body background="assets/images/fondo_login.jpg">
	<section id="section6">
		<div class="col-md-6 mx-auto">
			<div class="card card-default">
				<div class="card-header">
					<h3 class="card-title">¡Incríbete y comienza a aprender con nosotros!</h3>
				</div>
				<form class="form-horizontal" method="POST">
					<div class="card-body">
						<div class="form-group row">
							<label for="nombre" class="col-md-2 control-label">Nombre</label>
							<div class="col-md-10">
								<input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre" required/>
							</div>
						</div>
						<div class="form-group row">
							<label for="apellido" class="col-md-2 control-label">Apellidos</label>
							<div class="col-md-10">
								<input type="text" id="apellido" name="apellido" class="form-control" placeholder="Apellido" required/>
							</div>
						</div>
						<div class="form-group row">
							<label for="email" class="col-md-2 control-label">Correo electrónico</label>
							<div class="col-md-10">
								<input type="email" id="email" name="email" class="form-control" placeholder="Correo Electrónico" />
							</div>
						</div>
						<div class="form-group row">
							<label for="pais" class="col-md-2 control-label">País</label>
							<div class="col-md-10">
								<input type="text" id="pais" name="pais" class="form-control" placeholder="País" required/>
							</div>
						</div>
						<div class="form-group row">
							<label for="estado" class="col-md-2 control-label">Estado/Departamento</label>
							<div class="col-md-10">
								<input type="text" id="estado" name="estado" class="form-control" placeholder="Estado/Departamento" required/>
							</div>
						</div>
						<div class="form-group row">
							<label for="ciudad" class="col-md-2 control-label">Ciudad</label>
							<div class="col-md-10">
								<input type="text" id="ciudad" name="ciudad" class="form-control" placeholder="Ciudad" required/>
							</div>
						</div>
						<div class="form-group row">
							<label for="ciudad" class="col-md-2 control-label">Fecha Nacimiento</label>
							<div class="col-md-10">
								<input type="date" id="nacimiento" name="nacimiento" class="form-control" placeholder="Fecha de Nacimiento " />
							</div>
						</div>
						<div class="form-group row">
							<label for="ciudad" class="col-md-2 control-label">Contraseña</label>
							<div class="col-md-10">
								<input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required/>
							</div>
						</div>
						<div class="form-group row">
							<label for="ciudad" class="col-md-2 control-label">Ocupación</label>
							<div class="col-md-10">
								<select class="form-control" id="ocupacion" name="ocupacion" required>
									<option value="AL">Estudiante</option>
									<option value="AK">administrador</option>
									<option value="AZ">Profesor</option>
									<option value="AR">Empleado</option>
									<option value="CA">Independiente</option>
									<option value="CO">Otra</option>
								</select>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<div class="form-group row">
							<div class="col-md-10">
								<button id="registrar" name="registrar" value="registrar" class="boton_Ingresar_2 btn-header" type="submit">
									Registrarse
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
	<!-- <script src="js/jquery-3.3.1.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script> -->
</body>

</html>