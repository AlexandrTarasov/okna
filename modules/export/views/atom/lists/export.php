
		<div class="page-header"> 
             <h1 class="col-xs-12 col-sm-12 text-center text-left-sm">Заявки на вывоз</h1> 
        </div>	
        
		<? $days = array(
		    'Воскресенье', 'Понедельник', 'Вторник', 'Среда',
		    'Четверг', 'Пятница', 'Суббота'
		);
		?>		
		<? foreach($suppliers as $supplier):?>
		
			<? if(!empty($supplier['orders'])):?>
	        <div class="panel">
				<div class="panel-heading">
					Заявки для поставщика "<?=$supplier['company_name']?>"
				</div>
		        <table class="table table-bordered table-condensed table-smallheader j-tableSelecteble j-export-table">
		        	<thead>
		           		<tr>
				           	<th class="text-center">
					           Отправлено?	<input type="checkbox" class="j-globalSelect" />
					        </th>
					        <th>Заказ #</th>
							<th>Вывозить</th>
							<th>Адрес</th>
							<th>Монтажник</th>
							<th>Телефон</th>
						</tr>
					</thead>
		        	<tbody>
			        	<? foreach($supplier['orders'] as $order):?>
						<tr data-id="<?= $order['id'] ?>">
							<td class="text-center"><input type="checkbox" class="j-removal-sent" <?= $order['removal_request_sent'] == true ? 'checked=""' : ''?> /></td>
				        	<td><?=$order['contract_number']?></td>
				        	<td><?= $days[(date('w', strtotime($order['removal_date'])))] . ', ' . date('d-m', strtotime($order['removal_date']))?></td>
				        	<td><?=$order['address']?></td>
				        	<td><?=$order['installer_name']?></td>
				        	<td><?=russianPhoneFormat($order['installer_phone'])?></td>
			        	</tr>	
			        	<? endforeach;?>			        	
					</tbody>
		        </table>
	        </div>        
			<hr />
			<? endif;?>
		<? endforeach;?>
		
		
		
		
		<script>
			
			
			$('.j-export-table tbody input.j-removal-sent').on('change', function(e){
				e.preventDefault();
				
				$.post('/atom/module/export/removal_request_check', {id: $(this).parents('tr').data('id'), status: $(this).is(':checked')}, function(response)
				{
					
					if(response.result == false)
						$.growl.error({title: 'Ошибка!', message: response.message });
				});
				
			});
			
		</script>