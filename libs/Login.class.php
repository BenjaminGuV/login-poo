<?php

	/**
	* Clase Login
	*/
	class Login
	{

		private $_id;
		private $_nombre;
		private $_pass;
		private $_status = false;
		
		//constructor con dos parametros opcionales
		function __construct($nombre = '', $pass = '')
		{
			$this->_nombre = $nombre;
			$this->_pass = $pass;
		}

		/**
		 * setter/getter
		 */
		public function setId( $id ){	$this->_id = $id; }
		public function getId(){ return $this->_id; }
		public function setNombre( $nombre ){	$this->_nombre = $nombre; }
		public function getNombre(){ return $this->_nombre; }
		public function setPass( $pass ){	$this->_pass = $pass; }
		public function getPass(){ return $this->_pass; }

		/**
		 * 
		*/
		//activar la session
		private function varSession()
		{
			session_name("pruebas");
			session_start();
		}
		
		//crea la session
		private function crearSession( $id )
		{
			$this->varSession();
			$_SESSION["autentificado"] = true;
			$_SESSION["sid"] = $id;
			$this->_status = true;
		}
		//verifica si el password coinciden y retorna falso o verdadero
		public function verificarUsuario( $valor )
		{
			if ($valor[0]["pass"] == $this->_pass ) {
				$this->crearSession( $valor[0]["id"] );
				$ban = true;
			} else {
				$ban = false;
			}
			return $ban;
			
		}
		//verifica el estado de la session
		public function getStatus()
		{
			$this->varSession();
			$this->_status = $_SESSION["autentificado"];
			return $this->_status;

		}
		//cierra la session y elimina las variables
		public function cerrarSession()
		{
			$this->varSession();
			session_destroy();
			unset($_SESSION);
			$this->_status;
		}


		

	}
?>