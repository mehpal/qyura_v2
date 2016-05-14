<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container row">
            <!-- consultation -->
            <div style="display:show;" id="consultDiv">
                <div class="clearfix">
                    <div class="col-md-12">
                        <h3 class="pull-left page-title">Edit User</h3>
                    </div>
                </div>
                <form class="cmxform form-horizontal tasi-form avatar-form" id="editsubmitForm" method="post" action="<?php echo site_url('users/editUserSave'); ?>" novalidate="novalidate" enctype="multipart/form-data">
                    <input type="hidden"  name="users_id" value="<?php if (isset($users_detail->users_id) && !empty($users_detail->users_id)) { echo $users_detail->users_id; } ?>" id="users_id"/>
                    <input type="hidden"  name="patientDetails_id" value="<?php if (isset($users_detail->patientDetails_id) && !empty($users_detail->patientDetails_id)) { echo $users_detail->patientDetails_id; } ?>" id="patientDetails_id"/>
                    
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
                                        <input class="form-control disabled" id="patientDetails_unqId" name="patientDetails_unqId"  aria-required="true" value="<?php if (isset($users_detail) && !empty($users_detail)) { echo $users_detail->patientDetails_unqId; } ?>" placeholder="" disabled="">
                                    </div>
                                </article>
                                <article class="clearfix m-t-10" id="crop-avatar">
                                    <div id="upload_modal_form">
                                        <?php $this->load->view('upload_crop_modal');?>
                                    </div>
                                    <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                                    <div class="col-md-8 col-sm-8" data-target="#modal" data-toggle="modal">
                                        <label class="col-md-4 col-sm-4" for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x avatar-view"></i></label>
                                        <div class="pre col-md-4 col-sm-4 ">
                                            <div id="preImgLogo" class="avatar-preview preview-md preImgLogo">
                                            <?php if (!empty($users_detail->patientDetails_patientImg)) { ?>
                                                <img src="<?php echo base_url() ?>assets/usersImage/thumb/thumb_100/<?php echo $users_detail->patientDetails_patientImg; ?>" alt="" class="image-preview-show" />
                                            <?php } else { ?>
                                                <img src="<?php echo base_url() ?>assets/default-images/Doctor-logo.png" alt="" class="image-preview-show" />
                                            <?php } ?>
                                                <input type="hidden"  name="patientDetails_patientImg" value="<?php if (isset($users_detail) && !empty($users_detail)) { echo $users_detail->patientDetails_patientImg; } ?>" />
                                            </div>
                                        </div>
                                        <label class="error" > <?php echo form_error("avatar_file"); ?></label>
                                        <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">
                                    <label for="" class="control-label col-md-4 col-sm-4"> Name :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control " id="patientDetails_patientName" type="text" name="patientDetails_patientName" required="" value="<?php if (isset($users_detail) && !empty($users_detail)) { echo $users_detail->patientDetails_patientName; } ?>">
                                        <label class="error" > <?php echo form_error("patientDetails_patientName"); ?></label>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Gender :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <select class="select2" data-width="100%" name="patientDetails_gender">
                                            <option value="">Select Gender</option>
                                            <option value="1" <?php if ($users_detail->patientDetails_gender == 1): echo"selected";endif; ?>>Male</option>
                                            <option value="2" <?php if ($users_detail->patientDetails_gender == 2): echo"selected";endif; ?>>Female</option>
                                            <option value="3" <?php if ($users_detail->patientDetails_gender == 3): echo"selected";endif; ?>>Other</option>
                                        </select>
                                        <label class="error" > <?php echo form_error("patientDetails_gender"); ?></label>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Date of Birth :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <div class="input-group">
                                            <input class="form-control dob" placeholder="mm/dd/yyyy" id="patientDetails_dob" type="text" name="patientDetails_dob" onkeydown="return false;" value="<?php if (isset($users_detail) && !empty($users_detail)) {
    echo $newformat = date('m/d/Y', $users_detail->patientDetails_dob); } ?>">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        </div>
                                        <label class="error" > <?php echo form_error("patientDetails_dob"); ?></label>
                                    </div>
                                    
                                </article>
                                <article class="form-group m-lr-0">
                                    <label for="" class="control-label col-md-4 col-sm-4">Email Id:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control " id="users_email" type="email" name="users_email" placeholder="" value="<?php if (isset($users_detail->users_email) && !empty($users_detail->users_email)) { echo $users_detail->users_email; } ?>" readonly>
                                        <label class="error" > <?php echo form_error("users_email"); ?></label>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Phone:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <aside class="row">
                                            <div class="col-md-12 col-sm-4 col-xs-10 m-t-xs-10 ">
                                                <input type="text" class="form-control" name="patientDetails_mobileNo" id="patientDetails_mobileNo" maxlength="10" placeholder="Number" onkeypress="return isNumberKey(event)" value="<?php if (isset($users_detail) && !empty($users_detail)) { echo $users_detail->patientDetails_mobileNo; } ?>" readonly/>
                                                <label class="error" > <?php echo form_error("patientDetails_mobileNo"); ?></label>
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

                                                        <option value="<?php echo $val->state_id; ?>" <?php if ($val->state_id == $users_detail->patientDetails_stateId): echo"selected";endif; ?>><?php echo $val->state_statename; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label class="error" > <?php echo form_error("patientDetails_stateId"); ?></label>
                                                
                                            </div>
                                        </aside>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">
                                    <div class="col-md-8 col-md-offset-4 col-sm-4 col-sm-offset-4">
                                        <aside class="row">
                                            <div class="col-md-6 col-sm-6">
                                                <select class="select2" data-width="100%" name="patientDetails_cityId" id="patientDetails_cityId" data-size="4" >
                                                    <option value="">Select City</option>
                                                    <?php if (isset($qyura_city) && $qyura_city != NULL) {
                                                        foreach ($qyura_city as $key => $val) { ?>
                                                            <option <?php if ($users_detail->patientDetails_cityId == $val->city_id) { echo "selected"; } ?> value="<?php echo $val->city_id; ?>"><?php echo $val->city_name; ?></option>
                                                        <?php } } ?>
                                                </select>
                                                <label class="error" > <?php echo form_error("patientDetails_cityId"); ?></label>
                                            </div>
                                            <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                <input type="text" class="form-control" id="patientDetails_pin" name="patientDetails_pin" placeholder="Pin Code" maxlength="6" onkeypress="return isNumberKey(event)" value="<?php if (isset($users_detail) && !empty($users_detail)) { echo $users_detail->patientDetails_pin; } ?>" />
                                                <label class="error" > <?php echo form_error("patientDetails_pin"); ?></label>
                                            </div>
                                        </aside>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0 m-t-xs-10">
                                    <div class="col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4">
                                        <input type="text" class="form-control" id="patientDetails_address" name="patientDetails_address" placeholder=" " value="<?php if (isset($users_detail->patientDetails_address) && !empty($users_detail->patientDetails_address)) { echo $users_detail->patientDetails_address; } ?>" />
                                        <label class="error" > <?php echo form_error("patientDetails_address"); ?></label>
                                    </div>
                                </article>

                                                                <article class="form-group m-lr-0">
                                                                    <label for="cname" class="control-label col-md-4 col-sm-4">Enter Password :</label>
                                                                    <div class="col-md-8 col-sm-8">
                                                                        <input type="password" class="form-control" id="users_password" name="users_password" minlength="4"/>
                                
                                                                        <span class="error" > <?php echo form_error("users_password"); ?></span>
                                                                    </div>
                                                                </article>
                                                                <article class="form-group m-lr-0">
                                                                    <label for="cname" class="control-label col-md-4 col-sm-4">Confirm Password :</label>
                                                                    <div class="col-md-8 col-sm-8">
                                                                        <input type="password" class="form-control" id="cnfPassword" name="cnfPassword" placeholder=" " />
                                
                                                                        <span class="error" > <?php echo form_error("cnfPassword"); ?></span>
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
                            <!-- Health Insurance  Start -->
                            <figure class="clearfix">
                                <h3>Health Insurance Detail</h3>
                            </figure>
                            <aside class="clearfix m-t-20">
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Have Health Insurance ?</label>
                                    <input type="hidden"  name="userInsurance_id" value="<?php if (isset($users_insurance->userInsurance_id) && !empty($users_insurance->userInsurance_id)) { echo $users_insurance->userInsurance_id; } ?>" id="userInsurance_id"/>
                                    <div class="col-md-8 col-sm-8">
                                        <div class="radio radio-success radio-inline">
                                            <input type="radio" name="healthInsurance1" value="1" id="inlineRadio1" onchange="insuranceShowHide('1', 'insuranceDiv')" <?php if (isset($users_insurance) && !empty($users_insurance)) { echo "checked"; } ?> >
                                            <label for="inlineRadio1">Yes</label>
                                        </div>
                                        <div class="radio radio-success radio-inline">
                                            <input type="radio" name="healthInsurance1" value="0" id="inlineRadio2" onchange="insuranceShowHide('0', 'insuranceDiv')" <?php if (!isset($users_insurance) && empty($users_insurance)) { echo "checked"; } ?>>
                                            <label for="inlineRadio2">No</label>
                                        </div>
                                    </div>
                                </article>
                                <div style="display:<?php if (isset($users_insurance) && !empty($users_insurance)) { echo 'block';} else { echo 'none'; } ?>" id="insuranceDiv">
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Health Insura. Company:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="select2" data-width="100%" name="userInsurance_insuranceId">
                                                <option value=""> select company </option>
                                                <?php foreach ($insurance_cmpny as $key => $val) { ?>
                                                <option value="<?php echo $val->insurance_id; ?>" <?php if ($val->insurance_id == $users_insurance->userInsurance_insuranceId): echo"selected"; endif;?>><?php echo $val->insurance_Name; ?></option>
                                                <?php } ?>
                                            </select>
                                            <label class="error" > <?php echo form_error("userInsurance_insuranceId"); ?></label>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="" class="control-label col-md-4 col-sm-4">Health Insura. Card no. :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control " id="userInsurance_insuranceNo" type="text" name="userInsurance_insuranceNo"  value="<?php if (isset($users_insurance->userInsurance_insuranceNo) && !empty($users_insurance->userInsurance_insuranceNo)) { echo $users_insurance->userInsurance_insuranceNo; } ?>" />
                                            <label class="error" > <?php echo form_error("userInsurance_insuranceNo"); ?></label>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Policy Expiry Date :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <div class="input-group">
                                                <input class="form-control pickDatePolicyedit" id="userInsurance_expDate" placeholder="mm/dd/yyyy" id="expiryDate" type="text" name="userInsurance_expDate" onkeydown="return false;" value="<?php if (isset($users_insurance->userInsurance_expDate) && !empty($users_insurance->userInsurance_expDate)) { echo date('m/d/Y', $users_insurance->userInsurance_expDate); } ?>">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span></div>
                                            <label class="error" > <?php echo form_error("userInsurance_expDate"); ?></label>
                                        </div>
                                    </article>
                                </div>
                                <!--Health Insuranse End--> 
                                <!--Family Section Start -->
                                <figure class="clearfix">
                                    <h3>Add Family Members :</h3>
                                </figure>
                                <aside class="clearfix m-t-20">
                                    <div id="familyInsuranceSection" > 
                                        <div id="familyInsuranceClon_1">
                                            <?php $count_family = 1; if(isset($usersfamily_detail) && !empty($usersfamily_detail)){ ?>
                                            <input type="hidden" id="total_family" name="total_family" value="<?php echo count($usersfamily_detail); ?>" >
                                            <?php foreach ($usersfamily_detail as $val) { ?>
                                                <input type="hidden" id="usersfamily_id_<?php echo $count_family; ?>" name="usersfamily_id_<?php echo $count_family; ?>" value="<?php echo $val->usersfamily_id; ?>">
                                                <article class="form-group m-lr-0">
                                                    <label for="" class="control-label col-md-4 col-sm-4">Name :</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <input class="form-control " id="usersfamily_name_<?php echo $count_family; ?>" type="text" name="usersfamily_name_<?php echo $count_family; ?>" value="<?php echo $val->usersfamily_name; ?>"/>
                                                        <label class="error" > <?php echo form_error("usersfamily_name_$count_family"); ?></label>
                                                    </div>
                                                </article>
                                                <article class="form-group m-lr-0">
                                                    <label for="cname" class="control-label col-md-4 col-sm-4">Gender & Age:</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <aside class="row">
                                                            <div class="col-md-6 col-sm-6">
                                                                <select class="select2" data-width="100%" name="usersfamily_gender_<?php echo $count_family; ?>" id="usersfamily_gender_<?php echo $count_family; ?>" required="">
                                                                    <option value="1" <?php if ($val->usersfamily_gender == 1): echo"selected"; endif; ?> >Male</option>
                                                                    <option value="2" <?php if ($val->usersfamily_gender == 2): echo"selected"; endif; ?>>Female</option>
                                                                </select>
                                                                <label class="error" > <?php echo form_error("usersfamily_gender_$count_family"); ?></label>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                                <input class="form-control " id="usersfamily_age_<?php echo $count_family; ?>" type="text" name="usersfamily_age_<?php echo $count_family; ?>" required="" value="<?php echo $val->usersfamily_age; ?>" onkeypress="return isNumberKey(event)" placeholder="">
                                                                 <label class="error" > <?php echo form_error("usersfamily_age_$count_family"); ?></label>
                                                            </div>
                                                        </aside>
                                                    </div>
                                                </article>
                                                <article class="form-group m-lr-0">
                                                    <label for="cname" class="control-label col-md-4 col-sm-4">Relationship :</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <select class="select2" data-width="100%" name="usersfamily_relationId_<?php echo $count_family; ?>" id="usersfamily_relationId_<?php echo $count_family; ?>">
                                                        <?php foreach ($familyMember as $key => $value) { ?>
                                                            <option value="<?php echo $value->relation_id; ?>"<?php if ($value->relation_id == $val->usersfamily_relationId): echo"selected"; endif; ?>><?php echo $value->relation_type; ?></option>
                                                        <?php } ?>
                                                        </select>
                                                        <label class="error" > <?php echo form_error("usersfamily_relationId_$count_family"); ?></label>
                                                    </div>
                                                </article>
                                                
                                                <article class="form-group m-lr-0">
                                                    <label for="cname" class="control-label col-md-4 col-sm-4">Have Health Insurance ?</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="radio radio-success radio-inline">
                                                            <input type="radio" name="healthInsurance_<?php echo $count_family; ?>" value="1" id="inlineRadio3_<?php echo $count_family; ?>" onchange="insuranceShowHide('1', 'insuranceDivfamily_<?php echo $count_family; ?>')" <?php if(isset($val->userInsurance_id) && $val->userInsurance_id != ''){ echo "checked"; }?> >
                                                            <label for="inlineRadio3_<?php echo $count_family; ?>">Yes</label>
                                                        </div>
                                                        <div class="radio radio-success radio-inline">
                                                            <input type="radio" name="healthInsurance_<?php echo $count_family; ?>" value='0' id="inlineRadio4_<?php echo $count_family; ?>" onchange="insuranceShowHide('0', 'insuranceDivfamily_<?php echo $count_family; ?>')" <?php if(!isset($val->userInsurance_id) && $val->userInsurance_id == ''){ echo "checked"; } ?> >
                                                            <label for="inlineRadio4_<?php echo $count_family; ?>">No</label>
                                                        </div>
                                                    </div>
                                                </article>
                                                <div style="display:<?php if(isset($val->userInsurance_id) && $val->userInsurance_id != '') {echo "block";}else{echo 'none';} ?>" id="insuranceDivfamily_<?php echo $count_family; ?>">
                                                    <input type="hidden"  name="userFInsurance_id_<?php echo $count_family; ?>" value="<?php if (isset($val->userInsurance_id) && !empty($val->userInsurance_id)) { echo $val->userInsurance_id; } ?>" id="userFInsurance_id_<?php echo $count_family; ?>"/>
                                                    <article class="form-group m-lr-0">
                                                        <label for="cname" class="control-label col-md-4 col-sm-4">Health Insu. Provider:</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <select class="select2" data-width="100%" name="userInsurance_insuranceId_<?php echo $count_family; ?>" id="userInsurance_insuranceId_<?php echo $count_family; ?>">
                                                            <?php  if(isset($insurance_cmpny) && !empty($insurance_cmpny)){
                                                            foreach ($insurance_cmpny as $key => $value) { ?>
                                                                <option value="<?php echo $value->insurance_id; ?>"  <?php if ($value->insurance_id == $val->userInsurance_insuranceId){ echo"selected";} ?>><?php echo $value->insurance_Name; ?></option>
                                                            <?php } } ?>
                                                            </select>
                                                            <label class="error" > <?php echo form_error("userInsurance_insuranceId_$count_family"); ?></label>
                                                        </div>
                                                    </article>
                                                    <article class="form-group m-lr-0">
                                                        <label for="" class="control-label col-md-4 col-sm-4">Health Card no. :</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <input class="form-control " id="userInsurance_insuranceNo_<?php echo $count_family; ?>" type="text" name="userInsurance_insuranceNo_<?php echo $count_family; ?>" value="<?php echo $val->userInsurance_insuranceNo; ?>" required=""  />
                                                            <label class="error" > <?php echo form_error("userInsurance_insuranceNo_$count_family"); ?></label>
                                                        </div>
                                                    </article>
                                                    
                                                    
                                                    
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Policy Expiry Date :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <div class="input-group">
                                                <input class="form-control pickDatePolicyedit" id="userInsurance_expDate_<?php echo $count_family; ?>" placeholder="mm/dd/yyyy" type="text" name="userInsurance_expDate_<?php echo $count_family; ?>" onkeydown="return false;" value="<?php if (isset($val->userInsurance_expDate) && !empty($val->userInsurance_expDate)) { echo date('m/d/Y', $val->userInsurance_expDate); } ?>">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span></div>
                                            <label class="error" > <?php echo form_error("userInsurance_expDate_$count_family"); ?></label>
                                        </div>
                                    </article>
                                                    
                                                    
                                                    
                                                    
                                                    
                                                </div>
<!--                                              <button type="button" onclick="deletefamily('usersfamily_id_<?php echo $count_family; ?>');"> Delete </button>-->
                                                <hr>
                                            <?php $count_family++; }  } ?>
                                                <input type="hidden" id="total_test_edit" name="total_test_edit" value="<?php echo $count_family; ?>" >
                                        </div>
                                    </div>
                                    <article class="form-group m-lr-0">     
                                        <div class="col-md-5 col-sm-5  col-md-offset-4 col-sm-offset-4">
                                            <button type="button" href="javascript:void(0)" class="btn btn-success btn-block waves-effect waves-light" onclick="addMoreFamilyMemberEdit()" >Add More Member </button>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-md-offset-0 col-sm-offset-0">
                                        </div>
                                    </article>
                                </aside>
                                <!--Experience Section End -->
                        </div>
                    </section>
                    <section class="clearfix ">
                        <div class="col-md-12 m-t-20 m-b-20">
                            <button class="btn btn-success waves-effect waves-light pull-right m-r-20" onclick="return editformContainer();" type="submit">Submit</button>
                        </div>
                    </section>
                </form>
            </div>
            <!-- consultation -->
            <!-- Right Section End -->
        </div>
        <!-- container -->
    </div>
