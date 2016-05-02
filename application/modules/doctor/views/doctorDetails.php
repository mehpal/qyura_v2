<style>
    .m-t-4{margin-top:4px;}
    .blue-ttl{width:120px; height:85px; border:1px solid #ddd; 
              padding:0px 2px 10px 0px; margin: 15px 10px; float: left }
    .blue-ttl aside h5
    {
        text-align: right;
        display:none;
        margin-top: 3px;
    }
    .blue-ttl aside h5 
    {
        display: none;
    }
    .blue-ttl:hover aside h5 
    {
        display:block;
    }
    .blue-ttl + .tooltip > .tooltip-inner {
        background-color: #f8f8f8;
        border: 1px solid #3FCEB2;
        padding: 0px;
        color:#333;
        text-align: left;
        padding: 0px 10px 10px;
    }
    .orange-ttl + .tooltip.left .tooltip-arrow {
        border-top-color:  #3FCEB2;
    }
</style>
<!-- Start right Content here -->
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
            <?php
            $date2 = date('Y-m-d');
            if (isset($doctorDetail[0]->doctors_expYear) && $doctorDetail[0]->doctors_expYear != NULL) {
                $date1 = $doctorDetail[0]->doctors_expYear;
            } else {
                $date1 = strtotime(date('Y-m-d'));
            }
            $diff = abs(strtotime($date2) - $date1);
            $years = floor($diff / (365 * 60 * 60 * 24));
            ?>
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
                                <div class="col-md-8 col-sm-8 pull-right" data-target="#modal" data-toggle="modal">
                                    <label class="col-md-5 col-sm-5 pull-right" for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x avatar-view"></i></label>
                                    <div class="pre col-md-4 col-sm-4 pull-right" style="margin-top: -10%">
                                        <div id="preImgLogo" class="avatar-preview preview-md">
                                            <img src="<?php echo base_url() ?>assets/default-images/Doctor-logo.png"  class="image-preview-show" width="80px" height="80px" style="margin-top: 0"/>
                                        </div>
                                    </div>
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
                    <article class="text-center clearfix m-t-50">
                        <ul class="nav nav-tab nav-doctor">
                            <?php $active_tag = $this->session->flashdata('active_tag'); ?>
                            <li class="<?php
                            if ($active_tag == '' || $active_tag == 1) {
                                echo "active";
                            }
                            ?>">
                                <a data-toggle="tab" href="#general">General Detail</a>
                            </li>
                            <li class="<?php
                            if ($active_tag == 2) {
                                echo "active";
                            }
                            ?>">
                                <a data-toggle="tab" href="#academic">Academic Detail</a>
                            </li>
                            <li class="<?php
                                if ($active_tag == 3) {
                                    echo "active";
                                }
                            ?>">
                                <a data-toggle="tab" href="#experience">Services</a>
                            </li>
                            <li class="<?php
                                 if ($active_tag == 4) {
                                     echo "active";
                                 }
                                 ?>">
                                <a data-toggle="tab" href="#timeslot">Time Slot</a>
                            </li>
                            <li class="<?php
                                 if ($active_tag == 5) {
                                     echo "active";
                                 }
                                 ?>">
                                <a data-toggle="tab" href="#account">Account</a>
                            </li>
                        </ul>
                    </article>
                    <article class="tab-content p-b-20 m-t-50">
                        <div id="load_consulting" class="text-center text-success " style="display: none"><image alt="Please wait data is loading" src="<?php echo base_url('assets/images/loader/Heart_beat.gif'); ?>" /></div>
                        <div class="alert alert-success" id="successTop" style="display: none"></div>
                        <div class="alert alert-danger" id="er_TopError" style="display: none"></div>
                        <!-- General Detail Starts -->
                        <section class="tab-pane fade in <?php
                                 if ($active_tag == '' || $active_tag == 1) {
                                     echo "active";
                                 }
                                 ?>" id="general">
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
                                        <section id="detail" style="display:  <?php
                                                    if (isset($detailShow) && $detailShow != NULL) {
                                                        echo $detailShow;
                                                    }
                                                    ?>;">    
                                            <article class="form-group m-lr-0">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Doctor Id :</label>
                                                <p class="col-md-8 col-sm-8"><?php
                                                    if (isset($doctorDetail[0]->doctors_unqId) && $doctorDetail[0]->doctors_unqId != NULL) {
                                                        echo $doctorDetail[0]->doctors_unqId;
                                                    }
                                                    ?></p>
                                            </article>

                                            <article class="form-group m-lr-0 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Date of Joining :</label>
                                                <p class="col-md-8 col-sm-8"><?php
                                                    if (isset($doctorDetail[0]->doctors_joiningDate) && $doctorDetail[0]->doctors_joiningDate != NULL) {
                                                        echo date('F j Y', $doctorDetail[0]->doctors_joiningDate);
                                                    }
                                                    ?></p>
                                            </article>
                                            <article class="form-group m-lr-0 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Date of Birth :</label>
                                                <p class="col-md-8"><?php
                                                    if (isset($doctorDetail[0]->doctors_dob) && $doctorDetail[0]->doctors_dob != NULL) {
                                                        echo date('F j Y', $doctorDetail[0]->doctors_dob);
                                                    }
                                                    ?></p>
                                            </article>
                                            <article class="form-group m-lr-0 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Email Id:</label>
                                                <p class="col-md-8 col-sm-8"><?php
                                                    if (isset($doctorDetail[0]->users_email) && $doctorDetail[0]->users_email != NULL) {
                                                        echo $doctorDetail[0]->users_email;
                                                    } else {
                                                        echo "NA";
                                                    }
                                                    ?></p>
                                            </article>
                                            <article class="form-group m-lr-0 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone :</label>
                                                <p class="col-md-8 col-sm-8"><?php
                                                    if (isset($doctorDetail[0]->doctors_phn) && $doctorDetail[0]->doctors_phn != NULL) {
                                                        echo $doctorDetail[0]->doctors_phn;
                                                    } else {
                                                        echo "NA";
                                                    }
                                                    ?></p>
                                            </article>
                                            <article class="form-group m-lr-0 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Doctor On Call :</label>
                                                <p class="col-md-8 col-sm-8" style="width: 40%" ><?php
                                                    if (isset($doctorDetail[0]->doctors_27Src) && $doctorDetail[0]->doctors_27Src != NULL) {
                                                        if ($doctorDetail[0]->doctors_27Src == 1) {
                                                            echo "24x7";
                                                        } else {
                                                            echo "No";
                                                        }
                                                    }
                                                    ?></p>
                                            </article>
                                            <article class="form-group m-lr-0 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Home Visit :</label>
                                                <p class="col-md-8 col-sm-8" style="width: 40%" ><?php
                                                    if (isset($doctorDetail[0]->doctors_homeVisit) && $doctorDetail[0]->doctors_homeVisit != NULL) {
                                                        if ($doctorDetail[0]->doctors_homeVisit == 1) {
                                                            echo "Yes";
                                                        } else {
                                                            echo "No";
                                                        }
                                                    }
                                                    ?></p>
                                            </article>
                                            <article class="form-group m-lr-0 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Address :</label>
                                                <p class="col-md-8 col-sm-8" style="width: 40%" ><?php
                                                    if (isset($doctorDetail[0]->doctor_addr) && $doctorDetail[0]->doctor_addr != NULL) {
                                                        echo $doctorDetail[0]->doctor_addr;
                                                    }
                                                    ?></p>
                                            </article>
                                            <article class="form-group m-lr-0 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Years of Experience :</label>
                                                <p class="col-md-8 col-sm-8" style="width: 40%" ><?php
                                                    if (isset($years) && $years != NULL) {
                                                        echo $years;
                                                    }
                                                    ?> Years</p>
                                            </article>
                                            <article class="form-group m-lr-0 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">DocatId :</label>
                                                <p class="col-md-8 col-sm-8" style="width: 40%" ><?php
                                                    if (isset($doctorDetail[0]->doctors_docatId) && $doctorDetail[0]->doctors_docatId != NULL) {
                                                        echo $doctorDetail[0]->doctors_docatId;
                                                    }
                                                    ?></p>
                                            </article>
                                            <article class="form-group m-lr-0 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">QAP Id :</label>
                                                <p class="col-md-8 col-sm-8" style="width: 40%" ><?php
                                                    if (isset($doctorDetail[0]->qap_code) && $doctorDetail[0]->qap_code != NULL) {
                                                        echo $doctorDetail[0]->qap_code;
                                                    }
                                                    ?></p>
                                            </article>
                                        </section>
                                        <section id="newDetail" style="display:<?php echo $showStatus; ?>;">
                                            <!--edit-->
                                            <form name="doctorDetailForm" action="#" id="doctorDetailForm" method="post">
                                                <input type="hidden" id="StateId" name="StateId" value="<?php
                                                            if (isset($doctorDetail[0]->doctor_addr) && $doctorDetail[0]->doctor_addr != NULL) {
                                                                echo $doctorDetail[0]->doctors_stateId;
                                                            }
                                                    ?>" />
                                                <input type="hidden" id="countryId" name="countryId" value="<?php
                                                            if (isset($doctorDetail[0]->doctors_countryId) && $doctorDetail[0]->doctors_countryId != NULL) {
                                                                echo $doctorDetail[0]->doctors_countryId;
                                                            }
                                                    ?>" />
                                                <input type="hidden" id="cityId" name="cityId" value="<?php
                                                        if (isset($doctorDetail[0]->doctors_cityId) && $doctorDetail[0]->doctors_cityId != NULL) {
                                                            echo $doctorDetail[0]->doctors_cityId;
                                                        }
                                                    ?>" />
                                                <input type="hidden" id="userId" name="userId" value="<?php
                                                        if (isset($doctorDetail[0]->doctors_userId) && $doctorDetail[0]->doctors_userId != NULL) {
                                                            echo $doctorDetail[0]->doctors_userId;
                                                        }
                                                    ?>" />
                                                <input type="hidden" id="doctorAjaxId" name="doctorAjaxId" value="<?php
                                                            if (isset($doctorDetail[0]->doctors_id) && $doctorDetail[0]->doctors_id != NULL) {
                                                                echo $doctorDetail[0]->doctors_id;
                                                            }
                                                            ?>" />
                                                <article class="clearfix m-t-10">
                                                    <label for="" class="control-label col-md-3 col-sm-4">First Name :</label>
                                                    <div class="col-md-4 col-sm-5">
                                                        <input class="form-control" id="doctors_fName" type="text" name="doctors_fName" value="<?php echo (set_value('doctors_fName')) ? set_value('doctors_fName') : $doctorDetail[0]->doctors_fName; ?>">

                                                        <label class="error" id="err_doctors_fName" > <?php echo form_error("doctors_fName"); ?></label>
                                                    </div>
                                                </article>
                                                <article class="clearfix m-t-10">
                                                    <label for="" class="control-label col-md-3 col-sm-4">Last Name :</label>
                                                    <div class="col-md-4 col-sm-5">
                                                        <input class="form-control" id="doctors_lName" type="text" name="doctors_lName" value="<?php echo (set_value('doctors_lName')) ? set_value('doctors_lName') : $doctorDetail[0]->doctors_lName; ?>" />
                                                        <label class="error" id="err_doctors_lName" > <?php echo form_error("doctors_lName"); ?></label>
                                                    </div>
                                                </article>
                                                <article class="clearfix m-t-10">
                                                    <label for="" class="control-label col-md-3 col-sm-4">Date of Birth :</label>
                                                    <div class="col-md-4 col-sm-5">
                                                        <div class="input-group">
                                                            <input class="form-control pickDate" placeholder="mm/dd/yyyy" id="doctors_dob" type="text" name="doctors_dob" value="<?php echo (set_value('doctors_dob')) ? set_value('doctors_dob') : date('m/d/Y', $doctorDetail[0]->doctors_dob) ?>">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                        </div>
                                                        <label class="error" id="err_doctors_dob" > <?php echo form_error("doctors_dob"); ?></label>
                                                    </div>
                                                </article>
                                                <article class="clearfix m-t-10">
                                                    <label for="cname" class="control-label col-md-3 col-sm-4">Date of Joining :</label>
                                                    <div class="col-md-4 col-sm-5">
                                                        <div class="input-group">
                                                            <input class="form-control pickDate" placeholder="mm/dd/yyyy" id="doctors_creationTime" type="text" readonly="" name="creationTime" value="<?php
                                                                    if (isset($doctorDetail[0]->doctors_joiningDate) && $doctorDetail[0]->doctors_joiningDate != NULL) {
                                                                        echo date('m/d/Y', $doctorDetail[0]->doctors_joiningDate);
                                                                    }
                                                            ?>">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                        </div>
                                                        <label class="error" id="err_creationTime" > <?php echo form_error("creationTime"); ?></label>
                                                    </div>
                                                </article>
                                                <article class="clearfix m-t-10">
                                                    <label class="control-label col-md-3 col-sm-4">Email :</label>
                                                    <div class="col-md-4 col-sm-5">
                                                        <input class="form-control" id="users_email" name="users_email" placeholder="abc@gmail.com" value="<?php
                                                                        if (isset($doctorDetail[0]->users_email) && $doctorDetail[0]->users_email != NULL) {
                                                                            echo $doctorDetail[0]->users_email;
                                                                        }
                                                            ?>" onblur="checkEmailFormat()"/>
                                                        <label class="error" id="err_users_email" > <?php echo form_error("users_email"); ?></label>
                                                    </div>
                                                </article>
                                                <article class="clearfix m-t-10">
                                                    <label for="" class="control-label col-md-3 col-sm-3">Speciality:</label>
                                                    <div class="col-md-4 col-sm-4">
                                                        <select  multiple="" class="bs-select form-control-select2 " data-width="100%" name="doctorSpecialities_specialitiesId[]" Id="doctorSpecialities_specialitiesId" data-size="4">
