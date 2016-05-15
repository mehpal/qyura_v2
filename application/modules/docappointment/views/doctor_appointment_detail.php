<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="clearfix">
                <div class="col-md-12">
                    <h3 class="pull-left page-title">Doctor Appointment Detail</h3>
                    <a href="<?php echo site_url("docappointment") ?>" class="btn btn-appointment btn-back waves-effect waves-light pull-right"><i class="fa fa-angle-left"></i> Back</a>
                </div>
            </div>

            <!-- Main Div Start -->
            <section class="clearfix detailbox">

                <div class="bg-white">
                    <!-- Table Section Start -->
                    <?php if (isset($doctorAppointmentDetails) && $doctorAppointmentDetails != NULL){
                        foreach($doctorAppointmentDetails as $doctorAppointment);
                    } ?>
                    <!-- Top Section Start -->
                    <article class="clearfix p-t-20 appt-detail">
                        <aside class="col-md-6 col-sm-6">
                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Appointment Id :</label>
                                <p class="col-md-8"><?php echo $doctorAppointment->doctorAppointment_unqId; ?></p>
                            </div>
                            
                            <div class="clearfix m-t-10">
                                <label class="col-md-4">HMS Id :</label>
                                <p class="col-md-8"><?php if($doctorAppointment->doctorAppointment_HMSId != ''){ echo $doctorAppointment->doctorAppointment_HMSId; } ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Appointment Date:</label>
                                <p class="col-md-8"><?php echo date("d-m-Y" ,$doctorAppointment->doctorAppointment_date); ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Session :</label>
                                <p class="col-md-8">
                                    <?php echo date("H:i", strtotime($doctorAppointment->docTimeDay_open)). " - " .date("H:i", strtotime($doctorAppointment->docTimeDay_close)); ?>
                                </p>
                            </div>


                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Final Time :</label>
                                <p class="col-md-8"> <?php echo date("g:i a" ,$doctorAppointment->doctorAppointment_finalTiming); ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Status:</label>
                                <p class="col-md-8"><?php if($doctorAppointment->doctorAppointment_status == 11){ echo "Pending"; }elseif($doctorAppointment->doctorAppointment_status == 12){ echo "Confirm"; }elseif($doctorAppointment->doctorAppointment_status == 13){ echo "Cancel"; }elseif($doctorAppointment->doctorAppointment_status == 14){ echo "Completed"; } ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Patient Remarks :</label>
                                <p class="col-md-8"><?php echo $doctorAppointment->doctorAppointment_ptRmk ?></p>
                            </div>

                        </aside>
                        <aside class="col-md-6 col-sm-6">
                            <div class="clearfix m-t-20">
                                <article class="col-md-2 p-0 pull-right m-r-20">
                                    <img src="<?php echo base_url("assets/patientImages")."/".$doctorAppointment->patientDetails_patientImg ?>" alt="" class="img-responsive patient-pic" width="60" height="60">
                                </article>
                                <article class="col-md-5 text-right pull-right">
                                    <h3><?php echo $doctorAppointment->patientDetails_patientName ?></h3>
                                    <p><?php if($doctorAppointment->patientDetails_gender == 1){ echo "Male"; }elseif($doctorAppointment->patientDetails_gender == 2){ echo "Female"; }else{ echo "Other"; } ?> | <?php echo date_diff(date_create('1988/06/16'), date_create('today'))->y; ?></p>
                                    <p><?php echo $doctorAppointment->patientDetails_mobileNo ?></p>
                                </article>
                            </div>

                            <div class="clearfix m-t-20">
                                <article class="col-md-2 p-0 pull-right m-r-20">
                                    <img src="<?php echo base_url("assets/doctorsImages")."/".$doctorAppointment->doctors_img ?>" alt="" class="img-responsive patient-pic" width="60" height="60">
                                </article>
                                <article class="col-md-5 text-right pull-right">
                                    <h3>Dr. <?php if(isset($doctorAppointment->doctors_fName) && $doctorAppointment->doctors_fName != ''){ echo ucfirst($doctorAppointment->doctors_fName); }echo " "; if(isset($doctorAppointment->doctors_lName) && $doctorAppointment->doctors_lName != ''){ echo ucfirst($doctorAppointment->doctors_lName); } ?></h3>
                                    <p><?php echo $doctorAppointment->specialities_name; ?></p>
                                    <p><?php echo $doctorAppointment->doctors_mobile; ?></p>
                                </article>
                            </div>

                        </aside>
                    </article>


                    <!-- Top Secton Ends-->
                    <hr class="hr-appt-detail" />

                    <!-- Bottom Section Start -->
                    <article class="clearfix m-r-20 p-b-20">
                        <aside class="col-md-12">
                            <div class="clearfix m-t-20">
                                <h5 class="h5-title col-md-12">Patient Address :</h5>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Address :</label>
                                <p class="col-md-8 col-sm-8"><?php echo $doctorAppointment->patientDetails_address; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">City :</label>
                                <p class="col-md-8 col-sm-8"><?php echo $doctorAppointment->city_name; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Zip Code:</label>
                                <p class="col-md-8 col-sm-8"><?php echo $doctorAppointment->patientDetails_pin; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">State :</label>
                                <p class="col-md-8 col-sm-8"><?php echo $doctorAppointment->state_statename; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Country :</label>
                                <p class="col-md-8 col-sm-8"><?php echo $doctorAppointment->country; ?></p>
                            </div>

                            <div class="clearfix m-t-20">
                                <h5 class="h5-title col-md-12">Payment Detail :</h5>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Consultation Fee :</label>
                                <p class="col-md-8 col-sm-8"><i class="fa fa-inr"></i> <?php echo $doctorAppointment->doctorAppointment_consulationFee; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Other Fee :</label>
                                <p class="col-md-8 col-sm-8"><i class="fa fa-inr"></i> <?php echo $doctorAppointment->doctorAppointment_otherFee; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Tax :</label>
                                <p class="col-md-8 col-sm-8"><?php echo $doctorAppointment->doctorAppointment_tax; ?>%</p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Total Payble Amount :</label>
                                <p class="col-md-8 col-sm-8"><i class="fa fa-inr"> </i> <b><?php echo $doctorAppointment->doctorAppointment_totPayAmount; ?></b></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Payment Status :</label>
                                <p class="col-md-8 col-sm-8"><?php if($doctorAppointment->doctorAppointment_payStatus == 16){ echo "Paid"; }if($doctorAppointment->doctorAppointment_payStatus == 15){ echo "Unpaid"; } ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Payment Mode :</label>
                                <p class="col-md-8 col-sm-8"><?php if($doctorAppointment->doctorAppointment_payMode == 17){ echo "Cash"; }else{ echo "other"; } ?></p>
                            </div>

                        </aside>

                    </article>


                    <!-- Bottom Secton Ends-->
                </div>
            </section>

            <!-- container -->
        </div>
        <!-- content -->
    </div>
    <!-- End Right content here -->
</div>
