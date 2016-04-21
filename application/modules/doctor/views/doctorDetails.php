
<style>
    .boxwidth{
        width: 4.54%;
    }


</style><!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container row">
            <div class="clearfix">
                <div class="col-md-12">
                    <h3 class="pull-left page-title">Doctor Management</h3>
                    <a href="<?php echo site_url() ?>/doctor/" class="btn btn-appointment btn-back waves-effect waves-light pull-right"><i class="fa fa-angle-left"></i> Back</a>
                </div>
            </div>
            <!-- Left Section Start -->
            <div class="col-md-12 bg-white">
                <section class="clearfix detailbox">
                    <!-- Table Section Start -->
                    <article class="clearfix m-t-20 p-b-20 doctor-profile">
                        <aside class="col-md-2 col-sm-2 col-xs-6 p-0">
                            <?php if (!empty($doctorDetail[0]->doctors_img)) { ?>
                                <img src="<?php echo base_url() ?>assets/doctorsImages/thumb/thumb_100/<?php echo $doctorDetail[0]->doctors_img; ?>" alt="" class="img-responsive doctor-pic" width="1650px" height="150px"/>
                            <?php } else { ?>
                                <img src="<?php echo base_url() ?>assets/default-images/Doctor-logo.png" alt="" class="logo-img" width="165px" height="150px" />
                            <?php } ?>
                        </aside>
                        <aside class="col-md-5 col-sm-5 col-xs-12">
                            <h3>Dr. <?php
                                if (isset($doctorDetail[0]->doctoesName) && $doctorDetail[0]->doctoesName != NULL) {
                                    echo $doctorDetail[0]->doctoesName;
                                }
                                ?></h3>
                            <p><?php
                                if (isset($doctorDetail[0]->degreeSmallName) && $doctorDetail[0]->degreeSmallName != NULL) {
                                    echo $doctorAcademic[0]->degreeSmallName;
                                }
                                ?></p>
                            <p><?php
                                if (isset($doctorDetail[0]->degreeFullName) && $doctorDetail[0]->degreeFullName != NULL) {
                                    echo $doctorAcademic[0]->degreeFullName;
                                }
                                ?></p>
                            <p><?php
                                if (isset($years) && $years != NULL) {
                                    echo $years;
                                }
                                ?> Years Experience</p>
                            <p><?php
                                if (isset($doctorDetail[0]->speciality) && $doctorDetail[0]->speciality != NULL) {
                                    echo $doctorDetail[0]->speciality;
                                }
                                ?></p>
                        </aside>
                        <form class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" method="post" action="#" novalidate="novalidate" name="doctorForm" enctype="multipart/form-data">
                            <aside class="col-md-5 col-sm-5 col-xs-12 text-right t-xs-left">
                                <div class="col-md-8 col-sm-8 text-right avatar-view pull-right">
                                    <label for="file-input" id="image_select"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x "></i></label>
                                    <img src="<?php echo base_url('assets/default-images/Doctor-logo.png'); ?>" width="70" height="65" class="image-preview-show"/>
                                </div>
                                <label class="error pull-right" id="error-avatarInput" style="display: none">Please Select Image</label>
                                <label class="error" > <?php echo form_error("avatar_file"); ?></label>
                                <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                                <input type="hidden" id="doctorAjaxId" name="doctorAjaxId" value="<?php
                                    if (isset($doctorDetail[0]->doctors_id) && $doctorDetail[0]->doctors_id != NULL) {
                                        echo $doctorDetail[0]->doctors_id;
                                    }
                                ?>" />
                                <label class="error" id="err_avatarInput" > <?php echo form_error("avatarInput"); ?></label>
                                <label class="error" id="err_doctorAjaxId" > <?php echo form_error("doctorAjaxId"); ?></label>
                                <div class="col-md-12 m-t-20 m-b-20">
                                    <button class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit" onclick="return validationImageDoctor()" >Change Image</button>
                                </div>
                                <div id="upload_modal_form">
