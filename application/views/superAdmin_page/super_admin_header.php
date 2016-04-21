<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="<?php echo base_url();?>assets/images/fevicon-m.ico" rel="shortcut icon">
    <title>Qyura | <?php if(isset($title) && !empty($title)): echo ucwords($title); endif; ?></title>
    <link href="<?php echo base_url();?>assets/css/framework.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/datepicker.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/custom-g.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/custom-r.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/vendor/select2/select2.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/css/responsive-r.css" rel="stylesheet" />
    <!-- DataTables -->
    <link href="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url();?>assets/js/modernizr.min.js"></script>
    <link href="<?php echo base_url();?>assets/vendor/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
<!--    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery.dataTables.min.css"/> -->
  <style>
        .boldTitle {
            /*font-weight: bold !important;*/
        }
        .page-loader {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	opacity:0.81;
	background: url('<?php echo base_url('assets/images/loader') ?>/Doctors_symbol.gif') 50% 50% no-repeat rgb(249,249,249);
	background-color: white;
        }
	.danger{
	    color: red;
	}
    </style>
    
</head>

<body class="fixed-left" id="crop-avatar">
<!--<div id="loaderMainDiv" style="position: absolute; background-color: black;opacity: 0.4;width: 100%;height: 100%;z-index:9999;">
    </div>
  -->
    <!-- Begin page -->
    <div style="display: block" class="page-loader"></div>
    <div id="wrapper">
        <!-- Top Bar Start -->
        <div class="topbar">
            <!-- Logo -->
            <div class="topbar-left">
            </div>
            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container row">
                    <div class="clearfix">
                        <div class="pull-left">
                            <div class="mlogo visible-xs visible-sm"><a href="#"><i class="md"></i></a></div>
                            <div class="hidden-xs hidden-sm">
                                <a class="logo" href="#"><img src="<?php echo base_url();?>assets/images/qyura-f-l.png"></a>
                                <button class="button-menu-mobile open-left"><i class="fa fa-bars"></i></button> <span class="clearfix"></span>
                            </div>
                            <button class="button-menu-mobile open-left hidden-lg hidden-md"><i class="fa fa-bars"></i></button> <span class="clearfix"></span>
                        </div>
                        <form class="navbar-form pull-left visible-md" role="search">
                            <div class="form-group">
                                <input class="form-control search-bar" placeholder="Type here for search..." type="text">
                            </div>
                            <button class="btn btn-search" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                        <ul class="nav navbar-nav navbar-right pull-right">
                            <li class="dropdown">
                                 <a aria-expanded="true" class="dropdown-toggle profile" data-toggle="dropdown" href=""><img alt="User Image" class="img-circle" src="<?php echo base_url();?>assets/patientImages/<?php echo $this->session->userdata("ses_sa_image");?>"> <?php echo $this->session->userdata("ses_sa_name");?>
                                    <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php echo site_url('setting');?>"><i class=
                                    "md md-face-unlock"></i> Profile</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('auth/logout');?>"><i class=
                                    "md md-settings-power"></i> Logout</a>
                                    </li>
                                </ul>
                            </li>
                         <!--   <li class="dropdown hidden-xs">
                                <a aria-expanded="true" class="dropdown-toggle waves-effect waves-light" data-target="#" data-toggle="dropdown" href="#"><i class="md md-notifications"></i>
                           <span class=
                              "badge badge-xs badge-danger">3</span></a>
                                <ul class="dropdown-menu dropdown-menu-lg">
                                    <li class="text-center notifi-title">
                                        Notification
                                    </li>
                                    <li class="list-group">
                                        <a class="list-group-item" href="javascript:void(0);">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <em class="fa fa-user-plus fa-2x text-info">
                                          </em>
                                                </div>
                                                <div class="media-body clearfix">
                                                    <div class="media-heading">
                                                        New user registered
                                                    </div>
                                                    <p class="m-0"><small>You have
                                             10 unread messages</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="list-group-item" href="javascript:void(0);">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <em class="fa fa-diamond fa-2x text-primary">
                                          </em>
                                                </div>
                                                <div class="media-body clearfix">
                                                    <div class="media-heading">
                                                        New settings
                                                    </div>
                                                    <p class="m-0"><small>There are
                                             new settings
                                             available</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="list-group-item" href="javascript:void(0);">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <em class="fa fa-bell-o fa-2x text-danger">
                                          </em>
                                                </div>
                                                <div class="media-body clearfix">
                                                    <div class="media-heading">
                                                        Updates
                                                    </div>
                                                    <p class="m-0"><small>There are
                                             <span class=
                                                "text-primary">2</span> new
                                             updates available</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="list-group-item" href="javascript:void(0);"><small>See
                                 all notifications</small></a>
                                    </li>
                                </ul>
                            </li> -->
                            <!-- <li class="hidden-xs">
                           <a href="#" class="right-bar-toggle waves-effect waves-light"><i class="md md-settings"></i></a>
                           </li> -->
                            <li class="hidden-xs hidden-sm">
                                <a class="waves-effect waves-light" href="#" id="btn-fullscreen"><i class=
                              "md md-crop-free"></i></a>
                            </li>
                        </ul>
                    </div>
                    <!-- nav-collapse -->
                </div>
            </div>
        </div>
        <!-- Top Bar End -->
        <!-- Left Sidebar Start -->
        <div class="left side-menu">
            <div class="sidebar-inner slimscrollleft">
                <!--- Divider -->
                <div id="sidebar-menu">
                    <ul>
                        <li>
                            <a href="javascript:void(0)" class="waves-effect"><i class="ion-ios7-keypad-outline"></i><span>Dashboard</span></a>
                        </li>
                        <li class="has_sub">
                            <a class="waves-effect <?php if($this->router->fetch_class() == 'hospital'):echo"boldTitle  active";endif;?>" href="#"><i class="fa fa-hospital-o"></i> 
                            <span>Hospitals</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li class="<?php if($this->router->fetch_class() == 'hospital' && $this->router->fetch_method() != 'addHospital'):echo"boldTitle  active";endif;?>"><a href="<?php echo base_url();?>index.php/hospital">All Hospitals</a></li>
                                <li class="<?php if($this->router->fetch_method() == 'addHospital'):echo"boldTitle  active";endif;?>"><a href="<?php echo base_url();?>index.php/hospital/addHospital">Add New Hospital</a></li>
                            </ul>
                        </li>
                          <li class="has_sub">
                            <a class="waves-effect <?php if($this->router->fetch_class() == 'diagnostic'):echo"boldTitle  active";endif;?>" href="#"><i class="fa fa-plus-square"></i> 
                            <span>Diagnostic Centres</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li class="<?php if($this->router->fetch_class() == 'diagnostic' && $this->router->fetch_method() != 'addDiagnostic'):echo"boldTitle  active";endif;?>"><a href="<?php echo base_url();?>index.php/diagnostic">All Diag Centres</a></li>
                                
                                <li class="<?php if($this->router->fetch_method() == 'addDiagnostic'):echo"boldTitle  active";endif;?>">
                                        <a href="<?php echo base_url();?>index.php/diagnostic/addDiagnostic">Add New Diag Centre
                                        </a></li>
                            </ul>
                        </li>
                         <li class="has_sub">
                            <a class="waves-effect <?php if($this->router->fetch_class() == 'bloodbank'):echo"boldTitle  active";endif;?>" href="#"><i class="fa fa-heartbeat"></i> 
                            <span>Blood Banks</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li class="<?php if($this->router->fetch_class() == 'bloodbank' && $this->router->fetch_method() != 'Addbloodbank'):echo"boldTitle  active";endif;?>"><a href="<?php echo base_url();?>index.php/bloodbank">All Blood Banks</a></li>
                                <li class="<?php if($this->router->fetch_method() == 'Addbloodbank'):echo"boldTitle  active";endif;?>"><a href="<?php echo base_url();?>index.php/bloodbank/Addbloodbank">Add New Blood Bank</a></li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a class="waves-effect <?php if($this->router->fetch_class() == 'pharmacy'):echo"boldTitle  active";endif;?>" href="#"><i class="fa fa-medkit"></i> 
                            <span>Pharmacies</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li class="<?php if($this->router->fetch_class() == 'pharmacy' && $this->router->fetch_method() != 'addPharmacy'):echo"boldTitle  active";endif;?>"><a href="<?php echo base_url();?>index.php/pharmacy">All Pharmacies</a></li>
                                <li class="<?php if($this->router->fetch_class() == 'pharmacy' && $this->router->fetch_method() == 'addPharmacy'):echo"boldTitle  active";endif;?>"><a href="<?php echo base_url();?>index.php/pharmacy/addPharmacy">Add New Pharmacies</a></li>
                            </ul>
                        </li>
                          <li class="has_sub">
                            <a class="waves-effect <?php if($this->router->fetch_class() == 'ambulance'):echo"boldTitle  active";endif;?>" href="#"><i class="fa fa-ambulance"></i> 
                            <span>Ambulance </span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li class="<?php if($this->router->fetch_class() == 'ambulance' && $this->router->fetch_method() != 'addAmbulance'):echo"boldTitle  active";endif;?>"><a href="<?php echo base_url();?>index.php/ambulance">All Ambulance Providers</a></li>
                                <li class="<?php if($this->router->fetch_method() == 'addAmbulance'):echo"boldTitle  active";endif;?>"><a href="<?php echo base_url();?>index.php/ambulance/addAmbulance">Add Ambulance Provider</a></li>
                            </ul>
                        </li>
                        
                         <li class="has_sub">
                            <a class="waves-effect <?php if($this->router->fetch_class() == 'medicart'):echo"boldTitle  active";endif;?>" href="#"><i class="fa fa-newspaper-o"></i><span>Medicart</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li class="<?php if($this->router->fetch_class() == 'medicart' && $this->router->fetch_method() != 'addOffer' && $this->router->fetch_method() != 'bookingRequest' && $this->router->fetch_method() != 'enquiries'):echo"boldTitle  active";endif;?>"><a href="<?php echo site_url('medicart');?>">Medicart Offers</a></li>
                                <li class="<?php if($this->router->fetch_class() == 'medicart' && $this->router->fetch_method() == 'bookingRequest'):echo"boldTitle  active";endif;?>"><a href="<?php echo site_url('medicart/bookingRequest');?>">Booking Requests</a></li>
                                <li class="<?php if($this->router->fetch_class() == 'medicart' && $this->router->fetch_method() == 'enquiries'):echo"boldTitle  active";endif;?>"><a href="<?php echo site_url('medicart/enquiries');?>">Enquiries</a></li>
                                <li class="<?php if($this->router->fetch_class() == 'medicart' && $this->router->fetch_method() == 'addOffer'):echo"boldTitle  active";endif;?>"><a href="<?php echo site_url('medicart/addOffer');?>">Add New Offer</a></li>
                            </ul>
                        </li>
                        
                        <li class="has_sub">
                            <a class="waves-effect <?php if($this->router->fetch_class() == 'doctor'):echo 'boldTitle  active';endif;?>" href="#"><i class="fa fa-stethoscope"></i> 
                        <span>Doctors</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li class="<?php if($this->router->fetch_class() == 'doctor' && $this->router->fetch_method() != 'addDoctor'):echo"boldTitle  active";endif;?>"><a href="<?php echo site_url('doctor');?>">All Doctors</a></li>
                                <li class="<?php if($this->router->fetch_class() == 'doctor' && $this->router->fetch_method() == 'addDoctor'):echo"boldTitle  active";endif;?>"><a href="<?php echo site_url('doctor/addDoctor');?>">Add New Doctor</a></li>
