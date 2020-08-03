<style>
	.fa-comment-dots{font-size: 16px; color: brown;}
	.td-with-comment{background: hsl(65.7, 100%, 95.9%);}
	.roles-select{border: 1px solid gray; padding: 2px;}
	.role-admin-color{color:blue;font-weight: bold;}
	.role-manager-color{color:green;}
	.role-dev-color{color:red; font-weight: bold;}
</style>
<div class="card mb-4">
	<div class="card-header"><?=$title . ' / всего: ' .$total?></div>
	<div class="card-body" style="padding:0px;">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr style="background: 1px hsl(110.4, 100%, 95.1%);">
						<th>User name<i class="fas fa-sort"></i></th>
						<th>Роль</i></th>
						<th>Email</i></th>
						<th style='text-align:center;'>Act</th>
					</tr>
				</thead>
				<tbody>
<?php


foreach($users as $user){
	//make select for role
	$role_css = '';
	if($user['role_id'] == 2)  $role_css =  'role-manager-color';
	if($user['role_id'] == 3) $role_css =  'role-admin-color';
	if($user['role_id'] == 4)  $role_css =  'role-dev-color';
	$roles_select = '<select class="roles-select '.$role_css.'" onfocus="saveOption(this)" onchange="changeRole(this)">';
	foreach($roles as $role){
		$selected = ($role['id'] == $user['role_id']) ? ' selected ' : '';
		$roles_select .='<option value="'.$role['id'].'"' .$selected. '>'.$role['name'].'</option>';
	}
	$roles_select .= '</select>';
	// !- make select for role
	echo"<tr>"; 
	echo"<td>".$user['username']."</td>";
	// echo"<td>".$user['role_id']."</td>";
	echo"<td>".$roles_select."</td>";
	echo"<td>".$user['email']."</td>";
	echo"<td style='text-align:center;'><i title='this is button for edition bro' style='color:blue;' class=\"far fa-edit\"></i> | <i style='color:red;' class=\"far fa-trash-alt\"></i> </td>";
	echo"</tr>"; 
}
?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- modal add installer -->
<div class="fade modal" tabindex="-1" role="dialog" id="add_installer_modal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="fas fa-people-carry clr-red"></i> Добавить монтажника</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group" style="margin-bottom: 0rem;">
					<div class="form-row">
						<div class="col mb-2">
							<input type="email" class="form-control form-control-sm" id="" placeholder="Email">
						</div>
						<div class="col mb-2">
							<input type="text" class="form-control form-control-sm" id="" placeholder="Password">
						</div>
					</div>
					<div class="form-row">
						<div class="col mb-2">
							<input type="text"  class="form-control form-control-sm" id="" placeholder="ФИО">
						</div>
					</div>
					<div class="form-row">
						<div class="col mb-2">
							<div class="input-group input-group-sm">
								<input type="tel" class="form-control" id="" placeholder="Тел 1">
								<div class="input-group-append ">
									<span class="input-group-text" title="viber_span" id="viber_installer_act_span"><i class="off fab fa-viber" title="viber_svg" id="viber_installer_i"></i></span>
								</div>
							</div>
						</div>

						<div class="col mb-2">
							<input type="tel" class="form-control form-control-sm" id="" placeholder="Тел 2">
						</div>
					</div>
					<div class="form-row">
						<div class="col mb-2">
							<input type="text" class="form-control form-control-sm" id="" placeholder="Адрес">
						</div>

					</div>
					<textarea class="form-control mb-2" id=""  placeholder="Комментарий" rows="2"></textarea>

					<div class="form-row">
						<div class="col mb-1">

						</div>
						<div class="col mb-2">
						</div>
					</div>
					<hr>
					<div class="text-center" style="margin:-7px;">
						<button type="submit" class="btn btn-success">+</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--// end modal for installers -->

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
		if (confirm("Изменить роль?") == true) {
			alert("Изменили");
		} else {
			node.selectedIndex = processing_role.role_option_id; 
		processing_role.role_option_id = '';
		} 
	}
</script>
