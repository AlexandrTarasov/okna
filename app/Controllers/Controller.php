<?php

namespace AppCont;

use AppComp\View as View;

class Controller {
	public $route;
	public $view;
	public $action;
	public $model;

	public function __construct($controller_path = '', $action = '') 
	{
		// dd($controller_path);
		$controller_path = str_replace('AppCont\\', '', $controller_path);
		$controller_path = str_replace('Controller', '', $controller_path);
		$this->route = $controller_path;
		if( !isset($_SESSION['user_name']) && $this->route !=='Account'){
			$this->view = new View('', 'f/f');
			$this->view->redirect('/');
			exit('site closed');
		}
		// dd($controller_path);
		if( isset($_SESSION['user_role'] )){
			/*TODO
			 * remove Session check in independent class
			 * */
			$this->accessCheck($_SESSION['user_role'], $controller_path);
		}

		$this->model = $this->loadModel($controller_path);
		return $this;
	}
	
	/*if you need you own path put it in second parametr
	 * like 'path/path2/'
	 */
	public function runView($way, $path = ''): View
	{
		// dd($way);
		$this->view = new View($way, $path);
		return $this->view;
	}


	public function loadModel($name) 
	{
		$path = 'AppM\\'.$name.'';
		// dd(new $path);
		if( class_exists($path) ){
			return new $path;
		}
	}

	public function accessCheck($user_role_id, $controller_name)
	{
		$accepted_ways=['AdsAgent', 'Account'];
		if( $user_role_id ==='6' ){
			if (!in_array($controller_name, $accepted_ways)) {
				exit('permissions denied');
			}
		}
	}


}