<?php foreach ($speciality as $key => $val) { ?>
                                                                <option <?php
    if (isset($qyura_doctorSpecialities) && $qyura_doctorSpecialities != NULL) {
        if (in_array($val->specialities_id, $qyura_doctorSpecialities)) {
            echo "selected";
        }
    }
    ?> value="<?php echo $val->specialities_id; ?>"><?php echo $val->specialities_name; ?></option>
                                                                    <?php } ?>
                                                        </select>
                                                        <div class='setValues'></div>
                                                        <label class="error" style="display:none;" id="error-doctorSpecialities_specialitiesId"> Please select speciality(s)</label>
                                                        <label class="error" > <?php echo form_error("doctorSpecialities_specialitiesId"); ?></label>
                                                    </div>
                                                </article>
                                                <div id="multiplePhoneNumber">
                                                    <article class="form-group m-lr-0 ">
                                                        <label for="cemail" class="control-label col-md-3 col-sm-3">Phone :</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <aside class="row">
                                                                <div class="col-md-6 col-sm-12 col-xs-10 m-t-xs-10 ">
                                                                    <input type="text" class="form-control" name="doctors_phn" id="doctors_phn1" maxlength="10" placeholder="Number" onblur="checkNumber('doctors_phn', 1)" onkeypress="return isNumberKey(event)" value="<?php
                                                                       if (isset($doctorDetail[0]->doctors_phn) && $doctorDetail[0]->doctors_phn != NULL) {
                                                                           echo $doctorDetail[0]->doctors_phn;
                                                                       }
                                                                       ?>" />
                                                                    <label class="error" id="err_doctors_phn" > <?php echo form_error("doctors_phn"); ?></label>
                                                                </div>
                                                            </aside>
                                                        </div>
                                                    </article>
                                                </div>
                                                <article class="form-group m-lr-0">
                                                    <label for="cname" class="control-label col-md-3 col-sm-3">Address:</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <aside class="row">
                                                            <div class="col-md-3 col-sm-3">
                                                                <select class="selectpicker" data-width="100%" name="doctors_countryId" id="doctors_countryId">
                                                                    <option value="">Select Country</option>
