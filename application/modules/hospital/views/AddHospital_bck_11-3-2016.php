
        <!-- Left Sidebar End -->
        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">

                    <div class="clearfix">
                        <div class="col-md-12 text-success">
                            <?php echo $this->session->flashdata('message'); ?>
                            <?php ?>
                         </div>
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Add New Hospital</h3>

                        </div>
                    </div>
                    <div class="map_canvas"></div>
                    <form class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" name="hospitalForm" method="post" action="<?php echo site_url('hospital/SaveHospital'); ?>" novalidate="novalidate" enctype="multipart/form-data" >
                        <input type="hidden" id="countPnone" name="countPnone" value="1" />
                        <input type="hidden" id="countbloodBank_phn" name="countbloodBank_phn" value="1" />
                        <input type="hidden" id="countPharmacy_phn" name="countPharmacy_phn" value="1" />
                       <input type="hidden" id="countAmbulance_phn" name="countAmbulance_phn" value="1" />
                       <input type="hidden" id="serviceName" name="serviceName" value="1" />
                       <input type="hidden" id="StateId" name="StateId" value="" />
                       <input type="hidden" id="countServiceName" name="countServiceName" value="1" />
                        <!-- Left Section Start -->
                        <section class="col-md-6 detailbox">
                            <div class="bg-white mi-form-section">
                                <figure class="clearfix">
                                    <h3>General Detail</h3>
                                </figure>
                                <!-- Table Section End -->
                                <div class="clearfix m-t-20 p-b-20">
                                   
                                    <article class="form-group m-lr-0 ">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Hospital Name :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" id="hospital_name" name="hospital_name" type="text" required="">
                                            <label class="error" style="display:none;" id="error-hospital_name"> please enter hospital name</label>
                                            <label class="error" > <?php echo form_error("hospital_name"); ?></label>
                                        </div>
                                    </article>
                                    
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4  col-sm-4">Hospital Type :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" data-width="100%" name="hospital_type" id="hospital_type">
                                                <option value="1"> Trauma Centres</option>
                                                <option value="2">Rehabilitation Hospitals</option>
                                                <option value="3">Children's Hospitals</option>
                                            </select>
                                             <label class="error" style="display:none;" id="error-hospital_type"> please enter hospital type</label>
                                             <label class="error" > <?php echo form_error("hospital_type"); ?></label>
                                        </div>
                                    </article>

                                     <article class="form-group m-lr-0 ">
                                        <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                                        <div class="col-md-8 col-sm-8 text-right">
                                            <label for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x avatar-view"></i></label>
