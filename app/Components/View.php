<?php

namespace AppComp;

class View
{
	public $path;
	public $layout = 'default';
	public $route = '';

	public function __construct($class_method_names, $path)
	{
		if( $path !== '' ){
			$way_arr = explode('/', $path);
			$way_part_1 = $way_arr[0];
			$way_part_2 = $way_arr[1];
		}else{
			$way_arr_1 = explode('\\', $class_method_names);
			$way_arr_2 =  explode('::', $way_arr_1[1]);
			$way_part_1 = str_replace('Controller', '', $way_arr_2[0]);
			$way_part_2 = str_replace('Action', '', $way_arr_2[1]);
		}

		$this->path = $way_part_1.'/'.$way_part_2;
		// dd($way_part_1);
		if( $way_part_1 === 'AdsAgent' ){
			$this->layout = 'ads-agent';
		}
		return $this;
	}

	public function renderWithData($data)
	{
		$layout_obj = new Layout();
		if( $this->layout === 'default' ){
			$takeouts_badge_number = $layout_obj->takeoutsBadgeForLayout('', $this->layout);
			$data['takeouts_badge_number'] = $takeouts_badge_number;
		}
		if( isset($_SESSION['user_role'] )){
			$user_role = $layout_obj->userRoleForLayout($_SESSION['user_role']);
			$data['user_role'] = $user_role['description'];
		}

		extract($data);
		if( file_exists('app/Views/'.$this->path.'.php') ){
			ob_start();
			require('app/Views/'.$this->path.'.php');
			$content = ob_get_clean();
			require 'app/Views/layout/'.$this->layout.'.php';
		}else{
			throw new \Exception('file of layout not exist '.$this->path);
		}
	}


	public function setView($way)
	{
		$this->path = str_replace('__construct', $way, $this->path);
		return $this;
	}
	public function setLayout($layout)
	{
		$this->layout = $layout;
		return $this;
	}
	public function redirect($url)
	{
		
		header('location: '.$url);
		exit;
	}

	public function message($status, $message)
	{
		exit(json_encode(['status'=>$status, 'message'=>$message]));
	}

}
