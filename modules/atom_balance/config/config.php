<?php defined('BASEPATH') || exit('No direct script access allowed');

$config['module_config'] = array(
	'name'		    => 'Balance',
	'description'	=> 'Allow to see client balance from Perepelitsa Web Production',
	'version'		=> '0.0.2',
	'author'		=> 'Perepelitsa Web Production',
	'update_url' 	=> 'http://atom.perepelitsa.com.ua/modules/atom_balance/',
	'permissions'   =>  array(
		'Balance.Menu'  => 'Allow users to view balance menu'
	),
);