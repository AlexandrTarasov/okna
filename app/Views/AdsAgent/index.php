<div class="card mb-4">
	<div class="card-header"><?=$title ?></div>
	<div class="card-body" style="padding:0px;">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr style="background: 1px hsl(110.4, 100%, 95.1%);">
						<th>Дата</th>
						<th>Клиент</th>
						<th>Адрес</th>
						<th>Коммент.</th>
					</tr>
				</thead>
				<tbody>
<?php
foreach($leads as $val){
	// echo $val['client_id']."</br>";
	echo"<tr>"; 
	echo"<td>".$val['date']."</td>";
	echo"<td>".$val['client_name']."</td>";
	echo"<td>".$val['address']."</td>";
	echo"<td>".$val['comment']."</td>";
	echo"</tr>"; 
}
?>
				</tbody>
			</table>
		</div>
	</div>
</div>
