
		<div class="page-header"> 
             <h1 class="col-xs-12 col-sm-12 text-center text-left-sm">Заказы 
	             
	             <?
		            if(isset($filters['status'])){
					switch($filters['status'])
					{
						
						case 'new':
							echo '<span class="label label-default">Новый</span>';
						break;
						
						case 'processing':
							echo '<span class="label label-primary">В обработке</span>';
						break;
						
						case 'measuring':
							echo '<span class="label label-warning">Замер</span>';
						break;
						
						case 'during':
							echo '<span class="label label-info">В процессе</span>';
						break;
						case 'in_work':
							echo '<span class="label label-danger">В работе</span>';
						break;
						case 'complete':
							echo '<span class="label label-success">Готов</span>';
						break;
						case 'fulfilled':
							echo '<span class="label label-success">Выполнен</span>';
						break;
						case 'archive':
							echo '<span class="label label-default">Архив</span>';
						break;
					}
										
				}	
								
				?>

	             
             </h1> 
        </div>	
        
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-12">
<!--                 <a href="<?= MODULES_URL ?>orders/add" class="btn btn-primary"><i class="fa fa-plus"></i> <?=lang('atom_form_add_item')?></a> -->
            </div>
        </div>
		        
        <div class="panel">
	        <div class="panel-body">
		        <div class="tableScrollable">
		                
			        <table class="table table-hover table-bordered table-condensed table-smallheader j-tableFilterable">
			        	<thead>
			           		<tr>
								<th><span data-name="measurement_date">Дата замера</span></th>
								<th><span data-name="address">Адрес</span></th>
								<th><span data-name="client_id" data-type="select" data-source="<?=MODULES_URL?>orders/filters/clients">Клиент</span></th>
								<th><span data-name="">Телефон</span></th>
								<th><span data-name="discount">Скидка</span></th>
								
								<? if(!$this->auth->check_permission('Orders.Installer')):?>
								<th><span data-name="installer_id"  data-type="select" data-source="<?=MODULES_URL?>orders/filters/installers">Монтажник</span></th>	
								<? endif;?>
									
								<th><span data-name="comment">Комментарий</span></th>

								<? if(!$this->auth->check_permission('Orders.Installer')):?>
								<th class="text-right" width="50"><?=lang('atom_list_actions')?></th>
								<? endif;?>
							</tr>
						</thead>
			        	<tbody>
							<? foreach ($orders as $order): ?>
							<tr>
								<td><?= $order['measurement_date'] ?></a></td>
								<td><?= $order['address'] ?></td>
								<td><?= $order['client_name'] ?></td>
								<td><a href="tel:<?=$order['client_phone']?>"><?= russianPhoneFormat($order['client_phone']); ?></a></td>

								<td><?= $order['discount']?></td>


								<? if(!$this->auth->check_permission('Orders.Installer')):?>
								<td><?= $order['installer_name'] ? '<a href="'.MODULES_URL.'installers/view/'.$order['installer_id'] .'">'.$order['installer_name'] .'</a>' : '' ?></td>
								<? endif;?>
								
								<td><?= $order['comment']?></td>
								
								<? if(!$this->auth->check_permission('Orders.Installer')):?>
								<td style="text-align:right" width="50px">
									<div class="btn-group">
										<a href="<?= MODULES_URL ?>orders/view/<?=$order['id'] ?>" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>
																				
										<a href="<?= MODULES_URL ?>orders/delete/<?=$order['id'] ?>" class="btn btn-danger btn-sm j-delete_item"><i class="fa fa-trash"></i></a>
										
									</div>
								</td>
								<? endif;?>
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