<?php
if (isset($qyura_country) && $qyura_country != NULL) {
    foreach ($qyura_country as $key => $val) {
        ?>
                                                                            <option <?php
                                                                               if ($doctorDetail[0]->doctors_countryId == $val->country_id) {
                                                                                   echo "selected";
                                                                               }
                                                                               ?> value="<?php echo $val->country_id; ?>"><?php echo $val->country; ?></option>
    <?php }
}
?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3 col-sm-3 m-t-xs-10">
                                                                <select class="selectpicker" data-width="100%" name="doctors_stateId" Id="doctors_stateId" data-size="4" onchange ="fetchCity(this.value)">
                                                                    <option value="">Select State</option>
<?php
if (isset($qyura_state) && $qyura_state != NULL) {
    foreach ($qyura_state as $key => $val) {
        ?>
                                                                            <option <?php
        if ($doctorDetail[0]->doctors_stateId == $val->state_id) {
            echo "selected";
        }
        ?> value="<?php echo $val->state_id; ?>"><?php echo $val->state_statename; ?></option>
    <?php }
}
?>
                                                                </select>
                                                                <label class="error" style="display:none;" id="error-doctors_stateId"> please select a state</label>
                                                                <label class="error" > <?php echo form_error("doctors_stateId"); ?></label>
                                                            </div>
                                                        </aside>
                                                    </div>
                                                </article>
                                                <article class="form-group m-lr-0">
                                                    <div class="col-md-8 col-md-offset-3 col-sm-3 col-sm-offset-4">
                                                        <aside class="row">
                                                            <div class="col-md-3 col-sm-3">
                                                                <select class="selectpicker" data-width="100%" name="doctors_cityId" id="doctors_cityId" data-size="4" >
                                                                    <option value="">Select City</option>
