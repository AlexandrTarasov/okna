<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');


include_once getcwd().'/modules/atom/controllers/Atom.php';


class Admin extends Atom
{
		
	
	/* Build form */
	public $contexts = array('public','admin');
	public $public_views = array('list','card');
	public $views = array('list','form','card');
	public $actions = array('add','edit','delete');
	public $html = array('', 'input', 'textarea', 'select', 'date', 'checkbox', 'radio', 'password', 'email');
	
	
	
	
	
    function __construct()
    {
        parent::__construct();	
        
		if(!$this->auth->check_permission('Builder')) redirect('/atom');
        	
	}	
	
	
    public function index()
    {
	    // modules to screen
	    $data['modules'] = array();
	    
		$modules = array_filter(glob(MODULES_DIR.'*', GLOB_BRACE), 'is_dir');
		
		
		$permissions = $this->auth->get_permissions_list();
		
				
		foreach($modules as $module)
		{
			
			if(file_exists("$module/config/config.php"))
			{
				
				include("$module/config/config.php");
				
				$module_name = basename($module);
								
				$data['modules'][$module_name] = $config['module_config'];
				
				
				$data['modules'][$module_name]['dump'] = file_exists($module.'/dump.sql');
				$data['modules'][$module_name]['db_table_exists'] = $this->db->table_exists($module_name);
				
				$data['modules'][$module_name]['permissions_installed'] = true;
				
				
				if(isset($data['modules'][$module_name]['permissions']) && !empty($data['modules'][$module_name]['permissions']))
				{
					
					foreach($data['modules'][$module_name]['permissions'] as $permission => $description)
					{
						if(!in_array(strtolower($permission), $permissions))
							$data['modules'][$module_name]['permissions_installed'] = false;
					}
				}
				
				
				$data['modules'][$module_name]['updates'] = $this->check_for_updates($module_name, $data['modules'][$module_name]['version']);
				
				
				
			}
			
		}
		
		
		
        $data['header']['title'] = 'Builder for modules';
		
		
		
		$this->renderer->view('atom', 'lists/builder', $data);        
    }




	/**
	 * install_module function.
	 * 
	 * @access public
	 * @return void
	 */
	public function install_permissions($module_name)
	{
		
		$permissions = $this->auth->get_permissions_list();
		
		if(file_exists(MODULES_DIR."$module_name/config/config.php"))
		{
			
			include(MODULES_DIR."$module_name/config/config.php");
			
							
			if(isset($config['module_config']['permissions']) && !empty($config['module_config']['permissions']))
			{
				
				$installed = 0;
				
				foreach($config['module_config']['permissions'] as $permission => $description)
				{
					if(!in_array(strtolower($permission), $permissions))
					{
						$this->db->insert('atom_permissions', array('name' => $permission, 'description' => $description)); 
						
						// Set up default permission for Developer role
						$this->db->insert('atom_roles_permissions', array('permission_id' => $this->db->insert_id(), 'role_id' => '4'));
						
						$installed++;
					}

				}
				
				
				$this->session->set_flashdata('modules_success', "<strong>Success: </strong> $installed permissions installed for module <b>$module_name</b>.");
			
				
				
			} else 
				$this->session->set_flashdata('modules_error', "<strong>Error: </strong> module <b>$module_name</b> doesn't have any permissions.");
						
			
		} else 
			$this->session->set_flashdata('modules_error', "<strong>Error: </strong> module <b>$module_name</b> config file doesn't exist in module folder!");

		
		
		redirect(site_url(MODULES_URL.'atom_builder'));

		
	}
	
	



