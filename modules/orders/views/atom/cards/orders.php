  
		
		<div class="page-header">
            <h1 class="col-xs-12 col-sm-12 text-center text-left-sm"><a href="<?= MODULES_URL ?>orders">Все заказы</a> &nbsp; / &nbsp; Заказ №<?=$order['id']?> от <?= date('d.m.Y', strtotime($order['measurement_date']));?></h1> 
        </div>	
		
		

        <div class="row">
	        
	        <div class="col-md-6 section" data-id="<?=$order['id']?>">
		        
		        
		        <!-- order panel -->
		        
			    <div class="panel">
					<div class="panel-heading">
						<span class="panel-title"><i class="ion-ios-cart"></i> Основная информация о заказе</span>
						
						<div class="pull-right">Статус: &nbsp;&nbsp;
							<select name="order[status]" class="j-ajax-save-order" style="display: inline-block; width: 100px;" <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?>>
								<option value="new" <?= (isset($order['status']) && ($order['status'] == 'new')) ? 'selected' : ''?>>Новый</option>
								<option value="processing" <?= (isset($order['status']) && ($order['status'] == 'processing')) ? 'selected' : ''?>>В обработке</option>
								<option value="measuring" <?= (isset($order['status']) && ($order['status'] == 'measuring')) ? 'selected' : ''?>>Замер</option>
								<option value="during" <?= (isset($order['status']) && ($order['status'] == 'during')) ? 'selected' : ''?>>В процессе</option>
								<option value="in_work" <?= (isset($order['status']) && ($order['status'] == 'in_work')) ? 'selected' : ''?>>В работе</option>
								<option value="complete" <?= (isset($order['status']) && ($order['status'] == 'complete')) ? 'selected' : ''?>>Готов</option>
								<option value="fulfilled" <?= (isset($order['status']) && ($order['status'] == 'fulfilled')) ? 'selected' : ''?>>Выполнен</option>
								<option value="archive" <?= (isset($order['status']) && ($order['status'] == 'archive')) ? 'selected' : ''?>>Архив</option>
							</select>
						</div>
					</div>
			        <div class="panel-body">
				        
				        
				        <div class="row">
					        
					        <div class="col-md-5 form-group inline-group">
						        <label class="col-md-12">Дата замера:</label>
						        <div class="col-md-12">
							        <div class="input-group">
										<input type="text" class="form-control j-datepicker j-ajax-save-order" name="order[measurement_date]" id="measurement_date" placeholder="" value="<?= isset($order['measurement_date']) ? 
									date('d.m.Y', strtotime($order['measurement_date'])) : '';?>" <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?> />
								        <i class="input-group-addon ion-android-calendar"></i>
							        </div>
						        </div>						        
					        </div>
					        
					        <div class="col-md-5 col-md-offset-1 form-group inline-group">
						        <label class="col-md-12">Дата готовности:</label>
						        <div class="col-md-12">
							        <div class="input-group">
										<input type="text" class="form-control j-datepicker j-ajax-save-order" name="order[readiness_date]" id="readiness_date" placeholder="" value="<?= isset($order['readiness_date']) ? date('d.m.Y', strtotime($order['readiness_date'])) : '';?>" <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?> />	
								        <i class="input-group-addon ion-android-calendar"></i>
							        </div>
						        </div>				        
					        </div>
				        </div>
				        
				        
				        <div class="row">
					        
					        
					        <div class="col-md-5 form-group inline-group">
						        <label class="col-md-12">Заявка на вывоз:</label>	
						        <div class="col-md-12">
							        <div class="input-group">
										<input type="text" class="form-control j-datepicker j-ajax-save-order" name="order[removal_date]" id="removal_date" placeholder="" value="<?= isset($order['removal_date']) ? 
									date('d.m.Y', strtotime($order['removal_date'])) : '';?>" <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?> />
								        <i class="input-group-addon ion-android-calendar"></i>
							        </div>
						        </div>						        
					        </div>
					        
					        
					        <div class="col-md-5 col-md-offset-1 form-group inline-group">
						        <label class="col-md-12">Дата монтажа:</label>
						        <div class="col-md-12">
							        <div class="input-group">
										<input type="text" class="form-control j-datepicker j-ajax-save-order" name="order[montage_date]" id="montage_date" placeholder="" value="<?= isset($order['montage_date']) ? date('d.m.Y', strtotime($order['montage_date'])) : '';?>" <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?> />				
								        <i class="input-group-addon ion-android-calendar"></i>
							        </div>
						        </div>	        
					        </div>
					        
				        </div>


				        <div class="row">
					        
					        
					        <div class="col-md-5 form-group inline-group">
						        <label class="col-md-12">Время доставки:</label>	
						        <div class="col-md-12">
							        <div class="input-group">
										<input type="text" class="form-control j-ajax-save-order" name="order[delivery_time]" id="delivery_time" placeholder="" value="<?= isset($order['delivery_time']) ? $order['delivery_time'] : '';?>" <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?> />
								        <i class="input-group-addon ion-clock"></i>
							        </div>
						        </div>						        
					        </div>
				        </div>					        

				        
				        <hr/>
				        
				        <div class="row">


					        <div class="col-xs-12 form-group">
						        <label>Предварительный расчет:</label>
						        <div class="input-group">
							        <strong class="input-group-addon"><i class="ion-ios-calculator"></i></strong>
									<input type="text" class="form-control j-ajax-save-order" name="order[calculation_link]" id="order[calculation_link]" placeholder="" value="<?= isset($order['calculation_link']) ? $order['calculation_link'] : '';?>" <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?> />
						        </div>
					        </div>
					        
							
					        <div class="col-xs-12 form-group <?= !$order['manager_id'] ? "has-error" : ""?>">
						        <label>Менеджер:</label>
								
								<select class="form-control j-ajax-save-order" name="order[manager_id]"  <?= !$this->auth->check_permission('Orders.ChangeManager') ? 'disabled=""' : ''?> <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?>>
									<option>Не выбран</option>
									<? foreach($managers as $manager):?>
									<option value="<?= $manager['id']?>" <?= (isset($order['manager_id']) && ($order['manager_id'] == $manager['id'])) ? 'selected' : ''?>><?= $manager['username']?></option>
									<? endforeach;?>
								</select>
					        </div>
					        

					        <div class="col-xs-12 form-group <?= !$order['supplier_id'] ? "has-error" : ""?>">
						        <label>Поставщик:</label>
								
								<select class="form-control j-ajax-save-order" name="order[supplier_id]" <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?>>
									<option>Не выбран</option>
									<? foreach($suppliers as $supplier):?>
									<option value="<?= $supplier['id']?>" <?= (isset($order['supplier_id']) && ($order['supplier_id'] == $supplier['id'])) ? 'selected' : ''?>><?= $supplier['company_name']?></option>
									<? endforeach;?>
								</select>
					        </div>
					        
					        
					        <div class="col-xs-12 form-group">
						        <label>Адрес установки:</label>
						        	
						        <div class="input-group">
							        <i class="input-group-addon ion-ios-location"></i>
									<input type="text" class="form-control j-ajax-save-order" name="order[address]" id="order[address]" placeholder="" value="<?= isset($order['address']) ? $order['address'] : '';?>" <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?> />		
						        </div>     
					        </div>
					        
					        
					        <div class="col-xs-12 form-group <?= !$order['installer_id'] ? "has-error" : ""?>">
						        <label>Монтажник:</label>
								
								
								<select class="form-control j-ajax-save-order" name="order[installer_id]" <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?>>
									<option>Не выбран</option>
									<? foreach($installers as $installer):?>
									<option value="<?= $installer['id']?>" <?= (isset($order['installer_id']) && ($order['installer_id'] == $installer['id'])) ? 'selected' : ''?>><?= $installer['name']?></option>
									<? endforeach;?>
								</select>
					        </div>
					        
					        <div class="col-xs-12 form-group <?= !$order['gauger_id'] ? "has-error" : ""?>">
						        <label>Замерщик:</label>
								
								<select class="form-control j-ajax-save-order" name="order[gauger_id]" <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?>>
									<option>Не выбран</option>
									<? foreach($installers as $installer):?>
									<option value="<?= $installer['id']?>" <?= (isset($order['gauger_id']) && ($order['gauger_id'] == $installer['id'])) ? 'selected' : ''?>><?= $installer['name']?></option>
									<? endforeach;?>
								</select>
					        </div>

					        
					        <div class="col-xs-12 form-group">
						        <label>Скидка:</label>
						        <div class="input-group">
							        <strong class="input-group-addon">%</strong>
									<input type="text" class="form-control j-ajax-save-order" name="order[discount]" id="order[discount]" placeholder="" value="<?= isset($order['discount']) ? $order['discount'] : '';?>" <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?> />
						        </div>
					        </div>


					        <div class="col-xs-12 form-group">
						        <label>Квадратные метры:</label>
						        <div class="input-group">
							        <strong class="input-group-addon">м<sup>2</sup></strong>
									<input type="text" class="form-control j-ajax-save-order" name="order[square_meters]" id="order[square_meters]" placeholder="" value="<?= isset($order['square_meters']) ? $order['square_meters'] : '';?>" <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?> />
						        </div>
					        </div>
					        
					        
					        <div class="col-xs-12 form-group">
						        <label>Номер расчета:</label>
								<input type="text" class="form-control j-ajax-save-order" name="order[calculation_number]" id="order[calculation_number]" placeholder="" value="<?= isset($order['calculation_number']) ? $order['calculation_number'] : '';?>" <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?> />
					        </div>

					        
					        <div class="col-xs-12 form-group">
						        <label>Номер договора:</label>
								<input type="text" class="form-control j-ajax-save-order" name="order[contract_number]" id="order[contract_number]" placeholder="" value="<?= isset($order['contract_number']) ? $order['contract_number'] : '';?>" <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?> />
					        </div>
					        

					        
					        <div class="col-xs-12 form-group">
						        <label>Номер заказа у поставщика:</label>
								<input type="text" class="form-control j-ajax-save-order" name="order[vendor_number]" id="order[vendor_number]" placeholder="" value="<?= isset($order['vendor_number']) ? $order['vendor_number'] : '';?>" <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?> />
					        </div>
					        
					        
				        </div>
				        
				        
				        <hr/>
				        
				        
				        <div class="row">
					        
					        <div class="col-md-5 form-group inline-group">
						        <label class="col-md-6">Стоимость:</label>
						        <div class="col-md-6">
									<input type="text" class="form-control j-calculate-balance j-ajax-save-order" name="order[total_price]" id="total_price" placeholder="" value="<?= isset($order['total_price']) ? $order['total_price'] : '';?>" <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?> />
						        </div>						        
					        </div>
					        
					        <div class="col-md-5 col-md-offset-1 form-group inline-group">
						        <label class="col-md-6">Монтаж:</label>
						        <div class="col-md-6">
									<input type="text" class="form-control j-ajax-save-order" name="order[montage_price]" id="montage_price" placeholder="" value="<?= isset($order['montage_price']) ? $order['montage_price'] : '';?>" <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?> />
						        </div>				        
					        </div>
				        </div>
				        
				        <div class="row">
					        
					        <div class="col-md-5 form-group inline-group">
						        <label class="col-md-6">Доп. работы:</label>
						        <div class="col-md-6">
									<input type="text" class="form-control j-ajax-save-order" name="order[additional_price]" id="additional_price" placeholder="" value="<?= isset($order['additional_price']) ? $order['additional_price'] : '';?>" <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?> />
						        </div>				        
					        </div>
					        
					        
					        <div class="col-md-5 col-md-offset-1 form-group inline-group">
						        <label class="col-md-6">Стоимость замера:</label>
						        <div class="col-md-6">
									<input type="text" class="form-control j-ajax-save-order" name="order[measuring_price]" id="measuring_price" placeholder="" value="<?= isset($order['measuring_price']) ? $order['measuring_price'] : '';?>" <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?> />
						        </div>				        
					        </div>
				        </div>

						
				        <div class="row">
							<? if($this->auth->get_user_role() != 1):?>
					        <div class="col-md-5 form-group inline-group">
						        <label class="col-md-6">Газда:</label>
						        <div class="col-md-6">
									<input type="text" class="form-control j-ajax-save-order" name="order[gazda_price]" id="gazda_price" placeholder="" value="<?= isset($order['gazda_price']) ? $order['gazda_price'] : '';?>" <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?> />
						        </div>				        
					        </div>

					        <div class="col-md-5 col-md-offset-1 form-group inline-group">
						        <label class="col-md-6">Фактический остаток:</label>
						        <div class="col-md-6">
									<input type="text" class="form-control j-ajax-save-order" id="balance" placeholder="" value="<?= $order['total_price'] - $order['received_amount'] ?>" disabled="" />
						        </div>						        
					        </div>
							<? endif;?>
				        </div>

				        
				        <hr/>
				        
				        <div class="row">
					        
					        <div class="col-xs-12 form-group">
						        <label>Комментарий к заказу:</label>
						        	
								<textarea name="order[comment]" class="form-control j-ajax-save-order" rows="4" style="resize: vertical" <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?>><?= isset($order['comment']) ? $order['comment'] : '';?></textarea>	
					        </div>
				        </div>
					</div>
				</div>
			    
		        <!-- end: order panel -->
			    
			    
		        <!-- order payments -->
			    <div class="panel">
					<div class="panel-heading">
						<span class="panel-title"><a data-toggle="collapse" href="#payments"><i class="ion-social-usd"></i> Оплаты по заказу</a></span>
					</div>
					<div id="payments" class="panel-collapse collapse in">
						
						<? if($this->auth->get_user_role() != 1):?>
				        <div class="panel-body">
					        <a href="<?= MODULES_URL?>orders_payments/add/<?=$order['id']?>" data-toggle="mainmodal" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Добавить оплату</a> 
				        </div>
				        <? endif;?>
				        
						<table class="table table-bordered" style="margin-bottom: 0px;">
						        <thead>
							        <tr>
								        <th>Тип</th>
								        <th>Кто/Кому</th>
								        <th>Дата оплаты</th>
								        <th>Сумма</th>
								        <th>Статус</th>
								        <th width="80"></th>
							        </tr>
						        </thead>
						        <tbody>
							        <? foreach($orders_payments as $payment):?>
							        <tr>
								        <td>
									        <? if($payment['type'] == 'income'):?>
									        <span class="label label-success">Доход</span>
									        <? else:?>
									        <span class="label label-warning">Расход</span>
									        <? endif;?>
									    </td>
								        <td>
									        <?
										        switch($payment['user_type'])
												{
													case 'client':
														echo 'Клиент';
													break;
													
													case 'installer':
														echo 'Монтажник';
													break;
													
													case 'supplier':
														echo 'Поставщик';
													break;

													case 'gauger':
														echo 'Замерщик';
													break;
												}
											?>
								        </td>
								        <td><?= date('d.m.Y', strtotime($payment['date_create']));?></td>
								        
										<? if($this->auth->get_user_role() != 1):?>
								        <td><a href="<?= MODULES_URL?>orders_payments/edit/<?=$payment['id']?>" data-toggle="mainmodal"><?= number_format($payment['amount'], 0, '.', ' ');?>грн.</a></td>
								        <? else:?>
								        <td><?= number_format($payment['amount'], 0, '.', ' ');?>грн.</td>
								        <? endif;?>
								        
								        <td>
									        <? if($payment['status'] == 'received'):?>
									        <span class="label label-success">Получено</span>
									        <? else:?>
									        <span class="label label-default">Отправлено</span>
									        <? endif;?>
								        </td>
								        <td class="text-right">
									        
									        <div class="btn-group">
										        <? if($payment['comment'] != ''):?>
									        	<a href="#" data-toggle="tooltip" data-title="<?= $payment['comment']?>" class="btn btn-xs btn-warning"><i class="ion-android-textsms"></i></a>
									        	<? endif;?>
									        </div>
								        </td>
							        </tr>
							        <? endforeach;?>
						        </tbody>
					        </table>
					</div>
			    </div>
		        <!-- end: order payments -->
			    
			    
			    
			    

		        <!-- order files -->
			    <div class="panel">
					<div class="panel-heading">
						<span class="panel-title"><a data-toggle="collapse" href="#files"><i class="ion-ios-folder"></i> Файлы заказа</a></span>
					</div>
					<div id="files" class="panel-collapse collapse in">
						<? if($this->auth->get_user_role() != 1):?>
				        <div class="panel-body">
					        <a href="#uploadfile" data-toggle="modal" class="btn btn-primary btn-sm"><i class="fa fa-cloud-upload"></i> Загрузить файл</a> 
				        </div>
				        <? endif;?>
				        
						<table class="table table-bordered" style="margin-bottom: 0px;">
					        <thead>
						        <tr>
							        <th width="200">Файл</th>
							        <th>Загрузил</th>
							        <th>Дата загрузки</th>
							        <th width="300">Комментарий</th>
							        
									<? if($this->auth->get_user_role() != 1):?>
							        <th width="50"></th>
							        <? endif;?>
						        </tr>
					        </thead>
					        <tbody>
						        <? foreach($files as $file):?>
						        <tr>
							        <td><a href="#"><?=$file['filename']?></a></td>
							        <td><?=$file['username']?></td>
							        <td><?= date('H:i d.m.Y', strtotime($file['upload_date']));?></td>
							        <td><?=$file['comment']?></td>
									
									<? if($this->auth->get_user_role() != 1):?>
							        <td>
								        <a href="<?= MODULES_URL?>orders/delete_file/<?=$order['id']?>/<?=$file['id']?>"  onclick="return confirm('Вы уверены что хотите удалить файл?');"  class="btn btn-xs btn-danger">
									        <i class="fa fa-trash"></i>
									    </a>
									</td>
									<? endif;?>
						        </tr>
						        <? endforeach;?>
					        </tbody>
				        </table>
					</div>
			    </div>
		        <!-- end: order files -->
			    
	        </div>
	        
	        
	        <div class="col-md-6 section" data-id="<?=$client['id']?>">
		        
			    <div class="panel">
					<div class="panel-heading">
						<span class="panel-title"><i class="ion-person"></i> Информация о клиенте</span>
					</div>
			        <table class="table table-bordered" style="margin-bottom: 0px;">
				        <tbody>
							<tr>
						    	<td>ID клиента</td>
						    	<td><?= $client['id']; ?></td>
						    </tr>
							<tr>
						    	<td>ФИО</td>
						    	<td><a href="<?= MODULES_URL?>clients?id=<?= $client['id']; ?>"><?= $client['name']; ?></a></td>
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
						    	<td>
							    	<textarea class="j-save-client-note form-control j-ajax-save-order" name="client[comment]" <?= !$this->auth->check_permission('Orders.Edit') ? 'disabled=""' : ''?>><?= $client['comment']; ?></textarea>
							    </td>
						    </tr>
				        </tbody>
			        </table>

			    </div>
			    
				<? if($this->auth->get_user_role() != 1):?>
			    <div class="panel">
					<div class="panel-heading">
						<span class="panel-title"><a data-toggle="collapse" href="#lead"><i class="ion-checkmark-circled"></i> Информация о лиде</a></span>
					</div>
					<div id="lead" class="panel-collapse collapse">
				        <table class="table table-bordered" style="margin-bottom: 0px;">
					        <tbody>
								<tr>
							    	<td>ID</td>
							    	<td><a href="<?=MODULES_URL?>leads?id=<?= $lead['id']; ?>">Лид №<?= $lead['id']; ?></a></td>
							    </tr>
								<tr>
							    	<td>Адрес</td>
							    	<td><?= $lead['address']; ?></td>
							    </tr>
								<tr>
							    	<td>Комментарий</td>
							    	<td><?= $lead['comment']; ?></td>
							    </tr>
							    
								<tr>
							    	<td>Источник</td>
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
							    </tr>		
								<tr>
							    	<td>Дата</td>
							    	<td><?= date('d.m.Y', strtotime($lead['date'])); ?></td>
							    </tr>		
					        </tbody>
				        </table>
					</div>
			    </div>
			    <? endif;?>
			    
				<? if($this->auth->get_user_role() != 1):?>
			    <div class="panel">
					<div class="panel-heading">
						<span class="panel-title"><a data-toggle="collapse" href="#clientOrders"><i class="ion-ios-cart"></i> Заказы клиента</a></span>
					</div>
					<div id="clientOrders" class="panel-collapse collapse in">
				        <table class="table table-bordered" style="margin-bottom: 0px;">
					        <thead>
						        <tr>
							        <th>ID</th>
							        <th>№ договора</th>
							        <th>Готовность</th>
							        <th>Монтажник</th>
							        <th>Адрес монтажа</th>
							        <th>Статус</th>
						        </tr>
					        </thead>
					        <tbody>
						        <? foreach($client_orders as $client_order):?>
						        <tr>
							        <td><a href="<?= MODULES_URL?>orders/view/<?=$client_order['id']?>"><?=$client_order['id']?></a></td>
							        <td><a href="<?= MODULES_URL?>orders/view/<?=$client_order['id']?>"><?=$client_order['contract_number']?></a></td>
							        <td><?= $client_order['readiness_date'] ? date('d.m.Y', strtotime($client_order['readiness_date'])) : '-';?></td>
							        <td><?= $client_order['installer_name']?></td>
							        <td><?= $client_order['address'];?></td>
								<td>
									<? 
										switch($client_order['status'])
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
										
								
								
									?>
									
								</td>
						        </tr>
						        <? endforeach;?>
					        </tbody>
				        </table>
					</div>
			    </div>
			    <? endif;?>
			    
			    
	        </div>
        </div>
        
        
        
        


		<div class="modal fade" tabindex="-1" role="dialog" id="uploadfile">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
	          <form action="<?= MODULES_URL?>orders/upload_file/<?=$order['id']?>" method="post" class="form-vertical" enctype="multipart/form-data">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title">Загрузить файл</h4>
			      </div>
			      <div class="modal-body">
				      
				        
				        <div class="form-group">
					        <label>Выберите файл</label>
					        <input type="file" name="file" />
				        </div>
				        
				        <div class="form-group">
					        <label>Комментарий</label>
					        <textarea class="form-control" style="resize: vertical" name="comment"></textarea>
				        </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Отменить</button>
			        <button type="submit" class="btn btn-primary">Загрузить файл</button>
			      </div>
		      		        
	          </form>
		      
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
        
        <style>
	        
	        .inline-group label {padding-top: 5px;}
	        
	        
	        .table-order tr:first-child td, .table-order tr th {border:none !important;}
	        
	    </style>
        
        
        
     
        
        
		<script>
			
	       $.fn.datepicker.dates['ru'] = {
	            days: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
			    daysShort: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
			    daysMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
			    months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
			    monthsShort: ["Янв", "Фев", "Март", "Апр", "Май", "Июнь", "Июль", "Авг", "Сент", "Окт", "Ноя", "Дек"],
			    today: "Сегодня",
			    clear: "Очистить",
			    format: "dd.mm.yyyy",
			    titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
			};
			
			 $('input.j-datepicker').datepicker({'format': 'dd.mm.yyyy', weekStart: 1, todayHighlight: true, language: 'ru'});
			 
			 
			 
			 
			 $('.j-calculate-balance').on('change', function(){
				
				$('input#balance').val(parseInt($('input[name="order[total_price]"]').val()) - parseInt($('input[name="order[prepaid]"]').val()));
				 
			 });
			 
			 $('.j-ajax-save-order').on('change', function(){
				var target = $(this);
				
				$.post('/atom/module/orders/ajax_save/', {name: target.attr('name'), value: target.val(), id: target.parents('.section').data('id')}, function(response){
					
					if(response.result == false)
						$.growl.error({title: 'Ошибка!', message: response.message });

				}, 'json');
				 
			 });
			 
			 
			 $('body').on('change', '[name="order[montage_date]"]', function(){			
				 
				var next_day = moment($(this).val(), "DD.MM.YYYY").subtract(1, 'days');
				
				
				while(next_day.day() == 6 || next_day.day() == 0)
				{
					next_day = moment(next_day).subtract(1, 'days');
				}
				
				 
				$('input[name="order[removal_date]"]').val(moment(next_day).format('DD.MM.YYYY')).trigger('change');
			 });
			 
			 			 
			 
			 
		</script>