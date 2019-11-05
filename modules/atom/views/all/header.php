<!DOCTYPE html>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title><?=$title?> - Atom</title>
	<meta name="owner" content="info@perepelitsa.com.ua"/>
	<meta name="author" content="Anton Perepelitsa"/>
	<meta name="resourse-type" content ="Document"/>
	<meta http-equiv="charset" content="UTF-8"/>
	<meta name="robots" content="nofollow"/>
	
	<link rel="shortcut icon" href="/modules/atom/assets/img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/modules/atom/assets/img/favicon.ico" type="image/x-icon">

    <link href="/modules/atom/assets/css/fonts.css" rel="stylesheet">
    <style>
	    <? include(getcwd().'/modules/atom/assets/css/atom.min.css')?>
	    <? include(getcwd().'/modules/atom/assets/css/themes/'. (isset($this->auth->user['theme']) ? $this->auth->user['theme'] : 'default') .'.min.css')?>
	</style>
    

	<? if(isset($css_libs) && !empty($css_libs)):?>
	<? foreach($css_libs as $lib): ?>
    <link href="<?=$lib?>" rel="stylesheet">
	<? endforeach;?>
	<? endif;?>

    <script src="/modules/atom/assets/js/atom.min.js"></script>
    

    <!--[if lt IE 9]>
        <script src="/modules/atom/assets/js/html5.min.js"></script>
    <![endif]-->
</head>

