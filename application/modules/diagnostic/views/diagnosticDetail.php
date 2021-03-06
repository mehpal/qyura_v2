<!-- Start right Content here -->
<div class="content-page">
<!-- Start content -->
<div class="content">
<div class="container row">
<div class="clearfix">
   <div class="col-md-12 text-success">
      <?php //echo $this->session->flashdata('message'); ?>
   </div>
   <div class="col-md-12">
      <h3 class="pull-left page-title">Diagnostic Centre Detail</h3>
      <a href="<?php echo site_url('diagnostic'); ?>" class="btn btn-appointment btn-back waves-effect waves-light pull-right"><i class="fa fa-angle-left"></i> Back</a>
   </div>
</div>
<div style="display:none;position:absolute;top:50%;left:45%;padding:2px;z-index: 10000" class="loader" id="defaultloader">
   <img alt="Please wait data is loading" src="<?php echo base_url('assets/images/loader/Heart_beat.gif'); ?>" /> 
</div>
<!-- Left Section Start -->
<section class="col-md-12 detailbox m-t-10">
<div class="bg-white">
<!-- Table Section Start -->
<section class="col-md-12">
   <aside class="clearfix m-bg-pic">
      <div class="bg-picture text-center" style="background-image:url('<?php if (isset($diagnosticData) && !empty($diagnosticData[0]->diagnostic_background_img)): echo base_url() . 'assets/diagnosticsImage/' . $diagnosticData[0]->diagnostic_background_img;
         else : echo base_url() . 'assets/default-images/Diagnostic_Centre.png';
         endif; ?>')">
         <div class="bg-picture-overlay"></div>
         <div class="profile-info-name">
            <div class='pro-img' id="crop-avatar-upload">
               <?php echo $this->load->view('edit_upload_crop_modal'); ?>
               <!-- image -->
               <?php if (!empty($diagnosticData[0]->diagnostic_img)) {
                  ?>
               <img src="<?php echo base_url() ?>assets/diagnosticsImage/thumb/thumb_100/<?php echo $diagnosticData[0]->diagnostic_img; ?>" alt="" class="logo-img" style="display:block" />
               <?php } else { ?>
               <img src="<?php echo base_url() ?>assets/default-images/Dignostics-logo.png" alt="" class="logo-img" style="display:block" />
               <?php } ?>
               <article class="logo-up avatar-view" style="display:none">
                  <?php if (!empty($diagnosticData[0]->diagnostic_img)) {
                     ?>
                  <img src="<?php echo base_url() ?>assets/diagnosticsImage/thumb/thumb_100/<?php echo $diagnosticData[0]->diagnostic_img; ?>" alt="" class="logo-img" />
                  <?php } else { ?>
                  <img src="<?php echo base_url() ?>assets/default-images/Dignostics-logo.png" alt="" class="logo-img" />
                  <?php } ?>
                  <div class="fileUpload btn btn-sm btn-upload logo-Upload">
                     <span><i class="fa fa-cloud-upload fa-3x "></i></span>
                     <!--                                                        <input id="uploadBtn" type="file" class="upload" />-->
                     <input type="hidden" style="display:none;" class="no-display file_action_url" id="file_action_url" name="file_action_url" value="<?php echo site_url('diagnostic/editUploadImage'); ?>">
                     <input type="hidden" style="display:none;" class="no-display" id="load_url" name="load_url" value="<?php echo site_url('diagnostic/getUpdateAvtar/' . $this->uri->segment(3)); ?>">
                  </div>
               </article>
               <!-- description div -->
               <div class="pic-edit diagno_edit">
                  <h3><a  class="pull-center cl-white picEdit" title="Edit Logo"><i class="fa fa-pencil"></i></a></h3>
                  <h3><a  class="pull-center cl-white picEditClose" title="Cancel"  style="display:none;"><i class="fa fa-times"></i></a></h3>
               </div>
               <!-- end description div -->
            </div>
            <h3 class="text-white"><?php if (isset($diagnosticData)) {
               if (!empty($diagnosticData)): echo $diagnosticData[0]->diagnostic_name;
               endif;
               } ?></h3>
            <h4><?php if (isset($diagnosticData)) {
               if (!empty($diagnosticData)): echo $diagnosticData[0]->diagnostic_address;
               endif;
               } ?></h4>
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
         <li class="<?php if (isset($active) && $active == 'general') {
            echo "active";
            } ?>">
            <a data-toggle="tab" href="#general">General Detail</a>
         </li>
         <li class="<?php if (isset($active) && $active == 'collectionCenter') {
            echo "active";
            } ?>">
            <a data-toggle="tab" href="#collectionCenter">Collection Center</a>
         </li>
         <li class=" <?php if (isset($active) && $active == 'diag') {
            echo "active";
            } ?>">
            <a data-toggle="tab" href="#diagnostic">Diagnostics</a>
         </li>
         <li class=" <?php if (isset($active) && $active == 'specialities') {
            echo "active";
            } ?>">
            <a data-toggle="tab" href="#specialities">Specialities</a>
         </li>
         <!--                                        <li class="<?php if (isset($active) && $active == 'gallery') {
            echo "active";
            } ?>">
            <a data-toggle="tab" href="#gallery">Gallery</a>
            </li>-->
         <li class="<?php if (isset($active) && ( $active == 'timeslot' OR $active == 'timeSlot' )) {
            echo "active";
            } ?>">
            <a data-toggle="tab" href="#timeslot">Time Slot</a>
         </li>
         <li class=" <?php if (isset($active) && $active == 'doctor') {
            echo "active";
            } ?>">
            <a data-toggle="tab" href="#doctor">Doctor</a>
         </li>
         <li class=" <?php if (isset($active) && $active == 'membership') { echo "active"; } ?>">
            <a data-toggle="tab" href="#membership">membership</a>
         </li>
         <li class=" <?php if (isset($active) && $active == 'account') {
            echo "active";
            } ?>">
            <a data-toggle="tab" href="#account">Account</a>
         </li>
      </ul>
   </article>
   <?php if (isset($diagnosticData) && !empty($diagnosticData)) { ?>
   <article class="tab-content m-t-50" ng-app="myApp">
      <!-- General Detail Starts -->
      <section class="tab-pane fade in <?php if (isset($active) && $active == 'general') {
         echo "active";
         } ?>" id="general">
         <article class="detailbox">
            <div class="mi-form-section">
            <!-- Table Section End -->
            <aside class="clearfix m-t-20 setting">
               <div class="col-md-6">
                  <h4>Multispeciality Diagnostic Centre
                     <a id="editdetail" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                  </h4>
                  <hr/>
                  <section id="detail">
                     <article class="clearfix m-b-10">
                        <label for="cemail" class="control-label col-md-4 col-sm-4">Diagnostic Centre Name:
                        </label>
                        <p class="col-md-8 col-sm-8 t-xs-left"><?php if (isset($diagnosticData) && !empty($diagnosticData)): echo ucwords($diagnosticData[0]->diagnostic_name);
                           endif; ?></p>
                     </article>
                      
                      
                     <article class="clearfix m-b-10">
                        <label for="cemail" class="control-label col-md-4 col-sm-4">Address :</label>
                        <p class="col-md-8 col-sm-8 t-xs-left"><?php if (!empty($diagnosticData) && isset($diagnosticData)): echo ucwords(strtolower($diagnosticData[0]->diagnostic_address . " " . $diagnosticData[0]->diagnostic_zip . " " . $diagnosticData[0]->city_name . "</br>" . $diagnosticData[0]->state_statename . ", " . $diagnosticData[0]->country));
                           endif; ?></p>
                     </article>
                      
                     <article class="clearfix m-b-10">
                        <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                        <aside class="col-md-8 col-sm-8 t-xs-left">
                           <?php
                              if (isset($diagnosticData) && !empty($diagnosticData[0]->diagnostic_phn) && isset($diagnosticData[0]->diagnostic_phn)) {
                                  $explode = explode('|', $diagnosticData[0]->diagnostic_phn);
                                  for ($i = 0; $i < count($explode); $i++) {
                                      ?>
                           <p>+<?php echo $explode[$i]; ?></p>
                           <?php }
                              } ?>
                        </aside>
                     </article>
                      
                    <article class="clearfix m-b-10">
                                 <label for="cemail" class="control-label col-md-4 col-sm-4">Diagnostic Type :</label>
                                 <p class="col-md-8 col-sm-8 t-xs-left">
                                    <?php
                                       if ($diagnosticData[0]->diagnoTypeId != '') {
                                           echo $diagnosticData[0]->diagnoTypeName;
                                       }
                                       ?>
                                 </p>
                     </article>
                           
                     <article class="clearfix m-b-10">
                        <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person:</label>
                        <p class="col-md-8 col-sm-8 t-xs-left"><?php if (!empty($diagnosticData) && isset($diagnosticData)): echo $diagnosticData[0]->diagnostic_cntPrsn;
                           endif; ?></p>
                     </article>
                     <article class="clearfix m-b-10">
                        <label for="cemail" class="control-label col-md-4 col-sm-4">Designation:</label>
                        <p class="col-md-8 col-sm-8 t-xs-left"><?php if (!empty($diagnosticData) && isset($diagnosticData)): echo $diagnosticData[0]->diagnostic_dsgn;
                           endif; ?></p>
                     </article>
                     <article class="clearfix m-b-10">
                        <label for="cemail" class="control-label col-md-4 col-sm-4">24x7 Emergency :</label>
                        <?php if($diagnosticData[0]->diagnostic_availibility_24_7 == 1){?>
                        <p class="col-md-8 col-sm-8 t-xs-left">Available</p>
                        <?php } else {?>
                        <p class="col-md-8 col-sm-8 t-xs-left">Not Available</p>
                        <?php }?>
                     </article>
                     <article class="clearfix m-b-10">
                        <label for="cemail" class="control-label col-md-4 col-sm-4">Emergency Ward :</label>
                        <?php if($diagnosticData[0]->diagnostic_isEmergency == 1){?>
                        <p class="col-md-8 col-sm-8 t-xs-left">Available</p>
                        <?php } else {?>
                        <p class="col-md-8 col-sm-8 t-xs-left">Not Available</p>
                        <?php }?>
                     </article>
                     <article class="clearfix m-b-10">
                        <label for="cemail" class="control-label col-md-4 col-sm-4">Pharmacy :</label>
                        <?php if($diagnosticData[0]->diagnostic_hasPharmacy == 1){?>
                        <p class="col-md-8 col-sm-8 t-xs-left">Available</p>
                        <?php } else {?>
                        <p class="col-md-8 col-sm-8 t-xs-left">Not Available</p>
                        <?php }?>
                     </article>
                     <article class="clearfix m-b-10">
                        <label for="cemail" class="control-label col-md-4 col-sm-4">Docat Id:</label>
                        <p class="col-md-8 col-sm-8 t-xs-left"><?php if(isset($diagnosticData[0]->diagnostic_docatId)){ echo $diagnosticData[0]->diagnostic_docatId; }?></p>
                     </article>
                     <article class="clearfix m-b-10">
                        <label for="cemail" class="control-label col-md-4 col-sm-4">About Us:</label>
                        <p class="col-md-8 col-sm-8 t-xs-left text-justify"><?php if (!empty($diagnosticData) && isset($diagnosticData)): echo $diagnosticData[0]->diagnostic_aboutUs;
                           endif; ?></p>
                     </article>
                     <?php if(!empty($diagnosticData[0]->bloodBank_phn)){ ?>
                     <aside class="clearfix m-t-20 setting">
                        <h4>Blood Bank Detail
                        </h4>
                        <hr/>
                        <section id="detailbbk">
                           <article class="clearfix m-b-10">
                              <label for="cemail" class="control-label col-md-4 col-sm-4">Name :</label>
                              <p class="col-md-8 col-sm-8 t-xs-left"><?php echo $diagnosticData[0]->bloodBank_name;?></p>
                           </article>
                           <article class="clearfix m-b-10">
                              <label for="cemail" class="control-label col-md-4 col-sm-4">Image :</label>
                              <!-- image -->
                              <aside class="col-md-8 col-sm-8 t-xs-left">
                                 <!-- image -->
                                 <?php if(!empty($diagnosticData[0]->bloodBank_photo)){ ?>
                                 <img src="<?php echo base_url()?>assets/BloodBank/thumb/thumb_100/<?php echo $diagnosticData[0]->bloodBank_photo; ?>" alt="" />
                                 <?php } else { ?>
                                 <img src="<?php echo base_url()?>assets/default-images/Blood-logo.png" alt="" />
                                 <?php } ?>
                              </aside>
                           </article>
                           <article class="clearfix m-b-10 ">
                              <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                              <aside class="col-md-8 col-sm-8 t-xs-left">
                                 <?php 
                                    $bloodBank_explode= explode('|',$diagnosticData[0]->bloodBank_phn); 
                                    for($i= 0; $i< count($bloodBank_explode);$i++){?>
                                 <p>+<?php echo $bloodBank_explode[$i];?></p>
                                 <?php }?>
                              </aside>
                           </article>
                     </aside>
                     <?php } if(!empty($diagnosticData[0]->ambulance_phn)){ ?>
                     <aside class="clearfix m-t-20 setting">
                     <h4>Ambulance Detail
                     </h4>
                     <hr/>
                     <section id="detailpharma">
                     <article class="clearfix m-b-10">
                     <label for="cemail" class="control-label col-md-4 col-sm-4">Name :</label>
                     <p class="col-md-8 col-sm-8 t-xs-left"><?php echo $diagnosticData[0]->ambulance_name;?></p>
                     </article>
                     <article class="clearfix m-b-10">
                     <label for="cemail" class="control-label col-md-4 col-sm-4">Image :</label>
                     <!-- image -->
                     <aside class="col-md-8 col-sm-8 t-xs-left">
                     <!-- image -->
                     <?php if(!empty($diagnosticData[0]->ambulance_img)){ ?>
                     <img src="<?php echo base_url()?>assets/ambulanceImages/thumb/thumb_100/<?php echo $diagnosticData[0]->ambulance_img; ?>" alt="" class="logo-img" />
                     <?php } else { ?>
                     <img src="<?php echo base_url()?>assets/default-images/ambulance_logo.png" alt="" class="logo-img" />
                     <?php } ?>
                     </aside>
                     </article>
                     <article class="clearfix m-b-10 ">
                     <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                     <aside class="col-md-8 col-sm-8 t-xs-left">
                     <?php 
                        $ambulance_explode= explode('|',$diagnosticData[0]->ambulance_phn); 
                        for($i= 0; $i< count($ambulance_explode);$i++){?>
                     <p>+<?php echo $ambulance_explode[$i];?></p>
                     <?php }?>
                     </aside>
                     </article>
                     <article class="clearfix m-b-10">
                     <label for="cemail" class="control-label col-md-4 col-sm-4">Doctor On Board :</label>
                     <?php if($diagnosticData[0]->docOnBoard == 1){?>
                     <p class="col-md-8 col-sm-8 t-xs-left">Available</p>
                     <?php } else {?>
                     <p class="col-md-8 col-sm-8 t-xs-left">Not Available</p>
                     <?php }?>
                     </article>
                     </section>
                     </aside>
                     <?php } ?>  
                     <div class="map_canvas"></div>
                     </section>
                     <?php $formId = 0;
                        if (isset($diagnosticData) && !empty($diagnosticData)) {
                            $formId = $diagnosticData[0]->diagnostic_id;
                        } ?>                                                    
                     <section id="newDetail" style="display:none;">
                        <form name="diagnosticForm" action="<?php echo site_url('diagnostic/saveDetailDiagnostic/' . $formId); ?>" method="post" enctype="multipart/form-data">
                           <input type="hidden" id="StateId" name="StateId" value="<?php echo $diagnosticData[0]->diagnostic_stateId; ?>" />
                           <input type="hidden" id="countryId" name="countryId" value="<?php echo $diagnosticData[0]->diagnostic_countryId; ?>" />
                           <input type="hidden" id="cityId" name="cityId" value="<?php echo $diagnosticData[0]->diagnostic_cityId; ?>" />
                           <input type="hidden" id="diagnostic_id" name="diagnostic_id" value="<?php echo $diagnosticData[0]->diagnostic_id; ?>" />
                           <article class="clearfix m-t-10">
                              <label for="cemail" class="control-label col-md-4 col-sm-4">Diagnostic Centre Name:</label>
                              <div class="col-md-8 col-sm-8">
                                 <input class="form-control" id="diagnosticCenter" name="diagnostic_name" type="text" required="" value="<?php if (!empty($diagnosticData) && isset($diagnosticData)): echo $diagnosticData[0]->diagnostic_name;
                                    endif; ?>" />
                                 <label class="error" style="display:none;" id="error-diagnostic_name"> please enter diagnostic name only alphabet character's!</label>      
                              </div>
                           </article>
                           
                            <article class="clearfix">
                                    <label for="cname" class="control-label col-md-4  col-sm-4">Diagnostic Type :</label>
                                    <div class="col-md-8 col-sm-8">
                                       <select class="form-control select2" data-width="100%" name="diagno_type" id="diagno_type" tabindex="-98">
                                       <?php
                                          if (!empty($diagnosticType)) {
                                              foreach ($diagnosticType as $key => $val) {
                                                  $selected = '';
                                                  if (isset($diagnosticData[0]->diagnoTypeId) && $hospitalData[0]->diagnoTypeId == $val->hospitalType_id) {
                                                      $selected = 'selected = "selected" ';
                                                  }
                                                  echo '<option ' . $selected . ' value="' . $val->hospitalType_id . '">' . $val->hospitalType_name . '</option>';
                                              }
                                          }
                                          ?>
                                       </select>
                                         <label class="error" style="display:none;" id="error-diagno_type"> please select a country</label>
                                         <label class="error" > <?php echo form_error("diagno_type"); ?></label>
                                    </div>
                            </article>
                           
                           <article class="clearfix m-t-10">
                              <label for="cemail" class="control-label col-md-4 col-sm-4">Address :</label>
                              <div class="col-md-8 col-sm-8">
                                 <select class="selectpicker form-control" data-width="100%" name="diagnostic_countryId" id="diagnostic_countryId">
                                    <option value="">Select Country</option>
                                    <?php if (!empty($allCountry)):
                                       foreach ($allCountry as $country):
                                           ?>
                                    <option value="<?php echo $country->country_id; ?>" <?php if ($diagnosticData[0]->diagnostic_countryId == $country->country_id):echo"selected";
                                       endif; ?>><?php echo $country->country; ?></option>
                                    <?php endforeach;
                                       endif; ?>
                                 </select>
                                 <label class="error" style="display:none;" id="error-diagnostic_countryId"> please select a country</label>
                                 <label class="error" > <?php echo form_error("diagnostic_countryId"); ?></label>
                              </div>
                           </article>
                           <article class="clearfix">
                              <div class="col-sm-8 col-sm-offset-4">
                                 <select class="selectpicker form-control" data-width="100%" name="diagnostic_stateId" onchange ="fetchCity(this.value)" id="diagnostic_stateId">
                                    <option value="">Select State</option>
                                    <?php foreach($allStates as $key=>$val) {?>
                                    <option <?php if($diagnosticData[0]->diagnostic_stateId == $val->state_id):echo"selected";endif;?> value="<?php echo $val->state_id;?>"><?php echo $val->state_statename;?></option>
                                    <?php }?>
                                 </select>
                                 <label class="error" > <?php echo form_error("diagnostic_stateId"); ?></label>
                                 <label class="error" style="display:none;" id="error-diagnostic_stateId"> please select a state</label>
                              </div>
                           </article>
                           <article class="clearfix">
                              <div class="col-sm-8 col-sm-offset-4">
                                 <select class="selectpicker form-control" data-width="100%" name="diagnostic_cityId" id="diagnostic_cityId">
                                    <option value="">Select City</option>
                                    <?php foreach($allCities as $key=>$val) {?>
                                    <option <?php if($diagnosticData[0]->diagnostic_cityId == $val->city_id):echo"selected";endif;?> value="<?php echo $val->city_id;?>"><?php echo $val->city_name;?></option>
                                    <?php }?>
                                 </select>
                                 <label class="error" style="display:none;" id="error-diagnostic_cityId"> please select a city</label>
                                 <label class="error" > <?php echo form_error("diagnostic_cityId"); ?></label>
                              </div>
                           </article>
                           <article class="clearfix">
                              <div class="col-sm-8 col-sm-offset-4">
                                 <input type="text" class="form-control" id="diagnostic_zip" name="diagnostic_zip" placeholder="" value="<?php if (!empty($diagnosticData) && isset($diagnosticData)): echo $diagnosticData[0]->diagnostic_zip;
                                    endif; ?>" onkeypress="return isNumberKey(event)"/>
                                 <label class="error" style="display:none;" id="error-diagnostic_zip"> please enter a zip code</label>
                                 <label class="error" > <?php echo form_error("diagnostic_zip"); ?></label>
                              </div>
                           </article>
                           <article class="clearfix m-t-10">
                              <div class="col-sm-8 col-sm-offset-4">
                                 <aside class="clearfix">
                                    <input type="text" class="form-control" id="geocompleteId" name="diagnostic_address" placeholder="" value="<?php if (!empty($diagnosticData) && isset($diagnosticData)): echo $diagnosticData[0]->diagnostic_address;
                                       endif; ?>"/>
                                    <label class="error" style="display:none;" id="error-diagnostic_address"> please enter an address</label>
                                    <label class="error" > <?php echo form_error("diagnostic_address"); ?></label>
                                 </aside>
                              </div>
                           </article>
                           <article class="clearfix">
                              <div class="col-sm-8 col-sm-offset-4">
                                 <aside class="row">
                                    <div class="col-sm-6">
                                       <input name="lat" class="form-control" required="" type="text"   id="lat" <?php if (!empty($diagnosticData) && isset($diagnosticData) && $diagnosticData[0]->isManual == 0) {
                                          echo '';
                                          } ?> value="<?php echo $diagnosticData[0]->diagnostic_lat; ?>" onchange="latChack(this.value)" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"/>
                                       <label class="error" style="display:none;" id="error-lat">Please enter the correct format for latitude</label>
                                       <label class="error" > <?php echo form_error("lat"); ?></label>
                                    </div>
                                    <div class="col-sm-6 m-t-xs-10">
                                       <input name="lng" class="form-control" required="" type="text"  id="lng" <?php if (!empty($diagnosticData) && $diagnosticData[0]->isManual == 0) {
                                          echo '';
                                          } ?> value="<?php echo $diagnosticData[0]->diagnostic_long; ?>" onchange="lngChack(this.value)" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"/>
                                       <label class="error" style="display:none;" id="error-lng"> Please enter the correct format for longitude</label>
                                       <label class="error" > <?php echo form_error("lng"); ?></label>
                                    </div>
                                 </aside>
                              </div>
                           </article>
                           <article class="clearfix m-t-10 ">
                              <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                              <div class="col-md-8 col-sm-8">
                                 <aside class="row">
                                    <div class="col-xs-12 m-t-xs-10">
                                       <input type="text" class="form-control" name="diagnostic_phn" id="diagnostic_phn" placeholder="" value="<?php echo $diagnosticData[0]->diagnostic_phn; ?>" maxlength="10" onkeypress="return isNumberKey(event)"  minlength="10" pattern=".{10,10}"/>
                                    </div>
                                 </aside>
                                 <!-- </br> -->
                                 <label class="error" style="display:none;" id="error-diagnostic_phn1"> please enter a valid phone number</label>
                                 <label class="error" > <?php echo form_error("diagnostic_phn"); ?></label>
                              </div>
                           </article>
                           <article class="clearfix m-t-10">
                              <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person:</label>
                              <div class="col-md-8 col-sm-8">
                                 <input class="form-control" id="diagnostic_cntPrsn" name="diagnostic_cntPrsn" type="text" required="" value="<?php if (!empty($diagnosticData) && isset($diagnosticData)): echo $diagnosticData[0]->diagnostic_cntPrsn;
                                    endif; ?>" />
                                 <label class="error" style="display:none;" id="error-diagnostic_cntPrsn"> please enter the name of a contact person</label>
                                 <label class="error" style="display:none;" id="error-diagnostic_cntPrson_alpha"> please enter contact person name only alphabet character's!</label>   
                                 <label class="error" > <?php echo form_error("diagnostic_cntPrsn"); ?></label>
                              </div>
                           </article>
                           <article class="clearfix m-t-10">
                              <label for="cemail" class="control-label col-md-4 col-sm-4">Designation :</label>
                              <div class="col-md-8 col-sm-8">
                                 <input class="form-control" id="diagnostic_dsgn" name="diagnostic_dsgn" type="text" required="" value="<?php if (!empty($diagnosticData) && isset($diagnosticData)): echo $diagnosticData[0]->diagnostic_dsgn;
                                    endif; ?>" />
                                 <label class="error" style="display:none;" id="error-diagnostic_dsgn"> please enter the name of a contact person designations</label>
                                 <label class="error" style="display:none;" id="error-diagnostic_dsgn_alpha"> please enter contact person designations only alphabet character's!</label>   
                                 <label class="error" > <?php echo form_error("diagnostic_dsgn"); ?></label>
                              </div>
                           </article>
                           
                           <article class="form-group m-lr-0 ">
                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Docat Id :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" id="docatId" name="docatId" type="text" value="<?php if (!empty($diagnosticData) && isset($diagnosticData)): echo $diagnosticData[0]->diagnostic_docatId;
                                    endif; ?>">
                                        <label class="error" > <?php echo form_error("docatId"); ?></label>
                                    </div>
                          </article>
                           
                           <article class="clearfix m-t-10">
                              <label for="cemail" class="control-label col-md-4 col-sm-4">About Us :</label>
                              <div class="col-md-8 col-sm-8">
                                 <!--                                                                    <input class="form-control" id="diagnostic_aboutUs" name="diagnostic_aboutUs" type="text" required="" value="" />-->
                                 <textarea value="" id="diagnostic_aboutUs" name="diagnostic_aboutUs" class="form-control"><?php if (isset($diagnosticData) && !empty($diagnosticData)): echo $diagnosticData[0]->diagnostic_aboutUs;
                                    endif;
                                    ?></textarea>
                                 <!--<span class="error"  id="aboutLimit">255</span> characters remaining-->
                                 <label style="display: none;"class="error" id="error-diagnostic_aboutUs"> Please write about the diagnostic! </label>
                                 <label class="error" > <?php echo form_error("diagnostic_aboutUs"); ?></label>
                              </div>
                           </article>
                           <article class="clearfix">
                              <label class="control-label col-md-4 col-sm-4 col-xs-9" for="cname">Blood bank  </label>
                              <div class="col-md-8 col-xs-3">
                                 <aside class="checkbox checkbox-success m-t-5">
                                    <input type="checkbox" id="bloodbankbtn" name="bloodbank_chk" value="1" <?php if(isset($diagnosticData[0]->diagnostic_hasBloodbank) && $diagnosticData[0]->diagnostic_hasBloodbank == 1){ echo 'checked="checked" '; } ?> >
                                    <label>
                                    </label>
                                 </aside>
                              </div>
                           </article>
                           <section id="bloodbankdetail" style="<?php if(isset($diagnosticData[0]->diagnostic_hasBloodbank) && $diagnosticData[0]->diagnostic_hasBloodbank == 1){ echo 'display:block'; }else{ echo 'display:none'; } ?>">
                              <input type="hidden" name="isBloodBankOutsource"          value="<?php if(isset($diagnosticData[0]->diagnostic_isBloodBankOutsource) && $diagnosticData[0]->diagnostic_isBloodBankOutsource != ''){ echo $diagnosticData[0]->diagnostic_isBloodBankOutsource; } ?>" id="isBloodBankOutsource" >
                              
                              <article class="clearfix m-b-10">
                                 <label for="cemail" class="control-label col-md-4 col-sm-4">Name :</label>
                                 <div class="col-md-8 col-sm-8">
                                    <input class="form-control" name="bloodBank_name" id="bloodBank_name" type="text" value="<?php if(isset($diagnosticData[0]->bloodBank_name)){ echo $diagnosticData[0]->bloodBank_name; } ?>">
                                    <label class="error" style="display:none;" id="error-bloodBank_name"> please Check your Blood Bank name</label>
                                    <div>
                              </article>
                              
                              <?php if(isset($diagnosticData[0]->diagnostic_hasBloodbank) && $diagnosticData[0]->diagnostic_hasBloodbank == 1){ ?>
                              <div class="pro-img" id="crop-blood">
                              <?php echo $this->load->view('edit_bloodbank_upload_crop_modal', array('id' => $diagnosticData[0]->bloodBank_id)); ?>
                              <!-- image -->
                              <?php if (!empty($diagnosticData[0]->bloodBank_photo)) { ?>
                              <img src="<?php echo base_url() ?>assets/BloodBank/thumb/thumb_100/<?php echo $diagnosticData[0]->bloodBank_photo; ?>" alt="" class="logo-img-bloodbank" />
                              <?php } else { ?>
                              <img src="<?php echo base_url() ?>assets/default-images/Blood-logo.png" alt="" class="logo-img-bloodbank" />
                              <?php } ?>
                              <article class="logo-up-bloodbank avatar-view" style="display:none">
                              <?php if (!empty($diagnosticData[0]->name)) { ?>
                              <img src="<?php echo base_url() ?>assets/BloodBank/thumb/thumb_100/<?php echo $diagnosticData[0]->bloodBank_photo; ?>" alt="" class="logo-img-ambulance" style="display:block" />
                              <?php } else { ?>
                              <img src="<?php echo base_url() ?>assets/default-images/Blood-logo.png" alt="" class="logo-img-bloodbank" style="display:block" />
                              <?php } ?>
                              <div class="fileUpload btn btn-sm btn-upload logo-Upload">
                              <span><i class="fa fa-cloud-upload fa-3x "></i></span>
                              <!--                                                        <input id="uploadBtn" type="file" class="upload" />-->
                              <input type="hidden" style="display:none;" class="no-display file_action_url"  name="file_action_url" value="<?php echo site_url('diagnostic/editUploadImageBloodbank'); ?>">
                              <input type="hidden" style="display:none;" class="no-display load_url" id="load_url" name="load_url" value="<?php echo site_url('diagnostic/getUpdateAvtar/' . $diagnosticData[0]->bloodBank_id); ?>/bloodbank">
                              </div>
                              </article>
                              <!-- description div -->
                              <div class='pic-edit bloodbank_edit'>
                              <h3><a  class="pull-center cl-white picEdit-bloodbank" title="Edit Logo" style="display:block;"><i class="fa fa-pencil"></i></a></h3>
                              <h3><a  class="pull-center cl-white picEditClose-bloodbank" title="Cancel"  style="display:none;"><i class="fa fa-times"></i></a></h3>
                              </div>
                              <!-- end description div -->
                              </div>
                        <?php }else{ ?>
                              <article class="clearfix m-t-10">
                                                <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                              <div id="blood-crop-avatar">
                                    <?php $this->load->view('blood_upload_crop_modal'); ?>
                                    <article class="clearfix m-b-10"  class="avatar-form">



                                        <div class="col-md-8 col-sm-8" data-target="#modal" data-toggle="modal">
                                            <label class="col-md-4 col-sm-4" for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x avatar-view"></i></label>

                                            <div class="pre col-md-4 col-sm-4 ">
                                                <div id="preImgLogo" class="avatar-preview preview-md preImgLogo">

                                                    <img src="<?php echo base_url() ?>assets/default-images/Blood-logo.png"  class="image-preview-show"/>

                                                </div>
                                            </div>


                                            <label class="error" > <?php echo form_error("avatar_file"); ?></label>
                                            <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>



                                        </div>
                                    </article>
                                </div>
                              </article>
                         <?php } ?>
                              
                              <article class="clearfix m-b-10">
                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                <div class="col-md-8 col-sm-8">
                                <aside class="row">
                                <div class="col-xs-10 m-t-xs-10">
                                <input type="teL" class="form-control" name="bloodBank_phn" id="bloodBank_phn" value ="<?php if(isset($diagnosticData[0]->bloodBank_phn) && $diagnosticData[0]->bloodBank_phn != ''){ echo $diagnosticData[0]->bloodBank_phn; } ?>" onkeypress="return isNumberKey(event)" maxlength="10" minlength="10" pattern=".{10,10}" />
                                </div>
                                </aside>
                                <label class="error" style="display:none;" id="error-bloodBank_phone"> please Check your Blood Bank Phone</label>
                                </div>
                              </article>
                           </section>
                           <article class="clearfix">
                           <label class="control-label col-md-4 col-sm-4 col-xs-9" for="cname">Pharmacy</label>
                           <div class="col-md-8 col-xs-3">
                           <aside class="checkbox checkbox-success m-t-5">
                           <input type="checkbox" id="pharmacybtn" name="pharmacy_chk" value="1" <?php if(isset($diagnosticData[0]->diagnostic_hasPharmacy) && $diagnosticData[0]->diagnostic_hasPharmacy == 1){ echo 'checked="checked" '; } ?>  >
                           <label>
                           </label>
                           </aside>
                           </div>
                           </article>
                           <article class="clearfix">
                           <label class="control-label col-md-4 col-sm-4 col-xs-9" for="cname">Ambulance</label>
                           <div class="col-md-8 col-xs-3">
                           <aside class="checkbox checkbox-success m-t-5">
                           <input type="checkbox" id="ambulancebtn" name="ambulance_chk" value="1" <?php if(isset($diagnosticData[0]->ambulance_phn) && $diagnosticData[0]->ambulance_phn != ''){ echo 'checked="checked" '; } ?> >
                           <label>
                           </label>
                           </aside>
                           </div>
                           </article>
                           <section id="ambulancedetail" style="<?php if(isset($diagnosticData[0]->ambulance_phn) && $diagnosticData[0]->ambulance_phn != ''){ echo 'display:block'; }else{ echo 'display:none';  } ?>">
                           <article class="clearfix m-b-10">
                           <label for="cemail" class="control-label col-md-4 col-sm-4">Name :</label>
                           <div class="col-md-8 col-sm-8">
                           <input class="form-control" name="ambulance_name" id="ambulance_name" type="text" value="<?php if(isset($diagnosticData[0]->ambulance_name)){ echo $diagnosticData[0]->ambulance_name; } ?>">
                           <label class="error" style="display:none;" id="error-ambulance_name"> please Check your Ambulance Name</label>
                           <div>
                           </article>
                               
                           <?php if(isset($diagnosticData[0]->ambulance_phn) && $diagnosticData[0]->ambulance_phn != ''){ ?>  
                               
                           <div class="pro-img" id="crop-ambulance">
                           <?php echo $this->load->view('edit_ambulance_upload_crop_modal', array('id' => $diagnosticData[0]->ambulance_id)); ?>
                           <!-- image -->
                           <?php if (!empty($diagnosticData[0]->ambulance_img)) { ?>
                           <img src="<?php echo base_url() ?>assets/ambulanceImages/thumb/thumb_100/<?php echo $diagnosticData[0]->ambulance_img; ?>" alt="" class="logo-img-ambulance" />
                           <?php } else { ?>
                           <img src="<?php echo base_url() ?>assets/default-images/ambulance_logo.png" alt="" class="logo-img-ambulance" />
                           <?php } ?>
                           <article class="logo-up-ambulance avatar-view" style="display:none">
                           <?php if (!empty($diagnosticData[0]->ambulance_img)) { ?>
                           <img src="<?php echo base_url() ?>assets/ambulanceImages/thumb/thumb_100/<?php echo $diagnosticData[0]->ambulance_img; ?>" alt="" class="logo-img-ambulance" style="display:block" />
                           <?php } else { ?>
                           <img src="<?php echo base_url() ?>assets/default-images/ambulance_logo.png" alt="" class="logo-img-ambulance" style="display:block" />
                           <?php } ?>
                           <div class="fileUpload btn btn-sm btn-upload logo-Upload">
                           <span><i class="fa fa-cloud-upload fa-3x "></i></span>
                           <!--                                                        <input id="uploadBtn" type="file" class="upload" />-->
                           <input type="hidden" style="display:none;" class="no-display file_action_url"  name="file_action_url" value="<?php echo site_url('diagnostic/editUploadImageAmbulance'); ?>">
                           <input type="hidden" style="display:none;" class="no-display load_url" id="load_url" name="load_url" value="<?php echo site_url('diagnostic/getUpdateAvtar/' . $diagnosticData[0]->ambulance_id); ?>/ambulance">
                           </div>
                           </article>
                           <!-- description div -->
                           <div class='pic-edit ambulance_edit'>
                           <h3><a  class="pull-center cl-white picEdit-ambulance" title="Edit Logo" style="display:block;"><i class="fa fa-pencil"></i></a></h3>
                           <h3><a  class="pull-center cl-white picEditClose-ambulance" title="Cancel"  style="display:none;"><i class="fa fa-times"></i></a></h3>
                           </div>
                           <!-- end description div -->
                           </div>
                           <?php }else{ ?>   
                               <div id="ambulance-crop-avatar">
                                    <?php $this->load->view('ambulance_upload_crop_modal'); ?>
                                    <article class="clearfix m-b-10"  class="avatar-form">
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
                                </div>
                               
                             <?php } ?>
                               
                           <article class="clearfix m-b-10 ">
                           <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                           <div class="col-md-8 col-sm-8">
                           <aside class="row">
                           <div class="col-xs-10 m-t-xs-10">
                           <input type="text" class="form-control" name="ambulance_phn" id="ambulance_phn" value ="<?php if(isset($diagnosticData[0]->ambulance_phn) && $diagnosticData[0]->ambulance_phn != ''){ echo $diagnosticData[0]->ambulance_phn; } ?>" onkeypress="return isNumberKey(event)" onkeypress="return isNumberKey(event)" maxlength="10" minlength="10" pattern=".{10,10}" />
                           </div>
                           </aside>
                           <label class="error" style="display:none;" id="error-ambulance_phn1"> please Check your Ambulance Phone</label>
                           </div>
                           </article>
                           <article class="clearfix">
                           <label class="control-label col-md-4 col-xs-9" for="cname">Doctor On board</label>
                           <div class="col-md-8 col-xs-3">
                           <aside class="checkbox checkbox-success m-t-5">
                           <input type="checkbox" id="docOnBoard" name="docOnBoard" value="1" <?php if($diagnosticData[0]->docOnBoard == 1){ echo "checked";}?> >
                           <label>
                           </label>
                           </aside>
                           </div>
                           </article>
                           </section>  
                           <article class="clearfix">
                           <label class="control-label col-md-4 col-sm-4 col-xs-9" for="cname">Emergency Ward</label>
                           <div class="col-md-8 col-xs-3">
                           <aside class="checkbox checkbox-success m-t-5">
                           <input type="checkbox" id="isEmergency" name="isEmergency" value="1" <?php if($diagnosticData[0]->diagnostic_isEmergency == 1){ echo "checked";}?> />
                           <label>
                           </label>
                           </aside>
                           </div>
                           </article>
                           <article class="clearfix">
                           <label class="control-label col-md-4 col-sm-4 col-xs-9" for="cname">24*7 Availibility</label>
                           <div class="col-md-8 col-xs-3">
                           <aside class="checkbox checkbox-success m-t-5">
                           <input type="checkbox" id="availibility_24_7" name="availibility_24_7" value="1" <?php if($diagnosticData[0]->diagnostic_availibility_24_7 == 1){ echo "checked";}?> />
                           <label>
                           </label>
                           </aside>
                           </div>
                           </article>
                           <input name="user_tables_id" id="user_tables_id" type="hidden" value="<?php if (isset($diagnosticData[0]->diagnostic_usersId)) { echo $diagnosticData[0]->diagnostic_usersId; } ?>">
                           <input  type="hidden" name="isManual" value="1" id="isManual">
                           <article class="clearfix ">
                           <div class="col-md-12 m-t-20 m-b-20">


                           <button type="submit" class="btn btn-success waves-effect waves-light pull-right" onclick="return changeStatusUpdate()">Update</button>

                           </div>
                           </article>
                        </form>
                     </section>
                     <div class="gap"></div>
                     <article class="clearfix company-logo">
                     <aside class="clearfix">
                     <h4>Insurance Company Tied
                     <a id="editcompany" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                     </h4>
                     <hr/>
                     </aside>
                     <section id="detailcompany">
                     <?php if(!empty($insurance)){
                        foreach($insurance as $key => $val){    
                        ?>
                     <div class="col-md-3 col-sm-6 part-ins">
                     <a class="delete-ins" href="javascript:void(0)" onclick="deletInsurance(<?php echo $val->diagnoInsurance_id;?>)"><i class="fa fa-close"></i></a>
                     <img src="<?php echo base_url()?>assets/insuranceImages/3x/<?php echo $val->insurance_img;?>" class="img-responsive center-block img-ins">
                     <h5><?php echo substr($val->insurance_Name,0,50);?></h5>
                     </div>
                     <?php }} else{?>
                     <div class="col-md-6 col-sm-6">
                     <h5>Please select Insurance company</h5>
                     </div>
                     <?php }?>
                     </section>
                     <section id="newcompany" style="display:none;">
                     <form name="insuranceForm" id="insuranceForm" action="<?php echo site_url("diagnostic/addInsurance/$diagnosticId"); ?>" method="post">
                     <input type="hidden" name="hospitalInsuranceId" id="hospitalInsuranceId" value="<?php echo $diagnosticId;?>" />
                     <article class="clearfix m-b-10">
                     <label for="cemail" class="control-label col-md-4 col-sm-4">Company Name :</label>
                     <div class="col-md-8 col-sm-8">
                     <!--<input class="form-control" id="diagnosticCenter" name="name" type="text" required=""> -->
                     <select  multiple="" class="select2" data-width="100%" name="insurances[]" Id="insurances" data-size="4" >
                     <?php foreach($allInsurance as $key=>$val) {?>
                     <option value="<?php echo $val->insurance_id;?>"><?php echo $val->insurance_Name;?></option>
                     <?php }?>
                     </select>
                     </div>
                     </article>
                     <article class="clearfix ">
                     <div class="col-md-12 m-t-20 m-b-20">
                     <button type="submit" class="btn btn-success waves-effect waves-light pull-right">Add More</button>
                     </div>
                     </article>
                     </form>    
                     </section>
                     </article> 
                     <div class="gap"></div>
                     </div>                                                             
                     <div class="col-md-6 p-b-20">
                     <article class="clearfix">                                                   
                     <!-- Awards Recognition  -->  
                     <article class="clearfix">
                     <h4>Awards Recognition
                     <a id="editawards" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                     </h4>
                     <hr/>
                     <aside class="clearfix" id="detailawards">
                     <ul class="ul-tick" id="loadAwards">
                     </ul>
                     </aside>                                        
                     <form id="newawards" style="display:none">
                     <aside class="form-group m-lr-0 p-b-20 m-b-30">
                     <label for="cname" class="control-label col-lg-3 col-sm-4">Awards:</label>
                     <div class="col-lg-9 col-sm-8">
                     <aside class="row">
                     <div class="col-md-12 ">
                     <input type="text" class="form-control" placeholder="Awards name" id="diagnostic_awardsName" name="diagnostic_awardsName"/>
                     <label style="display: none;"class="error" id="error-awards"> Please enter award name </label>  
                     <div class="clearfix m-t-10">
                     <select class="selectpicker" data-width="100%" id="diagnosticAwards_agencyName" name="diagnosticAwards_agencyName">
                     <option value="">Select Agency</option>
                     <?php if(!empty($awardAgency)){
                        foreach($awardAgency as $key => $val){    
                        ?>
                     <option value="<?php echo $val->awardAgency_id;  ?>"><?php echo $val->agency_name;  ?></option>
                     <?php }  } ?>
                     </select>
                     <label style="display: none;"class="error" id="error-diagnosticAwards_agencyName"> Please enter agency name </label>
                     </div>
                     <div class="clearfix m-t-10">
                     <input type="text" class="form-control" placeholder="Year" id="diagnostic_awardsyear" name="diagnostic_awardsyear" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  />
                     <label style="display: none;"class="error" id="error-years"> Please enter year only number formate minium and maximum length 4 </label> 
                     <label style="display: none;"class="error" id="error-years-valid">Invalid Year! Please enter year between 1920 to <?php echo date('Y') ?>  </label> 
                     </div>
                     </div>
                     <div class="clearfix">
                     <div class="col-md-2 col-sm-2 col-xs-2 pull-right text-right">
                     <a onclick="addAwards()" class="pointer"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus" title="Add More"></i></a>
                     </div>
                     </div>
                     </aside>
                     <div id="totalAwards">                                                
                     </div>
                     </div>
                     </aside>
                     </form>
                     </article>
                     <!-- Awards Recognition  --> 
                     <!-- Services  -->                            
                     <aside class="clearfix">
                     <h4>Services
                     <a id="editservices" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                     </h4>
                     <hr/>
                     </aside>
                     <section id="detailservices">
                     <ul class="ul-tick" id="loadServices">
                     </ul>
                     </section>
                     <form>
                     <aside class="form-group m-lr-0" id="newservices" style="display:none">
                     <label for="cname" class="control-label col-lg-3 col-sm-4">Services:</label>
                     <div class="col-lg-9 col-sm-8">
                     <aside class="row">
                     <div class="col-md-10 col-sm-10 col-xs-10">
                     <input type="text" class="form-control" placeholder="Diagnostic Services" id="diagnostic_serviceName" name="diagnostic_serviceName"/>
                     <label style="display: none;"class="error" id="error-serviceName"> Please enter service name </label> 
                     </div>
                     <div class="col-md-2 col-sm-2 col-xs-2">
                     <a class="pointer" onclick="addServices()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus" title="Add More"></i></a>
                     </div>
                     </aside>
                     <div id="totalServices">                                                   
                     </div>
                     </div>
                     </aside>
                     </form>
                     </article>
                     <!-- Services  -->                            
                     </div>                                                             
            </aside>
            </div>
         </article>
         </section>                      
         <!-- General Detail Ends -->  
         <!--Collection Center Start-->
         <section class="tab-pane fade in <?php if (isset($active) && $active == 'collectionCenter') {
            echo "active";
            } ?>" id="collectionCenter">
         <article class="clearfix">
         <h4>Collection Center
         <a id="editCollectonCenter" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
         </h4>
         <hr/>
         <aside class="clearfix" id="detailCenter">
         <ul class="ul-tick" id="loadCenter">
         </ul>
         </aside>                                        
         <form id="newCenter" style="display:none">
         <aside class="form-group m-lr-0 p-b-20 m-b-30">
         <label for="cname" class="control-label col-lg-3 col-sm-4">Center Name:</label>
         <div class="col-lg-9 col-sm-8">
         <aside class="row">
         <div class="col-md-12 ">
         <input type="text" class="form-control" placeholder="Center Name" id="centerName" name="centerName"/>
         <label style="display: none;"class="error" id="error-centerName"> Please enter collection center name </label>  
         <aside class="clearfix m-t-10">
         <input type="text" class="form-control" placeholder="Address" id="centerAddress" name="centerAddress"/>
         <label style="display: none;"class="error" id="error-centerAddress"> Please enter center address</label> 
         </aside>
         <aside class="row m-t-10">
         <div class="col-sm-6">
         <input name="centerLat" class="form-control" required="" type="text"   id="centerLat"  value="" onchange="latChack(this.value)" placeholder="latitude"/>
         <label class="error" style="display:none;" id="error-centerLat">Please enter the correct format for latitude</label>
         </div>
         <div class="col-sm-6 m-t-xs-10">
         <input name="centerLong" class="form-control" required="" type="text"  id="centerLong" value="" onchange="lngChack(this.value)" placeholder="longitude"/>
         <label class="error" style="display:none;" id="error-centerLong"> Please enter the correct format for longitude</label>
         </div>
         </aside>
         </div>
         <div class="clearfix">
         <div class="col-md-2 col-sm-2 col-xs-2 pull-right text-right">
         <a onclick="addCenter()" class="pointer"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus" title="Add More"></i></a>
         </div>
         </div>
         </aside>
         <div id="totalCenter">                                                
         </div>
         </div>
         </aside>
         </form>
         </article>
         </section>
         <!-- Collection Center End --> 
         <!--diagnostic Starts -->
         <section class="tab-pane fade in diagdetail <?php if (isset($active) && $active == 'diag') {
            echo "active";
            } ?>" id="diagnostic">
         <!-- first Section Start -->
         <aside class="clearfix">
         <section class="col-md-5 detailbox m-b-20 diag" >
         <aside class="bg-white">
         <figure class="clearfix">
         <h3>Diagnostic Categories Available</h3>
         <article class="clearfix">
         <div class="input-group m-b-5">
         <span class="input-group-btn">
         <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
         </span>
         <input type="text" id="search-text1" placeholder="search" class="form-control">
         </div>
         </article>
         </figure>
         <div class="nicescroll mx-h-400">
         <div class="clearfix diag-detail">
         <ul id="list2">
         </ul>
         </div>
         </div>
         </aside>
         </section>
         <!-- first Section End -->
         <section class="col-md-2 detailbox m-b-20 text-center">
         <div class="m-t-150">
         <a onclick="addDiagnostic()" id="addDiagnosticeArrow"><i class="fa fa-arrow-right s-add"></i></a>
         </div>
         <div class="m-t-50">
         <a onclick="revertDiagnostic()" id="revertDiagnosticeArrow"> <i class="fa fa-arrow-left s-add"></i></a>
         </div>
         </section>
         <!-- second Section Start -->
         <section class="col-md-5 detailbox m-b-20 diag">
         <aside class="bg-white">
         <figure class="clearfix">
         <h3>Diagnostic Categories Added</h3>
         <article class="clearfix">
         <div class="input-group m-b-5">
         <span class="input-group-btn">
         <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
         </span>
         <input type="text" id="search-text" placeholder="search" class="form-control">
         </div>
         </article>
         </figure>
         <div class="nicescroll mx-h-400">
         <div class="clearfix diag-detail">
         <ul id="list3">
         </ul>
         </div>
         </div>
         </aside>
         </section>
         <!-- second Section End -->
         </aside>
         <!--    <section class="clearfix detailbox m-b-20">
            <div class="col-md-8" ng-app="myApp" ng-controller="diag - c - avail">  
                <figure class="clearfix">
                    <h3>Diagnostic Test Pricing Setup</h3>
                    <article class="clearfix">
                        <div class="input-group m-b-5">
                            <span class="input-group-btn">
                                <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                            </span>
                            <input type="text" placeholder="Search" class="form-control" name="example-input1-group2" id="example-input1-group2">
                        </div>
                    </article>
                </figure>
                <aside class="table-responsive">
                    <table class="table">
                        <col style="width:70%">
                        <col style="width:20%">
                        <col style="width:10%">
                        <tbody>
                            <tr class="border-a-dull">
                                <th>Test Name</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </tbody>
                    </table>
                    <article class="nicescroll mx-h-300">
                        <div class="error errorMessage"></div>
                        <div class="successMessage"></div>
                        <table class="table">
                            <col style="width:70%">
                            <col style="width:20%">
                            <col style="width:10%">
                            <tbody id="loadTestDetail">
                            </tbody>
                        </table>
                    </article>
                </aside>
            </div>
            <div class="col-md-4">
                <figure class="clearfix">
                    <h3 class="pull-left ">Test Preparation Instruction</h3>
                </figure>
                <aside class="clearfix mx-h-400">
                    <article class="nicescroll">
                        <p class="p-5" id="detailInstruction">
                        </p>
                        <aside class="clearfix p-5">
                            <a href="#" class="btn btn-success waves-effect waves-light m-b-5 p-abs " data-toggle="modal" data-target="#myModal">Edit</a>
                        </aside>
                    </article>
                </aside>
            </div>
            </section>-->
         </section>
         <!-- diagnostic Ends -->
         <!--Specialities Starts -->
         <section class="tab-pane fade in" id="specialities" <?php if (isset($active) && $active == 'specialities') {
            echo "active";
            } ?>">
         <article class="clearfix">
         <label class="control-label col-md-4" for="cname">Speciality Name display format:</label>
         <div class="col-md-8">
         <aside class="radio radio-info radio-inline">
         <input <?php echo set_radio('specialityNameFormate', '1', TRUE); ?> type="radio"  name="specialityNameFormate" value="1" id="specialityNameFormate" onclick="setSpecialityNameFormate(this.value)" <?php if ($diagnosticData[0]->diagnostic_specialityNameFormate == 1) {
            echo "checked";
            } ?> >
         <label for="inlineRadio1"> General Name</label>
         </aside>
         <aside class="radio radio-info radio-inline">
         <input <?php echo set_radio('specialityNameFormate', '0'); ?> type="radio" name="specialityNameFormate" value="0" id="specialityNameFormate" onclick="setSpecialityNameFormate(this.value)" <?php if ($diagnosticData[0]->diagnostic_specialityNameFormate == 0) {
            echo "checked";
            } ?>>
         <label for="inlineRadio2"> Scientific Name</label>
         </aside>
         </div>
         </article>
         <aside class="clearfix">  
         <section class="col-md-5 detailbox m-b-20 diag" >
         <aside class="bg-white">
         <figure class="clearfix">
         <h3>Specialities Available</h3>
         <article class="clearfix">
         <div class="input-group m-b-5">
         <span class="input-group-btn">
         <button class="b-search waves-effect waves-light btn-success " type="button"><i class="fa fa-search"></i></button>
         </span>
         <input type="text" id="search-text2" placeholder="search" class="form-control">
         </div>
         </article>
         </figure>
         <div class="nicescroll mx-h-400">
         <div class="clearfix diag-detail">
         <ul id="list4">
         </ul>
         </div>
         </div>
         </aside>
         </section>
         <!-- first Section End -->
         <section class="col-md-2 detailbox m-b-20 text-center">
         <div class="m-t-150">
         <a onclick="addSpeciality(<?php if (!empty($diagnosticData)): echo $diagnosticData[0]->diagnostic_usersId;
            endif; ?>)"><i class="fa fa-arrow-right s-add"></i></a>
         </div>
         <div class="m-t-50">
         <a onclick="revertSpeciality()"> <i class="fa fa-arrow-left s-add"></i></a>
         </div>
         </section>
         <!-- second Section Start -->
         <section class="col-md-5 detailbox m-b-20 diag">
         <aside class="bg-white">
         <figure class="clearfix">
         <h3>Specialities Added</h3>
         <article class="clearfix">
         <div class="input-group m-b-5">
         <span class="input-group-btn">
         <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
         </span>
         <input type="text" id="search-text3" placeholder="search" class="form-control">
         </div>
         </article>
         </figure>
         <div class="nicescroll mx-h-400">
         <div class="clearfix diag-detail">
         <ul id="list5">  
         </ul>
         </div>
         </div>
         </aside>
         </section>
         <!-- second Section End -->
         </aside>
         </section>
         <!-- Specialities Ends -->  
         <!--Gllery Starts -->
         <!--<section class="tab-pane fade in <?php if (isset($active) && $active == 'gallery') {
            echo "active";
            } ?>" id="gallery">
            <div class="fileUpload btn btn-sm btn-upload im-upload avatar-view-gallery">
                <img src="<?php echo base_url(); ?>assets/default-images/Dignostics-logo.png" style="display:none;" />
                <span class="btn btn-appointment " >Add More</span>
                                                     <input type="file" class="upload" id="uploadBtn"> 
            </div>
             <input type="hidden" style="display:none;" class="no-display" id="file_action_url_gallery" name="file_action_url_gallery" value="<?php echo site_url('diagnostic/galleryUploadImage'); ?>" />
             <input type="hidden" style="display:none;" class="no-display" id="load_url_gallery" name="load_url_gallery" value="<?php echo site_url('diagnostic/getGalleryImage/' . $this->uri->segment(3)); ?>">
            <div class="clearfix" id="display_gallery">
            <?php if (!empty($gallerys)) {
               foreach ($gallerys as $gallery) { ?>
                      <aside class="col-md-3 col-sm-4 col-xs-6 show-image">
                            <img width="210" class="thumbnail img-responsive" src="<?php echo base_url() ?>/assets/diagnosticsImage/thumb/original/<?php echo $gallery->diagonsticImages_ImagesName ?>">
                            <a class="delete" onClick="deleteGalleryImage(<?php echo $gallery->diagonsticImages_id ?>)"> <i class="fa fa-times fa-2x"></i></a>
                        </aside>
            <?php }
               } ?>
            </div>
            </section>-->
         <!--Gallery Ends -->
         <?php
            $diaId = 0;
            if (!empty($diagnosticData) && isset($diagnosticData)) {
                $diaId = $diagnosticData[0]->diagnostic_id;
            }
            ?>
         <!--Timeslot Starts -->
         <section class="tab-pane fade in <?php if (isset($active) && ($active == 'timeslot' OR $active == 'timeSlot')) {
            echo "active";
            } ?>" id="timeslot">
           
        <?php if(isset($diagnosticData[0]->diagnostic_availibility_24_7) && $diagnosticData[0]->diagnostic_availibility_24_7 == 1){ 
                         
                         echo "24/7 Services available"; 
                     
                     }else{ ?>
             
         <?php if (isset($timeSlot) && !empty($timeSlot)): ?>
         <form method="post" name="timeSlotForm" id="timeSlotForm" action="<?php echo site_url('diagnostic/updateTimeSlot'); ?>">
         <input type="hidden" name="mi_user_id" value="<?php if (isset($diagnosticData[0]->diagnostic_usersId)) {
            echo $diagnosticData[0]->diagnostic_usersId;
            } ?>" id="mi_user_id" />
         <input type="hidden" name="mi_id" value="<?php if (isset($diagnosticData[0]->diagnostic_id)) {
            echo $diagnosticData[0]->diagnostic_id;
            } ?>" />
         <input type="hidden" name="redirectControllerMethod" value="diagnostic/detailDiagnostic" />
         <?php echo $this->load->view('common_pages/edit_time_slot_view'); ?>
         <article class="clearfix m-t-10">
         <div class="col-md-12">
         <button class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" type="submit" onclick="return timeSlotCheck()">Update</button>
         </div>
         </article>
         </form>
         <?php else: ?>
         <form method="post" name="timeSlotForm" id="timeSlotForm" action="<?php echo site_url('diagnostic/setTimeSlotMi'); ?>">
         <input type="hidden" name="mi_user_id" value="<?php if (isset($diagnosticData[0]->diagnostic_usersId)) {
            echo $diagnosticData[0]->diagnostic_usersId;
            } ?>" />
         <input type="hidden" name="mi_id" value="<?php if (isset($diagnosticData[0]->diagnostic_id)) {
            echo $diagnosticData[0]->diagnostic_id;
            } ?>" />
         <input type="hidden" name="redirectControllerMethod" value="diagnostic/detailDiagnostic" />
         <?php echo $this->load->view('common_pages/time_slot_view'); ?>
         <article class="clearfix m-t-10">
         <div class="col-md-12">
         <button class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" type="submit" onclick="return timeSlotCheck()">Submit</button>
         </div>
         </article>
         </form>
         <?php endif; ?>
         <?php } ?>
         </section>
         <!-- Timeslot Ends -->
         <!--Staff and Permission Starts -->
         <section class="tab-pane fade in <?php if (isset($active) && $active == 'doctor') { echo "active"; } ?>" id="doctor">
         <!-- Form Section Start -->
         <article class="row p-b-10" style="margin-left: 0" style="<?php if (isset($showDiv) &&  $showDiv == 'timeSlot') {  echo "display:none"; } ?>">
         <aside class="col-md-2 col-sm-2" id="AddNewDoc" style="<?php if (isset($showDiv) && $showDiv == 'adddoctor' OR $showDiv == 'editDoctor' OR $showDiv == 'timeSlot') {  echo "display:none"; } ?>">
         <button class="btn btn-success waves-effect waves-light m-l-10 pull-right addDoctorButton" onclick="addNewDoctor();" >Add New Doctor</button>
         </aside>
         <aside class="col-md-3 col-sm-3 m-tb-xs-3 pull-right" style="<?php if (isset($showDiv) && $showDiv == 'adddoctor' OR $showDiv == 'editDoctor' OR $showDiv == 'timeSlot') {  echo "display:none"; } ?>">
         <input type="text" name="search" id="search" class="form-control" placeholder="Search" />
         </aside>
         </article>
         <!-- Form Section End -->
         <article class="clearfix m-top-40 p-b-20" id="doctorList" style="<?php if (isset($showDiv) && $showDiv == 'adddoctor' OR $showDiv == 'editDoctor' OR $showDiv == 'timeSlot') {  echo "display:none"; } ?>">
         <aside class="table-responsive">
         <table class="table all-doctor" id="diagnostic_doctors" style="width:100%">
         <thead>
         <tr class="border-a-dull">
         <th>Photo</th>
         <th>Name and Id</th>
         <th>Speciality</th>
         <th>Consulting fee</th>
         <th>Experience</th>
         <th>Phone</th>
         <th>Action</th>
         <th>Status</th>
         </tr>
         </thead>
         </table>
         </aside>
         </article>
         
         <div id="doctorForm" style="<?php if (isset($showDiv) && $showDiv == 'adddoctor') { echo "display:block"; } else { echo "display:none"; } ?>" >
         <?php echo $this->load->view('addDoctor'); ?>
         <?php echo $this->load->view('doctorScript.php'); ?>
         </div>
         <div id="editDoctorForm" style="<?php if (isset($showDiv) && $showDiv == 'editDoctor') { echo "display:block"; } else {  echo "display:none"; } ?>" >
         <?php echo $this->load->view('editDoctor'); ?>
         </div>
         <div id="editDoctorTimeSlot" style="<?php
               if (isset($showDiv) && $showDiv === 'timeSlot') {
                   echo "display:block";
               } else {
                   echo "display:none";
               }
               ?>" >
            <?php  echo $showDiv == 'timeSlot' ? $this->load->view('timeSlot') : '' ; ?>
            </div>
         </section>
         <!-- Staff and Permission Ends -->
         <!--Membership Starts -->
         <section class="tab-pane fade in <?php if (isset($active) && $active == 'membership') { echo "active"; } ?>" id="membership"> 
         <form method="post" name="membershipForm" id="membershipForm">
         <aside class="col-md-9 setting">
         <h4>Membership Detail
         <?php if(isset($membership_datail) && $membership_datail != NULL){ ?>
         <a id="editMem"  class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a> 
         <?php }else{ ?>
         <a id="editMem"  class="pull-right cl-plus"><i class="fa fa-plus"></i></a>   
         <?php } ?>
         </h4>
         <hr/>
         <div class="clearfix m-t-20 p-b-20 " id="detailMem">
         <?php if(isset($membership_datail) && $membership_datail){
            foreach($membership_datail as $membership){ ?>
         <article class="clearfix m-b-10">
         <label for="cemail" class="control-label col-md-4 col-sm-5"><?php echo $membership->facilities_name; ?>:</label>
         <p class="col-md-8 col-sm-7"><?php echo $membership->miMembership_quantity; ?> <?php echo $membership->facilities_name; ?> <?php if($membership->facilities_id == 2 || $membership->facilities_id == 4){ if(isset($membership->miMembership_duration) && $membership->miMembership_duration != 0){ echo "For ".$membership->miMembership_duration." "."Weeks"; } } ?></p>
         </article>
         <?php } } ?>
         </div>
         <aside id="newMem" style="display:none">
         <?php $checkBocCount = 1; 
            if(isset($membership_datail) && $membership_datail != NULL){ ?>
         <input type="hidden" value="<?php echo count($membership_datail); ?>" id="faci_count" name="faci_count">    
         <input type="hidden" value="<?php echo $diagnosticData[0]->diagnostic_usersId; ?>" id="digo_id" name="digo_id">
         <input type="hidden" value="<?php echo $diagnosticData[0]->diagnostic_id; ?>" id="diagnoId" name="diagnoId">
         <article class="clearfix m-t-10">
         <label for="cname" class="control-label col-md-4 col-sm-4">Membership Type :</label>
         <div class="col-md-8  col-sm-8">
         <select class="selectpicker" data-width="100%" name="diagnostic_mbrTyp" id="diagnostic_mbrTyp" onchange="find_membershipdata(this.value)" >
         <option value="">Select Membership</option>
         <?php if(isset($membership_plan) && $membership_plan){ 
            foreach($membership_plan as $membership){ ?>
         <option value="<?php echo $membership->membership_id; ?>" <?php if($diagnosticData[0]->diagnostic_mbrTyp == $membership->membership_id){ echo "selected"; } ?> ><?php echo $membership->membership_name; ?></option>
         <?php } } ?>
         </select>
         <label class="error" id="err_diagnostic_mbrTyp" > <?php echo form_error("diagnostic_mbrTyp"); ?></label>
         </div>
         </article>
         <?php foreach($membership_datail as $facilities){ ?>
         <label class="control-label col-md-4 col-xs-9" for="cname"><?php echo $facilities->facilities_name; ?></label>
         <div class="col-md-8 col-sm-8">
         <aside class="row">
         <input type="hidden" value="<?php echo $facilities->miMembership_id; ?>" id="miMembershipId_<?php echo $checkBocCount; ?>" name="miMembershipId_<?php echo $checkBocCount; ?>">
         <input type="hidden" value="<?php echo $facilities->miMembership_facilitiesId; ?>" id="miFacilitiesId_<?php echo $checkBocCount; ?>" name="miFacilitiesId_<?php echo $checkBocCount; ?>">
         <div class="col-md-6 col-sm-6">
         <input type="number" id="membership_quantity_<?php echo $checkBocCount; ?>" name="membership_quantity_<?php echo $checkBocCount; ?>" class="form-control" min="1" max="25" value="<?php echo $facilities->miMembership_quantity ?>"/>
         <label class="error" id="err_membership_quantity_<?php echo $checkBocCount; ?>" > <?php echo form_error("membership_quantity"); ?></label>
         </div>
         <?php if($facilities->facilities_id == 2 || $facilities->facilities_id == 4){ ?>
         <div class="col-md-6 col-sm-6 m-t-xs-10">
         <input type="number" id="membership_duration_<?php echo $checkBocCount; ?>" name="membership_duration_<?php echo $checkBocCount; ?>" class="form-control" min="1" max="25" value="<?php  echo $facilities->miMembership_duration; ?>"/>
         <label class="error" id="err_membership_duration_<?php echo $checkBocCount; ?>" > <?php echo form_error("membership_duration"); ?></label>
         </div>
         <?php } ?>
         </aside>
         </div>
         <?php $checkBocCount++; } ?> 
         <article class="clearfix ">
         <div class="col-md-12 m-t-20 m-b-20">
         <input type="submit" name="submit" class="btn btn-success waves-effect waves-light pull-right" value="Update" >
         </div>
         </article>
         <?php }else{ ?>
         <aside class="clearfix m-t-20 p-b-20">
         <input type="hidden" value="<?php echo $diagnosticData[0]->diagnostic_usersId; ?>" id="digo_id" name="digo_id">
         <input type="hidden" value="<?php echo $diagnosticData[0]->diagnostic_id; ?>" id="diagnoId" name="diagnoId">
         <article class="clearfix m-t-10">
         <label for="cname" class="control-label col-md-4 col-sm-4">Membership Type :</label>
         <div class="col-md-8  col-sm-8">
         <select class="selectpicker" data-width="100%" name="diagnostic_mbrTyp" id="diagnostic_mbrTyp" onchange="find_membershipdata(this.value)">
         <option value="">Select Membership</option>
         <?php if(isset($membership_plan) && $membership_plan){ 
            foreach($membership_plan as $membership){ ?>
         <option value="<?php echo $membership->membership_id; ?>" <?php echo set_select('diagnostic_mbrTyp', $membership->membership_id); ?> ><?php echo $membership->membership_name; ?></option>
         <?php } } ?>
         </select>
         <label class="error" id="err_diagnostic_mbrTyp" > <?php echo form_error("diagnostic_mbrTyp"); ?></label>
         </div>
         </article>
         <article class="clearfix m-t-10">
         <?php $checkBocCount = 1; 
            if(isset($facilities_list) && $facilities_list != NULL){ ?>
         <input type="hidden" value="<?php echo count($facilities_list); ?>" id="faci_count" name="faci_count">    
         <?php foreach($facilities_list as $facilities){ ?>
         <label class="control-label col-md-4 col-xs-9" for="cname"><?php echo $facilities->facilities_name; ?></label>
         <div class="col-md-8 col-sm-8">
         <aside class="row">
         <input type="hidden" value="<?php echo $facilities->facilities_id; ?>" id="miFacilitiesId_<?php echo $checkBocCount; ?>" name="miFacilitiesId_<?php echo $checkBocCount; ?>">
         <div class="col-md-6 col-sm-6">
         <input type="number" id="membership_quantity_<?php echo $checkBocCount; ?>" name="membership_quantity_<?php echo $checkBocCount; ?>" class="form-control" min="1" max="25" />
         <label class="error" id="err_membership_quantity_<?php echo $checkBocCount; ?>" > <?php echo form_error("membership_quantity"); ?></label>
         </div>
         <?php if($facilities->facilities_id == 2 || $facilities->facilities_id == 4){ ?>
         <div class="col-md-6 col-sm-6 m-t-xs-10">
         <input type="number" id="membership_duration_<?php echo $checkBocCount; ?>" name="membership_duration_<?php echo $checkBocCount; ?>" class="form-control" min="1" max="25" <?php if($facilities->facilities_id == 2 || $facilities->facilities_id == 4){  } ?>/>
         <label class="error" id="err_membership_duration_<?php echo $checkBocCount; ?>" > <?php echo form_error("membership_duration"); ?></label>
         </div>
         <?php } ?>
         </aside>
         </div>
         <?php $checkBocCount++;} } ?>
         </article>
         <article class="clearfix ">
         <div class="col-md-12 m-t-20 m-b-20">
         <input type="submit" name="submit" class="btn btn-success waves-effect waves-light pull-right" value="Submit" >
         </div>
         </article>
         </aside>
         <?php } ?>
         </aside>
         </form>    
         </section>
         <!-- Membership Ends -->
         <!--Account Starts -->
         <section class="tab-pane fade in <?php if (isset($active) && $active == 'account') {
            echo "active";
            } ?>" id="account"> 
         <form method="post" name="acccountForm" id="acccountForm">
         <!--                                        <p class="text-success" style="display:none;" id="error-password_email_check_success"> Data Changed Successfully!</p>-->
         <aside class="col-md-9 setting">
         <h4>Account Detail
         <a id="editac"  class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
         </h4>
         <hr/>
         <div class="clearfix m-t-20 p-b-20 doctor-description" id="detailac">
         <article class="clearfix m-b-10">
         <label for="cemail" class="control-label col-md-4 col-sm-5">Registered Email Id :</label>
         <p class="col-md-8 col-sm-7"><?php if (!empty($diagnosticData)): echo $diagnosticData[0]->users_email;
            endif; ?></p>
         </article>
         <article class="clearfix m-b-10">
         <label for="cemail" class="control-label col-md-4 col-sm-5">Registered Mobile Number:</label>
         <p class="col-md-8 col-sm-7">        
         <?php if (isset($diagnosticData[0]->users_mobile)): echo $diagnosticData[0]->users_mobile;
            endif; ?>
         </p>
         </article>
             
