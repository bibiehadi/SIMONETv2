<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Avenxo Admin Theme</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="Avenxo Admin Theme">
    <meta name="author" content="KaijuThemes">

    <link type='text/css' href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600' rel='stylesheet'>

    <link type="text/css" href="<?php echo base_url('') ?>assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">        <!-- Font Awesome -->
    <link type="text/css" href="<?php echo base_url('') ?>assets/fonts/themify-icons/themify-icons.css" rel="stylesheet">              <!-- Themify Icons -->
    <link type="text/css" href="<?php echo base_url('') ?>assets/css/styles.css" rel="stylesheet">                                     <!-- Core CSS with all styles -->

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


    </head>

    <body class="animated-content sidebar-collapsed">
        
        <header id="topnav" class="navbar navbar-default navbar-fixed-top" role="banner">

	<div class="logo-area">
		<span id="trigger-sidebar" class="toolbar-trigger toolbar-icon-bg">
			<a data-toggle="tooltips" data-placement="right" title="Toggle Sidebar">
				<span class="icon-bg">
					<i class="ti ti-menu"></i>
				</span>
			</a>
		</span>
		
		<a class="navbar-brand" href="<?php echo site_url() ?>"></a>
	</div><!-- logo-area -->

	<ul class="nav navbar-nav toolbar pull-right">
        <li class="dropdown toolbar-icon-bg hidden-xs">
			<a href="#" class="hasnotifications dropdown-toggle" data-toggle='dropdown'><span class="icon-bg"><i class="ti ti-email"></i></span><span
			class="badge badge-deeporange">2</span></a>
			<div class="dropdown-menu notifications arrow">
				<div class="topnav-dropdown-header">
					<span>Messages</span>
				</div>
				<div class="scroll-pane">
					<ul class="media-list scroll-content">
						<li class="media notification-message">
							<a href="#">
								<div class="media-left">
									<img class="img-circle avatar" src="http://placehold.it/300&text=Placeholder" alt="" />
								</div>
								<div class="media-body">
									<h4 class="notification-heading"><strong>Vincent Keller</strong> <span class="text-gray">‒ Design should be ...</span></h4>
									<span class="notification-time">2 mins ago</span>
								</div>
							</a>
						</li>
						<li class="media notification-message">
							<a href="#">
								<div class="media-left">
									<img class="img-circle avatar" src="http://placehold.it/300&text=Placeholder" alt="" />
								</div>
								<div class="media-body">
									<h4 class="notification-heading"><strong>Frend Pratt</strong> <span class="text-gray">‒ I will start with the ...</span></h4>
									<span class="notification-time">40 mins ago</span>
								</div>
							</a>
						</li>
						<li class="media notification-message">
							<a href="#">
								<div class="media-left">
									<img class="img-circle avatar" src="http://placehold.it/300&text=Placeholder" alt="" />
								</div>
								<div class="media-body">
									<h4 class="notification-heading"><strong>Cynthia Hines</strong> <span class="text-gray">‒ Interior bits are ...</span></h4>
									<span class="notification-time">6 hours ago</span>
								</div>
							</a>
						</li>
						<li class="media notification-message">
							<a href="#">
								<div class="media-left">
									<img class="img-circle avatar" src="http://placehold.it/300&text=Placeholder" alt="" />
								</div>
								<div class="media-body">
									<h4 class="notification-heading"><strong>Robin Horton</strong> <span class="text-gray">‒ Are you even ...</span></h4>
									<span class="notification-time">8 days ago</span>
								</div>
							</a>
						</li>
						<li class="media notification-message">
							<a href="#">
								<div class="media-left">
									<img class="img-circle avatar" src="http://placehold.it/300&text=Placeholder" alt="" />
								</div>
								<div class="media-body">
									<h4 class="notification-heading"><strong>Amanda Torrez</strong> <span class="text-gray">‒ The message is ...</span></h4>
									<span class="notification-time">16 hours ago</span>
								</div>
							</a>
						</li>
						<li class="media notification-message">
							<a href="#">
								<div class="media-left">
									<img class="img-circle avatar" src="http://placehold.it/300&text=Placeholder" alt="" />
								</div>
								<div class="media-body">
									<h4 class="notification-heading"><strong>Khan Farhan</strong> <span class="text-gray">‒ Expected the stuff ...</span></h4>
									<span class="notification-time">2 days ago</span>
								</div>
							</a>
						</li>
						<li class="media notification-message">
							<a href="#">
								<div class="media-left">
									<img class="img-circle avatar" src="http://placehold.it/300&text=Placeholder" alt="" />
								</div>
								<div class="media-body">
									<h4 class="notification-heading"><strong>Will Whedon</strong> <span class="text-gray">‒ The movie of this ...</span></h4>
									<span class="notification-time">4 days ago</span>
								</div>
							</a>
						</li>
					</ul>
				</div>
				<div class="topnav-dropdown-footer">
					<a href="#">See all messages</a>
				</div>
			</div>
		</li>
		
		<li class="dropdown toolbar-icon-bg">
			<a href="#" class="hasnotifications dropdown-toggle" data-toggle='dropdown'><span class="icon-bg"><i class="ti ti-bell"></i></span><span class="badge badge-deeporange">2</span></a>
			<div class="dropdown-menu notifications arrow">
				<div class="topnav-dropdown-header">
					<span>Notifications</span>
				</div>
				<div class="scroll-pane">
					<ul class="media-list scroll-content">
						<li class="media notification-success">
							<a href="#">
								<div class="media-left">
									<span class="notification-icon"><i class="ti ti-check"></i></span>
								</div>
								<div class="media-body">
									<h4 class="notification-heading">Update 1.0.4 successfully pushed</h4>
									<span class="notification-time">8 mins ago</span>
								</div>
							</a>
						</li>
						<li class="media notification-info">
							<a href="#">
								<div class="media-left">
									<span class="notification-icon"><i class="ti ti-check"></i></span>
								</div>
								<div class="media-body">
									<h4 class="notification-heading">Update 1.0.3 successfully pushed</h4>
									<span class="notification-time">24 mins ago</span>
								</div>
							</a>
						</li>
						<li class="media notification-teal">
							<a href="#">
								<div class="media-left">
									<span class="notification-icon"><i class="ti ti-check"></i></span>
								</div>
								<div class="media-body">
									<h4 class="notification-heading">Update 1.0.2 successfully pushed</h4>
									<span class="notification-time">16 hours ago</span>
								</div>
							</a>
						</li>
						<li class="media notification-indigo">
							<a href="#">
								<div class="media-left">
									<span class="notification-icon"><i class="ti ti-check"></i></span>
								</div>
								<div class="media-body">
									<h4 class="notification-heading">Update 1.0.1 successfully pushed</h4>
									<span class="notification-time">2 days ago</span>
								</div>
							</a>
						</li>
						<li class="media notification-danger">
							<a href="#">
								<div class="media-left">
									<span class="notification-icon"><i class="ti ti-arrow-up"></i></span>
								</div>
								<div class="media-body">
									<h4 class="notification-heading">Initial Release 1.0</h4>
									<span class="notification-time">4 days ago</span>
								</div>
							</a>
						</li>
					</ul>
				</div>
				<div class="topnav-dropdown-footer">
					<a href="#">See all notifications</a>
				</div>
			</div>
		</li>

		<li class="dropdown toolbar-icon-bg">
			<a href="#" class="dropdown-toggle username" data-toggle="dropdown">
				<img class="img-circle" src="<?php echo base_url('') ?>assets/img/anu.png" alt="" />
			</a>
			<ul class="dropdown-menu userinfo arrow">
				<li><a href="#/"><i class="ti ti-user"></i><span>Profile</span><span class="badge badge-info pull-right">80%</span></a></li>
				<li><a href="#/"><i class="ti ti-panel"></i><span>Account</span></a></li>
				<li><a href="#/"><i class="ti ti-settings"></i><span>Settings</span></a></li>
				<li class="divider"></li>
				<li><a href="#/"><i class="ti ti-stats-up"></i><span>Earnings</span></a></li>
				<li><a href="#/"><i class="ti ti-view-list-alt"></i><span>Statement</span></a></li>
				<li><a href="#/"><i class="ti ti-money"></i><span>Withdrawals</span></a></li>
				<li class="divider"></li>
				<li><a href="<?php echo site_url('login/logout') ?>"><i class="ti ti-shift-right"></i><span>Sign Out</span></a></li>
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
									<li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>	
									<li><a href="<?php echo site_url('devices'); ?>"><i class="fa fa-hdd-o"></i><span>Devices</span></a></li>	
									<li><a href="#"><i class="fa fa-area-chart" style="bold"></i><span>Statistic</span></a></li>	
									<li><a href="javascript:;"><i class="fa fa-users"></i><span>Hotspot</span></a>
										<ul class="acc-menu">
												<li><a href="<?php echo site_url('hotspot/userhotspot'); ?>">User Hotspot</a></li>
												<li><a href="<?php echo site_url('hotspot/userprofile'); ?>">User Profile</a></li>
												<li><a href="<?php echo site_url('hotspot/useractive'); ?>">User Active</a></li>
											</ul>
									</li>
									<li><a id="logPopover" role="button" data-toggle="popover" data-placement="right" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."><i class="ti ti-rss-alt"></i><span>Log Activity</span></a>
									</li>
								</ul>
							</nav>
						</div>

</div>

