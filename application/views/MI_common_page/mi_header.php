<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="<?php echo base_url();?>assets/images/fevicon-m.ico" rel="shortcut icon">
    <title>Dashboard</title>
    <link href="<?php echo base_url();?>assets/css/framework.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/custom-g.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/custom-r.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/responsive-r.css" rel="stylesheet" />
    <link type="text/css" href="<?php echo base_url();?>assets/vendor/js-scroll/style/scroll-2.css" rel="stylesheet" />

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

    </head><body class="fixed-left">
<!-- Begin page -->
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
                            <a class="logo" href="<?php echo site_url('midashboard');?>"><img src="<?php echo base_url();?>assets/images/qyura-f-l.png"></a>

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
                            <a aria-expanded="true" class="dropdown-toggle profile" data-toggle="dropdown" href=""><img alt="User" class="img-circle" src="<?php echo base_url();?>assets/<?php if($this->session->userdata("ses_mi_roleid")==1) echo "diagnosticsImage";else echo "diagnosticsImage";?>/<?php echo $this->session->userdata("ses_mi_image");?>"> <?php echo $this->session->userdata("ses_mi_name")?>
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="javascript:void(0)"><i class=
                                    "md md-face-unlock"></i> Profile</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><i class=
                                    "md md-settings"></i> Settings</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><i class=
                                    "md md-lock"></i> Lock screen</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url("auth/logout");?>"><i class=
                                    "md md-settings-power"></i> Logout</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown hidden-xs">
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
                        </li>
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
                        <a href="<?php echo site_url('midashboard');?>" class="waves-effect active"><i class="ion-ios7-keypad-outline"></i><span>Dashboard</span></a>
                    </li>
                    <li class="has_sub">
                        <a class="waves-effect" href="#"><i class="fa fa-stethoscope"></i> 
                            <span>Appointments</span><span class="pull-right"><i class="md md-add"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="consultation.html">Consulting</a></li>
                            <li><a href="diagnostic.html">Diagnostic</a></li>
                            <li><a href="addappointment.html">Add New Appointment</a></li>
                            <li><a href="upload-reports.html">Upload Test Reports</a></li>
                        </ul>
                    </li>
                    <li class="has_sub">
                        <a class="waves-effect" href="#"><i class="ion-clipboard"></i> 
                            <span>Quotations</span><span class="pull-right"><i class="md md-add"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="quotelist.html">Quote Requests</a></li>
                            <li><a href="send-quote.html">Send a Quote</a></li>
                            <li><a href="quote-history.html">Quotation History</a></li>
                        </ul>
                    </li>
                    <li class="has_sub">
                        <a class="waves-effect" href="#"><i class="fa fa-newspaper-o"></i><span>Healthcare Packag.</span><span class="pull-right"><i class="md md-add"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="health-packages.html">Healthcare Package</a></li>
                            <li><a href="add-health-package.html">Add New Package</a></li>
                            <li><a href="health-package-booking.html">Package Booking</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a class="waves-effect" href="#"><i class="fa fa-newspaper-o"></i><span>Medicart</span><span class="pull-right"><i class="md md-add"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="medicart-booking.html">Booking Requests</a></li>
                            <li><a href="medicart-enquiry.html">Enquiries</a></li>
                            <li><a href="add-medicat-offer.html">Add New Offer</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="call-tracking.html" class="waves-effect"><i class="ion-ios7-telephone-outline"></i><span>Call Tracking</span></a>
                    </li>
                    <li class="has_sub">
                        <a class="waves-effect" href="#"><i class="fa fa-stethoscope"></i> 
                            <span>Doctor Mgmt</span><span class="pull-right"><i class="md md-add"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="all-doctor.html">Doctor List</a></li>
                            <li><a href="add-doctor.html">Add New Doctor</a></li>
                            <li><a href="secheduling.html">Schedule & Availability</a></li>
                        </ul>
                    </li>
                    <li class="has_sub">
                        <a class="waves-effect" href="#"><i class="md md-account-circle"></i><span>Patient Mgmt</span><span class="pull-right"><i class="md md-add"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="all-patient.html">Patient List</a></li>
                            <li><a href="add-new-patient.html">Add Patient </a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="waves-effect" href="review-management.html"><i class="fa fa-star-o"></i><span>Rate & Reviews</span></a>
                    </li>
                    <li>
                        <a href="favouriteby.html" class="waves-effect"><i class="fa fa-star-o"></i><span>Favorited By</span></a>
                    </li>
                    <li>
                        <a href="#" class="waves-effect"><i class="fa fa-bar-chart-o"></i><span>Analytics</span></a>

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
                            <li><a href="promo-coupon.html">Coupons List</a></li>
                            <li><a href="create-coupon.html">Create a Coupon</a></li>
                        </ul>
                    </li>
                    <li class="has_sub">
                        <a class="waves-effect" href="sponser-healthtip.html"><i class="fa fa-gift"></i> <span>Sponsor Health Tips</span></a>
                    </li>
                    <li>
                        <a class="waves-effect" href="#"><i class="fa fa-list-alt"></i><span>Reporting</span></a>
                    </li>
                    <li>
                        <a class="waves-effect" href="setting.html"><i class="fa fa-cog"></i><span>Settings</span></a>
                    </li>

                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Left Sidebar End -->
      <!-- Start right Content here -->
    <div class="content-page">
        <!-- Start content -->
