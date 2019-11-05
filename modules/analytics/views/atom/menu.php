<?php 	
	
	if($this->auth->check_permission('Analytics'))
		$menu['main'][] = array('type' => 'item', 'link' => MODULES_URL.'analytics', 'title' => 'Аналитика', 'active' => ($this->uri->segment(3) == 'analytics'), 'icon' => 'ion-arrow-graph-up-right');

?>
