
		<div class="page-header"> 
            <h1 class="col-xs-12 col-sm-12 text-center text-left-sm"><a href="<?= MODULES_URL ?>installers">Монтажники</a> &nbsp; / &nbsp; <?= isset($installer) ? lang('atom_form_edit_item') : lang('atom_form_add_item')?></h1> 
        </div>	
        
        <div class="panel">
	        <div class="panel-body">
	        	<form action="/<?= uri_string()?>" method="post" class="form-horizontal">
					<input type="hidden" name="atom_user_id" value="<?= isset($installer['atom_user_id']) ? $installer['atom_user_id'] : '';?>" />
					
					
					
					<div class="form-group">
				        <label class="col-md-2" for="name">Логин в системе</label>
						<div class="col-md-6">
			           		<input type="text" class="form-control" name="username" id="username" placeholder="" value="<?= isset($atom_user['username']) ? $atom_user['username'] : '';?>" <?= isset($atom_user['username']) ? 'readonly=""' : '';?> />
						</div>
					</div>
					

					<div class="form-group">
				        <label class="col-md-2" for="name">Пароль в систему</label>
						<div class="col-md-6">
			           		<input type="password" class="form-control" name="password" id="password" placeholder="" value="<?= isset($installer['password']) ? $installer['password'] : '';?>" />
			           		<? if(isset($installer)):?>
			           		<p class="help-block">Вводите только если нужно изменить пароль</p>
			           		<? endif;?>
						</div>
					</div>
										
					
					<hr/>
					<div class="form-group">
				        <label class="col-md-2" for="phone">Телефон</label>
						<div class="col-md-6">
			           		<input type="text" class="form-control j-phone" autocomplete="off" name="phone" id="phone" placeholder="Phone" value="<?= isset($installer['phone']) ? $installer['phone'] : '';?>" />
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="phone2">Телефон 2</label>
						<div class="col-md-6">
			           		<input type="text" class="form-control j-phone" autocomplete="off" name="phone2" id="phone2" placeholder="Phone2" value="<?= isset($installer['phone2']) ? $installer['phone2'] : '';?>" />
						</div>
					</div>
					
					<div class="form-group">
				        <label class="col-md-2" for="viber">Viber</label>
						<div class="col-md-6">
							<div class="input-group">
			           			<input type="text" class="form-control j-phone" autocomplete="off" name="viber" id="viber" placeholder="Viber" value="<?= isset($installer['viber']) ? $installer['viber'] : '';?>" />
			           			<div class="input-group-btn">
			           				<a href="#" class="btn btn-primary j-copy-main-phone">Скопировать основной номер</a>
			           			</div>
							</div> 
						</div>
					</div>
					<hr/>
					
					
					<div class="form-group">
				        <label class="col-md-2" for="name">ФИО</label>
						<div class="col-md-10">
			           		<input type="text" class="form-control" name="name" id="name" placeholder="Иванов Иван Иванович" value="<?= isset($installer['name']) ? $installer['name'] : '';?>" />
						</div>
					</div>
					

					<div class="form-group">
				        <label class="col-md-2" for="address">Адрес</label>
						<div class="col-md-10">
			           		<input type="text" class="form-control" name="address" id="address" placeholder="" value="<?= isset($installer['address']) ? $installer['address'] : '';?>" />
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="email">Email</label>
						<div class="col-md-10">
			           		<input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= isset($installer['email']) ? $installer['email'] : '';?>" />
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="comment">Комментарий</label>
						<div class="col-md-10">
			            <textarea class="form-control" rows="3" name="comment" id="comment" placeholder="Этот комментарий виден только админу и менеджеру"><?= isset($installer['comment']) ? $installer['comment'] : '';?></textarea>
						</div>
					</div>
					<input type="hidden" name="id" value="<?= isset($installer['id']) ? $installer['id'] : '';?>" /> 
					<button type="submit" class="btn btn-primary"><?=lang('atom_save')?></button> 
					<a href="<?= MODULES_URL ?>installers" class="btn btn-default"><?=lang('atom_cancel')?></a>
				</form>
	    	</div>
	    </div>
	    
	    
	    <script>
		    
		    $('.j-copy-main-phone').on('click', function(e){
			    e.preventDefault();			    
			    $('input[name="viber"]').val($('input[name="phone"]').val());
		    });
		    
		</script>