
		<div class="page-header"> 
             <h1 class="col-xs-12 col-sm-12 text-center text-left-sm">Монтажники</h1> 
        </div>	
        
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-12">
                <a href="<?= MODULES_URL ?>installers/add" class="btn btn-primary"><i class="fa fa-plus"></i> <?=lang('atom_form_add_item')?></a>
            </div>
        </div>
		        
        <div class="panel">
	        <div class="panel-body">
		        <div class="tableScrollable">
		                
			        <table class="table table-hover table-bordered table-condensed table-smallheader j-tableFilterable">
			        	<thead>
			           		<tr>
								<th><span data-name="name">ФИО</span></th>
								<th><span data-name="phone">Телефон</span></th>
								<th class="text-right" width="80"><?=lang('atom_list_actions')?></th>
							</tr>
						</thead>
			        	<tbody>
							<? foreach ($installers as $installer): ?>
							<tr>
								<td><a href="<?= MODULES_URL ?>installers/view/<?=$installer['id'] ?>"><?= $installer['name'] ?></a></td>
								<td><?= $installer['phone'] ? '<a href="tel:'.$installer['phone'].'">'.russianPhoneFormat($installer['phone']) . '</a>' : ''?></td>
								<td style="text-align:right" width="120px">
									<div class="btn-group">										
										<a href="<?= MODULES_URL ?>installers/edit/<?=$installer['id'] ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
										
										<a href="<?= MODULES_URL ?>installers/delete/<?=$installer['id'] ?>" class="btn btn-danger btn-sm j-delete_item"><i class="fa fa-trash"></i></a>
										
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
