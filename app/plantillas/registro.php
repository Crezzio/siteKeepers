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
    <link href="web/css/signup.css" rel="stylesheet">
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body class="text-center">
    <div class="container-fluid py-3">
        <form class="form-registro col-md-6 mx-auto" name="formularioRegistro" id="formularioRegistro" action="app/conf/accionForm.php" method="post" onsubmit="cambiarALoading()">
            <?php if ($_SESSION['errores']['fechaIncorrecta'] == 1): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> Introduce una fecha correcta, ¡por favor!
            </div>
            <?php elseif ($_SESSION['errores']['rolIncorrecto'] == 1): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> Elige uno de los roles posibles, ¡por favor!
            </div>
            <?php elseif ($_SESSION['errores']['errorCamposVacios'] == 1): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> Algunos campos del formulario están vacíos. ¡Rellénalos, por favor!
            </div>
            <?php elseif ($_SESSION['errores']['usuarioRepetido'] == 1): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> El correo ya está registrado. ¡Elige otro, por favor!
            </div>
            <?php elseif ($_SESSION['errores']['contraseniasDiferentes'] == 1): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> Las contraseñas no coinciden.
            </div>
            <?php elseif ($_SESSION['errores']['errorDesconocido'] == 1): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> Se produjo un error desconocido a la hora de crear su usuario. ¡Póngase en <a href="index.php?ctl=inicio#contacto" data-toggle="tooltip" title="Clica aquí">contacto</a> con nosotros!.
            </div>
            <?php endif;?>
            <input type=hidden name="accion" value="registro">
            <a href="index.php?ctl=inicio">
                <img class="mb-4" src="web/img/logo.png" alt="Logo" width="72" height="72" data-toggle="tooltip" title="Vuelve al inicio">
            <a/>
            <h3 class="h3 mb-3 font-weight-normal">Regístrate</h3>
            <fieldset>
                <div class="form-group">
                    <label for="txEmail" class="sr-only">Correo electrónico</label>
                    <input data-toggle="tooltip" title="Introduce tu correo electrónico" type="email" id="txEmail" name="txEmail"  class="form-control" placeholder="Correo electrónico" required autofocus value="<?= $_SESSION['formulario']['txEmail']?>">
                </div>
                <div class="form-group">
                    <label for="pswUsuario" class="sr-only">Contraseña</label>
                    <input data-toggle="tooltip" title="Introduce tu contraseña" type="password" id="pswUsuario" name="pswUsuario" class="form-control" placeholder="Contraseña" required>
                </div>
                <div class="form-group">
                    <label for="pswUsuarioConfirm" class="sr-only">Contraseña</label>
                    <input data-toggle="tooltip" title="Confirma tu contraseña" type="password" id="pswUsuarioConfirm" name="pswUsuarioConfirm" class="form-control" placeholder="Confirma tu contraseña" required>
                </div>
                <div class="form-group">
                    <select data-toggle="tooltip" title="Elige tu rol" class="form-control" name="selRol" required>
                        <option></option>
                        <option value="siteKeeper" <?php if($_SESSION['formulario']['selRol'] == 'siteKeeper'): ?>selected<?php endif;?>>Site Keeper</option>
                        <option value="cliente" <?php if($_SESSION['formulario']['selRol'] == 'cliente'): ?>selected<?php endif;?>>Cliente</option>
                        <option value="ambos" <?php if($_SESSION['formulario']['selRol'] == 'ambos'): ?>selected<?php endif;?>>Ambos</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="txNombre" class="sr-only">Nombre</label>
                    <input data-toggle="tooltip" title="Introduce tu nombre" type="text" id="txNombre" name="txNombre" class="form-control" placeholder="Nombre" required value="<?= $_SESSION['formulario']['txNombre']?>">
                </div>
                <div class="form-group">
                    <label for="txApellido1" class="sr-only">Primer apellido</label>
                    <input data-toggle="tooltip" title="Tu primer apellido" type="text" id="txApellido1" name="txApellido1" class="form-control" placeholder="Primer apellido" required value="<?= $_SESSION['formulario']['txApellido1']?>">
                </div>
                <div class="form-group">
                    <label for="txApellido2" class="sr-only">Segundo apellido</label>
                    <input data-toggle="tooltip" title="Tu segundo apellido" type="text" id="txApellido2" name="txApellido2" class="form-control" placeholder="Segundo apellido" required value="<?= $_SESSION['formulario']['txApellido2']?>">
                </div>
                <div class="form-group">
                    <label for="fechaNacimiento" class="sr-only">Fecha de nacimiento</label>
                    <input data-toggle="tooltip" title="Introduce tu fecha de nacimiento" type="date" id="fechaNacimiento" name="fechaNacimiento" class="form-control" placeholder="Fecha de nacimiento" required value="<?= $_SESSION['formulario']['fechaNacimiento']?>">
                </div>
                <div class="checkbox">
                    <label>
                        <input name="chTerminos" type="checkbox" value="1" required> He leído y acepto los <a href="https://terminosycondicionesdeusoejemplo.com/"> términos de uso</a>
                    </label>
                </div>
                <button data-toggle="tooltip" title="Clica para registrarte" class="btn btn-lg btn-secondary btn-block" type="submit" id="btnRegistro" value="registro">Registrarme</button>
                <p class="mt-5 mb-3" style="color: rgba(255, 255, 255, .5)">
                    © Copyright - <strong><?= date('Y')?> Site Keepers</strong> - Christian Téllez Giraldo
                </p>
            </fieldset>
        </form>
    </div>
    <?php
    unset($_SESSION['errores']);
    unset($_SESSION['formulario']);
    //unset($_SESSION['errorUsuario']);
    //unset($_SESSION['errorContrasenia']);
    //unset($_SESSION['sesionCerrada']);
    ?>
    <script>
        function cambiarALoading() {
            var boton = document.getElementById('btnRegistro');
            boton.setAttribute("class", "btn btn-lg btn-warning btn-block");
            boton.innerHTML = "<span class='fa fa-refresh fa-spin'></span> Loading...";
            console.log("Loading");
        }
    </script>
</body>
</html>