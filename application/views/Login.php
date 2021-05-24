<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>Khadim</title>
	

	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">

	<script src="assets/js/jquery-1.11.0.min.js"></script>
	
	
</head>
<body class="page-body login-page login-form-fall" data-url="http://neon.dev">


<!-- This is needed when you send requests via Ajax --><script type="text/javascript">
var baseurl = '';

<?php 
	if($this->session->userdata('testuser')){
?>
r = confirm("You are already LoggedIn,You want to logout from other ?");
if(r==true){
	window.location.href="<?php echo SURL."Login/setsession";?>"
}else{
	window.location.href="<?php echo SURL."Login/dessession";?>"
}
<?php

	}
?>
</script>

<style>
    .newdes,.newkey{
        color:white;
    }
</style>
<div class="login-container">
	
	<div class="login-header login-caret">
		
		<div class="login-content">
			
			<!--<a href="index.html" class="logo">-->
			<!--	<img src="assets/images/logo@2x.png" width="120" alt="" />-->
			<!--</a>-->
			
			<p class="description newdes">Dear user, log in to access the admin area!</p>
			
			<!-- progress bar indicator -->
			<div class="login-progressbar-indicator">
				<h3>43%</h3>
				<span>logging in...</span>
			</div>
		</div>
		
	</div>
	
	<div class="login-progressbar">
		<div></div>
	</div>
	
	<div class="login-form">
		
		<div class="login-content">
			<?php if(!empty($error)){ ?>
			
			<div class="form-login-error" style="display: block;">
				<h3>Invalid login</h3>
				<p><?php echo $error; ?></p>
			</div>

			<?php } ?>


			<?php if(!empty($this->session->flashdata('fail'))){ ?>
			
			<div class="form-login-error" style="display: block;">
				
				<p><?php echo $this->session->flashdata('fail'); ?></p>
			</div>

			<?php } ?>


			<?php 

			if(isset($signup)){ ?>

				<form method="post" role="form" id="form_login1" action="/Signup">
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
						
						<input type="text" class="form-control" name="ownername" id="ownername" placeholder="Enter Your Name" autocomplete="off" />
					</div>
					
				</div>
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>
						
						<input type="text" class="form-control" name="businessname" id="businessname" placeholder="Enter Your Business Name" autocomplete="off" />
					</div>
				
				</div>

				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>
						
						<input type="email" class="form-control" name="email" id="email" placeholder="Enter Your Email" autocomplete="off" />
					</div>
				
				</div>

				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>
						
						<input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" autocomplete="off" />
					</div>
				
				</div>

				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>
						
						<input type="password" class="form-control" name="re-password" id="password" placeholder="Re-Enter Your Password" autocomplete="off" />
					</div>
				
				</div>

				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>
						
						<input type="number" class="form-control" name="cell_no" id="cell_no" placeholder="Enter Your Phone No" autocomplete="off" />
					</div>
				
				</div>
				
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block btn-login" name="submit">
						<i class="entypo-login"></i>
						Sign Up
					</button>
				</div>
				<div class="form-group">
						Already Have Account? <a href="/Login">Login Now</a> 
					</button>
				</div>
				
				
				
							
			</form>



			<?php }else{

			 ?>
			
			<form method="post" role="form" id="form_login1" action="<?php echo SURL;?>Login">
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user newkey"></i>
						</div>
						
						<input type="email" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" />
					</div>
					
				</div>
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key newkey"></i>
						</div>
						
						<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
					</div>
				
				</div>
				
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block btn-login" name="submit">
						<i class="entypo-login"></i>
						Login In
					</button>
				</div>
				<!--<div class="form-group">-->
				<!--		Dont Have Account? <a href="/Signup">Sign Up Now</a> -->
				<!--	</button>-->
				<!--</div>-->
				
				
				
							
			</form>

		<?php } ?>
			
			
			<!-- <div class="login-bottom-links">
				
				<a href="extra-forgot-password.html" class="link">Forgot your password?</a>
				
				<br />
				
				<a href="#">ToS</a>  - <a href="#">Privacy Policy</a>
				
			</div> -->
			
		</div>
		
	</div>
	
</div>


	<!-- Bottom Scripts -->
	<script src="assets/js/gsap/main-gsap.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
	<script src="assets/js/jquery.validate.min.js"></script>
	<script src="assets/js/neon-login.js"></script>
	<script src="assets/js/neon-custom.js"></script>
	<script src="assets/js/neon-demo.js"></script>

</body>
</html>