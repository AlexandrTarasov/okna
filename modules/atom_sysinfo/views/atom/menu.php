<?php 
	
	if($this->auth->check_permission('Sysinfo'))
		$menu['settings'][] = array('type' => 'item', 'link' => MODULES_URL.'atom_sysinfo', 'title' => 'Sysinfo', 'active' => ($this->uri->segment(3) == 'atom_sysinfo'), 'icon' => 'fa fa-info-circle');


?>
