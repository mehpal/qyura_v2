
        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container row">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">User Management</h3>
                             <a href="all-user.html" class="btn btn-appointment btn-back waves-effect waves-light pull-right"><i class="fa fa-angle-left"></i> Back</a>

                        </div>
                    </div>

                    <!-- Left Section Start -->
                    <section class="col-md-12 detailbox">


                        <div class="bg-white">
                            <!-- Table Section Start -->
                            <article class="clearfix">
                                <section class="col-md-12">
                                    <article class="col-md-12 m-t-20 p-b-20 doctor-profile">
                                        <aside class="col-md-2 col-sm-2 col-xs-6 p-0">
                                            <img src="<?php echo base_url().'assets/usersImage/thumb/thumb_100/'.$users_detail->patientDetails_patientImg; ?>" alt="" class="img-responsive doctor-pic" />
                                        </aside>
                                        <aside class="col-md-5 col-sm-5 col-xs-12">
                                            <h3><?php if(isset($users_detail->patientDetails_patientName) && !empty($users_detail->patientDetails_patientName)){
                                                echo $users_detail->patientDetails_patientName;
                                            }?></h3>
                                            <p><?php if(isset($users_detail->patientDetails_gender) && !empty($users_detail->patientDetails_gender)){
                                                if($users_detail->patientDetails_gender == 1){
                                                    echo "Male";
                                                }
                                                 elseif($users_detail->patientDetails_gender == 2){
                                                    echo "Female";
                                                }else{
                                                    echo "Other" ;
                                                }
                                            }?></p>
                                            <p><?php if(isset($users_detail->patientDetails_address) && !empty($users_detail->patientDetails_address)){
                                                echo $users_detail->patientDetails_address;
                                            }?></p>
                                        </aside>
                                        <aside class="col-md-5 col-sm-5 col-xs-12 text-right">
                                            <h6><a href="">200 Ratings Given</a> &nbsp; <span class="label label-success waves-effect waves-light m-b-5 center-block">5.0</span></h6>
                                            <h6><a href="#">12 Reviews Given</a> &nbsp; <i class="fa fa-commenting clg"></i></h6>
                                            <h6><button class="btn btn-appointment waves-effect waves-light m-t-10" type="button">Edit Detail</button></h6>
                                        </aside>
                                    </article>


                                    <article class="text-center clearfix m-t-50">
                                        <ul class="nav nav-tab nav-doctor">
                                            <li class="active">
                                                <a data-toggle="tab" href="#activities">Activities</a>
                                            </li>
                                            <li class=" ">
                                                <a data-toggle="tab" href="#consulting">Consulting Appointment</a>
                                            </li>
                                            <li class=" ">
                                                <a data-toggle="tab" href="#diagnostic">Diagnostic Appointment</a>
                                            </li>
                                            <li class=" ">
                                                <a data-toggle="tab" href="#healthcare">Healthcare Package</a>
                                            </li>
                                            <li class=" ">
                                                <a data-toggle="tab" href="#reports">Reports</a>
                                            </li>

                                        </ul>
                                    </article>
                                    
<!--                                    table for user consultant-->
  <div class="bg-white">
                            <!-- Table Section Start -->
                            <article class="clearfix m-top-40 p-b-20">
                                <aside class="table-responsive">
                                <table class="table all-bloodbank" id="consultingList">
                                    <thead>
                                        <tr class="border-a-dull">
<!--                                            <th>Appt Id</th>-->
                                            <th>Date & Time</th>
                                             <th>MI Name</th>
<!--                                            <th>Doctor</th>
                                            <th>Patient</th>-->
                                            <th>Appointment Status</th>
                                            <th>Action</th>
                                        </tr>
                                                                          
                                       
                        </thead>
                        </table>
                                    </aside>


                        </article>
                </div>

 <!--table for user diagnostic-->
 <div class="bg-white">
                            <!-- Table Section Start -->
                            <article class="clearfix m-top-40 p-b-20">
                                <aside class="table-responsive">
                                <table class="table all-bloodbank" id="diagnosticList">
                                    <thead>
                                        <tr class="border-a-dull">
                                            <th>Appt Id</th>
                                            <th>Date & Time</th>
                                             <th>MI Name</th>
                                            <th>Diagnostic</th>
                                            <th>Patient</th>
                                            <th>Appointment Status</th>
                                            <th>Action</th>
                                        </tr>
                                                                          
                                       
                        </thead>
                        </table>
                                    </aside>


                        </article>
                </div>
 
