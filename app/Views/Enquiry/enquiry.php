<link href="/assets/css/lead_styles.css" rel="stylesheet" />
<style>
	.enquery_id_block{ width: 100px; float: right; text-align: center; margin: 0 3px 0 3px;
		background: hsl(204.8, 100%, 87.6%); border-radius: 4px; font-weight: bold;
	}
	.enquery_info_item{padding:4px;}
	.row{margin:unset;}
	.enquery_info_item_name{margin: auto; border-bottom: 1px solid hsl(0, 0%, 93.3%);}
	.card{margin:5px;min-width:350px;}
	.table { font-size: 13px;}
	.table th, .table td{padding: 0.35rem;}
	.col-5{min-width:340px;}
	.viber_on{color:purple;}
	.viber_off{color:gray;}
	.form-control { transition: background 1s; }
	.marg-center{margin: 0 auto;}
	.del-buttom{float: right;
		background: hsl(0, 100%, 80.2%);
		padding: 0 5px 0 5px;
		border-radius: 3px;
		border: 1px solid red;
		height: 24px;
		margin-left: 10px;
		color: hsl(236.3, 33.3%, 9.4%);
		cursor:pointer;
	}
	.fa-funnel-dollar{color: hsl(205.7, 42%, 60.8%);}
</style>
<?php
$sources_options = '<select class="custom-select source-'.$enquery['source'].'"  onchange="changeSource(this)">';
foreach($sources as $source){
	$selected_source = ( $source == $enquery['source'] ) ? 'selected' : '';
	$sources_options .='<option value="'.$source.'" '.$selected_source.'>'.$source.'</option>';
}
$sources_options .= '</select>';

$status_options = '<select class="custom-select status-'.$enquery['status'].'" onchange="changeStatus(this)">';
foreach($statuses as $status){
	$selected = ( $status == $enquery['status'] ) ? 'selected' : ''; 
	$status_options .='<option value="'.$status.'" '.$selected.'>'.$status.'</option>';
}
$status_options .= '</select>';

?>
<div class="row">
	<div class="col-6 p-0">
		<div class="card">
			<div class="card-header"><i class="fas fa-funnel-dollar"></i> <?=$title?>
				<div class="del-buttom" id="" onclick=\"del(".$enquiry['id'].")\" title="удалить лид">X</div>
				<div class="enquery_id_block" id=""><?=$enquery['date']?></div>
				<div class="enquery_id_block" id=""> ID <?=$enquery['id']?> </div>
				<input class="form-control" id="lead_id" hidden value="<?=$enquery['id']?>">
			</div>
			<div class="card-body p-1" style="padding:0px;">
				<div class="row">
					<div class="col-3 enquery_info_item_name"> ФИО </div> 
					<div class="col enquery_info_item">
						<input class="form-control" id=""  value="<?=$enquery['client_name']?>"> 
					</div>
				</div>
				<div class="row">
					<div class="col-3 enquery_info_item_name"> Адрес </div> <div class="col enquery_info_item">
						<input class="form-control" id=""  value="<?=$enquery['address']?>"> 
					</div>
				</div>
				<div class="row">
					<div class="col-3 enquery_info_item_name"> Ресурс </div> <div class="col enquery_info_item">
						<!-- <input class="form&#45;control" id=""  value="<?=$enquery['source']?>">  -->
						<?=$sources_options?>
					</div>
				</div>
				<div class="row">
					<div class="col-3 enquery_info_item_name">Статус</div> <div class="col enquery_info_item">
						<!-- <input class="form&#45;control" id=""  value="<?=$enquery['status']?>">  -->
						<?=$status_options?>
					</div>
				</div>
				<div class="row">
					<div class="col-3 enquery_info_item_name"> Коммент.</div> <div class="col enquery_info_item">
						<textarea class="form-control" style="width: 100%;" id="comment_input"><?=$enquery['comment']?></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="/assets/js/admin_sluice.js"></script>


<script>
function del(id)
{
	let res = goSluice(id, '', 'lead_delete');
	res.then(data => {
		data.text().then(function(text) {
			if( text == '1' ){
				document.getElementById(id).style.display = 'none';
			}
			console.log(text)
		})
	})
}	
function changeStatus(node)
{
	let new_status = node.options[node.selectedIndex];
	console.log(lead_id);
	if (confirm("Изменить статуc?") == true) {
		let res = goSluice(lead_id.value, new_status.value,'lead_update_status');
		res.then(data => {
			data.text().then(function(text) {
				if( text == '1' ){
					// location.reload();
				}
				console.log(text)
			})
		})
	} else {
		// node.selectedIndex = current_enquiry.status_option_id; 
	} 
}
</script>
