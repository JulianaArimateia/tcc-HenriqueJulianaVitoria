<?php

namespace App\controllers;

//Recursos de nosso MVC
use Core\controller\Action;
use App\controllers\AuthController;

//Models utilizados
use Core\model\Container;

class PagamentoController extends Action
{
    public function estrutura()
    {
        AuthController::validaAutenticacao();
  
        $this->render("estrutura", "templateAdmin");
    }

    public function pagamento()
    {
        AuthController::validaAutenticacao();

        $this->render("pagamento", "templateAdmin");
    }
}