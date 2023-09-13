<?php

namespace App\Models;

use Core\Model\Model;

class ProdutosReservasModel extends Model
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
        $query = "select id from reservas where id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $this->__get('id'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getProdutosReservas()
    {
    	$sql = "select p.id, p.id_reserva, p.id_produto, r.valor_produto as valor_produto, r.data_entrega as data_entrega, o.nome_produto as nome_produto from produtos_reserva as p inner join 
    		reserva as r on r.id = p.id_reserva inner join produtos as o on o.id = p.id_produto";
    	return $this->db->query($sql)->fetchAll();
    }
}
