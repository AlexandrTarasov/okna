<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Renderer
{
	
	
	public static $data = array('header' => array(), 'footer' => array());
	
	
	
	
	
	/**
	 * view function.
	 *
	 * Render template
	 * 
	 * @access public
	 * @param mixed $template (default: null)
	 * @param mixed $view (default: null)
	 * @param mixed $data (default: null)
	 * @param bool $constructor (default: true)
	 * @return void
	 */
	public function view($template = null, $view = null, $data = null, $constructor = true)
	{
		
		$CI =& get_instance();
		
		
		if($constructor)
		{							
			$CI->load->view($template.'/all/header', (isset($data['header']) && is_array($data) ? array_merge(self::$data['header'], $data['header']) : self::$data['header']));
			$CI->load->view($template.'/'.$view, (isset($data) && is_array($data) ? array_merge(self::$data, $data) : self::$data));
			$CI->load->view($template.'/all/footer',(isset($data['footer']) && is_array($data) ? array_merge(self::$data['footer'], $data['footer']) : self::$data['footer']));
		
		} else {
			$data = isset($data) && is_array($data) ? array_merge(self::$data, $data) : self::$data;
			$CI->load->view($template.'/'.$view, $data);
		}
	}	
	
	


    /**
     * Set function.
     * 
     * Allow to setup $data static
     *
     * @access public
     * @static
     * @param string $var_name (default: '')
     * @param string $value (default: '')
     * @return void
     */
    public static function set($var_name = '', $value = '')
    {
	    
        if (is_array($var_name) && $value == '') {
            foreach ($var_name as $key => $val) {
	            
                self::$data[$key] = $val;
            }
        } else {
            self::$data[$var_name] = $value;
        }
        
    }

	
	
}