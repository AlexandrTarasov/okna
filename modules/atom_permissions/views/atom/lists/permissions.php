
		<div class="page-header"> 
             <h1 class="col-xs-12 col-sm-12 text-center text-left-sm">Permissions</h1> 
        </div>	
        
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-6">
                <a href="<?= MODULES_URL ?>atom_permissions/add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
            </div>
            <div class="col-md-6 text-right">
                <a href="<?= MODULES_URL ?>atom_permissions/matrix" class="btn btn-default"><i class="fa fa-list"></i> Permission Matrix</a>
            </div>
        </div>
		        
        <div class="panel">
	        <div class="panel-body">
		        <div class="tableScrollable">
		                
			        <table class="table table-hover table-bordered table-condensed table-smallheader j-tableFilterable">
			        	<thead>
			           		<tr>
								<th><span data-name="name">Name</span></th>
								<th><span data-name="description">Description</span></th>
								<th><span data-name="status">Status</span></th>
								<th class="text-right" width="100">Actions</th>
							</tr>
						</thead>
			        	<tbody>
							<? foreach ($atom_permissions as $atom_permission): ?>
							<tr>
								<td><?= $atom_permission['name'] ?></td>
								<td><?= $atom_permission['description'] ?></td>
								<td><?= $atom_permission['status'] ?></td>
								<td style="text-align:right" width="150px">
									<div class="btn-group">
										<a href="<?= MODULES_URL ?>atom_permissions/edit/<?=$atom_permission['id'] ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
										
										<a href="<?= MODULES_URL ?>atom_permissions/delete/<?=$atom_permission['id'] ?>" class="btn btn-danger btn-sm j-delete_item"><i class="fa fa-trash"></i></a>
										
									</div>
								</td>
							</tr>
							<? endforeach;?>
						</tbody>
			        </table>
   
			    </div>
	        </div>
        </div>        
        <div class="row">
            <div class="col-md-6">
                <p class="text-muted">Total Records: <?= $total_rows ?></p>
            </div>
            <div class="col-md-6 text-right">
                <?= $this->pagination->create_links() ?>
            </div>
        </div>
