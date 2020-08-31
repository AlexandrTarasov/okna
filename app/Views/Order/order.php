<style>
	.badge-light { font-size: 15px; border: 1px solid hsl(0, 1.5%, 74.5%); }
	.card-header {padding: 5px;}
	.card{min-width:350px;}
	.container-fluid{padding:5px;}
	.card-body .row .col{min-width:280px;}
	label{font-weight: 600;}
	.billing .col-3{margin-bottom: 10px; font-size: 13px;}
	.billing .col-3 label{margin-top:8px;}
	.status-new 	  {background: rgba(76, 175, 80, 0.3)}
	.status-processing{background: lightblue;}
	.status-measuring {background: gold;}
	.status-during    {background: hsla(240, 98.4%, 75.1%, 0.3); }
	.status-in_work   {background: hsla(0, 91.5%, 77.1%, 0.3 );}
	.status-complete  {background: hsla(120, 59.1%, 42.2%, 0.3); }
	.status-fulfilled {background: hsl(120, 59.1%, 42.2%);}
	.status-archive   {background: lightgray;}
	.status-selector-div {width: 190px; float: right;}
	.status-selector  { width: 65%; padding: 1px; height:unset;}
	.form-control { transition: background 1s; }
	#payments_table tr th input{font-size:12px;}
	#payments_table tr { font-size:14px;}
	#payments_table tr th{vertical-align: middle;padding: 0.25rem;} 
	#client_orders_table tr {font-size:12px;} 
	#client_orders_table tr th{vertical-align: middle;padding: 0.25rem;} 


</style>
<ul class="d-none"><?=$id_given_by_supplier?> </ul>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page"><?=$title?> id <span id="order_id" class="badge badge-light"><?=$id?></span></li>
    <li class="breadcrumb-item active" aria-current="page"> договор <span class="badge badge-light"><?=$contract_number?></span></li>
    <li class="breadcrumb-item active" aria-current="page"> создан <span class="badge badge-light"><?=$order[0]['create_date']?></span></li>
  </ol>
</nav>

