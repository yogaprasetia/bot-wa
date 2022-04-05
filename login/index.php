<!DOCTYPE html>
<?php require_once ('../konfig.php') ;

?>  

<script>  
 function register()  {
  // validasi
	if ( $("#newemail").val()==''){
		toastr.error("Enter your Email...!");
		$('#newemail').focus();
		return false;
	}
	if ($("#newuser").val()==''){
		toastr.error("Enter User Name...!");
		$('#newuser').focus();
		return false;
	}
	if ($("#wa_no").val()==''){
		toastr.error("Enter WA Number...!");
		$('#wa_no').focus();
		return false;
	}	

  $.ajax({
	url: "register.php?email=" + $("#newemail").val() + "&user=" + $("#newuser").val() +  "&wa=" + $("#wa_no").val() ,  
	beforeSend: function() {
		$("#spinner").html('<img src="../wg_files/loader.gif"  alt="Loading">');
	},
	complete: function() {
		$("#spinner").html('');
	},		
	success: function(data){ 	
		$("#spinner").html('');	
		alert (data) ;
		location.reload() ;
	}         
	});       
 }  
 
 
 function forget()  {
  $.ajax({
	url: "forget.php?email=" + $("#email").val() ,  
	beforeSend: function() {
		$("#spinner").html('<img src="../wg_files/loader.gif"  alt="Loading">');
	},
	complete: function() {
		$("#spinner").html('');
	},		
	success: function(data){ 
		alert (data) ;
		location.reload() ;
	}         
	});       
 }  
</script> 

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<title><?echo $appname ?> | WebApp</title>
		<META content="WA-GW | WhatsApp GateWay" property="og:title"> 
		<META content="http://wa-gw.com/files/logo.png" property="og:image">    		
		<link rel="shortcut icon" href="../logo.ico"> 
		<meta name="description" content="User login page">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="./files/bootstrap.css">
		<link rel="stylesheet" href="./files/font-awesome.css">

		<!-- text fonts -->
		<link rel="stylesheet" href="./files/ace-fonts.css">

		<!-- ace styles -->
		<link rel="stylesheet" href="./files/ace.css">

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="../assets/css/ace-part2.css" />
		<![endif]-->
		<link rel="stylesheet" href="./files/ace-rtl.css">

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.css" />
		<![endif]-->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="../assets/js/html5shiv.js"></script>
		<script src="../assets/js/respond.js"></script>
		<![endif]-->
		<link rel="stylesheet" href="./files/toastr.css">
		<script src="./files/jQuery-2.1.3.min.js.download"></script>
		<script src="./files/toastr.js.download" type="text/javascript"></script>
		<script>
		
		toastr.options = {
		  "closeButton": true,
		  "debug": false,
		  "progressBar": false,
		  "positionClass": "toast-bottom-center",
		  "onclick": null,
		  "showDuration": "1000",
		  "hideDuration": "1000",
		  "timeOut": "2500",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		}
	</script>
	 <style>
		.spinner {
			position: fixed;
			top: 50%;
			left: 50%;
			margin-left: -50px; /* half width of the spinner gif */
			margin-top: -50px; /* half height of the spinner gif */
			text-align:center;
			z-index:1234;
			overflow: auto;
			width: 100px; /* width of the spinner gif */
			height: 102px; /*hight of the spinner gif +2px to fix IE8 issue */
		}
		
	</style> 
	</head>

	<body class="login-layout blur-login">
		<div id="spinner" class="spinner">		
		 		 
		</div>
			
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="pull-left" style="padding-top:10px;">
						
					</div>
				
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h3>
									 
									<span class="red">WhatsApp</span>
									<span class="white" id="id-text2"> GateWay</span>
								</h3>
								<h4 class="light-blue" id="id-company-text">WebApp</h4>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-lock green"></i>
												Enter User and Password
											</h4>

											<div class="space-6"></div>
											<form id="formLogin" action="">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input  autocomplete="off" type="text" id="username" name="username" class="form-control" placeholder="Username" value="">
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input  autocomplete="off" type="password" id="userpass" name="userpass" class="form-control" placeholder="Password" value="">
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														 
														<button type="button" id="login" name="login" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Login</span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>

											<div class="social-or-login center">
												
											</div>

											<div class="space-6"></div>

											<div class="social-login center">
												
											</div>
										</div><!-- /.widget-main -->
								<div class="toolbar clearfix">
										<? if ($multi == 'yes') { ?>	
											<div>
												 <a href="#" data-target="#forgot-box" class="user-signup-link" style="color:#ccc;">
												 <i class="ace-icon fa fa-arrow-left"></i>
													Forgot Password													
												</a> 
												
											</div>
 
										  
											<div>
												 <a href="#" data-target="#signup-box" class="user-signup-link">
													I want to register
													<i class="ace-icon fa fa-arrow-right"></i>
												</a> 
												
											</div>
										<? } ?>	
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->

								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="ace-icon fa fa-key"></i>
												Retrieve Password
											</h4>

											<div class="space-6"></div>
											<p>
												Enter your email and to receive instructions
											</p>

											<form id="formLupa">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" id="email" name="email" class="form-control" placeholder="Email">
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>

													<div class="clearfix">
														<button type="button" onclick="forget()"  id="btnlupa" class="width-35 pull-right btn btn-sm btn-danger">
															<i class="ace-icon fa fa-lightbulb-o"></i>
															<span class="bigger-110">Send Me!</span>
														</button>
													</div>
												</fieldset>
											</form>
										</div><!-- /.widget-main -->

										<div class="toolbar center">
											<a href="//#" data-target="#login-box" class="back-to-login-link" id="balik">
												Back to login
												<i class="ace-icon fa fa-arrow-right"></i>
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.forgot-box -->

								<div id="signup-box" class="signup-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header green lighter bigger">
												<i class="ace-icon fa fa-users blue"></i>
												New User Registration
											</h4>

											<div class="space-6"></div>
											<p> Enter your details to begin: </p>

											<form id="formRegister">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input  autocomplete="off" type="email" id="newemail" name="newemail" class="form-control" placeholder="Email">
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input  autocomplete="off" type="text" id="newuser" name="newuser" class="form-control" placeholder="Username">
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>
													
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input  autocomplete="off" type="text" id="wa_no" name="wa_no" class="form-control" placeholder="WhatsApp Number with Country Code">
															<i class="ace-icon fa fa-phone"></i>
														</span>
													</label>													

