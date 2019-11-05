<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

include_once MODULES_DIR.'atom/controllers/Atom.php';

class Admin extends Atom
{
			
    function __construct()
    {
        parent::__construct();
		if(!$this->auth->check_permission('Orders')) redirect('/atom');
	}

    public function index()
    {
	    
        if($this->auth->check_permission('Orders.Installer'))
			$data['mydata'] = $this->db->where('atom_user_id', $this->auth->user['id'])->get('installers', 1)->row_array();	    
	    
		$this->load->library('filters');
		
		
		if(isset($_GET['readiness_date']) && $_GET['readiness_date'] != '') $_GET['readiness_date'] = date('Y-m-d', strtotime($_GET['readiness_date']));
		if(isset($_GET['montage_date']) && $_GET['montage_date'] != '') $_GET['montage_date'] = date('Y-m-d', strtotime($_GET['montage_date']));

		
		list($page, $where, $filters) = $this->filters->get_all('o', 'orders');			
	    if(empty($where)) $where = '1 = 1';
		
		
		if($this->auth->get_user_role() == 1) $this->db->where('o.installer_id', $data['mydata']['id'])->where('o.status !=', 'archive');
		if($this->auth->get_user_role() == 2) $this->db->where('o.manager_id', $this->auth->user['id']);


		$this->db->where($where, null, false)->from('orders o');
		$config['total_rows'] = $data['total_rows'] = $this->db->count_all_results();
		$config['base_url'] = base_url() . "/atom/module/orders?".http_build_query($filters, '', '&');
		$config['first_url'] = base_url() . "/atom/module/orders?".http_build_query($filters, '', '&')."&page=1";
		$config['per_page'] = 100;

        $this->load->library('pagination');
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();		
		$this->db->select('o.*, c.name as client_name, c.phone as client_phone, c.phone2 as client_phone2, i.name as installer_name')->order_by('o.id DESC')
								   ->join('clients c', 'c.id = o.client_id', 'left')
								   ->join('installers i', 'i.id = o.installer_id', 'left')
								   ->where($where);
								   
								   
		if($this->auth->get_user_role() == 1) $this->db->where('o.installer_id', $data['mydata']['id'])->where('o.status !=', 'archive');
		if($this->auth->get_user_role() == 2) $this->db->where('o.manager_id', $this->auth->user['id']);
		

		$data['orders'] = $this->db->get('orders o', $config['per_page'], ($page - 1) * $config['per_page'])->result_array();
		
        $data['header']['title'] = 'Все заказы';
        
        $data['filters'] = $filters;
        
        if(isset($filters['status']) && $filters['status'] == 'measuring')
        {
			$this->renderer->view('atom', 'lists/orders-measuring', $data);       
			 
        } elseif(isset($filters['status']) && $filters['status'] == 'in_work') {
	        
			$this->renderer->view('atom', 'lists/orders-in-work', $data);        
        } else {
			$this->renderer->view('atom', 'lists/orders', $data);        
        }
    }
    


    public function view($id) 
    {
		if(!$this->auth->check_permission('Orders.View')) redirect('/atom');
	    $this->load->helper('text_helper');
	    
	    
		if($this->auth->get_user_role() == 1)
			$data['mydata'] = $this->db->where('atom_user_id', $this->auth->user['id'])->get('installers', 1)->row_array();	    
	    
	    	    
	    $this->db->select('o.*, COALESCE((SELECT SUM(op.amount) FROM orders_payments op WHERE op.order_id = o.id and op.type = "income" and op.order_id = o.id and op.status = "received"), 0) received_amount');
		if($this->auth->get_user_role() == 1) $this->db->where('o.installer_id', $data['mydata']['id']);
		if($this->auth->get_user_role() == 2) $this->db->where('o.manager_id', $this->auth->user['id']);

	    
		$data['order'] = $this->db->get_where('orders o', array('o.id' => $id))->row_array();		
		if(empty($data['order'])) show_404();


		$data['lead'] = $this->db->where('id', $data['order']['lead_id'])->get('leads', 1)->row_array();

		$data['client'] = $this->db->where('id', $data['order']['client_id'])->get('clients', 1)->row_array();
		
		$data['managers'] = $this->db->where('role_id', 2)->get('atom_users')->result_array();
		
		
		$data['client_orders'] = $this->db->select('o.contract_number,o.id,o.readiness_date,o.address,i.name as installer_name,o.status')->join('installers i', 'i.id = o.installer_id', 'left')->where('o.client_id', $data['order']['client_id'])->where('o.id !=', $id)->get('orders o')->result_array();		

		$data['suppliers'] = $this->db->select('id,company_name')->get('suppliers')->result_array();

		$data['installers'] = $this->db->select('id,name')->get('installers')->result_array();
		
		$data['files'] = $this->db->select('of.*, au.username')->join('atom_users au', 'au.id = of.user_id')->where('of.order_id', $id)->order_by('of.id desc')->get('orders_files of')->result_array();
		
		
		
		$data['orders_payments'] = $this->db->where('order_id', $id)->order_by('id DESC')->get('orders_payments')->result_array();

        $data['header']['title'] = 'Заказ №'.$id;
        $data['footer']['js_libs'] = array('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js');
        
		$this->renderer->view('atom', 'cards/orders', $data);        
    } 





