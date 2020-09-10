<style>
	.fa-comment-dots{font-size: 16px; color: brown;}
	.td-with-comment{background: hsl(65.7, 100%, 95.9%);}
	.roles-select{padding: 1px; font-size: 14px; height: 25px;}
	.role-admin-color{background:hsl(0, 100%, 90.6%);font-weight: bold;}
	.role-manager-color{background:hsl(120, 68.3%, 87.6%);}
	.role-dev-color{background:gray; font-weight: bold;}
	.role-installer-color{background:hsl(196.7, 95.6%, 91.2%);}
	.add_user{color: hsl(120, 32.5%, 49.4%);}
	.hidden{display:none;}
	.showed{display:block;}
</style>
<div class="card mb-4">
	<div class="card-header"><?=$title . ' / всего: ' .$total?> / <span class="add_user" data-toggle="modal" data-target="#add_user_modal"><i class="fas fa-user-plus"></i></span> </div>
	<div class="card-body" style="padding:0px;">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr style="background: 1px hsl(110.4, 100%, 95.1%);">
						<th>Юзер<i class="fas fa-sort"></i></th>
						<th>ФИО</th>
						<th>Роль</th>
						<th>Email</th>
						<th>Телефон</th>
						<th>Коммент</th>
						<th>Pass</th>
						<th style='text-align:center;'>Act</th>
					</tr>
				</thead>
				<tbody>
<?php


foreach($users as $user){
	$phone 	   = '';
	if( $user['phone'] !== NULL ){
		$user['phone'] = str_replace('38', '', $user['phone']);
		$phone .= '('.substr($user['phone'], 0, 3).')-';
		$phone .= substr($user['phone'], 3, 3).'-';
		$phone .= substr($user['phone'], -4, 2).'-'; 
		$phone .= substr($user['phone'], -2, 2); 
		$phone = '<a href="tel:'.$phone.'" class="">'.$phone.'</a>';
	}


	$role_css = '';
	if($user['role_id'] == 2)  $role_css =  'role-manager-color';
	if($user['role_id'] == 3)  $role_css =  'role-admin-color';
	if($user['role_id'] == 4)  $role_css =  'role-dev-color';
	if($user['role_id'] == 5)  $role_css =  'role-installer-color';

	$roles_select = '<select  id="'.$user['id'].'" class="custom-select  roles-select '.$role_css.'" onfocus="saveOption(this)" onchange="changeRole(this)">';
	foreach($roles as $role){
		$selected = ($role['id'] == $user['role_id']) ? ' selected ' : '';
		$roles_select .='<option value="'.$role['id'].'"' .$selected. '>'.$role['name'].'</option>';
	}
	$roles_select .= '</select>';
	// !- make select for role
	echo"<tr>"; 
	echo"<td>".$user['username']."</td>";
	echo"<td>".$user['name']."</td>";
	echo"<td>".$roles_select."</td>";
	echo"<td>".$user['email']."</td>";
	echo"<td>".$phone."</td>";
	echo"<td>".$user['comment']."</td>";
	echo"<td class='text-center'>
		<span class=\"showed\" onclick=\"changeView(this)\"><i class=\"far fa-eye\"></i></span>
		<span class=\"hidden\">".$user['pa_str']."</span></td>
	";
	// echo"<td class='text-center'><a href='#' onclick='showPass();' ><i class=\"far fa-eye\"></i></a></td>";
	echo"<td style='text-align:center;'><a href='#' onclick=\"userDel(".$user['id'].", this)\" class=\"\"><i style='color:red;' class=\"far fa-trash-alt\"></i></a></td>";
	echo"</tr>"; 
}
?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- modal add user -->
<div class="fade modal" tabindex="-1" role="dialog" id="add_user_modal" aria-hidden="true">
	<form  id="add_user_modal_form">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="fas fa-user-plus add_user"></i> Добавить пользователя</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="back_message_user_modal"></div>
			<div class="modal-body" id="add_user_modal_body">
				<div class="form-group" style="margin-bottom: 0rem;">
					<div class="form-row">
						<div class="col mb-2">
							<input type="text" name="username" class="form-control form-control-sm" id="" placeholder="Login">
						</div>
						<div class="col mb-2">
							<input type="email" name="email" class="form-control form-control-sm" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"  required id="" placeholder="Email">
						</div>
					</div>
					<div class="form-row">
						<div class="col mb-2">
							<input type="text" name="name" class="form-control form-control-sm" required id="" placeholder="ФИО">
						</div>
					</div>
					<div class="form-row">
						<div class="col mb-2">
							<div class="input-group input-group-sm">
								<input type="tel" name="phone" class="form-control"  required id="phone_user_form" placeholder="(000)-000-00-00" 
								pattern="\([0-9]{3}\)-[0-9]{3}-[0-9]{2}-[0-9]{2}">
								<div class="input-group-append ">
									<span class="input-group-text" title="viber_span" id="viber_installer_act_span"><i class="off fab fa-viber" title="viber_svg" id="viber_installer_i"></i></span>
								</div>
							</div>
						</div>
					</div>
					<textarea class="form-control  mb-2" id="" name="comment" placeholder="Комментарий" rows="2"></textarea>
					<hr>
					<div class="text-center" style="margin:-7px;">
						<button type="submit" class="btn btn-success">+</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	</form>
