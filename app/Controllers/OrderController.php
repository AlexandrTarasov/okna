<?php

namespace AppCont;

use AppComp\Status;
use AppM\Enquiry;
use AppComp\HTMLWrapper;
use Kilte\Pagination\Pagination;

class OrderController extends Controller
{
	public $model;
	private $message = [];
	public $items_per_page = 50;
	public $manager_id = '';

	public function __construct()
	{
		parent::__construct(__CLASS__);

		if( $_SESSION['user_role'] === '2'){
			$this->manager_id = $_SESSION['user_id'];
		}
	}

	public function indexAction($current_page = 0)
	{
		// $prod_id = explode('_', $url);
		// dd($url);
		$neighbours = 4;

		$totalItems = $this->model->getAllOrders();
		$pagination = new Pagination($totalItems, $current_page, $this->items_per_page, $neighbours);
		$offset = $pagination->offset();
		$pages = $pagination->build();

		$orders = $this->model->getOrders($this->manager_id, $this->items_per_page, $offset);

		$resalt = [
			'title' => 'Заказы ',
			'message' => $this->message,
			'orders' => $orders,
			'total' => $totalItems,
			'pagination'=> $pages,
			'ipp' => '',
		];
		$this->runView(__METHOD__)->renderWithData($resalt);
	}

	public function sortByAction($path)
	{
		$neighbours = 4;
		$ipp_for_pagination = '';
		$current_page = 0;
		$sort_by = 'all';

		if( strpos($path, '/page/') ){
			$parts_of_url = explode('/', $path);
			$sort_by = $parts_of_url['0'];
			$current_page = $parts_of_url['2'];

		}else{ $sort_by = $path;}

		$totalItems = $this->model->getAllOrders($sort_by);
		$pagination = new Pagination($totalItems, $current_page, $this->items_per_page, $neighbours);
		$offset = $pagination->offset();
		$pages = $pagination->build();

		$orders = $this->model->getOrdersBy($sort_by);
		$resalt = [
			'title' => 'Сортированые заказы',
			'message' => $this->message,
			'orders' => $orders,
			'pagination'=> $pages,
			'ipp' => '',
			'total' => $totalItems,
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
		$enquiry_data = $enquiry_obj->getClientEnquiry($order[0]['client_id']);

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
