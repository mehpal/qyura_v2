<style>
    .tab-content {
    box-shadow: none !important;
    color: #777;
}
    
</style>
<body class="fixed-left">
    <!-- Start right Content here -->
        <div class="content-page" ng-app="myApp">
            <!-- Start content -->
            <div class="content">
                <div class="container row">
                    <div class="clearfix">
                         <!--<div class="col-md-12 text-success">
                            <?php // echo $this->session->flashdata('message'); ?>
                         </div> -->
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Hospital Detail</h3>
                            <a href="<?php echo site_url('hospital');?>" class="btn btn-appointment btn-back waves-effect waves-light pull-right"><i class="fa fa-angle-left"></i> Back</a>
                               
                        </div>
                    </div>

                    <!-- Left Section Start -->
                    <section class="col-md-12 detailbox m-t-10">


                        <div class="bg-white">
                            <!-- Table Section Start -->

                            <section class="col-md-12">

                                <aside class="clearfix m-bg-pic">


                                    <div class="bg-picture text-center" style="background-image:url('<?php if(isset($hospitalData[0]->hospital_background_img) && !empty($hospitalData[0]->hospital_background_img)): echo base_url().'assets/hospitalsImages/'.$hospitalData[0]->hospital_background_img; else : echo base_url().'assets/default-images/Hospital.png'; endif;?>')">
                                        
                                        <div class="bg-picture-overlay"></div>
                                        <div class="profile-info-name">
                                            <div class='pro-img'>
                                                <!-- image -->
                                                <?php if(!empty($hospitalData[0]->hospital_img)){
                                                    ?>
                                               <img src="<?php echo base_url()?>assets/hospitalsImages/thumb/thumb_100/<?php echo $hospitalData[0]->hospital_img; ?>" alt="" class="logo-img" />
                                               <?php } else { ?>
                                                 <img src="<?php echo base_url()?>assets/default-images/Hospital-logo.png" alt="" class="logo-img" />
                                               <?php } ?>
                                                   <article class="logo-up avatar-view" style="display:none">
                                                        <?php if(!empty($hospitalData[0]->hospital_img)){
                                                    ?>
                                               <img src="<?php echo base_url()?>assets/hospitalsImages/thumb/thumb_100/<?php echo $hospitalData[0]->hospital_img; ?>" alt="" class="logo-img" />
                                               <?php } else { ?>
                                                 <img src="<?php echo base_url()?>assets/default-images/Hospital-logo.png" alt="" class="logo-img" />
                                               <?php } ?>
                                                    <div class="fileUpload btn btn-sm btn-upload logo-Upload">
                                                        <span><i class="fa fa-cloud-upload fa-3x "></i></span>
