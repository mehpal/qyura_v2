 <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">


                    <div class="clearfix">
                        <div class="col-md-12 text-success">
                            <?php //echo $this->session->flashdata('message'); ?>
                        </div>
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Add New Ambulance</h3>

                        </div>
                    </div>
                    <div class="map_canvas"></div>
                     <form class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" name="submitForm" method="post" action="<?php echo site_url(); ?>/ambulance/SaveAmbulance" novalidate="novalidate" enctype="multipart/form-data" >
                        <input type="hidden" id="StateId" name="StateId" value="" />
    <div style="display:none;position:absolute;top:50%;left:45%;padding:2px;z-index: 10000" class="loader" id="defaultloader">
    <img alt="Please wait data is loading" src="<?php echo base_url('assets/images/beet.gif');?>" /> 
</div>
                       
                        <!-- Left Section Start -->
                        <section class="col-md-12 detailbox">
                            <div class="bg-white mi-form-section">
                                <article class="clearfix">
                                    <aside class="col-md-8">
                                        <div class="clearfix m-t-20 p-b-20">
                                            <article class="clearfix m-t-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Ambulance Name :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input class="form-control" id="ambulance_name" name="ambulance_name" type="text" required="" value="<?php echo set_value('ambulance_name'); ?>">
                                                    <label class="error" style="display:none;" id="error-ambulance_name"> please enter ambulance name only alphabetically!</label>
                                                    <label class="error" > <?php echo form_error("ambulance_name"); ?></label>
                                                </div>
                                            </article>
                                            <article class="clearfix m-t-10">
                                                <label for="cname" class="control-label col-md-4 col-sm-4">Ambulance Type :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <select class="form-control select2" data-width="100%" name="ambulanceType">
                                        <option value='1' <?php echo set_select('ambulanceType', '1'); ?>>Emergency</option>
                                        <option value='2' <?php echo set_select('ambulanceType', '2'); ?>>Patient Transport</option>
					<option value='3' <?php echo set_select('ambulanceType', '3'); ?>>Response Unit</option>
                                        <option value='4' <?php echo set_select('ambulanceType', '4'); ?>>Charity Ambulance</option>
					<option value='5' <?php echo set_select('ambulanceType', '5'); ?>>Bariatric Ambulance</option>
                                                       
                                                    </select>
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
                                        
                                   <img src="<?php echo base_url() ?>assets/default-images/ambulance_logo.png"  class="image-preview-show"/>
                                        
                                    </div>
                                    </div>

                                    <label class="error" > <?php echo form_error("avatar_file"); ?></label>
                                    <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                                    
                                    
                                    
                                </div>
                                
                            </article>


                                            <article class="clearfix m-t-10">
                                                <label for="cname" class="control-label col-md-4 col-sm-4">Address:</label>
                                                <div class="col-md-8 col-sm-8">
                                                            <select class="form-control select2" data-width="100%" name="ambulance_countryId" id="ambulance_countryId">
                                                               <option value=''>Select Country</option>
                                                                <option value="1" <?php echo set_select('ambulance_countryId', '1'); ?>>INDIA</option>
                                                              
                                                            </select>
                                                            <label class="error" style="display:none;" id="error-ambulance_countryId"> please select a country</label>
                                                            <label class="error" > <?php echo form_error("ambulance_countryId"); ?></label>
                                                        </div>
                                            </article>
                                            <article class="clearfix">
                                                <div class="col-sm-8 col-sm-offset-4">
                                             <select class="form-control select2" data-width="100%" name="ambulance_stateId" Id="ambulance_stateId" data-size="4" onchange ="fetchCity(this.value)">
                                                        <option value="">Select State</option>
                                                       <?php foreach($allStates as $key=>$val) {?>
                                                        <option value="<?php echo $val->state_id;?>" <?php echo set_select('ambulance_stateId', $val->state_id); ?>><?php echo $val->state_statename;?></option>
                                                         <?php }?>
                                                    </select>
                                                    <label class="error" style="display:none;" id="error-ambulance_stateId"> please select a state</label>
                                                    <label class="error" > <?php echo form_error("ambulance_stateId"); ?></label>
                                                </div>
                                             </article>

                                            <article class="clearfix">
                                                <div class="col-sm-8 col-sm-offset-4">
                                                    <select class="form-control select2" data-width="100%" name="ambulance_cityId" id="ambulance_cityId" data-size="4">
                                                      <option value="">Select City</option>
                                                      <?php if(isset($citys) && !empty($citys)){?>
                                                       <?php foreach($citys as $key=>$city) {?>
                                                        <option value="<?php echo $city->city_id;?>" <?php echo set_select('ambulance_cityId', $city->city_id); ?>><?php echo $city->city_name;?></option>
                                                      <?php }}?>
                                                      
                                                    </select>
                                                    <label class="error" style="display:none;" id="error-ambulance_cityId"> please select a city</label>
                                                    <label class="error" > <?php echo form_error("ambulance_cityId"); ?></label>
                                        </div>
                                            </article>
                                            
                                              <article class="clearfix m-t-10">
                                                <div class="col-sm-8 col-sm-offset-4">
                                               <input type="text" class="form-control" id="ambulance_zip" name="ambulance_zip" placeholder="Zip code" maxlength="6" minlength="6"  onkeypress="return isNumberKey(event)" value="<?php echo set_value('ambulance_zip'); ?>"/>
                                                <label class="error" style="display:none;" id="error-ambulance_zip"> please enter a zip code</label>   
                                                <label class="error" > <?php echo form_error("ambulance_zip"); ?></label>
                                                </div>
                                             </article>
                                            
                                               <input type="hidden" <?php echo set_radio('isManual', 1, TRUE); ?>  name="isManual" value="1" id="isManual">
