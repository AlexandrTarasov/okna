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

$disabled = ($enquery['status'] === 'accepted') ? 'disabled' : '';

?>

<?php if( !empty($message )){ ?>
	<div class="alert alert-<?=$message['type']?>" role="alert">  <?=$message['text']?> </div>
<?php } ?>
<?php if( $enquery ){ ?>
<div class="row">
	<div class="col-6 p-0">
		<div class="card">
			<div class="card-header"><i class="fas fa-funnel-dollar"></i> <?=$title?>
<?php if( $_SESSION["user_role"] === '3'){ ?>
				<div class="del-buttom" id=""  onclick="del(<?=$enquery['id']?>)" title="удалить лид">X</div>
<?php  } ?>
				<div class="enquery_id_block" id=""><?=$enquery['date']?></div>
				<div class="enquery_id_block" id=""> ID <?=$enquery['id']?> </div>
				<input class="form-control" id="lead_id" hidden value="<?=$enquery['id']?>">
			</div>
			<div class="card-body p-1" id="cart_body" style="padding:0px;">
				<div class="row">
					<div class="col-3 enquery_info_item_name"> ФИО </div> 
					<div class="col enquery_info_item"><a href="/client/<?=$enquery['client_id']?>" class=""><?=$enquery['client_name']?></a></div>
				</div>
				<div class="row">
					<div class="col-3 enquery_info_item_name"> Адрес </div> <div class="col enquery_info_item">
						<input class="form-control" id="address_input"  value="<?=$enquery['address']?>"> 
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
				Предварительные расчёты
				<div class="row">
					<div class="col-3 enquery_info_item_name"> расчёт №1 </div> <div class="col enquery_info_item">
						<input class="form-control" id="advance_calculation_1"  value="<?=$enquery['advance_calculation1']?>"> 
					</div>
				</div>
				<div class="row">
					<div class="col-3 enquery_info_item_name"> расчёт №1 </div> <div class="col enquery_info_item">
						<input class="form-control" id="advance_calculation_2"  value="<?=$enquery['advance_calculation2']?>"> 
					</div>
				</div>
				<div class="row">
					<div class="col-3 enquery_info_item_name"> расчёт №1 </div> <div class="col enquery_info_item">
						<input class="form-control" id="advance_calculation_3"  value="<?=$enquery['advance_calculation3']?>"> 
					</div>
				</div>
				<div class="row">
					<div class="col-6 text-center">
						<button type="button" class="btn btn-warning">ЗАЯВКА НА ЗАМЕР</button>
					</div>
					<div class="col-6 text-center">
					<button type="button" <?=$disabled?> onclick="makeOrder(<?=$enquery['id']?>, <?=$enquery['client_id']?>,'<?=$enquery['address']?>')" class="btn btn-success">&#160;&#160;&#160;&#160;&#160;В ЗАКАЗЫ&#160;&#160;&#160;&#160;&#160;</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="/assets/js/admin_sluice.js"></script>
<script src="/assets/js/lead_edit_hendler.js"></script>

<?php } ?>
	<script>
	 
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
