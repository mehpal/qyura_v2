<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="<?php echo base_url();?>assets/images/fevicon-m.ico" rel="shortcut icon">
    <title>Add New Hospital</title>
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
    <style>.img-preview-sm {
        height: 175px;
        width: 200px;
        }
    </style>
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
                            <a class="waves-effect active" href="#"><i class="fa fa-hospital-o"></i> 
                            <span>Hospitals</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="<?php echo base_url();?>index.php/hospital">All Hospitals</a></li>
                                 <li class="active"><a href="<?php echo base_url();?>index.php/hospital/addHospital">Add New Hospital</a></li>
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
                            <a class="waves-effect" href="#"><i class="fa fa-medkit"></i> 
                            <span>Pharmacies</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="<?php echo base_url();?>index.php/pharmacy">All Pharmacies</a></li>
                                <li><a href="<?php echo base_url();?>index.php/pharmacy/addPharmacy">Add New Pharmacies</a></li>
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
                            <h3 class="pull-left page-title">Add New Hospital</h3>

                        </div>
                    </div>
                    <div class="map_canvas"></div>
                    <form class="cmxform form-horizontal tasi-form" id="hospitalForm" name="hospitalForm" method="post" action="<?php echo site_url('hospital/SaveHospital'); ?>" novalidate="novalidate" enctype="multipart/form-data" >
                        <input type="hidden" id="countPnone" name="countPnone" value="1" />
                        <input type="hidden" id="countbloodBank_phn" name="countbloodBank_phn" value="1" />
                        <input type="hidden" id="countPharmacy_phn" name="countPharmacy_phn" value="1" />
                       <input type="hidden" id="countAmbulance_phn" name="countAmbulance_phn" value="1" />
                       <input type="hidden" id="serviceName" name="serviceName" value="1" />
                       <input type="hidden" id="StateId" name="StateId" value="" />
                       <input type="hidden" id="countServiceName" name="countServiceName" value="1" />
                        <!-- Left Section Start -->
                        <section class="col-md-6 detailbox">
                            <div class="bg-white mi-form-section">
                                <figure class="clearfix">
                                    <h3>General Detail</h3>
                                </figure>
                                <!-- Table Section End -->
                                <div class="clearfix m-t-20 p-b-20">
                                   
                                    <article class="form-group m-lr-0 ">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Hospital Name :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" id="hospital_name" name="hospital_name" type="text" required="">
                                            <label class="error" style="display:none;" id="error-hospital_name"> please enter hospital name</label>
                                            <label class="error" > <?php echo form_error("hospital_name"); ?></label>
                                        </div>
                                    </article>
                                    
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4  col-sm-4">Hospital Type :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" data-width="100%" name="hospital_type" id="hospital_type">
                                                <option value="1"> Trauma Centres</option>
                                                <option value="2">Rehabilitation Hospitals</option>
                                                <option value="3">Children's Hospitals</option>
                                            </select>
                                             <label class="error" style="display:none;" id="error-hospital_type"> please enter hospital type</label>
                                             <label class="error" > <?php echo form_error("hospital_type"); ?></label>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0 ">
                                        <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Hospital Logo :</label>
                                        <div class="col-md-8 col-sm-8 text-right">
                                            <label for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x"></i></label>
                                            <input type="file" style="display:none;" class="no-display" id="file-input" name="hospital_img">
                                            <label class="error" > <?php echo form_error("hospital_img"); ?></label>
                                            <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                                            
                                            <!--<div class="row">
                                                    <div class="col-md-5">
                                                        <div class="image-crop">
                                                            <img height="10" width="10" src="<?php echo base_url(); ?>assets/images/noImage.png">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <h4>Preview image</h4>
                                                        <div class="img-preview img-preview-sm"></div>
                                                        
                                                        <div class="btn-group">
                                                            <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                                                <input type="file" accept="image/*" name="hospital_photo" id="inputImage" class="hide" onchange="ValidateSingleInput(this,'2','5');">
                                                                Upload new image
                                                            </label>
                                                        </div>
                                                       <div class="btn-group">
                                                            <button class="btn btn-white" id="zoomIn" type="button">Zoom In</button>
                                                            <button class="btn btn-white" id="zoomOut" type="button">Zoom Out</button>
                                                            <button class="btn btn-white" id="rotateLeft" type="button">Rotate Left</button>
                                                            <button class="btn btn-white" id="rotateRight" type="button">Rotate Right</button>
                                                        </div>
                                                        <input required="" type="hidden" id="imageData" name="imageData">
                                                    </div>
                                                </div>-->
                                        </div>
                                    </article>


                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Address:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <aside class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <select class="selectpicker" data-width="100%" name="hospital_countryId" id="hospital_countryId">
                                                        <option value=' '>Select Country</option>
                                                        <option value="1">INDIA</option>
                                                         
                                                    </select>
                                                    <label class="error" style="display:none;" id="error-hospital_countryId"> please select a country</label>
                                                    <label class="error" > <?php echo form_error("hospital_countryId"); ?></label>
                                                </div>
                                                <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                    <select class="selectpicker" data-width="100%" name="hospital_stateId" id="hospital_stateId" data-size="4" onchange ="fetchCity(this.value)">

                                                        <option value="">Select State</option>
                                                       <?php foreach($allStates as $key=>$val) {?>
                                                        <option value="<?php echo $val->state_id;?>"><?php echo $val->state_statename;?></option>
                                                         <?php }?>
                                                    </select>
                                                    <label class="error" style="display:none;" id="error-hospital_stateId"> please select a state</label>
                                                    <label class="error" > <?php echo form_error("hospital_stateId"); ?></label>
                                                </div>
                                            </aside>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                            <aside class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <select class="selectpicker" data-width="100%" name="hospital_cityId" id="hospital_cityId" data-size="4">
                                                        <!--<option>Select City</option>
                                                        <option>Kolkata</option>
                                                        <option>Delhi</option>-->
                                                    </select>
                                                    <label class="error" style="display:none;" id="error-hospital_cityId"> please select a city</label>
                                                </div>
                                                <div class="col-md-6 col-sm-6 m-t-xs-10"> 
                                                    <input type="text" class="form-control" id="hospital_zip" name="hospital_zip" placeholder="700001" />
                                                    <label class="error" style="display:none;" id="error-hospital_zip"> please enter a zip code</label>
