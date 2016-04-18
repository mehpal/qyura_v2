<!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">

                    <div class="clearfix">
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Add New Diagnostic Center</h3>

                        </div>
                   <div class="map_canvas"></div>
                    <form class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" name="diagnosticForm" method="post" action="<?php echo site_url(); ?>/diagnostic/SaveDiagnostic" novalidate="novalidate" enctype="multipart/form-data" >
                        <input type="hidden" id="countPnone" name="countPnone" value="1" />
                       <input type="hidden" id="StateId" name="StateId" value="" />
                       <div class="col-md-12 text-success"><?php echo $this->session->flashdata('message'); ?></div>
                        <!-- Left Section Start -->
                        <section class="col-md-6 detailbox">
                            <div class="bg-white mi-form-section">
                                <figure class="clearfix">
                                    <h3>General Detail</h3>
                                </figure>
                                <!-- Table Section End -->
                                <div class="clearfix m-t-20 p-b-20">
                                    <article class="clearfix m-t-10">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Diagnostic Center Name </label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" id="diagnostic_name" name="diagnostic_name" type="text" required="" value="<?php echo set_value('diagnostic_name'); ?>">
                                             <label class="error" style="display:none;" id="error-diagnostic_name"> please enter diagnostic name only alphabet character's</label>
                                            <label class="error" > <?php echo form_error("diagnostic_name"); ?></label>
                                        </div>
                                    </article>
                                    <article class="clearfix m-t-10">
                                        <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                                        <div class="col-md-8 col-sm-8 text-right avatar-view">
                                            <label for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x "></i></label>
