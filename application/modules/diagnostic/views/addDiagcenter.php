<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <div class="clearfix">
                <div class="col-md-12">
                    <h3 class="pull-left page-title">Add New Diagnostic Center</h3>

                </div>
                <div class="map_canvas"></div>
                <form class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" name="diagnosticForm" method="post" action="<?php echo site_url(); ?>/diagnostic/SaveDiagnostic" novalidate="novalidate" enctype="multipart/form-data" >
                    <input type="hidden" id="countPnone" name="countPnone" value="1" />
                    <input type="hidden" id="StateId" name="StateId" value="" />
                    <input type="hidden" id="isBloodBankOutsource" name="isBloodBankOutsource" value="0" />
                    <input type="hidden" id="isAddressDisabled" name="isAddressDisabled" value="<?php if (isset($diagno_id) && $diagno_id != 0) {
    echo 1;
} else {
    echo 0;
} ?>" />
                    <div class="col-md-12 text-success"><?php //echo $this->session->flashdata('message');  ?></div>
                    <!-- Left Section Start -->
                    <section class="col-md-6 detailbox">
                        <div class="bg-white mi-form-section">
                            <figure class="clearfix">
                                <h3>General Detail</h3>
                            </figure>
                            <!-- Table Section End -->
                            <div class="clearfix m-t-20 p-b-20">

                                <article class="clearfix m-t-10"> 
                                    <label for="cname" class="control-label col-md-4  col-sm-4">Select Name :</label>
                                    <div class="col-md-8 col-sm-8">
                                            <?php $publishDiagno[] = (object) array('diagno_id' => 0, 'diagnostic_name' => 'Other') ?>
                                        <select class="form-control selectpicker" data-width="100%" name="diagno_id" id="diagno_id" onchange="getDiagnodetail(this.value)" >
                                            <option value="">Select Diagnostice Center</option>
                                            <?php
                                            if (!empty($publishDiagno)) {

                                                foreach ($publishDiagno as $key => $val) {
                                                    ?>
                                                    <option <?php echo set_select('diagno_id', $val->diagno_id); ?> value="<?php echo $val->diagno_id; ?>"> <?php echo $val->diagnostic_name; ?></option>
    <?php
    }
}
?>
                                            <!--<option value="0">Other</option>-->
                                        </select>

                                        <label class="error" style="display:none;" id="error-diagno_id"> please select diagnostic name</label>
                                        <label class="error" > <?php echo form_error("diagno_id"); ?></label>
                                    </div>
                                </article>

                                <article class="clearfix m-t-10" style="<?php if (isset($diagno_id) && $diagno_id == 0) {
    echo 'display:block';
} else {
    echo 'display:none';
} ?>" id="diagnoName">
                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Center Name :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" id="diagnostic_name" name="diagnostic_name" type="text" required="" value="<?php echo set_value('diagnostic_name'); ?>">
                                        <label class="error" style="display:none;" id="error-diagnostic_name"> please enter diagnostic name only alphabet character's</label>
                                        <label class="error" > <?php echo form_error("diagnostic_name"); ?></label>
                                    </div>
                                </article>
                                <div id="crop-avatar">
                                <article class="clearfix m-t-10">
                                    <div id="upload_modal_form">