<?php
if (isset($qyura_city) && $qyura_city != NULL) {
    foreach ($qyura_city as $key => $val) {
        ?>
                                                                            <option <?php
        if ($doctorDetail[0]->doctors_cityId == $val->city_id) {
            echo "selected";
        }
        ?> value="<?php echo $val->city_id; ?>"><?php echo $val->city_name; ?></option>
                                                                <?php }
                                                            }
                                                            ?>
                                                                </select>
                                                                <label class="error" style="display:none;" id="error-doctors_cityId"> please select a state</label>
                                                                <label class="error" > <?php echo form_error("doctors_cityId"); ?></label>
                                                            </div>
                                                            <div class="col-md-3 col-sm-3 m-t-xs-10">
                                                                <input type="text" class="form-control" id="doctors_pinn" name="doctors_pinn" placeholder="Pin Code" maxlength="6" onkeypress="return isNumberKey(event)" value="<?php
                                                            if (isset($doctorDetail[0]->doctors_pin) && $doctorDetail[0]->doctors_pin != NULL) {
                                                                echo $doctorDetail[0]->doctors_pin;
                                                            }
                                                            ?>" />
                                                                <label class="error" style="display:none;" id="error-doctors_pinn"> Zip code should be numeric and 6 digit long</label>
                                                                <label class="error" > <?php echo form_error("doctors_pinn"); ?></label>
                                                            </div>
                                                        </aside>
                                                    </div>
                                                </article>
                                                <article class="form-group m-lr-0 m-t-10">
                                                    <div class="col-md-4 col-md-offset-3 col-sm-8 col-sm-offset-3">
                                                        <input type="text" class="form-control" id="geocomplete1" name="doctor_addr" placeholder="Address" value="<?php
                                                            if (isset($doctorDetail[0]->doctor_addr) && $doctorDetail[0]->doctor_addr != NULL) {
                                                                echo $doctorDetail[0]->doctor_addr;
                                                            }
                                                            ?>" />
                                                        <label class="error" style="display:none;" id="error-doctor_addr"> please select a pin number</label>
                                                        <label class="error" > <?php echo form_error("doctor_addr"); ?></label>
                                                    </div>
                                                </article>
                                                <article class="clearfix">
                                                    <div class="col-md-8  col-sm-8 col-sm-offset-3">
                                                        <aside class="row">
                                                            <div class="col-sm-3">
                                                                <input name="lat" class="form-control" required="" type="text" value="<?php
                                                            if (isset($doctorDetail[0]->doctors_lat) && $doctorDetail[0]->doctors_lat != NULL) {
                                                                echo $doctorDetail[0]->doctors_lat;
                                                            }
                                                            ?>"  id="lat" placeholder="Latitude" onchange="latChack(this.value)" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="9"/>
                                                                <label class="error" > <?php echo form_error("lat"); ?></label>
                                                                <label class="error" style="display:none;" id="error-lat">Please enter the correct format for latitude</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <input name="lng" required="" type="text" value="<?php
                                                            if (isset($doctorDetail[0]->doctors_long) && $doctorDetail[0]->doctors_long != NULL) {
                                                                echo $doctorDetail[0]->doctors_long;
                                                            }
                                                            ?>"  id="lng" class="form-control" placeholder="Longitude" onChange="lngChack(this.value)" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="9"/>
                                                                <label class="error" > <?php echo form_error("lng"); ?></label>
                                                                <label class="error" style="display:none;" id="error-lng"> Please enter the correct format for longitude</label>
                                                            </div>
                                                        </aside>
                                                    </div>
                                                </article>
                                                <article class="clearfix m-lr-0" >
                                                    <label for="" class="control-label col-md-3 col-sm-3">Docate Id :</label>
                                                    <div class="col-md-4 col-sm-4">

                                                        <input class="form-control" id="docatId" name="docatId" type="text" value="<?php
                                                                   if (isset($doctorDetail[0]->doctors_docatId) && $doctorDetail[0]->doctors_docatId != NULL) {
                                                                       echo $doctorDetail[0]->doctors_docatId;
                                                                   }
                                                            ?>" maxlength="50"/>
                                                        <label class="error" style="display:none;" id="error-docatId"> please enter Docate Id</label>
                                                        <label class="error" > <?php echo form_error("docatId"); ?></label>
                                                    </div>
                                                </article>
                                                <article class="clearfix m-lr-0" >
                                                    <label for="" class="control-label col-md-3 col-sm-3">QAP Id :</label>
                                                    <div class="col-md-4 col-sm-4">

                                                        <input class="form-control" id="qapId" name="qapId" type="text" value="<?php
                                                                   if (isset($doctorDetail[0]->qap_code) && $doctorDetail[0]->qap_code != NULL) {
                                                                       echo $doctorDetail[0]->qap_code;
                                                                   }
                                                            ?>" maxlength="10" onblur="return check_qap()"/>
                                                        <input class="form-control" id="qapIdTb" name="qapIdTb" type="hidden" value="<?php
                                                                   if (isset($doctorDetail[0]->doctors_qapId) && $doctorDetail[0]->doctors_qapId != NULL) {
                                                                       echo $doctorDetail[0]->doctors_qapId;
                                                                   }
                                                            ?>"/>
                                                        <label class="error" style="display:none;" id="error-qapId"> please enter QAP Id</label>
                                                        <label class="error" style="display:none;" id="error-qapIdTb"> please enter Correct QAP Id</label>
                                                        <label class="error" > <?php echo form_error("qapId"); ?></label>
                                                    </div>
                                                </article>
                                                <article class="clearfix m-t-10">
                                                    <label for="cname" class="control-label col-md-3 col-sm-4"> Doctor On Call ? </label>
                                                    <div class="col-md-4 col-sm-5">
                                                        <aside class="radio radio-info radio-inline">

                                                            <input type="radio"  name="doctors_27Src" value="1" id="inlineRadio1" <?php
                                                                   if (isset($doctorDetail[0]->doctors_27Src)) {
                                                                       if ($doctorDetail[0]->doctors_27Src == 1) {
                                                                           echo "checked";
                                                                       }
                                                                   }
                                                            ?> >
                                                            <label for="inlineRadio1"> Yes</label>
                                                        </aside>
                                                        <aside class="radio radio-info radio-inline">

                                                            <input type="radio"  name="doctors_27Src" value="0" id="inlineRadio2" <?php
                                                                   if (isset($doctorDetail[0]->doctors_27Src)) {
                                                                       if ($doctorDetail[0]->doctors_27Src == 0) {
                                                                           echo "checked";
                                                                       }
                                                                   }
                                                            ?> >
                                                            <label for="inlineRadio2"> No</label>
                                                        </aside>
                                                    </div>
                                                </article>
                                                <article class="clearfix m-t-10">
                                                    <label for="cname" class="control-label col-md-3 col-sm-3"> Home Visit ? </label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <aside class="radio radio-info radio-inline">
                                                            <input type="radio" id="inlineRadio5" value="1" name="home_visit" <?php
                                                                   if (isset($doctorDetail[0]->doctors_homeVisit)) {
                                                                       if ($doctorDetail[0]->doctors_homeVisit == 1) {
                                                                           echo "checked";
                                                                       }
                                                                   }
                                                            ?> >
                                                            <label for="inlineRadio5"> Yes</label>
                                                        </aside>
                                                        <aside class="radio radio-info radio-inline">
                                                            <input type="radio" id="inlineRadio6" value="0" name="home_visit" <?php
                                                                   if (isset($doctorDetail[0]->doctors_homeVisit)) {
                                                                       if ($doctorDetail[0]->doctors_homeVisit == 0) {
                                                                           echo "checked";
                                                                       }
                                                                   }
                                                            ?> >
                                                            <label for="inlineRadio6"> No</label>
                                                        </aside>
                                                    </div>
                                                </article>
                                                <article class="clearfix m-t-10">
                                                    <label for="cname" class="control-label col-md-3 col-sm-3">Show experience ?</label>
                                                    <div class="col-md-6 col-sm-6">
                                                        <aside class="radio radio-info radio-inline">
                                                            <input type="radio" id="inlineRadio3" value="1" name="show_exp" <?php
                                                                   if (isset($doctorDetail[0]->doctors_showExp)) {
                                                                       if ($doctorDetail[0]->doctors_showExp == 1) {
                                                                           echo "checked";
                                                                       }
                                                                   }
                                                            ?> >
                                                            <label for="inlineRadio3"> Yes</label>
                                                        </aside>
                                                        <aside class="radio radio-info radio-inline">
                                                            <input type="radio" id="inlineRadio4" value="0" name="show_exp" <?php
                                                                   if (isset($doctorDetail[0]->doctors_showExp)) {
                                                                       if ($doctorDetail[0]->doctors_showExp == 0) {
                                                                           echo "checked";
                                                                       }
                                                                   }
                                                            ?>>
                                                            <label for="inlineRadio4"> No</label>
                                                        </aside>
                                                    </div>
                                                </article>
                                                <article class="clearfix m-t-10">
                                                    <label for="cname" class="control-label col-md-3 m-t-10">Years of Experience</label>
                                                    <div class="col-md-4 col-sm-4 m-b-20 m-t-10">
                                                        <input type="number" class="form-control" name="exp_year" required="" id="exp_year" placeholder="Experience" min="1" max="50" value="<?php echo $years; ?>">
                                                        <label class="error" style="display:none;" id="error-exp_year"> please fill Experience</label>
                                                    </div>
                                                </article>
                                                <section class="clearfix ">
                                                    <div class="col-md-12 m-t-20 m-b-20 text-right">
                                                        <button type="submit" class="btn btn-success waves-effect waves-light  m-r-20" onclick="return doctorDetail()">Submit</button>
                                                    </div>
                                                </section>
                                            </form>
                                        </section>
                                    </div>
                                </div>
                            </section>
                        </section>
                        <!-- General Detail Ends -->
                        <!-- Academic Detail Starts -->
                        <section class="tab-pane fade in <?php
                                                        if ($active_tag == 2) {
                                                            echo "active";
                                                        }
                                                            ?>" id="academic">
                            <div class="clearfix m-t-20 doctor-description">
                                <article class="clearfix">
                                    <aside class="col-sm-8">
                                        <h4>
                                            <button class="btn btn-appointment waves-effect waves-light m-r-10" id="adddegree" title="Add New Degree">
                                                <i class="fa fa-plus"></i> Add  </button>
                                            <button class="btn btn-appointment waves-effect waves-light" id="editdegree" title="Edit Degree">
                                                <i class="fa fa-pencil"></i> Edit </button>
                                        </h4>
                                    </aside>
                                </article>
                                <article class="clearfix m-t-20" id="newdegree" style="display:none">
                                    <form name="addAcademicForm" action="#" id="addAcademicForm" method="post">
                                        <input type="hidden" name="total_add_academic" id="total_add_academic" value="1">
                                        <input type="hidden" id="doctorAjaxId" name="doctorAjaxId" value="<?php
                                                        if (isset($doctorDetail[0]->doctors_id) && $doctorDetail[0]->doctors_id != NULL) {
                                                            echo $doctorDetail[0]->doctors_id;
                                                        }
                                                            ?>" />
                                        <div id="appendAcademicDiv">
                                            <div class="col-sm-6">
                                                <aside class="clearfix m-t-10">
                                                    <select class="selectpicker" data-width="100%" name="degree_addid_1" id="degree_addid_1">
                                                        <option value="">Select Degree</option>
                                                    <?php
                                                           if (isset($qyura_degree) && $qyura_degree != NULL) {
                                                               foreach ($qyura_degree as $degree) {
                                                                   ?>
                                                                <option value="<?php echo $degree->degree_id ?>"><?php echo $degree->degree_SName; ?></option>
    <?php }
}
?>
                                                    </select>
                                                    <label class="error" id="err_degree_addid_1" > <?php echo form_error("degree_addid_1"); ?></label>
                                                </aside>
                                                <aside class="clearfix ">
                                                    <textarea class="form-control" id="acdemic_addaddress_1" name="acdemic_addaddress_1" required="" placeholder="College Address"></textarea>
                                                    <label class="error" id="err_acdemic_addaddress_1" > <?php echo form_error("acdemic_addaddress_1"); ?></label>
                                                </aside>
                                                <aside class="clearfix ">
                                                    <input class="form-control" name="acdemic_addyear_1" required="" id="acdemic_addyear_1" value="" placeholder="Year" maxlength="4">
                                                    <label class="error" id="err_addacdemic_year_1" > <?php echo form_error("acdemic_addyear_1"); ?></label>
                                                </aside>

                                            </div>
                                        </div>
                                        <article class="clearfix m-t-20">
                                            <aside class="col-sm-12 " >
                                                <button class="btn btn-appointment waves-effect waves-light m-t-10" onclick="return checkAcademicYear('addAcademicForm', 'acdemic_addyear_')" type="submit"  >Save</button>
                                            </aside>
                                        </article>
                                    </form>
                                    <button class="btn btn-appointment waves-effect waves-light m-t-10" onclick="addAcademicNumber()">Add New</button>
                                </article>
                                <form name="changeAcademicForm" action="#" id="changeAcademicForm" method="post">
                                    <?php
                                    if (isset($doctorAcademic) && $doctorAcademic != NULL) {
                                        $totalAcademic = count($doctorAcademic);
                                        $acdemicIn = 1;
                                        ?>
                                        <input type="hidden" id="totalAcademic" name="totalAcademic" value="<?php echo $totalAcademic; ?>" >
                                        <input type="hidden" id="doctorAjaxId" name="doctorAjaxId" value="<?php
                                                if (isset($doctorDetail[0]->doctors_id) && $doctorDetail[0]->doctors_id != NULL) {
                                                    echo $doctorDetail[0]->doctors_id;
                                                }
                                        ?>" />
    <?php foreach ($doctorAcademic as $docAcademic) { ?>
                                            <aside class="col-md-6 col-sm-6">
                                                <article class="clearfix m-t-20 degreedetail">
                                                    <h6><?php echo $docAcademic->degreeSmallName; ?><button title="Delete Advertisement" onclick="deleteFn('doctor', 'academicDelete', '<?php echo $docAcademic->academic_id; ?>')" type="button" class="pull-right btn btn-outline btn-xs "><img src="<?php echo base_url(); ?>/assets/images/delete.png"></button></h6>
                                                    <p><?php echo $docAcademic->degreeFullName; ?></p>
                                                    <p><?php echo $docAcademic->degreeInsAddress; ?></p>
                                                    <p><?php echo $docAcademic->degreeYear; ?></p>
                                                </article>
                                                <article class="clearfix m-t-20">
                                                    <div class="col-sm-9 detailnew" style="display:none">
                                                        <input type="hidden" name="academic_id_<?php echo $acdemicIn; ?>" id="academic_id_<?php echo $acdemicIn; ?>" value="<?php echo $docAcademic->academic_id; ?>" >
                                                        <aside class="clearfix m-t-10">
                                                            <select class="selectpicker" data-width="100%" name="degree_id_<?php echo $acdemicIn; ?>" id="degree_id_<?php echo $acdemicIn; ?>">
                                                                <option value="">Select Degree</option>
                                                                   <?php
                                                                   if (isset($qyura_degree) && $qyura_degree != NULL) {
                                                                       foreach ($qyura_degree as $degree) {
                                                                           ?>
                                                                        <option <?php
                                                                           if ($docAcademic->degreeId == $degree->degree_id) {
                                                                               echo "selected";
                                                                           }
                                                                           ?> value="<?php echo $degree->degree_id ?>"><?php echo $degree->degree_SName; ?></option>
                                                                <?php }
                                                            }
                                                            ?>
                                                            </select>
                                                            <label class="error" id="err_degree_id_<?php echo $acdemicIn; ?>" > <?php echo form_error("degree_id_" . $acdemicIn); ?></label>
                                                        </aside>
                                                        <aside class="clearfix m-t-10">
                                                            <textarea class="form-control customAddress" id="acdemic_address_<?php echo $acdemicIn; ?>" name="acdemic_address_<?php echo $acdemicIn; ?>" required=""><?php echo $docAcademic->degreeInsAddress; ?></textarea>
                                                            <label class="error" id="err_acdemic_address_<?php echo $acdemicIn; ?>" > <?php echo form_error("acdemic_address_" . $acdemicIn); ?></label>
                                                        </aside>
                                                        <aside class="clearfix m-t-10">
                                                            <input class="form-control" name="acdemic_year_<?php echo $acdemicIn; ?>" required="" id="acdemic_year_<?php echo $acdemicIn; ?>" value="<?php echo $docAcademic->degreeYear; ?>" maxlength="4">
                                                            <label class="error" id="err_acdemic_year_<?php echo $acdemicIn; ?>" > <?php echo form_error("acdemic_year_" . $acdemicIn); ?></label>
                                                        </aside>
                                                    </div>
                                                </article>
                                            </aside>
                                <?php $acdemicIn++;
                            }
                            ?>
                                        <article class="clearfix m-t-20">
                                            <aside class="col-sm-12 detailnew" style="display:none">
                                                <button  class="btn btn-appointment waves-effect waves-light" onclick="return checkAcademicYear('changeAcademicForm', 'acdemic_year_')" type="submit" >Update</button>
                                            </aside>
                                        </article>
<?php } ?>
                                </form>
                            </div>
                        </section>
                        <!-- Academic Detail Ends -->

                        <!-- Experience Starts -->
                        <section class="tab-pane fade in <?php
