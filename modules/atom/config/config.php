<?php defined('BASEPATH') || exit('No direct script access allowed');

$config['module_config'] = array(
	'name'		    => 'Atom',
	'description'	=> 'Control panel',
	'version'		=> '6.0.3',
	'author'		=> 'Perepelitsa Web Production',
	'permissions'	=> array(
		'Atom.Login'  => 'Allow users to login to Atom',
		'Atom.Maintanance'  => 'Allow users use Atom when Maintenance mode is on',
		'Atom.Settings.Atom' => 'Allow users to change Atom config',
		'Atom.Menu.Developer' => 'Allow users to change Atom config',
	),
);