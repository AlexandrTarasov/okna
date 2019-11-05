<?php 
	
	if($this->auth->get_user_role() == 1)
		$menu['main'][] = array('type' => 'item', 'link' => MODULES_URL.'installers/cabinet', 'title' => 'Личный кабинет', 'active' => ($this->uri->segment(3) == 'installers'), 'icon' => 'ion-person');
		
	if($this->auth->check_permission('Installers'))
		$menu['main'][] = array('type' => 'item', 'link' => MODULES_URL.'installers', 'title' => 'Монтажники', 'active' => ($this->uri->segment(3) == 'installers'), 'icon' => 'ion-ios-body');

?>
