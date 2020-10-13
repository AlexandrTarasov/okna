<?php

namespace AppCont;

use Kilte\Pagination\Pagination;

class EnquiryController extends Controller
{
	public $model;
	private $message = [];

	public function __construct()
	{
		parent::__construct(__CLASS__);
	}

	public function indexAction($current_page = 0)
	{
		$neighbours = 4;
		$items_per_page = 50; 
		if(isset($_GET['num_of_rec']) AND (($_GET['num_of_rec']) == 20 || ($_GET['num_of_rec'] == 100) ) ) {
			$items_per_page = $_GET['num_of_rec']; 
		}

		$totalItems = $this->model->getTotalEnquiries();
		$pagination = new Pagination($totalItems, $current_page, $items_per_page, $neighbours);
		$offset = $pagination->offset();
		$limit = $pagination->limit();
		$pages = $pagination->build();

		$enqueries = $this->model->getEnquiries('', $items_per_page, $offset);

		// dd($offset);
		$resalt = [
			'title' => 'Лиды',
			'message' => $this->message,
			'enquiries' => $enqueries,
			'total' => $totalItems,
			'stay_as_enquery' => count($enqueries),
			'pagination'=> $pages,
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
