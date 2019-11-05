<?php defined('BASEPATH') || exit('No direct script access allowed');

$config['module_config'] = array(
	'name'		    => 'Users',
	'description'	=> 'Allow administrator to manage system users',
	'version'		=> '0.0.2',
	'author'		=> 'Perepelitsa Web Production',
	'update_url' 	=> 'http://atom.perepelitsa.com.ua/modules/atom_users/',
	'permissions'	=> array(
		'Users'  => 'Allow users to use Users module',
		'UsersCreateDeveloper'  => 'Allow users to create user with role Developer',
	),
);