<?php
  date_default_timezone_set('America/Los_Angeles');
  // Configuracion de acceso a la base de datos
  define('DB_HOST', 'localhost');
  define('DB_USUARIO', 'root'); //Nombre de Usuario de la Base de Datos
  define('DB_PASSWORD', 'root'); //Contrasenia del usuario de la Base de Datos
  define('DB_NBD', 'sistema_inventario'); //Nombre de las Base de Datos

  // Ruta de la aplicacion
   define('RUTA_APP', dirname(dirname(__FILE__)));

 // echo dirname(dirname(__FILE__));
   //Ruta url Ejemplo: C:\xampp\htdocs\MVCPHP\app
   define('RUTA_URL', '192.168.0.8'); // Ruta de la pagina a configurar
   define('RUTA_HOST', "http://".$_SERVER['HTTP_HOST'].""); // Ruta de la pagina a configurar

  define('NOMBRESITIO', 'Inventario');



 ?>
