<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container row">
            <!-- consultation -->
            <div style="display:show;" id="consultDiv">
                <div class="clearfix">
                    <div class="col-md-12">
                        <h3 class="pull-left page-title">Add User</h3>
                    </div>
                </div>
                <form class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" method="post" action="#" novalidate="novalidate" enctype="multipart/form-data">
                    <!-- Left Section Start -->
                    <section class="col-md-6 detailbox">
                        <div class="bg-white mi-form-section">
                            <figure class="clearfix">
                                <h3>General Detail</h3>
                            </figure>
                            <!-- Table Section End -->
                            <div class="clearfix m-t-20">
                                <article class="form-group m-lr-0 ">
                                    <label for="cemail" class="control-label col-md-4 col-sm-4">User Id :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control disabled" id="patientDetails_unqId" name="patientDetails_unqId"  aria-required="true" value="<?php if (isset($usersCode) && !empty($usersCode)) {
    echo $usersCode;
}; ?>" placeholder="" readonly>
                                    </div>
                                </article>
                                <article class="clearfix m-t-10" id="crop-avatar">
                                    <div id="upload_modal_form">
<?php $this->load->view('upload_crop_modal'); ?>
                                    </div>
                                    <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                                    <div class="col-md-8 col-sm-8" data-target="#modal" data-toggle="modal">
                                        <label class="col-md-4 col-sm-4" for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x avatar-view"></i></label>
                                        <div class="pre col-md-4 col-sm-4 ">
                                            <div id="preImgLogo" class="avatar-preview preview-md preImgLogo">
                                                <img src="<?php echo base_url() ?>assets/default-images/Doctor-logo.png"  class="image-preview-show"/>
                                            </div>
                                        </div>
                                        <div id="error-label" class="error-label"></div>

                                        <span class="error" > <?php echo form_error("avatar_file"); ?></span>
                                        <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                                    </div>
                                    <span style="color: #EF5350; display: none" id="error-avatarInput">Please upload an image!</span>
                                </article>
                                <article class="form-group m-lr-0">
                                    <label for="" class="control-label col-md-4 col-sm-4"> Name :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control " id="patientDetails_patientName" type="text" name="patientDetails_patientName" required="" value="<?php echo set_value('patientDetails_patientName'); ?>">
                                        <label class="error" id="err_patientDetails_patientName"> <?php echo form_error("patientDetails_patientName"); ?></label>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Gender :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <select class="select2" data-width="100%" name="patientDetails_gender">
                                            <option value="">Select Gender</option>
                                            <option value="1"  <?php echo set_select('patientDetails_gender', '1'); ?>>Male</option>
                                            <option value="2" <?php echo set_select('patientDetails_gender', '2'); ?>>Female</option>
                                            <option value="3" <?php echo set_select('patientDetails_gender', '3'); ?>>Other</option>
                                        </select>
                                        <span class="error" id="err_patientDetails_gender" > <?php echo form_error("patientDetails_gender"); ?></span>
                                        <div id="error_patientDetails_gender" class="error_patientDetails_gender"></div>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Date of Birth :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <div class="input-group">
                                            <input class="form-control dob" placeholder="mm/dd/yyyy" id="patientDetails_dob" type="text" name="patientDetails_dob" onkeydown="return false;" value="<?php echo set_value('patientDetails_dob'); ?>">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        </div>

                                    </div>
                                    <label class="error" id="err_patientDetails_dob" > <?php echo form_error("patientDetails_dob"); ?></label>
                                </article>
                                <article class="form-group m-lr-0">
                                    <label for="" class="control-label col-md-4 col-sm-4">Email Id:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control " id="users_email" type="email" name="users_email" placeholder="" value="<?php echo set_value('users_email'); ?>">
                                        <input type="hidden" class="form-control" id="users_email_status" name="users_email_status" value="" />
                                        <span class="error" id="err_users_email" > <?php echo form_error("users_email"); ?></span>
                                      
                                        <div class="error" style="display:none;" id="erroremail_check"> User Email Already Exists!</div>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Phone:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <aside class="row">
                                            <div class="col-md-12 col-sm-4 col-xs-10 m-t-xs-10 ">
                                                <input type="text" class="form-control" name="patientDetails_mobileNo" id="patientDetails_mobileNo" maxlength="10" placeholder="Number" onkeypress="return isNumberKey(event)" value="<?php echo set_value('patientDetails_mobileNo'); ?>"/>
                                                <input type="hidden" class="form-control" id="users_mobile_status" name="users_mobile_status" value="" />

                                                <span class="error" id="err_patientDetails_mobileNo" > <?php echo form_error("patientDetails_mobileNo"); ?></span>
                                               
                                                <div class="error" style="display:none;" id="error-mobile_check"> User Mobile Number Already Exists!</div>


                                            </div>
                                        </aside>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0 m-t-30">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Address:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <aside class="row">
                                            <div class="col-md-6 col-sm-6">
                                                <select class="select2" data-width="100%" name="patientDetails_countryId" id="patientDetails_countryId">
                                                    <option value="1">India</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                <select class="select2" data-width="100%" name="patientDetails_stateId" Id="	patientDetails_stateId" data-size="4" onchange ="fetchCity(this.value)">
                                                    <option value="">Select State</option>
                                                    <?php foreach ($allStates as $key => $val) { ?>
                                                        <option value="<?php echo $val->state_id; ?>" <?php echo set_select('patientDetails_stateId', $val->state_id); ?>><?php echo $val->state_statename; ?></option>
<?php } ?>
                                                </select>
                                                <span class="error" id="err_patientDetails_stateId" > <?php echo form_error("patientDetails_stateId"); ?></span>
                                                <div id="error_patientDetails_stateId" class="error_patientDetails_stateId"></div>
                                            </div>
                                        </aside>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">
                                    <div class="col-md-8 col-md-offset-4 col-sm-4 col-sm-offset-4">
                                        <aside class="row">
                                            <div class="col-md-6 col-sm-6">
                                                <select class="select2" data-width="100%" name="patientDetails_cityId" id="patientDetails_cityId" data-size="4" >
                                                </select>
                                                <span class="error" id="err_patientDetails_cityId" > <?php echo form_error("patientDetails_cityId"); ?></span>
                                                <div id="error_patientDetails_cityId" class="error_patientDetails_cityId"></div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                <input type="text" class="form-control" id="patientDetails_pin" name="patientDetails_pin" placeholder="Pin Code" maxlength="6" onkeypress="return isNumberKey(event)" value="<?php echo set_value('patientDetails_pin'); ?>" />
                                                <span class="error" id="err_patientDetails_pin" > <?php echo form_error("patientDetails_pin"); ?></span>
                                            </div>
                                        </aside>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0 m-t-xs-10">
                                    <div class="col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4">
                                        <input type="text" class="form-control" id="patientDetails_address" name="patientDetails_address" value="<?php echo set_value('patientDetails_address') ?>" placeholder="Address"/>
                                        <span class="error" id="err_patientDetails_address" > <?php echo form_error("patientDetails_address"); ?></span>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Enter Password :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input type="password" class="form-control" id="users_password" name="users_password" minlength="4"/>
                                        <span class="error" id="err_users_password" > <?php echo form_error("users_password"); ?></span>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Confirm Password :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input type="password" class="form-control" id="cnfPassword" name="cnfPassword" placeholder=" " />
                                        <span class="error" id="err_cnfPassword" > <?php echo form_error("cnfPassword"); ?></span>
                                    </div>
                                </article>
                            </div>
                            <!-- .form -->
                        </div>
                    </section>
                    <!-- Left Section End -->

                    <!-- Right Section Start -->
                    <section class="col-md-6 detailbox mi-form-section">
                        <div class="bg-white clearfix">
                            <!--Health Insurance  Start -->
                            <figure class="clearfix">
                                <h3>Health Insurance Detail</h3>
                            </figure>
                            <aside class="clearfix m-t-20">
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Have Health Insurance ?</label>
                                    <div class="col-md-8 col-sm-8">
                                        <div class="radio radio-success radio-inline">
                                            <input type="radio" name="healthInsurance1" value="1" id="inlineRadio1" onchange="insuranceShowHide('1', 'insuranceDiv')">
                                            <label for="inlineRadio1">Yes</label>
                                        </div>
                                        <div class="radio radio-success radio-inline">
                                            <input type="radio" checked="" name="healthInsurance1" value="0" id="inlineRadio2" onchange="insuranceShowHide('0', 'insuranceDiv')">
                                            <label for="inlineRadio2">No</label>
                                        </div>
                                    </div>
                                </article>
                                <div style="display:none" id="insuranceDiv">
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Health Insura. Company:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="select2" data-width="100%" name="userInsurance_insuranceId">
                                                <option value=""> Select Insurance</option>
                                                <?php foreach ($insurance_cmpny as $key => $val) { ?>
                                                    <option value="<?php echo $val->insurance_id; ?>" <?php echo set_select('patientDetails_stateId', $val->insurance_id); ?>><?php echo $val->insurance_Name; ?></option>
<?php } ?>
                                            </select>
                                            <span class="error" id="err_userInsurance_insuranceId" > <?php echo form_error("userInsurance_insuranceId"); ?></span>
                                            <div id="error_userInsurance_insuranceId" class="error_userInsurance_insuranceId"></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="" class="control-label col-md-4 col-sm-4">Health Insura. Card no. :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control " id="userInsurance_insuranceNo" type="text" name="userInsurance_insuranceNo" value="<?php echo set_value('userInsurance_insuranceNo'); ?>"  />
                                            <span class="error" id="err_userInsurance_insuranceNo" > <?php echo form_error("userInsurance_insuranceNo"); ?></span>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Policy Expiry Date :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <div class="input-group">
                                                <input class="form-control pickDatePolicy" id="userInsurance_expDate" placeholder="mm/dd/yyyy" type="text" value="<?php echo set_value('userInsurance_expDate'); ?>" name="userInsurance_expDate" onkeydown="return false;">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span></div>
                                            <span class="error" id="err_userInsurance_expDate" > <?php echo form_error("userInsurance_expDate"); ?></span>

                                        </div>

                                    </article>
                                </div>
                                <!--Health Insuranse End -->
                                <!--Family Section Start -->

                                <figure class="clearfix">
                                    <h3>Add Family Members :</h3>
                                </figure>
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Add Family Members ?</label>
                                    <div class="col-md-8 col-sm-8">
                                        <div class="radio radio-success radio-inline">
                                            <input type="radio" name="addFamilyMember" value="1" id="inlineRadioF1" onchange="insuranceShowHide('1', 'addFamilyDiv')">
                                            <label for="inlineRadioF1">Yes</label>
                                        </div>
                                        <div class="radio radio-success radio-inline">
                                            <input type="radio" checked="" name="addFamilyMember" value="0" id="inlineRadioF2" onchange="insuranceShowHide('0', 'addFamilyDiv')">
                                            <label for="inlineRadioF2">No</label>
                                        </div>
                                    </div>
                                </article>
                                <div id="addFamilyDiv" style="display: none">
                                    <aside class="clearfix m-t-20">
                                        <div id="familyInsuranceSection" > 
                                            <div id="familyInsuranceClon_1">
                                                <article class="form-group m-lr-0">
                                                    <input type="hidden" id="total_test" name="total_test" value="1">
                                                </article>
                                                <article class="form-group m-lr-0">
                                                    <label for="" class="control-label col-md-4 col-sm-4">Name :</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <input class="form-control " id="usersfamily_name_1" type="text" name="usersfamily_name_1" value="<?php echo set_value('usersfamily_name_1'); ?>"  required/>
                                                        <span class="error" id="err_usersfamily_name_1" > <?php echo form_error("usersfamily_name_1"); ?></span>
                                                    </div>
                                                </article>
                                                <article class="form-group m-lr-0">
                                                    <label for="cname" class="control-label col-md-4 col-sm-4">Gender & Age:</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <aside class="row">
                                                            <div class="col-md-6 col-sm-6">
                                                                <select class="select2" data-width="100%" name="usersfamily_gender_1" id="usersfamily_gender_1" required="">
                                                                    <option value=""> Select Gender</option>
                                                                    <option value="1" <?php echo set_select('usersfamily_gender_1', '1'); ?>>Male</option>
                                                                    <option value="2" <?php echo set_select('usersfamily_gender_1', '2'); ?>>Female</option>
                                                                    <option value="3" <?php echo set_select('usersfamily_gender_1', '3'); ?>>Other</option>
                                                                </select>
                                                                <span class="error" id="err_usersfamily_gender_1" > <?php echo form_error("usersfamily_gender_1"); ?></span>
                                                                <div id="error_usersfamily_gender_1" class="error_usersfamily_gender_1"></div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                                <input class="form-control " id="usersfamily_age_1" placeholder ="Age" type="text" name="usersfamily_age_1" required="" onkeypress="return isNumberKey(event)">
                                                                <span class="error" id="err_usersfamily_age_1" > <?php echo form_error("usersfamily_relationId_1"); ?></span>
                                                            </div>
                                                        </aside>
                                                    </div>
                                                </article>
                                                <article class="form-group m-lr-0">
                                                    <label for="cname" class="control-label col-md-4 col-sm-4">Relationship :</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <select class="select2" data-width="100%" name="usersfamily_relationId_1" id="usersfamily_relationId_1" required>
                                                            <option value=""> Select Relation</option>
                                                            <?php foreach ($familyMember as $key => $val) { ?>
                                                                <option value="<?php echo $val->relation_id; ?>" <?php echo set_select('usersfamily_relationId_1', $val->relation_type); ?>><?php echo $val->relation_type; ?></option>
<?php } ?>

                                                        </select>
                                                        <span class="error" id="err_usersfamily_relationId_1" > <?php echo form_error("usersfamily_relationId_1"); ?></span>
                                                        <div id="error_usersfamily_relationId_1" class="error_usersfamily_relationId_1"></div>
                                                    </div>
                                                </article>
                                                <article class="form-group m-lr-0">
                                                    <label for="cname" class="control-label col-md-4 col-sm-4">Have Health Insurance ?</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="radio radio-success radio-inline">
                                                            <input type="radio" checked="" name="healthInsurance_1" value="1" id="inlineRadio3_1" onchange="insuranceShowHide('1', 'insuranceDivfamily_1')" <?php echo set_radio('healthInsurance_1', '1'); ?>/>
                                                            <label for="inlineRadio3_1">Yes</label>
                                                        </div>
                                                        <div class="radio radio-success radio-inline">
                                                            <input type="radio" name="healthInsurance_1" value='0' id="inlineRadio4_1" checked onchange="insuranceShowHide('0', 'insuranceDivfamily_1')" <?php echo set_radio('healthInsurance_1', '0'); ?> />
                                                            <label for="inlineRadio4_1">No</label>
                                                        </div>
                                                    </div>
                                                </article>
                                                <div style="display:none" id="insuranceDivfamily_1">
                                                    <article class="form-group m-lr-0">
                                                        <label for="cname" class="control-label col-md-4 col-sm-4">Health Insu. Provider:</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <select class="select2" data-width="100%" required="" name="userInsurance_insuranceId_1" id="userInsurance_insuranceId_1">
                                                                <option value=""> Select Insurance</option>
                                                                <?php foreach ($insurance_cmpny as $key => $val) { ?>
                                                                    <option value="<?php echo $val->insurance_id; ?>" <?php echo set_select('userInsurance_insuranceId_1', $val->insurance_id); ?>><?php echo $val->insurance_Name; ?></option>
<?php } ?>
                                                            </select>
                                                            <span class="error" id="err_userInsurance_insuranceId_1" > <?php echo form_error("userInsurance_insuranceId_1"); ?></span>
                                                            <div id="error_userInsurance_insuranceId_1" class="error_userInsurance_insuranceId_1"></div>
                                                        </div>
                                                    </article>
                                                    <article class="form-group m-lr-0">
                                                        <label for="" class="control-label col-md-4 col-sm-4">Health Card no. :</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <input class="form-control " id="userInsurance_insuranceNo_1" type="text" name="userInsurance_insuranceNo_1" required="" placeholder="" value="<?php echo set_value('userInsurance_insuranceNo_1'); ?>" />
                                                            <span class="error" id="err_userInsurance_insuranceNo_1" > <?php echo form_error("userInsurance_insuranceNo_1"); ?></span>
                                                        </div>
                                                    </article>
                                                    <article class="form-group m-lr-0">
                                                        <label for="cname" class="control-label col-md-4 col-sm-4">Policy Expiry Date :</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <div class="input-group">
                                                                <input class="form-control pickDatePolicy" id="userInsurance_expDate_1" placeholder="dd/mm/yyyy" type="text"  name="userInsurance_expDate_1" value="<?php echo set_value('userInsurance_expDate_1'); ?>" onkeydown="return false;">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span></div>
                                                            <span class="error" id="err_userInsurance_expDate_1" > <?php echo form_error("userInsurance_expDate_1"); ?></span>
                                                        </div>
                                                    </article>
                                                </div>
                                            </div>
                                        </div>
                                        <article class="form-group m-lr-0">     
                                            <div class="col-md-5 col-sm-5  col-md-offset-4 col-sm-offset-4">
                                                <button type="button" href="javascript:void(0)" class="btn btn-success btn-block waves-effect waves-light" onclick="addMoreFamilyMember()" >Add More Member </button>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-md-offset-0 col-sm-offset-0">
                                            </div>
                                        </article>
                                    </aside>
                                </div>
                                <!--Experience Section End -->
                            </aside>
                        </div>
                    </section>
                    <section class="clearfix ">
                        <div class="col-md-12 m-t-20 m-b-20">
                            <button class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit" onclick="return formContainer();">Submit</button>
                                   
                            <!--onclick="return check_email();"-->

                        </div>
                    </section>
                </form>
            </div>
            <!-- consultation -->
            <!-- Right Section End -->
        </div>
        <!-- container -->
    </div>