<?php
session_start();

// COMPRUEBA SI SE HA USADO UNO DE LOS VALORES POSIBLES DENTRO DEL ARRAY DE POSIBILIDADES
function comprobarValoresPosibles($valor, $posiblesValores) {
    if (!in_array($valor, $posiblesValores)):
        return false;
    endif;
    return true;
}

// SI NO HA INICIADO SESIÓN, LE REDIRIGE A LA PESTAÑA DE LOGIN
if(!isset($_SESSION['LoggedIn']) || $_SESSION['LoggedIn'] == 0):
    $_SESSION['rol'] = 'visitante';
    $_SESSION['LoggedIn'] = 0;

    //$linkActual = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $uriActual = $_SERVER[REQUEST_URI];
    $posiblesUris = array('/', '/index.php', '/index.php?ctl=front', '/index.php?ctl=inicio', '/index.php?ctl=login', '/index.php?ctl=registro');

    if(!comprobarValoresPosibles($uriActual, $posiblesUris)):
        header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=login');
    endif;
endif;
//index.php

//require_once __DIR__ . '/fuente/Modelo/archivos.php/inc'; /* archivos de modelo*/
//require_once __DIR__ . '/fuente/Controlador/archivos.php/inc'; /*controladores */
require_once __DIR__ . '/fuente/Controlador/defaultController.inc';
require_once __DIR__ . '/fuente/Controlador/usuarioController.inc';
require_once __DIR__ . '/fuente/Modelo/usuario.inc';
require_once __DIR__ . '/app/conf/rutas.php'; /*Ubicación del archivo de rutas*/

// Parseo de la ruta
if (isset($_GET['ctl']))
{ if (isset($mapeoRutas[$_GET['ctl']]))
  { $ruta = $_GET['ctl'];
  }else
  { header('Status: 404 Not Found');
    echo '<html><body><h1>Error 404: No existe la ruta <i>' .
          $_GET['ctl'] .
          '</p></body></html>';
    exit;
  }
}else
{ $ruta = 'front';
}

$controlador = $mapeoRutas[$ruta];
// Ejecución del controlador asociado a la ruta

if (method_exists($controlador['controller'],$controlador['action']))
{ call_user_func(array(new $controlador['controller'], $controlador['action']));
}else
{ header('Status: 404 Not Found');
  echo '<html><body><h1>Error 404: El controlador <i>' .
       $controlador['controller'] .
       '->' . $controlador['action'] .
       '</i> no existe</h1></body></html>';
}


?>