<?php $this->load->view('upload_crop_modal'); ?>
                        </div>
                                    <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>

                                    <div class="col-md-8 col-sm-8" data-target="#modal" data-toggle="modal">
                                        <label class="col-md-4 col-sm-4" for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x avatar-view"></i></label>

                                        <div class="pre col-md-4 col-sm-4 ">
                                            <div id="preImgLogo" class="avatar-preview preview-md preImgLogo">

                                                <img src="<?php echo base_url() ?>assets/default-images/Dignostics-logo.png"  class="image-preview-show"/>

                                            </div>
                                        </div>

                                        <label class="error" > <?php echo form_error("avatar_file"); ?></label>
                                        <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>                     

                                    </div>

                                </article>
                                </div>    
                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Address:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <select class="selectpicker form-control" data-width="100%" name="diagnostic_countryId" id="diagnostic_countryId" <?php if (isset($diagno_id) && $diagno_id != 0) {
    echo 'disabled';
} ?>>
                                            <option value=''>Select Country</option>
                                            <option value="1" <?php echo set_select('diagnostic_countryId', '1'); ?>>India</option>
                                        </select>
                                        <label class="error" style="display:none;" id="error-diagnostic_countryId"> please select a country</label>
                                        <label class="error" > <?php echo form_error("diagnostic_countryId"); ?></label>
                                    </div>
                                </article>


                                <article class="clearfix">
                                    <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                        <select class="selectpicker form-control" data-width="100%" name="diagnostic_stateId" id="diagnostic_stateId" data-size="4" onchange ="fetchCity(this.value)" <?php if (isset($diagno_id) && $diagno_id != 0) {
                                                echo 'disabled';
                                            } ?>>

                                            <option value="">Select State</option>
                                            <?php foreach ($allStates as $key => $val) { ?>
                                                <option selected="selected" value="<?php echo $val->state_id; ?>" ><?php echo $val->state_statename; ?></option>
                                            <?php } ?>
                                        </select>
                                        <label class="error" style="display:none;" id="error-diagnostic_stateId"> please select a state</label>
                                        <label class="error" > <?php echo form_error("diagnostic_stateId"); ?></label>
                                    </div>
                                </article>

                                <article class="clearfix">
                                    <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                        <select class="selectpicker form-control" data-width="100%" name="diagnostic_cityId" id="diagnostic_cityId" data-size="4" <?php if (isset($diagno_id) && $diagno_id != 0) {
                                                echo 'disabled';
                                            } ?>>
                                            <option value="">Select City</option>
