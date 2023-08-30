<?php

namespace App\Models;

use Core\Model\Model;

class CarrinhoModel extends Model
{

    private $id;
    private $id_produto;
    private $id_usuario;
    private $date_cadastro;

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function addCarrinho($id, $user)
    {
        $query = "
        insert into carrinho (id_usuarios, id_produtos, date_cadastro) values (:id_usuarios, :id_produtos, NOW())
        ";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':id_produtos', $id);
        $stmt->bindValue(':id_usuarios', $user);
        $stmt->execute();

        return $this;
    }

    public function removeCarrinho($id, $user)
    {
        $query = "delete from carrinho where id_produtos = :id_produtos and id_usuarios = :id_usuarios;";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':id_produtos', $id);
        $stmt->bindValue(':id_usuarios', $user);

        $stmt->execute();

        return $this;
    }

    public function getCarrinho()
    {
        $query = "select * from carrinho";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
