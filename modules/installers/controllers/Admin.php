<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

include_once MODULES_DIR.'atom/controllers/Atom.php';

class Admin extends Atom
{
		
    function __construct()
    {
        parent::__construct();
	}

    public function index()
    {
		if(!$this->auth->check_permission('Installers')) redirect('/atom');

		if(isset($_GET['phone']) && $_GET['phone'] != '') $_GET['phone'] = preg_replace('~[^0-9]+~', '', $_GET['phone']);
		if(isset($_GET['phone2']) && $_GET['phone2'] != '') $_GET['phone2'] = preg_replace('~[^0-9]+~', '', $_GET['phone2']);
		if(isset($_GET['viber']) && $_GET['viber'] != '') $_GET['viber'] = preg_replace('~[^0-9]+~', '', $_GET['viber']);

		$this->load->library('filters');
		list($page, $where, $filters) = $this->filters->get_all('i', 'installers');			
	    if(empty($where)) $where = '1 = 1';

		$this->db->where($where, null, false)->from('installers i');
		$config['total_rows'] = $data['total_rows'] = $this->db->count_all_results();
		$config['base_url'] = base_url() . "/atom/module/installers?".http_build_query($filters, '', '&');
		$config['first_url'] = base_url() . "/atom/module/installers?".http_build_query($filters, '', '&')."&page=1";
		$config['per_page'] = 100;

        $this->load->library('pagination');
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();		
		$data['installers'] = $this->db->select('i.*, au.username atom_username')->order_by('i.id ASC')->join('atom_users au', 'au.id = i.atom_user_id and au.role_id = 1')->where($where)->get('installers i', $config['per_page'], ($page - 1) * $config['per_page'])->result_array();
		
        $data['header']['title'] = 'Монтажники';
		$this->renderer->view('atom', 'lists/installers', $data);        
    }

    public function view($id) 
    {
		if(!$this->auth->check_permission('Installers')) redirect('/atom');

		$data['installer'] = $this->db->select('i.*, au.username atom_username')->join('atom_users au', 'au.id = i.atom_user_id and au.role_id = 1')->get_where('installers i', array('i.id' => $id))->row_array();
		if(empty($data['installer'])) show_404();


		$data['orders'] = $this->db->select('o.id, o.contract_number, o.montage_date, o.montage_price, COALESCE(SUM(op.amount), 0) received_amount, o.address')->join('orders_payments op', 'op.user_id = o.installer_id and op.type = "outgo" and op.user_type ="installer" and op.order_id = o.id', 'left')->group_by('o.id')->where('o.installer_id', $id)->get('orders o')->result_array();

		
		$data['payments'] = $this->db->where('user_type', 'installer')->where('user_id', $id)->order_by('id desc')->get('orders_payments op')->result_array();
				
        $data['header']['title'] = 'Монтажник ' . $data['installer']['name'];
		$this->renderer->view('atom', 'cards/installers', $data);        
    } 


    public function add() 
    {
		if(!$this->auth->check_permission('Installers')) redirect('/atom');
	    
	    if($post = $this->input->post(null, true)){
		    
		    
			if($this->db->where('username', $post['username'])->get('atom_users')->num_rows() == 0) 
			{
				
				$this->db->insert('atom_users', array(
					'username' => $post['username'],
					'username_hash' => $this->auth->hashing_data($post['username']),
					'password' => $this->auth->hashing_data($post['password']),
					'email' => htmlspecialchars($post['email']),
					'role_id' => 1
				));
				
				
				if($this->db->affected_rows() > 0)
				{
						
				    $this->db->insert('installers', array(
				    	'atom_user_id' => $this->db->insert_id(),
				    	'name' => $post['name'],
				    	'phone' => $post['phone'],
				    	'phone2' => $post['phone2'],
				    	'viber' => $post['viber'],
				    	'address' => $post['address'],
				    	'email' => $post['email'],
				    	'comment' => $post['comment'],
				    ));
				    
				    
					if($this->db->affected_rows() > 0)
						$this->session->set_flashdata('alert_success', "record successfully added!");
					else
						$this->session->set_flashdata('alert_error', "record is not added. If the problem persists, please contact support.");
					
					
				
				} else
					$this->session->set_flashdata('alert_error', "мы не смогли зарегистрировать пользователя в системе, пожалуйста, попробуйте ещё раз.");
					
			} else 
				$this->session->set_flashdata('alert_error', "пользователь с таким логином уже существует. Попробуйте использовать другой логин для входа в систему.");
		    
		    
            redirect(site_url('/atom/module/installers'));
            
	    } else {
	        $data['header']['title'] = 'Добавить монтажника';
	        $data['footer']['js_libs'] = array('/public/jquery.maskedinput.min.js');
			$data['footer']['js_code'] = "$('input.j-phone').mask('+38 (099) 999-99-99');";

			$this->renderer->view('atom', 'forms/installers', $data);                
	    }

    }

