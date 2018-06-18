<?php
/* configuraciones comunes a la aplicación */
class configuracion
{ private $dbParams = []; /*Vector con parámetros de configuración del SGBD */

  public function __construct()
  { $this->dbParams = ["driver"=>"pdo_mysql", //no utilizada realmente
                       "server"=>"173.249.11.19", //nombre servidor
                       "port"=>"1433", //puerto por el que escucha las peticiones de la aplicación
                       "database"=>"crezzio_siteKeepers", //nombre de la base de datos
                       "user"=>"crezzio_crezzio", //usuario definido para la aplicación
                       "pass"=>"loftusroad95", //contraseña del usuario
                       "charset"=>"utf-8"]; //conjunto de caracteres
  }

  public function getDbParams()
  { return $this->dbParams;
  }
}

