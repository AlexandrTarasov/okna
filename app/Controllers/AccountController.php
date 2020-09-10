<?php

namespace AppCont;

use AppComp\View as View;
use AppM;

class AccountController extends Controller
{
	private $mail;
	private $user_data_arr;

	public function __construct()
	{
		parent::__construct(__CLASS__);
	}

	public function indexAction()
	{
		// dd(password_hash('Jx6-EFa-p8g-WrZ', PASSWORD_DEFAULT));
		if( isset($_SESSION['admin']) && $_SESSION['admin'] ===1 ){
				$this->runView(__METHOD__)->redirect('/adminpanel');
		}

		if( (isset($_POST['mail']) && $_POST['mail'] !=='')  && 
		   (isset($_POST['password']) && $_POST['password'] !=='')	){
			
			$mail = $this->testInput($_POST["mail"]);
			if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
				$this->thowErrLoginPage(__METHOD__, 'wrong email format');
			}
			$this->user_data_arr = $this->model->getUserLoginInfo($_POST['mail']);
			if(empty($this->user_data_arr)){
				$this->thowErrLoginPage(__METHOD__, 'no such mail');
			}

			// if(password_verify($_POST['password'], $this->user_data_arr[0]['password']))
			/*TODO
			 * make varification withoud developer code which is line down
			 */
			if( password_verify($_POST['password'], $this->user_data_arr[0]['password'])){
				$_SESSION['user_name'] = $this->user_data_arr[0]['username'];
				$_SESSION['user_role'] = $this->user_data_arr[0]['role_id'];
				$_SESSION['user_id'] = $this->user_data_arr[0]['id'];
				$this->runView(__METHOD__)->redirect('/orders');
			}else{
				$this->thowErrLoginPage(__METHOD__, 'pass wrong');
			}

		}else{
			$this->runView(__METHOD__)->setLayout('login')->renderWithData(['login page', 'title page', 'err_message'=>'']); 
		}
	}

	public function thowErrLoginPage($path, $err_message)
	{
		$this->runView($path)->setLayout('login')->renderWithData(['title'=>'login page', 'err_message' => $err_message ]); 
		exit();
	}

	public function testInput($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	public function logOutAction()
	{
		$_SESSION = [];
		$this->view = new View('', 'f/f');
		$this->view->redirect('/');
	}
}
