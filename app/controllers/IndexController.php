<?php

namespace App\controllers;

//Recursos de nosso MVC
use Core\controller\Action;
use App\controllers\AuthController;

//Models utilizados
use App\models\ProdutoModel;
use App\models\InfoModel;
use Core\model\Container;

class IndexController extends Action
{

    public function index()
    {
        $produto = Container::getModel('Produtos');
        $produtos = $produto->getProdutos();
        $this->view->produtos = $produtos;

        $carrinho = Container::getModel('carrinho');
        $carrinho = $carrinho->getCarrinho();
        $this->view->carrinho = $carrinho;

        $this->render("index", "templateUsuario");
    }

    public function login()
    {
        if (AuthController::esta_logado()) {
            header('Location: /admin');
        } else {
            $this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
            $this->render("login");
        }
    }
}
