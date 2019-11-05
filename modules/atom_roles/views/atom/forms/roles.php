
		<div class="page-header"> 
            <h1 class="col-xs-12 col-sm-12 text-center text-left-sm"><a href="<?= MODULES_URL ?>atom_roles">Roles</a> &nbsp; / &nbsp; <?= isset($atom_role) ? 'Edit item' : 'Add new item'?></h1> 
        </div>	
        
        <div class="panel">
	        <div class="panel-body">
	        	<form action="/<?= uri_string()?>" method="post" class="form-horizontal">
		
					<div class="form-group">
				        <label class="col-md-2" for="name">Name</label>
						<div class="col-md-10">
			           		<input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?= isset($atom_role['name']) ? $atom_role['name'] : '';?>" />
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="description">Description</label>
						<div class="col-md-10">
			           		<input type="text" class="form-control" name="description" id="description" placeholder="Description" value="<?= isset($atom_role['description']) ? $atom_role['description'] : '';?>" />
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="default">Default</label>
						<div class="col-md-10">								
			            	<label class="inline checkbox">
				           		<input type="checkbox" name="default[]" value="1" <?= (isset($atom_role['default']) && ($atom_role['default'] == '1')) ? 'checked' : ''?>> Set as default
				           	</label>
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="status">Status</label>
						<div class="col-md-10">
				            <select class="form-control" name="status" id="status">
								<option value="active" <?= (isset($atom_role['status']) && ($atom_role['status'] == 'active')) ? 'selected' : ''?>>active</option>
								<option value="disabled" <?= (isset($atom_role['status']) && ($atom_role['status'] == 'disabled')) ? 'selected' : ''?>>disabled</option>
							</select>
						</div>
					</div>
					<input type="hidden" name="id" value="<?= isset($atom_role['id']) ? $atom_role['id'] : '';?>" /> 
					<button type="submit" class="btn btn-primary">Save</button> 
					<a href="<?= MODULES_URL ?>atom_roles" class="btn btn-default">Cancel</a>
				</form>
	    	</div>
	    </div>