<body class="">
				
		
		<? if(!in_array($this->uri->segment(2), array('login', '2fa'))):?>	
				
		  <nav class="px-nav px-nav-left px-nav-animate px-nav-collapse">
		    <button type="button" class="px-nav-toggle" data-toggle="px-nav">
		      <span class="px-nav-toggle-arrow"></span>
		      <span class="navbar-toggle-icon"></span>
		      <span class="px-nav-toggle-label font-size-11">HIDE MENU</span>
		    </button>
		
		    <ul class="px-nav-content">
			    
		      <li class="px-nav-box p-a-3 b-b-1" id="demo-px-nav-box">
		        <button type="button" class="close" aria-label="Close" data-toggle="px-nav"><span aria-hidden="true">&times;</span></button>
		        <div class="font-size-16"><span class="font-weight-light"><?= lang('atom_hello');?>, </span><strong><?= $this->auth->user['username']; ?></strong></div>
		        <div class="btn-group" style="margin-top: 4px;">
		          <a href="/atom/settings" class="btn btn-xs btn-primary btn-outline"><i class="fa fa-cog"></i></a>
		          <a href="/atom/logout" class="btn btn-xs btn-danger btn-outline"><i class="fa fa-power-off"></i></a>
		        </div>
		      </li>
		
		
	            <? if(isset($menu['main'])):?>
	            
	               <? foreach ($menu['main'] as $ck => $item): ?>
	               		<? if ($item['type'] == 'item'): ?>
							<li class="px-nav-item <?= $item['active'] ? 'active' : '' ?> <?= isset($item['class']) ? $item['class'] : ''?>">
								<a href="<?=$item['link']?>"><i class="px-nav-icon <?=$item['icon']?>"></i><span class="px-nav-label"><?=$item['title']?></span></a>
							</li>
						<? else: ?>
	
						<li class="px-nav-item px-nav-dropdown <?= $item['active'] ? 'active' : '' ?> <?= isset($item['class']) ? $item['class'] : ''?>">
							<a href="#">
								<i class="px-nav-icon <?=$item['icon']?>"></i><span class="px-nav-label"><?=$item['title']?></span>
							</a>
							<ul class="px-nav-dropdown-menu">
								<? foreach ($item['items'] as $rk => $subitem): ?>
									<li class="px-nav-item" id="menu<?=$ck.$rk?>"><a tabindex="-1" href="<?=$subitem['link']?>"><span class="px-nav-label"><?=$subitem['title']?></span></a></li>
								<? endforeach; ?>
							</ul>
						</li>
					<? endif; ?>
				<? endforeach; ?>
			<? endif;?>		

		    </ul>
		  </nav>
		
		
        <div id="main-navbar" class="navbar navbar-fixed-top px-navbar" role="navigation">

				<div class="navbar-header">
					<a href="/atom/" class="navbar-brand">
						<img src="/modules/atom/assets/img/logo_small.png" height="30" class="navbar-atom-logo" title="ATOM" />
						<strong><?= $this->config->atom_config['atom_name'] != '' ?  $this->config->atom_config['atom_name'] : 'Atom'?></strong>
					</a>
	    		</div>
	
	   			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu" aria-expanded="false"><i class="navbar-toggle-icon"></i></button>

                <div id="main-menu" class="collapse navbar-collapse main-navbar-collapse">
                    <div>
                      <!-- Header zone -->
                      <? if(isset($menu['header']) && !empty($menu['header'])):?>
                        <ul class="nav navbar-nav">
		                    
	                           <? foreach ($menu['header'] as $ck => $item): ?>
	                           	<? if ($item['type'] == 'item'): ?>
										<li class="<?= $item['active'] ? 'active' : '' ?> <?= isset($item['class']) ? $item['class'] : ''?>">
											<a href="<?=$item['link']?>"><i class="<?=$item['icon']?>"></i>&nbsp;<span class="<?= ($item['icon'] != '') ? "hidden-sm" : "" ?>"><?=$item['title']?></span></a>
										</li>
									<? else: ?>
	
									<li class="dropdown <?= $item['active'] ? 'active' : '' ?> <?= isset($item['class']) ? $item['class'] : ''?>">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="<?=$item['icon']?>"></i>&nbsp; <span class="<?= ($item['icon'] != '') ? "hidden-sm" : "" ?>"><?=$item['title']?></span> <b class="caret hidden-xs"></b></a>
										<ul class="dropdown-menu">
											<? foreach ($item['items'] as $rk => $subitem): ?>
												<li id="menu<?=$ck.$rk?>"><a tabindex="-1" href="<?=$subitem['link']?>"> <?=$subitem['title']?></a></li>
											<? endforeach; ?>
										</ul>
									</li>
								<? endif; ?>
							<? endforeach; ?>
                        </ul>
						<? endif;?>

                        <ul class="nav navbar-nav pull-right right-navbar-nav">
							
                            <? if(isset($menu['right']) && !empty($menu['right'])):?>
							<? foreach ($menu['right'] as $item): ?>
	                        <li class="<?= $item['active'] ? 'active' : '' ?> <?= isset($item['class']) ? $item['class'] : ''?>"><a href="<?=$item['link']?>"><i class="<?=$item['icon'] != '' ? $item['icon'] : ''?>"></i> <?=$item['title']?></a></li>
							<? endforeach;?>
							<? endif;?>
					
						
							<? if($this->config->atom_config['atom_clock'] == TRUE): ?>
								<li><a href="#"><span class="hidden-sm"><i class="fa fa-clock-o"></i></span> <span class="j-atom-clock"><?= date('G:i:s') ?></span></a></li>
							<? endif;?>
							
							
														
							<? if($this->auth->check_permission('Atom.Menu.Developer')):?>
							<!-- Developer Menu -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown"><i class="fa fa-code"></i> <span class="hidden-xs">Develop</span></a>

                                <ul class="dropdown-menu pull-right">
		                            
		                            <? 	if($this->cache->get('maintenance') == FALSE):?>
		                            	<li><a href="/atom/maintenance/true"><span class="label label-default">OFF</span>  Maintenance</a></li>
		                            <? else:?>
		                            	<li><a href="/atom/maintenance"><span class="label label-success">ON</span> Maintenance</a></li>
		                            
									<? endif;?>
										                            
		                            <? if(isset($menu['developer']) && !empty($menu['developer'])):?>
										<? foreach ($menu['developer'] as $item): ?>
			                        		<li class="<?= $item['active'] ? 'active' : '' ?> <?= isset($item['class']) ? $item['class'] : ''?>">
			                        			<a href="<?=$item['link']?>">
				                        			<i class="<?=$item['icon'] != '' ? 'dropdown-icon ' . $item['icon'] : ''?>"></i>&nbsp; <?=$item['title']?>
				                        		</a>
				                        	</li>
										<? endforeach;?>
									<? endif;?>		                            
		                        
                                </ul>
                            </li>
							<!-- \\ Developer Menu -->
							<? endif;?>
							
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown"><?= substr_replace(strtoupper($this->auth->user['language']), '', 2)?></a>
                            
                                <ul class="dropdown-menu pull-right">
		                            <li class="<?= ($this->auth->user['language'] == 'english' ? 'active' : '')?>"><a href="/atom/language/english">English</a></li>
		                            <li class="<?= ($this->auth->user['language'] == 'russian' ? 'active' : '')?>"><a href="/atom/language/russian">Русский</a></li>
                                </ul>
                            </li>
							
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown"><span class="hidden-sm"><?= lang('atom_hello');?>, </span><strong><?= $this->auth->user['username']; ?></strong></a>

                                <ul class="dropdown-menu pull-right">
	                                
	                                
									<? if($this->config->atom_config['atom_link_to_site'] == TRUE): ?>
		                           		<li><a href="/"><i class="dropdown-icon fa fa-home"></i> <?= lang('atom_to_site');?></a></li>
		                            <? endif;?>
		                            
		                            <? if(isset($menu['settings']) && !empty($menu['settings'])):?>
									<? foreach ($menu['settings'] as $item): ?>
			                        <li class="<?= $item['active'] ? 'active' : '' ?> <?= isset($item['class']) ? $item['class'] : ''?>"><a href="<?=$item['link']?>"><i class="<?=$item['icon'] != '' ? 'dropdown-icon ' . $item['icon'] : ''?>"></i> <?=$item['title']?></a></li>
									<? endforeach;?>
									
									<? endif;?>		                            
		                            <li><a href="/atom/settings"><i class="dropdown-icon fa fa-cog"></i> <?= lang('atom_settings');?></a></li>
		                            <li class="divider"></li>
		                            <li><a href="/atom/logout"><i class="dropdown-icon fa fa-power-off"></i> <?= lang('atom_logout');?></a></li>
                                </ul>
                            </li>
                        </ul><!-- / .navbar-nav -->

                    </div>
                </div><!-- / #main-navbar-collapse -->
            </div><!-- / .navbar-inner -->
        </div><!-- / #main-navbar -->

        <div id="main-menu-bg"></div>
        
		<div class="px-content">
		<? else:?>
		
		    <div id="main-navbar" class="navbar px-navbar bg-white" role="navigation">
				<div class="navbar-header">
					<a href="/atom/" class="navbar-brand">
						<div class="navbar-logo"></div>
					</a>
				</div>
			</div>
		

		<? endif;?>	
			
	
			<? if(function_exists('validation_errors') && validation_errors() != ''): ?>
				<div class="alert alert-danger text-center">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong><?=lang('atom_error')?>:</strong> <?=validation_errors('<span></span>')?>
				</div>
			<? endif;?>
			
			
			<? if($this->session->flashdata("alert_error")): ?>
				<div class="alert alert-danger  text-center">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong><?=lang('atom_error')?>:</strong> <?= $this->session->flashdata("alert_error"); ?>
				</div>
			
				
				
			<? elseif($this->session->flashdata("alert_success")): ?>
				<div class="alert alert-success text-center">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong><?=lang('atom_success')?>:</strong> <?= $this->session->flashdata("alert_success"); ?>
				</div>
			<? endif; ?>
			
					
			<? 	if($this->auth->check_permission('Atom.Maintanance') && ($this->cache->get('maintenance') != FALSE)):?>
				<div class="alert alert-waning text-center">
				  <strong><?=lang('atom_attention')?>!</strong> System maintenance mode on. Users can't sign in to system. Please, <a href="/atom/maintenance">deactivate it</a> after maintenance.
				</div>
			<? endif;?>
			
