<?php
if($_SESSION['LoggedIn'] == 1):
    $datosUsuario = (new usuarioRepositorio())->datosUsuarioPorId($_SESSION['id']);
endif;
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
 <link rel="stylesheet" type="text/css" href="web/css/custom.css" />
 <script>
  $(document).ready(function(){
   $('[data-toggle="tooltip"]').tooltip();
  });
 </script>
</head>
<body data-spy="scroll" data-target=".navbar">
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
     <a class="nav-link" href="#presentacion">Presentación</a>
    </li>
    <li class="nav-item">
     <a class="nav-link" href="#info">Info</a>
    </li>
    <li class="nav-item">
     <a class="nav-link" href="#opiniones">Opiniones</a>
    </li>
    <li class="nav-item">
     <a class="nav-link" href="#contacto">Contacto</a>
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

 <div id="presentacion" class="carousel slide" data-ride="carousel">
  <!-- Indicadores -->
  <ul class="carousel-indicators">
   <li data-target="#presentacion" data-slide-to="0" class="active"></li>
   <li data-target="#presentacion" data-slide-to="1"></li>
   <li data-target="#presentacion" data-slide-to="2"></li>
  </ul>

  <!-- Sliders -->
  <div class="carousel-inner">
   <div class="carousel-item active">
    <img src="web/img/carrusel1_edited.jpg" class="mx-auto d-block img-fluid embed-responsive" alt="Imagen carrusel 1">
    <div class="carousel-caption">
     <h2>¿Estás cansado de esperar largas colas sin sentido?</h2>
     <p></p>
    </div>
   </div>
   <div class="carousel-item">
    <img src="web/img/carrusel2_edited.jpg" class="mx-auto d-block img-fluid" alt="Imagen carrusel 2">
    <div class="carousel-caption">
     <h2>¿Te pasas tardes enteras sin saber qué hacer?</h2>
     <p></p>
    </div>
   </div>
   <div class="carousel-item">
    <img src="web/img/carrusel3_edited.jpg" class="mx-auto d-block img-fluid" alt="Imagen carrusel 3">
    <div class="carousel-caption">
     <h2>¡ÚNETE A LA REVOLUCIÓN SITE KEEPER!</h2>
     <p>(El gato ya es uno de los nuestros)</p>
    </div>
   </div>
  </div>

  <!-- Controles (izq/dcha) -->
  <a class="carousel-control-prev" href="#presentacion" data-slide="prev">
   <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#presentacion" data-slide="next">
   <span class="carousel-control-next-icon"></span>
  </a>
 </div>

 <div id="lema" class="container-fluid col-lg-12 bg-light">
     <div class="container" style="padding:30px">
         <div class="row">
             <div class="col-sm-12 text-center">
                 <h1>SITE KEEPERS</h1>
                 <p>Keeping your site for a bright future</p>
             </div>
         </div>
     </div>
 </div>

 <div id="info" class="container" style="margin-top:30px; margin-bottom:30px; color: white">
  <div class="row">
   <div class="col-sm-8">
    <h2 style="color: #ffa813">SOBRE NOSOTROS</h2>
       <p><strong>Site Keepers</strong> es un sitio web en el que es posible registrarse y contactar con otras personas con las que poder <strong>intercambiar tiempo útil por dinero.</strong></p>
       <p>Existen dos posibles roles para el usuario: <strong>site keeper</strong>, el cual ofrece su tiempo en beneficio del cliente que lo contrata; y <strong>cliente,</strong> el cual ofrece su dinero como compensación al tiempo servido por el site keeper.</p>
       <p>El equipo de Site Keepers trabaja día a día para que la aplicación mejore a cada versión.</p>
       <p>Antiguos trabajos recalcables de los creadores de Site Keepers son los siguientes:</p>
       <ul>
           <li><a href="http://wordpress.crezzio.tk/" style="color: #ffa813">Crezzio Games</a></li>
           <li><a href="http://prestashop.crezzio.tk/" style="color: #ffa813">Tienda Crezzio</a></li>
           <li><a href="http://crezzio.tk/formulario.html" style="color: #ffa813">PHPizza</a></li>
       </ul>
       <p>Además del resto de sitios web y empresas relacionadas con la agrupacion <strong>Crezzio.</strong></p>
   </div>
   <div class="col-sm-4">
     <h4 style="color: #ffa813">Datos de contacto:</h4>
     <ul class="flex-column" style="list-style: none">
         <li>
             <p><i class="fa fa-map-marker fa-2x" style="color: #ffa813"></i> Springfield, 742 de Evergreen Terrace</p>
         </li>
         <li>
             <p><i class="fa fa-phone fa-2x" style="color: #ffa813"></i> +34 697 407 791</p>
         </li>
         <li>
             <p><i class="fa fa-envelope fa-2x" style="color: #ffa813"></i> cristellez7@hotmail.com</p>
         </li>
     </ul>
     <hr class="d-sm-none">
   </div>
  </div>
 </div>

 <div id="opiniones" class="container-fluid col-lg-12 bg-light">
  <div class="container" style="padding:30px">
   <div class="row">
    <div class="col-lg-4">
     <img class="rounded-circle mx-auto d-block mb-2" src="web/img/avatar1.svg" alt="Generic placeholder image" width="140" height="140">
     <h4>C. TÉLLEZ<br><small>Full-stack developer</small></h4>
     <p>"Site Keepers me ha cambiado la vida. Ya no podría llevar a cabo mi día a día sin esta aplicación. El servicio ofrecido es impecable y la atención al cliente, inmejorable. ¡Espero su pronta colaboración con empresas del calibre de <a href="http://wordpress.crezzio.tk/">Crezzio Games</a>! 10/10"</p>
     <p><a class="btn btn-dark mx-auto d-block" href="index.php?ctl=registro" role="button">¡Regístrate! &raquo;</a></p>
    </div><!-- /.col-lg-4 -->
    <div class="col-lg-4">
     <img class="rounded-circle mx-auto d-block mb-2" src="web/img/avatar2.svg" alt="Generic placeholder image" width="140" height="140">
     <h4>Y. GARCÍA<br><small>Web designer</small></h4>
     <p>"Aunque en un principio rechacé (varias veces) unirme al universo Site Keepers, poco después comprobé que era una aplicación increíble. Ahora no puedo evitar visitar la página siempre que puedo. ¡Ójala una asociación con mi querida <a href="http://crezzio.tk/formulario.html">PHPizza</a>! 9,5/10"</p>
     <p><a class="btn btn-dark mx-auto d-block" href="index.php?ctl=registro" role="button">¡Regístrate! &raquo;</a></p>
    </div><!-- /.col-lg-4 -->
    <div class="col-lg-4">
     <img class="rounded-circle mx-auto d-block mb-2" src="web/img/avatar3.svg" alt="Generic placeholder image" width="140" height="140">
     <h4>S. HERNÁEZ<br><small>Android/iOS developer</small></h4>
     <p>"A pesar de mi optimismo innato, pocas cosas hay en el mundo que me agraden tanto como esta app y la comunidad que lo rodea. ¡La verdad es que solo Site Keepers y la tienda de videojuegos de <a href="http://prestashop.crezzio.tk">Crezzio</a> me encantan a este nivel! 9/10"</p>
     <p><a class="btn btn-dark mx-auto d-block" href="index.php?ctl=registro" role="button">¡Regístrate! &raquo;</a></p>
    </div><!-- /.col-lg-4 -->
   </div>
  </div>
 </div>

 <div id="contacto" class="container" style="margin-top:30px; margin-bottom: 30px; color: white">
    <div class="row">
    <form class="form-contacto col-md-6 mx-auto" name="formularioContacto" id="formularioContacto" action="app/conf/accionForm.php" method="post" onsubmit="cambiarALoading()">
        <?php // EMAIL ENVIADO
        if ($_SESSION['emailEnviado'] == 1): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class="fa fa-smile-o"></i> ¡Enhorabuena!</strong> El correo ha sido enviado correctamente. ¡Gracias por aportar tu granito de arena!
            </div>
        <?php endif; ?>
        <h2 style="color: #ffa813">¡CONTÁCTANOS!</h2>
        <p class="text-center">Envíanos sugerencias sobre <strong>Site Keepers</strong> y las usaremos para seguir mejorando. ¡Tu opinión es importante!</p>
        <fieldset>
            <div class="form-group">
                <label for="txTitulo" class="sr-only">Título del correo</label>
                <input data-toggle="tooltip" title="Introduce el título" type="text" id="txTitulo" name="txTitulo" class="form-control" placeholder="Título del correo" required>
            </div>
            <div class="form-group">
                <label for="txEmail" class="sr-only">Correo electrónico</label>
                <input data-toggle="tooltip" title="Introduce tu correo electrónico" type="email" id="txEmail" name="txEmail" class="form-control" placeholder="Correo electrónico" required <?php if($_SESSION['LoggedIn'] == 1): ?>value="<?= $datosUsuario->getEmail()?>"<?php endif; ?>>
            </div>
            <div class="form-group">
                <label for="txContenido" class="sr-only">Descripción</label>
                <textarea class="form-control" id="txContenido" name="txContenido" rows="3" placeholder="Escribe algo que enviarnos" required></textarea>
            </div>
            <button data-toggle="tooltip" title="Clica para enviar" class="btn btn-lg btn-secondary btn-block" type="submit" id="btnContacto" name="accion" value="emailContacto">Enviar</button>
        </fieldset>
    </form>
    </div>
 </div>

 <aside>
  <button type="button" onclick="volverArriba()" id="btnVolverArriba" title="Volver arriba" class="fa">&#xf0a6;</button>
 </aside>

 <div class="jumbotron text-center" style="margin-bottom:0">
  <p>© Copyright - <strong><?= date('Y')?> Site Keepers</strong> - Christian Téllez Giraldo</p>

 </div>
 <?php
 unset($_SESSION['emailEnviado']);
 ?>
 <script src="web/js/main.js"></script>
 <script>
     function cambiarALoading() {
         var boton = document.getElementById('btnContacto');
         boton.setAttribute("class", "btn btn-lg btn-warning btn-block");
         boton.innerHTML = "<span class='fa fa-refresh fa-spin'></span> Loading...";
         console.log("Loading");
     }
 </script>
</body>
</html>