<label class="error" style="display:none;" id="error-hospital_zip_check">Please enter numeric digits only!</label>
                                                    <label class="error" > <?php echo form_error("hospital_zip"); ?></label>
                                                </div>
                                            </aside>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                            <input type="text" class="form-control" id="geocomplete" name="hospital_address" placeholder="209, ABC Road, near XYZ Building " />
                                            <label class="error" style="display:none;" id="error-hospital_address"> please enter an address</label>
                                            <label class="error" > <?php echo form_error("hospital_address"); ?></label>
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
                                                    <input type="text" class="form-control" name="hospital_phn[]" id="hospital_phn1" placeholder="9837000123" maxlength="10" />
                                                    <label class="error" style="display:none;" id="error-hospital_phn"> please enter a valid phone number</label>
                                                    <label class="error" > <?php echo form_error("hospital_phn"); ?></label>
                                                </div>
                                            </aside>
                                            <p class="m-t-10">* If it is landline, include Std code with number </p>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4  col-sm-4">Hospital Services:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <a href="javascript:void(0)" class="add pull-right" onclick="countserviceName()" ><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a>
                                           
                                            <aside class="row">
                                                
                                                <div class="col-lg-10 col-md-10 col-sm-7 col-xs-10 m-t-xs-10" id="multiserviceName">
                                                    <input type="text" class="form-control" name="hospitalServices_serviceName[]" id="hospitalServices_serviceName1" placeholder="Give Your Service Name" maxlength="30" />
                                                    <label class="error" style="display:none;" id="error-hospitalServices_serviceName"> please enter a hospital service Name without Numeric value</label>
                                                    <label class="error" > <?php echo form_error("hospitalServices_serviceName"); ?></label>
                                                    
                                                </div>
                                               

                                            </aside>
                                           
                                        </div>
                                    </article>
                                   

                                    <article class="form-group m-lr-0 ">
                                        <label for="cemail" class="control-label col-md-4  col-sm-4">Contact Person :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" id="hospital_cntPrsn" name="hospital_cntPrsn" type="text" required="">
                                            <label class="error" style="display:none;" id="error-hospital_cntPrsn"> please enter the name of a contact person</label>
   <label class="error" style="display:none;" id="error-hospital_cntPrsn_check">please enter characters only!</label>
                                            <label class="error" > <?php echo form_error("hospital_cntPrsn"); ?></label>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0 ">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Designation :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" id="hospital_dsgn" name="hospital_dsgn" type="text" required="">
                                            <label class="error" style="display:none;" id="error-hospital_dsgn"> please enter a designation</label>
