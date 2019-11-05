<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

include_once MODULES_DIR.'atom/controllers/Atom.php';

class Admin extends Atom
{
		
    function __construct()
    {
        parent::__construct();
        if(!$this->auth->check_permission('Roles')) redirect('/atom');

	}

    public function index()
    {
	    $page = $this->input->get('page') ? $this->input->get('page') : 1;
	    $where = '';
	    if(empty($where)) $where = '1 = 1';

		$this->db->where($where, null, false)->from('atom_roles a');
		$config['total_rows'] = $data['total_rows'] = $this->db->count_all_results();
		$config['base_url'] = base_url() . "/atom/module/atom_roles?";
		$config['first_url'] = base_url() . "/atom/module/atom_roles?\&page=1";
		$config['per_page'] = 100;

        $this->load->library('pagination');
		$this->pagination->initialize($config);
		$data['atom_roles'] = $this->db->select('a.*')->where($where)->get('atom_roles a', $config['per_page'], ($page - 1) * $config['per_page'])->result_array();
		
        $data['header']['title'] = 'Roles list';
		$this->renderer->view('atom', 'lists/roles', $data);        
    }

    public function add() 
    {
	    if($post = $this->input->post(null, true)){
		    $this->db->insert('atom_roles', $post);
		    
			if($this->db->affected_rows() > 0)
				$this->session->set_flashdata('alert_success', "record successfully added!");
			else
				$this->session->set_flashdata('alert_error', "record is not added. If the problem persists, please contact support.");

            redirect(site_url('/atom/module/atom_roles'));
            
	    } else {
	        $data['header']['title'] = 'Add Role item';
			$this->renderer->view('atom', 'forms/roles', $data);                
	    }

    }

    public function edit($id) 
    {
	    if($post = $this->input->post(null, true)){
		    $this->db->update('atom_roles', $post, array('id' => $id));
		    
			if($this->db->affected_rows() > 0)
				$this->session->set_flashdata('alert_success', "record #{$id} successfully updated!");
			else
				$this->session->set_flashdata('alert_error', "record #{$id} isn't updated. If the problem persists, please contact support.");

            redirect(site_url('/atom/module/atom_roles'));
            
	    } else {
		    
		    $data['atom_role'] = $this->db->get_where('atom_roles', array('id' => $id),1)->row_array();
		    if(empty($data['atom_role'])) show_404();
		    
	        $data['header']['title'] = 'Update Role item';
			$this->renderer->view('atom', 'forms/roles', $data);                
	    }
    }
    

    public function delete($id) 
    {
	    $this->db->delete('atom_roles', array('id' => $id));
	    
		if($this->db->affected_rows() == 0)
			$this->session->set_flashdata('alert_error', "record #{$id} isn't deleted. If the problem persists, please contact support.");
    }
	
}



/* Roles module */
/* Developed by Perepelitsa Web Production */