<!--                                            <input type="file" style="display:none;" class="no-display" id="file-input" name="diagnostic_img">-->
                                             <label class="error" > <?php echo form_error("diagnostic_img"); ?></label>
                                            <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                                            <img style="border:1px solid #777777;" src="<?php echo base_url();?>assets/default-images/Dignostics-logo.png" width="70" height="65" class="image-preview-show"/>
                                             
                                        </div>
                                    </article>

                                    <article class="clearfix m-t-10">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Address:</label>
                                        <div class="col-md-8 col-sm-8">
                                                    <select class="selectpicker form-control" data-width="100%" name="diagnostic_countryId" id="diagnostic_countryId">
                                                        <option value=''>Select Country</option>
                                                        <option value="1">India</option>
                                                        </select>
                                                         <label class="error" style="display:none;" id="error-diagnostic_countryId"> please select a country</label>
                                                    <label class="error" > <?php echo form_error("diagnostic_countryId"); ?></label>
                                        </div>
                                    </article>
                                   <article class="clearfix">
                                        <div class="col-md-8  col-sm-8 col-sm-offset-4">
					<select class="selectpicker form-control" data-width="100%" name="diagnostic_stateId" id="diagnostic_stateId" data-size="4" onchange ="fetchCity(this.value)">

                                                        <option value="">Select State</option>
                                                       <?php foreach($allStates as $key=>$val) {?>
                                                        <option value="<?php echo $val->state_id;?>"><?php echo $val->state_statename;?></option>
                                                         <?php }?>
                                                    </select>
                                                    <label class="error" style="display:none;" id="error-diagnostic_stateId"> please select a state</label>
                                                    <label class="error" > <?php echo form_error("diagnostic_stateId"); ?></label>
                                        </div>
                                    </article>

                                   <article class="clearfix">
                                        <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                            
                                                    <select class="selectpicker form-control" data-width="100%" name="diagnostic_cityId" id="diagnostic_cityId" data-size="4">
                                                        <!--<option>Select City</option>
                                                        <option>Kolkata</option>
                                                        <option>Delhi</option>-->
                                                    </select>
                                                    <label class="error" style="display:none;" id="error-diagnostic_cityId"> please select a city</label>
                                                     <label class="error" > <?php echo form_error("diagnostic_cityId"); ?></label>
                                               
                                        </div>
                                    </article>

                                    <article class="clearfix">
                                        <div class="col-md-8  col-sm-8 col-sm-offset-4">
 <input type="text" class="form-control" id="diagnostic_zip" name="diagnostic_zip" placeholder="700001" value="<?php echo set_value('diagnostic_zip'); ?>" maxlength="6" />
                                                    <label class="error" style="display:none;" id="error-diagnostic_zip"> please enter a zip code</label>
                                                    <label class="error" style="display:none;" id="error-diagnostic_zip_long"> zip code should be 6 digit long</label>
                                                    <label class="error" > <?php echo form_error("diagnostic_zip"); ?></label>
                                        </div>
                                    </article>
                                    
                                     <article class="clearfix">
                                        <label class="control-label col-md-4" for="cname">Manual</label>
                                        <div class="col-md-8">
                                            <aside class="radio radio-info radio-inline">
                                                <input type="radio"  name="isManual" value="1" id="isManual" onclick="IsAdrManual(this.value)">
                                                <label for="inlineRadio1"> Yes</label>
                                            </aside>
                                            <aside class="radio radio-info radio-inline">
                                                <input type="radio" checked="" name="isManual" value="0" id="isManual" onclick="IsAdrManual(this.value)">
                                                <label for="inlineRadio2"> No</label>
                                            </aside>
                                        </div>
                                    </article>

                                    <article class="clearfix m-t-10">
                                        <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                            <input type="text" class="form-control" id="geocomplete" name="diagnostic_address" placeholder="209, ABC Road, near XYZ Building " value="<?php echo set_value('diagnostic_address'); ?>"/>
                                            
                                            
                                             
                                            <label class="error" style="display:none;" id="error-diagnostic_address"> please enter an address</label>
                                            <label class="error" > <?php echo form_error("diagnostic_address"); ?></label>
                                        </div>
                                    </article>

                                   <article class="clearfix">
                                        <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                            <aside class="row">
                                             <div class="col-sm-6">
                                             <input name="lat" class="form-control" placeholder="Longitude" required="" type="text" value="<?php echo set_value('lat'); ?>"  id="lat" readonly=""  />
                                             <label class="error" style="display:none;" id="error-lat">Please enter the correct format for latitude</label>                             </div>
                                            <div class="col-sm-6 m-t-xs-10">
                                            <input name="lng" class="form-control" placeholder="Latitude" required="" type="text" value="<?php echo set_value('lng'); ?>"  id="lng" readonly="" />
                                             <label class="error" style="display:none;" id="error-lng"> Please enter the correct format for longitude</label>                         </div>
                                             </aside>
                                        </div>
                                    </article>

                                    <article class="clearfix m-t-10">
                                        <label for="cname" class="control-label col-md-4  col-sm-4">Phone:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <div id="multuple_phone_load">
                                            <aside class="row" id="phone_list">
                                                <div class="col-lg-3 col-md-4 col-sm-3 col-sm-4 col-xs-12 m-t-xs-10" id="multiPreNumber">
                                        <select class="selectpicker" data-width="100%" name="pre_number[]" id="multiPreNumber1">
                                            <option value ='91'>+91</option>
                                        </select>
                                                    
                                             </div>
                                           
                                                <div class="col-lg-7 col-md-6 col-sm-7 col-xs-10 m-t-xs-10" id="multiPhoneNumber">
               <input type="text" class="form-control" name="diagnostic_phn[]" id="diagnostic_phn1" placeholder="9837000123" maxlength="10" onkeypress="return isNumberKey(event)"/>
                                                    <label class="error" style="display:none;" id="error-diagnostic_phn1"> please enter a valid phone number</label>
                                                    <label class="error" > <?php echo form_error("diagnostic_phn1"); ?></label>
                                                </div>
                                                <div class="col-md-2 col-sm-2 col-xs-2 m-t-xs-10"><a href="javascript:void(0)" onclick="countPhoneNumber()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a></div>

                                            </aside>
                                            </div>
                                            <p class="m-t-10">* If it is landline, include Std code with number </p>
                                        </div>
                                    </article>

                                    <article class="clearfix m-t-10">
                                        <label for="cemail" class="control-label col-md-4  col-sm-4">Contact Person :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" id="diagnostic_cntPrsn" name="diagnostic_cntPrsn" type="text" required="" value="<?php echo set_value('diagnostic_cntPrsn'); ?>">
                                            <label class="error" style="display:none;" id="error-diagnostic_cntPrsn"> please enter the name of a contact person</label>
                                            <label class="error" > <?php echo form_error("diagnostic_cntPrsn"); ?></label>
                                        </div>
                                    </article>
                                    
                                       <article class="clearfix m-t-10">
                                        <label class="control-label col-md-4 col-sm-4" for="cemail">Designation :</label>
                                        <div class="col-md-8 col-sm-8">
                                        <input  class="form-control" type="text" required="" name="diagnostic_dsgn" id="diagnostic_dsgn">
                                         <label class="error" style="display:none;" id="error-diagnostic_dsgn"> please enter the  contact person designation only alphabet character's</label>
                                        <label class="error" > <?php echo form_error("diagnostic_dsgn"); ?></label>
                                        </div>
                                        </article>

                                    <article class="clearfix m-t-10">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Membership Type :</label>
                                        <div class="col-md-8  col-sm-8">
                                            <select class="selectpicker" data-width="100%" name="diagnostic_mbrTyp" id="diagnostic_mbrTyp">
                                                <option value="1">Life Time</option>
                                                <option value="2">Health Club</option>
                                            </select>
                                            <label class="error" style="display:none;" id="error-diagnostic_mbrTyp"> please select a member type</label>
                                            <label class="error" > <?php echo form_error("diagnostic_mbrTyp"); ?></label>
                                        </div>
                                    </article>

                                    <article class="clearfix m-t-10">
                                        <label class="control-label col-md-4 col-sm-4" for="cname">About Us :</label>
                                        <div class="col-md-8  col-sm-8">
                                           <textarea value="" id="aboutUs" name="aboutUs" class="form-control"> </textarea>
                                            <label class="error"> </label>
                                          
                                            <label class="error" style="display:none;" id="error-aboutUs"> Please write about the diagnostic!</label>
                                            <label class="error" > <?php echo form_error("aboutUs"); ?></label>
                                           
                                        </div>
                                    </article>
                                    
                                    
                                </div>
                                <!-- .form -->
                            </div>
                         <fieldset>
                           
                            <input name="lat" type="hidden" value="">

                           <!-- <label>Longitude</label> -->
                            <input name="lng" type="hidden" value="">

                           
                          </fieldset>
                        </section>
                        <!-- Left Section End -->



                        <!-- Right Section Start -->
                        <section class="col-md-6 detailbox mi-form-section">
                            <div class="bg-white clearfix">
                                <!-- Feature Access Section Start -->

