<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>Philbert I Fast build Admin dashboard for any platform</title>
	<meta name="description" content="Philbert is a Dashboard & Admin Site Responsive Template by hencework." />
	<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Philbert Admin, Philbertadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
	<meta name="author" content="hencework"/>
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	
	<!-- vector map CSS -->
	<link href="<?=base_url('assets')?>/vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
	
	
	
	<!-- Custom CSS -->
	<link href="<?=base_url('assets')?>/dist/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<!--Preloader-->
		<!-- <div class="preloader-it">
			<div class="la-anim-1"></div>
		</div> -->
		<!--/Preloader-->
		
		<div class="wrapper pa-0">
			<header class="sp-header">
				<div class="sp-logo-wrap pull-left">
					<a href="index.html">
						<img class="brand-img mr-10" src="<?=base_url('assets')?>/dist/img/logo.png" alt="brand"/>
						<span class="brand-text">Philbert</span>
					</a>
				</div>
				<div class="form-group mb-0 pull-right">
					<span class="inline-block pr-10">Already have an account?</span>
					<a class="inline-block btn btn-info btn-success btn-rounded btn-outline" href="<?=base_url('login')?>">Sign In</a>
				</div>
				<div class="clearfix"></div>
			</header>
			
			<!-- Main Content -->
			<div class="page-wrapper pa-0 ma-0 auth-page">
				<div class="container-fluid">
					<!-- Row -->
					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float">
								<div class="row">
									<div class="col-sm-12 col-xs-12">
										<div class="mb-30">
											<h3 class="text-center txt-dark mb-10">Sign up to Philbert</h3>
											<h6 class="text-center nonecase-font txt-grey">Enter your details below</h6>
										</div>	
										<div class="form-wrap">
											<form action="<?=base_url('register/validate')?>" method="POST" id="form-add">
												<div class="form-group">
													<label class="control-label mb-10 text-left">Nama User</label>
													<input type="text" class="form-control" id="input-nama_user" placeholder="Irfan Hakim"  name="nama_user">
													<div class="help-block with-errors" id="error">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label mb-10 text-left">Username</label>
													<input type="text" class="form-control" id="input-username" placeholder="Username"  name="username">
													<div class="help-block with-errors" id="error">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label mb-10 text-left">Password</label>
													<input type="password" class="form-control" id="input-password" placeholder="Password"  name="password">
													<div class="help-block with-errors" id="error">
													</div>
												</div>				
												<div class="form-group">
													<label class="control-label mb-10" for="exampleInputuname_1">Level</label>					
													<select name="id_level" id="input-id_level" class="form-control">
														<option value="" style="display:none;">Pilih Level</option>
														<?php foreach ($data_level as $level): ?>
															<?php if ($level->id_level == 5): ?>
																<option value="<?=$level->id_level?>"><?=$level->nama_level?></option>
															<?php endif ?>
														<?php endforeach ?>
													</select>
													<div class="help-block with-errors" id="error">
													</div>
												</div>
												<div class="form-group text-center">
													<button type="submit" class="btn btn-info btn-success btn-rounded">sign Up</button>
												</div>
											</form>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<!-- /Row -->	
				</div>
				
			</div>
			<!-- /Main Content -->
			
		</div>
		<!-- /#wrapper -->
		
		<!-- JavaScript -->
		
		<!-- jQuery -->
		<script src="<?=base_url('assets')?>/vendors/bower_components/jquery/dist/jquery.min.js"></script>
		
		<!-- Bootstrap Core JavaScript -->
		<script src="<?=base_url('assets')?>/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="<?=base_url('assets')?>/vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
		
		<!-- Slimscroll JavaScript -->
		<script src="<?=base_url('assets')?>/dist/js/jquery.slimscroll.js"></script>
		
		<!-- Init JavaScript -->
		<script src="<?=base_url('assets')?>/dist/js/init.js"></script>
	</body>
	</html>
	<?php if (isset($validation)): ?>
		<script src="<?=base_url('assets/vendors')?>/bower_components/sweetalert/dist/sweetalert.min.js"></script>
		<script type="text/javascript">
			var base_url = '<?=base_url()?>'
		</script>		
		<script type="text/javascript" src="<?=base_url('assets/'.$validation)?>.js"></script>		
	<?php endif ?>
