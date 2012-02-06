<?php

	/**
	* Clase usuario
	*/
	class Usuario
	{
		/**
		 * Declaramos variables
		*/
		private $_id;
		private $_nombre;
		private $_pass;
		private $_email;
		private $_usuarios;
		
		//contructor con dos parametros opcionales
		function __construct( $nombre = '', $pass = '' )
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
		public function setEmail( $email ){	$this->_email = $email; }
		public function getEmail(){ return $this->_email; }

		//metodo que devuelve una consulta para crear un usuario
		public function crearUsuario()
		{
			$this->_pass = $this->cifrarPass($this->_pass);
			$sql = sprintf( "INSERT INTO usuarios( nombre, pass, email) VALUES ( '%s', '%s', '%s')", $this->_nombre, $this->_pass, $this->_email );

			return $sql;

		}
		//metodo que devuelve una consulta para verificar si el usuario existe
		public function selectUsuario()
		{
			$sql = sprintf( "SELECT * FROM usuarios WHERE nombre = '%s'", $this->_nombre );

			return $sql;
		}
		//metodo que devuelve una consulta para obtener los datos del usuario
		public function datosUsuario()
		{
			$sql = sprintf( "SELECT * FROM usuarios WHERE id = '%d'", $this->_id );

			return $sql;
		}

		//cifrar password a SHA254

		private function cifrarPass($pass)
		{

			$this->_pass = hash('sha256', $pass);

			return $this->_pass;
		}

	}
?>