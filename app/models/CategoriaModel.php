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



	// public function getCategorias()
	//  {
	// 	$sql = "select c.id, c.nome, u.nome as nome_usuario, u.sobrenome as sobrenome_usuario from categorias as c inner join 
	//  		usuarios as u on u.id = c.id_usuario"  . " and c.ativo = 1";

	// 	return $this->db->query($sql)->fetchAll();
	//  }
	public function getCategorias()
	{
		$query = "select * from categoria";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	
}
