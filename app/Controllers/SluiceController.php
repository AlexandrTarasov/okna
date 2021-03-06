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

			$model = new AppM\Enquiry();
	
			$enquiry_data = [];
			foreach($this->post as $key => $val){
				if( $key === 'phone_1' || $key === 'phone_2' ){
					$enquiry_data[$key] = $this->cleanPhone($val);
					continue;
				}
				$enquiry_data[$key] = $this->test_input($val);
			}
			$enquiry_data['who_added_id']= $_SESSION['user_id'];
			// if client exists 
			if($this->post['client_id'] !== ''){
				if ( is_numeric($model->setLead($this->post['client_id'], $enquiry_data)) ){
					echo 1;
					return;
				} else {
					echo"problem with lead adding when client exists";
					return false;
				}
			}
			// --
			// if client doesnt exist
			$last_id = $model->setClient($enquiry_data);

			if( is_numeric($last_id)){
				if ( is_numeric($model->setLead($last_id, $enquiry_data)) ){
					echo 1;
					return;
				} else {
					echo"problem with lead adding when client doesnt exist";
					return false;
				}
			}
			else{ 
				echo "Ошибка базы клиент не услановлен"; 
				return false;
			}
			//
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

		if( ($this->post['from_node'] == 'enquery_phone_exists') || 
			($this->post['from_node'] == 'client_phone_exists')){
			$model = new AppM\Enquiry();
			// $resp = $model->checkClientByPhone('38' . $this->post['phone']);
			if (!empty($resp = $model->checkClientByPhone('38' . $this->post['phone']))){
				header('Content-Type: application/json');
				echo(json_encode($resp[0]));
				// <!-- dd($resp); -->
				//GO HERE
				// dd($this->post);
			}else{
				echo '0';
			}
			
		}
		if( $this->post['from_node'] == 'add_supplier_modal_form'){
			$model_supplier = new AppM\Supplier();
			$this->post['manager_phone'] = $this->cleanPhone($this->post['manager_phone']);
			if (is_numeric($model_supplier->setSupplier($this->post))){
				echo '1';
				return;
			}else{
				echo __FUNCTION__.' went wrong';
			}
		}

		if( $this->post['from_node'] == 'add_user_modal_form'){
			$model_user = new AppM\User();
			$this->post['phone'] = $this->cleanPhone($this->post['phone']);
			$last_id_and_pass = $model_user->setUser($this->post);

			if (is_numeric($last_id_and_pass[0])){
				$model_user->set_u_i($last_id_and_pass);
				echo json_encode(['rsp'=>'1', 'pass'=>$last_id_and_pass[1]]);
				return;
			}else{
				echo __FUNCTION__.' went wrong';
			}
		}
//Order handling
		if( ($info = explode('_', $this->post['from_node']))[0] === 'order'){
			// dd($this->post);
			$method = $info[1].'OrderMain';
			$column = $info[2]. (isset($info[3]) ? "_".$info[3] : '');
			$model_order = new AppM\Order();
			echo $model_order->$method($this->post['id'], $this->post['val'], $column);
		}
//
		// if( $this->post['from_node'] ==='client_update_comment' ){
		// 	$model_client = new AppM\Client();
		// 	echo $model_client->updateClientMain($this->post['id'], $this->post['val'], 'comment');
		// }

		if( $this->post['from_node'] === 'generate_enquiry' ){
			$data = explode('||', $this->post['val']);
			$lead_id = $this->post['id'];
			$client_id = $data[0];
			$manager_of_order = "NULL";
			$address = $data[1];
			$model_order = new AppM\Order();
			if( $_SESSION['user_role']  === '2'){ //if logged as manager put him as order manager
				$manager_of_order = $_SESSION['user_id'];
			}
			echo $id_of_new_order = $model_order->setOrder($lead_id, $client_id, $address, $manager_of_order);
			if( is_numeric($id_of_new_order )){
				$model_enquiry = new AppM\Enquiry();
				$model_enquiry->updateStatus($lead_id, 'accepted');
			}else{echo 'id_of_new_order no number '.__FUNCTION__;}
		}

		if( $this->post['from_node'] === 'add_payment_form' ){
			$model_order = new AppM\Order();
			$last_payment_id = $model_order->addPayment($this->post['order_id'], 
				$_SESSION["user_id"],
				$this->post['user_type'],
				$this->post['method'],
				$this->post['amount'],
				$this->post['type'],
				$this->test_input($this->post['comment']),
				$this->post['date_create'],
				$this->post['status']);
			echo ($last_payment_id);
			return;
			// dd($this->post);
		}

		if( ($this->post['from_node'] == 'del_user') ){
			$model = new AppM\User();
			$res = $model->delUser($this->post['id']);
			echo 1;
			return;
		}

		if( ($this->post['from_node'] == 'user_role_change') ){
			$model = new AppM\User();
			$res = $model->updateUserMain($this->post['id'], $this->post['val'], 'role_id');
			if( is_numeric($res)){
				echo 1;
				return;
			}
			echo $res;
			return;
		}

		if( ($this->post['from_node'] == 'payment_status_update') ){
			
			$model = new AppM\Payment();
			$res = $model->updatePaymentMain($this->post['id'], $this->post['val'], 'status');
			if( is_numeric($res)){
				echo 1;
				return;
			}
			echo $res;
			return;
		}


//client handling
		if( ($info = explode('_', $this->post['from_node']))[0] === 'client'){
			$model_client = new AppM\Client();
			if( $info[1] == 'delete'){
				echo ($model_client->delete($this->post['id']) == 1) ? '1' : '0';
				return true;
			}
			if( $info[2] === 'phone' || $info[2] === 'phone2'){
				$this->post['val'] = $this->cleanPhone($this->post['val']);
			}
			$method = $info[1].'ClientMain';
			$column = $info[2]. (isset($info[3]) ? "_".$info[3] : '');
			echo $model_client->$method($this->post['id'], $this->post['val'], $column);
		}
//
		if( ($this->post['from_node'] == 'enquery_client_name_exists') ){
			$model_client = new AppM\Client();
			$clients_list =$model_client->getClientByName($this->post['fio']);

			if (!empty($resp = $model_client->getClientByName($this->post['fio']))){
				header('Content-Type: application/json');
				echo(json_encode($resp));
			}else{
				echo '0';
			}
		}
///// lead handling
		if( ($info = explode('_', $this->post['from_node']))[0] === 'lead'){
			$model_lead = new AppM\Enquiry();
			if( $info[1] == 'delete'){
				echo ($model_lead->delete($this->post['id']) == 1) ? '1' : '0';
				return true;
			}
			$method = $info[1].'LeadMain';
			$column = $info[2]. (isset($info[3]) ? "_".$info[3] : '');
			echo $model_lead->$method($this->post['id'], $this->post['val'], $column);
		}

		// if( ($this->post['from_node'] == 'lead_update_status') ){
		// 	$model = new AppM\Enquiry();
		// 	$res = $model->updateStatus($this->post['id'], $this->post['val']);
		// 	if( is_numeric($res)){
		// 		echo 1;
		// 		return;
		// 	}
		// 	echo $res;
		// 	return;
		// }	
		if( ($this->post['from_node'] == 'lead_delete') ){
			$model_lead = new AppM\Enquiry();
		}
////
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
