<style>
	.w600{width:400px;}
	.status-select{border: 1px solid lightgray; padding: 2px;}
	.round{border-radius:2px;padding:2px;}
	.status-new 	  {}
	.status-processing{background: lightblue;}
	.status-measuring {background: hsl(50.3, 100%, 86.7%);}
	.status-during    {background: hsl(240, 95%, 92.2%);}
	.status-in_work   {background: hsl(0, 100%, 89%);}
	.status-complete  {background: hsl(112.4, 53.6%, 46.5%);}
	.status-fulfilled {background: hsl(120, 100%, 88.8%);}
	.status-archive   {background: hsl(0, 0%, 67.1%);}
	.fa-viber{font-size: 15px; color: hsl(286.9, 46%, 37.1%);}
	.fa-comment-dots{font-size: 16px; color: brown;}
	.td-with-comment{background: hsl(65.7, 100%, 95.9%);}
	a.links{ color: hsl(213.6, 76.9%, 42.4%); }
	.empty-mount-data{color: hsl(0, 0%, 87.5%); border: 1px solid hsl(0, 0%, 87.5%);}
</style>
<div class="card mb-4">
	<div class="card-header"><?=$title .': '. $total?>
		/ Сортировка по умолчанию:
		<select class="">
			<option value="">дата монтажа</option>
			<option value="">дата создания</option>
			<option value="">статус</option>
		</select>
	</div>
	<div class="card-body" style="padding:0px;">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr style="background: 1px hsl(110.4, 100%, 95.1%);">
						<th>Дог. № <i class="fas fa-sort"></i></th>
						<th>Адрес <i class="fas fa-sort"></i></th>
						<th>Клиент <i class="fas fa-sort"></i></th>
						<th>Дата монтажа  <i class="fas fa-sort"></i></th>
						<th>Монтажник <i class="fas fa-sort"></i></th>
						<th id="order_status"> <select id="cars" class="status-select round"  onchange="">
							<option value="">Сортануть</option>
							<option value="new">Новый</option>
							<option value="processing">В обработке</option>
							<option value="measuring">Замер</option>
							<option value="during">В процессе</option>
							<option value="in_work">В работе</option>
							<option value="complete">Готов</option>
							<option value="fulfilled">Выполнен</option>
							<option value="archive">Архив</option>
							</select>
						</th>
					</tr>
				</thead>
				<tbody>
<?php
$statuses = ['new'=>'Новый', 'processing'=>'В обработке', 'measuring'=>'Замер', 'during'=>'В процессе', 'in_work'=>'В работе', 'complete'=>'Готов', 'fulfilled'=>'Выполнен', 'archive'=>'Архив'];

foreach($orders as $order){
	$mont    = "<input class='empty-mount-data' type='date' value=''> ";
	$comment = "";
	$ct      = "";
	$status_selector_css = ' status-'.$order['status']; 
	$status = '<div class="round status-'.$order['status'].'" >'.$statuses[$order['status']].' </div>';

	if( $order['montage_date'] ){
		$mont = "<input class='' type='date' id=''  value='".$order['montage_date']."'>";
	}
	if( $order['comment'] ){
		$comment = "<i title='".$order['comment']."' class=\"far fa-comment-dots\"></i>";
		$ct = 'class="td-with-comment"';
	}
	echo"<tr>"; 
	echo"<td ".$ct."><a href='/order/".$order['id']."'>".$order['contract_number']."</a> ".$comment."</td>";
	echo"<td> <a href='/order/".$order['id']."'>".$order['address']."</a></td>";
	echo"<td><a href='/client/".$order['client_id']."' class='links'>".$order['client_name']."</a></td>";
	echo"<td>$mont</td>";
	echo"<td><a href='/installer/".$order['installer_id']."' class='links'>".$order['inst_name']."</a></td>";
	echo"<td>".$status."</td>";
	echo"</tr>"; 
}
?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	let current_order = {
		status_option_id : '',
	}

	order_status.onchange=(e)=>{
		console.log(e.target.value);
		window.location.href = "/orders/sort/"+e.target.value;
	}


</script>
