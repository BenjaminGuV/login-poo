<?php

	/**
	* clase tabla
	*/
	class Table
	{
		
		function __construct()
		{
			# code...
		}

		public function cabeceraTable( $pagina, $ban, $vars ){
			$cabecera = "<tr>";
			foreach ($vars as $key => $value) {

				if ( is_array($value) ) {
					foreach ($value as $key2 => $value2) {
						$cabecera .= '<th>' . $key2 . '</th>';
					}
				}else{
					$cabecera .= "<th><a href='".$_SERVER["PHP_SELF"]."?pagina=".$pagina. "&ban=" . $ban . "&orden=" . $key . "'>" . $value . "</a></th>";
				}


			}
			$cabecera .= "</tr>";

			return $cabecera;
		}

		public function table( $row, $opcion = '<td></td>' )
		{


			for ($i=0; $i < sizeof( $row ) ; $i++) {
				$table .= "<tr>";
				foreach ($row[$i] as $key) {
					$table .= "<td>";
					$table .= $key;
					$table .= "</td>";
				}
				$table .= "</tr>";
			}

			return $table;
		}


		public function paginacion( $numRegistro, $numxPagina, $paginaActual )
		{
			$pagina = $numRegistro / $numxPagina;
			$pagina = ceil( $pagina );
			$text = '<ul>';
			for ($i=1; $i <= $pagina; $i++) {
				if ( $i == $paginaActual ) {
				 	$text .= '<li><strong>' . $i . '</strong></li>';
				 } else {
				 	$text .= '<li>' . $i . '</li>';
				 }
			}
			$text .= '</ul>';

			return $text;
		}
	}

?>