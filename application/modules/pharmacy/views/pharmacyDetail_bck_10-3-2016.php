
        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container row">
                    <div class="clearfix">
                         <div class="col-md-12 text-success">
                            <?php echo $this->session->flashdata('message'); ?>
                         </div>
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Pharmacy Detail</h3>
                            <a href="<?php echo site_url('/pharmacy'); ?>" class="btn btn-appointment btn-back waves-effect waves-light pull-right"><i class="fa fa-angle-left"></i> Back</a>
                               
                        </div>
                    </div>

                    <!-- Left Section Start -->
                    <section class="col-md-12 detailbox m-t-10">


                        <div class="bg-white">
                            <!-- Table Section Start -->

                            <section class="col-md-12">

                                <aside class="clearfix m-bg-pic">


                                    <div class="bg-picture text-center" style="background-image:url('<?php if(isset($pharmacyData[0]->pharmacy_background_img) && !empty($pharmacyData[0]->pharmacy_background_img)): echo base_url().'assets/pharmacyImages/'.$pharmacyData[0]->pharmacy_background_img; endif;?>')">
                                        <div class="bg-picture-overlay"></div>
                                        <div class="profile-info-name">
                                            <div class='pro-img'>
                                                <!-- image -->
                                                <?php if(!empty($pharmacyData[0]->pharmacy_img)){
                                                    ?>
                                               <img src="<?php echo base_url()?>assets/pharmacyImages/<?php echo $pharmacyData[0]->pharmacy_img; ?>" alt=""  class="logo-img" />
                                               <?php } else { ?>
                                                 <img src="<?php echo base_url()?>assets/images/noImage.png" alt="" class="logo-img" />
                                               <?php } ?>
                                                 
                                                  <article class="logo-up" style="display:none">
                                                    <div class="fileUpload btn btn-sm btn-upload logo-Upload">
                                                        <span><i class="fa fa-cloud-upload fa-3x avatar-view"></i></span>
