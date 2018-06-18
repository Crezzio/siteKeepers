<?php
$datosUsuario = (new usuarioRepositorio())->datosUsuarioPorId($_SESSION['id']);
$datosUsuarioFicha = (new usuarioRepositorio())->datosUsuarioPorId($_GET['id']);
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
    <link rel="stylesheet" type="text/css" href="web/css/principal.css" />
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

<div class="container" style="margin-top: 30px; margin-bottom: 30px; min-height: 600px">
    <div class="row">
        <div class="col-sm-4">
            <!-- PARA CENTRAR LA FICHA -->
        </div>
        <div class="col-sm-4">
            <div class="card card-profile text-center m-1">
                <img class="card-img-top" src="web/img/backgroundPerfil.jpg" alt="Fondo perfil" style="width: 100%">
                <div class="card-body">
                    <a href="index.php?ctl=principal"><img data-toggle="tooltip" title="Vuelve a la página principal" class="card-img-profile rounded-circle" <?php if ($datosUsuarioFicha->propiedadSeteada('imagen')): ?>src="web/img/<?= $datosUsuarioFicha->getImagen()?>" <?php else:?>src="web/img/avatarDefault.jpg"<?php endif; ?> alt="avatar-<?= $datosUsuarioFicha->getNombre()?>"></a>
                    <h4 class="card-title font-weight-bold"><?= $datosUsuarioFicha->getNombre().' '.$datosUsuarioFicha->getApellido1().' '.$datosUsuarioFicha->getApellido2()?></h4>
                    <p class="card-text">
                        <?php if($datosUsuarioFicha->propiedadSeteada('descripcion')):?>
                            <i>"<?= $datosUsuarioFicha->getDescripcion()?>"</i>
                        <?php else: ?>
                            No ha introducido aún ninguna descripción.
                        <?php endif; ?>
                    </p>
                    <p class="card-text">
                        <strong>Correo: </strong><?= $datosUsuarioFicha->getEmail()?>
                    </p>
                    <p class="card-text">
                        <strong>Fecha de nacimiento: </strong><?= $datosUsuarioFicha->getFechaNacimiento()?>
                    </p>
                    <p class="card-text">
                        <?php if ($datosUsuarioFicha->getRol() === 'siteKeeper'): ?><span class="badge badge-success">Site Keeper</span>
                        <?php elseif ($datosUsuarioFicha->getRol() === 'cliente'): ?><span class="badge badge-info">Cliente</span>
                        <?php elseif ($datosUsuarioFicha->getRol() === 'ambos'): ?><span class="badge badge-success">Site Keeper</span> <span class="badge badge-info">Cliente</span>
                        <?php elseif ($datosUsuarioFicha->getRol() === 'admin'): ?><span class="badge badge-secondary">Admin</span><?php endif; ?>
                    </p>
                </div>
            </div>
            <?php if ($_SESSION['errores']['fechaIncorrecta'] == 1): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><i class="fa fa-frown-o"></i> ¡Ups!</strong> Introduce una fecha correcta, ¡por favor!
                </div>
            <?php endif; ?>
        </div>
        <div class="col-sm-4">
            <!-- PARA CENTRAR LA FICHA -->
        </div>
    </div>
</div>

<aside>
    <button type="button" onclick="volverArriba()" id="btnVolverArriba" title="Volver arriba" class="fa">&#xf0a6;</button>
</aside>

<div class="jumbotron text-center" style="margin-bottom:0">
    <p>© Copyright - <strong><?= date('Y')?> Site Keepers</strong> - Christian Téllez Giraldo</p>

</div>

<script src="web/js/main.js"></script>
<script>
    $(document).ready(function(){
        $("#txBusqueda").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".media").filter(function() {
                $(this).toggle($(this).find(".mediaTitle").text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
</body>
</html>