	public function create_order_from_lead($lead_id = null)
	{
		if($this->auth->check_permission('Orders.Installer')) redirect('/atom');
		if(!$lead_id) show_404();
		
		
		$lead = $this->db->where('id', $lead_id)->where('status !=', 'accepted')->get('leads', 1)->row_array();		
		if(empty($lead)) show_404();
		
		
		
		$new_id = $this->db->select('MAX(id) as max')->get('orders')->row_array()['max'];
		
		$this->db->insert('orders', array(
			'lead_id' => $lead['id'],
			'client_id' => $lead['client_id'],
			'address' => $lead['address'],
			'create_date' => date('Y-m-d'),
			'manager_id' => ($this->auth->get_user_role() == 2 ? $this->auth->user['id'] : NULL)
		));
		
		
		if($this->db->affected_rows() > 0)
		{
			$insert_id = $this->db->insert_id();
			
			$this->db->update('orders', array('contract_number' => '91-'.date('y').'-'.$insert_id, 'vendor_number' => '91-'.date('y').'-'.$insert_id), array('id' => $insert_id));
			$this->db->update('leads', array('status' => 'accepted'), array('id' => $lead_id));
			
			$this->session->set_flashdata('alert_success', "record successfully added!");
			redirect(site_url('/atom/module/orders/view/'.$insert_id));

		} else {
			$this->session->set_flashdata('alert_error', "record is not added. If the problem persists, please contact support.");
			redirect(site_url('/atom/module/leads?id='.$lead_id));
		}		
		
	}
	
	
	
	public function ajax_save()
	{
		if(!$this->auth->check_permission('Orders.Edit')) show_404();

		
		if(($post = $this->input->post()))
		{
			
			$field = preg_split('/\s/', preg_replace('/[^a-zA-ZА-Яа-я0-9\s_]/', ' ', $post['name']));
			
			
			
			if($field[1] == 'manager_id' && !$this->auth->check_permission('Orders.ChangeManager'))
			{
				echo json_encode(array('result' => false, 'message' => 'У вас недостаточно полномочий для изменения менеджера.'));
				die();
			}
			
			
			if(preg_split('/\_/', $field[1])[1] == 'date')
			{
				if($post['value'] == '') 
					$post['value'] = NULL;
				else
					$post['value'] = date('Y-m-d', strtotime($post['value']));
			}
			
			
			
			
			
			if($field[0] == 'order')
				$this->db->update('orders', array($field[1] => $post['value']), array('id' => $post['id']));
			elseif($field[0] == 'client')
				$this->db->update('clients', array($field[1] => $post['value']), array('id' => $post['id']));
			else
				echo json_encode(array('result' => false, 'message' => 'Таблица для обновления не задана в запросе'));
			
			
			
			if($this->db->affected_rows() > 0)
				echo json_encode(array('result' => true, 'message' => 'Запрос выполнен успешно'));			
			else
				echo json_encode(array('result' => false, 'message' => 'Мы не смогли обновить данные в БД'));			
			
			
		} else
			show_404();


		
	}
	
	
	
	
	
