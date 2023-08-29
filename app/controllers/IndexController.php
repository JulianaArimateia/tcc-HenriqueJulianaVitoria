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
        // AuthController::validaAutenticacao();

        //faz a instancia de produto com a conexão com banco de dados
        // $emprego = Container::getModel('Emprego');

        // $empregos = $emprego->getAllEmpregos();
        // $this->view->dados = [];
        // $this->view->title = "Home";


        $this->render("index", "templateUsuario");
    }

    public function login()
    {
        if (AuthController::esta_logado()) {
            header('Location: /');
        } else {
            $this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
            $this->render("login");
        }
    
    }

 public function carrinho()
    {

 $this->render("carrinho", "templateUsuario");

 }

 public function favoritos()
    {

 $this->render("favoritos","templateUsuario");

 }
}