<label class="error" style="display:none;" id="error-hospital_dsgn_check">please enter only charcters!</label>
                                            <label class="error" > <?php echo form_error("hospital_dsgn"); ?></label>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Membership Type :</label>
                                        <div class="col-md-8  col-sm-8">
                                            <select class="selectpicker" data-width="100%" name="hospital_mmbrTyp" id="hospital_mmbrTyp">
                                                <option value="1">Life Time</option>
                                                <option value="2">Health Club</option>
                                            </select>
                                            <label class="error" style="display:none;" id="error-hospital_mmbrTyp"> please select a member type</label>
                                            <label class="error" > <?php echo form_error("hospital_mmbrTyp"); ?></label>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">About Us :</label>
                                        <div class="col-md-8  col-sm-8">
                                           <textarea class="form-control" name="hospital_aboutUs" id="hospital_aboutUs"  value=""> </textarea>
                                            <label class="error" > <?php echo form_error("hospital_aboutUs"); ?></label>
                                            <label class="error" style="display:none;" id="error-hospital_aboutUs"> Please write about the hospital!</label>
                                           
                                        </div>
                                    </article>
                                    
                                    <!-- Extra Check box section -->
                                    
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-12">Do you also provide following in same campus ? </label>
                                        <div class="col-md-12 ">


                                            <article class="clearfix m-t-10">
                                                <label class="control-label col-md-4 col-xs-9" for="cname">Bloodbank </label>
                                                <div class="col-md-8 col-xs-3">
                                                    <aside class="checkbox checkbox-success m-t-5">
                                                        <input type="checkbox" id="bloodbank" name="bloodbank_chk" value="1">
                                                        <label>

                                                        </label>
                                                    </aside>
                                                </div>
                                            </article>
                                            
                                            <section class="clearfix m-t-10" id="bloodbankOption" style="display:none">
                                                <article class="form-group m-lr-0 ">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Name : </label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <input class="form-control" id="bloodBank_name" name="bloodBank_name" type="text" required="" maxlength="30" onblur="bbname();">
                                                        <label class="error" style="display:none;" id="error-bloodBank_name"> please Check your BloodBank name</label>
                                                    </div>
                                                </article>
                                                <article class="form-group m-lr-0 ">
                                                    <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                                                    <div class="col-md-8 col-sm-8 text-right">
                                                        <label for="file-input2"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x"></i></label>
                                                        <input type="file" style="display:none;" class="no-display" id="file-input2" name="bloodBank_photo">
                                                        
                                                    </div>
                                                </article>
                                                
                                                <article class="form-group m-lr-0">
                                                    <label for="cname" class="control-label col-md-4 col-sm-4">Phone:</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <!--<a href="javascript:void(0)" class="aaaa pull-right" rel=".clone">
                                                            <i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a>-->
                                                        <aside class="row">
                                                            <div class="col-md-3 col-sm-3 col-xs-12" id="multiBloodbnkPreNumber">
                                                                <select class="selectpicker" data-width="100%" id="preblbankNo1" name="preblbankNo[]">
                                                                    <option value='91'>+91</option>
                                                                    <option value ='1'>+1</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-7 col-sm-7 col-xs-10 m-t-xs-10" id="multiBloodbnkPhoneNumber">
                                                                <input type="text" class="form-control" name="bloodBank_phn[]" id="bloodBank_phn1" placeholder="9837000123" maxlength="10" onblur="bbphone()" />
                                                                 <label class="error" style="display:none;" id="error-bloodBank_phone"> please Check your BloodBank Phone</label>
                                                            </div>
                                                            <div class="col-md-2 col-sm-2 col-xs-2 m-t-xs-10">
                                                            </div>
                                                            <a href="javascript:void(0)" onclick="countBloodPhoneNumber()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a>

                                                        </aside>
                                                        <p class="m-t-10">* If it is landline, include Std code with number </p>
                                                    </div>
                                                </article>




                                            </section>

                                            <article class="clearfix">
                                                <label class="control-label col-md-4 col-xs-9" for="cname">Pharmacy </label>
                                                <div class="col-md-8 col-xs-3">
                                                    <aside class="checkbox checkbox-success m-t-5">
                                                        <input type="checkbox" id="pharmacy" name="pharmacy_chk" value="1">
                                                        <label>

                                                        </label>
                                                    </aside>
                                                </div>
                                            </article>
                                            <section class="clearfix m-t-10" id="pharmacyOption" style="display:none">
                                                <article class="form-group m-lr-0 ">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Name : </label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <input class="form-control" id="pharmacy_name" name="pharmacy_name" type="text" required="" maxlength="30" onblur="phname()">
                                                        <label class="error" style="display:none;" id="error-pharmacy_name"> please Check your Pharmacy Name</label>
                                                    </div>
                                                </article>
                                                <article class="form-group m-lr-0 ">
                                                    <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                                                    <div class="col-md-8 col-sm-8 text-right">
                                                        <label for="file-input3"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x"></i></label>
                                                        <input type="file" style="display:none;" class="no-display" id="file-input3" name="pharmacy_img">
                                                    </div>
                                                </article>
                                                <article class="form-group m-lr-0">
                                                    <label for="cname" class="control-label col-md-4 col-sm-4">Phone:</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <aside class="row">
                                                            <div class="col-md-3 col-sm-3 col-xs-12" id="multipharmacyPreNumber">
                                                                <select class="selectpicker" data-width="100%" name="prePharmacy[]" id="prePharmacy1">
                                                                    <option value='91'>+91</option>
                                                                    <option value='1'>+1</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-7 col-sm-7 col-xs-10 m-t-xs-10" id="multipharmacyNumber" >
                                                                <input type="text" class="form-control" name="pharmacy_phn[]" id="pharmacy_phn1" placeholder="9837000123" maxlength="10" onblur="phphone()"/>
                                                                <label class="error" style="display:none;" id="error-pharmacy_phn1"> please Check your Pharmacy Phone</label>
                                                            </div>
                                                            <div class="col-md-2 col-sm-2 col-xs-2 m-t-xs-10">
                                                            </div>
                                                            <a href="javascript:void(0)" onclick="countPharmacyPhoneNumber()"> <i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i><a>

                                                        </aside>
                                                        <p class="m-t-10">* If it is landline, include Std code with number </p>
                                                    </div>
                                                </article>
                                            </section>

                                            <article class="clearfix">
                                                <label class="control-label col-md-4 col-xs-9" for="cname">Ambulance </label>
                                                <div class="col-md-8 col-xs-3">
                                                    <aside class="checkbox checkbox-success m-t-5">
                                                        <input type="checkbox" id="ambulance" name="ambulance_chk" value="1">
                                                        <label>

                                                        </label>
                                                    </aside>
                                                </div>
                                            </article>
                                            <section class="clearfix m-t-10" id="ambulanceOption" style="display:none">
                                                <article class="form-group m-lr-0 ">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Name : </label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <input class="form-control" id="ambulance_name" name="ambulance_name" type="text" required="" maxlength="30" onblur="amname()">
                                                        <label class="error" style="display:none;" id="error-ambulance_name"> please Check your Ambulance Name</label>
                                                    </div>
                                                </article>
                                                <article class="form-group m-lr-0 ">
                                                    <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                                                    <div class="col-md-8 col-sm-8 text-right">
                                                    
                                                      <label for="file-input4"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x"></i></label>
                                                        <input type="file" style="display:none;" class="no-display" id="file-input4" name='ambulance_img'>
                                                        
                                                 
                                                    </div>
                                                </article>
                                                <article class="form-group m-lr-0">
                                                    <label for="cname" class="control-label col-md-4 col-sm-4">Phone:</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <aside class="row">
                                                            <div class="col-md-3 col-sm-3 col-xs-12" id="preAmbulance_name">
                                                                <select class="selectpicker" data-width="100%" name="preAmbulance[]" id="preAmbulance1">
                                                                    <option value='91'>+91</option>
                                                                    <option value='1'>+1</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-7 col-sm-7 col-xs-10 m-t-xs-10" id="phoneAmbulance">
                                                                <input type="text" class="form-control" name="ambulance_phn[]" id="ambulance_phn1" placeholder="9837000123" maxlength="10" onblur="amphone()"/>
                                                                <label class="error" style="display:none;" id="error-ambulance_phn1"> please Check your Ambulance Phone</label>
                                                            </div>
                                                            <div class="col-md-2 col-sm-2 col-xs-2 m-t-xs-10">
                                                            </div>
                                                            <a href="javascript:void(0)" onclick="countAmbulancePhoneNumber()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a>

                                                        </aside>
                                                        <p class="m-t-10">* If it is landline, include Std code with number </p>
                                                    </div>
                                                </article>
                                            </section>


                                            <article class="clearfix">
                                                <label class="control-label col-md-4 col-xs-9" for="cname">Emergency Ward</label>
                                                <div class="col-md-8 col-xs-3">
                                                    <aside class="checkbox checkbox-success m-t-5">
                                                        <input type="checkbox" id="isEmergency" name="isEmergency" value="1">
                                                        <label>

                                                        </label>
                                                    </aside>
                                                </div>
                                            </article>

                                        </div>
                                    </article>

                                     <!-- End Extra check box section -->   

                                </div>
                                <!-- .form -->
                            </div>

                        </section>
                        <!-- Left Section End -->



                        <!-- Right Section Start -->
                        <section class="col-md-6 detailbox mi-form-section">
                            <div class="bg-white clearfix">
                                <!-- Feature Access Section Start -->
                            <!--    <div>
                                    <figure class="clearfix">
                                        <h3>Feature Access</h3>
                                    </figure>


                                    <article class="clearfix m-t-10">
                                        <label class="control-label col-md-6 col-xs-9" for="cname"> Doctor Management</label>
                                        <div class="col-md-6 col-xs-3">
                                            <aside class="checkbox checkbox-success m-t-5">
                                                <input type="checkbox" id="checkbox3">
                                                <label>

                                                </label>
                                            </aside>
                                        </div>
                                    </article>

                                    <article class="clearfix">
                                        <label class="control-label col-md-6 col-xs-9" for="cname"> App Consultation Booking </label>
                                        <div class="col-md-6 col-xs-3">
                                            <aside class="checkbox checkbox-success m-t-5">
                                                <input type="checkbox" id="checkbox3">
                                                <label>

                                                </label>
                                            </aside>
                                        </div>
                                    </article>

                                    <article class="clearfix">
                                        <label class="control-label col-md-6 col-xs-9" for="cname">Diagnostic Management </label>
                                        <div class="col-md-6 col-xs-3">
                                            <aside class="checkbox checkbox-success m-t-5">
                                                <input type="checkbox" id="checkbox3">
                                                <label>

                                                </label>
                                            </aside>
                                        </div>
                                    </article>

                                    <article class="clearfix">
                                        <label class="control-label col-md-6 col-xs-9" for="cname">App Diagnostic Booking </label>
                                        <div class="col-md-6 col-xs-3">
                                            <aside class="checkbox checkbox-success m-t-5">
                                                <input type="checkbox" id="checkbox3">
                                                <label>

                                                </label>
                                            </aside>
                                        </div>
                                    </article>

                                    <article class="clearfix">
                                        <label class="control-label col-md-6 col-xs-9" for="cname">Healthcare Packages </label>
                                        <div class="col-md-6 col-xs-3">
                                            <aside class="checkbox checkbox-success m-t-5">
                                                <input type="checkbox" id="checkbox3">
                                                <label>

                                                </label>
                                            </aside>
                                        </div>
                                    </article>

                                    <article class="clearfix">
                                        <label class="control-label col-md-6 col-xs-9" for="cname">Healthcare Package Booking </label>
                                        <div class="col-md-6 col-xs-3">
                                            <aside class="checkbox checkbox-success m-t-5">
                                                <input type="checkbox" id="checkbox3">
                                                <label>

                                                </label>
                                            </aside>
                                        </div>
                                    </article>
                                
                                </div>    -->

                                <!-- Feature Access Section End -->


                                <!-- Account Detail Section Start -->
                                <figure class="clearfix">
                                    <h3>Account Detail</h3>
                                </figure>
                                <aside class="clearfix m-t-20 p-b-20">
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
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Registered Mobile no. :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="text" class="form-control" id="hospital_mblNo" name="hospital_mblNo" placeholder="8880007755" maxlength="10" />
                                            <label class="error" style="display:none;" id="error-hospital_mblNo"> please enter your mobile number</label>
                                        <label class="error" style="display:none;" id="error-hospital_mblNo_check">please enter digits only!</label>
                                            <label class="error" > <?php echo form_error("hospital_mblNo"); ?></label>

                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Enter Password :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="password" class="form-control" id="users_password" name="users_password" placeholder=" " />
                                            <label class="error" style="display:none;" id="error-users_password"> please enter password and shoul be 6 chracter</label>
                                            <label class="error" > <?php echo form_error("users_password"); ?></label>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Confirm Password :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="password" class="form-control" id="cnfPassword" name="cnfPassword" placeholder=" " />
                                           <!-- <label class="error" style="display:none;" id="error-cnfPassword"> please enter the password</label>-->
                                            <label class="error" style="display:none;" id="error-cnfPassword_check">Passwords do not match!</label>
                                             <label class="error" > <?php echo form_error("cnfPassword"); ?></label>
                                        </div>
                                    </article>

                                </aside>

                                <!-- Account Detail Section End -->

                            </div>
                        </section>
                        <section class="clearfix ">
                            <div class="col-md-12 m-t-20 m-b-20">
                                <button class="btn btn-danger waves-effect pull-right" type="button">Reset</button>
                <div>
                                <input class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit" onclick="return validationHospital()" value="Submit" />
                </div>
                            </div>

                        </section>
                        
                            <fieldset>
                            
                            <input name="lat" type="hidden" value="" />

                           <!-- <label>Longitude</label> -->
                            <input name="lng" type="hidden" value="" />

                          </fieldset>
                    </form>
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
    <!-- <script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js">
    </script>
    <script src="<?php echo base_url();?>assets/js/framework.js">
    </script> -->
    
    <script src="<?php echo base_url();?>assets/js/jquery-1.8.2.min.js">
    </script>
    <script src="<?php echo base_url();?>assets/js/framework.js">
    </script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js">
    </script>
   
    <script src="<?php echo base_url();?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    
    <script src="<?php echo base_url();?>assets/js/pages/addHospital.js">
    </script>
     <script src="<?php echo base_url();?>assets/js/reCopy.js"></script>
    
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->

    <script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>
