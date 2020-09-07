<?php

namespace AppCont;

class UserController extends Controller
{
	public $model;
	private $message;

	public function __construct()
	{
		parent::__construct(__CLASS__);
		if( $_SESSION['user_role'] !== '3' ){
			exit();
		}
	}

	public function indexAction($url='')
	{
		$users = $this->model->getUsers();
		$roles = $this->model->getRoles();
		$resalt = [
			'title' => 'Юзеры',
			'message' => $this->message,
			'users' => $users,
			'roles' => $roles,
			'total' => count($users),
		];
		$this->runView(__METHOD__)->renderWithData($resalt);
	}

}
