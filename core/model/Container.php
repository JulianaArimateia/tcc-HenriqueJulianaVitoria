<?php
    namespace Core\model;

    //devemos importar a classe Connection
    use App\database\Connection;

    class Container {

        // Esta método será capaz de retornar o modelo solicitado 
        // ja instanciado, inclusive com a conexao com banco de dados
        public static function getModel ($model) {

            // montando o caminho de onde o model se localiza e unindo 
            // com modelo que chegou via parametro ($model)
            $class = "\\App\\models\\" . ucfirst($model)."Model";

            // Criando uma conexão com banco de dados 
            // através da instancia de connection, acionando o
            // método getDb estático
            $conn = Connection::getDb();

            //devolvendo o modelo ja com a conexao com o banco de dados
            //dessa forma nao precisamos mais realizar esta ação
            //no controlador, deixando de ser repetido
            return new $class($conn);
        }
    }

?>