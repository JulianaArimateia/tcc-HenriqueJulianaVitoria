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

        if (strlen($this->__get('nome_produto')) < 1) {
            $valido = false;
        }
        if (strlen($this->__get('custo')) < 1) {
            $valido = false;
        }
        if (strlen($this->__get('valor')) < 1) {
            $valido = false;
        }
        if (strlen($this->__get('quantidade_produto')) < 1) {
            $valido = false;
        }

        return $valido;
    }

    //recuperar um Produtos por nome
    public function getProdutosPorNome()
    {
        $query = "select id, nome_produto, id_categoria, quantidade_produto, custo, valor, descricao, imagem from produtos where nome_produto = :nome_produto";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome_produto', $this->__get('nome_produto'));
        $stmt->execute();
        // $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this;
    }

    //recuperar uma Produtos por id
    public function getProdutosPorId()
    {
        $query = "select id, nome_produto, id_categoria, quantidade_produto, custo, valor, descricao, imagem from produtos where id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $this->__get('id'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getProdutos()
    {
        $sql = "select p.id, p.nome_produto, p.id_categoria,
         p.quantidade_produto, p.custo, p.valor, p.descricao,
         p.created_at, p.updated_at, p.deleted_at, p.imagem, 
		 c.nome as categoria from produtos as p inner join 
			categoria as c on p.id_categoria = c.id";

        return $this->db->query($sql)->fetchAll();
    }

    public function getTotalProdutos()
    {
        $query = "select count(id) as qtdeProdutos from produtos";

        return $this->db->query($query)->fetchObject()->qtdeUsuarios;
    }



    public function deletarProdutos($id)
    {
        $query = "delete from produtos where id = :id_produtos";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_produtos', $id);
        $stmt->execute();

        return true;
    }

    //salvar
    public function salvar()
    {

        $query = "insert into produtos(nome_produto, id_categoria, quantidade_produto, custo, valor, descricao, imagem ) values (:nome_produto, :id_categoria, :quantidade_produto, :custo, :valor, :descricao, :imagem )";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome_produto', $this->__get('nome_produto'));
        $stmt->bindValue(':id_categoria', $this->__get('id_categoria'));
        $stmt->bindValue(':quantidade_produto', $this->__get('quantidade_produto'));
        $stmt->bindValue(':custo', $this->__get('custo'));
        $stmt->bindValue(':valor', $this->__get('valor'));
        $stmt->bindValue(':descricao', $this->__get('descricao'));
        $stmt->bindValue(':imagem', $this->__get('imagem'));
        $stmt->execute();

        // $this->__set('id', $this->db->lastInsertId());

        return $this;
    }


    public function atualizar()
    {
        $query = "update produtos SET nome_produto = :nome_produto, id_categoria = :id_categoria, quantidade_produto = :quantidade_produto, custo = :custo, valor = :valor, descricao = :descricao, imagem = :imagem, updated_at = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':nome_produto', $this->__get('nome_produto'));
        $stmt->bindValue(':id_categoria', $this->__get('id_categoria'));
        $stmt->bindValue(':quantidade_produto', $this->__get('quantidade_produto'));
        $stmt->bindValue(':custo', $this->__get('custo'));
        $stmt->bindValue(':valor', $this->__get('valor'));
        $stmt->bindValue(':descricao', $this->__get('descricao'));
        $stmt->bindValue(':imagem', $this->__get('imagem'));
        $stmt->bindValue('id', $this->__get('id'));
        $stmt->execute();

        return $this;
    }
}
