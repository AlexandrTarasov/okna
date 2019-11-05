<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

include_once MODULES_DIR.'atom/controllers/Atom.php';

class Admin extends Atom
{
		
    function __construct()
    {
        parent::__construct();
		if(!$this->auth->check_permission('Permissions')) redirect('/atom');
	}

    public function index()
    {
	    
		$this->load->library('filters');
		list($page, $where, $filters) = $this->filters->get_all('a', 'atom_permissions');			
	    if(empty($where)) $where = '1 = 1';

		$this->db->where($where, null, false)->from('atom_permissions a');
		$config['total_rows'] = $data['total_rows'] = $this->db->count_all_results();
		$config['base_url'] = base_url() . "/atom/module/atom_permissions?".http_build_query($filters, '', '&');
		$config['first_url'] = base_url() . "/atom/module/atom_permissions?".http_build_query($filters, '', '&')."&page=1";
		$config['per_page'] = 100;

        $this->load->library('pagination');
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();		
		$data['atom_permissions'] = $this->db->select('a.*')->order_by('a.name ASC')->where($where)->get('atom_permissions a', $config['per_page'], ($page - 1) * $config['per_page'])->result_array();
		
        $data['header']['title'] = 'Permissions list';
		$this->renderer->view('atom', 'lists/permissions', $data);        
    }

    public function add() 
    {
	    if($post = $this->input->post(null, true)){
		    $this->db->insert('atom_permissions', $post);
		    
			if($this->db->affected_rows() > 0)
				$this->session->set_flashdata('alert_success', "record successfully added!");
			else
				$this->session->set_flashdata('alert_error', "record is not added. If the problem persists, please contact support.");

            redirect(site_url('/atom/module/atom_permissions'));
            
	    } else {
	        $data['header']['title'] = 'Add Permission item';
			$this->renderer->view('atom', 'forms/permissions', $data);                
	    }

    }

    public function edit($id) 
    {
	    if($post = $this->input->post(null, true)){
		    $this->db->update('atom_permissions', $post, array('id' => $id));
		    
			if($this->db->affected_rows() > 0)
				$this->session->set_flashdata('alert_success', "record #{$id} successfully updated!");
			else
				$this->session->set_flashdata('alert_error', "record #{$id} isn't updated. If the problem persists, please contact support.");

            redirect(site_url('/atom/module/atom_permissions'));
            
	    } else {
		    
		    $data['atom_permission'] = $this->db->get_where('atom_permissions', array('id' => $id),1)->row_array();
		    if(empty($data['atom_permission'])) show_404();
		    
	        $data['header']['title'] = 'Update Permission item';
			$this->renderer->view('atom', 'forms/permissions', $data);                
	    }
    }
    
    
    
    public function matrix()
    {
	    
	    $data['roles_permissions'] = array();
	    $data['roles'] = $this->db->get('atom_roles')->result_array();
	    $data['permissions'] = $this->db->get('atom_permissions')->result_array();
	    
	    foreach($this->db->get('atom_roles_permissions')->result_array() as $row)
	    	$data['roles_permissions'][$row['role_id']][] = $row['permission_id'];
	    
	    
		$data['header']['title'] = 'Permission Matrix';
		$this->renderer->view('atom', 'forms/matrix', $data);                
	    
    }
    
    
    public function matrix_update()
	{
		
		if($this->input->post())
		{
			$post = $this->input->post();
			
			if($post['status'] == 'true')
				$this->db->insert('atom_roles_permissions', array('role_id' => $post['role'], 'permission_id' => $post['permission']));				
			else		
				$this->db->delete('atom_roles_permissions', array('role_id' => $post['role'], 'permission_id' => $post['permission']));

		}
		

		
	}    
    
    
    

    public function delete($id) 
    {
	    $this->db->delete('atom_permissions', array('id' => $id));
	    
		if($this->db->affected_rows() == 0)
			$this->session->set_flashdata('alert_error', "record #{$id} isn't deleted. If the problem persists, please contact support.");
    }
	
}



/* Permission module */
/* Developed by Perepelitsa Web Production */