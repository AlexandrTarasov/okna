<?php

namespace AppCont;

use AppComp\Status;
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
		$orders = $this->model->getOrders();
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
		$order = $this->model->getOrder($id);
		$client = $this->model->getClient($order[0]['client_id']);
		$status_options = new Status($order[0]['status']);
		$managers_list = $this->model->getUsersByRoleID(2);
		$installers_list = $this->model->getUsersByRoleID(5);
		$suppliers_list =$this->model->getSuppliers();
		$gaugers_list = $this->model->getUsersByRoleID(5);

		$managers_wrap = new HTMLWrapper($managers_list);
		$managers_options = $managers_wrap->makeOptionsList($order[0]['manager_id'],['id', 'username'])->receiveElem();

		$suppliers_wrap = new HTMLWrapper($suppliers_list);
		$suppliers_options = $suppliers_wrap->makeOptionsList($order[0]['supplier_id'], ['id', 'company_name'])->receiveElem();

		$installers_wrap = new HTMLWrapper($installers_list);
		$installers_options = $installers_wrap->makeOptionsList($order[0]['installer_id'],['id', 'username'])->receiveElem();

		$gaugers_wrap = new HTMLWrapper($gaugers_list);
		$gaugers_options = $gaugers_wrap->makeOptionsList($order[0]['gauger_id'],['id', 'username'])->receiveElem();

		$resalt = [
			'title'   => 'Заказ',
			'id'      => $order[0]['id'],
			'contract_number' => $order[0]['contract_number'],
			'message' => $this->message,
			'order'   => $order,
			'status'  => $status_options->render(),
			'client'  => $client,
			'managers_options' => $managers_options,
			'suppliers_options'=>$suppliers_options,
			'installers_options' => $installers_options,
			'gaugers_options' => $gaugers_options,
		];
		$this->runView(__METHOD__)->renderWithData($resalt);
	}


}
