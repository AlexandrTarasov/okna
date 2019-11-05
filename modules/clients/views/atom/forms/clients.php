
		<div class="page-header"> 
            <h1 class="col-xs-12 col-sm-12 text-center text-left-sm"><a href="<?= MODULES_URL ?>clients">Клиенты</a> &nbsp; / &nbsp; <?= isset($client) ? lang('atom_form_edit_item') : lang('atom_form_add_item')?></h1> 
        </div>	
        
        <div class="panel">
	        <div class="panel-body">
	        	<form action="/<?= uri_string()?>" method="post" class="form-horizontal">
		
					<div class="form-group">
				        <label class="col-md-2" for="name">ФИО</label>
						<div class="col-md-10">
			           		<input type="text" class="form-control" name="name" id="name" autocomplete="off"  placeholder="Иван Иванович Иваненко" value="<?= isset($client['name']) ? $client['name'] : '';?>" />
						</div>
					</div>
					
					<hr/>
					<div class="form-group">
				        <label class="col-md-2" for="phone">Телефон</label>
						<div class="col-md-6">
			           		<input type="text" class="form-control j-phone" autocomplete="off" name="phone" id="phone" placeholder="Phone" value="<?= isset($client['phone']) ? $client['phone'] : '';?>" />
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="phone2">Телефон 2</label>
						<div class="col-md-6">
			           		<input type="text" class="form-control j-phone" autocomplete="off" name="phone2" id="phone2" placeholder="Phone2" value="<?= isset($client['phone2']) ? $client['phone2'] : '';?>" />
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="viber">Viber</label>
						<div class="col-md-6">
							<div class="input-group">
			           			<input type="text" class="form-control j-phone" autocomplete="off" name="viber" id="viber" placeholder="Viber" value="<?= isset($client['viber']) ? $client['viber'] : '';?>" />
			           			<div class="input-group-btn">
			           				<a href="#" class="btn btn-primary j-copy-main-phone">Скопировать основной номер</a>
			           			</div>
							</div> 
						</div>
					</div>
					<hr/>
					
					<div class="form-group">
				        <label class="col-md-2" for="address">Адрес</label>
						<div class="col-md-10">
			           		<input type="text" class="form-control" name="address" autocomplete="off"  id="address" placeholder="" value="<?= isset($client['address']) ? $client['address'] : '';?>" />
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="comment">Комментарий</label>
						<div class="col-md-10">
			           		<textarea class="form-control" name="comment" id="comment" autocomplete="off"  placeholder="Этот комментарий виден только админу и менеджеру"><?= isset($client['comment']) ? $client['comment'] : '';?></textarea>
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="email">E-mail</label>
						<div class="col-md-10">
			           		<input type="email" class="form-control" name="email" id="email" autocomplete="off"  placeholder="Email" value="<?= isset($client['email']) ? $client['email'] : '';?>" />
						</div>
					</div>
					<input type="hidden" name="id" value="<?= isset($client['id']) ? $client['id'] : '';?>" /> 
					<button type="submit" class="btn btn-primary"><?=lang('atom_save')?></button> 
					<a href="<?= MODULES_URL ?>clients" class="btn btn-default"><?=lang('atom_cancel')?></a>
				</form>
	    	</div>
	    </div>
	    
	    
	    <script>
		    
		    $('.j-copy-main-phone').on('click', function(e){
			    e.preventDefault();			    
			    $('input[name="viber"]').val($('input[name="phone"]').val());
		    });
		    
		</script>