<!--
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Password">
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Repeat password">
															<i class="ace-icon fa fa-retweet"></i>
														</span>
													</label>
 -->
													<div class="space-24"></div>

													<div class="clearfix">
														<button type="reset" class="width-30 pull-left btn btn-sm">
															<i class="ace-icon fa fa-refresh"></i>
															<span class="bigger-110">Reset</span>
														</button>

														<button type="button" onclick="register()"  class="width-65 pull-right btn btn-sm btn-success">
															<span class="bigger-110">Register</span>

															<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
														</button>
													</div>
												</fieldset>
											</form>
										</div>

										<div class="toolbar center">
											<a href="//#" data-target="#login-box" class="back-to-login-link">
												<i class="ace-icon fa fa-arrow-left"></i>
												Back to login
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.signup-box -->
							</div><!-- /.position-relative -->
							
							<!--
							<div class="navbar-fixed-top align-right">
								<br>
								&nbsp;
								<a id="btn-login-dark" href="//#">Dark</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-blur" href="//#">Blur</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-light" href="//#">Light</a>
								&nbsp; &nbsp; &nbsp;
							</div>
							-->
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->
		<div id="spinner" class="spinner" style="display:none;">
			<img id="img-spinner" src="./files/loading.gif" alt="Loading">
		</div>

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='../js/jquery.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='../assets/js/jquery1x.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#username').focus();
				var ajaxurl='../';
				$("#login").click(function(){
						var uname	=document.getElementById("username").value;
						var pwd		=document.getElementById("userpass").value;
						
						if (uname==''){
							toastr.error("Fill your username...!");
							$('#username').focus();
							return false;
						}
						if (pwd==''){
							toastr.error("Enter your password...!");
							$('#userpass').focus();
							return false;
						}
						$('#formLogin').submit();
				
					
				});
				$('#formLogin').submit(function(e){
					 
					e.preventDefault();
					var myform = $('#formLogin');
							var disabled = myform.find(':input:disabled').removeAttr('disabled');
							var querystring =  myform.serialize();
							disabled.attr('disabled','disabled');						
							$.ajax({
								type: "POST",
								url: "./login.php",
								data : querystring,
								async: false,
								success: function(msg){	
						
										if(msg =='SALAH'){  
											toastr.error('Wrong username or password...! Note Writing Uppercase / Lowercase');
										}else{
											//location.reload();
											window.location.href="../home";
										}
								}
							});
				return false;
				});
				$('#userpass').on('keyup',function(e){
					e.stopImmediatePropagation()
					if(e.keyCode == 13){
						$('#login').click();
					}
					e.preventDefault();
					
				});
				$("#btnlupa").click(function(){
					var email	=	$('#email').val();
					pola_email=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
					
					if(email==''){
						toastr.error('Enter your email address...!');
						$('#email').focus();
						return false;
					}
					if(!pola_email.test(email)){
						toastr.error('Wrong email address...!');
						$('#email').focus();
					return false;
					}
					$.ajax({
						type: "POST",
						url: ajaxurl+"access/cek_email",
						data : {email:email},
						async: false,
						success: function(msg){
								if(msg=='false'){
									toastr.error('Email not registered...!');
								}else{
										$('#spinner').show();
										$.ajax({
											type: "POST",
											url: ajaxurl+"access/send_email",
											data : {email:email},
											async: false,
											success: function(msg){
													toastr.warning('Link password resset has be send to your email '+msg);
													$('#email').val('');
													$('#balik').click();
													$('#spinner').hide();
											},
											error: function(){
													toastr.error('Send email recovery fails, try again later..!');
													$('#spinner').hide();
											}
										});
								}
						}
					});
					
					
				});
				
				
			});
		</script>
		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
			
			
			
			//you don't need this, just used for changing background
			jQuery(function($) {
			 $('#btn-login-dark').on('click', function(e) {
				$('body').attr('class', 'login-layout');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-light').on('click', function(e) {
				$('body').attr('class', 'login-layout light-login');
				$('#id-text2').attr('class', 'grey');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-blur').on('click', function(e) {
				$('body').attr('class', 'login-layout blur-login');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'light-blue');
				
				e.preventDefault();
			 });
			 
			});
		</script>
	

</body></html>