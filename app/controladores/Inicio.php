<?php

	class Inicio extends Controlador{
		public function __construct(){
	//		$this->employeModelo = $this->modelo('Employe'); // Cargamos al Modelo
		}

		public function index(){
      //$employe = $this->employeModelo->obtenerEmpleados();
			$data = [
				'title' =>'Dashboard',
        'css' => '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/flatly/bootstrap.min.css">',
        'js' => ''
			//	'empleados' =>$employe //Pagina PDOConexion.php
      ];
// echo 'INDEX - DASHBOARD';
       $this->render('paginas/dashboard',$data); // se coloca el nombre del archivo sin extension para mostrar
    }

		public function agregar(){
			$data = [
				'title' =>'Dashboard',
        'css' => '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/flatly/bootstrap.min.css">',
				'js' => ''
			];
			$this->render('paginas/form',$data); // se coloca el nombre del archivo sin extension para mostrar

		}
		public function actualizar(){
			echo 'actualizar';
		}


	}

