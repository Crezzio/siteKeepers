<?php ob_start() ?>
<?php
// PATHS DE ARCHIVOS
$pathRaiz = "../../";
$pathImagenes = "../../web/img/";
?>

<h2>Blog de Site Keepers</h2>

<?php $contenido = ob_get_clean() ?>

<?php include 'base.php' ?>
