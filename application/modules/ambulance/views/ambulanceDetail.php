<!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container row">
                    <div class="col-md-12 text-success">
                           <?php //echo $this->session->flashdata('message'); ?>                     
                    </div>
     <div style="display:none;position:absolute;top:50%;left:45%;padding:2px;z-index: 10000" class="loader" id="defaultloader">
       <img alt="Please wait data is loading" src="<?php echo base_url('assets/images/beet.gif');?>" /> </div>
                    <div class="clearfix">
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Ambulance Provider Detail</h3>
                            <a href="<?php echo site_url('ambulance');?>" class="btn btn-appointment btn-back waves-effect waves-light pull-right"><i class="fa fa-angle-left"></i> Back</a>

                        </div>
                    </div>

                    <!-- Left Section Start -->
                    <section class="col-md-12 detailbox m-t-10">


                        <div class="clearfix bg-white">
                            <!-- Table Section Start -->

                            <section class="col-md-12">

                                <aside class="clearfix m-bg-pic">


                                    <div class="bg-picture text-center" style="background-image:url('<?php if(isset($backgroundImage) && !empty($backgroundImage[0]->ambulance_background_img)): echo base_url().'assets/ambulanceImages/'.$backgroundImage[0]->ambulance_background_img; else: echo base_url().'assets/default-images/ambulance.png'; endif;?>')">
                                        <div class="bg-picture-overlay"></div>
                                        <div class="profile-info-name">
                                            
                                            
                                       <div class='pro-img ' id="crop-avatar">
                                           <?php echo $this->load->view('edit_upload_crop_modal');?>
                                                <!-- image -->
                                                <?php if(!empty($ambulanceData[0]->ambulance_img)){
                                                    ?>
                                                <img src="<?php echo base_url()?>assets/ambulanceImages/thumb/original/<?php echo $ambulanceData[0]->ambulance_img; ?>" alt="" class="logo-img" />
                                               <?php } else { ?>
                                                 <img src="<?php echo base_url()?>assets/default-images/ambulance_logo.png" alt="" class="logo-img" />
                                               <?php } ?>
                                                <article class="logo-up avatar-view" style="display:none">
                                                       <?php if(!empty($ambulanceData[0]->ambulance_img)){
                                                    ?>
                                                <img src="<?php echo base_url()?>assets/ambulanceImages/thumb/original/<?php echo $ambulanceData[0]->ambulance_img; ?>" alt="" class="logo-img" />
                                               <?php } else { ?>
                                                 <img src="<?php echo base_url()?>assets/default-images/ambulance_logo.png" alt="" class="logo-img" />
                                               <?php } ?>
                                                    <div class="fileUpload btn btn-sm btn-upload logo-Upload">
                                                        <span><i class="fa fa-cloud-upload fa-3x "></i></span>
