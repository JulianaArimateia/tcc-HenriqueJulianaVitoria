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
        $routes['favoritos'] = array('route' => '/favoritos', 'controller' => 'usuarioController', 'action' => 'favoritos');
        $routes['pagamento'] = array('route' => '/pagamento', 'controller' => 'usuarioController', 'action' => 'pagamento');

        //AdminController
        $routes['lista'] =  array('route' => '/admin/lista', 'controller' => 'adminController', 'action' => 'lista');
        $routes['adicionar'] = array('route' => '/admin/adicionar', 'controller' => 'adminController', 'action' => 'adicionar');

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
