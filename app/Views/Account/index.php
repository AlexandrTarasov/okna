<div class="container" style="text-align:center;">
	<div class="col-sm"> </div>
	<div class="col-sm" style="width:300px; margin: 200px auto;">
		<div class="" style= "width:300px;">
			<img style= "width:300px;" src="<?=HTTPS_IMAGE?>logo.png" title="" id="logo_img" border="0">
		</div>
		<div class=""> <?=$err_message?> </div>
		<form action="/" method="POST" style="width: 300px; text-align: center;">
			<div class="form-group">
				<input type="text" name="mail" class="form-control" id="exampleInputEmail1" 
				aria-describedby="emailHelp" placeholder="Enter mail">
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
			</div>
			<button type="submit" class="btn btn-primary">IN</button>
		</form>
	</div>
	<div class="col-sm"> </div>
</div>