<!--                                            <article class="clearfix m-t-10">
                                                <label class="control-label col-md-4" for="cname">Manual :</label>
                                                <div class="col-md-8">
                                                    <aside class="radio radio-info radio-inline">
                                                        <input type="radio"  name="isManual" value="1" id="isManual" onclick="IsAdrManual(this.value)" <?php //echo set_radio('isManual', '1', TRUE); ?>>
                                                        <label for="inlineRadio1"> Yes</label>
                                                    </aside>
                                                    <aside class="radio radio-info radio-inline">
                                                        <input type="radio"  name="isManual" value="0" id="isManual" onclick="IsAdrManual(this.value)" <?php //echo set_radio('isManual', '0'); ?>>
                                                        <label for="inlineRadio2"> No</label>
                                                    </aside>
                                                </div>
                                            </article>-->
                                            
                                           <article class="clearfix m-t-10">

                                        <div class="col-sm-8 col-sm-offset-4">
                                            <input type="text" class="form-control" name="ambulance_address" id="geocompleteSearch" placeholder="address" value="<?php echo set_value('ambulance_address'); ?>" />
                                        <label class="error" style="display:none;" id="error-ambulance_address"> please enter an address</label>
                                            <label class="error" > <?php echo form_error("ambulance_address"); ?></label> 
                                        </div>
                                    </article>
                                     <article class="clearfix m-t-10">
                                             <label class="control-label col-sm-4" for="cname">Latitude & Longitude</label>
                                                <div class="col-sm-8">
                                             <aside class="row m-b-10">
                                              <div class="col-sm-6">
                                                 <input name="lat" class="form-control" placeholder="Longitude" required="" type="text" value="<?php echo set_value('lat'); ?>"  id="lat"  value="<?php echo set_value('lat'); ?>"/>
                                             <label class="error" style="display:none;" id="error-lat">Please enter the correct format for latitude</label>
                                              <label class="error" > <?php echo form_error("lat"); ?></label> 
                                             
                                              </div>
                                               <div class="col-sm-6 m-t-xs-10">
  <input name="lng" class="form-control" placeholder="Latitude" required="" type="text" value="<?php echo set_value('lng'); ?>"  id="lng" value="<?php echo set_value('lng'); ?>"/>
                                             <label class="error" style="display:none;" id="error-lng"> Please enter the correct format for longitude</label>
                                              <label class="error" > <?php echo form_error("lng"); ?></label> 
                                                </div>
                                             </aside>
                                             </div>
                                             </article>
                                      
                                    <article class="clearfix m-t-10">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Registered Email Id:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="email" class="form-control" id="users_email" name="users_email" placeholder="" onblur="checkEmailFormat()" value="<?php echo set_value('users_email'); ?>"/>
                                            <label class="error" style="display:none;" id="error-users_email"> please enter Email id Properly</label>
                                            <label class="error" style="display:none;" id="error-users_email_check"> Email Already Exits!</label>
                                            <input type="hidden" class="form-control" id="users_email_status" name="users_email_status" value="" />
                                            <label class="error" > <?php echo form_error("users_email"); ?></label>
                                        </div>
                                    </article>
                                            
                                      <article class="clearfix m-t-10">
                                <label class="control-label col-md-4 col-sm-4" for="cname"> Phone :</label>
                                <div class="col-md-8 col-sm-8">
                                     <input type="text" class="form-control" name="ambulance_phn" id="ambulance_phn" maxlength="10" minlength="10" onkeypress="return isNumberKey(event)" <?php set_value('ambulance_phn') ?> />

                                    <label class="error" style="display:none;" id="error-ambulance_phn"> please enter a valid phone min length should be min 10 and max 10</label>
                                  
                                    <label class="error" > <?php echo form_error("ambulance_phn"); ?></label>
                                    <label class="error"> </label>
  <p class="m-t-0">* The number above is going to be your primary number.</p>
                                </div>
                            </article>
                                            
