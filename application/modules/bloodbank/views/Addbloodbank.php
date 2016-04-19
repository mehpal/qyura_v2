<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <div class="clearfix">
                <!--<div class="col-md-12 text-success">
                <?php // echo $this->session->flashdata('message'); ?>
                 </div> -->
                <div class="col-md-12">
                    <h3 class="pull-left page-title">Add New BloodBank</h3>

                </div>
            </div>
            <div class="map_canvas"></div>
            <form class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" name="submitForm" method="post" action="<?php echo site_url(); ?>/bloodbank/SaveBloodbank" novalidate="novalidate" enctype="multipart/form-data" >
                <input type="hidden" id="StateId" name="StateId" value="" />

                <!-- Left Section Start -->
                <section class="col-md-6 detailbox">
                    <div class="bg-white mi-form-section">
                        <figure class="clearfix">
                            <h3>General Detail</h3>
                        </figure>
                        <!-- Table Section End -->
                        <div class="clearfix m-t-20 p-b-20">
                            <article class="clearfix m-t-10">
                                <label for="cemail" class="control-label col-md-4 col-sm-4">Blood Bank Name :</label>
                                <div class="col-md-8 col-sm-8">
                                    <input class="form-control" id="bloodBank_name" name="bloodBank_name" type="text" required="" maxlength="30" value="<?php echo set_value('bloodBank_name'); ?>">
                                    <label class="error" style="display:none;" id="error-bloodBank_name"> please enter bloodbank name</label>
                                    <label class="error" > <?php echo form_error("bloodBank_name"); ?></label>
                                </div>
                            </article>

                                  <article class="clearfix m-t-10">
                                <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                                
                                <div class="col-md-8 col-sm-8" data-target="#modal" data-toggle="modal">
                                    <label class="col-md-4 col-sm-4" for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x avatar-view"></i></label>

                                    <div class="pre col-md-4 col-sm-4 ">
                                    <div id="preImgLogo" class="avatar-preview preview-md">
                                        
                                   <img src="<?php echo base_url() ?>assets/default-images/Blood-logo.png"  class="image-preview-show"/>
                                        
                                    </div>
                                    </div>

                                    <label class="error" > <?php echo form_error("avatar_file"); ?></label>
                                    <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                                    
                                    
                                    
                                </div>
                                
                            </article>



                            <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4 col-sm-4">Address:</label>
                                <div class="col-md-8 col-sm-8">
                                    <select class="form-control selectpicker" data-width="100%" name="countryId" id="countryId">
                                        <option value=''>Select Country</option>
                                        <option value="1" <?php echo set_select('countryId', '1'); ?> >India</option>

                                    </select>
                                    <label class="error" style="display:none;" id="error-countryId"> please select a country</label>
                                    <label class="error" > <?php echo form_error("countryId"); ?></label>
                                </div>
                            </article>

                            <article class="clearfix">
                                <div class="col-md-8 col-sm-8 col-sm-offset-4">
                                    <select class="selectpicker" data-width="100%" name="stateId" Id="stateId" data-size="4" onchange ="fetchCity(this.value)">
                                        <option value="">Select State</option>
                                        <?php if (isset($allStates) && !empty($allStates)) {
                                            foreach ($allStates as $key => $val) { ?>
                                                <option <?php echo set_select('stateId', $val->state_id); ?> value="<?php echo $val->state_id; ?>"><?php echo $val->state_statename; ?></option>
    <?php }
} ?>

                                    </select>
                                    <label class="error" style="display:none;" id="error-stateId"> please select a state</label>
                                    <label class="error" > <?php echo form_error("stateId"); ?></label>
                                </div>
                            </article>

                            <article class="clearfix">
                                <div class="col-sm-8 col-sm-offset-4">
                                    <select class="selectpicker" data-width="100%" name="cityId" id="cityId" data-size="4">
                                        <option value="">Select City</option>
                                        <?php if (isset($allCities) && !empty($allCities)) {
                                            foreach ($allCities as $key => $val) { ?>
                                                <option <?php echo set_select('cityId', $val->city_id); ?> value="<?php echo $val->city_id; ?>"><?php echo $val->city_name; ?></option>
    <?php }
} ?>

                                    </select>
                                    <label class="error" > <?php echo form_error("cityId"); ?></label>
                                    <label class="error" style="display:none;" id="error-cityId"> please select a city</label>
                                </div>
                            </article>

                            <article class="clearfix m-t-10">
                                <div class="col-sm-8 col-sm-offset-4">
                                    <input type="text" class="form-control" id="bloodBank_zip" name="bloodBank_zip" maxlength="6" value="<?php echo set_value('bloodBank_zip'); ?>" onkeypress="return isNumberKey(event)" placeholder="Zipcode"/>
                                    <label class="error" style="display:none;" id="error-bloodBank_zip"> zip code should be numeric and 6 digit long</label>          <label class="error" > <?php echo form_error("bloodBank_zip"); ?></label>
                                </div>
                            </article>


                            <article class="clearfix checkManual">
                                <label class="control-label col-md-4" for="cname">Manual:</label>
                                <div class="col-md-8">
                                    <aside class="radio radio-info radio-inline">
                                        <input type="radio" <?php echo set_radio('isManual', 1, TRUE); ?>  name="isManual" value="1" id="isManual" onclick="IsAdrManual(this.value)">
                                        <label for="inlineRadio1"> Yes</label>
                                    </aside>
                                    <aside class="radio radio-info radio-inline">
                                        <input type="radio" <?php echo set_radio('myradio', 0); ?> name="isManual" value="0" id="isManual" onclick="IsAdrManual(this.value)">
                                        <label for="inlineRadio2"> No</label>
                                    </aside>
                                </div>
                            </article>

                            <article class="clearfix m-t-10">
                                <div class="col-sm-8 col-sm-offset-4">
                                    <input type="text" class="form-control geocomplete" name="bloodBank_add" id="geocomplete1" value="<?php echo set_value('bloodBank_add'); ?>" placeholder="Address"/>
                                    <label class="error" style="display:none;" id="error-bloodBank_add"> please enter an address</label>
                                    <label class="error" > <?php echo form_error("bloodBank_add"); ?></label>

                                </div>
                            </article>

                            <article class="clearfix m-t-10">
                                <div class="col-sm-8 col-sm-offset-4">
                                    <aside class="row">
                                        <div class="col-sm-6">
                                            <input name="lat" value="<?php echo set_value('lat'); ?>" class="form-control" type="text"  id="lat" placeholder="Latitude" onkeypress="return isNumberKey(event)" />
                                            <label class="error" > <?php echo form_error("lat"); ?></label>
                                            <label class="error" style="display:none;" id="error-lat">Please enter latitude</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <input name="lng" value="<?php echo set_value('lng'); ?>" class="form-control" type="text"   id="lng" placeholder="Longitude" onkeypress="return isNumberKey(event)"  />

                                            <label class="error" > <?php echo form_error("lng"); ?></label>
                                            <label class="error" style="display:none;" id="error-lng"> Please enter longitude</label> 
                                        </div>
                                    </aside>

                                </div>
                            </article>

                            <article class="clearfix m-t-10">
                                <label class="control-label col-md-4 col-sm-4" for="cname">Phone :</label>
                                <div class="col-md-8 col-sm-8">
                                     <input type="text" class="form-control" name="bloodBank_phn" id="bloodBank_phn" maxlength="10" minlength="10" onkeypress="return isNumberKey(event)" <?php set_value('bloodBank_phn') ?> />

                                    <label class="error" style="display:none;" id="error-bloodBank_phn"> please enter a valid phone min length should be min 10 and max 10</label>
                                  
                                    <label class="error" > <?php echo form_error("bloodBank_phn"); ?></label>
                                    <label class="error"> </label>
  <p class="m-t-0">* The number above is going to be your primary number.</p>
                                </div>
                            </article>

                            <article class="clearfix m-t-10">
                                <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person :</label>
                                <div class="col-md-8 col-sm-8">
                                    <input class="form-control" name="bloodBank_cntPrsn" type="text" required="" id="bloodBank_cntPrsn" value="<?php echo set_value('bloodBank_cntPrsn'); ?>">
                                    <label class="error" style="display:none;" id="error-bloodBank_cntPrsn">please enter name properly!</label>
                                    <label class="error" > <?php echo form_error("bloodBank_cntPrsn"); ?></label>
                                </div>
                            </article>

                            <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4 col-sm-4">Membership Type :</label>
                                <div class="col-md-8 col-sm-8">
                                    <select class="selectpicker" data-width="100%" name="bloodBank_mbrTyp" id="bloodBank_mbrTyp">
                                        <option value="1" <?php echo set_select('bloodBank_mbrTyp', '1', TRUE); ?>
                                                >Life Time</option>
                                        <option value="2" <?php echo set_select('bloodBank_mbrTyp', '2'); ?>
                                                >Health Club</option>
                                    </select>
                                    <label class="error" style="display:none;" id="error-bloodBank_mbrTyp">please enter only charcters</label>
                                    <label class="error" > <?php echo form_error("bloodBank_mbrTyp"); ?></label>
                                </div>
                            </article>
                            <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4">24/7 Services ? </label>
                                <div class="col-md-8">
                                    <aside class="radio radio-info radio-inline">
                                        <input <?php echo set_radio('isEmergency', 1); ?> type="radio" id="isEmergency_yes" value="1" name="isEmergency" checked>
                                        <label for="inlineRadio1"> Yes</label>
                                    </aside>
                                    <aside class="radio radio-info radio-inline">
                                        <input <?php echo set_radio('isEmergency', 1, TRUE); ?> type="radio" id="isEmergency_no" value="0" name="isEmergency">
                                        <label for="inlineRadio2"> No</label>
                                    </aside>
                                </div>
                            </article>
                            
                                <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4">Docat Id : </label>
                                <div class="col-md-8 col-sm-8">
                                    <input class="form-control" name="bloodbank_docatId" type="text" required="" id="bloodbank_docatId" value="<?php echo set_value('bloodbank_docatId'); ?>">
                                    <label class="error" style="display:none;" id="error-bloodbank_docatId">please enter Docat Id.</label>
                                    <label class="error" > <?php echo form_error("bloodbank_docatId"); ?></label>
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

                        <!-- Account Detail Section Start -->
                        <figure class="clearfix">
                            <h3>Account Detail</h3>
                        </figure>
                        <aside class="clearfix m-t-20 p-b-20">
                            <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4 col-sm-4">Email Id:</label>
                                <div class="col-md-8 col-sm-8">
                                    <input type="email" class="form-control" id="users_email" name="users_email" onblur="return checkEmailFormat()"   value="<?php echo set_value('users_email'); ?>"/>
                                    <label class="error" style="display:none;" id="error-users_email"> please enter Email id Properly</label>
                                    <label class="error" style="display:none;" id="error-users_email_check"> Email Already Exists!</label>
                                    <label class="error" > <?php echo form_error("users_email"); ?></label>
                                    <input type="hidden" class="form-control" id="users_email_status" name="users_email_status" value="" />
                                </div>
                            </article>

                            <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4 col-sm-4">Mobile no. :</label>
                                <div class="col-md- col-sm-8">
                                    <input type="text" class="form-control" id="bloodBank_mblNo" name="bloodBank_mblNo" maxlength="10" value="<?php echo set_value('bloodBank_mblNo'); ?>" onkeypress="return isNumberKey(event)"/>
                                    <label class="error" style="display:none;" id="error-bloodBank_mblNo"> please enter your mobile number properly</label>
                                    <label class="error" > <?php echo form_error("bloodBank_mblNo"); ?></label>
                                </div>
                            </article>

                            <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4 col-sm-4">Enter Password :</label>
                                <div class="col-md-8 col-sm-8">
                                    <input type="password" class="form-control" id="users_password" name="users_password" />
                                    <label class="error" style="display:none;" id="error-users_password"> please enter password and it should be 6 chracter</label>
                                    <label class="error" > <?php echo form_error("users_password"); ?></label>
                                </div>
                            </article>

                            <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4 col-sm-4">Confirm Password :</label>
                                <div class="col-md-8 col-sm-8">
                                    <input type="password" class="form-control" id="cnfPassword" name="cnfPassword"/>
                                    <label class="error" style="display:none;" id="error-cnfPassword"> please enter the password</label>
                                    <label class="error" style="display:none;" id="error-cnfPassword_check">Passwords do not match!</label>
                                    <label class="error" > <?php echo form_error("cnfPassword"); ?></label>
                                </div>
                            </article>

                        </aside>

                        <!-- Account Detail Section End -->

                    </div>
                </section>
                <section class="clearfix ">
                    <div class="col-md-12 m-t-20 m-b-20">
                        <input type="hidden" value="1" name="isValid" id="isValid">
                        <input type="hidden" value="" name="userId" id="userId">
                        <label class="error" style="display:none;" id="error-userexist">Blood bank already exist!</label>
                        <button class="btn btn-danger waves-effect pull-right" type="reset">Reset</button>
                        <div>
                            <input class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit" value="Submit" onclick="return validationBloodbank()" />
                        </div>
                    </div>

                </section>

                <fieldset>



                </fieldset>
                <div id="upload_modal_form">
<?php $this->load->view('upload_crop_modal'); ?>
                </div>
            </form>

        </div>

        <!-- container -->
    </div>
    <!-- content -->

