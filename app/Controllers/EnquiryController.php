<?php

namespace AppCont;

class EnquiryController extends Controller
{
	public $model;
	private $message;

	public function __construct()
	{
		parent::__construct(__CLASS__);
	}

	public function indexAction($url='')
	{

		$enqueries = $this->model->getEnquiries();
		$total = $this->model->getTotalEnquiries();

		// dd($enqueries);
		$resalt = [
			'title' => 'Лиды',
			'message' => $this->message,
			'enquiries' => $enqueries,
			// 'total' => count($enqueries),
			'total' => count($total),
			'stay_as_enquery' => count($enqueries),
			// 'orders' => $orders,
		];
		$this->runView(__METHOD__)->renderWithData($resalt);
	}

}
