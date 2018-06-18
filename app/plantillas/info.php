<?php ob_start() ?>
<?php
// PATHS DE ARCHIVOS
$pathRaiz = "../../";
$pathImagenes = "../../web/img/";
?>

<h2>Sobre nosotros</h2>

<section class="sectionInfo">
    <div class="contenedorTexto">
        <h3>La historia de Site Keepers</h3>
        <p>

        </p>
    </div>
    <div class="contenedorCarta">
        <div class="carta">
            <img src="<?= $pathImagenes?>Captura3.jpg" alt="fotoCEO" style="width:100%">
            <h1>Christian Téllez</h1>
            <p class="titulo">CEO & Fundador</p>
            <p>IES Comercio</p>
            <div style="margin: 24px 0;">
                <a target="_blank" href="https://www.instagram.com/?hl=es"><i class="fa fa-instagram"></i></a>
                <a target="_blank" href="https://twitter.com/"><i class="fa fa-twitter"></i></a>
                <a target="_blank" href="https://es.linkedin.com/"><i class="fa fa-linkedin"></i></a>
                <a target="_blank" href="https://es-es.facebook.com/"><i class="fa fa-facebook"></i></a>
            </div>
            <p><button>Contacto</button></p>
        </div>
    </div>
</section>


<?php $contenido = ob_get_clean() ?>

<?php include 'base.php' ?>
