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

        $produtos = Container::getModel('Produtos');
        $produtos = $produtos->getProdutos();
        $this->view->produtos = $produtos;

        $this->render("lista", "templateAdmin");
    }

    public function adicionar()
    {
        AuthController::validaAutenticacao();
        $this->render("adicionar", "templateAdmin");
    }

    public function reservas()
    {
        AuthController::validaAutenticacao();

        $reservas = Container::getModel('Reservas');
        $reservas = $reservas->getReservas();
        $this->view->reservas = $reservas;

        $this->render("reservas", "templateAdmin");
    }

    public function salvarProduto()
    {
        AuthController::validaAutenticacao();
        //receber dados do formulario via post 
        //faz a instancia de produto com a conexão com banco de dados
        $produto = Container::getModel('Produtos');

        //seta os dados do form nos atributos da classe Usuário
        $produto->__set('nome_produto', isset($_POST['nome_produto']) ? $_POST['nome_produto'] : "");
        $produto->__set('id_categoria', isset($_POST['categoria']) ? $_POST['categoria'] : "");
        $produto->__set('quantidade_produto', isset($_POST['quantidade_produto']) ? $_POST['quantidade_produto'] : "");
        $produto->__set('custo', isset($_POST['custo']) ? $_POST['custo'] : "");
        $produto->__set('valor', isset($_POST['valor']) ? $_POST['valor'] : "");
        $produto->__set('descricao', isset($_POST['descricao']) ? $_POST['descricao'] : "");
        $produto->__set('imagem', isset($_POST['imagem']) ? $_POST['imagem'] : "");
        $produto->__set('nivel', 0);

        if ($produto->validarCadastro()) {
            //SUCCESS ao validar cadastro
            $produto->salvar();
        }

        $this->render("adicionar", "templateAdmin");
    }

    public function atualizar()
    {
        AuthController::validaAutenticacao();


        //faz a instancia de produto com a conexão com banco de dados
        $produto = Container::getModel('Produto');

        //seta os dados do form nos atributos da classe Usuário
        $produto->__set('id', isset($_POST['id']) ? $_POST['id'] : "");
        $produto->__set('nome', isset($_POST['nome']) ? $_POST['nome'] : "");



        if ($produto->validarCadastro()) {
            //SUCCESS ao validar cadastro
            $produto->atualizar();

            $this->render("editar", "templateAdmin");
        }
    }

    public function editarProduto()
    {
        AuthController::validaAutenticacao();

        $produto = Container::getModel('Produtos');

        //seta o id no atributos id da classe Usuário
        $produto->__set('id', isset($_GET['id']) ? $_GET['id'] : "");


        $this->render("editar", "templateAdmin");
    }


    public function excluirProduto()
    {
        AuthController::validaAutenticacao();

        $id_produtos = isset($_GET['id']) ? $_GET['id'] : '';

        $produto = Container::getModel('Produtos');
        $produto->deletarPro($id_produtos);

        header("Location: /adminAdicionar");
    }
}
