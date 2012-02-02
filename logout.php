<?php
	
	//librerias
	require 'libs/Login.class.php';

	//instaciando la clase login
	$Login = new Login();
	//cerrando y destruyendo variables de la session
	$Login->cerrarSession();
	//direccionando
	header("Location: login.php");

?>