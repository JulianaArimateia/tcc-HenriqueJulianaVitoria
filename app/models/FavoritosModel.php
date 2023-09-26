<?php

namespace App\Models;

use Core\Model\Model;
use App\controllers\AuthController;

class FavoritosModel extends Model
{

    private $id;
    private $id_produtos;
    private $id_usuarios;
    private $valor_produto;
    private $date_cadastro;

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function addFavoritos($id, $user)
    {
        AuthController::esta_logado();

        $query = "
        insert into favoritos (id_usuarios, id_produtos, date_cadastro) values (:id_usuarios, :id_produtos, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_produtos', $id);
        $stmt->bindValue(':id_usuarios', $user);
        $stmt->execute();

        return $this;
    }

    public function removeFavoritos($id, $user)
    {
        AuthController::esta_logado();

        $query = "delete from Favoritos where id_produtos = :id_produtos and id_usuarios = :id_usuarios;";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':id_produtos', $id);
        $stmt->bindValue(':id_usuarios', $user);

        $stmt->execute();

        return $this;
    }

    public function getFavoritos()
    {
        $sql = "SELECT f.id, f.id_produtos, f.id_usuarios, p.nome_produto as nome_produto, p.descricao as descricao_produto
        FROM favoritos as f
        INNER JOIN produtos as p ON p.id = f.id_produtos;";
        return $this->db->query($sql)->fetchAll();
    }


    public function getFavoritosPorID()
    {

        AuthController::esta_logado();

        $query = "select * from favoritos where id_usuarios = :id_usuarios";
        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':id_usuarios', $_SESSION['id']);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
