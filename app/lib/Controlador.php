<?php
	//Clase controlador pricipal
	//Se carga de poner cargar los modelos y las vistas
	class Controlador{
		//cargar modelos
  	public $navbar = 'navbar';
    public $layout = 'default';
    private $render = false;
		public function modelo($modelo){
			//carga
			require_once '../app/modelos/'.$modelo.'.php';
			//Instanciar Modelo
			return new $modelo();
		}

		//cargar vista
		public function render($view, $data=[]){
			if($this->render) return false;
			require '../app/views/layouts/'.$this->navbar.'.php';

			$navbar = ob_get_clean();
			$views = '../app/views/'.$view.'.php';
			ob_start();
			require_once ($views);

			$content = ob_get_clean();
			require'../app/views/layouts/'.$this->layout.'.php';
			$this->render = true;


			// if(file_exists('../app/views/'.$vista.'.php')){
			// 	require_once '../app/views/'.$vista.'.php';
			// }else{
			// 	//si el archivo de la vista no existe
      //   die('La vista no existe '.$vista);
			// }




		}


	}
