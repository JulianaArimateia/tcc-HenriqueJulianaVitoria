<?php

namespace App\controllers;

use Core\model\Container;
use Core\controller\Action;
use App\controllers\AuthController;

class UsuarioController extends Action
{
    // Página do carrinho
    public function carrinho()
    {
        AuthController::validaAutenticacao();

        $produto = Container::getModel('Produtos');
        $produtos = $produto->getProdutos();
        $this->view->produtos = $produtos;

        $carrinho = Container::getModel('carrinho');
        $carrinho = $carrinho->getCarrinhoPorID();
        $this->view->carrinho = $carrinho;

        $this->render("carrinho", "templateUsuario");
    }

    // Página de favoritos
    public function favoritos()
    {
        AuthController::validaAutenticacao();

        $produto = Container::getModel('Produtos');
        $produtos = $produto->getProdutos();
        $this->view->produtos = $produtos;

        $carrinho = Container::getModel('carrinho');
        $carrinho = $carrinho->getCarrinhoPorID();
        $this->view->carrinho = $carrinho;

        $favoritos = Container::getModel('favoritos');
        $favoritos = $favoritos->getFavoritos();
        $this->view->favoritos = $favoritos;

        $this->render("favoritos", "templateUsuario");
    }

    // Adicionar produto ao carrinho
    public function adicionarCarrinho()
    {
        AuthController::validaAutenticacao();
        $carrinho = Container::getModel('carrinho');
        $carrinho->addCarrinho($_GET['id'], $_SESSION['id']);
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
    }

    // Adicionar aos favoritos
    public function addFavoritos()
    {
        AuthController::validaAutenticacao();
        $favoritos = Container::getModel('favoritos');
        $favoritos->addFavoritos($_GET['id'], $_SESSION['id']);
        header('Location: /');
    }

    // Remover produto do carrinho
    public function removerCarrinho()
    {
        AuthController::validaAutenticacao();
        $carrinho = Container::getModel('carrinho');
        $carrinho->removeCarrinho($_GET['id'], $_SESSION['id']);
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
    }

    // Remover dos favoritos
    public function removeFavoritos()
    {
        AuthController::validaAutenticacao();
        $favoritos = Container::getModel('favoritos');
        $favoritos->removeFavoritos($_GET['id'], $_SESSION['id']);
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
    }

    // Aumentar quantidade no carrinho
    public function maisQtdCarrinho()
    {
        $carrinho = Container::getModel('carrinho');
        $carrinho->maisQtd($_GET['id']);
        header('Location: /carrinho');
    }

    // Diminuir quantidade no carrinho
    public function menosQtdCarrinho()
    {
        $carrinho = Container::getModel('carrinho');
        $carrinho->menosQtd($_GET['id']);
        header('Location: /carrinho');
    }

    // Página de pagamento
    public function pagamento()
    {
        AuthController::validaAutenticacao();
        $this->render("pagamento", "templateUsuario");
    }

    // Salvar um novo usuário
    public function salvar_usuario()
    {
        // AuthController::validaAutenticacao();
        //receber dados do formulario via post 
        //faz a instancia de produto com a conexão com banco de dados
        $usuario = Container::getModel('Usuario');

        //seta os dados do form nos atributos da classe Usuário
        $usuario->__set('nome', isset($_POST['nome']) ? $_POST['nome'] : "");
        $usuario->__set('email', isset($_POST['email']) ? $_POST['email'] : "");
        $usuario->__set('senha', isset($_POST['senha']) ? md5($_POST['senha']) : "");
        $usuario->__set('nivel', 0);

        if ($usuario->validarCadastro()) {
            //SUCCESS ao validar cadastro
            if (count($usuario->getUsuarioPorEmail()) == 0) {
                $usuario->salvar();

                //podemos criar um atributo generico no objeto pois estamos herdando de action o view
                $this->view->status = array(
                    "status" => "SUCCESS",
                    "msg"    => "Cadastro realizado com sucesso"
                );

                header('Location: /login?cad=1');
            } else {
                //caso retornar 1 linha na query - indica que ja esta cadastrado no banco de dados
                $this->view->status = array(
                    "status" => "ERROR",
                    "msg"    => "Erro ao cadastrar usuário, e-mail já existe no banco de dados"
                );

                $this->view->tempUsuario = array(
                    "nome"      => isset($_POST['nome']) ? $_POST['nome'] : "",
                    "email"     => isset($_POST['email']) ? $_POST['email'] : "",
                    "senha"     => isset($_POST['senha']) ? $_POST['senha'] : "",
                    "nivel"     => isset($_POST['nivel']) ? $_POST['nivel'] : "",
                );

                header('Location: /login?cad=0');
            }
        } else {
            //erro na digitação < que 3 caracteres
            //armazena os dados para recarregar o form

            $this->view->tempUsuario = array(
                "nome" => isset($_POST['nome']) ? $_POST['nome'] : "",
                "email"    => isset($_POST['email']) ? $_POST['email'] : "",
                "senha"    => isset($_POST['senha']) ? $_POST['senha'] : "",
                "nivel"    => isset($_POST['nivel']) ? $_POST['nivel'] : "",
            );

            // dd($this->view->tempUsuario);

            $this->view->status = array(
                "status" => "ERROR",
                "msg"    => "Erro ao cadastrar usuário, verifique os campos digitados e tente novamente"
            );
            $this->render("login");
        }
    }

    // Reservar produtos
    public function reservar()
    {
        $reservas = Container::getModel('reservas');
        $reservas->__set('data_entrega', isset($_POST['data_entrega']) ? $_POST['data_entrega'] : "");
        $reservas->__set('valor_produto', isset($_POST['valor_produto']) ? $_POST['valor_produto'] : "");
        $reservas->__set('id_carrinho', isset($_POST['id_carrinho']) ? $_POST['id_carrinho'] : "");
        $reservas->__set('id_produto', isset($_POST['id_produto']) ? $_POST['id_produto'] : "");
        $reservas->addReserva();

        $carrinho = Container::getModel('carrinho');
        $carrinho->removeCarrinho(-1, $_SESSION['id']);

        header('Location: /minhasReservas');
    }

    // Página de reservas do usuário
    public function minhasReservas()
    {
        AuthController::validaAutenticacao();

        $produtos = Container::getModel('produtos');
        $produtos = $produtos->getProdutos();
        $this->view->produtos = $produtos;

        $reservas = Container::getModel('reservas');
        $reservas = $reservas->getReservas();
        $this->view->reservas = $reservas;

        $carrinho = Container::getModel('carrinho');
        $carrinho = $carrinho->getCarrinhoPorID();
        $this->view->carrinho = $carrinho;

        $this->render("minhasReservas", "templateUsuario");
    }
}
