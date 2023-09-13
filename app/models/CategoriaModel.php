<?php

namespace App\Models;

use Core\Model\Model;

class CategoriaModel extends Model
{

	private $id;
	private $nome;
	private $created_at;
	private $updated_at;
	private $deleted_at;



	public function __get($atributo)
	{
		return $this->$atributo;
	}

	public function __set($atributo, $valor)
	{
		$this->$atributo = $valor;
	}

	public function getCategorias()
	{
		$query = "select * from categoria";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	
}
