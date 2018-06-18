<?php
// Ejemplo de controlador para página home de la aplicación
class DefaultController {
  public function front() {
    require __DIR__ . '/../../app/plantillas/front.php';
  }
  public function info() {
    require __DIR__ . '/../../app/plantillas/info.php';
  }
  public function blog() {
    require __DIR__ . '/../../app/plantillas/blog.php';
  }
  public function opiniones() {
    require __DIR__ . '/../../app/plantillas/opiniones.php';
  }
  public function contacto() {
    require __DIR__ . '/../../app/plantillas/contacto.php';
  }

}

?>