<!--                                                        <input id="uploadBtn" type="file" class="upload" />-->
                                                         <input type="hidden" style="display:none;" class="no-display" id="file_action_url" name="file_action_url" value="<?php echo site_url('pharmacy/editUploadImage');?>">
                                                         <input type="hidden" style="display:none;" class="no-display" id="load_url" name="load_url" value="<?php echo site_url('pharmacy/getUpdateAvtar/'.$this->uri->segment(3));?>">
                                                    </div>
                                                </article>
                                                  
                                                <!-- description div -->
                                                <div class='pic-edit'>
                                                    <h3><a id="picEdit" class="pull-center cl-white" title="Edit Logo"><i class="fa fa-pencil"></i></a></h3>
                                                    <h3><a id="picEditClose" class="pull-center cl-white" title="Cancel"  style="display:none;"><i class="fa fa-times"></i></a></h3>
                                                </div>
                                                <!-- end description div -->
                                            </div>

                                            <h3 class="text-white"> <?php echo $pharmacyData[0]->pharmacy_name;?> </h3>
                                            <h4> <?php if(isset($pharmacyData[0]->pharmacy_address)){ echo $pharmacyData[0]->pharmacy_address; }?> </h4>

                                        </div>

                                    </div>
                                    
                                    
                                    <!--/ meta -->

                                </aside>
                                <section class="clearfix hospitalBtn">
                                   <div class="col-md-12">
                                        <a data-toggle="modal" data-target="#changeBg" class="pull-right cl-white" title="Edit Background"><i class="fa fa-pencil"></i></a>
                                    </div>

                                </section>
                                <!--
                                <article class="text-center clearfix m-t-50">
                                    <ul class="nav nav-tab nav-setting">
                                        <li class="active">
                                            <a data-toggle="tab" href="#general">General Detail</a>
                                        </li>
                                    </ul>
                                </article>
                                -->

                                <article class="tab-content p-b-20 m-t-50">

                                    <!-- General Detail Starts -->
                                     <div class="map_canvas"></div>
                                    
                                    <section class="tab-pane fade in active" id="general">

                                        <article class="detailbox">
                                            <div class="bg-white mi-form-section">

                                                <!-- Table Section End -->
                                                <aside class="clearfix m-t-20 setting">
                                                    <div class="col-md-8">
                                                        <h4>Pharmacy Details 
                                                         <a id="edit" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                                                        </h4>
                                                        <hr/>
                                                        <aside id="detail" style="display: <?php echo $detailShow;?>;">
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Pharmacy Name :</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"> <?php echo $pharmacyData[0]->pharmacy_name;?> </p>
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Pharmacy Type :</label>
                                                                     <p class="col-md-8 col-sm-8 t-xs-left"> <?php echo $pharmacyData[0]->pharmacy_type;?> </p> 
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Address :</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"><?php if(isset($pharmacyData[0]->pharmacy_address)){ echo $pharmacyData[0]->pharmacy_address; }?> </p>
                                                            </article>

                                                            <article class="clearfix m-b-10 ">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                <aside class="col-md-8 col-sm-8 text-right t-xs-left">
                                                                    <?php 
                                                                    $explode= explode('|',$pharmacyData[0]->pharmacy_phn); 
                                                                    for($i= 0; $i< count($explode);$i++){?>
                                                                    <p>+<?php echo $explode[$i];?></p>
                                                                   
                                                                    <?php }?>
                                                                    <!-- <p>+91-011-123456</p>
                                                                    <p>+91-011-123456</p>
                                                                    <p>+91-011-123456</p> -->
                                                                </aside>
                                                            </article>
                                                            
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Email Id :</label>
                                                                <p class="col-md-8  col-sm-8 text-right t-xs-left"> <?php echo $pharmacyData[0]->users_email;?> </p>
                                                            </article>
                                                            
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person:</label>
                                                                <p class="col-md-8  col-sm-8 text-right t-xs-left"> <?php if(isset($pharmacyData[0]->pharmacy_cntPrsn)){ echo $pharmacyData[0]->pharmacy_cntPrsn; }?> </p>
                                                            </article>
                                                             <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Membership Type:</label>
                                                                <p class="col-md-8  col-sm-8 text-right t-xs-left"> <?php if(isset($pharmacyData[0]->pharmacy_mmbrTyp)){ echo $pharmacyData[0]->pharmacy_mmbrTyp; }?> </p>
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">24/7 Service - Yes/No:</label>
                                                                <p class="col-md-8  col-sm-8 text-right t-xs-left"> <?php if(isset($pharmacyData[0]->pharmacy_27Src)){ echo $pharmacyData[0]->pharmacy_27Src; }?> </p>
                                                            </article>
                                                        </aside>
                                                        <!--edit-->
                                                         <form name="pharmacyDetail" action="<?php echo site_url(); ?>/pharmacy/saveDetailPharmacy/<?php echo $pharmacyId; ?>" id="pharmacyDetail" method="post">
                                                        <aside id="newDetail" style="display:<?php echo $showStatus;?>;">
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Pharmacy Name :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <input class="form-control" id="pharmacy_name" name="pharmacy_name" type="text" value="<?php echo $pharmacyData[0]->pharmacy_name;?>">
                                                                     <label class="error" style="display:none;" id="error-pharmacy_name"> please enter pharmacy name</label>
                                                                    <label class="error" > <?php echo form_error("pharmacy_name"); ?></label>
                                                                </div>
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Pharmacy Type :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <select class="selectpicker" data-width="100%" name="pharmacy_type">
                                                                        <option value="1" <?php if($pharmacyData[0]->pharmacy_type == "Medicine") { echo 'selected';}?>>Medicine</option>
                                                                        <option value="2" <?php if($pharmacyData[0]->pharmacy_type == "Homyopathic") { echo 'selected';}?>>Homyopathic</option>
                                                                        <option value="3" <?php if($pharmacyData[0]->pharmacy_type == "Herbal") { echo 'selected';}?>>Herbal</option>
                                                                    </select>
                                                                   
                                                                    <!--<input class="form-control" id="pharmacy_type" name="pharmacy_type" type="text" value="<?php echo $pharmacyData[0]->pharmacy_type;?>">-->
                                                                    <label class="error" > <?php echo form_error("pharmacy_type"); ?></label>
                                                                </div>
                                                            </article>
                                                         
                                                            
                                                          <article class="clearfix m-b-10">
                                                             <label for="cemail" class="control-label col-md-4 col-sm-4">Address:</label>
                                                             <div class="col-md-8 col-sm-8">
                                                                 <aside class="row">
                                                                     <div class="col-md-6 col-sm-6">
                                                                         <select class="selectpicker" data-width="100%" name="pharmacy_countryId">
                                                                             <option>Select Country</option>
                                                                             <?php if(!empty($allCountry)):
                                                                                    foreach($allCountry as $country):?>
                                                                                
                                                                                    <option value="<?php echo $country->country_id;?>" <?php if($pharmacyData[0]->pharmacy_countryId == $country->country_id):echo"selected";endif;?>><?php echo $country->country;?></option>
                                                                             <?php endforeach;endif;?>
                                                                         </select>
                                                                         <label class="error" style="display:none;" id="error-pharmacy_countryId"> please select a country</label>
                                                                         <label class="error" > <?php echo form_error("pharmacy_countryId"); ?></label>
                                                                     </div>
                                                                     <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                                            <select class="selectpicker" data-width="100%" name="pharmacy_stateId" onchange ="fetchCity(this.value)" id="pharmacy_stateId">
                                                                                <?php foreach($allStates as $key=>$val) {?>
                                                                                  <option <?php if($pharmacyData[0]->pharmacy_stateId == $val->state_id):echo"selected";endif;?> value="<?php echo $val->state_id;?>"><?php echo $val->state_statename;?></option>
                                                                                 <?php }?>
                                                                              
                                                                                
       </select>
                                                                     </div>
                                                                 </aside>
                                                                 <aside class="row m-t-10">
                                                                     <div class="col-md-6 col-sm-6">
                                                                         
                                                                         <select class="selectpicker" data-width="100%" name="pharmacy_cityId" id="pharmacy_cityId">
                                                                              <?php foreach($allCities as $key=>$val) {?>
                                                                                <option <?php if($pharmacyData[0]->pharmacy_cityId == $val->city_id):echo"selected";endif;?> value="<?php echo $val->city_id;?>"><?php echo $val->city_name;?></option>
                                                                              <?php }?>

                                                                            </select>
                                                                      <label class="error" style="display:none;" id="error-diagnostic_cityId"> please select a city</label>
                                                                       <label class="error" > <?php echo form_error("pharmacy_cityId"); ?></label>
                                                                     </div>
                                                                     <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                                         <input type="text" class="form-control" id="pharmacy_zip" name="pharmacy_zip" placeholder="700001" maxlength="6"  value="<?php if(!empty($pharmacyData)): echo $pharmacyData[0]->pharmacy_zip; endif;?>" onkeypress="return isNumberKey(event)"/>
                                                                             <label class="error" style="display:none;" id="error-pharmacy_zip"> please enter a zip code</label>

                                                                            <label class="error" id="error-pharmacy_zip1"  > <?php echo form_error("pharmacy_zip"); ?></label>
                                                                     </div>
                                                                 </aside>
                                                                 <div class="clearfix m-t-10">
                                                                      <input type="text" class="form-control" id="geocomplete" name="pharmacy_address" type="text" value="<?php if(isset($pharmacyData[0]->pharmacy_address)){ echo $pharmacyData[0]->pharmacy_address; }?>" >
                                                                    <label class="error" > <?php echo form_error("pharmacy_address"); ?></label>
                                                                 </div>
                                                             </div>
                                                         </article>

                                                            <article class="clearfix m-b-10 ">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <?php 
                                                                    $explodes= explode('|',$pharmacyData[0]->pharmacy_phn); 
                                                                    if(!empty($explodes)){
                                                                    for($i= 0; $i< count($explodes);$i++){
                                                                    $moreExpolde = explode(' ',$explodes[$i]);?>
                                                                    
                                                                    
                                                                    <aside class="row">
                                                                        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-12">
                                                                            <select class="selectpicker" data-width="100%" name="pre_number[]">
                                                                                <option value="91" <?php if($moreExpolde[0] == '91'){ echo 'selected';}?>>+91</option>
                                                                                <option value="1" <?php if($moreExpolde[0] == '1'){ echo 'selected';}?>>+1</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-10 m-t-xs-10">
                                                                            <input type="text" class="form-control" name="pharmacy_phn[]" id="pharmacy_phn<?php echo $i;?>" placeholder="9837000123" value="<?php echo $moreExpolde[1];?>" maxlength="10" onkeypress="return isNumberKey(event)"/>
                                                                        </div>
                                                                       
                                                                    </aside>
                                                                    <br />
                                                                    <?php $moreExpolde ='';} }?>
                                                               
                                                                    <p class="m-t-10">* If it is landline, include Std code with number </p>
                                                                </div>
                                                            </article>
                                                            
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Email Id :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                 <input class="form-control" id="users_email" name="users_email" type="email" value="<?php echo $pharmacyData[0]->users_email;?>" onblur="checkEmailFormat()" />
                                                                  <label class="error" style="display:none;" id="error-users_email_check"> Email Already Exists!</label>
                                                                <label class="error" > <?php echo form_error("users_email"); ?></label>
                                                                </div>
                                                            </article>
                                    
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person:</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                 
                                                                    <input class="form-control" id="pharmacy_cntPrsn" name="pharmacy_cntPrsn" type="text" value="<?php if(isset($pharmacyData[0]->pharmacy_cntPrsn)){ echo $pharmacyData[0]->pharmacy_cntPrsn; }?>">
                                                           <label class="error" > <?php echo form_error("pharmacy_cntPrsn"); ?></label>
                                                           </div>    
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Membership Type:</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <select class="selectpicker" data-width="100%" name="pharmacy_mmbrTyp" id="pharmacy_mmbrTyp">
                                                                        <option value="1" <?php if($pharmacyData[0]->pharmacy_mmbrTyp == "Life Time" ) { echo 'selected';}?>>Life Time</option>
                                                                        <option value="2" <?php if($pharmacyData[0]->pharmacy_mmbrTyp == "Health Club" ) { echo 'selected';}?>>Health Club</option>
                                                                    </select>
                                                                    <!--<input class="form-control" id="pharmacy_mmbrTyp" name="pharmacy_mmbrTyp" type="text" value="<?php if(isset($pharmacyData[0]->pharmacy_mmbrTyp)){ echo $pharmacyData[0]->pharmacy_mmbrTyp; }?>">-->
                                                           <label class="error" > <?php echo form_error("pharmacy_mmbrTyp"); ?></label>
                                                           </div>    
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">24/7 Service - Yes/No:</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                <aside class="radio radio-info radio-inline">
                                                                  <input type="radio" id="isEmergency_yes" value="1" name="isEmergency"  <?php if($pharmacyData[0]->pharmacy_27Src == "Yes") { echo 'checked';}?>>
                                                                    <label for="inlineRadio1"> Yes</label>
                                                                </aside>
                                                                <aside class="radio radio-info radio-inline">
                                                                    <input type="radio" id="isEmergency_no" value="0" name="isEmergency" <?php if($pharmacyData[0]->pharmacy_27Src == "No" ) { echo 'checked';}?>>
                                                                        <label for="inlineRadio2"> No</label>
                                                                </aside>
                                                                 <!--   <input class="form-control" id="pharmacy_27Src" name="pharmacy_27Src" type="text" value="<?php if(isset($pharmacyData[0]->pharmacy_27Src)){ echo $pharmacyData[0]->pharmacy_27Src; }?>">-->
                                                           <label class="error" > <?php echo form_error("pharmacy_27Src"); ?></label>
                                                           </div>    
                                                            </article>
                                                             <article class="clearfix m-b-10">

                                                              <div class="col-md-12">
                                                              <button type="submit" class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" onclick="return validationPharmacyDetail();">Update</button>
                                                              </div>

                                                             </article>
                                                        </aside>
                                                             <fieldset>
                           
                                                                <input name="lat" type="hidden" value="<?php echo $pharmacyData[0]->pharmacy_lat;?>">

                                                               <!-- <label>Longitude</label> -->
                                                                <input name="lng" type="hidden" value="<?php echo $pharmacyData[0]->pharmacy_long;?>">
                                                                <input name="user_tables_id" id="user_tables_id" type="hidden" value="<?php echo $pharmacyData[0]->users_id;?>">
                                                             </fieldset>  
                                                        </form>  
                                                    </div>

                                                </aside>
                                            </div>
                                        </article>
                                    </section>       
                                   
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
</body>

</html>
