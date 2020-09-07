<?php

namespace AppCont;

use AppComp\Status;
use AppM\Enquiry;
use AppComp\HTMLWrapper;

class OrderController extends Controller
{
	public $model;
	private $message;

	public function __construct()
	{
		parent::__construct(__CLASS__);
	}

	public function indexAction($url='')
	{
		// $prod_id = explode('_', $url);
		$manager_id = '';
		if( $_SESSION['user_role'] === '2'){
			$manager_id = $_SESSION['user_id'];
		}
		$orders = $this->model->getOrders($manager_id);
		$resalt = [
			'title' => 'Заказы ',
			'message' => $this->message,
			'orders' => $orders,
			'total' => count($orders),
		];
		$this->runView(__METHOD__)->renderWithData($resalt);
	}

	public function sortByAction($param)
	{
		$orders = $this->model->getOrdersBy($param);
		$resalt = [
			'title' => 'Сортированые заказы',
			'message' => $this->message,
			'orders' => $orders,
			'total' => count($orders),
		];
		$this->runView('AppCont\OrderController::indexAction')->renderWithData($resalt);
	}

	public function orderAction($id)
	{
		$all_income_sum = 0;
		$other_client_orders_th = '';
		$payments_th = '';
		$id_given_by_supplier = '';

		$order = $this->model->getOrder($id);
		$other_client_orders = $this->model->getOrdersOfOneClient($order[0]['client_id'], $id);
		$client = $this->model->getClient($order[0]['client_id']);
		$status_options = new Status($order[0]['status']);
		$managers_list = $this->model->getUsersByRoleID(2);
		$installers_list = $this->model->getUsersByRoleID(5);
		$suppliers_list =$this->model->getSuppliers();
		foreach($suppliers_list as $val){
			$id_given_by_supplier .= '<li><data value = "'.$val['our_id_in_company'].'" >'.$val['id'].'</data></li>';
		};
		$gaugers_list = $this->model->getUsersByRoleID(5);

		$enquiry_obj = new Enquiry();
		$enquiry_data = $enquiry_obj->getEnquiry($order[0]['client_id']);

		$managers_wrap = new HTMLWrapper($managers_list);
		$managers_options = $managers_wrap->makeOptionsList($order[0]['manager_id'],['id', 'name'])->receiveElem();

		$suppliers_wrap = new HTMLWrapper($suppliers_list);
		$suppliers_options = $suppliers_wrap->makeOptionsList($order[0]['supplier_id'], ['id', 'company_name'])->receiveElem();

		$installers_wrap = new HTMLWrapper($installers_list);
		$installers_options = $installers_wrap->makeOptionsList($order[0]['installer_id'],['id', 'name'])->receiveElem();

		$gaugers_wrap = new HTMLWrapper($gaugers_list);
		$gaugers_options = $gaugers_wrap->makeOptionsList($order[0]['gauger_id'],['id', 'name'])->receiveElem();

		$payments = $this->model->getOrderPayments($id);
		if( !empty($payments )){
			$payments_wrap = new HTMLWrapper($payments);
			$payments_th = $payments_wrap->makeThList()->receiveElem();
			foreach($payments as $val){
				if( $val['type'] =='income' ){
					$all_income_sum = $all_income_sum + $val['amount'];
				}
			}
		}

		if( !empty($other_client_orders )){
			$other_client_orders_wrap = new HTMLWrapper($other_client_orders);
			$other_client_orders_th = $other_client_orders_wrap->makeThOrdersList()->receiveElem();
		}

		$actual_balance = $order[0]['total_price'] - $all_income_sum;
		$resalt = [
			'title'   => 'Заказ',
			'id'      => $order[0]['id'],
			'contract_number' 	=> $order[0]['contract_number'],
			'message' => $this->message,
			'order'   => $order,
			'status'  => $status_options->render(),
			'client'  => $client,
			'managers_options' 	=> $managers_options,
			'suppliers_options'	=>$suppliers_options,
			'installers_options' => $installers_options,
			'gaugers_options' 	=> $gaugers_options,
			'payments_th' 		=> $payments_th,
			'actual_balance'  	=> $actual_balance,
			'enquiry_data' 		=> $enquiry_data,
			'other_client_orders_th' => $other_client_orders_th,
			'id_given_by_supplier' => $id_given_by_supplier,
		];
		$this->runView(__METHOD__)->renderWithData($resalt);
	}
}
