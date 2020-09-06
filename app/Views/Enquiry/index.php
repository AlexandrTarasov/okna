<style>
	.w600{width:400px;}
	.fa-viber{font-size: 15px; color: hsl(286.9, 46%, 37.1%);}
	.fa-comment-dots{font-size: 16px; color: brown;}
	a.links{ color: hsl(213.6, 76.9%, 42.4%); }
	.status-select{border: 1px solid lightgray; padding: 2px;}
	.round{border-radius:5px;}
	.status-new 	   {background:lightgreen;}
	.status-processing {background:lightblue; color: hsl(194.4, 37.7%, 39%);}
	.status-canceled   {background:lightgray; color: hsl(0, 2.3%, 65.9%);}
	.status-{color: hsl(0, 85.7%, 72.5%)};
	.pointer{cursor: pointer;}
</style>
<div class="card mb-4">
	<div class="card-header"><?=$title . ' / было всего: ' .$total. '/ из них не в заказах '.$stay_as_enquery ?></div>
	<div class="card-body" style="padding:0px;">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr style="background: 1px hsl(110.4, 100%, 95.1%);">
						<th>Дата <i class="fas fa-sort"></i></th>
						<th id="order_status"> <select id="status_selector_id" class="status-select round">
							<option value="">Статус sort</option>
							<option value="new">Новый</option>
							<option value="processing">В обработке</option>
							<option value="no_status">Нет статуса</option>
						 </th>
						<th>Клиент</th>
						<th>Адрес</th>
						<th><select id="source_selector_id" class="status-select round">
							<option value="">Источник sort</option>
							<option value="call">Звонок</option>
							<option value="youtube">YouTube</option>
							<option value="adwords">Adwords</option>
							<option value="facebook">Facebook</option>
							<option value="instagram">Instagram</option>
							<option value="recommendation">Рекомендация</option></th>
						<th>Коммент.</th>
						<th>Действие</th>
					</tr>
				</thead>
				<tbody>
<?php

$statuses = ['new'=>'Новый', 'processing'=>'В обработке', 'canceled'=>'Отменён', ''=>'Нет статуса'];

foreach($enquiries as $enquiry){
	$status = '';
	$source = '';
	if( $enquiry['source'] == 'call' ){
		$source ='<i class="fas fa-phone-alt"></i>'; 
	}
	//statuses processing
	$status_selector_css = ' status-'.$enquiry['status']; 

	$select_of_statuses = '<select id="cars" class="status-select round '.$status_selector_css.'"
		onchange="changeRole(this)" onfocus="saveOption(this)">';
	foreach($statuses as $key => $status){
		$secected_opt = "";
		if( $enquiry['status'] == $key ){
			$secected_opt = "selected";
		}
		$select_of_statuses .= "<option value='".$key."' $secected_opt>$status</option>";
	}
	$select_of_statuses .= "</select>";
	// ! statuses processing

	echo"<tr>"; 
	echo'<td><input id="" type="date" disabled value="'.$enquiry['date'].'"></td>';
	echo'<td>'.$select_of_statuses.'</td>';
	echo"<td><a href='/client/".$enquiry['client_id']."' class=''>".$enquiry['client_name']."</a></td>";
	echo"<td>".$enquiry['address']."</td>";
	echo"<td>".$source."</td>";
	echo"<td>".$enquiry['comment']."</td>";
	// echo"<td style='text-align:center;'> <i style='color:red;' class=\"far fa-trash-alt\"></i> </td>";
	echo"<td style='text-align:center;'> <i style='color:green; font-size: 16px; cursor: pointer;'
		title='Принять в заказы' onclick=\"makeOrder(".$enquiry['id'].", ".$enquiry['client_id'].", '".$enquiry['address']."')\" class=\"fas fa-file-import\"></i> </td>";
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

function saveOption(node){
	current_enquiry.status_option_id = node.selectedIndex;
	console.log(current_enquiry.status_option_id);
}

function changeRole(node)
{
	let selected_index = node.selectedIndex;
	if (confirm("Изменить статуc?") == true) {
		alert("Изменили");
	} else {
		alert("Оставили как есть");
		node.selectedIndex = current_enquiry.status_option_id; 
	} 
	current_enquiry.status_option_id = '';
}

order_status.onchange=(e)=>{
	console.log(e.target.value);
	window.location.href = "/enquiry/sort/"+e.target.value;
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
