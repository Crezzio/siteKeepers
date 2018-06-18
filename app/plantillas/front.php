<!doctype html>
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
    <link rel="stylesheet" type="text/css" href="web/css/cover.css">
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body class="text-center">

<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="masthead mb-auto">
        <div class="inner">
            <a class="masthead-brand mr-2" href="index.php?ctl=front">
                <img src="web/img/logo.png" alt="Logo" style="width:40px;">
            </a>
            <h3 class="masthead-brand">Site Keepers</h3>
            <nav class="nav nav-masthead justify-content-center">
                <a class="nav-link active" href="index.php?ctl=front">Front</a>
                <a class="nav-link" href="index.php?ctl=inicio">Home</a>
                <a class="nav-link" href="index.php?ctl=login">Login</a>
                <a class="nav-link" href="index.php?ctl=registro">Registro</a>
            </nav>
        </div>
    </header>

    <main role="main" class="inner cover">
        <h1 class="cover-heading">Site Keepers</h1>
        <p class="lead">Keeping your site for a bright future</p>
        <p class="lead">
            <a data-toggle="tooltip" title="¡Entra en el universo Site Keeper!" href="index.php?ctl=inicio" class="btn btn-lg btn-secondary">Entra en el sitio</a>
        </p>
    </main>

    <footer class="mastfoot mt-auto">
        <div class="inner">
            <p>© Copyright - <strong><?= date('Y')?> Site Keepers</strong> - Christian Téllez Giraldo</p>
        </div>
    </footer>

    <!-- <iframe id="myVideo" src="https://www.youtube.com/embed/1IkY0_qONRk?controls=0&showinfo=0&autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen allowautoplay></iframe> -->
</div>

<script src="web/js/main.js"></script>
</body>
</html>