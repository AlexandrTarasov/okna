
		<div class="page-header"> 
             <h1 class="col-xs-12 col-sm-12 text-center text-left-sm">Roles</h1> 
        </div>	
        
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-12">
                <a href="<?= MODULES_URL ?>atom_roles/add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
            </div>
        </div>
		        
        <div class="panel">
	        <div class="panel-body">
		        <div class="tableScrollable">
		                
			        <table class="table table-hover table-bordered table-condensed table-smallheader">
			        	<thead>
			           		<tr>
								<th>Name</th>
								<th>Description</th>
								<th>Default</th>
								<th>Status</th>
								<th class="text-right" width="100">Actions</th>
							</tr>
						</thead>
						<tbody>
							<? foreach ($atom_roles as $atom_role): ?>
							<tr>
								<td><?= $atom_role['name'] ?></td>
								<td><?= $atom_role['description'] ?></td>
								<td><?= $atom_role['default'] ?></td>
								<td><?= $atom_role['status'] ?></td>
								<td style="text-align:right" width="150px">
									<div class="btn-group">
										<a href="<?= MODULES_URL ?>atom_roles/edit/<?=$atom_role['id'] ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
										
										<a href="<?= MODULES_URL ?>atom_roles/delete/<?=$atom_role['id'] ?>" class="btn btn-danger btn-sm j-delete_item"><i class="fa fa-trash"></i></a>
										
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
