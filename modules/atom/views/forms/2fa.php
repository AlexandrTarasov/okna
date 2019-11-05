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
	
	<div class="page-signin-container" id="page-signin-form">
        <h2 class="m-t-0 m-b-4 text-xs-center font-weight-semibold font-size-20">Two factor authentication</h2>

		<form action="/atom/two_step_auth" method="post" id="signin-form_id" class="panel p-a-4">
	        <div class="form-group">
	            <label for="inputPassword">Your code from Authenticator:</label>
	            <input name="code" class="form-control" autocomplete="off" pattern="\d*" placeholder="" />
	        </div>
			            
            <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Sign In</button>
            <div class="text-center" style="margin-top: 8px;">
                <a href="mailto:dev@perepelitsa.com.ua" class="font-size-12 text-muted" id="page-signin-forgot-link">Don't know code?</a>
            </div>
        </form>
	    <div class="signin-developer text-center">
			<small>Created by <a href="//perepelitsa.com.ua">Perepelitsa</a> &copy; 2013-<?= date('Y') ?></small>
	    </div>
    </div>