<!--                                                        <input id="uploadBtn" type="file" class="upload" />-->
                                                         <input type="hidden" style="display:none;" class="no-display" id="file_action_url" name="file_action_url" value="<?php echo site_url('hospital/editUploadImage');?>">
                                                         <input type="hidden" style="display:none;" class="no-display" id="load_url" name="load_url" value="<?php echo site_url('hospital/getUpdateAvtar/'.$this->uri->segment(3));?>">
                                                    </div>
                                                </article>
                                                <!-- description div -->
                                                
                                                <div class='pic-edit'>
                                                    <h3><a id="picEdit" class="pull-center cl-white" title="Edit Logo"><i class="fa fa-pencil"></i></a></h3>
                                                    <h3><a id="picEditClose" class="pull-center cl-white" title="Cancel"  style="display:none;"><i class="fa fa-times"></i></a></h3>
                                                </div>
                                                <!-- end description div -->
                                            </div>

                                            <h3 class="text-white"> <?php echo $hospitalData[0]->hospital_name;?> </h3>
                                            <h4> <?php if(isset($hospitalData[0]->hospital_address)){ echo $hospitalData[0]->hospital_address; }?> </h4>

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
                                        <li class="<?php if(isset($active) && $active == 'general'){echo "active";}?>">
                                            <a data-toggle="tab" href="#general">General Details</a>
                                        </li>
                                        
                                        <li class="<?php if(isset($active) && $active == 'diag'){echo "active";}?>">
                                            <a data-toggle="tab" href="#diagnostic">Diagnostics</a>
                                        </li>
                                        <li class="<?php if(isset($active) && $active == 'specialities'){echo "active";}?>">
                                            <a data-toggle="tab" href="#specialities">Specialities</a>
                                        </li>
                                       <!-- <li class="<?php // if(isset($active) && $active == 'gallery'){echo "active";}?>">
                                            <a data-toggle="tab" href="#gallery">Gallery</a>
                                        </li>-->
                                        <li class="<?php if(isset($active) && $active == 'timeslot'){echo "active";}?>">
                                            <a data-toggle="tab" href="#timeslot">Time Slot</a>
                                        </li>
                                       <li class="<?php if(isset($active) && $active == 'doctor'){echo "active";}?>">
                                            <a data-toggle="tab" href="#doctor">All Doctors</a>
                                        </li>
                                        
                                        <li class="<?php if(isset($active) && $active == 'account'){echo "active";}?>">
                                            <a data-toggle="tab" href="#account">Account</a>
                                        </li>

                                    </ul>
                                </article>

                                <article class="tab-content p-b-20 m-t-50">

                                    <!-- General Detail Starts -->
                                     <div class="map_canvas"></div>
                                    
                                    <section class="tab-pane fade in <?php if(isset($active) && $active == 'general'){echo "active";}?>" id="general">

                                        <article class="detailbox">
                                            <div class="mi-form-section">

                                                <!-- Table Section End -->
                                                <aside class="clearfix m-t-20 setting">
                                                    <div class="col-md-6">
                                                        <h4>Hospital Details 
                                                         <a href="javascript:void(0)" id="edit" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                                                        </h4>
                                                        <hr/>
                                                        <aside id="detail" style="display: <?php echo $detailShow;?>;">
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Hospital Name :</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"> <?php echo $hospitalData[0]->hospital_name;?> </p>
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Hospital Type :</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left">
                                                                    <?php if($hospitalData[0]->hosTypeId != ''){ echo $hospitalData[0]->hosType; }?>
                                                                </p>
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Address :</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"><?php if(isset($hospitalData[0]->hospital_address)){ echo $hospitalData[0]->hospital_address; }?> </p>
                                                            </article>

                                                            <article class="clearfix m-b-10 ">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                <aside class="col-md-8 col-sm-8 text-right t-xs-left">
                                                                    <?php 
                                                                    $explode= explode('|',$hospitalData[0]->hospital_phn); 
                                                                    for($i= 0; $i< count($explode);$i++){?>
                                                                    <p>+<?php echo $explode[$i];?></p>
                                                                   
                                                                    <?php }?>
                                                                    
                                                                </aside>
                                                            </article>
                                                            
                                                            <!-- <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Mobile Number :</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"><?php // if(isset($hospitalData[0]->hospital_mbl) && $hospitalData[0]->hospital_mbl != 0){ echo $hospitalData[0]->hospital_mbl; }?> </p>
                                                            </article> -->
                                                           
                                                          
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">24x7 Emergency :</label>
                                                                <?php if($hospitalData[0]->availibility_24_7 == 1){?>
                                                                <p class="col-md-8 col-sm-8 t-xs-left">Available</p>
                                                                <?php } else {?>
                                                                <p class="col-md-8 col-sm-8 t-xs-left">Not Available</p>
                                                                 <?php }?>
                                                            </article>
                                                            
                                                             <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Emergency Ward :</label>
                                                                <?php if($hospitalData[0]->isEmergency == 1){?>
                                                                <p class="col-md-8 col-sm-8 t-xs-left">Available</p>
                                                                <?php } else {?>
                                                                <p class="col-md-8 col-sm-8 t-xs-left">Not Available</p>
                                                                 <?php }?>
                                                            </article>
                                                            
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Pharmacy :</label>
                                                                <?php if($hospitalData[0]->hasPharmacy == 1){?>
                                                                <p class="col-md-8 col-sm-8 t-xs-left">Available</p>
                                                                <?php } else {?>
                                                                <p class="col-md-8 col-sm-8 t-xs-left">Not Available</p>
                                                                 <?php }?>
                                                            </article>
                                                           
                                                            
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person:</label>
                                                                <p class="col-md-8  col-sm-8 text-right t-xs-left"> <?php if(isset($hospitalData[0]->hospital_cntPrsn)){ echo $hospitalData[0]->hospital_cntPrsn; }?> </p>
                                                            </article>
                                                            
                                                             <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Designation:</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"><?php if(isset($hospitalData[0]->hospital_dsgn)){ echo $hospitalData[0]->hospital_dsgn; }?></p>
                                                            </article> 
                                                            
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Docat Id:</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"><?php if(isset($hospitalData[0]->docatId)){ echo $hospitalData[0]->docatId; }?></p>
                                                            </article> 
                                                            
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">About Us :</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"><?php if(isset($hospitalData[0]->hospital_aboutUs)){ echo $hospitalData[0]->hospital_aboutUs; }?></p>
                                                            </article>
                                                            
                                                            <?php if(!empty($hospitalData[0]->bloodBank_phn)){ ?>
                                                             <aside class="clearfix m-t-20 setting">
                                                            <h4>Blood Bank Detail
                                                            
                                                              </h4>
                                                            <hr/>
                                                            <section id="detailbbk">
                                                                <article class="clearfix m-b-10">
                                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Name :</label>
                                                                    <p class="col-md-8 col-sm-8 t-xs-left"><?php echo $hospitalData[0]->bloodBank_name;?></p>
                                                                </article>

                                                                <article class="clearfix m-b-10 ">
                                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                    <aside class="col-md-8 col-sm-8 t-xs-left">
                                                                         <?php 
                                                                    $bloodBank_explode= explode('|',$hospitalData[0]->bloodBank_phn); 
                                                                    for($i= 0; $i< count($bloodBank_explode);$i++){?>
                                                                    <p>+<?php echo $bloodBank_explode[$i];?></p>
                                                                   
                                                                    <?php }?>
                                                                    </aside>
                                                                </article>
                                                            </section>
                                                         
                                                        </aside>
                                                            <?php } 
                                                             if(!empty($hospitalData[0]->pharmacy_phn)){ ?>
                                                        <aside class="clearfix m-t-20 setting">
                                                            <h4>Pharmacy Detail
                                                           
                                                              </h4>
                                                            <hr/>
                                                            <section id="detailpharma">
                                                                <article class="clearfix m-b-10">
                                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Name :</label>
                                                                    <p class="col-md-8 col-sm-8 t-xs-left"><?php echo $hospitalData[0]->pharmacy_name;?></p>
                                                                </article>

                                                                <article class="clearfix m-b-10 ">
                                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                    <aside class="col-md-8 col-sm-8 t-xs-left">
                                                                         <?php 
                                                                    $pharmacy_explode= explode('|',$hospitalData[0]->pharmacy_phn); 
                                                                    for($i= 0; $i< count($pharmacy_explode);$i++){?>
                                                                    <p>+<?php echo $pharmacy_explode[$i];?></p>
                                                                   
                                                                    <?php }?>
                                                                    </aside>
                                                                </article>
                                                            </section>
                                                            
                                                        </aside>
                                                             <?php } if(!empty($hospitalData[0]->ambulance_phn)){ ?>
                                                            
                                                            <aside class="clearfix m-t-20 setting">
                                                            <h4>Ambulance Detail
                                                           
                                                              </h4>
                                                            <hr/>
                                                            <section id="detailpharma">
                                                                <article class="clearfix m-b-10">
                                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Name :</label>
                                                                    <p class="col-md-8 col-sm-8 t-xs-left"><?php echo $hospitalData[0]->ambulance_name;?></p>
                                                                </article>

                                                                <article class="clearfix m-b-10 ">
                                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                    <aside class="col-md-8 col-sm-8 t-xs-left">
                                                                         <?php 
                                                                    $ambulance_explode= explode('|',$hospitalData[0]->ambulance_phn); 
                                                                    for($i= 0; $i< count($ambulance_explode);$i++){?>
                                                                    <p>+<?php echo $ambulance_explode[$i];?></p>
                                                                   
                                                                    <?php }?>
                                                                    </aside>
                                                                </article>
                                                                
                                                                <article class="clearfix m-b-10">
                                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Doctor On Board :</label>
                                                                    <?php if($hospitalData[0]->docOnBoard == 1){?>
                                                                    <p class="col-md-8 col-sm-8 t-xs-left">Available</p>
                                                                    <?php } else {?>
                                                                    <p class="col-md-8 col-sm-8 t-xs-left">Not Available</p>
                                                                     <?php }?>
                                                                </article>
                                                                
                                                            </section>
                                                            
                                                        </aside>
                                                             <?php } ?>   
                                                        </aside>
                                                        
                                                        <!--edit-->
                                                         <form name="hospitalDetail" action="<?php echo site_url("hospital/saveDetailHospital/$hospitalId"); ?>" id="hospitalDetail" method="post">
                                                         <input type="hidden" id="StateId" name="StateId" value="<?php echo $hospitalData[0]->hospital_stateId;?>" />
                                                          <input type="hidden" id="countryId" name="countryId" value="<?php echo $hospitalData[0]->hospital_countryId;?>" />
                                                          <input type="hidden" id="cityId" name="cityId" value="<?php echo $hospitalData[0]->hospital_cityId;?>" />
                                                        <aside id="newDetail" style="display:<?php echo $showStatus;?>;">
                                                            <article class="clearfix m-t-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Hospital Name :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <input class="form-control" id="hospital_name" name="hospital_name" type="text" value="<?php echo $hospitalData[0]->hospital_name;?>">
                                                                    <label class="error" style="display:none;" id="error-hospital_name"> please enter hospital name</label>
                                                                    <label class="error" > <?php echo form_error("hospital_name"); ?></label>
                                                                </div>
                                                            </article>
                                                            
                                                            <article class="clearfix">
                                                                <label for="cname" class="control-label col-md-4  col-sm-4">Hospital Type :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <select class="form-control select2" data-width="100%" name="hospital_type" id="hospital_type" tabindex="-98">
                                                                        <?php if(!empty($hospitalType)){ foreach($hospitalType as $key=>$val) {
                                                                                $selected = '';
                                                                                if(isset($hospitalData[0]->hospital_type) && $hospitalData[0]->hospital_type == $val->hospitalType_id){ $selected = 'selected = "selected" ';  }
                                                                                echo  '<option '.$selected.' value="'.$val->hospitalType_id.'">'.$val->hospitalType_name.'</option>';
                                                                            } } ?>
                                                                    </select>
                                                                </div>
                                                            </article>
                                                         
                                                            <article class="clearfix m-t-10">
                                                            <label for="cemail" class="control-label col-md-4 col-sm-4">Address :</label>
                                                            <div class="col-md-8 col-sm-8">
                                                                         <select class="form-control select2" data-width="100%" name="hospital_countryId" onchange ="fetchState(this.value)">
                                                                             <option value="" >Select Country</option>
                                                                             <?php if(!empty($allCountry)):
                                                                                    foreach($allCountry as $country):?>
                                                                                
                                                                                    <option value="<?php echo $country->country_id;?>" <?php if($hospitalData[0]->hospital_countryId == $country->country_id):echo"selected";endif;?>><?php echo $country->country;?></option>
                                                                             <?php endforeach;endif;?>
                                                                         </select>
                                                                         <label class="error" style="display:none;" id="error-hospital_countryId"> please select a country</label>
                                                                         <label class="error" > <?php echo form_error("hospital_countryId"); ?></label>
                                                                   </div>
                                                              </article>
                                                            <article class="clearfix">
                                                            	<div class="col-sm-offset-4 col-sm-8">
                                                                           <?php // print_r($allStates); ?>
                                                                            <select class="form-control select2" data-width="100%" name="hospital_stateId" onchange ="fetchCity(this.value)" id="hospital_stateId">
                                                                                <?php foreach($allStates as $key=>$val) {?>
                                                                                  <option <?php if($hospitalData[0]->hospital_stateId == $val->state_id):echo"selected";endif;?> value="<?php echo $val->state_id;?>"><?php echo $val->state_statename;?></option>
                                                                                 <?php }?>
                                                                              
                                                                                
                                                                             </select>
                                                                         
                                                                         <label class="error" style="display:none;" id="error-hospital_stateId"> please select a state</label>
                                                                         <label class="error" > <?php echo form_error("hospital_stateId"); ?></label>
                                                            	</div>
                                                            </article>
                                                            <article class="clearfix">
                                                            	<div class="col-sm-offset-4 col-sm-8">
                                                                <select class="form-control select2" data-width="100%" name="hospital_cityId" id="hospital_cityId">
                                                                              <?php foreach($allCities as $key=>$val) {?>
                                                                                <option <?php if($hospitalData[0]->hospital_cityId == $val->city_id):echo"selected";endif;?> value="<?php echo $val->city_id;?>"><?php echo $val->city_name;?></option>
                                                                              <?php }?>

                                                                            </select>
                                                                      <label class="error" style="display:none;" id="error-hospital_cityId"> please select a city</label>
                                                                       <label class="error" > <?php echo form_error("hospital_cityId"); ?></label>
                                                                </div>
                                                             </article>
                                                                
                                                                <article class="clearfix">
                                                         <div class="col-sm-offset-4 col-sm-8">
                                                                        <input type="text" class="form-control" id="hospital_zip" name="hospital_zip" placeholder="" maxlength="6" onkeypress="return isNumberKey(event)" value="<?php if(isset($hospitalData[0]->hospital_zip)){ echo $hospitalData[0]->hospital_zip; }?>">
                                                                             <label class="error" style="display:none;" id="error-hospital_zip"> Zip code should be numeric and 6 digit long</label>

                                                                            <label class="error" id="error-hospital_zip"  > <?php echo form_error("hospital_zip"); ?></label>
                                                                     </div>
                                                                </article>
                                                               
                                                                
                                                                
                                                          <!-- <article class="clearfix">
                                                                <label class="control-label col-md-4" for="cname">Manual:</label>
                                                                <div class="col-md-8">
                                                                    <aside class="radio radio-info radio-inline">
                                                                        <input type="radio" <?php // if(!empty($hospitalData) &&   $hospitalData[0]->isManual == 1 ){ echo 'checked="checked" '; }?>  name="isManual" value="1" id="isManual" onclick="IsAdrManual(this.value)">
                                                                        <label for="inlineRadio1"> Yes</label>
                                                                    </aside>
                                                                    <aside class="radio radio-info radio-inline">
                                                                        <input type="radio" <?php // if(!empty($hospitalData) &&   $hospitalData[0]->isManual == 0 ){ echo 'checked="checked" '; }?> name="isManual" value="0" id="isManual" onclick="IsAdrManual(this.value)">
                                                                        <label for="inlineRadio2"> No</label>
                                                                    </aside>
                                                                </div>
                                                            </article> -->
                                                          
                                                          <input  type="hidden" name="isManual" value="1" id="isManual">
                                                            
                                                            
                                                            <article class="clearfix m-t-10">
                                                              <div class="col-sm-8 col-sm-offset-4">
  <input class="form-control geocomplete" id="geocomplete1" name="hospital_address" type="text" value="<?php if(isset($hospitalData[0]->hospital_address)){ echo $hospitalData[0]->hospital_address; }?>" >
                                                                   <label class="error" style="display:none;" id="error-geocomplete"> please enter an address</label>


                                                               </div>
                                                            </article>
                                                                
                                                            <article class="clearfix m-t-10">
                                                              <div class="col-sm-8 col-sm-offset-4">
                                                                <aside class="row">
                                                                    
                                                                  <div class="col-sm-6">
                                                                   <input class="form-control" name="lat" type="text"   <?php if(!empty($hospitalData) &&   $hospitalData[0]->isManual == 0 ){ echo 'readonly="readonly" '; }?> id="lat" value="<?php echo $hospitalData[0]->hospital_lat;?>"  placeholder="Latitude" onkeypress="return isNumberKey(event)"  />
                                                                 <label class="error" > <?php echo form_error("lat"); ?></label>
                                                                 <label class="error" style="display:none;" id="error-lat">Please enter the correct format for latitude</label>
                                                                 </div>
                                                                    
                                                                 <div class="col-sm-6">
                                                                <input class="form-control" name="lng" type="text" <?php if(!empty($hospitalData) &&   $hospitalData[0]->isManual == 0 ){ echo 'readonly="readonly" '; }?>  id="lng" value="<?php echo $hospitalData[0]->hospital_long;?>" placeholder="Longitude" onkeypress="return isNumberKey(event)" />
                                                                 <label class="error" > <?php echo form_error("lng"); ?></label>
                                                                 <label class="error" style="display:none;" id="error-lng"> Please enter the correct format for longitude</label>
