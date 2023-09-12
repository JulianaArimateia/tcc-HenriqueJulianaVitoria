<?php

namespace App\Models;

use Core\Model\Model;

class ReservasModel extends Model
{

    private $id;
    private $id_usuarios;
    private $valor_produto;


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
<<<<<<< HEAD
=======

        return $valido;
    }
>>>>>>> ac86a26678e46df1e9f579367e09246bb343628d

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

    // public function getReservas()
    // {
    // 	$sql = "select c.id, c.nome, c.id_usuario, c.ativo, c.created_at, u.nome as nome_usuario, u.sobrenome as sobrenome_usuario from produtos as c inner join 
    // 		usuarios as u on u.id = c.id_usuario"  . " and c.ativo = 1";
    // 	return $this->db->query($sql)->fetchAll();
    // }

    public function getReservas()
    {
        $query = "select * from reserva";

        return $this->db->query($query)->fetchAll();
    } //perguntar sobre a quantidade essa quantidade de usuarios e pq precisa disso



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
<<<<<<< HEAD
=======

>>>>>>> ac86a26678e46df1e9f579367e09246bb343628d
}
