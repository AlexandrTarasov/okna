	<div class="page-header">
		<h1 class="col-xs-12 col-sm-12 text-center text-left-sm"><a href="<?=MODULES_URL?>atom_builder">Builder</a> &nbsp; / &nbsp;  Update module</h1>
	</div>
    
    <div class="panel">
        <div class="panel-body">
			<? if($content != ''):?>
				<?=$content ?>
			<? else: ?>
				<p><b>You have the latest version <?=$config['version']?> of <?=$config['name']?>.</b></p>
			<? endif;?>				
		</div>
		
		<? if($content != ''):?>
		<div class="panel-footer text-center">
			<? if(!$updated):?>
				<a href="/<?=uri_string()?>/true" class="btn btn-primary" onclick="return confirm('Are you sure? This will take some time... Please make sure that this action does not interfere with other users.');">Update module</a>
			<?endif;?>
			<a href="<?=MODULES_URL?>atom_builder" class="btn btn-default">Return to Builder</a>
		</div>
		<?endif;?>
	</div>
	
