<?php
	/**
	* clase tarea
	*/
	class Tarea
	{
		
		private $_id;
		private $_actividad;

		/**
		 * setter/getter
		 */
		public function setId( $id ){ $this->_id = $id; }
		public function getId(  ){ return $this->_id; }

		function __construct($act = "")
		{
			$this->_actividad = $act;
		}

		public function crearTarea($act)
		{
			$sql = sprintf( "INSERT INTO tareas(actividad) VALUE ('%s');", $act );

			return $sql;
		}

		public function selectTarea( $pagina = 0, $numxPagina = 0 )
		{
			if ( $numxPagina == 0 && $pagina == 0 ) {
				$sql = sprintf( "SELECT * FROM tareas" );
			} else {
				$registro = $numxPagina * ( $pagina - 1 );
				$sql = sprintf( "SELECT * FROM tareas LIMIT %d, %d", $registro, $numxPagina );
			}

			return $sql;
		}

	}
?>