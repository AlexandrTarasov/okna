<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
require 'vendor/autoload.php';
require 'config.php';
$router = Bit55\Litero\Router::fromGlobals();
$router->add([
	// '/page-:any'		=> 'AppCont\PageController@indexAction',
	'/' 				=> 'AppCont\AccountController@indexAction',
	'/logout' 			=> 'AppCont\AccountController@logOutAction',
	'/sluice'			=> 'AppCont\SluiceController@indexAction',
	'/orders'			=> 'AppCont\OrderController@indexAction',
	'/request_for_out'	=> 'AppCont\TakeoutsController@indexAction',
	'/order/:num'		=> 'AppCont\OrderController@orderAction',
	'/orders/sort/:any'	=> 'AppCont\OrderController@sortByAction',
	'/clients'		    => 'AppCont\ClientController@indexAction',
	'/client/:num'		=> 'AppCont\ClientController@clientAction',
	'/ads_agent/'		=> 'AppCont\AdsAgentController@indexAction',
	'/installers'		=> 'AppCont\InstallerController@indexAction',
	'/installer/:num'	=> 'AppCont\InstallerController@installerAction',
	'/enquiry'		    => 'AppCont\EnquiryController@indexAction',
	'/enquiry/sort/:any'=> 'AppCont\EnquiryController@sortByAction',
	'/enquiry/:num'	    => 'AppCont\EnquiryController@enquiryAction',
	'/enquiry/page/:num'=> 'AppCont\EnquiryController@indexAction',
	'/suppliers'		=> 'AppCont\SupplierController@indexAction',
	'/supplier/:num'	=> 'AppCont\SupplierController@supplierAction',
	'/users'		    => 'AppCont\UserController@indexAction',
	'/settings'		    => 'AppCont\SettingController@indexAction',
	'/user/:num'		=> 'AppCont\UserController@userAction',
	'/payment_edit/:num'	    => 'AppCont\PaymentController@indexAction',
]);

if ( $router->isFound() ) {
	session_start();
	if(!isset($_SESSION['url_referer']))
	{
		if(isset($_SERVER['HTTP_REFERER'])) {
			$_SESSION['url_referer'] = $_SERVER['HTTP_REFERER'];
		}
	}
	$router->executeHandler(
		$router->getRequestHandler(),
		$router->getParams()
	);
} 
else {
	http_response_code(404);
	echo '404 Not found';
}
