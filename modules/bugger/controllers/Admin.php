<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

include_once MODULES_DIR.'atom/controllers/Atom.php';

class Admin extends Atom
{
		
    function __construct()
    {
        parent::__construct();
		$this->lang->load('bugger', $this->language);
	}
	
	
	public function index()
	{
				
		if($this->config->item('atom_client_id') != '' && $this->config->item('atom_client_api') != '')
		{
			
		
		    if(($post = $this->input->post(null, true)) && $post['title'] != '' && $post['description'] != '')
		    {				
				$curl = curl_init($this->config->item('atom_api_url') . 'add_bug');
			    curl_setopt($curl, CURLOPT_POST, true);
			    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array('client_id' => $this->config->item('atom_client_id'), 'client_api' => $this->config->item('atom_client_api'), 'title' => $post['title'], 'description' => $post['description'])));
			    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			    $response = json_decode(curl_exec($curl), true);
			    curl_close($curl);
			    
				
				if(isset($response['status']) && $response['status'] == true)
					$this->session->set_flashdata('alert_success', lang('bugger_sended_success'));
				else
					$this->session->set_flashdata('alert_error', lang('bugger_sended_error'));

				redirect(site_url('/atom/module/bugger'));
				
					            
		    } else {
	
		        $data['header']['title'] = 'Bugger';
				$this->renderer->view('atom', 'forms/add', $data);                
		    }
		    
		 
		} else {
			die('Error: please input ID and API key first.');
		}
		
	}
	
	
}



/* Bugger module */
/* Developed by Perepelitsa Web Production */