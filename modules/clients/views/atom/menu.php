<?php 	
	
	if($this->auth->check_permission('Clients'))
		$menu['main'][] = array('type' => 'item', 'link' => MODULES_URL.'clients', 'title' => 'Клиенты', 'active' => ($this->uri->segment(3) == 'clients'), 'icon' => 'ion-ios-people');

?>
