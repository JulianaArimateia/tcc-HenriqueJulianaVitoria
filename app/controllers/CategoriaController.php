<?php

namespace App\controllers;

use Core\model\Container;
use Core\controller\Action;
use App\controllers\AuthController;

class CategoriaController extends Action
{
    public function index()
    {
        AuthController::validaAutenticacao();

        $categoria = Container::getModel("Categoria");
        $categorias = $categoria->getCategorias();
        $this->view->dados = $categorias;
        $this->view->title = "Admin - Categorias";

        $this->render("index", "template_admin");
    }

    public function cadastrar()
    {
        AuthController::validaAutenticacao();

        $this->view->title = "Admin - Categorias";

        $this->render("cadastrar", "template_admin");
    }

    public function salvar_categoria()
    {
        AuthController::validaAutenticacao();
        //receber dados do formulario via post 
        //faz a instancia de produto com a conexão com banco de dados
        $categoria = Container::getModel('Categoria');

        // upload($_FILES['file_imagem'], "categoria");

        //seta os dados do form nos atributos da classe Usuário
        $categoria->__set('nome', isset($_POST['nome']) ? $_POST['nome'] : "");
        $categoria->__set('id_usuario', isset($_SESSION['id']) ? $_SESSION['id'] : "");

        if ($categoria->validarCadastro()) {
            //SUCCESS ao validar cadastro
            if (count($categoria->getCategoriaPorNome()) == 0) {

                $categoria->salvar();

                //podemos criar um atributo generico no objeto pois estamos herdando de action o view
                $this->view->status = array(
                    "status" => "SUCCESS",
                    "msg"    => "Cadastro realizado com sucesso"
                );

                $this->render("cadastrar", "template_admin");
            } else {
                //caso retornar 1 linha na query - indica que ja esta cadastrado no banco de dados
                $this->view->status = array(
                    "status" => "ERROR",
                    "msg"    => "Erro ao cadastrar categoria, o nome já existe no banco de dados"
                );

                $this->view->tempUsuario = array(
                    "nome"      => isset($_POST['nome']) ? $_POST['nome'] : "",
                );

                $this->view->title = "Admin - Categorias";

                $this->render("cadastrar", "template_admin");
            }
        } else {
            //erro na digitação < que 3 caracteres
            //armazena os dados para recarregar o form

            $this->view->tempUsuario = array(
                "nome" => isset($_POST['nome']) ? $_POST['nome'] : "",
            );

            // dd($this->view->tempUsuario);

            $this->view->status = array(
                "status" => "ERROR",
                "msg"    => "Erro ao cadastrar categoria, verifique os campos digitados e tente novamente"
            );
            $this->render("cadastrar", "template_admin");
        }
    }

    public function atualizar()
    {
        AuthController::validaAutenticacao();


        //faz a instancia de produto com a conexão com banco de dados
        $categoria = Container::getModel('Categoria');

        //seta os dados do form nos atributos da classe Usuário
        $categoria->__set('id', isset($_POST['id']) ? $_POST['id'] : "");
        $categoria->__set('nome', isset($_POST['nome']) ? $_POST['nome'] : "");

        
        

        if ($categoria->validarCadastro()) {
            //SUCCESS ao validar cadastro

            if (count($categoria->getCategoriaPorNome()) == 0 || $_POST['nome'] === $_POST['nome_atual']) {
                
                $categoria->atualizar();

                //podemos criar um atributo generico no objeto pois estamos herdando de action o view
                $this->view->status = array(
                    "status" => "SUCCESS",
                    "msg"    => "Categoria atulizada com sucesso"
                );

                $categorias = $categoria->getCategoriaPorId();
                $this->view->dados = $categorias;

                $this->render("editar", "template_admin");
            } else {
                //caso retornar 1 linha na query - indica que ja esta cadastrado no banco de dados
                $this->view->status = array(
                    "status" => "ERROR",
                    "msg"    => "Erro ao editar categoria, nome já existe no banco de dados"
                );

                $this->view->tempUsuario = array(
                    "nome"      => isset($_POST['nome']) ? $_POST['nome'] : "",
                );

                $this->view->title = "Admin - Categorias";

                $this->render("editar", "template_admin");
            }
        } else {
            //erro na digitação < que 3 caracteres
            //armazena os dados para recarregar o form

            $this->view->tempUsuario = array(
                "nome" => isset($_POST['nome']) ? $_POST['nome'] : "",
            );

            // dd($this->view->tempUsuario);

            $this->view->status = array(
                "status" => "ERROR",
                "msg"    => "Erro ao editar categoria, verifique os campos digitados e tente novamente"
            );

            $this->view->title = "Admin - Categorias";
            $this->render("editar", "template_admin");
        }
    }

    public function editar()
    {
        AuthController::validaAutenticacao();

        $categoria = Container::getModel('Categoria');

        //seta o id no atributos id da classe Usuário
        $categoria->__set('id', isset($_GET['id']) ? $_GET['id'] : "");

        $categorias = $categoria->getCategoriaPorId();
        $this->view->dados = $categorias;

        $this->view->title = "Admin - Categorias";

        $this->render("editar", "template_admin");
    }

    public function excluir()
    {
        AuthController::validaAutenticacao();

        $id_categoria = isset($_GET['id']) ? $_GET['id'] : '';

        $categoria = Container::getModel('Categoria');
        $categoria->deletarCategoria($id_categoria);

        // $this->index();
        header("Location: /categoria");
    }
}



// IndexController
