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
        $produto->__set('id_categoria', isset($_SESSION['id']) ? $_SESSION['id'] : "");
        $produto->__set('quantidade_produto', isset($_SESSION['quantidade_produto']) ? $_SESSION['quantidade_produto'] : "");
        $produto->__set('custo', isset($_SESSION['custo']) ? $_SESSION['custo'] : "");
        $produto->__set('valor', isset($_SESSION['valor']) ? $_SESSION['valor'] : "");
        $produto->__set('descricao', isset($_SESSION['descricao']) ? $_SESSION['descricao'] : "");
        $produto->__set('imagem', isset($_SESSION['imagem']) ? $_SESSION['imagem'] : "");
       
if (count($produto->getProdutosPorNome()) == 0) {

                $produto->salvar();

                //podemos criar um atributo generico no objeto pois estamos herdando de action o view
                $this->view->status = array(
                    "status" => "SUCCESS",
                    "msg"    => "Cadastro realizado com sucesso"
                );

                $this->render("adicionar", "templateAdmin");
            } else {
                //caso retornar 1 linha na query - indica que ja esta cadastrado no banco de dados
                $this->view->status = array(
                    "status" => "ERROR",
                    "msg"    => "Erro ao cadastrar produto, o nome já existe no banco de dados"
                );
            }
        // if ($produto->validarCadastro()) {
        //     //SUCCESS ao validar cadastro
        //     if (count($produto->getProdutoPorNome()) == 0) {

        //         $produto->salvar();

        //         //podemos criar um atributo generico no objeto pois estamos herdando de action o view
        //         $this->view->status = array(
        //             "status" => "SUCCESS",
        //             "msg"    => "Cadastro realizado com sucesso"
        //         );

        //         $this->render("adicionar", "templateAdmin");
        //     } else {
        //         //caso retornar 1 linha na query - indica que ja esta cadastrado no banco de dados
        //         $this->view->status = array(
        //             "status" => "ERROR",
        //             "msg"    => "Erro ao cadastrar produto, o nome já existe no banco de dados"
        //         );

        //         $this->view->tempUsuario = array(
        //             "nome"      => isset($_POST['nome']) ? $_POST['nome'] : "",
        //         );


        //           $this->render("adicionar", "templateAdmin");
        //     }
        // } else {
        //     //erro na digitação < que 3 caracteres
        //     //armazena os dados para recarregar o form

        //     $this->view->tempUsuario = array(
        //         "nome" => isset($_POST['nome']) ? $_POST['nome'] : "",
        //     );

        //     // dd($this->view->tempUsuario);

        //     $this->view->status = array(
        //         "status" => "ERROR",
        //         "msg"    => "Erro ao cadastrar o produto, verifique os campos digitados e tente novamente"
        //     );
        //     $this->render("adicionar", "templateAdmin");
        // }
    }
}