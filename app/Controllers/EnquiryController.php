<?php

namespace AppCont;

class EnquiryController extends Controller
{
	public $model;
	private $message = [];

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

	public function enquiryAction($id)
	{
		$enquery = $this->model->getEnquiry($id);
		if(!$enquery){
			$this->message = ['text'=>'Нет такого лида', 'type'=>'danger'];
		}
		$statuses = $this->model->getENUMoptions('status');
		$sources = $this->model->getENUMoptions('source');
		// dd($this->message);
		$resalt = [
			'title' 	=> 'Лид',
			'message' 	=> $this->message,
			'enquery' 	=> $enquery,
			'statuses'  => $statuses,  
			'sources'	=> $sources
		];
		$this->runView(__METHOD__)->renderWithData($resalt);
	}

	public function sortByAction($param)
	{
		$enqueries = $this->model->getEnquiries($param);
		$resalt = [
			'title' 	=> 'Лиды сортированные',
			'message' 	=> $this->message,
			'enquiries' => $enqueries,
			'total' => '',
			'stay_as_enquery' => '',
		];
		$this->runView(__METHOD__)->renderWithData($resalt);
		// dd(__CLASS__);
	}

}
