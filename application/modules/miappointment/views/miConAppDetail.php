
<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container row">
            <div class="clearfix">
                <div class="col-md-12">
                    <h3 class="pull-left page-title">Consultation Appointment Detail</h3>
                    <a href="<?php echo site_url()?>/miappointment" class="btn btn-appointment btn-back waves-effect waves-light pull-right"><i class="fa fa-angle-left"></i> Back</a>

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
                                <label class="col-md-4">Appointment Date :</label>
                                <p class="col-md-8"><?php echo isset($conDetail->dateTime) ? date('M d,Y', $conDetail->dateTime) : ''; ?></p>
                            </div>

                            <!--div class="clearfix m-t-10">
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

                            </div-->


                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Final Time :</label>
                                <p class="col-md-8"><?php echo isset($conDetail->dateTime) ? date('h:i A', $conDetail->dateTime) : ''; ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Status:</label>
                                <p class="col-md-8">
                                    <?php echo $conDetail->bookingStatus; ?>
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
                                <button type="button" class="btn btn-danger waves-effect m-r-10" onclick="changestatus(<?php echo $qtnId;?>,1,13)">Cancel</button>
                               <button data-toggle="modal" data-target="#myModal" class="btn btn-success waves-effect waves-light m-b-5 applist-btn" type="button">Reschedule</button>
                                
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
                                <p class="col-md-8 col-sm-8"><?php echo isset($conDetail->paymode) ? $conDetail->paymode : ''; ?></p>
                            </div>

                        </aside>
                        <!--aside class="col-md-5">

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

                        </aside-->
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


    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Change Timing</h3>
                </div>
                <!--input type="hidden" id="mi_centre" name="mi_centre"  value="<?php echo $conDetail->doctorParentId;?>"-->
                <input type="hidden" id="docid" name="docid" value="<?php echo $conDetail->docid."_".$conDetail->doctorUserId;?>">
                
                <input type="hidden" id="appid" name="appid" value="<?php echo isset($appid) ? $appid : ''?>">
                <div class="modal-body">
                    <div class="modal-body">
                        <form class="form-horizontal" id="changetimeform">
                            <article class="clearfix m-t-10">
                                <label for="" class="control-label col-md-4 col-sm-4">Appointment Date:</label>
                                <div class="col-md-8 col-sm-8">
                                    <div class="input-group">
                                        <input class="form-control pickDate" value="17/12/2015" id="date-7" type="text" name="appdate" onkeydown="return false;" onchange="getTimeSlot();">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>
                            </article>
                            <article class="clearfix m-t-10">
                                <label class="control-label col-md-4 col-sm-4">Time Slot :</label>
                                <p class="col-md-8 col-sm-8">
                                    <select  data-width="100%" name="timeSlot" id="timeSlot">
                                        <option value="">Select Time Slot</option>
                                    </select>

                                </p>
                            </article>
                            <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4 col-sm-4">Final Timing:</label>
                                <div class="col-md-8 col-sm-8">
                                    <div class="bootstrap-timepicker input-group w-100">
                                        <input id="timepicker3" name="finaltime" type="text" class="form-control timepicker" value="06:00 PM" />
                                    </div>
                                </div>
                            </article>
                            <article class="clearfix m-t-20">
                                <button type="button" class="btn btn-primary pull-right waves-effect waves-light" onclick="changeapptime()">Save changes</button>
                            </article>
                        </form>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>