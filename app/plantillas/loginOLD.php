<?php
/* Ejemplo de plantilla que se mostrará dentro de la plantilla principal
  ob_start() activa el almacenamiento en buffer de la página. Mientras se
             almacena en el buffer no se produce salida alguna hacia el
             navegador del cliente
  luego viene el código html y/o php que especifica lo que debe aparecer en
     el cliente web
  ob_get_clean() obtiene el contenido del buffer (que se pasa a la variable
             $contenido) y elimina el contenido del buffer
  Por último, se incluye la página que muestra la imagen común de la aplicación
    (en este caso base.php) la cual contiene una referencia a la variable
    $contenido que provocará que se muestre la salida del buffer dentro dicha
    página "base.php"
*/
?>
<?php ob_start() ?>
<?php

// PATHS DE ARCHIVOS
$pathRaiz = "../../";
$pathImagenes = "../../web/img/";

//PARA LA COMPROBACIÓN DE USUARIOS. TODO CUANDO LE DÉ A MI CABECITA POR PENSAR CLARAMENTE

/*
function comprobarValoresPosibles($valor, $posiblesValores) {
    if (!in_array($valor, $posiblesValores)):
        return false;
    endif;
    return true;
}


function comprobacionPermisos($logPosibles, $gruposPosibles) {
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
        include "app/conf/error.php";
        exit;
    endif;
    if (!comprobarValoresPosibles($_SESSION['LoggedIn'], $logPosibles)):
        echo "<br>ERROR de login";
        $tipoError = 'Login';
        include __DIR__ . "app/conf/error.php";
        exit;
    endif;
}

$logsPosibles = array('1');
$gruposPosibles = array('admin', 'sitekeeper', 'cliente', 'ambos', 'visitante');

comprobacionPermisos($logsPosibles, $gruposPosibles);
*/

// USANDO EL MÉTODO SIN CLASES
// CARGO LOS RESULTADOS DE LA CONSULTA
//$obj = $resultado->fetch_object();
// USANDO EL MÉTODO CON CLASES
//echo $usuarios[0]->getNombre()."<br>";
//echo $usuarios[0]->getEmail()."<br>";

if($_SESSION['LoggedIn'] == 0):
    ?>
    <h2>¡Oh! parece que no has iniciado sesión</h2>
    <h3>Necesitas estar registrado para disfrutar de los servicios ofrecidos por Site-Keepers</h3>
    <p>
        <i>Clica en el botón de login si ya eres uno de los nuestros: <button onclick="document.getElementById('modalLogin').style.display='block'" style="width:auto;">Login</button></i>
    </p>
    <p>
        <i>¿Aún no tienes una <a href="index.php?ctl=registro">cuenta</a>?</i>
    </p>

    <div id="modalLogin" class="modal">

        <form name="formularioLogin" id="formularioLogin" class="modal-content animate" action="<?= $pathRaiz?>app/conf/accionForm.php" method="post">
            <input type=hidden name="accion" value="login">
            <div class="imgcontainer">
                <span onclick="document.getElementById('modalLogin').style.display='none'" class="close" title="Cerrar ventana modal">&times;</span>
                <img src="<?= $pathImagenes?>logo.png" alt="Avatar" class="avatar" title="Site Keepers">
            </div>

            <div class="container">
                <label for="txEmail"><b>Usuario</b></label>
                <input type="text" placeholder="Introduzca su e-mail..." name="txEmail" required>

                <label for="pswUsuario"><b>Password</b></label>
                <input type="password" placeholder="Contraseña..." id="pswUsuario" name="pswUsuario" required>


                <button type="button" onclick="login()">Login</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Recordarme
                </label>
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('modalLogin').style.display='none'" class="cancelbtn">Cancelar</button>
                <span class="psw"><i>¿Aún no tienes una <a href="index.php?ctl=registro">cuenta</a>?</i></span>
            </div>
        </form>
    </div>
<?php elseif ($_SESSION['LoggedIn'] == 1):?>
    <figure>
        <img src="web/img/warning.png" style="margin: 0 auto">
    </figure>
    <h2>¡Ya has iniciado sesión!</h2>
    <h3>No puedes iniciar sesión con otra cuenta hasta que cierres sesión con esta, <?= $_SESSION['nombre']?>.</h3>
    <p style="text-align: center">
        <i>Si quieres cerrar sesión y después iniciar sesión con otra cuenta, ¡clica en sl siguiente botón!</i>
    </p>
    <div id='contenedorInicio'><a id='botonLogout' class='fa fa-sign-out' style='cursor: pointer;' href="/index.php?ctl=logout"></a></div>
<?php endif; ?>

    <script>
        // Recoge la ventana modal
        var modal = document.getElementById('modalLogin');

        // Cuando se clica fuera de la ventana, esta se cierra
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };

        function login() {
            this.disabled=true;
            mostrarLoading();
            document.formularioLogin.accion.value='login';
            document.formularioLogin.submit();
        }

    </script>

<?php $contenido = ob_get_clean() ?>

<?php include 'base.php' ?>