<?php
$created_date = explode(' ', $client[0]['created_at'])[0];
?>
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
	.form-control { transition: background 1s; }
</style>
<div class="row">
	<div class="col-5 p-0">
		<div class="card">
			<div class="card-header"><?=$title?>
				<div class="client_id_block" id=""> ID <?=$client[0]['id']?> </div>
				<input class="form-control" id="id" hidden value="<?=$client[0]['id']?>">
			</div>
			<div class="card-body p-1" style="padding:0px;">
				<div class="row">
					<div class="col-3 client_info_item_name"> Создан </div> 
					<div class="col client_info_item">
						<input class="form-control" type="date" id="date_input" disabled  value="<?=$created_date?>"> 
					</div>
				</div>
				<div class="row">
					<div class="col-3 client_info_item_name"> ФИО </div> 
					<div class="col client_info_item">
						<input class="form-control" id="name_input"  value="<?=$client[0]['name']?>"> 
					</div>
				</div>
				<div class="row">
					<div class="col-3 client_info_item_name"> Адрес </div> <div class="col client_info_item">
						<input class="form-control" id="address_input"  value="<?=$client[0]['address']?>"> </div>
				</div>
				<div class="row">
					<div class="col-3 client_info_item_name"><a href="" class="">☎</a>Phone 1</div>
					<div class="col  client_info_item">
						<div class="input-group input-group-sm">
							<input type="tel" class="form-control" placeholder="(000)-000-00-00" pattern="\([0-9]{3}\)-[0-9]{3}-[0-9]{2}-[0-9]{2}" id="client_phone_1" title="Главный телефон клиента" value="<?=$client[0]['phone']?>">
							<div class="input-group-append ">
								<span class="input-group-text" title="viber_span" id="client_viber_id" style="z-index:100;" >
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
							<input type="tel" class="form-control" placeholder="(000)-000-00-00" pattern="\([0-9]{3}\)-[0-9]{3}-[0-9]{2}-[0-9]{2}" id="client_phone_2" title="Второй телефон клиента" value="<?=$client[0]['phone2']?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-3 client_info_item_name">📧 E-mail </div> <div class="col  client_info_item">
						<input class="form-control" id="email_input"  value="<?=$client[0]['email']?>"> </div>
				</div>
				<div class="row">
					<div class="col-3 client_info_item_name"> Коммент.</div> <div class="col client_info_item">
						<textarea class="form-control" style="width: 100%;" id="comment_input"><?=$client[0]['comment']?></textarea>
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
?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script src="/assets/js/client_edit_hendler.js"></script>
<script src="/assets/js/admin_sluice.js"></script>




