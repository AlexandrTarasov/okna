
		<div class="page-header"> 
            <h1 class="col-xs-12 col-sm-12 text-center text-left-sm"><a href="<?= MODULES_URL ?>suppliers">Поставщики</a> &nbsp; / &nbsp; <?= isset($supplier) ? lang('atom_form_edit_item') : lang('atom_form_add_item')?></h1> 
        </div>	
        
        <div class="panel">
	        <div class="panel-body">
	        	<form action="/<?= uri_string()?>" method="post" class="form-horizontal">
		
					<div class="form-group">
				        <label class="col-md-2" for="company_name">Название компании</label>
						<div class="col-md-10">
			           		<input type="text" class="form-control" name="company_name" id="company_name" placeholder="Название" value="<?= isset($supplier['company_name']) ? $supplier['company_name'] : '';?>" />
						</div>
					</div>
					
					<hr/>
					<div class="form-group">
				        <label class="col-md-2" for="manager_name">Имя менеджера</label>
						<div class="col-md-10">
			           		<input type="text" class="form-control" name="manager_name" id="manager_name" placeholder="Иван Иванович Иваненко" value="<?= isset($supplier['manager_name']) ? $supplier['manager_name'] : '';?>" />
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="manager_phone">Телефон менеджера</label>
						<div class="col-md-10">
			           		<input type="text" class="form-control j-phone" name="manager_phone" id="manager_phone" placeholder="" value="<?= isset($supplier['manager_phone']) ? $supplier['manager_phone'] : '';?>" />
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="manager_email">Email менеджера</label>
						<div class="col-md-10">
			           		<input type="email" class="form-control" name="manager_email" id="manager_email" placeholder="Email" value="<?= isset($supplier['manager_email']) ? $supplier['manager_email'] : '';?>" />
						</div>
					</div>
					<hr/>
					<div class="form-group">
				        <label class="col-md-2" for="manager2_name">Имя менеджера №2</label>
						<div class="col-md-10">
			           		<input type="text" class="form-control" name="manager2_name" id="manager2_name" placeholder="Иван Иванович Иваненко" value="<?= isset($supplier['manager2_name']) ? $supplier['manager2_name'] : '';?>" />
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="manager2_phone">Телефон менеджера №2</label>
						<div class="col-md-10">
			           		<input type="text" class="form-control j-phone" name="manager2_phone" id="manager2_phone" placeholder="" value="<?= isset($supplier['manager2_phone']) ? $supplier['manager2_phone'] : '';?>" />
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="manager2_email">Email менеджера №2</label>
						<div class="col-md-10">
			           		<input type="email" class="form-control" name="manager2_email" id="manager2_email" placeholder="Email" value="<?= isset($supplier['manager2_email']) ? $supplier['manager2_email'] : '';?>" />
						</div>
					</div>
					<hr/>
					
					<div class="form-group">
				        <label class="col-md-2" for="viber">Viber</label>
						<div class="col-md-10">
			           		<input type="text" class="form-control j-phone" name="viber" id="viber" placeholder="Viber" value="<?= isset($supplier['viber']) ? $supplier['viber'] : '';?>" />
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="address">Адрес</label>
						<div class="col-md-10">
			           		<input type="text" class="form-control" name="address" id="address" placeholder="Адрес" value="<?= isset($supplier['address']) ? $supplier['address'] : '';?>" />
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="comment">Комментарий</label>
						<div class="col-md-10">
			            <textarea class="form-control" rows="3" name="comment" id="comment" placeholder="Этот комментарий виден только админу и менеджеру"><?= isset($supplier['comment']) ? $supplier['comment'] : '';?></textarea>
						</div>
					</div>
					<input type="hidden" name="id" value="<?= isset($supplier['id']) ? $supplier['id'] : '';?>" /> 
					<button type="submit" class="btn btn-primary"><?=lang('atom_save')?></button> 
					<a href="<?= MODULES_URL ?>suppliers" class="btn btn-default"><?=lang('atom_cancel')?></a>
				</form>
	    	</div>
	    </div>