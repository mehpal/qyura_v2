
<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container row">
            <div class="clearfix">
                <div class="col-md-12">
                    <h3 class="pull-left page-title">Diagnostic Appointment Detail</h3>
                    <a href="all-appointment.html" class="btn btn-appointment btn-back waves-effect waves-light pull-right"><i class="fa fa-angle-left"></i> Back</a>

                </div>
            </div>

            <!-- Main Div Start -->
            <section class="clearfix detailbox">


                <div class="bg-white">
                    <!-- Table Section Start -->

                    <!-- Top Section Start -->
                    <article class="clearfix p-t-20 appt-detail">
                        <aside class="col-md-6 col-sm-6">
                            <div class="clearfix m-t-10">
                                <label class="col-md-4">MI Name :</label>
                                <p class="col-md-8"><?php echo isset($conDetail->MIname) ? $conDetail->MIname : ''; ?></p>
                            </div>
                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Appointment Id :</label>
                                <p class="col-md-8"><?php echo isset($conDetail->orderId) ? $conDetail->orderId : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4">HMS Id :</label>
                                <p class="col-md-8"><?php echo isset($conDetail->hmsId) ? $conDetail->hmsId : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Appointment Date :</label>
                                <p class="col-md-8"><?php echo isset($conDetail->dateTime) ? date('M d,Y', $conDetail->dateTime) : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Session :</label>
                                <p class="col-md-8"><?php
                                    if (isset($conDetail->sessionType)) {
                                        
                                            switch ($conDetail->sessionType) {
                                                case 0:
                                                    $session = "Morning";
                                                    break;
                                                case 1:
                                                    $session = "Afternoon";
                                                    break;
                                                case 2:
                                                    $session = "Evening";
                                                    break;
                                                case 3:
                                                    $session = "Night";
                                                    break;
                                                default:
                                                    $session = "Session is not aloated";
                                            }
                                            echo $session . " | " . $conDetail->startTime . " - " . $conDetail->endTime;
                                    }
                                    ?></p>

                            </div>


                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Final Time :</label>
                                <p class="col-md-8"><?php echo isset($conDetail->dateTime) ? date('h:i A', $conDetail->dateTime) : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Status:</label>
                                <p class="col-md-8">
                                    <?php
                                    if (isset($conDetail->bookingStatus)) {
                                        switch ($conDetail->bookingStatus) {
                                            case 0:
                                                $bookStatus = "Pending";
                                                break;
                                            case 1:
                                                $bookStatus = "Confirmed";
                                                break;
                                            case 2:
                                                $bookStatus = "Completed";
                                                break;
                                            case 3:
                                                $bookStatus = "Cancel";
                                                break;
                                            default:
                                                $bookStatus = "Pending";
                                        }
                                        echo $bookStatus;
                                    }
                                    ?>
                                </p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Patient Remarks :</label>
                                <p class="col-md-8"><?php echo isset($conDetail->remarks)?$conDetail->remarks:''; ?></p>
                            </div>

                            


                        </aside>
                        <aside class="col-md-6 col-sm-6">
                            <div class="clearfix m-t-20">
                                <article class="col-md-2 p-0 pull-right m-r-20">
                                    <?php
                                        $path = FCPATH . BS_PROF_PATH;
                                        if (file_exists(realpath($path) . '/' . $conDetail->patientImg)) {
                                            ?>
                                            <img src="<?php echo base_url(BS_PROF_PATH); ?>/<?php echo $conDetail->patientImg  ?>" alt="" class="img-responsive patient-pic">
                                            <?php
                                        }
                                    ?>
                                    
                                </article>
                                <article class="col-md-5 text-right pull-right">
                                    <h3><?php echo isset($conDetail->userName) ? $conDetail->userName : ''; ?></h3>
                                    <p><?php
                                        //echo isset($conDetail->userGender) ? $conDetail->userGender : '';
                                        if (isset($conDetail->userGender)) {
                                            switch ($conDetail->userGender) {
                                                case 0:
                                                    $userGender = "-";
                                                    break;
                                                case 1:
                                                    $userGender = "Male";
                                                    break;
                                                case 2:
                                                    $userGender = "Female";
                                                    break;
                                                case 3:
                                                    $userGender = "Others";
                                                    break;
                                            } echo $userGender;
                                        }
                                        ?> | <?php echo isset($conDetail->userAge) ? $conDetail->userAge : ''; ?> Year</p>
                                    <p><?php echo isset($conDetail->mobile) ? $conDetail->mobile : ''; ?></p>
                                </article>
                            </div>

                            <div class="clearfix m-t-20">
                                <article class="col-md-2 p-0 pull-right m-r-20">
                                    
                                    <?php
                                        if($conDetail->type == 'hospital')
                                        $path = FCPATH . BS_HOSIMG_PATH;
                                        
                                        if($conDetail->type == 'diagnostic')
                                        $path = FCPATH . BS_DIAGIMG_PATH;
                                        
                                        
                                        if (file_exists(realpath($path) . '/' . $conDetail->MIimg)) {
                                            ?>
                                            <img src="<?php echo base_url(BS_PROF_PATH); ?>/<?php echo $conDetail->MIimg  ?>" alt="" class="img-responsive patient-pic">
                                            <?php
                                        }
                                    ?>
                                    <img src="assets/images/dc.jpg" alt="" class="img-responsive patient-pic">
                                </article>
                                <article class="col-md-5 text-right pull-right">
                                    <h3><?php echo isset($conDetail->MIname) ? $conDetail->MIname : ''; ?></h3>
                                    <p><?php echo isset($conDetail->MImblNo) ? $conDetail->MImblNo : ''; ?></p>
                                </article>
                            </div>
                            <div class="clearfix m-t-20 text-right">
                                <button type="button" class="btn btn-danger waves-effect m-r-10">Cancel</button>
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Reschedule</button>
                                <button type="submit" class="btn btn-appointment waves-effect waves-light m-tb-xs-3">Change Status</button>
                            </div>
                        </aside>
                    </article>


                    <!-- Top Secton Ends-->
                    <hr class="hr-appt-detail" />

                    <!-- Bottom Section Start -->
                    <article class="clearfix m-r-20 p-b-20">
                        <aside class="col-md-7">
                            <div class="clearfix m-t-20">
                                <h5 class="h5-title col-md-12">Patient Address :</h5>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Address :</label>
                                <p class="col-md-8 col-sm-8"><?php echo isset($conDetail->address) ? $conDetail->address : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">City :</label>
                                <p class="col-md-8 col-sm-8"><?php echo isset($conDetail->city_name) ? $conDetail->city_name : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Zip Code:</label>
                                <p class="col-md-8 col-sm-8"><?php echo isset($conDetail->pin) ? $conDetail->pin : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">State :</label>
                                <p class="col-md-8 col-sm-8"><?php echo isset($conDetail->state_statename) ? $conDetail->state_statename : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Country :</label>
                                <p class="col-md-8 col-sm-8"><?php echo isset($conDetail->country) ? $conDetail->country : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-20">
                                <h5 class="h5-title col-md-12">Payment Detail :</h5>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Consultation Fee :</label>
                                <p class="col-md-8 col-sm-8"><i class="fa fa-inr"></i><?php echo isset($conDetail->consulationFee) ? $conDetail->consulationFee : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Other Fee :</label>
                                <p class="col-md-8 col-sm-8"><?php echo isset($conDetail->otherFee) ? $conDetail->otherFee : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Tax :</label>
                                <p class="col-md-8 col-sm-8"><?php echo isset($conDetail->tax) ? $conDetail->tax : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Total Payble Amount :</label>
                                <p class="col-md-8 col-sm-8"><i class="fa fa-inr"> </i> <b><?php echo isset($conDetail->totPayAmount) ? $conDetail->totPayAmount : ''; ?></b></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Payment Status :</label>
                                <p class="col-md-8 col-sm-8"><?php echo isset($conDetail->paymentStatus) ? $conDetail->paymentStatus : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Payment Mode :</label>
                                <p class="col-md-8 col-sm-8"><?php echo isset($conDetail->paymentMethod) ? $conDetail->paymentMethod : ''; ?></p>
                            </div>

                        </aside>
                        <aside class="col-md-5">

                            <section id="effect-3" class="effects clearfix m-t-10">
                                <div class="clearfix m-t-20">
                                    <h5 class="h5-title col-md-12">Diagnostic Report :</h5>
                                </div>
                                
                                <?php
                                if (isset($reports) && $reports != null) {
                                    foreach ($reports as $report) {
                                        $path = FCPATH . BS_REPO_PATH;
                                        echo base_url(BS_PRS_IMG_PATH); ?>/<?php echo $report->report;
                                        if (file_exists(realpath($path) . '/' . $report->report)) {
                                            ?>
                                            <article class="img m-t-20">
                                                <img src="<?php echo base_url(BS_PRS_IMG_PATH); ?>/<?php echo $report->report; ?>" alt="">
                                                <div class="overlay">
                                                    <a href=""><i class="fa fa-search"></i></a>&nbsp;
                                                    <a href="#"><i class="fa fa-download"></i></a>
                                                    <a class="close-overlay hidden">x</a>
                                                </div>
                                            </article>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </section>

                        </aside>
                    </article>


                    <!-- Bottom Secton Ends-->
                </div>
            </section>

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
<?php echo $this->load->view('edit_upload_crop_modal'); ?>