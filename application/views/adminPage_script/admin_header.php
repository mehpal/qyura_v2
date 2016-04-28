<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="assets/images/fevicon-m.ico" rel="shortcut icon">
    <title>Dashboard</title>
    <link href="assets/css/framework.css" rel="stylesheet">
    <link href="assets/css/custom-g.css" rel="stylesheet">
    <link href="assets/css/custom-r.css" rel="stylesheet">
    <link href="assets/css/responsive-r.css" rel="stylesheet" />
    
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
     <![endif]-->
    


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

<div class="hidden-xs hidden-sm"><a class="logo" href="#"><img src="assets/images/qyura-f-l.png"></a>

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
                                        Notifications
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
                            <a href="dashboard.html" class="waves-effect active"><i class="ion-ios7-keypad-outline"></i><span>Dashboard</span></a>
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
                            <span>Diagnostic Center</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="diagnostic-center-listing.html">All Diag Centers</a></li>
                                <li><a href="add-diagcenter.html">Add New Diag Center</a></li>
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
                            <a class="waves-effect" href="#"><i class="fa fa-medkit"></i> 
                            <span>Pharmacies</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="all-pharmacies.html">All Pharmacies</a></li>
                                <li><a href="add-pharmacy.html">Add New Pharmacies</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a class="waves-effect" href="#"><i class="fa fa-ambulance"></i> 
                            <span>Ambulance Providr</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="all-ambulance-provider.html">All Ambulance Providers</a></li>
                                <li><a href="add-ambulance-provider.html">Add New Ambulance Provider</a></li>
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
                                <li><a href="#">Pending Quotation Requests</a></li>
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