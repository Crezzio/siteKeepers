<?php
require_once __DIR__ . '/../app/conf/config.php';

class ConexionBd
{ private $con;

  public function __construct()
  {
    $params = (new Configuracion())->getDbParams();
    mysqli_report(MYSQLI_REPORT_STRICT);

    try {
      $this->con = new mysqli($params['server'], $params['user'], $params['pass'], $params['database']);
      $this->con->set_charset("utf8mb4");

    } catch(Exception $ex) {
      die("Error de conexión ".$ex->getMessage());
    }
  }
  public function getConexion()
  { return $this->con;
  }
}

/*
 * $params = (new Configuracion())->getDbParams();
    mysqli_report(MYSQLI_REPORT_STRICT);

    try {
      $this->con = new mysqli($params['server'], $params['user'], $params['pass'], $params['database']);

    } catch(Exception $ex) {
      die("Error de conexión ".$ex->getMessage());
    }
 */
