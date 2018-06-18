<?php
session_start();
include_once '../../fuente/Repositorio/usuarioRepositorio.inc';

$accion = $_POST['accion'];

/**
 * COMPROBAR LOS INPUT TEXT Y TEXTAREA
 * @param $data
 * @return string
 */
function comprobarInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * COMPROBAR SI SE TRATA DE UNA FECHA VÁLIDA
 * @param $fechaNacimiento
 * @return bool
 */
function esFecha($fechaNacimiento) {
    list($year, $month, $day) = explode('-', $fechaNacimiento);
    return checkdate($month, $day, $year);
}

/**
 * COMPROBAR SI SE HA USADO UNO DE LOS VALORES POSIBLES DENTRO DEL ARRAY DE POSIBILIDADES
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
 * COMPROBAR QUE SE TRATA DE UN TIPO DE IMAGEN SOPORTADO
 * @param $imagefile
 * @return bool
 */
function chequearImagen($imagefile) {

    /* Obtener extensión del archivo */
    $dot = (strlen($imagefile) - strrpos($imagefile, ".")-1)*(-1);

    $ext = substr($imagefile, $dot);
    $ext = strtolower($ext);
    //echo $ext;

    /* Chequear que las imágenes sean de alguno de los formatos soportados. Por medio de la funcion strtolower(), pasamos la extensión a minúsculas */
    if(strtolower($ext) != "gif" && strtolower($ext) != "jpg" && strtolower($ext) != "jpeg" && strtolower($ext) != "png")
    {
        return false;
    }
    else
    {
        return true;
    }
}

/**
 * OBTENER LA EXTENSIÓN DEL ARCHIVO DE IMAGEN
 * @param $imagefile
 * @return string
 */
function getExtension($imagefile){
    $dot = (strlen($imagefile) - strrpos($imagefile, ".")-1)*(-1);
    $ext = substr($imagefile, $dot);
    return strtolower($ext);
}

/**
 * PARA ENVIAR EL CORREO EN UTF8 (ACENTOS, CARACTERES EXTRAÑOS...)
 * @param $to
 * @param $from_user
 * @param $from_email
 * @param string $subject
 * @param string $message
 * @return bool
 */
function mail_utf8($to, $subject = '(No subject)', $message = '')
{
    $subject = "=?UTF-8?B?".base64_encode($subject)."?=";

    $headers =
        "MIME-Version: 1.0" . "\r\n" .
        "Content-type: text/html; charset=UTF-8" . "\r\n";

    return mail($to, $subject, $message, $headers);
}

