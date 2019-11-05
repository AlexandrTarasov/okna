<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

include_once MODULES_DIR.'atom/controllers/Atom.php';

class Admin extends Atom
{
		
    function __construct()
    {
        parent::__construct();
        
		if(!$this->auth->check_permission('Users')) redirect('/atom');
		
		$this->lang->load('atom_users/atom_users', $this->language);	
	}

    public function index()
    {
	    
		$this->load->library('filters');
		list($page, $where, $filters) = $this->filters->get_all('a', 'atom_users');			
	    if(empty($where)) $where = '1 = 1';

		$this->db->where($where, null, false)->from('atom_users a');
		$config['total_rows'] = $data['total_rows'] = $this->db->count_all_results();
		$config['base_url'] = base_url() . "/atom/module/atom_users?".http_build_query($filters, '', '&');
		$config['first_url'] = base_url() . "/atom/module/atom_users?".http_build_query($filters, '', '&')."&page=1";
		$config['per_page'] = 100;

        $this->load->library('pagination');
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();		
		$data['atom_users'] = $this->db->select('a.*, ar.name role_name')->join('atom_roles ar', 'ar.id = a.role_id and ar.name != "Developer"')->order_by('a.id ASC')->where($where)->get('atom_users a', $config['per_page'], ($page - 1) * $config['per_page'])->result_array();
		
        $data['header']['title'] = lang('au_title');
		$this->renderer->view('atom', 'lists/users', $data);        
    }

    public function add() 
    {
	    if($post = $this->input->post(null, true)){
		    		    
		    
		    
		    // Only in new versions of Atom
		    if(method_exists($this->auth, 'get_system_role'))
		    {
			   $roles = $this->auth->get_system_roles();
		    } else {
				$roles = array();
					
				foreach($this->db->select('id,name')->get('atom_roles')->result_array() as $role)
					$roles[$role['name']] = $role['id'];					
		    }	    
		    
		    
		    		    		    		    
			if($post['role_id'] == $roles['Developer'] && !$this->auth->check_permission('UsersCreateDeveloper'))
			{
			   	die("You don't have permission to create users with developer rights.");			   
			}
		   

		    
			$post['username_hash'] = $this->auth->hashing_data($post['username']);
			$post['password'] = $this->auth->hashing_data($post['password']);
		    
		    $this->db->insert('atom_users', $post);
		    
			if($this->db->affected_rows() > 0)
				$this->session->set_flashdata('alert_success', "<strong>Success: </strong> record successfully added!");
			else
				$this->session->set_flashdata('alert_error', "<strong>Error: </strong> record is not added. If the problem persists, please contact support.");

            redirect(site_url('/atom/module/atom_users'));
            
	    } else {
			$data['roles'] = $this->db->select('id,name')->get('atom_roles')->result_array();
	        $data['header']['title'] = lang('au_title');
			$this->renderer->view('atom', 'forms/users', $data);                
	    }

    }

    public function edit($id) 
    {
	    if($post = $this->input->post(null, true)){
		    
		    
		    // Only in new versions of Atom
		    if(method_exists($this->auth, 'get_system_role'))
		    {
			   $roles = $this->auth->get_system_roles();
		    } else {
				$roles = array();
					
				foreach($this->db->select('id,name')->get('atom_roles')->result_array() as $role)
					$roles[$role['name']] = $role['id'];					
		    }	    
		    
		    
		    		    		    		    
			if($post['role_id'] == $roles['Developer'] && !$this->auth->check_permission('UsersCreateDeveloper'))
			{
			   	die("You don't have permission to create users with developer rights.");			   
			}
		   		    
		    
			$post['username_hash'] = $this->auth->hashing_data($post['username']);
			
			
			if($post['password'] != '')
				$post['password'] = $this->auth->hashing_data($post['password']);
			else 
				unset($post['password']);

		    
		    $this->db->update('atom_users', $post, array('id' => $id));
		    
			if($this->db->affected_rows() > 0)
				$this->session->set_flashdata('alert_success', "<strong>Success: </strong> record #{$id} successfully updated!");
			else
				$this->session->set_flashdata('alert_error', "<strong>Error: </strong> record #{$id} isn't updated. If the problem persists, please contact support.");

            redirect(site_url('/atom/module/atom_users'));
            
	    } else {
		    
		    $data['atom_user'] = $this->db->get_where('atom_users', array('id' => $id),1)->row_array();
		    if(empty($data['atom_user'])) show_404();
		    
			$data['roles'] = $this->db->select('id,name')->get('atom_roles')->result_array();
	        $data['header']['title'] = lang('au_title');
			$this->renderer->view('atom', 'forms/users', $data);                
	    }
    }

    public function delete($id) 
    {
	    $this->db->delete('atom_users', array('id' => $id));
	    
		if($this->db->affected_rows() == 0)
			$this->session->set_flashdata('alert_error', "<strong>Error: </strong> record #{$id} isn't deleted. If the problem persists, please contact support.");
    }
	
}



/* Users module */
/* Developed by Perepelitsa Web Production */