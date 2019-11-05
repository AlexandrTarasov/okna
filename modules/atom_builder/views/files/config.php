<?php

echo "<?php defined('BASEPATH') || exit('No direct script access allowed');" .
PHP_EOL . "
\$config['module_config'] = array(
	'name'		    => '{$module_name}',
	'description'	=> '{$module_description}',
	'version'		=> '{$module_version}',
	'author'		=> '{$module_author}',
	'permissions'   =>  array(),
);";