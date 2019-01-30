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
	
	<!-- Morris Charts CSS -->
    <link href="<?=base_url('assets/vendors')?>/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css"/>

    <link href="<?=base_url('assets/vendors')?>/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
	
	<!-- Data table CSS -->
	<link href="<?=base_url('assets/vendors')?>/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
		
	<!-- Custom CSS -->
	<link href="<?=base_url('assets/dist')?>/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<!-- Preloader -->
	<!-- <div class="preloader-it">
		<div class="la-anim-1"></div>
	</div> -->
	<!-- /Preloader -->
    <div class="wrapper theme-1-active pimary-color-green">
		<!-- Top Menu Items -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="mobile-only-brand pull-left">
				<div class="nav-header pull-left">
					<div class="logo-wrap">
						<a href="index.html">
							<img class="brand-img" src="<?=base_url('assets/dist/')?>/img/logo.png" alt="brand"/>
							<span class="brand-text">Philbert</span>
						</a>
					</div>
				</div>	
				<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
				<a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);">
				<a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>				
			</div>
			<div id="mobile_only_nav" class="mobile-only-nav pull-right">
				<ul class="nav navbar-right top-nav pull-right">					
					<li class="dropdown auth-drp">
						<a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="<?=base_url('assets/dist/')?>/img/user1.png" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
						<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
							<li>
								<a href="<?=base_url('login/logout')?>"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
							</li>
						</ul>
					</li>
				</ul>
			</div>	
		</nav>
		<!-- /Top Menu Items -->
		<?php
			$hal = $this->uri->segment(1);
		?>
		<!-- Left Sidebar Menu -->
		<div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">
				<li class="navigation-header">
					<span>Main</span> 
					<i class="zmdi zmdi-more"></i>
				</li>
				<li>					
					<a class="<?=($hal=='home'||$hal=='')?'active':''?>" href="<?=base_url()?>" data-toggle="collapse" data-target="#dashboard_dr"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="pull-right"></div><div class="clearfix"></div></a>					
				</li>				
				<?php if ($this->session->userdata('user_id_level')==1): ?>
					<li>
						<a class="<?=($hal=='user')?'active':''?>" href="<?=base_url('user')?>" data-toggle="collapse" data-target="#dashboard_dr"><div class="pull-left"><i class="icon-user mr-20"></i><span class="right-nav-text">Daftar User</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
					</li>
					<li>
						<a class="<?=($hal=='masakan')?'active':''?>" href="<?=base_url('masakan')?>" data-toggle="collapse" data-target="#dashboard_dr"><div class="pull-left"><i class="fa fa-cutlery mr-20"></i><span class="right-nav-text">Daftar Masakan</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
					</li>
				<?php endif ?>
			</ul>
		</div>
		<!-- /Left Sidebar Menu -->
        <!-- Main Content -->
		<div class="page-wrapper">
			<div class="container-fluid">
				
				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h5 class="txt-dark">
					  <?php if (isset($judul)): ?>
					  	<?=$judul?>
					  <?php else: ?>
					  	
					  <?php endif ?>
					  </h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
					  	<li><a href="<?=base_url()?>"><span>Home</span></a></li>
					  	<?php if ($this->uri->segment(1)&&!$this->uri->segment(2)&&!$this->uri->segment(3)): ?>
	                        <li class="breadcrumb-item"><?=ucfirst($this->uri->segment(1))?></li>
	                    <?php endif ?>
					  	<?php if ($this->uri->segment(1)&&$this->uri->segment(2)&&!$this->uri->segment(3)): ?>
                        <li class="breadcrumb-item active">
                          <a href="<?=base_url($this->uri->segment(1))?>">
                            <?=ucfirst($this->uri->segment(1))?>
                          </a>
                        </li>
                        <li class="breadcrumb-item"><?=ucfirst($this->uri->segment(2))?></li>
                      <?php endif ?>
                      <?php if ($this->uri->segment(1)&&$this->uri->segment(2)&&$this->uri->segment(3)): ?>
                        <li class="breadcrumb-item active">
                          <a href="<?=base_url($this->uri->segment(1))?>">
                            <?=ucfirst($this->uri->segment(1))?>
                          </a>
                        </li>                        
                        <li class="breadcrumb-item"><?=ucfirst($this->uri->segment(2))?></li>
                      <?php endif ?>
						<!-- <li><a href="#"><span>table</span></a></li>
						<li class="active"><span>basic table</span></li> -->
					  </ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->
				
				<div class="row">
					<!-- Basic Table -->
					<div class="col-sm-12">
						<?php $this->load->view($view)?>
						<!-- <div class="panel panel-default card-view">	 -->						
							<!-- <div class="panel-wrapper collapse in"> -->
								
								<!-- <div class="panel-body">
									
								</div> -->
							<!-- </div> -->
						<!-- </div> -->
					</div>
					<!-- /Basic Table -->
				</div>	
				
			</div>
			
			<!-- Footer -->
			<footer class="footer container-fluid pl-30 pr-30">
				<div class="row">
					<div class="col-sm-12">
						<p>2017 &copy; Philbert. Pampered by Hencework</p>
					</div>
				</div>
			</footer>
			<!-- /Footer -->
			
		</div>
        <!-- /Main Content -->

    </div>
    <!-- /#wrapper -->
	
	<!-- JavaScript -->
	
    <!-- jQuery -->
    <script src="<?=base_url('assets/vendors')?>/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url('assets/vendors')?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
	<!-- Data table JavaScript -->
	<script src="<?=base_url('assets/vendors')?>/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	
	<!-- Slimscroll JavaScript -->
	<script src="<?=base_url('assets/dist')?>/js/jquery.slimscroll.js"></script>
	
	<!-- simpleWeather JavaScript -->
	<script src="<?=base_url('assets/vendors')?>/bower_components/moment/min/moment.min.js"></script>
	<script src="<?=base_url('assets/vendors')?>/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
	<script src="<?=base_url('assets/dist')?>/js/simpleweather-data.js"></script>
	
	<!-- Progressbar Animation JavaScript -->
	<script src="<?=base_url('assets/vendors')?>/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="<?=base_url('assets/vendors')?>/bower_components/jquery.counterup/jquery.counterup.min.js"></script>
	
	<!-- Fancy Dropdown JS -->
	<script src="<?=base_url('assets/dist')?>/js/dropdown-bootstrap-extended.js"></script>
	
	<!-- Sparkline JavaScript -->
	<script src="<?=base_url('assets/vendors')?>/jquery.sparkline/dist/jquery.sparkline.min.js"></script>
	
	<!-- Owl JavaScript -->
	<script src="<?=base_url('assets/vendors')?>/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
	
	<!-- ChartJS JavaScript -->
	<script src="<?=base_url('assets/vendors')?>/chart.js/Chart.min.js"></script>
	
	<!-- Morris Charts JavaScript -->
    <script src="<?=base_url('assets/vendors')?>/bower_components/raphael/raphael.min.js"></script>
    <script src="<?=base_url('assets/vendors')?>/bower_components/morris.js/morris.min.js"></script>    
	
	<!-- Switchery JavaScript -->
	<script src="<?=base_url('assets/vendors')?>/bower_components/switchery/dist/switchery.min.js"></script>
	
	

	<?php if (isset($validation)): ?>
		<script src="<?=base_url('assets/vendors')?>/bower_components/sweetalert/dist/sweetalert.min.js"></script>
		<script type="text/javascript">
			var base_url = '<?=base_url()?>'
		</script>		
		<script type="text/javascript" src="<?=base_url('assets/'.$validation)?>.js"></script>		
	<?php endif ?>
</body>

</html>
