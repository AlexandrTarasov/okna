<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * MY_Controller
 * 
 * Use this controller for inserting some functionality to Front & Backend.
 *  
 * @extends MX_Controller
*/
 
class Atom_Controller extends Global_Controller {
	
    public function __construct() {
       parent::__construct();
       
       $this->showProfiler();
    
    }
    
    

	
	
    /**
     * showProfiler
     * 
     * This function decides whether to use the profiler
     * 
     * @access protected
     * @param bool $frontEnd (default: true)
     * @return void
     */
    protected function showProfiler()
    {
	    
        $isCliRequest = is_cli();
        
        // if request not from CMD and not from Ajax
        if (! $isCliRequest && !$this->input->is_ajax_request())
        {
			$this->load->library('atom/Auth');
	        // if user can view profiler
           if($this->auth->is_2fa_disabled() && $this->auth->check_permission('Profiler.Show')){
                $this->load->library('Console');
                $this->output->enable_profiler(true);
            }
        }
        
    }



}