<?php

namespace App\controllers;

//Recursos de nosso MVC
use Core\controller\Action;
use App\controllers\AuthController;

//Models utilizados
use Core\model\Container;

class AdminController extends Action
{
    public function lista()
    {
        AuthController::validaAutenticacao();        

        // $usuario = Container::getModel('Usuario');
        
        // $this->view->qtdeUsuarios = $usuario->getTotalUsuarios();
        

        $this->render("lista", "templateAdmin");
    }

    public function adicionar()
    {
        AuthController::validaAutenticacao();

       

        $this->render("adicionar", "templateAdmin");
    }

    

    
}