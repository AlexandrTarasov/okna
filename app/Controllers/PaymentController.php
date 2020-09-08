<?php

namespace AppCont;

class PaymentController extends Controller
{
	public $model;
	private $message;

	public function __construct()
	{
		parent::__construct(__CLASS__);
		if( $_SESSION['user_role'] !== '3' ){
			exit ("permissions denied");
		}
	}

	public function indexAction($payment_num)
	{
		$pay_m_statuses = $this->model->getENUMoptions('status');
		if( $payment_num ==='0' ){
			$payments = $this->model->getPayments();
		}else{
			$payments = $this->model->getPayments(['sent'], $payment_num);
		}

		$resalt = [
			'title' => 'Платежи',
			'message' => $this->message,
			'payments' => $payments,
			'total' => count($payments),
			'pay_m_statuses' => $pay_m_statuses,
			// 'total' => count($payments),
		];
		$this->runView(__METHOD__)->renderWithData($resalt);
	}
}
