<style>
	.w400{width:400px;}
	.w200{width:200px;}
	.w150{width:150px;}
	.sent{background: yellow;}
	.received{background: lightgreen;}
	.canceled{background: lightgray;}
	.w50{width:50px;}
	.fa-comment-dots{font-size: 16px; color: brown;}
	.td-with-comment{background: hsl(65.7, 100%, 95.9%);}
	.status-selector{width: 65%; padding: 1px; height: unset;}
	.fa-dollar-sign{color: hsl(205.7, 42%, 60.8%); !importent}
</style>
<div class="card mb-4">
	<div class="card-header"><i class="fas fa-dollar-sign"></i> <?=$title . ' / всего: ' .$total?> / <a href="/payment_edit/0" class=""> последние 40</a></div>
	<div class="card-body" style="padding:0px;">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr style="background: 1px hsl(110.4, 100%, 95.1%);">
						<th class="w50">id</th>
						<th class="w150">Номер договора</th>
						<th>id юзера</th>
						<th>Метод</th>
						<th class='w50'>Сумма</th>
						<th class='w150'>Дата создания</th>
						<th class='w150'>Дата принятия</th>
						<th>Статус</th>
						<th>Коммент</th>
					</tr>
				</thead>
				<tbody>
<?php

foreach($payments as $payment){

	$statuses = '<select onchange="changeStatus('.$payment['id'].', this);"  class="custom-select status-selector '.$payment['status'].'">';
	$date = explode(' ', $payment['date_create']);
	foreach($pay_m_statuses as $status){
		$selected = '';
		if($status === 'sent')    { $status_name = 'Отправлен'; }
		if($status === 'received'){ $status_name = 'Получен'; }	
		if($status === 'canceled'){ $status_name = 'Отменён'; }	
		if( $payment['status'] == $status ){
			$selected = 'selected';
		}
		$statuses .= '<option class="'.$status.'" '.$selected.' value="'.$status.'">'.$status_name.'</option>';
	}
	$statuses .= '</select>';

	$comment   = '';
	echo"<tr>"; 
	echo"<td  class='w50'>".$payment['id']."</td>";
	echo"<td><a href='/order/".$payment['order_id']."'>".$payment['contract_num']."</a></td>";
	echo"<td>".$payment['user_id']."</td>";
	echo"<td>".$payment['method']."</td>";
	echo"<td class='w50'>".$payment['amount']."</td>";
	echo"<td class='w150'><input type='date' class=\"l\"  value=\"".$date[0]."\"></td>";
	echo"<td class='w150'>".$payment['date_receiving']."</td>";
	echo"<td>".$statuses."</td>";
	echo"<td>".$payment['comment']."</td>";
	echo"</tr>"; 
}
?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script src="/assets/js/admin_sluice.js"></script>
<script>
function changeStatus (payment_id, current_select_status){
	let res = goSluice(payment_id, current_select_status.value , 'payment_status_update');
	res.then(data => {
		data.text().then(function(text) {
			if( text == '1' ){
				location.reload();
			}
			console.log(text)
		})
	})
}	 
</script>