<?php $this->load->view('upload_crop_modal'); ?>
                                </div>
                            </aside>
                        </form>
                    </article>
                    <article class="text-center clearfix m-t-10">
                        <ul class="nav nav-tab nav-doctor">
                            <li class="">
                                <a data-toggle="tab" href="#general">General Detail</a>
                            </li>
                            <li class=" ">
                                <a data-toggle="tab" href="#academic">Academic Detail</a>
                            </li>
                            <li class=" ">
                                <a data-toggle="tab" href="#experience">Experience</a>
                            </li>
                            <li class=" ">
                                <a data-toggle="tab" href="#appointment">Appointment History</a>
                            </li>
                            <li class="active ">
                                <a data-toggle="tab" href="#timeslot">Time Slot</a>
                            </li>
                            <li class=" ">
                                <a data-toggle="tab" href="#account">Account</a>
                            </li>
                        </ul>
                    </article>
                    <article class="tab-content p-b-20 m-t-50">
                        <div id="load_consulting" class="text-center text-success " style="display: none"><image alt="Please wait data is loading" src="<?php echo base_url('assets/images/loader/Heart_beat.gif'); ?>" /></div>
                        <div class="alert alert-success" id="successTop" style="display: none"></div>
                        <div class="alert alert-danger" id="er_TopError" style="display: none"></div>

                        <!-- Timeslot Starts Section -->
                        <section class="tab-pane fade in active" id="timeslot">

                            <div class="bg-white mi-form-section">
                                <!-- Top Detailed Section -->
                                <!-- Time Scedule Start here-->
                                <div class="container">
                                    <div class="clearfix">
                                        <div class="col-md-12">
                                            <h3 class="pull-left page-title">Doctor Availability</h3>
                                            <div id="load_consulting" class="text-center text-success " style="display: none"><image alt="Please wait data is loading" src="<?php echo base_url('assets/images/loader/Heart_beat.gif'); ?>" /></div>
                                        </div>
                                    </div>
<?php
$sMsg = $this->session->flashdata('message');
$eMsg = $this->session->flashdata('error');
if (!empty($sMsg)) {
    ?>
                                        <div class="alert alert-success" id="successmsg" ><?php echo $this->session->flashdata('message'); ?></div>
<?php } ?>
<?php if (!empty($eMsg)) { ?>
                                        <div class="alert alert-danger" id="errormsg"><?php echo $this->session->flashdata('error'); ?></div>
<?php } ?>
                                    <!-- Left Section Start -->
                                    <section class="col-md-7 detailbox m-b-20">
                                        <aside class="bg-white">
                                            <figure class="clearfix">
                                                <h3>Available At</h3>
                                                <article class="clearfix">
                                                    <div class="input-group m-b-5">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="b-search waves-effect waves-light btn-success"><i class="fa fa-search"></i></button>
                                                        </span>
                                                        <input type="text" ng-model="test" id="example-input1-group2" name="example-input1-group2" class="form-control ng-pristine ng-untouched ng-valid" placeholder="Search">
                                                    </div>
                                                </article>
                                            </figure>
