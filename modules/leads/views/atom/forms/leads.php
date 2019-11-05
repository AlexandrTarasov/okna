
		<div class="page-header"> 
            <h1 class="col-xs-12 col-sm-12 text-center text-left-sm"><a href="<?= MODULES_URL ?>leads">Лиды</a> &nbsp; / &nbsp; <?= isset($lead) ? lang('atom_form_edit_item') : lang('atom_form_add_item')?></h1> 
        </div>	
        
        
        
        <div class="panel">
	        <div class="panel-body">
	        	<form action="/<?= uri_string()?>" method="post" class="form-horizontal">
		
		
					<div class="form-group">
				        <label class="col-md-2" for="client_id">Клиент ID</label>
						<div class="col-md-10">
			           		<input type="text" class="form-control" name="client_id" id="client_id" placeholder="" value="<?= isset($lead['client_id']) ? $lead['client_id'] : '';?>" readonly="" />
						</div>
					</div>
					
					<div class="form-group">
				        <label class="col-md-2" for="client_id">ФИО</label>
						<div class="col-md-10">
			           		<input type="text" class="form-control j-search-for-client" name="name" id="name" placeholder="" value="<?= isset($client['name']) ? $client['name'] : '';?>" />
						</div>
					</div>
					
					<div class="form-group">
				        <label class="col-md-2" for="phone">Телефон</label>
						<div class="col-md-6">
			           		<input type="text" class="form-control j-phone j-search-for-client" autocomplete="off" name="phone" id="phone" placeholder="" value="<?= isset($client['phone']) ? $client['phone'] : '';?>" />
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="phone2">Телефон 2</label>
						<div class="col-md-6">
			           		<input type="text" class="form-control j-phone j-search-for-client" autocomplete="off" name="phone2" id="phone2" placeholder="" value="<?= isset($client['phone2']) ? $client['phone2'] : '';?>" />
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="viber">Viber</label>
						<div class="col-md-6">
							<div class="input-group">
			           			<input type="text" class="form-control j-phone j-search-for-client" autocomplete="off" name="viber" id="viber" placeholder="Viber" value="<?= isset($client['viber']) ? $client['viber'] : '';?>" />
			           			<div class="input-group-btn">
			           				<a href="#" class="btn btn-primary j-copy-main-phone">Скопировать основной номер</a>
			           			</div>
							</div> 
						</div>
					</div>

					<div class="form-group">
				        <label class="col-md-2" for="email">E-mail</label>
						<div class="col-md-10">
			           		<input type="email" class="form-control j-search-for-client" name="email" id="email" autocomplete="off"  placeholder="Email" value="<?= isset($client['email']) ? $client['email'] : '';?>" />
						</div>
					</div>
					
					
					<hr />
					
					<div class="form-group">
				        <label class="col-md-2" for="address">Адрес установки</label>
						<div class="col-md-10">
			            	<input class="form-control" name="address" id="address" placeholder="" value="<?= isset($lead['address']) ? $lead['address'] : '';?>" />
						</div>
					</div>
					
					
					<div class="form-group">
				        <label class="col-md-2" for="comment">Комментарий</label>
						<div class="col-md-10">
			            <textarea class="form-control" rows="3" name="comment" id="comment" placeholder=""><?= isset($lead['comment']) ? $lead['comment'] : '';?></textarea>
						</div>
					</div>

					<div class="form-group">
				        <label class="col-md-2" for="source">Источник</label>
						<div class="col-md-10">
				            <select class="form-control" name="source" id="source">
								<option value="call" <?= (isset($lead['source']) && ($lead['source'] == 'call')) ? 'selected' : ''?>>Звонок</option>
								<option value="adwords" <?= (isset($lead['source']) && ($lead['source'] == 'adwords')) ? 'selected' : ''?>>Adwords</option>
								<option value="facebook" <?= (isset($lead['source']) && ($lead['source'] == 'facebook')) ? 'selected' : ''?>>Facebook</option>
								<option value="instagram" <?= (isset($lead['source']) && ($lead['source'] == 'instagram')) ? 'selected' : ''?>>Instagram</option>
								<option value="recommendation" <?= (isset($lead['source']) && ($lead['source'] == 'recommendation')) ? 'selected' : ''?>>Рекомендация</option>
								<option value="youtube" <?= (isset($lead['source']) && ($lead['source'] == 'youtube')) ? 'selected' : ''?>>Youtube</option>
							</select>
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="date">Дата</label>
						<div class="col-md-10">
			           		<input type="text" class="form-control j-datepicker" name="date" id="date" data-format="dd.mm.yyyy" placeholder="" value="<?= isset($lead['date']) ? $lead['date'] : date('d.m.Y');?>" />
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="status">Статус</label>
						<div class="col-md-10">
				            <select class="form-control" name="status" id="status">
								<option value="new" <?= (isset($lead['status']) && ($lead['status'] == 'new')) ? 'selected' : ''?>>Новая</option>
								<option value="processing" <?= (isset($lead['status']) && ($lead['status'] == 'processing')) ? 'selected' : ''?> seleted="">В обработке</option>
								<option value="accepted" <?= (isset($lead['status']) && ($lead['status'] == 'accepted')) ? 'selected' : ''?> disabled="">Принят (используйте кнопку "заказ принят")</option>
								<option value="canceled" <?= (isset($lead['status']) && ($lead['status'] == 'canceled')) ? 'selected' : ''?>>Отменён</option>
							</select>
						</div>
					</div>
					<input type="hidden" name="id" value="<?= isset($lead['id']) ? $lead['id'] : '';?>" /> 
					<button type="submit" class="btn btn-primary"><?=lang('atom_save')?></button> 
					<a href="<?= MODULES_URL ?>leads" class="btn btn-default"><?=lang('atom_cancel')?></a>
				</form>
	    	</div>
	    </div>
	    
	    
	    <script>
		    
		    
		    $('input.j-datepicker').datepicker({'format': 'dd.mm.yyyy'});
		    
		    
			$('input.j-search-for-client').on("keydown", function( event ) {			
				var input = $(this);
			    input.autocomplete({
					source: function(request, respond){
						$.post('/atom/module/clients/ajax/search_for_client', {input:input.attr('name'), value:$.trim(request.term)}, function(response){
							var items = [];
							$.each(response, function(i, item) {
								items.push({ label: item.name +', '+item.phone+', '+item.phone2+', ' +item.email+' '+item.address, value: item});
							});
							respond(items);
						}, 'json');
					},
					focus: function(){return false;},
					minLength: 4,
					select: function(event, ui){ 
						$('input[name="client_id"]').val(ui.item.value.id);
						$('input[name="name"]').val(ui.item.value.name);
						$('input[name="phone"]').val(ui.item.value.phone);
						$('input[name="phone2"]').val(ui.item.value.phone2);
						$('input[name="viber"]').val(ui.item.value.viber);
						$('input[name="email"]').val(ui.item.value.email);
						$('input[name="address"]').val(ui.item.value.address);
						return false;
				    }    
				});
		    });					    
	
		    
		    $('.j-copy-main-phone').on('click', function(e){
			    e.preventDefault();			    
			    $('input[name="viber"]').val($('input[name="phone"]').val());
		    });
		    		    
		    
		    
		</script>
	    
	    