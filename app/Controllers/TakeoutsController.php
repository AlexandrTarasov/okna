<?php

namespace AppCont;

class TakeoutsController extends Controller
{
	public $model;
	private $message;

	public function __construct()
	{
		parent::__construct(__CLASS__);
	}


	public function indexAction()
	{
		$takeouts = $this->model->getTakeoutOrders();
		$resalt = [
			'title' => 'Заявки на вывоз',
			'message' => $this->message,
			'takeouts' => $takeouts,
		];
		$this->runView(__METHOD__)->renderWithData($resalt);
	}

	public function getTakoutsNumber()
	{
		return sizeof($this->model->getTakeoutOrders());
	}
}