<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">Основная информация о заказе
				<div class="status-selector-div">Статус: <select class="custom-select status-selector" id="order_status" >
						<?=$status?>
					</select>
				</div>
			</div>
			<div class="card-body p-1" style="padding:0px;">
				<div class="row">
					<div class="col">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="">Замер</span>
							</div>
							<input class="form-control" type="date"  id="measurement_date_input" value="<?=$order[0]['measurement_date']?>">
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="">Вывоз</span>
							</div>
							<input class="form-control" type="date" disabled id="removal_date_input" value="<?=$order[0]['removal_date']?>">
						</div>
						
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="">Время доставки</span>
							</div>
							<input class="form-control" type="time" id="delivery_time_input" value="<?=$order[0]['delivery_time']?>">
						</div>
						
					</div>
					<div class="col">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="">Готов</span>
							</div>
							<input class="form-control" type="date" id="readiness_date_input" value="<?=$order[0]['readiness_date']?>">
						</div>

						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="">Монтаж</span>
							</div>
							<input class="form-control" type="date" id="montage_date_input" value="<?=$order[0]['montage_date']?>">
						</div>
						
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-12 form-group">
						<label>Предварительный расчет:</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id=""><i class="fas fa-calculator"></i></span>
							</div>
							<input type="text" class="form-control" id="calculation_link_input" value="<?=$order[0]['calculation_link']?>">
						</div>
					</div>
					<div class="col-12 form-group ">
						<label>Менеджер:</label>
						<select class="form-control" id="manager_select">
							<option value="">Не выбран</option>
							<?=$managers_options?>
						</select>
					</div>
					<div class="col-12 form-group ">
						<label>Поставщик:</label>
						<select class="form-control" id="supplier_select" name="supplier">
							<option value="">Не выбран</option>
							<?=$suppliers_options?>
						</select>
					</div>

					<div class="col-12 form-group">
						<label>Адрес установки:</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
							</div>
							<input type="text" class="form-control" id="address_input"
							value="<?=$order[0]['address']?>">
						</div>
					</div>

					<div class="col-12 form-group ">
						<label>Монтажник:</label>
						<select class="form-control" id="installer_select">
							<option value="">Не выбран</option>
							<?=$installers_options?>
						</select>
					</div>
					<div class="col-12 form-group">
						<label>Замерщик:</label>
						<select class="form-control" id="gauger_select">
							<option value="">Не выбран</option>
							<?=$gaugers_options?>
						</select>
					</div>
					<div class="col-12 form-group">
						<label>Скидка:</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" >%</span>
							</div>
							<input type="number" class="form-control" id="discount_input"  value="<?=$order[0]['discount']?>">
						</div>
					</div>
					<div class="col-12 form-group">
						<label>Квадратные метры:</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">м<sup>2</sup></span>
							</div>
							<input type="text" class="form-control" 
								 id="square_meters_input" value="<?=$order[0]['square_meters']?>">
						</div>
					</div>
					<div class="col-12 form-group">
						<label>Номер расчета:</label>
						<input type="text" class="form-control" 
						 id="calculation_number_input" value="<?=$order[0]['calculation_number']?>">
					</div>

					<div class="col-12 form-group">
						<label>Номер договора:</label>
						<input type="text" class="form-control" 
							 id="contract_number_input" value="<?=$order[0]['contract_number']?>">
					</div>

					<div class="col-12 form-group">
						<label>Номер заказа у поставщика:</label>
						<input type="text" class="form-control" 
					 id="vendor_number_input" value="<?=$order[0]['vendor_number']?>">
					</div>
					<hr>
				</div>
				<hr>
				<div class="row billing">
					<div class="col-3"><label>Стоимость:</label></div>
					<div class="col-3">
						<input type="number" class="form-control " id="total_price_input" value="<?=$order[0]['total_price']?>">
					</div>
					<div class="col-3"><label>Монтаж:</label></div>
					<div class="col-3">
						<input type="number" class="form-control " id="montage_price_input" value="<?=$order[0]['montage_price']?>">
					</div>
				</div>
				<div class="row billing">
					<div class="col-3"><label>Доп. работы:</label></div>
					<div class="col-3">
						<input type="number" class="form-control " id="additional_price_input" value="<?=$order[0]['additional_price']?>">
					</div>
					<div class="col-3"><label>Стоимость замера:</label></div>
					<div class="col-3">
						<input type="number" class="form-control " id="measuring_price_input" value="<?=$order[0]['measuring_price']?>">
					</div>
				</div>
				<div class="row billing">
					<div class="col-3"><label>Газда:</label></div>
					<div class="col-3">
						<input type="number" class="form-control " id="gazda_price_input" value="<?=$order[0]['gazda_price']?>">
					</div>
					<div class="col-3"><label>Фактический остаток:</label></div>
					<div class="col-3">
						<input type="number" disabled class="form-control " id="balance_input" value="<?=$actual_balance?>">
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col"><label>Комментарий к заказу:</label>
						<textarea class="form-control" id="comment_textarea"><?=$order[0]['comment']?></textarea>
					</div>
				</div>
			</div>
		</div>
		</br>
		<div class="card">
			<div class="card-header">Оплата по заказу</div>
			<div class="card-body p-1" style="padding:0px;">
				<button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#payment_modal">Добавить</button>
				<table class="table table-bordered" id="payments_table" style="margin-bottom: 0px;">
					<thead>
						<tr>
							<th>Тип</th>
							<th>Кто/Кому</th>
							<th>Дата оплаты</th>
							<th>Сумма</th>
							<th>Статус</th>
							<th></th>
						</tr>
						<?=$payments_th?>
					</thead>
				</table>
			</div>
		</div> <!-- payment card -->

		<div class="card">
			<div class="card-header">Файлы заказа</div>
			<div class="card-body p-1" style="padding:0px;">
				<button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#file_add_modal">Загрузить файл</button>
				<table class="table table-bordered" style="margin-bottom: 0px;">
					<thead>
						<tr>
							<th width="200">Файл</th>
							<th>Загрузил</th>
							<th>Дата загрузки</th>
							<th width="300">Комментарий</th>
							<th width="50"></th>
						</tr>
					</thead>
				</table>
			</div>
		</div> <!-- payment card -->
	</div>



	<div class="col">
		<div class="card">
			<div class="card-header">Инфа о клиенте</div>
			<div class="card-body" style="padding:0px;">
				<table class="table table-bordered" style="margin-bottom: 0px;">
					<tbody>
						<tr>
							<td>ID клиента</td>
							<td><input id="client_id" disabled value="<?=$order[0]['client_id']?>"></td>
						</tr>
						<tr>
							<td>ФИО</td>
							<td><a href="/client/<?=$order[0]['client_id']?>"><?=$client[0]['name']?></a></td>
						</tr>

						<tr>
							<td>Адрес</td>
							<td><?=$client[0]['address']?></td>
						</tr>

						<tr>
							<td>Телефон</td>
							<td><a id="phone_a" href="tel:<?=$client[0]['phone']?>"><?=$client[0]['phone']?></a> </td>
						</tr>
						<tr>
							<td>Комментарий</td>
							<td>
								<textarea class="form-control" id="client_comment_textarea"><?=$client[0]['comment']?></textarea>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		</br>
		<div class="card">
			<div class="card-header"><a data-toggle="collapse" aria-expanded="true" href="#collapseExample">Информация о лиде</a></div>
			<div class="card-body" style="padding:0px;" >
				<div class="collapse" id="collapseExample">
					<table class="table table-bordered" style="margin-bottom: 0px;">
						<tbody>
							<tr>
								<td>ID</td>
								<td><a href="/atom/module/lead?id=<?=$order[0]['lead_id']?>"><?=$order[0]['lead_id']?></a></td>
							</tr>
							<tr>
								<td>Адрес</td>
								<td><?=$enquiry_data['address']?></td>
							</tr>
							<tr>
								<td>Комментарий</td>
								<td><?=$enquiry_data['comment']?></td>
							</tr>
							<tr>
								<td>Источник</td>
								<td> <i class="ion-ios-telephone"></i> <?=$enquiry_data['source']?></td>
							</tr>
							<tr>
								<td>Дата</td>
								<td><?=$enquiry_data['date']?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		</br>
		<div class="card">
			<div class="card-header">Заказы клиента</div>
			<div class="card-body" style="padding:0px;">
				<table class="table table-bordered" id="client_orders_table" style="margin-bottom: 0px;">
					<thead>
						<tr>
							<th>ID</th>
							<th>№ договора</th>
							<th>Готовность</th>
							<th>Монтажник</th>
							<th>Адрес монтажа</th>
							<th>Статус</th>
						</tr>
						<?=$other_client_orders_th?>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- modal payment adding -->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" id="payment_modal" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Добавить оплату</h5>
			</div>
			<form id="add_payment_form">
			<div class="modal-body">
				<input type="hidden" name="order_id" value="<?=$id?>"> 
				<div class="input-group input-group-sm mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text" >Тип</label>
					</div>
					<select name="type" id="payment_type_select"  required class="form-control">
						<option value="">-</option>
						<option value="income">Доход</option>
						<option value="outgo">Расход</option>
					</select>
				</div>
				<div class="input-group input-group-sm mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text" id="payee_payer_lable"></label>
					</div>
					<select name="user_type" id="payee_or_payer" required class="form-control">
						<option value="" >-</option>
					</select>
				</div>
				<div class="input-group input-group-sm mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text" >Методы оплаты</label>
					</div>
					<select name="method"  required class="form-control">
						<option value="">-</option>
						<option value="cash">Наличные</option>
						<option value="cashless">Безнал</option>
						<option value="card">Карта</option>
						<option value="courier">Курьер</option>
						<option value="installer">Монтажником</option>
					</select>
				</div>
				</hr>
				<div class="input-group input-group-sm mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-sm">Сумма оплаты</span>
					</div>
					<input class="form-control" required name="amount" type="number">
				</div>

				<hr>
				<div class="form-group">
					<label>Дата оплаты</label>
					<input type="date" name="date_create" class="form-control" required value="" >
				</div>
				<div class="form-group">
					<label>Комментарий</label>
					<textarea class="form-control" style="resize: vertical" name="comment"></textarea>
				</div>
				<input hidden class="form-control" name="status"id="" placeholder="" value="sent">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
				<button type="submit" class="btn btn-primary" >Сохранить</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!--  -->

