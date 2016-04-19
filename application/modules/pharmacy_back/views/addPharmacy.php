<?php //print_r($allStates); exit;?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="<?php echo base_url();?>assets/images/fevicon-m.ico" rel="shortcut icon">
    <title>Add New Pharmacy</title>
    <link href="<?php echo base_url();?>assets/css/framework.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/datepicker.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/custom-g.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/custom-r.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/css/responsive-r.css" rel="stylesheet" />

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
     <![endif]-->
    <script src="<?php echo base_url();?>assets/js/modernizr.min.js"></script>
</head>

<body class="fixed-left">
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
                                <a class="logo" href="#"><img src="<?php echo base_url()?>assets/images/qyura-f-l.png"></a>

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
                                <a aria-expanded="true" class="dropdown-toggle profile" data-toggle="dropdown" href=""><img alt="user-img" class="img-circle" src="<?php echo base_url();?>assets/images/users/avatar-1.jpg"> Ramesh K
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
                                        <a href="javascript:void(0)"><i class=
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
                            <a href="dashboard.html" class="waves-effect"><i class="ion-ios7-keypad-outline"></i><span>Dashboard</span></a>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-hospital-o"></i> 
                            <span>Hospitals</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="<?php echo base_url();?>index.php/hospital">All Hospitals</a></li>
                                <li><a href="<?php echo base_url();?>index.php/hospital/addHospital">Add New Hospital</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-plus-square"></i> 
                            <span>Diagnostic Centres</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="<?php echo base_url();?>index.php/diagnostic">All Diag Centres</a></li>
                                <li><a href="<?php echo base_url();?>index.php/diagnostic/addDiagnostic">Add New Diag Centre</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-heartbeat"></i> 
                            <span>Blood Banks</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="<?php echo base_url();?>index.php/bloodbank">All Blood Banks</a></li>
                                <li><a href="<?php echo base_url();?>index.php/bloodbank/Addbloodbank">Add New Blood Bank</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect active" href="#"><i class="fa fa-medkit"></i> 
                            <span>Pharmacies</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="<?php echo base_url();?>index.php/pharmacy">All Pharmacies</a></li>
                                <li class="active"><a href="<?php echo base_url();?>index.php/pharmacy/addPharmacy">Add New Pharmacies</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-ambulance"></i> 
                            <span>Ambulance Providr</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="<?php echo base_url();?>index.php/ambulance">All Ambulance Providers</a></li>
                                <li><a href="<?php echo base_url();?>index.php/ambulance/addAmbulance">Add Ambulance Provider</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-stethoscope"></i> 
                            <span>Doctors</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="all-doctor.html">All Doctors</a></li>
                                <li><a href="add-doctor.html">Add New Doctor</a></li>
                                <li><a href="#">Schedule & Availability</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-stethoscope"></i> 
                            <span>MI Appointments</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="#">Pending Appointments</a></li>
                                <li><a href="all-appointment.html">All Appointments</a></li>
                                <li><a href="addappointment.html">Add New Appointment</a></li>
                                <li><a href="upload-reports.html">Upload Test Reports</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-stethoscope"></i> 
                            <span>Dr. Appointments</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="#">Pending Appointments</a></li>
                                <li><a href="doctor-appointments.html">All Appointments</a></li>
                                <li><a href="add-doctor-appointment.html">Add New Appointment</a></li>

                            </ul>
                        </li>


                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="ion-clipboard"></i> 
                            <span>Quotations</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="#">Pending Quotation Req.</a></li>
                                <li><a href="quotelist.html">All Quotation Requests</a></li>
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
                                <li><a href="medicart-offer-list.html">Medicart Offers</a></li>
                                <li><a href="medicart-booking.html">Booking Requests</a></li>
                                <li><a href="medicart-enquiry.html">Enquiries</a></li>
                                <li><a href="add-medicat-offer.html">Add New Offer</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="call-tracking.html" class="waves-effect"><i class="ion-ios7-telephone-outline"></i><span>Call Tracking</span></a>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="md md-account-circle"></i><span>User Management</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="all-user.html">User List</a></li>
                                <li><a href="add-user.html">Add New User</a></li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-star-o"></i><span>Rate & Reviews</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="review-management.html">All Reviews</a></li>
                                <li><a href="#">Ratings</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#" class="waves-effect"><i class="fa fa-star-o"></i><span>Favorited By</span></a>
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


                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-gift"></i> <span>Sponsor Health Tips</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="#">All Healthtip Offers</a></li>
                                <li><a href="#">Healthtip Bookings</a></li>
                                <li><a href="#">Healthtip Messages</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="waves-effect" href="#"><i class="fa fa-list-alt"></i><span>Reporting</span></a>
                        </li>
                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-gift"></i> <span>Master</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="specialities.html">Specialities</a></li>
                                <li><a href="diagnostics.html">Diagnostics</a></li>
                                <li><a href="degrees.html">Doctor Degrees</a></li>
                                <li><a href="#">Memberships</a></li>
                                <li><a href="#">Transaction Configuration</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="waves-effect" href="#"><i class="fa fa-cog"></i><span>Settings</span></a>
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
            <div class="content">
                <div class="container">


                    <div class="clearfix">
                        <div class="col-md-12 text-success">
                            <?php echo $this->session->flashdata('message'); ?>
                        </div>
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Add New Pharmacy</h3>

                        </div>
                    </div>
                    <div class="map_canvas"></div>
                     <form class="cmxform form-horizontal tasi-form" id="pharmacyForm" name="pharmacyForm" method="post" action="<?php echo site_url(); ?>/pharmacy/SavePharmacy" novalidate="novalidate" enctype="multipart/form-data" >
                        <input type="hidden" id="StateId" name="StateId" value="" />
                       
                        <!-- Left Section Start -->
                        <section class="col-md-12 detailbox">
                            <div class="bg-white mi-form-section">
                                <article class="clearfix">
                                    <aside class="col-md-8">
                                        <div class="clearfix m-t-20 p-b-20">
                                            <article class="form-group m-lr-0 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Pharmacy Name :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input class="form-control" id="pharmacy_name" name="pharmacy_name" type="text" required="">
                                                    <label class="error" style="display:none;" id="error-pharmacy_name"> please enter pharmacy name</label>
                                                    <label class="error" > <?php echo form_error("pharmacy_name"); ?></label>
                                                </div>
                                            </article>
                                            <article class="form-group m-lr-0">
                                                <label for="cname" class="control-label col-md-4 col-sm-4">Pharmacy Type :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <select class="selectpicker" data-width="100%" name="pharmacyType">
                                                       <option value="1" selected>Medicine</option>
                                                        <option value="2">Homyopathic</option>
                                                         <option value="3">Herbal</option>
                                                    </select>
                                                </div>
                                            </article>
                                            <article class="form-group m-lr-0 ">
                                                <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                                                <div class="col-md-8 col-sm-8 text-right">
                                                    <label for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x"></i></label>
                                                   <input type="file" style="display:none;" class="no-display" id="file-input" name="pharmacy_img">
                                            <label class="error" > <?php echo form_error("pharmacy_img"); ?></label>
                                            <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                                                </div>
                                            </article>


                                            <article class="form-group m-lr-0">
                                                <label for="cname" class="control-label col-md-4 col-sm-4">Address:</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <aside class="row">
                                                        <div class="col-md-6 col-sm-6">
                                                            <select class="selectpicker" data-width="100%" name="pharmacy_countryId" id="pharmacy_countryId">
                                                               <option value=''>Select Country</option>
                                                                <option value="1">INDIA</option>
                                                              
                                                            </select>
                                                            <label class="error" style="display:none;" id="error-pharmacy_countryId"> please select a country</label>
                                                            <label class="error" > <?php echo form_error("pharmacy_countryId"); ?></label>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                        <select class="selectpicker" data-width="100%" name="pharmacy_stateId" Id="pharmacy_stateId" data-size="4" onchange ="fetchCity(this.value)">
                                                        <option value="">Select State</option>
                                                       <?php foreach($allStates as $key=>$val) {?>
                                                        <option value="<?php echo $val->state_id;?>"><?php echo $val->state_statename;?></option>
                                                         <?php }?>
                                                    </select>
                                                    <label class="error" style="display:none;" id="error-pharmacy_stateId"> please select a state</label>
                                                    <label class="error" > <?php echo form_error("pharmacy_stateId"); ?></label>
                                                </div>
                                                    </aside>
                                                </div>
                                            </article>

                                            <article class="form-group m-lr-0">
                                                <div class="col-sm-8 col-sm-offset-4">
                                            <aside class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <select class="selectpicker" data-width="100%" name="pharmacy_cityId" id="pharmacy_cityId" data-size="4">
                                                        <!--<option>Select City</option>
                                                        <option>Kolkata</option>
                                                        <option>Delhi</option>-->
                                                    </select>
                                                    <label class="error" style="display:none;" id="error-pharmacy_cityId"> please select a city</label>

                                                </div>
                                                        
                                                <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                    <input type="text" class="form-control" id="pharmacy_zip" name="pharmacy_zip" placeholder="700001" maxlength="13" />
                                                <label class="error" style="display:none;" id="error-pharmacy_zip"> please enter a zip code</label>   
                                                <label class="error" > <?php echo form_error("pharmacy_zip"); ?></label>
                                                </div>                                            
                                            </aside>
                                        </div>
                                            </article>

                                           <article class="form-group m-lr-0">
                                        <div class="col-sm-8 col-sm-offset-4">
                                            <input type="text" class="form-control" name="pharmacy_address" id="geocomplete" placeholder="209, ABC Road, near XYZ Building " />
                                        <label class="error" style="display:none;" id="error-pharmacy_address"> please enter an address</label>
                                            <label class="error" > <?php echo form_error("pharmacy_address"); ?></label>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Registered Email Id:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="email" class="form-control" id="users_email" name="users_email" placeholder="abc@gmail.com" onblur="checkEmailFormat()" />
                                            <label class="error" style="display:none;" id="error-users_email"> please enter Email id Properly</label>
                                            <label class="error" style="display:none;" id="error-users_email_check"> Email Already Exits!</label>
                                            <label class="error" > <?php echo form_error("users_email"); ?></label>
                                        </div>
                                    </article>
                                           <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4  col-sm-4">Phone:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <a href="javascript:void(0)" class="add pull-right" rel=".clone"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a>
                                            <aside class="row clone">
                                                <div class="col-lg-3 col-md-4 col-sm-3 col-sm-4 col-xs-12 m-t-xs-10" id="multiPreNumber">
                                                    <select class="selectpicker" data-width="100%" name="pre_number[]" id="multiPreNumber">
                                                        <option value ='91'>+91</option>
                                                        <option value ='1'>+1</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-7 col-md-6 col-sm-7 col-xs-10 m-t-xs-10" id="multiPhoneNumber">
                                                    <input type="text" class="form-control" name="pharmacy_phn[]" id="pharmacy_phn1" placeholder="9837000123" maxlength="10" />
                                                    <label class="error" style="display:none;" id="error-pharmacy_phn1"> please enter a valid phone number</label>
                                                    <label class="error" > <?php echo form_error("pharmacy_phn1"); ?></label>
                                                </div>
                                            </aside>
                                            <p class="m-t-10">* If it is landline, include Std code with number </p>
                                        </div>
                                    </article>
                                            <article class="form-group m-lr-0 ">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" name="pharmacy_cntPrsn" type="text" required="" id="pharmacy_cntPrsn">
                                           <label class="error" style="display:none;" id="error-pharmacy_cntPrsn">please enter name properly!</label>
                                           <label class="error" > <?php echo form_error("pharmacy_cntPrsn"); ?></label>
                                        </div>
                                    </article>

                                           <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Membership Type :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" data-width="100%" name="pharmacy_mmbrTyp" id="pharmacy_mmbrTyp">
                                                <option value="1">Life Time</option>
                                                <option value="2">Health Club</option>
                                            </select>
                                            <label class="error" style="display:none;" id="error-pharmacy_mmbrTyp">please enter only charcters!</label>
                                            <label class="error" > <?php echo form_error("pharmacy_mmbrTyp"); ?></label>
                                        </div>
                                    </article>
                                           <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4">24/7 Services ? </label>
                                        <div class="col-md-8">
                                            <aside class="radio radio-info radio-inline">
                                                <input type="radio" id="isEmergency_yes" value="1" name="isEmergency" checked>
                                                <label for="inlineRadio1"> Yes</label>
                                            </aside>
                                            <aside class="radio radio-info radio-inline">
                                                <input type="radio" id="isEmergency_no" value="option2" name="isEmergency">
                                                <label for="inlineRadio2"> No</label>
                                            </aside>
                                        </div>
                                    </article>

                                    </aside>
                                </article>
                                </div>
                                <!-- .form -->
                            </div>

                        </section>
                        <!-- Left Section End -->


                            <section class="clearfix ">
                            <div class="col-md-12 m-t-20 m-b-20">
                                <button class="btn btn-danger waves-effect pull-right" type="button">Reset</button>
                                <div>
                                    <input class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit" onclick="return validationPharmacy()" value="Submit" />
                                </div>
                            </div>

                        </section>

                        <fieldset>
                            
                            <input name="lat" type="hidden" value="22.725473" />

                           <!-- <label>Longitude</label> -->
                            <input name="lng" type="hidden" value="75.893852" />

                          </fieldset>
                    </form>


                    <!-- consultation -->

                </div>

                <!-- container -->
            </div>
            <!-- content -->
            <footer class="footer text-right">
                2015 © Qyura.
            </footer>
        </div>
        <!-- End Right content here -->
    </div>
    <!-- END wrapper -->


     <script>
        var resizefunc = [];
    </script>

    <script src="<?php echo base_url();?>assets/js/jquery-1.8.2.min.js">
    </script>
    <script src="<?php echo base_url();?>assets/js/framework.js">
    </script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js">
    </script>
    <script src="<?php echo base_url();?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>

    <!--<script type="text/javascript" src="https://www.google.com/jsapi">
    </script>-->
    <script>
        $('#date-3').datepicker();
    </script>
    
    <script src="<?php echo base_url();?>assets/js/reCopy.js"></script>
    
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->

    <script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>
     <script>
         $(function(){

        $("#geocomplete").geocomplete({
           map: ".map_canvas",
          details: "form",
          types: ["geocode", "establishment"],
        });

        $("#find").click(function(){
           $("#geocomplete").trigger("geocode");
        });
      });
        
    </script>
 <script>
      $(function(){
            var removeLink = '<a class="remove" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false"> <i class="fa fa-minus-circle fa-2x m-t-5 label-plus"></i></a>';
          $('a.add').relCopy({ append: removeLink});    
          
          });
        var urls = "<?php echo base_url()?>";
         var j = 1;
         
        function fetchCity(stateId) {    
           
           $.ajax({
               url : urls + 'index.php/pharmacy/fetchCity',
               type: 'POST',
              data: {'stateId' : stateId},
              success:function(datas){
               // console.log(datas);
                  $('#pharmacy_cityId').html(datas);
                  $('#pharmacy_cityId').selectpicker('refresh');
                  $('#StateId').val(stateId);
              }
           });
           
        }
        function countPhoneNumber(){
        if(j==10)
            return false;
      j = parseInt(j)+parseInt(1); 
      $('#countPnone').val(j);
      $('#multiPhoneNumber').append('<input type=text class=form-control name=pharmacy_phn[] placeholder=9837000123 maxlength="10" id=pharmacy_phn'+j + ' />');
     $('#multiPreNumber').append('<select class=selectpicker data-width=100% name=pre_number[] id=multiPreNumber'+j+'><option value=91>+91</option><option value=1>+1</option></select>');
      $('#multiPreNumber'+j).selectpicker('refresh');
      //.append('<div class=col-lg-3 col-md-4 col-sm-3 col-sm-4 col-xs-12 m-t-xs-10 id=multiPreNumber><select class=selectpicker data-width=100% name=pre_number[] id=multiPreNumber><option value =91>+91</option><option value =1>+1</option></select></div><div class=col-lg-7 col-md-6 col-sm-7 col-xs-10 m-t-xs-10 id=multiPhoneNumber><nput type=text class="form-control" name=hospital_phn[] id=hospital_phn1 placeholder=9837000123 maxlength=10 /> </div>');

   }
        
        
   function validationPharmacy(){
             //$("form[name='pharmacyForm']").submit();
       
        var check= /^[a-zA-Z\s]+$/;
        var numcheck=/^[0-9]+$/;
        var emails = $.trim($('#users_email').val());
        var cpname = $.trim($('#pharmacy_cntPrsn').val());        
        var phn= $.trim($('#pharmacy_phn1').val());
        var myzip = $.trim($('#pharmacy_zip').val());
        var cityId =$.trim($('#pharmacy_cityId').val());
        var stateIds = $.trim($('#StateId').val());
        //var status =1;
    //debugger;
   
            if($('#pharmacy_name').val()==''){
                $('#pharmacy_name').addClass('bdr-error');
                $('#error-pharmacy_name').fadeIn().delay(3000).fadeOut('slow');
                //status= 0;
               // $('#hospital_name').focus();
            }
           if($('#pharmacy_type').val()==''){
                $('#pharmacy_type').addClass('bdr-error');
                $('#error-pharmacy_type').fadeIn().delay(3000).fadeOut('slow');
                //status= 0;
               // $('#hospital_type').focus();
            }
            if($.trim($('#pharmacy_countryId').val()) == ''){
                $('#pharmacy_countryId').addClass('bdr-error');
                $('#error-pharmacy_countryId').fadeIn().delay(3000).fadeOut('slow');
                //status= 0;
               // $('#hospital_countryId').focus();
            }
           if(!$.isNumeric(stateIds)){
               // console.log("in state");
                $('#pharmacy_stateId').addClass('bdr-error');
                $('#error-pharmacy_stateId').fadeIn().delay(3000).fadeOut('slow');
                //status= 0;
               // $('#hospital_stateId').focus();
            }
            if(!$.isNumeric(cityId)){
                $('#pharmacy_cityId').addClass('bdr-error');
                $('#error-pharmacy_cityId').fadeIn().delay(3000).fadeOut('slow');
               // status= 0;
               // $('#hospital_cityId').focus();
            }
           
            if(!$.isNumeric(myzip)){
                
                $('#pharmacy_zip').addClass('bdr-error');
                $('#error-pharmacy_zip').fadeIn().delay(3000).fadeOut('slow');
                //status= 0;
                // $('#hospital_zip').focus();
            } 

            if($("input[name='pharmacy_address']" ).val()==''){
                $('#pharmacy_address').addClass('bdr-error');
                $('#error-pharmacy_address').fadeIn().delay(3000).fadeOut('slow');
                //status= 0;
               // $('#hospital_address').focus();
            }
            
            
            if(!$.isNumeric(phn)){
                $('#pharmacy_phn1').addClass('bdr-error');
                $('#error-pharmacy_phn1').fadeIn().delay(3000).fadeOut('slow');
                //status= 0;
                // $('#hospital_phn').focus();
            }
            
            if(!check.test(cpname)){
                $('#pharmacy_cntPrsn').addClass('bdr-error');
                $('#error-pharmacy_cntPrsn').fadeIn().delay(3000).fadeOut('slow');
                //status= 0;
                // $('#hospital_cntPrsn').focus();
            }
           
            if($('#pharmacy_mmbrTyp').val()==''){
                $('#pharmacy_mmbrTyp').addClass('bdr-error');
                $('#error-pharmacy_mmbrTyp').fadeIn().delay(3000).fadeOut('slow');
                //status= 0;
               // $('#hospital_mmbrType').focus();
            }
            if($('#users_email').val()==''){
                $('#users_email').addClass('bdr-error');
                $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');
               // $('#users_email').focus();
            }
            if(emails !=''){
              check_email(emails);
              return false;
            }
            return false;
        //debugger;
        }
        function checkEmailFormat(){
                var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                var email = $('#users_email').val();
                if(email!==''){
                    if (!filter.test(email)){
                        
                       $('#users_email').addClass('bdr-error');
                         $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');;
                        // $('#users_email').focus();

                    }
            }
        }   
          function check_email(myEmail){
           $.ajax({
               url : urls + 'index.php/pharmacy/check_email',
               type: 'POST',
              data: {'users_email' : myEmail},
              success:function(datas){
                  if(datas == 0){
                   $("form[name='pharmacyForm']").submit();
                   return true;
              }
              else {
                        $('#users_email').addClass('bdr-error');
                    $('#error-users_email_check').fadeIn().delay(3000).fadeOut('slow');;
                   return false;
                  }
              } 
           });
        }  
        
         
 </script>       
</body>

</html>
