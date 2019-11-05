
		<div class="page-header"> 
             <h1 class="col-xs-12 col-sm-12 text-center text-left-sm">Лиды</h1> 
        </div>	
        
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-12">
                <a href="<?= MODULES_URL ?>leads/add" class="btn btn-primary"><i class="fa fa-plus"></i> Новый лид</a>
            </div>
        </div>
		        
        <div class="panel">
	        <div class="panel-body">
		        <div class="tableScrollable">
		                
			        <table class="table table-hover table-bordered table-condensed table-smallheader j-tableFilterable">
			        	<thead>
			           		<tr>
								<th width="100"><span data-name="status" data-type="select" data-source="<?=MODULES_URL?>leads/filters/status">Статус</span></th>
								<th><span data-name="date">Дата</span></th>
								<th><span data-name="client_id" data-type="select" data-source="<?=MODULES_URL?>leads/filters/clients">Клиент</span></th>
								<th><span data-name="address">Адрес</span></th>
								<th><span data-name="source" data-type="select" data-source="<?=MODULES_URL?>leads/filters/source">Источник</span></th>
								<th><span data-name="order_id">№ заказа</span></th>
								<th width="400"><span>Комментарий</span></th>
								<th class="text-right" width="150"><?=lang('atom_list_actions')?></th>
							</tr>
						</thead>
			        	<tbody>
							<? foreach ($leads as $lead): ?>
							<tr>
								<td>
									<? 
										switch($lead['status'])
										{
											
											case 'new':
												echo '<span class="label label-default">Новый</span>';
											break;
											
											case 'processing':
												echo '<span class="label label-primary">В обработке</span>';
											break;
											
											case 'accepted':
												echo '<span class="label label-success">Принят</span>';
											break;
											
											case 'canceled':
												echo '<span class="label label-danger">Отменён</span>';
											break;
											
										}
								
								
									?>
								</td>
								<td><?= date('d.m.Y', strtotime($lead['date'])); ?></td>
								<td><a href="<?= MODULES_URL?>clients?id=<?= $lead['client_id'] ?>"><?= $lead['client_name'] ?></a></td>
								<td><?= $lead['address'] ?></td>
								<td>
									<? 
										switch($lead['source'])
										{
											
											case 'call':
												echo '<i class="ion-ios-telephone"></i> Звонок';
											break;
											
											case 'adwords':
												echo 'AdWords';
											break;

											case 'facebook':
												echo '<i class="ion-social-facebook"></i>  Facebook';
											break;

											case 'instagram':
												echo '<i class="ion-social-instagram"></i> Instagram';
											break;

											case 'recommendation':
												echo 'Рекомендация';
											break;
											
											case 'youtube':
												echo '<i class="ion-social-youtube"></i> YouTube';
											break;

										}								
									?>
								</td>
								<td><?= $lead['order_number'] != '' ? '<a href="'.MODULES_URL.'orders/view/'.$lead['order_number'].'">Заказ №'.$lead['order_number'].'</a>' : ''?></td>
								<td><?= $lead['comment'] ?></td>
								<td style="text-align:right" width="150px">
									<div class="btn-group">
										<? if($lead['status'] != 'accepted'):?>
										<a href="<?= MODULES_URL ?>orders/create_order_from_lead/<?=$lead['id'] ?>" onclick="return confirm('Вы уверены что хотите перевести лид в заказ?');" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> в заказ</a>
										<? endif;?>
										
										
										<a href="<?= MODULES_URL ?>leads/edit/<?=$lead['id'] ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
										
										<a href="<?= MODULES_URL ?>leads/delete/<?=$lead['id'] ?>" class="btn btn-danger btn-sm j-delete_item"><i class="fa fa-trash"></i></a>
										
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
