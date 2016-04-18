 <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">


                    <div class="clearfix">
                        <?php $succ_msg = $this->session->flashdata('message'); 
                        if(isset($succ_msg) && $succ_msg != NULL){?>
                        <div class="col-md-12 text-success">
                            <script>alert('<?php echo $succ_msg; ?>');</script>
                        </div>
                        <?php } ?>
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Setting</h3>

                        </div>
                    </div>
                    <div class="map_canvas"></div>
                     <form class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" name="submitForm" method="post" action="<?php echo site_url(); ?>/setting/config/<?php //echo $users[0]->users_id;?>" novalidate="novalidate" enctype="multipart/form-data" >
                        <input type="hidden" id="StateId" name="StateId" value="" />
                       
                        <!-- Left Section Start -->
                        <section class="col-md-12 detailbox">
                            <div class="bg-white mi-form-section">
                                <article class="clearfix">
                                    <aside class="col-md-8">
                                        <div class="clearfix m-t-20 p-b-20">
                                          
                                             <article class="form-group m-lr-0 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">User Name :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input class="form-control" id="user_name" name="user_name" type="text" required="" value="<?php if(!empty($users[0]->name)): echo ucwords($users[0]->name);endif;?>">
                                                    <label class="error" style="display:none;" id="error-user_name"> please enter user name</label>
                                                    <label class="error" > <?php echo form_error("user_name"); ?></label>
                                                </div>
                                            </article>
                                            <article class="form-group m-lr-0 ">
                                                <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Image :</label>
                                                <div class="col-md-8 col-sm-8 text-right">
                                                        <label for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x avatar-view"></i></label>
                                                     <input type="file" style="display:none;" class="no-display avatar-view" id="healthtip_img" name="healthtip_img">
                                            <img src="" width="70" height="65" class="image-preview-show"/>
                                            <label class="error" > <?php echo form_error("sa_img"); ?></label>
                                            <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                                                </div>
                                            </article>
                                            
                                            
                                             <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Date Of Birth :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <div class="input-group">
                                                <input class="form-control pickDate" placeholder="dd/mm/yyyy" id="date-3" type="text" onkeydown="return false;" value="<?php if(!empty($users[0]->patientDetails_dob)): echo date('m/d/Y',  $users[0]->patientDetails_dob);endif;?>" name="dob">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                        </div>
                                    </article>
                                            
                                              <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Email :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="email" class="form-control" id="users_email" name="users_email" placeholder="abc@gmail.com"  value="<?php if(!empty($users[0]->users_email)): echo $users[0]->users_email;endif;?>" readonly=""/>
                                            <label class="error" style="display:none;" id="error-users_email"> please enter Email id Properly</label>
                                            <label class="error" style="display:none;" id="error-users_email_check"> Email Already Exits!</label>
                                            <label class="error" > <?php echo form_error("users_email"); ?></label>
                                        </div>
                                    </article>
                                            

                                               <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4  col-sm-4">Mobile No. :</label>
                                        <div class="col-md-8 col-sm-8">
                                      
                                             
                                         
                                                    <input type="text" class="form-control" name="users_mobile" id="users_mobile" placeholder="9837000123" maxlength="10"  onkeypress="return isNumberKey(event)" value="<?php if(!empty($users[0]->users_mobile)): echo ucwords($users[0]->users_mobile);endif;?>"/>
                                                    <label class="error" style="display:none;" id="error-users_mobile"> please enter a valid mobile number</label>
                                                    <label class="error" > <?php echo form_error("users_mobile"); ?></label>
                                        
                                          
                                            
                                        </div>
                                    </article>
                                            
                                             <article class="form-group m-lr-0">
                                                <label for="cname" class="control-label col-md-4 col-sm-4">Address:</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <aside class="row">
                                                        <div class="col-md-6 col-sm-6">
                                                            <select class="select2" data-width="100%" name="setting_countryId" id="setting_countryId">
                                                               <option value="">Select Country</option>
                                                                <option value="1" <?php if(!empty($users[0]->patientDetails_countryId) && $users[0]->patientDetails_countryId == 1): echo "selected";endif;?>>INDIA</option>
                                                              
                                                            </select>
                                                            <label class="error" style="display:none;" id="error-ambulance_countryId"> please select a country</label>
                                                            <label class="error" > <?php echo form_error("setting_countryId"); ?></label>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                        <select class="select2" data-width="100%" name="setting_stateId" Id="setting_stateId" data-size="4" onchange ="fetchCity(this.value)">
                                                        <option value="">Select State</option>
                                                       <?php foreach($allStates as $key=>$val) {?>
                                                        <option value="<?php echo $val->state_id;?>" <?php if(!empty($users[0]->patientDetails_stateId) && $users[0]->patientDetails_stateId == $val->state_id): echo "selected";endif;?>><?php echo $val->state_statename;?></option>
                                                         <?php }?>
                                                    </select>
                                                    <label class="error" style="display:none;" id="error-setting_stateId"> please select a state</label>
                                                    <label class="error" > <?php echo form_error("setting_stateId"); ?></label>
                                                </div>
                                                    </aside>
                                                </div>
                                            </article>

                                            <article class="form-group m-lr-0">
                                                <div class="col-sm-8 col-sm-offset-4">
                                            <aside class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <select class="select2" data-width="100%" name="setting_cityId" id="setting_cityId" data-size="4">
                                                        <option value="">Select City</option>
                                                        <?php if(isset($cityData) && !empty($cityData)){
                                                              foreach($cityData as $citys){ ?>
                                                                  
                                                 <option value="<?php echo $citys->city_id;?>" <?php if($citys->city_id == $users[0]->patientDetails_cityId){echo"selected";}?>><?php echo $citys->city_name;?></option>
                                                                  
                                                             <?php }}?>
                                                        
                                                    </select>
                                                     <input type="hidden" class="form-control" name="city" id="city" value="<?php if(!empty($users[0]->patientDetails_cityId)): echo $users[0]->patientDetails_cityId;endif;?>"/>
                                                     
                                                    <label class="error" style="display:none;" id="error-ambulance_cityId"> please select a city</label>

                                                </div>
                                                        
                                                <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                    <input type="text" class="form-control" id="zip" name="zip" placeholder="700001" maxlength="13"  onkeypress="return isNumberKey(event)" value="<?php if(!empty($users[0]->patientDetails_pin)): echo $users[0]->patientDetails_pin;endif;?>"/>
                                                <label class="error" style="display:none;" id="error-ambulance_zip"> please enter a zip code</label>   
                                                <label class="error" > <?php echo form_error("zip"); ?></label>
                                                </div>                                            
                                            </aside>
                                        </div>
                                            </article>

                                           <article class="form-group m-lr-0">
                                        <div class="col-sm-8 col-sm-offset-4">
                                            <input type="text" class="form-control" name="address" id="geocomplete" placeholder="209, ABC Road, near XYZ Building " value="<?php if(!empty($users[0]->patientDetails_address)): echo $users[0]->patientDetails_address;endif;?>"/>
                                        <label class="error" style="display:none;" id="error-ambulance_address"> please enter an address</label>
                                            <label class="error" > <?php echo form_error("ambulance_address"); ?></label>
                                        </div>
                                    </article>
                                            
                                            <a href="javascript:void(0)" class="col-md-offset-4" onClick="showPassword()">Change Password</a> 
                                            <br><br>
                                  <div style="display: none;" id="changePassword">       
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Enter Password :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="password" class="form-control" id="users_password" name="users_password" placeholder=" " />
                                            <label class="error" style="display:none;" id="error-users_password"> please enter password and shoul be 6 chracter</label>
                                            <label class="error" > <?php echo form_error("users_password"); ?></label>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Confirm Password :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="password" class="form-control" id="cnfPassword" name="cnfPassword" placeholder=" " />
                                           <!-- <label class="error" style="display:none;" id="error-cnfPassword"> please enter the password</label>-->
                                            <label class="error" style="display:none;" id="error-cnfPassword_check">Passwords do not match!</label>
                                             <label class="error" > <?php echo form_error("cnfPassword"); ?></label>
                                        </div>
                                    </article>
                                  </div>      

                                    </aside>
                                </article>
                                </div>
                                <!-- .form -->
                            </section>
                            <!-- Left Section End -->
                            <section class="clearfix ">
                            <div class="col-md-12 m-t-20 m-b-20">
                              
                                <div>
                                    <input class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit"  value="Submit" />
                                </div>
                            </div>

                        </section>
                    </form>
                    <!-- consultation -->
                </div>
                <!-- container -->
            </div>
                 <div id="upload_modal_form">
                    <?php $this->load->view('upload_crop_modal');?>
                </div>
            <!-- content -->
           