<!--                                            <div class="nicescroll" style="overflow-x: scroll;" tabindex="5004">
                                                <div class="clearfix">
                                                    <div class="clearfix m-t-20 text-center" style="width:1600px">
                                                        <section class="col-md-2">
                                                            <aside class="checkbox checkbox-success text-left">
                                                                <input type="checkbox" id="checkbox3">
                                                                <label for="checkbox3">
                                                                    Monday
                                                                </label>
                                                            </aside>
                                                        </section>
                                                        <div class="col-md-10">

                                                            <article class="clearfix">

                                                                <aside class="col-md-3 schdule-space boxwidth">
                                                                    <div class="bootstrap-timepicker input-group">
                                                                        <input type="text" value="10:00 AM" class="form-control timepicker" id="timepicker4">
                                                                        <div class="bootstrap-timepicker-widget dropdown-menu"><table><tbody><tr><td><a data-action="incrementHour" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td><a data-action="incrementMinute" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td class="meridian-column"><a data-action="toggleMeridian" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td></tr><tr><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-hour" name="hour"></td> <td class="separator">:</td><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-minute" name="minute"></td> <td class="separator">&nbsp;</td><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-meridian" name="meridian"></td></tr><tr><td><a data-action="decrementHour" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator"></td><td><a data-action="decrementMinute" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator">&nbsp;</td><td><a data-action="toggleMeridian" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td></tr></tbody></table></div></div>
                                                                </aside>

                                                                <aside class="col-md-3 schdule-space boxwidth">
                                                                    <div class="bootstrap-timepicker input-group">
                                                                        <input type="text" value="10:00 AM" class="form-control timepicker" id="timepicker4">
                                                                        <div class="bootstrap-timepicker-widget dropdown-menu"><table><tbody><tr><td><a data-action="incrementHour" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td><a data-action="incrementMinute" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td class="meridian-column"><a data-action="toggleMeridian" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td></tr><tr><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-hour" name="hour"></td> <td class="separator">:</td><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-minute" name="minute"></td> <td class="separator">&nbsp;</td><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-meridian" name="meridian"></td></tr><tr><td><a data-action="decrementHour" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator"></td><td><a data-action="decrementMinute" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator">&nbsp;</td><td><a data-action="toggleMeridian" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td></tr></tbody></table></div></div>
                                                                </aside>
                                                                <aside class="col-md-3 schdule-space boxwidth">
                                                                    <div class="bootstrap-timepicker input-group">
                                                                        <input type="text" value="10:00 AM" class="form-control timepicker" id="timepicker4">
                                                                        <div class="bootstrap-timepicker-widget dropdown-menu"><table><tbody><tr><td><a data-action="incrementHour" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td><a data-action="incrementMinute" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td class="meridian-column"><a data-action="toggleMeridian" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td></tr><tr><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-hour" name="hour"></td> <td class="separator">:</td><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-minute" name="minute"></td> <td class="separator">&nbsp;</td><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-meridian" name="meridian"></td></tr><tr><td><a data-action="decrementHour" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator"></td><td><a data-action="decrementMinute" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator">&nbsp;</td><td><a data-action="toggleMeridian" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td></tr></tbody></table></div></div>
                                                                </aside>
                                                                <aside class="col-md-3 schdule-space boxwidth   ">
                                                                    <div class="bootstrap-timepicker input-group">
                                                                        <input type="text" value="10:00 AM" class="form-control timepicker" id="timepicker4">
                                                                        <div class="bootstrap-timepicker-widget dropdown-menu"><table><tbody><tr><td><a data-action="incrementHour" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td><a data-action="incrementMinute" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td class="meridian-column"><a data-action="toggleMeridian" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td></tr><tr><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-hour" name="hour"></td> <td class="separator">:</td><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-minute" name="minute"></td> <td class="separator">&nbsp;</td><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-meridian" name="meridian"></td></tr><tr><td><a data-action="decrementHour" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator"></td><td><a data-action="decrementMinute" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator">&nbsp;</td><td><a data-action="toggleMeridian" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td></tr></tbody></table></div></div>
                                                                </aside>
                                                                <aside class="col-md-3 schdule-space">
                                                                    <div class="bootstrap-timepicker input-group">
                                                                        <input type="text" value="10:00 AM" class="form-control timepicker" id="timepicker4">
                                                                        <div class="bootstrap-timepicker-widget dropdown-menu"><table><tbody><tr><td><a data-action="incrementHour" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td><a data-action="incrementMinute" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td class="meridian-column"><a data-action="toggleMeridian" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td></tr><tr><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-hour" name="hour"></td> <td class="separator">:</td><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-minute" name="minute"></td> <td class="separator">&nbsp;</td><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-meridian" name="meridian"></td></tr><tr><td><a data-action="decrementHour" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator"></td><td><a data-action="decrementMinute" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator">&nbsp;</td><td><a data-action="toggleMeridian" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td></tr></tbody></table></div></div>
                                                                </aside>
                                                            </article>

                                                        </div>
                                                    </div>

                                                    <div class="clearfix m-t-20 text-center" s>
                                                        <section class="col-md-2">
                                                            <aside class="checkbox checkbox-success text-left">
                                                                <input type="checkbox" id="checkbox3">
                                                                <label for="checkbox3">
                                                                    Monday
                                                                </label>
                                                            </aside>
                                                        </section>
                                                        <div class="col-md-10">

                                                            <article class="clearfix">

                                                                <aside class="col-md-3 schdule-space">
                                                                    <div class="bootstrap-timepicker input-group">
                                                                        <input type="text" value="10:00 AM" class="form-control timepicker" id="timepicker4">
                                                                        <div class="bootstrap-timepicker-widget dropdown-menu"><table><tbody><tr><td><a data-action="incrementHour" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td><a data-action="incrementMinute" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td class="meridian-column"><a data-action="toggleMeridian" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td></tr><tr><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-hour" name="hour"></td> <td class="separator">:</td><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-minute" name="minute"></td> <td class="separator">&nbsp;</td><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-meridian" name="meridian"></td></tr><tr><td><a data-action="decrementHour" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator"></td><td><a data-action="decrementMinute" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator">&nbsp;</td><td><a data-action="toggleMeridian" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td></tr></tbody></table></div></div>
                                                                </aside>

                                                                <aside class="col-md-3 schdule-space">
                                                                    <div class="bootstrap-timepicker input-group">
                                                                        <input type="text" value="10:00 AM" class="form-control timepicker" id="timepicker4">
                                                                        <div class="bootstrap-timepicker-widget dropdown-menu"><table><tbody><tr><td><a data-action="incrementHour" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td><a data-action="incrementMinute" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td class="meridian-column"><a data-action="toggleMeridian" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td></tr><tr><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-hour" name="hour"></td> <td class="separator">:</td><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-minute" name="minute"></td> <td class="separator">&nbsp;</td><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-meridian" name="meridian"></td></tr><tr><td><a data-action="decrementHour" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator"></td><td><a data-action="decrementMinute" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator">&nbsp;</td><td><a data-action="toggleMeridian" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td></tr></tbody></table></div></div>
                                                                </aside>
                                                                <aside class="col-md-3 schdule-space">
                                                                    <div class="bootstrap-timepicker input-group">
                                                                        <input type="text" value="10:00 AM" class="form-control timepicker" id="timepicker4">
                                                                        <div class="bootstrap-timepicker-widget dropdown-menu"><table><tbody><tr><td><a data-action="incrementHour" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td><a data-action="incrementMinute" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td class="meridian-column"><a data-action="toggleMeridian" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td></tr><tr><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-hour" name="hour"></td> <td class="separator">:</td><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-minute" name="minute"></td> <td class="separator">&nbsp;</td><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-meridian" name="meridian"></td></tr><tr><td><a data-action="decrementHour" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator"></td><td><a data-action="decrementMinute" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator">&nbsp;</td><td><a data-action="toggleMeridian" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td></tr></tbody></table></div></div>
                                                                </aside>
                                                                <aside class="col-md-3 schdule-space">
                                                                    <div class="bootstrap-timepicker input-group">
                                                                        <input type="text" value="10:00 AM" class="form-control timepicker" id="timepicker4">
                                                                        <div class="bootstrap-timepicker-widget dropdown-menu"><table><tbody><tr><td><a data-action="incrementHour" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td><a data-action="incrementMinute" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td class="meridian-column"><a data-action="toggleMeridian" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td></tr><tr><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-hour" name="hour"></td> <td class="separator">:</td><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-minute" name="minute"></td> <td class="separator">&nbsp;</td><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-meridian" name="meridian"></td></tr><tr><td><a data-action="decrementHour" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator"></td><td><a data-action="decrementMinute" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator">&nbsp;</td><td><a data-action="toggleMeridian" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td></tr></tbody></table></div></div>
                                                                </aside>
                                                                <aside class="col-md-3 schdule-space">
                                                                    <div class="bootstrap-timepicker input-group">
                                                                        <input type="text" value="10:00 AM" class="form-control timepicker" id="timepicker4">
                                                                        <div class="bootstrap-timepicker-widget dropdown-menu"><table><tbody><tr><td><a data-action="incrementHour" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td><a data-action="incrementMinute" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td class="meridian-column"><a data-action="toggleMeridian" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></td></tr><tr><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-hour" name="hour"></td> <td class="separator">:</td><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-minute" name="minute"></td> <td class="separator">&nbsp;</td><td><input type="text" maxlength="2" class="form-control bootstrap-timepicker-meridian" name="meridian"></td></tr><tr><td><a data-action="decrementHour" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator"></td><td><a data-action="decrementMinute" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator">&nbsp;</td><td><a data-action="toggleMeridian" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a></td></tr></tbody></table></div></div>
                                                                </aside>
                                                            </article>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>-->
                                        </aside>
                                    </section>
                                    <!-- Left Section End -->
                                    <!-- Right Section Start -->
    <section class="col-md-5 detailbox">
        <div class="bg-white">
            <aside class="clearfix">
                <!-- Appointment Chart -->
                <figure>
                    <h3>Add New Time slot</h3>
                </figure>
                <!-- Add Specialities -->
                <div class="col-sm-12">
                    <form  class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" name="addDoctorSlot" method="post" action="#" novalidate="novalidate">
                        <article class="clearfix m-t-10">
                            <label class="control-label" for="docTimeTable_stayAt">Seating Place Type:</label>
                            <div class="">
                                <aside class="radio radio-info radio-inline">
                                    <input type="radio"  required="" name="docTimeTable_stayAt" value="1" class="docTimeTable_stayAt" onclick="placeDetail(this.value)" >
                                    <label for="inlineRadio1"> MI Place</label>
                                </aside>
                                <aside class="radio radio-info radio-inline">
                                    <input type="radio" required="" name="docTimeTable_stayAt" value="0" class="docTimeTable_stayAt" onclick="placeDetail(this.value)" >
                                    <label for="inlineRadio2"> Personal Chamber</label>
                                </aside>
                            </div>
                        </article>
                        <article class="clearfix m-t-10" id="div_docTimeTable_MItype">
                            <label class="control-label" for="docTimeTable_MItype">MI Type:</label>
                            <div class="">
                                <select class="m-t-5 selectpicker" data-width="100%" name="docTimeTable_MItype" id="docTimeTable_MItype">
                                     <option value=""> -- Select MI Type -- </option>
                                    <option value="1">Hospital</option>
                                    <option value="2">Diagnostic</option>
                                </select>
                            </div>
                        </article>
                        <article class="clearfix m-t-10" id="div_docTimeTable_HprofileId">
                            <label class="control-label" for="docTimeTable_MIprofileId">Hospital Name:</label>
                            <div class="">
                                <select class="m-t-5 select2" data-width="100%" name="docTimeTable_MIprofileId" id="docTimeTable_MIprofileId">
                                    <option value="">-- Select Hospital --</option>
                                    <?php if (isset($allHospital) && $allHospital != NULL) {
                                        foreach ($allHospital as $aH) {
                                            ?>
                                            <option value="<?php echo $aH->hospital_id ?>"><?php echo $aH->hospital_name ?></option>
                                        <?php }
                                    }
                                    ?>
                                    <option value="0">Other</option>
                                </select>
                            </div>
                        </article>
                        <article class="clearfix m-t-10" id="div_docTimeTable_DprofileId">
                            <label class="control-label" for="docTimeTable_MIprofileId">Diagnostic Name:</label>
                            <div class="">
                                <select class="m-t-5 select2" data-width="100%" name="docTimeTable_MIprofileId" id="docTimeTable_MIprofileId">
                                    <option value="">-- Select Diagnostic --</option>
