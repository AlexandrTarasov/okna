	<? if(!in_array($this->uri->segment(2), array('login', '2fa'))):?>	

	</div><!-- / #content-wrapper -->
        
        
    <div class="clearfix"></div>
    
     
	<footer class="px-footer p-t-30 px-footer-bottom text-center">		
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<small class="text-muted hidden-xs"><a href="//perepelitsa.com.ua/cms-atom" target="_blank">Atom</a> starting platform created by <a href="//perepelitsa.com.ua" target="_blank">Perepelitsa Web Production</a> <strong class="pull-right"> v<?= $this->config->module_config['module_config']['version'] ?></strong></small>
					<small class="text-muted visible-xs"><a href="//perepelitsa.com.ua/cms-atom" target="_blank">Atom</a> by <a href="//perepelitsa.com.ua" target="_blank">Perepelitsa Web Production</a> &nbsp; <strong class="pull-right"> v<?= $this->config->module_config['module_config']['version'] ?></strong></small>
				</div>
				
			</div>
		</div>
	 </footer>   
	 
	 <? endif;?>
	 
	 
	 
	   
     
          
	<!-- Main modal -->
	<div class="modal fade" id="mainModal" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	    </div>
	  </div>
	</div>
	
	
	<!-- Default init Atom modules -->
    <script src="/modules/atom/assets/js/init.js" type="text/javascript"></script>
	
	<!-- include files from controller -->
	<? if(isset($js_libs) && !empty($js_libs)):?>
	<? foreach($js_libs as $lib): ?>
	<script src="<?=$lib?>" type="text/javascript"></script>
	<? endforeach;?>
	<? endif;?>

	<!--  How long page load -->
	<script>			
		<?= isset($js_code) ? $js_code : "";?>
		console.log('Total Execution Time: {elapsed_time}. Memory usage: <?= memory_get_usage(true)?> bytes');
	</script>
	
    </body>
</html>

 