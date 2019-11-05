<?php 

$string = "  
		
		<div class=\"page-header\">
            <h1 class=\"col-xs-12 col-sm-12 text-center text-left-sm\"><a href=\"<?= MODULES_URL ?>$module_name_right\">".$module_name."</a> &nbsp; / &nbsp; ".singular($module_name)." item</h1> 
        </div>	
        
        <div class=\"panel\">
	        <div class=\"panel-body\">

		        <table class=\"table\">";
		        
		        if(isset($fields)){
				foreach ($fields as $field) {
				    $string .= "\n\t\t\t\t\t<tr>
				    \t<td>".$field['title']."</td>
				    \t<td><?= $".$db_table_name_single."['".$field['name']."']; ?></td>
				    </tr>";
				}
				}
				$string .= "\n\t\t\t\t</table>
				<a href=\"<?= MODULES_URL ?>$module_name_right\" class=\"btn btn-default\">Return to list</a>
			</div>
		</div>
    ";



echo $string;

?>