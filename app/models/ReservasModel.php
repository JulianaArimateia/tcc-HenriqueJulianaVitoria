<?php

namespace App\Models;

use Core\Model\Model;
use App\controllers\AuthController;

class ReservasModel extends Model
{
    private $id;
    private $id_usuarios;
    private $valor_produto;
    private $quantidade;
    private $produto;
    private $data_entrega;

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function validarCadastro()
    {
        $valido = true;

        if (strlen($this->__get('nome_reserva')) < 3) {
            $valido = false;
        }

        return $valido;
    }

    public function getReservasPorId()
    {
        $query = "SELECT r.id, r.id_usuarios, r.valor_produto, r.data_entrega, r.quantidade, u.nome as nome_usuario, u.email as email_usuario FROM reserva as r INNER JOIN usuarios as u ON u.id = r.id_usuarios WHERE r.id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $_GET['reserva']);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getReservasPorUser()
    {
        $query = "SELECT r.id, r.id_usuarios, r.valor_produto, r.valor_produto, DATE_FORMAT(r.data_entrega, '%d/%m/%Y') AS data_formatada, u.nome as nome_usuario, u.email as email_usuario FROM reserva as r INNER JOIN usuarios as u ON u.id = r.id_usuarios WHERE r.id_usuarios = :id_usuarios";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuarios', $_SESSION['id']);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getReservas()
    {
        AuthController::esta_logado();

        $sql = "SELECT r.id, r.id_usuarios, r.valor_produto, r.quantidade, DATE_FORMAT(r.data_entrega, '%d/%m/%Y') AS data_formatada, u.nome AS nome_usuario, u.email AS email_usuario FROM reserva AS r INNER JOIN usuarios AS u ON u.id = r.id_usuarios";
        return $this->db->query($sql)->fetchAll();
    }

    public function deletarReservas($id)
    {
        $query = "DELETE FROM reserva WHERE id = :id_reserva";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_reserva', $id);
        $stmt->execute();

        return true;
    }

    public function addReserva()
    {
        AuthController::esta_logado();

        // Primeira consulta para inserir na tabela 'reserva'
        $query = "INSERT INTO reserva (id_usuarios, valor_produto, data_entrega, quantidade) VALUES (:id_usuarios, :valor_produto, :data_entrega, :quantidade)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuarios', $_SESSION['id']);
        $stmt->bindValue(':data_entrega', $this->__get('data_entrega'));
        $stmt->bindValue(':valor_produto', $_POST['valor_produto']);
        $stmt->bindValue(':quantidade', $_POST['quantidade']);
        $stmt->execute();

        // Obter o último ID inserido na tabela 'reserva'
        $id_reserva = $this->db->lastInsertId();

        // Desserializa a string 'produto' de $_POST em um array
        $produtos = unserialize($_POST['produto']);

        foreach ($produtos as $produtoId) {
            $query = "INSERT INTO produtos_reserva (id_produto, id_reserva) VALUES (:id_produto, :id_reserva)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_produto', $produtoId);
            $stmt->bindValue(':id_reserva', $id_reserva);
            $stmt->execute();
        }

        return $this;
    }
}
