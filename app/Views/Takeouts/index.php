<div class="card mb-4">
	<div class="card-header"><i class="fas fa-truck-moving"></i> <?=$title?> </span> </div>
	<div class="card-body" style="padding:0px;">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr style="background: 1px hsl(110.4, 100%, 95.1%);">
						<th>Номер договора</th>
						<th>Адрес</th>
						<th>Дата монтажа</th>
						<th>Установщик</th>
						<th>Отправлена</th>
					</tr>
				</thead>
				<tbody>
<?php


foreach($takeouts as $takeout){
	echo"<tr>"; 
	echo"<td>".$takeout['contract_number']."</td>";
	echo"<td>".$takeout['address']."</td>";
	echo"<td>".$takeout['montage_date']."</td>";
	echo"<td>".$takeout['supplier_id']."</td>";
	// echo'<td><input class="" type="checkbox" id="" value="'.$takeout[''].'"></td>';
	if( $takeout['removal_request_sent'] == '1' ){
		echo'<td><button type="button" class="btn btn-success disabled">Отправлен</button></td>';
	}else {
		echo'<td><button type="button" class="btn btn-info">Отметить как отправлен</button></td>';
	}
	echo"</tr>"; 
}
?>
				</tbody>
			</table>
		</div>
	</div>
</div>