<!--                                <figure class="clearfix">
                                    <h3>Feature Access</h3>
                                </figure>

                                <article class="clearfix m-t-20 p-b-20">
                                    <div class="col-md-11">

                                        <article class="clearfix">
                                            <label class="control-label col-md-6 col-xs-9" for="cname">Doctor Management</label>
                                            <div class="col-md-6 col-xs-3">
                                                <aside class="checkbox checkbox-success m-t-5">
                                                    <input type="checkbox" id="checkbox3">
                                                    <label>

                                                    </label>
                                                </aside>
                                            </div>
                                        </article>

                                        <article class="clearfix">
                                            <label class="control-label col-md-6 col-xs-9" for="cname">App Consultation Booking </label>
                                            <div class="col-md-6 col-xs-3">
                                                <aside class="checkbox checkbox-success m-t-5">
                                                    <input type="checkbox" id="checkbox3">
                                                    <label>

                                                    </label>
                                                </aside>
                                            </div>
                                        </article>

                                        <article class="clearfix">
                                            <label class="control-label col-md-6 col-xs-9" for="cname">Diagnostic Management </label>
                                            <div class="col-md-6 col-xs-3">
                                                <aside class="checkbox checkbox-success m-t-5">
                                                    <input type="checkbox" id="checkbox3">
                                                    <label>

                                                    </label>
                                                </aside>
                                            </div>
                                        </article>

                                        <article class="clearfix">
                                            <label class="control-label col-md-6 col-xs-9" for="cname">App Diagnostic Booking</label>
                                            <div class="col-md-6 col-xs-3">
                                                <aside class="checkbox checkbox-success m-t-5">
                                                    <input type="checkbox" id="checkbox3">
                                                    <label>

                                                    </label>
                                                </aside>
                                            </div>
                                        </article>

                                        <article class="clearfix">
                                            <label class="control-label col-md-6 col-xs-9" for="cname">Healthcare Packages </label>
                                            <div class="col-md-6 col-xs-3">
                                                <aside class="checkbox checkbox-success m-t-5">
                                                    <input type="checkbox" id="checkbox3">
                                                    <label>

                                                    </label>
                                                </aside>
                                            </div>
                                        </article>


                                        <article class="clearfix m-t-5">
                                            <label class="control-label col-md-6 col-xs-9" for="cname">Healthcare Package Booking</label>
                                            <div class="col-md-6 col-xs-3">
                                                <aside class="checkbox checkbox-success m-t-5">
                                                    <input type="checkbox" id="checkbox3">
                                                    <label>

                                                    </label>
                                                </aside>
                                            </div>
                                        </article>

                                    </div>
                                </article>-->
                                <!-- Feature Access Section Start -->


                                <!-- Account Detail Section Start -->
                                <figure class="clearfix">
                                    <h3>Account Detail</h3>
                                </figure>
                                <aside class="clearfix m-t-20 p-b-20">
                                    <article class="clearfix m-t-10">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Registered Email Id:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="email" class="form-control" id="users_email" name="users_email" placeholder="abc@gmail.com" onblur="checkEmailFormat();" value="<?php echo set_value('users_email'); ?>"/>
                                            <label class="error" style="display:none;" id="error-users_email"> please enter Email id Properly</label>
                                            <label class="error" style="display:none;" id="error-users_email_check"> Email Already Exits!</label>
                                            <label class="error" > <?php echo form_error("users_email"); ?></label>
                                            <input type="hidden" class="form-control" id="users_email_status" name="users_email_status" value="" />
                                        </div>
                                    </article>

                                     <article class="clearfix m-t-10">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Registered Mobile no. :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="text" class="form-control" id="diagnostic_mblNo" name="diagnostic_mblNo" placeholder="8880007755" maxlength="10" value="<?php echo set_value('diagnostic_mblNo'); ?>" onkeypress="return isNumberKey(event)"/>
                                            <label class="error" style="display:none;" id="error-diagnostic_mblNo"> please enter your mobile number</label>
                                        <label class="error" style="display:none;" id="error-diagnostic_mblNo_check">please enter digits only!</label>
                                            <label class="error" > <?php echo form_error("diagnostic_mblNo"); ?></label>

                                        </div>
                                    </article>


                                    <article class="clearfix m-t-10">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Enter Password :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="password" class="form-control" id="users_password" name="users_password" placeholder=" " />
                                            <label class="error" style="display:none;" id="error-users_password"> please enter password and it should be 6 chracter</label>
                                            <label class="error" > <?php echo form_error("users_password"); ?></label>
                                        </div>
                                    </article>

                                     <article class="clearfix m-t-10">
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
                               <div id="upload_modal_form">
                            <?php $this->load->view('upload_crop_modal');?>
                        </div>
                        </section>
                        <section class="clearfix ">
                            <div class="col-md-12 m-t-20 m-b-20">
                                <button type="reset" class="btn btn-danger waves-effect pull-right" type="button">Reset</button>
                                <input class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit" onclick="return validationDiagnostic()" value="Submit" />
                            </div>

                        </section>
                      
                    </form>
                </div>

                <!-- container -->
            </div>
            <!-- content -->
          
