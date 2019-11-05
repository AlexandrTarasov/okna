	   
	<div class="page-header">
		<h1 class="col-xs-12 col-sm-12 text-center text-left-sm"><?= lang('atom_settings_title');?></h1>
	</div>
	    		
     <ul class="nav nav-tabs page-block m-t-4 tab-resize-nav" id="account-tabs">
        <li class="dropdown tab-resize">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"></a>

            <ul class="dropdown-menu"></ul>
        </li>

        <li class="active"><a href="#account-profile" data-toggle="tab"><?=lang('atom_settings_profile')?></a></li>
        <li><a href="#account-password" data-toggle="tab"><?=lang('atom_settings_password')?></a></li>
        <li><a href="#2fa" data-toggle="tab">2fa</a></li>
        
        <? if($this->auth->check_permission('Atom.Settings.Atom')):?>
        <li><a href="#atom" data-toggle="tab">Atom</a></li>
        <? endif;?>        
	</ul>

    <div class="tab-content p-y-4">
        <!-- Profile tab -->

        <div class="tab-pane fade in active" id="account-profile">
            <div class="row">
	            
	            <div class="col-xs-12">
					<form class="j-form-additional form-horizontal"  method="post" action="/atom/settings/information">
						
						<div class="p-x-1">
	                        <div class="form-group <?= form_error('email') ? ' has-error' : ''; ?>">
	                            <label class="col-sm-2" for="email">Email</label>
	                            <div class="col-sm-10">
	                             	<input class="form-control" id="email" name="email" type="text" value="<?= set_value('email', $user['email'])?>" required />
	                            </div>
	                        </div>
	                        
	                        <div class="form-group <?= form_error('dashboard') ? ' has-error' : ''; ?>">
	                            <label class="col-sm-2" for="dashboard"><?=lang('atom_settings_profile_dashboard')?></label> 
	                            <div class="col-sm-10">
	                            	<input class="form-control" id="dashboard" name="dashboard" type="text" value="<?= set_value('dashboard', $user['dashboard'])?>" />
	                            </div>
	                        </div>
	                        
	                        		                        
	                        <div class="form-group <?= form_error('theme') ? ' has-error' : ''; ?>">
	                            <label class="col-sm-2" for="theme"><?=lang('atom_settings_profile_theme')?></label>
	                            <div class="col-sm-10">
		                            <select name="theme" class="form-control">
			                            <? foreach($themes as $theme):?>
			                           		<option value="<?=$theme?>" <?= set_select('theme', $theme, (isset($user['theme']) && $user['theme'] == $theme)) ?>><?= ucfirst($theme)?></option>
			                            <? endforeach;?>
		                            </select>
	                            </div>
	                        </div>		                        
	
							<button type="submit" class="btn btn-primary m-t-3"><?= lang('atom_save');?></button>
						</div>							
	                </form><!-- Spacer -->
	            </div>
            </div>
        </div><!-- / Profile tab -->

        <!-- Password tab -->
        <div class="tab-pane fade" id="account-password">
            <form class="form-horizontal" method="post" action="/atom/settings/password">
	            <div class="p-x-1">
	                <div class="form-group">
	                    <label for="oldpassword" class="col-sm-2"><?= lang('atom_settings_password_current');?></label>
	                    <div class="col-sm-10">
		                    <input class="form-control" name="oldpassword" type="password" value="" />
	                    </div>
	                </div>
	                
	                
	                <div class="form-group">
	                    <label for="password" class="col-sm-2"><?= lang('atom_settings_password_new');?></label>
	                    <div class="col-sm-10">
	                    	<input class="form-control" name="password" type="password" value="" />
	                    </div>
	                </div>
	                						
	                <div class="form-group">
	                    <label for="confirmpassword" class="col-sm-2"><?= lang('atom_settings_password_repeat');?></label>
	                    <div class="col-sm-10">
	                    	<input class="form-control" name="confirmpassword" type="password" value="" />
	                    </div>
	                </div>
	                <button type="submit" class="btn btn-primary m-t-3"><?= lang('atom_save');?></button>
	            </div>					                
            </form>
        </div><!-- / Password tab -->
        
        <!-- 2fa tab -->
	    <div role="tabpanel" class="tab-pane" id="2fa">

			<div class="p-a-2">
			    <h4 class="m-t-0">Двухфакторная аутентификация</h4>
			    			    
			    <? if($this->auth->get_session('2fa_secret') == ''):?>
			    <div>
				    
				    <p>Статус двухфакторной аутентификации: <span class="label label-danger">Выключена</span></p>
			    
				    <p>Установить двухфакторную аутентификацию очень просто, следуйте инструкции ниже.</p>
	
					<br/>
					
					<p><strong>1. Установите приложение для двухфакторной аутентификации</strong></p>
	
					<ul>
						<li><a href="http://itunes.apple.com/us/app/google-authenticator/id388497605?mt=8" target="_blank" rel="nofollow noopener">Google Authenticator для iOS</a></li>
						<li><a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2" target="_blank" rel="nofollow noopener">Google Authenticator для Android</a></li>
						<li><a href="https://itunes.apple.com/ru/app/andeks.kluc-dla-zasity-akkaunta/id957324816?l=ru" target="_blank" rel="nofollow noopener">Яндекс.Ключ для iOS</a></li>
						<li><a href="https://play.google.com/store/apps/details?id=ru.yandex.key&amp;hl=ru" target="_blank" rel="nofollow noopener">Яндекс.Ключ для Android</a></li>
						<li><a href="https://www.microsoft.com/uk-ua/store/p/microsoft-authenticator/9nblgggzmcj6" target="_blank" rel="nofollow noopener">Authenticator для Windows</a></li>
						<li><a href="https://www.authy.com/" target="_blank" rel="nofollow noopener">Authy для iOS, Android, Chrome и OS X</a></li>
						<li><a href="https://freeotp.github.io/" target="_blank" rel="nofollow noopener">FreeOTP для iOS, Android и Pebble</a></li>
					</ul>
					
					<br/> 
					
					<p><strong>2. Сфотографируйте картинку в установленном приложении</strong></p>
					
					<p><img src="<?=$two_step['qrCodeUrl']?>" /></p>
					
					<br/> 
					<p><strong>3. Введите 6 значный код подтверждения с вашего устройства</strong></p>
					<form method="post" action="/atom/settings/2fa_on">
						
						<input type="hidden" name="secret" value="<?=$two_step['secret']?>" />
						
						<div class="form-group">
							<input type="text" class="form-control" name="code" placeholder="" pattern="\d*" style="width: 200px" />
						</div>	
						<div class="form-group">
							<input type="submit" class="btn btn-primary" value="Подключить" />
						</div>									
					</form>
			    </div>
				<? else:?>
				
				<p>Статус двухфакторной аутентификации: <span class="label label-success">Включена</span></p>
				<br/>
				<br/>
				
				<form method="post" action="/atom/settings/2fa_off">
														
					<div class="form-group">
						<label>Введите код с приложения Authenticator</label>
						<input type="text" class="form-control" name="code" placeholder="" pattern="\d*" style="width: 200px" />
					</div>	
					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Выключить" />
					</div>									
				</form>
				
				
				<? endif;?>
			</div>
    	</div>
        
        
        <? if($this->auth->check_permission('Atom.Settings.Atom')):?>
        
        <div class="tab-pane fade" id="atom">
            <form class="form-horizontal" method="post" action="/atom/settings/atom">
	            <div class="p-x-1">
		            
		            <? if(isset($atom_settings)):?>
		            	<? foreach($atom_settings as $name => $v):?>
		                <div class="form-group">
		                    <label for="<?=$name?>" class="col-sm-2"><?=$name?></label>
		                    <div class="col-sm-10">
			                    <input class="form-control" name="<?=$name?>" type="text" value="<?=$v?>" />
		                    </div>
		                </div>
						<? endforeach;?>
				
	                <button type="submit" class="btn btn-primary m-t-3"><?= lang('atom_save');?></button>
					<? endif;?>
		        </div>					                
            </form>
        </div><!-- / Password tab -->
        
		<? endif;?>
    </div>
    
    