<!--                                                        <input id="uploadBtn" type="file" class="upload" />-->
                                                         <input type="hidden" style="display:none;" class="no-display file_action_url" id="file_action_url" name="file_action_url" value="<?php echo site_url('ambulance/editUploadImage');?>">
                                                         <input type="hidden" style="display:none;" class="no-display" id="load_url" name="load_url" value="<?php echo site_url('ambulance/getUpdateAvtar/'.$this->uri->segment(3));?>">
                                                    </div>
                                                </article>
                                                <!-- description div -->
                                                <div class='pic-edit'>
                                                    <h3><a id="picEdit" class="pull-center cl-white" title="Edit Logo"><i class="fa fa-pencil"></i></a></h3>
                                                    <h3><a id="picEditClose" class="pull-center cl-white" title="Cancel"  style="display:none;"><i class="fa fa-times"></i></a></h3>
                                                </div>

                                                <!-- end description div -->
                                            </div>

                                            <h3 class="text-white"><?php echo $ambulanceData[0]->ambulance_name;?> </h3>
                                            <h4><?php echo $ambulanceData[0]->ambulance_address;?></h4>

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
                                   <li class="<?php if(isset($active) && $active == 'general'){echo "active";}?>" >
                                      <a data-toggle="tab" href="#general">General Detail</a>
                                   </li>
                                 
                                    <li class="<?php if(isset($active) && $active == 'timeSlot'){echo "active";}?>">
                                      <a data-toggle="tab" href="#timeSlot">Time Slot</a>
                                   </li>
                                  
                                </ul>
                             </article>
                                <article class="tab-content  m-t-50">
                  <!-- General Detail Starts -->
               
                  <section class="tab-pane fade in <?php if(isset($active) && $active == 'general'){echo "active";}?>" id="general">
                                <article class="col-md-8">
                                    <aside class="clearfix amb-detail">
                                     <h4>Ambulance Provider Detail
                                     <a id="edit" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                                    </h4>
                                    <hr/>
                                        </aside>


                                    <!--Ambulance Provider Detail Starts -->
                                    <div class="map_canvas"></div>
                                    <section class="tab-pane fade in active" id="detail" style="display:<?php echo $detail;?>">
                                        <div class="clearfix m-t-20 p-b-20 doctor-description">
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Ambulance Provider Name:</label>
                                                <p class="col-md-8 col-sm-8"><?php echo ucwords($ambulanceData[0]->ambulance_name);?></p>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Provider Type :</label>
                                                <p class="col-md-8 col-sm-8"><?php if($ambulanceData[0]->ambulanceType == 1){ echo 'Emergency'; } elseif($ambulanceData[0]->ambulanceType == 2) { echo 'Patient Transport';}elseif($ambulanceData[0]->ambulanceType == 3) {echo"Response Unit";}elseif($ambulanceData[0]->ambulanceType == 4) {echo"Charity Ambulance";}elseif($ambulanceData[0]->ambulanceType == 5) {echo"Bariatric Ambulance";}?></p>
                                            </article>
                                            
                                            
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Address:</label>
                                                <p class="col-md-5 col-sm-8">
                                                    <?php echo ucfirst($ambulanceData[0]->ambulance_address)."</br>".ucwords(strtolower($ambulanceData[0]->city_name." ".$ambulanceData[0]->ambulance_zip.", ".$ambulanceData[0]->state_statename." ".$ambulanceData[0]->country));?>
                                                    
                                                </p>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Number:</label>
                                                <aside class="col-md-4 col-sm-4">
                                                 <?php 
                                                    $explode= explode('|',$ambulanceData[0]->ambulance_phn); 
                                                    for($i= 0; $i< count($explode);$i++){?>
                                                    <p>0<?php echo $explode[$i];?></p>
                                                    <?php }?>
                                                </aside>
                                                <!--<p class="col-md-8 col-sm-8">+91 731 7224401</p>-->
                                            </article>

                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person Name:</label>
                                                <p class="col-md-8 col-sm-8"><?php echo $ambulanceData[0]->ambulance_cntPrsn;?></p>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Membership Type:</label>
                                                <p class="col-md-8 col-sm-8"><?php if($ambulanceData[0]->ambulance_mmbrTyp == 1){ echo 'Life Time'; } else { echo 'Health Club';}?></p>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">24/7 Service - Yes/No :</label>
                                                <p class="col-md-8 col-sm-8"><?php if($ambulanceData[0]->ambulance_27Src == 1){ echo 'Yes'; } else { echo 'No';}?></p>
                                            </article>
                                            
                                             <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Docat Id :</label>
                                                <p class="col-md-8 col-sm-8"><?php echo $ambulanceData[0]->ambulance_docatId;?></p>
                                            </article>

                                        </div>
                                    </section>
                                    <!-- Ambulance Provider Detail Ends -->
                                    
                                    <!-- Ambulance Provider Detail in Edit Mode -->
                                     <form name="ambulanceDetail" action="<?php echo site_url(); ?>/ambulance/saveDetailAmbulance/<?php echo $ambulanceId; ?>" id="submitForm" method="post">
                                    <section id="editdetail" style="display:<?php echo $editdetail;?>">
                                        <div class="clearfix m-t-20 p-b-20 doctor-description">
                                            <article class="clearfix m-t-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Ambulance Provider Name:</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input class="form-control" id="ambulance_name" name="ambulance_name" type="text"  value="<?php echo $ambulanceData[0]->ambulance_name;?>">
                                                    <label class="error" > <?php echo form_error("ambulance_name"); ?></label>
                                                    <label class="error" style="display:none;" id="error-ambulance_name"> Please enter ambulance name</label>
                                                           
                                                </div>
                                            </article>
                                            <article class="clearfix m-t-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Provider Type :</label>
                                                 <div class="col-md-8 col-sm-8">
                                                    <select class="select2" data-width="100%" name="ambulanceType">
                                                        


 					<option value='1' <?php if($ambulanceData[0]->ambulanceType == 1){ echo 'selected';}?>>Emergency</option>
                                        <option value='2' <?php if($ambulanceData[0]->ambulanceType == 2){ echo 'selected';}?>>Patient Transport</option>
					<option value='3' <?php if($ambulanceData[0]->ambulanceType == 3){ echo 'selected';}?>>Response Unit</option>
                                        <option value='4' <?php if($ambulanceData[0]->ambulanceType == 4){ echo 'selected';}?>>Charity Ambulance</option>
					<option value='5' <?php if($ambulanceData[0]->ambulanceType == 5){ echo 'selected';}?>>Bariatric Ambulance</option>




                                                    </select>
                                                     <label class="error" > <?php echo form_error("ambulanceType"); ?></label>
                                                </div>
                                            </article>
                                            
                                            
                                                     <article class="clearfix m-t-10">
                                                <label for="cname" class="control-label col-md-4 col-sm-4">Address:</label>
                                                <div class="col-md-8 col-sm-8">
                                                            <select class="form-control select2" data-width="100%" name="ambulance_countryId" id="ambulance_countryId">
                                                               <option value=''>Select Country</option>
                                                               <option value="1" <?php if($ambulanceData[0]->ambulance_countryId == 1){ echo 'selected';}?>>INDIA</option>
                                                              
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
                                                        <option value="<?php echo $val->state_id;?>" <?php if($ambulanceData[0]->ambulance_stateId == $val->state_id){ echo 'selected';}?>><?php echo $val->state_statename;?></option>
                                                         <?php }?>
                                                    </select>
                                                    <label class="error" style="display:none;" id="error-ambulance_stateId"> Please select a state</label>
                                                    <label class="error" > <?php echo form_error("ambulance_stateId"); ?></label>
                                                </div>
                                             </article>

                                            <article class="clearfix">
                                                <div class="col-sm-8 col-sm-offset-4">
                                                    <select class="form-control select2" data-width="100%" name="ambulance_cityId" id="ambulance_cityId" data-size="4">
                                                      <option value="">Select City</option>
                                                      <?php if(isset($citys) && !empty($citys)){?>
                                                       <?php foreach($citys as $key=>$city) {?>
                                                        <option value="<?php echo $city->city_id;?>" <?php if($ambulanceData[0]->ambulance_cityId == $city->city_id){ echo 'selected';}?>><?php echo $city->city_name;?></option>
                                                      <?php }}?>
                                                      
                                                    </select>
                                                    <label class="error" style="display:none;" id="error-ambulance_cityId"> Please select a city</label>
                                                    <label class="error" > <?php echo form_error("ambulance_cityId"); ?></label>
                                        </div>
                                            </article>
                                            
                                              <article class="clearfix m-t-10">
                                                <div class="col-sm-8 col-sm-offset-4">
                                               <input type="text" class="form-control" id="ambulance_zip" name="ambulance_zip" placeholder="Zip code" maxlength="6" minlength="6"  onkeypress="return isNumberKey(event)" value="<?php if(isset($ambulanceData[0]->ambulance_zip)){ echo $ambulanceData[0]->ambulance_zip; }?>"/>
                                                <label class="error" style="display:none;" id="error-ambulance_zip"> Please enter a zip code</label>   
                                                <label class="error" > <?php echo form_error("ambulance_zip"); ?></label>
                                                </div>
                                             </article>
