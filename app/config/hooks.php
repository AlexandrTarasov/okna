<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/


$hook['post_controller_constructor'][] = array(
                                'class'    => 'Language',
                                'function' => 'auto_detect',
                               'filename' => 'Language.php',
                               'filepath' => 'hooks',
                               );
                               


$hook['post_controller_constructor'][] = array(
                                'class'    => 'Language',
                                'function' => 'fetch_lang',
                               'filename' => 'Language.php',
                               'filepath' => 'hooks',
                               );
                               
