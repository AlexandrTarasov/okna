<?php

$string = "<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

include_once MODULES_DIR.'atom/controllers/Atom.php';

class Admin extends Atom
{
		
    function __construct()
    {
        parent::__construct();
        
	}";


// List View
if(isset($module_admin_views) && in_array('list', $module_admin_views)){
    
    if(isset($module_admin_filters) && $module_admin_filters == 'on')
    {
		$string .= "\n\n    public function index()
    {
	    
		\$this->load->library('filters');
		list(\$page, \$where, \$filters) = \$this->filters->get_all('".$db_table_name[0]."', '$db_table_name');			
	    if(empty(\$where)) \$where = '1 = 1';

		\$this->db->where(\$where, null, false)->from('$db_table_name ".$db_table_name[0]."');
		\$config['total_rows'] = \$data['total_rows'] = \$this->db->count_all_results();
		\$config['base_url'] = base_url() . \"".MODULES_URL.$module_name_right."?\".http_build_query(\$filters, '', '&');
		\$config['first_url'] = base_url() . \"".MODULES_URL.$module_name_right."?\".http_build_query(\$filters, '', '&').\"&page=1\";
		\$config['per_page'] = 100;

        \$this->load->library('pagination');
		\$this->pagination->initialize(\$config);
		\$data['pagination'] = \$this->pagination->create_links();		
		\$data['$db_table_name'] = \$this->db->select('".$db_table_name[0].".*')->order_by('".$db_table_name[0].".id ASC')->where(\$where)->get('$db_table_name ".$db_table_name[0]."', \$config['per_page'], (\$page - 1) * \$config['per_page'])->result_array();
		
        \$data['header']['title'] = '".plural($module_name)." list';
		\$this->renderer->view('atom', 'lists/$module_name_right', \$data);        
    }";

    } else {
	    
		$string .= "\n\n    public function index()
    {
	    \$page = \$this->input->get('page') ? \$this->input->get('page') : 1;
	    \$where = '';
	    if(empty(\$where)) \$where = '1 = 1';

		\$this->db->where(\$where, null, false)->from('$db_table_name ".$db_table_name[0]."');
		\$config['total_rows'] = \$data['total_rows'] = \$this->db->count_all_results();
		\$config['base_url'] = base_url() . \"".MODULES_URL.$module_name_right."?\";
		\$config['first_url'] = base_url() . \"".MODULES_URL.$module_name_right."?\&page=1\";
		\$config['per_page'] = 100;

        \$this->load->library('pagination');
		\$this->pagination->initialize(\$config);
		\$data['$db_table_name'] = \$this->db->select('".$db_table_name[0].".*')->where(\$where)->get('$db_table_name ".$db_table_name[0]."', \$config['per_page'], (\$page - 1) * \$config['per_page'])->result_array();
		
        \$data['header']['title'] = '".plural($module_name)." list';
		\$this->renderer->view('atom', 'lists/$module_name_right', \$data);        
    }";
	    
	    
    }
    
    
    
    
}


// Card View
if(isset($module_admin_views) && in_array('card', $module_admin_views)){    
$string .= "\n\n    public function view(\$id) 
    {
		\$data['$db_table_name_single'] = \$this->db->get_where('$db_table_name', array('id' => \$id))->row_array();
		if(empty(\$data['$db_table_name_single'])) show_404();

        \$data['header']['title'] = '".singular($module_name)." item';
		\$this->renderer->view('atom', 'cards/$module_name_right', \$data);        
    } ";
}

// Create Action
if(isset($module_actions) && in_array('add', $module_actions)){    
$string .= "\n\n    public function add() 
    {
	    if(\$post = \$this->input->post(null, true)){
		    \$this->db->insert('$db_table_name', \$post);
		    
			if(\$this->db->affected_rows() > 0)
				\$this->session->set_flashdata('alert_success', \"record successfully added!\");
			else
				\$this->session->set_flashdata('alert_error', \"record is not added. If the problem persists, please contact support.\");

            redirect(site_url('".MODULES_URL.$module_name_right."'));
            
	    } else {
	        \$data['header']['title'] = 'Add ".singular($module_name)." item';
			\$this->renderer->view('atom', 'forms/$module_name_right', \$data);                
	    }

    }";
}


// Edit Action
if(isset($module_actions) && in_array('edit', $module_actions)){      
$string .= "\n\n    public function edit(\$id) 
    {
	    if(\$post = \$this->input->post(null, true)){
		    \$this->db->update('$db_table_name', \$post, array('id' => \$id));
		    
			if(\$this->db->affected_rows() > 0)
				\$this->session->set_flashdata('alert_success', \"record #{\$id} successfully updated!\");
			else
				\$this->session->set_flashdata('alert_error', \"record #{\$id} isn't updated. If the problem persists, please contact support.\");

            redirect(site_url('".MODULES_URL.$module_name_right."'));
            
	    } else {
		    
		    \$data['$db_table_name_single'] = \$this->db->get_where('$db_table_name', array('id' => \$id),1)->row_array();
		    if(empty(\$data['$db_table_name_single'])) show_404();
		    
	        \$data['header']['title'] = 'Update ".singular($module_name)." item';
			\$this->renderer->view('atom', 'forms/$module_name_right', \$data);                
	    }
    }";
 }
 
// Delete Action    
if(isset($module_actions) && in_array('delete', $module_actions)){      
$string .= "\n\n    public function delete(\$id) 
    {
	    \$this->db->delete('$db_table_name', array('id' => \$id));
	    
		if(\$this->db->affected_rows() == 0)
			\$this->session->set_flashdata('alert_error', \"record #{\$id} isn't deleted. If the problem persists, please contact support.\");
    }
	";
}


$string .= "
}";


$string .= "\n\n\n\n/* $module_name module */
/* Developed by $module_author */";


echo $string;



?>