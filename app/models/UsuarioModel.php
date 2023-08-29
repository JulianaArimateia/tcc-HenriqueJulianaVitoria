<?php

namespace App\Models;

use Core\Model\Model;

class UsuarioModel extends Model
{

	private $id;
	private $nome;
	private $email;
	private $senha;
	private $nivel;
	private $ativo;
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

	//validar se um cadastro pode ser feito
	public function validarCadastro()
	{
		$valido = true;

		if (strlen($this->__get('nome')) < 3) {
			$valido = false;
		}

		if (strlen($this->__get('email')) < 3) {
			$valido = false;
		}

		if (strlen($this->__get('senha')) < 3) {
			$valido = false;
		}

		return $valido;
	}

	//recuperar um usuário por e-mail
	public function getUsuarioPorEmail()
	{
		$query = "select nome, email from usuarios where email = :email";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	//recuperar um usuário por id
	public function getUsuarioPorId()
	{
		$query = "select id, nome, email, senha, nivel, from usuarios where id = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $this->__get('id'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function autenticar()
	{
		$query = "select id, nome, nivel, email, ativo from usuarios where email 
		= :email and senha = :senha";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':senha', $this->__get('senha'));
		$stmt->execute();

		$usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

		if ($usuario['id'] != '' && $usuario['nome'] != '') {
			$this->__set('id', $usuario['id']);
			$this->__set('nome', $usuario['nome']);
			$this->__set('tipo', $usuario['nivel']);
			$this->__set('email', $usuario['email']);
			$this->__set('ativo', $usuario['ativo']);
		}

		return $this;
	}

	//Informações do Usuário
	public function getInfoUsuario()
	{
		$query = "select nome from usuarios where id = :id_usuario";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_usuario', $this->__get('id'));
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	public function getUsuarios()
	{
		$sql = "select id, nome, email, nivel, ativo, created_at from usuarios where id != " . $_SESSION['id'] . " and ativo = 1";

		return $this->db->query($sql)->fetchAll();
	}

	public function getTotalUsuarios()
	{
		$query = "select count(id) as qtdeUsuarios from usuarios";

		return $this->db->query($query)->fetchObject()->qtdeUsuarios;
	}

	public function deletarUsuario($id)
	{
		// $query = "delete from usuarios where id = :id_usuario";
		$query = "update usuarios set ativo = 0 where id = :id_usuario";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_usuario', $id);
		$stmt->execute();

		return true;
	}

	//salvar
	public function salvar()
	{
		$query = "insert into usuarios(nome, email, senha, nivel) values (:nome, :email, :senha, :nivel)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':nome', $this->__get('nome'));
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':senha', $this->__get('senha')); //md5() -> hash 32 caracteres
		$stmt->bindValue(':nivel', $this->__get('nivel'));
		$stmt->execute();

		return $this;
	}

	//atualizar
	public function atualizar()
	{

		$query = "update usuarios set nome = :nome, email = :email, senha = :senha, nivel = :nivel";

		$query .= ", updated_at = :updated_at where id=:id";




		$stmt = $this->db->prepare($query);

		$stmt->bindValue(':nome', $this->__get('nome'));
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':senha', $this->__get('senha')); //md5() -> hash 32 caracteres
		$stmt->bindValue(':nivel', $this->__get('nivel'));

		

		$stmt->bindValue(':updated_at', $this->__get('updated_at'));
		$stmt->bindValue(':id', $this->__get('id'));

		$stmt->execute();

		return $this;
	}
}
