<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту');

class Atom_model extends CI_Model  {

	public $CI;
			
	public function __construct()
    {
	    $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
	    $this->load->library('atom/curl');
	    
		$this->ci = get_instance(); // CI_Loader instance
	}
	
	
	private function api($cachename, $path, $params = array(), $debug = FALSE, $cache = TRUE, $time = 86000)
	{

		if ($debug)
		{
			var_dump($this->curl->simple_post($this->pwp_url . $path, $params));

		} else {

			if (!$data = $this->cache->get($cachename))
			{
				$data = json_decode($this->curl->simple_post($this->pwp_url . $path, $params), TRUE);

				if ($cache) $this->cache->save($cachename, $data, $time);
			}

			return $data;

		}
	}	
	

    /**
    * Create Menu from modules config
    *
    * If u need too put module menu to settings area, set array name – settings
    *    
    * @return  array
    */
	public function get_menu_items() // return array 
	{
		$menu = array();
		
		
		@$modules = array_filter(glob(MODULES_DIR.'*'), 'is_dir');

		foreach($modules as $module)
		{
			if(file_exists($module.'/views/atom/menu.php'))
				@include($module.'/views/atom/menu.php');
		}
		
		return $menu;
				
	}
	
	
	

}

?>