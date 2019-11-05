    <div class="page-header m-b-0">
        <div class="row">
            <div class="col-md-4">
                <h1><i class="page-header-icon ion-arrow-graph-up-right"></i> Аналитика</h1>
            </div>
        </div>
    </div>

    
    
    <div class="page-wide-block">
        <div class="box border-radius-0 bg-black">
            <!-- Revenue -->


            <div class="col-md-12 p-a-4 bg-black darken">
                <div>
                    <span class="font-size-34 font-weight-light">Заказы</span>
                </div>


                <div class="p-t-4">
                    <canvas id="sales-chart" width="400" height="100"></canvas>
                </div>
            </div>
            
                       
            <script type="text/javascript">
				$(function() {
					new Chart(document.getElementById('sales-chart').getContext("2d"), {
						type: 'bar',
						data: {
							labels: [<?= '"'.implode('","', $labels).'"' ?>],
							datasets: [
							{
								label: 'Заказы',
								data: [ <?= implode(',', $sales) ?> ],
								borderWidth: 1,
								backgroundColor: pxUtil.hexToRgba('#E040FB', 0.3),
								borderColor: '#E040FB',
							},
							{
								label: 'Оплаты',
								data: [ <?= implode(',', $payments) ?> ],
								borderWidth: 1,
								backgroundColor: pxUtil.hexToRgba('#36A766', 0.3),
								borderColor: '#36A766',
							},
							{
								label: 'Расходы',
								data: [ <?= implode(',', $expenses) ?> ],
								borderWidth: 1,
								backgroundColor: pxUtil.hexToRgba('#3156be', 0.3),
								borderColor: '#3156be',
							}],
						},
						options: {
							legend: {
								display: true
							},
						},
					});		
					
				});         
            </script>
        </div>
    </div>


	<div class="row">	
		
		<? if(!empty($waiting_moneys)):?>
        <div class="col-xs-12">
		    <div class="panel panel-danger panel-dark">
				<div class="panel-heading">
					<span class="panel-title"><i class="ion-android-alert"></i> Ожидающие платежи</span>
				</div>
	
		        <table class="table table-bordered">
			        <thead>
				        
				        <tr>
					        <th>ID заказа</th>
					        <th>Тип</th>
					        <th>Пользователь</th>
					        <th>Отправка</th>
					        <th>Получение</th>
					        <th>Метод</th>
					        <th>Сумма</th>
					        <th>Статус</th>
				        </tr>
				        
			        </thead>
			        <tbody>
				    	<? foreach($waiting_moneys as $waiting_money):?>
				    		
					        <tr>
						        <td><a href="<?= MODULES_URL?>orders/view/<?=$waiting_money['order_id']?>">Заказ №<?=$waiting_money['order_id']?></a></td>
						        <td>
							        <? if($waiting_money['type'] == 'income'):?>
							        <span class="label label-success">Доход</span>
							        <? else:?>
							        <span class="label label-warning">Расход</span>
							        <? endif;?>
						        </td>
								<td>
							        <?
								        switch($waiting_money['user_type'])
										{
											case 'installer':
												echo 'Монтажник';
											break;
											
											case 'supplier':
												echo 'Поставщик';
											break;
											
											case 'client':
												echo 'Клиент';
											break;
										}
									?>
								</td>
						        <td><?= date('d.m.Y', strtotime($waiting_money['date_create']));?></td>
						        <td><?= $waiting_money['date_receiving'] ? date('d.m.Y', strtotime($waiting_money['date_receiving'])) : '';?></td>
								<td>
							        <?
								        switch($waiting_money['method'])
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
								<td><?= number_format($waiting_money['amount'], 0, '.', ' ');?>грн.</td>
						        <td>
							        <? if($waiting_money['status'] == 'received'):?>
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
        <? endif;?>



		<? if(!empty($supplier_overpayments)):?>
        <div class="col-xs-12">
		    <div class="panel panel-danger panel-dark">
				<div class="panel-heading">
					<span class="panel-title"><i class="ion-android-alert"></i> Перепелаты поставщикам</span>
				</div>
	
		        <table class="table table-bordered">
			        <thead>
				        
				        <tr>
					        <th width="200">ID заказа</th>
					        <th width="200">№ договора</th>
					        <th width="200">Готовность</th>
					        <th>Поставщик</th>
					        <th>Газда</th>
					        <th>Оплачено</th>
					        <th>Адрес монтажа</th>
				        </tr>
				        
			        </thead>
			        <tbody>
				    	<? foreach($supplier_overpayments as $supplier_overpayment):?>
					        <tr>
						        <td><a href="<?= MODULES_URL?>orders/view/<?=$supplier_overpayment['id']?>"><?=$supplier_overpayment['id']?></a></td>
						        <td><a href="<?= MODULES_URL?>orders/view/<?=$supplier_overpayment['id']?>"><?=$supplier_overpayment['contract_number']?></a></td>
						        <td><?= $supplier_overpayment['readiness_date'] ? date('d.m.Y', strtotime($supplier_overpayment['readiness_date'])) : '-';?></td>
						        <td><a href="<?= MODULES_URL?>suppliers/view/<?=$supplier_overpayment['supplier_id']?>"><?= $supplier_overpayment['supplier_name'];?></a></td>
						        <td><?= number_format($supplier_overpayment['gazda_price'], 0, '.', ' ');?>грн.</td>
						        <td><?= number_format($supplier_overpayment['received_amount'], 0, '.', ' ');?>грн.</td>
						        <td><?= $supplier_overpayment['address'];?></td>
					        </tr>						    	
				    	<? endforeach;?>
				        
			        </tbody>
			        
				</table>
			</div>
        </div>
        <? endif;?>
        
        
		<? if(!empty($supplier_underpayments)):?>
        <div class="col-xs-12">
		    <div class="panel panel-warning panel-dark">
				<div class="panel-heading">
					<span class="panel-title"><i class="ion-alert-circled"></i> Недоплаты поставщикам</span>
				</div>
	
		        <table class="table table-bordered">
			        <thead>
				        
				        <tr>
					        <th width="200">ID заказа</th>
					        <th width="200">№ договора</th>
					        <th width="200">Готовность</th>
					        <th>Поставщик</th>
					        <th>Газда</th>
					        <th>Оплачено</th>
					        <th>Адрес монтажа</th>
				        </tr>
				        
			        </thead>
			        <tbody>
				    	<? foreach($supplier_underpayments as $supplier_underpayment):?>
					        <tr>
						        <td><a href="<?= MODULES_URL?>orders/view/<?=$supplier_underpayment['id']?>"><?=$supplier_underpayment['id']?></a></td>
						        <td><a href="<?= MODULES_URL?>orders/view/<?=$supplier_underpayment['id']?>"><?=$supplier_underpayment['contract_number']?></a></td>
						        <td><?= $supplier_underpayment['readiness_date'] ? date('d.m.Y', strtotime($supplier_underpayment['readiness_date'])) : '-';?></td>
						        <td><a href="<?= MODULES_URL?>suppliers/view/<?=$supplier_underpayment['supplier_id']?>"><?= $supplier_underpayment['supplier_name'];?></a></td>
						        <td><?= number_format($supplier_underpayment['gazda_price'], 0, '.', ' ');?>грн.</td>
						        <td><?= number_format($supplier_underpayment['received_amount'], 0, '.', ' ');?>грн.</td>
						        <td><?= $supplier_underpayment['address'];?></td>
					        </tr>						    	
				    	<? endforeach;?>
				        
			        </tbody>
			        
				</table>
			</div>
        </div>
        <? endif;?>
        
        
		
		<? if(!empty($last_payments)):?>
        <div class="col-xs-12">
		    <div class="panel panel-dark">
				<div class="panel-heading">
					<span class="panel-title"><i class="ion-social-usd"></i> Последние 50 платежей</span>
				</div>
	
		        <table class="table table-bordered">
			        <thead>
				        
				        <tr>
					        <th>ID заказа</th>
					        <th>Тип</th>
					        <th>Пользователь</th>
					        <th>Отправка</th>
					        <th>Получение</th>
					        <th>Метод</th>
					        <th>Сумма</th>
					        <th>Статус</th>
				        </tr>
				        
			        </thead>
			        <tbody>
				    	<? foreach($last_payments as $last_payment):?>
				    		
					        <tr>
						        <td><a href="<?= MODULES_URL?>orders/view/<?=$last_payment['order_id']?>">Заказ №<?=$last_payment['order_id']?></a></td>
						        <td>
							        <? if($last_payment['type'] == 'income'):?>
							        <span class="label label-success">Доход</span>
							        <? else:?>
							        <span class="label label-warning">Расход</span>
							        <? endif;?>
						        </td>
								<td>
							        <?
								        switch($last_payment['user_type'])
										{
											case 'installer':
												echo 'Монтажник';
											break;
											
											case 'supplier':
												echo 'Поставщик';
											break;
											
											case 'client':
												echo 'Клиент';
											break;
										}
									?>
								</td>
						        <td><?= date('d.m.Y', strtotime($last_payment['date_create']));?></td>
						        <td><?= $last_payment['date_receiving'] ? date('d.m.Y', strtotime($last_payment['date_receiving'])) : '';?></td>
								<td>
							        <?
								        switch($last_payment['method'])
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
								<td><?= number_format($last_payment['amount'], 0, '.', ' ');?>грн.</td>
						        <td>
							        <? if($last_payment['status'] == 'received'):?>
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
        <? endif;?>
        
	</div>
	