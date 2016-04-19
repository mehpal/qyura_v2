
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
                                <p class="col-md-8"><?php echo isset($qtnDetail->MIname) ? $qtnDetail->MIname : ''; ?></p>
                            </div>
                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Appointment Id :</label>
                                <p class="col-md-8"><?php echo isset($qtnDetail->orderId) ? $qtnDetail->orderId : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4">HMS Id :</label>
                                <p class="col-md-8"><?php echo isset($qtnDetail->hmsId) ? $qtnDetail->hmsId : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Appointment Date :</label>
                                <p class="col-md-8"><?php echo isset($qtnDetail->dateTime) ? date('M d,Y', $qtnDetail->dateTime) : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Session :</label>
                                <p class="col-md-8"><?php
                                    if (isset($qtnDetail->timeSlot)) {
                                        $timeSlot = explode('-', $qtnDetail->timeSlot);
                                        if (is_array($timeSlot) && count($timeSlot) == 3) {
                                            switch ($timeSlot[2]) {
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
                                            echo $session . " | " . $timeSlot[0] . " - " . $timeSlot[1];
                                        }
                                    }
                                    ?></p>

                            </div>


                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Final Time :</label>
                                <p class="col-md-8"><?php echo isset($qtnDetail->dateTime) ? date('h:i A', $qtnDetail->dateTime) : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Status:</label>
                                <p class="col-md-8">
                                    <?php
                                    if (isset($qtnDetail->bookStatus)) {
                                        switch ($qtnDetail->bookStatus) {
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
                                <p class="col-md-8"><?php echo 'Need discus'; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Instruction :</label>
                                <?php
                                if (isset($quotationTests) && $quotationTests != null) {
                                    foreach ($quotationTests as $quotationTest) {
                                        ?>
                                        <p class="col-md-8"><?php echo $quotationTest->instruction; ?></p>
                                        <?php
                                    }
                                }
                                ?>

                            </div>


                        </aside>
                        <aside class="col-md-6 col-sm-6">
                            <div class="clearfix m-t-20">
                                <article class="col-md-2 p-0 pull-right m-r-20">
                                    <?php
                                        $path = FCPATH . BS_PROF_PATH;
                                        if (file_exists(realpath($path) . '/' . $userDetail->patientImg)) {
                                            ?>
                                            <img src="<?php echo base_url(BS_PROF_PATH); ?>/<?php echo $userDetail->patientImg  ?>" alt="" class="img-responsive patient-pic">
                                            <?php
                                        }
                                    ?>
                                    
                                </article>
                                <article class="col-md-5 text-right pull-right">
                                    <h3><?php echo isset($userDetail->userName) ? $userDetail->userName : ''; ?></h3>
                                    <p><?php
                                        echo isset($userDetail->userGender) ? $userDetail->userName : '';
                                        if (isset($userDetail->userGender)) {
                                            switch ($userDetail->userGender) {
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
                                        ?> | <?php echo isset($userDetail->userAge) ? $userDetail->userAge : ''; ?> Year</p>
                                    <p><?php echo isset($userDetail->mobile) ? $userDetail->mobile : ''; ?></p>
                                </article>
                            </div>

                            <div class="clearfix m-t-20">
                                <article class="col-md-2 p-0 pull-right m-r-20">
                                    
                                    <?php
                                        if($qtnDetail->type == 'hospital')
                                        $path = FCPATH . BS_HOSIMG_PATH;
                                        
                                        if($qtnDetail->type == 'diagnostic')
                                        $path = FCPATH . BS_DIAGIMG_PATH;
                                        
                                        
                                        if (file_exists(realpath($path) . '/' . $qtnDetail->MIimg)) {
                                            ?>
                                            <img src="<?php echo base_url(BS_PROF_PATH); ?>/<?php echo $qtnDetail->MIimg  ?>" alt="" class="img-responsive patient-pic">
                                            <?php
                                        }
                                    ?>
                                    <img src="assets/images/dc.jpg" alt="" class="img-responsive patient-pic">
                                </article>
                                <article class="col-md-5 text-right pull-right">
                                    <h3><?php echo isset($qtnDetail->MIname) ? $qtnDetail->MIname : ''; ?></h3>
                                    <p><?php echo isset($qtnDetail->MImblNo) ? $qtnDetail->MImblNo : ''; ?></p>
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
                                <p class="col-md-8 col-sm-8"><?php echo isset($userDetail->address) ? $userDetail->address : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">City :</label>
                                <p class="col-md-8 col-sm-8"><?php echo isset($userDetail->city_name) ? $userDetail->city_name : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Zip Code:</label>
                                <p class="col-md-8 col-sm-8"><?php echo isset($userDetail->pin) ? $userDetail->pin : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">State :</label>
                                <p class="col-md-8 col-sm-8"><?php echo isset($userDetail->state_statename) ? $userDetail->state_statename : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Country :</label>
                                <p class="col-md-8 col-sm-8"><?php echo isset($userDetail->country) ? $userDetail->country : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-20">
                                <h5 class="h5-title col-md-12">Payment Detail :</h5>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Consultation Fee :</label>
                                <p class="col-md-8 col-sm-8"><i class="fa fa-inr"></i><?php echo isset($qtnAmount->price) ? $qtnAmount->price : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Other Fee :</label>
                                <p class="col-md-8 col-sm-8">0</p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Tax :</label>
                                <p class="col-md-8 col-sm-8">5%</p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Total Payble Amount :</label>
                                <p class="col-md-8 col-sm-8"><i class="fa fa-inr"> </i> <b><?php echo isset($qtnAmount->price) ? $qtnAmount->price : ''; ?></b></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Payment Status :</label>
                                <p class="col-md-8 col-sm-8"><?php echo isset($qtnDetail->paymentStatus) ? $qtnDetail->paymentStatus : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4 col-sm-4">Payment Mode :</label>
                                <p class="col-md-8 col-sm-8"><?php echo isset($qtnDetail->paymentMethod) ? $qtnDetail->paymentMethod : ''; ?></p>
                            </div>

                        </aside>
                        <aside class="col-md-5">

                            <section id="effect-3" class="effects clearfix">
                                <div class="clearfix m-t-20">
                                    <h5 class="h5-title col-md-12">Prescription :</h5>
                                </div>

                                <?php
                                if (isset($quotationTests) && $quotationTests != null) {
                                    foreach ($quotationTests as $quotationTest) {
                                        $path = FCPATH . BS_PRS_IMG_PATH;
                                        echo base_url(BS_PRS_IMG_PATH); ?>/<?php echo $quotationTest->prescription;
                                        if (file_exists(realpath($path) . '/' . $quotationTest->prescription)) {
                                            ?>
                                            <article class="img m-t-20">
                                                <img src="<?php echo base_url(BS_PRS_IMG_PATH); ?>/<?php echo $quotationTest->prescription; ?>" alt="">
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

                            <section id="effect-3" class="effects clearfix m-t-10">
                                <div class="clearfix m-t-20">
                                    <h5 class="h5-title col-md-12">Diagnostic Report :</h5>
                                </div>
                                
                                <?php
                                if (isset($quotationTests) && $quotationTests != null) {
                                    foreach ($quotationTests as $quotationTest) {
                                        $path = FCPATH . BS_REPO_PATH;
                                        echo base_url(BS_PRS_IMG_PATH); ?>/<?php echo $quotationTest->report;
                                        if (file_exists(realpath($path) . '/' . $quotationTest->report)) {
                                            ?>
                                            <article class="img m-t-20">
                                                <img src="<?php echo base_url(BS_PRS_IMG_PATH); ?>/<?php echo $quotationTest->report; ?>" alt="">
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