<!--                                <li><a href="#">Schedule & Availability</a></li>-->
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a class="waves-effect <?php if($this->router->fetch_class() == 'miappointment'):echo 'boldTitle  active';endif;?>" href="#"><i class="fa fa-stethoscope"></i> 
                        <span>MI Appointments</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <!--<li><a href="#">Pending Appointments</a></li>-->
                                <li class="<?php if($this->router->fetch_class() == 'miappointment' && $this->router->fetch_method() != 'add_appointment'):echo"boldTitle  active";endif;?>"><a href="<?php echo site_url('miappointment');?>"><a href="<?php echo site_url('miappointment');?>">All Appointments</a></li>
                                <li class="<?php if($this->router->fetch_class() == 'miappointment' && $this->router->fetch_method() == 'add_appointment'):echo"boldTitle  active";endif;?>"><a href="<?php echo site_url('miappointment/add_appointment/');?>">Add New Appointment</a></li>
                                <!--<li><a href="upload-reports.html">Upload Test Reports</a></li>-->
                            </ul>
                        </li>
                       <li class="has_sub">
                            <a class="waves-effect <?php if($this->router->fetch_class() == 'docappointment'):echo 'boldTitle  active';endif;?>" href="#"><i class="fa fa-stethoscope"></i> 
                        <span>Dr. Appointments</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <!--<li><a href="#">Pending Appointments</a></li>-->
                                <li class="<?php if($this->router->fetch_class() == 'docappointment' && $this->router->fetch_method() != 'add_appointment'):echo"boldTitle  active";endif;?>" ><a href="<?php echo site_url('docappointment');?>">All Appointments</a></li>
                                <li class="<?php if($this->router->fetch_class() == 'docappointment' && $this->router->fetch_method() == 'add_appointment'):echo"boldTitle  active";endif;?>"><a href="<?php echo site_url('docappointment/add_appointment/');?>">Add New Appointment</a></li>
                            </ul>
                        </li>
                         <li class="has_sub">
                             <a class="waves-effect <?php if($this->router->fetch_class() == 'quotation'):echo"boldTitle  active";endif;?>" href="#"><i class="ion-clipboard"></i> 
                        <span>Quotations</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