if ($active_tag == 3) {
    echo "active";
}
?>" id="experience">
                            <div class="clearfix m-t-20 doctor-description">
                                <article class="clearfix">
                                    <aside class="col-sm-8">
                                        <h4>
                                            <button class="btn btn-appointment waves-effect waves-light m-r-10" id="addexp" title="Add New Experience">
                                                <i class="fa fa-plus"></i> Add  </button>
                                            <button class="btn btn-appointment waves-effect waves-light" id="editexp" title="Edit Experience">
                                                <i class="fa fa-pencil"></i> Edit </button>
                                        </h4>
                                    </aside>
                                </article>
                                <section class="clearfix m-t-20">
                                    <aside class="col-md-6 col-sm-6">
                                        <article class="clearfix m-t-20">
                                            <div id="newexp" style="display:none">
                                                <form name="addServicesForm" action="#" id="addServicesForm" method="post">
                                                    <input type="hidden" id="doctorAjaxId" name="doctorAjaxId" value="<?php
if (isset($doctorDetail[0]->doctors_id) && $doctorDetail[0]->doctors_id != NULL) {
    echo $doctorDetail[0]->doctors_id;
}
?>" />
                                                    <div id="expDiv">
                                                        <article class="form-group m-lr-0" id="doctorService">
                                                            <label for="" class="control-label col-md-4 col-sm-4">Doctor Services :</label>
                                                            <div class="col-md-6 col-sm-6">
                                                                <input type="hidden" id="totalService" name="totalService" value="1">
                                                                <input class="form-control" id="doctors_service_1" name="doctors_service_1" type="text" value="<?php echo set_value('doctors_service_1'); ?>" maxlength="50"/>
                                                                <label class="error" style="display:none;" id="error-doctors_service"> please enter Service</label>
                                                                <label class="error" > <?php echo form_error("doctors_service_1"); ?></label>
                                                            </div>
                                                        </article>
                                                    </div>
                                                    <article class="clearfix m-t-20">
                                                        <aside class="col-sm-12 m-t-10" >
                                                            <button type="submit" class="btn btn-appointment waves-effect waves-light">Save</button>
                                                        </aside>
                                                    </article>
                                                </form>
                                                <article class="form-group m-lr-0">
                                                    <div class="col-md-8 ">
                                                        <button class="btn btn-success waves-effect waves-light m-r-20" type="button" onclick="multipleService()">Add More</button>
                                                    </div>
                                                </article>
                                            </div>
                                        </article>
                                    </aside>
                                </section>

                                <div class="col-md-12">