<?php if (isset($alldignostic) && $alldignostic != NULL) {
foreach ($alldignostic as $aD) {
?>
                                            <option value="<?php echo $aD->diagnostic_id ?>"><?php echo $aD->diagnostic_name ?></option>
<?php }
}
?>
                                    <option value="0">Other</option>
                                </select>
                            </div>
                        </article>
                        <article class="clearfix" id="div_Mi_name">
                            <label class="control-label" for="Mi_name">MI Name:</label>
                            <div class="">
                                <input type="text" name="Mi_name" id="Mi_name" class="form-control" placeholder="MI Name" value="<?php echo set_value('Mi_name'); ?>">
                                <label class="error"><?php echo form_error("Mi_name"); ?></label>
                            </div>
                        </article>
                        <article class="clearfix m-t-10 " id="div_psChamber_name">
                            <label class="control-label" for="psChamber_name">Personal Chamber Name:</label>
                            <div class="">
                                <input type="text" name="psChamber_name" id="psChamber_name" class="form-control"  value="<?php echo set_value('psChamber_name'); ?>">
                                <label class="error"><?php echo form_error("psChamber_name"); ?></label>
                            </div>
                        </article>

                        <article class="clearfix" id="div_address">
                            <label for="cname" class="control-label">Address:</label>
                            <div class="">
                                <aside class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <select class="selectpicker" data-width="100%" name="doctors_countryId" id="doctors_countryId">
                                            <option value="1">India</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6 m-t-xs-10">
                                        <select class="selectpicker" data-width="100%" name="doctors_stateId" Id="doctors_stateId" data-size="4" onchange ="fetchCity(this.value)">
                                            <option value="">Select State</option>
