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

<<<<<<< HEAD
        dd($_POST);

        $this->render("pagamento", "templateAdmin");
=======
        $this->view->dados = $_POST;

        $this->render("pagamento");
>>>>>>> c7b6f6cb791b70ab98a0f8875e683c774dbec7a8
    }
}
