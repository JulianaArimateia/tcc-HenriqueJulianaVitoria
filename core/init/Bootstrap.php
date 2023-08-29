<?php

namespace Core\init;

use App\Controllers\AuthController;

//Uma classe abstrata é definida de forma analoga a qualquer tipo de classe.
//É um tipo de classe especial que não pode ser instanciada, apenas herdada.
//Sendo assim, uma classe abstrata nao pode ter um objeto criado 
//a partir de uma instanciação
//As classes abstratas servem como "MODELO" para outras classes que dela herdem
//nao podendo ser instanciada por si só.
//Para ter um objeto de uma classe abstrata é necessário criar uma classe
//esepecializada  herdando dela com o termo extends....

abstract class Bootstrap
{
    private $routes;

    //Quando definimos um metodo abstrato, estamos indicando que 
    //quando herdado na classe filha
    //esse método dever ser obrigatóriamente implementado 
    //la nessa classe filha
    abstract protected function initRoutes();


    public function __construct()
    {
        $this->initRoutes();
        $this->run($this->getUrl());
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function setRoutes(array $routes)
    {
        $this->routes = $routes;
    }

    //visibilidade protected indica que o atributo ou método
    //pode ser modicifado pela propria classe e por classe que 
    //seja filhas de dela, ou seja herdem desta classe 

    protected function getUrl()
    {
        //$_SERVER['REQUEST_URI'] contem o endereço digitado na URL do navegador
        //parse_url pega a url digitada no navegador e retorna os seus componentes
        //PHP_URL_PATH faz com que o retorno seja uma string do path digitado na URL
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    //responsavel pela identificação do controller e chamada da action desejada
    protected function run($url)
    {        
        $rota = array();

        foreach ($this->getRoutes() as $key => $route) {
            if ($url == $route['route']) {
                $class = "App\\controllers\\" . ucfirst($route['controller']);
                $action = $route['action'];

                $rota = array(
                    "classe" => $class,
                    "action" => $action,
                );
            }            
        }
        $this->loadView($rota);
    }

    public function loadView(array $rota)
    {
        if (!empty($rota)) {
            $controller = new $rota['classe'];
            $action = $rota['action'];
            $controller->$action();
        } else {
            // AuthController::validaAutenticacao();

            $class = "App\\controllers\\ErrorController";
            $controller = new $class;
            $action = "error404";
            $controller->$action();       
        }
    }
}
