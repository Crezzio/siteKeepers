<?php
$datosUsuario = (new usuarioRepositorio())->datosUsuarioPorId($_SESSION['id']);
?>
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
    <link rel="stylesheet" type="text/css" href="web/css/perfil.css" />
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">
<div class="jumbotron text-center" style="margin-bottom:0; padding: 1rem 1rem 0 1rem;">
    <figure class="figure">
        <img class="figure-img float-left mr-3" src="web/img/logo.png" alt="Logo" width="100px">
        <figcaption class="figure-caption float-right mt-2">
            <h1 style="color: green">Site Keepers</h1>
            <p>Keeping your site for a bright future</p>
        </figcaption>
    </figure>
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
    <a class="navbar-brand" href="index.php">
        <img data-toggle="tooltip" title="Vuelve a la portada" src="web/img/logo.png" alt="Logo" style="width:40px;">
    </a>
    <a class="navbar-brand" href="index.php?ctl=inicio">Site Keepers</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav mr-auto">
            <?php if ($_SESSION['LoggedIn'] == 1): ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?ctl=principal">Principal</a>
                </li>
            <?php endif;?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?ctl=inicio#presentacion">Presentación</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?ctl=inicio#info">Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?ctl=inicio#opiniones">Opiniones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?ctl=inicio#contacto">Contacto</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <?php if ($_SESSION['LoggedIn'] == 0): ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?ctl=registro"><i class="fa fa-address-book-o"></i> Registro</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?ctl=login"><i class="fa fa-sign-in"></i> Login</a>
                </li>
            <?php elseif ($_SESSION['LoggedIn'] == 1): ?>
                <li class="nav-item">
                    <a data-toggle="tooltip" title="Visita tu perfil" class="nav-link mt-1" href="index.php?ctl=perfil"><i class="fa fa-user-circle-o"></i> <?= $datosUsuario->getNombre()?></a>
                </li>
                <li>
                    <a class="navbar-brand dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                        <img class="rounded-circle" <?php if ($datosUsuario->propiedadSeteada('imagen')): ?>src="web/img/<?= $datosUsuario->getImagen()?>" <?php else: ?>src="web/img/avatarDefault.jpg"<?php endif;?> alt="Foto de perfil" style="width:40px;">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="index.php?ctl=perfil">Perfil</a>
                        <a class="dropdown-item" href="index.php?ctl=logout">Cerrar sesión</a>
                    </div>
                </li>
            <?php endif;?>
        </ul>
    </div>
</nav>

<div class="container-fluid" style="height:310px; background-image: url('web/img/backgroundPerfil.jpg'); background-position: bottom">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-profile text-center m-1" style="background-color: transparent; color: #fff; border: none">
                <div class="card-body">
                    <a href="index.php?ctl=perfil"><img data-toggle="tooltip" title="Visita tu perfil" class="card-img-profile rounded-circle" <?php if ($datosUsuario->propiedadSeteada('imagen')): ?>src="web/img/<?= $datosUsuario->getImagen()?>" <?php else:?>src="web/img/avatarDefault.jpg"<?php endif; ?> alt="avatar-<?= $datosUsuario->getNombre()?>"></a>
                    <h4 class="card-title font-weight-bold"><?= $datosUsuario->getNombre().' '.$datosUsuario->getApellido1().' '.$datosUsuario->getApellido2()?></h4>
                    <p class="card-text">
                        <p class="card-text">
                            <?php if($datosUsuario->propiedadSeteada('descripcion')):
                                if (strlen($datosUsuario->getDescripcion()) < 95):
                                ?>
                                <?= $datosUsuario->getDescripcion()?>
                                <?php else: ?>
                                <?= substr($datosUsuario->getDescripcion(), 0, 95) . " [...]"?>
                                <?php endif; ?>
                            <?php else: ?>
                                No has introducido aún ninguna descripción.
                            <?php endif; ?>
                        </p>
                        <p class="card-text">
                            <?php if ($datosUsuario->getRol() === 'siteKeeper'): ?><span class="badge badge-success">Site Keeper</span>
                            <?php elseif ($datosUsuario->getRol() === 'cliente'): ?><span class="badge badge-info">Cliente</span>
                            <?php elseif ($datosUsuario->getRol() === 'ambos'): ?><span class="badge badge-success">Site Keeper</span> <span class="badge badge-info">Cliente</span>
                            <?php elseif ($datosUsuario->getRol() === 'admin'): ?><span class="badge badge-secondary">Admin</span><?php endif; ?>
                        </p>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid px-0 bg-dark">
    <ul class="nav nav-tabs text-center d-flex justify-content-center w-100">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#datos">Iniciales</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#contrasenia">Contraseña</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#descripcion">Descripción</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#imagen">Imagen</a>
        </li>
    </ul>
