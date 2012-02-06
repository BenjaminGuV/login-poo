<?php

	require '../../conexion/DB.class.php';
	require '../../conexion/Conf.class.php';
	require '../../libs/Tarea.php';

	if ($_POST) {
		//verificamos que no haya algun tipo de codigo malisioso
		$actividad = mysql_real_escape_string($_POST["actividad"]);

		$db = Db::getInstance();
		$Tarea = new Tarea();

		$sql = $Tarea->crearTarea($actividad);
		$result = $db->ejecutar($sql);

		header("Location: ../../index.php");

	} else {
		//nada
	}
?>
<!doctype html>
<html>
<head>
	<title>Crear Tarea</title>

	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<meta charset="UTF-8" />
</head>
<body>
	<header>
		<h1>Pruebas</h1>
	</header>
	<nav>
		<ul>
			<li><a href="index.php">Inicio</a></li>
			<li><a href="configuracion.php">Configuraciones</a></li>
			<li><a href="logout.php">Log out</a></li>
		</ul>
	</nav>
	<section id="intro">
		<header>
			<h2>Crear Tarea</h2>
		</header>
		<section>
			<form method="post" action="crear.php">
				<dl>
					<dt>Actividad:</dt>
					<dl><input type="text" name="actividad" value=""></dl><br>
				</dl>
				<input type="submit" value="Crear">
			</form>
		</section>
	</section>
	<aside>
	</aside>
	<footer>
	</footer>
</body>
</html>