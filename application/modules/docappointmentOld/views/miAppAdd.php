
        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">

                    <div class="clearfix">
                        <div class="col-md-12 text-success">
                            <?php echo $this->session->flashdata('message'); ?>
                         </div>
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Add New BloodBank</h3>

                        </div>
                    </div>
                    <div class="map_canvas"></div>
                    <form class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" name="bloodbankForm" method="post" action="<?php echo site_url(); ?>/bloodbank/SaveBloodbank" novalidate="novalidate" enctype="multipart/form-data" >
                        <input type="hidden" id="StateId" name="StateId" value="" />
                      
                        <!-- Left Section Start -->
                        <section class="col-md-6 detailbox">
                            <div class="bg-white mi-form-section">
                                <figure class="clearfix">
                                    <h3>General Detail</h3>
                                </figure>
                                <!-- Table Section End -->
                                <div class="clearfix m-t-20 p-b-20">
                                    <article class="form-group m-lr-0 ">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Blood Bank Name :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" id="bloodBank_name" name="bloodBank_name" type="text" required="" maxlength="30" value="<?php echo set_value('bloodBank_name'); ?>">
                                            <label class="error" style="display:none;" id="error-bloodBank_name"> please enter bloodbank name</label>
                                            <label class="error" > <?php echo form_error("bloodBank_name"); ?></label>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0 ">
                                        <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                                        <div class="col-md-8 col-sm-8 text-right">
                                            <label for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x avatar-view"></i></label>
