<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

include_once MODULES_DIR.'atom/controllers/Atom.php';

class Admin extends Atom
{
		
    function __construct()
    {
        parent::__construct();
		if(!$this->auth->check_permission('Suppliers')) redirect('/atom');
	}

    public function index()
    {
		if(isset($_GET['manager_phone']) && $_GET['manager_phone'] != '') $_GET['manager_phone'] = preg_replace('~[^0-9]+~', '', $_GET['manager_phone']);
		if(isset($_GET['viber']) && $_GET['viber'] != '') $_GET['viber'] = preg_replace('~[^0-9]+~', '', $_GET['viber']);

		$this->load->library('filters');
		list($page, $where, $filters) = $this->filters->get_all('s', 'suppliers');			
	    if(empty($where)) $where = '1 = 1';

		$this->db->where($where, null, false)->from('suppliers s');
		$config['total_rows'] = $data['total_rows'] = $this->db->count_all_results();
		$config['base_url'] = base_url() . "/atom/module/suppliers?".http_build_query($filters, '', '&');
		$config['first_url'] = base_url() . "/atom/module/suppliers?".http_build_query($filters, '', '&')."&page=1";
		$config['per_page'] = 100;

        $this->load->library('pagination');
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();		
		$data['suppliers'] = $this->db->select('s.*')->order_by('s.id ASC')->where($where)->get('suppliers s', $config['per_page'], ($page - 1) * $config['per_page'])->result_array();
		
        $data['header']['title'] = 'Поставщики';
		$this->renderer->view('atom', 'lists/suppliers', $data);        
    }

    public function view($id) 
    {
		$data['supplier'] = $this->db->get_where('suppliers', array('id' => $id))->row_array();
		if(empty($data['supplier'])) show_404();


		$data['orders'] = $this->db->select('o.id, o.contract_number, o.readiness_date, i.name as installer_name, o.address, o.gazda_price, COALESCE(SUM(op.amount), 0) received_amount')->join('orders_payments op', 'op.user_id = o.supplier_id and op.type = "outgo" and op.user_type ="supplier" and op.order_id = o.id and op.status ="received"', 'left')->join('installers i', 'i.id = o.installer_id', 'left')->group_by('o.id')->where('o.supplier_id', $id)->get('orders o')->result_array();
		

		$data['payments'] = $this->db->where('user_type', 'supplier')->where('user_id', $id)->order_by('id desc')->get('orders_payments op')->result_array();


        $data['header']['title'] = $data['supplier']['company_name'];
		$this->renderer->view('atom', 'cards/suppliers', $data);        
    } 

    public function add() 
    {
	    if($post = $this->input->post(null, true)){
		    
		    
		    $post['manager_phone'] = preg_replace('~[^0-9]+~', '', $post['manager_phone']);
		    $post['manager2_phone'] = preg_replace('~[^0-9]+~', '', $post['manager2_phone']);
		    $post['viber'] = preg_replace('~[^0-9]+~', '', $post['viber']);		    
		    
		    $this->db->insert('suppliers', $post);
		    
			if($this->db->affected_rows() > 0)
				$this->session->set_flashdata('alert_success', "record successfully added!");
			else
				$this->session->set_flashdata('alert_error', "record is not added. If the problem persists, please contact support.");

            redirect(site_url('/atom/module/suppliers'));
            
	    } else {
	        $data['header']['title'] = 'Добавить поставщика';
	        $data['footer']['js_libs'] = array('/public/jquery.maskedinput.min.js');
			$data['footer']['js_code'] = "$('input.j-phone').mask('+38 (099) 999-99-99');";

			$this->renderer->view('atom', 'forms/suppliers', $data);                
	    }

    }

    public function edit($id) 
    {
	   
	    if($post = $this->input->post(null, true)){
		    
		    $post['manager_phone'] = preg_replace('~[^0-9]+~', '', $post['manager_phone']);
		    $post['manager2_phone'] = preg_replace('~[^0-9]+~', '', $post['manager2_phone']);
		    $post['viber'] = preg_replace('~[^0-9]+~', '', $post['viber']);		    
		    
		    $this->db->update('suppliers', $post, array('id' => $id));
		    
			if($this->db->affected_rows() > 0)
				$this->session->set_flashdata('alert_success', "record #{$id} successfully updated!");
			else
				$this->session->set_flashdata('alert_error', "record #{$id} isn't updated. If the problem persists, please contact support.");

            redirect(site_url('/atom/module/suppliers'));
            
	    } else {
		    
		    $data['supplier'] = $this->db->get_where('suppliers', array('id' => $id),1)->row_array();
		    if(empty($data['supplier'])) show_404();
		    
	        $data['header']['title'] = 'Редактировать поставщика';
	        $data['footer']['js_libs'] = array('/public/jquery.maskedinput.min.js');
			$data['footer']['js_code'] = "$('input.j-phone').mask('+38 (099) 999-99-99');";
			$this->renderer->view('atom', 'forms/suppliers', $data);                
	    }
    }

    public function delete($id) 
    {
	    $this->db->delete('suppliers', array('id' => $id));
	    
		if($this->db->affected_rows() == 0)
			$this->session->set_flashdata('alert_error', "record #{$id} isn't deleted. If the problem persists, please contact support.");
    }
	
}



/* Suppliers module */
/* Developed by Perepelitsa Web Production */