<!-- end lat long section -->


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
      
      $(function(){
            var removeLink = '<a class="remove" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false"> <i class="fa fa-minus-circle fa-2x m-t-5 label-plus"></i></a>';
          $('a.add').relCopy({ append: removeLink});    
          
          });

    </script>
<!--<link href="<?php echo base_url(); ?>assets/css/cropper/cropper.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/cropper/cropper.min.js"></script> -->
    <!-- for lat long -->

    
    <script>
  
        var urls = "<?php echo base_url()?>";
         var j = 1;
         var k = 1;
         var l = 1;
         var n= 1;
         var m = 1;
         var p = 1;
        function fetchCity(stateId) {           
           $.ajax({
               url : urls + 'index.php/hospital/fetchCity',
               type: 'POST',
              data: {'stateId' : stateId},
              success:function(datas){
                  $('#hospital_cityId').html(datas);
                  $('#hospital_cityId').selectpicker('refresh');
                  $('#StateId').val(stateId);
              }
           });
           
        }
        function countPhoneNumber(){
        if(j==10)
            return false;
      j = parseInt(j)+parseInt(1); 
      $('#countPnone').val(j);
      $('#multiPhoneNumber').append('<input type=text class=form-control name=hospital_phn[] placeholder=9837000123 maxlength="10" id=hospital_phn'+j + ' />');
     $('#multiPreNumber').append('<select class=selectpicker data-width=100% name=pre_number[] id=multiPreNumber'+j+'><option value=91>+91</option><option value=1>+1</option></select>');
      $('#multiPreNumber'+j).selectpicker('refresh');
      //.append('<div class=col-lg-3 col-md-4 col-sm-3 col-sm-4 col-xs-12 m-t-xs-10 id=multiPreNumber><select class=selectpicker data-width=100% name=pre_number[] id=multiPreNumber><option value =91>+91</option><option value =1>+1</option></select></div><div class=col-lg-7 col-md-6 col-sm-7 col-xs-10 m-t-xs-10 id=multiPhoneNumber><nput type=text class="form-control" name=hospital_phn[] id=hospital_phn1 placeholder=9837000123 maxlength=10 /> </div>');

   }
       function countBloodPhoneNumber(){
        if(k==10)
            return false;
      k = parseInt(k)+parseInt(1); 
      $('#countbloodBank_phn').val(k);
      $('#multiBloodbnkPhoneNumber').append('<input type=text class=form-control name=bloodBank_phn[] placeholder=9837000123 maxlength="10" id=bloodBank_phn'+k + ' />' );
     $('#multiBloodbnkPreNumber').append('<select class=selectpicker data-width=100% name=preblbankNo[] id=preblbankNo'+k+'><option value=91>+91</option><option value=1>+1</option></select>');
      $('#preblbankNo'+k).selectpicker('refresh');
      
   }

   function countPharmacyPhoneNumber(){
       if(l==10)
            return false;
      l = parseInt(l)+parseInt(1); 
      $('#countPharmacy_phn').val(l);
      $('#multipharmacyNumber').append('<input type=text class=form-control name=pharmacy_phn[] placeholder=9837000123 maxlength="10" id=pharmacy_phn'+l + ' />' );
     $('#multipharmacyPreNumber').append('<select class=selectpicker data-width=100% name=prePharmacy[] id=prePharmacy'+l+'><option value=91>+91</option><option value=1>+1</option></select>');
      $('#prePharmacy'+l).selectpicker('refresh');
   }
   
   function countAmbulancePhoneNumber(){
       if(n==10)
            return false;
      n = parseInt(n)+parseInt(1); 
      $('#countAmbulance_phn').val(n);
      $('#phoneAmbulance').append('<input type=text class=form-control name=ambulance_phn[] placeholder=9837000123 maxlength="10" id=ambulance_phn'+n + ' /> ' );
     $('#preAmbulance_name').append('<select class=selectpicker data-width=100% name=preAmbulance[] id=preAmbulance'+n+'><option value=91>+91</option><option value=1>+1</option></select> ');
     $('#preAmbulance'+n).selectpicker('refresh');
   }
   
   function countserviceName(){
        if(m==10)
            return false;
      m = parseInt(m)+parseInt(1); 
      $('#serviceName').val(m);
      $('#multiserviceName').append('<input type=text class=form-control name=hospitalServices_serviceName[] placeholder="Give Your Service Name" maxlength="30" id=hospitalServices_serviceName'+m + ' /> <br /> ' );
   }
   function bbname(){
       var bbankname = $('#bloodBank_name').val();
        var check= /^[a-zA-Z\s]+$/;
    if(!check.test(bbankname)){
    $('#bloodBank_name').addClass('bdr-error');
    $('#error-bloodBank_name').fadeIn().delay(3000).fadeOut('slow');
    // $('#bloodBank_name').focus();
    }
}
   function bbphone(){
    var bbphcheck=/^[0-9]+$/;
    var bbankphone=$.trim($('#bloodBank_phn1').val());
   if(!$.isNumeric(bbankphone)){
                
                $('#bloodBank_phn1').addClass('bdr-error');
                $('#error-bloodBank_phone').fadeIn().delay(3000).fadeOut('slow');
                // $('bloodBank_name').focus();
            } 
}
   function phname(){
        var pharname = $.trim($('#pharmacy_name').val());
          var check= /^[a-zA-Z\s]+$/;
        if(!check.test(pharname)){
        $('#pharmacy_name').addClass('bdr-error');
        $('#error-pharmacy_name').fadeIn().delay(3000).fadeOut('slow');
        // $('#pharmacy_name').focus();
}
}
   function phphone(){
    var pharname=$.trim($('#pharmacy_phn1').val());
    var phphonecheck=/^[0-9]+$/;
 if(!$.isNumeric(pharname)){
                
                $('#pharmacy_phn1').addClass('bdr-error');
                $('#error-pharmacy_phn1').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_zip').focus();
            } 
}
   function amname(){
        var amname =$.trim($('#ambulance_name').val());
        var check= /^[a-zA-Z\s]+$/;
        if(!check.test(amname)){
        $('#ambulance_name').addClass('bdr-error');
        $('#error-ambulance_name').fadeIn().delay(3000).fadeOut('slow');
        // $('#pharmacy_name').focus();
}
}
   function amphone(){
    var amname=$.trim($('#ambulance_phn1').val());
    var amphonecheck=/^[0-9]+$/;
 if(!$.isNumeric(amname)){
   $('#ambulance_phn1').addClass('bdr-error');
   $('#error-ambulance_phn1').fadeIn().delay(3000).fadeOut('slow');
  } 
}
   function validationHospital(){
         //$("form[name='hospitalForm']").submit();
       
        var check= /^[a-zA-Z\s]+$/;
        var numcheck=/^[0-9]+$/;
        var emails = $.trim($('#users_email').val());
        var cpname = $.trim($('#hospital_cntPrsn').val());
        var dsgn = $.trim($('#hospital_dsgn').val());
        var hsname =$.trim($('#hospitalServices_serviceName1').val());
        var pswd = $.trim($("#users_password").val());
        var cnfpswd = $.trim($("#cnfPassword").val());
        var mbl= $.trim($('#hospital_mblNo').val());
        var phn= $.trim($('#hospital_phn1').val());
        var myzip = $.trim($('#hospital_zip').val());
        var cityId =$.trim($('#hospital_cityId').val());
        var stateIds = $.trim($('#StateId').val());
        var hospital_mblNo = $.trim($('#hospital_mblNo').val());
        var aboutUs = $.trim($('#hospital_aboutUs').val());
  // alert(aboutUs);
            if($('#hospital_name').val()==''){
                $('#hospital_name').addClass('bdr-error');
                $('#error-hospital_name').fadeIn().delay(3000).fadeOut('slow');
                //return false;
               // $('#hospital_name').focus();
            }
          if($('#hospital_type').val()==''){
                $('#hospital_type').addClass('bdr-error');
                $('#error-hospital_type').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_type').focus();
            }
            if($.trim($('#hospital_countryId').val()) == ''){
                $('#hospital_countryId').addClass('bdr-error');
                $('#error-hospital_countryId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_countryId').focus();
            }
          if(!$.isNumeric(stateIds)){
               // console.log("in state");
                $('#hospital_stateId').addClass('bdr-error');
                $('#error-hospital_stateId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_stateId').focus();
            }
           if(!$.isNumeric(cityId)){
                $('#hospital_cityId').addClass('bdr-error');
                $('#error-hospital_cityId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_cityId').focus();
            }
           
            if(!$.isNumeric(myzip)){
                
                $('#hospital_zip').addClass('bdr-error');
                $('#error-hospital_zip').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_zip').focus();
            } 

           if($("input[name='hospital_address']" ).val()==''){
                $('#hospital_address').addClass('bdr-error');
                $('#error-hospital_address').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_address').focus();
            }
            
          if(!$.isNumeric(phn)){
                $('#hospital_phn1').addClass('bdr-error');
                $('#error-hospital_phn').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_phn').focus();
            }
            
            if(!check.test(hsname)){
                $('#hospitalServices_serviceName1').addClass('bdr-error');
                $('#error-hospitalServices_serviceName').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospitalServices_serviceName1').focus();
            }
           
           if(!check.test(cpname)){
                $('#hospital_cntPrsn').addClass('bdr-error');
                $('#error-hospital_cntPrsn').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_cntPrsn').focus();
            }
            if(!check.test(dsgn)){
                $('#hospital_dsgn').addClass('bdr-error');
                $('#error-hospital_dsgn').fadeIn().delay(3000).fadeOut('slow');
               
               // $('#hospital_dsgn').focus();
            }
            if($('#hospital_mmbrTyp').val()==''){
                $('#hospital_mmbrTyp').addClass('bdr-error');
                $('#error-hospital_mmbrTyp').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_mmbrType').focus();
            }
            if(aboutUs === ''){
                $('#hospital_aboutUs').addClass('bdr-error');
                $('#error-hospital_aboutUs').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_aboutUs').focus();
            }
            if($('#users_email').val()==''){
                $('#users_email').addClass('bdr-error');
                $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');
               // $('#users_email').focus();
            }
           
          
           if(!($.isNumeric(hospital_mblNo))){
                $('#hospital_mblNo').addClass('bdr-error');
                $('#error-hospital_mblNo').fadeIn().delay(3000).fadeOut('slow');
                
               // $('#hospital_mblNo').focus();
            }
           if($('#users_password').val()=='' || pswd.length < 6){
                $('#users_password').addClass('bdr-error');
                $('#error-users_password').fadeIn().delay(3000).fadeOut('slow');
               // $('#users_password').focus();
            }
            if($('#cnfPassword').val()=='' || pswd!= cnfpswd){
                $('#cnfPassword').addClass('bdr-error');
                $('#error-cnfPassword_check').fadeIn().delay(3000).fadeOut('slow');
                
               // $('#cnfpassword').focus();
            }
               //debugger;
        if(emails !=''){
              check_email(emails);
              return false;
            }
            return false;
            
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
               url : urls + 'index.php/hospital/check_email',
               type: 'POST',
              data: {'users_email' : myEmail},
              success:function(datas){
                  if(datas == 0){
                   $("form[name='hospitalForm']").submit();
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
   /*function addMultiserviceName(){
       if(p==10)
            return false;
      p = parseInt(p)+parseInt(1); 
      $('#countServiceName').val(p);
      $('#multiserviceName').append('<input type="text" class="form-control" name="hospitalServices_serviceName[]" id="" placeholder="Give Your Service Name" maxlength="30" />' );
   }*/
    </script> 
    

   
</body>

</html>