	/**
	 * install_module function.
	 * 
	 * @access public
	 * @return void
	 */
	public function install_dump($module_name)
	{
		
		if(file_exists(MODULES_DIR. "{$module_name}/dump.sql"))
		{
			
			if(!$this->db->table_exists($module_name))
			{
				$sql = file_get_contents(MODULES_DIR. "{$module_name}/dump.sql");
				
				$sqls = explode(';', $sql);
				array_pop($sqls);
				
				foreach($sqls as $statement){
				    $statment = $statement . ";";
				    $this->db->query($statement);   
				}
				
				
				$this->session->set_flashdata('modules_success', "<strong>Success: </strong> module <b>$module_name</b> dump executed successfully!");
				redirect(site_url(MODULES_URL.'atom_builder'));
				
				
			} else {
				
				$this->session->set_flashdata('modules_error', "<strong>Error: </strong> table of module <b>$module_name</b> already exist in database!");
				redirect(site_url(MODULES_URL.'atom_builder'));
			
			
			}			
						
			
		} else {
			
			$this->session->set_flashdata('modules_error', "<strong>Error: </strong> module <b>$module_name</b> module already installed!");
			redirect(site_url(MODULES_URL.'atom_builder'));
			
		}
		
		
	}
	
	
	
	
	
	
	/**
	 * update function.
	 * 
	 * @access public
	 * @param bool $do_update (default: false)
	 * @return void
	 */
	public function update_module($module = null, $do_update = false)
	{	
		
		if(!$module)
		{
			$this->session->set_flashdata('alert_error', "please, choose module for update.");
			redirect(MODULES_URL.'atom_builder');
		}
		
		
		$module_dir = MODULES_DIR.$module;
		
		
		if(!file_exists($module_dir."/config/config.php"))
		{
			$this->session->set_flashdata('alert_error', "module {$module} don't have config file. Update failed.");
			redirect(MODULES_URL.'atom_builder');	
		}
		
				
		// $config['module_config']
		include($module_dir."/config/config.php");
		
		
		
		// if process not completed
		if(!$this->session->flashdata("update_process"))
		{
		
			$data['content'] = '';
			$updates_dir = getcwd().'/uploads/updates/';
	
			$updates_found = $this->check_for_updates($module, $config['module_config']['version']);
	
			$data['updated'] = false;
			$data['config'] = $config['module_config'];
			
	
			if(!empty($updates_found))
			{
				
				$data['content'] .= '<h3 class="text-center">You have <strong>' . count($updates_found) . ' updates</strong> for '.$config['module_config']['name'].'</h3>';
				
				foreach($updates_found as $version)
				{
					
					$data['content'] .= "<legend>v $version</legend>";
					
					
					if($do_update)
					{
						// starting magic..
						$handle = zip_open($updates_dir.$module.'/'.$version.'.zip');
						
			            $data['content'] .= '<ul>';
			            while ($file = zip_read($handle) )
			            {
			                $thisFileName = zip_entry_name($file);
			                $thisFileDir = dirname($thisFileName);
			               
			                // Some rules
			                if(preg_match('/(^__MACOSX)/', $thisFileDir) || $thisFileName == '.DS_Store') continue; // if admin use macosx it save into zip some trash. Thats why we skip it.
			                if(substr($thisFileName,-1,1) == '/') continue; // Continue if its not a file		
			
			
			                //Make the directory if we need to...
			                if (!is_dir($module_dir.'/'.$thisFileDir ) )
			                {
			                     mkdir($module_dir.'/'.$thisFileDir, 0755, true);
			                     $data['content'] .= '<li>Created Directory '.$thisFileDir.'</li>';
			                }
			               
			                
			                if ( !is_dir($module_dir.'/'.$thisFileName)){ //Overwrite the file
				                
			                    $data['content']  .= '<li>'.$thisFileName.'...........';
			                    $contents = zip_entry_read($file, zip_entry_filesize($file));
			                    $contents = str_replace("n", "n", $contents);
			                    $updateThis = '';
			                   
			                    // if update zip contains upgrade.php – it will be included into update script
			                    // thats why u can place here any sql or other execute command
			                    if ($thisFileName == 'upgrade.php')
			                    {
			                        $upgradeExec = fopen ('upgrade.php','w');
			                        fwrite($upgradeExec, $contents);
			                        fclose($upgradeExec);
			                        include ('upgrade.php');
			                        unlink('upgrade.php');
			                        $data['content']  .=' executed</li>';
			                    }
			                    else
			                    {
			                        $updateThis = fopen($module_dir.'/'.$thisFileName, 'w');
			                        fwrite($updateThis, $contents);
			                        fclose($updateThis);
			                        unset($contents);
			                        $data['content']  .=' updated</li>';
			                    }
			                }
		
			            }
			            
			            $data['content'] .= '<li><b>system update to version '.$version.' successfully completed</b></li>';
			            $data['content'] .= '</ul>';
			            
			            $data['updated']  = TRUE;
			            
			            unlink($updates_dir.$module.'/'.$version.'.zip');
					}
					
					
					
				}
				
				
			}
						
			
			
			if($data['updated'])
			{ 
				$this->session->set_flashdata('update_process', $data['content']);			
				$this->session->set_flashdata('alert_success', "<strong>Success:</strong> Atom successfully updated to latest version $version.");			
				redirect(MODULES_URL.'atom_builder/update_module/'.$module.'/true');
			}
			
		} else {
			 $data['updated']  = TRUE;
			 $data['content'] = $this->session->flashdata("update_process");
		}


		$data['header']['title'] = 'Module Updater';
		
		$this->renderer->view('atom', 'cards/update', $data);

	}
	
		
	
