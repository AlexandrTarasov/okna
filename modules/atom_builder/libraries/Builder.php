<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Builder
{
	
	
    public $CI;
    protected $databaseTypes = array(
        'bigint'     => array('numeric', 'integer'),
        'binary'     => array('binary'),
        'bit'        => array('numeric', 'integer', 'bit'),
        'blob'       => array('binary', 'object'),
        'bool'       => array('numeric', 'integer', 'boolean'),
        'boolean'    => array('numeric', 'integer', 'boolean'),
        'char'       => array('string'),
        'date'       => array('date'),
        'datetime'   => array('date', 'time'),
        'dec'        => array('numeric', 'real'),
        'decimal'    => array('numeric', 'real'),
        'double'     => array('numeric', 'real'),
        'enum'       => array('string', 'list'),
        'float'      => array('numeric', 'real'),
        'int'        => array('numeric', 'integer'),
        'integer'    => array('numeric', 'integer'),
        'longblob'   => array('binary', 'object'),
        'longtext'   => array('string', 'object'),
        'mediumblob' => array('binary', 'object'),
        'mediumint'  => array('numeric', 'integer'),
        'mediumtext' => array('string', 'object'),
        'numeric'    => array('numeric', 'real'),
        'real'       => array('numeric', 'real'),
        'set'        => array('string', 'list'),
        'smallint'   => array('numeric', 'integer'),
        'time'       => array('time'),
        'timestamp'  => array('date', 'time'),
        'tinyblob'   => array('binary', 'object'),
        'tinyint'    => array('numeric', 'integer'),
        'tinytext'   => array('string', 'object'),
        'text'       => array('string', 'object'),
        'varbinary'  => array('binary'),
        'varchar'    => array('string'),
        'year'       => array('year', 'integer'),
    );


    public function __construct()
    {
        $this->CI = &get_instance();        

	}
	
	
	
	public function build_db_table($data)
	{
		$this->CI->load->helper('inflector');
		$this->CI->load->dbforge();
		
		
		if($data['new_db_name'] == '')
			$data['new_db_name'] = strtolower(underscore($data['module_name']));
			
		
		
		if($data['primary_key'] == '')
			$data['primary_key'] = 'id';
			
		// Adding at least one field
		$this->CI->dbforge->add_field($data['primary_key'], array(
			'type' => 'INT',
            'constraint' => 9,
            'unsigned' => TRUE,
            'auto_increment' => TRUE	
		));
		
		if($data['primary_key'] != 'id')
			$this->CI->dbforge->add_field($data['primary_key'], TRUE);
		
		
		if(!empty($data['fields']))
		{
			$fields = array();
			
			foreach($data['fields'] as $field)
			{
				$fields[$field['name']] = array(
					'type' => $field['type'],
	                'constraint' => (($field['type'] == 'enum' || $field['type'] == 'set') ? explode(',', $field['value']) : $field['value']),
				);
				
				
				if($field['type'] == 'enum' || $field['type'] == 'set')
					$fields[$field['name']]['default'] = explode(',', $field['value'])[0];
				
				
			}
			
			
			$this->CI->dbforge->add_field($fields);
			
		}
		
			
			
		if($this->CI->dbforge->create_table($data['new_db_name'], FALSE, array('ENGINE' => 'MyISAM')))
			return TRUE;
		else
			return FALSE;
				
		
		
	}
	
	
	
	public function build_module($data)
	{
		
		$this->CI->load->helper('inflector');
		
		
		
		$data['module_name_right'] = strtolower(underscore($data['module_name']));
		
		
		$data['db_table_name'] = ($data['module_db'] == 'new' ? ($data['new_db_name'] == '' ? strtolower(underscore($data['module_name'])) : $data['new_db_name']) : $data['db_table_name']);
		$data['db_table_name_single'] = singular($data['db_table_name']);
		
		
		// build module config
		$files['config'] = $this->buildConfig($data);
		
		
		
		
		
		foreach($data['module_contexts'] as $context)
			$files['controller'][$context] = $this->buildController($context, $data);
				
				
				
		if(isset($data['module_public_views']) && !empty($data['module_public_views']))
		{
			foreach($data['module_public_views'] as $view)
				$files['public_views'][$view.'s'] = $this->buildView('public_'.$view, $data);
		}
		
		
		
		if(isset($data['module_admin_views']) && !empty($data['module_admin_views']))
		{
			foreach($data['module_admin_views'] as $view)
				$files['admin_views'][$view.'s'] = $this->buildView($view, $data);
				
			
			// build menu view
			$files['admin_views']['menu'] = $this->buildView('menu', $data);
		}	
	
		
 		$this->writeFiles($data, $files);

		if(isset($data['module_db'])) $this->writeDump($data);
		
	}
	
	
	
    /**
     * Generate the content of the module config file.
     *
     * @param array $data The data used to generate the config file's content:
     *  string 'module_name'        The name given to the module.
     *  string 'module_description' The description text for the module.
     *  string 'module_version' 	The version of the module.
     *  string 'module_author'      The user name for the author.
     *
     * @return string The content of the config file.
    */
    private function buildConfig($data)
    {
        return $this->CI->load->view('files/config', $data, true);
    }	
    
    
	
	
    private function buildController($context, $data)
    {
       	return $this->CI->load->view('files/controller_'.$context, $data, true);
    }





    private function buildView($view, $data)
    {
        return $this->CI->load->view('files/view_'.$view, $data, true);
    }

	
    public function getDatabaseTypes()
    {
        return $this->databaseTypes;
    }
	
	private function writeDump($data)
	{
		
		$module_dir_name = MODULES_DIR.str_replace(' ', '_', strtolower($data['module_name']));
		
		$this->CI->load->dbutil();
		$backup = $this->CI->dbutil->backup(array(
	        'tables'        => $data['db_table_name'],   // Array of tables to backup.
	        'ignore'        => array(),                     // List of tables to omit from the backup
	        'format'        => 'txt',                       // gzip, zip, txt
	        'filename'      => '',              			// File name - NEEDED ONLY WITH ZIP FILES
	        'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
	        'add_insert'    => FALSE,                        // Whether to add INSERT data to backup file
	        'newline'       => "\n"                         // Newline character used in backup file
		));
		
		
		$this->CI->load->helper('file');
		write_file($module_dir_name.'/dump.sql', $backup);
		
	}
	
	
	
	
	
	private function writeFiles($data, $files)
	{
		// Module folder
		$module_dir_name = MODULES_DIR.str_replace(' ', '_', strtolower($data['module_name']));
		
		
		// modules/{module_name}/
		mkdir($module_dir_name, DIR_WRITE_MODE);
		
		
		// create folders structure
		mkdir($module_dir_name.'/assets', DIR_WRITE_MODE);
		mkdir($module_dir_name.'/config', DIR_WRITE_MODE);
		mkdir($module_dir_name.'/controllers', DIR_WRITE_MODE);
		mkdir($module_dir_name.'/views', DIR_WRITE_MODE);
		
		if(!empty($data['module_admin_views'])) mkdir($module_dir_name.'/views/atom', DIR_WRITE_MODE);
		if(!empty($data['module_public_views'])) mkdir($module_dir_name.'/views/site', DIR_WRITE_MODE);

		if($data['module_db'] != '') mkdir($module_dir_name.'/models', DIR_WRITE_MODE);			
		
		
        $this->CI->load->helper('file');
		
		foreach($files as $type => $file)
		{
			
			if($type == 'config')
			{
				write_file("{$module_dir_name}/config/config.php", $file);
			}
			
			
			if($type == 'controller')
			{
				foreach($file as $controller => $content)
				{
					if($controller == 'public')
						write_file("{$module_dir_name}/controllers/".ucfirst($data['module_name_right']).".php", $content);
					else
						write_file("{$module_dir_name}/controllers/".ucfirst($controller).".php", $content);
				}
			}
			
			
			if($type == 'public_views')
			{
				
				foreach($file as $view_folder => $view)
				{
					$view_folder = "{$module_dir_name}/views/site/{$view_folder}";
					if(!file_exists($view_folder)) mkdir($view_folder, DIR_WRITE_MODE);
					
					write_file("{$view_folder}/{$data['module_name_right']}.php", $view);
				}
			}	


			
			if($type == 'admin_views')
			{
				
				foreach($file as $view_folder => $view)
				{
					
					if($view_folder != 'menu')
					{
						$view_folder = "{$module_dir_name}/views/atom/{$view_folder}";
						if(!file_exists($view_folder)) mkdir($view_folder, DIR_WRITE_MODE);
						write_file("{$view_folder}/{$data['module_name_right']}.php", $view);
						
					} else 
						write_file("{$module_dir_name}/views/atom/menu.php", $view);
					
				}
			}	
			
			
		}
		
		
	}
	



	
}