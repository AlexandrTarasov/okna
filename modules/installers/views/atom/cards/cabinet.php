  
		
		<div class="page-header">
            <h1 class="col-xs-12 col-sm-12 text-center text-left-sm">Личный кабинет</h1> 
        </div>	
        
        
        
        <div class="row">	        
	        <div class="col-md-12">
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
    