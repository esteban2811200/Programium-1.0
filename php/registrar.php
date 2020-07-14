<?php
	
	$host = "localhost";
	$db = "programium";
	$user = "root";
	$pass = "";


	
	try{
		//ESTABLECE CONEXION A LA BD
		$connect = new PDO("mysql:host=$host;dbname=$db;charset=utf8",$user,$pass);
		$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$correo_usuario= $_POST['email'];
	$nombre_usuario= $_POST['nombre'];
	$apellido_usuario= $_POST['apellido'];
	$password_usuario= $_POST['password'];
	$var1= $_POST['ocupacion'];
	$ocupacion = 0;
	if ($var1="Estudiante") {
		$ocupacion= 1;
	}
	if ($var1="Profesor") {
		$ocupacion= 2;	
	}
	if ($var1="Empleado") {
		$ocupacion= 3;
	}
	if ($var1="Independiente") {
		$ocupacion= 4;	
	}
	if ($var1="Otra") {
		$ocupacion= 5;	
	}
	

	$req = (strlen($nombre_usuario)*strlen($apellido_usuario)*strlen($correo_usuario)*strlen($password_usuario)*strlen($ocupacion)) or die("<script>
			alert('No se han llenado todos los campos, Ingrese nuevamente los campos')
			location.href='http://localhost/learningphp/pagina%20programium%202/ingresar.html'
		</script>");



	$passworduser = md5($password_usuario);
	
	
	$sql="INSERT INTO usuario(correo_usuario, nombre_usuario, apellido_usuario, pasword_usuario, cod_ocupacion) VALUES('$correo_usuario','$nombre_usuario','$apellido_usuario','$passworduser', $ocupacion)";


		$sentence = $connect->prepare($sql);
		$sentence->bindParam(':correo_usuario', $correo_usuario);
		$sentence->bindParam(':nombre_usuario', $correo_usuario);
		$sentence->bindParam(':apellido_usuario', $apellido_usuario);
		$sentence->bindParam(':pasword_usuario', $passworduser);
		$sentence->bindParam(':cod_ocupacion', $ocupacion);
		$sentence->execute();


	echo'
		<script>
			alert("Registro Exitoso");
			location.href="http://localhost/learningphp/pagina%20programium%202/suscribirse.html";
		</script>	
	';
	}catch(PDOException $e){
			echo "Error: ".$e->getMessage()."<br/>";
		} finally{
			//cerrar conexion
			$conn=null;
			die();
		}

?>