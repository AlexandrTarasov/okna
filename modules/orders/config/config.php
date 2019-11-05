<?php defined('BASEPATH') || exit('No direct script access allowed');

$config['module_config'] = array(
	'name'		    => 'Orders',
	'description'	=> '',
	'version'		=> '0.0.1',
	'author'		=> 'Perepelitsa Web Production',
	'permissions'   =>  array(
		'Orders' => 'Доступ к модулю Заказы',
		'Orders.View' => 'Просмотр карточки заказа',
		'Orders.Edit' => 'Изменять заказ',
		'Orders.ChangeManager' => 'Изменять менеджера заказа',
	),
);