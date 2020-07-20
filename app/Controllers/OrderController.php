<?php

namespace AppCont;

use AppComp\Status;

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
		$resalt = [
			'title'   => 'Заказ',
			'id'      => $order[0]['id'],
			'contract_number' => $order[0]['contract_number'],
			'message' => $this->message,
			'order'   => $order,
			'status'  => $status_options->render(),
			'client'  => $client,
			// 'client' => $client,
		];
		$this->runView(__METHOD__)->renderWithData($resalt);
	}


}
