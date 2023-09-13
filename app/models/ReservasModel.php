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
        $query = "select id from reservas where id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $this->__get('id'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getReservas()
    {
    	$sql = "select r.id, r.id_usuarios, r.id_carrinho, r.data_entrega, u.nome as nome_usuario, u.email as email_usuario, c.quantidade as quantidade, c.valor as valor  from reserva as r inner join 
    		usuarios as u on u.id = r.id_usuarios";
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
    public function salvar()
    {

        $query = "insert into reserva (id) values (:id)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $this->__get('id'));
        // $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();

        return $this;
    }
}
