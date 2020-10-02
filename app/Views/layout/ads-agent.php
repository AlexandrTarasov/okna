
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
/* up botton */
	.back_to_top { position: fixed; bottom: 50px; right: 20px; z-index: 9999; width: 30px; 
		height: 30px; text-align: center; line-height: 30px; background: #f5f5f5;
		color: #444; cursor: pointer; z-index: 8; border-radius: 25px; display: none; border: 1px solid hsl(0, 1.2%, 67.5%);}
	.back_to_top:hover { background: #e9ebec; }
	.back_to_top-show { display: block; }
	.client_serch_dropdown{border: 1px solid hsl(0, 6%, 77.1%); margin-bottom: 10px; margin-top: -6px;}
/* up button end */
</style>
    </head>
	<body class="sb-nav-fixed">
		<nav class="sb-topnav navbar navbar-expand navbar-light bg-light">
		<a class="navbar-brand" href="/orders"><img class="logo" src="<?=HTTPS_IMAGE?>logo.png"></a>
			<button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

			<ul class="navbar-nav ml-auto">
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
							<a class="nav-link" href="/ads_agent/">
								<div class="sb-nav-link-icon"><i class="fas fa-funnel-dollar"></i> </div>Лиды
								<!-- <span class="add" id="request_span" data&#45;toggle="modal"  data&#45;target="#add_enquery_modal">+</span> -->
							</a>
						</div>
					</div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Вы вошли как:</div>
<?=$user_role?>
                    </div>
                </nav>
            </div>
			<div id="layoutSidenav_content">
				<main>
					<div class="container-fluid">
<?=$content?>
					</div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="/assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="/assets/js/scripts.js"></script>
    </body>
</html>
