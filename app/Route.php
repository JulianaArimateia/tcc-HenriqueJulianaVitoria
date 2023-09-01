<?php

namespace App;

use Core\init\Bootstrap;

class Route extends Bootstrap
{

    protected function initRoutes()
    {
        //IndexController
        $routes['home'] =  array('route' => '/', 'controller' => 'indexController', 'action' => 'index');
        $routes['login'] = array('route' => '/login', 'controller' => 'indexController', 'action' => 'login');

        //UsuarioController
        $routes['carrinho'] = array('route' => '/carrinho', 'controller' => 'usuarioController', 'action' => 'carrinho');
        $routes['adicionar_carrinho'] = array('route' => '/adicionarCarrinho', 'controller' => 'usuarioController', 'action' => 'adicionarCarrinho');
        $routes['remover_carrinho'] = array('route' => '/removerCarrinho', 'controller' => 'usuarioController', 'action' => 'removerCarrinho');
        $routes['favoritos'] = array('route' => '/favoritos', 'controller' => 'usuarioController', 'action' => 'favoritos');
        $routes['pagamento'] = array('route' => '/pagamento', 'controller' => 'usuarioController', 'action' => 'pagamento');

        //AdminController
        $routes['lista'] =  array('route' => '/adminLista', 'controller' => 'adminController', 'action' => 'lista');
        $routes['adicionar'] = array('route' => '/adminAdicionar', 'controller' => 'adminController', 'action' => 'adicionar');
        $routes['salvaProtudo'] = array('route' => '/salvarProduto', 'controller' => 'adminController', 'action' => 'salvarProduto');
        $routes['editarProtudo'] = array('route' => '/editarProduto', 'controller' => 'adminController', 'action' => 'editarProduto');
        $routes['excluirProtudo'] = array('route' => '/excluirProduto', 'controller' => 'adminController', 'action' => 'excluirProduto');

        // //UsuarioController
        $routes['usuario'] = array('route' => '/usuario', 'controller' => 'usuarioController', 'action' => 'index');
        $routes['novo_usuario'] = array('route' => '/novo_usuario', 'controller' => 'usuarioController', 'action' => 'cadastrar');
        $routes['salvar_usuario'] = array('route' => '/salvar_usuario', 'controller' => 'usuarioController', 'action' => 'salvar_usuario');
        // $routes['usuario_excluir'] = array('route' => '/usuario_excluir', 'controller' => 'UsuarioController', 'action' => 'excluir');
        // $routes['usuario_editar'] = array('route' => '/usuario_editar', 'controller' => 'UsuarioController', 'action' => 'editar');
        // $routes['usuario_atualizar'] = array('route' => '/usuario_atualizar', 'controller' => 'UsuarioController', 'action' => 'atualizar');

        //AuthController
        $routes['sair'] = array('route' => '/sair', 'controller' => 'AuthController', 'action' => 'sair');
        $routes['autenticar'] = array('route' => '/autenticar', 'controller' => 'AuthController', 'action' => 'autenticar');

        // //CategoriaController
        // $routes['categoria'] = array('route' => '/categoria', 'controller' => 'categoriaController', 'action' => 'index');
        // $routes['nova_categoria'] = array('route' => '/nova_categoria', 'controller' => 'categoriaController', 'action' => 'cadastrar');
        // $routes['salvar_categoria'] = array('route' => '/salvar_categoria', 'controller' => 'categoriaController', 'action' => 'salvar_categoria');
        // $routes['categoria_excluir'] = array('route' => '/categoria_excluir', 'controller' => 'categoriaController', 'action' => 'excluir');
        // $routes['categoria_editar'] = array('route' => '/categoria_editar', 'controller' => 'categoriaController', 'action' => 'editar');
        // $routes['categoria_atualizar'] = array('route' => '/categoria_atualizar', 'controller' => 'categoriaController', 'action' => 'atualizar');

        $this->setRoutes($routes);
    }
}
