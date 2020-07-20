<?php

namespace AppCont;

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
		}

		if( ($this->post['from_node'] == 'supplier_manager_name') ){
			$this->model->setSupplierManagerName($this->post['id'], $this->post['val']);
		}

		if( ($this->post['from_node'] == 'supplier_phone_1') ){
			$clear_phone = str_replace('(', '', $this->post['val']);
			$clear_phone = str_replace(')', '', $clear_phone);
			$clear_phone = str_replace('-', '', $clear_phone);
			$clear_phone = '38'.$clear_phone;
			$this->model->setSupplierManager1Phone($this->post['id'], $clear_phone);
		}
		echo 1;
	}

	public function setSuppliername()
	{
	}


	public function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
}
