<?php
$pathRaiz = "../../";
$pathImagenes = "../../web/img/";

/**
 * COMPRUEBA SI SE HA USADO UNO DE LOS VALORES POSIBLES DENTRO DEL ARRAY DE POSIBILIDADES
 * @param $valor
 * @param $posiblesValores array de valores posibles
 * @return bool
 */
function comprobarValoresPosibles($valor, $posiblesValores) {
    if (!in_array($valor, $posiblesValores)):
        return false;
    endif;
    return true;
}

/**
 * FUNCIÓN QUE SE INCLUIRÁ EN TODAS LAS PÁGINAS PARA COMPROBAR SI EL USUARIO PUEDE ACCEDER A LA PÁGINA O NO
 */
function comprobacionPermisos($logPosibles, $gruposPosibles) {
    global $pathRaiz;
    var_dump($_SESSION);
    var_dump($gruposPosibles);
    echo comprobarValoresPosibles($_SESSION['rol'], $gruposPosibles);
    echo comprobarValoresPosibles($_SESSION['LoggedIn'], $logPosibles);

    if (!comprobarValoresPosibles($_SESSION['rol'], $gruposPosibles)):
        echo "<br>ERROR de permisos";
        $tipoError = 'Permisos';
        include __DIR__ . "error.php";
        exit;
    endif;
    if (!comprobarValoresPosibles($_SESSION['LoggedIn'], $logPosibles)):
        echo "<br>ERROR de login";
        $tipoError = 'Login';
        include __DIR__ . "error.php";
        exit;
    endif;
}

/*function comprobacionPermisos($logPosibles, $gruposPosibles) {
    var_dump($_SESSION);
    var_dump($logPosibles);
    var_dump($gruposPosibles);

    $comprobacionPermisos = comprobarValoresPosibles($_SESSION['rol'], $gruposPosibles) ? 'true' : 'false';
    $comprobacionLogin = comprobarValoresPosibles($_SESSION['LoggedIn'], $logPosibles) ? 'true' : 'false';

    echo "<br>1-".$comprobacionPermisos;
    echo "<br>2-".$comprobacionLogin;

    if (!comprobarValoresPosibles($_SESSION['rol'], $gruposPosibles)):
        echo "<br>ERROR de permisos";
        $tipoError = 'Permisos';
        include __DIR__ . "../conf/error.php";
        exit;
    endif;
    if (!comprobarValoresPosibles($_SESSION['LoggedIn'], $logPosibles)):
        echo "<br>ERROR de login";
        $tipoError = 'Login';
        include __DIR__ . "../conf/error.php";
        exit;
    endif;
}*/
?>