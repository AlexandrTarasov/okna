	          <form action="/<?=uri_string()?>" method="post" class="form-vertical">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title"><?= isset($payment['id']) ? "Редактировать оплату" : 'Добавить оплату';?></h4>
			      </div>
			      <div class="modal-body">
				  		
				  		<input type="hidden" name="id" value="<?= isset($payment['id']) ? $payment['id'] : '';?>" /> 
				  		
				        <div class="form-group">
					        <label>Тип</label>
					        <select name="type" class="form-control">
						        <option <?= isset($payment['type']) && $payment['type'] == 'income' ? 'selected' : '';?> value="income">Доход</option>
						        <option <?= isset($payment['type']) && $payment['type'] == 'outgo' ? 'selected' : '';?> value="outgo">Расход</option>
					        </select>
				        </div>

				        <div class="form-group">
					        <label>Кто/Кому</label>
					        <select name="user_type" class="form-control">
						        <option <?= isset($payment['user_type']) && $payment['user_type'] == 'client' ? 'selected' : '';?> value="client">Клиент</option>
						        <option <?= isset($payment['user_type']) && $payment['user_type'] == 'installer' ? 'selected' : '';?> value="installer">Монтажник</option>
						        <option <?= isset($payment['user_type']) && $payment['user_type'] == 'supplier' ? 'selected' : '';?> value="supplier">Поставщик</option>
						        <option <?= isset($payment['user_type']) && $payment['user_type'] == 'gauger' ? 'selected' : '';?> value="gauger">Замерщик</option>
					        </select>
				        </div>
				        
				        <div class="form-group">
					        <label>Метод оплаты</label>
					        <select name="method" class="form-control">
						        <option <?= isset($payment['method']) && $payment['method'] == 'cash' ? 'selected' : '';?> value="cash">Наличные</option>
						        <option <?= isset($payment['method']) && $payment['method'] == 'cashless' ? 'selected' : '';?> value="cashless">Безнал</option>
						        <option <?= isset($payment['method']) && $payment['method'] == 'card' ? 'selected' : '';?> value="card">Карта</option>
						        <option <?= isset($payment['method']) && $payment['method'] == 'courier' ? 'selected' : '';?> value="courier">Курьер</option>
						        <option <?= isset($payment['method']) && $payment['method'] == 'installer' ? 'selected' : '';?> value="installer">Монтажником</option>
					        </select>
				        </div>
						
					
				        
				        
				        <div class="form-group">
					        <label>Сумма оплаты</label>
					        <div class="input-group">
					        	<input type="number" name="amount" class="form-control" value="<?= isset($payment['amount']) ? $payment['amount'] : '0';?>" placeholder="Сумма" />
					        	<span class="input-group-addon">грн.</span>
					        </div>
				        </div>
				        
				        
				        <hr/>
				        
				        
				        <div class="form-group">
					        <label>Дата оплаты</label>
					        <input type="text" name="date_create" class="form-control j-datepicker" value="<?= isset($payment['date_create']) ?  date('d.m.Y', strtotime($payment['date_create'])) : date('d.m.Y')?>" placeholder="Дата оплаты" />
				        </div>
				        
				        <div class="form-group">
					        <label>Дата Получения</label>
					        <input type="text" name="date_receiving" class="form-control j-datepicker" value="<?= isset($payment['date_receiving']) ? date('d.m.Y', strtotime($payment['date_receiving'])) : ''?>" placeholder="Дата получения" />
				        </div>
				        
				        
				        <div class="form-group">
					        <label>Комментарий</label>
					        <textarea class="form-control" style="resize: vertical" name="comment"><?= isset($payment['comment']) ? $payment['comment'] : '';?></textarea>
				        </div>
				        
				        <div class="form-group">
					        <label>Статус оплаты</label>
					        <select name="status" class="form-control">
						        <option value="sent" <?= isset($payment['status']) && $payment['status'] == 'sent' ? 'selected' : '';?>>Отправлено</option>
						        <option value="received" <?= isset($payment['status']) && $payment['status'] == 'received' ? 'selected' : '';?>>Получено</option>
					        </select>
				        </div>
			      </div>
			      <div class="modal-footer">
				    <? if(isset($payment)):?>
					<a href="<?= MODULES_URL?>orders_payments/delete/<?=$payment['id']?>" onclick="return confirm('Вы уверены что хотите удалить оплату?');" class="btn btn-danger pull-left"><i class="fa fa-trash"></i> Удалить</a>
				    <? endif;?>
				      
			        <button type="button" class="btn btn-default" data-dismiss="modal">Отменить</button>
			        <button type="submit" class="btn btn-primary">Сохранить</button>
			      </div>
		      		        
	          </form>


			  <script>
			
			 	 $.fn.datepicker.dates['ru'] = {
		            days: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
				    daysShort: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
				    daysMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
				    months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
				    monthsShort: ["Янв", "Фев", "Март", "Апр", "Май", "Июнь", "Июль", "Авг", "Сент", "Окт", "Ноя", "Дек"],
				    today: "Сегодня",
				    clear: "Очистить",
				    format: "dd.mm.yyyy",
				    titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
				};
			
				$('input.j-datepicker').datepicker({'format': 'dd.mm.yyyy', weekStart: 1, todayHighlight: true, language: 'ru'});
			 

				</script>