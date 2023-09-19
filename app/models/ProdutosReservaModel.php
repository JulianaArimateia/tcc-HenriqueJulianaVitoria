<?php

namespace App\Models;

use Core\Model\Model;

class ProdutosReservaModel extends Model
{

    private $id;
    private $id_reserva;
    private $id_produto;



    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    //recuperar uma reservas por id
    public function getProdutosReservasPorId()
    {
        $query = "select p.id, p.id_reserva, p.id_produto, r.valor_produto as valor_produto, r.data_entrega as data_entrega, o.nome_produto as nome_produto, o.id_categoria as id_categoria, o.descricao as descricao from produtos_reserva as p inner join 
        reserva as r on r.id = p.id_reserva inner join produtos as o on o.id = p.id_produto where p.id_reserva = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $_GET['reserva']);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getProdutosReservas()
    {
        $sql = "select p.id, p.id_reserva, p.id_produto, r.valor_produto as valor_produto, r.data_entrega as data_entrega, o.nome_produto as nome_produto from produtos_reserva as p inner join 
    		reserva as r on r.id = p.id_reserva inner join produtos as o on o.id = p.id_produto";
        return $this->db->query($sql)->fetchAll();
    }

    public function addProdutosReserva()
    {
        $query = "insert into produtos_reserva(id_produto, id_reserva) values (:id_produto, :id_reserva)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_produto', $_GET['produto']);
        $stmt->bindValue(':id_produto', $_GET['reserva']);
        $stmt->execute();
    }

    public function deletarProdutosReserva($id)
    {
        $query = "delete from produtos_reserva where id_reserva = :id_reserva";
        // $query = "update produtos set ativo = 0, deleted_at = NOW() where id = :id_produtos";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_reserva', $id);
        $stmt->execute();

        return true;
    }
}
