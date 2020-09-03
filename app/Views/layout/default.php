<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<title><?=$title?></title>
        <link href="/assets/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
		<script src="/assets/js/phone_number_handler.js"></script>
<style>
	#dataTable{font-size: 13px;}
	.add{font-size: 26px; color: hsl(120, 83%, 79.2%);margin: -13px 0 -13px 10px;}
	div.nav a.nav-link:hover{border-right: 5px solid hsl(191.2, 45.1%, 53.5%);}
	a.nav-link{color: hsla(0, 0%, 98.8%, 0.59);}
	.sb-nav-link-icon svg{color: hsl(205.7, 42%, 60.8%);}
	.logo{height: 50px;}
	.add{cursor:pointer;width: 100%; text-align: right;}
	.form-control::placeholder { color: hsl(200, 2.1%, 71.6%);}
	.clr-red{color: hsl(0, 100%, 50%);}
	.form-row .col{min-width: 300px; }
</style>
    </head>
	<body class="sb-nav-fixed">
		<nav class="sb-topnav navbar navbar-expand navbar-light bg-light">
		<a class="navbar-brand" href="/orders"><img class="logo" src="<?=HTTPS_IMAGE?>logo.png"></a>
			<button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" id="" href="/users" role="button"  aria-haspopup="true" aria-expanded="false">
					<i class="far fa-id-card" title="users"></i>
					</a>
				</li>
				<li>
					<a class="nav-link" id="" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-cogs fa-fw"></i>
					</a>
				</li>
				<li>
					<a class="nav-link" id="" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-globe fa-fw"></i>
					</a>
				</li>
				<li>
					<a class="nav-link" id="" href="/logout" role="button" aria-haspopup="true" aria-expanded="false">
						<i title="log out" class="fas fa-sign-out-alt fa-fw"></i>
					</a>
				</li>
			</ul>
		</nav>
		<div id="layoutSidenav">
			<div id="layoutSidenav_nav">
				<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
					<div class="sb-sidenav-menu">
						<div class="nav">
							<a class="nav-link" href="/orders"><div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>Заказы</a>
							<a class="nav-link" href="/enquiry">
								<div class="sb-nav-link-icon"><i class="fas fa-funnel-dollar"></i> </div>Запросы
								<span class="add" id="request_span" data-toggle="modal"  data-target="#add_enquery_modal">+</span>
							</a>
							<a class="nav-link" href="/request_for_out">
								<div class="sb-nav-link-icon"><i class="fas fa-truck-moving"></i></div>Заявки на вывоз<?=$takeouts_badge_number?></a>
							<a class="nav-link" href="/clients"><div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>Клиенты
								<span class="add" id="clients_span" data-toggle="modal"  data-target="#add_client_modal">+</span></a>
							<a class="nav-link" href="/installers"><div class="sb-nav-link-icon"><i class="fas fa-people-carry"></i></div>Монтажники
								</a>
							<a class="nav-link" href="/suppliers"><div class="sb-nav-link-icon"><i class="fas fa-briefcase"></i></div>Поставщики
								<span class="add" id="suppliers_span" data-toggle="modal"  data-target="#add_supplier_modal">+</span></a>

							<!--div class="sb-sidenav-menu-heading">Interface</div>
							<a class="nav-link collapsed" href="#" data-toggle="collapse"data-target="#collapseLayouts" 
								aria-expanded="false" aria-controls="collapseLayouts">
								<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
								Layouts
								<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
							<div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
								<nav class="sb-sidenav-menu-nested nav">
									<a class="nav-link" href="">Static Navigation</a>
									<a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
								</nav>
							</div>
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages" ><div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div> Pages
								<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
							<div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
								<nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
									<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">Authentication <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
									<div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
										<nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="login.html">Login</a><a class="nav-link" href="register.html">Register</a><a class="nav-link" href="password.html">Forgot Password</a></nav>
									</div>
									<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">Error <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
									<div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
										<nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="401.html">401 Page</a><a class="nav-link" href="404.html">404 Page</a><a class="nav-link" href="500.html">500 Page</a></nav>
									</div>
								</nav>
							</div-->
						</div>
					</div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        admin
                    </div>
                </nav>
            </div>
			<div id="layoutSidenav_content">
				<main>
					<div class="container-fluid">
