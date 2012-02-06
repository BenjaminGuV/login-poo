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

		public function selectTarea()
		{
			$sql = sprintf( "SELECT * FROM tareas" );

			return $sql;
		}

	}
?>