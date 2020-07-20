<style>
	.badge-light { font-size: 15px; border: 1px solid hsl(0, 1.5%, 74.5%); }
	.card-header {padding: 5px;}
	.card{min-width:350px;}
	.container-fluid{padding:5px;}
	.card-body .row .col{min-width:280px;}
	label{font-weight: 600;}
	.billing .col-3{margin-bottom: 10px; font-size: 13px;}
	.billing .col-3 label{margin-top:8px;}
	.status-new 	  {background: lightgreen;}
	.status-processing{background: lightblue;}
	.status-measuring {background: gold; }
	.status-during    {background: hsl(240, 98.4%, 75.1%);}
	.status-in_work   {background: hsl(0, 91.5%, 77.1%);}
	.status-complete  {background: hsl(120, 59.1%, 42.2%);}
	.status-fulfilled {background: darkgreen;}
	.status-archive   {background: black;}
	.status-selector-div {width: 190px; float: right;}
	.status-selector  { width: 65%; padding: 1px; height:unset;}
</style>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page"><?=$title?> id <span class="badge badge-light"><?=$id?></span></li>
    <li class="breadcrumb-item active" aria-current="page"> договор <span class="badge badge-light"><?=$contract_number?></span></li>
    <li class="breadcrumb-item active" aria-current="page"> создан <span class="badge badge-light"><?=$order[0]['create_date']?></span></li>
  </ol>
</nav>

