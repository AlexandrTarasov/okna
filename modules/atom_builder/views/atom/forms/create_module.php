		<div class="page-header">
			<h1 class="col-xs-12 col-sm-12 text-center text-left-sm"><a href="<?=MODULES_URL?>atom_builder">Builder</a> &nbsp; / &nbsp;  Create Module</h1>
		</div>
        
        <div class="panel">
	        <div class="panel-body">
	        	<form action="/<?= uri_string()?>" method="post" class="form-horizontal" id="module">
		
		
		            <fieldset id="module_details">
		                <legend>Module Details</legend>

						<div class="form-group <?= form_error('module_name') ? ' has-error' : ''; ?>">
				            <label class="col-md-2" for="module_name">Name</label>
				            <div class="col-md-10">
				           		<input type="text" class="form-control" name="module_name" id="module_name" placeholder="Module Name" value="<?= set_value("module_name"); ?>" />
<!-- 				           		 <p class="help-block"><a href="#" data-toggle="collapse" data-target="#mb_show_advanced">Show advanced settings</a></p> -->
						   	</div>
				        </div>
				        
				        
				        <div id="mb_show_advanced" class="collapse in">
							
			                <div class="form-group <?= form_error('module_description') ? ' has-error' : ''; ?>">
			                    <label for="module_description" class="col-sm-2">Description</label>
			                    <div class="col-sm-10">
			                        <input name="module_description" id="module_description" type="text" class="form-control" value="<?= set_value("module_description"); ?>" placeholder="" />
			                    </div>
			                </div>
			                
			                
			                <div class="form-group <?= form_error('module_author') ? ' has-error' : ''; ?>">
			                    <label for="module_author" class="col-sm-2">Author</label>
			                    <div class="col-sm-10">
			                        <input name="module_author" id="module_author" type="text" class="form-control" value="<?= set_value("module_author", 'Perepelitsa Web Production'); ?>" placeholder="" />
			                    </div>
			                </div>
			                
			                <div class="form-group <?= form_error('module_version') ? ' has-error' : ''; ?>">
			                    <label for="module_version" class="col-sm-2">Version</label>
			                    <div class="col-sm-10">
			                        <input name="module_version" id="module_version" type="text" class="form-control" value="<?= set_value("module_version", '0.0.1'); ?>" placeholder="" />
			                    </div>
			                </div>
			                
			                

			                
			                
			                <div class="form-group <?= form_error('module_contexts') ? ' has-error' : ''; ?>">
			                    <?= form_error("module_contexts"); ?>
			                    
			                    <label class="col-sm-2" id="module_contexts">Contexts</label>
			                    <div class="col-sm-10" aria-labelledby="module_contexts" role="group">
				                    
				                    
				                    <? foreach($contexts as $context):?>
				                    
                                    <label class="checkbox" for="form_action_list">
										<input type="checkbox" name="module_contexts[]" value="<?=$context?>" <?= set_checkbox('module_contexts', $context, true)?>> <?= ucfirst($context)?>
									</label>

				                    <? endforeach;?>
				                    

			                    </div>
			                </div>
			                
			                
			                <div class="form-group <?= form_error('module_public_views') ? ' has-error' : ''; ?>">
			                    <?= form_error("module_public_views"); ?>
			                    
			                    <label class="col-sm-2" id="module_public_views">Public Views</label>
			                    <div class="col-sm-10" aria-labelledby="module_public_views" role="group">
				                    
				                    
				                    <? foreach($public_views as $view):?>
				                    
                                    <label class="checkbox" for="module_public_views">
										<input type="checkbox" name="module_public_views[]" value="<?=$view?>" <?= set_checkbox('module_public_views', $view, true)?>> <?= ucfirst($view)?>
									</label>

				                    <? endforeach;?>
				                    

			                    </div>
			                </div>
			                
			                
			                <div class="form-group <?= form_error('module_admin_views') ? ' has-error' : ''; ?>">
			                    <?= form_error("module_admin_views"); ?>
			                    
			                    <label class="col-sm-2" id="module_admin_views">Admin Views</label>
			                    <div class="col-sm-10" aria-labelledby="module_admin_views" role="group">
				                    
				                    
				                    <? foreach($views as $view):?>
				                    
                                    <label class="checkbox" for="form_action_list">
										<input type="checkbox" name="module_admin_views[]" value="<?=$view?>" <?= set_checkbox('module_admin_views', $view, true)?>> <?= ucfirst($view)?>
									</label>

				                    <? endforeach;?>
				                    

			                    </div>
			                </div>
			                
			                
			                
			                <div class="form-group <?= form_error('module_admin_filters') ? ' has-error' : ''; ?>">
			                    <?= form_error("module_admin_filters"); ?>
			                    
			                    <label class="col-sm-2" id="module_admin_filters">Filters for Admin</label>
			                    <div class="col-sm-10" aria-labelledby="module_admin_filters" role="group">
				                    				                    
                                    <label class="checkbox" for="module_admin_filters">
										<input type="checkbox" name="module_admin_filters" value="on" <?= set_checkbox('module_admin_filters', "on", TRUE)?>> Include filters library?
									</label>				                    

			                    </div>
			                </div>
			                
			                
			                
			                <div class="form-group <?= form_error('module_actions') ? ' has-error' : ''; ?>">
			                    <?= form_error("module_actions"); ?>
			                    
			                    <label class="col-sm-2" id="module_actions">Actions</label>
			                    <div class="col-sm-10" aria-labelledby="module_actions" role="group">
				                    
				                    
				                    <? foreach($actions as $action):?>
				                    
                                    <label class="checkbox" for="">
										<input type="checkbox" name="module_actions[]" value="<?=$action?>" <?= set_checkbox('module_actions', $action, true)?>> <?= ucfirst($action)?>
									</label>

				                    <? endforeach;?>
				                    

			                    </div>
			                </div>

			            </div>
				        
				        
				        
				        
		                <legend>Database Details</legend>
				        
				        
		                <div class="form-group">
		                    <label class='col-sm-2' for='module_db'>Database</label>
		                    <div class="col-sm-10" id='mb_module_db'>
		                        <label class="inline radio" for="db_no">
		                            <input name="module_db" id="db_no" type="radio" value="no" <?= set_radio('module_db', 'no', true); ?> class="radio" />
		                            Not use
		                        </label>
		                        <label class="inline radio" for="db_create" data-toggle="collapse" data-target="#database_create">
		                            <input name="module_db" id="db_create" type="radio" value="new" <?= set_radio('module_db', 'new'); ?> class="radio" />
		                            Create New Database
		                        </label>
		                        <label class="inline radio" for="db_exists" data-toggle="collapse" data-target="#database_from">
		                            <input name="module_db" id="db_exists" type="radio" value="existing" <?= set_radio('module_db', 'existing'); ?> class="radio" />
		                           Use Existing Database
		                        </label>
		                    </div>
		                </div>
		                
		                
		                
		                
		                <div id="database_create" class="module_db-type collapse <?= set_value('module_db') == 'new' ? 'in' : ''?>">
			                
			                
			                <div class="alert alert-info">
				                <p>Your table will be created from at least one field – primary key. This will be used as a unique identifier and as an index. If you need additional fields, click "Add fields" to add them.</p>
			                </div>
			                
			                <div class="form-group <?= form_error('new_db_name') ? ' has-error' : ''; ?>">
			                    <label for="primary_key" class="col-sm-2">Database Name</label>
			                    <div class="col-sm-10">
			                        <input name="new_db_name" id="new_db_name" type="text" class="form-control" value="<?= set_value("new_db_name", ''); ?>" placeholder="" />
			                        <p class="help-block">Leave empty and we will use your module name</p>
			                    </div>
			                </div>
			                

			                <div class="form-group <?= form_error('primary_key') ? ' has-error' : ''; ?>">
			                    <label for="primary_key" class="col-sm-2">Primary Key</label>
			                    <div class="col-sm-10">
			                        <input name="primary_key" id="primary_key" type="text" class="form-control" value="<?= set_value("primary_key", 'id'); ?>" placeholder="" />
			                    </div>
			                </div>
			                
			                
			                <div class="form-group">
			                    <label for="primary_key" class="col-sm-2">Add fields</label>
			                    <div class="col-sm-10">
				                    <input type="text" class="j-add_fields-count form-control" value="0" /><br/>
				                    <button type="button" class="j-add_fields btn btn-primary">Submit</button>
			                    </div>
			                </div>


		                </div>
		                
		                
		                
				        
		                <div id="database_from" class="module_db-type collapse <?= set_value('module_db') == 'exist' ? 'in' : ''?>">
							
							<br/>

							<div class="form-group">
					            <label class="col-md-2" for="db_table_name">Select Database</label>
					            <div class="col-md-10">
						            <select name="db_table_name" id="db_table_name" class="form-control" style="min-width:300px;">
							            <? foreach($tables as $table):?>
										<option value="<?= $table['Name']?>" <?= set_select('db_table_name', $table['Name'])?>><?= $table['Name']?></option>
										<? endforeach; ?>
									</select>
							   	</div>
					        </div>
		                </div>
		                
		                <br/>
		                		                			   
						<legend>All fields</legend>
	
	
						<div id="fields">
		                <? if(isset($columns)):?>
								
								
										                			   
			                			                	
		                	<? foreach($columns as $k => $column):?>
		                	
		                		<? if($column->primary_key != 1):?>
		                		
									<div class="fields__item">
			                		<div class="form-group <?= form_error('fields['.$k.'][title]') ? ' has-error' : ''; ?>">
				                		<label class="col-md-2">Title</label>
										<div class="col-md-10">
											<input type="text" class="form-control fields__item-title" name="fields[<?=$column->name?>][title]" value="<?= set_value('fields['.$k.'][title]', humanize($column->name))?>" />
										</div>
			                		</div>
			                		
			                		<div class="form-group <?= form_error('fields['.$k.'][name]') ? ' has-error' : ''; ?>">
				                		<label class="col-md-2">Name</label>
										<div class="col-md-10">
											<input type="text" class="form-control fields__item-name" name="fields[<?=$column->name?>][name]"  value="<?= set_value('fields['.$k.'][name]', $column->name)?>" />
											<p class="help-block">Field name, so only lowercase and can contain dashes</p>
										</div>
			                		</div>
			                		
			                		<div class="form-group <?= form_error('fields['.$k.'][html]') ? ' has-error' : ''; ?>">
				                		<label class="col-md-2">HTML field</label>
										<div class="col-md-10">
											<select class="form-control" name="fields[<?=$column->name?>][html]" >
												
												
												
												
												<? 
													
													$default_field_type = '';
													
													if(in_array($column->type, array('enum', 'set')))
														$default_field_type = 'select';
													elseif(strpos(strtolower($column->name), '_hash') !== FALSE)
														$default_field_type = '';
													elseif(strpos(strtolower($column->name), 'password') !== FALSE)
														$default_field_type = 'password';
													elseif(strpos(strtolower($column->name), 'email') !== FALSE)
														$default_field_type = 'email';
													elseif(in_array($column->type, array('tinytext', 'text', 'mediumtext', 'longtext')))
														$default_field_type = 'text';
													else 
														$default_field_type = 'input';
												?>
												
												
												<? foreach($html as $tag):?>
												
													<option value="<?=$tag?>" <?= set_select('fields['.$column->name.'][html]', $tag, ($tag == $default_field_type ? true : false))?>><?= ucfirst($tag)?></option>
												<? endforeach;?>
												
											
											</select>
										</div>
			                		</div>
			                		
			                		<div class="form-group">
				                		<label class="col-md-2">Field Type</label>
										<div class="col-md-10">
											<select name="fields[<?=$column->name?>][type]" class="form-control" <?= set_value('module_db') == 'existing' ? 'disabled' : ''?>>
												<? foreach($dbtypes as $type):?>
													<option value="<?=$type?>" <?= set_select('fields['.$column->name.'][type]', $type, ($type == $column->type ? true : false))?>><?= ucfirst($type)?></option>
												<? endforeach;?>
											</select>											
										</div>
			                		</div>
			                		
			                		
			                					                		
			                		<div class="form-group <?= form_error('fields['.$k.'][value]') ? ' has-error' : ''; ?>">
				                		<label class="col-md-2">Length or Values</label>
										<div class="col-md-10">
											<input type="text" class="form-control" name="fields[<?=$column->name?>][value]" value="<?= set_value('fields['.$k.'][value]', $column->value, '255')?>" />
										</div>
			                		</div>
			                			                		
									<hr/>
								</div>
		                		
		                		<? endif;?>
		                		
		                	<? endforeach;?>
						
			            <? endif;?>
					
			                
							</div>
			                				        		            
					 
					<button type="submit" class="btn btn-primary">Create</button> 
					<a href="<?=MODULES_URL?>atom_builder" class="btn btn-default">Cancel</a>
				</form>
	    	</div>
	    </div>
	    
	    
	 <div style="display: none" class="j-fields_item_view">
		<div class="fields__item">
			
			<div class="form-group">
				<label class="col-md-2">Title</label>
				<div class="col-md-10">
					<input type="text" class="form-control fields__item-title" name="fields[{i}][title]" value="">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-2">Name</label>
				<div class="col-md-10">
					<input type="text" class="form-control fields__item-name" name="fields[{i}][name]"  value="">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-2">HTML field</label>
				<div class="col-md-10">
					<select class="form-control" name="fields[{i}][html]" >
						<? foreach($html as $tag):?>
							<option value="<?=$tag?>" <?= $tag == 'input' ? 'selected' : ''?>><?= ucfirst($tag)?></option>
						<? endforeach;?>			
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-2">Field Type</label>
				<div class="col-md-10">
					<select name="fields[{i}][type]" class="form-control">
						<? foreach($dbtypes as $type):?>
							<option value="<?=$type?>" <?= $type == 'varchar' ? 'selected' : ''?>><?= ucfirst($type)?></option>
						<? endforeach;?>
					</select>
				</div>
			</div>	
						                		
			<div class="form-group">
				<label class="col-md-2">Length or Values</label>
				<div class="col-md-10">
					<input type="text" class="form-control" name="fields[{i}][value]" value="255" />
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-12 text-right">
					<a href="#" class="btn btn-danger j-remove_field"><i class="fa fa-remove"></i> Remove</a>
				</div>
			</div>
			<hr/>
		</div>
	 </div>   
	    
	    
	    
	    
	 <script>
		
		
		$('.fields__item-title').change(function(){				
			
			$(this).parents('.fields__item').find('.fields__item-name').val($(this).val().replace(/\s+/g, '_').toLowerCase());			
		});
		
		
		$('input[name="module_db"]').on('change', function(){
			$('#fields').empty();
			$('.module_db-type.collapse.in').removeClass('in');
		});
		
		
		$('body').on('click', '.j-remove_field', function(){
			
			$(this).parents('.fields__item').empty();
			
			return false;
			
		});
		
	 	$('.j-add_fields').on('click', function(){
		 	
		 	var fields = $('#fields .fields__item').length;
		 	
		 	
		 	for(var i = 1; i <= $('.j-add_fields-count').val(); i++)
		 	{
			 	$('#fields').append($('.j-fields_item_view').html().replace(/\{(\i)\}/g, fields + i));
		 	}
		 	
		 	 $('.j-add_fields-count').val('');
		 	
		 	return false;
	 	});
		 
	</script>
	