<?php
if (isset($qyura_services) && $qyura_services != NULL) {
    foreach ($qyura_services as $services) {
        ?>
                                            <div class="col-md-6">
                                                <article class="clerfix detailexp">
                                                    <h6><?php
        if (isset($services->doctorServices_serviceName) && $services->doctorServices_serviceName != NULL) {
            echo $services->doctorServices_serviceName;
        }
        ?><button title="Delete Service" onclick="deleteFn('doctor', 'serviceDelete', '<?php echo $services->doctorServices_id; ?>')" type="button" class="pull-right btn btn-outline btn-xs "><img src="<?php echo base_url(); ?>/assets/images/delete.png"></button></h6>
                                                </article>
                                            </div>
    <?php }
}
?>
                                </div>

                                <aside class="col-md-12 col-sm-12">
                                    <section class="clearfix">
                                        <article class="clearfix m-t-20">
                                            <div class="col-sm-9 detailexpnew" style="display:none">
                                                <form name="editServiceForm" action="#" id="editServiceForm" method="post">
<?php
if (isset($qyura_services) && $qyura_services != NULL) {
    $countEdit = 1;
    $doctor_edit_count = count($qyura_services);
    ?>
                                                        <input type="hidden" name="total_edit_services" id="total_edit_services" value="<?php echo $doctor_edit_count; ?>">
                                                        <input type="hidden" id="doctorAjaxId" name="doctorAjaxId" value="<?php
    if (isset($doctorDetail[0]->doctors_id) && $doctorDetail[0]->doctors_id != NULL) {
        echo $doctorDetail[0]->doctors_id;
    }
    ?>" />
    <?php foreach ($qyura_services as $services) { ?>
                                                            <input type="hidden" name="doctorServices_id_<?php echo $countEdit; ?>" id="doctorServices_id_<?php echo $countEdit; ?>" value="<?php echo $services->doctorServices_id; ?>">

                                                            <aside class="clearfix m-t-10 col-md-6">
                                                                <input class="form-control" name="services_name_edit_<?php echo $countEdit; ?>" id="services_name_edit_<?php echo $countEdit; ?>" required="" value="<?php echo $services->doctorServices_serviceName; ?>" placeholder="Services">
                                                                <label class="error" id="err_services_name_edit_<?php echo $countEdit; ?>" > <?php echo form_error("services_name_edit_" . $countEdit); ?></label>
                                                            </aside>
        <?php
        $countEdit++;
    }
}
?>
                                                    <article class="clearfix m-t-20">
                                                        <aside class="col-sm-12 detailexpnew" style="display:none">
                                                            <button type="submit" class="btn btn-appointment waves-effect waves-light m-r-10">Update</button>
                                                        </aside>
                                                    </article>
                                                </form>
                                            </div>
                                        </article>
                                    </section>
                                </aside>
                            </div>
                        </section>
                        <!-- Experience Ends -->
                        <!-- Appointment History Starts -->
                        <section class="tab-pane fade in <?php
if ($active_tag == 4) {
    echo "active";
}
?>" id="appointment">
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
                        <section class="tab-pane fade in <?php
                                 if ($active_tag == 5) {
                                     echo "active";
                                 }
?>" id="account">
                            <div class="clearfix m-t-20 p-b-20 doctor-description">   
                                <article class="clearfix">
                                    <aside class="col-sm-8 setting">
                                        <h4>Account Detail
                                            <a id="editaccount" class="pull-right cl-pencil">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </h4>
                                        <hr/>
                                    </aside>
                                </article>
                                <section id="detailaccount">
                                    <article class="clearfix m-t-10">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Registered Email Id :</label>
                                        <p class="col-md-8 col-sm-8"><?php
                                 if (isset($doctorDetail[0]->users_email) && $doctorDetail[0]->users_email != NULL) {
                                     echo $doctorDetail[0]->users_email;
                                 }
?></p>
                                    </article>
                                    <article class="clearfix m-t-10">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Registered Mobile Number:</label>
                                        <p class="col-md-8 col-sm-8">+91 <?php
                                 if (isset($doctorDetail[0]->doctors_registeredMblNo) && $doctorDetail[0]->doctors_registeredMblNo != NULL) {
                                     echo $doctorDetail[0]->doctors_registeredMblNo;
                                 }
?></p>
                                    </article>
                                    <article class="clearfix m-t-10">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Change Password:</label>
                                    </article>
                                </section>
                                <section id="newdetailaccount" style="display:none">
                                    <form name="changePasswordForm" action="#" id="changePasswordForm" method="post">
                                        <input type="hidden" id="user_id" name="user_id" value="<?php
                                 if (isset($doctorDetail[0]->doctors_userId) && $doctorDetail[0]->doctors_userId != NULL) {
                                     echo $doctorDetail[0]->doctors_userId;
                                 }
?>" />
                                        <input type="hidden" id="doctorAjaxId" name="doctorAjaxId" value="<?php
                                 if (isset($doctorDetail[0]->doctors_id) && $doctorDetail[0]->doctors_id != NULL) {
                                     echo $doctorDetail[0]->doctors_id;
                                 }
?>" />
                                        <article class="clearfix m-t-10">
                                            <label for="cemail" class="control-label col-md-4 col-sm-4">Registered Email Id :</label>
                                            <aside class="col-md-4 col-sm-4">
                                                <input type="email" class="form-control" name="registered_email" id="registered_email" value="<?php
                                 if (isset($doctorDetail[0]->users_email) && $doctorDetail[0]->users_email != NULL) {
                                     echo $doctorDetail[0]->users_email;
                                 }
?>" >
                                                <label class="error" id="err_registered_email" > <?php echo form_error("registered_email"); ?></label>
                                            </aside>
                                        </article>
                                        <article class="clearfix m-t-10">
                                            <label for="cemail" class="control-label col-md-4 col-sm-4">Registered Mobile Number:</label>
                                            <aside class="col-md-4 col-sm-4">
                                                <input type="text" class="form-control" id="register_mobile" name="register_mobile" value="<?php
                                 if (isset($doctorDetail[0]->doctors_registeredMblNo) && $doctorDetail[0]->doctors_registeredMblNo != NULL) {
                                     echo $doctorDetail[0]->doctors_registeredMblNo;
                                 }
