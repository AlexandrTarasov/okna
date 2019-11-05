<?php 	

	if($this->auth->check_permission('Roles'))
	$menu['developer'][] = array('type' => 'item', 'link' => MODULES_URL.'atom_roles', 'title' => 'Roles', 'active' => ($this->uri->segment(3) == 'atom_roles'), 'icon' => 'fa fa-users');

?>
