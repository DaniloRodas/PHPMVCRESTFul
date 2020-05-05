<?php
  //Cargar lib
	require_once 'config/configurar.php';
  require_once 'helpers/url_helper.php';

	//Librerias
	// require_once 'lib/Base.php';
	// require_once 'lib/Controlador.php';
	// require_once 'lib/Core.php';

//Autoload php
spl_autoLoad_register(function($nombreClase){
	require_once 'lib/'.$nombreClase.'.php';
});

?>