<!--                                <li><a href="#">Pending Quotation Req.</a></li>-->
                                <li class="<?php if($this->router->fetch_class() == 'quotation' && $this->router->fetch_method() != 'sendQuotation' && $this->router->fetch_method() != 'quotationHistory'):echo"boldTitle  active";endif;?>"><a href="<?php echo base_url();?>index.php/quotation">All Quotation Requests</a></li>
                                <li class="<?php if($this->router->fetch_class() == 'quotation' && $this->router->fetch_method() == 'sendQuotation'):echo"boldTitle  active";endif;?>"><a href="<?php echo base_url();?>index.php/quotation/sendQuotation">Send a Quote</a></li>
                                <li class="<?php if($this->router->fetch_class() == 'quotation' && $this->router->fetch_method() == 'quotationHistory'):echo"boldTitle  active";endif;?>"><a href="<?php echo base_url();?>index.php/quotation/quotationHistory">Quotation History</a></li>
                            </ul>
                        </li>
                        
                        <li class="has_sub">
                            <a class="waves-effect <?php if($this->router->fetch_class() == 'healthcare'):echo"boldTitle  active";endif;?>" href="#"><i class="fa fa-newspaper-o"></i><span>Healthcare Packag</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li class="<?php if($this->router->fetch_class() == 'healthcare' && $this->router->fetch_method() != 'addHealthpkg' && $this->router->fetch_method() != 'bookingHealthpkgList' && $this->router->fetch_method() != 'bookingDetailHealthpkg'):echo"boldTitle  active";endif;?>"><a href="<?php echo base_url();?>index.php/healthcare">Healthcare Package</a></li>
                                
                                <li class="<?php if($this->router->fetch_class() == 'healthcare' && $this->router->fetch_method() == 'addHealthpkg'):echo"boldTitle  active";endif;?>"><a href="<?php echo base_url();?>index.php/healthcare/addHealthpkg">Add New Package</a></li>
                                <li class="<?php if($this->router->fetch_class() == 'healthcare' && ($this->router->fetch_method() == 'bookingHealthpkgList' OR $this->router->fetch_method() == 'bookingDetailHealthpkg')):echo"boldTitle  active";endif;?>"><a href="<?php echo base_url();?>index.php/healthcare/bookingHealthpkgList">Package Booking</a></li>
                            </ul>
                        </li>