<?=$content?>
					</div>
				</main>
				<footer class="py-4 bg-light mt-auto">
					<div class="container-fluid"> </div>
				</footer>
			</div>
       </div>
<!-- modal add enquery -->
<style>
	/*works only for modals below */
	.fa-viber{font-size:19px;}
	.off{color: hsl(282.9, 3.3%, 57.8%);}
</style>
<div class="fade bd-example-modal-lg modal" tabindex="-1" role="dialog" 
	id="add_enquery_modal" aria-hidden="true">
	<form id="add_enquiry_modal_form">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"> <i class="fas fa-funnel-dollar clr-red"></i> </i>Добавить запрос</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="back_message_enquery_modal"></div>
			<div class="modal-body" id="add_enquery_modal_body">
				<div class="form-group" style="margin-bottom: 0rem;">
					<div class="form-row">
						<div class="col mb-2">
							<input type="text" name="fio" required class="form-control form-control-sm" id="" placeholder="ФИО">
							<input id="client_id_input" name="client_id" hidden value="">
						</div>
						<div class="col mb-2">
							<input type="email" name="email" class="form-control form-control-sm" id="" placeholder="Email">
						</div>
					</div>
					<div class="form-row">
						<div class="col mb-2">
							<div class="input-group input-group-sm">
								<input type="tel" required class="form-control" name="phone_1" id="phone_1_enquery_form" 
									title="tel 1" placeholder="000-000-00-00"  pattern="\([0-9]{3}\)-[0-9]{3}-[0-9]{2}-[0-9]{2}">
								<div class="input-group-append">
									<span class="input-group-text" title="viber_span" 
										style="z-index:100;" ><i title="viber_svg" id="enquery_viber" class="off fab fa-viber"></i></span>
								</div>
							</div>
						</div>

						<div class="col mb-2">
							<input type="tel" class="form-control form-control-sm"  name="phone_2"  title="tel 2" placeholder="(000)-000-00-00" 
							id="phone_2_enquery_form"  pattern="\([0-9]{3}\)-[0-9]{3}-[0-9]{2}-[0-9]{2}" value="">
						</div>
					</div>
					<div class="form-row">
						<div class="col mb-2">
							<input type="text" class="form-control form-control-sm" name="address" id="" placeholder="Адрес установки">
						</div>
						<div class="col mb-2">
							<select class="form-control form-control-sm" name="status">
								<option value="new">Новаый запрос</option>
								<option value="processing">В обработке</option>
								<option value="accepted">Принят</option>
								<option value="canceled">Отменён</option>
							</select>
						</div>
					</div>
					<textarea class="form-control mb-2" id=""  placeholder="Комментарий" name="comment" rows="2"></textarea>

					<div class="form-row">
						<div class="col mb-1">
							<select class="form-control form-control-sm"  name="source">
								<option value="call">Звонок</option>
								<option value="adwords">Adwords</option>
								<option value="facebook">FB</option>
								<option value="instagram">Instagram</option>
								<option value="recommendation">Рекомендация</option>
								<option value="youtube">Youtube</option>
							</select>
						</div>
						<!--div class="col mb-2">
							<input type="date" class="form-control form-control-sm" name="date" id="order_date_inp" value="" >
						</div-->
					</div>
					<hr>
					<div class="text-center" style="margin:-7px;">
						<button type="submit" id="add_request_button" class="btn btn-success">+</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	</form>
</div>
<!--// modal for requests -->

