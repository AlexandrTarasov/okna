<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Filters
{	
	
	
	/**
	*  Preparing filters
	*  
	*  0 - page number
	*  1 - filters w\t db prefix
	*  2 - Get array
	*
	*/
	public function get_all($prefix, $table = null)
	{
		$CI =& get_instance();
		
		$filters = array(0 => '', 1 => '', 2 => array());
		
		$get = $CI->input->get(null, true);
				
		if(isset($get['page'])){
			$filters[0] = $get['page'];
			unset($get['page']);
		} else
			$filters[0] = 1;
		
		
				
		foreach($get as $k => $v){ 
				
			if($CI->db->field_exists($k, $table))
			{
								
				if($filters[1] != '') $filters[1] .= ' AND ';		
				
				
				$val = str_replace('"', '', $v);
			
				$val = html_entity_decode($val); // maybe html symbols encoded? decode it now bitch!				

				if(in_array($k, array('create_date', 'quote_date', 'client_date', 'last_test_date', 'last_report'))) $val = date('Y-m-d', strtotime($val));

				if(in_array(trim(substr($val,0,2)), array('>', '<', '>=', '<=', '='))) // meybe string have leading operators? use it!
				{
					$operator = trim(substr($val,0,2));
					$filters[1] .= '`'.$prefix.'`.`' . $k . '` '.$operator.' "'.trim(str_replace($operator, '', $val)).'"';
					
				} else 
					$filters[1] .= '`'.$prefix.'`.`' . $k . '` = "'.trim($val).'"'; // no operators, thats why filter will be = value

			} 
			
			$filters[2][$k] = $v;
		}
		
						
		return $filters;
	}	


	

}