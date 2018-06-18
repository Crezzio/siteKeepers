<!-- Vista común a la mayoría (sino todas) las vistas de la aplicación
     Suele contener la imagen corporativa de la apliación Web
     Concretamente esta página contiene el nombre de la empresa
     "Site Keepers" y una barra de hiperenlaces con un enlace a la
     página home, llamado "inicio"
     El nombre del archivo es indiferente: layout, comun, etc.
-->
<?php
$pathRaiz = "../../";
$pathImagenes = "../../web/img/";


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Christian Téllez Giraldo">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="<?= $pathRaiz?>web/css/main.css" />
    <link rel="icon" href="../../web/img/logo.png">
    <title>Site Keepers</title>
    <script src="../../web/js/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
  </head>
  <body>
    <nav id="navegadorInicio" class="navbar" data-spy="affix" data-offset-top="197">
      <span id="abrirCerrarNav" style="font-size:30px; cursor: pointer" onclick="comprobarNav()">&#9776; abrir</span>
      <a href="/index.php" id="logoNav"><img src="../../web/img/logo.png" alt="logoSiteKeepers" class="logoSiteKeepers" height="40"></a>
      <div class="btn-group" style="float: right">
        <a href="/index.php?ctl=perfil"><button type="button" class="btn btn-success" style="margin-right: 1px"><i class="fa fa-user-circle-o"></i><?php if($_SESSION['LoggedIn'] == 1): echo " ".$_SESSION['nombre']; else: echo ' Usuario'; endif;?></button></a>
        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu text-center" role="menu">
          <li><a href="/index.php?ctl=login">Login</a></li>
          <li><a href="/index.php?ctl=logout">Cerrar sesión</a></li>
          <li><a href="/index.php?ctl=registro">Registro</a></li>
        </ul>

      </div>
    </nav>
    <header class="jumbotron">
      <figure>
        <a href="/index.php"><img src="../../web/img/logo.png" alt="logoSiteKeepers" class="logoSiteKeepers" height="40"></a>
        <figcaption><h1>Site Keepers</h1></figcaption>
      </figure>
    </header>
    <aside id="mySidenav" class="sidenav">
      <a href="javascript:void(0)" class="closebtn enlacesSidenav" onclick="comprobarNav()">&times;</a>
      <a href="/index.php?ctl=inicio" class="fa enlacesSidenav">&#xf015; <span style="font-family: Raleway">Inicio</span></a>
      <a href="/index.php?ctl=login" class="fa enlacesSidenav">&#xf090; <span style="font-family: Raleway">Login</span></a>
      <a href="/index.php?ctl=logout" class="fa enlacesSidenav">&#xf08b; <span style="font-family: Raleway">Cerrar sesión</span></a>
      <a href="/index.php?ctl=registro" class="fa enlacesSidenav">&#xf2ba; <span style="font-family: Raleway">Registro</span></a>
      <a href="javascript:void(0)" onclick="history.back()" class="fa enlacesSidenav">&#xf04a; <span style="font-family: Raleway">Anterior</span></a>
    </aside>
    <aside id="botonesHover" class="botonesHover">
        <a href="/index.php?ctl=info" id="info">Info</a>
        <a href="/index.php?ctl=blog" id="blog">Blog</a>
        <a href="/index.php?ctl=opiniones" id="opiniones">Opiniones</a>
        <a href="/index.php?ctl=contacto" id="contacto">Contacto</a>
    </aside>
    <aside class="barraRedesSociales">
      <a target="_blank" href="https://es-es.facebook.com/" class="facebook" title="Facebook"><i class="fa fa-facebook"></i></a>
      <a target="_blank" href="https://twitter.com/" class="twitter" title="Twitter"><i class="fa fa-twitter"></i></a>
      <a target="_blank" href="https://www.google.es/" class="google" title="Google"><i class="fa fa-google"></i></a>
      <a target="_blank" href="https://es.linkedin.com/" class="linkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a>
      <a target="_blank" href="https://www.youtube.com/?hl=es&gl=ES" class="youtube" title="Youtube"><i class="fa fa-youtube"></i></a>
      <a target="_blank" href="https://www.instagram.com/?hl=es" class="instagram" title="Instagram"><i class="fa fa-instagram"></i></a>
    </aside>
    <aside>
      <button type="button" onclick="volverArriba()" id="btnVolverArriba" title="Volver arriba" class="fa">&#xf0a6;</button>
    </aside>
    <section id="contenido">
      <?= $contenido ?>
    </section>
    <img id="loadingGif" src="<?= $pathImagenes?>loadingGif.gif" alt="gifLoading">
    <footer class="container-fluid text-center">
      <p align="center">© Copyright - <strong><?= date('Y')?> Site Keepers</strong> - Christian Téllez Giraldo</p>

    </footer>
    <script src="web/js/main.js"></script>
  </body>
</html>
