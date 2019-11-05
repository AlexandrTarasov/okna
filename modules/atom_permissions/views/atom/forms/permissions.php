
		<div class="page-header"> 
            <h1 class="col-xs-12 col-sm-12 text-center text-left-sm"><a href="<?= MODULES_URL ?>permissions">Permissions</a> &nbsp; / &nbsp; <?= isset($atom_permission) ? 'Edit item' : 'Add new item'?></h1> 
        </div>	
        
        <div class="panel">
	        <div class="panel-body">
	        	<form action="/<?= uri_string()?>" method="post" class="form-horizontal">
		
					<div class="form-group">
				        <label class="col-md-2" for="name">Name</label>
						<div class="col-md-10">
			           		<input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?= isset($atom_permission['name']) ? $atom_permission['name'] : '';?>" />
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="description">Description</label>
						<div class="col-md-10">
			           		<input type="text" class="form-control" name="description" id="description" placeholder="Description" value="<?= isset($atom_permission['description']) ? $atom_permission['description'] : '';?>" />
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="status">Status</label>
						<div class="col-md-10">
				            <select class="form-control" name="status" id="status">
								<option value="active" <?= (isset($atom_permission['status']) && ($atom_permission['status'] == 'active')) ? 'selected' : ''?>>active</option>
								<option value="disabled" <?= (isset($atom_permission['status']) && ($atom_permission['status'] == 'disabled')) ? 'selected' : ''?>>disabled</option>
							</select>
						</div>
					</div>
					<input type="hidden" name="id" value="<?= isset($atom_permission['id']) ? $atom_permission['id'] : '';?>" /> 
					<button type="submit" class="btn btn-primary">Save</button> 
					<a href="<?= MODULES_URL ?>permissions" class="btn btn-default">Cancel</a>
				</form>
	    	</div>
	    </div>