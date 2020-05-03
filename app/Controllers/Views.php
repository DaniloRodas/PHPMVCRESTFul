<?php
  class Views extends Controllers{
    public function __construct(){
      $this->resultado = $this->modelo('View'); /// result database
    }
    public function index(){
      $rows = $this->resultado->usuarios();
      $data = [
        'title' => 'Inicio',
        'css' => '<link rel="stylesheet" href="assets/css/style.css">',
        'js' => ' <script src="assets/js/main.js"></script>',
        'data' => $rows
      ];
      $this->render('partials/index', $data);
    }
  }
?>