<!-- modal add client -->
<div class="fade bd-example-modal-lg modal" tabindex="-1" role="dialog" id="add_client_modal" aria-hidden="true">
	<form id="add_client_modal_form">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="fas fa-users clr-red"></i> Добавить клиента</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="back_message_client_modal"></div>
			<div class="modal-body" id="add_client_modal_body">
				<div class="form-group" style="margin-bottom: 0rem;">
					<div class="form-row">
						<div class="col mb-2">
							<input type="text" name="fio" required class="form-control form-control-sm" id="" placeholder="ФИО">
						</div>
						<div class="col mb-2">
							<input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="email" class="form-control form-control-sm" id="" placeholder="Email">
						</div>
					</div>
					<div class="form-row">
						<div class="col mb-2">
							<div class="input-group input-group-sm">
								<input type="tel" required class="form-control" name="phone_1" id="phone_1_client_form" placeholder="(000)-000-00-00"  pattern="\([0-9]{3}\)-[0-9]{3}-[0-9]{2}-[0-9]{2}">
								<div class="input-group-append ">
									<span class="input-group-text" title="viber_span" id="viber_client_act_span"><i class="off fab fa-viber" title="viber_svg" id="viber_client_i"></i></span>
								</div>
							</div>
						</div>

						<div class="col mb-2">
							<input type="tel" class="form-control form-control-sm"  name="phone_2"  pattern="\([0-9]{3}\)-[0-9]{3}-[0-9]{2}-[0-9]{2}" 
							id="phone_2_client_form" placeholder="(000)-000-00-00">
						</div>
					</div>
					<div class="form-row">
						<div class="col mb-2">
							<input type="text" class="form-control form-control-sm" name="address" id="" placeholder="Адрес клиента">
						</div>

					</div>
					<textarea class="form-control mb-2" id="" name="comment"  placeholder="Комментарий" rows="2"></textarea>

					<div class="form-row">
						<div class="col mb-1">

						</div>
						<div class="col mb-2">
						</div>
					</div>
					<hr>
					<div class="text-center" style="margin:-7px;">
						<button type="submit" id="add_client_button"class="btn btn-success">+</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	</form>
</div>
<!--// end modal for client -->

<!-- modal add supplier -->
<div class="fade modal" tabindex="-1" role="dialog" id="add_supplier_modal" aria-hidden="true">
	<form  id="add_supplier_modal_form">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="fas fa-briefcase clr-red"></i> Добавить поставщика</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="back_message_supplier_modal"></div>
			<div class="modal-body" id="add_supplier_modal_body">
				<div class="form-group" style="margin-bottom: 0rem;">
					<div class="form-row">
						<div class="col mb-2">
							<input type="text" required name="company_name" class="form-control form-control-sm" id="" placeholder="Название компании">
						</div>
						<div class="col mb-2">
							<input type="text" name="address"class="form-control form-control-sm" id="" placeholder="Адрес компании">
						</div>
					</div>
					<div class="form-row">
						<div class="col mb-2">
							<input type="text" name="manager_name" class="form-control form-control-sm" id="" placeholder="Имя менеджера">
						</div>
						<div class="col mb-2">
							<input type="email" name="manager_email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"  class="form-control form-control-sm" id="" placeholder="Мэйл менеджера">
						</div>
					</div>
					<div class="form-row">
						<div class="col mb-2">
							<div class="input-group input-group-sm">
								<input type="tel" class="form-control" name="manager_phone" required id="phone_1_supplier_form" placeholder="(000)-000-00-00"  pattern="\([0-9]{3}\)-[0-9]{3}-[0-9]{2}-[0-9]{2}">
								<div class="input-group-append ">
									<span class="input-group-text" title="viber_span" id="viber_supplier_act_span"><i class="off fab fa-viber" title="viber_svg" id="viber_supplier_i"></i></span>
								</div>
							</div>
						</div>
					</div>
					<textarea class="form-control mb-2" id=""  name="comment"  placeholder="Комментарий" rows="2"></textarea>

					<hr>
					<div class="text-center" style="margin:-7px;">
						<button type="submit" class="btn btn-success">+</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<form>
