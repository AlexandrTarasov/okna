<?php 	

	if($this->auth->check_permission('Users'))
		$menu['settings'][] = array('type' => 'item', 'link' => MODULES_URL.'atom_users', 'title' => 'Users', 'active' => ($this->uri->segment(3) == 'atom_users'), 'icon' => 'fa fa-users');
	

?>
