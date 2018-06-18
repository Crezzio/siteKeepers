<?php ob_start() ?>
<?php
// PATHS DE ARCHIVOS
$pathRaiz = "../../";
$pathImagenes = "../../web/img/";
?>

<h2>Opiniones de Site Keepers y clientes</h2>

<?php $contenido = ob_get_clean() ?>

<?php include 'base.php' ?>