<!--                                            
                                             <article class="clearfix m-t-10">
                                        <label for="cname" class="control-label col-md-4  col-sm-4">Mobile No. :</label>
                                        <div class="col-md-8 col-sm-8">
                                         
                                              
                                                    <input type="text" class="form-control" name="users_mobile" id="users_mobile" placeholder="" maxlength="10"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="<?php echo set_value('users_mobile'); ?>"/>
                                                    <label class="error" style="display:none;" id="error-users_mobile"> please enter a valid mobile number</label>
                                                    <label class="error" > <?php echo form_error("users_mobile"); ?></label>
                                            
                                        </div>
                                    </article>-->
                                            
                                            <article class="form-group m-lr-0 ">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" name="ambulance_cntPrsn" type="text" required="" id="ambulance_cntPrsn" value="<?php echo set_value('ambulance_cntPrsn'); ?>">
                                           <label class="error" style="display:none;" id="error-ambulance_cntPrsn">please enter name properly!</label>
                                           <label class="error" > <?php echo form_error("ambulance_cntPrsn"); ?></label>
                                        </div>
                                    </article>

                                           <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Membership Type :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="select2" data-width="100%" name="ambulance_mmbrTyp" id="ambulance_mmbrTyp">
                                            
                                                <option value="1" <?php echo set_select('ambulance_mmbrTyp', '1'); ?>>Life Time</option>
                                                <option value="2" <?php echo set_select('ambulance_mmbrTyp', '2'); ?>>Health Club</option>
                                            </select>
                                            <label class="error" style="display:none;" id="error-ambulance_mmbrTyp">please enter only charcters!</label>
                                            <label class="error" > <?php echo form_error("ambulance_mmbrTyp"); ?></label>
                                        </div>
                                    </article>
                                           <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4">24/7 Services ? </label>
                                        <div class="col-md-8">
                                            <aside class="radio radio-info radio-inline">
                                                <input type="radio" id="isEmergency_yes" value="1" name="isEmergency" checked <?php echo set_radio('isEmergency', '1'); ?>>
                                                <label for="inlineRadio1"> Yes</label>
                                            </aside>
                                            <aside class="radio radio-info radio-inline">
                                                <input type="radio" id="isEmergency_no" value="0" name="isEmergency" <?php echo set_radio('isEmergency', '0'); ?>>
                                                <label for="inlineRadio2"> No</label>
                                            </aside>
                                        </div>
                                    </article>

                           <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4">Doctor On Board </label>
                                        <div class="col-md-8">
                                            <aside class="">
                                                <input type="checkbox" id="docOnBoard" value="1" name="docOnBoard" <?php echo set_radio('isDoctorAvl', '1'); ?>>
                                                
                                            </aside>
                                       
                                        </div>
                                    </article>

                             <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4">Docat Id : </label>
                                <div class="col-md-8 col-sm-8">
                                    <input class="form-control" name="ambulance_docatId" type="text" required="" id="ambulance_docatId" value="<?php echo set_value('ambulance_docatId'); ?>">
                                    <label class="error" style="display:none;" id="error-ambulance_docatId">please enter Docat Id.</label>
                                    <label class="error" > <?php echo form_error("ambulance_docatId"); ?></label>
                                </div>
                            </article>
                                    </aside>
                                </article>
                                </div>
                                <!-- .form -->
                        

                        </section>
                        <!-- Left Section End -->


                            <section>
                            <div class="col-md-12 m-t-20 m-b-20">
                               
                                <div>
                                        <button class="btn btn-danger waves-effect pull-right" type="reset" id="resetBtn" onclick="location.reload();">Reset</button>
                                    <input class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit" value="Submit" />
                                </div>
                            </div>

                        </section>

                        <fieldset>


                          </fieldset>
                 
                    </form>


                    <!-- consultation -->

                </div>

                <!-- container -->
            </div>
            
            <!-- content -->
           
