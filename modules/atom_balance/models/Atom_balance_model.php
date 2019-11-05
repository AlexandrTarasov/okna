<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту');

class Atom_Balance_model extends CI_Model  {

	public $CI;
		
	
	public function __construct()
    {
	    $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
	    
		$this->ci = get_instance(); // CI_Loader instance
		$this->ci->load->config('atom/atom');
	}
	
	/**
	* 	This only for clients, who's on our support
	*/
	public function get_balance()
	{
		
		if (!$data = $this->cache->get('pwp_unpaid'))
		{
			$data = array('client_id' => $this->ci->config->item('atom_client_id'), 'client_api' => $this->ci->config->item('atom_client_api'));
			
			// use key 'http' even if you send the request to https://...		
			$data = file_get_contents($this->ci->config->item('atom_api_url') . 'get_unpaided/2', false, stream_context_create(array('http' => array('header'  => "Content-type: application/x-www-form-urlencoded\r\n", 'method'  => 'POST','content' => http_build_query($data)))));
		
			$data = json_decode($data, true);
			
			$this->cache->save('pwp_unpaid', $data, 3600);
		}
		
		return $data;
		
	}
	
	
	

}

?>