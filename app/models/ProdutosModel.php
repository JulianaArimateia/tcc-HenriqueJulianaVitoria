<?php

namespace App\Models;

use Core\Model\Model;

class ProdutosModel extends Model
{

    private $id;
    private $nome_produto;
    private $id_categoria;
    private $quantidade_produto;
    private $custo;
    private $valor;
    private $descricao;
    private $created_at;
    private $updated_at;
    private $deleted_at;
    private $nivel;
    private $imagem;

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    //validar se um cadastro pode ser feito
    public function validarCadastro()
    {
        $valido = true;

        if (strlen($this->__get('nome_produto')) < 3) {
            $valido = false;
        }

        return $valido;
    }

    //recuperar um Produtos por nome
    public function getProdutosPorNome()
    {
        $query = "select id, nome, ativo from produtos where nome = :nome";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    //recuperar uma Produtos por id
    public function getProdutosPorId()
    {
        $query = "select id, nome from produtos where id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $this->__get('id'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    //-----------------------------------------------------//
    //perguntar pro fabio
    //---------------------------------------------//

    // public function getProdutos()
    // {
    // 	$sql = "select c.id, c.nome, c.id_usuario, c.ativo, c.created_at, u.nome as nome_usuario, u.sobrenome as sobrenome_usuario from produtos as c inner join 
    // 		usuarios as u on u.id = c.id_usuario"  . " and c.ativo = 1";

    // 	return $this->db->query($sql)->fetchAll();
    // }

    public function getTotalProdutos()
    {
        $query = "select count(id) as qtdeProdutos from produtos";

        return $this->db->query($query)->fetchObject()->qtdeUsuarios;
    }



    public function deletarProdutos($id)
    {
        $query = "delete from produtos where id = :id_produto";
        // $query = "update produtos set ativo = 0, deleted_at = NOW() where id = :id_produtos";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_produtos', $id);
        $stmt->execute();

        return true;
    }

    //salvar
    public function salvar()
    {

        $query = "insert into produtos (nome) values (:nome)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome', $this->__get('nome'));
        // $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();

        return $this;
    }

    //atualizar
    public function atualizar()
    {

        $query = "update produtos set nome = :nome, updated_at = NOW() where id=:id";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':nome', $this->__get('nome'));

        $stmt->bindValue(':id', $this->__get('id'));

        $stmt->execute();

        return $this;
    }
}
