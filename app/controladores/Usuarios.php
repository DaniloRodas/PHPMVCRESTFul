<?php

	class Usuarios extends Controlador{
		public function __construct(){
		//	$this->employeModelo = $this->modelo('Employe'); // Cargamos al Modelo
		}

		public function index(){

			$data = [
				'title' =>'Usuarios',
				'css' => '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/flatly/bootstrap.min.css">',
        'js' => ''
      ];


        $this->render('paginas/usuario',$data); // se coloca el nombre del archivo sin extension para mostrar


    }
  }