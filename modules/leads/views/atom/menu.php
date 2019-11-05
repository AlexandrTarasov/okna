<?php 
		
	if($this->auth->check_permission('Leads')){

		$menu['main'][] = array('type' => 'item', 'link' => MODULES_URL.'leads/add', 'title' => 'Новый лид', 'active' => ($this->uri->segment(3) == 'leads'), 'icon' => 'fa fa-plus-square');

		$menu['main'][] =  array('type' => 'subitem', 'link' =>  MODULES_URL.'leads', 'title' => 'Лиды', 'active' => ($this->uri->segment(3) == 'leads'),  'icon' => 'ion-checkmark-circled', 'items' => array(
			array('link' =>  MODULES_URL.'leads?status=new', 'title' => '<span class="badge badge-default" style="display:inline-block;width:10px;height:10px;"></span> Новые'),
			array('link' =>  MODULES_URL.'leads?status=processing', 'title' => '<span class="badge badge-primary" style="display:inline-block;width:10px;height:10px;"></span> В обработке'),
			array('link' =>  MODULES_URL.'leads?status=accepted', 'title' => '<span class="badge badge-success" style="display:inline-block;width:10px;height:10px;"></span> Принятые'),
			array('link' =>  MODULES_URL.'leads?status=canceled', 'title' => '<span class="badge badge-danger" style="display:inline-block;width:10px;height:10px;"></span> Отменённые'),
		));

	}


?>
