<?php 
 
/* Clase encargada de gestionar las conexiones a la base de datos */ 
Class Db{ 
 
   private $servidor; 
   private $usuario; 
   private $password; 
   private $base_datos; 
   private $link; 
   private $stmt; 
   private $array; 
 
   static $_instance; 
 
   /*La función construct es privada para evitar que el objeto pueda ser creado mediante new*/ 
   private function __construct(){ 
      $this->setConexion(); 
      $this->conectar(); 
   } 
 
   /*Método para establecer los parámetros de la conexión*/ 
   private function setConexion(){ 
      $conf = Conf::getInstance(); 
      $this->servidor=$conf->getHostDB(); 
      $this->base_datos=$conf->getDB(); 
      $this->usuario=$conf->getUserDB(); 
      $this->password=$conf->getPassDB(); 
   } 
 
   /*Evitamos el clonaje del objeto. Patrón Singleton*/ 
   private function __clone(){ } 
 
   /*Función encargada de crear, si es necesario, el objeto. Esta es la función que debemos llamar desde fuera de la clase para instanciar el objeto, y así, poder utilizar sus métodos*/ 
   public static function getInstance(){ 
      if (!(self::$_instance instanceof self)){ 
         self::$_instance=new self(); 
      } 
         return self::$_instance; 
   } 
 
   /*Realiza la conexión a la base de datos.*/ 
   private function conectar(){ 
      $link = $this->link=mysql_connect($this->servidor, $this->usuario, $this->password);
      if($link){
         $p = mysql_select_db($this->base_datos,$this->link); 
         @mysql_query("SET NAMES 'utf8'"); 
      }

      if (!$link){ 
         error_log(0,'Problema de conexión a la base de datos.'); 
         exit('Perdonen las molestias. Tenemos un problema técnico. Esperamos resolverlo en los próximos minutos');
      }else{ 
         $this->link = $link; 
      }

   }

   public function desconectar()
   {
      mysql_close();
   }
 
   /*Método para ejecutar una sentencia sql*/ 
   public function ejecutar($sql){ 
      $this->stmt=mysql_query($sql,$this->link);
      return $this->stmt; 
   } 
 
   /*Método para obtener una fila de resultados de la sentencia sql*/ 
   public function obtener_fila($stmt, $fila = null){ 

      unset($this->array);

      if ($fila === 0){
         $this->array[]=mysql_fetch_assoc($stmt); 
      }elseif ( $fila === null ) {
         while ( $row =@ mysql_fetch_assoc($stmt) ) {
            $this->array[] = $row;
         }
      }
      else{ 
         mysql_data_seek($stmt,$fila); 
         $this->array[]=mysql_fetch_assoc($stmt); 
      } 
      return $this->array; 
   } 
 
   //Devuelve el último id del insert introducido 
   public function lastID(){ 
      return mysql_insert_id($this->link); 
   }
   
   //desconecta la conexion a la base de datos
   public function __sleep()
   {
      mysql_close();
   }
   
   public function __wakeup()
   {
      $this->conectar();
   } 
 
}
?>