	private function check_for_updates($module_name, $current_version)
	{
		$updates_found = array();
		
		if($this->config->item('atom_client_api') && $this->config->item('atom_client_id')){

		
			$updates_dir = getcwd().'/uploads/updates/';
			$module_updates_dir = $updates_dir.$module_name . '/';						
	
			$server = $this->curl->simple_post('http://atom.perepelitsa.com.ua/updater/check_updates', array('module' => $module_name, 'version' => $current_version, 'api_key' => $this->config->item('atom_client_api'), 'api_id' => $this->config->item('atom_client_id')));		
			
					
			if ($server)
			{				
				// check is uploads folder exists
				if(!is_dir(getcwd().'/uploads')) mkdir(getcwd().'/uploads', DIR_WRITE_MODE);
				
				// check is uploads updates folder exists
				if(!is_dir($updates_dir)) mkdir($updates_dir, DIR_WRITE_MODE);
				
				// check is uploads updates module folder exists
				if(!is_dir($module_updates_dir)) mkdir($module_updates_dir, DIR_WRITE_MODE);
				
							
				foreach(json_decode($server, true) as $version => $url)
				{	
												
					if($version > $current_version)
					{
						
						$updates_found[] = $version;
						
											
						if (get_headers($url.'?api_key='.$this->config->item('atom_client_api').'&api_id='.$this->config->item('atom_client_id'), 1)[0] == 'HTTP/1.1 200 OK')
						{						            	
				            			            			                
			                $new_update = file_get_contents($url.'?api_key='.$this->config->item('atom_client_api').'&api_id='.$this->config->item('atom_client_id'));
			                $handler = fopen($module_updates_dir.$version.'.zip', 'w');
			                
			                if ( !fwrite($handler, $new_update)){
								$this->session->set_flashdata('alert_error', "new update for module {$module_name} found, but could not save new update. Operation aborted.");
				                exit(); 
				            }
				            
			                fclose($handler);
							
		            	} 
						
							            	 
					}
									
					
				}
				
			}
		} 
		
		return $updates_found;
	}

	
	
	/**
	 * delete_module function.
	 * 
	 * @access public
	 * @param mixed $module
	 * @return void
	 */
	public function delete_module($module)
	{
		$dir = MODULES_DIR.$module;
		
		
		 if (is_dir($dir)){
		 	
		 	
		 	$this->load->helper('file');
		 	delete_files($dir, TRUE);
		 	rmdir($dir);		 	
		    
		    $this->session->set_flashdata('modules_success', "<strong>Success: </strong> module <b>$module</b> successfully deleted!");
			redirect(site_url(MODULES_URL.'atom_builder'));
		    
		} else {
			
			$this->session->set_flashdata('modules_error', "<strong>Error: </strong> module <b>$module</b> folder not exist!");
			redirect(site_url(MODULES_URL.'atom_builder'));
			
		}		
	}
	
	
	

