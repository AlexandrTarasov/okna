<?php 	

	if($this->auth->check_permission('Permissions'))
	$menu['developer'][] = array('type' => 'item', 'link' => MODULES_URL.'atom_permissions', 'title' => 'Permissions', 'active' => ($this->uri->segment(3) == 'atom_permissions'), 'icon' => 'fa fa-asterisk');

?>
