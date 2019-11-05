<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

include_once MODULES_DIR.'atom/controllers/Atom.php';

class Admin extends Atom
{
			
    function __construct()
    {
        parent::__construct();
		if(!$this->auth->check_permission('OrdersPayments')) redirect('/atom');
	}


    public function add($order_id = null)
    {
		if(!$order_id) show_404();
	    
		$data['order'] = $this->db->select('id,client_id,installer_id,supplier_id,gauger_id,status')->where('id', $order_id)->get('orders',1)->row_array();
		if(empty($data['order'])) show_404();

	    if(($post = $this->input->post()))
	    {
		    			
			switch($post['user_type'])
			{
				case 'client':
					$post['user_id'] = $data['order']['client_id'];
				break;
				
				case 'installer':
					$post['user_id'] = $data['order']['installer_id'];
				break;
				
				case 'supplier':
					$post['user_id'] = $data['order']['supplier_id'];
				break;

				case 'gauger':
					$post['user_id'] = $data['order']['gauger_id'];
				break;
			}
			
			
			$post['date_create'] = date('Y-m-d', strtotime($post['date_create']));
			$post['date_receiving'] = date('Y-m-d', strtotime($post['date_receiving']));

			if($post['user_id'] > 0)
			{
			    $this->db->insert('orders_payments', array(
				    'type' => $post['type'],
				    'user_type' => $post['user_type'],
				    'method' => $post['method'],
				    'amount' => (int) $post['amount'],
				    'date_create' => date('Y-m-d', strtotime($post['date_create'])),
				    'date_receiving' => ($post['date_receiving'] != '' ? date('Y-m-d', strtotime($post['date_receiving'])) : NULL),
				    'comment' => $post['comment'],
				    'status' => $post['status'],
				    'user_id' => $post['user_id'],
				    'order_id' => $order_id,
			    ));
			    
			    
				if($this->db->affected_rows() > 0)
					$this->session->set_flashdata('alert_success', "оплата успешно добавлена к заказу №{$order_id}.");
				else
					$this->session->set_flashdata('alert_error', "оплата не добавлена, пожалуйста, попробуйте ещё раз.");
					
			} else 
				$this->session->set_flashdata('alert_error',  "мы не смогли добавить оплату, так как <strong>".($post['user_type'] == 'installer' ? 'монтажник' : 'поставщик')."</strong> не выбран.");
				

            redirect(site_url(MODULES_URL.'orders/view/'.$order_id));
            
	    } else {
			echo json_encode($this->load->view('atom/modals/orders_payments', $data, true));                
	    }
    }
    
    
    
    
    public function edit($id = null) 
    {
	    if(!$id) show_404();
	    
	    $data['payment'] = $this->db->where('id', $id)->get('orders_payments',1)->row_array();
	    if(empty($data['payment'])) show_404();		    
		
		$data['order'] = $this->db->select('id,client_id,installer_id,supplier_id,gauger_id,status')->where('id', $data['payment']['order_id'])->get('orders',1)->row_array();
		if(empty($data['order'])) show_404();
		    		    
	    
	    if(($post = $this->input->post())){
		    
			switch($post['user_type'])
			{
				case 'client':
					$post['user_id'] = $data['order']['client_id'];
				break;
				
				case 'installer':
					$post['user_id'] = $data['order']['installer_id'];
				break;
				
				case 'supplier':
					$post['user_id'] = $data['order']['supplier_id'];
				break;
				
				case 'gauger':
					$post['user_id'] = $data['order']['gauger_id'];
				break;
			}
		    


			$post['date_create'] = date('Y-m-d', strtotime($post['date_create']));
			$post['date_receiving'] = date('Y-m-d', strtotime($post['date_receiving']));



		    $this->db->update('orders_payments', array(
			    'type' => $post['type'],
			    'user_type' => $post['user_type'],
			    'method' => $post['method'],
			    'amount' => (int) $post['amount'],
			    'date_create' => date('Y-m-d', strtotime($post['date_create'])),
			    'date_receiving' => ($post['date_receiving'] != '' ? date('Y-m-d', strtotime($post['date_receiving'])) : NULL),
			    'comment' => $post['comment'],
			    'status' => $post['status'],
			    'user_id' => $post['user_id'],
			    'order_id' => $data['order']['id'],
		    ), array('id' => $post['id']));
		    		    
		    
			if($this->db->affected_rows() > 0)
				$this->session->set_flashdata('alert_success', "оплата успешно обновлена.");
			else
				$this->session->set_flashdata('alert_error', "оплата не обновлена, пожалуйста, попробуйте ещё раз.");

            redirect(site_url(MODULES_URL.'orders/view/'.$data['order']['id']));

            
	    } else {
		    
			echo json_encode($this->load->view('atom/modals/orders_payments', $data, true));                
	    }
    }    
       
    
    
    
    public function delete($id) 
    {	    
	    $data['payment'] = $this->db->where('id', $id)->get('orders_payments',1)->row_array();
	    if(empty($data['payment'])) show_404();		    
		
		$data['order'] = $this->db->select('id,client_id,installer_id,supplier_id,status')->where('id', $data['payment']['order_id'])->get('orders',1)->row_array();
		if(empty($data['order'])) show_404();
		    		    	    
	    
	    $this->db->delete('orders_payments', array('id' => $id));
	    
		if($this->db->affected_rows() == 0)
			$this->session->set_flashdata('alert_error', "оплата не удалена, пожалуйста, попробуйте ещё раз.");
		else
			$this->session->set_flashdata('alert_success', "оплата успешно удалена.");
			
		 redirect(site_url(MODULES_URL.'orders/view/'.$data['order']['id']));
    }

	
}



/* Orders module */
/* Developed by Perepelitsa Web Production */