switch($accion):
    case 'login':
        // SI YA HA INICIADO SESIÓN CON OTRA CUENTA, LO REDIRIGIMOS A LA VENTANA DE LOGIN DE NUEVO. TIENE QUE CERRAR SESIÓN ANTES DE HACER LOGIN CON OTRA CUENTA
        if ($_SESSION['LoggedIn'] === 1):
            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=login');
            break;
        endif;
        $email = comprobarInput($_POST['txEmail']);
        $contrasenia = comprobarInput($_POST['pswUsuario']);

        // COMPRUEBO LOS VALORES REQUERIDOS
        if (empty($email) || empty($contrasenia)):
            $_SESSION['errores']['errorCamposVacios'] = 1;
            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=login');
        endif;
        $datosUsuario = (new usuarioRepositorio())->datosUsuarioPorEmail($email);

        if (!isset($datosUsuario)):
            $_SESSION['errores']['errorUsuario'] = 1;
            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=login');
        endif;

        $passCorrecta = password_verify($contrasenia, $datosUsuario->getConstrasenia());

        if ($passCorrecta):
            $_SESSION['LoggedIn'] = 1;
            $_SESSION['id'] = $datosUsuario->getId();
            $_SESSION['rol'] = $datosUsuario->getRol();
            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=inicio');
            // OTRA OPCIÓN SERÍA HACER EN 'else': header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=login&error=1') PERO HAY
            // PROBLEMAS PARA MANDAR DATOS A TRAVÉS DE GET, YA QUE DEBE PASAR PRIMERO POR index.php DONDE SE PIERDE EL VALOR DE error,
            // YA QUE SOLO SE CONTEMPLA EL VALOR DE ctl, POR LO QUE ME VEO OBLIGADO A USAR VARIABLES DE SESIÓN
        else:
            $_SESSION['errores']['errorContrasenia'] = 1;
            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=login');
        endif;
        break;
    case 'registro':
        // 1. VALIDACIÓN DE DATOS
        // SE COMPRUEBAN LOS DATOS INTRODUCIDOS (trim, htmlspecialchars, stripslashes)
        $email = comprobarInput($_POST['txEmail']);
        $contrasenia = comprobarInput($_POST['pswUsuario']);
        $contraseniaConfirm = comprobarInput($_POST['pswUsuarioConfirm']);
        $nombre = comprobarInput($_POST['txNombre']);
        $apellido1 = comprobarInput($_POST['txApellido1']);
        $apellido2 = comprobarInput($_POST['txApellido2']);

        // SE ASIGNAN EL RESTO DE VARIABLES
        $rol = $_POST['selRol'];
        $fechaNacimiento = $_POST['fechaNacimiento'];
        $terminos = $_POST['chTerminos'];

        // SE CUMPRUEBA QUE ESTÁN RELLENADOS LOS CAMPOS REQUIRED
        if (empty($email) || empty($contrasenia) || empty($contraseniaConfirm)|| empty($rol) || empty($nombre) || empty($apellido1) || empty($apellido2) || empty($fechaNacimiento) || empty($terminos)):
            $_SESSION['errores']['errorCamposVacios'] = 1;
            // PARA QUE SE MANTENGAN LOS CAMPOS AL VOLVER AL FORMULARIO
            $_SESSION['formulario']['txEmail'] = $email;
            $_SESSION['formulario']['selRol'] = $rol;
            $_SESSION['formulario']['txNombre'] = $nombre;
            $_SESSION['formulario']['txApellido1'] = $apellido1;
            $_SESSION['formulario']['txApellido2'] = $apellido2;
            $_SESSION['formulario']['fechaNacimiento'] = $fechaNacimiento;
            $_SESSION['formulario']['chTerminos'] = $terminos;

            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=registro');
            break;
        endif;

        // SE COMPRUEBA SI LA FECHA ES CORRECTA
        $fechaCorrecta = esFecha($fechaNacimiento);
        if (!$fechaCorrecta):
            $_SESSION['errores']['fechaIncorrecta'] = 1;
            // PARA QUE SE MANTENGAN LOS CAMPOS AL VOLVER AL FORMULARIO
            $_SESSION['formulario']['txEmail'] = $email;
            $_SESSION['formulario']['selRol'] = $rol;
            $_SESSION['formulario']['txNombre'] = $nombre;
            $_SESSION['formulario']['txApellido1'] = $apellido1;
            $_SESSION['formulario']['txApellido2'] = $apellido2;
            $_SESSION['formulario']['chTerminos'] = $terminos;

            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=registro');
            break;
        endif;

        // SE COMPRUEBA QUE EL ROL ESTÁ ENTRE LOS POSIBLES VALORES
        $posiblesRoles = ['siteKeeper', 'cliente', 'ambos'];
        $rolCorrecto = comprobarValoresPosibles($rol, $posiblesRoles);
        if (!$rolCorrecto):
            $_SESSION['errores']['rolIncorrecto'] = 1;
            // PARA QUE SE MANTENGAN LOS CAMPOS AL VOLVER AL FORMULARIO
            $_SESSION['formulario']['txEmail'] = $email;
            $_SESSION['formulario']['txNombre'] = $nombre;
            $_SESSION['formulario']['txApellido1'] = $apellido1;
            $_SESSION['formulario']['txApellido2'] = $apellido2;
            $_SESSION['formulario']['fechaNacimiento'] = $fechaNacimiento;
            $_SESSION['formulario']['chTerminos'] = $terminos;

            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=registro');
            break;
        endif;

        // SE COMPRUEBA SI EL USUARIO YA ESTÁ CREADO
        $datosUsuario = (new usuarioRepositorio())->datosUsuarioPorEmail($email);
        if (isset($datosUsuario)):
            $_SESSION['errores']['usuarioRepetido'] = 1;
            // PARA QUE SE MANTENGAN LOS CAMPOS AL VOLVER AL FORMULARIO
            $_SESSION['formulario']['selRol'] = $rol;
            $_SESSION['formulario']['txNombre'] = $nombre;
            $_SESSION['formulario']['txApellido1'] = $apellido1;
            $_SESSION['formulario']['txApellido2'] = $apellido2;
            $_SESSION['formulario']['fechaNacimiento'] = $fechaNacimiento;
            $_SESSION['formulario']['chTerminos'] = $terminos;

            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=registro');
            break;
        endif;

        // SE COMPRUEBA QUE LAS CONTRASEÑAS COINCIDEN
        if ($contrasenia !== $contraseniaConfirm):
            $_SESSION['errores']['contraseniasDiferentes'] = 1;
            // PARA QUE SE MANTENGAN LOS CAMPOS AL VOLVER AL FORMULARIO
            $_SESSION['formulario']['txEmail'] = $email;
            $_SESSION['formulario']['selRol'] = $rol;
            $_SESSION['formulario']['txNombre'] = $nombre;
            $_SESSION['formulario']['txApellido1'] = $apellido1;
            $_SESSION['formulario']['txApellido2'] = $apellido2;
            $_SESSION['formulario']['fechaNacimiento'] = $fechaNacimiento;
            $_SESSION['formulario']['chTerminos'] = $terminos;

            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=registro');
            break;
        endif;

        // 2. INSERT EN LA BASE DE DATOS
        $passHash = password_hash($contrasenia, PASSWORD_DEFAULT);
        $insertCorrecto = (new usuarioRepositorio())->registrarse($email, $nombre, $apellido1, $apellido2, $passHash, $rol, $fechaNacimiento);
        if (!$insertCorrecto):
            $_SESSION['errores']['errorDesconocido'] = 1;
            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=registro');
            break;
        endif;

        $_SESSION['registroExitoso'] = 1;
        header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=login');
        break;
    case 'editarDatosGenerales':
        // 1. VALIDACIÓN DE DATOS
        // SE COMPRUEBAN LOS DATOS INTRODUCIDOS (trim, htmlspecialchars, stripslashes)
        $email = comprobarInput($_POST['txEmail']);
        $nombre = comprobarInput($_POST['txNombre']);
        $apellido1 = comprobarInput($_POST['txApellido1']);
        $apellido2 = comprobarInput($_POST['txApellido2']);

        // SE ASIGNAN EL RESTO DE VARIABLES
        $idUsuario = $_POST['idUsuario'];
        $rol = $_POST['selRol'];
        $fechaNacimiento = $_POST['fechaNacimiento'];

        // SE CUMPRUEBA QUE ESTÁN RELLENADOS LOS CAMPOS REQUIRED
        if (empty($email) || empty($rol) || empty($nombre) || empty($apellido1) || empty($apellido2) || empty($fechaNacimiento)):
            $_SESSION['errores']['errorCamposVaciosIniciales'] = 1;
            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=perfil');
            break;
        endif;

        // SE COMPRUEBA SI LA FECHA ES CORRECTA
        $fechaCorrecta = esFecha($fechaNacimiento);
        if (!$fechaCorrecta):
            $_SESSION['errores']['fechaIncorrecta'] = 1;
            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=perfil');
            break;
        endif;

        // SE COMPRUEBA QUE EL ROL ESTÁ ENTRE LOS POSIBLES VALORES
        $posiblesRoles = ['siteKeeper', 'cliente', 'ambos'];
        $rolCorrecto = comprobarValoresPosibles($rol, $posiblesRoles);
        if (!$rolCorrecto):
            $_SESSION['errores']['rolIncorrecto'] = 1;
            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=perfil');
            break;
        endif;

        // SE COMPRUEBA QUE NO ESTÉ EL CORREO YA ELEGIDO
        $correoRepetido = (new usuarioRepositorio())->datosUsuarioPorEmail($email);
        $datosUsuarioActual = (new usuarioRepositorio())->datosUsuarioPorId($idUsuario);
        $correoAntiguo = $datosUsuarioActual->getEmail();

        if ($correoRepetido):
            if ($correoRepetido->getEmail() != $correoAntiguo):
                $_SESSION['errores']['correoRepetido'] = 1;
                header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=perfil');
                break;
            endif;
        endif;

        // 2. UPDATE DE LOS DATOS EN LA BD SI TODOS LOS ANTERIORES PASOS HAN SIDO REALIZADOS CORRECTAMENTE
        $updateCorrecto = (new usuarioRepositorio())->editarDatosGenerales($idUsuario, $email, $rol, $nombre, $apellido1, $apellido2, $fechaNacimiento);
        if (!$updateCorrecto):
            $_SESSION['errores']['errorDesconocido'] = 1;
            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=perfil');
            break;
        endif;

        $_SESSION['modificaciones']['modificacionExitosaIniciales'] = 1;
        header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=perfil');
        break;
    case 'editarContrasenia':
        // 1. VALIDACIÓN DE DATOS
        // SE COMPRUEBAN LOS DATOS INTRODUCIDOS (trim, htmlspecialchars, stripslashes)
        $pswUsuario = comprobarInput($_POST['pswUsuario']);
        $pswUsuarioNueva = comprobarInput($_POST['pswUsuarioNueva']);
        $pswUsuarioConfirm = comprobarInput($_POST['pswUsuarioConfirm']);
        $idUsuario = $_POST['idUsuario'];

        // SE CUMPRUEBA QUE ESTÁN RELLENADOS LOS CAMPOS REQUIRED
        if (empty($pswUsuario) || empty($pswUsuarioNueva) || empty($pswUsuarioConfirm)):
            $_SESSION['errores']['errorCamposVaciosContrasenia'] = 1;
            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=perfil');
            break;
        endif;

        $datosUsuario = (new usuarioRepositorio())->datosUsuarioPorId($idUsuario);

        // POR SI ACASO NO EXISTE EL USUARIO, AUNQUE DEBERÍA EXISTIR SIEMPRE
        if (!isset($datosUsuario)):
            $_SESSION['errores']['errorUsuario'] = 1;
            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=perfil');
            break;
        endif;

        $passCorrecta = password_verify($pswUsuario, $datosUsuario->getConstrasenia());

        if(!$passCorrecta):
            $_SESSION['errores']['errorContrasenia'] = 1;
            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=perfil');
            break;
        endif;

        if ($pswUsuarioNueva !== $pswUsuarioConfirm):
            $_SESSION['errores']['contraseniasDiferentes'] = 1;
            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=perfil');
            break;
        endif;

        // 2. UPDATE DE LOS DATOS EN LA BD SI TODOS LOS ANTERIORES PASOS HAN SIDO REALIZADOS CORRECTAMENTE
        $passHash = password_hash($pswUsuarioNueva, PASSWORD_DEFAULT);
        $updateCorrecto = (new usuarioRepositorio())->editarContrasenia($idUsuario, $passHash);
        if (!$updateCorrecto):
            $_SESSION['errores']['errorDesconocido'] = 1;
            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=perfil');
            break;
        endif;

        $_SESSION['modificaciones']['modificacionExitosaContrasenia'] = 1;
        header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=perfil');
        break;
    case 'editarDescripcion':
        // 1. VALIDACIÓN DE DATOS
        // SE COMPRUEBAN LOS DATOS INTRODUCIDOS (trim, htmlspecialchars, stripslashes)
        $txDescripcion = comprobarInput($_POST['txDescripcion']);
        $idUsuario = $_POST['idUsuario'];

        if (strlen($txDescripcion) > 200):
            $_SESSION['errores']['masDe200Chars'] = 1;
            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=perfil');
            break;
        endif;

        // 2. UPDATE DE LOS DATOS EN LA BD SI TODOS LOS ANTERIORES PASOS HAN SIDO REALIZADOS CORRECTAMENTE
        $updateCorrecto = (new usuarioRepositorio())->editarDescripcion($idUsuario, $txDescripcion);
        if (!$updateCorrecto):
            $_SESSION['errores']['errorDesconocido'] = 1;
            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=perfil');
            break;
        endif;

        $_SESSION['modificaciones']['modificacionExitosaDescripcion'] = 1;
        header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=perfil');
        break;
    case 'editarImagen':
        $nombreImagenInicial = $_FILES['fileImagen']['name'];
        $imagen = $_FILES['fileImagen']['tmp_name'];
        $idUsuario = $_POST['idUsuario'];

        $imagenGuardada = (new usuarioRepositorio())->datosUsuarioPorId($idUsuario)->getImagen();
        if(!empty($imagenGuardada)):
            $_SESSION['errores']['borrarAntesDeModificar'] = 1;
            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=perfil');
            break;
        endif;


        if(empty($imagen)):
            $_SESSION['errores']['emptyImagen'] = 1;
            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=perfil');
            break;
        endif;

        if (!chequearImagen($nombreImagenInicial)):
            $_SESSION['errores']['tipoImagenNoValido'] = 1;
            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=perfil');
            break;
        endif;

        // SE ACTUALIZA EL PATH DEL FICHERO SUBIDO CON EL ID DEL USUARIO + LA EXTENSIÓN (PARA MANTENER UN ORDEN AL GUARDAR LA IMAGEN EN EL SERVIDOR)
        list($nombreImagen, $extension) = explode(".", $nombreImagenInicial);
        // + time() PARA EVITAR EL CACHEADO DE LAS FOTOS
        $pathImagen = $idUsuario . "." . $extension;
        $pathImagenConTime = $pathImagen . "?" . time();

        $updateCorrecto = (new usuarioRepositorio())->editarImagen($idUsuario, $imagen, $pathImagen, $pathImagenConTime);
        if(!$updateCorrecto):
            $_SESSION['errores']['errorSubidaImagen'] = 1;
            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=perfil');
            break;
        endif;

        $_SESSION['modificaciones']['modificacionExitosaImagen'] = 1;
        header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=perfil');
        break;
    case 'borrarImagen':
        $idUsuario = $_POST['idUsuario'];
        $imagenGuardada = (new usuarioRepositorio())->datosUsuarioPorId($idUsuario)->getImagen();
        list($pathImagenGuardada, $time) = explode("?", $imagenGuardada);
        /*var_dump($imagenGuardada);
        var_dump($pathImagenGuardada);
        var_dump($time);*/

        $borradoBaseDatos = (new usuarioRepositorio())->borrarFoto($idUsuario, $pathImagenGuardada);
        if (!$borradoBaseDatos):
            $_SESSION['errores']['errorBorradoImagen'] = 1;
            header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=perfil');
            break;
        endif;

        // QUEDA BORRAR EL ARCHIVO DEL SERVIDOR

        $_SESSION['modificaciones']['modificacionExitosaImagen'] = 1;
        header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=perfil');
        break;
    case 'emailContacto':
        $para = 'cristellez7@hotmail.com';
        $titulo = comprobarInput($_POST['txTitulo'])." - ".comprobarInput($_POST['txEmail']);
        $mensaje = comprobarInput($_POST['txContenido']);
        $mensaje = wordwrap($mensaje, 70, "\r\n");

        mail_utf8($para, $titulo, $mensaje);

        $_SESSION['emailEnviado'] = 1;
        header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=inicio#contacto');
        break;
endswitch;

?>