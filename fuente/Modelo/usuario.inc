<?php
class Usuario {
    private $id;
    private $email;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $contrasenia;
    private $rol;
    private $fechaNacimiento;
    private $descripcion;
    private $imagen;

    public function __construct($usuario) {
    $this->id = $usuario['ID_USUARIO'];
    $this->email = $usuario['EMAIL'];
    $this->nombre = $usuario['NOMBRE'];
    $this->apellido1 = $usuario['APELLIDO1'];
    $this->apellido2 = $usuario['APELLIDO2'];
    $this->contrasenia = $usuario['CONTRASENIA'];
    $this->rol = $usuario['ROL'];
    $this->fechaNacimiento = $usuario['FECHA_NACIMIENTO'];
    $this->descripcion = $usuario['DESCRIPCION'];
    $this->imagen = $usuario['IMAGEN'];
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido1() {
        return $this->apellido1;
    }

    public function getApellido2() {
        return $this->apellido2;
    }

    public function getConstrasenia() {
        return $this->contrasenia;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getImagen() {
        return $this->imagen;
    }

    /* YA QUE NO FUNCIONA CORRECTAMENTE LA FUNCIÓN ISSET CON LOS GETTERS, HAGO ESTE MÉTODO. EN EL CASO isset($usuario->getImagen()), SIEMPRE DEVUELVE FALSE */
    public function propiedadSeteada($nombrePropiedad) {
        return isset($this->$nombrePropiedad);
    }
}
?>