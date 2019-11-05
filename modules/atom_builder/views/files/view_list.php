<?php 

	$string = '
		<div class="page-header"> 
             <h1 class="col-xs-12 col-sm-12 text-center text-left-sm">'.ucfirst($module_name).'</h1> 
        </div>	
        ';


if(isset($module_actions) && in_array('add', $module_actions)){
	
	$string .= '
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-12">
                <a href="<?= MODULES_URL ?>'.$module_name_right.'/add" class="btn btn-primary"><i class="fa fa-plus"></i> <?=lang(\'atom_form_add_item\')?></a>
            </div>
        </div>
		';
}


if(isset($fields)){
$string .= '        
        <div class="panel">
	        <div class="panel-body">
		        <div class="tableScrollable">
		        ';
		        
		        		        
		        // If filters checked
		        if(isset($module_admin_filters) && $module_admin_filters == 'on'):
					$string .= '        
			        <table class="table table-hover table-bordered table-condensed table-smallheader j-tableFilterable">
			        	<thead>
			           		<tr>';
			           		foreach ($fields as $field) {
							    $string .= "\n\t\t\t\t\t\t\t\t<th><span data-name=\"".$field['name']."\">" . $field['title'] . "</span></th>";
							}
							$string .= "\n\t\t\t\t\t\t\t\t<th class=\"text-right\" width=\"100\"><?=lang(\'atom_list_actions\')?></th>
							</tr>
						</thead>
			        ";
			    else: 
					$string .= '        
			        <table class="table table-hover table-bordered table-condensed table-smallheader">
			        	<thead>
			           		<tr>';
			           		foreach ($fields as $field) {
							    $string .= "\n\t\t\t\t\t\t\t\t<th>" . $field['title'] . "</th>";
							}
							$string .= "\n\t\t\t\t\t\t\t\t<th class=\"text-right\" width=\"100\"><?=lang(\'atom_list_actions\')?></th>
							</tr>
						</thead>
					";			    
			    endif;
			    
			    
				
				$string .= "\t<tbody>
							<? foreach ($$db_table_name as \$$db_table_name_single): ?>
							<tr>";
			           			foreach ($fields as $field) {
								    $string .= "\n\t\t\t\t\t\t\t\t<td><?= \${$db_table_name_single}['". $field['name'] . "'] ?></td>";
								}	
														
								$string .= "\n\t\t\t\t\t\t\t\t<td style=\"text-align:right\" width=\"150px\">
									<div class=\"btn-group\">";
									
									
								if(in_array('card', $module_admin_views)){
								$string .= "
										<a href=\"<?= MODULES_URL ?>$module_name_right/view/<?=\${$db_table_name_single}['id'] ?>\" class=\"btn btn-default btn-sm\"><i class=\"fa fa-eye\"></i></a>
										";
								}
								
								if(in_array('edit', $module_actions)){
								$string .= "
										<a href=\"<?= MODULES_URL ?>$module_name_right/edit/<?=\${$db_table_name_single}['id'] ?>\" class=\"btn btn-primary btn-sm\"><i class=\"fa fa-pencil\"></i></a>
										";
								}
								
								if(in_array('delete', $module_actions)){
								$string .= "
										<a href=\"<?= MODULES_URL ?>$module_name_right/delete/<?=\${$db_table_name_single}['id'] ?>\" class=\"btn btn-danger btn-sm j-delete_item\"><i class=\"fa fa-trash\"></i></a>
										";
								}
										
								$string .= "
									</div>
								</td>
							</tr>
							<? endforeach;?>
						</tbody>
			        </table>
   
			    </div>
	        </div>
        </div>";
}        
        
$string .= "        
        <div class=\"row\">
            <div class=\"col-md-6\">
                <p class=\"text-muted\"><?=lang(\'atom_list_total_records\')?>: <?= \$total_rows ?></p>
            </div>
            <div class=\"col-md-6 text-right\">
                <?= \$this->pagination->create_links() ?>
            </div>
        </div>";


echo $string;

?>

