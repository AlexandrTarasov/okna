<?php 	
	
	if($this->auth->check_permission('Export'))
	{
		
		$request_date = date('w') >= 5 ? date('Y-m-d', strtotime("next monday")) : date('Y-m-d', strtotime('+ 1 day'));
		
		$count = $this->db->where('o.removal_date', $request_date)->where('o.removal_request_sent', 0)->from('orders o')->count_all_results();
		
				
		$menu['main'][] = array('type' => 'item', 'link' => MODULES_URL.'export', 'title' => '<span class="badge badge-'.($count > 0 ? 'danger' : 'default').'">'.$count.'</span> Заявки на вывоз', 'active' => ($this->uri->segment(3) == 'export'), 'icon' => 'ion-paper-airplane');
	}
	
?>
