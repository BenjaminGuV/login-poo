<?php
	
	//liberias
	require 'conexion/Conf.class.php';
	require 'conexion/DB.class.php';
	require 'libs/Usuario.php';
	require 'libs/Tarea.php';
	require 'libs/Login.class.php';
	require 'libs/Table.class.php';

	//instaciando la clase Db para la conexion a la base
	$db = Db::getInstance();

	//Instaciamos clases
	$Login = new Login();
	$Usuario = new Usuario();
	$Tarea = new Tarea();
	$Table = new Table();
	
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

		//obtenemos los datos de la tabla tarea
		$sql = $Tarea->selectTarea();
		//obtenemos resultados
		$result	= $db->ejecutar( $sql );
		//obtener todos los resultados
		$tareas = $db->obtener_fila( $result );

		$cabNombres =  array(
			'id' => 'Id',
			'actividad' => 'Actividad'
		);

		$tableCompleta = '<table>';

		$tableCompleta .= $Table->cabeceraTable(1, true, $cabNombres);

		$tableCompleta .= $Table->table( $tareas );

		$tableCompleta .= '</table>';
	} else {
		// si no esta logueado direcciona
		header("Location: login.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Index de login</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
	<header>
		<h1>Pruebas</h1>
	</header>
	<nav>
		<ul>
			<li><a href="index.php">Inicio</a></li>
			<li><a href="#">Configuraciones</a></li>
			<li><a href="logout.php">Log out</a></li>
		</ul>
	</nav>
	<section id="intro">
		<header>
			<h2>¡Bienvenidos <?php echo $Usuarios[0]["nombre"]; ?> al panel de control!</h2>
		</header>
		<section>
			<header>
				<h3>Tareas</h3>
				<p><small><a href="vistas/Tareas/crear.php">Crear</a></small></p>
			</header>
			<?php
				echo $tableCompleta;
			?>
		</section>
	</section>
	<aside>
	</aside>
	<footer>
	</footer>
</body>
</html>