<label class="error" > <?php echo form_error("hospital_address"); ?></label>
                                                                </div>
                                                                    
                                                              </aside>
                                                           </div>
                                                         </article>
                                                        

                                                            <article class="clearfix m-t-10 ">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                  
                                                                    
                                                                    <div id="multuple_phone_load">
                                                                        
                                                                   
                                                                    <aside class="row cllone">
                                                                      
                                                                        
                                                                        <div class="col-xs-10 m-t-xs-10">
                                                                            <input type="text" class="form-control" name="hospital_phn" onkeypress="return isNumberKey(event)" id="hospital_phn" value="<?php if(isset($hospitalData[0]->hospital_phn) && $hospitalData[0]->hospital_phn != ''  ){ echo $hospitalData[0]->hospital_phn; } ?>" maxlength="10" minlength="10" pattern=".{10,10}"/>
                                                                             <label class="error" > <?php  echo form_error("hospital_phn"); ?></label>
                                                                        </div>
                                                                       
                                                                    </aside>
                                                                        
                                                                    
                                                                    </div>
                                                                    
                                                                    
                                                                    
                                                               
                                                                   <p class="m-t-0">* The number above is going to be your primary number.</p>
                                                                </div>
                                                            </article>
                                                            
                                                             <!--<article class="clearfix m-t-10">
                                                                    <label class="control-label col-md-4 col-sm-4" for="cname">Mobile no. :</label>
                                                                    <div class="col-md-8 col-sm-8">
                                                                        <input type="text" onkeypress="return isNumberKey(event)" maxlength="10" placeholder="" name="hospital_mbl" id="hospital_mbl" class="form-control" value="<?php // if(isset($hospitalData[0]->hospital_mbl) && $hospitalData[0]->hospital_mbl != 0){ echo $hospitalData[0]->hospital_mbl; } ?>">

                                                                       <label id="error-hospital_mbl" style="display:none;" class="error">please enter digits only!</label>
                                                                       <label class="error" > <?php // echo form_error("hospital_mbl"); ?></label>
                                                                       <label class="error"> </label>

                                                                    </div>
                                                                </article> -->
                                                            
                                                            <article class="clearfix m-t-10">
                                                                <label class="control-label col-md-4 col-sm-4" for="cname">About Us :</label>
                                                                <div class="col-md-8  col-sm-8">
                                                                    <textarea id="hospital_aboutUs" name="hospital_aboutUs" class="form-control"><?php echo $hospitalData[0]->hospital_aboutUs;  ?></textarea>
                                                                    <label class="error" > <?php echo form_error("hospital_aboutUs"); ?></label>
                                                                    <label id="error-hospital_aboutUs" style="display:none;" class="error"> Please write about the hospital!</label>

                                                                </div>
                                                            </article>

                                                            <article class="clearfix">
                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-9" for="cname">Blood bank  </label>
                                                                        <div class="col-md-8 col-xs-3">
                                                                            <aside class="checkbox checkbox-success m-t-5">
                                                                                <input type="checkbox" id="bloodbankbtn" name="bloodbank_chk" value="1">
                                                                                <label>

                                                                                </label>
                                                                            </aside>
                                                                        </div>
                                                                    </article>
                                                                    
                                                                    <section id="bloodbankdetail" style="display:none">
                                                                
                                                                        <article class="clearfix m-b-10">
                                                                       <label for="cemail" class="control-label col-md-4 col-sm-4">Name :</label>
                                                                       <div class="col-md-8 col-sm-8">
                                                                           <input class="form-control" name="bloodBank_name" id="bloodBank_name" type="text" value="<?php if(isset($hospitalData[0]->bloodBank_name)){ echo $hospitalData[0]->bloodBank_name; } ?>">
                                                                            <label class="error" style="display:none;" id="error-bloodBank_name"> please Check your Blood Bank name</label>
                                                                           <div>
                                                                   </article>
                                                                       <article class="clearfix m-b-10 ">
                                                                       <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                       <div class="col-md-8 col-sm-8">
                                                                           <aside class="row">
                                                                              <!-- <div class="col-md-3 col-sm-3 col-xs-12">
                                                                                   <select class="selectpicker" data-width="100%" name="preblbankNo[]" id="preblbankNo<?php // echo ($i+1);?>">
                                                                                    <option value="91" <?php // if($more_bloodbank[0] == '91'){ echo 'selected';}?>>+91</option>
                                                                                   <!--<option value="1" <?php // if($more_bloodbank[0] == '1'){ echo 'selected';}?>>+1</option> 
                                                                                   </select>
                                                                               </div> -->
                                                                               
                                                                             <!--<div class="col-md-4 col-sm-4 col-xs-10 m-t-xs-10">
                                                                                <input type="text" onkeypress="return isNumberKey(event)" onblur="checkNumber('midNumber',1)" maxlength="5" value="<?php // if(isset($more_bloodbank[1]) && $more_bloodbank[1] != ''){ echo $more_bloodbank[1]; } ?>"  id="bloodMidNumber" name="bloodMidNumber[]" class="form-control" requird>
                                                                                <label class="error" > <?php// echo form_error("bloodMidNumber"); ?></label>
                                                                            </div> -->
                                                                               
                                                                               <div class="col-xs-10 m-t-xs-10">
                                                                                   <input type="teL" class="form-control" name="bloodBank_phn" id="bloodBank_phn" value ="<?php if(isset($hospitalData[0]->bloodBank_phn) && $hospitalData[0]->bloodBank_phn != ''){ echo $hospitalData[0]->bloodBank_phn; } ?>" onkeypress="return isNumberKey(event)" maxlength="10" minlength="10" pattern=".{10,10}" />
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
                                                                                <input type="checkbox" id="pharmacybtn" name="pharmacy_chk" value="1" <?php if($hospitalData[0]->hasPharmacy == 1){ echo "checked";}?>>
                                                                                <label>

                                                                                </label>
                                                                            </aside>
                                                                        </div>
                                                          </article>
                                                                     
                                                       <!--   <section id="pharmacydetail" style="display:none">
                                                                
                                                                 <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Name :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <input class="form-control" id="pharmacy_name" name="pharmacy_name" type="text" value="<?php // if(isset($hospitalData[0]->pharmacy_name)){ echo $hospitalData[0]->pharmacy_name; } ?>" >
                                                                    <label class="error" style="display:none;" id="error-pharmacy_name"> please Check your Pharmacy Name</label>
                                                                    <div>
                                                            </article>
                                                                 
                                                                <article class="clearfix m-b-10 ">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <?php 
                                                                  /*  if($hospitalData[0]->pharmacy_phn != ''){
                                                                    $explodesPharmacy= explode('|',$hospitalData[0]->pharmacy_phn); 
                                                                    for($i= 0; $i< count($explodesPharmacy);$i++){
                                                                    $morePharmacy = explode(' ',$explodesPharmacy[$i]); */ ?>
                                                                    <aside class="row">
                                                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                                                            <select class="selectpicker" data-width="100%" name="prePharmacy[]" id="prePharmacy<?php // echo ($i+1);?>">
                                                                                <option value="91" <?php // if($morePharmacy[0] == '91'){ echo 'selected';}?>>+91</option>
                                                                               <!-- <option value="1" <?php // if($morePharmacy[0] == '1'){ echo 'selected';}?>>+1</option> 
                                                                            </select>
                                                                        </div>
                                                                        
                                                                          <div class="col-md-4 col-sm-4 col-xs-10 m-t-xs-10">
                                                                            <input type="text" onkeypress="return isNumberKey(event)" onblur="checkNumber('midNumber',1)" maxlength="5" value="<?php // if(isset($morePharmacy[1]) && $morePharmacy[1] != ''){ echo $morePharmacy[1]; } ?>"  id="pharmacyMidNumber" name="pharmacyMidNumber[]" class="form-control" requird>
                                                                                <label class="error" > <?php // echo form_error("pharmacyMidNumber"); ?></label>
                                                                            </div>
                                                                        
                                                                        <div class="col-md-5 col-sm-4 col-xs-10 m-t-xs-10">
                                                                            <input type="teL" class="form-control" name="pharmacy_phn[]" id="pharmacy_phn<?php // echo ($i+1);?>" value ="<?php // if(isset($morePharmacy[2]) && $morePharmacy[2] != ''){ echo $morePharmacy[2]; } ?>" onkeypress="return isNumberKey(event)" maxlength="8" />
                                                                        </div>

                                                                    </aside>
                                                                    <?php // $morePharmacy = '';} } else { ?>
                                                                    <aside class="row">
                                                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                                                            <select class="selectpicker" data-width="100%" name="prePharmacy[]" id="prePharmacy1">
                                                                                <option value="91">+91</option>
                                                                               <option value="1">+1</option>
                                                                            </select>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-4 col-sm-4 col-xs-10 m-t-xs-10">
                                                                                <input type="text" onkeypress="return isNumberKey(event)" onblur="checkNumber('midNumber',1)" maxlength="5"  id="pharmacyMidNumber" name="pharmacyMidNumber[]" class="form-control" requird>
                                                                                <label class="error" > <?php // echo form_error("pharmacyMidNumber"); ?></label>
                                                                            </div>
                                                                        
                                                                        
                                                                        <div class="col-md-5 col-sm-4 col-xs-10 m-t-xs-10">
                                                                            <input type="teL" class="form-control" name="pharmacy_phn[]" id="pharmacy_phn1" onkeypress="return isNumberKey(event)" maxlength="8" />
                                                                        </div>

                                                                    </aside>
                                                                    <?php // } ?>
                                                                    <label class="error" style="display:none;" id="error-pharmacy_phn1"> please Check your Pharmacy Phone</label>
                                                                </div>
                                                            </article>
                                                           </section> -->
                                    
                                                          <article class="clearfix">
                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-9" for="cname">Ambulance</label>
                                                                        <div class="col-md-8 col-xs-3">
                                                                            <aside class="checkbox checkbox-success m-t-5">
                                                                                <input type="checkbox" id="ambulancebtn" name="ambulance_chk" value="1">
                                                                                <label>

                                                                                </label>
                                                                            </aside>
                                                                        </div>
                                                                    </article>
                                                                    
                                                                    <section id="ambulancedetail" style="display:none">
                                                                
                                                                        <article class="clearfix m-b-10">
                                                                       <label for="cemail" class="control-label col-md-4 col-sm-4">Name :</label>
                                                                       <div class="col-md-8 col-sm-8">
                                                                           <input class="form-control" name="ambulance_name" id="ambulance_name" type="text" value="<?php if(isset($hospitalData[0]->ambulance_name)){ echo $hospitalData[0]->ambulance_name; } ?>">
                                                                          <label class="error" style="display:none;" id="error-ambulance_name"> please Check your Ambulance Name</label>
                                                                           <div>
                                                                   </article>
                                                                       <article class="clearfix m-b-10 ">
                                                                       <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                       <div class="col-md-8 col-sm-8">
                                                                            <aside class="row">
                                                                               <!--<div class="col-md-3 col-sm-3 col-xs-12">
                                                                                   <select class="selectpicker" data-width="100%" name="preambuNo[]" id="preambuNo<?php // echo ($i+1);?>">
                                                                                    <option value="91" <?php // if($more_ambulance[0] == '91'){ echo 'selected';}?>>+91</option>
                                                                                    <option value="1" <?php // if($more_ambulance[0] == '1'){ echo 'selected';}?>>+1</option>
                                                                                   </select>
                                                                               </div> -->
                                                                               
                                                                               <!-- <div class="col-md-4 col-sm-4 col-xs-10 m-t-xs-10">
                                                                            <input type="text" onkeypress="return isNumberKey(event)" onblur="checkNumber('midNumber',1)" maxlength="5" value="<?php // if(isset($more_ambulance[1]) && $more_ambulance[1] != ''){ echo $more_ambulance[1]; } ?>"  id="ambulanceMidNumber" name="ambulanceMidNumber[]" class="form-control" requird>
                                                                                <label class="error" > <?php // echo form_error("ambulanceMidNumber"); ?></label>
                                                                            </div> -->
                                                                               
                                                                               <div class="col-xs-10 m-t-xs-10">
                                                                                   <input type="text" class="form-control" name="ambulance_phn" id="ambulance_phn" value ="<?php if(isset($hospitalData[0]->ambulance_phn) && $hospitalData[0]->ambulance_phn != ''){ echo $hospitalData[0]->ambulance_phn; } ?>" onkeypress="return isNumberKey(event)" onkeypress="return isNumberKey(event)" maxlength="10" minlength="10" pattern=".{10,10}" />
                                                                               </div>

                                                                           </aside>
                                                                           
                                                                           <label class="error" style="display:none;" id="error-ambulance_phn1"> please Check your Ambulance Phone</label>
                                                                       </div>
                                                                   </article>
                                                                        
                                                                    <article class="clearfix">
                                                                            <label class="control-label col-md-4 col-xs-9" for="cname">Doctor On board</label>
                                                                            <div class="col-md-8 col-xs-3">
                                                                                <aside class="checkbox checkbox-success m-t-5">
                                                                                    <input type="checkbox" id="docOnBoard" name="docOnBoard" value="1" <?php if($hospitalData[0]->docOnBoard == 1){ echo "checked";}?> >
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
                                                                                <input type="checkbox" id="isEmergency" name="isEmergency" value="1" <?php if($hospitalData[0]->isEmergency == 1){ echo "checked";}?> />
                                                                                <label>

                                                                                        </label>
                                                                                    </aside>
                                                                                </div>
                                                            </article>
                                                             
                                                              <article class="clearfix">
                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-9" for="cname">24*7 Availibility</label>
                                                                        <div class="col-md-8 col-xs-3">
                                                                            <aside class="checkbox checkbox-success m-t-5">
                                                                                <input type="checkbox" id="availibility_24_7" name="availibility_24_7" value="1" <?php if($hospitalData[0]->availibility_24_7 == 1){ echo "checked";}?> />
                                                                                <label>

                                                                                        </label>
                                                                                    </aside>
                                                                                </div>
                                                            </article>

                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person:</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                 
                                                                    <input class="form-control" id="hospital_cntPrsn" name="hospital_cntPrsn" type="text" value="<?php if(isset($hospitalData[0]->hospital_cntPrsn)){ echo $hospitalData[0]->hospital_cntPrsn; }?>">
                                                           <label class="error" > <?php echo form_error("hospital_cntPrsn"); ?></label>
                                                           <label class="error" style="display:none;" id="error-hospital_cntPrsn"> please enter the name of a contact person</label>
                                                           </div>    
                                                            </article>
                                                          <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Designation :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <input class="form-control" id="hospital_dsgn" name="hospital_dsgn" type="text" value="<?php if(isset($hospitalData[0]->hospital_dsgn)){ echo $hospitalData[0]->hospital_dsgn; }?>">
                                                                    <label class="error" > <?php echo form_error("hospital_dsgn"); ?></label>
                                                                    <label class="error" style="display:none;" id="error-hospital_dsgn"> please enter a designation</label>
                                                                    <div>
                                                            </article>
                                                             
                                                             
                                                             <article class="form-group m-lr-0 ">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Docat Id :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <input class="form-control" id="docatId" name="docatId" type="text" value="<?php if(isset($hospitalData[0]->docatId)){ echo $hospitalData[0]->docatId; }?>">
                                                                    <label class="error" > <?php echo form_error("docatId"); ?></label>
                                                                </div>
                                                            </article>

                                                           
                                                            <article class="clearfix m-b-10">

                                                              <div class="col-md-12">
                                                              <button type="submit" class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" onclick="return validationHospitalDetail();">Update</button>
                                                              </div>

                                                             </article>
                                                        </aside>
                                                             <fieldset>
                           
                                                                
                                                                <input name="user_tables_id" id="user_tables_id" type="hidden" value="<?php echo $hospitalData[0]->users_id;?>">
                                                            <?php if($hospitalData[0]->pharmacy_phn != '' OR $hospitalData[0]->pharmacy_name != ''){ ?>
                                                                <input name="pharmacy_status" id="pharmacy_status" type="hidden" value="<?php echo $hospitalData[0]->pharmacy_name;?>">
                                                            <?php } ?>
                                                               <?php if($hospitalData[0]->bloodBank_name != '' OR $hospitalData[0]->bloodBank_phn != ''){ ?>
                                                                <input name="bloodbank_status" id="bloodbank_status" type="hidden" value="<?php echo $hospitalData[0]->bloodBank_name;?>">
                                                            <?php } ?>  
                                                                <?php if($hospitalData[0]->ambulance_name != '' OR $hospitalData[0]->ambulance_phn != ''){ ?>
                                                                <input name="ambulance_status" id="ambulance_status" type="hidden" value="<?php echo $hospitalData[0]->ambulance_name;?>">
                                                            <?php } ?> 
                                                             </fieldset>  
                                                        </form>  
                                                        
                                                       
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
                                                                    <a class="delete-ins" href="javascript:void(0)" onclick="deletInsurance(<?php echo $val->hospitalInsurance_id;?>)"><i class="fa fa-close"></i></a>
                                                                    <img src="<?php echo base_url()?>assets/insurance/<?php echo $val->insurance_img;?>" class="img-responsive center-block img-ins">
                                                                    <h5><?php echo $val->insurance_Name;?></h5>
                                                                </div>
                                                                <?php }} else{?>
                                                                <div class="col-md-6 col-sm-6">
                                                                 
                                                                    <h5>Please select Insurance company</h5>
                                                                </div>
                                                                <?php }?>
                                                                <!--<div class="col-md-3 col-sm-6">
                                                                    <img src="<?php echo base_url()?>assets/insurance/hdfc.jpg" class="img-responsive center-block">
                                                                    <h5>HDFC ERGO</h5>
                                                                </div>
                                                                <div class="col-md-3 col-sm-6">
                                                                    <img src="<?php echo base_url()?>assets/insurance/icici.png" class="img-responsive center-block">
                                                                    <h5>ICICI</h5>
                                                                </div>
                                                                <div class="col-md-3 col-sm-6">
                                                                    <img src="<?php echo base_url()?>assets/insurance/hsbc.png" class="img-responsive center-block">
                                                                    <h5>HDFC ERGO</h5>
                                                                </div>-->
                                                            </section>
                                                            <section id="newcompany" style="display:none;">
                                                                <form name="insuranceForm" id="insuranceForm" action="<?php echo site_url("hospital/addInsurance/$hospitalId"); ?>" method="post">
                                                                    
                                                                        <input type="hidden" id="countPnone" name="countPnone" value="1" />
                                                                        <input type="hidden" id="countbloodBank_phn" name="countbloodBank_phn" value="1" />
                                                                        <input type="hidden" id="countPharmacy_phn" name="countPharmacy_phn" value="1" />
                                                                       <input type="hidden" id="countAmbulance_phn" name="countAmbulance_phn" value="1" />
                       
                                                                    <input type="hidden" name="hospitalInsuranceId" id="hospitalInsuranceId" value="<?php echo $hospitalId;?>" />
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
                                                    </div>
                                                                    
                                                      <div class="col-md-6 p-b-20">
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
                                                                        <label for="cname" class="control-label col-md-3 col-sm-4">Awards:</label>
                                                                        <div class="col-md-9 col-sm-8">
                                                                            <aside class="row">
                                                                                <div class="col-md-10 col-sm-10 col-xs-10">
                                                                                    <input type="text" class="form-control" name="hospitalAwards_awardsName" id="hospitalAwards_awardsName" placeholder="Award Name" />
                                                                                     
                                                                                     <label style="display: none;"class="error" id="error-awards"> Please enter award name </label>  
                                                                                     
