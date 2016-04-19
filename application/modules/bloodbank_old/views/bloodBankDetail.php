<!-- Start right Content here -->
<div class="content-page">
<!-- Start content -->
<div class="content">
   <div class="container row">
      <div class="clearfix">
         <!--<div class="col-md-12 text-success">
            <?php //echo $this->session->flashdata('message'); ?>
         </div> -->
         <div class="col-md-12">
            <h3 class="pull-left page-title">Bloodbank Detail </h3>
            <a href="<?php echo site_url('bloodbank');?>" class="btn btn-appointment btn-back waves-effect waves-light pull-right"><i class="fa fa-angle-left"></i> Back</a>
         </div>
      </div>
      <!-- Left Section Start -->
      <section class="col-md-12 detailbox m-t-10">
         <div class="bg-white">
            <!-- Table Section Start -->
            <section class="col-md-12">
               <aside class="clearfix m-bg-pic">
                  <div class="bg-picture text-center" style="background-image:url('<?php if(isset($bloodBankData[0]->bloodBank_background_img) && !empty($bloodBankData[0]->bloodBank_background_img)): echo base_url().'assets/BloodBank/'.$bloodBankData[0]->bloodBank_background_img; else : echo base_url().'assets/default-images/bloodbank.jpg'; endif;?>')">
                     <div class="bg-picture-overlay"></div>
                     <div class="profile-info-name">
                        <div class='pro-img'>
                           <!-- image -->
                           <?php if(!empty($bloodBankData[0]->bloodBank_photo)){
                              ?>
                           <img src="<?php echo base_url()?>assets/BloodBank/thumb/original/<?php echo $bloodBankData[0]->bloodBank_photo; ?>" alt="" class="logo-img" />
                           <?php } else { ?>
                           <img src="<?php echo base_url()?>assets/default-images/Blood-logo.png" alt="" class="logo-img" />
                           <?php } ?>
                           <article class="logo-up avatar-view" style="display:none">
                              <?php if(!empty($bloodBankData[0]->bloodBank_photo)){
                                 ?>
                              <img src="<?php echo base_url()?>assets/BloodBank/thumb/original/<?php echo $bloodBankData[0]->bloodBank_photo; ?>" alt="" class="logo-img" />
                              <?php } else { ?>
                              <img src="<?php echo base_url()?>assets/default-images/Blood-logo.png" alt="" class="logo-img" />
                              <?php } ?>
                              <div class="fileUpload btn btn-sm btn-upload logo-Upload ">
                                 <span><i class="fa fa-cloud-upload fa-3x "></i></span>
                                 <input type="hidden" style="display:none;" class="no-display" id="file_action_url" name="file_action_url" value="<?php echo site_url('bloodbank/editUploadImage');?>">
                                 <input type="hidden" style="display:none;" class="no-display" id="load_url" name="load_url" value="<?php echo site_url('bloodbank/getUpdateAvtar/'.$this->uri->segment(3));?>">
                              </div>
                           </article>
                           <!-- description div -->
                           <div class='pic-edit'>
                              <h3><a id="picEdit" class="pull-center cl-white" title="Edit Logo"><i class="fa fa-pencil"></i></a></h3>
                              <h3><a id="picEditClose" class="pull-center cl-white" title="Edit Logo"  style="display:none;"><i class="fa fa-times"></i></a></h3>
                           </div>
                           <!-- end description div -->
                        </div>
                        <h3 class="text-white"> <?php echo $bloodBankData[0]->bloodBank_name;?> </h3>
                        <h4> <?php if(isset($bloodBankData[0]->bloodBank_add)){ echo $bloodBankData[0]->bloodBank_add; }?> </h4>
                     </div>
                  </div>
                  <!--/ meta -->
               </aside>
               <section class="clearfix hospitalBtn">
                  <div class="col-md-12">
                     <a data-toggle="modal" data-target="#changeBg" class="pull-right cl-white" title="Edit Background"><i class="fa fa-pencil"></i></a>
                  </div>
               </section>
               <article class="text-center clearfix m-t-50">
                  <ul class="nav nav-tab nav-setting">
                     <li class="active">
                        <a data-toggle="tab" href="#general">General Detail</a>
                     </li>
                     <li class=" ">
                        <a data-toggle="tab" href="#ba">Blood Availability</a>
                     </li>
                     <li class=" ">
                        <a data-toggle="tab" href="#account">Account</a>
                     </li>
                  </ul>
               </article>
               <article class="tab-content p-b-20 m-t-50">
                  <!-- General Detail Starts -->
                  <div class="map_canvas"></div>
                  <section class="tab-pane fade in active" id="general">
                     <article class="detailbox">
                        <div class="mi-form-section">
                           <!-- Table Section End -->
                           <aside class="clearfix m-t-20 setting">
                              <div class="col-md-8">
                                 <h4>Blood Bank Detail 
                                    <a  id="edit" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                                 </h4>
                                 <hr/>
                                 <aside id="detail" style="display: <?php echo $detailShow;?>;">
                                    <article class="clearfix m-b-10">
                                       <label for="cemail" class="control-label col-md-4 col-sm-4">Blood Bank Name :</label>
                                       <p class="col-md-8 col-sm-8 text-right t-xs-left"> <?php echo $bloodBankData[0]->bloodBank_name;?> </p>
                                    </article>
                                    <article class="clearfix m-b-10">
                                       <label for="cemail" class="control-label col-md-4 col-sm-4">Address :</label>
                                       <p class="col-md-8 col-sm-8 text-right t-xs-left"><?php if(isset($bloodBankData[0]->bloodBank_add)){ echo $bloodBankData[0]->bloodBank_add; }?> </p>
                                    </article>
                                    <article class="clearfix m-b-10 ">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Landline Phone:</label>
                                    <aside class="col-md-8 col-sm-8 text-right t-xs-left">
                                    <?php
                                    $explode = explode('|', $bloodBankData[0]->bloodBank_phn);
                                    for ($i = 0; $i < count($explode); $i++) { ?>
                                       <label for="cemail" class="control-label col-md-4 col-sm-4"><?php if($i == 0){ ?><?php } ?></label>
                                       <?php if ($explode[$i] != '')?><p>+<?php echo $explode[$i];?></p>
                                          <?php }?>
                                       </aside>
                                    </article>
                                    <article class="clearfix m-b-10">
                                       <label for="cemail" class="control-label col-md-4 col-sm-4">Email Id :</label>
                                       <p class="col-md-8  col-sm-8 text-right t-xs-left"> <?php echo $bloodBankData[0]->users_email;?> </p>
                                    </article>
                                    <article class="clearfix m-b-10">
                                       <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person:</label>
                                       <p class="col-md-8  col-sm-8 text-right t-xs-left"> <?php if(isset($bloodBankData[0]->bloodBank_cntPrsn)){ echo $bloodBankData[0]->bloodBank_cntPrsn; }?> </p>
                                    </article>
                                 </aside>
                                 <form name="submitForm" action="<?php echo site_url('bloodbank/saveDetailBloodBank/'.$bloodBankId); ?>" id="submitForm" method="post">
                                    <aside id="newDetail" style="display:<?php echo $showStatus;?>;">
                                       <article class="clearfix m-t-10">
                                          <label for="cemail" class="control-label col-md-4 col-sm-4">Blood Bank Name :</label>
                                          <div class="col-md-8 col-sm-8">
                                             <input class="form-control" id="bloodBank_name" name="bloodBank_name" type="text" value="<?php echo $bloodBankData[0]->bloodBank_name;?>">
                                             <label class="error" style="display:none;" id="error-bloodBank_name"> please enter bloodbank name</label>
                                             <label class="error" > <?php echo form_error("bloodBank_name"); ?></label>
                                          </div>
                                       </article>

                                       <article class="clearfix">
                                          <label for="cemail" class="control-label col-md-4 col-sm-4">Address:</label>
                                          <div class="col-md-8 col-sm-8">
                                             <select class="form-control selectpicker" data-width="100%" name="countryId" id="countryId">
                                                <?php if(!empty($allCountry)):
                                                   foreach($allCountry as $country):?>
                                                   <option value="<?php echo $country->country_id;?>" <?php if($bloodBankData[0]->countryId == $country->country_id):echo"selected";endif;?>><?php echo $country->country;?></option>
                                                <?php endforeach;endif;?>
                                             </select>
                                             <label class="error" style="display:none;" id="error-countryId"> please select a country</label>
                                             <label class="error" > <?php echo form_error("countryId"); ?></label>
                                          </div>
                                       </article>

                                       <article class="clearfix">
                                          <div class="col-sm-8 col-sm-offset-4">
                                             <select class="form-control selectpicker" data-width="100%" name="stateId" onchange ="fetchCity(this.value)" id="stateId">
                                                <?php foreach($allStates as $key=>$val) {?>
                                                <option <?php if($bloodBankData[0]->stateId == $val->state_id):echo"selected";endif;?> value="<?php echo $val->state_id;?>"><?php echo $val->state_statename;?></option>
                                                <?php }?>
                                             </select>
                                              <label class="error" > <?php echo form_error("stateId"); ?></label>
                                          </div>
                                       </article>

                                       <article class="clearfix m-t-10">
                                          <div class="col-sm-8 col-sm-offset-4">
                                             <select class="selectpicker" data-width="100%" name="cityId" id="cityId">
                                                <?php foreach($allCities as $key=>$val) {?>
                                                <option <?php if($bloodBankData[0]->cityId == $val->city_id):echo"selected";endif;?> value="<?php echo $val->city_id;?>"><?php echo $val->city_name;?></option>
                                                <?php }?>
                                             </select>
                                             <label class="error" style="display:none;" id="error-cityId"> please select a city</label>
                                             <label class="error" > <?php echo form_error("cityId"); ?></label>
                                          </div>
                                       </article>

                                       <article class="clearfix m-b-10">
                                       <label for="cemail" class="control-label col-md-4 col-sm-4">Zip Code :</label>
                                       <div class="col-md-8 col-sm-8">
                                           <input class="form-control" id="bloodBank_zip" name="bloodBank_zip" type="text" value="<?php echo $bloodBankData[0]->bloodBank_zip;?>" onkeypress="return isNumberKey(event)" maxlength="6">
                                       <label class="error" style="display:none;" id="error-bloodBank_zip"> Zip code should be numeric and 6 digit long</label>
                                       <label class="error" id="error-bloodBank_zip1"  > <?php echo form_error("bloodBank_zip"); ?></label>       
                                       </article>

                                       <article class="clearfix">
                                          <label class="control-label col-md-4" for="cname">Manual:</label>
                                          <div class="col-md-8">
                                              
                                             <aside class="radio radio-info radio-inline">
                                                <input type="radio" <?php if(isset($bloodBankData[0]->bloodBank_isManual) && $bloodBankData[0]->bloodBank_isManual == 1){ echo 'checked="checked"'; }?>  name="isManual" value="1" id="isManual" onclick="IsAdrManual(this.value)">
                                                <label for="inlineRadio1"> Yes</label>
                                             </aside>
                                             <aside class="radio radio-info radio-inline">
                                                <input <?php if(isset($bloodBankData[0]->bloodBank_isManual) && $bloodBankData[0]->bloodBank_isManual == 0){ echo 'checked="checked"'; }?> type="radio" name="isManual" value="0" id="isManual" onclick="IsAdrManual(this.value)">
                                                <label for="inlineRadio2"> No</label>
                                             </aside>
                                          </div>
                                       </article>

                                       
                                       <article class="clearfix m-t-10">
                                          <label for="cemail" class="control-label col-md-4 col-sm-4"></label>
                                          <div class="col-md-8 col-sm-8">
                                             <textarea  class="form-control geocomplete" id="geocomplete1" name="bloodBank_add" type="text" ><?php if(isset($bloodBankData[0]->bloodBank_add)){ echo $bloodBankData[0]->bloodBank_add; }?></textarea>
                                             <label class="error" style="display:none;" id="error-bloodBank_add"> please enter an address</label>
                                             <label class="error" > <?php echo form_error("bloodBank_add"); ?></label>
                                          </div>
                                       </article>
                                       <article class="clearfix">
                                          <div class="col-md-8 col-sm-8 col-sm-offset-4">
                                             <aside class="row">
                                                <div class="col-sm-6">
                                                   <input class="form-control" name="lat" type="text"  id="lat" <?php if(isset($bloodBankData[0]->bloodBank_isManual) && $bloodBankData[0]->bloodBank_isManual == 0){ echo 'readonly="readonly"'; }?> value="<?php echo $bloodBankData[0]->bloodBank_lat;?>" placeholder="Latitude"/>
                                                   
                                                   <label class="error" > <?php echo form_error("lat"); ?></label>
                                                   <label class="error" style="display:none;" id="error-lat">Please enter the correct format for latitude</label>
                                                </div>
                                                <div class="col-sm-6">
                                                   <input class="form-control" name="lng" type="text"   id="lng" <?php if(isset($bloodBankData[0]->bloodBank_isManual) && $bloodBankData[0]->bloodBank_isManual == 0){ echo 'readonly="readonly"'; }?> value="<?php echo $bloodBankData[0]->bloodBank_long;?>" placeholder="Longitude" />
                                                   <label class="error" > <?php echo form_error("lng"); ?></label>
                                                   <label class="error" style="display:none;" id="error-lng"> Please enter the correct format for longitude</label>
                                                </div>
                                             </aside>
                                          </div>
                                       </article>
                                        
                                      <article class="clearfix m-t-10">
                                        <label for="cname" class="control-label col-md-4  col-sm-4">Phone:</label>
                                        <div class="col-md-8 col-sm-8">
                                            
                                            <?php 
                                                $explodes= explode('|',$bloodBankData[0]->bloodBank_phn); 
                                                if(!empty($explodes)){
                                                for($i= 0; $i< count($explodes);$i++){
                                                $moreExpolde = explode(' ',$explodes[$i]);?>
                                            
                                            <aside class="row clone">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-sm-4 col-xs-12 m-t-xs-10" id="multiPreNumber">
                                                    <select class="selectpicker" data-width="100%" name="pre_number[]" id="multiPreNumber">
                                                        <option <?php if($moreExpolde[0] == '91'){ echo 'selected';}?> value ='91'>+91</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12 m-t-xs-10">
                                                    <input type="text" class="form-control" name="midNumber[]" id="midNumber1" maxlength="5" onkeypress="return isNumberKey(event)" value="<?php if(isset($moreExpolde[1]) && $moreExpolde[1] != ''){ echo $moreExpolde[1]; } ?>" />
                                                     <label class="error" > <?php echo form_error("midNumber"); ?></label>
                                                </div>
                                                
                                                <div class="col-md-5 col-sm-5 col-xs-10 m-t-xs-10 " id="multiPhoneNumber">
                                                    <input type="text" class="form-control" name="bloodBank_phn[]" id="bloodBank_phn1" maxlength="8" onkeypress="return isNumberKey(event)" value="<?php if(isset($moreExpolde[2]) && $moreExpolde[2] != ''){ echo $moreExpolde[2]; } ?>" />
                                                    <label class="error" style="display:none;" id="error-bloodBank_phn"> please enter a valid phone number</label>
                                                    <label class="error" > <?php echo form_error("bloodBank_phn"); ?></label>
                                                </div>
                                                
                                            </aside>
                                            <?php $moreExpolde ='';} }?>
                                            <p class="m-t-0">* The number above is going to be your primary number.</p>
                                        </div>
                                        
                                    </article>
                                        
                                       <article class="clearfix m-t-10">
                                          <label for="cemail" class="control-label col-md-4 col-sm-4">Email Id :</label>
                                          <div class="col-md-8 col-sm-8">
                                             <input class="form-control" id="users_email" name="users_email" type="email" value="<?php echo $bloodBankData[0]->users_email;?>" onblur="checkEmailFormatDetail()" />
                                             <label class="error" style="display:none;" id="error-users_email_check"> Email Already Exists!</label>
                                             <label class="error" style="display:none;" id="error-users_email"> please enter Email id Properly</label>
                                             <label class="error" > <?php echo form_error("users_email"); ?></label>
                                          </div>
                                       </article>
                                       <article class="clearfix">
                                          <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person:</label>
                                          <div class="col-md-8 col-sm-8">
                                             <input class="form-control" id="bloodBank_cntPrsn" name="bloodBank_cntPrsn" type="text" value="<?php if(isset($bloodBankData[0]->bloodBank_cntPrsn)){ echo $bloodBankData[0]->bloodBank_cntPrsn; }?>">
                                             <label class="error" style="display:none;" id="error-bloodBank_cntPrsn"> please enter contact person name</label>
                                          </div>
                                          <label class="error" > <?php echo form_error("bloodBank_cntPrsn"); ?></label>
                                       </article>
                                       <article class="clearfix m-t-10">
                                          <div class="col-md-12">
                                             <button type="submit" class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" onclick="return validationBloodbank();">Submit</button>
                                          </div>
                                       </article>
                                    </aside>
                                    <fieldset>
                                       <input name="user_tables_id" id="user_tables_id" type="hidden" value="<?php echo $bloodBankData[0]->users_id;?>">
                                    </fieldset>
                                 </form>
                              </div>
                           </aside>
                        </div>
                     </article>
                  </section>
                  <!-- General Detail Ends -->
                  <!--diagnostic Starts -->
                  <section class="tab-pane fade in" id="ba">
                     <div class="clearfix">
                        <article class="col-md-8">
                           <aside class="table-responsive">
                              <table class="table">
                                 <tr border-a-dull>
                                    <th>Blood Group</th>
                                    <th>Check Availability</th>
                                    <th>Quantity</th>
                                 </tr>
                                 <!--   <tr>
                                    <td><h6>O +ve</h6></td>
                                    <td><aside class="checkbox checkbox-success m-t-5">
                                                    <input type="checkbox" id="opve">
                                                    <label>
                                    
                                                    </label>
                                                </aside>
                                        </td>
                                    
                                    <td><h6 id="opveDetail" style="display:none"> <span id="detailbu">
                                                                 50 Unit
                                                                 <a class="cl-pencil editbu m-l-20"><i class="fa fa-pencil"></i></a>
                                                                </span>
                                                                <span id="newbu" style="display:none">
                                                                <input type="text" class="shortinp" value="50"  />
                                                                <button type="button" class="btn btn-xs btn-success editbu">Save</button>
                                                                <button type="button" class="btn btn-xs btn-danger editbu">Cancle</button>
                                                                </span>
                                            </h6></td>
                                    </tr>
                                       
                                    <tr>
                                    <td><h6>O -ve</h6></td>
                                    <td><aside class="checkbox checkbox-success m-t-5">
                                                    <input type="checkbox" id="onve">
                                                    <label>
                                    
                                                    </label>
                                                </aside>
                                        </td>
                                    <td><h6 id="onveDetail" style="display:none">
                                            <span id="detailbu1">
                                                                 50 Unit
                                                                 <a class="cl-pencil editbu1 m-l-20"><i class="fa fa-pencil"></i></a>
                                                                </span>
                                                                <span id="newbu1" style="display:none">
                                                                <input type="text" class="shortinp" value="50"  />
                                                                <button type="button" class="btn btn-xs btn-success editbu1">Save</button>
                                                                <button type="button" class="btn btn-xs btn-danger editbu1">Cancle</button>
                                                                </span>
                                        
                                        </h6></td>
                                    </tr>
                                       
                                     <tr>
                                    <td><h6>A +ve</h6></td>
                                    <td><aside class="checkbox checkbox-success m-t-5">
                                                    <input type="checkbox" id="apve">
                                                    <label>
                                    
                                                    </label>
                                                </aside>
                                        </td>
                                    <td><h6 id="apveDetail" style="display:none"> <span id="detailbu2">
                                                                 50 Unit
                                                                 <a class="cl-pencil editbu2 m-l-20"><i class="fa fa-pencil"></i></a>
                                                                </span>
                                                                <span id="newbu2" style="display:none">
                                                                <input type="text" class="shortinp" value="50"  />
                                                                <button type="button" class="btn btn-xs btn-success editbu2">Save</button>
                                                                <button type="button" class="btn btn-xs btn-danger editbu2">Cancle</button>
                                                                </span></h6></td>
                                    </tr>
                                       
                                    <tr>
                                    <td><h6>A -ve</h6></td>
                                    <td><aside class="checkbox checkbox-success m-t-5">
                                                    <input type="checkbox" id="anve">
                                                    <label>
                                    
                                                    </label>
                                                </aside>
                                        </td>
                                    <td><h6 id="anveDetail" style="display:none"> <span id="detailbu3">
                                                                 50 Unit
                                                                 <a class="cl-pencil editbu3 m-l-20"><i class="fa fa-pencil"></i></a>
                                                                </span>
                                                                <span id="newbu3" style="display:none">
                                                                <input type="text" class="shortinp" value="50"  />
                                                                <button type="button" class="btn btn-xs btn-success editbu3">Save</button>
                                                                <button type="button" class="btn btn-xs btn-danger editbu3">Cancle</button>
                                                                </span></h6></td>
                                    </tr> -->
                                 <?php foreach($bloodBankCatData as $key=>$val){
                                    $id= $val->bloodCatBank_id; ?>
                                 <tr>
                                    <td>
                                       <h6><?php echo $val->bloodCat_name;?></h6>
                                    </td>
                                    <td>
                                       <aside class="checkbox checkbox-success m-t-5">
                                          <input type="checkbox" id="anve_<?php echo $id; ?>" onclick="openBloodUnit(<?php echo $id; ?>)">
                                          <label>
                                          </label>
                                       </aside>
                                    </td>
                                    <td>
                                       <h6 id="anveDetail_<?php echo $id; ?>" style="display:none"> <span id="detailbu_<?php echo $id; ?>">
                                          <span id="unitshow_<?php echo $id; ?>"> <?php echo $val->bloodCatBank_Unit;?></span> Unit
                                          <a class="cl-pencil editbu_<?php echo $id;?> m-l-20" onclick="anchorClick(<?php echo $id;?>)"><i class="fa fa-pencil"></i></a>
                                          </span>
                                          <span id="newbu_<?php echo $id;?>" style="display:none">
                                          <input type="text" class="shortinp" id ="unit_<?php echo $id;?>" value="<?php echo $val->bloodCatBank_Unit;?>" onkeypress="return isNumberKey(event)" maxlength="4" />
                                          <button type="button" class="btn btn-xs btn-success" onclick="updateBloodUnit(<?php echo $id;?>)">Save</button>
                                          <button type="button" class="btn btn-xs btn-danger" onclick="anchorClick(<?php echo $id;?>)">Cancle</button>
                                          </span>
                                       </h6>
                                    </td>
                                 </tr>
                                 <?php } ?>
                              </table>
                           </aside>
                        </article>
                     </div>
                  </section>
                  <!-- diagnostic Ends -->
                  <!--Account Starts -->
                  <section class="tab-pane fade in" id="account">
                     <div class="clearfix m-t-20 p-b-20 doctor-description">
                        <article class="clearfix m-b-10">
                           <label for="cemail" class="control-label col-md-4 col-sm-5">Registered Email Id :</label>
                           <p class="col-md-8 col-sm-7"><?php echo $bloodBankData[0]->users_email; ?></p>
                        </article>
                        <article class="clearfix m-b-10">
                           <label for="cemail" class="control-label col-md-4 col-sm-5">Registered Mobile Number:</label>
                           <p class="col-md-8 col-sm-7">+91 <?php if(isset($bloodBankData[0]->users_mobile)){ echo $bloodBankData[0]->users_mobile; } ?></p>
                        </article>
                        <form class="" name="passwordUpdate" id="passwordUpdate" action="<?php base_url();?>bloodbank/updatePassword">
                           <article class="clearfix m-b-10">
                              <label for="cemail" class="control-label col-md-4 col-sm-5">Change Password:</label>
                              <aside class="col-md-4 col-sm-4">
                                 <input type="password" name="users_password" class="form-control" id="users_password" />
                                 <!-- <p><a class="m-t-10" href="#">Edit</a></p> -->
                              </aside>
                           </article>
                           <article class="clearfix m-b-10">
                              <label for="cemail" class="control-label col-md-4 col-sm-5">Confirm Password:</label>
                              <aside class="col-md-4 col-sm-4">
                                 <input type="password" name="cnfPassword" class="form-control" id="cnfPassword" />
                                 <!--<p><a class="m-t-10" href="javascript:void(0)" onclick="updatePassword()">Edit</a></p>-->
                                 <p><button type="button" class="btn btn-success waves-effect waves-light pull-right m-t-10" onclick="updatePassword()">Edit</button></p>
                                 <p class="error" id="error-password_email_check" style="display:none;"> Server not respond properly!</p>
                                 <p class="text-success" style="display:none;" id="error-password_email_check_success"> Password Changed Successfully!</p>
                              </aside>
                           </article>
                           <!-- <input type="text" name="myPassword" id="myPassword" value="<?php if(isset($bloodBankData[0]->users_password)){ echo $bloodBankData[0]->users_password;}?>" /> -->
                        </form>
                     </div>
                  </section>
                  <!-- Account Ends -->
               </article>
            </section>
            <!-- Table Section End -->
            <article class="clearfix">
            </article>
         </div>
      </section>
      <!-- Left Section End -->
   </div>
   <!-- container -->
