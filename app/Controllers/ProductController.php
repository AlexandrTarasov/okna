<?php

namespace AppCont;

class ProductController extends Controller
{
	private $message;
	public function __construct()
	{
		parent::__construct(__CLASS__);
	}

	public function indexAction($url)
	{
		$prod_id = explode('_', $url);
		if( !empty($prod_id) ){
			$product = $this->model->getProduct($prod_id[0]);
		}else{
			$this->message = 'страница не найдена';
		}

		if(!$product){
			$this->message = 'нет такого товара';
		}
		// dd($product);
		$resalt = [
			'title' => '',
			'message' => $this->message,
			'meta_descr' => '',
			'p' => $product,
		];
		$this->runView(__METHOD__)->renderWithData($resalt);
	}
}
