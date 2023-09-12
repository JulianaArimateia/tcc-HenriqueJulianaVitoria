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
        $produto->__set('imagem', isset($_FILES['imagem']["name"]) ? $_FILES['imagem']["name"] : "");
        $produto->__set('nivel', 0);
    
        if ($produto->validarCadastro()) {
            //SUCCESS ao validar cadastro
            $produto->salvar();
            $name = $_FILES["imagem"]["name"];
            $arquivo = ($_FILES["imagem"]["tmp_name"]);
            move_uploaded_file($arquivo, "assets/img/produto/$name");

            header('Location: /adminLista');
        }
        $this->render("adicionar", "templateAdmin");
    }


    public function atualizarProduto()
    {
        AuthController::validaAutenticacao();

        $produto = Container::getModel('Produtos');

        // Setar os dados do formulário nos atributos do objeto Produto
        $produto->__set('id', isset($_GET['id']) ? $_GET['id'] : "");
        $produto->__set('nome_produto', isset($_POST['nome_produto']) ? $_POST['nome_produto'] : "");
        $produto->__set('id_categoria', isset($_POST['categoria']) ? $_POST['categoria'] : "");
        $produto->__set('quantidade_produto', isset($_POST['quantidade_produto']) ? $_POST['quantidade_produto'] : "");
        $produto->__set('custo', isset($_POST['custo']) ? $_POST['custo'] : "");
        $produto->__set('valor', isset($_POST['valor']) ? $_POST['valor'] : "");
        $produto->__set('descricao', isset($_POST['descricao']) ? $_POST['descricao'] : "");
        $produto->__set('imagem', isset($_POST['imagem']) ? $_POST['imagem'] : "");
        $produto->__set('nivel', 0);

        if ($produto->validarCadastro()) {
            // Atualizar os dados do produto no banco de dados
            $produto->atualizar();
            // Redirecionar para a página de lista de produtos ou fazer qualquer outra ação necessária após a atualização
            header('Location: /adminLista');
        }

        $this->render("editar", "templateAdmin");
    }


    public function editarProduto()
    {
        AuthController::validaAutenticacao();

        $produto = Container::getModel('Produtos');

        // Setar o ID do produto a ser editado
        $produto->__set('id', isset($_GET['id']) ? $_GET['id'] : "");
        // Buscar os dados do produto no banco de dados

        $this->render("editar", "templateAdmin");
    }



    public function excluirProduto()
    {
        AuthController::validaAutenticacao();

        $id_produtos = isset($_GET['id']) ? $_GET['id'] : '';
        $produto = Container::getModel('Produtos');
        $produto->deletarProdutos($id_produtos);

        header("Location: /adminLista");
    }
}