</div>
<!-- content -->
<!--Change Logo-->
<div id="changeBg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h3>Change Background</h3>
         </div>
         <div class="modal-body">
            <div class="modal-body">
               <div id="messageErrors"></div>
               <form class="form-horizontal" id="uploadimage" action="" method="post" enctype="multipart/form-data">
                  <div id="image_preview"> <img id="previewing" src="<?php echo base_url();?>assets/images/hospital.jpg" class="img-responsive center-block" /></div>
                  <article class="form-group m-lr-0 ">
                     <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Background :</label>
                     <div class="col-md-8 col-sm-8 text-right">
                        <input disabled="disabled" class="showUpload" id="uploadFileDd" >
                        <div class="fileUpload btn btn-sm btn-upload">
                           <span><i class="fa fa-cloud-upload fa-3x"></i></span>
                           <input type="file" name="file" class="upload" id="uploadBtnDd">
                        </div>
                     </div>
                  </article>
                  <!--<h4 id='loading' >loading..</h4>-->
                  <article class="clearfix m-t-20">
                     <button type="submit" name="submit" class="btn btn-primary pull-right waves-effect waves-light bg-btn m-r-20">Upload</button>
                  </article>
               </form>
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
</div>
<!-- /Change Logo -->
<?php echo $this->load->view('edit_upload_crop_modal');?>
<?php echo $this->load->view('edit_gallery_crop_modal');?>