<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth
{

	
	private $CI;
	private $permissions = array();
	public $user = array();
	
	
	
    public function __construct()
    {
        $this->CI = &get_instance();        
        
        
		if($this->CI->uri->segment(2) != 'two_step_auth' && $this->CI->uri->segment(2) != 'logout' && !$this->is_2fa_disabled())
		{
			redirect('/atom/two_step_auth');
		}
    
        
	}
	
	
	public function is_2fa_disabled()
	{
		if($this->is_logged_in() && $this->user['2fa_secret'] != '' && !$this->CI->session->userdata('2fa_disabled'))
			return false;
		else
			return true;
	}
	
	
	
	public function is_logged_in()
	{
		if($this->CI->session->userdata('id'))
		{
			$this->user = $this->get_user();
			
			if(!empty($this->user)){
				
				return true;
			} else 
				return false;
			
		} else 
			return false;
	}
	
	
	
	public function login($username, $password)
	{
		$user = $this->CI->db->select('id, username, role_id')->where(array('username_hash' => $this->hashing_data($username), 'password' => $this->hashing_data($password)))->get('atom_users',1)->row_array();
						
		if(!empty($user))
			return $user;
		else 
			return false;		
		
	}
	
	
	
	public function set_session($data)
	{
		$this->CI->session->set_userdata($data);
	}
	
	
	/**
	*  This function is hack for old modules
	*/
	public function get_session($data)
	{
		return $this->user[$data];
	}
	
	
	
	public function get_user()
	{
		if(empty($this->user))
		{
			$this->user = $this->CI->db->where('id', $this->CI->session->userdata('id'))->get('atom_users',1)->row_array();
		}	
		
		return $this->user;		
	}	
	
	
	public function hashing_data($item)
	{
		return crypt(md5($item), $this->CI->config->atom_config['atom_key']);
	}
	
	
	
	public function logout()
	{
		@$this->CI->session->sess_destroy();
	}
	
	
	
	private function load_permissions($role_id)
	{
		foreach($this->CI->db->select('arp.permission_id, ap.name')->join('atom_permissions ap', 'ap.id = arp.permission_id')->where('arp.role_id', $role_id)->get('atom_roles_permissions arp')->result_array() as $permission)
			$this->permissions[strtolower($permission['name'])] = $permission['permission_id'];
	}
	
	
	public function get_permissions_list()
	{
		$permissions = array();
		
		foreach($this->CI->db->get('atom_permissions')->result_array() as $permission)
			$permissions[] = strtolower($permission['name']);

		return $permissions;
	}
	
	
	
	public function get_user_role()
	{						
		return $this->user['role_id'];
	}
	
	
	public function get_system_roles()
	{
		$roles = array();
			
		foreach($this->CI->db->select('id,name')->get('atom_roles')->result_array() as $role)
			$roles[$role['name']] = $role['id'];
			
			
		return $roles;
	}
	
	
	public function check_permission($permission, $role_id = null)
	{
		if($role_id == null)
		{			
			if($this->is_logged_in())
				$role_id = $this->get_user_role();
			else
				return false;
		}
				
		
		if(empty($this->permissions)) $this->load_permissions($role_id);
		
		
		if(isset($this->permissions[strtolower($permission)])) 
			return true;
		else
			return false;
				
	}
	
	
}