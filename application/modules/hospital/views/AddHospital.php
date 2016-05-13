<!-- Left Sidebar End -->
<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <div class="clearfix">
                <!--<div class="col-md-12 text-success">
                <?php // echo $this->session->flashdata('message'); ?>
                <?php ?>
                </div> -->
                <div class="col-md-12">
                    <h3 class="pull-left page-title">Add New Hospital</h3>

                </div>
            </div>
            <div class="map_canvas"></div>
            <form class="cmxform form-horizontal tasi-form " id="submitForm" name="hospitalForm" method="post" action="<?php echo site_url('hospital/SaveHospital'); ?>" novalidate="novalidate" enctype="multipart/form-data" >
                <input type="hidden" id="countPnone" name="countPnone" value="1" />
                <input type="hidden" id="countbloodBank_phn" name="countbloodBank_phn" value="1" />
                <input type="hidden" id="countPharmacy_phn" name="countPharmacy_phn" value="1" />
                <input type="hidden" id="countAmbulance_phn" name="countAmbulance_phn" value="1" />
                <input type="hidden" id="serviceName" name="serviceName" value="1" />
                <input type="hidden" id="StateId" name="StateId" value="" />
                <input type="hidden" id="countServiceName" name="countServiceName" value="1" />
                <input type="hidden" id="isBloodBankOutsource" name="isBloodBankOutsource" value="0" />
                <input type="hidden" id="isAddressDisabled" name="isAddressDisabled" value="<?php
                if (isset($hospital_id) && $hospital_id != 0) {
                    echo 1;
                } else {
                    echo 0;
                }
                ?>" />
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
                                        <?php $publishHospital[] = (object) array('hospital_id' => 0, 'hospital_name' => 'Other') ?>
                                    <select class="form-control select2" data-width="100%" name="hospital_id" id="hospital_id" onchange="getHospitaldetail(this.value)" >
                                        <option value="">Select Hospital</option>
                                        <?php
                                        if (!empty($publishHospital)) {

                                            foreach ($publishHospital as $key => $val) {
                                                ?>
                                                <option <?php echo set_select('hospital_id', $val->hospital_id); ?> value="<?php echo $val->hospital_id; ?>"> <?php echo $val->hospital_name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <!--<option value="0">Other</option>-->
                                    </select>
                                    <label class="error" style="display:none;" id="error-hospital_id"> please select hospital name</label>
                                    <label class="error" > <?php echo form_error("hospital_id"); ?></label>
                                </div>
                            </article>

                            <article class="clearfix m-t-10" style="<?php
                            if (isset($hospital_id) && $hospital_id == 0) {
                                echo 'display:block';
                            } else {
                                echo 'display:none';
                            }
                            ?>" id="hospitalName">
                                <label for="cemail" class="control-label col-md-4 col-sm-4">Hospital Name :</label>
                                <div class="col-md-8 col-sm-8">
                                    <input class="form-control" id="hospital_name" name="hospital_name" type="text" value="<?php echo set_value('hospital_name'); ?>">
                                    <label class="error" style="display:none;" id="error-hospital_name"> please enter hospital name</label>
                                    <label class="error" > <?php echo form_error("hospital_name"); ?></label>
                                </div>
                            </article>
                            

                            <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4  col-sm-4">Hospital Type :</label>
                                <div class="col-md-8 col-sm-8">
                                    <select class="form-control select2" data-width="100%" name="hospital_type" id="hospital_type" >
                                    <option value="">Select Type</option>
                                        <?php
                                        if (!empty($hospitalType)) {
                                            foreach ($hospitalType as $key => $val) {
                                                ?>
                                                <option <?php echo set_select('hospital_type', $val->hospitalType_id); ?> value="<?php echo $val->hospitalType_id; ?>"> <?php echo $val->hospitalType_name; ?></option>';
        <?php
    }
}
?>
                                    </select>
                                    <label class="error" style="display:none;" id="error-hospital_type"> please enter hospital type</label>
                                    <label class="error" > <?php echo form_error("hospital_type"); ?></label>
                                </div>
                            </article>
                            
                            <div id="crop-avatar">
                                <article class="clearfix m-t-10"  class="avatar-form">
                                    <div id="upload_modal_form">
                                    <?php $this->load->view('upload_crop_modal'); ?>
                                    </div>
                                    <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                                    <div class="col-md-8 col-sm-8" data-target="#modal" data-toggle="modal">
                                        <label class="col-md-4 col-sm-4" for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x avatar-view"></i></label>

                                        <div class="pre col-md-4 col-sm-4 ">
                                            <div id="preImgLogo" class="avatar-preview preview-md preImgLogo">

                                                <img src="<?php echo base_url() ?>assets/default-images/Hospital-logo.png"  class="image-preview-show"/>

                                            </div>
                                        </div>
                                        
                                        <div id="error-label" class="error-label"></div>
                                        <label class="error" > <?php echo form_error("avatar_file"); ?></label>
                                        <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>



                                    </div>
                                </article>
                            </div>
                            
                            
                            <div id="addressDiv">

                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Address:</label>
                                    <div class="col-md-8 col-sm-8">

                                        <select class="form-control selectpicker" data-width="100%" name="hospital_countryId" id="hospital_countryId" onchange ="fetchState(this.value)" <?php
                                            if (isset($hospital_id) && $hospital_id != 0) {
                                                echo 'disabled';
                                            }
                                            ?>>
                                            <option value="">Select Country</option>
                                            <?php
                                            if (isset($allCountry) && !empty($allCountry)) {
                                                foreach ($allCountry as $key => $val) {
                                                    ?>
                                                    <option <?php echo set_select('hospital_countryId', $val->country_id); ?>  value="<?php echo $val->country_id; ?>"><?php echo $val->country; ?></option>
        <?php
    }
}
?>


                                        </select>
                                        <label class="error" style="display:none;" id="error-hospital_countryId"> please select a country</label>
                                        <label class="error" > <?php echo form_error("hospital_countryId"); ?></label>

                                    </div>
                                </article>

                                <article class="clearfix">
                                    <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                        <select class="form-control selectpicker" data-width="100%" name="hospital_stateId" id="hospital_stateId" data-size="4" onchange ="fetchCity(this.value)" <?php
                                            if (isset($hospital_id) && $hospital_id != 0) {
                                                echo 'disabled';
                                            }
                                            ?>>

                                            <option value="">Select State</option>
                                            <?php
                                            if (isset($allStates) && !empty($allStates)) {
                                                foreach ($allStates as $key => $val) {
                                                    ?>
                                                    <option <?php echo set_select('hospital_stateId', $val->state_id); ?> value="<?php echo $val->state_id; ?>"><?php echo $val->state_statename; ?></option>
        <?php
    }
}
?>
                                        </select>
                                        <label class="error" style="display:none;" id="error-hospital_stateId"> please select a state</label>
                                        <label class="error" > <?php echo form_error("hospital_stateId"); ?></label>
                                    </div>
                                </article>

                                <article class="clearfix">
                                    <div class="col-md-8  col-sm-8 col-sm-offset-4">

                                        <select class="form-control selectpicker" data-width="100%" name="hospital_cityId" id="hospital_cityId" data-size="4" <?php
                                            if (isset($hospital_id) && $hospital_id != 0) {
                                                echo 'disabled';
                                            }
                                            ?>>
                                            <option value="">Select City</option>
<?php
if (isset($allCities) && !empty($allCities)) {
    foreach ($allCities as $key => $val) {
        ?>
                                                    <option <?php echo set_select('hospital_cityId', $val->city_id); ?> value="<?php echo $val->city_id; ?>"><?php echo $val->city_name; ?></option>
        <?php
    }
}
?>

                                        </select>
                                        <label class="error" style="display:none;" id="error-hospital_cityId"> please select a city</label>
                                        <label class="error" > <?php echo form_error("hospital_cityId"); ?></label>
                                    </div>
                                </article>

                                <article class="clearfix m-t-10">
                                    <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                        <input type="text" class="form-control" id="hospital_zip" name="hospital_zip" placeholder="Zipcode" onkeypress="return isNumberKey(event)" maxlength="6" value="<?php echo set_value('hospital_zip'); ?>" <?php
if (isset($hospital_id) && $hospital_id != 0) {
    echo 'readonly';
}
?>/>
                                        <label class="error" style="display:none;" id="error-hospital_zip"> please enter a zip code</label>
                                        <label class="error" style="display:none;" id="error-hospital_zip_check">Please enter numeric digits only!</label>
                                        <label class="error" style="display:none;" id="error-hospital_zip_long"> zip code should be 6 digit long</label>
                                        <label class="error" > <?php echo form_error("hospital_zip"); ?></label>
                                    </div>
                                </article>


                                <!--  <article class="clearfix">
                                      <label class="control-label col-md-4" for="cname">Manual:</label>
                                      <div class="col-md-8">
                                          <aside class="radio radio-info radio-inline">
                                              <input <?php // echo set_radio('isManual', '1', TRUE);   ?> type="radio"  name="isManual" value="1" id="isManual" onclick="IsAdrManual(this.value)">
                                              <label for="inlineRadio1"> Yes</label>
                                          </aside>
                                          <aside class="radio radio-info radio-inline">
                                              <input <?php // echo set_radio('isManual', '0');  ?> type="radio" name="isManual" value="0" id="isManual" onclick="IsAdrManual(this.value)">
                                              <label for="inlineRadio2"> No</label>
                                          </aside>
                                      </div>
                                  </article> -->

                                <input  type="hidden" name="isManual" value="1" id="isManual">


                                <article class="clearfix m-t-10">
                                    <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                        <input type="text" class="form-control geocomplete" id="geocomplete1" name="hospital_address" placeholder="Address" value="<?php echo set_value('hospital_address'); ?>" <?php
                                        if (isset($hospital_id) && $hospital_id != 0) {
                                            echo 'readonly';
                                        }
?>/>
                                        <label class="error" style="display:none;" id="error-hospital_address"> please enter an address</label>

                                        <label class="error" > <?php echo form_error("hospital_address"); ?></label>
                                    </div>
                                </article>

                                <article class="clearfix">
                                    <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                        <aside class="row">

                                            <div class="col-sm-6">
                                                <input name="lat" onkeypress="return isNumberKey(event)" class="form-control" type="text" value="<?php echo set_value('lat'); ?>"  id="lat" placeholder="Latitude"  <?php
                                                if (isset($hospital_id) && $hospital_id != 0) {
                                                    echo 'readonly';
                                                }
?>/>
                                                <label class="error" > <?php echo form_error("lat"); ?></label>
                                                <label class="error" style="display:none;" id="error-lat">Please enter the correct format for latitude</label>
                                            </div>

                                            <div class="col-sm-6">
                                                <input name="lng" onkeypress="return isNumberKey(event)" type="text" value="<?php echo set_value('lng'); ?>"  id="lng" class="form-control" placeholder="Longitude"  <?php
                                                if (isset($hospital_id) && $hospital_id != 0) {
                                                    echo 'readonly';
                                                }
?>/>
                                                <label class="error" > <?php echo form_error("lng"); ?></label>
                                                <label class="error" style="display:none;" id="error-lng"> Please enter the correct format for longitude</label>
                                            </div>

                                        </aside>
                                    </div>
                                </article>

                            </div>  

                            <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4  col-sm-4">Phone:</label>
                                <div class="col-md-8 col-sm-8">
                                    <!--<a href="javascript:void(0)" class="add pull-right" onclick="countPhoneNumber()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a>-->
                                    <div id="multuple_phone_load">
                                        <aside class="row clone">
                                            <!-- <div class="col-lg-3 col-md-4 col-sm-3 col-sm-4 col-xs-12 m-t-xs-10" id="multiPreNumber">
                                                 <select class="selectpicker" data-width="100%" name="pre_number[]" id="multiPreNumber">
                                                     <option value ='91'>+91</option>
                                                 </select>
                                             </div> -->

                                            <!--<div class="col-lg-4 col-md-4 col-sm-3 col-xs-12 m-t-xs-10">
                                                <input type="text" onkeypress="return isNumberKey(event)" onblur="checkNumber('midNumber', 1)" maxlength="5" value="<?php // set_value('midNumber[0]');   ?>"  id="midNumber" name="midNumber[]" class="form-control" requird>
                                                <label class="error" > <?php // echo form_error("midNumber");   ?></label>
                                            </div> -->

                                            <div class="col-xs-10 m-t-xs-10" id="multiPhoneNumber">
                                                <input type="text" class="form-control" name="hospital_phn" id="hospital_phn1" maxlength="10" onkeypress="return isNumberKey(event)" requird value="<?php echo set_value('hospital_phn'); ?>" minlength="10" pattern=".{10,10}"/>
                                                <label class="error" style="display:none;" id="error-hospital_phn"> please enter a valid phone number</label>
                                                <label class="error" > <?php echo form_error("hospital_phn"); ?></label>
                                            </div>

                                        </aside>
                                    </div>
                                    <p class="m-t-0">* The number above is going to be your primary number.</p>
                                </div>
                            </article>

                            <!-- <article class="clearfix m-t-10">
                                 <label class="control-label col-md-4 col-sm-4" for="cname">Mobile no. :</label>
                                 <div class="col-md-8 col-sm-8">
                                     <input type="text" value="<?php // set_value('hospital_mbl');   ?>" onkeypress="return isNumberKey(event)" maxlength="10" placeholder="" name="hospital_mbl" id="hospital_mbl" class="form-control">
 
                                     <label id="error-hospital_mbl" style="display:none;" class="error">please enter digits only!</label>
                                     <label class="error" > <?php // echo form_error("hospital_mbl");   ?></label>
 
                                 </div>
                             </article> -->

                            <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4  col-sm-4">Hospital Services:</label>
                                <div class="col-md-8 col-sm-8">
                                    <a href="javascript:void(0)" class="add pull-right" onclick="countserviceName()" ><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a>

                                    <aside class="row" id="multiserviceName">

                                        <div class="col-lg-10 col-md-10 col-sm-7 col-xs-10 m-t-xs-10">
                                            <input type="text" class="form-control" name="hospitalServices_serviceName[]" id="hospitalServices_serviceName1" placeholder="" maxlength="30" value="<?php echo set_value('hospitalServices_serviceName[0]'); ?>"/>
                                            <label class="error" style="display:none;" id="error-hospitalServices_serviceName"> please enter a hospital service Name without Numeric value</label>
                                            <label class="error" > <?php echo form_error("hospitalServices_serviceName[0]"); ?></label>

                                        </div>


                                    </aside>

                                </div>
                            </article>


                            <article class="clearfix m-t-10">
                                <label for="cemail" class="control-label col-md-4  col-sm-4">Contact Person :</label>
                                <div class="col-md-8 col-sm-8">
                                    <input class="form-control" id="hospital_cntPrsn" name="hospital_cntPrsn" type="text" value="<?php echo set_value('hospital_cntPrsn'); ?>">
                                    <label class="error" style="display:none;" id="error-hospital_cntPrsn"> please enter the name of a contact person</label>
                                    <label class="error" style="display:none;" id="error-hospital_cntPrsn_check">please enter characters only!</label>
                                    <label class="error" > <?php echo form_error("hospital_cntPrsn"); ?></label>
                                </div>
                            </article>

                            <article class="form-group m-lr-0 ">
                                <label for="cemail" class="control-label col-md-4 col-sm-4">Docat Id :</label>
                                <div class="col-md-8 col-sm-8">
                                    <input class="form-control" id="docatId" name="docatId" type="text" value="<?php echo set_value('docatId'); ?>">
                                    <label class="error" > <?php echo form_error("docatId"); ?></label>
                                </div>
                            </article>

                            <article class="form-group m-lr-0 ">
                                <label for="cemail" class="control-label col-md-4 col-sm-4">Designation :</label>
                                <div class="col-md-8 col-sm-8">
                                    <input class="form-control" id="hospital_dsgn" name="hospital_dsgn" type="text" value="<?php echo set_value('hospital_dsgn'); ?>">
                                    <label class="error" style="display:none;" id="error-hospital_dsgn"> please enter a designation</label>
                                    <label class="error" style="display:none;" id="error-hospital_dsgn_check">please enter only charcters!</label>
                                    <label class="error" > <?php echo form_error("hospital_dsgn"); ?></label>
                                </div>
                            </article>
                            
                        
                            
                            <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4 col-sm-4">About Us :</label>
                                <div class="col-md-8  col-sm-8">
                                    <textarea class="form-control" name="hospital_aboutUs" id="hospital_aboutUs"  value=""><?php echo set_value('hospital_aboutUs'); ?></textarea>
                                    <label class="error" > <?php echo form_error("hospital_aboutUs"); ?></label>
                                    <label class="error" style="display:none;" id="error-hospital_aboutUs"> Please write about the hospital!</label>

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

                                    <section class="clearfix m-t-10" id="bloodbankOption" style="<?php
                                                if (isset($bloodBankstatus) && $bloodBankstatus == 1) {
                                                    echo 'display:block';
                                                } else {
                                                    echo 'display:none';
                                                }
?>">
                                        <article class="clearfix m-t-10 ">
                                            <label for="cemail" class="control-label col-md-4 col-sm-4">Name : </label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control" id="bloodBank_name" name="bloodBank_name" type="text" maxlength="30" value="<?php echo set_value('bloodBank_name'); ?>" onblur="bbname();">
                                                <label class="error" style="display:none;" id="error-bloodBank_name"> please Check your BloodBank name</label>
                                            </div>
                                        </article>
                                        
                                        <article class="clearfix m-t-10">
                                            <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
<!--                                            <div class="col-md-8 col-sm-8 text-right">
                                                <label for="file-input2"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x"></i></label>
                                                <input  type="file" style="display:none;" class="no-display" id="file-input2" name="bloodBank_photo" onchange="ValidateSingleInput(this, '2', '5');">

                                            </div>-->

                                            <div id="blood-crop-avatar">
                                                <?php $this->load->view('blood_upload_crop_modal'); ?>
                                                <article class="col-md-8 col-sm-8 text-right"  class="avatar-form">
                                                    

                                                   
                                                    <div class="col-md-8 col-sm-8" data-target="#modal" data-toggle="modal">
                                                        <label class="col-md-4 col-sm-4" for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x avatar-view"></i></label>

                                                        <div class="pre col-md-4 col-sm-4 ">
                                                            <div id="preImgLogo" class="avatar-preview preview-md preImgLogo m-l-15">

                                                                <img src="<?php echo base_url() ?>assets/default-images/Blood-logo.png"  class="image-preview-show"/>

                                                            </div>
                                                        </div>
                                                        <label class="error" style="display:none;" id="error-avatar_data_bloodbank">Blood bank image required</label>
                                                        <label class="error" > <?php echo form_error("avatar_file"); ?></label>
                                                        <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>



                                                    </div>
                                                </article>
                                            </div>

                                        </article>

                                        <article class="clearfix m-t-10">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Phone:</label>
                                            <div class="col-md-8 col-sm-8">
                                                <!--<a href="javascript:void(0)" class="aaaa pull-right" rel=".clone">
                                                    <i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a>-->
                                                <aside class="row">
                                                    <!--<div class="col-md-3 col-sm-3 col-xs-12" id="multiBloodbnkPreNumber">
                                                        <select class="selectpicker" data-width="100%" id="preblbankNo1" name="preblbankNo[]">
                                                            <option value='91'>+91</option>
                                                            <option value ='1'>+1</option>
                                                        </select>
                                                    </div> -->

                                                    <!--<div class="col-md-4 col-sm-4 col-xs-10 m-t-xs-10">
                                                        <input type="text" onkeypress="return isNumberKey(event)" onblur="checkNumber('midNumber', 1)" maxlength="5"  id="bloodMidNumber" name="bloodMidNumber[]" class="form-control" requird>
                                                        <label class="error" > <?php // echo form_error("bloodMidNumber");   ?></label>
                                                    </div> -->

                                                    <div class="col-xs-10 m-t-xs-10" id="multiBloodbnkPhoneNumber">
                                                        <input type="text" class="form-control" name="bloodBank_phn" id="bloodBank_phn1" maxlength="10" onkeypress="return isNumberKey(event)" minlength="10" pattern=".{10,10}" value="<?php echo set_value('bloodBank_phn'); ?>"/>
                                                        <label class="error" style="display:none;" id="error-bloodBank_phone"> please Check your BloodBank Phone</label>
                                                    </div>

                                                    <div class="col-md-2 col-sm-2 col-xs-2 m-t-xs-10">
                                                    </div>
                                                   <!-- <a href="javascript:void(0)" onclick="countBloodPhoneNumber()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a> -->

                                                </aside>
                                               <!-- <p class="m-t-10">* If it is landline, include Std code with number </p>-->
                                            </div>
                                        </article>




                                    </section>

                                    <article class="clearfix">
                                        <label class="control-label col-md-4 col-xs-9" for="cname">Pharmacy </label>
                                        <div class="col-md-8 col-xs-3">
                                            <aside class="checkbox checkbox-success m-t-5">
                                                <input type="checkbox" id="pharmacy" name="pharmacy_chk" value="1" <?php echo set_checkbox('pharmacy_chk', '1'); ?> >
                                                <label>

                                                </label>
                                            </aside>
                                        </div>
                                    </article>

                                    <article class="clearfix">
                                        <label class="control-label col-md-4 col-xs-9" for="cname">Ambulance </label>
                                        <div class="col-md-8 col-xs-3">
                                            <aside class="checkbox checkbox-success m-t-5">
                                                <input type="checkbox"  id="ambulance" name="ambulance_chk" value="1" <?php echo set_checkbox('bloodbank_chk', '1'); ?>>
                                                <label>

                                                </label>
                                            </aside>
                                        </div>
                                    </article>

                                    <section class="clearfix m-t-10" id="ambulanceOption" style="<?php
if (isset($amobulancestatus) && $amobulancestatus == 1) {
    echo 'display:block';
} else {
    echo 'display:none';
}
?>">
                                        <article class="form-group m-lr-0 ">
                                            <label for="cemail" class="control-label col-md-4 col-sm-4">Name : </label>
                                            <div class="col-md-8 col-sm-8">
                                                <input value="<?php echo set_value('ambulance_name'); ?>" class="form-control" id="ambulance_name" name="ambulance_name" type="text" maxlength="30" onblur="amname()">
                                                <label class="error" style="display:none;" id="error-ambulance_name"> please Check your Ambulance Name</label>
                                            </div>
                                        </article>
                                        


                                        <article class="clearfix m-t-10">
                                            <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                               

                                            <div id="ambulance-crop-avatar">
                                                <?php $this->load->view('ambulance_upload_crop_modal'); ?>
                                                <article class="col-md-8 col-sm-8 text-right"  class="avatar-form">
                                                    

                                                   
                                                    <div class="col-md-8 col-sm-8" data-target="#modal" data-toggle="modal">
                                                        <label class="col-md-4 col-sm-4" for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x avatar-view"></i></label>

                                                        <div class="pre col-md-4 col-sm-4 ">
                                                            <div id="preImgLogo" class="avatar-preview preview-md preImgLogo m-l-15">

                                                                <img src="<?php echo base_url() ?>assets/default-images/ambulance_logo.png"  class="image-preview-show"/>

                                                            </div>
                                                        </div>
                                                        <label class="error" style="display:none;" id="error-avatar_data_ambulance">Ambulance image required</label>
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

                </section>
                <!-- Left Section End -->



                <!-- Right Section Start1 -->
                <section class="col-md-6 detailbox mi-form-section"> 
                   <div class="bg-white clearfix">

                            <!-- membership Detail Section Start -->
                            <figure class="clearfix">
                                <h3>Membership Detail</h3>
                            </figure>
                            <aside class="clearfix m-t-20 p-b-20">
                                
                                    
                            <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Membership Type :</label>
                                    <div class="col-md-8  col-sm-8">
                                        <select class="select2" data-width="100%" name="hospital_mmbrTyp" id="hospital_mmbrTyp" onchange="find_membershipdata(this.value)">
                                            <option value="">Select Membership</option>
                                            <?php if(isset($membership_plan) && $membership_plan){ 
                                                foreach($membership_plan as $membership){ ?>
                                                    <option value="<?php echo $membership->membership_id; ?>" <?php echo set_select('hospital_mmbrTyp', $membership->membership_id); ?> ><?php echo $membership->membership_name; ?></option>
                                            <?php } } ?>
                                        </select>
                                        <label class="error" style="display:none;" id="error-hospital_mmbrTyp"> please select a member type</label>
                                        <label class="error" > <?php echo form_error("hospital_mmbrTyp"); ?></label>
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
                                            <input type="hidden" value="<?php echo $facilities->facilities_id; ?>" id="checkbox_<?php echo $checkBocCount; ?>" name="checkbox_<?php echo $checkBocCount; ?>">
                                            
                                            <div class="col-md-6 col-sm-6">
                                                <input type="number" id="membership_quantity_<?php echo $checkBocCount; ?>" name="membership_quantity_<?php echo $checkBocCount; ?>" class="form-control" min="1" max="25" value="<?php echo set_value('membership_quantity_'.$checkBocCount); ?>"/>
                                                <label class="error" style="display:none;" id="error-membership_quantity_<?php echo $checkBocCount; ?>"> please enter the Quantity!</label>
                                                <label class="error" > <?php echo form_error("membership_quantity_$checkBocCount"); ?></label>
                                            </div>
                                            <?php if($facilities->facilities_id == 2 || $facilities->facilities_id == 4){ ?>
                                            <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                <input type="number" id="membership_duration_<?php echo $checkBocCount; ?>" name="membership_duration_<?php echo $checkBocCount; ?>" class="form-control" min="1" max="25" <?php if($facilities->facilities_id == 2 || $facilities->facilities_id == 4){  } ?> value="<?php echo set_value('membership_duration_'.$checkBocCount); ?>"/>
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
                                <label for="cname" class="control-label col-md-4 col-sm-4">Registered Email Id:</label>
                                <div class="col-md-8 col-sm-8">
                                    <input type="email" class="form-control" id="users_email" name="users_email" placeholder="" value="<?php echo set_value('users_email'); ?>" />
                                    <label class="error" style="display:none;" id="error-users_email"> please enter Email id Properly</label>
                                    <label class="error" style="display:none;" id="error-users_email_check"> Email Already Exits!</label>
                                    <label class="error" > <?php echo form_error("users_email"); ?></label>
                                    <input type="hidden" class="form-control" id="users_email_status" name="users_email_status" value="" />
                                </div>
                            </article>

                            <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4 col-sm-4">Registered Mobile no. :</label>
                                <div class="col-md-8 col-sm-8">
                                    <input type="text" class="form-control" id="hospital_mblNo" name="hospital_mblNo" placeholder="" maxlength="10" onkeypress="return isNumberKey(event)" value="<?php echo set_value('hospital_mblNo'); ?>" />
                                    <label class="error" style="display:none;" id="error-hospital_mblNo"> please enter your mobile number</label>
                                    <label class="error" style="display:none;" id="error-hospital_mblNo_check">please enter digits only!</label>
                                    <label class="error" > <?php echo form_error("hospital_mblNo"); ?></label>

                                </div>
                            </article>

                            <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4 col-sm-4">Enter Password :</label>
                                <div class="col-md-8 col-sm-8">
                                    <input type="password" class="form-control" id="users_password" name="users_password" placeholder="" />
                                    <label class="error" style="display:none;" id="error-users_password"> please enter password and shoul be 6 chracter</label>
                                    <label class="error" > <?php echo form_error("users_password"); ?></label>
                                </div>
                            </article>

                            <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4 col-sm-4">Confirm Password :</label>
                                <div class="col-md-8 col-sm-8">
                                    <input type="password" class="form-control" id="cnfPassword" name="cnfPassword" placeholder="" />
                                    <!-- <label class="error" style="display:none;" id="error-cnfPassword"> please enter the password</label>-->
                                    <label class="error" style="display:none;" id="error-cnfPassword_check">Passwords do not match!</label>
                                    <label class="error" > <?php echo form_error("cnfPassword"); ?></label>
                                </div>
                            </article>

                        </aside>

                        <!-- Account Detail Section End -->

                  
                </section>
                <section class="clearfix ">
                    <div class="col-md-12 m-t-20 m-b-20">
                        <button class="btn btn-danger waves-effect pull-right" type="button" onclick="location.href='addHospital'">Reset</button>
                        <div>
                            <input onclick="return changeStatus()" class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit" value="Submit"  />
                        </div>
                    </div>

                </section>

                <fieldset>


                </fieldset>

            </form>
        </div>

        <!-- container -->
    </div>
    <!-- content -->

</div>
<!-- End Right content here -->

<!-- END wrapper -->


