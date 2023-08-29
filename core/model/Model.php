<?php

namespace Core\model;

use PDO;

//Vamos criar uma classe abstrata que irá conter apenas os trechos 
//que são identicos para os models, que são: 
//o atributo protected $db e método construtor
abstract class Model
{
    //Variavel que receberá a conexão com banco de dados
    //que é a instância PDO que pe feita a partir do método getDb 
    //da classe Connection
    protected $db;

    //Construtor de Produto recebe por parametro a instancia de PDO
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
}