	public function create_module($add_fields = 0)
	{
		
		
		$this->load->library('form_validation');
		$this->load->library('builder');
		$this->load->helper('inflector');
		
		
		
		$fields_count = 0;
		
        $this->form_validation->set_rules("module_name", 'Name',  array("trim", "alpha_numeric_spaces", "required", array('check_module_exists', function($str){ if (is_dir(MODULES_DIR . str_replace(' ', '_', strtolower($str)))) return FALSE; else return TRUE;})), array('check_module_exists' => 'Module with this name already exist.'));
        
        $this->form_validation->set_rules("module_description", 'Description', "trim");
        $this->form_validation->set_rules("module_author", 'Author', "trim");
        $this->form_validation->set_rules("module_version", 'Version', "trim");
        
        
        $this->form_validation->set_rules("module_contexts[]", 'Contexts', "trim|in_list[".implode(',', $this->contexts)."]");
        $this->form_validation->set_rules("module_public_views[]", 'Public Views', "trim|in_list[".implode(',', $this->public_views)."]");
        $this->form_validation->set_rules("module_admin_views[]", 'Admin Views', "trim|in_list[".implode(',', $this->views)."]");
        
        $this->form_validation->set_rules("module_admin_filters", 'Admin Filters', "trim|in_list[on,]");
        
        
        $this->form_validation->set_rules("module_db", 'Module Database', "trim|in_list[no,new,existing]");
        $this->form_validation->set_rules("module_actions[]", 'Actions', "trim|in_list[".implode(',', $this->actions)."]");

        $this->form_validation->set_rules("new_db_name", 'New Database Name', array('trim', array('check_db_exists', function($name){ if($this->db->table_exists($name)) return FALSE; else return TRUE;})), array('check_db_exists' => 'Table in database with this name already exists.'));



        $this->form_validation->set_rules("db_table_name", 'Database Name', "trim");


		$post = $this->input->post();
		
		
		
		
		if(isset($post['module_db']) && ($post['module_db'] == 'existing' || $post['module_db'] == 'new') && isset($post['fields']) && !empty($post['fields']))
		{
			foreach($post['fields'] as $field => $data)
			{				

				$this->form_validation->set_rules("fields[$field][title]", "$field title", "trim|required");
				$this->form_validation->set_rules("fields[$field][name]", "$field name", "trim|required|alpha_dash");
				$this->form_validation->set_rules("fields[$field][html]", "$field html tag", "trim|in_list[".implode(',', $this->html)."]");

			}
		}
		
		
		
		
		if(($this->form_validation->run() != FALSE) && ($post['module_db'] == 'no' || (($post['module_db'] == 'existing' || $post['module_db'] == 'new') && isset($post['fields']) && !empty($post['fields']))))
		{
		
		
			
				
			if($post['module_db'] == 'new')
			{
				
				if(!$this->builder->build_db_table($post))
				{
					$this->session->set_flashdata('alert_error', "some error happened, when creating database table <b>".$post['db_table_name']."</b>. Table not created, try again.");
				}
				
				
				// Need to create a new database
			}
			
			
			
			$this->builder->build_module($post);
							
						
		    $this->session->set_flashdata('alert_success', "<b>".$post['module_name']."</b> created successfully!");
			redirect(site_url(MODULES_URL.'atom_builder'));
			
							
			
						
			
		} elseif(isset($post['module_db']) && $post['module_db'] == 'existing'){ 
			
			
			if($this->db->table_exists($this->input->post('db_table_name'))){
				
				foreach($this->db->field_data($this->input->post('db_table_name')) as $column)
				{
					$column->value = $column->max_length;
					
					if($column->type == 'set' || $column->type == 'enum')
					{
						$vals = array();
						preg_match_all("/'(.*?)'/", $this->db->query("SHOW COLUMNS FROM ".$this->input->post('db_table_name')." LIKE '".$column->name."'")->row()->Type, $vals);
						
						
						$column->value = implode(',', $vals[1]);						
						
					}
					
					
					
					$data['columns'][] = $column;
					
				}
				
				
			}else {
				
				$this->session->set_flashdata('alert_error', "table <b>".$this->input->post('db_table_name')."</b> not exist in database. Please select another table from list!");
				
			}
			
			
		} elseif(isset($post['module_db']) && $post['module_db'] == 'new' && !empty($post['fields'])){ 
			
						
			foreach ($this->input->post('fields') as $k => $field)
			{
				$data['columns'][$k] = (object) $field;
				$data['columns'][$k]->primary_key = 0;
				
			}
					
		}
		
		
        Renderer::set('contexts', $this->contexts);
        Renderer::set('public_views', $this->public_views);
		Renderer::set('views', $this->views);
		Renderer::set('actions', $this->actions);
		
		Renderer::set('html', $this->html);



        foreach (array_keys($this->builder->getDatabaseTypes()) as $key) {
            $data['dbtypes'][$key] = $key;
        }

		
		$data['tables'] =  $this->db->query('SHOW TABLE STATUS')->result_array();    

		$data['header']['title'] = 'New Module';
		$this->renderer->view('atom', 'forms/create_module', $data);        

		
		
	}
	
	
	


    


}

