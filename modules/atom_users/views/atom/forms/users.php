
		<div class="page-header"> 
            <h1 class="col-xs-12 col-sm-12 text-center text-left-sm"><a href="<?= MODULES_URL ?>atom_users"><?=lang('au_title')?></a> &nbsp; / &nbsp; <?= isset($atom_user) ? lang('atom_form_edit_item') : lang('atom_form_add_item')?></h1> 
        </div>	
        
        <div class="panel">
	        <div class="panel-body">
	        	<form action="/<?= uri_string()?>" method="post" class="form-horizontal">
		
					<div class="form-group">
				        <label class="col-md-2" for="username">Username</label>
						<div class="col-md-10">
			           		<input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?= isset($atom_user['username']) ? $atom_user['username'] : '';?>" autocomplete="off"/>
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="password"><?=lang('atom_settings_password')?></label>
						<div class="col-md-10">
			           		<input type="password" class="form-control" autocomplete="new-password" name="password" id="password" placeholder="Password" autocomplete="off" />
			           		<p class="help-block">Enter only if you need to change the password</p>
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="email">Email</label>
						<div class="col-md-10">
			           		<input type="email" class="form-control" name="email"  autocomplete="new-email" autocomplete="off" id="email" placeholder="Email" value="<?= isset($atom_user['email']) ? $atom_user['email'] : '';?>" />
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="language"><?=lang('atom_language')?></label>
						<div class="col-md-10">								
			            	<label class="inline radio">
				           		 <input type="radio" name="language" value="russian" <?= (isset($atom_user['language']) && ($atom_user['language'] == 'russian')) ? 'checked' : ''?>> Русский
				           	</label>								
			            	<label class="inline radio">
				           		 <input type="radio" name="language" value="english" <?= (isset($atom_user['language']) && ($atom_user['language'] == 'english')) ? 'checked' : ''?>> English
				           	</label>								
<!--
			            	<label class="inline radio">
				           		 <input type="radio" name="language" value="ukraine" <?= (isset($atom_user['language']) && ($atom_user['language'] == 'ukraine')) ? 'checked' : ''?>> ukraine
				           	</label>
