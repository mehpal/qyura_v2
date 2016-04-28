<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="assets/images/fevicon-m.ico" rel="shortcut icon">
    <title>Pharmacy Details</title>
    <link href="assets/css/framework.css" rel="stylesheet">
    <link href="assets/css/datepicker.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link href="assets/css/custom-g.css" rel="stylesheet">
    <link href="assets/css/custom-r.css" rel="stylesheet">
    <link href="assets/css/responsive-r.css" rel="stylesheet" />
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
    <script src="assets/js/modernizr.min.js"></script>
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
                                <a class="logo" href="#"><img src="assets/images/qyura-f-l.png"></a>

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
                                <a aria-expanded="true" class="dropdown-toggle profile" data-toggle="dropdown" href=""><img alt="user-img" class="img-circle" src="assets/images/users/avatar-1.jpg"> Ramesh K
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
                                <li><a href="hospital-listing.html">All Hospitals</a></li>
                                <li><a href="add-hospital.html">Add New Hospital</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-plus-square"></i> 
                            <span>Diagnostic Centres</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="diagnostic-center-listing.html">All Diag Centres</a></li>
                                <li><a href="add-diagcenter.html">Add New Diag Centre</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-heartbeat"></i> 
                            <span>Blood Banks</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="all-bloodbank.html">All Blood Banks</a></li>
                                <li><a href="add-bloodbank.html">Add New Blood Bank</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect active" href="#"><i class="fa fa-medkit"></i> 
                            <span>Pharmacies</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li class="active"><a href="all-pharmacies.html">All Pharmacies</a></li>
                                <li><a href="add-pharmacy.html">Add New Pharmacies</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-ambulance"></i> 
                            <span>Ambulance Providr</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="all-ambulance-provider.html">All Ambulance Providers</a></li>
                                <li><a href="add-ambulance-provider.html">Add Ambulance Provider</a></li>
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
                <div class="container row">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Pharmacy Detail</h3>
                            <a href="all-pharmacies.html" class="btn btn-appointment btn-back waves-effect waves-light pull-right"><i class="fa fa-angle-left"></i> Back</a>

                        </div>
                    </div>

                    <!-- Left Section Start -->
                    <section class="col-md-12 detailbox m-t-10">


                        <div class="clearfix bg-white">
                            <!-- Table Section Start -->

                            <section class="col-md-12">

                                <aside class="clearfix m-bg-pic">


                                    <div class="bg-picture text-center">
                                        <div class="bg-picture-overlay"></div>
                                        <div class="profile-info-name">
                                            <div class='pro-img'>
                                                <!-- image -->
                                              <img src="assets/images/p-appolo.png"  alt="profile-image">
                                                <!-- description div -->
                                                <div class='pic-edit'>
                                                    <h3><a href="#" class="pull-center cl-white" title="Edit Logo"><i class="fa fa-pencil"></i></a></h3>
                                                </div>
                                                <!-- end description div -->
                                            </div>

                                            <h3 class="text-white">Apollo Pharmacies</h3>
                                            <h4>ABC Road Sector-12, Indraprastha<br/>New Delhi-100123</h4>

                                        </div>

                                    </div>
                                    <!--/ meta -->

                                </aside>
                                <section class="clearfix hospitalBtn">
                                    <div class="col-md-12">
                                        <a href="#" class="pull-right cl-white" title="Edit Background"><i class="fa fa-pencil"></i></a>

                                    </div>

                                </section>
                               <!-- Pharmacy Section Starts -->
                                
                                <article class="col-md-8 m-t-50">
                                    <aside class="clearfix amb-detail">
                                     <h4>Pharmacy Detail
                                     <a id="edit" href="#" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                                    </h4>
                                    <hr/>
                                    </aside>

                                    <!--Pharmacy Detail Starts -->
                                    <section class="tab-pane fade in active" id="detail">
                                        <div class="clearfix m-t-20 p-b-20 doctor-description">
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Pharmacy Name:</label>
                                                <p class="col-md-8 col-sm-8"> Appolo Pharmacies</p>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Pharmacy Type :</label>
                                                <p class="col-md-8 col-sm-8">Trauma Medicine </p>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Address:</label>
                                                <p class="col-md-6 col-sm-8">Siddharth Nagar, Mulund West, Mumbai, Maharashtra 400080</p>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Number:</label>
                                                <p class="col-md-8 col-sm-8">+91 731 7224401</p>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person Name:</label>
                                                <p class="col-md-8 col-sm-8">Jayant Chourasia</p>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Membership Type:</label>
                                                <p class="col-md-8 col-sm-8">Life Time</p>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">24/7 Service - Yes/No :</label>
                                                <p class="col-md-8 col-sm-8">Yes</p>
                                            </article>

                                        </div>
                                    </section>
                                    <!-- Pharmacy Deatail Ends -->
                                    
                                    <!-- Pharmacy Edit Ends -->
                                    <section id="editdetail" style="display:none">
                                        <div class="clearfix m-t-20 p-b-20 doctor-description">
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Pharmacy Name:</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input class="form-control" id="ambulanceProvider" name="ambulanceProvider" type="text" required="" value="Appolo Pharmacies">
                                                </div>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Pharmacy Type :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <select class="selectpicker" data-width="100%" name="membership">
                                                        <option value="1" selected>Medicine</option>
                                                        <option value="2">Homyopathic</option>
                                                         <option value="3">Herbal</option>
                                                    </select>
                                                </div>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Address:</label>
                                              <div class="col-md-8 col-sm-8">
                                            <aside class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <select class="selectpicker" data-width="100%" name="pharmacy_countryId" id="pharmacy_countryId">
                                                               <option value=''>Select Country</option>
                                                                <option value="1">INDIA</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                    <select class="selectpicker" data-width="100%" name="state">
                                                        <option>Select State</option>
                                                        <option selected>Maharashtra</option>
                                                        <option>Oddisa</option>
                                                    </select>
                                                </div>
                                            </aside>
                                            <!--<aside class="row m-t-10">
                                                <div class="col-md-6 col-sm-6">
                                                    <select class="selectpicker" data-width="100%" name="city">
                                                        <option>Select City</option>
                                                        <option selected>Mumbai</option>
                                                        <option>Delhi</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                    <input type="text" class="form-control" id="zip" name="zip" value="400080" />
                                                </div>
                                            </aside>-->
                                            <div class="clearfix m-t-10">
                                           <textarea class="form-control" id="geocomplete" name="pharmacy_address" type="text" ><?php if(isset($pharmacyData[0]->pharmacy_address)){ echo $pharmacyData[0]->pharmacy_address; }?></textarea>
                                           <label class="error" > <?php echo form_error("pharmacy_address"); ?></label>
                                        </div>
                                        </div>
                                            </article>
                                            <article class="clearfix m-b-10 ">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <?php 
                                                                    $explodes= explode('|',$pharmacyData[0]->pharmacy_phn); 
                                                                    for($i= 0; $i< count($explodes)-1;$i++){
                                                                    $moreExpolde = explode(' ',$explodes[$i]);?>
                                                                    
                                                                    
                                                                    <aside class="row">
                                                                        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-12">
                                                                            <select class="selectpicker" data-width="100%" name="pre_number[]">
                                                                                <option value="91" <?php if($moreExpolde[0] == '91'){ echo 'selected';}?>>+91</option>
                                                                                <option value="1" <?php if($moreExpolde[0] == '1'){ echo 'selected';}?>>+1</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-10 m-t-xs-10">
                                                                            <input type="text" class="form-control" name="pharmacy_phn[]" id="pharmacy_phn<?php echo $i;?>" placeholder="9837000123" value="<?php echo $moreExpolde[1];?>" maxlength="10" onblur="checkNumber(<?php echo $i;?>)"/>
                                                                        </div>
                                                                       
                                                                    </aside>
                                                                    <br />
                                                                    <?php $moreExpolde ='';}?>
                                                               
                                                                    <p class="m-t-10">* If it is landline, include Std code with number </p>
                                                                </div>
                                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Mobile Number:</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <aside class="row">
                                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                                            <select class="selectpicker" data-width="100%">
                                                                <option selected>+91</option>
                                                                <option>+1</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-9 col-sm-9 col-xs-12 m-t-xs-10">
                                                            <input type="text" class="form-control" name="mobile" id="mobile" value="9837000123" />
                                                        </div>


                                                    </aside>
                                                </div>
                                            </article>

                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person:</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                 
                                                                    <input class="form-control" id="pharmacy_cntPrsn" name="pharmacy_cntPrsn" type="text" value="<?php if(isset($pharmacyData[0]->pharmacy_cntPrsn)){ echo $pharmacyData[0]->pharmacy_cntPrsn; }?>">
                                                               <label class="error" > <?php echo form_error("pharmacy_cntPrsn"); ?></label>
                                                               </div>
                                                            </article>

                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Membership Type:</label>
                                                <div class="col-md-8 col-sm-8">
                                                     <select class="selectpicker" data-width="100%" name="pharmacy_mmbrTyp" id="pharmacy_mmbrTyp">
                                                <option value="1">Life Time</option>
                                                <option value="2">Health Club</option>
                                            </select>
                                                </div>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">24/7 Service - Yes/No :</label>
                                                <div class="col-md-8 col-sm-8">
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
                                            <article class="clearfix ">
                                              <div class="col-md-12 m-t-20 m-b-20">
                                                <button type="button" class="btn btn-success waves-effect waves-light pull-right" onclick="return validationPharmacy();">Update</button>
                                              </div>
                                            </article>

                                        </div>
                                    </section>
                                    <!-- Pharmacy Edit Ends -->

                                </article>
                            <!-- Pharmacy Section Ends -->


                    </div>
                    </section>
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
     <script src="<?php echo base_url();?>assets/js/jquery-1.8.2.min.js"> </script>
    <script src="<?php echo base_url();?>assets/js/framework.js"> </script>
        <script src="<?php echo base_url();?>assets/js/pages/blood-detail.js">
    </script>
     <script src="<?php echo base_url();?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>

    <script type="text/javascript" src="https://www.google.com/jsapi">
    </script>
    
   <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>

    <script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>
    <script>
         var urls = "<?php echo base_url()?>";
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
      
       function validationPharmacy(){
           
       //$("form[name='bloodDetail']").submit();
        var check= /^[a-zA-Z\s]+$/;
        var numcheck=/^[0-9]+$/;
        var emails = $.trim($('#users_email').val());
        var cpname = $.trim($('#pharmacy_cntPrsn').val());
        
       
            if($.trim($('#pharmacy_name').val()) === ''){
                $('#pharmacy_name').addClass('bdr-error');
                
            }
          
            if($.trim($('#geocomplete').val()) === ''){
               $("#geocomplete").addClass('bdr-error');
               
            }
             if(!check.test(cpname)){
                $('#pharmacy_cntPrsn').addClass('bdr-error');
                
            }
            
            if( emails !== ''){
                check_email(emails);
            }
            
            return false;
            
        }
        
        function checkNumber(id){
            var phone = $.trim($('#'+'pharmacy_phn'+id).val());
            if(!($.isNumeric(phone))){
             $('#'+'pharmacy_phn'+id).addClass('bdr-error');
         }
        }
        
        function checkEmailFormat(){
                var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                var email = $('#users_email').val();
                if(email!==''){
                    if (!filter.test(email)){
                       $('#users_email').addClass('bdr-error');
                    }
            }
        } 
        
        function check_email(myEmail){
            var user_table_id = $('#user_tables_id').val();
           $.ajax({
               url : urls + 'index.php/pharmacy/check_email',
               type: 'POST',
              data: {'users_email' : myEmail,'user_table_id' : user_table_id },
              success:function(datas){
                 // console.log(datas);
                  if(datas == 0){
                   $("form[name='pharmacyDetail']").submit();
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