<!--                                            
                                             <article class="clearfix m-t-10">
                                                <label class="control-label col-md-4" for="cname">Manual :</label>
                                                <div class="col-md-8">
                                                    <aside class="radio radio-info radio-inline">
                                                        <input type="radio"  name="isManual" value="1" id="isManual" onclick="IsAdrManual(this.value)" <?php if($ambulanceData[0]->ambulance_isManual == 1){ echo 'checked';}?>>
                                                        <label for="inlineRadio1"> Yes</label>
                                                    </aside>
                                                    <aside class="radio radio-info radio-inline">
                                                        <input type="radio" name="isManual" value="0" id="isManual" onclick="IsAdrManual(this.value)"  <?php if($ambulanceData[0]->ambulance_isManual == 0){ echo 'checked';}?>>
                                                        <label for="inlineRadio2"> No</label>
                                                    </aside>
                                                </div>
                                            </article>-->
  <input type="hidden" name="isManual" value="1" id="isManual"/>                                          
                                            
                                            <article class="clearfix m-t-10">
                                               
                                              <div class="col-md-8 col-sm-8 col-md-offset-4">
                                          
                                            <textarea class="form-control" id="geocomplete" name="ambulance_address" type="text" ><?php if(isset($ambulanceData[0]->ambulance_address)){ echo $ambulanceData[0]->ambulance_address; }?></textarea>
                                             <label class="error" style="display:none;" id="error-ambulance_address"> Please enter address</label>
                                            <label class="error" > <?php echo form_error("ambulance_address"); ?></label>           
                                            </div>
                                       
                                            </article>
                                         
                                        <article class="clearfix m-t-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Latitude & Longitude:</label>
                                              <div class="col-md-8 col-sm-8">
                                          
                                            <aside class="row">
                                                   <div class="col-sm-6"> 
                                                            <input name="lat" class="form-control" required="" type="text"  id="lat"  value="<?php echo $ambulanceData[0]->ambulance_lat;?>"/>
                                                            <label class="error" style="display:none;" id="error-lat">Please enter the correct format for latitude</label>
                                                     </div>
                                                     <div class="col-sm-6"> 
                                                           <input name="lng" class="form-control" required="" type="text"   id="lng" value="<?php echo $ambulanceData[0]->ambulance_long;?>" />
                                                            <label class="error" style="display:none;" id="error-lng"> Please enter the correct format for longitude</label>                                          
                                            </div>
                                          </aside>
                                        </div>
                                            </article>


