<?php
class UsuarioRepositorio
{
    function cargaUsuarios() {
        $sql = "SELECT *
                    FROM USUARIO";

        include_once __DIR__ .'/../../core/conexionBd.inc';

        try {
            $con = (new ConexionBd)->getConexion();

            require_once __DIR__."/../Modelo/usuario.inc";
            $resultado = $con->query($sql);

            $usuarios = [];
            while($row = $resultado->fetch_assoc()) {
                $usuarios[] = new Usuario($row);
            }

            return $usuarios;
        } catch (Exception $ex) {
            throw $ex;
        } finally {
            $con = null;
        }
    }
    function cargaUsuariosSinClases() {
        $sql = "SELECT *
                    FROM USUARIO";

        include_once __DIR__ .'/../../core/conexionBd.inc';

        try {
            $con = (new ConexionBd)->getConexion();

            $resultado = $con->query($sql);

            return $resultado;
        } catch (Exception $ex) {
            throw $ex;
        } finally {
            $con = null;
        }
    }
    function datosUsuarioPorEmail($email) {
        $sql = "SELECT * FROM USUARIO WHERE EMAIL='$email'";

        include_once __DIR__ .'/../../core/conexionBd.inc';
        try {
            $con = (new ConexionBd)->getConexion();

            require_once __DIR__."/../Modelo/usuario.inc";
            $resultado = $con->query($sql);

            $datosUsuario = null;
            while($row = $resultado->fetch_assoc()) {
                $datosUsuario = new Usuario($row);
            }

            return $datosUsuario;
        } catch (Exception $ex) {
            throw $ex;
        } finally {
            $con = null;
        }
    }
    function datosUsuarioPorId($id) {
        $sql = "SELECT * FROM USUARIO WHERE ID_USUARIO='$id'";

        include_once __DIR__ .'/../../core/conexionBd.inc';
        try {
            $con = (new ConexionBd)->getConexion();

            require_once __DIR__."/../Modelo/usuario.inc";
            $resultado = $con->query($sql);

            $datosUsuario = null;
            while($row = $resultado->fetch_assoc()) {
                $datosUsuario = new Usuario($row);
            }

            return $datosUsuario;
        } catch (Exception $ex) {
            throw $ex;
        } finally {
            $con = null;
        }
    }
    function registrarse($EMAIL, $NOMBRE, $APELLIDO1, $APELLIDO2, $CONTRASENIA, $ROL, $FECHA_NACIMIENTO) {
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

    function editarDatosGenerales($ID_USUARIO, $EMAIL, $ROL, $NOMBRE, $APELLIDO1, $APELLIDO2, $FECHA_NACIMIENTO) {
        $sql = "UPDATE USUARIO SET
                        EMAIL = '$EMAIL',
                        ROL = '$ROL',
                        NOMBRE = '$NOMBRE',
                        APELLIDO1 = '$APELLIDO1',
                        APELLIDO2 = '$APELLIDO2',
                        FECHA_NACIMIENTO = '$FECHA_NACIMIENTO'
                        WHERE ID_USUARIO = $ID_USUARIO";

        include_once __DIR__ . '/../../core/conexionBd.inc';
        try {
            $con = (new ConexionBd)->getConexion();

            $snt = $con->prepare($sql);
            require_once __DIR__ . "/../Modelo/usuario.inc";
            $snt->execute();

            return true;
        } catch (Exception $ex) {
            return false;
        } finally{
            $snt = null;
            $con = null;
        }
    }

    function editarContrasenia($ID_USUARIO, $CONTRASENIA_HASH) {
        $sql = "UPDATE USUARIO SET
                        CONTRASENIA = '$CONTRASENIA_HASH'
                        WHERE ID_USUARIO = $ID_USUARIO";

        include_once __DIR__ . '/../../core/conexionBd.inc';
        try {
            $con = (new ConexionBd)->getConexion();

            $snt = $con->prepare($sql);
            require_once __DIR__ . "/../Modelo/usuario.inc";
            $snt->execute();

            return true;
        } catch (Exception $ex) {
            return false;
        } finally{
            $snt = null;
            $con = null;
        }
    }

    function editarDescripcion($ID_USUARIO, $DESCRIPCION) {
        $sql = "UPDATE USUARIO SET
                        DESCRIPCION = '$DESCRIPCION'
                        WHERE ID_USUARIO = $ID_USUARIO";

        include_once __DIR__ . '/../../core/conexionBd.inc';
        try {
            $con = (new ConexionBd)->getConexion();

            $snt = $con->prepare($sql);
            require_once __DIR__ . "/../Modelo/usuario.inc";
            $snt->execute();

            return true;
        } catch (Exception $ex) {
            return false;
        } finally{
            $snt = null;
            $con = null;
        }
    }

    function editarImagen($ID_USUARIO, $IMAGEN, $pathImagen, $pathImagenConTime) {
        $sql = "UPDATE USUARIO SET
                        IMAGEN = '$pathImagenConTime'
                        WHERE ID_USUARIO = $ID_USUARIO";

        include_once __DIR__ . '/../../core/conexionBd.inc';
        try {
            $con = (new ConexionBd)->getConexion();

            $con->begin_transaction();

            $snt = $con->prepare($sql);
            require_once __DIR__ . "/../Modelo/usuario.inc";
            $snt->execute();

            $subida = move_uploaded_file($IMAGEN, '../../web/img/'.$pathImagen);
            if (!$subida):
                return false;
            endif;

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

    function borrarFoto($ID_USUARIO, $pathImagen) {
        $sql = "UPDATE USUARIO SET
                        IMAGEN = NULL
                        WHERE ID_USUARIO = $ID_USUARIO";

        include_once __DIR__ . '/../../core/conexionBd.inc';
        try {
            $con = (new ConexionBd)->getConexion();

            $con->begin_transaction();

            $snt = $con->prepare($sql);
            require_once __DIR__ . "/../Modelo/usuario.inc";
            $snt->execute();

            // COMPROBAMOS QUE EXISTE
            $borrado = file_exists('../../web/img/'.$pathImagen);
            if (!$borrado):
                return false;
            endif;

            // LO BORRAMOS
            $borrado = unlink('../../web/img/'.$pathImagen);
            if (!$borrado):
                return false;
            endif;

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
}
// VERSIONES ANTERIORES
/*
function cargaUsuarios()
    {
        $sql = "SELECT *
                FROM usuario";

        include_once __DIR__ . '/../../core/conexionBd.inc';
        try {
            $con = (new ConexionBd)->getConexion();
            var_dump($con);
            exit;
            $snt = $con->prepare($sql);
            require_once __DIR__ . "/../Modelo/usuario.inc";
            $snt->execute();

            $usuarios = [];
            while ($fila = $snt->fetch(PDO::FETCH_ASSOC)) {
                $usuarios[] = new Usuario($fila);
            }

            return $usuarios;
        } catch (PDOException $ex) {
            throw $ex;
        } finally {
            $con = null;
            $snt = null;
        }
    }
 */
/*
 * function registrarse($EMAIL, $NOMBRE, $APELLIDO1, $APELLIDO2, $CONTRASENIA, $ROL, $FECHA_NACIMIENTO) {
        $sql = "INSERT INTO USUARIO (EMAIL, NOMBRE, APELLIDO1, APELLIDO2, CONTRASENIA, ROL, FECHA_NACIMIENTO)
                        VALUES (:EMAIL, :NOMBRE, :APELLIDO1, :APELLIDO2, :CONTRASENIA, :ROL, :FECHA_NACIMIENTO)";
        include_once __DIR__. "/../../core/conexionBd.inc";
        try {
            $con = (new ConexionBd)->getConexion();

            $con->begin_transaction();

            $snt = $con->prepare($sql);
            $snt->bind_param(':EMAIL', $EMAIL);
            $snt->bind_param(':NOMBRE', $NOMBRE);
            $snt->bind_param(':APELLIDO1', $APELLIDO1);
            $snt->bind_param(':APELLIDO2', $APELLIDO2);
            $snt->bind_param(':CONTRASENIA', $CONTRASENIA);
            $snt->bind_param(':ROL', $ROL);
            $snt->bind_param(':FECHA_NACIMIENTO', $FECHA_NACIMIENTO);

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
 */
?>