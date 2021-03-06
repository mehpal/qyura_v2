<!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container row">
                    <!-- consultation -->

                    <div style="display:show;" id="consultDiv">
                        <div class="clearfix">
                            <div class="col-md-12">
                                <h3 class="pull-left page-title">Add New Medicart Offer</h3>

                            </div>
                   
                        </div>

                        <form class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" name="submitForm" method="post" action="<?php echo site_url(); ?>/medicart/saveOffer" novalidate="novalidate" enctype="multipart/form-data">
     
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
                                                <select class="selectepicker2" data-width="100%" name="medicartOffer_cityId" id="cityId" required="">
                                                  <option value="">Select City</option>
                                                    <?php foreach ($allCity as $key => $val) { ?>
                                                        <option value="<?php echo $val->city_id; ?>" <?php echo set_select('medicartOffer_cityId', $val->city_id); ?>><?php echo $val->city_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label class="error"><?php echo form_error('medicartOffer_cityId'); ?></label>
                                            </div>
                                        </article>
                                  <article class="form-group m-lr-0 ">
                                    <label class="control-label col-md-4 col-sm-4">MI Type :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <select class="selectepicker2" data-width="100%" name="miType" onchange ="getMIList(this.value, medicartOffer_cityId.value)" id="miType" required="">
                                            <option value=""> Select MI Type</option>
                                            <option <?php echo set_select('miType', 'Diagnostic'); ?>>Diagnostic</option>
                                            <option <?php echo set_select('miType', 'Hospital'); ?>>Hospital</option>
                                            
                                        </select>
                                    <label class="error"><?php echo form_error('miType'); ?></label>
                                    </div>
                                </article>

                                        <article class="form-group m-lr-0 ">
                                            <label for="cemail" class="control-label col-md-4 col-sm-4">MI Name:</label>
                                            <div class="col-md-8 col-sm-8">
                                                <select class="selectepicker2" data-width="100%" name="medicartOffer_MIId" id="miName" onchange="getMemberShipDuTime(this.value)">
                                                </select>
                                                 <label class="error"><?php echo form_error('medicartOffer_MIId'); ?></label>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0 ">
                                            <label for="cemail" class="control-label col-md-4 col-sm-4">Offer Id :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control disabled" id="medicartOffer_OfferId" name="medicartOffer_OfferId" type="disabled" required="" aria-required="true" placeholder="" value="<?php echo $uniqueId;?>" readonly="" >
                                                 <label class="error"><?php echo form_error('medicartOffer_OfferId'); ?></label>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Offer Specialities:</label>
                                            <div class="col-md-8 col-sm-8">
                                                <select class="select2" data-width="100%" name="medicartOffer_offerCategory[]"id="medicartOffer_offerCategory" required="" multiple="">
                                                        <?php foreach ($allOffetCategory as $keys => $values) { ?>
                                                        <option value="<?php echo $values->specialities_id; ?>" <?php echo set_select('medicartOffer_offerCategory[]', $values->specialities_id); ?>><?php echo ucwords($values->specialities_name); ?></option>
                                                    <?php } ?>
                                                </select>
                                                 <label class="error"><?php echo form_error('medicartOffer_offerCategory[]'); ?></label>
                                                 <div class="error" id="medicart_speciality_error"></div>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Title :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control " type="text" name="medicartOffer_title" required="" id="medicartOffer_title" value="<?=set_value('medicartOffer_title');?>">
                                                 <label class="error"><?php echo form_error('medicartOffer_title'); ?></label>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0 " id="crop-avatar"><div id="upload_modal_form">
                            <?php $this->load->view('upload_crop_modal');?>
                        </div>
                                        
                                            
                                                    <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Image :</label>
                                
                                <div class="col-md-8 col-sm-8" data-target="#modal" data-toggle="modal">
                                    <label class="col-md-4 col-sm-4" for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x avatar-view"></i></label>

                                    <div class="pre col-md-4 col-sm-4 ">
                                    <div id="preImgLogo" class="avatar-preview preview-md preImgLogo">
                                        
                                     <img src="<?php echo base_url() ?>assets/default-images/Emerg-logo.png"  class="image-preview-show"/>
                                        
                                    </div>
                                    </div>
                                    <div class="error" id="file_error"></div>
                                    <label class="error"> <?php echo form_error("avatar_file"); ?></label>
                                    <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                                    
                                    
                                    
                                </div>
                                                       
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Description :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <textarea class="form-control" type="text" name="medicartOffer_description" required="" id="medicartOffer_description" rows="4"><?php echo set_value('medicartOffer_description');?></textarea>
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
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Publish Duration :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <aside class="row">
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="input-group">
                                                            <input class="form-control pickDate" id="date-1" type="text" name="medicartOffer_startDate" placeholder="Date From" onkeydown="return false;" value="<?=set_value('medicartOffer_startDate');?>" autocomplete="off">
                                                             <label class="error"><?php echo form_error('medicartOffer_startDate'); ?></label>
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                           
                                                        </div>
                                                         <div class="error" id="error_sd"></div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                        <div class="input-group">
                                                            <input type="hidden" id="offerDuration" name="offerDuration" value="0"/>
                                                            <input class="form-control pickDates" id="date-2" type="text" name="medicartOffer_endDate" placeholder="Date To" readonly="" onkeydown="return false;" value="<?=set_value('medicartOffer_endDate');?>" autocomplete="off">
                                                             <label class="error"><?php echo form_error('medicartOffer_endDate'); ?></label>
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                            
                                                        </div>
                                                        <div class="error" id="error_ed"></div>
                                                    </div>
                                                </aside>
                                                <label id="date_error" class="error"></label>
                                            </div>
                                        </article>

<!--				       <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Range :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <div class="radio radio-success radio-inline">
                                              <input type="radio" checked="" name="medicartOffer_range" value="5" id="inlineRadio1" <?php echo set_radio('medicartOffer_range', '5 KM'); ?>>
                                                    <label for="inlineRadio1">5 KM</label>
                                                </div>
                                                <div class="radio radio-success radio-inline">
                                               <input type="radio" name="medicartOffer_range" value="10" id="inlineRadio1" <?php echo set_radio('medicartOffer_range', '10 KM'); ?>>
                                               
                                                    <label for="inlineRadio2">10 KM</label>
                                                </div>
                                                   <div class="radio radio-success radio-inline">
                                               <input type="radio" name="medicartOffer_range" value="15" id="inlineRadio1" <?php echo set_radio('medicartOffer_range', '15 KM'); ?>>
                                               
                                                    <label for="inlineRadio2">15 KM</label>
                                                </div>
                                                   <div class="radio radio-success radio-inline">
                                               <input type="radio" name="medicartOffer_range" value="0" id="inlineRadio1" <?php echo set_radio('medicartOffer_range', 'all'); ?>>
                                               
                                                    <label for="inlineRadio2">All</label>
                                                </div>
                                            </div>
                                        </article>-->
<input type="hidden" name="medicartOffer_range" value="0" id="inlineRadio1" >



                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Allow Booking ?</label>
                                            <div class="col-md-8 col-sm-8">
                                                <div class="radio radio-success radio-inline">
                                                    <input type="radio"  name="medicartOffer_allowBooking" value="1" id="inlineRadio1" onClick="IsallowBooking(this.value)" <?php echo set_radio('medicartOffer_allowBooking', '1'); ?>>
                                                    <label for="inlineRadio1">Yes</label>
                                                </div>
                                                <div class="radio radio-success radio-inline">
                                                    <input type="radio" checked="" name="medicartOffer_allowBooking" value="0" id="inlineRadio2" onClick="IsallowBooking(this.value)" <?php echo set_radio('medicartOffer_allowBooking', '0'); ?>>
                                                    <label for="inlineRadio2">No</label>
                                                </div>
                                            </div>
                                        </article>


					<div style="display:none" id="maximunBooking">
                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Maximum Booking Limit :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control " id="medicartOffer_maximumBooking" type="text" name="medicartOffer_maximumBooking" required="" value="<?=set_value('medicartOffer_maximumBooking','1');?>" onkeypress="return isNumberKey(event)">
                                                 <label class="error"><?php echo form_error('medicartOffer_maximumBooking'); ?></label>
                                            </div>
                                        </article>
                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Actual Pricing :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control " id="medicartOffer_actualPrice" type="text" name="medicartOffer_actualPrice" placeholder="" value="<?=set_value('medicartOffer_actualPrice');?>"  onchange="isCalculate()" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                                 <label class="error"><?php echo form_error('medicartOffer_actualPrice'); ?></label>
                                            </div>
                                        </article>
                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Discount Offer :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <div class="radio radio-success radio-inline">
                                                    <input type="radio"  name="medicartOffer_discount" value="1" id="inlineRadio3" required="" onclick="IsallowDiscount(this.value)" <?php echo set_radio('medicartOffer_discount', '1'); ?>>
                                                    <label for="inlineRadio3">Yes</label>
                                                </div>
                                                <div class="radio radio-success radio-inline">
                                                    <input type="radio" checked="" name="medicartOffer_discount" value="0" id="inlineRadio4" onclick="IsallowDiscount(this.value)" <?php echo set_radio('medicartOffer_discount', '0'); ?>>
                                                    <label for="inlineRadio4">No</label>
                                                </div>
                                            </div>
                                        </article>
                                        <div  style="display:none" id="discountOffer">
                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Discount for Age Group :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <select class="selectpicker" data-width="100%" name="medicartOffer_ageDiscount" id="medicartOffer_ageDiscount" required="">
                                                    <option value="0-10" <?php echo set_select('medicartOffer_ageDiscount', '0-10'); ?>>0-10</option>
                                                    <option value="10-20" <?php echo set_select('medicartOffer_ageDiscount', '10-20'); ?>>10-20</option>
                                                    <option value="20-30" <?php echo set_select('medicartOffer_ageDiscount', '20-30'); ?>>20-30</option>
                                                    <option value="30-40" <?php echo set_select('medicartOffer_ageDiscount', '30-40'); ?>>30-40</option>
                                                    <option value="40-50" <?php echo set_select('medicartOffer_ageDiscount', '40-50'); ?>>40-50</option>
                                                    <option value="50-60" <?php echo set_select('medicartOffer_ageDiscount', '50-60'); ?>>50-60</option>
                                                    <option value="60-70" <?php echo set_select('medicartOffer_ageDiscount', '60-70'); ?>>60-70</option>
                                                    <option value="70-80" <?php echo set_select('medicartOffer_ageDiscount', '70-80'); ?>>70-80</option>
                                                    <option value="80-90" <?php echo set_select('medicartOffer_ageDiscount', '80-90'); ?>>80-90</option>
                                                    <option value="90-100" <?php echo set_select('medicartOffer_ageDiscount', '90-100'); ?>>90-100</option>
                                                      <option value="0-100" <?php echo set_select('medicartOffer_ageDiscount', '0-100'); ?>>0-100</option>
                                                </select>
                                                 <label class="error"><?php echo form_error('medicartOffer_ageDiscount'); ?></label>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Discounted % :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control " id="medicartOffer_discountPrice" type="text" name="medicartOffer_discountPrice" required="" placeholder="" value="<?=set_value('medicartOffer_discountPrice');?>" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" onchange="isCalculate()">
                                                 <label class="error"><?php echo form_error('medicartOffer_discountPrice'); ?></label>
                                            </div>
                                        </article>
                                            
                                           <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Total price :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control " id="medicartOffer_totalPrice" type="text" name="medicartOffer_totalPrice" required="" placeholder="" value="<?=set_value('medicartOffer_totalPrice');?>" onkeypress="return isNumberKey(event)" readonly="">
                                                 <label class="error"><?php echo form_error('medicartOffer_totalPrice'); ?></label>
                                            </div>
                                        </article>
                                            </div>
                                        </div>
                                        <!-- Other Info Section End -->
                                </div>
                            </section>
                            <section class="clearfix ">
                                <div class="col-md-12 m-t-20 m-b-20">
                                    <button type="reset" class="btn btn-danger waves-effect pull-right" onclick="location.reload();">Reset</button>
                                    <button type="submit" class="btn btn-success waves-effect waves-light pull-right m-r-20">Submit</button>
                                </div>
                            </section>
                      
                        </form>
                    </div>
                    <!-- consultation -->
                    <!-- Right Section End -->
                </div>
                <!-- container -->
            </div>