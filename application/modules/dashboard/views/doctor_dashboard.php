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
    <link type="text/css" href="assets/vendor/js-scroll/style/scroll-2.css" rel="stylesheet" media="all" />

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
                <!-- Devider-->
                <div id="sidebar-menu">
                    <ul>
                        <li>
                            <a href="dashboard.html" class="waves-effect active"><i class="ion-ios7-keypad-outline"></i><span>Dashboard</span></a>
                        </li>

                        <li>
                            <a class="waves-effect" href="consultation.html"><i class="ion-ios7-albums-outline"></i>
                        <span>Appointments</span></a>

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
                            <a class="waves-effect" href="#"><i class="md md-account-circle"></i><span>Patient Mgment</span><span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="all-patient.html">All Patient</a></li>
                                <li><a href="add-new-patient.html">Add New Patient</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="review-management.html" class="waves-effect"><i class="fa fa-star-o"></i><span>Rate & Reviews</span></a>
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
                                <li><a href="#">Payment Transaction</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="sponser-healthtip.html" class="waves-effect"><i class="fa fa-medkit"></i><span>Sponsor Health Tips</span></a>

                        </li>
                        <li>
                            <a class="waves-effect" href="#"><i class="fa fa-cog"></i><span>Reporting</span></a>
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
                    <!--   start section 1 -->
                    <section class="clearfix">

                        <!--start total booking-->
                        <aside class=" col-sm-4 m-b-10">
                            <h4 class="r-box-title">Total Booking</h4>
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

                        <!--start total call received -->
                        <aside class=" col-sm-4 m-b-10">
                            <h4 class="y-box-title">Call Received</h4>
                            <article class="clearfix  y-box">
                                <figure class="col-md-4">
                                    <small>Overall Calls</small>
                                    <p>10.440</p>
                                </figure>
                                <figure class="col-md-4">
                                    <small>Avg Monthly</small>
                                    <p>380</p>
                                </figure>
                                <figure class="col-md-4">
                                    <small>Today's</small>
                                    <p>25</p>
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
                        <!--end total call received -->

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







                    <!-- section 2 start -->
                    <section class="clearfix m-t-30">

                        <!--  start today appointment -->
                        <aside class="col-md-8 detailbox">
                            <div class="bg-white">
                                <figure class="clearfix">
                                    <h3 class="pull-left">Today's Appointments</h3>
                                    <form class="search-form pull-right">
                                        <input type="" class="search pull-right" />
                                    </form>
                                </figure>

                                <div class="mCustomScrollbar mxh-450" style="overflow: hidden;" tabindex="5000">
                                    <aside class="table-responsive">
                                        <table class="table  doctor-db-table">
                                            <thead>
                                                <tr class="border-a-dull">
                                                    <th>Appt. Detail</th>
                                                    <th>Patient</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h6>AHC098</h6>
                                                        <p>01:00 PM</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jha</h6>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Pending</h6>

                                                    </td>
                                                    <td>
                                                        <h6>
                                                            <button class="btn btn-warning waves-effect waves-light m-b-5" type="button">View</button>
                                                            <button class="btn btn-success waves-effect waves-light m-b-5" type="button">Edit</button>
                                                    </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>AHC098</h6>
                                                        <p>01:00 PM</p>
                                                    </td>
                                                    <td>
                                                        <h6>Rohan Bhargav</h6>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Pending</h6>

                                                    </td>
                                                    <td>
                                                        <h6>
                                                    <button class="btn btn-warning waves-effect waves-light m-b-5" type="button">View</button>
                                                    <button class="btn btn-success waves-effect waves-light m-b-5" type="button">Edit</button>
                                               </h6></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>AHC098</h6>
                                                        <p>01:00 PM</p>
                                                    </td>
                                                    <td>
                                                        <h6>Rohan Bhargav</h6>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Pending</h6>

                                                    </td>
                                                    <td>
                                                        <h6>
                                                    <button class="btn btn-warning waves-effect waves-light m-b-5" type="button">View</button>
                                                    <button class="btn btn-success waves-effect waves-light m-b-5" type="button">Edit</button>
                                               </h6></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>AHC098</h6>
                                                        <p>01:00 PM</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jha</h6>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Pending</h6>

                                                    </td>
                                                    <td>
                                                        <h6>
                                                    <button class="btn btn-warning waves-effect waves-light m-b-5" type="button">View</button>
                                                    <button class="btn btn-success waves-effect waves-light m-b-5" type="button">Edit</button>
                                               </h6> </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>AHC098</h6>
                                                        <p>01:00 PM</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jha</h6>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Pending</h6>

                                                    </td>
                                                    <td>
                                                        <h6>
                                                    <button class="btn btn-warning waves-effect waves-light m-b-5" type="button">View</button>
                                                    <button class="btn btn-success waves-effect waves-light m-b-5" type="button">Edit</button>
                                                    </h6> </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>AHC098</h6>
                                                        <p>01:00 PM</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jha</h6>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Pending</h6>

                                                    </td>
                                                    <td>
                                                        <h6>
                                                    <button class="btn btn-warning waves-effect waves-light m-b-5" type="button">View</button>
                                                    <button class="btn btn-success waves-effect waves-light m-b-5" type="button">Edit</button>
                                                    </h6></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>AHC098</h6>
                                                        <p>01:00 PM</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jha</h6>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Pending</h6>

                                                    </td>
                                                    <td>
                                                        <h6>
                                                    <button class="btn btn-warning waves-effect waves-light m-b-5" type="button">View</button>
                                                    <button class="btn btn-success waves-effect waves-light m-b-5" type="button">Edit</button>
                                                    </h6></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>AHC098</h6>
                                                        <p>01:00 PM</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jha</h6>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Pending</h6>

                                                    </td>
                                                    <td>
                                                        <h6>
                                                    <button class="btn btn-warning waves-effect waves-light m-b-5" type="button">View</button>
                                                    <button class="btn btn-success waves-effect waves-light m-b-5" type="button">Edit</button>
                                                    </h6> </td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </aside>
                                </div>

                            </div>
                        </aside>
                        <!-- end today appointment -->

                        <!--Top 5 Doctors -->
                        <aside class="col-md-4 detailbox">
                            <div class="bg-white">
                                <article class="clearfix">
                                    <figure class="clearfix">
                                        <h3>Top 5 Doctors of Month</h3>
                                    </figure>
                                    <div class="mCustomScrollbar mxh-450" style="overflow: hidden;" tabindex="5000">
                                        <aside class="table-responsive">
                                            <table class="table rating-table top-doctor">
                                                <tr>
                                                    <td>
                                                        <h6><img src="assets/images/doctor.png" alt="" class="img-responsive" /></h6>
                                                    </td>
                                                    <td>
                                                        <h6>Alpesh Dhakad</h6>
                                                        <p>ACH089</p>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td class="text-right">
                                                        <h6>122</h6>
                                                        <p>Appointments</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6><img src="assets/images/doctor4.png" alt="" class="img-responsive" /></h6>
                                                    </td>
                                                    <td>
                                                        <h6>Alpesh Dhakad</h6>
                                                        <p>ACH089</p>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td class="text-right">
                                                        <h6>122</h6>
                                                        <p>Appointments</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6><img src="assets/images/doctor.png" alt="" class="img-responsive" /></h6>
                                                    </td>
                                                    <td>
                                                        <h6>Alpesh Dhakad</h6>
                                                        <p>ACH089</p>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td class="text-right">
                                                        <h6>122</h6>
                                                        <p>Appointments</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6><img src="assets/images/doctor4.png" alt="" class="img-responsive" /></h6>
                                                    </td>
                                                    <td>
                                                        <h6>Alpesh Dhakad</h6>
                                                        <p>ACH089</p>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td class="text-right">
                                                        <h6>122</h6>
                                                        <p>Appointments</p>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <h6><img src="assets/images/doctor4.png" alt="" class="img-responsive" /></h6>
                                                    </td>
                                                    <td>
                                                        <h6>Alpesh Dhakad</h6>
                                                        <p>ACH089</p>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td class="text-right">
                                                        <h6>122</h6>
                                                        <p>Appointments</p>
                                                    </td>
                                                </tr>

                                            </table>
                                        </aside>
                                    </div>
                                </article>
                            </div>
                        </aside>
                        <!--Top 5 Doctors -->

                    </section>
                    <!-- end section 2 -->





                    <!-- section 3 start -->
                    <section class="clearfix m-t-30">

                        <!--  start today appointment -->
                        <aside class="col-md-8 detailbox">
                            <div class="bg-white">
                                <figure class="clearfix">
                                    <h3 class="pull-left">Pending Appointment Requests</h3>
                                    <form class="search-form pull-right">
                                        <input type="" class="search pull-right" />
                                    </form>
                                </figure>


                                <div class="mCustomScrollbar mxh-450" style="overflow: hidden;" tabindex="5000">
                                    <aside class="table-responsive">
                                        <table class="table  doctor-db-table">
                                            <thead>
                                                <tr class="border-a-dull">
                                                    <th>Appt. Detail</th>
                                                    <th>Patient</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h6>AHC098</h6>
                                                        <p>17-Dec 2015</p>
                                                        <p>01:00 PM</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jha</h6>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Pending</h6>

                                                    </td>
                                                    <td>
                                                        <h6>
                                                    <button class="btn btn-warning waves-effect waves-light m-b-5" type="button">View</button>
                                                    <button class="btn btn-success waves-effect waves-light m-b-5" type="button">Edit</button>
                                                    </h6></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>AHC098</h6>
                                                        <p>17-Dec 2015</p>
                                                        <p>01:00 PM</p>
                                                    </td>
                                                    <td>
                                                        <h6>Rohan Bhargav</h6>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Pending</h6>

                                                    </td>
                                                    <td>
                                                        <h6>
                                                    <button class="btn btn-warning waves-effect waves-light m-b-5" type="button">View</button>
                                                    <button class="btn btn-success waves-effect waves-light m-b-5" type="button">Edit</button>
                                                    </h6></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>AHC098</h6>
                                                        <p>17-Dec 2015</p>
                                                        <p>01:00 PM</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jha</h6>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Pending</h6>

                                                    </td>
                                                    <td>
                                                        <h6>
                                                        <button class="btn btn-warning waves-effect waves-light m-b-5" type="button">View</button>
                                                    <button class="btn btn-success waves-effect waves-light m-b-5" type="button">Edit</button>
                                                    </h6></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>AHC098</h6>
                                                        <p>17-Dec 2015</p>
                                                        <p>01:00 PM</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jha</h6>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Pending</h6>

                                                    </td>
                                                    <td>
                                                        <h6>
                                                    <button class="btn btn-warning waves-effect waves-light m-b-5" type="button">View</button>
                                                    <button class="btn btn-success waves-effect waves-light m-b-5" type="button">Edit</button>
                                                    </h6> </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>AHC098</h6>
                                                        <p>17-Dec 2015</p>
                                                        <p>01:00 PM</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jha</h6>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Pending</h6>

                                                    </td>
                                                    <td>
                                                        <h6>
                                                    <button class="btn btn-warning waves-effect waves-light m-b-5" type="button">View</button>
                                                    <button class="btn btn-success waves-effect waves-light m-b-5" type="button">Edit</button>
                                                    </h6> </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>AHC098</h6>
                                                        <p>17-Dec 2015</p>
                                                        <p>01:00 PM</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jha</h6>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Pending</h6>

                                                    </td>
                                                    <td>
                                                        <h6>
                                                    <button class="btn btn-warning waves-effect waves-light m-b-5" type="button">View</button>
                                                    <button class="btn btn-success waves-effect waves-light m-b-5" type="button">Edit</button>
                                                    </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>AHC098</h6>
                                                        <p>17-Dec 2015</p>
                                                        <p>01:00 PM</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jha</h6>
                                                        <p>Male | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Pending</h6>

                                                    </td>
                                                    <td>
                                                        <h6>
                                                    <button class="btn btn-warning waves-effect waves-light m-b-5" type="button">View</button>
                                                    <button class="btn btn-success waves-effect waves-light m-b-5" type="button">Edit</button>
                                                    </h6>
                                                    </td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </aside>
                                </div>

                            </div>
                        </aside>
                        <!-- end today appointment -->

                        <!--  start medicart -->
                        <aside class="col-md-4 detailbox">
                            <div class="bg-white">
                                <figure class="clearfix">
                                    <h3 class="pull-left">Medicart</h3>
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



                                <article class="tab-content">

                                    <!-- booking -->
                                    <section class="tab-pane fade in active" id="booking-detail">
                                        <table class="table table-hover table-striped m-0">
                                            <thead>
                                                <tr>
                                                    <th width="40%">Booking Details</th>
                                                    <th width="60%">Promotion</th>
                                                </tr>
                                            </thead>
                                        </table>
                                        <div class="mCustomScrollbar mxh-366" style="overflow: hidden;" tabindex="5000">
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
                                    <section class="tab-pane fade in" id="enquiry">
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


                    </section>
                    <!-- end section 2 -->



                    <!-- start -->
                    <section class="clearfix m-t-30">
                        <article class="col-md-12 chartbox">
                            <div class="bg-white">
                                <figure class="clearfix">
                                    <h3>Revenue Trend</h3>
                                </figure>
                                <figcaption>
                                    <h4 class=""><i class="md md-event"></i> 2015</h4>
                                    <canvas id="lineChart" data-type="Line" height="250"></canvas>
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
    <script src="assets/js/framework.js">
    </script>
    <!-- Chart JS -->
    <script src="assets/vendor/chart.js/chart.min.js"></script>
    <!-- Canvas Charts -->
    <script src="assets/js/pages/dashboard.js">
    </script>
    <!--  js-scroll -->
    <script type="text/javascript" src="assets/vendor/js-scroll/script/scroll-2.js">
    </script>

</body>

</html>