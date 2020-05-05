<?php

	/*
		Traer url ingresada en el navegador y reacomodarla a MVC

		1-Controlador
		2-metodo
		3-Parametro

		Example: /articulos/actulizar/4

	*/
	class Core{
		protected $controladorActual = 'inicio';
		protected $metodoActual = 'index';
		protected $parametros = [];

		//constructor
		public function __construct(){
			//print_r($this->getUrl());//Ejemlo de Resultado: Array ( [0] => paginas [1] => actualizar )
			$url = $this->getUrl();

//Buscando los Controladores si existe cada controlador
// $url[0] es el Controlador
			if(file_exists('../app/controladores/'.ucwords($url[0]).'.php')){
				$this->controladorActual = ucwords($url[0]);
				//unset Indice
				unset($url[0]);
			}
			//require controlador
			require_once '../app/controladores/'.$this->controladorActual.'.php';
			$this->controladorActual = new $this->controladorActual;

// segunda parte de url para el metodo
// $url[1] es el Metodo
			if(isset($url[1])){
				if(method_exists($this->controladorActual, $url[1])){
					//revisamos el metodo
					$this->metodoActual = $url[1];
						//unset Indice
					unset($url[1]);
				}
			}
			// echo $this->metodoActual;
//obtner los parametros
			$this->parametros = $url ? array_values($url) : [];
			// llamar calback con parametros array
			call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);

		}

		public function getUrl(){
   //    echo $_GET['url'];

			if(isset($_GET['url'])){
        $url= rtrim($_GET['url'], '/');
				$url= filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

				return $url;

			}

		}
	}

