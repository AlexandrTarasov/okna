<?php 	
	
	
	if($this->auth->check_permission('Balance.Menu'))
	{
		$this->ci = get_instance(); // CI_Loader instance
		$this->ci->load->model('atom_balance/atom_balance_model');
		$balance = $this->atom_balance_model->get_balance();
		
		
		$menu['right'][] = array('type' => 'item', 'class' => ($balance['invoice_value'] > 0 ? 'text-danger' : 'text-success'), 'link' => '#', 'title' => ($balance['invoice_value'] > 0 ? '-' : "") . number_format($balance['invoice_value'],2) .  $balance['currency_symbol'], 'active' => ($this->uri->segment(3) == 'balance'), 'icon' => 'fa fa-shopping-cart');
	}
?>
