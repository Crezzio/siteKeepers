<?php ob_start() ?>
<?php
// PATHS DE ARCHIVOS
$pathRaiz = "../../";
$pathImagenes = "../../web/img/";

switch($tipoError):
    case 'Datos':
        echo "<h2>Introduce los datos del formulario de forma correcta, por favor</h2><h3>Clica en el botón inferior para volver a la pagina anterior.</h3>";
        break;
    case 'Permisos':
        echo "<h2>Parece que no tienes los permisos necesrios para acceder a esta página</h2><h3>Clica en el botón inferior para volver a la pagina anterior.</h3>";
        break;
endswitch;
?>

<div id='contenedorInicio'><a id='inicio' class='fa fa-backward' style='cursor: pointer;' onclick='history.back()'></a></div>

<?php $contenido = ob_get_clean() ?>

<?php include '../plantillas/base.php';

exit;?>
