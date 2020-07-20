<?php

namespace AppCont;

class InstallerController extends Controller
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
		$installers = $this->model->getInstallers();

		// dd($product);
		$resalt = [
			'title' => 'Интeрстeллеры',
			'message' => $this->message,
			'installers' => $installers,
			'total' => count($installers),
			// 'orders' => $orders,
		];
		$this->runView(__METHOD__)->renderWithData($resalt);
	}

	public function installerAction($id)
	{
		$resalt = [
			'title' => 'Монтажник',
			'message' => $this->message,
			// 'client' => $client,
		];
		$this->runView(__METHOD__)->renderWithData($resalt);
	}


}
