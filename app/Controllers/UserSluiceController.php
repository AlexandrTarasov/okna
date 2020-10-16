<?php
namespace AppCont;

use AppM;

class UserSluiceController extends Controller
{

	private $post;
	
	public function __construct()
	{
		$this->post = $_POST;
		parent::__construct(__CLASS__);
	}

	public function indexAction()
	{
		if( ($this->post['from_node'] == 'search_for_order_phone') ){
			$model = new AppM\Client();
			if (!empty($resp = $model->getClientByPartOfPhone($this->post['val']))){
				header('Content-Type: application/json');
				echo(json_encode($resp));
			}else{
				echo '0';
			}
		}

		if( ($this->post['from_node'] == 'search_clien_address_or_name') ){
			$model = new AppM\Client();
			if (!empty($resp = $model->getClientByAddressOrName($this->post['val']))){
				header('Content-Type: application/json');
				echo(json_encode($resp));
			}else{
				echo '0';
			}
			return;
		}
	}
}
