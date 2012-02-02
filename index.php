<?php
	
	//liberias
	require 'conexion/Conf.class.php';
	require 'conexion/DB.class.php';
	require 'libs/Usuario.php';
	require 'libs/Login.class.php';

	//instaciando la clase Db para la conexion a la base
	$db = Db::getInstance();

	//Instaciamos clases
	$Login = new Login();
	$Usuario = new Usuario();
	
	//verificar si esta logeado el usuario
	if (  $Login->getStatus() == true ) {
		//guardamos el Id del usuario en $_SESSION
		$Usuario->setId( $_SESSION["sid"] );
		//Pedimos una consulta de los datos del usuario
		$sql = $Usuario->datosUsuario();
		//ejecutamos la consulta
		$result = $db->ejecutar($sql);
		//obtenemos los datos del usuario
		$Usuarios = $db->obtener_fila($result);

	} else {
		// si no esta logueado direcciona
		header("Location: login.php?error=1");
	}

?>
<html>
<head>
	<title>Index de login</title>
</head>
<body>
	<h1>Bienvenidos al panel de control</h1>
	<dl>
		<dt>Usuario</dt>
		<dd><?php echo $Usuarios[0]["nombre"]; ?></dd><br>
		<dt>Pass</dt>
		<dd><?php echo $Usuarios[0]["pass"]; ?></dd>
		<dt>Email</dt>
		<dd><?php echo $Usuarios[0]["email"]; ?></dd>
	</dl>
	<p><small><a href="logout.php">Logout</a></small></p>
</body>
</html>