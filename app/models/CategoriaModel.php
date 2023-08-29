<?php

namespace App\Models;

use Core\Model\Model;

class CategoriaModel extends Model
{

	private $id;
	private $nome;
	
	

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

		if (strlen($this->__get('nome')) < 3) {
			$valido = false;
		}

		return $valido;
	}

	//recuperar um categoria por nome
	public function getCategoriaPorNome()
	{
		$query = "select id, nome from categorias where nome = :nome";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':nome', $this->__get('nome'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	//recuperar uma categoria por id
	public function getCategoriaPorId()
	{
		$query = "select id, nome from categorias where id = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $this->__get('id'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	// public function getCategorias()
	// {
	// 	$sql = "select c.id, c.nome, c.id_usuario, c.ativo, c.created_at, u.nome as nome_usuario, u.sobrenome as sobrenome_usuario from categorias as c inner join 
	// 		usuarios as u on u.id = c.id_usuario"  . " and c.ativo = 1";

	// 	return $this->db->query($sql)->fetchAll();
	// }

	public function getTotalCategorias()
	{
		$query = "select count(id) as qtdeCategorias from categorias";

		return $this->db->query($query)->fetchObject()->qtdeUsuarios;
	}

	public function deletarCategoria($id)
	{
		$query = "delete from categoria where id = :id_categoria";
		// $query = "update categorias set ativo = 0, deleted_at = NOW() where id = :id_categoria";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_categoria', $id);
		$stmt->execute();

		return true;
	}

	//salvar
	public function salvar()
	{
		
		$query = "insert into categorias (nome) values (:nome)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':nome', $this->__get('nome'));
		// $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
		$stmt->execute();

		return $this;
	}

	//atualizar
	public function atualizar()
	{

		$query = "update categorias set nome = :nome, updated_at = NOW() where id=:id";

		$stmt = $this->db->prepare($query);

		$stmt->bindValue(':nome', $this->__get('nome'));
		
		$stmt->bindValue(':id', $this->__get('id'));

		$stmt->execute();

		return $this;
	}
}
