<?php

$email=$_POST['email'];
$password=$_POST['password'];

try{
//conectar base de datos
$connect=mysqli_connect("localhost","root","","programium");
$consulta="SELECT * FROM usuario WHERE correo_usuario='$email' and pasword_usuario='$password'";
$res=mysqli_query($connect, $consulta);

$filas=mysqli_num_rows($res);

if ($filas>0) {
	header("location:http://localhost/learningphp/pagina%20programium%202/suscribirse.html");
}
else{
echo'
		<script>
			alert("La contraseña y email no coinciden");
			location.href="http://localhost/learningphp/pagina%20programium%202/suscribirse.html";
		</script>
	';
}
	}catch(PDOException $e){
			echo "Error: ".$e->getMessage()."<br/>";
		} finally{
			//cerrar conexion
			$conn=null;
			die();
		}


?>php