	public function upload_file($order_id = null)
	{
		if($this->auth->check_permission('Orders.Installer')) redirect('/atom');
		if(!$order_id) show_404();
		
		if(($post = $this->input->post()) && !empty($_FILES['file'] && $_FILES['file']['tmp_name'] != ''))
		{
			$this->load->library('uploader');			
			if(!is_dir(getcwd().'/uploads/orders/'.$order_id)) mkdir(getcwd().'/uploads/orders/'.$order_id, 0777, true);

			$filename = $this->uploader->upload($_FILES['file'], '/uploads/orders/'.$order_id, true);
			
			
			$this->db->insert('orders_files', array(
				'order_id' => $order_id,
				'user_id' => $this->auth->user['id'],
				'filename' => $filename,
				'comment' => htmlspecialchars($post['comment'])
			));
						
			
			if($this->db->affected_rows() > 0)
				$this->session->set_flashdata('alert_success', "файл успешно загружен!");
			else
				$this->session->set_flashdata('alert_success', 'файл не загружен, пожалуйста, попробуйте ещё раз.');			
						
						
			redirect(site_url('/atom/module/orders/view/'.$order_id));
			
		}		
	}
	
	
	public function delete_file($order_id = null, $file_id = null)
	{
		if($this->auth->check_permission('Orders.Installer')) redirect('/atom');
		if(!$order_id || !$file_id) show_404();
		
		$file = $this->db->select('filename')->where('id', $file_id)->where('order_id', $order_id)->get('orders_files', 1)->row_array();
		
		
		if(unlink(getcwd().'/uploads/orders/'.$order_id.'/'.$file['filename']))
		{
			$this->db->delete('orders_files', array('id' => $file_id, 'order_id' => $order_id));
			
			if($this->db->affected_rows() > 0)
				$this->session->set_flashdata('alert_success', "файл успешно удален!");
			else
				$this->session->set_flashdata('alert_success', 'не удалось удалить файл, пожалуйста, попробуйте ещё раз.');			
						
						
			redirect(site_url('/atom/module/orders/view/'.$order_id));
			
		}		
	}
	
	
	

    public function delete($id) 
    {
		if($this->auth->check_permission('Orders.Installer')) redirect('/atom');
	    $this->db->delete('orders', array('id' => $id));
	    
		if($this->db->affected_rows() == 0)
			$this->session->set_flashdata('alert_error', "record #{$id} isn't deleted. If the problem persists, please contact support.");
    }
	
	
	
	
    public function filters($name)
    {
		$response = array();		
		switch($name)
		{
			
			case 'search':
				
				$response['clients'] = $this->db->like('c.name', $this->input->post('value'))->get('clients c', 100)->result_array();
				
				
				$response['phones'] = ((strlen(preg_replace('~[^0-9]+~', '', $this->input->post('value'))) > 2) ? $this->db->like('c.phone', preg_replace('~[^0-9]+~', '', $this->input->post('value')))->or_like('c.phone2', preg_replace('~[^0-9]+~', '', $this->input->post('value')))->get('clients c', 100)->result_array() : array());
				$response['addresses'] = $this->db->like('o.address', $this->input->post('value'))->group_by('o.address')->get('orders o', 100)->result_array();


			break;
			
			case 'clients':
				$response = $this->db->query('SELECT id as value, name as text FROM clients ORDER BY name ASC')->result_array();
				array_unshift($response, array('value' => '', 'text' => 'Все'));
			break;
			
			
			case 'installers':
				$response = $this->db->query('SELECT id as value, name as text FROM installers ORDER BY name ASC')->result_array();
				array_unshift($response, array('value' => '', 'text' => 'Все'));
			break;
			

			case 'status':
				$response[] = array('value' => 'new', 'text' => 'Новый');
				$response[] = array('value' => 'processing', 'text' => 'В обработке');
				$response[] = array('value' => 'measuring', 'text' => 'Замер');
				$response[] = array('value' => 'during', 'text' => 'В процессе');
				$response[] = array('value' => 'in_work', 'text' => 'В работе');
				$response[] = array('value' => 'complete', 'text' => 'Готов');
				$response[] = array('value' => 'fulfilled', 'text' => 'Выполнен');
				$response[] = array('value' => 'archive', 'text' => 'Архив');
				array_unshift($response, array('value' => '', 'text' => 'Все'));
			break;
			
				
			
		}
	    echo json_encode($response);
    }
    
	
}



/* Orders module */
/* Developed by Perepelitsa Web Production */