</div>

<div class="container" style="margin-top: 30px; margin-bottom: 30px; min-height: 500px">
    <div class="row">
        <div class="col-sm-12 tab-content text-center" style="color: #fff;">
            <div id="datos" class="container tab-pane active">
                <form class="form-perfil col-md-6 mx-auto" name="formularioDatosGenerales" id="formularioDatosGenerales" action="app/conf/accionForm.php" method="post" onsubmit="cambiarALoading('btnDatosGenerales')">
                    <?php // ERRORES INICIALES
                        if ($_SESSION['errores']['fechaIncorrecta'] == 1): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> Introduce una fecha correcta, ¡por favor!
                        </div>
                    <?php elseif ($_SESSION['errores']['rolIncorrecto'] == 1): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> Elige uno de los roles posibles, ¡por favor!
                        </div>
                    <?php elseif ($_SESSION['errores']['errorCamposVaciosIniciales'] == 1): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> Algunos campos del formulario están vacíos. ¡Rellénalos, por favor!
                        </div>
                    <?php elseif ($_SESSION['errores']['correoRepetido'] == 1): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> El correo al que intentas cambiar ya está elegido por otro usuario. ¡Elige otro, por favor!
                        </div>
                    <?php elseif ($_SESSION['errores']['errorDesconocido'] == 1): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> Se produjo un error desconocido a la hora de crear su usuario. ¡Póngase en <a href="index.php?ctl=inicio#contacto" data-toggle="tooltip" title="Clica aquí">contacto</a> con nosotros!.
                        </div>
                    <?php // ERRORES CONTRASEÑA
                        elseif ($_SESSION['errores']['errorCamposVaciosContrasenia'] == 1): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> Algunos campos del formulario están vacíos. ¡Rellénalos, por favor!
                        </div>
                    <?php elseif ($_SESSION['errores']['errorUsuario'] == 1): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> ¡El usuario no existe!
                        </div>
                    <?php elseif ($_SESSION['errores']['errorContrasenia'] == 1): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> La contraseña antigua es incorrecta. ¡Vuelve a intentarlo!
                        </div>
                    <?php elseif ($_SESSION['errores']['contraseniasDiferentes'] == 1): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> Las contraseñas no coinciden. ¡Vuelve a intentarlo!
                        </div>
                    <?php // ERRORES DESCRIPCIÓN
                        elseif ($_SESSION['errores']['masDe200Chars'] == 1): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> La descripción no puede tener más de 200 caracteres.
                        </div>
                    <?php // ERRORES IMAGEN
                        elseif ($_SESSION['errores']['emptyImagen'] == 1): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> Introduce una imagen, ¡por favor!
                        </div>
                    <?php elseif ($_SESSION['errores']['tipoImagenNoValido'] == 1): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> Tienes que introducir un archivo válido de imagen (jpg, jpeg, png o gif).
                        </div>
                    <?php elseif ($_SESSION['errores']['errorSubidaImagen'] == 1): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> Ocurrió un error a la hora de subir la imagen. ¡Vuelve a intentarlo!
                        </div>
                    <?php elseif ($_SESSION['errores']['errorBorradoImagen'] == 1): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> Ocurrió un error a la hora de borrar la imagen. ¡Vuelve a intentarlo!
                        </div>
                    <?php elseif ($_SESSION['errores']['borrarAntesDeModificar'] == 1): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> ¡Tienes que borrar la foto de perfil actual antes de poner una nueva!
                        </div>
                    <?php // MODIFICACIONES CORRECTAS
                        elseif ($_SESSION['modificaciones']['modificacionExitosaIniciales'] == 1): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong><i class="fa fa-smile-o"></i> ¡Enhorabuena!</strong> Tus datos han sido modificados correctamente. ¡Sigue editando tu perfil si quieres!
                    </div>
                    <?php elseif ($_SESSION['modificaciones']['modificacionExitosaContrasenia'] == 1): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="fa fa-smile-o"></i> ¡Enhorabuena!</strong> Tu contraseña ha sido modificada correctamente. ¡Sigue editando tu perfil si quieres!
                        </div>
                    <?php elseif ($_SESSION['modificaciones']['modificacionExitosaDescripcion'] == 1): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong><i class="fa fa-smile-o"></i> ¡Enhorabuena!</strong> Tus descripción ha sido modificada correctamente. ¡Sigue editando tu perfil si quieres!
                    </div>
                    <?php elseif ($_SESSION['modificaciones']['modificacionExitosaImagen'] == 1): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong><i class="fa fa-smile-o"></i> ¡Enhorabuena!</strong> Tu foto de perfil ha sido modificada correctamente. ¡Sigue editando tu perfil si quieres!
                    </div>
                    <?php endif;?>
                    <h3 class="h3 mb-3 font-weight-normal">Modifica tus datos generales</h3>
                    <input type=hidden name="idUsuario" value="<?= $_SESSION['id']?>">
                    <fieldset>
                        <div class="form-group">
                            <label for="txEmail" class="sr-only">Correo electrónico</label>
                            <input data-toggle="tooltip" title="Introduce tu correo electrónico" type="email" id="txEmail" name="txEmail"  class="form-control" placeholder="Correo electrónico" required autofocus value="<?= $datosUsuario->getEmail()?>">
                        </div>
                        <div class="form-group">
                            <select data-toggle="tooltip" title="Elige tu rol" class="form-control" name="selRol" required>
                                <option></option>
                                <option value="siteKeeper" <?php if($datosUsuario->getRol() == 'siteKeeper'): ?>selected<?php endif;?>>Site Keeper</option>
                                <option value="cliente" <?php if($datosUsuario->getRol() == 'cliente'): ?>selected<?php endif;?>>Cliente</option>
                                <option value="ambos" <?php if($datosUsuario->getRol() == 'ambos'): ?>selected<?php endif;?>>Ambos</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="txNombre" class="sr-only">Nombre</label>
                            <input data-toggle="tooltip" title="Introduce tu nombre" type="text" id="txNombre" name="txNombre" class="form-control" placeholder="Nombre" required value="<?= $datosUsuario->getNombre()?>">
                        </div>
                        <div class="form-group">
                            <label for="txApellido1" class="sr-only">Primer apellido</label>
                            <input data-toggle="tooltip" title="Tu primer apellido" type="text" id="txApellido1" name="txApellido1" class="form-control" placeholder="Primer apellido" required value="<?= $datosUsuario->getApellido1()?>">
                        </div>
                        <div class="form-group">
                            <label for="txApellido2" class="sr-only">Segundo apellido</label>
                            <input data-toggle="tooltip" title="Tu segundo apellido" type="text" id="txApellido2" name="txApellido2" class="form-control" placeholder="Segundo apellido" required value="<?= $datosUsuario->getApellido2()?>">
                        </div>
                        <div class="form-group">
                            <label for="fechaNacimiento" class="sr-only">Fecha de nacimiento</label>
                            <input data-toggle="tooltip" title="Introduce tu fecha de nacimiento" type="date" id="fechaNacimiento" name="fechaNacimiento" class="form-control" placeholder="Fecha de nacimiento" required value="<?= $datosUsuario->getFechaNacimiento()?>">
                        </div>
                        <button data-toggle="tooltip" title="Clica para confirmar" class="btn btn-lg btn-secondary btn-block" type="submit" id="btnDatosGenerales" name="accion" value="editarDatosGenerales">Confirmar</button>
                    </fieldset>
                </form>
            </div>
            <div id="contrasenia" class="container tab-pane fade">
                <form class="form-perfil col-md-6 mx-auto" name="formularioContrasenia" id="formularioContrasenia" action="app/conf/accionForm.php" method="post" onsubmit="cambiarALoading('btnContraseña')">
                    <h3 class="h3 mb-3 font-weight-normal">Cambia tu contraseña</h3>
                    <input type=hidden name="idUsuario" value="<?= $_SESSION['id']?>">
                    <fieldset>
                        <div class="form-group">
                            <label for="pswUsuario" class="sr-only">Contraseña antigua</label>
                            <input data-toggle="tooltip" title="Introduce tu antigua contraseña" type="password" id="pswUsuario" name="pswUsuario" class="form-control" placeholder="Contraseña antigua" required>
                        </div>
                        <div class="form-group">
                            <label for="pswUsuarioNueva" class="sr-only">Contraseña nueva</label>
                            <input data-toggle="tooltip" title="Introduce tu nueva contraseña" type="password" id="pswUsuarioNueva" name="pswUsuarioNueva" class="form-control" placeholder="Contraseña nueva" required>
                        </div>
                        <div class="form-group">
                            <label for="pswUsuarioConfirm" class="sr-only">Contraseña</label>
                            <input data-toggle="tooltip" title="Confirma tu nueva contraseña" type="password" id="pswUsuarioConfirm" name="pswUsuarioConfirm" class="form-control" placeholder="Confirma tu nueva contraseña" required>
                        </div>
                        <button data-toggle="tooltip" title="Clica para confirmar" class="btn btn-lg btn-secondary btn-block" type="submit" id="btnContraseña" name="accion" value="editarContrasenia">Confirmar</button>
                    </fieldset>
                </form>
            </div>
            <div id="descripcion" class="container tab-pane fade">
                <form class="form-perfil col-md-6 mx-auto" name="formularioDescripcion" id="formularioDescripcion" action="app/conf/accionForm.php" method="post" onsubmit="cambiarALoading('btnDescripcion')">
                    <h3 class="h3 mb-3 font-weight-normal">Edita tu descripción</h3>
                    <input type=hidden name="idUsuario" value="<?= $_SESSION['id']?>">
                    <fieldset>
                        <div class="form-group">
                            <label for="txDescripcion" class="sr-only">Descripción</label>
                            <textarea class="form-control" id="txDescripcion" name="txDescripcion" rows="3" placeholder="Aún no has escrito nada. ¿A qué esperas, <?= $datosUsuario->getNombre()?>?"><?= $datosUsuario->getDescripcion()?></textarea>
                            <div id="charNum"></div>
                        </div>
                    </fieldset>
                    <button data-toggle="tooltip" title="Clica para confirmar" class="btn btn-lg btn-secondary btn-block" type="submit" id="btnDescripcion" name="accion" value="editarDescripcion">Confirmar</button>
                </form>
            </div>
            <div id="imagen" class="container tab-pane fade">
                <form enctype="multipart/form-data" class="form-perfil col-md-6 mx-auto" name="formularioImagen" id="formularioImagen" action="app/conf/accionForm.php" method="post" onsubmit="cambiarALoading('editarImagen'); cambiarALoading('borrarImagen');">
                    <h3 class="h3 mb-3 font-weight-normal">Cambia tu foto de perfil</h3>
                    <h6 style="color: #aeaeae">¡Fíjate en cómo quedaría la foto para elegir aquella que más te guste!<br><small><strong>Pista:</strong> las mejores fotos son aquellas con formato cuadrado (dimensiones 1:1).</small><br><small style="color: yellow"><strong>Importante:</strong> antes de modificar tu foto de perfil, tienes que borrar la anterior.</small></be></h6>
                    <input type=hidden name="idUsuario" value="<?= $_SESSION['id']?>">
                    <fieldset class="mt-3">
                        <div class="form-group">
                            <img class="rounded-circle" id="imagenMostrada" src="" alt="Imagen a subir">
                            <label for="fileImagen" class="sr-only">Input de imagen</label>
                            <input type="file" class="form-control-file mt-4" name="fileImagen" id="fileImagen" style="font-weight: normal" onchange="imagenPreview(event)" accept="image/*">
                        </div>
                    </fieldset>
                    <div class="btn-group d-flex">
                        <button data-toggle="tooltip" class="btn btn-lg btn-secondary flex-fill" type="submit" id="editarImagen" name="accion" value="editarImagen" onclick="return comprobarTipoArchivo('fileImagen')" <?php if ($datosUsuario->propiedadSeteada('imagen')): ?>title="Borra la foto antes de elegir una nueva" disabled<?php else: ?>title="Clica para modificar la foto"<?php endif; ?>>Confirmar</button>
                        <button data-toggle="tooltip" class="btn btn-lg btn-danger flex-fill" type="submit" id="borrarImagen" name="accion" value="borrarImagen" <?php if (!$datosUsuario->propiedadSeteada('imagen')): ?>title="No puedes borrar nada aún" disabled<?php else: ?>title="Clica para borrar la foto"<?php endif; ?>>Borrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<aside>
    <button type="button" onclick="volverArriba()" id="btnVolverArriba" title="Volver arriba" class="fa">&#xf0a6;</button>
</aside>

<div class="jumbotron text-center" style="margin-bottom:0">
    <p>© Copyright - <strong><?= date('Y')?> Site Keepers</strong> - Christian Téllez Giraldo</p>

</div>
<?php
unset($_SESSION['errores']);
unset($_SESSION['modificaciones']);
?>
<script src="web/js/main.js"></script>
<script>
    function cambiarALoading(idBoton) {
        var boton = document.getElementById(idBoton);
        boton.setAttribute("class", "btn btn-lg btn-warning btn-block");
        boton.innerHTML = "<span class='fa fa-refresh fa-spin'></span> Loading...";
        console.log("Loading");
    }

    $('#txDescripcion').keyup(function () {
        var max = 200;
        var len = $(this).val().length;
        if (len > max) {
            $('#charNum').text('¡Has superado al límite de caracteres! (200)');
        } else {
            var char = max - len;
            $('#charNum').text(char + ' caracteres restantes');
        }
    });
</script>
</body>
</html>