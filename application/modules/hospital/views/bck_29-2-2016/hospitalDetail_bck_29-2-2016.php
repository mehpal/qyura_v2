<?php //print_r($pharmacyData);exit;?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="<?php echo base_url();?>assets/images/fevicon-m.ico" rel="shortcut icon">
    <title>Hospitals Details</title>
    <link href="<?php echo base_url();?>assets/css/framework.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendor/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/css/custom-g.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/custom-r.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/vendor/select2/select2.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/css/responsive-r.css" rel="stylesheet" />
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
    <script src="<?php echo base_url();?>assets/js/modernizr.min.js"></script>
    <script> var urls = "<?php echo base_url()?>";
         var hospitalId = <?php echo $hospitalId; ?>;
    </script>
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
                           <span class="badge badge-xs badge-danger">3</span></a>
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
                <!--  Side Menu Bar -->
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
                                <li><a href="<?php echo base_url();?>index.php/bloodBank">All Blood Banks</a></li>
                                <li><a href="<?php echo base_url();?>index.php/bloodBank/AddbloodBank">Add New Blood Bank</a></li>
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
                
                <!-- End Side Bar -->
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Start right Content here -->
        <div class="content-page" ng-app="myApp">
            <!-- Start content -->
            <div class="content">
                <div class="container row">
                    <div class="clearfix">
                         <div class="col-md-12 text-success">
                            <?php echo $this->session->flashdata('message'); ?>
                         </div>
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Hospital Detail</h3>
                            <a href="all-pharmacies.html" class="btn btn-appointment btn-back waves-effect waves-light pull-right"><i class="fa fa-angle-left"></i> Back</a>
                               
                        </div>
                    </div>

                    <!-- Left Section Start -->
                    <section class="col-md-12 detailbox m-t-10">


                        <div class="bg-white">
                            <!-- Table Section Start -->

                            <section class="col-md-12">

                                <aside class="clearfix m-bg-pic">


                                    <div class="bg-picture text-center">
                                        <div class="bg-picture-overlay"></div>
                                        <div class="profile-info-name">
                                            <div class='pro-img'>
                                                <!-- image -->
                                                <?php if(!empty($hospitalData[0]->hospital_img)){
                                                    ?>
                                               <img src="<?php echo base_url()?>assets/hospitalsImages/<?php echo $hospitalData[0]->hospital_img; ?>" alt="" class="logo-img" />
                                               <?php } else { ?>
                                                 <img src="<?php echo base_url()?>assets/images/noImage.png" alt="" class="logo-img" />
                                               <?php } ?>
                                                  <article class="logo-up" style="display:none">
                                                    <div class="fileUpload btn btn-sm btn-upload logo-Upload">
                                                        <span><i class="fa fa-cloud-upload fa-3x"></i></span>
                                                        <input id="uploadBtn" type="file" class="upload" />
                                                    </div>
                                                </article>
                                                <!-- description div -->
                                                <div class='pic-edit'>
                                                    <h3><a id="picEdit" class="pull-center cl-white" title="Edit Logo"><i class="fa fa-pencil"></i></a></h3>
                                                    <h3><a id="picEditClose" class="pull-center cl-white" title="Cancel"  style="display:none;"><i class="fa fa-times"></i></a></h3>
                                                </div>
                                                <!-- end description div -->
                                            </div>

                                            <h3 class="text-white"> <?php echo $hospitalData[0]->hospital_name;?> </h3>
                                            <h4> <?php if(isset($hospitalData[0]->hospital_address)){ echo $hospitalData[0]->hospital_address; }?> </h4>

                                        </div>

                                    </div>
                                    <!--/ meta -->

                                </aside>
                                <section class="clearfix hospitalBtn">
                                    <div class="col-md-12">
                                        <a href="#" class="pull-right cl-white" title="Edit Background"><i class="fa fa-pencil"></i></a>

                                    </div>

                                </section>
                                
                                <article class="text-center clearfix m-t-50">
                                    <ul class="nav nav-tab nav-setting">
                                        <li class="active">
                                            <a data-toggle="tab" href="#general">General Detail</a>
                                        </li>
                                        
                                        <li class=" ">
                                            <a data-toggle="tab" href="#diagnostic">Diagnostics</a>
                                        </li>
                                        <li class=" ">
                                            <a data-toggle="tab" href="#specialities">Specialities</a>
                                        </li>
                                        <li class=" ">
                                            <a data-toggle="tab" href="#gallery">Gallery</a>
                                        </li>
                                        <li class=" ">
                                            <a data-toggle="tab" href="#timeslot">Time Slot</a>
                                        </li>
                                       <li class=" ">
                                            <a data-toggle="tab" href="#doctor">All Doctors</a>
                                        </li>
                                        
                                        <li class=" ">
                                            <a data-toggle="tab" href="#account">Account</a>
                                        </li>

                                    </ul>
                                </article>

                                <article class="tab-content p-b-20 m-t-50">

                                    <!-- General Detail Starts -->
                                     <div class="map_canvas"></div>
                                    
                                    <section class="tab-pane fade in active" id="general">

                                        <article class="detailbox">
                                            <div class="bg-white mi-form-section">

                                                <!-- Table Section End -->
                                                <aside class="clearfix m-t-20 setting">
                                                    <div class="col-md-6">
                                                        <h4>Hospital Details 
                                                         <a href="javascript:void(0)" id="edit" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                                                        </h4>
                                                        <hr/>
                                                        <aside id="detail" style="display: <?php echo $detailShow;?>;">
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Hospital Name :</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"> <?php echo $hospitalData[0]->hospital_name;?> </p>
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Hospital Type :</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left">
                                                                    <?php if($hospitalData[0]->hospital_type == 1)
                                                                            echo "Trauma Centres";
                                                                            else if($hospitalData[0]->hospital_type == 2)
                                                                            echo "Rehabilitation Hospitals";
                                                                            else
                                                                            echo "Children's Hospitals";    
                                                                        ?>
                                                                </p>
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Address :</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"><?php if(isset($hospitalData[0]->hospital_address)){ echo $hospitalData[0]->hospital_address; }?> </p>
                                                            </article>

                                                            <article class="clearfix m-b-10 ">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                <aside class="col-md-8 col-sm-8 text-right t-xs-left">
                                                                    <?php 
                                                                    $explode= explode('|',$hospitalData[0]->hospital_phn); 
                                                                    for($i= 0; $i< count($explode)-1;$i++){?>
                                                                    <p>+<?php echo $explode[$i];?></p>
                                                                   
                                                                    <?php }?>
                                                                    
                                                                </aside>
                                                            </article>
                                                           
                                                          
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">24x7 Emergency :</label>
                                                                <?php if($hospitalData[0]->isEmergency == 1){?>
                                                                <p class="col-md-8 col-sm-8 t-xs-left">Available</p>
                                                                <?php } else {?>
                                                                <p class="col-md-8 col-sm-8 t-xs-left">Not Available</p>
                                                                 <?php }?>
                                                            </article>
                                                           
                                                            
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person:</label>
                                                                <p class="col-md-8  col-sm-8 text-right t-xs-left"> <?php if(isset($hospitalData[0]->hospital_cntPrsn)){ echo $hospitalData[0]->hospital_cntPrsn; }?> </p>
                                                            </article>
                                                             <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Designation:</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"><?php if(isset($hospitalData[0]->hospital_dsgn)){ echo $hospitalData[0]->hospital_dsgn; }?></p>
                                                            </article> 
                                                            
                                                            
                                                             <aside class="clearfix m-t-20 setting">
                                                            <h4>Blood Bank Detail
                                                            
                                                              </h4>
                                                            <hr/>
                                                            <section id="detailbbk">
                                                                <article class="clearfix m-b-10">
                                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Name :</label>
                                                                    <p class="col-md-8 col-sm-8 t-xs-left"><?php echo $hospitalData[0]->bloodBank_name;?></p>
                                                                </article>

                                                                <article class="clearfix m-b-10 ">
                                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                    <aside class="col-md-8 col-sm-8 t-xs-left">
                                                                         <?php 
                                                                    $bloodBank_explode= explode('|',$hospitalData[0]->bloodBank_phn); 
                                                                    for($i= 0; $i< count($bloodBank_explode)-1;$i++){?>
                                                                    <p>+<?php echo $bloodBank_explode[$i];?></p>
                                                                   
                                                                    <?php }?>
                                                                    </aside>
                                                                </article>
                                                            </section>
                                                         
                                                        </aside>


                                                        <aside class="clearfix m-t-20 setting">
                                                            <h4>Pharmacy Detail
                                                           
                                                              </h4>
                                                            <hr/>
                                                            <section id="detailpharma">
                                                                <article class="clearfix m-b-10">
                                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Name :</label>
                                                                    <p class="col-md-8 col-sm-8 t-xs-left"><?php echo $hospitalData[0]->pharmacy_name;?></p>
                                                                </article>

                                                                <article class="clearfix m-b-10 ">
                                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                    <aside class="col-md-8 col-sm-8 t-xs-left">
                                                                         <?php 
                                                                    $pharmacy_explode= explode('|',$hospitalData[0]->pharmacy_phn); 
                                                                    for($i= 0; $i< count($pharmacy_explode)-1;$i++){?>
                                                                    <p>+<?php echo $pharmacy_explode[$i];?></p>
                                                                   
                                                                    <?php }?>
                                                                    </aside>
                                                                </article>
                                                            </section>
                                                            
                                                        </aside>
                                                        </aside>
                                                        
                                                        <!--edit-->
                                                         <form name="hospitalDetail" action="<?php echo site_url("hospital/saveDetailHospital/$hospitalId"); ?>" id="hospitalDetail" method="post">
                                                         <input type="hidden" id="StateId" name="StateId" value="<?php echo $hospitalData[0]->hospital_stateId;?>" />
                                                          <input type="hidden" id="countryId" name="countryId" value="<?php echo $hospitalData[0]->hospital_countryId;?>" />
                                                          <input type="hidden" id="cityId" name="cityId" value="<?php echo $hospitalData[0]->hospital_cityId;?>" />
                                                        <aside id="newDetail" style="display:<?php echo $showStatus;?>;">
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Hospital Name :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <input class="form-control" id="hospital_name" name="hospital_name" type="text" value="<?php echo $hospitalData[0]->hospital_name;?>">
                                                                    <label class="error" > <?php echo form_error("hospital_name"); ?></label>
                                                                </div>
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                                <label for="cname" class="control-label col-md-4  col-sm-4">Hospital Type :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <select class="selectpicker" data-width="100%" name="hospital_type" id="hospital_type" tabindex="-98">
                                                                        <option value="1" <?php if($hospitalData[0]->hospital_type == 1){ echo 'selected';}?>> Trauma Centres</option>
                                                                        <option value="2" <?php if($hospitalData[0]->hospital_type == 2){ echo 'selected';}?>>Rehabilitation Hospitals</option>
                                                                        <option value="3" <?php if($hospitalData[0]->hospital_type == 3){ echo 'selected';}?>>Children's Hospitals</option>
                                                                    </select>
                                                                </div>
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                            <label for="cemail" class="control-label col-md-4 col-sm-4">Address :</label>
                                                            <div class="col-md-8 col-sm-8">
                                                    
                                            <div class="clearfix m-t-10">
                                                <textarea class="form-control" id="geocomplete" name="hospital_address" type="text" ><?php if(isset($hospitalData[0]->hospital_address)){ echo $hospitalData[0]->hospital_address; }?></textarea>
                                               <label class="error" > <?php echo form_error("hospital_address"); ?></label>
                                            </div>
                                        </div>
                                                        </article>

                                                            <article class="clearfix m-b-10 ">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <?php 
                                                                    $explodes= explode('|',$hospitalData[0]->hospital_phn); 
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
                                                                            <input type="text" class="form-control" name="hospital_phn[]" id="hospital_phn<?php echo ($i+1);?>" placeholder="9837000123" value="<?php echo $moreExpolde[1];?>" maxlength="10" onblur="checkNumber(<?php echo $i;?>)"/>
                                                                        </div>
                                                                       
                                                                    </aside>
                                                                    <br />
                                                                    <?php $moreExpolde ='';}?>
                                                               
                                                                    <p class="m-t-10">* If it is landline, include Std code with number </p>
                                                                </div>
                                                            </article>
                                                            <article class="clearfix">
                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-9" for="cname">Bloodbank Availablity </label>
                                                                        <div class="col-md-8 col-xs-3">
                                                                            <aside class="checkbox checkbox-success m-t-5">
                                                                                <input type="checkbox" id="bloodbankbtn" name="bloodbank_chk" value="1">
                                                                                <label>

                                                                                </label>
                                                                            </aside>
                                                                        </div>
                                                                    </article>
                                                                    
                                                                    <section id="bloodbankdetail" style="display:none">
                                                                
                                                                        <article class="clearfix m-b-10">
                                                                       <label for="cemail" class="control-label col-md-4 col-sm-4">Name :</label>
                                                                       <div class="col-md-8 col-sm-8">
                                                                           <input class="form-control" name="bloodBank_name" id="bloodBank_name" type="text" value="<?php if(isset($hospitalData[0]->bloodBank_name)){ echo $hospitalData[0]->bloodBank_name; } ?>">
                                                                           <div>
                                                                   </article>
                                                                       <article class="clearfix m-b-10 ">
                                                                       <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                       <div class="col-md-8 col-sm-8">
                                                                            <?php 
                                                                            if($hospitalData[0]->bloodBank_phn != ''){
                                                                                $explodes_bloodbank= explode('|',$hospitalData[0]->bloodBank_phn); 
                                                                                for($i= 0; $i< count($explodes_bloodbank)-1;$i++){
                                                                                $more_bloodbank = explode(' ',$explodes_bloodbank[$i]);?>
                                                                           <aside class="row">
                                                                               <div class="col-md-3 col-sm-3 col-xs-12">
                                                                                   <select class="selectpicker" data-width="100%" name="preblbankNo[]" id="preblbankNo<?php echo ($i+1);?>">
                                                                                    <option value="91" <?php if($more_bloodbank[0] == '91'){ echo 'selected';}?>>+91</option>
                                                                                    <option value="1" <?php if($more_bloodbank[0] == '1'){ echo 'selected';}?>>+1</option>
                                                                                   </select>
                                                                               </div>
                                                                               <div class="col-md-9 col-sm-9 col-xs-10 m-t-xs-10">
                                                                                   <input type="teL" class="form-control" name="bloodBank_phn[]" id="bloodBank_phn<?php echo ($i+1);?>" value ="<?php echo $more_bloodbank[1]; ?>" placeholder="9837000123" onkeypress="return isNumberKey(event)" />
                                                                               </div>

                                                                           </aside>
                                                                            <?php $more_bloodbank = ''; } } else {?>
                                                                                <aside class="row">
                                                                               <div class="col-md-3 col-sm-3 col-xs-12">
                                                                                   <select class="selectpicker" data-width="100%" name="preblbankNo[]" id="preblbankNo1">
                                                                                    <option value="91" >+91</option>
                                                                                    <option value="1" >+1</option>
                                                                                   </select>
                                                                               </div>
                                                                               <div class="col-md-9 col-sm-9 col-xs-10 m-t-xs-10">
                                                                                   <input type="teL" class="form-control" name="bloodBank_phn[]" id="bloodBank_phn1" value ="" placeholder="9837000123" onkeypress="return isNumberKey(event)" />
                                                                               </div>

                                                                           </aside>
                                                                            <?php } ?>
                                                                       </div>
                                                                   </article>
                                                                  </section>
                                                         
                                                           <article class="clearfix">
                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-9" for="cname">Pharmacy Availablity </label>
                                                                        <div class="col-md-8 col-xs-3">
                                                                            <aside class="checkbox checkbox-success m-t-5">
                                                                                <input type="checkbox" id="pharmacybtn" name="pharmacy_chk" value="1">
                                                                                <label>

                                                                                </label>
                                                                            </aside>
                                                                        </div>
                                                                    </article>
                                                                     
                                                          <section id="pharmacydetail" style="display:none">
                                                                
                                                                 <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Name :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <input class="form-control" id="pharmacy_name" name="pharmacy_name" type="text" value="<?php if(isset($hospitalData[0]->pharmacy_name)){ echo $hospitalData[0]->pharmacy_name; } ?>" >
                                                                    <div>
                                                            </article>
                                                                 
                                                                <article class="clearfix m-b-10 ">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <?php 
                                                                    if($hospitalData[0]->pharmacy_phn != ''){
                                                                    $explodesPharmacy= explode('|',$hospitalData[0]->pharmacy_phn); 
                                                                    for($i= 0; $i< count($explodesPharmacy)-1;$i++){
                                                                    $morePharmacy = explode(' ',$explodesPharmacy[$i]);?>
                                                                    <aside class="row">
                                                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                                                            <select class="selectpicker" data-width="100%" name="prePharmacy[]" id="prePharmacy<?php echo ($i+1);?>">
                                                                                <option value="91" <?php if($morePharmacy[0] == '91'){ echo 'selected';}?>>+91</option>
                                                                                    <option value="1" <?php if($morePharmacy[0] == '1'){ echo 'selected';}?>>+1</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-9 col-sm-9 col-xs-10 m-t-xs-10">
                                                                            <input type="teL" class="form-control" name="pharmacy_phn[]" id="pharmacy_phn<?php echo ($i+1);?>" value ="<?php echo $morePharmacy[1]; ?>" placeholder="9837000123" onkeypress="return isNumberKey(event)" />
                                                                        </div>

                                                                    </aside>
                                                                    <?php $morePharmacy = '';} } else { ?>
                                                                    <aside class="row">
                                                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                                                            <select class="selectpicker" data-width="100%" name="prePharmacy[]" id="prePharmacy1">
                                                                                <option value="91">+91</option>
                                                                                    <option value="1">+1</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-9 col-sm-9 col-xs-10 m-t-xs-10">
                                                                            <input type="teL" class="form-control" name="pharmacy_phn[]" id="pharmacy_phn1" placeholder="9837000123" onkeypress="return isNumberKey(event)" />
                                                                        </div>

                                                                    </aside>
                                                                    <?php }?>
                                                                </div>
                                                            </article>
                                                           </section>
                                    
                                                            
                                                           <article class="clearfix">
                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-9" for="cname">24x7 Emergency </label>
                                                                        <div class="col-md-8 col-xs-3">
                                                                            <aside class="checkbox checkbox-success m-t-5">
                                                                                <input type="checkbox" id="isEmergency" name="isEmergency" value="1" <?php if($hospitalData[0]->isEmergency == 1){ echo "checked";}?> />
                                                                                <label>

                                                                                </label>
                                                                            </aside>
                                                                        </div>
                                                    </article>
                                                               
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person:</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                 
                                                                    <input class="form-control" id="hospital_cntPrsn" name="hospital_cntPrsn" type="text" value="<?php if(isset($hospitalData[0]->hospital_cntPrsn)){ echo $hospitalData[0]->hospital_cntPrsn; }?>">
                                                           <label class="error" > <?php echo form_error("hospital_cntPrsn"); ?></label>
                                                           </div>    
                                                            </article>
                                                          <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Designation :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <input class="form-control" id="hospital_dsgn" name="hospital_dsgn" type="text" value="<?php if(isset($hospitalData[0]->hospital_dsgn)){ echo $hospitalData[0]->hospital_dsgn; }?>">
                                                                    <label class="error" > <?php echo form_error("hospital_dsgn"); ?></label>
                                                                    <div>
                                                            </article>
                                                          
                                                           
                                                            <article class="clearfix m-b-10">

                                                              <div class="col-md-12">
                                                              <button type="submit" class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" onclick="return validationHospital();">Update</button>
                                                              </div>

                                                             </article>
                                                        </aside>
                                                             <fieldset>
                           
                                                                <input name="lat" type="hidden" value="<?php echo $hospitalData[0]->hospital_lat;?>">

                                                               <!-- <label>Longitude</label> -->
                                                                <input name="lng" type="hidden" value="<?php echo $hospitalData[0]->hospital_long;?>">
                                                                <input name="user_tables_id" id="user_tables_id" type="hidden" value="<?php echo $hospitalData[0]->users_id;?>">
                                                            <?php if($hospitalData[0]->pharmacy_phn != '' OR $hospitalData[0]->pharmacy_name != ''){ ?>
                                                                <input name="pharmacy_status" id="pharmacy_status" type="hidden" value="<?php echo $hospitalData[0]->pharmacy_name;?>">
                                                            <?php } ?>
                                                               <?php if($hospitalData[0]->bloodBank_name != '' OR $hospitalData[0]->bloodBank_phn != ''){ ?>
                                                                <input name="bloodbank_status" id="bloodbank_status" type="hidden" value="<?php echo $hospitalData[0]->bloodBank_name;?>">
                                                            <?php } ?>  
                                                             </fieldset>  
                                                        </form>  
                                                        
                                                       
                                                        <div class="gap"></div>
                                                        <article class="clearfix company-logo">
                                                            <aside class="clearfix">
                                                                <h4>Insurance Company Tied
                                                                     <a id="editcompany" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                                                                </h4>
                                                                <hr/>
                                                            </aside>
                                                            <section id="detailcompany">
                                                                <?php if(!empty($insurance)){
                                                                    foreach($insurance as $key => $val){    
                                                                 ?>
                                                                <div class="col-md-3 col-sm-6">
                                                                    <img src="<?php echo base_url()?>assets/insurance/<?php echo $val->insurance_img;?>" class="img-responsive center-block">
                                                                    <h5><?php echo $val->insurance_Name;?></h5>
                                                                </div>
                                                                <?php }} else{?>
                                                                <div class="col-md-6 col-sm-6">
                                                                 
                                                                    <h5>Please select Insurance company</h5>
                                                                </div>
                                                                <?php }?>
                                                                <!--<div class="col-md-3 col-sm-6">
                                                                    <img src="<?php echo base_url()?>assets/insurance/hdfc.jpg" class="img-responsive center-block">
                                                                    <h5>HDFC ERGO</h5>
                                                                </div>
                                                                <div class="col-md-3 col-sm-6">
                                                                    <img src="<?php echo base_url()?>assets/insurance/icici.png" class="img-responsive center-block">
                                                                    <h5>ICICI</h5>
                                                                </div>
                                                                <div class="col-md-3 col-sm-6">
                                                                    <img src="<?php echo base_url()?>assets/insurance/hsbc.png" class="img-responsive center-block">
                                                                    <h5>HDFC ERGO</h5>
                                                                </div>-->
                                                            </section>
                                                            <section id="newcompany" style="display:none;">
                                                                <form name="insuranceForm" id="insuranceForm" action="<?php echo site_url("hospital/addInsurance/$hospitalId"); ?>" method="post">
                                                                    <input type="hidden" name="hospitalInsuranceId" id="hospitalInsuranceId" value="<?php echo $hospitalId;?>" />
                                                                    <article class="clearfix m-b-10">
                                                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Company Name :</label>
                                                                        <div class="col-md-8 col-sm-8">
                                                                            <!--<input class="form-control" id="diagnosticCenter" name="name" type="text" required=""> -->
                                                                            <select  multiple="" class="bs-select form-control-select2 " data-width="100%" name="insurances[]" Id="insurances" data-size="4" >

                                                                                    <?php foreach($allInsurance as $key=>$val) {?>
                                                                                     <option value="<?php echo $val->insurance_id;?>"><?php echo $val->insurance_Name;?></option>
                                                                                      <?php }?>
                                                                                 </select>
                                                                        </div>
                                                                    </article>
                                                                   <!-- <article class="form-group m-lr-0 ">
                                                                        <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                                                                        <div class="col-md-8 col-sm-8 text-right">
                                                                            <input id="uploadFileBb" class="showUpload" disabled="disabled" />
                                                                            <div class="fileUpload btn btn-sm btn-upload">
                                                                                <span><i class="fa fa-cloud-upload fa-3x"></i></span>
                                                                                <input id="uploadBtnBb" type="file" class="upload" />
                                                                            </div>
                                                                        </div>
                                                                    </article>-->
                                                                    <article class="clearfix ">
                                                                        <div class="col-md-12 m-t-20 m-b-20">
                                                                            <button type="submit" class="btn btn-success waves-effect waves-light pull-right">Add More</button>
                                                                        </div>
                                                                    </article>
                                                                </form>    
                                                            </section>
                                                        </article> 
                                                    </div>
                                                                    
                                                      <div class="col-md-6 p-b-20">
                                                            <article class="clearfix">
                                                                <h4>Awards Recognition
                                                               <a id="editawards" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                                                            </h4>
                                                                <hr/>
                                                                <aside class="clearfix" id="detailawards">
                                                                    <ul class="ul-tick" id="loadAwards">
                                                                       
                                                                    </ul>
                                                                </aside>
                                                                <form id="newawards" style="display:none">
                                                                    <aside class="form-group m-lr-0 p-b-20 m-b-30">
                                                                        <label for="cname" class="control-label col-md-3 col-sm-4">Awards:</label>
                                                                        <div class="col-md-9 col-sm-8">
                                                                            <aside class="row">
                                                                                <div class="col-md-10 col-sm-10 col-xs-10">
                                                                                    <input type="text" class="form-control" name="hospitalAwards_awardsName" id="hospitalAwards_awardsName" placeholder="FICCI Healthcare Excillence Awards" />
                                                                                </div>
                                                                                <div class="col-md-2 col-sm-2 col-xs-2">
                                                                                    <a onclick="addAwards()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus" title="Add Awards"></i></a>
                                                                                </div>
                                                                                
                                                                                
                                                                               
                                                                            </aside>
                                                                            <div id="totalAwards">
                                                                               
                                                                            </div>

                                                                        </div>
                                                                    </aside>
                                                                </form>
                                                            </article>

                                                            <article class="clearfix">
                                                                <aside class="clearfix">
                                                                    <h4>Services
                                                      <a id="editservices" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                                                   </h4>
                                                                    <hr>
                                                                </aside>
                                                                <section id="detailservices">
                                                                    <ul class="ul-tick" id="loadServices">
                                                                       <!-- <li>Hemetology</li>
                                                                        <li>Microbiology Blood Bank</li>
                                                                        <li>Radiology</li>
                                                                        <li>Loren</li>
                                                                        <li>Loren Ipsum</li>
                                                                        <li>Hemetology</li>
                                                                        <li>Microbiology Blood Bank</li>
                                                                        <li>Radiology</li>
                                                                        <li>Loren</li>
                                                                        <li>Loren Ipsum</li> -->
                                                                    </ul>
                                                                </section>
                                                                <form>
                                                                    <aside class="form-group m-lr-0" id="newservices" style="display:none">
                                                                        <label for="cname" class="control-label col-md-3 col-sm-4">Services :</label>
                                                                        <div class="col-md-9 col-sm-8">
                                                                            <aside class="row">
                                                                                <div class="col-md-10 col-sm-10 col-xs-10">
                                                                                    <input type="text" class="form-control" name="hospitalServices_serviceName" id="hospitalServices_serviceName" placeholder="Add Service" />
                                                                                </div>
                                                                                <div class="col-md-2 col-sm-2 col-xs-2">
                                                                                    <a onclick="addServices()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus" title="Add Services"></i></a>
                                                                                </div>
                                                                                
                                                                                
                                                                               
                                                                            </aside>
                                                                            <div id="totalServices">
                                                                               
                                                                            </div>

                                                                        </div>
                                                                    </aside>
                                                                </form>
                                                            </article>
                                                        </div>               
                                                                    
                                                                    
                                                   
                                                </aside>
                                                
                                            </div>
                                        </article>
                                    </section>  
                                  
                                    <!--diagnostic Starts -->
                                     <section class="tab-pane fade in diagdetail" id="diagnostic">
                                            <!-- first Section Start -->
                                            <aside class="clearfix">
                                            <section class="col-md-5 detailbox m-b-20 diag" >
                                            <aside class="bg-white">
                                            <figure class="clearfix">
                                            <h3>Diagnostic Categories Available</h3>
                                            <article class="clearfix">
                                            <div class="input-group m-b-5">
                                            <span class="input-group-btn">
                                            <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                                            </span>
                                            <input type="text" id="search-text1" placeholder="search" class="form-control">
                                            </div>
                                            </article>
                                            </figure>
                                            <div class="nicescroll mx-h-400">
                                            <div class="clearfix diag-detail">
                                            <ul id="list1">
                                           <!-- <li>Pet</li>
                                            <li>Mri</li> -->
                                            </ul>
                                            </div>
                                            </div>
                                            </aside>
                                            </section>
                                            <!-- first Section End -->
                                            <section class="col-md-2 detailbox m-b-20 text-center">
                                            <div class="m-t-150">
                                            <a onclick="addDiagnostic()"><i class="fa fa-arrow-right s-add"></i></a>
                                            </div>
                                            <div class="m-t-50">
                                            <a onclick="revertDiagnostic()"> <i class="fa fa-arrow-left s-add"></i></a>
                                            </div>
                                            </section>
                                            <!-- second Section Start -->
                                            <section class="col-md-5 detailbox m-b-20 diag">
                                            <aside class="bg-white">
                                            <figure class="clearfix">
                                            <h3>Diagnostic Categories Added</h3>
                                            <article class="clearfix">
                                            <div class="input-group m-b-5">
                                            <span class="input-group-btn">
                                            <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                                            </span>
                                            <input type="text" id="search-text" placeholder="search" class="form-control">
                                            </div>
                                            </article>
                                            </figure>
                                            <div class="nicescroll mx-h-400">
                                            <div class="clearfix diag-detail">
                                            <ul id="list">
                                            <!--<li>Pet</li>
                                            <li>Mri</li> -->
                                            </ul>
                                            </div>
                                            </div>
                                            </aside>
                                            </section>
                                            <!-- second Section End -->
                                            </aside>
                                            <section class="clearfix detailbox m-b-20">
                                            <div class="col-md-8" ng-app="myApp" ng-controller="diag-c-avail">
                                            <figure class="clearfix">
                                            <h3>Diagnostic Test Pricing Setup</h3>
                                            <article class="clearfix">
                                            <div class="input-group m-b-5">
                                            <span class="input-group-btn">
                                            <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                                            </span>
                                            <input type="text" placeholder="Search" class="form-control" name="example-input1-group2" id="example-input1-group2">
                                            </div>
                                            </article>
                                            </figure>
                                            <aside class="table-responsive">
                                            <table class="table">
                                            <col style="width:70%">
                                            <col style="width:20%">
                                            <col style="width:10%">
                                            <tbody>
                                            <tr class="border-a-dull">
                                            <th>Test Name</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                            </tr>
                                            </tbody>
                                            </table>
                                            <article class="nicescroll mx-h-300">
                                            <table class="table">
                                            <col style="width:70%">
                                            <col style="width:20%">
                                            <col style="width:10%">
                                            <tbody id="loadTestDetail">
                                            <!--<tr>
                                            <td>
                                            Cmplete Blood Count(CBC)
                                            </td>
                                            <td>
                                            <i class="fa fa-inr"></i> <a data-title="Enter username" data-pk="1" data-type="text" id="username" href="#" class="editable editable-click " data-original-title="" title="Edit Price">1200</a>
                                            </td>
                                            <td>
                                            <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                            Blood Chemistry Test
                                            </td>
                                            <td>
                                            <i class="fa fa-inr"></i> 1200
                                            </td>
                                            <td>
                                            <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                            Cmplete Blood Count(CBC)
                                            </td>
                                            <td>
                                            <i class="fa fa-inr"></i> 1200
                                            </td>
                                            <td>
                                            <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                            Blood Chemistry Test
                                            </td>
                                            <td>
                                            <i class="fa fa-inr"></i> 1200
                                            </td>
                                            <td>
                                            <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                            Cmplete Blood Count(CBC)
                                            </td>
                                            <td>
                                            <i class="fa fa-inr"></i> 1200
                                            </td>
                                            <td>
                                            <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                            Blood Chemistry Test
                                            </td>
                                            <td>
                                            <i class="fa fa-inr"></i> 1200
                                            </td>
                                            <td>
                                            <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                            Cmplete Blood Count(CBC)
                                            </td>
                                            <td>
                                            <i class="fa fa-inr"></i> 1200
                                            </td>
                                            <td>
                                            <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                            Blood Chemistry Test
                                            </td>
                                            <td>
                                            <i class="fa fa-inr"></i> 1200
                                            </td>
                                            <td>
                                            <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                            Cmplete Blood Count(CBC)
                                            </td>
                                            <td>
                                            <i class="fa fa-inr"></i> 1200
                                            </td>
                                            <td>
                                            <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                            Blood Chemistry Test
                                            </td>
                                            <td>
                                            <i class="fa fa-inr"></i> 1200
                                            </td>
                                            <td>
                                            <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>
                                            </td>
                                            </tr>-->
                                            </tbody>
                                            </table>
                                            </article>
                                            </aside>
                                            </div>
                                            <div class="col-md-4">
                                            <figure class="clearfix">
                                            <h3 class="pull-left ">Test Preparation Instruction</h3>
                                            </figure>
                                            <aside class="clearfix mx-h-400">
                                            <article class="nicescroll">
                                            <p class="p-5" id="detailInstruction"></p>
                                             <!--<p class="p-5" id="detailInstruction">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                            </p>-->
                                            <aside class="clearfix p-5">
                                            <a href="#" class="btn btn-success waves-effect waves-light m-b-5 p-abs " data-toggle="modal" data-target="#myModal">Edit</a>
                                            </aside>
                                            </article>
                                            </aside>
                                            </div>
                                            </section>
                                     </section>
                                    <!-- diagnostic Ends --> 
                                    
                                     <!--Specialities Starts -->
                                    <section class="tab-pane fade in" id="specialities">
                  <aside class="clearfix">
                  <section class="col-md-5 detailbox m-b-20 diag" >
                  <aside class="bg-white">
                  <figure class="clearfix">
                  <h3>Specialities Categories Available</h3>
                  <article class="clearfix">
                  <div class="input-group m-b-5">
                  <span class="input-group-btn">
                  <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                  </span>
                  <input type="text" id="search-text2" placeholder="search" class="form-control">
                  </div>
                  </article>
                  </figure>
                  <div class="nicescroll mx-h-400">
                  <div class="clearfix diag-detail">
                  <ul id="list2">
                 <!-- <li>Pet</li>
                  <li>Mri</li> -->
                  </ul>
                  </div>
                  </div>
                  </aside>
                  </section>
                  <!-- first Section End -->
                  <section class="col-md-2 detailbox m-b-20 text-center">
                  <div class="m-t-150">
                  <a onclick="sendSpeciality()"><i class="fa fa-arrow-right s-add"></i></a>
                  </div>
                  <div class="m-t-50">
                  <a onclick ="revertSpeciality()"> <i class="fa fa-arrow-left s-add"></i></a>
                  </div>
                  </section>
                  <!-- second Section Start -->
                  <section class="col-md-5 detailbox m-b-20 diag">
                  <aside class="bg-white">
                  <figure class="clearfix">
                  <h3>Specialities Categories Added</h3>
                  <article class="clearfix">
                  <div class="input-group m-b-5">
                  <span class="input-group-btn">
                  <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                  </span>
                  <input type="text" id="search-text3" placeholder="search" class="form-control">
                  </div>
                  </article>
                  </figure>
                  <div class="nicescroll mx-h-400">
                  <div class="clearfix diag-detail">
                  <ul id="list3">
                 <!-- <li>Pet</li>
                  <li>Mri</li> -->
                  </ul>
                  </div>
                  </div>
                  </aside>
                  </section>
                  <!-- second Section End -->
                  </aside>
               </section>
                                    <!-- Specialities Ends -->
                                    <!--Gllery Starts -->
                                    <section class="tab-pane fade in" id="gallery">
                                        <div class="fileUpload btn btn-sm btn-upload im-upload">
                                            <span class="btn btn-appointment">Add More</span>
                                            <input type="file" class="upload" id="uploadBtn">
                                        </div>
                                        <div class="clearfix" id="galleryImages">
                                            <aside class="col-md-3 col-sm-4 col-xs-6 show-image">
                                                <img class="thumbnail img-responsive" src="<?php echo base_url()?>assets/images/hospital/h1.jpg">
                                                <a class="delete"> <i class="fa fa-times fa-2x"></i></a>
                                            </aside>
                                            <aside class="col-md-3 col-sm-4 col-xs-6 show-image">
                                                <img class="thumbnail img-responsive" src="<?php echo base_url()?>assets/images/hospital/h2.jpg">
                                                <a class="delete"> <i class="fa fa-times fa-2x"></i></a>
                                            </aside>
                                            <aside class="col-md-3 col-sm-4 col-xs-6 show-image">
                                                <img class="thumbnail img-responsive" src="<?php echo base_url()?>assets/images/hospital/h3.jpg">
                                                <a class="delete"> <i class="fa fa-times fa-2x"></i></a>
                                            </aside>
                                            <aside class="col-md-3 col-sm-4 col-xs-6 show-image">
                                                <img class="thumbnail img-responsive" src="<?php echo base_url()?>assets/images/hospital/h4.jpg">
                                                <a class="delete"> <i class="fa fa-times fa-2x"></i></a>
                                            </aside>
                                            <aside class="col-md-3 col-sm-4 col-xs-6 show-image">
                                                <img class="thumbnail img-responsive" src="<?php echo base_url()?>assets/images/hospital/h2.jpg">
                                                <a class="delete"> <i class="fa fa-times fa-2x"></i></a>
                                            </aside>
                                        </div>
                                    </section>
                                    <!--Gallery Ends -->
                                    
                                    <!-- Timeslot start -->
                                      <!-- Timeslot Starts Section -->
                                    <section class="tab-pane fade in" id="timeslot">
                                        <div class="col-md-10 p-b-20">
                                            <form class="form-horizontal">

                                                <aside id="session">
                                                    <article class="clearfix m-t-10">
                                                        <label for="" class="control-label col-md-4 col-sm-4">Morning Session:</label>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepicker4" type="text" class="form-control timepicker" value="06:00 AM" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepicker4" type="text" class="form-control timepicker" value="11:59 AM" />
                                                            </div>
                                                        </div>
                                                    </article>

                                                    <article class="clearfix m-t-10">
                                                        <label for="" class="control-label col-md-4 col-sm-4">Afternoon Session :</label>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepicker4" type="text" class="form-control timepicker" value="12:00 PM" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepicker4" type="text" class="form-control timepicker" value="05:59 PM" />
                                                            </div>
                                                        </div>
                                                    </article>

                                                    <article class="clearfix m-t-10">
                                                        <label for="" class="control-label col-md-4 col-sm-4">Evening Session :</label>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepicker4" type="text" class="form-control timepicker" value="06:00 PM" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepicker4" type="text" class="form-control timepicker" value="10:59 PM" />
                                                            </div>
                                                        </div>
                                                    </article>

                                                    <article class="clearfix m-t-10">
                                                        <label for="" class="control-label col-md-4 col-sm-4">Night Session :</label>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepicker4" type="text" class="form-control timepicker" value="11:00 PM" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepicker4" type="text" class="form-control timepicker" value="5:00 AM" />
                                                            </div>
                                                        </div>
                                                    </article>

                                                </aside>
                                                <article class="clearfix ">
                                                    <div class="col-md-12 m-t-20 m-b-20">
                                                        <button class="btn btn-danger waves-effect pull-right" type="button">Reset</button>
                                                        <button class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit">Submit</button>
                                                    </div>
                                                </article>
                                            </form>
                                        </div>
                                    </section>
                                    <!-- Timeslot Ends -->
                                  
                                    
                                     <!--All Doctors Starts -->
                                   <section class="tab-pane fade in" id="doctor">

                                    <article class="clearfix m-top-40 p-b-20">
                           <aside class="table-responsive">
                              <table class="table all-doctor">
                                 <tbody>
                                    <tr class="border-a-dull">
                                       <th>Photo</th>
                                       <th>Name and Id</th>
                                       <th>Speciality</th>
                                       <th>Experience</th>
                                       <th>Date of Joining</th>
                                       <th>Phone</th>
                                       <th>Action</th>
                                    </tr>
                                    <tr>
                                       <td>
                                          <i class="fa fa-check-circle doc-online"></i>
                                          <h6><img src="assets/images/doctor/doc-1.jpg" alt="" class="img-responsive" /></h6>
                                       </td>
                                       <td>
                                          <h6>Alpesh Dhakad</h6>
                                          <p>ACH089</p>
                                       </td>
                                       <td>
                                          <h6>Surgury</h6>
                                       </td>
                                       <td>
                                          <h6>20 Years</h6>
                                       </td>
                                       <td>
                                          <h6>15 Nov, 2014</h6>
                                       </td>
                                       <td>
                                          <h6>9826000777</h6>
                                          <h6>0731-2349999</h6>
                                       </td>
                                       <td>
                                          <h6><a href="doctor-profile.html" class="btn btn-warning waves-effect waves-light m-b-5 applist-btn">View Detail</a></h6>
                                          <a href="edit-doctor.html" class="btn btn-success waves-effect waves-light m-b-5 applist-btn">Edit Detail</a>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <i class="fa fa-check-circle doc-online"></i>
                                          <h6><img src="assets/images/doctor/doc-2.jpg" alt="" class="img-responsive" /></h6>
                                       </td>
                                       <td>
                                          <h6>Dr. Manoj Kumar</h6>
                                          <p>ACH089</p>
                                       </td>
                                       <td>
                                          <h6>Cardiology</h6>
                                       </td>
                                       <td>
                                          <h6>15 Years</h6>
                                       </td>
                                       <td>
                                          <h6>15 Jan, 2013</h6>
                                       </td>
                                       <td>
                                          <h6>9826000777</h6>
                                          <h6>0731-2349999</h6>
                                       </td>
                                       <td>
                                          <h6><a href="doctor-profile.html" class="btn btn-warning waves-effect waves-light m-b-5 applist-btn">View Detail</a></h6>
                                          <a href="edit-doctor.html" class="btn btn-success waves-effect waves-light m-b-5 applist-btn">Edit Detail</a>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <i class="fa fa-check-circle doc-online"></i>
                                          <h6><img src="assets/images/doctor/doc-3.jpg" alt="" class="img-responsive" /></h6>
                                       </td>
                                       <td>
                                          <h6>Dr. Prabha Jha</h6>
                                          <p>ACH089</p>
                                       </td>
                                       <td>
                                          <h6>Eye Specialist</h6>
                                       </td>
                                       <td>
                                          <h6>10 Years</h6>
                                       </td>
                                       <td>
                                          <h6>15 Jan, 2013</h6>
                                       </td>
                                       <td>
                                          <h6>9826000777</h6>
                                          <h6>0731-2349999</h6>
                                       </td>
                                       <td>
                                          <h6><a href="doctor-profile.html" class="btn btn-warning waves-effect waves-light m-b-5 applist-btn">View Detail</a></h6>
                                          <a href="edit-doctor.html" class="btn btn-success waves-effect waves-light m-b-5 applist-btn">Edit Detail</a>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <i class="fa fa-check-circle doc-online"></i>
                                          <h6><img src="assets/images/doctor/doc-1.jpg" alt="" class="img-responsive" /></h6>
                                       </td>
                                       <td>
                                          <h6>Alpesh Dhakad</h6>
                                          <p>ACH089</p>
                                       </td>
                                       <td>
                                          <h6>Surgury</h6>
                                       </td>
                                       <td>
                                          <h6>20 Years</h6>
                                       </td>
                                       <td>
                                          <h6>15 Nov, 2014</h6>
                                       </td>
                                       <td>
                                          <h6>9826000777</h6>
                                          <h6>0731-2349999</h6>
                                       </td>
                                       <td>
                                          <h6><a href="doctor-profile.html" class="btn btn-warning waves-effect waves-light m-b-5 applist-btn">View Detail</a></h6>
                                          <a href="edit-doctor.html" class="btn btn-success waves-effect waves-light m-b-5 applist-btn">Edit Detail</a>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <i class="fa fa-check-circle doc-online"></i>
                                          <h6><img src="assets/images/doctor/doc-2.jpg" alt="" class="img-responsive" /></h6>
                                       </td>
                                       <td>
                                          <h6>Dr. Manoj Kumar</h6>
                                          <p>ACH089</p>
                                       </td>
                                       <td>
                                          <h6>Cardiology</h6>
                                       </td>
                                       <td>
                                          <h6>15 Years</h6>
                                       </td>
                                       <td>
                                          <h6>15 Jan, 2013</h6>
                                       </td>
                                       <td>
                                          <h6>9826000777</h6>
                                          <h6>0731-2349999</h6>
                                       </td>
                                       <td>
                                          <h6><a href="doctor-profile.html" class="btn btn-warning waves-effect waves-light m-b-5 applist-btn">View Detail</a></h6>
                                          <a href="edit-doctor.html" class="btn btn-success waves-effect waves-light m-b-5 applist-btn">Edit Detail</a>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <i class="fa fa-check-circle doc-online"></i>
                                          <h6><img src="assets/images/doctor/doc-3.jpg" alt="" class="img-responsive" /></h6>
                                       </td>
                                       <td>
                                          <h6>Dr. Prabha Jha</h6>
                                          <p>ACH089</p>
                                       </td>
                                       <td>
                                          <h6>Eye Specialist</h6>
                                       </td>
                                       <td>
                                          <h6>10 Years</h6>
                                       </td>
                                       <td>
                                          <h6>15 Jan, 2013</h6>
                                       </td>
                                       <td>
                                          <h6>9826000777</h6>
                                          <h6>0731-2349999</h6>
                                       </td>
                                       <td>
                                          <h6><a href="doctor-profile.html" class="btn btn-warning waves-effect waves-light m-b-5 applist-btn">View Detail</a></h6>
                                          <a href="edit-doctor.html" class="btn btn-success waves-effect waves-light m-b-5 applist-btn">Edit Detail</a>
                                       </td>
                                    </tr>
                    
                                </tbody>
                              </table>
                           </aside>
                            <article class="clearfix m-t-20 p-b-20">
                        <ul class="list-inline list-unstyled pull-right call-pagination">
                           <li class="disabled"><a href="#">Prev</a></li>
                           <li><a href="#">1</a></li>
                           <li class="active"><a href="#">2</a></li>
                           <li><a href="#">3</a></li>
                           <li><a href="#">4</a></li>
                           <li><a href="#">Next</a></li>
                        </ul>
                     </article>                              
                        </article>
                                    </section>
                                    <!-- All Doctors Ends -->
                                    
                                   <!--Account Starts -->
                                    <section class="tab-pane fade in" id="account">
                                        <aside class="col-md-9 setting">
                                            <h4>Account Detail
                                                <a id="editac"  class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                                            </h4>
                                            <hr/>

                                            <!-- Account Detail Section -->
                                            <div class="clearfix m-t-20 p-b-20 doctor-description" id="detailac">
                                                <article class="clearfix m-b-10">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-5">Registered Email Id :</label>
                                                    <p class="col-md-8 col-sm-7"><?php echo $hospitalData[0]->users_email; ?></p>
                                                </article>
                                                <article class="clearfix m-b-10">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-5">Registered Mobile Number:</label>
                                                    <p class="col-md-8 col-sm-7">+91 <?php if(isset($hospitalData[0]->users_mobile)){ echo $hospitalData[0]->users_mobile; } ?></p>
                                                </article>
                                                <article class="clearfix m-b-10">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-5">Membership Type:</label>
                                                    <p class="col-md-6 col-sm-5">
                                                        <?php if($hospitalData[0]->hospital_mmbrTyp == 1){echo 'Life Time';}if($hospitalData[0]->hospital_mmbrTyp == 2){echo 'Health Club';}?>
                                                    </p>
                                                   <!-- <aside class="col-sm-2">
                                                        <button class="btn btn-appointment waves-effect waves-light pull-right" type="button">Upgrade</button>
                                                    </aside> -->
                                                </article>
                                                <article class="clearfix m-b-10">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-5">Change Password:</label>

                                                    <aside class="col-md-5 col-sm-6">
                                                        <form class="">
                                                            <input type="password" name="password" class="form-control" placeholder="New Password" value ="********" readonly="readonly" />
                                                        </form>
                                                    </aside>
                                                </article>
                                            </div>
                                            <!-- Account Detail Section -->

                                            <!-- Account Edit Section -->
                                            <form name="acccountForm" id="acccountForm" type="post">
                                                <input type="hidden" name="hospitalUserId" id="hospitalUserId" value="<?php echo $hospitalData[0]->users_id;?>" >
                                                 <p class="text-success" style="display:none;" id="error-password_email_check_success"> Data Changed Successfully!</p>
                                                <aside id="newac" style="display:none">
                                                <article class="clearfix m-b-10">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Registered Email Id :</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <input class="form-control" id="users_email" name="users_email" type="users_email" required="" value="<?php echo $hospitalData[0]->users_email; ?>" onblur="checkEmailFormat()">
                                                        <label class="error" style="display:none;" id="error-users_email"> please enter Email id Properly</label>
                                                        <label class="error" style="display:none;" id="error-users_email_check"> Email Already Exits!</label>
                                                        <label class="error" style="display:none;" id="error-users_emailBlank"> Email id field should not be blank!</label>
                                                    </div>
                                                </article>

                                               <!-- <article class="clearfix m-b-10">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Name :</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <input class="form-control" id="diagnosticCenter" name="name" type="text" required="" value="Appolo Pharmacies">
                                                    </div>
                                                </article> -->

                                                <article class="clearfix m-b-10 ">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Mobile Numbers :</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <aside class="row">
                                                            <!--<div class="col-md-3 col-sm-3 col-xs-12">
                                                                <select class="selectpicker" data-width="100%">
                                                                    <option>+91</option>
                                                                    <option>+1</option>
                                                                </select>
                                                            </div>-->
                                                            <div class="col-md-9 col-sm-9 col-xs-12 m-t-xs-10">
                                                                <input type="teL" class="form-control" name="users_mobile" id="users_mobile" placeholder="9837000123" onkeypress="return isNumberKey(event)" value="<?php if(isset($hospitalData[0]->users_mobile)){ echo $hospitalData[0]->users_mobile; } ?>" />
                                                                   <p class="error" id="error-users_mobile" style="display:none;"> Enter Mobile Number!</p>
                                                            </div>
                                                            <!--<p class="m-t-10">* If it is landline, include Std code with number </p> -->
                                                        </aside>
                                                    </div>
                                                </article>

                                                <article class="clearfix m-b-10">
                                                    <label for="cname" class="control-label col-md-4 col-sm-4">Membership Type:</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <select class="selectpicker" data-width="100%" name="hospital_mmbrTyp" id="hospital_mmbrTyp">
                                                            <option value="1" <?php if($hospitalData[0]->hospital_mmbrTyp == 1){echo "selected";} ?>>Life Time</option>
                                                            <option value="2" <?php if($hospitalData[0]->hospital_mmbrTyp == 2){echo "selected";} ?>>Health Club</option>

                                                        </select>
                                                    </div>
                                                </article>
                                                <article class="clearfix m-b-10">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Change Password:</label>

                                                    <aside class="col-md-8 col-sm-8">
                                                      
                                                            <input type="password" name="users_password" id="users_password" class="form-control" placeholder="New Password" />
                                                             <label class="error" style="display:none;" id="error-users_password"> please enter password and should be 6 character </label>
                                                    </aside>
                                                </article>
                                               <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-5">Confirm Password:</label>

                                                <aside class="col-md-8 col-sm-8">
                                                   
                                                    <input type="password" name="cnfPassword" class="form-control" placeholder="Confirm Password" id="cnfPassword" />
                                                   
                                                    <!--<p><a class="m-t-10" href="javascript:void(0)" onclick="updatePassword()">Edit</a></p> -->
                                                     <label class="error" style="display:none;" id="error-cnfPassword"> Password and confirm password should be same </label>
                                                  
                                                   
                                                </aside>
                                            </article>
                                               <!-- <input type="text" name="myPassword" id="myPassword" value="<?php if(isset($bloodBankData[0]->users_password)){ echo $bloodBankData[0]->users_password;}?>" /> -->
                                                <article class="clearfix ">
                                                    <div class="col-md-12 m-t-20 m-b-20">

                                                        <button type="button" class="btn btn-success waves-effect waves-light pull-right" onclick="updateAccount()">Update</button>
                                                    </div>

                                                </article>
                                            </aside>
                                            </form>    
                                            <!-- Account Edit Section -->
                                        </aside>
                                    </section>
                                   
                                   <!-- Account Ends -->

                                </article>

                            </section>



                            <!-- Table Section End -->
                            <article class="clearfix">

                            </article>
                        </div>

                    </section>
                    <!-- Left Section End -->


                </div>

                <!-- container -->
            </div>
            <!-- content -->
            <footer class="footer text-right">
                2015 © Qyura.
            </footer>
        </div>
        <!-- End Right content here -->
        <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Edit Detail</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Comming Soon</p>

                                </div>
                                <div class="modal-footer p-t-10">
                                    <button type="button" class="btn btn-appointment" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
    </div>
    <!-- END wrapper -->
     <!--Change Logo-->
                    <div id="changeBg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3>Change Background</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-body">
                                        <img src="assets/images/hospital.jpg" class="img-responsive center-block" />
                                        <form class="form-horizontal">

                                            <article class="form-group m-lr-0 ">
                                                    <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Background :</label>
                                                    <div class="col-md-8 col-sm-8 text-right">
                                                        <input id="uploadFileBg" class="showUpload" disabled="disabled" />
                                                        <div class="fileUpload btn btn-sm btn-upload">
                                                            <span><i class="fa fa-cloud-upload fa-3x"></i></span>
                                                            <input id="uploadBtnBg" type="file" class="upload" />
                                                        </div>
                                                    </div>
                                                </article>


                                            <article class="clearfix m-t-20">
                                                <button type="button" class="btn btn-primary pull-right waves-effect waves-light bg-btn m-r-20">Upload</button>
                                            </article>
                                        </form>
                                    </div>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    </div>
                    <!-- /Change Logo -->
                                        
                    <!-- Gallery Model -->
                    <div class="modal" id="modal-gallery" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                  <button class="close" type="button" data-dismiss="modal">×</button>
                                  <h3 class="modal-title"></h3>
                              </div>
                              <div class="modal-body">
                                  <div id="modal-carousel" class="carousel">

                                    <div class="carousel-inner">           
                                    </div>

                                    <a class="carousel-control left" href="#modal-carousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                                    <a class="carousel-control right" href="#modal-carousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>

                                  </div>
                              </div>
                              <div class="modal-footer">
                                  <button class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                    </div>
                    <!-- Gallery Model Ends -->






    <script>
        var resizefunc = [];
    </script>
     <script src="<?php echo base_url();?>assets/js/jquery-1.8.2.min.js"> </script>
    <script src="<?php echo base_url();?>assets/js/framework.js"> </script>
     <script src="<?php echo base_url();?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/vendor/timepicker/bootstrap-timepicker.min.js">  </script>
    <script type="text/javascript" src="https://www.google.com/jsapi">
    </script>
 
   <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>

    <script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/x-editable/jquery.xeditable.js"> </script>
    <!--<script src="<?php echo base_url(); ?>assets/js/angular.min.js"> </script>-->
    <script src="<?php echo base_url(); ?>assets/js/pages/hospital-detail.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/select2/select2.min.js" type="text/javascript"></script>
    <script>
        
         var stateIds = $.trim($('#StateId').val());
         
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
        $(document).ready(function(){
           
           /* fetchStates();
            function fetchStates(){
            
            var countryId = $('#countryId').val();
            //var stateId = $('#StateId').val();
            
            $.ajax({
               url : urls + 'index.php/hospital/fetchStates',
               type: 'POST',
              data: {'stateId' : stateIds , 'countryId' : countryId},
              success:function(datas){
               // console.log(datas);
                  $('#hospital_stateId').html(datas);
                  $('#hospital_stateId').selectpicker('refresh');
                  fetchCityOnload();
                  //$('#StateId').val(stateId);
              }
           });
        }

        function fetchCityOnload(stateId) {    
           var cityId = $('#cityId').val();
           //alert(cityId);
           $.ajax({
               url : urls + 'index.php/hospital/fetchCityOnload',
               type: 'POST',
              data: {'stateId' : stateIds , 'cityId' : cityId},
              success:function(datas){
               // console.log(datas);
                  $('#hospital_cityId').html(datas);
                  $('#hospital_cityId').selectpicker('refresh');
                  $('#StateId').val(stateId);
              }
           });
           
        }*/
      
        $(".bs-select").select2({ placeholder: "Select Insurance",
          allowClear: true
      });
        loadAwards();
        loadServices();
        var pharmacy_status = '';
        pharmacy_status = $('#pharmacy_status').val();
        var bloodbank_status = '';
        bloodbank_status = $('#bloodbank_status').val();
        if(bloodbank_status != '')
        $("#bloodbankbtn").trigger("click");
        if(bloodbank_status != '')
        $("#pharmacybtn").trigger("click");
         
         loadSpeciality();
          loadDiagonastic();
       
    }) ;
    function addDiagnostic(){
         $('.diagonasticCheck').each(function() {
            if($(this).is(':checked')){
                $.ajax({
                    url : urls + 'index.php/hospital/addDiagnostic',
                    type: 'POST',
                   data: {'hospitalId' : hospitalId , 'hospitalDiagnosticsCat_diagnosticsCatId' : $(this).val() },
                   success:function(datas){
                    
                       loadDiagonastic();
                   }
                });
            }
            
        });
    }
    function revertDiagnostic(){
         $('.diagonasticAllocCheck').each(function() {
            if($(this).is(':checked')){
                $.ajax({
                    url : urls + 'index.php/hospital/revertDiagnostic',
                    type: 'POST',
                   data: {'hospitalId' : hospitalId , 'hospitalDiagnosticsCat_id' : $(this).val() },
                   success:function(datas){
                    
                       loadDiagonastic();
                   }
                });
            }
            
        });
    }
    function showDiagonasticDetail(hospitalId,categoryId){
        $.ajax({
                    url : urls + 'index.php/hospital/detailDiagnostic',
                    type: 'POST',
                   data: {'hospitalId' : hospitalId , 'categoryId' : categoryId },
                   success:function(datas){
                    
                       $('#loadTestDetail').html(datas);
                   }
                });
    }
    function fetchInstruction(digTestId){
         $.ajax({
                    url : urls + 'index.php/hospital/detailDiagnosticInstruction',
                    type: 'POST',
                   data: {'quotationDetailTests_id' : digTestId},
                   success:function(datas){
                    
                       $('#detailInstruction').html(datas);
                   }
                });
    }
    function loadDiagonastic(){
        $('#list1').load(urls + 'index.php/hospital/hospitalDiagnostics/'+hospitalId,function () {
           // alert('callback function implementation');
        });
        
        $('#list').load(urls + 'index.php/hospital/hospitalFetchDiagnostics/'+hospitalId,function () {
           // alert('callback function implementation');
        });
        $('#loadTestDetail').html('');
    }
    function sendSpeciality(){
        var specialityId = [];
        $('.specialityCheck').each(function() {
            if($(this).is(':checked')){
                $.ajax({
                    url : urls + 'index.php/hospital/addSpeciality',
                    type: 'POST',
                   data: {'hospitalId' : hospitalId , 'hospitalSpecialities_specialitiesId' : $(this).val() },
                   success:function(datas){
                    
                      loadSpeciality();
                   }
                });
            }
            
        });
    }
    
    function revertSpeciality(){
        $('.specialityAllocCheck').each(function() {
            if($(this).is(':checked')){
                //alert($(this).val());
                $.ajax({
                    url : urls + 'index.php/hospital/revertSpeciality',
                    type: 'POST',
                   data: {'hospitalId' : hospitalId , 'hospitalSpecialities_id' : $(this).val() },
                   success:function(datas){
                    
                      loadSpeciality();
                   }
                });
            }
            
        });
    }
   
    
    function loadSpeciality(){
     $('#list2').load(urls + 'index.php/hospital/hospitalSpecialities/'+hospitalId,function () {
           // alert('callback function implementation');
        });
        $('#list3').load(urls + 'index.php/hospital/hospitalAllocatedSpecialities/'+hospitalId,function () {
           // alert('callback function implementation');
        });
    
    }  
    
    
    function addAwards(){
        var hospitalAwards_awardsName = $.trim($('#hospitalAwards_awardsName').val());
        if(hospitalAwards_awardsName != ''){
            
            $.ajax({
               url : urls + 'index.php/hospital/addSpeciality',
               type: 'POST',
              data: {'hospitalId' : hospitalId , 'hospitalAwards_awardsName' : hospitalAwards_awardsName },
              success:function(datas){
               // console.log(datas);
                  loadAwards();
                  $('#hospitalAwards_awardsName').val('');
              }
           });
        }    
    }
    function editAwards(awardsId){
         var edit_awardsName = $.trim($('#'+awardsId).val());
        
        if(edit_awardsName != ''){
            
            $.ajax({
               url : urls + 'index.php/hospital/editHospitalAwards',
               type: 'POST',
              data: {'awardsId' : awardsId , 'hospitalAwards_awardsName' : edit_awardsName },
              success:function(datas){
              console.log(datas);
                  loadAwards();
              }
           });
        }  
    }
    function deleteAwards(awardsId){
        
         $.ajax({
               url : urls + 'index.php/hospital/deleteHospitalAwards',
               type: 'POST',
              data: {'awardsId' : awardsId },
              success:function(datas){
              console.log(datas);
                  loadAwards();
              }
           });
        
    }
    function loadAwards(){
       
        $('#loadAwards').load(urls + 'index.php/hospital/hospitalAwards/'+hospitalId,function () {
           // alert('callback function ');
        });
        $('#totalAwards').load(urls + 'index.php/hospital/detailAwards/'+hospitalId,function () {
           // alert('callback function implementation');
        });
    }
    function loadServices(){
        $('#loadServices').load(urls + 'index.php/hospital/hospitalServices/'+hospitalId,function (data) {
            //alert('callback function implementation');
            
        });
        $('#totalServices').load(urls + 'index.php/hospital/detailServices/'+hospitalId,function () {
            //alert('callback function implementation');
        });
    }
    function addServices(){
        var hospitalServices_serviceName = $.trim($('#hospitalServices_serviceName').val());
        //alert(hospitalServices_serviceName);
        if(hospitalServices_serviceName != ''){
            
            $.ajax({
               url : urls + 'index.php/hospital/addHospitalService',
               type: 'POST',
              data: {'hospitalId' : hospitalId , 'hospitalServices_serviceName' : hospitalServices_serviceName },
              success:function(datas){
               // console.log(datas);
                  loadServices();
                  $('#hospitalServices_serviceName').val('');
              }
           });
        }    
    }
    
    function editServices(serviceId){
         var edit_serviceName = $.trim($('#'+serviceId).val());
        
        if(edit_serviceName != ''){
            
            $.ajax({
               url : urls + 'index.php/hospital/editHospitalService',
               type: 'POST',
              data: {'serviceId' : serviceId , 'hospitalServices_serviceName' : edit_serviceName },
              success:function(datas){
              console.log(datas);
                  loadServices();
              }
           });
        }  
    }
    
    function deleteServices(serviceId){
        
         $.ajax({
               url : urls + 'index.php/hospital/deleteHospitalService',
               type: 'POST',
              data: {'serviceId' : serviceId },
              success:function(datas){
              console.log(datas);
                  loadServices();
              }
           });
        
    }
      function fetchCity(stateId) {    
           
           $.ajax({
               url : urls + 'index.php/hospital/fetchCity',
               type: 'POST',
              data: {'stateId' : stateId},
              success:function(datas){
               // console.log(datas);
                  $('#hospital_cityId').html(datas);
                  $('#hospital_cityId').selectpicker('refresh');
                  $('#StateId').val(stateId);
              }
           });
           
        }
       function validationHospital(){
           
       //$("form[name='bloodDetail']").submit();
        var check= /^[a-zA-Z\s]+$/;
        var numcheck=/^[0-9]+$/;
        //var emails = $.trim($('#users_email').val());
        
       
         if($.trim($('#hospital_name').val()) === ''){
                $('#hospital_name').addClass('bdr-error');
                
            }
          
            if($.trim($('#geocomplete').val()) === ''){
               $("#geocomplete").addClass('bdr-error');
               
            }
             if(!check.test(cpname)){
                $('#hospital_cntPrsn').addClass('bdr-error');
                
            }

            if( emails !== ''){
                check_email(emails);
            }
            
            return false;
            
            
        }
        function checkNumber(id){
            var phone = $.trim($('#'+'hospital_phn'+id).val());
            if(!($.isNumeric(phone))){
             $('#'+'hospital_phn'+id).addClass('bdr-error');
         }
        }
        function checkEmailFormat(){
           
                var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                var email = $('#users_email').val();
                if(email!==''){
                    if (!filter.test(email)){
                       $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');
                    }
            }
        } 
        
       
        function updateAccount(){
          
            var pswd = $.trim($("#users_password").val());
            var cnfpswd = $.trim($("#cnfPassword").val());
            var mobile = $('#users_mobile').val();
            var emails = $('#users_email').val();
            var user_tables_id = $('#user_tables_id').val();
            var users_mobile = $('#users_mobile').val();
            var returnValue = 0;
           
            var status = 1;
            if(emails === ''){
                $('#error-users_emailBlank').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
            if(users_mobile === ''){
                $('#error-users_mobile').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
            if(pswd != ''){
                if(pswd.length < 6){
                    $('#users_password').addClass('bdr-error');
                    $('#error-users_password').fadeIn().delay(3000).fadeOut('slow');
                   // $('#users_password').focus();
                   status = 0;
                }

               if(pswd != cnfpswd){
                    $('#cnfPassword').addClass('bdr-error');
                    $('#error-cnfPassword').fadeIn().delay(3000).fadeOut('slow');

                   // $('#cnfpassword').focus();
                   status = 0;
                }
            }
            if(status == 0)
                return false;
            else{
                    var user_table_id = $('#user_tables_id').val();
                    $.ajax({
                        url : urls + 'index.php/hospital/check_email',
                        type: 'POST',
                       data: {'users_email' : emails,'user_table_id' : user_table_id },
                       success:function(datas){
                           //console.log(datas);
                           if(datas == 0){
                            
                             $.ajax({
                                    url : urls + 'index.php/hospital/updatePassword',
                                    type: 'POST',
                                   //data: {'currentPassword' : pswd,'existingPassword' : password,'user_tables_id' : user_tables_id}, password updated from another user except super admin
                                   data: $('#acccountForm').serialize(),
                                   success:function(insertData){
                                       
                                       console.log(insertData);

                                       if(insertData == 1){
                                     $('#users_password').val('');
                                      $('#cnfPassword').val('');
                                   
                                    setTimeout(function(){
                                      $('#error-password_email_check_success').fadeIn().delay(4000).fadeOut(function() {
                                      window.location.reload();
                                                               
                                        });
                                       }, 4000);
                                      
                                        return true;
                                      }
                                     
                                   } 
                                });
                       }
                       else {
                         $('#users_email').addClass('bdr-error');
                         $('#error-users_email_check').fadeIn().delay(3000).fadeOut('slow');;

                        return false;
                       }
                       } 
                    });
                
              
            }
        }
        
         function check_email(myEmail){
            var user_table_id = $('#user_tables_id').val();
           $.ajax({
               url : urls + 'index.php/hospital/check_email',
               type: 'POST',
              data: {'users_email' : myEmail,'user_table_id' : user_table_id },
              success:function(datas){
                  console.log(datas);
                  if(datas == 0){
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
