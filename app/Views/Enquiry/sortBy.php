<link href="/assets/css/lead_styles.css" rel="stylesheet" />
<style>
	.w600{width:400px;}
	.fa-viber{font-size: 15px; color: hsl(286.9, 46%, 37.1%);}
	.fa-comment-dots{font-size: 16px; color: brown;}
	a.links{ color: hsl(213.6, 76.9%, 42.4%); }
	.status-select{border: 1px solid lightgray; padding: 2px;}
	.round{border-radius:5px;}
	.pointer{cursor: pointer;}
	.today_lead{background: lightgreen; color:black;}
	.cursor{cursor:pointer;}
	.red{color:red;}
</style>
<div class="card mb-4">
	<div class="card-header"><?=$title . ' / всего: ' .$total?></div>
	<div class="card-body" style="padding:0px;">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr style="background: 1px hsl(110.4, 100%, 95.1%);">
						<th>Дата <i class="fas fa-sort"></i></th>
						<th id="order_status">
							<select id="status_selector_id" class="status-select round">
								<option value="">Статус sort</option>
								<option value="new">Новый</option>
								<option value="processing">В обработке</option>
								<option value="accepted">Принят</option>
								<option value="all">Все</option>
								<option value="no_status">Нет статуса</option>
							</select>
						 </th>
						<th>Клиент</th>
						<th>Адрес</th>
						<th>Ресурс
<!-- <select id="source_selector_id" class="status&#45;select round"> -->
<!-- 							<option value="">Источник sort</option> -->
<!-- 							<option value="call">Звонок</option> -->
<!-- 							<option value="youtube">YouTube</option> -->
<!-- 							<option value="adwords">Adwords</option> -->
<!-- 							<option value="facebook">Facebook</option> -->
<!-- 							<option value="instagram">Instagram</option> -->
<!-- 							<option value="recommendation">Рекомендация</option> -->
						</th>
						<th>Коммент.</th>
						<th>Действие</th>
					</tr>
				</thead>
				<tbody>
<?php

$statuses = ['new'=>'Новый', 'processing'=>'В обработке', 'canceled'=>'Отменён', ''=>'Нет статуса', 'accepted'=>'Принят'];
foreach($enquiries as $enquiry){
	$montage_date_class = "";
	$montage_date_title = "";
	if( $enquiry['date'] === date("Y-m-d") ){
		$montage_date_class = 'today_lead';
		$montage_date_title = "Сегодняшний запрос";
	}
	$button_status = ( $enquiry['status'] == 'accepted')? ' disabled ' : '';

	$status = '';
	$source = '';
	if( $enquiry['source'] == 'call' ){
		$source ='<i class="fas fa-phone-alt"></i>'; 
	}elseif( $enquiry['source'] == 'facebook' ){
		$source ='<i class="fab fa-facebook-f"></i>'; 
	}elseif( $enquiry['source'] == 'recommendation' ){
		$source ='<i class="fas fa-people-arrows"></i>'; 
	}elseif( $enquiry['source'] == 'site' ){
		$source ='<i class="fas fa-globe"></i>'; 
	} else{
		$source = $enquiry['source'];
	}
	//statuses processing
	$status_selector_css = ' status-'.$enquiry['status']; 

	$select_of_statuses = '<select id="'.$enquiry['id'].'" class="status-select round '.$status_selector_css.'"
		onchange="changeStatus(this)" >';
	foreach($statuses as $key => $status){
		$secected_opt = "";
		if( $enquiry['status'] == $key ){
			$secected_opt = "selected";
		}
		$select_of_statuses .= "<option value='".$key."' ".$secected_opt.">$status</option>";
	}
	$select_of_statuses .= "</select>";

	// ! statuses processing

	echo"<tr id='".$enquiry['id']."'>"; 
	echo'<td><input id="" class="'.$montage_date_class.'" type="date" title = "'.$montage_date_title.'" disabled value="'.$enquiry['date'].'"></td>';
	echo'<td>'.$select_of_statuses.'</td>';
	echo"<td><a href='/client/".$enquiry['client_id']."' class=''>".$enquiry['client_name']."</a></td>";
	echo"<td><a href='/enquiry/".$enquiry['id']."' class=''>".$enquiry['address']."</a></td>";
	echo"<td class=\"text-center\">".$source."</td>";
	echo"<td>".$enquiry['comment']."</td>";
	// echo"<td style='text-align:center;'> <i style='color:red;' class=\"far fa-trash-alt\"></i> </td>";
	echo"<td style='text-align:center;'> <button  type=\"button\" style=\"padding:0 3px 0 3px; font-size:13px;\" ".$button_status."
		title='Принять в заказы' onclick=\"makeOrder(".$enquiry['id'].", ".$enquiry['client_id'].", '".$enquiry['address']."')\" class=\"btn btn-success\">В&nbsp;ЗАКАЗЫ</button></td>";
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
	let current_enquiry = {
		status_option_id : '',
	}

// function saveOption(node){
// 	current_enquiry.status_option_id = node.selectedIndex;
// 	console.log(current_enquiry.status_option_id);
// }

function changeStatus(node)
{
	let new_status = node.options[node.selectedIndex];
	console.log(new_status.value);
	if (confirm("Изменить статуc?") == true) {
		let res = goSluice(node.id, new_status.value,'lead_update_status');
		res.then(data => {
			data.text().then(function(text) {
				if( text == '1' ){
					location.reload();
				}
				console.log(text)
			})
		})
	} else {
		// node.selectedIndex = current_enquiry.status_option_id; 
	} 
	current_enquiry.status_option_id = '';
}

order_status.onchange=(e)=>{
	if(e.target.value === 'all'){
		window.location.href = "/enquiry";
	}else{;
		window.location.href = "/enquiry/sort/"+e.target.value;
	}
}


function makeOrder(enquery_id, client_id, address){
	res = goSluice(enquery_id, client_id+'||'+address, 'generate_enquiry')
	res.then(data => {
		data.text().then(function(text) {
			/*if text is number*/
			if( isNumeric(text)){
				window.location.href = "/order/"+text;
			}
			else{ console.log(text); }
		})
	}).catch(err => {
		console.error('Error: ', err);
	});
}

function isNumeric(value) {
    return /^-{0,1}\d+$/.test(value);
}



</script>