</div>
<!--//  -->


<script src="/assets/js/admin_sluice.js"></script>

<script>
let processing_role = {
	role_option_id : '',
}

function saveOption(node){
	processing_role.role_option_id = node.selectedIndex;
}

function changeRole(node)
{
	let selected_index = node.selectedIndex;
	var role_id = node.options[node.selectedIndex].value;
	let user_id = node.id;
	if (confirm("Изменить роль?") == true) {
		let res = goSluice(user_id, role_id, 'user_role_change');
		res.then(data => {
			data.text().then(function(text) {
				if( text == '1' ){
					// console.log(text)
				}
				console.log(text)
			})
		})
	} else {
		node.selectedIndex = processing_role.role_option_id; 
		processing_role.role_option_id = '';
	} 
}

/*user modal process */
let user_form = {
	viber : 0,
}
add_user_modal.onclick=(e)=>{
	let icon = clickOnViberIcon(e);
	if( typeof icon === 'object' ){
		if(user_form.viber == 0){
			changeViberState(icon, 'on');
			user_form.viber = 1;
		} else{
			changeViberState(icon, 'off');
			user_form.viber = 0;
		}
	}
}
phone_user_form.addEventListener("input", function(event){
	makePhoneNumber(event, phone_user_form);
});

add_user_modal_form.onsubmit = async (e) => {
	e.preventDefault();
	let formData = new FormData(add_user_modal_form);
	formData.append('viber_is', user_form.viber);
	formData.append('from_node', 'add_user_modal_form');
	let response = await fetch('/sluice', {
		method: 'POST',
		body: formData
	});
	response.text().then(function (text){
		var text_json = JSON.parse(text);
		if( text_json.rsp === '1' ){
			add_user_modal_body.innerHTML = '<div class="alert alert-info" role="alert">Юзер добавлен.</br> Пароль: '+text_json.pass+'</div></br><a href="/users" class="">обновить список</a> ';
		}else{
			back_message_user_modal.innerHTML = text_json;
		}
		console.log(text_json);
	});
}
	//


function userDel(user_id, node){
	var r = confirm("Удалить пользователя ?");
	if (r == true) {
		res = goSluice(user_id, '', 'del_user');
		res.then(data => {
			data.text().then(function(text) {
				if( text == '1' ){
					node.parentNode.parentNode.remove();
				}
				else{ console.log(text); }
			})
		});
	} else { } 
}

function changeView(node){
	if (node.nextElementSibling.style.display == 'block'){
		node.nextElementSibling.style.display="none";
	}else{
		node.nextElementSibling.style.display="block";
	}
}
</script>
