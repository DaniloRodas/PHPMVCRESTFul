<?php

/*
		Traer url ingresada en el navegador y reacomodarla a MVC
		1-Controlador
		2-metodo
		3-Parametro
		Example: /articulos/actulizar/4
	*/
class Core
{
	protected $controladorActual = 'Views';
	protected $metodoActual = 'index';
	protected $parametros = [];

	//constructor
	public function __construct()
	{
		//print_r($this->getUrl());//Ejemlo de Resultado: Array ( [0] => paginas [1] => actualizar )
		$url = $this->getUrl();
		// print_r ($url[3]);

		$dirController = '../app/Controllers/';

		if (is_dir($dirController)) {
			if (is_readable($dirController)) {
				$objects = scandir($dirController);
				foreach ($objects as $object) {
					if ($object != "." && $object != "..") {
						//   if (!is_readable_r($dir."/".$object)) return false;
						//    else continue;
						//	echo $object. ' dirigir a -- '.ucwords($url[0]) .'.php <br />' ;
						if (ucwords($url[0]) . '.php' == $object) {
							$this->controladorActual = ucwords($url[0]);
						}
					}
				}
				//exit();
				//return true;
			} else {
				return false;
			}
		} else if (file_exists($dirController)) {
			return (is_readable($dirController));
		}

		require_once '../app/Controllers/' . $this->controladorActual . '.php';
		$this->controladorActual = new $this->controladorActual;

		//Step 1
		//Obtener el controlador



		//Step 2
		//Obtener el metodo

		if (isset($url[1])) {

			if (method_exists($this->controladorActual, $url[1])) {
				//checar el metodo
				$this->metodoActual = $url[1];
				// unset indice
				unset($url[1]);
			}
		}
		// imprime el metodo si existe
		// echo $this->metodoActual;


		//Step 3
		// Obtener el parametros
		$this->parametros = $url ? array_values($url) : [];
		// var_dump( $this->parametros = $url ? array_values($url) : [] );
		//llamar callback con parametros
		// var_dump([$this->controladorActual, $this->metodoActual], $this->parametros);
		call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
	}

	public function getUrl(){
		//    echo $_GET['url'];

		if (isset($_GET['url'])) {
			$url = rtrim($_GET['url'], '/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode('/', $url);

			return $url;
		}
	}
}
