<?php

namespace AppCont;

use Kilte\Pagination\Pagination;

class EnquiryController extends Controller
{
	public $model;
	private $message = [];
	public $items_per_page = 50;

	public function __construct()
	{
		parent::__construct(__CLASS__);
	}

	public function indexAction($current_page = 0)
	{
		$neighbours = 4;
		$ipp_for_pagination = ''; //ipp -items per page

		if(isset($_GET['num_of_rec']) AND (($_GET['num_of_rec']) == 20 || ($_GET['num_of_rec'] == 100) ) ) {
			$this->items_per_page  = $_GET['num_of_rec']; 
			$ipp_for_pagination = '?num_of_rec='.$_GET['num_of_rec']; 
		}

		$totalItems = $this->model->getTotalEnquiries();
		$pagination = new Pagination($totalItems, $current_page, $this->items_per_page, $neighbours);
		$offset = $pagination->offset();
		$pages = $pagination->build();

		$enqueries = $this->model->getEnquiries('', $this->items_per_page, $offset);

		$resalt = [
			'title' => 'Лиды',
			'message' => $this->message,
			'enquiries' => $enqueries,
			'total' => $totalItems,
			'pagination'=> $pages,
			'ipp' => $ipp_for_pagination,
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

		// dd($sort_by);
		if(isset($_GET['num_of_rec']) AND (($_GET['num_of_rec']) == 20 || ($_GET['num_of_rec'] == 100) ) ) {
			$this->items_per_page  = $_GET['num_of_rec']; 
			$ipp_for_pagination = '?num_of_rec='.$_GET['num_of_rec']; 
		}

		$totalItems = $this->model->getTotalEnquiries($sort_by);
		$pagination = new Pagination($totalItems, $current_page, $this->items_per_page, $neighbours);
		$offset = $pagination->offset();
		$pages = $pagination->build();

		$enqueries = $this->model->getEnquiries($sort_by, $this->items_per_page,  $offset) ;
		$resalt = [
			'title' 	=> 'Лиды сортированные',
			'message' 	=> $this->message,
			'enquiries' => $enqueries,
			'total' => $totalItems,
			'sort_by' => $sort_by,
			'pagination'=> $pages,
			'ipp' => $ipp_for_pagination,
		];
		$this->runView(__METHOD__)->renderWithData($resalt);
		// dd(__CLASS__);
	}

}