<!--                        <li>
                            <a href="call-tracking.html" class="waves-effect"><i class="ion-ios7-telephone-outline"></i><span>Call Tracking</span></a>
                        </li> -->
<!--                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="md md-account-circle"></i><span>User Management</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="all-user.html">User List</a></li>
                                <li><a href="add-user.html">Add New User</a></li>
                            </ul>
                        </li>-->
                         <li class="has_sub ">
                            <a class="waves-effect <?php if($this->router->fetch_class() == 'reviews'):echo"boldTitle  active";endif;?>" href="#"><i class="fa fa-star-o"></i><span>Rate & Reviews</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li class="<?php if($this->router->fetch_class() == 'reviews'):echo"boldTitle  active";endif;?>"><a href="<?php echo site_url('reviews');?>">All Reviews</a></li>
                                <li><a href="#">Ratings</a></li>
                            </ul>
                        </li>
                        <li class="has_sub ">
                            <a class="waves-effect <?php if($this->router->fetch_class() == 'cms'):echo"boldTitle  active";endif;?>" href="#"><i class="fa fa-file"></i><span>CMS</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li class="<?php if($this->router->fetch_class() == 'cms'):echo"boldTitle  active";endif;?>"><a href="<?php echo site_url('cms');?>">All CMS</a></li>
                            </ul>
                        </li>
                       <!-- 
                        <li class="<?php if($this->router->fetch_class() == 'favouriteby'):echo"boldTitle  active";endif;?>">
                            <a href="<?php echo base_url();?>index.php/favouriteby" class="waves-effect"><i class="fa fa-star-o"></i><span>Favorited By</span></a>
                        </li>
                       <li>
                            <a href="#" class="waves-effect"><i class="fa fa-bar-chart-o"></i><span>App Analytics</span></a>
                        </li>
                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="md md-trending-up"></i><span>Finance</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="#">Finacial Accounts</a></li>
                                <li><a href="#">Invoice List</a></li>
                                <li><a href="#">Payment Transactions</a></li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-gift"></i> <span>Promo Coupons</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="#">Coupons List</a></li>
                                <li><a href="#">Create a Coupon</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="waves-effect" href="#"><i class="fa fa-list-alt"></i><span>Reporting</span></a>
                        </li>-->
			<li class="has_sub">
                            <a class="waves-effect <?php if($this->router->fetch_class() == 'faq'):echo 'boldTitle  active';endif;?>" href="#"><i class="fa fa-question"></i> 
                        <span>FAQ</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li class="<?php if($this->router->fetch_class() == 'faq' && $this->router->fetch_method() != 'addFaq'):echo"boldTitle  active";endif;?>"><a href="<?php echo site_url('faq');?>">All FAQ</a></li>
                                <li class="<?php if($this->router->fetch_class() == 'faq' && $this->router->fetch_method() == 'addFaq'):echo"boldTitle  active";endif;?>"><a href="<?php echo site_url('faq/addFaq');?>">Add New Doctor</a></li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a class="waves-effect <?php if($this->router->fetch_class() == 'healthtip' && ($this->router->fetch_method() == 'index' OR $this->router->fetch_method() == 'addHealthtip')):echo"boldTitle  active";endif; ?>" href=""><i class="fa fa-gift"></i> <span>Health Tips</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li class="<?php  if($this->router->fetch_class() == 'healthtip' && $this->router->fetch_method() != ''):echo"boldTitle  active";endif;?>"><a class="<?php if($this->router->fetch_class() == 'healthtip' && $this->router->fetch_method() != ''):echo"boldTitle  active";endif;?>" href="<?php echo base_url();?>index.php/healthtip">All Healthtip Offers</a></li>

                                <li class="<?php  if($this->router->fetch_class() == 'sponserhealthtip' && $this->router->fetch_method() == 'index'):echo"boldTitle  active";endif;?>"><a  class="<?php if($this->router->fetch_class() == 'sponserhealthtip' && $this->router->fetch_method() == 'index'):echo"boldTitle  active";endif;?>" href="<?php echo base_url();?>index.php/sponserhealthtip">Sponsor Healthtip</a></li>

				<li class="<?php  if($this->router->fetch_class() == 'sponserhealthtip' && $this->router->fetch_method() == 'bookedsponser'):echo"boldTitle  active";endif;?>"><a class="<?php if($this->router->fetch_class() == 'sponserhealthtip' && $this->router->fetch_method() == 'bookedsponser'):echo"boldTitle  active";endif;?>" href="<?php echo base_url();?>index.php/sponserhealthtip/bookedsponser">Healthtip Bookings</a></li>
                                <!--<li><a href="#">Healthtip Messages</a></li>-->
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a class="waves-effect <?php if($this->router->fetch_class() == 'master' || $this->router->fetch_class() == 'healthcategory' || $this->router->fetch_class() == 'membership'):echo"boldTitle  active";endif;?>" href="#"><i class="fa fa-gift"></i> <span>Master</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li class="<?php if($this->router->fetch_class() == 'master' && $this->router->fetch_method() == 'index' OR $this->router->fetch_method() == 'specialities'):echo"boldTitle  active";endif;?>" ><a href="<?php echo site_url('master/specialities/');?>">Specialities</a></li>
                                <li class="<?php if($this->router->fetch_class() == 'master' && $this->router->fetch_method() == 'index' OR $this->router->fetch_method() == 'diagnostic'):echo"boldTitle  active";endif;?>" ><a href="<?php echo site_url('master/diagnostic/');?>">Diagnostic</a></li>
                                <li class="<?php if($this->router->fetch_class() == 'master' && $this->router->fetch_method() == 'index' OR $this->router->fetch_method() == 'degree'):echo"boldTitle  active";endif;?>"><a href="<?php echo site_url('master/degree/');?>">Degrees</a></li>
				<li class="<?php if($this->router->fetch_class() == 'master' && $this->router->fetch_method() == 'index' OR $this->router->fetch_method() == 'miType'):echo"boldTitle  active";endif;?>"><a href="<?php echo site_url('master/miType/');?>">MI Type</a></li>
                                <li class="<?php if($this->router->fetch_class() == 'healthcategory' && ($this->router->fetch_method() == 'index' OR $this->router->fetch_method() == 'addHealthCategory')):echo"boldTitle  active";endif; ?>"><a href="<?php echo base_url();?>index.php/healthcategory">Healthtip Category</a></li>
                                <li class="<?php if($this->router->fetch_class() == 'master' && ($this->router->fetch_method() == 'index' OR $this->router->fetch_method() == 'insurance')):echo"boldTitle  active";endif; ?>" ><a href="<?php echo base_url();?>index.php/master/insurance">Insurance</a></li>
				<li class="<?php if($this->router->fetch_class() == 'membership' && $this->router->fetch_method() == 'index' OR $this->router->fetch_method() == 'membershipAdd' OR $this->router->fetch_method() == 'membershipEditView'):echo"boldTitle  active";endif;?>"><a href="<?php echo site_url('membership/');?>">Membership</a></li>

				<li class="<?php if($this->router->fetch_class() == 'mi_master' && $this->router->fetch_method() == 'index' OR $this->router->fetch_method() == 'hospital' OR $this->router->fetch_method() == 'addHospital'):echo"boldTitle  active";endif;?>"><a href="<?php echo site_url('master/mi_master/hospital/');?>">Hospital Master</a></li>

                                <li class="<?php if($this->router->fetch_class() == 'mi_master' && $this->router->fetch_method() == 'index' OR $this->router->fetch_method() == 'diagnosticList' OR $this->router->fetch_method() == 'addDiagnostic'):echo"boldTitle  active";endif;?>"><a href="<?php echo site_url('master/mi_master/diagnosticList/');?>">Diagnostic Master</a></li>

                                <li class="<?php if($this->router->fetch_class() == 'city_master' && $this->router->fetch_method() == 'index' ):echo"boldTitle  active";endif;?>"><a href="<?php echo site_url('master/city_master/');?>">City Master</a></li>

                                 <li class="<?php if($this->router->fetch_class() == 'master' && $this->router->fetch_method() == 'index' OR $this->router->fetch_method() == 'awardAgency'):echo"boldTitle  active";endif;?>"><a href="<?php echo site_url('master/awardAgency/');?>">Award Agency</a></li>
                                 <li class="<?php if($this->router->fetch_class() == 'master' && $this->router->fetch_method() == 'index' OR $this->router->fetch_method() == 'department'):echo"boldTitle  active";endif;?>"><a href="<?php echo site_url('master/department/');?>">Department</a></li>
                                 <li class="<?php if($this->router->fetch_class() == 'master' && $this->router->fetch_method() == 'index' OR $this->router->fetch_method() == 'designation'):echo"boldTitle  active";endif;?>"><a href="<?php echo site_url('master/designation/');?>">Designation</a></li>
                                <!--<li><a href="#">Transaction Configuration</a></li>-->
                            </ul>
                        </li>
                        <li>
                            <a class="waves-effect <?php if($this->router->fetch_class() == 'setting'):echo"boldTitle  active";endif;?>" href="<?php echo site_url('setting');?>"><i class="fa fa-cog"></i><span>Settings</span></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Left Sidebar End -->