    public function edit($id) 
    {
		if(!$this->auth->check_permission('Installers')) redirect('/atom');
	    
	    if($post = $this->input->post(null, true)){
		    
		    
		    if(isset($post['password']) && $post['password'] != '')
		    	$this->db->update('atom_users', array('password' => $this->auth->hashing_data($post['password'])), array('role_id' => 1, 'id' => $post['atom_user_id']));
		    
		    
		    $this->db->update('installers', array(
		    	'name' => $post['name'],
		    	'phone' => $post['phone'],
		    	'phone2' => $post['phone2'],
		    	'viber' => $post['viber'],
		    	'address' => $post['address'],
		    	'email' => $post['email'],
		    	'comment' => $post['comment'],
			), array('id' => $id));
		    
			if($this->db->affected_rows() > 0)
				$this->session->set_flashdata('alert_success', "record #{$id} successfully updated!");
			else
				$this->session->set_flashdata('alert_error', "record #{$id} isn't updated. If the problem persists, please contact support.");

            redirect(site_url('/atom/module/installers'));
            
	    } else {
		    
		    $data['installer'] = $this->db->get_where('installers', array('id' => $id),1)->row_array();
		    if(empty($data['installer'])) show_404();
		    
		    
		    $data['atom_user'] = $this->db->select('username')->where('id', $data['installer']['atom_user_id'])->where('role_id', 1)->get('atom_users', 1)->row_array();
		    
		    
	        $data['header']['title'] = 'Редактирование монтажника';
	        $data['footer']['js_libs'] = array('/public/jquery.maskedinput.min.js');
			$data['footer']['js_code'] = "$('input.j-phone').mask('+38 (099) 999-99-99');";

			$this->renderer->view('atom', 'forms/installers', $data);                
	    }
    }

    public function delete($id) 
    {
		if(!$this->auth->check_permission('Installers')) redirect('/atom');

	    $this->db->delete('installers', array('id' => $id));
	    
		if($this->db->affected_rows() == 0)
			$this->session->set_flashdata('alert_error', "record #{$id} isn't deleted. If the problem persists, please contact support.");
    }
	
	
	
	public function cabinet()
	{
		if($this->auth->get_user_role() != 1) redirect('/atom');
		
		$data['installer'] = $this->db->select('i.*, au.username atom_username')->join('atom_users au', 'au.id = i.atom_user_id and au.role_id = 1')->get_where('installers i', array('i.atom_user_id' => $this->auth->user['id']))->row_array();
		if(empty($data['installer'])) show_404();


		$data['orders'] = $this->db->select('o.id, o.contract_number, o.montage_date, o.montage_price, COALESCE(SUM(op.amount), 0) received_amount, o.address')->join('orders_payments op', 'op.user_id = o.installer_id and op.type = "outgo" and op.user_type ="installer" and op.order_id = o.id', 'left')->group_by('o.id')->where('o.installer_id', $data['installer']['id'])->get('orders o')->result_array();

		
		$data['payments'] = $this->db->where('user_type', 'installer')->where('user_id', $data['installer']['id'])->order_by('id desc')->get('orders_payments op')->result_array();
				
        $data['header']['title'] = 'Личный кабинет';
		$this->renderer->view('atom', 'cards/cabinet', $data);        
	}


}



/* Installers module */
/* Developed by Perepelitsa Web Production */