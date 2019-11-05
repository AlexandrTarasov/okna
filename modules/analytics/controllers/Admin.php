<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

include_once MODULES_DIR.'atom/controllers/Atom.php';

class Admin extends Atom
{
			
    function __construct()
    {
        parent::__construct();
		if(!$this->auth->check_permission('Analytics')) redirect('/atom');
	}


    public function index()
    {
	    
	    
	   $data['labels'] = array(date('Y-n') => date('m.y'));
	   $empty = array(date('Y-n') => 0);
	   
	   for ($i = 1; $i < 12; $i++){
		  $empty[date('Y-n', strtotime("-$i month"))] = 0;
		  $data['labels'][date('Y-n', strtotime("-$i month"))] = date('m.y', strtotime("-$i month"));
	    } 	
	    		
		uksort($empty, function($k1, $k2){
			return strtotime($k1) - strtotime($k2);
		});
		
		uksort($data['labels'], function($k1, $k2){
			return strtotime($k1) - strtotime($k2);
		});
		
				
		$data['sales'] = $data['payments'] = $data['expenses'] = $empty;	
	    		    	
	    		    	
		foreach($this->db->query("
			SELECT extract(year from o.create_date) as year, extract(month from o.create_date) as month, SUM(o.total_price) amount
			FROM orders o
			WHERE  o.create_date >= date_sub(now(), interval 12 month)
			GROUP BY month, year")->result_array() as $row)
				$data['sales'][$row['year'].'-'.$row['month']] = number_format($row['amount'], 2, '.', '');
		
		
		    
		foreach($this->db->query("
			SELECT EXTRACT(year from DATE(op.date_receiving)) as year, EXTRACT(month from DATE(op.date_receiving)) as month, SUM(op.amount) amount
			FROM orders_payments op
			WHERE  op.date_receiving >= date_sub(now(), interval 12 month) AND op.type = 'income' AND op.status = 'received'
			GROUP BY month, year")->result_array() as $row)
				$data['payments'][$row['year'].'-'.$row['month']] = $row['amount'];

				
		foreach($this->db->query("
			SELECT EXTRACT(year from DATE(op.date_receiving)) as year, EXTRACT(month from DATE(op.date_receiving)) as month, SUM(op.amount) amount
			FROM orders_payments op
			WHERE  op.date_receiving >= date_sub(now(), interval 12 month) AND op.type = 'outgo' AND op.status = 'received'
			GROUP BY month, year")->result_array() as $row)
				$data['expenses'][$row['year'].'-'.$row['month']] = $row['amount'];

		
		
		$data['supplier_overpayments'] = $this->db->select('o.id, o.contract_number, o.readiness_date, o.address, o.gazda_price, COALESCE(SUM(op.amount), 0) received_amount, s.company_name as supplier_name, s.id supplier_id')->join('orders_payments op', 'op.user_id = o.supplier_id and op.type = "outgo" and op.user_type ="supplier" and op.order_id = o.id and op.status ="received"', 'left')->join('suppliers s', 's.id = o.supplier_id')->having('received_amount > gazda_price')->group_by('o.id')->where('o.status !=', 'archive')->get('orders o')->result_array();		
		
				 
		$data['supplier_underpayments'] = $this->db->select('o.id, o.contract_number, o.readiness_date, o.address, o.gazda_price, COALESCE(SUM(op.amount), 0) received_amount, s.company_name as supplier_name, s.id supplier_id')->join('orders_payments op', 'op.user_id = o.supplier_id and op.type = "outgo" and op.user_type ="supplier" and op.order_id = o.id and op.status ="received"', 'left')->join('suppliers s', 's.id = o.supplier_id')->having('received_amount < gazda_price')->group_by('o.id')->where('o.status !=', 'archive')->get('orders o')->result_array();		



		$data['waiting_moneys'] = $this->db->select('op.*')
										   ->where('op.status', 'sent')
										   ->order_by('op.id desc')->get('orders_payments op')->result_array();

		$data['last_payments'] = $this->db->select('op.*')->order_by('op.id desc')->get('orders_payments op', 50)->result_array();

									

        $data['header']['title'] = 'Аналитика';
		$this->renderer->view('atom', 'cards/analytics', $data);  
		              
    }

	
}



/* Orders module */
/* Developed by Perepelitsa Web Production */