<!--         <article class="clearfix m-b-10">
         <label for="cemail" class="control-label col-md-4 col-sm-5">Membership Type:</label>
         <p class="col-md-6 col-sm-5"><?php
            if (!empty($diagnosticData)) {
                if ($diagnosticData[0]->diagnostic_mbrTyp == 1) {
                    echo"Life Time";
                } else {
                    echo "Health Club";
                }
            };
            ?></p>-->
         <!--                                                     <aside class="col-sm-2"> -->
         <!--                                                         <button class="btn btn-appointment waves-effect waves-light pull-right" type="button">Upgrade</button> -->
         <!--                                                     </aside> -->
         </article>
         <!--                                                 <article class="clearfix m-b-10"> -->
         <!--                                                     <label for="cemail" class="control-label col-md-4 col-sm-5">Change Password:</label> -->
         <!--                                                     <aside class="col-md-5 col-sm-6"> -->
         <!--                                                         <form class=""> -->
         <!--                                                             <input type="password" name="password" class="form-control" placeholder="New Password" /> -->
         <!--                                                         </form> -->
         <!--                                                     </aside> -->
         <!--                                                 </article> -->
         </div>
         <aside id="newac" style="display:none">
         <article class="clearfix m-b-10">
         <label for="cemail" class="control-label col-md-4 col-sm-4">Registered Email Id :</label>
         <div class="col-md-8 col-sm-8">
         <input class="form-control" id="users_email" name="users_email" type="text" value="<?php if (!empty($diagnosticData)): echo $diagnosticData[0]->users_email;
            endif; ?>" onblur="checkEmailFormat()" required="" readonly="">
         <label class="error" style="display:none;" id="error-users_email"> please enter Email id Properly</label>
         <label class="error" style="display:none;" id="error-users_email_check"> Email Already Exits!</label>
         <label class="error" > <?php echo form_error("users_email"); ?></label>
         </div>
         </article>    
         <input type="hidden" id="user_tables_id" name="user_table_id" value="<?php if (!empty($diagnosticData)): echo $diagnosticData[0]->diagnostic_usersId;
            endif; ?>"/>
         <article class="clearfix m-b-10 ">
         <label for="cemail" class="control-label col-md-4 col-sm-4">Mobile Numbers :</label>
         <div class="col-md-8 col-sm-8">
         <input type="teL" class="form-control" name="users_mobile" id="users_mobile" placeholder="9837000123" maxlength="10" onkeypress="return isNumberKey(event)" value="<?php if (isset($diagnosticData[0]->users_mobile)) {
            echo $diagnosticData[0]->users_mobile;
            } ?>"/>
         <label class="error" id="error-users_mobile" style="display:none;"> Enter Mobile Number</label>                                         
         </div>
         </article>
         
