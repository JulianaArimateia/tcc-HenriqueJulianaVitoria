<?php

namespace App\Models;

use Core\Model\Model;

class ReservasModel extends Model
{

    private $id;
    private $id_usuarios;
    private $id_carrinho;
    private $data_entrega;


    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    // validar se um cadastro pode ser feito
    public function validarCadastro()
    {
        $valido = true;

        if (strlen($this->__get('nome_reserva')) < 3) {
            $valido = false;
        }

        return $valido;
    }


    //recuperar uma reservas por id
    public function getReservasPorId()
    {
        $query = "select r.id, r.id_usuarios, r.valor_produto , r.id_carrinho, r.valor_produto, r.data_entrega, u.nome as nome_usuario, u.email as email_usuario, c.quantidade as quantidade, c.id_produtos as id_produtos  from reserva as r inner join 
        usuarios as u on u.id = r.id_usuarios inner join carrinho as c on c.id = r.id_carrinho where r.id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $_GET['reserva']);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getReservas()
    {
        $sql = "select r.id, r.id_usuarios, r.id_carrinho, r.valor_produto, r.data_entrega, u.nome as nome_usuario, u.email as email_usuario, c.quantidade as quantidade, c.id_produtos as id_produtos  from reserva as r inner join 
        usuarios as u on u.id = r.id_usuarios inner join carrinho as c on c.id = r.id_carrinho;";
        return $this->db->query($sql)->fetchAll();
    }


    public function deletarReservas($id)
    {
        $query = "delete from reserva where id = :id_reserva";
        // $query = "update produtos set ativo = 0, deleted_at = NOW() where id = :id_produtos";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_reserva', $id);
        $stmt->execute();

        return true;
    }

    //salvar
    public function addReserva()
    {
        // Primeira consulta para inserir na tabela 'reserva'
        $query = "INSERT INTO reserva (id_usuarios, valor_produto, data_entrega, id_carrinho) VALUES (:id_usuarios, :valor_produto, :data_entrega, :id_carrinho)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuarios', $_SESSION['id']);
        $stmt->bindValue(':valor_produto', $_GET['valor']);
        $stmt->bindValue(':data_entrega', $this->__get('data_entrega'));
        $stmt->bindValue(':id_carrinho', $_GET['carrinho']);
        $stmt->execute();

        // Obter o último ID inserido na tabela 'reserva'
        $id_reserva = $this->db->lastInsertId();

        // Segunda consulta para inserir na tabela 'produtos_reserva'
        $query = "INSERT INTO produtos_reserva (id_produto, id_reserva) VALUES (:id_produto, :id_reserva)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_produto', $_GET['produto']);
        $stmt->bindValue(':id_reserva', $id_reserva); // Usando o último ID inserido na primeira tabela
        $stmt->execute();

        return $this;
    }
}
