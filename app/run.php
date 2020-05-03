<?php
	// require_once './../config.php';
spl_autoLoad_register(function($nombreClase){
	require_once 'libs/'.$nombreClase.'.php';
});

?>