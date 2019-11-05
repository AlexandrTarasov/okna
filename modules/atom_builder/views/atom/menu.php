<?php 
	
	
	$menu['developer'][] = array('type' => 'item', 'link' => MODULES_URL.'atom_builder', 'title' => 'Builder', 'active' => ($this->uri->segment(3) == 'atom_builder'), 'icon' => 'fa fa-cogs');



?>