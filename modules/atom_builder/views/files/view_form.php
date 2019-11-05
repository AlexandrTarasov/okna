<?php 

$string = "
		<div class=\"page-header\"> 
            <h1 class=\"col-xs-12 col-sm-12 text-center text-left-sm\"><a href=\"<?= MODULES_URL ?>$module_name_right\">".$module_name."</a> &nbsp; / &nbsp; <?= isset($$db_table_name_single) ? lang('atom_form_edit_item') : lang('atom_form_add_item')?></h1> 
        </div>	
        
        <div class=\"panel\">
	        <div class=\"panel-body\">
	        	<form action=\"/<?= uri_string()?>\" method=\"post\" class=\"form-horizontal\">
		";	
		
			
			if(isset($fields)){
			
			foreach ($fields as $field) {
					
				if($field["html"] != ''){
					
					$string .= "\n\t\t\t\t\t<div class=\"form-group\">
				        <label class=\"col-md-2\" for=\"".$field['name']."\">".$field['title']."</label>
						<div class=\"col-md-10\">";
					
					
					// Textarea
				 	if($field["html"] == 'textarea')
				 	{
				   	 $string .= "
			            <textarea class=\"form-control\" rows=\"3\" name=\"".$field['name']."\" id=\"".$field["name"]."\" placeholder=\"".$field['title']."\"><?= isset($".$db_table_name_single."['".$field["name"]."']) ? $".$db_table_name_single."['".$field["name"]."'] : '';?></textarea>";
				       
				        
				    // Select
				    } elseif($field["html"] == 'select'){
					    
					    $values = explode(",", $field['value']);
			
					    $string .= "
				            <select class=\"form-control\" name=\"".$field['name']."\" id=\"".$field['name']."\">";
			            	foreach($values as $value){
				           		$string .= "\n\t\t\t\t\t\t\t\t<option value=\"$value\" <?= (isset($".$db_table_name_single."['".$field['name']."']) && ($".$db_table_name_single."['".$field['name']."'] == '$value')) ? 'selected' : ''?>>$value</option>";
							}
							$string .= "\n\t\t\t\t\t\t\t</select>";
				     
				     
				    } elseif($field["html"] == 'checkbox'){
					    
					    $values = explode(",", $field['value']);
			            	
			            foreach($values as $value){
				           	$string .= "\t\t\t\t\t\t\t\t
			            	<label class=\"inline checkbox\">
				           		<input type=\"checkbox\" name=\"".$field['name']."[]\" value=\"$value\" <?= (isset($".$db_table_name_single."['".$field['name']."']) && ($".$db_table_name_single."['".$field['name']."'] == '$value')) ? 'checked' : ''?>> ".$value . "
				           	</label>";
							}
				     
				    } elseif($field["html"] == 'radio'){
					    
					    $values = explode(",", $field['value']);
			
			            	
			            foreach($values as $k => $value){
				           		$string .= "\t\t\t\t\t\t\t\t
			            	<label class=\"inline radio\">
				           		 <input type=\"radio\" name=\"".$field['name']."\" value=\"$value\" <?= (isset($".$db_table_name_single."['".$field['name']."']) && ($".$db_table_name_single."['".$field['name']."'] == '$value')) ? 'checked' : '".($k == 0 ? 'checked' : '')."'?>> ".$value . "
				           	</label>";
						}
					   	
					   	
				    } elseif($field["html"] == 'password'){
					    
					    $string .= "
			           		<input type=\"password\" class=\"form-control\" name=\"".$field['name']."\" id=\"".$field['name']."\" placeholder=\"".$field['title']."\" value=\"<?= isset($".$db_table_name_single."['".$field['name']."']) ? $".$db_table_name_single."['".$field['name']."'] : '';?>\" />"; 
					   	
					   	
				    } elseif($field["html"] == 'email'){
					    			
					    $string .= "
			           		<input type=\"email\" class=\"form-control\" name=\"".$field['name']."\" id=\"".$field['name']."\" placeholder=\"".$field['title']."\" value=\"<?= isset($".$db_table_name_single."['".$field['name']."']) ? $".$db_table_name_single."['".$field['name']."'] : '';?>\" />"; 

				    } elseif($field["html"] == 'date'){ // if enum = select
					  
				   $string .= "
			           		<input type=\"text\" class=\"form-control j-datepicker\" name=\"".$field['name']."\" id=\"".$field['name']."\" placeholder=\"".$field['title']."\" value=\"<?= isset($".$db_table_name_single."['".$field['name']."']) ? $".$db_table_name_single."['".$field['name']."'] : '';?>\" />"; 
			        
			        } else {
					
					$string .= "
			           		<input type=\"text\" class=\"form-control\" name=\"".$field['name']."\" id=\"".$field['name']."\" placeholder=\"".$field['title']."\" value=\"<?= isset($".$db_table_name_single."['".$field['name']."']) ? $".$db_table_name_single."['".$field['name']."'] : '';?>\" />";
			    	}
			    	
				$string .= "
					\t</div>
				\t</div>";	
				}
				
			}
			}
			
			$string .= "\n\t\t\t\t\t<input type=\"hidden\" name=\"id\" value=\"<?= isset($".$db_table_name_single."['id']) ? $".$db_table_name_single."['id'] : '';?>\" /> ";
			$string .= "\n\t\t\t\t\t<button type=\"submit\" class=\"btn btn-primary\"><?=lang('atom_save')?></button> ";
			$string .= "\n\t\t\t\t\t<a href=\"<?= MODULES_URL ?>$module_name_right\" class=\"btn btn-default\"><?=lang('atom_cancel')?></a>";
			$string .= "\n\t\t\t\t</form>
	    	</div>
	    </div>";


echo $string;

?>