<?php

namespace AppCont;

use AppComp\HTMLWrapper;

class ClientController extends Controller
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
		$clients = $this->model->getClients();

		// dd($product);
		$resalt = [
			'title' => 'Клиенты',
			'message' => $this->message,
			'clients' => $clients,
			'total' => count($clients),
			// 'orders' => $orders,
		];
		$this->runView(__METHOD__)->renderWithData($resalt);
	}


	public function clientAction($id)
	{
		$sum_client_payments = 0;
		$viber_1 = $viber_2 = 'viber_off';
		$client_info = $this->model->getClient($id);
		$client_orders = $this->model->getClientsOrders($id);
		// dd($client_info);
		$client_payments = $this->model->getClientPayments($id);
		$html_wrapper = new HTMLWrapper($client_payments );

		if( ($client_info[0]['phone'] !='' ) && ($client_info[0]['phone'] == $client_info[0]['viber'])){
			$viber_1 = 'viber_on';
		}
		if( $client_info[0]['phone2'] !='' && $client_info[0]['phone2'] == $client_info[0]['viber']){
			$viber_2 = 'viber_on';
		}
		$i = 0;
		foreach($client_orders as $val){
			$client_orders[$i]['income_sum'] = $this->model->getIncomeSum($val['id'], $val['client_id']);
			$i++;
		};
		$resalt = [
			'title'   => 'Клиент',
			'message' => $this->message,
			'client'  => $client_info,
			'orders'  => $client_orders,
			'payments'=> $html_wrapper->wrapSupplierPaymentsTable(), 
			'phone_viber_1'=> $viber_1,
			'phone_viber_2'=> $viber_2,
			// 'orders'  => $client_orders,
		];
		$this->runView(__METHOD__)->renderWithData($resalt);
	}

}
