

		<div class="page-header">
			<h1 class="col-xs-12 col-sm-12 text-center text-left-sm">Builder for modules</h1>
		</div>
        
        <div class="row">
            <div class="col-md-12 text-center">
                <div style="margin-top: 8px" id="message">
					<? if($this->session->flashdata("modules_error")): ?>
						<div class="alert alert-danger text-center">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<?= $this->session->flashdata("modules_error"); ?>
						</div>
					<? elseif($this->session->flashdata("modules_success")): ?>
						<div class="alert alert-success text-center">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<?= $this->session->flashdata("modules_success"); ?>
						</div>
					<? endif; ?>
                </div>
            </div>
        </div>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-12">
                <a href="<?=MODULES_URL?>atom_builder/create_module" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
            </div>
        </div>
        
        <div class="panel">
	        <div class="panel-body">
		        <div class="table-light">
			        <div class="tableScrollable">
				        <table class="table table-hover table-striped table-bordered">
				        	<thead>
				           		<tr>
									<th>Slug</th>
									<th>Name</th>
									<th>Description</th>
									<th>Author</th>
									<th class="text-center">Version</th>
									<th class="text-center">Updates</th>
									<th class="text-center">Permissions</th>
									<th class="text-center">Dump</th>
									<th class="text-right">Actions</th>
								</tr>
							</thead>
							<tbody>
								<? foreach ($modules as $slug => $module): ?>								
								<tr>
									<td><span class="label label-default"><?= $slug ?></span></td>
									<td><?= $module['name'] ?></td>
									<td><?= $module['description'] ?></td>
									<td><?= $module['author'] ?></td>
									<td class="text-center"><?= $module['version'] ?></td>	
									<td class="text-center">
										<span class="badge badge-<?= isset($module['updates']) && count($module['updates']) > 0 ? 'primary' : 'default' ?>"><?= isset($module['updates']) ? count($module['updates']) : 0 ?></span>
									</td>	
									
									<td class="text-center"><?= ($module['permissions_installed'])  ? '<span class="label label-success">True</span>' : '<a href="'.MODULES_URL.'atom_builder/install_permissions/'.$slug.'"><span class="label label-danger">False</span></a>'?></td>
									<td class="text-center"><?= ($module['dump'])  ? '<a href="'.MODULES_URL.'atom_builder/install_dump/'.$slug.'"><span class="label label-success">True</span></a>' : '<span class="label label-danger">False</span>'?></td>
									
									
									<td style="text-align:right" width="150px">										
										<a href="<?=MODULES_URL?>atom_builder/update_module/<?=$slug?>" class="btn btn-primary btn-sm" <?= !isset($module['updates']) || count($module['updates']) < 1 ? 'disabled=""' : ''?>><i class="fa fa-refresh"></i> Update</a>
										
										
										
										
										<a href="<?=MODULES_URL?>atom_builder/delete_module/<?=$slug?>" class="btn btn-danger btn-sm j-delete_item"><i class="fa fa-trash"></i> Delete</a>
									</td>
								</tr>
								<? endforeach;?>
							</tbody>
				        </table>
			        </div>
		        </div>
	        </div>
        </div>
        
        
