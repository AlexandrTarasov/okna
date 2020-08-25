<style>
	.w400{width:400px;}
	.w200{width:200px;}
	.w150{width:150px;}
	.fa-viber{font-size: 15px; color: hsl(286.9, 46%, 37.1%);}
	.fa-comment-dots{font-size: 16px; color: brown;}
	.td-with-comment{background: hsl(65.7, 100%, 95.9%);}
	.clr-grn{color:green;}
	.flt-rt{float:right;}
	.ptr{cursor:pointer;}
	.dsp-no{display:none;}
	.supplier_icon{color: hsl(205.7, 42%, 60.8%);}
</style>
<div class="card mb-4">
	<div class="card-header"> <i class="fas fa-briefcase supplier_icon"></i> <?=$title . ' / всего: ' .$total?></div>
	<div class="card-body" style="padding:0px;">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr style="background: 1px hsl(110.4, 100%, 95.1%);">
						<th>Company</th>
						<th class="w150">Manager</th>
						<th>Тел.</th>
						<th>Наша ID</th>
						<th>Коммент.</th>
					</tr>
				</thead>
				<tbody>
<?php
foreach($suppliers as $supplier){
	$viber_ico = '';
	$comment   = '';
	$ct    	   = '';

	$phone 	   = '';
	if( $supplier['manager_phone'] ){
		$supplier['manager_phone'] = str_replace('38', '', $supplier['manager_phone']);
		$phone .= '('.substr($supplier['manager_phone'], 0, 3).')-';
		$phone .= substr($supplier['manager_phone'], 3, 3).'-';
		$phone .= substr($supplier['manager_phone'], -4, 2).'-'; 
		$phone .= substr($supplier['manager_phone'], -2, 2); 
	}


	if( $supplier['viber_is'] ){
		$viber_ico="<i class=\"fab fa-viber\"></i>";
	}
	if( $supplier['comment'] ){
		$ct = 'class="td-with-comment"';
	}
	echo"<tr data-supl-id=".$supplier['id'].">"; 
	echo"<td ".$ct."><a href=\"/supplier/".$supplier['id']."\" class=>".$supplier['company_name']."</a>".$comment."</td>";
	echo"<td>".$supplier['manager_name']."</td>";
	echo'<td class="w150"><a href="tel:'.$phone.'">'.$phone.'</a> '.$viber_ico.'</td>';
	echo"<td>".$supplier['our_id_in_company']."</td>";
	echo"<td contenteditable='true' onclick='editNodeContent(this)' title='comment'
		onblur='resetNodeContent(this)'><div class='far fa-save clr-grn flt-rt ptr dsp-no' onclick='saveContent(this)'></div>".$supplier['comment']."</td>";
	echo"</tr>"; 
}
?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>

let ces = { //ces  = current_edited_supplier ;
	id : '',
	initial_content: '',
	title : '',
	content_to_save : '',
	switchVisable : function (node, state){
		node.childNodes[0].style.display = state;
	}
}

function editNodeContent(node){
	ces.initial_content = node.innerHTML;
	node.childNodes[0].style.display = 'inline';
	ces.switchVisable(node, 'inline');
	ces.id =  node.parentNode.getAttribute("data-supl-id");
	ces.title = node.title;
}

function resetNodeContent(node){
	node.innerHTML = ces.initial_content;
	ces.switchVisable(node, 'none');
	// node.childNodes[0].style.display = 'none';
	ces.title = '';
}

function saveContent(save_i_node){
	ces.content_to_save = save_i_node.ownerDocument.activeElement.innerText;
	console.log(ces.id);
}



</script>
