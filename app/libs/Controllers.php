<?php
  class Controllers{
    public $navbar = 'navbar';
    public $layout = 'default';

    private $render = false;
    public  function  __construct($request)
    {
        $this->request = $request;
    }
    public function modelo($modelo){
      $file = '..'.DS.'app'.DS.'modelos'.DS.$modelo.'.php';
      require_once($file);
      $return = (!isset($this->modelo))?  $this->modelo = new $modelo :  false;
      return $return;
    }

    public function render($view, $data=[]){
      if($this->render) return false;
        require'..'.DS.'app'.DS.'views'.DS.'layouts'.DS.$this->navbar.'.php';
        $navbar = ob_get_clean();
        $view = '..'.DS.'app'.DS.'views'.DS.''.$view.'.php';
        ob_start();
        require($view);
        $content = ob_get_clean();
        require'..'.DS.'app'.DS.'views'.DS.'layouts'.DS.$this->layout.'.php';
        $this->render = true;

    }

  }