<!--                                            <input type="file" style="display:none;" class="no-display" id="file-input" name="bloodBank_photo">-->
                                            <!-- <input type="file" style="display:none;" class="no-display avatar-view" id="file-input11" name="bloodBank_photo"> -->
                                            
                                           <!-- <label class="error" > <?php // echo form_error("bloodBank_photo"); ?></label> -->
                                            <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                                            <img src="<?php echo base_url('assets/images/noImage.png'); ?>" width="70" height="65" class="image-preview-show"/>
                                        </div>
                                    </article>


                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Address:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <aside class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <select class="selectpicker" data-width="100%" name="hospital_countryId" id="hospital_countryId">
                                                        <option value=' '>Select Country</option>
                                                        <option value="1">INDIA</option>
                                                         
                                                    </select>
                                                    <label class="error" style="display:none;" id="error-hospital_countryId"> please select a country</label>
                                                    <label class="error" > <?php echo form_error("hospital_countryId"); ?></label>
                                                </div>
                                                <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                    <select class="selectpicker" data-width="100%" name="hospital_stateId" id="hospital_stateId" data-size="4" onchange ="fetchCity(this.value)">

                                                        <option value="">Select State</option>
                                                       <?php foreach($allStates as $key=>$val) {?>
                                                        <option value="<?php echo $val->state_id;?>"><?php echo $val->state_statename;?></option>
                                                         <?php }?>
                                                    </select>
                                                    <label class="error" style="display:none;" id="error-hospital_stateId"> please select a state</label>
                                                    <label class="error" > <?php echo form_error("hospital_stateId"); ?></label>
                                                </div>
                                            </aside>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                            <aside class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <select class="selectpicker" data-width="100%" name="hospital_cityId" id="hospital_cityId" data-size="4">
                                                        <!--<option>Select City</option>
                                                        <option>Kolkata</option>
                                                        <option>Delhi</option>-->
                                                    </select>
                                                    <label class="error" style="display:none;" id="error-hospital_cityId"> please select a city</label>
                                                </div>
                                                <div class="col-md-6 col-sm-6 m-t-xs-10"> 
                                                    <input type="text" class="form-control" id="hospital_zip" name="hospital_zip" placeholder="700001" onkeypress="return isNumberKey(event)" maxlength="6" minlength="6" />
                                                    <label class="error" style="display:none;" id="error-hospital_zip"> please enter a zip code</label>
                                                    <label class="error" style="display:none;" id="error-hospital_zip_check">Please enter numeric digits only!</label>
                                                    <label class="error" style="display:none;" id="error-hospital_zip_long"> zip code should be 6 digit long</label>
                                                    <label class="error" > <?php echo form_error("hospital_zip"); ?></label>
                                                </div>
                                            </aside>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                            <input type="text" class="form-control" id="geocomplete" name="hospital_address" placeholder="209, ABC Road, near XYZ Building " />
                                            <label class="error" style="display:none;" id="error-hospital_address"> please enter an address</label>
                                            <label class="error" > <?php echo form_error("hospital_address"); ?></label>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4  col-sm-4">Phone:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <a href="javascript:void(0)" class="add pull-right" onclick="countPhoneNumber()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a>
                                            <aside class="row clone">
                                                <div class="col-lg-3 col-md-4 col-sm-3 col-sm-4 col-xs-12 m-t-xs-10" id="multiPreNumber">
                                                    <select class="selectpicker" data-width="100%" name="pre_number[]" id="multiPreNumber">
                                                        <option value ='91'>+91</option>
                                                        <option value ='1'>+1</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-7 col-md-6 col-sm-7 col-xs-10 m-t-xs-10" id="multiPhoneNumber">
                                                    <input type="text" class="form-control" name="hospital_phn[]" id="hospital_phn1" placeholder="9837000123" maxlength="10" onkeypress="return isNumberKey(event)" />
                                                    <label class="error" style="display:none;" id="error-hospital_phn"> please enter a valid phone number</label>
                                                    <label class="error" > <?php echo form_error("hospital_phn"); ?></label>
                                                </div>
                                            </aside>
                                            <p class="m-t-10">* If it is landline, include Std code with number </p>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4  col-sm-4">Hospital Services:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <a href="javascript:void(0)" class="add pull-right" onclick="countserviceName()" ><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a>
                                           
                                            <aside class="row">
                                                
                                                <div class="col-lg-10 col-md-10 col-sm-7 col-xs-10 m-t-xs-10" id="multiserviceName">
                                                    <input type="text" class="form-control" name="hospitalServices_serviceName[]" id="hospitalServices_serviceName1" placeholder="Give Your Service Name" maxlength="30" />
                                                    <label class="error" style="display:none;" id="error-hospitalServices_serviceName"> please enter a hospital service Name without Numeric value</label>
                                                    <label class="error" > <?php echo form_error("hospitalServices_serviceName"); ?></label>
                                                    
                                                </div>
                                               

                                            </aside>
                                           
                                        </div>
                                    </article>
                                   

                                    <article class="form-group m-lr-0 ">
                                        <label for="cemail" class="control-label col-md-4  col-sm-4">Contact Person :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" id="hospital_cntPrsn" name="hospital_cntPrsn" type="text" required="">
                                            <label class="error" style="display:none;" id="error-hospital_cntPrsn"> please enter the name of a contact person</label>
   <label class="error" style="display:none;" id="error-hospital_cntPrsn_check">please enter characters only!</label>
                                            <label class="error" > <?php echo form_error("hospital_cntPrsn"); ?></label>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0 ">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Designation :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" id="hospital_dsgn" name="hospital_dsgn" type="text" required="">
                                            <label class="error" style="display:none;" id="error-hospital_dsgn"> please enter a designation</label>
