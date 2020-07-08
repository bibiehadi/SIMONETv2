<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $this->config->item('program'); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="Avenxo Admin Theme">
    <meta name="author" content="KaijuThemes">

    <link type='text/css' href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600' rel='stylesheet'>

    <link type="text/css" href="<?php echo base_url('') ?>assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">        <!-- Font Awesome -->    <link type="text/css" href="<?php echo base_url('') ?>assets/css/styles.css" rel="stylesheet">                                     <!-- Core CSS with all styles -->
    <link type="text/css" href="<?php echo base_url('');?>assets/fonts/themify-icons/themify-icons.css" rel="stylesheet">               <!-- Themify Icons -->
    <link type="text/css" href="<?php echo base_url('') ?>assets/plugins/codeprettifier/prettify.css" rel="stylesheet">                <!-- Code Prettifier -->
    <link type="text/css" href="<?php echo base_url('') ?>assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">              <!-- iCheck -->
    <!--[if lt IE 10]>
        <script type="text/javascript" src="assets/js/media.match.min.js"></script>
        <script type="text/javascript" src="assets/js/respond.min.js"></script>
        <script type="text/javascript" src="assets/js/placeholder.min.js"></script>
    <![endif]-->
    <!-- The following CSS are included as plugins and can be removed if unused-->
    
	<link type="text/css" href="<?php echo base_url('') ?>assets/plugins/switchery/switchery.css" rel="stylesheet">   							<!-- Switchery -->
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/plugins/datatables/dataTables.bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/plugins/datatables/dataTables.css">
	<link type="text/css" href="<?php echo base_url('') ?>assets/plugins/progress-skylo/skylo.css" rel="stylesheet">
    
	<link href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/plugins/next-bower/css/next.min.css">
	<script type="text/javascript" src="<?php echo base_url('') ?>assets/plugins/next-bower/js/next.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">

    </head>

    <body class="animated-content sidebar-collapsed">
        
        <header id="topnav" class="navbar navbar-default navbar-fixed-top" role="banner">

	<div class="logo-area">
		<span id="trigger-sidebar" class="toolbar-trigger toolbar-icon-bg">
			<a data-toggle="tooltips" data-placement="right" title="Toggle Sidebar">
				<span class="icon-bg">
					<i class="fa fa-bars"></i>
				</span>
			</a>
		</span>		
		<a class="navbar-brand" href="<?php echo site_url();?>">
            <span><img src="<?php echo base_url('assets/img/logo-infra.png'); ?>"/></span>
            Infranet
        </a>
		
	</div><!-- logo-area -->

	<ul class="nav navbar-nav toolbar pull-right">
		<li class="toolbar-icon-bg hidden-xs">
            <a href="javascript:;" data-aksi="log" data-toggle="tooltip" title="Log Activity"><span class="icon-bg"><i class="ti ti-notepad"></i></span></a>
        </li>
		<li class="dropdown toolbar-icon-bg">
			<a href="#" class="dropdown-toggle username" data-toggle="dropdown">
				<img class="img-circle" src="<?php echo base_url('') ?>assets/img/anu.png" alt="" />
			</a>
			<ul class="dropdown-menu userinfo arrow">
				<li><a href="#/" data-aksi="settings"><i class="fa fa-cog"></i><span>Setting Users</span></a></li>
				<li class="divider"></li>
				<li><a href="<?php echo site_url('login/logout') ?>"><i class="fa fa-sign-out"></i><span>Log Out</span></a></li>
			</ul>
		</li>

	</ul>
	</header>
    </div>
        <div id="wrapper">
            <div id="layout-static">
                <div class="static-sidebar-wrapper sidebar-default">
                    <div class="static-sidebar">
                        <div class="sidebar">
	<!-- <div class="widget">
        <div class="widget-body">
            <div class="userinfo">
                <div class="avatar">
                    <img src="<?php echo base_url('') ?>assets/img/anu.png" class="img-responsive img-circle"> 
                </div>
                <div class="info">
                    <span class="username">Alexander Anu</span>
                    <span class="useremail">anu@iya.com</span>
                </div>
            </div>
        </div>
    </div> -->
						<div class="widget stay-on-collapse" id="widget-sidebar">
							<nav role="navigation" class="widget-body">
								<ul class="acc-menu">
									<li class="nav-separator"><span>Explore</span></li>
									<li><a href="<?php echo site_url('dashboard'); ?>"><i class="ti ti-home"></i><span>Dashboard</span></a></li>	
									<li><a href="<?php echo site_url('devices'); ?>"><i class="ti ti-harddrive"></i><span>Devices</span></a></li>	
									<li><a href="<?php echo site_url('topology'); ?>"><i class="ti ti-map"></i><span>Topology</span></a></li>	
									<li><a href="<?php echo site_url('statistic'); ?>"><i class="ti ti-stats-up" style="bold"></i><span>Statistic</span></a></li>	
									<li><a href="javascript:;"><i class="ti ti-rss"></i><span>Hotspot</span></a>
										<ul class="acc-menu">
												<li><a href="<?php echo site_url('hotspot/userhotspot'); ?>">User Hotspot</a></li>
												<li><a href="<?php echo site_url('hotspot/userprofile'); ?>">User Profile</a></li>
												<li><a href="<?php echo site_url('hotspot/useractive'); ?>">User Active</a></li>
											</ul>
									</li>																		
								</ul>
							</nav>
						</div>

</div>

