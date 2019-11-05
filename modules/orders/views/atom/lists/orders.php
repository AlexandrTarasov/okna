
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
            <div class="col-md-8 col-xs-4">
            </div>
	        <div class="col-md-4 col-xs-8 text-right">
                <form class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Улица / Имя клиента / Номер телефона" value="">
                        <span class="input-group-btn">
                          <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
	        </div>
        </div>

		        
        <div class="panel">
	        <div class="panel-body">
		        <div class="tableScrollable">
		                
			        <table class="table table-hover table-bordered table-condensed table-smallheader j-tableSelecteble j-tableFilterable">
			        	<thead>
			           		<tr>
				           		<th><span
								<th><span data-name="contract_number">№ договора</span></th>
								<th><span data-name="address">Адрес</span></th>
								<th><span data-name="client_id" data-type="select" data-source="<?=MODULES_URL?>orders/filters/clients">Клиент</span></th>
								<? if($this->auth->get_user_role() == 1):?>
								<th>Телефон</th>
								<? endif;?>
								<th><span data-name="montage_date">Дата монтажа</span></th>
								
								<? if($this->auth->get_user_role() != 1):?>
								<th><span data-name="installer_id"  data-type="select" data-source="<?=MODULES_URL?>orders/filters/installers">Монтажник</span></th>								
								<? endif;?>

								<th><span data-name="status" data-type="select" data-source="<?=MODULES_URL?>orders/filters/status">Статус</span></th>
								
								<? if(!$this->auth->check_permission('Orders.Installer')):?>
								<th class="text-right" width="50"><?=lang('atom_list_actions')?></th>
								<? endif;?>
							</tr>
						</thead>
			        	<tbody>
							<? foreach ($orders as $order): ?>
							<tr>
								<? if($this->auth->get_user_role() == 1):?>
								<td><a href="<?= MODULES_URL ?>orders/view/<?=$order['id'] ?>"><?= $order['contract_number'] ?></a></td>
								<td><a href="<?= MODULES_URL ?>orders/view/<?=$order['id'] ?>"><?= $order['address'] ?></a></td>
								<td><?= $order['client_name'] ?></td>
								<td><a href="tel:<?=$order['client_phone']?>"><?= russianPhoneFormat($order['client_phone']); ?></a></td>
								<? else:?>
								<td><a href="<?= MODULES_URL ?>orders/view/<?=$order['id'] ?>"><?= $order['contract_number'] ?></a></td>
								<td><a href="<?= MODULES_URL ?>orders/view/<?=$order['id'] ?>"><?= $order['address'] ?></a></td>
								<td><a href="<?= MODULES_URL ?>clients/view/<?= $order['client_id'] ?>"><?= $order['client_name'] ?></a></td>
								<? endif;?>

								<td><?= $order['montage_date'] ? date('d.m.Y', strtotime($order['montage_date'])) : ''?></td>
								
								<? if($this->auth->get_user_role() != 1):?>
								<td><?= $order['installer_name'] ? '<a href="'.MODULES_URL.'installers/view/'.$order['installer_id'] .'">'.$order['installer_name'] .'</a>' : '' ?></td>
								<? endif;?>
								
								<td>
									<? 
										switch($order['status'])
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
								<? if(!$this->auth->check_permission('Orders.Installer')):?>
								<td style="text-align:right" width="50px">
									<div class="btn-group" style="display: block; width: 70px;">
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



        
       <script>
	   		$('input[name="search"]').on("keydown", function( event ) {								
				var input = $(this);
				
			    input.autocomplete({
					source: function(request, respond){
						$.post('<?=MODULES_URL?>orders/filters/search', {value:$.trim(request.term)}, function(response){
							var items = [];
							
							$.each(response.clients, function(i, client) {
								items.push({ label: 'Клиент: ' + client.name, filter: 'client_id=' + client.id});
							});



							$.each(response.phones, function(i, phone) {
								items.push({ label: 'Клиент: ' + phone.name + ' ('+phone.phone + ', ' + phone.phone2 + ')', filter: 'client_id=' + phone.id});
							});


							$.each(response.addresses, function(i, address) {
								items.push({ label: 'Адрес: ' + address.address, filter: 'address=' + encodeURI(address.address)});
							});


							respond(items);
						}, 'json');
					},
					focus: function(){return false;},
					minLength: 3,
					select: function(event, ui){ 
						
						 window.location.href = '<?=MODULES_URL?>orders?' + ui.item.filter;
						return false;
				    }    
				});
		    });	
	   </script> 
        
               