<label class="error" style="display:none;" id="error-hospital_dsgn_check">please enter only charcters!</label>
                                            <label class="error" > <?php echo form_error("hospital_dsgn"); ?></label>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Membership Type :</label>
                                        <div class="col-md-8  col-sm-8">
                                            <select class="selectpicker" data-width="100%" name="hospital_mmbrTyp" id="hospital_mmbrTyp">
                                                <option value="1">Life Time</option>
                                                <option value="2">Health Club</option>
                                            </select>
                                            <label class="error" style="display:none;" id="error-hospital_mmbrTyp"> please select a member type</label>
                                            <label class="error" > <?php echo form_error("hospital_mmbrTyp"); ?></label>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">About Us :</label>
                                        <div class="col-md-8  col-sm-8">
                                           <textarea class="form-control" name="hospital_aboutUs" id="hospital_aboutUs"  value=""> </textarea>
                                            <label class="error" > <?php echo form_error("hospital_aboutUs"); ?></label>
                                            <label class="error" style="display:none;" id="error-hospital_aboutUs"> Please write about the hospital!</label>
                                           
                                        </div>
                                    </article>
                                    
                                    <!-- Extra Check box section -->
                                    
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-12">Do you also provide following in same campus ? </label>
                                        <div class="col-md-12 ">


                                            <article class="clearfix m-t-10">
                                                <label class="control-label col-md-4 col-xs-9" for="cname">Bloodbank </label>
                                                <div class="col-md-8 col-xs-3">
                                                    <aside class="checkbox checkbox-success m-t-5">
                                                        <input type="checkbox" id="bloodbank" name="bloodbank_chk" value="1">
                                                        <label>

                                                        </label>
                                                    </aside>
                                                </div>
                                            </article>
                                            
                                            <section class="clearfix m-t-10" id="bloodbankOption" style="display:none">
                                                <article class="form-group m-lr-0 ">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Name : </label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <input class="form-control" id="bloodBank_name" name="bloodBank_name" type="text" required="" maxlength="30" onblur="bbname();">
                                                        <label class="error" style="display:none;" id="error-bloodBank_name"> please Check your BloodBank name</label>
                                                    </div>
                                                </article>
                                                <article class="form-group m-lr-0 ">
                                                    <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                                                    <div class="col-md-8 col-sm-8 text-right">
                                                        <label for="file-input2"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x"></i></label>
                                                    <input  type="file" style="display:none;" class="no-display" id="file-input2" name="bloodBank_photo" onchange="ValidateSingleInput(this,'2','5');">
                                                       
                                                    </div>
                                                </article>
                                                
                                                <article class="form-group m-lr-0">
                                                    <label for="cname" class="control-label col-md-4 col-sm-4">Phone:</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <!--<a href="javascript:void(0)" class="aaaa pull-right" rel=".clone">
                                                            <i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a>-->
                                                        <aside class="row">
                                                            <div class="col-md-3 col-sm-3 col-xs-12" id="multiBloodbnkPreNumber">
                                                                <select class="selectpicker" data-width="100%" id="preblbankNo1" name="preblbankNo[]">
                                                                    <option value='91'>+91</option>
                                                                    <option value ='1'>+1</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-7 col-sm-7 col-xs-10 m-t-xs-10" id="multiBloodbnkPhoneNumber">
                                                                <input type="text" class="form-control" name="bloodBank_phn[]" id="bloodBank_phn1" placeholder="9837000123" maxlength="10" onblur="bbphone()" onkeypress="return isNumberKey(event)" />
                                                                 <label class="error" style="display:none;" id="error-bloodBank_phone"> please Check your BloodBank Phone</label>
                                                            </div>
                                                            <div class="col-md-2 col-sm-2 col-xs-2 m-t-xs-10">
                                                            </div>
                                                            <a href="javascript:void(0)" onclick="countBloodPhoneNumber()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a>

                                                        </aside>
                                                        <p class="m-t-10">* If it is landline, include Std code with number </p>
                                                    </div>
                                                </article>




                                            </section>

                                            <article class="clearfix">
                                                <label class="control-label col-md-4 col-xs-9" for="cname">Pharmacy </label>
                                                <div class="col-md-8 col-xs-3">
                                                    <aside class="checkbox checkbox-success m-t-5">
                                                        <input type="checkbox" id="pharmacy" name="pharmacy_chk" value="1">
                                                        <label>

                                                        </label>
                                                    </aside>
                                                </div>
                                            </article>
                                            <section class="clearfix m-t-10" id="pharmacyOption" style="display:none">
                                                <article class="form-group m-lr-0 ">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Name : </label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <input class="form-control" id="pharmacy_name" name="pharmacy_name" type="text" required="" maxlength="30" onblur="phname()">
                                                        <label class="error" style="display:none;" id="error-pharmacy_name"> please Check your Pharmacy Name</label>
                                                    </div>
                                                </article>
                                                <article class="form-group m-lr-0 ">
                                                    <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                                                    <div class="col-md-8 col-sm-8 text-right">
                                                        <label for="file-input3"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x"></i></label>
                                                        <input type="file" style="display:none;" class="no-display" id="file-input3" name="pharmacy_img" onchange="ValidateSingleInput(this,'2','5');">
                                                    </div>
                                                </article>
                                                <article class="form-group m-lr-0">
                                                    <label for="cname" class="control-label col-md-4 col-sm-4">Phone:</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <aside class="row">
                                                            <div class="col-md-3 col-sm-3 col-xs-12" id="multipharmacyPreNumber">
                                                                <select class="selectpicker" data-width="100%" name="prePharmacy[]" id="prePharmacy1">
                                                                    <option value='91'>+91</option>
                                                                    <option value='1'>+1</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-7 col-sm-7 col-xs-10 m-t-xs-10" id="multipharmacyNumber" >
                                                                <input type="text" class="form-control" name="pharmacy_phn[]" id="pharmacy_phn1" placeholder="9837000123" maxlength="10" onblur="phphone()" onkeypress="return isNumberKey(event)"/>
                                                                <label class="error" style="display:none;" id="error-pharmacy_phn1"> please Check your Pharmacy Phone</label>
                                                            </div>
                                                            <div class="col-md-2 col-sm-2 col-xs-2 m-t-xs-10">
                                                            </div>
                                                            <a href="javascript:void(0)" onclick="countPharmacyPhoneNumber()"> <i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i><a>

                                                        </aside>
                                                        <p class="m-t-10">* If it is landline, include Std code with number </p>
                                                    </div>
                                                </article>
                                            </section>

                                            <article class="clearfix">
                                                <label class="control-label col-md-4 col-xs-9" for="cname">Ambulance </label>
                                                <div class="col-md-8 col-xs-3">
                                                    <aside class="checkbox checkbox-success m-t-5">
                                                        <input type="checkbox" id="ambulance" name="ambulance_chk" value="1">
                                                        <label>

                                                        </label>
                                                    </aside>
                                                </div>
                                            </article>
                                            <section class="clearfix m-t-10" id="ambulanceOption" style="display:none">
                                                <article class="form-group m-lr-0 ">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Name : </label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <input class="form-control" id="ambulance_name" name="ambulance_name" type="text" required="" maxlength="30" onblur="amname()">
                                                        <label class="error" style="display:none;" id="error-ambulance_name"> please Check your Ambulance Name</label>
                                                    </div>
                                                </article>
                                                <article class="form-group m-lr-0 ">
                                                    <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                                                    <div class="col-md-8 col-sm-8 text-right">
                                                    
                                                      <label for="file-input4"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x"></i></label>
                                                        <input type="file" style="display:none;" class="no-display" id="file-input4" name='ambulance_img' onchange="ValidateSingleInput(this,'2','5');" >
                                                        
                                                 
                                                    </div>
                                                </article>
                                                <article class="form-group m-lr-0">
                                                    <label for="cname" class="control-label col-md-4 col-sm-4">Phone:</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <aside class="row">
                                                            <div class="col-md-3 col-sm-3 col-xs-12" id="preAmbulance_name">
                                                                <select class="selectpicker" data-width="100%" name="preAmbulance[]" id="preAmbulance1">
                                                                    <option value='91'>+91</option>
                                                                    <option value='1'>+1</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-7 col-sm-7 col-xs-10 m-t-xs-10" id="phoneAmbulance">
                                                                <input type="text" class="form-control" name="ambulance_phn[]" id="ambulance_phn1" placeholder="9837000123" maxlength="10" onblur="amphone()" onkeypress="return isNumberKey(event)"/>
                                                                <label class="error" style="display:none;" id="error-ambulance_phn1"> please Check your Ambulance Phone</label>
                                                            </div>
                                                            <div class="col-md-2 col-sm-2 col-xs-2 m-t-xs-10">
                                                            </div>
                                                            <a href="javascript:void(0)" onclick="countAmbulancePhoneNumber()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a>

                                                        </aside>
                                                        <p class="m-t-10">* If it is landline, include Std code with number </p>
                                                    </div>
                                                </article>
                                            </section>


                                            <article class="clearfix">
                                                <label class="control-label col-md-4 col-xs-9" for="cname">Emergency Ward</label>
                                                <div class="col-md-8 col-xs-3">
                                                    <aside class="checkbox checkbox-success m-t-5">
                                                        <input type="checkbox" id="isEmergency" name="isEmergency" value="1">
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



                        <!-- Right Section Start -->
                        <section class="col-md-6 detailbox mi-form-section">
                            <div class="bg-white clearfix">
                                <!-- Feature Access Section Start -->
                            <!--    <div>
                                    <figure class="clearfix">
                                        <h3>Feature Access</h3>
                                    </figure>


                                    <article class="clearfix m-t-10">
                                        <label class="control-label col-md-6 col-xs-9" for="cname"> Doctor Management</label>
                                        <div class="col-md-6 col-xs-3">
                                            <aside class="checkbox checkbox-success m-t-5">
                                                <input type="checkbox" id="checkbox3">
                                                <label>

                                                </label>
                                            </aside>
                                        </div>
                                    </article>

                                    <article class="clearfix">
                                        <label class="control-label col-md-6 col-xs-9" for="cname"> App Consultation Booking </label>
                                        <div class="col-md-6 col-xs-3">
                                            <aside class="checkbox checkbox-success m-t-5">
                                                <input type="checkbox" id="checkbox3">
                                                <label>

                                                </label>
                                            </aside>
                                        </div>
                                    </article>

                                    <article class="clearfix">
                                        <label class="control-label col-md-6 col-xs-9" for="cname">Diagnostic Management </label>
                                        <div class="col-md-6 col-xs-3">
                                            <aside class="checkbox checkbox-success m-t-5">
                                                <input type="checkbox" id="checkbox3">
                                                <label>

                                                </label>
                                            </aside>
                                        </div>
                                    </article>

                                    <article class="clearfix">
                                        <label class="control-label col-md-6 col-xs-9" for="cname">App Diagnostic Booking </label>
                                        <div class="col-md-6 col-xs-3">
                                            <aside class="checkbox checkbox-success m-t-5">
                                                <input type="checkbox" id="checkbox3">
                                                <label>

                                                </label>
                                            </aside>
                                        </div>
                                    </article>

                                    <article class="clearfix">
                                        <label class="control-label col-md-6 col-xs-9" for="cname">Healthcare Packages </label>
                                        <div class="col-md-6 col-xs-3">
                                            <aside class="checkbox checkbox-success m-t-5">
                                                <input type="checkbox" id="checkbox3">
                                                <label>

                                                </label>
                                            </aside>
                                        </div>
                                    </article>

                                    <article class="clearfix">
                                        <label class="control-label col-md-6 col-xs-9" for="cname">Healthcare Package Booking </label>
                                        <div class="col-md-6 col-xs-3">
                                            <aside class="checkbox checkbox-success m-t-5">
                                                <input type="checkbox" id="checkbox3">
                                                <label>

                                                </label>
                                            </aside>
                                        </div>
                                    </article>
                                
                                </div>    -->

                                <!-- Feature Access Section End -->


                                <!-- Account Detail Section Start -->
                                <figure class="clearfix">
                                    <h3>Account Detail</h3>
                                </figure>
                                <aside class="clearfix m-t-20 p-b-20">
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Registered Email Id:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="email" class="form-control" id="users_email" name="users_email" placeholder="abc@gmail.com" onblur="checkEmailFormat()" />
                                            <label class="error" style="display:none;" id="error-users_email"> please enter Email id Properly</label>
                                            <label class="error" style="display:none;" id="error-users_email_check"> Email Already Exits!</label>
                                            <label class="error" > <?php echo form_error("users_email"); ?></label>
                                            <input type="hidden" class="form-control" id="users_email_status" name="users_email_status" value="" />
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Registered Mobile no. :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="text" class="form-control" id="hospital_mblNo" name="hospital_mblNo" placeholder="8880007755" maxlength="10" onkeypress="return isNumberKey(event)" />
                                            <label class="error" style="display:none;" id="error-hospital_mblNo"> please enter your mobile number</label>
                                        <label class="error" style="display:none;" id="error-hospital_mblNo_check">please enter digits only!</label>
                                            <label class="error" > <?php echo form_error("hospital_mblNo"); ?></label>

                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Enter Password :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="password" class="form-control" id="users_password" name="users_password" placeholder=" " />
                                            <label class="error" style="display:none;" id="error-users_password"> please enter password and shoul be 6 chracter</label>
                                            <label class="error" > <?php echo form_error("users_password"); ?></label>
                                        </div>
                                    </article>

                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Confirm Password :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="password" class="form-control" id="cnfPassword" name="cnfPassword" placeholder=" " />
                                           <!-- <label class="error" style="display:none;" id="error-cnfPassword"> please enter the password</label>-->
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
                                <button class="btn btn-danger waves-effect pull-right" type="button">Reset</button>
                <div>
                    <input class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit" value="Submit" onclick="return validationHospital()" />
                </div>
                            </div>

                        </section>
                        
                            <fieldset>
                            
                            <input name="lat" type="hidden" value="" />

                           <!-- <label>Longitude</label> -->
                            <input name="lng" type="hidden" value="" />

                          </fieldset>
                         <div id="upload_modal_form">
                            <?php $this->load->view('upload_crop_modal');?>
                        </div>
                    </form>
                </div>

                <!-- container -->
            </div>
            <!-- content -->
          
        </div>
        <!-- End Right content here -->
  
    <!-- END wrapper -->


