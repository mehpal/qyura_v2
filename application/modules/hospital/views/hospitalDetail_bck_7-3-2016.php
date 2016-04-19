
<body class="fixed-left">
   

    <!-- Start right Content here -->
        <div class="content-page" ng-app="myApp">
            <!-- Start content -->
            <div class="content">
                <div class="container row">
                    <div class="clearfix">
                         <div class="col-md-12 text-success">
                            <?php echo $this->session->flashdata('message'); ?>
                         </div>
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


                                    <div class="bg-picture text-center" style="background-image:url('<?php if(isset($hospitalData[0]->hospital_background_img) && !empty($hospitalData[0]->hospital_background_img)): echo base_url().'assets/hospitalsImages/'.$hospitalData[0]->hospital_background_img; endif;?>')">
                                        <div class="bg-picture-overlay"></div>
                                        <div class="profile-info-name">
                                            <div class='pro-img'>
                                                <!-- image -->
                                                <?php if(!empty($hospitalData[0]->hospital_img)){
                                                    ?>
                                               <img src="<?php echo base_url()?>assets/hospitalsImages/thumb/thumb_100/<?php echo $hospitalData[0]->hospital_img; ?>" alt="" class="logo-img" />
                                               <?php } else { ?>
                                                 <img src="<?php echo base_url()?>assets/images/noImage.png" alt="" class="logo-img" />
                                               <?php } ?>
                                                   <article class="logo-up" style="display:none">
                                                    <div class="fileUpload btn btn-sm btn-upload logo-Upload">
                                                        <span><i class="fa fa-cloud-upload fa-3x avatar-view"></i></span>
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
                                        <li class="active">
                                            <a data-toggle="tab" href="#general">General Detail</a>
                                        </li>
                                        
                                        <li class=" ">
                                            <a data-toggle="tab" href="#diagnostic">Diagnostics</a>
                                        </li>
                                        <li class=" ">
                                            <a data-toggle="tab" href="#specialities">Specialities</a>
                                        </li>
                                        <li class=" ">
                                            <a data-toggle="tab" href="#gallery">Gallery</a>
                                        </li>
                                        <li class="<?php if(isset($showTimeSlotBox) && !empty($showTimeSlotBox)){echo $showTimeSlotBox;}?>">
                                            <a data-toggle="tab" href="#timeslot">Time Slot</a>
                                        </li>
                                       <li class=" ">
                                            <a data-toggle="tab" href="#doctor">All Doctors</a>
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
                                            <div class="bg-white mi-form-section">

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
                                                                    <?php if($hospitalData[0]->hospital_type == 1)
                                                                            echo "Trauma Centres";
                                                                            else if($hospitalData[0]->hospital_type == 2)
                                                                            echo "Rehabilitation Hospitals";
                                                                            else
                                                                            echo "Children's Hospitals";    
                                                                        ?>
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
                                                                    for($i= 0; $i< count($explode)-1;$i++){?>
                                                                    <p>+<?php echo $explode[$i];?></p>
                                                                   
                                                                    <?php }?>
                                                                    
                                                                </aside>
                                                            </article>
                                                           
                                                          
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">24x7 Emergency :</label>
                                                                <?php if($hospitalData[0]->isEmergency == 1){?>
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
                                                                    for($i= 0; $i< count($bloodBank_explode)-1;$i++){?>
                                                                    <p>+<?php echo $bloodBank_explode[$i];?></p>
                                                                   
                                                                    <?php }?>
                                                                    </aside>
                                                                </article>
                                                            </section>
                                                         
                                                        </aside>


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
                                                                    for($i= 0; $i< count($pharmacy_explode)-1;$i++){?>
                                                                    <p>+<?php echo $pharmacy_explode[$i];?></p>
                                                                   
                                                                    <?php }?>
                                                                    </aside>
                                                                </article>
                                                            </section>
                                                            
                                                        </aside>
                                                        </aside>
                                                        
                                                        <!--edit-->
                                                         <form name="hospitalDetail" action="<?php echo site_url("hospital/saveDetailHospital/$hospitalId"); ?>" id="hospitalDetail" method="post">
                                                         <input type="hidden" id="StateId" name="StateId" value="<?php echo $hospitalData[0]->hospital_stateId;?>" />
                                                          <input type="hidden" id="countryId" name="countryId" value="<?php echo $hospitalData[0]->hospital_countryId;?>" />
                                                          <input type="hidden" id="cityId" name="cityId" value="<?php echo $hospitalData[0]->hospital_cityId;?>" />
                                                        <aside id="newDetail" style="display:<?php echo $showStatus;?>;">
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Hospital Name :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <input class="form-control" id="hospital_name" name="hospital_name" type="text" value="<?php echo $hospitalData[0]->hospital_name;?>">
                                                                    <label class="error" > <?php echo form_error("hospital_name"); ?></label>
                                                                </div>
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                                <label for="cname" class="control-label col-md-4  col-sm-4">Hospital Type :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <select class="selectpicker" data-width="100%" name="hospital_type" id="hospital_type" tabindex="-98">
                                                                        <option value="1" <?php if($hospitalData[0]->hospital_type == 1){ echo 'selected';}?>> Trauma Centres</option>
                                                                        <option value="2" <?php if($hospitalData[0]->hospital_type == 2){ echo 'selected';}?>>Rehabilitation Hospitals</option>
                                                                        <option value="3" <?php if($hospitalData[0]->hospital_type == 3){ echo 'selected';}?>>Children's Hospitals</option>
                                                                    </select>
                                                                </div>
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                            <label for="cemail" class="control-label col-md-4 col-sm-4">Address :</label>
                                                            <div class="col-md-8 col-sm-8">
                                                    
                                            <div class="clearfix m-t-10">
                                                <textarea class="form-control" id="geocomplete" name="hospital_address" type="text" ><?php if(isset($hospitalData[0]->hospital_address)){ echo $hospitalData[0]->hospital_address; }?></textarea>
                                               <label class="error" > <?php echo form_error("hospital_address"); ?></label>
                                            </div>
                                        </div>
                                                        </article>

                                                            <article class="clearfix m-b-10 ">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <?php 
                                                                    $explodes= explode('|',$hospitalData[0]->hospital_phn); 
                                                                    for($i= 0; $i< count($explodes)-1;$i++){
                                                                    $moreExpolde = explode(' ',$explodes[$i]);?>
                                                                    
                                                                    
                                                                    <aside class="row">
                                                                        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-12">
                                                                            <select class="selectpicker" data-width="100%" name="pre_number[]">
                                                                                <option value="91" <?php if($moreExpolde[0] == '91'){ echo 'selected';}?>>+91</option>
                                                                                <option value="1" <?php if($moreExpolde[0] == '1'){ echo 'selected';}?>>+1</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-10 m-t-xs-10">
                                                                            <input type="text" class="form-control" name="hospital_phn[]" id="hospital_phn<?php echo ($i+1);?>" placeholder="9837000123" value="<?php echo $moreExpolde[1];?>" maxlength="10" onblur="checkNumber(<?php echo $i;?>)"/>
                                                                        </div>
                                                                       
                                                                    </aside>
                                                                    <br />
                                                                    <?php $moreExpolde ='';}?>
                                                               
                                                                    <p class="m-t-10">* If it is landline, include Std code with number </p>
                                                                </div>
                                                            </article>
                                                            <article class="clearfix">
                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-9" for="cname">Bloodbank Availablity </label>
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
                                                                           <div>
                                                                   </article>
                                                                       <article class="clearfix m-b-10 ">
                                                                       <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                       <div class="col-md-8 col-sm-8">
                                                                            <?php 
                                                                            if($hospitalData[0]->bloodBank_phn != ''){
                                                                                $explodes_bloodbank= explode('|',$hospitalData[0]->bloodBank_phn); 
                                                                                for($i= 0; $i< count($explodes_bloodbank)-1;$i++){
                                                                                $more_bloodbank = explode(' ',$explodes_bloodbank[$i]);?>
                                                                           <aside class="row">
                                                                               <div class="col-md-3 col-sm-3 col-xs-12">
                                                                                   <select class="selectpicker" data-width="100%" name="preblbankNo[]" id="preblbankNo<?php echo ($i+1);?>">
                                                                                    <option value="91" <?php if($more_bloodbank[0] == '91'){ echo 'selected';}?>>+91</option>
                                                                                    <option value="1" <?php if($more_bloodbank[0] == '1'){ echo 'selected';}?>>+1</option>
                                                                                   </select>
                                                                               </div>
                                                                               <div class="col-md-9 col-sm-9 col-xs-10 m-t-xs-10">
                                                                                   <input type="teL" class="form-control" name="bloodBank_phn[]" id="bloodBank_phn<?php echo ($i+1);?>" value ="<?php echo $more_bloodbank[1]; ?>" placeholder="9837000123" onkeypress="return isNumberKey(event)" />
                                                                               </div>

                                                                           </aside>
                                                                            <?php $more_bloodbank = ''; } } else {?>
                                                                                <aside class="row">
                                                                               <div class="col-md-3 col-sm-3 col-xs-12">
                                                                                   <select class="selectpicker" data-width="100%" name="preblbankNo[]" id="preblbankNo1">
                                                                                    <option value="91" >+91</option>
                                                                                    <option value="1" >+1</option>
                                                                                   </select>
                                                                               </div>
                                                                               <div class="col-md-9 col-sm-9 col-xs-10 m-t-xs-10">
                                                                                   <input type="teL" class="form-control" name="bloodBank_phn[]" id="bloodBank_phn1" value ="" placeholder="9837000123" onkeypress="return isNumberKey(event)" />
                                                                               </div>

                                                                           </aside>
                                                                            <?php } ?>
                                                                       </div>
                                                                   </article>
                                                                  </section>
                                                         
                                                           <article class="clearfix">
                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-9" for="cname">Pharmacy Availablity </label>
                                                                        <div class="col-md-8 col-xs-3">
                                                                            <aside class="checkbox checkbox-success m-t-5">
                                                                                <input type="checkbox" id="pharmacybtn" name="pharmacy_chk" value="1">
                                                                                <label>

                                                                                </label>
                                                                            </aside>
                                                                        </div>
                                                                    </article>
                                                                     
                                                          <section id="pharmacydetail" style="display:none">
                                                                
                                                                 <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Name :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <input class="form-control" id="pharmacy_name" name="pharmacy_name" type="text" value="<?php if(isset($hospitalData[0]->pharmacy_name)){ echo $hospitalData[0]->pharmacy_name; } ?>" >
                                                                    <div>
                                                            </article>
                                                                 
                                                                <article class="clearfix m-b-10 ">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <?php 
                                                                    if($hospitalData[0]->pharmacy_phn != ''){
                                                                    $explodesPharmacy= explode('|',$hospitalData[0]->pharmacy_phn); 
                                                                    for($i= 0; $i< count($explodesPharmacy)-1;$i++){
                                                                    $morePharmacy = explode(' ',$explodesPharmacy[$i]);?>
                                                                    <aside class="row">
                                                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                                                            <select class="selectpicker" data-width="100%" name="prePharmacy[]" id="prePharmacy<?php echo ($i+1);?>">
                                                                                <option value="91" <?php if($morePharmacy[0] == '91'){ echo 'selected';}?>>+91</option>
                                                                                    <option value="1" <?php if($morePharmacy[0] == '1'){ echo 'selected';}?>>+1</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-9 col-sm-9 col-xs-10 m-t-xs-10">
                                                                            <input type="teL" class="form-control" name="pharmacy_phn[]" id="pharmacy_phn<?php echo ($i+1);?>" value ="<?php echo $morePharmacy[1]; ?>" placeholder="9837000123" onkeypress="return isNumberKey(event)" />
                                                                        </div>

                                                                    </aside>
                                                                    <?php $morePharmacy = '';} } else { ?>
                                                                    <aside class="row">
                                                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                                                            <select class="selectpicker" data-width="100%" name="prePharmacy[]" id="prePharmacy1">
                                                                                <option value="91">+91</option>
                                                                                    <option value="1">+1</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-9 col-sm-9 col-xs-10 m-t-xs-10">
                                                                            <input type="teL" class="form-control" name="pharmacy_phn[]" id="pharmacy_phn1" placeholder="9837000123" onkeypress="return isNumberKey(event)" onblur="phphone()" />
                                                                        </div>

                                                                    </aside>
                                                                    <?php }?>
                                                                </div>
                                                            </article>
                                                           </section>
                                    
                                                            
                                                           <article class="clearfix">
                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-9" for="cname">24x7 Emergency </label>
                                                                        <div class="col-md-8 col-xs-3">
                                                                            <aside class="checkbox checkbox-success m-t-5">
                                                                                <input type="checkbox" id="isEmergency" name="isEmergency" value="1" <?php if($hospitalData[0]->isEmergency == 1){ echo "checked";}?> />
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
                                                           </div>    
                                                            </article>
                                                          <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Designation :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <input class="form-control" id="hospital_dsgn" name="hospital_dsgn" type="text" value="<?php if(isset($hospitalData[0]->hospital_dsgn)){ echo $hospitalData[0]->hospital_dsgn; }?>">
                                                                    <label class="error" > <?php echo form_error("hospital_dsgn"); ?></label>
                                                                    <div>
                                                            </article>
                                                          
                                                           
                                                            <article class="clearfix m-b-10">

                                                              <div class="col-md-12">
                                                              <button type="submit" class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" onclick="return validationHospitalDetail();">Update</button>
                                                              </div>

                                                             </article>
                                                        </aside>
                                                             <fieldset>
                           
                                                                <input name="lat" type="hidden" value="<?php echo $hospitalData[0]->hospital_lat;?>">

                                                               <!-- <label>Longitude</label> -->
                                                                <input name="lng" type="hidden" value="<?php echo $hospitalData[0]->hospital_long;?>">
                                                                <input name="user_tables_id" id="user_tables_id" type="hidden" value="<?php echo $hospitalData[0]->users_id;?>">
                                                            <?php if($hospitalData[0]->pharmacy_phn != '' OR $hospitalData[0]->pharmacy_name != ''){ ?>
                                                                <input name="pharmacy_status" id="pharmacy_status" type="hidden" value="<?php echo $hospitalData[0]->pharmacy_name;?>">
                                                            <?php } ?>
                                                               <?php if($hospitalData[0]->bloodBank_name != '' OR $hospitalData[0]->bloodBank_phn != ''){ ?>
                                                                <input name="bloodbank_status" id="bloodbank_status" type="hidden" value="<?php echo $hospitalData[0]->bloodBank_name;?>">
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
                                                                <div class="col-md-3 col-sm-6">
                                                                    <img src="<?php echo base_url()?>assets/insurance/<?php echo $val->insurance_img;?>" class="img-responsive center-block">
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
                                                                    <input type="hidden" name="hospitalInsuranceId" id="hospitalInsuranceId" value="<?php echo $hospitalId;?>" />
                                                                    <article class="clearfix m-b-10">
                                                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Company Name :</label>
                                                                        <div class="col-md-8 col-sm-8">
                                                                            <!--<input class="form-control" id="diagnosticCenter" name="name" type="text" required=""> -->
                                                                            <select  multiple="" class="bs-select form-control-select2 " data-width="100%" name="insurances[]" Id="insurances" data-size="4" >

                                                                                    <?php foreach($allInsurance as $key=>$val) {?>
                                                                                     <option value="<?php echo $val->insurance_id;?>"><?php echo $val->insurance_Name;?></option>
                                                                                      <?php }?>
                                                                                 </select>
                                                                        </div>
                                                                    </article>
                                                                   <!-- <article class="form-group m-lr-0 ">
                                                                        <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                                                                        <div class="col-md-8 col-sm-8 text-right">
                                                                            <input id="uploadFileBb" class="showUpload" disabled="disabled" />
                                                                            <div class="fileUpload btn btn-sm btn-upload">
                                                                                <span><i class="fa fa-cloud-upload fa-3x"></i></span>
                                                                                <input id="uploadBtnBb" type="file" class="upload" />
                                                                            </div>
                                                                        </div>
                                                                    </article>-->
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
                                                                                    <input type="text" class="form-control" name="hospitalAwards_awardsName" id="hospitalAwards_awardsName" placeholder="FICCI Healthcare Excillence Awards" />
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
                                                                                    <input type="text" class="form-control" name="hospitalServices_serviceName" id="hospitalServices_serviceName" placeholder="Add Service" />
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
                                     <section class="tab-pane fade in diagdetail" id="diagnostic">
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
                                            <section class="clearfix detailbox m-b-20">
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
                                            <!--<tr>
                                            <td>
                                            Cmplete Blood Count(CBC)
                                            </td>
                                            <td>
                                            <i class="fa fa-inr"></i> <a data-title="Enter username" data-pk="1" data-type="text" id="username" href="#" class="editable editable-click " data-original-title="" title="Edit Price">1200</a>
                                            </td>
                                            <td>
                                            <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                            Blood Chemistry Test
                                            </td>
                                            <td>
                                            <i class="fa fa-inr"></i> 1200
                                            </td>
                                            <td>
                                            <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                            Cmplete Blood Count(CBC)
                                            </td>
                                            <td>
                                            <i class="fa fa-inr"></i> 1200
                                            </td>
                                            <td>
                                            <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                            Blood Chemistry Test
                                            </td>
                                            <td>
                                            <i class="fa fa-inr"></i> 1200
                                            </td>
                                            <td>
                                            <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                            Cmplete Blood Count(CBC)
                                            </td>
                                            <td>
                                            <i class="fa fa-inr"></i> 1200
                                            </td>
                                            <td>
                                            <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                            Blood Chemistry Test
                                            </td>
                                            <td>
                                            <i class="fa fa-inr"></i> 1200
                                            </td>
                                            <td>
                                            <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                            Cmplete Blood Count(CBC)
                                            </td>
                                            <td>
                                            <i class="fa fa-inr"></i> 1200
                                            </td>
                                            <td>
                                            <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                            Blood Chemistry Test
                                            </td>
                                            <td>
                                            <i class="fa fa-inr"></i> 1200
                                            </td>
                                            <td>
                                            <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                            Cmplete Blood Count(CBC)
                                            </td>
                                            <td>
                                            <i class="fa fa-inr"></i> 1200
                                            </td>
                                            <td>
                                            <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                            Blood Chemistry Test
                                            </td>
                                            <td>
                                            <i class="fa fa-inr"></i> 1200
                                            </td>
                                            <td>
                                            <a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a>
                                            </td>
                                            </tr>-->
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
                                             <!--<p class="p-5" id="detailInstruction">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                            </p>-->
                                            <aside class="clearfix p-5">
                                                <input type="hidden" value="" id="instructionId" />
                                                <a onclick="changeInstruction()" class="btn btn-success waves-effect waves-light m-b-5 p-abs " data-toggle="modal" id="instructionEdit">Edit</a>
                                                <a style="display:none;" onclick="updateInstruction()" class="btn btn-success waves-effect waves-light m-b-5 p-abs " data-toggle="modal" id="instructionUpdate">Update</a>
                                                <!--<a onclick="changeInstruction()" class="btn btn-success waves-effect waves-light m-b-5 p-abs " data-toggle="modal" data-target="#myModal">Edit</a>-->
                                            </aside>
                                            </article>
                                            </aside>
                                            </div>
                                            </section>
                                     </section>
                                    <!-- diagnostic Ends --> 
                                    
                                     <!--Specialities Starts -->
                                    <section class="tab-pane fade in" id="specialities">
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
                                    <section class="tab-pane fade in" id="gallery">
                                        <div class="fileUpload btn btn-sm btn-upload im-upload">
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
                                  <section class="tab-pane fade in" id="timeslot">
                                        <div class="col-md-10 p-b-20">
                                            <?php //echo '<pre>';
                                             // print_r($AlltimeSlot);
                                          //  echo '</pre>';
                                          //  echo $AlltimeSlot[1]->hospitalTimeSlot_endTime;
                                              if(empty($AlltimeSlot) || count($AlltimeSlot) == 0){
                                            ?>
                                            <form class="form-horizontal" action="<?php echo site_url("hospital/hospitalAddTimeSlot/$hospitalId"); ?>" method="post">

                                                <aside id="session">
                                                   <article class="clearfix m-t-10">
                                                        <label for="" class="control-label col-md-4 col-sm-4">Morning Session:</label>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepickerMorStart" type="text" class="form-control timepicker" value="6:00 AM" name="morningStartTime" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepickerMorEnd" type="text" class="form-control timepicker" value="11:59 AM" name="morningEndTime" />
                                                            </div>
                                                        </div>
                                                    </article>

                                                    <article class="clearfix m-t-10">
                                                        <label for="" class="control-label col-md-4 col-sm-4">Afternoon Session :</label>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepickernoonStart" type="text" class="form-control timepicker" value="12:00 PM" name="afternoonStartTime" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepickernoonEnd" type="text" class="form-control timepicker" value="05:59 PM" name="afternoonEndTime" />
                                                            </div>
                                                        </div>
                                                    </article>


                                                    <article class="clearfix m-t-10">
                                                        <label for="" class="control-label col-md-4 col-sm-4">Evening Session :</label>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepickerEveStart" type="text" class="form-control timepicker" value="06:00 PM" name="eveningStartTime" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepickerEveEnd" type="text" class="form-control timepicker" value="10:59 PM" name="eveningEndTime" />
                                                            </div>
                                                        </div>
                                                    </article>

                                                    <article class="clearfix m-t-10">
                                                        <label for="" class="control-label col-md-4 col-sm-4">Night Session :</label>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepickerNgtStart" type="text" class="form-control timepicker" value="11:00 PM" name="nightStartTime" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepickerNgtEnd" type="text" class="form-control timepicker" value="5:00 AM" name="nightEndTime" />
                                                            </div>
                                                        </div>
                                                    </article>

                                                </aside>
                                                
                                            <input type="hidden" name="morningSession" value="0">
                                            <input type="hidden" name="afternoonSession" value="1">
                                            <input type="hidden" name="eveningSession" value="2">
                                            <input type="hidden" name="nightSession" value="3">
                                            <input type="hidden" name="hospitalId" value="<?php echo $hospitalId ?>">
                                       
                                        
                                                <article class="clearfix ">
                                                    <div class="col-md-12 m-t-20 m-b-20">
                                                        <button class="btn btn-danger waves-effect pull-right" type="button">Reset</button>
                                                        <button class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit">Submit</button>
                                                    </div>
                                                </article>
                                            </form>
                                            <?php }else{ ?>
                                            
                                               <form class="form-horizontal" action="<?php echo site_url("hospital/UpdateHospitalTimeSlot/$hospitalId"); ?>" method="post">

                                                <aside id="session">
                                                   <article class="clearfix m-t-10">
                                                        <label for="" class="control-label col-md-4 col-sm-4">Morning Session:</label>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepickerMorStart" type="text" class="form-control timepicker" value="<?php if(isset($AlltimeSlot[0]->hospitalTimeSlot_startTime) && $AlltimeSlot[0]->hospitalTimeSlot_startTime != '' ){ echo date('h:i:s A', strtotime($AlltimeSlot[0]->hospitalTimeSlot_startTime)); }else{ echo '06:00 AM'; } ?> " name="morningStartTime" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepickerMorEnd" type="text" class="form-control timepicker" value="<?php if(isset($AlltimeSlot[0]->hospitalTimeSlot_endTime) && $AlltimeSlot[0]->hospitalTimeSlot_endTime != '' ){ echo date('h:i:s A', strtotime($AlltimeSlot[0]->hospitalTimeSlot_endTime)); }else{ echo '11:59 AM'; } ?> " name="morningEndTime" />
                                                            </div>
                                                        </div>
                                                    </article>

                                                    <article class="clearfix m-t-10">
                                                        <label for="" class="control-label col-md-4 col-sm-4">Afternoon Session :</label>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepickernoonStart" type="text" class="form-control timepicker" value="<?php if(isset($AlltimeSlot[1]->hospitalTimeSlot_startTime) && $AlltimeSlot[1]->hospitalTimeSlot_startTime != '' ){ echo date('h:i:s A', strtotime($AlltimeSlot[1]->hospitalTimeSlot_startTime) ); }else{ echo '12:00 PM'; } ?> " name="afternoonStartTime" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepickernoonEnd" type="text" class="form-control timepicker" value="<?php if(isset($AlltimeSlot[1]->hospitalTimeSlot_endTime) && $AlltimeSlot[1]->hospitalTimeSlot_endTime != '' ){ echo date('h:i:s A', strtotime($AlltimeSlot[1]->hospitalTimeSlot_endTime)); }else{ echo '5:59 PM'; } ?> " name="afternoonEndTime" />
                                                            </div>
                                                        </div>
                                                    </article>


                                                    <article class="clearfix m-t-10">
                                                        <label for="" class="control-label col-md-4 col-sm-4">Evening Session :</label>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepickerEveStart" type="text" class="form-control timepicker" value="<?php if(isset($AlltimeSlot[2]->hospitalTimeSlot_startTime) && $AlltimeSlot[2]->hospitalTimeSlot_startTime != '' ){ echo date('h:i:s A', strtotime($AlltimeSlot[2]->hospitalTimeSlot_startTime)); }else{ echo '06:00 PM'; } ?> " name="eveningStartTime" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepickerEveEnd" type="text" class="form-control timepicker" value="<?php if(isset($AlltimeSlot[2]->hospitalTimeSlot_endTime) && $AlltimeSlot[2]->hospitalTimeSlot_endTime != '' ){ echo date('h:i:s A', strtotime($AlltimeSlot[2]->hospitalTimeSlot_endTime)); }else{ echo '10:59 PM'; } ?>" name="eveningEndTime" />
                                                            </div>
                                                        </div>
                                                    </article>

                                                    <article class="clearfix m-t-10">
                                                        <label for="" class="control-label col-md-4 col-sm-4">Night Session :</label>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepickerNgtStart" type="text" class="form-control timepicker" value="<?php if(isset($AlltimeSlot[3]->hospitalTimeSlot_startTime) && $AlltimeSlot[3]->hospitalTimeSlot_startTime != '' ){ echo date('h:i:s A', strtotime($AlltimeSlot[3]->hospitalTimeSlot_startTime)); }else{ echo '11:00 PM'; } ?>" name="nightStartTime" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input id="timepickerNgtEnd" type="text" class="form-control timepicker" value="<?php if(isset($AlltimeSlot[3]->hospitalTimeSlot_endTime) && $AlltimeSlot[3]->hospitalTimeSlot_endTime != '' ){ echo date('h:i:s A', strtotime($AlltimeSlot[3]->hospitalTimeSlot_endTime)); }else{ echo '05:00 AM'; } ?>" name="nightEndTime" />
                                                            </div>
                                                        </div>
                                                    </article>

                                                </aside>
                                                
                                            <input type="hidden" name="morningSession" value="0">
                                            <input type="hidden" name="afternoonSession" value="1">
                                            <input type="hidden" name="eveningSession" value="2">
                                            <input type="hidden" name="nightSession" value="3">
                                            <input type="hidden" name="hospitalId" value="<?php echo $hospitalId ?>">
                                       
                                        
                                                <article class="clearfix ">
                                                    <div class="col-md-12 m-t-20 m-b-20">
                                                        <button class="btn btn-danger waves-effect pull-right" type="button">Reset</button>
                                                        <button class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit">Submit</button>
                                                    </div>
                                                </article>
                                            </form>
                                            <?php } ?>
                                        </div>
                                       
                                    </section>
                                    <!-- Timeslot Ends -->
                                  
                                    
                                     <!--All Doctors Starts -->
                                   <section class="tab-pane fade in" id="doctor">

                                    <article class="clearfix m-top-40 p-b-20">
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
                                    </section>
                                    <!-- All Doctors Ends -->
                                    
                                   <!--Account Starts -->
                                    <section class="tab-pane fade in" id="account">
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
                                                        <input class="form-control" id="users_email" name="users_email" type="users_email" required="" value="<?php echo $hospitalData[0]->users_email; ?>" onblur="checkEmailFormat()">
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
                                                                <input type="teL" class="form-control" name="users_mobile" id="users_mobile" placeholder="9837000123" onkeypress="return isNumberKey(event)" value="<?php if(isset($hospitalData[0]->users_mobile)){ echo $hospitalData[0]->users_mobile; } ?>" />
                                                                   <p class="error" id="error-users_mobile" style="display:none;"> Enter Mobile Number!</p>
                                                            </div>
                                                            <!--<p class="m-t-10">* If it is landline, include Std code with number </p> -->
                                                        </aside>
                                                    </div>
                                                </article>

                                                <article class="clearfix m-b-10">
                                                    <label for="cname" class="control-label col-md-4 col-sm-4">Membership Type:</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <select class="selectpicker" data-width="100%" name="hospital_mmbrTyp" id="hospital_mmbrTyp">
                                                            <option value="1" <?php if($hospitalData[0]->hospital_mmbrTyp == 1){echo "selected";} ?>>Life Time</option>
                                                            <option value="2" <?php if($hospitalData[0]->hospital_mmbrTyp == 2){echo "selected";} ?>>Health Club</option>

                                                        </select>
                                                    </div>
                                                </article>
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
                     <?php echo $this->load->view('edit_gallery_crop_modal');?>
                     <?php echo $this->load->view('edit_upload_crop_modal');?>
                    <!-- Gallery Model Ends -->
