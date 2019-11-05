    <style>
		#main-navbar {position: relative}  		
		.navbar-header, .navbar-brand {width: 100%} 	 	
	  	.navbar-logo{display: block; margin: 0 auto;}
	    .page-signin-container {
	      width: auto;
	      margin: 30px 10px;
	    }
	    .page-signin-container form {
	      border: 0;
	      box-shadow: 0 2px 2px rgba(0,0,0,.05), 0 1px 0 rgba(0,0,0,.05);
	    }
	    @media (min-width: 544px) {
	      .page-signin-container {
	        width: 350px;
	        margin: 60px auto;
	      }
	    }
	    .page-signin-social-btn {
	      width: 40px;
	      padding: 0;
	      line-height: 40px;
	      text-align: center;
	      border: none !important;
	    }
	    #page-signin-forgot-form { display: none; }
	</style>
    

	<? if($this->session->flashdata('login_error')): ?>
		<div class="alert alert-danger text-center">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<?= $this->session->flashdata('login_error'); ?>
		</div>
	<? elseif($this->session->flashdata('login_success')): ?>
		<div class="alert alert-success text-center">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<?= $this->session->flashdata('login_success'); ?>
		</div>
	<? endif; ?>

    <div class="page-signin-container" id="page-signin-form">
        <h2 class="m-t-0 m-b-4 text-xs-center font-weight-semibold font-size-20">Sign In</h2>

		<form  action="/atom/login" method="post" id="signin-form_id" class="panel p-a-4">
            <fieldset class=" form-group form-group-lg">
               <input type="text" name="username" id="username_id" class="form-control input-lg data" placeholder="username" required="">
            </fieldset>

            <fieldset class=" form-group form-group-lg">
                <input type="password" name="password" id="password_id" class="form-control input-lg data" placeholder="password" required="">
            </fieldset>
            
            <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Sign In</button>
            <div class="text-center" style="margin-top: 8px;">
                <a href="mailto:dev@perepelitsa.com.ua" class="font-size-12 text-muted" id="page-signin-forgot-link">Forgot your password?</a>
            </div>
        </form>
	    <div class="signin-developer text-center">
			<small>Created by <a href="//perepelitsa.com.ua">Perepelitsa</a> &copy; 2013-<?= date('Y') ?></small>
	    </div>
    </div>
