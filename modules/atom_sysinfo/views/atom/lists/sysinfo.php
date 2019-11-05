
		<div class="page-header"> 
             <h1 class="col-xs-12 col-sm-12 text-center text-left-sm">Sysinfo</h1> 
        </div>	
                



		<div class="row">
			<div class="col-md-12">
				<ul class="nav nav-tabs">
				  <li class="active"><a data-toggle="tab" href="#main">Main</a></li>
				  <li><a data-toggle="tab" href="#php">PHP</a></li>
				</ul>
				
				<div class="tab-content">
				  <div id="main" class="tab-pane fade in active">
				    <h3>Main info</h3>
					<table class="table">
			            <? foreach ($main as $key => $val) : ?>
			            <tr>
			                <th><?= $key; ?></th>
			                <td><?= $val; ?></td>
			            </tr>
			            <? endforeach; ?>
					</table>
				  </div>
				  <div id="php" class="tab-pane fade">
				    <h3>PHP info</h3>
				    
				    <div class="row">
					    <div class="col-md-2">
				    
							<ul class="nav nav-pills nav-stacked">
							  <? foreach($php as $title => $section): ?>
							  <li><a href="#php_info_<?=strtolower(underscore($title))?>"><?= $title?></a></li>
							  <? endforeach;?>
		
							</ul>			
					    </div>
						<div class="col-md-10">
							<? foreach($php as $title => $section): ?>
						    <div id="php_info_<?=strtolower(underscore($title))?>">
							    <h4><?=$title?></h4>					    
							    <table class="table">
								    <? foreach($section as $key => $value):?>
									   <tr>
										   <td width="200"><?=$key?></td>
										   
										   <td>
										   <? if(is_array($value)):?>
										   		<? foreach($value as $k => $v):?>
										   			
												   <p> <?= $k == 1 ? '<span class="label label-primary">'.$v.'</span>' : '<span class="label label-default">'.$v.'</span>'?></p>							   			
										   			
										   		<? endforeach;?>
										   <? else:?>
										  	<?=$value?>
										   <? endif;?>
										  </td>
									   </tr>
									   
								    <? endforeach;?>
							    </table>
						    </div>
						    
						    <? endforeach;?>
						</div>
				    
				    
				    </div>	    
				    
				  </div>
				</div>
			</div>
		</div>