<?php if (isset($citys) && !empty($citys)) { ?>
    <?php foreach ($citys as $key => $city) { ?>
                                                    <option value="<?php echo $city->city_id; ?>" <?php echo set_select('diagnostic_cityId', $city->city_id); ?>><?php echo $city->city_name; ?></option>
    <?php }
} ?>

                                        </select>
                                        <label class="error" style="display:none;" id="error-diagnostic_cityId"> please select a city</label>
                                        <label class="error" > <?php echo form_error("diagnostic_cityId"); ?></label>

                                    </div>
                                </article>

                                <article class="clearfix">
                                    <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                        <input type="text" class="form-control" id="diagnostic_zip" name="diagnostic_zip" placeholder="Zip code" value="<?php echo set_value('diagnostic_zip'); ?>" maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" <?php if (isset($diagno_id) && $diagno_id != 0) {
    echo 'readonly';
} ?>/>
                                        <label class="error" style="display:none;" id="error-diagnostic_zip"> please enter a zip code</label>
                                        <label class="error" style="display:none;" id="error-diagnostic_zip_long"> zip code should be 6 digit long</label>
                                        <label class="error" > <?php echo form_error("diagnostic_zip"); ?></label>
                                    </div>
                                </article>

                                

                                <article class="clearfix m-t-10">
                                    <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                        <input type="text" class="form-control" id="geocompleteId" name="diagnostic_address" placeholder="address" value="<?php echo set_value('diagnostic_address'); ?>" <?php if (isset($diagno_id) && $diagno_id != 0) {
    echo 'readonly';
} ?>/>



                                        <label class="error" style="display:none;" id="error-diagnostic_address"> please enter an address</label>
                                        <label class="error" > <?php echo form_error("diagnostic_address"); ?></label>
                                    </div>
                                </article>

                                <article class="clearfix">
                                    <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                        <aside class="row">
                                            <div class="col-sm-6">
                                                <input name="lat" class="form-control" placeholder="Latitude" required="" type="text" value="<?php echo set_value('lat'); ?>"  id="lat"   oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" onchange="latChack(this.value)" value="<?php echo set_value('lat'); ?>" <?php if (isset($diagno_id) && $diagno_id != 0) {
    echo 'readonly';
} ?>/>
                                                <label class="error" style="display:none;" id="error-lat">Please enter the correct format for latitude</label>       <label class="error" > <?php echo form_error("lat"); ?></label>
                                            </div>
                                            <div class="col-sm-6 m-t-xs-10">
                                                <input name="lng" class="form-control" placeholder="Longitude" required="" type="text" value="<?php echo set_value('lng'); ?>"  id="lng"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" onChange="lngChack(this.value)" value="<?php echo set_value('lng'); ?>" <?php if (isset($diagno_id) && $diagno_id != 0) {
    echo 'readonly';
} ?>/>
                                                <label class="error" style="display:none;" id="error-lng"> Please enter the correct format for longitude</label>  
                                                <label class="error" > <?php echo form_error("lng"); ?></label></div>
                                        </aside>
                                    </div>
                                </article>

                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4  col-sm-4">Phone:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <div id="multuple_phone_load">
                                            <aside class="row" id="phone_list">


                                                <div class="col-xs-10 m-t-xs-10" id="multiPhoneNumber">
                                                    <input type="text" class="form-control" name="diagnostic_phn" id="diagnostic_phn1" placeholder="" maxlength="10" value="<?php echo set_value('diagnostic_phn'); ?>" minlength="10" pattern=".{10,10}"/>

                                                    <label class="error" > <?php echo form_error("diagnostic_phn"); ?></label>
                                                </div>
                                                <label class="error" style="display:none;" id="error-diagnostic_phn1"> please enter a valid phone number</label>

                                            </aside>
                                        </div>
                                        <p class="m-t-0">* The number above is going to be your primary number.</p>
                                    </div>
                                </article>


                                <article class="clearfix m-t-10">
                                    <label for="cemail" class="control-label col-md-4  col-sm-4">Contact Person :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" id="diagnostic_cntPrsn" name="diagnostic_cntPrsn" type="text" required="" value="<?php echo set_value('diagnostic_cntPrsn'); ?>">
                                        <label class="error" style="display:none;" id="error-diagnostic_cntPrsn"> please enter the name of a contact person</label>
                                        <label class="error" > <?php echo form_error("diagnostic_cntPrsn"); ?></label>
                                    </div>
                                </article>


                                <article class="form-group m-lr-0 ">
                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Docat Id :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" id="docatId" name="docatId" type="text" value="<?php echo set_value('docatId'); ?>">
                                        <label class="error" > <?php echo form_error("docatId"); ?></label>
                                    </div>
                                </article>

                                <article class="clearfix m-t-10">
                                    <label class="control-label col-md-4 col-sm-4" for="cemail">Designation :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input  class="form-control" type="text" required="" name="diagnostic_dsgn" id="diagnostic_dsgn" value="<?php echo set_value('diagnostic_dsgn'); ?>">
                                        <label class="error" style="display:none;" id="error-diagnostic_dsgn"> please enter the  contact person designation only alphabet character's</label>
                                        <label class="error" > <?php echo form_error("diagnostic_dsgn"); ?></label>
                                    </div>
                                </article>

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
                                        <label class="error" style="display:none;" id="error-diagnostic_mbrTyp"> please select a member type</label>
                                        <label class="error" > <?php echo form_error("diagnostic_mbrTyp"); ?></label>
                                    </div>
                                </article>

                                <article class="clearfix m-t-10">
                                    <label class="control-label col-md-4 col-sm-4" for="cname">About Us :</label>
                                    <div class="col-md-8  col-sm-8">
                                        <textarea value="" id="aboutUs" name="aboutUs" class="form-control" required=""><?php echo set_value('aboutUs'); ?> </textarea>
                                        <label class="error"> </label>

                                        <label class="error" style="display:none;" id="error-aboutUs"> Please write about the diagnostic!</label>
                                        <label class="error" > <?php echo form_error("aboutUs"); ?></label>

                                    </div>
                                </article>


                                <!-- Extra Check box section -->

                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-12">Do you also provide following in same campus ? </label>
                                    <div class="col-md-12 ">


                                        <article class="clearfix m-t-10">
                                            <label class="control-label col-md-4 col-xs-9" for="cname">Bloodbank </label>
                                            <div class="col-md-8 col-xs-3">
                                                <aside class="checkbox checkbox-success m-t-5">
                                                    <input type="checkbox" id="bloodbank" name="bloodbank_chk" value="1" <?php echo set_checkbox('bloodbank_chk', '1'); ?>>      
                                                    <label>

                                                    </label>
                                                </aside>
                                            </div>
                                        </article>

                                        <section class="clearfix m-t-10" id="bloodbankOption" style="<?php if (isset($bloodBankstatus) && $bloodBankstatus == 1) {
    echo 'display:block';
} else {
    echo 'display:none';
} ?>">
                                            <article class="clearfix m-t-10 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Name : </label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input class="form-control" id="bloodBank_name" name="bloodBank_name" type="text" maxlength="30" value="<?php echo set_value('bloodBank_name'); ?>" onblur="bbname();">
                                                    <label class="error" style="display:none;" id="error-bloodBank_name"> please Check your BloodBank name</label>
                                                    <label class="error" > <?php echo form_error("bloodBank_name"); ?></label>
                                                </div>
                                            </article>
                                            
                                            <article class="clearfix m-t-10">
                                                <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                                            <div id="blood-crop-avatar">
                                                <?php $this->load->view('blood_upload_crop_modal'); ?>
                                                <article class="col-md-8 col-sm-8 text-right"  class="avatar-form">
                                                    

                                                   
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

                                            <article class="clearfix m-t-10">
                                                <label for="cname" class="control-label col-md-4 col-sm-4">Phone:</label>
                                                <div class="col-md-8 col-sm-8">

                                                    <aside class="row">

                                                        <div class="col-xs-10 m-t-xs-10" id="multiBloodbnkPhoneNumber">
                                                            <input type="text" class="form-control" name="bloodBank_phn" id="bloodBank_phn1" maxlength="10" onkeypress="return isNumberKey(event)" minlength="10" pattern=".{10,10}" value="<?php echo set_value('bloodBank_phn'); ?>"/>
                                                            <label class="error" style="display:none;" id="error-bloodBank_phone"> please Check your BloodBank Phone</label>
                                                            <label class="error" > <?php echo form_error("bloodBank_phn"); ?></label>
                                                        </div>

                                                        <div class="col-md-2 col-sm-2 col-xs-2 m-t-xs-10">
                                                        </div>

                                                    </aside>
                                                   <!-- <p class="m-t-10">* If it is landline, include Std code with number </p>-->
                                                </div>
                                            </article>




                                        </section>

                                        <article class="clearfix">
                                            <label class="control-label col-md-4 col-xs-9" for="cname">Pharmacy </label>
                                            <div class="col-md-8 col-xs-3">
                                                <aside class="checkbox checkbox-success m-t-5">
                                                    <input type="checkbox" id="pharmacy" name="pharmacy_chk" value="1" <?php echo set_checkbox('pharmacy_chk', '1'); ?>>
                                                    <label>

                                                    </label>
                                                </aside>
                                            </div>
                                        </article>

                                        <article class="clearfix">
                                            <label class="control-label col-md-4 col-xs-9" for="cname">Ambulance </label>
                                            <div class="col-md-8 col-xs-3">
                                                <aside class="checkbox checkbox-success m-t-5">
                                                    <input type="checkbox"  id="ambulance" name="ambulance_chk" value="1" <?php echo set_checkbox('ambulance_chk', '1'); ?>>
                                                    <label>

                                                    </label>
                                                </aside>
                                            </div>
                                        </article>

                                        <section class="clearfix m-t-10" id="ambulanceOption" style="<?php if (isset($amobulancestatus) && $amobulancestatus == 1) {
    echo 'display:block';
} else {
    echo 'display:none';
} ?>">
                                            <article class="form-group m-lr-0 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Name : </label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input value="<?php echo set_value('ambulance_name'); ?>" class="form-control" id="ambulance_name" name="ambulance_name" type="text" maxlength="30" onblur="amname()">
                                                    <label class="error" style="display:none;" id="error-ambulance_name"> please Check your Ambulance Name</label>
                                                    <label class="error" > <?php echo form_error("ambulance_name"); ?></label>
                                                </div>
                                            </article>
                                            
                                           <article class="clearfix m-t-10">
                                            <div id="ambulance-crop-avatar">
                                                <?php $this->load->view('ambulance_upload_crop_modal'); ?>
                                                <article class="col-md-8 col-sm-8 text-right"  class="avatar-form">
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
                                        </article>

                                            <article class="clearfix">
                                                <label class="control-label col-md-4 col-xs-9" for="cname">Doctor On board</label>
                                                <div class="col-md-8 col-xs-3">
                                                    <aside class="checkbox checkbox-success m-t-5">
                                                        <input type="checkbox" id="docOnBoard" name="docOnBoard" value="1" <?php echo set_checkbox('docOnBoard', '1'); ?>>
                                                        <label>

                                                        </label>
                                                    </aside>
                                                </div>
                                            </article>


                                            <article class="clearfix m-t-10">
                                                <label for="cname" class="control-label col-md-4 col-sm-4">Phone:</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <aside class="row">


                                                        <div class="col-xs-10 m-t-xs-10" id="phoneAmbulance">
                                                            <input type="text" class="form-control" name="ambulance_phn" id="ambulance_phn1" maxlength="10" onkeypress="return isNumberKey(event)" minlength="10" pattern=".{10,10}" value="<?php echo set_value('ambulance_phn'); ?>"/>
                                                            <label class="error" style="display:none;" id="error-ambulance_phn1"> please Check your Ambulance Phone</label>
                                                            <label class="error" > <?php echo form_error("ambulance_phn"); ?></label>
                                                        </div>
                                                        <div class="col-md-2 col-sm-2 col-xs-2 m-t-xs-10">
                                                        </div>
                                                        <!--<a href="javascript:void(0)" onclick="countAmbulancePhoneNumber()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a> -->

                                                    </aside>
                                                    <!--<p class="m-t-10">* If it is landline, include Std code with number </p>-->
                                                </div>
                                            </article>
                                        </section>


                                        <article class="clearfix">
                                            <label class="control-label col-md-4 col-xs-9" for="cname">Emergency Ward</label>
                                            <div class="col-md-8 col-xs-3">
                                                <aside class="checkbox checkbox-success m-t-5">
                                                    <input type="checkbox" id="isEmergency" name="isEmergency" value="1" <?php echo set_checkbox('isEmergency', '1'); ?> >
                                                    <label>

                                                    </label>
                                                </aside>
                                            </div>
                                        </article>

                                        <article class="clearfix">
                                            <label class="control-label col-md-4 col-xs-9" for="cname">24*7 Avaibility</label>
                                            <div class="col-md-8 col-xs-3">
                                                <aside class="checkbox checkbox-success m-t-5">
                                                    <input type="checkbox" id="availibility_24_7" name="availibility_24_7" value="1" <?php echo set_checkbox('availibility_24_7', '1'); ?> >
                                                    <label>

                                                    </label>
                                                </aside>
                                            </div>
                                        </article>

                                    </div>
                                </article>

                                <!-- End Extra check box section -->   


                            </div>
                            <!-- .form -->
                        </div>
                        <fieldset>

