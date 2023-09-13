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
        $routes['minhasReservas'] = array('route' => '/minhasReservas', 'controller' => 'usuarioController', 'action' => 'minhasReservas');
        $routes['adicionar_carrinho'] = array('route' => '/adicionarCarrinho', 'controller' => 'usuarioController', 'action' => 'adicionarCarrinho');
        $routes['remover_carrinho'] = array('route' => '/removerCarrinho', 'controller' => 'usuarioController', 'action' => 'removerCarrinho');
        $routes['mais_carrinho'] = array('route' => '/maisQtdCarrinho', 'controller' => 'usuarioController', 'action' => 'maisQtdCarrinho');
        $routes['menos_carrinho'] = array('route' => '/menosQtdCarrinho', 'controller' => 'usuarioController', 'action' => 'menosQtdCarrinho');
        $routes['favoritos'] = array('route' => '/favoritos', 'controller' => 'usuarioController', 'action' => 'favoritos');
        $routes['pagamento'] = array('route' => '/pagamento', 'controller' => 'usuarioController', 'action' => 'pagamento');

        //AdminController
        $routes['lista'] =  array('route' => '/adminLista', 'controller' => 'adminController', 'action' => 'lista');
        $routes['adicionar'] = array('route' => '/adminAdicionar', 'controller' => 'adminController', 'action' => 'adicionar');
        $routes['reservas'] = array('route' => '/adminReservas', 'controller' => 'adminController', 'action' => 'reservas');
        $routes['detalhesReserva'] = array('route' => '/detalhesReserva', 'controller' => 'adminController', 'action' => 'detalhesReserva');
        $routes['deletarReserva'] = array('route' => '/deletarReserva', 'controller' => 'adminController', 'action' => 'deletarReserva');
        $routes['salvaProtudo'] = array('route' => '/salvarProduto', 'controller' => 'adminController', 'action' => 'salvarProduto');
        $routes['editarProtudo'] = array('route' => '/editarProduto', 'controller' => 'adminController', 'action' => 'editarProduto');
        $routes['excluirProtudo'] = array('route' => '/excluirProduto', 'controller' => 'adminController', 'action' => 'excluirProduto');
        $routes['atualizarProtudo'] = array('route' => '/atualizarProduto', 'controller' => 'adminController', 'action' => 'atualizarProduto');

        // //UsuarioController
        $routes['usuario'] = array('route' => '/usuario', 'controller' => 'usuarioController', 'action' => 'index');
        $routes['novo_usuario'] = array('route' => '/novo_usuario', 'controller' => 'usuarioController', 'action' => 'cadastrar');
        $routes['salvar_usuario'] = array('route' => '/salvar_usuario', 'controller' => 'usuarioController', 'action' => 'salvar_usuario');

        //AuthController
        $routes['sair'] = array('route' => '/sair', 'controller' => 'AuthController', 'action' => 'sair');
        $routes['autenticar'] = array('route' => '/autenticar', 'controller' => 'AuthController', 'action' => 'autenticar');

      
        $this->setRoutes($routes);
    }
}
