<?php
/*PRUEBA PARA COMPROBAR EL FUNCIONAMIENTO DE LA LA FUNCIÓN mail() DE PHP
 * $para      = 'christian.tellez@irsoluciones.com';
$titulo    = 'El título';
$mensaje   = 'Hola! Esto es una prueba para aprender a usar la función mail() nativa de PHP. Christian Téllez Giraldo.';
$cabeceras = 'From: ejemplo' . "\r\n" .
    'Reply-To: christian.tellez@irsoluciones.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($para, $titulo, $mensaje, $cabeceras);*/

/*PRUEBA PARA COMPROBAR EL FUNCIONAMIENTO DE LA FUNCIÓN registrarse (DE usuarioRepositorio)
 * function registrarse($EMAIL, $NOMBRE, $APELLIDO1, $APELLIDO2, $CONTRASENIA, $ROL, $FECHA_NACIMIENTO) {
    $sql = "INSERT INTO USUARIO (EMAIL, NOMBRE, APELLIDO1, APELLIDO2, CONTRASENIA, ROL, FECHA_NACIMIENTO)
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
    include_once __DIR__. "/../../core/conexionBd.inc";
    try {
        $con = (new ConexionBd)->getConexion();

        $con->begin_transaction();

        $snt = $con->prepare($sql);

        $snt->bind_param('sssssss', $EMAIL, $NOMBRE, $APELLIDO1, $APELLIDO2, $CONTRASENIA, $ROL, $FECHA_NACIMIENTO);

        $snt->execute();

        $con->commit();

        return true;
    } catch (Exception $ex) {
        $con->rollback();
        return false;
    } finally{
        $snt = null;
        $con = null;
    }
}
$pass = password_hash('crezzio', PASSWORD_DEFAULT);
$resultado = registrarse('christian.tellez@hotmail.co', 'Crezzio', 'Auditore', 'da Firenze', $pass, 'siteKeeper', '1995-03-23');
var_dump($resultado);
*/
?>