<!--                            <input name="lat" type="hidden" value="">

 <label>Longitude</label> 
 <input name="lng" type="hidden" value="">-->


                        </fieldset>
                    </section>
                    <!-- Left Section End -->



                    <!-- Right Section Start -->
                    <section class="col-md-6 detailbox mi-form-section">
                        <div class="bg-white clearfix">

                            <!-- membership Detail Section Start -->
                            <figure class="clearfix">
                                <h3>Membership Detail</h3>
                            </figure>
                            <aside class="clearfix m-t-20 p-b-20">
                                <article class="clearfix m-t-10">
                                    <?php $checkBocCount = 1; 
                                    if(isset($facilities_list) && $facilities_list != NULL){ ?>
                                    <input type="hidden" value="<?php echo count($facilities_list); ?>" id="faci_count" name="faci_count">    
                                    <?php foreach($facilities_list as $facilities){ ?>
                                    <label class="control-label col-md-4 col-xs-9" for="cname"><?php echo $facilities->facilities_name; ?></label>
                                    <div class="col-md-8 col-sm-8">
                                        <aside class="row">
                                            <input type="hidden" value="<?php echo $facilities->facilities_id; ?>" id="checkbox_<?php echo $checkBocCount; ?>" name="checkbox_<?php echo $checkBocCount; ?>">
                                            <div class="col-md-6 col-sm-6">
                                                <input type="number" id="membership_quantity_<?php echo $checkBocCount; ?>" name="membership_quantity_<?php echo $checkBocCount; ?>" class="form-control" min="1" max="25" />
                                                <label class="error" style="display:none;" id="error-membership_quantity_<?php echo $checkBocCount; ?>"> please enter the Quantity!</label>
                                                <label class="error" > <?php echo form_error("membership_quantity_$checkBocCount"); ?></label>
                                            </div>
                                            <?php if($facilities->facilities_id == 2 || $facilities->facilities_id == 4){ ?>
                                            <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                <input type="number" id="membership_duration_<?php echo $checkBocCount; ?>" name="membership_duration_<?php echo $checkBocCount; ?>" class="form-control" min="1" max="25" <?php if($facilities->facilities_id == 2 || $facilities->facilities_id == 4){  } ?>/>
                                                <label class="error" style="display:none;" id="error-membership_duration_<?php echo $checkBocCount; ?>"> please enter the Duration !</label>
                                                <label class="error" > <?php echo form_error("membership_duration_$checkBocCount"); ?></label>
                                            </div>
                                            <?php } ?>
                                        </aside>
                                    </div>
                                    <?php $checkBocCount++;} } ?>
                                </article>
                            </aside>
                            <!-- membership Detail Section End -->
                        </div>
                            
                            <!-- Account Detail Section Start -->
                            <figure class="clearfix">
                                <h3>Account Detail</h3>
                            </figure>
                            <aside class="clearfix m-t-20 p-b-20">
                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Email Id:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input type="email" class="form-control" id="users_email" name="users_email" placeholder="" onblur="checkEmailFormat();" value="<?php echo set_value('users_email'); ?>"/>
                                        <label class="error" style="display:none;" id="error-users_email"> please enter Email id Properly</label>
                                        <label class="error" style="display:none;" id="error-users_email_check"> Email Already Exits!</label>
                                        <label class="error" > <?php echo form_error("users_email"); ?></label>
                                        <input type="hidden" class="form-control" id="users_email_status" name="users_email_status" value="" />
                                    </div>
                                </article>

                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Mobile no. :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input type="text" class="form-control" id="diagnostic_mblNo" name="diagnostic_mblNo" placeholder="" maxlength="10" value="<?php echo set_value('diagnostic_mblNo'); ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"/>
                                        <label class="error" style="display:none;" id="error-diagnostic_mblNo"> please enter your mobile number</label>
                                        <label class="error" style="display:none;" id="error-diagnostic_mblNo_check">please enter digits only!</label>
                                        <label class="error" > <?php echo form_error("diagnostic_mblNo"); ?></label>

                                    </div>
                                </article>


                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Enter Password :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input type="password" class="form-control" id="users_password" name="users_password" placeholder=" " />
                                        <label class="error" style="display:none;" id="error-users_password"> please enter password and it should be 6 chracter</label>
                                        <label class="error" > <?php echo form_error("users_password"); ?></label>
                                    </div>
                                </article>

                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Confirm Password :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input type="password" class="form-control" id="cnfPassword" name="cnfPassword" placeholder=" " />
                                        <label class="error" style="display:none;" id="error-cnfPassword"> please enter the password</label>
                                        <label class="error" style="display:none;" id="error-cnfPassword_check">Passwords do not match!</label>
                                        <label class="error" > <?php echo form_error("cnfPassword"); ?></label>
                                    </div>
                                </article>

                            </aside>

                            <!-- Account Detail Section End -->

                        </div>
                        
                    </section>
                    <section class="clearfix ">
                        <div class="col-md-12 m-t-20 m-b-20">
                            <button type="reset" class="btn btn-danger waves-effect pull-right" type="button">Reset</button>
                            <input class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit" onclick="return validationDiagnostic()" value="Submit" />
                        </div>

                    </section>

                </form>
            </div>

            <!-- container -->
        </div>
        <!-- content -->

