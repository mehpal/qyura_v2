<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container row">
            <div class="clearfix">
                <div class="col-md-12">
                    <h3 class="pull-left page-title">Doctor Management</h3>
                    <a href="all-doctor.html" class="btn btn-appointment btn-back waves-effect waves-light pull-right"><i class="fa fa-angle-left"></i> Back</a>
                </div>
            </div>
            <!-- Left Section Start -->
            <div class="col-md-12 bg-white">
                <section class="clearfix detailbox">
                    <!-- Table Section Start -->
                    <article class="clearfix m-t-20 p-b-20 doctor-profile">
                        <aside class="col-md-2 col-sm-2 col-xs-6 p-0">
                            <?php if (!empty($doctorDetail[0]->doctors_img)) { ?>
                                <img src="<?php echo base_url() ?>assets/doctorsImages/thumb/thumb_150/<?php echo $doctorDetail[0]->doctors_img; ?>" alt="" class="img-responsive doctor-pic" />
                            <?php } else { ?>
                                <img src="<?php echo base_url() ?>assets/images/noImage.png" alt="" class="logo-img" />
                            <?php } ?>
                        </aside>
                        <aside class="col-md-5 col-sm-5 col-xs-12">
                            <h3>Dr. <?php echo $doctorDetail[0]->doctoesName; ?></h3>
                            <p><?php echo $doctorAcademic[0]->degreeSmallName; ?></p>
                            <p><?php echo $doctorAcademic[0]->degreeFullName; ?></p>
                            <p><?php echo $years; ?> Years Experience</p>
                            <p><?php echo $doctorDetail[0]->speciality; ?></p>
                        </aside>
                        <aside class="col-md-5 col-sm-5 col-xs-12 text-right t-xs-left">
                            <h6><a href="">200 Ratings</a> &nbsp; <span class="label label-success waves-effect waves-light m-b-5 center-block">5.0</span></h6>
                            <h6><a href="#">12 Reviews</a> &nbsp; <i class="fa fa-commenting clg"></i></h6>
                            <h6>Doctor on Call &nbsp; <i class="fa fa-phone clg"></i></h6>
                            <h6><button class="btn btn-appointment waves-effect waves-light" type="button">View Detail</button></h6>
                        </aside>
                    </article>
                    <article class="text-center clearfix m-t-50">
                        <ul class="nav nav-tab nav-doctor">
                            <li class="active">
                                <a data-toggle="tab" href="#general">General Detail</a>
                            </li>
                            <li class=" ">
                                <a data-toggle="tab" href="#academic">Academic Detail</a>
                            </li>
                            <li class=" ">
                                <a data-toggle="tab" href="#experience">Experience</a>
                            </li>
                            <li class=" ">
                                <a data-toggle="tab" href="#award">Award & Recognition</a>
                            </li>
                            <li class=" ">
                                <a data-toggle="tab" href="#appointment">Appointment History</a>
                            </li>
                            <li class=" ">
                                <a data-toggle="tab" href="#timeslot">Time Slot</a>
                            </li>
                            <li class=" ">
                                <a data-toggle="tab" href="#account">Account</a>
                            </li>
                        </ul>
                    </article>
                    
                    <article class="tab-content p-b-20 m-t-50">
                        <div class="alert alert-success" id="successTop" style="display: none"></div>
                        <div class="alert alert-danger" id="er_TopError" style="display: none"></div>
                        <!-- General Detail Starts -->
                        <section class="tab-pane fade in active" id="general">
                            <h3 class="page-title">About :</h3>
                            <p class="text-justified">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of </p>
                            <p>Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
                            <section class="detailbox">
                                <div class="mi-form-section">
                                    <!-- Table Section End -->
                                    <div class="m-t-20 setting doctor-description">
                                        <article class="clearfix">
                                            <aside class="col-sm-8">
                                                <h4>Doctor Detail 
                                                    <a href="javascript:void(0)" id="edit" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                                                </h4>
                                                <hr/>
                                            </aside>
                                        </article>
                                        <section id="detail" style="display:  <?php echo $detailShow; ?>;">    
                                            <article class="form-group m-lr-0">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Doctor Id :</label>
                                                <p class="col-md-8 col-sm-8"><?php echo $doctorDetail[0]->doctors_unqId; ?></p>
                                            </article>
                                            <article class="form-group m-lr-0 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Date of Joining :</label>
                                                <p class="col-md-8 col-sm-8"><?php echo date('F j Y', $doctorDetail[0]->creationTime); ?></p>
                                            </article>
                                            <article class="form-group m-lr-0 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Date of Birth :</label>
                                                <p class="col-md-8"><?php echo date('F j Y', $doctorDetail[0]->doctors_dob); ?></p>
                                            </article>
                                            <article class="form-group m-lr-0 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Email Id:</label>
                                                <p class="col-md-8 col-sm-8"><?php echo $doctorDetail[0]->users_email; ?></p>
                                            </article>
                                            <article class="form-group m-lr-0 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Landline Phone :</label>
                                                <?php
                                                $explode = explode('|', $doctorDetail[0]->doctors_phn);
                                                for ($i = 0; $i < count($explode); $i++) {
                                                    if ($explode[$i] != '')
                                                        ?>
                                                    <p class="col-md-8 col-sm-8">+<?php echo $explode[$i]; ?></p>

                                                <?php } ?>
                                            </article>

                                            <article class="form-group m-lr-0 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Mobile :</label>
                                                <?php
                                                $explode2 = explode('|', $doctorDetail[0]->doctors_mobile);
                                                for ($i = 0; $i < count($explode2); $i++) {
                                                    $againexplode = explode('*', $explode2[$i]);
                                                    ?>
                                                    <p class="col-md-8 col-sm-8">+<?php echo $againexplode[0]; ?></p>

                                                <?php } ?>
                                            </article>

                                            <article class="form-group m-lr-0 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Address :</label>
                                                <p class="col-md-8 col-sm-8"><?php echo $doctorDetail[0]->doctor_addr; ?></p>
                                            </article>

                                        </section>

                                        <section id="newDetail" style="display:<?php echo $showStatus; ?>;">
                                            <!--edit-->
                                            <form name="doctorDetail" action="<?php echo site_url("doctor/saveDetailDoctor/$"); ?>" id="doctorDetail" method="post">
                                                <input type="hidden" id="StateId" name="StateId" value="<?php echo $doctorDetail[0]->doctors_stateId; ?>" />
                                                <input type="hidden" id="countryId" name="countryId" value="<?php echo $doctorDetail[0]->doctors_countryId; ?>" />
                                                <input type="hidden" id="cityId" name="cityId" value="<?php echo $doctorDetail[0]->doctors_cityId; ?>" />


                                                <article class="clearfix m-t-10">
                                                    <label for="" class="control-label col-md-3 col-sm-4">First Name :</label>
                                                    <div class="col-md-4 col-sm-5">
                                                        <input class="form-control" id="doctors_fName" type="text" name="doctors_fName" value="<?php echo (set_value('doctors_fName')) ? set_value('doctors_fName') : $doctorDetail[0]->doctors_fName; ?>">
                                                        <label class="error" style="display:none;" id="error-doctors_fName"> Please enter doctor's First name</label>
                                                        <label class="error" > <?php echo form_error("doctors_fName"); ?></label>
                                                    </div>
                                                </article>



                                                <article class="clearfix m-t-10">
                                                    <label for="" class="control-label col-md-3 col-sm-4">Last Name :</label>
                                                    <div class="col-md-4 col-sm-5">
                                                        <input class="form-control" id="doctors_lName" type="text" name="doctors_lName" value="<?php echo (set_value('doctors_lName')) ? set_value('doctors_lName') : $doctorDetail[0]->doctors_lName; ?>" />
                                                        <label class="error" style="display:none;" id="error-doctors_lName"> Please enter doctor's Last name</label>
                                                        <label class="error" > <?php echo form_error("doctors_lName"); ?></label>
                                                    </div>
                                                </article>

                                                <article class="clearfix m-t-10">
                                                    <label for="" class="control-label col-md-3 col-sm-4">Date of Birth :</label>
                                                    <div class="col-md-4 col-sm-5">
                                                        <div class="input-group">
                                                            <input class="form-control timepickerclock" placeholder="dd/mm/yyyy" id="doctors_dob" type="text" name="doctors_dob" value="<?php echo (set_value('doctors_dob')) ? set_value('doctors_dob') : $doctorDetail[0]->doctors_dob; ?>">
                                                            <!--<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>-->
                                                            <label class="error" style="display:none;" id="error-doctors_dob"> Please enter doctor's DOB</label>
                                                            <label class="error" > <?php echo form_error("doctors_dob"); ?></label>

                                                        </div>
                                                    </div>
                                                </article>

                                                <article class="clearfix m-t-10">
                                                    <label for="cname" class="control-label col-md-3 col-sm-4">Date of Joining :</label>
                                                    <div class="col-md-4 col-sm-5">
                                                        <div class="input-group">
                                                            <input class="form-control timepickerclock" placeholder="dd/mm/yyyy" id="doctors_creationTime" type="text" readonly="" name="creationTime" value="<?php echo date('d/m/Y', $doctorDetail[0]->creationTime); ?>">
                                                            <!--<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>-->
                                                        </div>
                                                    </div>
                                                </article>



                                                <article class="clearfix m-t-10">
                                                    <label class="control-label col-md-3 col-sm-4">Email :</label>
                                                    <div class="col-md-4 col-sm-5">
                                                        <input class="form-control" id="users_email" name="users_email" placeholder="abc@gmail.com" readonly="" value="<?php echo $doctorDetail[0]->users_email; ?>" onblur="checkEmailFormat()"/>
                                                        <label class="error" style="display:none;" id="error-users_email"> please enter Email id Properly</label>
                                                        <!--<label class="error" style="display:none;" id="error-users_email_check"> Email Already Exists!</label>-->
                                                        <label class="error" > <?php echo form_error("users_email"); ?></label>
                                                        <input type="hidden" class="form-control" id="users_email_status" name="users_email_status" value="" />
                                                    </div>
                                                </article>
                                                <article class="clearfix m-t-10">
                                                    <label class="control-label col-md-3 col-sm-4">Landline :</label>
                                                    <div class="col-md-4 col-sm-5">
                                                        <input class="form-control" id="doctorId" name="doctorId" required="" value="+917315000555">
                                                    </div>
                                                </article>

                                                <article class="clearfix m-t-10">
                                                    <label class="control-label col-md-3 col-sm-4">Mobile:</label>
                                                    <div class="col-md-4 col-sm-5">
                                                        <input class="form-control" id="doctorId" name="doctorId" required="" value="">
                                                    </div>
                                                </article>
                                                <article class="clearfix m-t-10">
                                                    <label class="control-label col-md-3 col-sm-4">Address :</label>
                                                    <div class="col-md-4 col-sm-5">
                                                        <input type="text" id="geocomplete" class="form-control" id="doctorId" name="doctorId" value="<?php echo $doctorDetail[0]->doctor_addr; ?>" required="">
                                                    </div>
                                                </article>

                                            </form>

                                    </div>
                                </div>
                            </section>
                        </section>
                        <!-- General Detail Ends -->

                        <!-- Academic Detail Starts -->
                        <section class="tab-pane fade in" id="academic">
                            <div class="clearfix m-t-20 doctor-description">
                                <aside class="col-md-6 col-sm-6">
                                    <article class="clerfix m-t-20">
                                        <!-- <h6>MBBS</h6>
                                        <p>ABC Medical College, New-Delhi</p>
                                        <p>2015</p>
                                    </article> -->
                                        <?php
                                        $details = explode(',', $doctorAcademic[0]->degreeSmallName);
                                        $detailsFull = explode(',', $doctorAcademic[0]->degreeFullName);
                                        for ($i = 0; $i < count($details); $i++) {
                                            ?>
                                            <article class="clearfix m-t-20">
                                                <h6><?php echo $details[$i]; ?></h6>
                                                <p><?php echo $detailsFull[$i]; ?></p>

                                            </article>
                                        <?php } ?>
                                </aside>
                                <!--<aside class="col-md-6 col-sm-6">
                                    <article class="clearfix m-t-20">
                                        <h6>CRMS</h6>
                                        <p>ABC Medical College, New-Delhi</p>
                                        <p>2016</p>
                                    </article>
                                    <article class="clearfix m-t-20">
                                        <h6>CSRT</h6>
                                        <p>ABC Medical College, New-Delhi</p>
                                        <p>2016</p>
                                    </article>
                                </aside>-->
                            </div>
                        </section>
                        <!-- Academic Detail Ends -->

                        <!-- Experience Starts -->
                        <section class="tab-pane fade in" id="experience">
                            <div class="clearfix m-t-20 doctor-description">
                                <aside class="col-md-6 col-sm-6">
                                    <?php
                                    $explodeStartTime = explode(',', $doctorDetail[0]->startTime);
                                    $explodeEndTime = explode(',', $doctorDetail[0]->endTime);
                                    $explodeHospital = explode(',', $doctorDetail[0]->hospitalName);

                                    for ($i = 0; $i < count($explodeStartTime); $i++) {
                                        ?> 

                                        <article class="clerfix m-t-20">
                                            <h6><?php echo date('M-Y', $explodeStartTime[$i]); ?> - <?php echo date('M-Y', $explodeEndTime[$i]); ?></h6>
                                            <p><?php echo $explodeHospital[$i]; ?></p>

                                            <?php
                                            foreach ($exprerience as $key) {
                                                if ($key->professionalExp_start == $explodeStartTime[$i]) {
                                                    ?>
                                                    <label class="label doctor-label label-specialist"><?php echo $key->specialities_name; ?></label>
                                                    <?php
                                                }
                                            }
                                            ?>

                                                                                   <!-- <p>
                                                                                        <label class="label doctor-label label-specialist">Cardiology</label>
                                                                                        <label class="label doctor-label label-specialist">ENT</label>
                                                                                    </p>-->
                                        </article>
                                    <?php } ?>
                                    <!-- <article class="clerfix m-t-20">
                                        <h6>Oct 1987 - Jan 1995</h6>
                                        <p>ABC Medical College, New-Delhi</p>
                                        <p>Junior Surgeon, Department-Head</p>
                                        <p>
                                            <label class="label doctor-label label-specialist">Cardiology</label>
                                            <label class="label doctor-label label-specialist">ENT</label>
                                        </p>
                                    </article>
                                   <article class="clerfix m-t-20">
                                        <h6>Oct 1987 - Jan 1995</h6>
                                        <p>ABC Medical College, New-Delhi</p>
                                        <p>Junior Surgeon, Department-Head</p>
                                        <p>
                                            <label class="label doctor-label label-specialist">Cardiology</label>
                                            <label class="label doctor-label label-specialist">ENT</label>
                                        </p>
                                    </article>-->

                                </aside>
                                <!--<aside class="col-md-6 col-sm-6">
                                    <article class="clerfix m-t-20">
                                        <h6>Oct 1987 - Jan 1995</h6>
                                        <p>ABC Medical College, New-Delhi</p>
                                        <p>Junior Surgeon, Department-Head</p>
                                        <p>
                                            <label class="label doctor-label label-specialist">Cardiology</label>
                                            <label class="label doctor-label label-specialist">ENT</label>
                                        </p>
                                    </article>
                                    <article class="clerfix m-t-20">
                                        <h6>Oct 1987 - Jan 1995</h6>
                                        <p>ABC Medical College, New-Delhi</p>
                                        <p>Junior Surgeon, Department-Head</p>
                                        <p>
                                            <label class="label doctor-label label-specialist">Cardiology</label>
                                            <label class="label doctor-label label-specialist">ENT</label>
                                        </p>
                                    </article>
                                </aside> -->
                            </div>
                        </section>
                        <!-- Experience Ends -->

                        <!-- Awards Starts -->
                        <section class="tab-pane fade in" id="award">
                            <div class="doctor-description lh-25">
                                <article class="clearfix m-t-20">
                                    <aside class="col-md-6 col-sm-8">
                                        <h6>Certificate Holder of World Osteoporosis, Councle for bone Densteometry and Osteoporosis Hongcong</h6>
                                        <p>2001</p>
                                    </aside>
                                    <aside class="col-md-6 col-sm-4">
                                        <img src="assets/images/certificate.jpg" class="pull-right" />
                                    </aside>
                                </article>
                                <article class="clearfix m-t-20">
                                    <aside class="col-md-6 col-sm-8">
                                        <h6>Certificate Holder of World Osteoporosis, Councle for bone Densteometry and Osteoporosis Hongcong</h6>
                                        <p>2001</p>
                                    </aside>
                                    <aside class="col-md-6 col-sm-4">
                                        <img src="assets/images/certificate.jpg" class="pull-right" />
                                    </aside>
                                </article>
                                <article class="clearfix m-t-20">
                                    <aside class="col-md-6 col-sm-8">
                                        <h6>Certificate Holder of World Osteoporosis, Councle for bone Densteometry and Osteoporosis Hongcong</h6>
                                        <p>2001</p>
                                    </aside>
                                    <aside class="col-md-6 col-sm-4">
                                        <img src="assets/images/certificate.jpg" class="pull-right" />
                                    </aside>
                                </article>
                                <article class="clearfix m-t-20">
                                    <aside class="col-md-6 col-sm-8">
                                        <h6>Certificate Holder of World Osteoporosis, Councle for bone Densteometry and Osteoporosis Hongcong</h6>
                                        <p>2001</p>
                                    </aside>
                                    <aside class="col-md-6 col-sm-4">
                                        <img src="assets/images/certificate.jpg" class="pull-right" />
                                    </aside>
                                </article>
                            </div>
                        </section>
                        <!-- Awards Ends -->

                        <!-- Appointment History Starts -->
                        <section class="tab-pane fade in" id="appointment">
                            <aside class="table-responsive">
                                <table class="table doctor-table">
                                    <tr>
                                        <th>Appt Id</th>
                                        <th>Date & Time</th>
                                        <th>Patient</th>
                                        <th>Appointment Status</th>
                                        <th>Rating Received</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>ACH089</h6></td>
                                        <td>
                                            <h6>September 17, 2015</h6>
                                            <p>12:30 PM</p>
                                        </td>
                                        <td>
                                            <h6>Vipul Jain</h6>
                                            <p>Male | 45 Years</p>
                                        </td>
                                        <td>
                                            <h6>Completed</h6>
                                        </td>
                                        <td>
                                            <h6><span class="label label-success waves-effect waves-light m-b-5 center-block">5.0</span></h6>
                                            <h6><i class="fa fa-commenting clg"></i></h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>ACH089</h6></td>
                                        <td>
                                            <h6>September 17, 2015</h6>
                                            <p>12:30 PM</p>
                                        </td>
                                        <td>
                                            <h6>Vipul Jain</h6>
                                            <p>Male | 45 Years</p>
                                        </td>
                                        <td>
                                            <h6>Completed</h6>
                                        </td>
                                        <td>
                                            <h6><span class="label label-success waves-effect waves-light m-b-5 center-block">5.0</span></h6>
                                            <h6><i class="fa fa-commenting clg"></i></h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>ACH089</h6></td>
                                        <td>
                                            <h6>September 17, 2015</h6>
                                            <p>12:30 PM</p>
                                        </td>
                                        <td>
                                            <h6>Vipul Jain</h6>
                                            <p>Male | 45 Years</p>
                                        </td>
                                        <td>
                                            <h6>Completed</h6>
                                        </td>
                                        <td>
                                            <h6><span class="label label-success waves-effect waves-light m-b-5 center-block">5.0</span></h6>
                                            <h6><i class="fa fa-commenting clg"></i></h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>ACH089</h6></td>
                                        <td>
                                            <h6>September 17, 2015</h6>
                                            <p>12:30 PM</p>
                                        </td>
                                        <td>
                                            <h6>Vipul Jain</h6>
                                            <p>Male | 45 Years</p>
                                        </td>
                                        <td>
                                            <h6>Completed</h6>
                                        </td>
                                        <td>
                                            <h6><span class="label label-success waves-effect waves-light m-b-5 center-block">5.0</span></h6>
                                            <h6><i class="fa fa-commenting clg"></i></h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>ACH089</h6></td>
                                        <td>
                                            <h6>September 17, 2015</h6>
                                            <p>12:30 PM</p>
                                        </td>
                                        <td>
                                            <h6>Vipul Jain</h6>
                                            <p>Male | 45 Years</p>
                                        </td>
                                        <td>
                                            <h6>Completed</h6>
                                        </td>
                                        <td>
                                            <h6><span class="label label-success waves-effect waves-light m-b-5 center-block">5.0</span></h6>
                                            <h6><i class="fa fa-commenting clg"></i></h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>ACH089</h6></td>
                                        <td>
                                            <h6>September 17, 2015</h6>
                                            <p>12:30 PM</p>
                                        </td>
                                        <td>
                                            <h6>Vipul Jain</h6>
                                            <p>Male | 45 Years</p>
                                        </td>
                                        <td>
                                            <h6>Completed</h6>
                                        </td>
                                        <td>
                                            <h6><span class="label label-success waves-effect waves-light m-b-5 center-block">5.0</span></h6>
                                            <h6><i class="fa fa-commenting clg"></i></h6>
                                        </td>
                                    </tr>
                                </table>
                            </aside>
                        </section>
                        
                        <!-- Appointment History Starts -->
                        <!-- Account Detail Starts -->
                        <section class="tab-pane fade in" id="account">
                            <div class="clearfix m-t-20 p-b-20 doctor-description">
                                <article class="clearfix m-b-10">
                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Registered Email Id :</label>
                                    <p class="col-md-8 col-sm-8">abs@example.com</p>
                                </article>
                                <article class="clearfix m-b-10">
                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Registered Mobile Number:</label>
                                    <p class="col-md-8 col-sm-8">+91 8077224467</p>
                                </article>
                                <article class="clearfix m-b-10">
                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Change Password:</label>

                                    <aside class="col-md-5 col-sm-5">
                                        <form class="">
                                            <input type="password" name="password" class="form-control" placeholder="New Password" />
                                        </form>
                                    </aside>
                                </article>
                            </div>
                        </section>
                        <!-- Account Detail Ends -->

                        <!-- Timeslot Starts Section -->
                        <section class="tab-pane fade in" id="timeslot">

                            <div class="bg-white mi-form-section">
                                <!-- Top Detailed Section -->
                                <!-- Time Scedule Start here-->
                                <div class="clearfix m-t-20 text-center time-span">
                                    <section class="col-md-1 col-sm-1">
                                        <h6 class="text-left">Days</h6>
                                    </section>
                                    <div class="col-md-11">
                                        <section class="col-md-3 col-sm-3">
                                            <h6 class="col-sm-12 col-xs-6">Morning Session</h6>
                                            <h6 class="col-sm-12 col-xs-6">06:00 AM-11:59 AM</h6>
                                        </section>
                                        <section class="col-md-3 col-sm-3">
                                            <h6 class="col-sm-12 col-xs-6">Afternoon Session</h6>
                                            <h6 class="col-sm-12 col-xs-6">12:00 PM-05:59 PM</h6>
                                        </section>
                                        <section class="col-md-3 col-sm-3">
                                            <h6 class="col-sm-12 col-xs-6">Evening Session</h6>
                                            <h6 class="col-sm-12 col-xs-6">06:00 PM-10:59 PM</h6>
                                        </section>  
                                        <section class="col-md-3 col-sm-3">
                                            <h6 class="col-sm-12 col-xs-6">Night Session</h6>
                                            <h6 class="col-sm-12 col-xs-6">11:00 PM-05:59 AM</h6>
                                        </section>
                                    </div>
                                </div>
                                <div class="row col-md-12" style="display: none"><span class="alert alert-success" id="successTop"></span></div>
                                <div class="row col-md-12" style="display: none"><span class="alert alert-danger" id="er_TopError"></span></div>
                                
                                <form id="setData" name="setData" method="post" action="#" >
                                    <?php 
                                    $weekIndexs = array(0, 1, 2, 3, 4, 5, 6); ?>
                                    <input type="hidden" name="doctorId" value="<?php echo $doctorDetail[0]->doctors_id; ?>" />
                                    <input type="hidden" name="doctors_userId" value="<?php echo $doctorDetail[0]->doctors_userId; ?>" />
                                    <input type="hidden" name="doctors_refferalId" value="<?php echo (isset($this->input->get_post['reffralId']) && $this->input->get_post['reffralId']) != "" ? : $doctorDetail[0]->doctors_userId ;  ?>" />
                        <?php
