<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

include_once MODULES_DIR.'atom/controllers/Atom.php';

class Admin extends Atom
{
		
    function __construct()
    {
        parent::__construct();
		if(!$this->auth->check_permission('Clients')) redirect('/atom');
	}

    public function index()
    {
		if(isset($_GET['phone']) && $_GET['phone'] != '') $_GET['phone'] = preg_replace('~[^0-9]+~', '', $_GET['phone']);
		if(isset($_GET['phone2']) && $_GET['phone2'] != '') $_GET['phone2'] = preg_replace('~[^0-9]+~', '', $_GET['phone2']);
		if(isset($_GET['viber']) && $_GET['viber'] != '') $_GET['viber'] = preg_replace('~[^0-9]+~', '', $_GET['viber']);

		
		$this->load->library('filters');
		list($page, $where, $filters) = $this->filters->get_all('c', 'clients');			
	    if(empty($where)) $where = '1 = 1';

		$this->db->where($where, null, false)->from('clients c');
		$config['total_rows'] = $data['total_rows'] = $this->db->count_all_results();
		$config['base_url'] = base_url() . "/atom/module/clients?".http_build_query($filters, '', '&');
		$config['first_url'] = base_url() . "/atom/module/clients?".http_build_query($filters, '', '&')."&page=1";
		$config['per_page'] = 100;

        $this->load->library('pagination');
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();		
		$data['clients'] = $this->db->select('c.*')->order_by('c.id ASC')->where($where)->get('clients c', $config['per_page'], ($page - 1) * $config['per_page'])->result_array();
		
        $data['header']['title'] = 'Список клиентов';
		$this->renderer->view('atom', 'lists/clients', $data);        
    }

    public function view($id) 
    {
		$data['client'] = $this->db->get_where('clients', array('id' => $id))->row_array();
		if(empty($data['client'])) show_404();


		$data['orders'] = $this->db->select('o.id, o.contract_number, o.readiness_date, i.name as installer_name, o.address, o.total_price, COALESCE(SUM(op.amount), 0) received_amount')->join('orders_payments op', ' op.type = "income" and op.user_type ="client" and op.order_id = o.id and op.status ="received"', 'left')->join('installers i', 'i.id = o.installer_id', 'left')->group_by('o.id')->where('o.client_id', $id)->get('orders o')->result_array();
		

		$data['payments'] = $this->db->where('user_type', 'client')->where('user_id', $id)->order_by('id desc')->get('orders_payments op')->result_array();

        $data['header']['title'] = 'Клиент';
		$this->renderer->view('atom', 'cards/clients', $data);        
    } 

    public function add() 
    {
	    if($post = $this->input->post(null, true)){
		    
		    $post['phone'] = preg_replace('~[^0-9]+~', '', $post['phone']);
		    $post['phone2'] = preg_replace('~[^0-9]+~', '', $post['phone2']);
		    $post['viber'] = preg_replace('~[^0-9]+~', '', $post['viber']);		    


		    $this->db->insert('clients', $post);

			if($this->db->affected_rows() > 0)
				$this->session->set_flashdata('alert_success', "record successfully added!");
			else
				$this->session->set_flashdata('alert_error', "record is not added. If the problem persists, please contact support.");

            redirect(site_url('/atom/module/clients'));
            
	    } else {
	        $data['header']['title'] = 'Добавить клиента';
	        $data['footer']['js_libs'] = array('/public/jquery.maskedinput.min.js');
			$data['footer']['js_code'] = "$('input.j-phone').mask('+38 (099) 999-99-99');";

			$this->renderer->view('atom', 'forms/clients', $data);                
	    }

    }

    public function edit($id) 
    {
	    if($post = $this->input->post(null, true)){
		    
		    $post['phone'] = preg_replace('~[^0-9]+~', '', $post['phone']);
		    $post['phone2'] = preg_replace('~[^0-9]+~', '', $post['phone2']);
		    $post['viber'] = preg_replace('~[^0-9]+~', '', $post['viber']);		    

		    		    
		    $this->db->update('clients', $post, array('id' => $id));
		    
			if($this->db->affected_rows() > 0)
				$this->session->set_flashdata('alert_success', "record #{$id} successfully updated!");
			else
				$this->session->set_flashdata('alert_error', "record #{$id} isn't updated. If the problem persists, please contact support.");

            redirect(site_url('/atom/module/clients'));
            
	    } else {
		    
		    $data['client'] = $this->db->get_where('clients', array('id' => $id),1)->row_array();
		    if(empty($data['client'])) show_404();
	        $data['footer']['js_libs'] = array('/public/jquery.maskedinput.min.js');
			$data['footer']['js_code'] = "$('input.j-phone').mask('+38 (099) 999-99-99');";

	        $data['header']['title'] = 'Редактирование клиента';
			$this->renderer->view('atom', 'forms/clients', $data);                
	    }
    }


    public function delete($id) 
    {
	    $this->db->delete('clients', array('id' => $id));
	    
		if($this->db->affected_rows() == 0)
			$this->session->set_flashdata('alert_error', "record #{$id} isn't deleted. If the problem persists, please contact support.");
    }
    
    
    public function ajax($action)
    {
	    
	    switch($action)
	    {
		    
		    case 'search_for_client':
		    	
		    	
		    	if(($post = $this->input->post()))
		    	{
			    	// cleanup phones
			    	if(in_array($post['input'], array('phone', 'phone2', 'viber')))  $post['value'] = preg_replace('~[^0-9]+~', '', $post['value']);
					
								    	
			    	$clients = $this->db->select('id,name,phone,phone2,viber,email,address')->like($post['input'], $post['value'])->get('clients')->result_array();
			    	echo json_encode($clients);
			    	
			    	
		    	} else
			    	die('Error: empty request');
		    			    
		    break;
		    
		    
		    
	    }
	    
	    
    }
    
    
    
	
}



/* clients module */
/* Developed by Perepelitsa Web Production */