<?php foreach ($allStates as $key => $val) { ?>
                                                <option value="<?php echo $val->state_id; ?>"><?php echo $val->state_statename; ?></option>
<?php } ?>
                                        </select>
                                        <label class="error" style="display:none;" id="error-doctors_stateId"> please select a state</label>
                                        <label class="error"><?php echo form_error("doctors_stateId"); ?></label>
                                    </div>
                                </aside>
                                <aside class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <select class="selectpicker" data-width="100%" name="doctors_cityId" id="doctors_cityId" data-size="4" >
                                        </select>
                                        <label class="error" style="display:none;" id="error-doctors_cityId"> please select a state</label>
                                        <label class="error" > <?php echo form_error("doctors_cityId"); ?></label>
                                    </div>
                                    <div class="col-md-6 col-sm-6 m-t-xs-10">
                                        <input type="text" class="form-control" id="doctors_pinn" name="doctors_pinn" placeholder="Pin Code" maxlength="6" onkeypress="return isNumberKey(event)" value="<?php echo set_value('doctors_pinn'); ?>" />
                                        <label class="error" style="display:none;" id="error-doctors_pinn"> Zip code should be numeric and 6 digit long</label>
                                        <label class="error" > <?php echo form_error("doctors_pinn"); ?></label>
                                    </div>

                                </aside>
                                <aside class="row">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="geocomplete1" name="doctor_addr" placeholder="Address" value="<?php echo set_value('doctor_addr'); ?>" />
                                        <label class="error" > <?php echo form_error("doctor_addr"); ?></label>
                                    </div>
                                </aside>
                            </div>
                        </article>
                        <article class="clearfix">
                            <label class="control-label" for="docTimeDay_day">Weekdays:</label>
                            <div class="">
                                <select class="m-t-5 select2" data-width="100%" name="docTimeDay_day" id="docTimeDay_day" multiple="">
                        <?php   
                                $days = getDay();
                                if (isset($days) && $days != NULL) {
                                    foreach ($days as $d => $dayName) {  ?>
                                    <option value="<?php echo $dayName ?>"><?php echo $d ?></option>
                                <?php }
                                }  ?>
                                </select>
                            </div>
                            <div class="">
                                <aside class="checkbox checkbox-success m-t-5">
                                    <input type="checkbox" id="selectAllDay" name="selectAllDay" class="" >
                                    <label> Select All Days</label>
                                </aside>
                                
                            </div>
                        </article>
                        <article class="clearfix  m-t-10">
                            <div class="">
                                <aside class="row">
                                    <div class="col-sm-6">
                                        <input name="openingHour" class="form-control" required="" type="text" value="<?php echo set_value('openingHour'); ?>"  id="lat"   placeholder="opening Hour" />
                                        <label class="error" > <?php echo form_error("openingHour"); ?></label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input name="closeingHour" required="" type="text" value="<?php echo set_value('closeingHour'); ?>"  id="closeingHour"  class="form-control" placeholder="closing Hour"  maxlength="9"/>
                                        <label class="error" > <?php echo form_error("closeingHour"); ?></label>
                                    </div>
                                </aside>
                            </div>
                        </article>
                        <article class="clearfix">
                            <label class="control-label" for="fees">fees:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i>
</span>
                                <input name="fees" required="" type="text" value="<?php echo set_value('fees'); ?>"  id="fees"   class="form-control" placeholder="fees"  maxlength="9" onkeypress="return isNumberKey(event)"  />
                                <label class="error" > <?php echo form_error("fees"); ?></label>
                            </div>
                        </article>
                        <article class="clearfix m-t-10 m-b-20">
                            <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Submit</button>
                        </article>

                    </form>
                </div>
                <!-- Add Specialities -->
            </aside>
        </div>
    </section>
                                    <!-- Right Section End -->
                                </div>
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