-->
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="theme"><?=lang('atom_settings_profile_theme')?></label>
						<div class="col-md-10">
				            <select class="form-control" name="theme" id="theme">
								<option value="default" <?= (isset($atom_user['theme']) && ($atom_user['theme'] == 'default')) ? 'selected' : ''?>>default</option>
								<option value="asphalt" <?= (isset($atom_user['theme']) && ($atom_user['theme'] == 'asphalt')) ? 'selected' : ''?>>asphalt</option>
								<option value="candy-black" <?= (isset($atom_user['theme']) && ($atom_user['theme'] == 'candy-black')) ? 'selected' : ''?>>candy-black</option>
								<option value="candy-blue" <?= (isset($atom_user['theme']) && ($atom_user['theme'] == 'candy-blue')) ? 'selected' : ''?>>candy-blue</option>
								<option value="candy-cyan" <?= (isset($atom_user['theme']) && ($atom_user['theme'] == 'candy-cyan')) ? 'selected' : ''?>>candy-cyan</option>
								<option value="candy-green" <?= (isset($atom_user['theme']) && ($atom_user['theme'] == 'candy-green')) ? 'selected' : ''?>>candy-green</option>
								<option value="candy-orange" <?= (isset($atom_user['theme']) && ($atom_user['theme'] == 'candy-orange')) ? 'selected' : ''?>>candy-orange</option>
								<option value="candy-purple" <?= (isset($atom_user['theme']) && ($atom_user['theme'] == 'candy-purple')) ? 'selected' : ''?>>candy-purple</option>
								<option value="candy-red" <?= (isset($atom_user['theme']) && ($atom_user['theme'] == 'candy-red')) ? 'selected' : ''?>>candy-red</option>
								<option value="darklight-blue" <?= (isset($atom_user['theme']) && ($atom_user['theme'] == 'darklight-blue')) ? 'selected' : ''?>>darklight-blue</option>
								<option value="darklight-cyan" <?= (isset($atom_user['theme']) && ($atom_user['theme'] == 'darklight-cyan')) ? 'selected' : ''?>>darklight-cyan</option>
								<option value="darklight-green" <?= (isset($atom_user['theme']) && ($atom_user['theme'] == 'darklight-green')) ? 'selected' : ''?>>darklight-green</option>
								<option value="darklight-orange" <?= (isset($atom_user['theme']) && ($atom_user['theme'] == 'darklight-orange')) ? 'selected' : ''?>>darklight-orange</option>
								<option value="darklight-purple" <?= (isset($atom_user['theme']) && ($atom_user['theme'] == 'darklight-purple')) ? 'selected' : ''?>>darklight-purple</option>
								<option value="darklight-red" <?= (isset($atom_user['theme']) && ($atom_user['theme'] == 'darklight-red')) ? 'selected' : ''?>>darklight-red</option>
								<option value="dust" <?= (isset($atom_user['theme']) && ($atom_user['theme'] == 'dust')) ? 'selected' : ''?>>dust</option>
								<option value="fresh" <?= (isset($atom_user['theme']) && ($atom_user['theme'] == 'fresh')) ? 'selected' : ''?>>fresh</option>
								<option value="frost" <?= (isset($atom_user['theme']) && ($atom_user['theme'] == 'frost')) ? 'selected' : ''?>>frost</option>
								<option value="purple-hills" <?= (isset($atom_user['theme']) && ($atom_user['theme'] == 'purple-hills')) ? 'selected' : ''?>>purple-hills</option>
								<option value="silver" <?= (isset($atom_user['theme']) && ($atom_user['theme'] == 'silver')) ? 'selected' : ''?>>silver</option>
								<option value="white" <?= (isset($atom_user['theme']) && ($atom_user['theme'] == 'white')) ? 'selected' : ''?>>white</option>
								<option value="clean" <?= (isset($atom_user['theme']) && ($atom_user['theme'] == 'clean')) ? 'selected' : ''?>>clean</option>
								<option value="adminflare" <?= (isset($atom_user['theme']) && ($atom_user['theme'] == 'adminflare')) ? 'selected' : ''?>>adminflare</option>
							</select>
						</div>
					</div>
					<div class="form-group">
				        <label class="col-md-2" for="dashboard"><?=lang('atom_settings_profile_dashboard')?></label>
						<div class="col-md-10">
			           		<input type="text" class="form-control" name="dashboard" id="dashboard" placeholder="Dashboard" value="<?= isset($atom_user['dashboard']) ? $atom_user['dashboard'] : '';?>" />
						</div>
					</div>
										
					<div class="form-group">
				        <label class="col-md-2" for="type"><?=lang('atom_form_type')?></label>
						<div class="col-md-10">					
							
							<? foreach($roles as $role):?>			
			            	<label class="inline radio">
			            	
				           		 <input type="radio" name="role_id" value="<?=$role['id']?>" <?= (isset($atom_user['role_id']) && ($atom_user['role_id'] == $role['id'])) ? 'checked' : ''?> <?= $role['name'] == 'Developer' && !$this->auth->check_permission('UsersCreateDeveloper') ? 'disabled' : ''?>> <?=$role['name']?>
				           	</label>	
				           	<? endforeach;?>				           								
						</div>
					</div>
					<input type="hidden" name="id" value="<?= isset($atom_user['id']) ? $atom_user['id'] : '';?>" /> 
					<button type="submit" class="btn btn-primary"><?=lang('atom_save')?></button> 
					<a href="<?= MODULES_URL ?>users" class="btn btn-default"><?=lang('atom_cancel')?></a>
				</form>
	    	</div>
	    </div>