<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">Основная информация о заказе
				<div class="status-selector-div">Статус: <select class="custom-select status-selector" >
						<?=$status?>
					</select>
				</div>
			</div>
			<div class="card-body p-1" style="padding:0px;">
				<div class="row">
					<div class="col">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">Замер</span>
							</div>
							<input class="form-control" type="date" id="" value="<?=$order[0]['measurement_date']?>"></br>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">Вывоз</span>
							</div>
							<input class="form-control" type="date" id="" value="<?=$order[0]['removal_date']?>">
						</div>
						
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">Время доставки</span>
							</div>
							<input class="form-control" type="time" id="" value="<?=$order[0]['delivery_time']?>">
						</div>
						
					</div>
					<div class="col">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">Готов</span>
							</div>
							<input class="form-control" type="date" id="" value="<?=$order[0]['readiness_date']?>">
						</div>

						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">Монтаж</span>
							</div>
							<input class="form-control" type="date" id="" value="<?=$order[0]['montage_date']?>">
						</div>
						
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-12 form-group">
						<label>Предварительный расчет:</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1"><i class="fas fa-calculator"></i></span>
							</div>
							<input type="text" class="form-control j-ajax-save-order" name="order[calculation_link]" id="order[calculation_link]" placeholder="" value="<?=$order[0]['calculation_link']?>">
						</div>
					</div>
					<div class="col-12 form-group ">
						<label>Менеджер:</label>
						<select class="form-control j-ajax-save-order" name="order[manager_id]">
							<option>Не выбран</option>
							<option value="27" selected="">marina</option>
							<option value="30">oleksandr-ostrozhnyy</option>
						</select>
					</div>
					<div class="col-12 form-group ">
						<label>Поставщик:</label>
						<select class="form-control" id="supplier_id" name="supplier">
							<option>Не выбран</option>
							<option value="2">Газда </option>
							<option value="3">Фрам - Лайн</option>
							<option value="4">Маес</option>
							<option value="5">Валько</option>
							<option value="6">ВН. ОТ. Виталий Куц</option>
							<option value="7">Дедел - Данке</option>
							<option value="8">Силбуд - Топалит</option>
						</select>
					</div>

					<div class="col-12 form-group">
						<label>Адрес установки:</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span>
							</div>
							<input type="text" class="form-control" name="order[address]" 
								id="address_order"  value="<?=$order[0]['address']?>">		
						</div>
					</div>

					<div class="col-12 form-group ">
						<label>Монтажник:</label>
						<select class="form-control" id="installer_id" name="installer">
							<option>Не выбран</option>
							<option value="1">Александр Петрович Твердохлебов</option>
							<option value="2">Сергей Куц</option>
							<option value="3">Сергей Михайлович Мышелов</option>
							<option value="4">Голокоз Сергей</option>
							<option value="5">Виталий Куц</option>
							<option value="6">Андрей Петрович Хоменко</option>
							<option value="7">Стаднийчук Игорь В</option>
							<option value="8">Заказчик</option>
						</select>
					</div>
					<div class="col-12 form-group">
						<label>Замерщик:</label>
						<select class="form-control" name="gauger" id="gauger_id">
							<option>Не выбран</option>
							<option value="1">Александр Петрович Твердохлебов</option>
							<option value="2">Сергей Куц</option>
							<option value="3">Сергей Михайлович Мышелов</option>
							<option value="4">Голокоз Сергей</option>
							<option value="5">Виталий Куц</option>
							<option value="6">Андрей Петрович Хоменко</option>
							<option value="7">Стаднийчук Игорь В</option>
							<option value="8">Заказчик</option>
						</select>
					</div>
					<div class="col-12 form-group">
						<label>Скидка:</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">%</span>
							</div>
							<input type="text" class="form-control" name="discount" id="discount"  value="<?=$order[0]['discount']?>">
						</div>
					</div>
					<div class="col-12 form-group">
						<label>Квадратные метры:</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">м<sup>2</sup></span>
							</div>
							<input type="text" class="form-control" 
								name="square_meters" id="square_meters" value="<?=$order[0]['square_meters']?>">
						</div>
					</div>
					<div class="col-12 form-group">
						<label>Номер расчета:</label>
						<input type="text" class="form-control" 
							name="calculation_number" id="calculation_number" value="<?=$order[0]['calculation_number']?>">
					</div>

					<div class="col-12 form-group">
						<label>Номер договора:</label>
						<input type="text" class="form-control" 
							name="contract_number" id="contract_number" value="<?=$order[0]['contract_number']?>">
					</div>

					<div class="col-12 form-group">
						<label>Номер заказа у поставщика:</label>
						<input type="text" class="form-control" 
						name="vendor_number" id="vendor_number" value="<?=$order[0]['vendor_number']?>">
					</div>
					<hr>
				</div>
				<hr>
				<div class="row billing">
					<div class="col-3"><label>Стоимость:</label></div>
					<div class="col-3">
						<input type="text" class="form-control " name="total_price" id="total_price" value="<?=$order[0]['total_price']?>">
					</div>
					<div class="col-3"><label>Монтаж:</label></div>
					<div class="col-3">
						<input type="text" class="form-control " name="montage_price" id="montage_price" value="<?=$order[0]['montage_price']?>">
					</div>
				</div>
				<div class="row billing">
					<div class="col-3"><label>Доп. работы:</label></div>
					<div class="col-3">
						<input type="text" class="form-control " name="additional_price" id="additional_price" value="<?=$order[0]['additional_price']?>">
					</div>
					<div class="col-3"><label>Стоимость замера:</label></div>
					<div class="col-3">
						<input type="text" class="form-control " name="measuring_price" id="measuring_price" value="<?=$order[0]['measuring_price']?>">
					</div>
				</div>
				<div class="row billing">
					<div class="col-3"><label>Газда:</label></div>
					<div class="col-3">
						<input type="text" class="form-control " name="gazda_price" id="gazda_price" value="<?=$order[0]['gazda_price']?>">
					</div>
					<div class="col-3"><label>Фактический остаток:</label></div>
					<div class="col-3">
						<input type="text" disabled class="form-control " name="balance" id="balance" value="<?=$order[0]['balance']?>">
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col"><label>Комментарий к заказу:</label>
						<textarea class="form-control" name="order_comment"><?=$order[0]['comment']?></textarea>
					</div>
				</div>
			</div>
		</div>
		</br>
		<div class="card">
			<div class="card-header">Оплата по заказу</div>
			<div class="card-body p-1" style="padding:0px;">
				<button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#payment_modal">Добавить</button>
				<table class="table table-bordered" style="margin-bottom: 0px;">
					<thead>
						<tr>
							<th>Тип</th>
							<th>Кто/Кому</th>
							<th>Дата оплаты</th>
							<th>Сумма</th>
							<th>Статус</th>
							<th width="80"></th>
						</tr>
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
							<td><?=$order[0]['client_id']?></td>
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
								<textarea class="j-save-client-note form-control" name="client_comment"><?=$client[0]['comment']?></textarea>
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
								<td><a href="/atom/module/leads?id=356">Лид №</a></td>
							</tr>
							<tr>
								<td>Адрес</td>
								<td>Крушинского 22</td>
							</tr>
							<tr>
								<td>Комментарий</td>
								<td></td>
							</tr>
							<tr>
								<td>Источник</td>
								<td> <i class="ion-ios-telephone"></i> Звонок</td>
							</tr>
							<tr>
								<td>Дата</td>
								<td>03.04.2020</td>
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
				<table class="table table-bordered" style="margin-bottom: 0px;">
					<thead>
						<tr>
							<th>ID</th>
							<th>№ договора</th>
							<th>Готовность</th>
							<th>Монтажник</th>
							<th>Адрес монтажа</th>
							<th>Статус</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" id="payment_modal" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Добавить оплату</h5>
			</div>
			<div class="modal-body">
				<input type="hidden" name="id" value=""> 
				<div class="input-group input-group-sm mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text" >Тип</label>
					</div>
					<select name="type" class="form-control">
						<option value="income">Доход</option>
						<option value="outgo">Расход</option>
					</select>
				</div>
				<div class="input-group input-group-sm mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text" >Кто/Кому</label>
					</div>
					<select name="user_type" class="form-control">
						<option value="client">Клиент</option>
						<option value="installer">Монтажник</option>
						<option value="supplier">Поставщик</option>
						<option value="gauger">Замерщик</option>
					</select>
				</div>
				<div class="input-group input-group-sm mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text" >Методы оплаты</label>
					</div>
					<select name="method" class="form-control">
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
					<input class="form-control" type="number">
				</div>

				<hr>
				<div class="form-group">
					<label>Дата оплаты</label>
					<input type="date" name="date_create" class="form-control" value="03.04.2020" >
				</div>
				<div class="form-group">
					<label>Дата Получения</label>
					<input type="date" name="date_receiving" class="form-control" value="" >
				</div>
				<div class="form-group">
					<label>Комментарий</label>
					<textarea class="form-control" style="resize: vertical" name="comment"></textarea>
				</div>
				<div class="input-group input-group-sm">
					<div class="input-group-prepend">
						<label class="input-group-text" >Статус оплаты</label>
					</div>
					<select name="status" class="custom-select">
						<option value="sent">Отправлено</option>
						<option value="received">Получено</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
				<button type="button" class="btn btn-primary">Сохранить</button>
			</div>
		</div>
	</div>
</div>

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


<script>
/*choose data in selected*/
supplier_id.selectedIndex  = "<?=$order[0]['supplier_id']-1?>";
installer_id.selectedIndex = "<?=$order[0]['installer_id']-1?>";
gauger_id.selectedIndex    = "<?=$order[0]['gauger_id']-1?>";


// convert phone number
let p_1 = phone_a.innerText.slice(2, 5);
let p_2 = phone_a.innerText.slice(5, 8);
let p_3 = phone_a.innerText.slice(8, 10);
let p_4 = phone_a.innerText.slice(10, 12);
let usable_phone = '(' + p_1 + ')-' + p_2 + '-' + p_3 + '-' + p_4 ;
phone_a.innerText = usable_phone;
// | convert phone number
</script>
