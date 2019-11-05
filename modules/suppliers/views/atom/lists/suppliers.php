
		<div class="page-header"> 
             <h1 class="col-xs-12 col-sm-12 text-center text-left-sm">Поставщики</h1> 
        </div>	
        
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-12">
                <a href="<?= MODULES_URL ?>suppliers/add" class="btn btn-primary"><i class="fa fa-plus"></i> <?=lang('atom_form_add_item')?></a>
            </div>
        </div>
		        
        <div class="panel">
	        <div class="panel-body">
		        <div class="tableScrollable">
		                
			        <table class="table table-hover table-bordered table-condensed table-smallheader j-tableFilterable">
			        	<thead>
			           		<tr>
								<th><span data-name="company_name">Название компании</span></th>
								<th><span data-name="address">Адрес</span></th>
								<th width="300"><span>Комментарий</span></th>
								<th class="text-right" width="100"><?=lang('atom_list_actions')?></th>
							</tr>
						</thead>
			        	<tbody>
							<? foreach ($suppliers as $supplier): ?>
							<tr>
								<td><a href="<?= MODULES_URL ?>suppliers/view/<?=$supplier['id'] ?>"><?= $supplier['company_name'] ?></a></td>
								<td><a href="<?= MODULES_URL ?>suppliers/view/<?=$supplier['id'] ?>"><?= $supplier['address'] ?></a></td>
								<td><?= $supplier['comment'] ?></td>
								<td style="text-align:right" width="120px">
									<div class="btn-group">
										<a href="<?= MODULES_URL ?>suppliers/view/<?=$supplier['id'] ?>" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>
										
										<a href="<?= MODULES_URL ?>suppliers/edit/<?=$supplier['id'] ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
										
										<a href="<?= MODULES_URL ?>suppliers/delete/<?=$supplier['id'] ?>" class="btn btn-danger btn-sm j-delete_item"><i class="fa fa-trash"></i></a>
										
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
