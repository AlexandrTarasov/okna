<style>
	.w400{width:400px;}
	.w200{width:200px;}
	.w150{width:150px;}
	.fa-viber{font-size: 15px; color: hsl(286.9, 46%, 37.1%);}
	.fa-comment-dots{font-size: 16px; color: brown;}
	.td-with-comment{background: hsl(65.7, 100%, 95.9%);}
</style>
<div class="card mb-4">
	<div class="card-header"><?=$title . ' / всего: ' .$total?></div>
	<div class="card-body" style="padding:0px;">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr style="background: 1px hsl(110.4, 100%, 95.1%);">
						<th>ФИО<i class="fas fa-sort"></i></th>
						<th class="w150">Phone <i class="fas fa-sort"></i></th>
						<th>Адрес <i class="fas fa-sort"></i></th>
						<th>Email <i class="fas fa-sort"></i></th>
					</tr>
				</thead>
				<tbody>
<?php
foreach($clients as $client){
	$viber_ico = '';
	$comment   = '';
	$ct    	   = '';

	$phone 	   = '';
	$client['phone'] = str_replace('38', '', $client['phone']);
	$phone .= '('.substr($client['phone'], 0, 3).')-';
	$phone .= substr($client['phone'], 3, 3).'-';
	$phone .= substr($client['phone'], -4, 2).'-'; 
	$phone .= substr($client['phone'], -2, 2); 


	if( $client['viber'] ){
		$viber_ico="<i class=\"fab fa-viber\"></i>";
	}
	if( $client['comment'] ){
		$comment = "<i title='".$client['comment']."' class=\"far fa-comment-dots\"></i>";
		$ct = 'class="td-with-comment"';
	}
	echo"<tr>"; 
	echo"<td ".$ct."> <a href='/client/".$client['id']."' class=''>".$client['name']." ".$comment."</a> </td>";
	echo'<td class="w150"><a href="tel:'.$phone.'">'.$phone.'</a> '.$viber_ico.'</td>';
	echo"<td>".$client['address']."</td>";
	echo"<td>".$client['email']."</td>";
	echo"</tr>"; 
}
?>
				</tbody>
			</table>
		</div>
	</div>
</div>
