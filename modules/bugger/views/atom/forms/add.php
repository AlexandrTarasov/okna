
		<div class="page-header"> 
            <h1 class="col-xs-12 col-sm-12 text-center text-left-sm"><?=lang('bugger_form_title')?></h1> 
        </div>	
        
        <div class="col-md-4 col-md-offset-4">
	        <div class="panel">
		        <div class="panel-body" style="padding: 30px 20px;">
		        	<form action="/<?= uri_string()?>" method="post" class="form-vertical">
						
						<div class="form-group">
				            <label><?=lang('bugger_form_label_title')?></label>
				            <div>
				           		<input type="text" class="form-control" name="title" id="title" placeholder="<?=lang('bugger_form_placeholder_title')?>" value="" />
						   	</div>
				        </div>
				        
						<div class="form-group">
				            <label><?=lang('bugger_form_label_description')?></label>
				            <div>
				           		<textarea class="form-control" name="description" id="description" placeholder="<?=lang('bugger_form_placeholder_description')?>"></textarea>
						   	</div>
				        </div>
						
						
						<button type="submit" class="btn btn-primary"><?=lang('bugger_form_label_send')?></button> 
					</form>
		    	</div>
		    </div>
        </div>