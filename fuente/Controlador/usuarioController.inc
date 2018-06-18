<?php
class UsuarioController {
    public function inicio() {
        include_once __DIR__ . '/../Repositorio/usuarioRepositorio.inc';
        $params = array('mensaje' => 'Bienvenido a SiteKeepers',
            'fecha' => date('d-m-Y'),);
        require __DIR__ . '/../../app/plantillas/inicio.php';
    }

    public function login() {
        include_once __DIR__ . '/../Repositorio/usuarioRepositorio.inc';
        //$usuarios = (new usuarioRepositorio())->cargaUsuarios();
        //$resultado = (new usuarioRepositorio())->cargaUsuariosSinClases();
        include __DIR__ . '/../../app/plantillas/login.php';
    }

    public function logout() {
        $_SESSION = array();
        session_destroy();
        session_start();
        $_SESSION['sesionCerrada'] = 1;
        header('Location: http://sitekeepers.crezzio.tk/index.php?ctl=login');
    }

    public function registro() {
        include_once __DIR__ . '/../Repositorio/usuarioRepositorio.inc';
        include __DIR__ . '/../../app/plantillas/registro.php';
    }

    public function perfil() {
        include_once __DIR__ . '/../Repositorio/usuarioRepositorio.inc';
        include __DIR__ . '/../../app/plantillas/perfil.php';
    }

    public function ficha() {
        include_once __DIR__ . '/../Repositorio/usuarioRepositorio.inc';
        include __DIR__ . '/../../app/plantillas/ficha.php';
    }

    public function principal() {
        include_once __DIR__ . '/../Repositorio/usuarioRepositorio.inc';
        $usuarios = (new usuarioRepositorio())->cargaUsuarios();
        include __DIR__ . '/../../app/plantillas/principal.php';
    }
}

?>