</div>
<!--// end modal for supplier -->



        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="/assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="/assets/js/scripts.js"></script>
        <script src="/assets/js/add_data_from_modals.js"></script>
        <!-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script> -->
        <!-- <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script> -->
        <!-- <script src="files/demo/datatables&#45;demo.js"></script> -->
		<!-- taken from https://blackrockdigital.github.io/startbootstrap&#45;sb&#45;admin/dist/index.html -->
<script>
request_span.onclick=(e)=>{
	e.preventDefault()
}
clients_span.onclick=(e)=>{
	e.preventDefault()
}

suppliers_span.onclick=(e)=>{
	e.preventDefault()
}

window.onload = function (){
	let month = [ '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
	var today = new Date();
	var date = today.getFullYear()+'-'+month[today.getMonth()]+'-'+today.getDate();
	// order_date_inp.value = date;
	// $('#addRequestModal').modal('show');
}




/*enquery modal process */
let enquery_form = {
	viber : 0,
}
add_enquery_modal.onclick=(e)=>{

	let icon = clickOnViberIcon(e);
	if( typeof icon === 'object' ){
		if(enquery_form.viber == 0){
			changeViberState(icon, 'on');
			// viber_i.style.color ='purple';
			enquery_form.viber = 1;
		} else{
			changeViberState(icon, 'off');
			// viber_i.style.color ='grey';
			enquery_form.viber = 0;
		}
	}
}
phone_1_enquery_form.addEventListener("input", function(event){
	makePhoneNumber(event, phone_1_enquery_form);
	let clean_number = event.target.value.replace(/\(|\)|\-|_/gi, '');
	if( clean_number.length == 10 ){
		checkPhoneExistance(clean_number, 'enquery_phone_exists'); 
	}
});
phone_2_enquery_form.addEventListener("input", function(event){
	makePhoneNumber(event, phone_2_enquery_form);
});
/* -- */

/*client modal process */
let client_form = {
	viber : 0,
}
add_client_modal.onclick=(e)=>{
	let icon = clickOnViberIcon(e);
	if( typeof icon === 'object' ){
		if(client_form.viber == 0){
			changeViberState(icon, 'on');
			client_form.viber = 1;
		} else{
			changeViberState(icon, 'off');
			client_form.viber = 0;
		}
	}
}
phone_1_client_form.addEventListener("input", function(event){
	makePhoneNumber(event, phone_1_client_form);
	let clean_number = event.target.value.replace(/\(|\)|\-|_/gi, '');
	if( clean_number.length == 10 ){
		checkPhoneExistance(clean_number, 'client_phone_exists'); 
	}
});
phone_2_client_form.addEventListener("input", function(event){
	makePhoneNumber(event, phone_2_client_form);
});
/* -- */


/*supplier modal process*/
let supplier_form = {
	viber : 0,
}
add_supplier_modal.onclick=(e)=>{
	let icon = clickOnViberIcon(e);
	if( typeof icon === 'object' ){
		if(supplier_form.viber == 0){
			changeViberState(icon, 'on');
			supplier_form.viber = 1;
		} else{
			changeViberState(icon, 'off');
			supplier_form.viber = 0;
		}
	}
}
phone_1_supplier_form.addEventListener("input", function(event){
	makePhoneNumber(event, phone_1_supplier_form);
});

/*---*/
function clickOnViberIcon(e){
	if(  e.target.title == "viber_span" ){
		return e.target.childNodes[0];
	} else if(  e.target.textContent == "viber_svg" ){
		return  e.target;
	} else if(  e.target.nodeName == "path" ){
		return e.target.parentNode;
	} else	{ return false; }
}

function changeViberState(obj, action){
	if( action == 'on' ){
		obj.style.color ='purple';
	}
	if( action == 'off' ){
		obj.style.color ='gray';
	}
}


</script>
    </body>
</html>
