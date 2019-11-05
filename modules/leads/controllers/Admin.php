<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

include_once MODULES_DIR.'atom/controllers/Atom.php';

class Admin extends Atom
{
		
    function __construct()
    {
        parent::__construct();
		if(!$this->auth->check_permission('Leads')) redirect('/atom');
	}

    public function index()
    {
	    
		if(isset($_GET['date']) && $_GET['date'] != '') $_GET['date'] = date('Y-m-d', strtotime($_GET['date']));
	    
		$this->load->library('filters');
		list($page, $where, $filters) = $this->filters->get_all('l', 'leads');			
	    if(empty($where)) $where = '1 = 1';

		$this->db->where($where, null, false)->from('leads l');
		$config['total_rows'] = $data['total_rows'] = $this->db->count_all_results();
		$config['base_url'] = base_url() . "/atom/module/leads?".http_build_query($filters, '', '&');
		$config['first_url'] = base_url() . "/atom/module/leads?".http_build_query($filters, '', '&')."&page=1";
		$config['per_page'] = 100;

        $this->load->library('pagination');
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();		
		$data['leads'] = $this->db->select('l.*, c.name as client_name, o.id as order_number')->order_by('l.id DESC')->join('clients c', 'c.id = l.client_id', 'left')->join('orders o', 'o.lead_id = l.id', 'left')->where($where)->get('leads l', $config['per_page'], ($page - 1) * $config['per_page'])->result_array();
		
        $data['header']['title'] = 'Лиды';
		$this->renderer->view('atom', 'lists/leads', $data);        
    }

    public function view($id) 
    {
		$data['lead'] = $this->db->get_where('leads', array('id' => $id))->row_array();
		if(empty($data['lead'])) show_404();

        $data['header']['title'] = 'Лид №'.$data['lead']['id'];
		$this->renderer->view('atom', 'cards/leads', $data);        
    } 

    public function add() 
    {
	    if($post = $this->input->post(null, true)){
		    
		    
		    if(!isset($post['client_id']) || !$post['client_id']){
			    $this->db->insert('clients', array(
			    	'name' => $post['name'],
			    	'phone' =>  preg_replace('~[^0-9]+~', '', $post['phone']),
			    	'phone2' =>  preg_replace('~[^0-9]+~', '', $post['phone2']),
			    	'viber' =>  preg_replace('~[^0-9]+~', '', $post['viber']),
			    	'email' => $post['email'],
			    	'address' => $post['address'],
			    ));
			    
			    $post['client_id'] = $this->db->insert_id();
			}
		    
		    $post['date'] = date('Y-m-d', strtotime($post['date']));
		    
		    
		    
		    if($post['client_id'])
		    {
			    $this->db->insert('leads', array('client_id' => $post['client_id'], 'address' => $post['address'], 'comment' => $post['comment'], 'source' => $post['source'], 'date' => $post['date'], 'status' => $post['status']));
			    
				if($this->db->affected_rows() > 0)
					$this->session->set_flashdata('alert_success', "record successfully added!");
				else
					$this->session->set_flashdata('alert_error', "record is not added. If the problem persists, please contact support.");
		
			} else 
				$this->session->set_flashdata('alert_error', "Неизвестный клиент");


            redirect(site_url('/atom/module/leads'));
            
	    } else {
	        $data['footer']['js_libs'] = array('/public/jquery.maskedinput.min.js');
			$data['footer']['js_code'] = "$('input.j-phone').mask('+38 (099) 999-99-99');";

	        $data['header']['title'] = 'Новый лид';
			$this->renderer->view('atom', 'forms/leads', $data);                
	    }

    }

    public function edit($id) 
    {
	    if($post = $this->input->post(null, true)){
		    
		    
		    if(!isset($post['client_id']) || !$post['client_id']){
			    
			    $this->db->insert('clients', array(
			    	'name' => $post['name'],
			    	'phone' =>  preg_replace('~[^0-9]+~', '', $post['phone']),
			    	'phone2' =>  preg_replace('~[^0-9]+~', '', $post['phone2']),
			    	'viber' =>  preg_replace('~[^0-9]+~', '', $post['viber']),
			    	'email' => $post['email'],
			    	'address' => $post['address'],
			    ));
			    
			    $post['client_id'] = $this->db->insert_id();
			}
		    
		    $post['date'] = date('Y-m-d', strtotime($post['date']));
		    
		    
		    if($post['client_id'])
		    {
			    $this->db->update('leads', array('client_id' => $post['client_id'], 'address' => $post['address'], 'comment' => $post['comment'], 'source' => $post['source'], 'date' => $post['date'], 'status' => $post['status']), array('id' => $id));
			    
				if($this->db->affected_rows() > 0)
					$this->session->set_flashdata('alert_success', "record #{$id} successfully updated!");
				else
					$this->session->set_flashdata('alert_error', "record #{$id} isn't updated. If the problem persists, please contact support.");
			} else 
				$this->session->set_flashdata('alert_error', "Неизвестный клиент");


            redirect(site_url('/atom/module/leads'));
            
	    } else {
		    
		    $data['lead'] = $this->db->get_where('leads', array('id' => $id),1)->row_array();
		    if(empty($data['lead'])) show_404();
		    
		    
		    $data['client'] = $this->db->select('name,phone,phone2,viber,email')->where('id', $data['lead']['client_id'])->get('clients', 1)->row_array();
		    
		    
	        $data['footer']['js_libs'] = array('/public/jquery.maskedinput.min.js');
			$data['footer']['js_code'] = "$('input.j-phone').mask('+38 (099) 999-99-99');";		    
		    
	        $data['header']['title'] = 'Редактировать лид';
			$this->renderer->view('atom', 'forms/leads', $data);                
	    }
    }

    public function delete($id) 
    {
	    $this->db->delete('leads', array('id' => $id));
	    
		if($this->db->affected_rows() == 0)
			$this->session->set_flashdata('alert_error', "record #{$id} isn't deleted. If the problem persists, please contact support.");
    }
	
	
	
    public function filters($name)
    {
		$response = array();		
		switch($name)
		{			

			case 'status':
				$response[] = array('value' => 'new', 'text' => 'Новый');
				$response[] = array('value' => 'processing', 'text' => 'В обработке');
				$response[] = array('value' => 'accepted', 'text' => 'Принят');
				$response[] = array('value' => 'canceled', 'text' => 'Отменен');
				array_unshift($response, array('value' => '', 'text' => 'Все'));
			break;
			
			case 'clients':
				$response = $this->db->query('SELECT id as value, name as text FROM clients ORDER BY name ASC')->result_array();
				array_unshift($response, array('value' => '', 'text' => 'Все'));
			break;
			
			case 'source':
				$response[] = array('value' => 'call', 'text' => 'Звонок');
				$response[] = array('value' => 'adwords', 'text' => 'AdWords');
				$response[] = array('value' => 'facebook', 'text' => 'Facebook');
				$response[] = array('value' => 'instagram', 'text' => 'Instagram');
				$response[] = array('value' => 'youtube', 'text' => 'Youtube');
				$response[] = array('value' => 'recommendation', 'text' => 'Рекомендация');
				array_unshift($response, array('value' => '', 'text' => 'Все'));
			break;
			
			
		}
	    echo json_encode($response);
    }
    
	
	
	
}



/* Leads module */
/* Developed by Perepelitsa Web Production */