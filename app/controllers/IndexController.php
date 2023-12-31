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

        if (AuthController::esta_logado()) {
            $carrinho = $carrinho->getCarrinhoPorID();
        } else {
            $carrinho = $carrinho->getCarrinho();
        }

        $favoritos = Container::getModel('Favoritos');

        if (AuthController::esta_logado()) {
            $favoritos = $favoritos->getFavoritosPorID();
        } else {
            $favoritos = $favoritos->getFavoritos();
        }

        $this->view->carrinho = $carrinho;
        $this->view->favoritos = $favoritos;



        $this->render("index", "templateUsuario");
    }

    public function login()
    {
        if (AuthController::esta_logado()) {
            header('Location: /adminLista');
        } else {
            $this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
            $this->render("login");
        }
    }
    public function sobre()
    {
        $carrinho = Container::getModel('carrinho');

        if (AuthController::esta_logado()) {
            $carrinho = $carrinho->getCarrinhoPorID();
        } else {
            $carrinho = $carrinho->getCarrinho();
        }

        $favoritos = Container::getModel('Favoritos');

        if (AuthController::esta_logado()) {
            $favoritos = $favoritos->getFavoritosPorID();
        } else {
            $favoritos = $favoritos->getFavoritos();
        }

        $this->view->carrinho = $carrinho;
        $this->view->favoritos = $favoritos;

        $this->render("sobre", "templateUsuario");
    }
}
