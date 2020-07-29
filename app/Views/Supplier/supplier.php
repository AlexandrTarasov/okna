<style>
	.supplier_id_block{ width: 100px; float: right; text-align: center;
		background: hsl(204.8, 100%, 87.6%); border-radius: 4px; font-weight: bold;
	}
	.supplier_info_item{padding:4px;}
	.row{margin:unset;}
	.supplier_info_item_name{margin: auto; border-bottom: 1px solid hsl(0, 0%, 93.3%);}
	.card{margin:5px;min-width:350px;}
	.table { font-size: 13px;}
	.table th, .table td{padding: 0.35rem;}
	.col-5{min-width:340px;}
	.viber_on{color:purple;}
	.viber_off{color:gray;}
	.form-control{transition: background 2s;}
</style>
<div class="row">
	<div class="col-5 p-0">
		<div class="card">
			<div class="card-header"><?=$title?>
				<div class="supplier_id_block" id="supplier_id_block" data-supplier-id="<?=$supplier['id']?>"> ID <?=$supplier['id']?> 
				<i class="far fa-trash-alt" style="color:red;"></i>
				</div> 
			</div>
			<div class="card-body p-1" style="padding:0px;">
				<div class="row">
					<div class="col-3 supplier_info_item_name">Компания</div> 
					<div class="col supplier_info_item">
						<input class="form-control" id="supplier_company_name"  value="<?=$supplier['company_name']?>"> 
					</div>
				</div>

				<div class="row">
					<div class="col-3 supplier_info_item_name">Менджер 1</div> 
					<div class="col supplier_info_item">
						<input class="form-control" id="supplier_manager1_name"  value="<?=$supplier['manager_name']?>"> 
					</div>
				</div>

				<div class="row">
					<div class="col-3 supplier_info_item_name"><a href="" class="">☎</a>Phone 1</div>
					<div class="col  supplier_info_item">
						<div class="input-group input-group-sm">
							<input type="tel" class="form-control" id="supplier_phone_1" title="tel 1" 
								value="<?=$supplier['manager_phone']?>">
							<div class="input-group-append ">
								<span class="input-group-text" title="viber_span" id="supplier_viber1_id" style="z-index:100;" >
									<i title="viber_svg" class="<?=$phone_viber_1?> fab fa-viber"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-3 supplier_info_item_name">📧 E-mail 1</div> <div class="col  supplier_info_item">
						<input class="form-control" id="supplier_manager1_mail"  value="<?=$supplier['manager_email']?>">
					</div>
				</div>
				<div class="row">
					<div class="col-3 supplier_info_item_name">✍ Коммен.</div> <div class="col supplier_info_item">
						<textarea style="width: 100%;"><?=$supplier['comment']?></textarea>
					</div>
				</div>
<hr>
				<a href="#" class="" id="second_manager_switcher">+</a> 
				<div class="" style="display:none;" id="second_manager_div">
					<div class="row">
						<div class="col-3 supplier_info_item_name">Менеджер 2</div> 
						<div class="col supplier_info_item">
							<input class="form-control" id="supplier_manager2_name"  value="<?=$supplier['manager2_name']?>"> 
						</div>
					</div>
					<div class="row">
						<div class="col-3 supplier_info_item_name"><a href="" class="">☎</a>Phone 2</div> 
						<div class="col  supplier_info_item">
							<div class="input-group input-group-sm">
								<input type="tel" class="form-control" id="supplier_phone_2" title="tel 2" 
								value="<?=$supplier['manager2_phone']?>">
								<div class="input-group-append ">
									<span class="input-group-text" title="viber_span" style="z-index:100;" id="supplier_viber2_id">
										<i title="viber_svg" class="<?=$phone_viber_2?> fab fa-viber fab fa-viber"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-3 supplier_info_item_name">📧 E-mail 2 </div> <div class="col  supplier_info_item">
							<input class="form-control" id="supplier_manager2_mail"  value="<?=$supplier['manager_email']?>">
						</div>
					</div>
					<div class="row">
						<div class="col-3 supplier_info_item_name"> Адрес </div> <div class="col supplier_info_item">
							<input class="form-control" id="supplier_company_address"  value="<?=$supplier['address']?>"> 
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<div class="col-7 p-0">
		<div class="card">
			<div class="card-header">Заказы</div>
			<div class="card-body p-1" >
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>3аказ ID</th>
							<th>Договор №</th>
							<th>Готовность дата</th>
							<th>Оплачено ₴</th>
							<th>Гарза ₴</th>
							<th>Адрес</th>
						</tr>

					</thead>
					<tbody>
<?php
foreach($orders as $order){
					$date_readiness = date_create($order['readiness_date']);
					if( $order['readiness_date'] !== '0000-00-00 00:00:00' ){
						$date_readiness = date_format(date_create($order['readiness_date']),"d.m.Y");
					}
					echo"<tr>";
					echo"	<td><a href=/order/".$order['id'].">".$order['id']."</a></td>";
					echo"	<td><a href=/order/".$order['id'].">".$order['contract_number']."</a></td>";
					echo"	<td>".$date_readiness."</td>";
					echo"	<td>".$order['paid_out']."</td>";
					echo"	<td>".$order['gazda_price']."</td>";
					echo"	<td>".$order['address']."</td>";
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

<script src="/assets/js/supplier_edit_hendler.js"></script>
<script src="/assets/js/update_data.js"></script>
<script src="/assets/js/admin_sluice.js"></script>
<script>
second_manager_switcher.onclick=()=>{
	second_manager_div.style.display = 'block';
}
</script>
