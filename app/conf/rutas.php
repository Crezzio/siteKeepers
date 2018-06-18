<?php

// Vector multidimensional con rutas a controlador y método que debe
// atender cada enlace
/* formato:
    Primera dimensaión: nombre del enlace pasado mediante variable GET 'ctl'
     'nombreEnlace' => array() segunda dimesion con información del controlador
                       que atiende esa petición, clave 'controller', y del
                       método concreto que está especializado en su tratamiento,
                       clave 'action'
  Se debe agregar una ruta por cada valor diferente que tome la variable 'ctl'.
  La clave 'inicio' referencia la página home de la aplicación y especifica
    el controlador que debe decidir cuál es la vista que se debe mostrar
*/
$mapeoRutas =
  array('inicio' =>
              array('controller' =>'UsuarioController', 'action' =>'inicio'),
      'front' =>
          array('controller' =>'DefaultController', 'action' =>'front'),
      'principal' =>
          array('controller' =>'UsuarioController', 'action' =>'principal'),
      'login' =>
          array('controller' =>'UsuarioController', 'action' =>'login'),
      'logout' =>
          array('controller' =>'UsuarioController', 'action' =>'logout'),
      'registro' =>
          array('controller' =>'UsuarioController', 'action' =>'registro'),
      'perfil' =>
          array('controller' =>'UsuarioController', 'action' =>'perfil'),
      'ficha' =>
          array('controller' =>'UsuarioController', 'action' =>'ficha'),
      /* IBA A SER UTILIZADO, PERO AL FINAL SE MUESTRAN TODAS ESTAS SECCIONES EN LA PAGINA DE INICIO
       * 'info' =>
          array('controller' =>'DefaultController', 'action' =>'info'),
      'blog' =>
          array('controller' =>'DefaultController', 'action' =>'blog'),
      'opiniones' =>
          array('controller' =>'DefaultController', 'action' =>'opiniones'),
      'contacto' =>
          array('controller' =>'DefaultController', 'action' =>'contacto'),*/
       );
