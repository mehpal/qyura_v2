<!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container row">
                    <!-- consultation -->

                    <div style="display:show;" id="consultDiv">
                        <div class="clearfix">
                            <div class="col-md-12">
                                <h3 class="pull-left page-title">Edit Medicart Offer</h3>

                            </div>
                   
                        </div>

                        <form class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" name="submitForm" method="post" action="<?php echo site_url(); ?>/medicart/saveEditOffer" novalidate="novalidate" enctype="multipart/form-data">
     
                          
                            <input type="hidden" name="offerId" value="<?php if(isset($offerData) && !empty($offerData)){echo $offerData->medicartOffer_id; }?>" />
                            <!-- Left Section Start -->
                            <section class="col-md-6 detailbox">
                                <div class="bg-white mi-form-section">
                                    <figure class="clearfix">
                                        <h3>General Detail</h3>
                                    </figure>
                                    <!-- Table Section End -->
                                    <div class="clearfix m-t-20">
                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">City:</label>
                                            <div class="col-md-8 col-sm-8">
                       <?php $city =0;if(isset($offerData) && !empty($offerData)){$city = $offerData->medicartOffer_cityId;}?>
                                                <select class="" data-width="100%" name="medicartOffer_cityId" id="cityId" required="">
                                                  <option value="">Select City</option>
                                                    <?php foreach ($allCity as $key => $val) { ?>
                                                        <option value="<?php echo $val->city_id; ?>" <?php if($val->city_id == $city): echo"selected";endif;?>><?php echo $val->city_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label class="error"><?php echo form_error('medicartOffer_cityId'); ?></label>
                                            </div>
                                        </article>
                                  <article class="form-group m-lr-0 ">
                                    <label class="control-label col-md-4 col-sm-4">MI Type :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <select class="" data-width="100%" name="miType" onchange ="getMIList(this.value, medicartOffer_cityId.value)" id="miType" required="">
                                            <option value=""> Select MI Type</option>
                                            <option <?php if($offerData->miType == 1): echo"selected";endif;?>>Diagnostic</option>
                                            <option <?php if($offerData->miType == 2): echo"selected";endif;?>>Hospital</option>
                                           
                                        </select>
                                    <label class="error"><?php echo form_error('miType'); ?></label>
                                    </div>
                                </article>

                                        <article class="form-group m-lr-0 ">
                                            <label for="cemail" class="control-label col-md-4 col-sm-4">MI Name:</label>
                                            <div class="col-md-8 col-sm-8">
                                                <select class="" data-width="100%" name="medicartOffer_MIId" id="miName" onchange="getMemberShipDuTime(this.value)">
<!--                                                    <option value="<?php //echo $offerData->miId; ?>"><?php //echo $offerData->MIname; ?></option>-->
                                                    <?php if(!empty($options)){echo $options;}?>
                                                </select>
                                                 <label class="error"><?php echo form_error('medicartOffer_MIId'); ?></label>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0 ">
                                            <label for="cemail" class="control-label col-md-4 col-sm-4">Offer Id :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control disabled" id="medicartOffer_OfferId" name="medicartOffer_OfferId" type="disabled" required="" aria-required="true" placeholder="" value="<?php if(isset($offerData) && !empty($offerData)){echo $offerData->medicartOffer_OfferId;} ?>" readonly="" >
                                                 <label class="error"><?php echo form_error('medicartOffer_OfferId'); ?></label>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Offer Specialities:</label>
                                            <div class="col-md-8 col-sm-8">
                                                <?php $cat =0;if(isset($offerData) && !empty($offerData)){$cat = $offerData->medicartOffer_offerCategory;}?>
                                                <select class="select2" data-width="100%" name="medicartOffer_offerCategory[]"id="medicartOffer_offerCategory" required="" multiple="">
                                                    <?php foreach ($allOffetCategory as $keys => $values) { ?>
                                                        <option value="<?php echo $values->specialities_id; ?>" <?php if(isset($qyura_medicartSpecialities) && $qyura_medicartSpecialities != NULL){ if(in_array($values->specialities_id, $qyura_medicartSpecialities)){ echo "selected";} } ?>><?php echo ucwords($values->specialities_name); ?></option>
                                                    <?php } ?>
                                                </select>
                                                 <label class="error"><?php echo form_error('medicartOffer_offerCategory'); ?></label>
                                            </div>
                                        </article>
                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Title :</label>
                                            
                                            <div class="col-md-8 col-sm-8">
                                               
                                                <input class="form-control " type="text" name="medicartOffer_title" required="" id="medicartOffer_title" value="<?php if(isset($offerData) && !empty($offerData)){ echo $offerData->medicartOffer_title;} ?>">
                                                 <label class="error"><?php echo form_error('medicartOffer_title'); ?></label>
                                                </div>
                                             
                                               
                                        </article>

                                        
<!--                                        <article class="form-group m-lr-0 ">
                                            <label class="control-label col-md-4 col-sm-4" for="cemail">Image:</label>
                                            <div class="col-md-8 col-sm-8 text-right avatar-view">
                                                <input id="uploadFile" class="showUpload" disabled="disabled" />
                                                <div class="fileUpload btn btn-sm btn-upload">
                                                    <span><i class="fa fa-cloud-upload fa-3x "></i></span>
                                                    <input id="uploadBtn12" type="file" class="upload123" />
                                                </div>
                                                <img src="<?php //if(!empty($offerData) && !empty($offerData->medicartOffer_image)):echo base_url().$offerData->medicartOffer_image; else: echo base_url().'assets/default-images/Emerg-logo.png'; endif; ?>" alt=" " class="img-responsive image-preview-show" width="180"/>
                                                <label class="error"><?php //echo form_error('avatar_file'); ?></label>
                                                 <label class="error"><?php //echo $this->session->flashdata('valid_upload'); ?></label>
                                                
                                            </div>
                                        </article>-->
                                                 <article class="form-group m-lr-0 " id="crop-avatar"><div id="upload_modal_form">
                            <?php $this->load->view('upload_crop_modal');?>
                        </div>
                                        
                                            
                                                    <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Image :</label>
                                
                                <div class="col-md-8 col-sm-8" data-target="#modal" data-toggle="modal">
                                    <label class="col-md-4 col-sm-4" for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x avatar-view"></i></label>

                                    <div class="pre col-md-4 col-sm-4 ">
                                    <div id="preImgLogo" class="avatar-preview preview-md preImgLogo">
                                        
                                      <img src="<?php if(!empty($offerData) && !empty($offerData->medicartOffer_image)):echo base_url().$offerData->medicartOffer_image; else: echo base_url().'assets/default-images/Emerg-logo.png'; endif; ?>" alt=" " class="img-responsive image-preview-show" width="180"/>
                                        
                                    </div>
                                    </div>

                                    <label class="error" > <?php echo form_error("avatar_file"); ?></label>
                                    <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                                    
                                    
                                    
                                </div>
                                                       
                                        </article>
                                        
                                        

                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Description :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <textarea class="form-control" type="text" name="medicartOffer_description" required="" id="medicartOffer_description" rows="4"><?php if(isset($offerData) && !empty($offerData)){ echo $offerData->medicartOffer_description;}?></textarea>
                                                 <label class="error"><?php echo form_error('medicartOffer_description'); ?></label>
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
                                    <!-- Other Info Start -->

                                    <figure class="clearfix">
                                        <h3>Other Information</h3>
                                    </figure>
                                    <aside class="clearfix m-t-20">

	 <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Publish Duration:</label>
                                            <div class="col-md-8 col-sm-8">
                                                <aside class="row">
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="input-group">
                                                            <input class="form-control pickDate" id="date-1" type="text" name="medicartOffer_startDate" placeholder="Date To" onkeydown="return false;" value="<?php if(isset($offerData) && !empty($offerData)){ echo date('m/d/Y',$offerData->medicartOffer_startDate);}?>" autocomplete="off">
                                                             <label class="error"><?php echo form_error('medicartOffer_startDate'); ?></label>
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                        </div>
                                                          <div class="error" id="error_sd"></div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                        <div class="input-group">
                                                    <input type="hidden" id="offerDuration" name="offerDuration" value="<?php if(isset($membershipData) && !empty($membershipData)){ echo $membershipData[0]->miMembership_duration;}else{echo 0;}?>"/>
                                                            <input class="form-control pickDates" id="date-2" type="text" name="medicartOffer_endDate" placeholder="Date From" onkeydown="return false;" value="<?php if(isset($offerData) && !empty($offerData)){ echo date('m/d/Y',$offerData->medicartOffer_endDate);}?>" autocomplete="off">
                                                             <label class="error"><?php echo form_error('medicartOffer_endDate'); ?></label>
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                        </div>
                                                           <div class="error" id="error_ed"></div>
                                                    </div>
                                                    
                                                </aside>
                                                <label id="date_error" class="error"></label>
                                            </div>
                                        </article>

<!--     <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Range :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <div class="radio radio-success radio-inline">
                                      <input type="radio"  name="medicartOffer_range" value="5" id="inlineRadio1" <?php if(isset($offerData) && !empty($offerData) && $offerData->medicartOffer_range == "5"){echo "checked";}?>>
                                            <label for="inlineRadio1">5 KM</label>
                                        </div>
                                        <div class="radio radio-success radio-inline">
                                       <input type="radio" name="medicartOffer_range" value="10" id="inlineRadio1" <?php if(isset($offerData) && !empty($offerData) && $offerData->medicartOffer_range == "10"){echo "checked";}?>>

                                            <label for="inlineRadio2">10 KM</label>
                                        </div>
                                           <div class="radio radio-success radio-inline">
                                       <input type="radio" name="medicartOffer_range" value="15" id="inlineRadio1" <?php if(isset($offerData) && !empty($offerData) && $offerData->medicartOffer_range == "15"){echo "checked";}?>>

                                            <label for="inlineRadio2">15 KM</label>
                                        </div>
                                           <div class="radio radio-success radio-inline">
                                       <input type="radio" name="medicartOffer_range" value="0" id="inlineRadio1" <?php if(isset($offerData) && !empty($offerData) && $offerData->medicartOffer_range == "0"){echo "checked";}?>>

                                            <label for="inlineRadio2">All</label>
                                        </div>
                                    </div>
                               </article>-->
<input type="hidden" name="medicartOffer_range" value="0" id="inlineRadio1" >


                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Allow Booking ?</label>
                                            <div class="col-md-8 col-sm-8">
                                                <div class="radio radio-success radio-inline">
                                                    <input type="radio" checked="" name="medicartOffer_allowBooking" value="1" id="inlineRadio1" <?php if(isset($offerData) && !empty($offerData)){ if($offerData->medicartOffer_allowBooking == 1){ echo 'checked'; }}?> onClick="IsallowBooking(this.value)">
                                                    <label for="inlineRadio1">Yes</label>
                                                </div>
                                                <div class="radio radio-success radio-inline">
                                                    <input type="radio" name="medicartOffer_allowBooking" value="0" id="inlineRadio2" <?php if(isset($offerData) && !empty($offerData)){ if($offerData->medicartOffer_allowBooking == 0){ echo 'checked'; }}?> onClick="IsallowBooking(this.value)">
                                                    <label for="inlineRadio2">No</label>
                                                </div>
                                            </div>
                                        </article>
					<div  <?php if(isset($offerData) && !empty($offerData)){ if($offerData->medicartOffer_allowBooking == 0){ echo 'style="display:none"'; }}?> id="maximunBooking">

                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Maximum Booking Limit </label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control " id="medicartOffer_maximumBooking" type="text" name="medicartOffer_maximumBooking" required="" value="<?php if(isset($offerData) && !empty($offerData)){ echo $offerData->medicartOffer_maximumBooking; } ?>" onkeypress="return isNumberKey(event)">
                                                 <label class="error"><?php echo form_error('medicartOffer_maximumBooking'); ?></label>
                                            </div>
                                        </article>
                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Actual Pricing :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control " id="medicartOffer_actualPrice" type="text" name="medicartOffer_actualPrice" placeholder="" value="<?php if(isset($offerData) && !empty($offerData)){ echo round($offerData->medicartOffer_actualPrice);}?>" onchange="isCalculate()" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" >
                                                 <label class="error"><?php echo form_error('medicartOffer_actualPrice'); ?></label>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Discount Offer :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <div class="radio radio-success radio-inline">
                                                    <input type="radio" checked="" name="medicartOffer_discount" value="1" id="inlineRadio3" <?php if(isset($offerData) && !empty($offerData)){ if($offerData->medicartOffer_discount == 1){ echo 'checked'; }}?> required="" onclick="IsallowDiscount(this.value)">
                                                    <label for="inlineRadio3">Yes</label>
                                                </div>
                                                <div class="radio radio-success radio-inline">
                                                    <input type="radio" name="medicartOffer_discount" value="0"  <?php if(isset($offerData) && !empty($offerData)){ if($offerData->medicartOffer_discount == 0){ echo 'checked'; }}?> id="inlineRadio4" onclick="IsallowDiscount(this.value)">
                                                    <label for="inlineRadio4">No</label>
                                                </div>
                                            </div>
                                        </article>
                                        <div id="discountOffer" <?php if(isset($offerData) && !empty($offerData)){ if($offerData->medicartOffer_discount == 0){ echo 'style="display:none"'; }}?>>
                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Discount for Age Group :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <select class="selectpicker" data-width="100%" name="medicartOffer_ageDiscount" id="medicartOffer_ageDiscount" required="">
                                                    <option <?php if(isset($offerData) && !empty($offerData)){ if($offerData->medicartOffer_ageDiscount == "0-10"){ echo "selected"; }}?> value="0-10">0-10</option>
                                                    <option <?php if(isset($offerData) && !empty($offerData)){ if($offerData->medicartOffer_ageDiscount == "10-20"){ echo "selected"; }}?> value="10-20">10-20</option>
                                                    <option <?php if(isset($offerData) && !empty($offerData)){ if($offerData->medicartOffer_ageDiscount == "20-30"){ echo "selected"; }}?> value="20-30">20-30</option>
                                                    <option <?php if(isset($offerData) && !empty($offerData)){ if($offerData->medicartOffer_ageDiscount == "30-40"){ echo "selected"; }}?> value="30-40">30-40</option>
                                                    <option <?php if(isset($offerData) && !empty($offerData)){ if($offerData->medicartOffer_ageDiscount == "40-50"){ echo "selected"; }}?>  value="40-50">40-50</option>
                                                    <option <?php if(isset($offerData) && !empty($offerData)){ if($offerData->medicartOffer_ageDiscount == "50-60"){ echo "selected"; }}?> value="50-60">50-60</option>
                                                    <option <?php if(isset($offerData) && !empty($offerData)){ if($offerData->medicartOffer_ageDiscount == "60-70"){ echo "selected"; }}?> value="60-70">60-70</option>
                                                    <option <?php if(isset($offerData) && !empty($offerData)){ if($offerData->medicartOffer_ageDiscount == "70-80"){ echo "selected"; }}?> value="70-80">70-80</option>
                                                    <option <?php if(isset($offerData) && !empty($offerData)){ if($offerData->medicartOffer_ageDiscount == "80-90"){ echo "selected"; }}?> value="80-90">80-90</option>
                                                    <option <?php if(isset($offerData) && !empty($offerData)){ if($offerData->medicartOffer_ageDiscount == "90-100"){ echo "selected"; }}?> value="90-100">90-100</option>
                                                    <option <?php if(isset($offerData) && !empty($offerData)){ if($offerData->medicartOffer_ageDiscount == "0-100"){ echo "selected"; }}?> value="0-100">0-100</option>
                                                </select>
                                                 <label class="error"><?php echo form_error('medicartOffer_ageDiscount'); ?></label>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Discounted % :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control " id="medicartOffer_discountPrice" type="text" name="medicartOffer_discountPrice" required="" placeholder="" value="<?php if(isset($offerData) && !empty($offerData)){ echo round($offerData->medicartOffer_discountPrice);}?>" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" onchange="isCalculate()">
                                                 <label class="error"><?php echo form_error('medicartOffer_discountPrice'); ?></label>
                                            </div>
                                        </article>
                                            
                                             <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Total price :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control " id="medicartOffer_totalPrice" type="text" name="medicartOffer_totalPrice" required="" placeholder="" value="<?php if(isset($offerData) && !empty($offerData)){echo round($offerData->medicartOffer_totalPrice);}?>" onkeypress="return isNumberKey(event)" readonly="">
                                                 <label class="error"><?php echo form_error('medicartOffer_totalPrice'); ?></label>
                                            </div>
                                        </article>
                                         </div>    
                                        <!-- Other Info Section End -->
                              	</div>
                                </div>
                                
                               
                            </section>
                            
                         
                            
                            <section class="clearfix ">
                                <div class="col-md-12 m-t-20 m-b-20">
                                   
                                    <button type="submit" class="btn btn-success waves-effect waves-light pull-right m-r-20">Update</button>
                                </div>

                            </section>
                        </form>

                    </div>

                    <!-- consultation -->



                    <!-- Right Section End -->

                </div>

                <!-- container -->
            </div>
           
