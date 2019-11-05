
		<div class="page-header"> 
             <h1 class="col-xs-12 col-sm-12 text-center text-left-sm"><?=lang('au_title')?></h1> 
        </div>	
        
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-12">
                <a href="<?= MODULES_URL ?>atom_users/add" class="btn btn-primary"><i class="fa fa-plus"></i> <?=lang('atom_form_add_item')?></a>
            </div>
        </div>
		        
        <div class="panel">
	        <div class="panel-body">
		        <div class="tableScrollable">
		                
			        <table class="table table-hover table-bordered table-condensed table-smallheader j-tableFilterable">
			        	<thead>
			           		<tr>
								<th><span data-name="username">Username</span></th>
								<th><span data-name="email">Email</span></th>
								<th><span data-name="language"><?=lang('atom_language')?></span></th>
								<th><span data-name="theme"><?=lang('atom_settings_profile_theme')?></span></th>
								<th><span data-name="dashboard"><?=lang('atom_settings_profile_dashboard')?></span></th>
								<th><span data-name="type"><?=lang('atom_form_type')?></span></th>
								<th><span data-name="login_errors"><?=lang('au_login_errors')?></span></th>
								<th class="text-right" width="100"><?=lang('atom_list_actions')?></th>
							</tr>
						</thead>
			        	<tbody>
							<? foreach ($atom_users as $atom_user): ?>
							<tr>
								<td><?= $atom_user['username'] ?></td>
								<td><?= $atom_user['email'] ?></td>
								<td><?= $atom_user['language'] ?></td>
								<td><?= $atom_user['theme'] ?></td>
								<td><?= $atom_user['dashboard'] ?></td>
								<td><?= $atom_user['role_name'] ?></td>
								<td><?= $atom_user['login_errors'] ?></td>
								<td style="text-align:right" width="150px">
									<div class="btn-group">
										<a href="<?= MODULES_URL ?>atom_users/edit/<?=$atom_user['id'] ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
										
										<a href="<?= MODULES_URL ?>atom_users/delete/<?=$atom_user['id'] ?>" class="btn btn-danger btn-sm j-delete_item"><i class="fa fa-trash"></i></a>
										
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
                <p class="text-muted"><?=lang('atom_list_total_records')?>: <?= $total_rows ?></p>
            </div>
            <div class="col-md-6 text-right">
                <?= $this->pagination->create_links() ?>
            </div>
        </div>
