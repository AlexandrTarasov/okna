<?php

namespace AppCont;

class AdsAgentController extends Controller
{
	public $model;
	private $message;

	public function __construct()
	{
		parent::__construct(__CLASS__);
		// $this->view->redirect('/');
	}

	public function indexAction($url='')
	{
		// dd($this->model);
		// $prod_id = explode('_', $url);
		$leads = $this->model->getAdsAgentEnquiries();

		// dd($product);
		/*TODO 
		 * revove all vibers into "viber_is"
		 */
		$resalt = [
			'title' => 'Рекламный агент / лиды',
			'message' => $this->message,
			'leads' => $leads,
		];
		$this->runView(__METHOD__)->renderWithData($resalt);
	}
}
