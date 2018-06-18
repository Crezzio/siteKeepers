<?php ob_start() ?>

<?php
$_SESSION['LoggedIn'] = 0;
echo "<h2>Has cerrado sesión correctamente</h2>";
echo "<p>Te estamos dirigiendo a la página de inicio.</p>";
echo "<meta http-equiv='refresh' content='1;/index.php'>";

?>

<?php $contenido = ob_get_clean() ?>

<?php include 'base.php' ?>