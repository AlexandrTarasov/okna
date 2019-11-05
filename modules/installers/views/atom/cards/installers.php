  
		
		<div class="page-header">
            <h1 class="col-xs-12 col-sm-12 text-center text-left-sm"><a href="<?= MODULES_URL ?>installers">Монтажники</a> &nbsp; / &nbsp; <?= $installer['name'];?></h1> 
        </div>	
        
        
        
        <div class="row">
	        <div class="col-md-6">
			    <div class="panel">
					<div class="panel-heading">
						<span class="panel-title"><i class="ion-person"></i> Информация о монтажнике</span>
					</div>
			        <div class="panel-body">
		
				        <table class="table">
							<tr>
						    	<td>ID монтажника</td>
						    	<td><?= $installer['id']; ?></td>
						    </tr>
							<tr>
						    	<td>Логин в системе</td>
						    	<td><a href="<?= MODULES_URL ?>atom_users?id=<?= $installer['atom_user_id'] ?>"><?= $installer['atom_username'] ?></a></td>
						    </tr>
							<tr>
						    	<td>ФИО</td>
						    	<td><?= $installer['name']; ?></td>
						    </tr>
						    
							<tr>
						    	<td>Адрес</td>
						    	<td><?= $installer['address']; ?></td>
						    </tr>
						    
						    <? if(isset($installer['phone']) && $installer['phone'] != ''):?>
							<tr>
						    	<td>Телефон</td>
						    	<td><a href="tel:<?=$installer['phone']?>"><?= russianPhoneFormat($installer['phone']); ?></a> <?= $installer['phone2'] != '' ? ', <br/><a href="tel:'.$installer['phone'].'">' . russianPhoneFormat($installer['phone2']) . '</a>' : ''?></td>
						    </tr>
						    <? endif;?>
	
						    <? if(isset($installer['viber']) && $installer['viber'] != ''):?>
							<tr>
						    	<td>Viber</td>
						    	<td><a href="viber://chat?number=+<?= $installer['viber']; ?>"><?= russianPhoneFormat($installer['viber']); ?></a></td>
						    </tr>
						    <? endif;?>
						    
						    <? if(isset($installer['email']) && $installer['email'] != ''):?>
							<tr>
						    	<td>E-mail</td>
						    	<td><a href="mailto:<?= $installer['email']; ?>"><?= $installer['email']; ?></a></td>
						    </tr>
						    <? endif;?>
							<tr>
						    	<td>Комментарий</td>
						    	<td><?= $installer['comment']; ?></td>
						    </tr>
						</table>
						<a href="<?= MODULES_URL ?>installers" class="btn btn-default"><i class="fa fa-long-arrow-left"></i> К списку</a>
						<a href="<?= MODULES_URL ?>installers/edit/<?=$installer['id'] ?>" class="btn btn-primary"><i class="fa fa-pencil"></i> Редактировать</a>
						<a href="<?= MODULES_URL ?>installers/delete/<?=$installer['id'] ?>" class="btn btn-danger j-delete_item"><i class="fa fa-trash"></i> Удалить</a>
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
						        <th>№ договора</th>
						        <th>Монтаж</th>
						        <th>Монтажные</th>
						        <th>Оплачено</th>
						        <th>Адрес монтажа</th>
					        </tr>
					        
				        </thead>
				        <tbody>
					    	<? foreach($orders as $order):?>
						        <tr>
							        <td><a href="<?= MODULES_URL?>orders/view/<?=$order['id']?>"><?=$order['contract_number']?></a></td>
							        <td><?= $order['montage_date'] ? date('d.m', strtotime($order['montage_date'])) : '-';?></td>
							        <td><?= number_format($order['montage_price'], 0, '.', ' ');?>грн.</td>
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
    