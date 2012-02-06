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

			for ($i=0; $i < sizeof( $row[0] ) ; $i++) {
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


		function pagina($pages , $numeroRegistros, $ban, $orden)
		{
			//////////calculo de elementos necesarios para paginacion
		    //tamaño de la pagina
		    $tamPag=15;
		
		    //pagina actual si no esta definida y limites
		    if(!isset($pages))
		    {
		       $pagina=1;
		       $inicio=1;
		       $final=$tamPag;
		    }else{
		       $pagina = $pages;
		    }
		    //calculo del limite inferior
		    $limitInf=($pagina-1)*$tamPag;
		
		    //calculo del numero de paginas
		    $numPags=ceil($numeroRegistros/$tamPag);
		    if(!isset($pagina))
		    {
		       $pagina=1;
		       $inicio=1;
		       $final=$tamPag;
		    }else{
		       $seccionActual=intval(($pagina-1)/$tamPag);
		       $inicio=($seccionActual*$tamPag)+1;
		
		       if($pagina<$numPags)
		       {
		          $final=$inicio+$tamPag-1;
		       }else{
		          $final=$numPags;
		       }
		
		       if ($final>$numPags){
		          $final=$numPags;
		       }
		    }




		    if($pagina>1)
		    {
		       $x = "<a class='p' href='".$_SERVER["PHP_SELF"]."?pagina=".($pagina-1)."&orden=". $orden . "&ban=".$ban."'>";
		       $x .= "<font face='verdana' size='-2'>anterior</font>";
		       $x .= "</a> ";
		    }
		
		    for($i=$inicio;$i<=$final;$i++)
		    {
		       if($i==$pagina)
		       {
		          $x .= "<font face='verdana' size='-2'><b>".$i."</b> </font>";
		       }else{
		          $x .= "<a class='p' href='".$_SERVER["PHP_SELF"]."?pagina=".$i."&orden=".$orden."&ban=".$ban."'>";
		          $x .= "<font face='verdana' size='-2'>".$i."</font></a> ";
		       }
		    }
		    if($pagina<$numPags)
		   {
		       $x .= " <a class='p' href='".$_SERVER["PHP_SELF"]."?pagina=".($pagina+1)."&orden=".$orden."&ban=".$ban."'>";
		       $x .= "<font face='verdana' size='-2'>siguiente</font></a>";
		   }

		   return $x;

		}



	}

?>