<!--         <article class="clearfix m-b-10">
         <label for="cname" class="control-label col-md-4 col-sm-4">Membership Type:</label>
         <div class="col-md-8 col-sm-8">
         <select class="selectpicker" data-width="100%" name="diagnostic_mbrTyp">
         <option value="1" <?php
            if (!empty($diagnosticData)) {
                if ($diagnosticData[0]->diagnostic_mbrTyp == 1) {
                    echo"selected";
                }
            }
            ?>>Life Time</option>
         <option value="2" <?php
            if (!empty($diagnosticData)) {
                if ($diagnosticData[0]->diagnostic_mbrTyp == 2) {
                    echo"selected";
                }
            }
            ?>>Health Club</option>
         </select>
         </div>
         </article>-->
         
         <article class="clearfix m-b-10">
         <label for="cemail" class="control-label col-md-4 col-sm-4">Change Password:</label>
         <aside class="col-md-8 col-sm-8">
         <input type="password" name="users_password" id="users_password" class="form-control" placeholder="New Password" />
         <label class="error" style="display:none;" id="error-users_password"> please enter password and should be 6 character </label>
         </aside>
         </article>
         <article class="clearfix m-b-10">
         <label for="cemail" class="control-label col-md-4 col-sm-5">Confirm Password:</label>
         <aside class="col-md-8 col-sm-8">
         <input type="password" name="cnfPassword" class="form-control" placeholder="Confirm Password" id="cnfPassword" />
         <!--<p><a class="m-t-10" href="javascript:void(0)" onclick="updatePassword()">Edit</a></p> -->
         <label class="error" style="display:none;" id="error-cnfPassword"> Password and confirm password should be same </label>                    
         </aside>
         </article>
         <article class="clearfix ">
         <div class="col-md-12 m-t-20 m-b-20">
         <input type="button" name="submit" class="btn btn-success waves-effect waves-light pull-right" value="Update" onclick="updateAccount()">
         </div>
         </article>
         </aside>
         </form>    
         </section>
         <!-- Account Ends -->
   </article>
   <?php } ?>
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
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Detail</h4>
         </div>
         <div class="modal-body">
            <div class="messageUpdateIns"></div>
            <input type='hidden' name="quotationDetailTestsIns_id" id="quotationDetailTestsIns_id" />
            <label>Instruction</label>
            <textarea rows="6" cols="10" type="text" class="form-control" name="quotationDetailTests_instruction_name" id="quotationDetailTests_instruction_name"></textarea>
         </div>
         <div class="modal-footer p-t-10">
            <button type="button" class="btn btn-appointment" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" onClick="updateDiagnosticTest()">Update</button>
         </div>
      </div>
   </div>
