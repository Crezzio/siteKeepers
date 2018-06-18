<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Christian Téllez Giraldo">
    <link rel="icon" href="web/img/logo.png">
    <title>Site Keepers</title>
    <script src="web/js/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

    <!-- DE BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    <!-- ESTILO PROPIO -->
    <link href="web/css/signin.css" rel="stylesheet">
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body class="text-center">
<form class="form-signin" name="formularioLogin" id="formularioLogin" action="app/conf/accionForm.php" method="post" onsubmit="cambiarALoading()">
    <?php if ($_SESSION['errores']['errorCamposVacios'] == 1): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> Algunos campos del formulario están vacíos. ¡Rellénalos, por favor!
    </div>
    <?php elseif ($_SESSION['errores']['errorUsuario'] == 1): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> El nombre de usuario no existe. ¡Vuelve a intentarlo!
    </div>
    <?php elseif ($_SESSION['errores']['errorContrasenia'] == 1): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> La contraseña es incorrecta. ¡Vuelve a intentarlo!
    </div>
    <?php endif; ?>
    <?php if ($_SESSION['sesionCerrada'] == 1): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><i class="fa fa-smile-o"></i> ¡Adiós!</strong> Cerraste sesión correctamente. ¡Vuelve pronto!
    </div>
    <?php endif; ?>
    <?php if ($_SESSION['LoggedIn'] == 1): ?>
    <div class="alert alert-warning alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><i class="fa fa-user-circle-o"></i> ¡Cuidado!</strong> Ya has iniciado sesión. ¡<a href="index.php?ctl=logout" data-toggle="tooltip" title="Clica aquí">Cierra sesión</a> antes si quieres cambiar de usuario!
    </div>
    <?php endif; ?>
    <?php if ($_SESSION['registroExitoso'] == 1): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><i class="fa fa-smile-o"></i> ¡Enhorabuena!</strong> La cuenta ha sido creada correctamente. ¿A qué esperas para iniciar sesión?
    </div>
    <?php endif; ?>
    <input type=hidden name="accion" value="login">
    <a href="index.php?ctl=inicio">
        <img class="mb-4" src="web/img/logo.png" alt="Logo" width="72" height="72" data-toggle="tooltip" title="Vuelve al inicio">
    <a/>
    <h1 class="h3 mb-3 font-weight-normal">Inicia sesión</h1>
    <div class="form-group">
        <label for="txEmail" class="sr-only">Correo electrónico</label>
        <input data-toggle="tooltip" title="Introduce tu correo electrónico" type="email" id="txEmail" name="txEmail"  class="form-control" placeholder="Correo electrónico" required autofocus <?php if ($_SESSION['LoggedIn'] == 1): ?>disabled<?php endif; ?>>
        <label for="pswUsuario" class="sr-only">Contraseña</label>
        <input data-toggle="tooltip" title="Introduce tu contraseña" type="password" id="pswUsuario" name="pswUsuario" class="form-control" placeholder="Contraseña" required <?php if ($_SESSION['LoggedIn'] == 1): ?>disabled<?php endif; ?>>
    </div>
    <div class="checkbox mb-2">
        <label>
            <input name="recordar" type="checkbox" value="recordar" <?php if ($_SESSION['LoggedIn'] == 1): ?>disabled<?php endif; ?>> Recordarme
        </label>
    </div>
    <button data-toggle="tooltip" title="Clica para iniciar sesión" class="btn btn-lg btn-secondary btn-block" type="submit" id="btnLogin" value="login" <?php if ($_SESSION['LoggedIn'] == 1): ?>disabled<?php endif; ?>>Entrar</button>
    <div class="checkbox mt-1">
        <a data-toggle="tooltip" title="Clica para registrarte" href="index.php?ctl=registro">
            ¿No tienes una cuenta aún?
        </a>
    </div>
    <p class="mt-5 mb-3" style="color: rgba(255, 255, 255, .5)">
        © Copyright - <strong><?= date('Y')?> Site Keepers</strong> - Christian Téllez Giraldo
    </p>
</form>
<?php
    unset($_SESSION['errores']);
    unset($_SESSION['sesionCerrada']);
    unset($_SESSION['registroExitoso']);
?>
<script>
    /*function login() {
        // PARA QUE NO PUEDA SER CLICADO EL BOTON 2 VECES SEGUIDAS, PUDIENDO DAR ERRORES EN LA BD
        this.disabled=true;
        document.formularioLogin.accion.value='login';
        document.formularioLogin.submit();
    }*/
    function cambiarALoading() {
        var boton = document.getElementById('btnLogin');
        boton.setAttribute("class", "btn btn-lg btn-warning btn-block");
        boton.innerHTML = "<span class='fa fa-refresh fa-spin'></span> Loading...";
        console.log("Loading");
    }
</script>
</body>
</html>