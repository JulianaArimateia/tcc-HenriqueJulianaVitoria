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
        $this->render("lista", "templateAdmin");
    }

    public function adicionar()
    {
        AuthController::validaAutenticacao();
        $this->render("adicionar", "templateAdmin");
    }


    public function salvarProduto()
    {
        AuthController::validaAutenticacao();
        //receber dados do formulario via post 
        //faz a instancia de produto com a conexão com banco de dados
        $produto = Container::getModel('Produtos');

        //upload($_FILES['file_imagem'], "categoria");

        //seta os dados do form nos atributos da classe Usuário
        $produto->__set('nome_produto', isset($_POST['nome_produto']) ? $_POST['nome_produto'] : "");
        $produto->__set('id_categoria', isset($_POST['id']) ? $_POST['id'] : "");
        $produto->__set('quantidade_produto', isset($_POST['quantidade_produto']) ? $_POST['quantidade_produto'] : "");
        $produto->__set('custo', isset($_POST['custo']) ? $_POST['custo'] : "");
        $produto->__set('valor', isset($_POST['valor']) ? $_POST['valor'] : "");
        $produto->__set('descricao', isset($_POST['descricao']) ? $_POST['descricao'] : "");
        $produto->__set('imagem', isset($_POST['imagem']) ? $_POST['imagem'] : "");
        $produto->__set('nivel', 0);
        


        if ($produto->validarCadastro()) {
            //SUCCESS ao validar cadastro

            if (count($produto->getProdutosPorNome()) == 0) {
                // $imagem = formataArrayFile($_FILES['imagem']);
                $produto->salvar();
                $this->render("adicionar", "templateAdmin");
            } else {
                dd($produto);
            }
            // echo "Cadastro realizado com sucesso";
            // $this->view->status = array(
            //     "status" => "SUCCESS",
            //     "msg"    => "Cadastro realizado com sucesso"
            // );

            $categoria = Container::getModel("categoria");

            $categorias = $categoria->getCategorias();

            $this->view->dados = $categorias;

            $this->render("adicionar", "templateAdmin");
        }
        $this->render("adicionar", "templateAdmin");
    }
}
