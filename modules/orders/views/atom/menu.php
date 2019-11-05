<?php 	
	
	if($this->auth->check_permission('Orders'))
	{
		
		if($this->auth->get_user_role() == 1)
			$menu['main'][] = array('type' => 'item', 'link' => MODULES_URL.'orders', 'title' => 'Мои заказы', 'active' => ($this->uri->segment(3) == 'orders'), 'icon' => 'ion-ios-cart');
		else {
			$menu['main'][] =  array('type' => 'subitem', 'link' =>  MODULES_URL.'leads', 'title' => 'Заказы', 'active' => ($this->uri->segment(3) == 'orders'),  'icon' => 'ion-ios-cart', 'items' => array(
				array('link' =>  MODULES_URL.'orders', 'title' => 'Все заказы'),
				array('link' =>  MODULES_URL.'orders?status=new', 'title' => '<span class="badge badge-default" style="display:inline-block;width:10px;height:10px;"></span> Новые'),
				array('link' =>  MODULES_URL.'orders?status=processing', 'title' => '<span class="badge badge-primary" style="display:inline-block;width:10px;height:10px;"></span> В обработке'),
				array('link' =>  MODULES_URL.'orders?status=measuring', 'title' => '<span class="badge badge-warning" style="display:inline-block;width:10px;height:10px;"></span> Замер'),
				array('link' =>  MODULES_URL.'orders?status=during', 'title' => '<span class="badge badge-info" style="display:inline-block;width:10px;height:10px;"></span> В процессе'),
				array('link' =>  MODULES_URL.'orders?status=in_work', 'title' => '<span class="badge badge-danger" style="display:inline-block;width:10px;height:10px;"></span> В работе'),
				array('link' =>  MODULES_URL.'orders?status=complete', 'title' => '<span class="badge badge-success" style="display:inline-block;width:10px;height:10px;"></span> Готов'),
				array('link' =>  MODULES_URL.'orders?status=fulfilled', 'title' => '<span class="badge badge-success" style="display:inline-block;width:10px;height:10px;"></span> Выполнен'),
				array('link' =>  MODULES_URL.'orders?status=archive', 'title' => '<span class="badge badge-default" style="display:inline-block;width:10px;height:10px;"></span> Архив'),
			));
		}
		
	}

?>
