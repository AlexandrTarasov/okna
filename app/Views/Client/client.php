<style>
	.client_id_block{ width: 100px; float: right; text-align: center;
		background: hsl(204.8, 100%, 87.6%); border-radius: 4px; font-weight: bold;
	}
	.client_info_item{padding:4px;}
	.row{margin:unset;}
	.client_info_item_name{margin: auto; border-bottom: 1px solid hsl(0, 0%, 93.3%);}
	.card{margin:5px;min-width:350px;}
	.table { font-size: 13px;}
	.table th, .table td{padding: 0.35rem;}
	.col-5{min-width:340px;}
	.viber_on{color:purple;}
	.viber_off{color:gray;}
</style>
<div class="row">
	<div class="col-5 p-0">
		<div class="card">
			<div class="card-header"><?=$title?>
				<div class="client_id_block"> ID <?=$client[0]['id']?> </div>
			</div>
			<div class="card-body p-1" style="padding:0px;">
				<div class="row">
					<div class="col-3 client_info_item_name"> ФИО </div> 
					<div class="col client_info_item">
						<input class="form-control" id=""  value="<?=$client[0]['name']?>"> 
					</div>
				</div>
				<div class="row">
					<div class="col-3 client_info_item_name"> Адрес </div> <div class="col client_info_item">
						<input class="form-control" id=""  value="<?=$client[0]['address']?>"> </div>
				</div>
				<div class="row">
					<div class="col-3 client_info_item_name"><a href="" class="">☎</a>Phone 1</div>
					<div class="col  client_info_item">
						<div class="input-group input-group-sm">
							<input type="tel" class="form-control" id="client_phone_1" title="tel 1" value="<?=$client[0]['phone']?>">
							<div class="input-group-append ">
								<span class="input-group-text" title="viber_span" id="client_viber1_id" style="z-index:100;" >
									<i title="viber_svg" class="<?=$phone_viber_1?> fab fa-viber"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-3 client_info_item_name"><a href="" class="">☎</a>Phone 2</div> 
					<div class="col  client_info_item">
						<div class="input-group input-group-sm">
							<input type="tel" class="form-control" id="client_phone_2" title="tel 2" value="<?=$client[0]['phone2']?>">
							<div class="input-group-append ">
								<span class="input-group-text" title="viber_span" style="z-index:100;" id="client_viber2_id">
									<i title="viber_svg" class="<?=$phone_viber_2?> fab fa-viber fab fa-viber"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-3 client_info_item_name">📧 E-mail </div> <div class="col  client_info_item">
						<input class="form-control" id=""  value="<?=$client[0]['email']?>"> </div>
				</div>
				<div class="row">
					<div class="col-3 client_info_item_name"> Комментарий</div> <div class="col client_info_item">
						<textarea style="width: 100%;"><?=$client[0]['comment']?></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-7 p-0">
		<div class="card">
			<div class="card-header">Заказы клиента</div>
			<div class="card-body p-1" >
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>3аказ ID</th>
							<th>Договор №</th>
							<th>Готовность</th>
							<th>Монтажник</th>
							<th>Адрес монтажа</th>
							<th>Сумма ₴</th>
							<th>Получено ₴</th>
						</tr>

					</thead>
					<tbody>
<?php
foreach($orders as $order){
					echo"<tr>";
					echo"	<td><a href=/order/".$order['id'].">".$order['id']."</a></td>";
					echo"	<td><a href=/order/".$order['id'].">".$order['contract_number']."</a></td>";
					echo"	<td>".$order['readiness_date']."</td>";
					echo"	<td>".$order['instal_name']."</td>";
					echo"	<td>".$order['address']."</td>";
					echo"	<td>".$order['total_price']."</td>";
					echo"	<td>".$order['income_sum']."</td>";
					echo"</tr>";
}

?>
					</tbody>

				</table>
			</div>
		</div>
		<div class="card">
			<div class="card-header">Расчёты</div>
			<div class="card-body p-1" style="padding:0px;">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>ID заказа</th>
							<th>Тип</th>
							<th>Отправка</th>
							<th>Получение</th>
							<th>Метод</th>
							<th>Сумма ₴</th>
							<th>Статус</th>
						</tr>
					</thead>
					<tbody>
<?php
$payments->showElem();
// foreach($payments as $payment){
					// $date_create = date_create($payment['date_create']);
					// $date_receiving = '-';
					// if( $payment['date_receiving'] !== '0000-00-00 00:00:00' ){
					// 	$date_receiving = date_format(date_create($payment['date_receiving']),"Y/m/d");
					// }
					// echo"<tr>";
					// echo"	<td><a href=/order/".$payment['order_id'].">".$payment['order_id']."</a></td>";
					// echo"	<td>".$payment['type']."</td>";
					// echo"	<td>".date_format($date_create,"Y/m/d")."</td>";
					// echo"	<td>".$date_receiving."</td>";
					// echo"	<td>".$payment['method']."</td>";
					// echo"	<td>".$payment['amount']."</td>";
					// echo"	<td>".$payment['status']."</td>";
					// echo"</tr>";
// }
?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script src="/assets/js/phone_number_handler.js"></script>
