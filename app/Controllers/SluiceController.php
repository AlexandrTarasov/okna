<?php

namespace AppCont;

use AppM;

class SluiceController extends Controller
{
	private $post;
	
	public function __construct()
	{
		$this->post = $_POST;
		parent::__construct(__CLASS__);
	}

	public function indexAction()
	{
		if(!empty($this->post['cat_id'])){
			// $cat_id = $this->post['cat_id'];
			// $this->getSubmenu($cat_id);
		}

		if( ($this->post['from_node'] == 'supplier_data_name') ){
			$this->model->setSupplierCompanyName($this->post['id'], $this->post['val']);
			echo 1;
			return;
		}

		if( ($this->post['from_node'] == 'supplier_manager_name') ){
			$this->model->setSupplierManagerName($this->post['id'], $this->post['val']);
			echo 1;
			return;
		}

		if( ($this->post['from_node'] == 'supplier_phone_1') ){
			$clear_phone = $this->cleanPhone($this->post['val']);
			$this->model->setSupplierManager1Phone($this->post['id'], $clear_phone);
			echo 1;
			return;
		}

		if( ($this->post['from_node'] == 'add_enquiry_modal_form') ){
			if( $this->post['fio'] == '' || $this->post['phone_1'] == '' ){
				echo "Фио и Телефон должны быть заполнены";
				return false;
			}
	
			$enquiry_data = [];
			foreach($this->post as $key => $val){
				if( $key === 'phone_1' || $key === 'phone_2' ){
					$enquiry_data[$key] = $this->cleanPhone($val);
					continue;
				}
				$enquiry_data[$key] = $this->test_input($val);
			}
			$model = new AppM\Enquiry();
			$last_id = $model->setClient($enquiry_data);
			if( is_numeric($last_id)){
				if ( is_numeric($model->setLead($last_id, $enquiry_data)) ){
					echo 1;
					return;
				} else {
					echo"problem with lead adding";
					return false;
				}
			}
			else{ 
				echo "Ошибка базы клиент не услановлен"; 
				return false;
			}
		}

		if( ($this->post['from_node'] == 'add_client_modal_form') ){
			if( $this->post['fio'] == '' || $this->post['phone_1'] == '' ){
				echo "Фио и Телефон должны быть заполнены";
				return false;
			}
			$enquiry_data = [];
			foreach($this->post as $key => $val){
				if( $key === 'phone_1' || $key === 'phone_2' ){
					$enquiry_data[$key] = $this->cleanPhone($val);
					continue;
				}
				$enquiry_data[$key] = $this->test_input($val);
			}
			$model = new AppM\Enquiry();
			if (is_numeric($model->setClient($enquiry_data, 'only'))){
				echo '1';
				return;
			}
		}

	}

	public function cleanPhone($phone_number)
	{
		if( empty($phone_number) ){
			return false;
		}
		$clear_phone = str_replace('(', '', $phone_number);
		$clear_phone = str_replace(')', '', $clear_phone);
		$clear_phone = str_replace('-', '', $clear_phone);
		$clear_phone = '38'.$clear_phone;
		return $clear_phone;
	}

	public function setSuppliername()
	{
		//
	}


	public function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
}
