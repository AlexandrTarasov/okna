  
		
		<div class="page-header">
            <h1 class="col-xs-12 col-sm-12 text-center text-left-sm"><a href="<?= MODULES_URL ?>clients">Клиенты</a> &nbsp; / &nbsp; <?= $client['name']; ?> </h1> 
        </div>	
        
        
        
        <div class="row">
	        <div class="col-md-6">
			    <div class="panel">
					<div class="panel-heading">
						<span class="panel-title"><i class="ion-person"></i> Информация о клиенте</span>
					</div>
			        <div class="panel-body">
		
				        <table class="table">
							<tr>
						    	<td>ID клиента</td>
						    	<td><?= $client['id']; ?></td>
						    </tr>
							<tr>
						    	<td>ФИО</td>
						    	<td><?= $client['name']; ?></td>
						    </tr>
						    
							<tr>
						    	<td>Адрес</td>
						    	<td><?= $client['address']; ?></td>
						    </tr>
						    
						    <? if(isset($client['phone']) && $client['phone'] != ''):?>
							<tr>
						    	<td>Телефон</td>
						    	<td><a href="tel:<?=$client['phone']?>"><?= russianPhoneFormat($client['phone']); ?></a> <?= $client['phone2'] != '' ? ', <br/><a href="tel:'.$client['phone'].'">' . russianPhoneFormat($client['phone2']) . '</a>' : ''?></td>
						    </tr>
						    <? endif;?>
	
						    <? if(isset($client['viber']) && $client['viber'] != ''):?>
							<tr>
						    	<td>Viber</td>
						    	<td><a href="viber://chat?number=+<?= $client['viber']; ?>"><?= russianPhoneFormat($client['viber']); ?></a></td>
						    </tr>
						    <? endif;?>
						    
						    <? if(isset($client['email']) && $client['email'] != ''):?>
							<tr>
						    	<td>E-mail</td>
						    	<td><a href="mailto:<?= $client['email']; ?>"><?= $client['email']; ?></a></td>
						    </tr>
						    <? endif;?>
							<tr>
						    	<td>Комментарий</td>
						    	<td><?= $client['comment']; ?></td>
						    </tr>
						</table>
						<a href="<?= MODULES_URL ?>clients" class="btn btn-default"><i class="fa fa-long-arrow-left"></i> К списку</a>
						<a href="<?= MODULES_URL ?>clients/edit/<?=$client['id'] ?>" class="btn btn-primary"><i class="fa fa-pencil"></i> Редактировать</a>
						<a href="<?= MODULES_URL ?>clients/delete/<?=$client['id'] ?>" class="btn btn-danger j-delete_item"><i class="fa fa-trash"></i> Удалить</a>
					</div>
				</div>
	        </div>
	        
	        <div class="col-md-6">
			    <div class="panel">
					<div class="panel-heading">
						<span class="panel-title"><i class="ion-ios-cart"></i> Заказы клиента</span>
					</div>
		
			        <table class="table table-bordered">
				        <thead>
					        
					        <tr>
						        <th>ID заказа</th>
						        <th>№ договора</th>
						        <th>Готовность</th>
						        <th>Монтажник</th>
						        <th>Адрес монтажа</th>
						        <th>Сумма</th>
						        <th>Получено</th>
					        </tr>
					        
				        </thead>
				        <tbody>
					    	<? foreach($orders as $order):?>
						        <tr>
							        <td><a href="<?= MODULES_URL?>orders/view/<?=$order['id']?>"><?=$order['id']?></a></td>
							        <td><a href="<?= MODULES_URL?>orders/view/<?=$order['id']?>"><?=$order['contract_number']?></a></td>
							        <td><?= $order['readiness_date'] ? date('d.m.Y', strtotime($order['readiness_date'])) : '-';?></td>
							        <td><?= $order['installer_name']?></td>
							        <td><?= $order['address'];?></td>
							        <td><?= number_format($order['total_price'], 0, '.', ' ');?>грн.</td>
							        <td><?= number_format($order['received_amount'], 0, '.', ' ');?>грн.</td>
						        </tr>						    	
					    	<? endforeach;?>
					        
				        </tbody>
				        
					</table>
				</div>
				
			    <div class="panel">
					<div class="panel-heading">
						<span class="panel-title"><i class="ion-social-usd"></i> Расчёты</span>
					</div>
		
			        <table class="table table-bordered">
				        <thead>
					        
					        <tr>
						        <th>ID заказа</th>
						        <th>Тип</th>
						        <th>Отправка</th>
						        <th>Получение</th>
						        <th>Метод</th>
						        <th>Сумма</th>
						        <th>Статус</th>
					        </tr>
					        
				        </thead>
				        <tbody>
					    	<? foreach($payments as $payment):?>
					    		
						        <tr class="<?= ($payment['type'] == 'income' && $payment['status'] != 'received') ? 'danger' : ''?>">
							        <td><a href="<?= MODULES_URL?>orders/view/<?=$payment['order_id']?>">Заказ №<?=$payment['order_id']?></a></td>
							        <td>
								        <? if($payment['type'] == 'income'):?>
								        <span class="label label-success">Доход</span>
								        <? else:?>
								        <span class="label label-warning">Расход</span>
								        <? endif;?>
							        </td>
							        <td><?= date('d.m.Y', strtotime($payment['date_create']));?></td>
							        <td><?= $payment['date_receiving'] ? date('d.m.Y', strtotime($payment['date_receiving'])) : '';?></td>
									<td>
								        <?
									        switch($payment['method'])
											{
												case 'installer':
													echo 'Монтажником';
												break;
												
												case 'courier':
													echo 'Курьером';
												break;
												
												case 'cash':
													echo 'Наличные';
												break;

												case 'cashless':
													echo 'Безнал';
												break;

												case 'card':
													echo 'Карта';
												break;
												
											}
										?>
									</td>
									<td><?= number_format($payment['amount'], 0, '.', ' ');?>грн.</td>
							        <td>
								        <? if($payment['status'] == 'received'):?>
								        <span class="label label-success">Получено</span>
								        <? else:?>
								        <span class="label label-default">Отправлено</span>
								        <? endif;?>
							        </td>
						        </tr>						    	
					    	<? endforeach;?>
					        
				        </tbody>
				        
					</table>
				</div>
	        </div>
        </div>
    