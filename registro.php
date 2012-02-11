<?php
	//librerias
	require 'conexion/Conf.class.php';
	require 'conexion/DB.class.php';
	require 'libs/Usuario.php';
	//instaciando la clase db para la conexion a base de datos
	$db = Db::getInstance();

	if ( $_POST ) {
		//evitando sql injection
		$nombre = mysql_real_escape_string( $_POST["nombre"] );
		$pass = mysql_real_escape_string( $_POST["pass"] );
		$email = mysql_real_escape_string( $_POST["email"] );

		//instanciando la clase usuario
		$Usuario = new Usuario( $nombre, $pass );
		//para crear al usuario necesitamos su email
		$Usuario->setEmail($email);
		//pedimos la consulta para crear el usuario
		$sql = $Usuario->crearUsuario();
		//ejecutamos
		$db->ejecutar($sql);
		//direcciona a login.php
		header("Location: login.php");

	} else {
		//si no - vacio
	}
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Registro</title>
</head>
<body>
	<section id="registro">
		<header>
			<h2>Registrate</h2>
		</header>
		<form method="post" action="registro.php">
			<fieldset>
				<legend>Datos de usuario</legend>
				<dl>
					<dt>Nombre:</dt>
					<dd><input type="text" name="nombre" value=""></dd><br>
					<dt>Password:</dt>
					<dd><input type="password" name="pass" value=""></dd><br>
					<dt>Email:</dt>
					<dd><input type="text" name="email" value=""></dd><br>
				</dl>
				<input type="submit" value="Enviar">
			</fieldset>
		</form>
	</section>
</body>
</html>