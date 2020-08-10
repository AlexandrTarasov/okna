<?php

namespace AppCont;

use AppComp\HTMLWrapper;

class SupplierController extends Controller
{
	public $model;
	private $message;

	public function __construct()
	{
		parent::__construct(__CLASS__);
	}

	public function indexAction($url='')
	{
		$suppliers = $this->model->getSuppliers();
		$resalt = [
			'title' => 'Поставщики',
			'suppliers' => $suppliers,
			'total' => count($suppliers),
		];
		$this->runView(__METHOD__)->renderWithData($resalt);
	}

	public function supplierAction($id)
	{
		$viber_1 = 'viber_off';
		$viber_2 = 'viber_off';
		$supplier = $this->model->getSupplier($id);
		$orders   = $this->model->getSupplierOrders($supplier[0]['id']);
		$payments   = $this->model->getSupplierPayments($supplier[0]['id']);
		$html_wrapper = new HTMLWrapper($payments);

		if( $supplier[0]['manager_phone'] !=='' && $supplier[0]['manager_phone'] == $supplier[0]['viber_is']){
			$viber_1 = 'viber_on';
		}
		if( $supplier[0]['manager2_phone'] !=='' && $supplier[0]['manager2_phone'] == $supplier[0]['viber_is']){
			$viber_2 = 'viber_on';
		}

		$i = 0;
		foreach($orders as $order){
			$orders[$i]['paid_out'] = $this->model->getSupplierPayment($id, $order['id']);
			$i++;
		}
		$resalt = [
			'title'    => 'Поставщик',
			'supplier' => $supplier[0],
			'orders'   => $orders,
			'payments' => $html_wrapper->wrapSupplierPaymentsTable(), 
			'phone_viber_1' => $viber_1,
			'phone_viber_2' => $viber_2,
		];
		$this->runView(__METHOD__)->renderWithData($resalt);
	}

}