//                                    dump($doctorAvailability);
                                    
                                    foreach ($weekIndexs as $index) {
                                    
                                        if (in_array($index, $doctorAvailability->weekIndexs)) {  ?>
                                            <div class="clearfix m-t-20 text-center">
                                               
                                                <section class="col-md-1 col-sm-1">
                                                    <aside class="checkbox checkbox-success text-left">
                                                        <?php
                                                         
                                                        $availabilityStatus = (isset($doctorAvailability->doctorAvailabilitys[$index]->availabilityStatus)) ? $doctorAvailability->doctorAvailabilitys[$index]->availabilityStatus : '';
                                                        ?>
                                                        <input class="daycheck" name="day[]" value="<?php echo $index; ?>" <?php echo ($availabilityStatus) ? 'checked' : ''; ?>  type="checkbox" id="checkbox3">
                                                        <label for="checkbox3">
                                                            <?php echo convertNumberToDay($index); ?>
                                                        </label>
                                                    </aside>
                                                </section>
                                                <div class="col-md-11">
                                                    <?php
//                                                     dump($timeSlots);
                                                    for ($i = 0; $i < 4; $i++) {

                                                        if (isset($doctorAvailability->session[$i])) {

                                                        }


                                                        if (isset($doctorAvailability->doctorAvailabilitys[$index]->session[$i]->SessionStart)) {
                                                            $startTime = $doctorAvailability->doctorAvailabilitys[$index]->session[$i]->SessionStart;
                                                            $endTime = $doctorAvailability->doctorAvailabilitys[$index]->session[$i]->SessionEnd;
                                                            ?>
                                                            <section class="col-md-3 col-sm-3">
                                                                <article class="clearfix">
                                                                    <aside class="col-md-6 col-sm-12 col-xs-6 schdule-space">
                                                                        <div class="bootstrap-timepicker input-group">
                                                                            <input type="text" onblur="removeError(this)"  id="err_<?php echo $index; ?>_session_<?php echo $i; ?>_st" name="<?php echo $index; ?>_session_<?php echo $i; ?>_st" value="<?php echo date("g:i a", strtotime($startTime)); ?>" class="form-control timepickerclock" >
                                                                        </div>
                                                                    </aside>
                                                                    <aside class="col-md-6 col-sm-12 col-xs-6 schdule-space">
                                                                        <div class="bootstrap-timepicker input-group timepicker">
                                                                            <input type="text" name="<?php echo $index; ?>_session_<?php echo $i; ?>_ed" value="<?php echo date("g:i a", strtotime($endTime)); ?>" class="form-control timepickerclock" onblur="removeError(this)"  id="err_<?php echo $index; ?>_session_<?php echo $i; ?>_ed" value="<?php echo date("g:i a", strtotime($endTime)); ?>">
                                                                        </div>
                                                                    </aside>
                                                                </article>
                                                            </section>

                                                        <?php } else { ?>
                                                            <section class="col-md-3 col-sm-3">
                                                                <article class="clearfix">
                                                                    <aside class="col-md-6 col-sm-12 col-xs-6 schdule-space">
                                                                        <div class="bootstrap-timepicker input-group text-info timepicker">
                                                                            <input type="text" value="" class="form-control timepickerclock " onblur="removeError(this)"  id="err_<?php echo $index; ?>_session_<?php echo $i; ?>_st" name="<?php echo $index; ?>_session_<?php echo $i; ?>_st" >
                                                                        </div>
                                                                    </aside>
                                                                    <aside class="col-md-6 col-sm-12 col-xs-6 schdule-space">
                                                                        <div class="bootstrap-timepicker input-group border-bottom timepicker">
                                                                            <input type="text" value="" class="form-control timepickerclock " onblur="removeError(this)"  id="err_<?php echo $index; ?>_session_<?php echo $i; ?>_ed" name="<?php echo $index; ?>_session_<?php echo $i; ?>_ed" >
                                                                        </div>
                                                                    </aside>
                                                                </article>
                                                            </section>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
    </div><hr/>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="clearfix m-t-20 text-center">
                                                <section class="col-md-1 col-sm-1">
                                                    <aside class="checkbox checkbox-success text-left">
                                                        <input class="daycheck" name="day[]" value="<?php echo $index; ?>" type="checkbox" id="checkbox3">
                                                        <label for="checkbox3">
        <?php echo convertNumberToDay($index); ?>
                                                        </label>
                                                    </aside>
                                                </section>
                                                <div class="col-md-11">
        <?php for ($i = 0; $i < 4; $i++) { ?>
                                                        <section class="col-md-3 col-sm-3">
                                                            <article class="clearfix">
                                                                <aside class="col-md-6 col-sm-12 col-xs-6 schdule-space">
                                                                    <div class="bootstrap-timepicker input-group timepicker">
                                                                        <input type="text" value="" class="form-control timepickerclock" onblur="removeError(this)"  id="err_<?php echo $index; ?>_session_<?php echo $i; ?>_st" name="<?php echo $index; ?>_session_<?php echo $i; ?>_st" >
                                                                        <!--<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>-->
                                                                    </div>
                                                                </aside>
                                                                <aside class="col-md-6 col-sm-12 col-xs-6 schdule-space">
                                                                    <div class="bootstrap-timepicker input-group timepicker">
                                                                        <input type="text" value="" class="form-control timepickerclock" onblur="removeError(this)"  id="err_<?php echo $index; ?>_session_<?php echo $i; ?>_ed" name="<?php echo $index; ?>_session_<?php echo $i; ?>_ed" >
                                                                        <!--<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>-->
                                                                    </div>
                                                                </aside>
                                                            </article>
                                                        </section>
        <?php } ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>


                                    <hr class="hr-scedule">


                                    <!--Time Schedule Ends-->
                                    <section class="clearfix ">
                                        <div class="col-md-12 m-t-20 m-b-20 text-right">
                                            <button type="button" class="btn btn-danger waves-effect ">Reset</button>
                                            <button type="submit" class="btn btn-success waves-effect waves-light  m-r-20">Submit</button>
                                        </div>

                                    </section>
                                </form>   
                            </div>


                        </section>

                    </article>


                </section>
            </div>

            <!-- Left Section End -->

        </div>

        <!-- container -->
    </div>
    <!-- content -->


