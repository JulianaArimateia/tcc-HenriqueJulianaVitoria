<?php

namespace Core\controller;
use stdClass;
abstract class Action {
    
    protected $view;

    public function __construct()
    {   
        $this->view = new stdClass;        
    }

    protected function render($view, $layout = null) 
    {
        // $this->content(); se chamarmos assim o layout nao entra em ação
        $this->view->page = $view;
    
        if(file_exists("../app/views/layout/" . $layout . ".phtml")) {
            require_once("../app/views/layout/" . $layout . ".phtml");
        } else {
            $this->content();
        }        
    }

    public function content() 
    {
        $classeAtual = get_class($this);
        $classeAtual = str_replace('App\\controllers\\', '', $classeAtual);

        $classeAtual = strtolower(str_replace('Controller', '', $classeAtual));

        require_once('../app/views/' . $classeAtual . '/' . $this->view->page . '.phtml');
    }

}
