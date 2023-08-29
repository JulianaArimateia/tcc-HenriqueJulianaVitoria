<?php

namespace App\Controllers;

//os recursos do miniframework
use Core\Controller\Action;
use Core\Model\Container;

class AuthController extends Action
{
	public function autenticar()
	{
		$usuario = Container::getModel('Usuario');
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', md5($_POST['senha']));
		$usuario->autenticar();

		if ($usuario->__get('id') != '' && $usuario->__get('nome')) {
			session_start();
			$_SESSION['id'] = $usuario->__get('id');
			$_SESSION['nome'] = $usuario->__get('nome');
			$_SESSION['nivel'] = $usuario->__get('nivel');
			$_SESSION['email'] = $usuario->__get('email');

			header('Location: /');
		} else {
			header('Location: /login?error=401');
		}
		if ($_SESSION['nivel'] == '1') {
			header('Location: /admin/lista');
			$this->render("lista", "templateAdmin");
		} else {
			$_SESSION['nivel'] == '0';
			header('Location: /');
			$this->render("index", "templateUsuario");
		}
		dd($_POST);
	}

	public static function validaAutenticacao()
	{

		if (session_status() !== PHP_SESSION_ACTIVE) {
			session_start();
		}

		if (!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == '') {
			header('Location: /login?erro=403');
		}
	}

	public static function esta_logado()
	{
		if (session_status() !== PHP_SESSION_ACTIVE) {
			session_start();
		}

		$logado = true;

		if (!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == '') {
			$logado = false;
		}

		return $logado;
	}

	public function sair()
	{
		session_start();
		session_destroy();
		header('Location: /');
	}
}