<!--table for user healthcare package-->
 <div class="bg-white">
                            <!-- Table Section Start -->
                            <article class="clearfix m-top-40 p-b-20">
                                <aside class="table-responsive">
                                <table class="table all-bloodbank" id="diagnosticList">
                                    <thead>
                                        <tr class="border-a-dull">
                                            <th>Booking Id</th>
                                            <th>MI Name</th>
                                             <th>Package</th>
                                            <th>Booking Date & Time</th>
                                            <th>Payment Amount</th>
                                            <th>Action</th>
                                        </tr>
                                                                          
                                       
                        </thead>
                        </table>
                                    </aside>


                        </article>
                </div>

<!--table for user report-->
 <div class="bg-white">
                            <!-- Table Section Start -->
                            <article class="clearfix m-top-40 p-b-20">
                                <aside class="table-responsive">
                                <table class="table all-bloodbank" id="diagnosticList">
                                    <thead>
                                        <tr class="border-a-dull">
                                            <th>Booking Id</th>
                                            <th>MI Name</th>
                                             <th>Package</th>
                                            <th>Booking Date & Time</th>
                                            <th>Payment Amount</th>
                                            <th>Action</th>
                                        </tr>
                                                                          
                                       
                        </thead>
                        </table>
                                    </aside>


                        </article>
                </div>
                       <!--fdsfsadgfdsgd-->
                                    <article class="tab-content m-t-50">

                                        <!-- Activities Starts -->
                                        <section class="tab-pane fade in active" id="activities">
                                            <h3 class="page-title">About :</h3>
                                            <aside class="table-responsive">
                                            <table class="table patient-activity">
                                                <tr>
                                                    <td>
                                                        <h6><i class="fa fa-square fa-2x"></i></h6>
                                                    </td>
                                                    <td>
                                                        <h6>Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been the industry's standard dummy.</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>
                                                </tr <tr>
                                                <td>
                                                    <h6><i class="fa fa-square fa-2x"></i></h6>
                                                </td>
                                                <td>
                                                    <h6>Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been the industry's standard dummy.</h6>
                                                </td>
                                                <td>
                                                    <h6>September 17, 2015</h6>
                                                    <p>12:30 PM</p>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6><i class="fa fa-square fa-2x"></i></h6>
                                                    </td>
                                                    <td>
                                                        <h6>Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been the industry's standard dummy.</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6><i class="fa fa-square fa-2x"></i></h6>
                                                    </td>
                                                    <td>
                                                        <h6>Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been the industry's standard dummy.</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>
                                                </tr>
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
                                        </section>
                                        <!-- Activities Ends -->

                                        <!-- consulting Starts -->
                                        <section class="tab-pane fade in" id="consulting11">
                                             <aside class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th>Appt Id</th>
                                                    <th>Date & Time</th>
                                                    <th>MI Name</th>
                                                    <th>Doctor</th>
                                                    <th>Patient</th>
                                                    <th>Appointment Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>
                                                     <td>
                                                        <h6>Leelawati Hospital</h6>
                                                        <p>Mumbai</p>
                                                    </td>
                                                    <td>
                                                        <h6>Dr. Sambit Jain</h6>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td>
                                                        <h6>Self</h6>
                                                    </td>
                                                    <td>
                                                        <h6>Confirm</h6>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-success waves-effect waves-light m-t-10" type="button">View</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>
                                                     <td>
                                                        <h6>Leelawati Hospital</h6>
                                                        <p>Mumbai</p>
                                                    </td>
                                                    <td>
                                                        <h6>Dr. Sambit Jain</h6>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td>
                                                        <h6>Self</h6>
                                                    </td>
                                                    <td>
                                                        <h6>Confirm</h6>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-success waves-effect waves-light m-t-10" type="button">View</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>
                                                     <td>
                                                        <h6>Leelawati Hospital</h6>
                                                        <p>Mumbai</p>
                                                    </td>
                            
                                                    <td>
                                                        <h6>Dr. Sambit Jain</h6>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td>
                                                        <h6>Self</h6>
                                                    </td>
                                                    <td>
                                                        <h6>Confirm</h6>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-success waves-effect waves-light m-t-10" type="button">View</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>
                                                     <td>
                                                        <h6>Leelawati Hospital</h6>
                                                        <p>Mumbai</p>
                                                    </td>
                                                    <td>
                                                        <h6>Dr. Sambit Jain</h6>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td>
                                                        <h6>Self</h6>
                                                    </td>
                                                    <td>
                                                        <h6>Confirm</h6>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-success waves-effect waves-light m-t-10" type="button">View</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>
                                                     <td>
                                                        <h6>Leelawati Hospital</h6>
                                                        <p>Mumbai</p>
                                                    </td>
                                                    <td>
                                                        <h6>Dr. Sambit Jain</h6>
                                                        <p>Cardiology</p>
                                                    </td>
                                                    <td>
                                                        <h6>Self</h6>
                                                    </td>
                                                    <td>
                                                        <h6>Confirm</h6>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-success waves-effect waves-light m-t-10" type="button">View</button>
                                                    </td>
                                                </tr>
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
                                        </section>
                                        <!-- Consultion Ends -->

                                        <!-- Diagnostic Starts -->
                                        <section class="tab-pane fade in" id="diagnostic11">
                                             <aside class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th>Appt Id</th>
                                                    <th>Date & Time</th>
                                                    <th>MI Name</th>
                                                    <th>Diagnostic</th>
                                                    <th>Patient</th>
                                                    <th>Appointment Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>
                                                     <td>
                                                        <h6>Medanta The Medcity</h6>
                                                        <p>Gurgaon</p>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test-1</h6>
                                                        <p>Blood Test</p>
                                                    </td>
                                                    <td>
                                                        <h6>Self</h6>
                                                    </td>
                                                    <td>
                                                        <h6>Confirm</h6>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-success waves-effect waves-light m-t-10" type="button">View</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>
                                                     <td>
                                                        <h6>Leelawati Hospital</h6>
                                                        <p>Mumbai</p>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test-1</h6>
                                                        <p>Blood Test</p>
                                                    </td>
                                                    <td>
                                                        <h6>Self</h6>
                                                    </td>
                                                    <td>
                                                        <h6>Confirm</h6>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-success waves-effect waves-light m-t-10" type="button">View</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>
                                                     <td>
                                                        <h6>Leelawati Hospital</h6>
                                                        <p>Mumbai</p>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test-1</h6>
                                                        <p>Blood Test</p>
                                                    </td>
                                                    <td>
                                                        <h6>Self</h6>
                                                    </td>
                                                    <td>
                                                        <h6>Confirm</h6>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-success waves-effect waves-light m-t-10" type="button">View</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>
                                                     <td>
                                                        <h6>Leelawati Hospital</h6>
                                                        <p>Mumbai</p>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test-1</h6>
                                                        <p>Blood Test</p>
                                                    </td>
                                                    <td>
                                                        <h6>Self</h6>
                                                    </td>
                                                    <td>
                                                        <h6>Confirm</h6>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-success waves-effect waves-light m-t-10" type="button">View</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>
                                                     <td>
                                                        <h6>Leelawati Hospital</h6>
                                                        <p>Mumbai</p>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test-1</h6>
                                                        <p>Blood Test</p>
                                                    </td>
                                                    <td>
                                                        <h6>Self</h6>
                                                    </td>
                                                    <td>
                                                        <h6>Confirm</h6>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-success waves-effect waves-light m-t-10" type="button">View</button>
                                                    </td>
                                                </tr>
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
                                        </section>
                                        <!-- Diagnostic Ends -->


                                        <!-- healthcare Starts -->
                                        <section class="tab-pane fade in" id="healthcare11">
                                             <aside class="table-responsive">
                                            <table class="table patient-health-package-table">
                                                <tr>
                                                    <th>Booking Id</th>
                                                    <th>MI Name</th>
                                                    <th>Package</th>
                                                    <th>Booking Date & Time</th>
                                                    <th>Payment Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                     <td>
                                                        <h6>Leelawati Hospital</h6>
                                                        <p>Mumbai</p>
                                                    </td>
                                                    <td>
                                                        <h6>Package Title here package title here</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>
                                                    <td>
                                                        <h6><i class="fa fa-inr"></i> 7500.00</h6></td>
                                                    <td>
                                                        <button class="btn btn-success waves-effect waves-light m-t-10" type="button">View Detail</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                     <td>
                                                        <h6>Leelawati Hospital</h6>
                                                        <p>Mumbai</p>
                                                    </td>
                                                    <td>
                                                        <h6>Package Title here package title here</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>
                                                    <td>
                                                        <h6><i class="fa fa-inr"></i> 7500.00</h6></td>
                                                    <td>
                                                        <button class="btn btn-success waves-effect waves-light m-t-10" type="button">View Detail</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                     <td>
                                                        <h6>Leelawati Hospital</h6>
                                                        <p>Mumbai</p>
                                                    </td>
                                                    <td>
                                                        <h6>Package Title here package title here</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>
                                                    <td>
                                                        <h6><i class="fa fa-inr"></i> 7500.00</h6></td>
                                                    <td>
                                                        <button class="btn btn-success waves-effect waves-light m-t-10" type="button">View Detail</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                     <td>
                                                        <h6>Leelawati Hospital</h6>
                                                        <p>Mumbai</p>
                                                    </td>
                                                    <td>
                                                        <h6>Package Title here package title here</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>
                                                    <td>
                                                        <h6><i class="fa fa-inr"></i> 7500.00</h6></td>
                                                    <td>
                                                        <button class="btn btn-success waves-effect waves-light m-t-10" type="button">View Detail</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                     <td>
                                                        <h6>Leelawati Hospital</h6>
                                                        <p>Mumbai</p>
                                                    </td>
                                                    <td>
                                                        <h6>Package Title here package title here</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>
                                                    <td>
                                                        <h6><i class="fa fa-inr"></i> 7500.00</h6></td>
                                                    <td>
                                                        <button class="btn btn-success waves-effect waves-light m-t-10" type="button">View Detail</button>
                                                    </td>
                                                </tr>
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
                                        </section>
                                        <!-- Healthcare Ends -->


                                        <!-- Reports Starts -->
                                        <section class="tab-pane fade in" id="reports11">
                                             <aside class="table-responsive">
                                            <table class="table doctor-table">
                                                <tr>
                                                    <th>Report Id</th>
                                                    <th>Report Title</th>
                                                    <th>Ref. Appt Id</th>
                                                    <th>Upload Date & Time</th>
                                                    <th>Action</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test Report</h6>
                                                    </td>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>

                                                    <td>
                                                        <button class="btn btn-success waves-effect waves-light m-t-10" type="button">View Report</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test Report</h6>
                                                    </td>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>

                                                    <td>
                                                        <button class="btn btn-success waves-effect waves-light m-t-10" type="button">View Report</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test Report</h6>
                                                    </td>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>

                                                    <td>
                                                        <button class="btn btn-success waves-effect waves-light m-t-10" type="button">View Report</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test Report</h6>
                                                    </td>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>

                                                    <td>
                                                        <button class="btn btn-success waves-effect waves-light m-t-10" type="button">View Report</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test Report</h6>
                                                    </td>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>

                                                    <td>
                                                        <button class="btn btn-success waves-effect waves-light m-t-10" type="button">View Report</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                    <td>
                                                        <h6>Blood Test Report</h6>
                                                    </td>
                                                    <td>
                                                        <h6>ACH089</h6>
                                                    </td>
                                                    <td>
                                                        <h6>September 17, 2015</h6>
                                                        <p>12:30 PM</p>
                                                    </td>

                                                    <td>
                                                        <button class="btn btn-success waves-effect waves-light m-t-10" type="button">View Report</button>
                                                    </td>
                                                </tr>
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
                                        </section>
                                        <!-- Reports Ends -->



                                </section>
                                </aside>
                                </article>


                        </div>

                    </section>
                    <!-- Left Section End -->

                </div>

                <!-- container -->
            </div>
            <!-- content -->
           
        </div>
        <!-- End Right content here -->
    </div>
    <!-- END wrapper -->
    <script>
        var resizefunc = [];
    </script>

  
    <script src="assets/js/framework.js">
    </script>
    
</body>

</html>