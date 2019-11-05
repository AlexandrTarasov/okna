  
		
		<div class="page-header">
            <h1 class="col-xs-12 col-sm-12 text-center text-left-sm"><a href="<?= MODULES_URL ?>suppliers">Поставщики</a> &nbsp; / &nbsp; <?= $supplier['company_name']; ?></h1> 
        </div>	
        
    
    
        <div class="row">
	        <div class="col-md-6">
			    <div class="panel">
					<div class="panel-heading">
						<span class="panel-title"><i class="ion-person"></i> Информация о компании</span>
					</div>
			        <div class="panel-body">
		
				        <table class="table">
							<tr>
						    	<td>ID компании</td>
						    	<td><?= $supplier['id']; ?></td>
						    </tr>
							<tr>
						    	<td>Название компании</td>
						    	<td><?= $supplier['company_name']; ?></td>
						    </tr>
						    
						    <? if(isset($supplier['manager_name']) && $supplier['manager_name'] != ''):?>
							<tr>
						    	<td>Менеджер</td>
						    	<td><strong><?= $supplier['manager_name']; ?></strong></td>
						    </tr>
						    <? endif;?>

						    <? if(isset($supplier['manager_phone']) && $supplier['manager_phone'] != ''):?>
							<tr>
						    	<td>Телефон</td>
						    	<td><a href="tel:<?=$supplier['manager_phone']?>"><?= russianPhoneFormat($supplier['manager_phone']); ?></a></td>
						    </tr>
						    <? endif;?>
						    
						    <? if(isset($supplier['manager_email']) && $supplier['manager_email'] != ''):?>
							<tr>
						    	<td>Email</td>
						    	<td><a href="mailto:<?= $supplier['manager_email']; ?>"><?= $supplier['manager_email']; ?></a></td>
						    </tr>
						    <? endif;?>

						    <? if(isset($supplier['manager2_name']) && $supplier['manager2_name'] != ''):?>
							<tr>
						    	<td>Менеджер 2</td>
						    	<td><strong><?= $supplier['manager2_name']; ?></strong></td>
						    </tr>
						    <? endif;?>

						    <? if(isset($supplier['manager2_phone']) && $supplier['manager2_phone'] != ''):?>
							<tr>
						    	<td>Телефон</td>
						    	<td><a href="tel:<?=$supplier['manager2_phone']?>"><?= russianPhoneFormat($supplier['manager2_phone']); ?></a></td>
						    </tr>
						    <? endif;?>
						    
						    <? if(isset($supplier['manager2_email']) && $supplier['manager2_email'] != ''):?>
							<tr>
						    	<td>Email</td>
						    	<td><a href="mailto:<?= $supplier['manager2_email']; ?>"><?= $supplier['manager2_email']; ?></a></td>
						    </tr>
						    <? endif;?>
	
						    <? if(isset($supplier['viber']) && $supplier['viber'] != ''):?>
							<tr>
						    	<td>Viber</td>
						    	<td><a href="viber://chat?number=+<?= $supplier['viber']; ?>"><?= russianPhoneFormat($supplier['viber']); ?></a></td>
						    </tr>
						    <? endif;?>
						    
							<tr>
						    	<td>Адрес</td>
						    	<td><?= $supplier['address']; ?></td>
						    </tr>
							<tr>
						    	<td>Комментарий</td>
						    	<td><?= $supplier['comment']; ?></td>
						    </tr>
						</table>
						<a href="<?= MODULES_URL ?>suppliers" class="btn btn-default"><i class="fa fa-long-arrow-left"></i> К списку</a>
						<a href="<?= MODULES_URL ?>suppliers/edit/<?=$supplier['id'] ?>" class="btn btn-primary"><i class="fa fa-pencil"></i> Редактировать</a>
						<a href="<?= MODULES_URL ?>suppliers/delete/<?=$supplier['id'] ?>" class="btn btn-danger j-delete_item"><i class="fa fa-trash"></i> Удалить</a>
					</div>
				</div>
	        </div>
	        
	        <div class="col-md-6">
			    <div class="panel">
					<div class="panel-heading">
						<span class="panel-title"><i class="ion-ios-cart"></i> Заказы</span>
					</div>
		
			        <table class="table table-bordered">
				        <thead>
					        
					        <tr>
						        <th>ID заказа</th>
						        <th>№ договора</th>
						        <th>Готовность</th>
						        <th>Газда</th>
						        <th>Оплачено</th>
						        <th>Адрес монтажа</th>
					        </tr>
					        
				        </thead>
				        <tbody>
					    	<? foreach($orders as $order):?>
						        <tr class="<?= ($order['gazda_price'] < $order['received_amount']) ? 'danger' : ''?>">
							        <td><a href="<?= MODULES_URL?>orders/view/<?=$order['id']?>"><?=$order['id']?></a></td>
							        <td><a href="<?= MODULES_URL?>orders/view/<?=$order['id']?>"><?=$order['contract_number']?></a></td>
							        <td><?= $order['readiness_date'] ? date('d.m.Y', strtotime($order['readiness_date'])) : '-';?></td>
							        <td><?= number_format($order['gazda_price'], 0, '.', ' ');?>грн.</td>
							        <td><?= number_format($order['received_amount'], 0, '.', ' ');?>грн.</td>
							        <td><?= $order['address'];?></td>
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
    