<!--                                                                                     <input type="text" class="form-control" name="hospitalAwards_agencyName" id="hospitalAwards_agencyName" placeholder="Award Agency" />
                                                                                     <label style="display: none;"class="error" id="error-hospitalAwards_agencyName"> Please enter agency name </label>-->
                                                                                     
                                                                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                                                                          <select class="selectpicker" data-width="100%" id="hospitalAwards_agencyName" name="hospitalAwards_agencyName">
                                                                                              <option value="">Select Agency</option>
                                                                                               <?php if(!empty($awardAgency)){
                                                                                                    foreach($awardAgency as $key => $val){    
                                                                                                 ?>
                                                                                              <option value="<?php echo $val->awardAgency_id;  ?>"><?php echo $val->agency_name;  ?></option>
                                                                                               <?php }  } ?>
                                                                                            </select>
                                                                                           <label style="display: none;"class="error" id="error-hospitalAwards_agencyName"> Please enter agency name </label>
                                                                                     
                                                                                        </div>

                                                                                     <input type="text" class="form-control m-t-20" placeholder="Year" id="hospital_awardsyear" name="hospital_awardsyear" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="4" />
                                                                                    <label style="display: none;"class="error" id="error-years"> Please enter year only number formate minium and maximum length 4 </label>  
                                                                                    <label style="display: none;"class="error" id="error-years-valid">Award year should be greater then 1920 or less then <?php echo date('Y'); ?></label>
                                                                                </div>
                                                                                <div class="col-md-2 col-sm-2 col-xs-2">
                                                                                    <a onclick="addAwards()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus" title="Add Awards"></i></a>
                                                                                   
                                                                                </div>
                                                                                
                                                                                
                                                                               
                                                                            </aside>
                                                                            <div id="totalAwards">
                                                                               
                                                                            </div>

                                                                        </div>
                                                                    </aside>
                                                                </form>
                                                            </article>

                                                            <article class="clearfix">
                                                                <aside class="clearfix">
                                                                    <h4>Services
                                                      <a id="editservices" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                                                   </h4>
                                                                    <hr>
                                                                </aside>
                                                                <section id="detailservices">
                                                                    <ul class="ul-tick" id="loadServices">
                                                                       <!-- <li>Hemetology</li>
                                                                        <li>Microbiology Blood Bank</li>
                                                                        <li>Radiology</li>
                                                                        <li>Loren</li>
                                                                        <li>Loren Ipsum</li>
                                                                        <li>Hemetology</li>
                                                                        <li>Microbiology Blood Bank</li>
                                                                        <li>Radiology</li>
                                                                        <li>Loren</li>
                                                                        <li>Loren Ipsum</li> -->
                                                                    </ul>
                                                                </section>
                                                                <form>
                                                                    <aside class="form-group m-lr-0" id="newservices" style="display:none">
                                                                        <label for="cname" class="control-label col-md-3 col-sm-4">Services :</label>
                                                                        <div class="col-md-9 col-sm-8">
                                                                            <aside class="row">
                                                                                <div class="col-md-10 col-sm-10 col-xs-10">
                                                                                    <input type="text" class="form-control" name="hospitalServices_serviceName" id="hospitalServices_serviceName" placeholder="" />
                                                                                </div>
                                                                                <div class="col-md-2 col-sm-2 col-xs-2">
                                                                                    <a onclick="addServices()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus" title="Add Services"></i></a>
                                                                                </div>
                                                                                
                                                                                
                                                                               
                                                                            </aside>
                                                                            <div id="totalServices">
                                                                               
                                                                            </div>

                                                                        </div>
                                                                    </aside>
                                                                </form>
                                                            </article>
                                                        </div>               
                                                                    
                                                                    
                                                   
                                                </aside>
                                                
                                            </div>
                                        </article>
                                    </section>  
                                  
                                    <!--diagnostic Starts -->
                                     <section class="tab-pane fade in diagdetail <?php if(isset($active) && $active == 'diag'){echo "active";}?>" id="diagnostic">
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
                                            <ul id="list1">
                                           <!-- <li>Pet</li>
                                            <li>Mri</li> -->
                                            </ul>
                                            </div>
                                            </div>
                                            </aside>
                                            </section>
                                            <!-- first Section End -->
                                            <section class="col-md-2 detailbox m-b-20 text-center">
                                            <div class="m-t-150">
                                            <a onclick="addDiagnostic()" id="addDiagnosticB"><i class="fa fa-arrow-right s-add"></i></a>
                                            </div>
                                            <div class="m-t-50">
                                            <a onclick="revertDiagnostic()"> <i class="fa fa-arrow-left s-add"></i></a>
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
                                            <ul id="list">
                                            <!--<li>Pet</li>
                                            <li>Mri</li> -->
                                            </ul>
                                            </div>
                                            </div>
                                            </aside>
                                            </section>
                                            <!-- second Section End -->
                                            </aside>
                                            
                                            
                                           <!-- <section class="clearfix detailbox m-b-20">
                                            <div class="col-md-8" ng-app="myApp" ng-controller="diag-c-avail">
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
                                              <p class="p-5" id="detailInstruction"></p>
                                            <textarea id="detailsAll" style="width:100%; height:150px; display:none;" > </textarea>    
                                            
                                            <aside class="clearfix p-5">
                                                <input type="hidden" value="" id="instructionId" />
                                                <a onclick="changeInstruction()" class="btn btn-success waves-effect waves-light m-b-5 p-abs " data-toggle="modal" id="instructionEdit">Edit</a>
                                                <a style="display:none;" onclick="updateInstruction()" class="btn btn-success waves-effect waves-light m-b-5 p-abs " data-toggle="modal" id="instructionUpdate">Update</a>
                                               
                                            </aside>
                                            </article>
                                            </aside>
                                            </div>
                                            </section> -->
                                     </section>
                                    <!-- diagnostic Ends --> 
                                    
                                     <!--Specialities Starts -->
                                 <section class="tab-pane fade in <?php if(isset($active) && $active == 'specialities'){echo "active";}?>" id="specialities">
                                        
                               <article class="clearfix">
                                <label class="control-label col-md-4" for="cname">Speciality Name display format:</label>
                                <div class="col-md-8">
                                    <aside class="radio radio-info radio-inline">
                                        <input <?php  echo set_radio('specialityNameFormate', '1', TRUE); ?> type="radio"  name="specialityNameFormate" value="1" id="specialityNameFormate" onclick="setSpecialityNameFormate(this.value)" <?php if($hospitalData[0]->specialityNameFormate == 1){ echo "checked";}?> >
                                        <label for="inlineRadio1"> General Name</label>
                                    </aside>
                                    <aside class="radio radio-info radio-inline">
                                        <input <?php  echo set_radio('specialityNameFormate', '0'); ?> type="radio" name="specialityNameFormate" value="0" id="specialityNameFormate" onclick="setSpecialityNameFormate(this.value)" <?php if($hospitalData[0]->specialityNameFormate == 0){ echo "checked";}?>>
                                        <label for="inlineRadio2"> Scientific Name</label>
                                    </aside>
                                </div>
                            </article>
                                        
                  <aside class="clearfix">
                  <section class="col-md-5 detailbox m-b-20 diag" >
                  <aside class="bg-white">
                  <figure class="clearfix">
                  <h3>Specialities Categories Available</h3>
                  <article class="clearfix">
                  <div class="input-group m-b-5">
                  <span class="input-group-btn">
                  <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                  </span>
                  <input type="text" id="search-text2" placeholder="search" class="form-control">
                  </div>
                  </article>
                  </figure>
                  <div class="nicescroll mx-h-400">
                  <div class="clearfix diag-detail">
                  <ul id="list2">
                 <!-- <li>Pet</li>
                  <li>Mri</li> -->
                  </ul>
                  </div>
                  </div>
                  </aside>
                  </section>
                  <!-- first Section End -->
                  <section class="col-md-2 detailbox m-b-20 text-center">
                  <div class="m-t-150">
                  <a onclick="sendSpeciality()"><i class="fa fa-arrow-right s-add"></i></a>
                  </div>
                  <div class="m-t-50">
                  <a onclick ="revertSpeciality()"> <i class="fa fa-arrow-left s-add"></i></a>
                  </div>
                  </section>
                  <!-- second Section Start -->
                  <section class="col-md-5 detailbox m-b-20 diag">
                  <aside class="bg-white">
                  <figure class="clearfix">
                  <h3>Specialities Categories Added</h3>
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
                  <ul id="list3">
                 <!-- <li>Pet</li>
                  <li>Mri</li> -->
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
                                    <section class="tab-pane fade in <?php if(isset($active) && $active == 'gallery'){echo "active";}?>" id="gallery">
                                        <div class="fileUpload btn btn-sm btn-upload im-upload avatar-view-gallery">
                                            <img src="<?php echo base_url();?>assets/default-images/Hospital-logo.png" style="display:none;" />
                                            <span class="btn btn-appointment avatar-view-gallery">Add More</span>
                                           <!-- <input type="file" class="upload" id="uploadBtn"> -->
                                            
                                        </div>
                                         <input type="hidden" style="display:none;" class="no-display" id="file_action_url_gallery" name="file_action_url_gallery" value="<?php echo site_url('hospital/galleryUploadImage');?>">
                                          <input type="hidden" style="display:none;" class="no-display" id="load_url_gallery" name="load_url_gallery" value="<?php echo site_url('hospital/getGalleryImage/'.$this->uri->segment(3));?>">
                                          
                                       <div class="clearfix" id="display_gallery">

                                       <?php if(!empty($gallerys)){foreach($gallerys as $gallery){?>
                                       <aside class="col-md-3 col-sm-4 col-xs-6 show-image">
                                             <img width="210" class="thumbnail img-responsive" src="<?php echo base_url()?>/assets/hospitalsImages/thumb/original/<?php echo $gallery->hospitalImages_ImagesName ?>">
                                             <a class="delete" onClick="deleteGalleryImage(<?php echo $gallery->hospitalImages_id ?>)"> <i class="fa fa-times fa-2x"></i></a>
                                         </aside>
                                         <?php }}?>
                                     </div>
                                        
                                    </section>
                                    <!--Gallery Ends -->
                                    
                                    <!-- Timeslot start -->
                                      <!-- Timeslot Starts Section -->
                                  <section class="tab-pane fade in <?php if(isset($active) && $active == 'timeSlot'){echo "active";}?>" id="timeslot">
                                        <?php if(isset($timeSlot) && !empty($timeSlot)):?>
                         
                    <form method="post" name="timeSlotForm" id="timeSlotForm" action="<?php echo site_url('hospital/updateTimeSlot');?>">
                        
                        <input type="hidden" name="mi_user_id" value="<?php if(isset($hospitalData[0]->hospital_usersId)){ echo $hospitalData[0]->hospital_usersId; }?>" id="mi_user_id" />
                        
                         <input type="hidden" name="mi_id" value="<?php if(isset($hospitalData[0]->hospital_id)){ echo $hospitalData[0]->hospital_id; }?>" />
                         
                          <input type="hidden" name="redirectControllerMethod" value="hospital/detailHospital" />
                        
                        <?php echo $this->load->view('common_pages/edit_time_slot_view');?>
                        
                        <article class="clearfix m-t-10">
                            <div class="col-md-12">
                              <button class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" type="submit" onclick="return timeSlotCheck()">Update</button>
                            </div>
                            </article>
                    </form>
                    <?php else: ?>
                        
                       <form method="post" name="timeSlotForm" id="timeSlotForm" action="<?php echo site_url('hospital/setTimeSlotMi');?>">
                         <input type="hidden" name="mi_user_id" value="<?php if(isset($hospitalData[0]->hospital_usersId)){ echo $hospitalData[0]->hospital_usersId; }?>" />
                         <input type="hidden" name="mi_id" value="<?php if(isset($hospitalData[0]->hospital_id)){ echo $hospitalData[0]->hospital_id; }?>" />
                         
                          <input type="hidden" name="redirectControllerMethod" value="hospital/detailHospital" />
                         
                        <?php echo $this->load->view('common_pages/time_slot_view');?>
                        
                        <article class="clearfix m-t-10">
                            <div class="col-md-12">
                              <button class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" type="submit" onclick="return timeSlotCheck()">Submit</button>
                            </div>
                            </article>
                    </form>
                         
                    <?php endif;?>
                                       
                                    </section>
                                    <!-- Timeslot Ends -->
                                  
                                    <!--<label class="error" style="display:none;" id="error-users_email"> please enter Email id Properly</label>
                                    <label class="error" style="display:none;" id="error-users_email_check"> Email Already Exists!</label>-->
                                    <!--All Doctors Starts -->
                                    <section class="tab-pane fade in <?php if(isset($active) && $active == 'doctor'){echo "active";}?>" id="doctor">
                                    <!-- Form Section Start -->
                                        <article class="row p-b-10" style="margin-left: 0">
                                            <!--<form name="addHospiDocForm" action="#" id="addHospiDocForm" method="post">    
                                                <aside class="col-md-4 col-sm-4 m-tb-xs-3">
                                                    <div class="input-group">
                                                        <input type="text" name="doctorEmail" id="doctorEmail" class="form-control" placeholder="Check Doctor" onkeyup="switchButton()"/>
                                                        <input type="hidden" id="docId" name="docId" value="" >
                                                        <input type="hidden" id="hospiId" name="hospiId" value="<?php //if(isset($hospitalData[0]->hospital_usersId) && $hospitalData[0]->hospital_usersId != NULL){ echo $hospitalData[0]->hospital_usersId; }else{ echo ""; } ?>" >           
                                                        <input type="hidden" id="ajaxHospiId" name="ajaxHospiId" value="<?php //if(isset($hospitalData[0]->hospital_id) && $hospitalData[0]->hospital_id != NULL){ echo $hospitalData[0]->hospital_id; }else{ echo ""; } ?>" >
                                                    </div>
                                                    <label class="error" id="err_docId"></label>
                                                    <label class="error" id="err_hospiId"></label>
                                                </aside>
                                                <aside class="col-md-2 col-sm-2" id="AddDocHospi" style="display: none">
                                                    <button class="btn btn-success  m-l-10 pull-right" type="submit" id="addToHospi" >Add To Hospital Doctor</button>
                                                </aside>
                                            </form> 
                                        <aside class="col-md-2 col-sm-2" id="checkDoctor">
                                            <button class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" onclick="checkEmailExits()">Check Doctor</button>
                                        </aside>
                                        <aside class="col-md-2 col-sm-2" id="AddNewDoc" style="display: none">
                                            <button class="btn btn-success waves-effect waves-light m-l-10 pull-right" onclick="newDoctor();" >Add New Doctor</button>
                                        </aside>-->
                                            
                                          <aside class="col-md-2 col-sm-2" id="AddNewDoc">
                                            <button class="btn btn-success waves-effect waves-light m-l-10 pull-right addDoctorButton" onclick="addNewDoctor();" >Add New Doctor</button>
                                        </aside>
                                            
                                        <aside class="col-md-3 col-sm-3 m-tb-xs-3 pull-right">
                                            <input type="text" name="search" id="search" class="form-control" placeholder="Search" />
                                        </aside>
                                    </article>
                                    
                                    <!-- Form Section End -->
                                    <article class="clearfix m-top-40 p-b-20" id="doctorList" style="<?php if(isset($showDiv) &&  ($showDiv == 'adddoctor' OR  $showDiv == 'editDoctor' )){echo "display:none";}?>" >
                                        <aside class="table-responsive">
                                           <table class="table all-doctor" id="hospital_doctors">
                                              <thead>
                                                     <tr class="border-a-dull">
                                                         <th>Photo</th>
                                                         <th>Name and Id</th>
                                                          <th>Speciality</th>
                                                         <th>Consulting fee</th>
                                                         <th>Experience</th>
                                                         <th>Phone</th>
                                                         <th>Action</th>
                                                     </tr>
                                                  </thead>
                                           </table>
                                        </aside>
                                    </article>
                                    
                                    <div id="doctorForm" style="<?php if(isset($showDiv) && $showDiv == 'adddoctor'){echo "display:block";}else{ echo "display:none"; } ?>" >
                                        <?php echo $this->load->view('addDoctor'); ?>
                                            <?php echo $this->load->view('doctorScript.php'); ?>
                                    </div>
                                    
                                    
                                    <div id="editDoctorForm" style="<?php if(isset($showDiv) && $showDiv == 'editDoctor'){echo "display:block";}else{ echo "display:none"; } ?>" >
                                            <?php echo $this->load->view('editDoctor'); ?>
                                            <?php echo $this->load->view('doctorScript.php'); ?>
                                    </div>
                                    
                                    </section>
                                    <!-- All Doctors Ends -->
                                    
                                   <!--Account Starts -->
                                    <section class="tab-pane fade in <?php if(isset($active) && $active == 'account'){echo "active";}?>" id="account">
                                        <aside class="col-md-9 setting">
                                            <h4>Account Detail
                                                <a id="editac"  class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                                            </h4>
                                            <hr/>

                                            <!-- Account Detail Section -->
                                            <div class="clearfix m-t-20 p-b-20 doctor-description" id="detailac">
                                                <article class="clearfix m-b-10">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-5">Registered Email Id :</label>
                                                    <p class="col-md-8 col-sm-7"><?php echo $hospitalData[0]->users_email; ?></p>
                                                </article>
                                                <article class="clearfix m-b-10">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-5">Registered Mobile Number:</label>
                                                    <p class="col-md-8 col-sm-7">+91 <?php if(isset($hospitalData[0]->users_mobile)){ echo $hospitalData[0]->users_mobile; } ?></p>
                                                </article>
                                                <article class="clearfix m-b-10">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-5">Membership Type:</label>
                                                    <p class="col-md-6 col-sm-5">
                                                        <?php if($hospitalData[0]->hospital_mmbrTyp == 1){echo 'Life Time';}if($hospitalData[0]->hospital_mmbrTyp == 2){echo 'Health Club';}?>
                                                    </p>
                                                   <!-- <aside class="col-sm-2">
                                                        <button class="btn btn-appointment waves-effect waves-light pull-right" type="button">Upgrade</button>
                                                    </aside> -->
                                                </article>
                                                <article class="clearfix m-b-10">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-5">Change Password:</label>

                                                    <aside class="col-md-5 col-sm-6">
                                                        <form class="">
                                                            <input type="password" name="password" class="form-control" placeholder="New Password" value ="********" readonly="readonly" />
                                                        </form>
                                                    </aside>
                                                </article>
                                            </div>
                                            <!-- Account Detail Section -->

                                            <!-- Account Edit Section -->
                                            <form name="acccountForm" id="acccountForm" type="post">
                                                <input type="hidden" name="hospitalUserId" id="hospitalUserId" value="<?php echo $hospitalData[0]->users_id;?>" >
                                                 <p class="text-success" style="display:none;" id="error-password_email_check_success"> Data Changed Successfully!</p>
                                                <aside id="newac" style="display:none">
                                                <article class="clearfix m-b-10">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Registered Email Id :</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <input class="form-control" id="users_email" type="text" value="<?php echo $hospitalData[0]->users_email; ?>" readonly="">
                                                        <label class="error" style="display:none;" id="error-users_email"> please enter Email id Properly</label>
                                                        <label class="error" style="display:none;" id="error-users_email_check"> Email Already Exits!</label>
                                                        <label class="error" style="display:none;" id="error-users_emailBlank"> Email id field should not be blank!</label>
                                                    </div>
                                                </article>

                                               <!-- <article class="clearfix m-b-10">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Name :</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <input class="form-control" id="diagnosticCenter" name="name" type="text" required="" value="Appolo Pharmacies">
                                                    </div>
                                                </article> -->

                                                <article class="clearfix m-b-10 ">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Mobile Numbers :</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <aside class="row">
                                                            <!--<div class="col-md-3 col-sm-3 col-xs-12">
                                                                <select class="selectpicker" data-width="100%">
                                                                    <option>+91</option>
                                                                    <option>+1</option>
                                                                </select>
                                                            </div>-->
                                                            <div class="col-md-9 col-sm-9 col-xs-12 m-t-xs-10">
                                                                <input type="text" class="form-control" name="users_mobile" id="users_mobile" placeholder="" onkeypress="return isNumberKey(event)" value="<?php if(isset($hospitalData[0]->users_mobile)){ echo $hospitalData[0]->users_mobile; } ?>" maxlength="10" />
                                                                   <p class="error" id="error-users_mobile" style="display:none;"> Enter Mobile Number!</p>
                                                            </div>
                                                            <!--<p class="m-t-10">* If it is landline, include Std code with number </p> -->
                                                        </aside>
                                                    </div>
                                                </article>

                                                <article class="clearfix m-b-10">
                                                    <label for="cname" class="control-label col-md-4 col-sm-4">Membership Type:</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <select class="select2" data-width="100%" name="hospital_mmbrTyp" id="hospital_mmbrTyp">
                                                            <option value="1" <?php if($hospitalData[0]->hospital_mmbrTyp == 1){echo "selected";} ?>>Life Time</option>
                                                            <option value="2" <?php if($hospitalData[0]->hospital_mmbrTyp == 2){echo "selected";} ?>>Health Club</option>

                                                        </select>
                                                    </div>
                                                </article>
                                                <article class="clearfix m-b-10">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Change Password:</label>

                                                    <aside class="col-md-8 col-sm-8">
                                                      
                                                            <input type="password" name="users_password" id="users_password" class="form-control" placeholder="New Password" />
                                                             <label class="error" style="display:none;" id="error-users_password"> Please enter password! </label>
                                                    </aside>
                                                </article>
                                               <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-5">Confirm Password:</label>

                                                <aside class="col-md-8 col-sm-8">
                                                   
                                                    <input type="password" name="cnfPassword" class="form-control" placeholder="Confirm Password" id="cnfPassword" />
                                                   
                                                    <!--<p><a class="m-t-10" href="javascript:void(0)" onclick="updatePassword()">Edit</a></p> -->
                                                    <label class="error" style="display:none;" id="error-cnfPasswordenter"> Please enter confirm password! </label>
                                                     <label class="error" style="display:none;" id="error-cnfPassword"> Password and confirm password should be same </label>
                                                  
                                                   
                                                </aside>
                                            </article>
                                               <!-- <input type="text" name="myPassword" id="myPassword" value="<?php if(isset($bloodBankData[0]->users_password)){ echo $bloodBankData[0]->users_password;}?>" /> -->
                                                <article class="clearfix ">
                                                    <div class="col-md-12 m-t-20 m-b-20">

                                                        <button type="button" class="btn btn-success waves-effect waves-light pull-right" onclick="updateAccount()">Update</button>
                                                    </div>

                                                </article>
                                            </aside>
                                            </form>    
                                            <!-- Account Edit Section -->
                                        </aside>
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
            
        </div>
        <!-- End Right content here -->
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
                                    <p>Comming Soon</p>

                                </div>
                                <div class="modal-footer p-t-10">
                                    <button type="button" class="btn btn-appointment" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
    </div>
    <!-- END wrapper -->
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

                                        
                                                <div id="image_preview"> 
                                                     <?php if( isset($hospitalData[0]->hospital_background_img) && !empty($hospitalData[0]->hospital_background_img)){
                                                    ?>
                                                    <img id="previewing" src="<?php echo base_url().'assets/hospitalsImages/'.$hospitalData[0]->hospital_background_img ?>" class="img-responsive center-block" /></div>
                                                     <?php }else{ ?>
                                                        <img id="previewing" src="<?php echo base_url();?>assets/default-images/Hospital.png" class="img-responsive center-block" /></div>
                                                     <?php } ?>
                         

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
                    <!-- Gallery Model -->
                    <div class="modal" id="modal-gallery" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                  <button class="close" type="button" data-dismiss="modal">×</button>
                                  <h3 class="modal-title"></h3>
                              </div>
                              <div class="modal-body">
                                  <div id="modal-carousel" class="carousel">

                                    <div class="carousel-inner">           
                                    </div>

                                    <a class="carousel-control left" href="#modal-carousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                                    <a class="carousel-control right" href="#modal-carousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>

                                  </div>
                              </div>
                              <div class="modal-footer">
                                  <button class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                    </div>
                     <?php //echo $this->load->view('edit_gallery_crop_modal');?>
                     <?php  echo $this->load->view('edit_upload_crop_modal');?>
                    <!-- Gallery Model Ends -->
