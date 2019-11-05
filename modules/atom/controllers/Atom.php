<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Atom extends Atom_Controller {

	public $menu = array();		
	
	// Atom themes
	public $themes = array('default','asphalt','candy-black','candy-blue','candy-cyan','candy-green','candy-orange','candy-purple','candy-red','darklight-blue','darklight-cyan','darklight-green','darklight-orange','darklight-purple','darklight-red','dust','fresh','frost','purple-hills','silver','white','clean','adminflare');
	
	
	// default language is	
	public $language = 'english';

	public function __construct()
	{
		parent::__construct();
		
		
		// dependencies
		$this->load->database();
		$this->load->library('session');
		$this->load->helper('language');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('atom/atom_model');
		$this->load->helper('atom/config_file');
		$this->load->library('atom/auth');
		
		$this->config->atom_config = $this->load->config('atom/atom', true);
		$this->config->module_config = $this->load->config('atom/config', true);
		
		
		if(isset($this->auth->user['language']) || $this->session->userdata('language')){
			$this->language = $this->auth->user['language'] ? $this->auth->user['language'] : $this->session->userdata('language');
		}
		
				
		$this->lang->load('atom/atom', $this->language);	
		
				
		if($this->auth->is_logged_in() && $this->cache->get('maintenance') != FALSE && !in_array($this->uri->segment(2), array(null, 'login', 'logout')) && !$this->auth->check_permission('Atom.Maintanance'))
		{
			redirect('atom', 'refresh');			
		}
		
		
		if(!in_array($this->uri->segment(2), array('login', 'logout')) && !$this->auth->is_logged_in())
		{
			$this->session->set_userdata('return_to', uri_string());
			redirect('/atom/login', 'refresh');
		}
		
		        
        
		Renderer::set(array('header' => array('title' => '', 'menu' => $this->atom_model->get_menu_items())), '');
		
	}
	
	
	
	/**
	 * index function.
	 * 
	 * @access public
	 * @return void
	*/
	public function index()
	{								
		$data['header']['title'] = 'Atom';
		
					
		if($this->cache->get('maintenance') != FALSE && !$this->auth->check_permission('Atom.Maintanance'))
			$this->renderer->view('atom', 'default/maintenance', $data);
		else
		{
			$this->renderer->view('atom', 'default/home', $data);
		}
	}
	

	
	/**
	 * Auth process.
	 * 
	 * @access public
	 * @return void
	*/
	public function login()
	{			
		
		if($this->auth->is_logged_in()) redirect('/atom', 'refresh');


		$data['header']['title'] = 'Login';


		if(($post = $this->input->post(NULL, TRUE)) && isset($post['username']) && isset($post['password']))
		{			
			
			// Auth user
			if(($user = $this->auth->login($post['username'], $post['password'])))
			{

				if($this->auth->check_permission('Atom.Login', $user['role_id']))
				{
					
					$this->auth->set_session(array('id' => $user['id'], 'username' => $user['username']));	
					$user = $this->auth->get_user();							
					
					
					// IF system count login errors
					if($this->config->atom_config['login_errors'] && $user['login_errors'] > 0){
	
						$this->db->update('atom_users', array('login_errors' => 0), array('id' => $user['id']));
						$this->session->set_flashdata('alert_error', "someone ".$user['login_errors']." times tried to sign in into your account. We recommend that you immediately change your password and contact system support.");
					}		
					
					// IF user have page to return
					if($this->session->has_userdata('return_to'))		
					{
						$return_to = $this->session->userdata('return_to');
						$this->session->unset_userdata('return_to');
						redirect($return_to);
						
					}else	
						redirect(($this->auth->user['dashboard'] != '' ? $this->auth->user['dashboard'] : 'atom'), 'refresh');
					
				} else {
					$this->session->set_flashdata('alert_error', "<strong>Error:</strong> user doesn't have permission to enter the Atom.");
					redirect('/atom/login');
				}								
				
				
			} else { // Login failed
				
				
				// IF need to count login errors
				if($this->config->atom_config['login_errors'])
					@ $this->db->query("UPDATE atom_users SET login_errors = login_errors + 1 WHERE username_hash = '".$this->auth->hashing_data($post['username'])."'");

				

				// IF need to send email about login error
				if($this->config->atom_config['login_errors_email'])
				{	
					
				    $this->load->library('email', array('charset'=>'utf-8', 'wordwrap'=> TRUE, 'mailtype' => 'html'));
			        $this->email->to($this->config->atom_config['login_errors_email'])->from('noreply@'.preg_replace('/(http)|(\/)/', '', base_url()).'', 'Atom')->subject('Atom Login Error');
			        $this->email->message('<p>Someone tried to get into <b>'.$post['username'].'</b> account at <b>'.date('H:i:s d/m/Y').'</b> '. ($this->config->atom_config['login_errors_email_ip'] ? 'and someone IP was <b>'.$this->input->ip_address().'</b>.' : '.').'</p><p>If it were not for you, for more security, we recommend to change the password and contact system support – <a href="mailto:info@perepelitsa.com.ua">info@perepelitsa.com.ua</a></p>');
			        $this->email->send();
				}
				
				
				$this->session->set_flashdata('alert_error', "<strong>Error:</strong> incorrect data entered, we do not know this user.");
				redirect('atom/login', 'refresh');				

			}
			
			
		} else 
 			$this->renderer->view('atom', 'forms/login', $data);

	}



	public function two_step_auth()
	{
		
		
		if(!$this->auth->is_logged_in()) redirect('/atom');
		if($this->auth->user['2fa_secret'] == '' || ($this->auth->user['2fa_secret'] != '' && $this->session->userdata('2fa_disabled'))) redirect('/atom');
		
		
		if($this->input->post())
		{
			$post = $this->input->post();
			$this->load->library('GoogleAuthenticator');
						
			if($this->googleauthenticator->verifyCode($this->auth->user['2fa_secret'], $post['code'], 2))
			{
				$this->session->set_userdata('2fa_disabled', true);
				redirect('/atom');
				
			} else {
				$this->session->set_flashdata('alert_error', "Authenticator code entered incorrectly.");
				redirect('/atom/two_step_auth');
			}			
					
		} else {
					
			$data['header']['title'] = 'Two factor authentication';
			$data['header']['description'] = '';
			$data['header']['keywords'] = '';
								
			$this->renderer->view('atom', 'forms/2fa', $data);
			
		}
	}


	

	/**
	 *  Settings.
	 *  Save changes. View.
	 * 
	 * @access public
	 * @param mixed $mode (default: null)
	 * @return void
	 */
	public function settings($mode = null)
	{	
		
		
		$this->load->library('form_validation');
		$this->load->library('GoogleAuthenticator');
		
		if($this->input->post()){
			

			switch($mode){
				
				
				case 'information':

				
				$this->form_validation->set_rules("email", 'Email', "trim|valid_email|required");
				$this->form_validation->set_rules("dashboard", 'Dashboard URL', "trim");
				$this->form_validation->set_rules("theme", 'Theme', "trim|in_list[".implode(',', $this->themes)."]|required");
					
					

				if(($this->form_validation->run() != FALSE))
				{


					$this->db->update('atom_users', array('email' => htmlspecialchars($this->input->post('email')), 'theme' => htmlspecialchars($this->input->post('theme')), 'dashboard' => $this->input->post('dashboard')), array('username' => $this->session->userdata('username')));
					
									
					if($this->db->affected_rows() > 0)
					{
						$this->session->set_flashdata('alert_success', "information successfully updated");
						$this->session->set_userdata('theme', $this->input->post('theme'));
	
					} else
						$this->session->set_flashdata('alert_error', "an internal error occurred, please try again.");
						
					redirect('/atom/settings');
				} 

				
				break; 
				
				
				
				case 'password':

					$this->form_validation->set_rules("oldpassword", 'Old password', array("trim", "required", array('check_old_pass', function($pass){
						
						return ($this->db->get_where('atom_users', array('username' => $this->session->userdata('username'), 'password' =>  crypt(md5($pass),$this->config->atom_config['atom_key'])),1)->num_rows() > 0);
						
					})), array('check_old_pass' => 'Old password not correct.'));
					$this->form_validation->set_rules("password", 'New Password', "trim|matches[confirmpassword]|required");
					$this->form_validation->set_rules("confirmpassword", 'Confirm Password', "trim|required");
				
					if(($this->form_validation->run() != FALSE))
					{
						
						
						$post = $this->input->post(null, TRUE);
						$oldpass = crypt(md5($post['oldpassword']), $this->config->atom_config['atom_key']);
						
								
						$this->db->update('atom_users', array('password' => crypt(md5($post['password']), $this->config->atom_config['atom_key'])), array('username' => $this->session->userdata('username'), 'password' => $oldpass),1);
	
						if($this->db->affected_rows() > 0)
							$this->session->set_flashdata('alert_success', "password successfully changed");
						else
							$this->session->set_flashdata('alert_errors', "an internal error occurred, please try again.");													
							
												
						redirect('/atom/settings');
					}

				break;
				
				
				case 'atom':
				
					if(!$this->auth->check_permission('Atom.Settings.Atom')) redirect('/atom/settings');
								
									
					if(write_config('atom', $this->input->post(), 'atom'))
						$this->session->set_flashdata('alert_success', "atom config successfully saved.");
					else
						$this->session->set_flashdata('alert_error', "atom config successfully saved.");
						
					redirect('/atom/settings');

				break;
				
				
		        case '2fa_on':
		        
					$this->form_validation->set_rules('code', 'Код двухфакторной аутентификации', 'required|regex_match[/[0-9]+$/]');
					$this->form_validation->set_rules('secret', 'Секретный ключ', 'required');
					
				
					if ($this->form_validation->run() != FALSE)
					{
						$post = $this->input->post();	
						
						if ($this->googleauthenticator->verifyCode($post['secret'], $post['code'], 2)) {
							
							
							$this->db->update('atom_users', array(
								'2fa_secret' => trim($post['secret'])
							), array('id' => $this->auth->get_session('id')));		
			
			
							if($this->db->affected_rows() > 0) {
								
							    $this->load->library('email', array('charset'=>'utf-8', 'wordwrap'=> TRUE, 'mailtype' => 'html'));
						        $this->email->to($this->auth->user['email'])->from('noreply@'.$_SERVER['HTTP_HOST'], 'ATOM')->subject('В вашем аккаунте подключена двухфакторная авторизация');
						        $this->email->message($this->load->view('atom/emails/2fa_on', array('account' => array('name' => $this->auth->user['username'])), true));
						        $this->email->send();
															
								$this->session->set_flashdata('alert_success', "Двухфакторная аутентификация подключена.");
								
							} else
								$this->session->set_flashdata('alert_error', "Ошибка сохранения ключа, попробуйте ещё раз.");
			
			
						} else
							$this->session->set_flashdata('alert_error', "Код с вашего устройства не верен. Сосканируйте QR код снова.");
	
						
					} else
						$this->session->set_flashdata('alert_error', validation_errors());
	
					
					redirect('/atom/settings');
	
		        break;
		        
	
		        case '2fa_off':
		        
					$this->form_validation->set_rules('code', 'Код двухфакторной аутентификации', 'required|regex_match[/[0-9]+$/]');
	
				
					if ($this->form_validation->run() != FALSE)
					{
						$post = $this->input->post();	
						
						if ($this->googleauthenticator->verifyCode($this->auth->user['2fa_secret'], $post['code'], 2)) {

							
							$this->db->update('atom_users', array(
								'2fa_secret' => null,
							), array('id' => $this->session->userdata('id')));		
			
			
							if($this->db->affected_rows() > 0) {
								
							    $this->load->library('email', array('charset'=>'utf-8', 'wordwrap'=> TRUE, 'mailtype' => 'html'));
						        $this->email->to($this->auth->user['email'])->from('noreply@'.$_SERVER['HTTP_HOST'], 'ATOM')->subject('В вашем аккаунте отключена двухфакторная авторизация');
						        $this->email->message($this->load->view('atom/emails/2fa_off', array('account' => array('name' => $this->auth->user['username'])), true));
						        $this->email->send();
															
								$this->session->set_flashdata('alert_success', "Двухфакторная аутентификация отключена.");
								
							} else
								$this->session->set_flashdata('alert_error', "Ошибка обновления ключа, попробуйте ещё раз.");
			
			
						} else
							$this->session->set_flashdata('alert_error', "Код с вашего устройства не верен. Сосканируйте QR код снова.");
	
						
					} else
						$this->session->set_flashdata('alert_error', validation_errors());
	
					redirect('/atom/settings');
		        break;
		        
	
		        default:
					$this->session->set_flashdata('alert_error', "Sections of settings not correct.");
					redirect('/atom/settings');
		        break;
					
				
				
			}
						
					
		} 
		
		
		
		if($this->auth->check_permission('Atom.Settings.Atom'))
			$data['atom_settings'] = $this->config->atom_config;
		
		

		// generates the secret code
		$data['two_step']['secret'] = $this->googleauthenticator->createSecret();
		
				
		// generates the QR code for the link the user's phone with the service
		$data['two_step']['qrCodeUrl'] = $this->googleauthenticator->getQRCodeGoogleUrl('Atom – ' . $_SERVER['HTTP_HOST'], $this->auth->get_session('username'), $data['two_step']['secret']);
		
		
			
		$data['themes'] = $this->themes;
		$data['user'] = $this->db->where('username', $this->session->userdata('username'))->get('atom_users', 1)->row_array();		
		$data['header']['title'] = 'Settings';
	    
		$this->renderer->view('atom', 'default/settings', $data);


	}
	
	
	
	/**
	 * Toggle Maintanance mode.
	 * 
	 * @access public
	 * @param bool $status (default: false)
	 * @return void
	*/
	public function maintenance($status = false)
	{
		if(!$this->auth->check_permission('Atom.Maintanance')) redirect('/atom');
		
		if($status)
			$this->cache->save('maintenance', 'true', 259200);			
		else
			$this->cache->delete('maintenance');

		
		redirect('/atom/');
		
	}
	
	
	
	/**
	 * Toggle language for user.
	 * 
	 * @access public
	 * @param  string $language
	 * @return void
	*/
	public function language($language)
	{
		$this->session->set_userdata(array('language' => $language));
		$this->db->update('atom_users', array('language' => $language), array('id' => $this->session->userdata('id')));
		redirect('atom');	
	}

	
	
	
	/**
	 * Logout process.
	 * 
	 * @access public
	 * @return void
	*/
	public function logout()
	{		
		$this->auth->logout();
		redirect('/atom/login', 'refresh');
	}	
	
	
	
}