?>" onkeypress="return isNumberKey(event)">
                                                <label class="error" id="err_register_mobile" > <?php echo form_error("register_mobile"); ?></label>
                                            </aside>
                                        </article>
                                        <article class="clearfix m-t-10">
                                            <label for="cemail" class="control-label col-md-4 col-sm-4">Change Password:</label>
                                            <aside class="col-md-4 col-sm-4">
                                                <input type="password" name="password" id="password" class="form-control" placeholder="New Password" />
                                                <label class="error" id="err_password" > <?php echo form_error("password"); ?></label>
                                            </aside>
                                        </article>
                                        <article class="clearfix m-t-10">
                                            <label for="cemail" class="control-label col-md-4 col-sm-4">Confirm Password:</label>
                                            <aside class="col-md-4 col-sm-4">
                                                <input type="password" name="confirm" id="confirm" class="form-control" placeholder="Confirm Password" />
                                                <label class="error" id="err_confirm" > <?php echo form_error("confirm"); ?></label>
                                            </aside>
                                        </article>
                                        <section class="clearfix ">
                                            <div class="m-t-20 m-b-20">
                                                <button type="submit" hospitalsclass="btn btn-success waves-effect waves-light  m-r-20">Submit</button>
                                            </div>
                                        </section>
                                    </form>
                                </section>
                            </div>
                        </section>
                        <!-- Account Detail Ends -->
                        <!-- Timeslot Starts Section -->

                        <!-- Timeslot Starts Section -->
                        <section class="tab-pane fade in <?php
                                 if ($active_tag == 4) {
                                     echo "active";
                                 }