</div>
<!-- end modal -->
<!--Change Logo-->
<div id="changeBg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button class="close" data-dismiss="modal" type="button">×</button>
            <h3>Change Background</h3>
         </div>
         <div class="modal-body">
            <div class="modal-body">
               <div id="messageErrors"></div>
               <form class="form-horizontal" id="uploadimage" action="" method="post" enctype="multipart/form-data">
                  <div id="image_preview"> <img id="previewing" src="<?php echo base_url(); ?>assets/default-images/Diagnostic_Centre.png" class="img-responsive center-block" /></div>
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
    /* ============================================================
GLOBAL
============================================================ */
    .effects {
        padding-left: 15px;
    }
    .effects .img {
        position: relative;
        float: left;
        margin-bottom: 5px;
        /*  width: 25%;*/
        overflow: hidden;
    }
    .effects .img:nth-child(n) {
        margin-right: 5px;
    }
    .effects .img:first-child {
        margin-left: -15px;
    }
    .effects .img:last-child {
        margin-right: 0;
    }
    .effects .img img {
        display: block;
        margin: 0;
        padding: 0;
        max-width: 100%;
        height: auto;
    }

    .overlay1 {
        display: block;
        position: absolute;
        z-index: 20;
        background: rgba(0, 0, 0, 0.8);
        overflow: hidden;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
        -o-transition: all 0.5s;
        transition: all 0.5s;
    }

    a.close-overlay {
        display: block;
        position: absolute;
        top: 0;
        right: 0;
        z-index: 100;
        width: 45px;
        height: 45px;
        font-size: 20px;
        font-weight: 700;
        color: #fff;
        line-height: 45px;
        text-align: center;
        background-color: #000;
        cursor: pointer;
    }
    a.close-overlay.hidden {
        display: none;
    }

    a.expand {
        display: block;
        position: absolute;
        z-index: 100;
        width: 50px;
        height: 50px;
        border: solid 5px #fff;
        text-align: center;
        color: #fff;
        line-height: 35px;
        font-weight: 700;
        font-size: 20px;
        -webkit-border-radius: 25px;
        -moz-border-radius: 25px;
        -ms-border-radius: 25px;
        -o-border-radius: 25px;
        border-radius: 25px;
    }
    .overlay1 a i
    {
        margin-top: 9px;
    }
    /* ============================================================
      EFFECT 1 - SLIDE IN BOTTOM
    ============================================================ */
    .effect-1 .overlay1 {
        bottom: 0;
        left: 0;
        right: 0;
        width: 100%;
        height: 0;
    }
    .effect-1 .overlay1 a.expand {
        left: 0;
        right: 0;
        bottom: 52%;
        margin: 0 auto -30px auto;
    }
    .effect-1 .img.hover .overlay1 {
        height: 100%;
    }
</style>
<!-- /Change Logo -->
<!-- END wrapper -->