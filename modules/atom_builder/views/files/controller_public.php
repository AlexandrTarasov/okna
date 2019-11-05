<?php

$string = "<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ".ucfirst($module_name_right)." extends Atom_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{	
		\$data['$db_table_name'] = \$this->db->select('".$db_table_name[0].".*')->get('$db_table_name ".$db_table_name[0]."')->result_array();
			
		\$data['header']['title'] = '".plural($module_name)." list';
		\$data['header']['description'] = '';
		\$data['header']['keywords'] = '';
		
		\$this->renderer->view('site', 'lists/$module_name_right', \$data);
	}
			
	
	public function view(\$id = null)
	{
		if(!\$id) show_404();
		
		\$data['$db_table_name_single'] = \$this->db->where('".$db_table_name[0].".id', \$id)->get('$db_table_name ".$db_table_name[0]."')->row_array();
		if(empty(\$data['$db_table_name_single'])) show_404();

		\$data['header']['title'] = '".singular($module_name)." item';
		\$data['header']['description'] = '';
		\$data['header']['keywords'] = '';
		
		\$this->renderer->view('site', 'cards/$module_name_right', \$data);        
	}	

	
}

/* $module_name module public controller */
/* Developed by $module_author */";


echo $string;


?>