?>" id="timeslot">
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
                                            </figure>

 

                                            <div class="nicescroll" style="overflow: scroll; max-height:400px;" tabindex="5004">
                                                <div class="clearfix">
                                                    <!--                                                    <div class="clearfix m-t-20 text-center" style="width:1600px">-->
                                                    <div class="clearfix m-t-20 text-center" style="width:1600px">
                                                        <!-- outer  din start -->
                                                        <?php foreach($timeSloats as $day => $sloats){ ?>
                                                        <div class="clearfix m-t-20 text-center">
                                                            <section class="col-md-2" style="max-width:150px;">
                                                                <aside class="checkbox checkbox-success text-left">
                                                                    <input type="checkbox" id="checkbox3">
                                                                    <label for="checkbox3">
                                                                        <?php echo $day; ?>
                                                                    </label>
                                                                </aside>
                                                            </section>
                                                            <div class="col-md-10">

                                                                <article class="effects effect-1  clearfix ">
                                                                    <!-- inner taric -->
                                                                    <?php foreach ($sloats as $sloat) { ?>
                                                                    <div style="" data-toggle="tooltip" data-placement="right" data-html="true" title="<h4><?php echo ucfirst($sloat->doctors_fName).' '.ucfirst($sloat->doctors_lName); ?></h4><p><b>Address:</b><?php echo $sloat->address; ?></p><p><b>Consulting Fee:</b> <?php echo $sloat->price; ?></p>" class="blue-ttl img">

                                <div class="clearfix">
                                    <h4><?php echo date('h:i A',strtotime($sloat->open)); ?></h4>
                                    <h4><?php echo date('h:i A',strtotime($sloat->close)); ?></h4>
                                </div>
                                <div class="overlay1">
                                    <?php echo $sloat->docTimeTableId; ?>
                                    <?php echo $sloat->doctorId; ?>
                                    <?php echo $sloat->docTimeDayId; ?>
                                    <?php echo $sloat->day; ?>
                                    <a href="javascript:void(0)" onclick="editTimeSloatView('<?php echo $sloat->docTimeTableId ?>','<?php echo $sloat->doctorId ?>','<?php echo $sloat->docTimeDayId ?>','<?php echo $sloat->day ?>')"  class="expand" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <!-- <a class="close-overlay hidden">x</a> -->
                                </div>
                                                                    </div>
                                                                    <?php } ?>
                                                                    <!-- inner taric samapt -->
                                                                </article>

                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                        <!-- outer  din samapt -->
                                                        
                                                        </div>
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
                                                                    <div id="formDabba" class="col-sm-12">
                                                                        <form  class="cmxform form-horizontal tasi-form avatar-form" id="timeForm" name="addDoctorSlot" method="post" action="#" novalidate="novalidate">
                                                                            <article class="clearfix m-t-10">
                                                                                <label class="control-label" for="docTimeTable_stayAt">Seating Place Type:</label>
                                                                                <div class="">
                                                                                    <input type="hidden" name="doctorId" id="" value="<?php echo $doctorId; ?>" />
                                                                                    <aside class="radio radio-info radio-inline">
                                                                                        <input type="radio"  required="" name="docTimeTable_stayAt" value="1" class="docTimeTable_stayAt" onclick="placeDetail(this.value)" >
                                                                                        <label for="inlineRadio1"> MI Place</label>
                                                                                    </aside>
                                                                                    <aside class="radio radio-info radio-inline">
                                                                                        <input type="radio" required="" name="docTimeTable_stayAt" value="0" class="docTimeTable_stayAt" onclick="placeDetail(this.value)" >
                                                                                        <label for="inlineRadio2"> Personal Chamber</label>
                                                                                    </aside>
                                                                                    <label id="err_docTimeTable_stayAt" class="error"><?php echo form_error("psChamber_name"); ?></label>
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
                                                                                    <label id="err_docTimeTable_MItype" class="error"><?php echo form_error("docTimeTable_MItype"); ?></label>
                                                                                </div>

                                                                            </article>
                                                                            <article class="clearfix m-t-10" id="div_docTimeTable_HprofileId">
                                                                                <label class="control-label" for="docTimeTable_MIprofileId_h">Hospital Name:</label>
                                                                                <div class="">

                                                                                        <?php $hospitals[] = (object) array('hospital_id' => 0, 'hospital_name' => 'Other') ?>
                                                                                    <select class="m-t-5 select2" data-width="100%" name="docTimeTable_MIprofileId_h" id="docTimeTable_MIprofileId_h" onchange="getMIdetail(this.value)" >
                                                                                        <option value="">-- Select Hospital --</option>
                                                                                        <?php
                                                                                        if (!empty($hospitals)) {
                                                                                            foreach ($hospitals as $key => $val) {
                                                                                                ?>
                                                                                                <option <?php echo set_select('hospital_id', $val->hospital_id); ?> value="<?php echo $val->hospital_id; ?>"> <?php echo $val->hospital_name; ?></option>
        <?php
    }
}
?>

                                                                                    </select>

                                                                                    <label id="err_docTimeTable_MIprofileId_h" class="error"><?php echo form_error("docTimeTable_MIprofileId_h"); ?></label>
                                                                                </div>
                                                                            </article>
                                                                            <article class="clearfix m-t-10" id="div_docTimeTable_DprofileId">
                                                                                <label class="control-label" for="docTimeTable_MIprofileId_d">Diagnostic Name:</label>
                                                                                <div class="">

<?php $diagnostics[] = (object) array('diagnostic_id' => 0, 'diagnostic_name' => 'Other') ?>
                                                                                    <select class="m-t-5 select2" data-width="100%" onchange="getMIdetail(this.value)" name="docTimeTable_MIprofileId_d" id="docTimeTable_MIprofileId_d">

                                                                                        <option value="">-- Select Diagnostic --</option>
<?php
if (!empty($diagnostics)) {

    foreach ($diagnostics as $key => $val) {
        ?>
                                                                                                <option <?php echo set_select('diagnostic_id', $val->diagnostic_id); ?> value="<?php echo $val->diagnostic_id; ?>"> <?php echo $val->diagnostic_name; ?></option>
        <?php
    }
}
?>
                                                                                        ?>
                                                                                        <option value="0">Other</option>
                                                                                    </select>
                                                                                    <label id="err_docTimeTable_MIprofileId_d" class="error"><?php echo form_error("docTimeTable_MIprofileId_d"); ?></label>
                                                                                </div>
                                                                            </article>
<!--                                                                            <article class="clearfix" id="div_Mi_name">
                                                                                <label class="control-label" for="Mi_name">MI Name:</label>
                                                                                <div class="">
                                                                                    <input type="text" name="Mi_name" id="Mi_name" class="form-control" placeholder="MI Name" value="<?php echo set_value('Mi_name'); ?>">
                                                                                    <label id="err_Mi_name" class="error"><?php echo form_error("Mi_name"); ?></label>
                                                                                </div>
                                                                            </article>-->
                                                                            <article class="clearfix m-t-10 " id="div_psChamber_name">
                                                                                <label class="control-label" for="psChamber_name">Personal Chamber Name:</label>
                                                                                <div class="">
                                                                                    <input type="text" name="psChamber_name" id="psChamber_name" class="form-control"  value="<?php echo set_value('psChamber_name'); ?>">
                                                                                    <label id="err_psChamber_name" class="error"><?php echo form_error("psChamber_name"); ?></label>
                                                                                </div>
                                                                            </article>
                                                                            <article>
                                                                                <aside class="row">
                                                                                </aside>
                                                                            </article>

                                                                            <article class="clearfix" id="div_address">

                                                                                <div class="">
                                                                                    <div id="Miname_div" style="display: block">
                                                                                        <aside class="row">
                                                                                            <div class="col-md-12">

                                                                                                <label for="cname" class="control-label">MI Name:</label>
                                                                                                <input type="text" value="" style="display:none;" placeholder="Mi Name" name="Miname" id="Miname" class="form-control" readonly="readonly">
                                                                                                <label class="error" style="display:none;" id="error-Miname"> Zip code should be numeric and 6 digit long</label>
                                                                                                <label id="err_Miname" class="error" > <?php echo form_error("Miname"); ?></label>
                                                                                            </div>

                                                                                        </aside>
                                                                                    </div>
                                                                                    <aside class="row">
                                                                                        <div class="col-md-6 col-sm-6">
                                                                                            <select class="selectpicker" onchange="fetchStates()" data-width="100%" name="countryId" id="timeCountryId">
                                                                                                <option value="">Select Country</option>
                                                                                                <option value="1">India</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                                                            <select class="selectpicker" data-width="100%" name="stateId" Id="stateId" data-size="4" onchange ="fetchCity(this.value)">
                                                                                                <option value="">Select State</option>
<?php foreach ($allStates as $key => $val) { ?>
                                                                                                    <option value="<?php echo $val->state_id; ?>"><?php echo $val->state_statename; ?></option>
<?php } ?>
                                                                                            </select>
                                                                                            <label class="error" style="display:none;" id="error-stateId"> please select a state</label>
                                                                                            <label id="err_stateId" class="error"><?php echo form_error("stateId"); ?></label>
                                                                                        </div>
                                                                                    </aside>
                                                                                    <aside class="row">
                                                                                        <div class="col-md-6 col-sm-6">
                                                                                            <select class="selectpicker" data-width="100%" name="cityId" id="timeCityId" data-size="4" >
                                                                                            </select>
                                                                                            <label class="error" style="display:none;" id="error-cityId"> please select a state</label>
                                                                                            <label id="err_cityId" class="error" > <?php echo form_error("cityId"); ?></label>
                                                                                        </div>
                                                                                        <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                                                            <input type="text" class="form-control" id="pinn" name="pinn" placeholder="Pin Code" maxlength="6" onkeypress="return isNumberKey(event)" value="<?php echo set_value('pinn'); ?>" />
                                                                                            <label class="error" style="display:none;" id="error-pinn"> Zip code should be numeric and 6 digit long</label>
                                                                                            <label id="err_pinn" class="error" > <?php echo form_error("pinn"); ?></label>
                                                                                        </div>

                                                                                    </aside>
                                                                                    <aside class="row">
                                                                                        <input type="hidden" id="isAddressDisabled" name="isAddressDisabled" value="<?php
if (isset($MiId) && $MiId != 0) {
    echo 1;
} else {
    echo 0;
}
?>" />
                                                                                        <div class="col-md-12">
                                                                                            <input type="text" class="form-control" id="addr" name="addr" placeholder="Address" value="<?php echo set_value('doctor_addr'); ?>" />
                                                                                            <label id="err_addr" class="error" > <?php echo form_error("addr"); ?></label>
                                                                                        </div>
                                                                                    </aside>



                                                                                    <aside class="row">
                                                                                        <div class="col-sm-6">
                                                                                            <input name="lat" class="form-control" required="" type="text" value=""  id="mi_lat" placeholder="Latitude" onchange="latChack(this.value)" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="9"/>
                                                                                            <label id="err_lat" class="error" > <?php echo form_error("lat"); ?></label>
                                                                                            <label class="error" style="display:none;" id="error-mi_lat">Please enter the correct format for latitude</label>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <input name="lng" required="" type="text" value=""  id="mi_lng" class="form-control" placeholder="Longitude" onChange="lngChack(this.value)" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="9"/>
                                                                                            <label id="err_lng" class="error" > <?php echo form_error("lng"); ?></label>
                                                                                            <label class="error" style="display:none;" id="error-mi_lng"> Please enter the correct format for longitude</label>

                                                                                        </div>
                                                                                    </aside>

                                                                                </div>
                                                                            </article>
                                                                            <article class="clearfix">
                                                                                <label class="control-label" for="docTimeDay_day">Weekdays:</label>
                                                                                <div class="">
                                                                                    <select class="m-t-5 select2" data-width="100%" name="docTimeDay_day[]" id="docTimeDay_day" multiple="">
<?php
$days = getDay();
if (isset($days) && $days != NULL) {
    foreach ($days as $d => $dayName) {
        ?>
                                                                                                <option value="<?php echo $dayName ?>"><?php echo $d ?></option>
    <?php
    }
}
?>
                                                                                    </select>
                                                                                </div>
                                                                                <label id="err_docTimeDay_day" class="error" > <?php echo form_error("docTimeDay_day"); ?></label>
                                                                                <div class="">
                                                                                    <aside class="checkbox checkbox-success m-t-5">
                                                                                        <input type="checkbox" id="selectAllDay" name="selectAllDay" class="" >
                                                                                        <label> Select All Days</label>
                                                                                    </aside>

                                                                                </div>
                                                                                <label id="err_day" class="error" > <?php echo form_error("day"); ?></label>
                                                                            </article>
                                                                            <article class="clearfix  m-t-10">
                                                                                <div class="">
                                                                                    <aside class="row">
                                                                                        <div class="col-sm-6">
                                                                                            <input name="openingHour" class="form-control" required="" type="text" value="<?php echo set_value('openingHour'); ?>"  id="lat"   placeholder="opening Hour" />
                                                                                            <label id="err_openingHour" class="error" > <?php echo form_error("openingHour"); ?></label>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <input name="closeingHour" required="" type="text" value="<?php echo set_value('closeingHour'); ?>"  id="closeingHour"  class="form-control" placeholder="closing Hour"  maxlength="9"/>
                                                                                            <label id="err_closeingHour" class="error" > <?php echo form_error("closeingHour"); ?></label>

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
                                                                                    <label id="err_fees" class="error" > <?php echo form_error("fees"); ?></label>
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
