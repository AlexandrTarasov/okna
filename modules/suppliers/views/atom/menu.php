<?php 	
	
	if($this->auth->check_permission('Suppliers'))
		$menu['main'][] = array('type' => 'item', 'link' => MODULES_URL.'suppliers', 'title' => 'Поставщики', 'active' => ($this->uri->segment(3) == 'suppliers'), 'icon' => 'ion-briefcase');

?>
