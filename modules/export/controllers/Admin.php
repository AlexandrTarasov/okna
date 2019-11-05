<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

include_once MODULES_DIR.'atom/controllers/Atom.php';

class Admin extends Atom
{
		
    function __construct()
    {
        parent::__construct();
		if(!$this->auth->check_permission('Export')) redirect('/atom');
	}

    public function index()
    {		
		
		$request_date = date('w') >= 5 ? date('Y-m-d', strtotime("next monday")) : date('Y-m-d', strtotime('+ 1 day'));
	    $data['suppliers'] = $this->db->select('id,company_name')->get('suppliers')->result_array();
	    
		
		
		foreach($data['suppliers'] as $k => $supplier)
		{
			$data['suppliers'][$k]['orders'] = $this->db->select('o.id, o.contract_number, o.address, o.removal_date, o.removal_request_sent, i.name installer_name, i.phone installer_phone')->join('installers i', 'i.id = o.installer_id', 'left')->where('o.removal_date', $request_date)->get('orders o')->result_array();
		}
		
		
		
		
        $data['header']['title'] = 'Заявки на вывоз';
		$this->renderer->view('atom', 'lists/export', $data);        
    }
    
    
    
    public function removal_request_check()
    {
	    
	    if(($post = $this->input->post()) && isset($post['id'], $post['status']))
	    {
		    		    
		    $this->db->update('orders', array('removal_request_sent' => ($post['status'] === 'true' ? 1 : 0)), array('id' => (int) $post['id']));

			
			if($this->db->affected_rows() > 0)
				echo json_encode(array('result' => true, 'message' => 'Запрос выполнен успешно'));			
			else
				echo json_encode(array('result' => false, 'message' => 'Мы не смогли обновить данные в БД'));					    
		    
	    } else 
			echo json_encode(array('result' => false, 'message' => 'Отсутствуют обязательные параметры'));			
	    
    }
    
    

	
}



/* Suppliers module */
/* Developed by Perepelitsa Web Production */