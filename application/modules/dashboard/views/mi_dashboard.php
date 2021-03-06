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
    <link type="text/css" href="assets/vendor/js-scroll/style/scroll-2.css" rel="stylesheet" />

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
                        <a href="dashboard.html" class="waves-effect active"><i class="ion-ios7-keypad-outline"></i><span>Dashboard</span></a>
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
        <div class="content">
            <div class="container row">
                <!--   start section 1 -->
                <section class="clearfix">
                    <!--start total booking-->
                    <aside class=" col-md-4 col-sm-4 m-b-10">
                        <h4 class="r-box-title">Total Bookings</h4>
                        <article class="clearfix  r-box">
                            <figure class="col-md-4">
                                <small>Overall Booking</small>
                                <p>1,504</p>
                            </figure>
                            <figure class="col-md-4">
                                <small>Avg Monthly</small>
                                <p>1,504</p>
                            </figure>
                            <figure class="col-md-4">
                                <small>Today's</small>
                                <p>1,504</p>
                            </figure>
                            <figcaption class="col-md-12 clearfix">
                                <div class="progress-booking progress-sm">
                                    <div style="width: 20%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-info">
                                    </div>
                                </div>
                            </figcaption>
                            <div class="col-md-12 text-left ">
                                <h6>12% Higher than last month</h6>
                            </div>
                        </article>
                    </aside>
                    <!--end total booking-->
                    <!--start total revenue-->
                    <aside class=" col-md-4 col-sm-4 m-b-10">
                        <h4 class="y-box-title">Total Revenues (INR)</h4>
                        <article class="clearfix  y-box">
                            <figure class="col-md-4">
                                <small>Overall Booking</small>
                                <p>15,56,104</p>
                            </figure>
                            <figure class="col-md-4">
                                <small>Avg Monthly</small>
                                <p>1,55,004</p>
                            </figure>
                            <figure class="col-md-4">
                                <small>Today's</small>
                                <p>5,504</p>
                            </figure>
                            <figcaption class="col-md-12 clearfix">
                                <div class="progress-revenue progress-sm">
                                    <div style="width: 40%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-info">
                                    </div>
                                </div>
                            </figcaption>
                            <div class="col-md-12 text-left ">
                                <h6>35% Higher than last month</h6>
                            </div>
                        </article>
                    </aside>
                    <!--end total revenue-->
                    <!--start profile visits-->
                    <aside class=" col-md-4 col-sm-4 m-b-10">
                        <h4 class="b-box-title">Profile Visits</h4>
                        <article class="clearfix  b-box">
                            <figure class="col-md-4">
                                <small>Overall Visits</small>
                                <p>11,504</p>
                            </figure>
                            <figure class="col-md-4">
                                <small>Avg Monthly</small>
                                <p>345</p>
                            </figure>
                            <figure class="col-md-4">
                                <small>Today's</small>
                                <p>17</p>
                            </figure>
                            <figcaption class="col-md-12 clearfix">
                                <div class="progress-profile progress-sm">
                                    <div style="width:70%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-info">
                                    </div>
                                </div>
                            </figcaption>
                            <div class="col-md-12 text-left">
                                <h6>65% Higher than last month</h6>
                            </div>
                        </article>
                    </aside>
                    <!--end profile visits-->
                </section>
                <!--   end section  1-->







                <!-- section start -->
                <section class="clearfix m-t-30">



                    <!--  start today appt -->
                    <aside class="col-md-4 detailbox">
                        <div class="bg-white">
                            <figure class="clearfix">
                                <h3 class="pull-left">Today's Appointments</h3>
                                <form class="search-form pull-right">
                                    <input type="" class="search pull-right" />
                                </form>
                            </figure>


                            <article class="text-center clearfix border-third">
                                <ul class="nav nav-tabs">
                                    <li class="active col-md-6 col-xs-6">
                                        <a data-toggle="tab" href="#consulting">Consulting</a>
                                    </li>
                                    <li class="col-md-6 col-xs-6 b-left">
                                        <a data-toggle="tab" href="#diagnostic">Diagnostics</a>
                                    </li>
                                </ul>
                            </article>



                            <article class="tab-content h435">

                                <!-- consulting -->
                                <section class="tab-pane in active" id="consulting">
                                    <table class="table table-hover table-striped m-0">
                                        <thead>
                                            <tr>
                                                <th width="30%">Appt. Detail</th>
                                                <th width="40%">Doctor</th>
                                                <th width="30%">Time</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div class="mCustomScrollbar mxh-400" style="overflow: hidden;" tabindex="5000">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td width="30%">
                                                        <h6>AHC098</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td width="40%">
                                                        <h6>Dr. Sambit Jain</h6>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td width="30%">
                                                        <h6> 01:00 PM</h6>

                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">
                                                        <h6>AHC098</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td width="40%">
                                                        <h6>Dr. Sambit Jain</h6>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td width="30%">
                                                        <h6> 01:00 PM</h6>

                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">
                                                        <h6>AHC098</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td width="40%">
                                                        <h6>Dr. Sambit Jain</h6>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td width="30%">
                                                        <h6> 01:00 PM</h6>

                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">
                                                        <h6>AHC098</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td width="40%">
                                                        <h6>Dr. Sambit Jain</h6>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td width="30%">
                                                        <h6> 01:00 PM</h6>

                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">
                                                        <h6>AHC098</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td width="40%">
                                                        <h6>Dr. Sambit Jain</h6>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td width="30%">
                                                        <h6> 01:00 PM</h6>

                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">
                                                        <h6>AHC098</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td width="40%">
                                                        <h6>Dr. Sambit Jain</h6>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td width="30%">
                                                        <h6> 01:00 PM</h6>

                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">
                                                        <h6>AHC098</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td width="40%">
                                                        <h6>Dr. Sambit Jain</h6>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td width="30%">
                                                        <h6> 01:00 PM</h6>

                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">
                                                        <h6>AHC098</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td width="40%">
                                                        <h6>Dr. Sambit Jain</h6>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td width="30%">
                                                        <h6> 01:00 PM</h6>

                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>

                                                    </td>
                                                </tr>





                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                                <!-- consulting -->




                                <!-- diagnostic -->
                                <section class="tab-pane in" id="diagnostic">
                                    <table class="table table-hover table-striped m-0">
                                        <thead>
                                            <tr>
                                                <th width="30%">Appt. Detail</th>
                                                <th width="40%">Doctor</th>
                                                <th width="30%">Time</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div class="mCustomScrollbar mxh-400" style="overflow: hidden;" tabindex="5000">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td width="30%">
                                                        <h6>AHC098</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td width="40%">
                                                        <h6>Dr. Sambit Jain</h6>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td width="30%">
                                                        <h6> 01:00 PM</h6>
                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">
                                                        <h6>AHC098</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td width="40%">
                                                        <h6>Dr. Sambit Jain</h6>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td width="30%">
                                                        <h6> 01:00 PM</h6>

                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">
                                                        <h6>AHC098</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td width="40%">
                                                        <h6>Dr. Sambit Jain</h6>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td width="30%">
                                                        <h6> 01:00 PM</h6>
                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">
                                                        <h6>AHC098</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td width="40%">
                                                        <h6>Dr. Sambit Jain</h6>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td width="30%">
                                                        <h6> 01:00 PM</h6>

                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">
                                                        <h6>AHC098</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td width="40%">
                                                        <h6>Dr. Sambit Jain</h6>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td width="30%">
                                                        <h6> 01:00 PM</h6>

                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">
                                                        <h6>AHC098</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td width="40%">
                                                        <h6>Dr. Sambit Jain</h6>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td width="30%">
                                                        <h6> 01:00 PM</h6>
                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">
                                                        <h6>AHC098</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td width="40%">
                                                        <h6>Dr. Sambit Jain</h6>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td width="30%">
                                                        <h6> 01:00 PM</h6>
                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">
                                                        <h6>AHC098</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td width="40%">
                                                        <h6>Dr. Sambit Jain</h6>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td width="30%">
                                                        <h6> 01:00 PM</h6>
                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                                <!-- diagnostic -->
                            </article>
                        </div>
                    </aside>
                    <!-- end today appt -->
                    
                    <!--  start recent health package -->
                    <aside class="col-md-4 detailbox">
                        <div class="bg-white">
                            <figure class="clearfix">
                                <h3 class="pull-left">Recent Health Package Booking</h3>
                                <form class="search-form pull-right">
                                    <input type="" class="search pull-right" />
                                </form>
                            </figure>
                            
                            <table class="table table-hover table-striped m-0">
                                <thead>
                                    <tr>
                                        <th width="30%">Booking Details</th>
                                        <th width="40%">Packages</th>
                                        <th width="30%">Payment Status</th>
                                    </tr>
                                </thead>
                            </table>

                            <div class="mCustomScrollbar mxh-430" style="overflow: hidden;" tabindex="5000">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td width="30%">
                                                <h6>AHHP0986</h6>
                                                <p>Vipul Jain</p>
                                                <p>15/11/2015</p>
                                            </td>
                                            <td width="40%">
                                                <h6>Comprehensive</h6>
                                                <p>HPO111</p>
                                                <p>NR 500</p>
                                            </td>
                                            <td width="30%">
                                                <h6> Paid</h6>
                                                <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">
                                                <h6>AHHP0986</h6>
                                                <p>Vipul Jain</p>
                                                <p>15/11/2015</p>
                                            </td>
                                            <td width="40%">
                                                <h6>Comprehensive</h6>
                                                <p>HPO111</p>
                                                <p>NR 500</p>
                                            </td>
                                            <td width="30%">
                                                <h6> Paid</h6>
                                                <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">
                                                <h6>AHHP0986</h6>
                                                <p>Vipul Jain</p>
                                                <p>15/11/2015</p>
                                            </td>
                                            <td width="40%">
                                                <h6>Comprehensive</h6>
                                                <p>HPO111</p>
                                                <p>NR 500</p>
                                            </td>
                                            <td width="30%">
                                                <h6> Paid</h6>
                                                <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">
                                                <h6>AHHP0986</h6>
                                                <p>Vipul Jain</p>
                                                <p>15/11/2015</p>
                                            </td>
                                            <td width="40%">
                                                <h6>Comprehensive</h6>
                                                <p>HPO111</p>
                                                <p>NR 500</p>
                                            </td>
                                            <td width="30%">
                                                <h6> Paid</h6>
                                                <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">
                                                <h6>AHHP0986</h6>
                                                <p>Vipul Jain</p>
                                                <p>15/11/2015</p>
                                            </td>
                                            <td width="40%">
                                                <h6>Comprehensive</h6>
                                                <p>HPO111</p>
                                                <p>NR 500</p>
                                            </td>
                                            <td width="30%">
                                                <h6> Paid</h6>

                                                <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">
                                                <h6>AHHP0986</h6>
                                                <p>Vipul Jain</p>
                                                <p>15/11/2015</p>
                                            </td>
                                            <td width="40%">
                                                <h6>Comprehensive</h6>
                                                <p>HPO111</p>
                                                <p>NR 500</p>
                                            </td>
                                            <td width="30%">
                                                <h6> Paid</h6>
                                                <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">
                                                <h6>AHHP0986</h6>
                                                <p>Vipul Jain</p>
                                                <p>15/11/2015</p>
                                            </td>
                                            <td width="40%">
                                                <h6>Comprehensive</h6>
                                                <p>HPO111</p>
                                                <p>NR 500</p>
                                            </td>
                                            <td width="30%">
                                                <h6> Paid</h6>
                                                <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">
                                                <h6>AHHP0986</h6>
                                                <p>Vipul Jain</p>
                                                <p>15/11/2015</p>
                                            </td>
                                            <td width="40%">
                                                <h6>Comprehensive</h6>
                                                <p>HPO111</p>
                                                <p>NR 500</p>
                                            </td>
                                            <td width="30%">
                                                <h6> Paid</h6>

                                                <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">
                                                <h6>AHHP0986</h6>
                                                <p>Vipul Jain</p>
                                                <p>15/11/2015</p>
                                            </td>
                                            <td width="40%">
                                                <h6>Comprehensive</h6>
                                                <p>HPO111</p>
                                                <p>NR 500</p>
                                            </td>
                                            <td width="30%">
                                                <h6> Paid</h6>

                                                <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">
                                                <h6>AHHP0986</h6>
                                                <p>Vipul Jain</p>
                                                <p>15/11/2015</p>
                                            </td>
                                            <td width="40%">
                                                <h6>Comprehensive</h6>
                                                <p>HPO111</p>
                                                <p>NR 500</p>
                                            </td>
                                            <td width="30%">
                                                <h6> Paid</h6>

                                                <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>

                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </aside>
                    <!-- recent health package -->

                    <!--  start notification -->
                    <aside class="col-md-4 detailbox">
                        <div class="bg-white">
                            <figure class="clearfix">
                                <h3>Notifications</h3>
                            </figure>

                            <div class="mCustomScrollbar mxh-490" style="overflow: hidden;" tabindex="5000">
                                <aside class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td width="80%">
                                                    <p>You have received a quotation request for diagnostic booking. View details.</p>

                                                </td>
                                                <td width="20%">
                                                    <img src="assets/images/delete.png">

                                                </td>

                                            </tr>
                                            <tr>
                                                <td width="80%">
                                                    <p>You have received a quotation request for diagnostic booking. View details.</p>

                                                </td>
                                                <td width="20%">
                                                    <img src="assets/images/delete.png">

                                                </td>

                                            </tr>
                                            <tr>
                                                <td width="80%">
                                                    <p>You have received a quotation request for diagnostic booking. View details.</p>

                                                </td>
                                                <td width="20%">
                                                    <img src="assets/images/delete.png">

                                                </td>

                                            </tr>
                                            <tr>
                                                <td width="80%">
                                                    <p>You have received a quotation request for diagnostic booking. View details.</p>

                                                </td>
                                                <td width="20%">
                                                    <img src="assets/images/delete.png">

                                                </td>

                                            </tr>
                                            <tr>
                                                <td width="80%">
                                                    <p>You have received a quotation request for diagnostic booking. View details.</p>

                                                </td>
                                                <td width="20%">
                                                    <img src="assets/images/delete.png">

                                                </td>

                                            </tr>
                                            <tr>
                                                <td width="80%">
                                                    <p>You have received a quotation request for diagnostic booking. View details.</p>

                                                </td>
                                                <td width="20%">
                                                    <img src="assets/images/delete.png">

                                                </td>

                                            </tr>
                                            <tr>
                                                <td width="80%">
                                                    <p>You have received a quotation request for diagnostic booking. View details.</p>

                                                </td>
                                                <td width="20%">
                                                    <img src="assets/images/delete.png">

                                                </td>

                                            </tr>
                                            <tr>
                                                <td width="80%">
                                                    <p>You have received a quotation request for diagnostic booking. View details.</p>

                                                </td>
                                                <td width="20%">
                                                    <img src="assets/images/delete.png">

                                                </td>

                                            </tr>

                                            <tr>
                                                <td width="80%">
                                                    <p>You have received a quotation request for diagnostic booking. View details.</p>

                                                </td>
                                                <td width="20%">
                                                    <img src="assets/images/delete.png">

                                                </td>

                                            </tr>
                                            <tr>
                                                <td width="80%">
                                                    <p>You have received a quotation request for diagnostic booking. View details.</p>

                                                </td>
                                                <td width="20%">
                                                    <img src="assets/images/delete.png">

                                                </td>

                                            </tr>

                                        </tbody>
                                    </table>
                                </aside>
                            </div>

                        </div>
                    </aside>
                    <!-- end notification -->



                </section>
                <!-- end section -->



                <!-- section start -->
                <section class="clearfix m-t-30">



                    <!--  start quotation request -->
                    <aside class="col-md-4 detailbox">
                        <div class="bg-white">
                            <figure class="clearfix">
                                <h3>Quotation Requests</h3>
                                <form class="search-form pull-right">
                                    <input type="" class="search pull-right" />
                                </form>
                            </figure>

                            <table class="table table-hover table-striped m-0">
                                <thead>
                                    <tr>
                                        <th width="40%">QR Detail</th>
                                        <th width="60%">Diagnosis</th>
                                    </tr>
                                </thead>
                            </table>

                            <div class="mCustomScrollbar mxh-430" style="overflow: hidden;" tabindex="5000">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td width="40%">
                                                <h6>AHQT089</h6>
                                                <p>Vipul Jain</p>
                                                <p>15/11/2015</p>
                                            </td>
                                            <td>
                                                <h6>Blood Test-1</h6>
                                                <p>Vipul Jain</p>
                                            </td>
                                            <td>
                                                <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <h6>AHQT089</h6>
                                                <p>Vipul Jain</p>
                                                <p>15/11/2015</p>
                                            </td>
                                            <td>
                                                <h6>Blood Test-1</h6>
                                                <p>Vipul Jain</p>
                                            </td>
                                            <td>
                                                <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <h6>AHQT089</h6>
                                                <p>Vipul Jain</p>
                                                <p>15/11/2015</p>
                                            </td>
                                            <td>
                                                <h6>Blood Test-1</h6>
                                                <p>Vipul Jain</p>
                                            </td>
                                            <td>
                                                <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <h6>AHQT089</h6>
                                                <p>Vipul Jain</p>
                                                <p>15/11/2015</p>
                                            </td>
                                            <td>
                                                <h6>Blood Test-1</h6>
                                                <p>Vipul Jain</p>
                                            </td>
                                            <td>
                                                <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <h6>AHQT089</h6>
                                                <p>Vipul Jain</p>
                                                <p>15/11/2015</p>
                                            </td>
                                            <td>
                                                <h6>Blood Test-1</h6>
                                                <p>Vipul Jain</p>
                                            </td>
                                            <td>
                                                <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <h6>AHQT089</h6>
                                                <p>Vipul Jain</p>
                                                <p>15/11/2015</p>
                                            </td>
                                            <td>
                                                <h6>Blood Test-1</h6>
                                                <p>Vipul Jain</p>
                                            </td>
                                            <td>
                                                <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <h6>AHQT089</h6>
                                                <p>Vipul Jain</p>
                                                <p>15/11/2015</p>
                                            </td>
                                            <td>
                                                <h6>Blood Test-1</h6>
                                                <p>Vipul Jain</p>
                                            </td>
                                            <td>
                                                <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <h6>AHQT089</h6>
                                                <p>Vipul Jain</p>
                                                <p>15/11/2015</p>
                                            </td>
                                            <td>
                                                <h6>Blood Test-1</h6>
                                                <p>Vipul Jain</p>
                                            </td>
                                            <td>
                                                <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </aside>
                    <!-- end quotation request -->




                    <!--  start medicart -->
                    <aside class="col-md-4 detailbox">
                        <div class="bg-white">
                            <figure class="clearfix">
                                <h3>Medicart</h3>
                                <form class="search-form pull-right">
                                    <input type="" class="search pull-right" />
                                </form>
                            </figure>


                            <article class="text-center clearfix border-third">
                                <ul class="nav nav-tabs">
                                    <li class="active col-md-6 col-xs-6">
                                        <a data-toggle="tab" href="#booking-detail">Booking</a>
                                    </li>
                                    <li class="col-md-6 col-xs-6 b-left">
                                        <a data-toggle="tab" href="#enquiry">Enquiry</a>
                                    </li>
                                </ul>
                            </article>



                            <article class="tab-content h418">

                                <!-- booking -->
                                <section class="tab-pane in active" id="booking-detail">
                                    <table class="table table-hover table-striped m-0">
                                        <thead>
                                            <tr>
                                                <th width="40%">Booking Details</th>
                                                <th width="60%">Promotion</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div class="mCustomScrollbar mxh-382" style="overflow: hidden;" tabindex="5000">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td width="40%">
                                                        <h6>AHQT089</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>15/11/2015</p>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test-1</h6>
                                                        <p>Vipul Jain</p>
                                                    </td>
                                                    <td>
                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="40%">
                                                        <h6>AHQT089</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>15/11/2015</p>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test-1</h6>
                                                        <p>Vipul Jain</p>
                                                    </td>
                                                    <td>
                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="40%">
                                                        <h6>AHQT089</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>15/11/2015</p>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test-1</h6>
                                                        <p>Vipul Jain</p>
                                                    </td>
                                                    <td>
                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="40%">
                                                        <h6>AHQT089</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>15/11/2015</p>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test-1</h6>
                                                        <p>Vipul Jain</p>
                                                    </td>
                                                    <td>
                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="40%">
                                                        <h6>AHQT089</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>15/11/2015</p>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test-1</h6>
                                                        <p>Vipul Jain</p>
                                                    </td>
                                                    <td>
                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="40%">
                                                        <h6>AHQT089</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>15/11/2015</p>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test-1</h6>
                                                        <p>Vipul Jain</p>
                                                    </td>
                                                    <td>
                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="40%">
                                                        <h6>AHQT089</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>15/11/2015</p>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test-1</h6>
                                                        <p>Vipul Jain</p>
                                                    </td>
                                                    <td>
                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="40%">
                                                        <h6>AHQT089</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>15/11/2015</p>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test-1</h6>
                                                        <p>Vipul Jain</p>
                                                    </td>
                                                    <td>
                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                                <!-- booking -->




                                <!-- enquiry -->
                                <section class="tab-pane in" id="enquiry">
                                    <table class="table table-hover table-striped m-0">
                                        <thead>
                                            <tr>
                                                <th width="40%">Booking Details</th>
                                                <th width="60%">Promotion</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div class="mCustomScrollbar mxh-382" style="overflow: hidden;" tabindex="5000">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td width="40%">
                                                        <h6>AHQT089</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>15/11/2015</p>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test-1</h6>
                                                        <p>Vipul Jain</p>
                                                    </td>
                                                    <td>
                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="40%">
                                                        <h6>AHQT089</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>15/11/2015</p>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test-1</h6>
                                                        <p>Vipul Jain</p>
                                                    </td>
                                                    <td>
                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="40%">
                                                        <h6>AHQT089</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>15/11/2015</p>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test-1</h6>
                                                        <p>Vipul Jain</p>
                                                    </td>
                                                    <td>
                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="40%">
                                                        <h6>AHQT089</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>15/11/2015</p>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test-1</h6>
                                                        <p>Vipul Jain</p>
                                                    </td>
                                                    <td>
                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="40%">
                                                        <h6>AHQT089</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>15/11/2015</p>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test-1</h6>
                                                        <p>Vipul Jain</p>
                                                    </td>
                                                    <td>
                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="40%">
                                                        <h6>AHQT089</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>15/11/2015</p>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test-1</h6>
                                                        <p>Vipul Jain</p>
                                                    </td>
                                                    <td>
                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="40%">
                                                        <h6>AHQT089</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>15/11/2015</p>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test-1</h6>
                                                        <p>Vipul Jain</p>
                                                    </td>
                                                    <td>
                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                                <!-- enquiry -->
                            </article>


                        </div>
                    </aside>
                    <!-- end medicart -->




                    <!--  start Doctor Of The Month -->
                    <aside class="col-md-4 detailbox">
                        <div class="bg-white">
                            <figure class="clearfix">
                                <h3>Doctor Of The Month</h3>
                            </figure>

                            <p class="text-center"><img src="assets/images/users/avatar-1.jpg" class="img-responsive img-circle img-thumbnail m-t-20"></p>
                            <figcaption class="text-center">
                                <h3>Dr. Sambit Jain</h3>
                                <p>MBBS, MD</p>
                                <p>Cardiology</p>
                                <h3>Total Appointments:175</h3>
                            </figcaption>

                            <figcaption class="clearfix text-center text-black">
                                <aside class="col-md-4 col-xs-4">
                                    <div class="chart easy-pie-chart-1" data-percent="95">
                                        <span class="percent"></span>
                                    </div>
                                    <p>Conversion Rate</p>
                                </aside>
                                <aside class="col-md-4 col-xs-4">
                                    <div class="chart easy-pie-chart-2" data-percent="86">
                                        <span class="percent"></span>
                                    </div>
                                    <p>Booking Increment from Last Month</p>
                                </aside>
                                <aside class="col-md-4 col-xs-4">
                                    <div class="chart easy-pie-chart-3" data-percent="86">
                                        <span class="percent"></span>
                                    </div>
                                    <p>Conversion Increment</p>
                                </aside>
                            </figcaption>




                        </div>
                    </aside>
                    <!-- end Doctor Of The Month -->



                </section>
                <!-- end section -->



                <!-- start -->
                <section class="clearfix m-t-30">
                    <div class="col-lg-12">

                        <article class="clearfix chartbox">
                            <div class="bg-white">
                                <figure class="clearfix">
                                    <h3>Revenue Trend</h3>
                                </figure>
                                <figcaption>
                                    <h4 class=""><i class="md md-event"></i> 2015</h4>

                                    <canvas id="lineChart" data-type="Line" height="250"></canvas>
                                </figcaption>

                                <div class="clearfix">

                                    <aside class="col-md-6 col-sm-6">
                                        <div class="col-md-5">
                                            <div id="donut-chart" style="height:170px;"></div>
                                        </div>
                                        <div class="col-md-7 p-t-50">
                                            <ul class="num-label">
                                                <li><span></span> Diagnostic</li>
                                                <li><span class="bg-ong-red"></span>Health Package</li>
                                            </ul>
                                        </div>

                                    </aside>


                                    <aside class="col-md-6 col-sm-6">
                                        <canvas id="single-bar" data-type="Bar"></canvas>
                                    </aside>
                                </div>

                            </div>
                        </article>
                    </div>
                </section>
                <!-- end -->



                <!-- start -->
                <section class="clearfix m-t-30">
                    <article class="col-md-12 chartbox">
                        <div class="bg-white">
                            <figure class="clearfix">
                                <h3>Revenue Trend</h3>
                            </figure>
                            <figcaption>
                                <h4 class=""><i class="md md-event"></i> 2015</h4>
                                <!--                                    <div id="bar-chart"></div>-->
                                <canvas id="bar-chart" data-type="Bar" height="300"></canvas>
                            </figcaption>
                        </div>
                    </article>
                </section>
                <!-- end -->






                <!-- start -->
                <section class="clearfix m-t-30">

                    <article class="col-md-4 col-sm-4 chartbox">
                        <div class="bg-white">
                            <figure class="clearfix">
                                <h3>Booking Distribution</h3>
                            </figure>
                            <figcaption>
                                <h4 class=""><i class="md md-event"></i> 2015</h4>
                                <div id="chart_div"></div>
                            </figcaption>
                        </div>
                    </article>


                    <article class="col-md-4 col-sm-4 chartbox">
                        <div class="bg-white">
                            <figure class="clearfix">
                                <h3>Revenue Distribution</h3>
                            </figure>
                            <figcaption>
                                <h4 class=""><i class="md md-event"></i> 2015</h4>
                                <div id="chart_div_sec"></div>
                            </figcaption>
                        </div>
                    </article>


                    <article class="col-md-4 col-sm-4 chartbox">
                        <div class="bg-white">
                            <figure class="clearfix">
                                <h3>Medicart</h3>
                            </figure>
                            <figcaption>
                                <h4 class=""><i class="md md-event"></i> 2015</h4>
                                <div id="donut-example" style="height:200px"></div>
                            </figcaption>
                        </div>
                    </article>

                </section>
                <!-- end -->


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

<script src="assets/js/framework.js"></script>
<script src="assets/vendor/raphael/raphael-min.js"></script>
<script src="assets/vendor/morris.js/morris.min.js"></script>
<script src="assets/js/jsapi.js"></script>
<!-- Chart JS -->
<script src="assets/vendor/chart.js/chart.min.js"></script>
<!-- EASY PIE CHART JS -->
<script src="assets/vendor/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
<script src="assets/js/easy-pie-chart.init.js"></script>
<!-- Canvas Charts -->
<script src="assets/js/pages/dashboard.js"></script>
<!--  js-scroll -->
<script type="text/javascript" src="assets/vendor/js-scroll/script/scroll-2.js"></script>

</body>

</html>