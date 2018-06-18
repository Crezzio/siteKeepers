<?php ob_start() ?>
<?php
// PATHS DE ARCHIVOS
$pathRaiz = "../../";
$pathImagenes = "../../web/img/";
?>

<?php switch($tipoError):
    case 'Datos':?>
        <h2>Introduzca los datos del formulario de forma correcta, por favor</h2><h3>Clique en el boton inferior para volver a la pagina anterior.</h3>
    <? endswitch;
?>

<div id='contenedorInicio'><a id='inicio' class='fa fa-backward' style='cursor: pointer;' onclick='history.back()'></a></div>

<?php $contenido = ob_get_clean() ?>

<?php include 'base.php' ?>