<!--                                            <article class="clearfix m-t-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Number:</label>
                                               <div class="col-md-8 col-sm-8">
                                                   <?php 
                                                        $explodes= explode('|',$ambulanceData[0]->ambulance_phn); 
                                                        for($i= 0; $i< count($explodes);$i++){
                                                        $moreExpolde = explode(' ',$explodes[$i]);
                                                   ?>
                                                    <aside class="row">
                                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                                            <select class="selectpicker form-control" data-width="100%" name="pre_number[]">
                                                                <option value="91" <?php if($moreExpolde[0] == '91'){ echo 'selected';}?>>+91</option>
                              
                                                            </select>
                                                        </div>
                                                        
                                                          <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12 m-t-xs-10">
                                                    <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="5" value="<?php if(isset($moreExpolde[1])){echo $moreExpolde[1];}?>"  id="midNumber" name="midNumber[]" class="form-control" >
                                                    
                                                  <label class="error" style="display:none;" id="error-midNumber"> Please enter a valid STD code</label>
                                                </div>
                                                        
                                                        <div class="col-md-5 col-sm-5 col-xs-10 m-t-xs-10">
                                                            <input type="text" class="form-control" name="ambulance_phn[]" id="ambulance_phn1" placeholder="" value="<?php if(isset($moreExpolde[2])){echo $moreExpolde[2];}?>" maxlength="10" onblur="checkNumber(<?php echo $i;?>)" onkeypress="return isNumberKey(event)"/>
                                                           <label class="error" style="display:none;" id="error-ambulance_phn"> Please enter phone number</label>          
                                                        </div>

                                                    </aside>
                                                    <?php $moreExpolde ='';}?>

                                                    <br />
 <p class="m-t-0">* The number above is going to be your primary number.</p>
                                                </div>
                                            </article>-->

  <article class="clearfix m-t-10">
                                <label class="control-label col-md-4 col-sm-4" for="cname"> Phone :</label>
                                <div class="col-md-8 col-sm-8">
                                     <input type="text" class="form-control" name="ambulance_phn" id="ambulance_phn" maxlength="10" minlength="10" onkeypress="return isNumberKey(event)" value="<?php echo $ambulanceData[0]->ambulance_phn;?>" />

                                    <label class="error" style="display:none;" id="error-ambulance_phn"> please enter a valid phone min length should be min 10 and max 10</label>
                                  
                                    <label class="error" > <?php echo form_error("ambulance_phn"); ?></label>
                                    <label class="error"> </label>
  <p class="m-t-0">* The number above is going to be your primary number.</p>
                                </div>
                            </article>
                                       

                                            <article class="clearfix m-t-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person Name:</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input class="form-control" id="ambulance_cntPrsn" name="ambulance_cntPrsn" type="text" required="" value="<?php echo $ambulanceData[0]->ambulance_cntPrsn;?>">
                                                    <label class="error" > <?php echo form_error("ambulance_cntPrsn"); ?></label>   <label class="error" style="display:none;" id="error-ambulance_cntPrsn"> Please enter contact person name</label>          
                                                </div>
                                            </article>

                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Membership Type:</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <select class="select2" data-width="100%" name="ambulance_mmbrTyp" id="ambulance_mmbrTyp">
                                                        <option value="1" <?php if($ambulanceData[0]->ambulance_mmbrTyp == 1){ echo 'selected';}?>>Life Time</option>
                                                        <option value="2" <?php if($ambulanceData[0]->ambulance_mmbrTyp == 2){ echo 'selected';}?>>Health Club</option>
                                                    </select>
                                                </div>
                                            </article>

                                            <article class="clearfix m-t-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">24/7 Service - Yes/No :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <aside class="radio radio-info radio-inline">
                                                        <input type="radio" id="inlineRadio1" value="1" name="ambulance_27Src" <?php if($ambulanceData[0]->ambulance_27Src == 1){ echo 'checked'; }?> />
                                                        <label for="inlineRadio1"> Yes</label>
                                                    </aside>
                                                    <aside class="radio radio-info radio-inline">
                                                        <input type="radio" id="inlineRadio2" value="0" name="ambulance_27Src" <?php if($ambulanceData[0]->ambulance_27Src == 0){ echo 'checked'; }?> >
                                                        <label for="inlineRadio2"> No</label>
                                                    </aside>
                                                </div>
                                            </article>
                                             <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4">Docat Id : </label>
                                <div class="col-md-8 col-sm-8">
                                    <input class="form-control" name="ambulance_docatId" type="text" required="" id="ambulance_docatId" value="<?php echo $ambulanceData[0]->ambulance_docatId;?>">
                                    <label class="error" style="display:none;" id="error-ambulance_docatId">please enter Docat Id.</label>
                                    <label class="error" > <?php echo form_error("ambulance_docatId"); ?></label>
                                </div>
                            </article>

                                            <article class="clearfix ">
                                                <div class="col-md-12 m-t-20 m-b-20">
                                                <button type="submit" class="btn btn-appointment waves-effect waves-light m-l-10 pull-right">Submit</button>
                                                </div>
                                            </article>
                                        </div>
                                    </section>
                                        <fieldset>
                                           
                                            <input name="user_tables_id" id="user_tables_id" type="hidden" value="<?php echo $ambulanceData[0]->ambulance_usersId;?>">
                                       </fieldset>      
                                     </form>     
                                     <!-- Ambulance Provider Detail in Edit Mode -->

                                </article>
                  </section>
                   <section class="tab-pane fade in <?php if(isset($active) && $active == 'timeSlot'){echo "active";}?>" id="timeSlot">
                       
                    <?php if($ambulanceData[0]->ambulance_27Src == 1){ echo '<div class="row"><div class="col-md-12">24/7 service available</div></div></br></br>'; } else { ?>
                        
                        
                   
                       

                              <?php if(isset($timeSlot) && !empty($timeSlot)):?>
                         
                    <form method="post" name="timeSlotForm" id="timeSlotForm" action="<?php echo site_url('ambulance/updateTimeSlot');?>">
                        <input type="hidden" name="mi_user_id" value="<?php if(isset($ambulanceData[0]->ambulance_usersId)){ echo $ambulanceData[0]->ambulance_usersId; }?>" />
                         <input type="hidden" name="mi_id" value="<?php if(isset($ambulanceData[0]->ambulance_id)){ echo $ambulanceData[0]->ambulance_id; }?>" />
                         
                          <input type="hidden" name="redirectControllerMethod" value="ambulance/detailAmbulance" />
                        
                        <?php echo $this->load->view('common_pages/edit_time_slot_view');?>
                        
                        <article class="clearfix m-t-10">
                            <div class="col-md-12">
                              <button class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" type="submit" onclick="return timeSlotCheck()">Update</button>
                            </div>
                            </article>
                    </form>
                    <?php else: ?>
                        
                       <form method="post" name="timeSlotForm" id="timeSlotForm" action="<?php echo site_url('bloodbank/setTimeSlotMi');?>">
                        <input type="hidden" name="mi_user_id" value="<?php if(isset($ambulanceData[0]->ambulance_usersId)){ echo $ambulanceData[0]->ambulance_usersId; }?>" />
                         <input type="hidden" name="mi_id" value="<?php if(isset($ambulanceData[0]->ambulance_id)){ echo $ambulanceData[0]->ambulance_id; }?>" />
                        
                          <input type="hidden" name="redirectControllerMethod" value="ambulance/detailAmbulance" />
                         
                        <?php echo $this->load->view('common_pages/time_slot_view');?>
                        
                        <article class="clearfix m-t-10">
                            <div class="col-md-12">
                              <button class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" type="submit" onclick="return timeSlotCheck()">Submit</button>
                            </div>
                            </article>
                    </form>
                         
                    <?php endif;?>   
                       
                             <?php }?>  
                       
                  </section>
                                </article>

                            </section>
                            <!-- General Detail Ends -->


                    </div>

                    </section>
                    <!-- Left Section End -->
 <div id="changeBg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h3>Change Background</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-body">
                                        <div id="messageErrors"></div>
                                        <form class="form-horizontal" id="uploadimage" action="" method="post" enctype="multipart/form-data">

                                <?php if(isset($backgroundImage[0]->ambulance_background_img) && !empty($backgroundImage[0]->ambulance_background_img)):?>
                                           
                                            <div id="image_preview"> <img id="previewing" src="<?php echo base_url();?>assets/ambulanceImages/<?php echo $backgroundImage[0]->ambulance_background_img;?>" class="img-responsive center-block" /></div>
                                    
                                    <?php else : ?>
                                            
                                                    <div id="image_preview"> <img id="previewing" src="<?php echo base_url();?>assets/default-images/ambulance.png" class="img-responsive center-block" /></div>
                                            
                                            
                                             <?php endif;?>
                                            
                 
                         

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

                </div>

                <!-- container -->
                