<!--                                            <input type="file" style="display:none;" class="no-display" id="file-input" name="bloodBank_photo">-->
                                             <input type="file" style="display:none;" class="no-display avatar-view" id="file-input11" name="bloodBank_photo">
                                            
                                            <label class="error" > <?php echo form_error("bloodBank_photo"); ?></label>
                                            <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                                            <img src="" width="70" height="65" class="image-preview-show"/>
                                        </div>
                                    </article>


                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Address:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <aside class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <select class="selectpicker" data-width="100%" name="countryId" id="countryId">
                                                        <option value=''>Select Country</option>
                                                        <option value="1">INDIA</option>
                                                        
                                                    </select>
                                                    <label class="error" style="display:none;" id="error-countryId"> please select a country</label>
                                                    <label class="error" > <?php echo form_error("countryId"); ?></label>
                                                </div>
                                                <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                    <select class="selectpicker" data-width="100%" name="stateId" Id="stateId" data-size="4" onchange ="fetchCity(this.value)">
                                                        <option value="">Select State</option>
                                                       <?php foreach($allStates as $key=>$val) {?>
                                                        <option value="<?php echo $val->state_id;?>"><?php echo $val->state_statename;?></option>
                                                         <?php }?>
                                                    </select>
                                                    <label class="error" style="display:none;" id="error-stateId"> please select a state</label>
                                                    <label class="error" > <?php echo form_error("stateId"); ?></label>
                                                </div>
                                            </aside>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <div class="col-sm-8 col-sm-offset-4">
                                            <aside class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <select class="selectpicker" data-width="100%" name="cityId" id="cityId" data-size="4">
                                                        <!--<option>Select City</option>
                                                        <option>Kolkata</option>
                                                        <option>Delhi</option>-->
                                                    </select>
                                                    <label class="error" style="display:none;" id="error-cityId"> please select a city</label>

                                                </div>
                                                <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                    <input type="text" class="form-control" id="bloodBank_zip" name="bloodBank_zip" placeholder="700001" maxlength="13" value="<?php echo set_value('bloodBank_zip'); ?>" />
                                                <label class="error" style="display:none;" id="error-bloodBank_zip"> please enter a zip code</label>                                               <label class="error" > <?php echo form_error("bloodBank_zip"); ?></label>
                                                </div>
                                            </aside>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <div class="col-sm-8 col-sm-offset-4">
                                            <input type="text" class="form-control" name="bloodBank_add" id="geocomplete" placeholder="209, ABC Road, near XYZ Building " value="<?php echo set_value('bloodBank_add'); ?>"/>
                                        <label class="error" style="display:none;" id="error-bloodBank_add"> please enter an address</label>
                                            <label class="error" > <?php echo form_error("bloodBank_add"); ?></label>
                                        </div>
                                    </article>

                              
                                    
                                     <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4  col-sm-4">Phone:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <a href="javascript:void(0)" class="add pull-right" rel=".clone"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a>
                                            <aside class="row clone">
                                                <div class="col-lg-3 col-md-4 col-sm-3 col-sm-4 col-xs-12 m-t-xs-10" id="multiPreNumber">
                                                    <select class="selectpicker" data-width="100%" name="pre_number[]" id="multiPreNumber">
                                                        <option value ='91'>+91</option>
                                                        <option value ='1'>+1</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-7 col-md-6 col-sm-7 col-xs-10 m-t-xs-10" id="multiPhoneNumber">
                                                    <input type="text" class="form-control" name="bloodBank_phn[]" id="bloodBank_phn1" placeholder="9837000123" maxlength="10" />
                                                    <label class="error" style="display:none;" id="error-bloodBank_phn"> please enter a valid phone number</label>
                                                    <label class="error" > <?php echo form_error("bloodBank_phn"); ?></label>
                                                </div>
                                            </aside>
                                            <p class="m-t-10">* If it is landline, include Std code with number </p>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0 ">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" name="bloodBank_cntPrsn" type="text" required="" id="bloodBank_cntPrsn" value="<?php echo set_value('bloodBank_cntPrsn'); ?>">
                                           <label class="error" style="display:none;" id="error-bloodBank_cntPrsn">please enter name properly!</label>
                                           <label class="error" > <?php echo form_error("bloodBank_cntPrsn"); ?></label>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Membership Type :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" data-width="100%" name="bloodBank_mbrTyp" id="bloodBank_mbrTyp">
                                                <option value="1">Life Time</option>
                                                <option value="2">Health Club</option>
                                            </select>
                                            <label class="error" style="display:none;" id="error-bloodBank_mbrTyp">please enter only charcters!</label>
                                            <label class="error" > <?php echo form_error("bloodBank_mbrTyp"); ?></label>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4">24/7 Services ? </label>
                                        <div class="col-md-8">
                                            <aside class="radio radio-info radio-inline">
                                                <input type="radio" id="isEmergency_yes" value="1" name="isEmergency" checked>
                                                <label for="inlineRadio1"> Yes</label>
                                            </aside>
                                            <aside class="radio radio-info radio-inline">
                                                <input type="radio" id="isEmergency_no" value="option2" name="isEmergency">
                                                <label for="inlineRadio2"> No</label>
                                            </aside>
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
                                <!-- Feature Access Section Start -->

                                <figure class="clearfix">
                                    <h3>Feature Access</h3>
                                </figure>



                                <article class="form-group m-lr-0 m-t-20 ">
                                    <label class="control-label col-md-6 col-xs-9" for="cname">Blood Availability Management :</label>
                                    <div class="col-md-6 col-xs-3">
                                        <aside class="checkbox checkbox-success m-t-5">
                                            <input type="checkbox" id="checkbox3">
                                            <label>

                                            </label>
                                        </aside>
                                    </div>
                                </article>
                                <!-- Feature Access Section Start -->


                                <!-- Account Detail Section Start -->
                                <figure class="clearfix">
                                    <h3>Account Detail</h3>
                                </figure>
                                <aside class="clearfix m-t-20 p-b-20">
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Registered Email Id:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="email" class="form-control" id="users_email" name="users_email" placeholder="abc@gmail.com" onblur="checkEmailFormat()" value="<?php echo set_value('users_email'); ?>"/>
                                            <label class="error" style="display:none;" id="error-users_email"> please enter Email id Properly</label>
                                            <label class="error" style="display:none;" id="error-users_email_check"> Email Already Exists!</label>
                                            <label class="error" > <?php echo form_error("users_email"); ?></label>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Registered Mobile no. :</label>
                                        <div class="col-md- col-sm-8">
                                            <input type="text" class="form-control" id="bloodBank_mblNo" name="bloodBank_mblNo" placeholder="8880007755" maxlength="10" value="<?php echo set_value('bloodBank_mblNo'); ?>"/>
                                            <label class="error" style="display:none;" id="error-bloodBank_mblNo"> please enter your mobile number properly</label>
                                        <label class="error" > <?php echo form_error("bloodBank_mblNo"); ?></label>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Enter Password :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="password" class="form-control" id="users_password" name="users_password" placeholder=" " />
                                            <label class="error" style="display:none;" id="error-users_password"> please enter password and it should be 6 chracter</label>
                                            <label class="error" > <?php echo form_error("users_password"); ?></label>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Confirm Password :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="password" class="form-control" id="cnfPassword" name="cnfPassword" placeholder=" " />
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
                                <button class="btn btn-danger waves-effect pull-right" type="button">Reset</button>
                                <div>
                                    <input class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit" onclick="return validationBloodbankAdd()" value="Submit" />
				</div>
                            </div>

                        </section>
                        
                          <fieldset>
                           
                            <input name="lat" type="hidden" value="">

                           <!-- <label>Longitude</label> -->
                            <input name="lng" type="hidden" value="">

                          </fieldset>
                        <div id="upload_modal_form">
                            <?php $this->load->view('upload_crop_modal');?>
                        </div>
                    </form>

                </div>

                <!-- container -->
            </div>
            <!-- content -->
            