<!-- modal file download -->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" id="file_add_modal" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Загрузить файл</h5>
			</div>
			<div class="modal-body">
				<div class="input-group mb-3">
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="upload_file" >
						<label class="custom-file-label" for="inputGroupFile01">Выбрать файл</label>
					</div>
				</div>
				Комментарий:
				<textarea class="form-control" name="upload_file_comment"></textarea>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
<!-- -->

<script src="/assets/js/order_handler.js"></script>
<script src="/assets/js/admin_sluice.js"></script>
<script>

// convert phone number
let p_1 = phone_a.innerText.slice(2, 5);
let p_2 = phone_a.innerText.slice(5, 8);
let p_3 = phone_a.innerText.slice(8, 10);
let p_4 = phone_a.innerText.slice(10, 12);
let usable_phone = '(' + p_1 + ')-' + p_2 + '-' + p_3 + '-' + p_4 ;
phone_a.innerText = usable_phone;
// | convert phone number

add_payment_form.onsubmit = async (e) => {
	e.preventDefault();
	let formData = new FormData(add_payment_form);
	formData.append('from_node', 'add_payment_form');
	console.log(formData.get('amount'));

	let response = await fetch('/sluice', {
		method: 'POST',
		body: formData
	});
	response.text().then(function (text){
		if(!isNaN (text) ){
			location.reload();
		}else{
		}
		console.log(text);
	});
}

payment_type_select.onchange=(e)=>{
	let opt_val = payment_type_select.options[payment_type_select.selectedIndex].value;
	console.log(opt_val);
	if( opt_val === 'income' ){
		payee_payer_lable.innerHTML="Кто платит";
		payee_or_payer.innerHTML = "<option value=\"client\">Клиент</option>";
	}
	else if( opt_val === 'outgo' ){
		payee_payer_lable.innerHTML="Кому платим";
		payee_or_payer.innerHTML = "<option value=\"installer\">Монтажнику</option> <option value=\"supplier\">Поставщику</option> <option value=\"gauger\">Замерщику</option>";
	}
}


</script>
