    <!-- Start right Content here -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <!-- consultation -->
                <div style="display:show;" id="consultDiv">
                    <div class="clearfix">
                        <?php $succ_msg = $this->session->flashdata('message'); 
                        if(isset($succ_msg) && $succ_msg != ''){ ?>
                        <div class="col-md-12 text-success alert alert-success">
                            <?php echo $this->session->flashdata('message'); ?>
                        </div>
                        <?php } ?>
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Add New Doctor</h3>

                        </div>
                    </div>
                    <div class="map_canvas"></div>
                    <form class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" method="post" action="<?php echo site_url('doctor/saveDoctor'); ?>" novalidate="novalidate" name="doctorForm" enctype="multipart/form-data">
                        <input type="hidden" name="ProfessionalExpCount" id="ProfessionalExpCount" value="1" />
                        <!-- Left Section Start -->
                        <section class="col-md-6 detailbox">
                            <div class="bg-white mi-form-section">
                                <figure class="clearfix">
                                    <h3>General Detail</h3>
                                </figure>
                                <!-- Table Section End -->
                                <div class="clearfix m-t-20">
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Registered Email Id:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="hidden" name="referralId" id="referralId" value="<?php if($this->uri->segment(4) != NULL){ echo $this->uri->segment(4); } ?>">
                                            <input type="hidden" name="pRoleId" id="pRoleId" value="<?php if($this->uri->segment(5) != NULL){ echo $this->uri->segment(5); } ?>">
                                            <input type="email" class="form-control" id="users_email" name="users_email" placeholder="Email" value="<?php if($this->uri->segment(3) != ''){ echo urldecode($this->uri->segment(3)); }else{ echo set_value('users_email'); } ?>" onblur="checkEmailFormat()"/>
                                            <label class="error" style="display:none;" id="error-users_email"> please enter Email id Properly</label>
                                            <label class="error" style="display:none;" id="error-users_email_check"> Doctor Email Already Exists!</label>
                                            <label class="error" > <?php echo form_error("users_email"); ?></label>
                                            <input type="hidden" class="form-control" id="users_email_status" name="users_email_status" value="" />
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0 ">
                                        <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                                        <div class="col-md-8 col-sm-8 text-right avatar-view">
                                            <label for="file-input"><i id="image_select" style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x "></i></label>
                                            <img src="<?php echo base_url('assets/default-images/Doctor-logo.png'); ?>" width="70" height="65" class="image-preview-show"/>
                                        </div>
                                        <label class="error pull-right" id="error-avatarInput" style="display: none">Please Select Image</label>
                                        <label class="error" > <?php echo form_error("avatar_file"); ?></label>
                                        <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="" class="control-label col-md-4 col-sm-4">First Name :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control " id="doctors_fName" type="text" name="doctors_fName" value="<?php echo set_value('doctors_fName'); ?>" placeholder="First Name" >
                                             <label class="error" style="display:none;" id="error-doctors_fName"> Please enter doctor's First name</label>
                                            <label class="error" > <?php echo form_error("doctors_fName"); ?></label>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="" class="control-label col-md-4 col-sm-4">Last Name :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control " id="doctors_lName" type="text" name="doctors_lName" value="<?php echo set_value('doctors_lName'); ?>" placeholder="Last Name"/>
                                            <label class="error" style="display:none;" id="error-doctors_lName"> Please enter doctor's Last name</label>
                                            <label class="error" > <?php echo form_error("doctors_lName"); ?></label>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Date of Birth :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <div class="input-group">
                                                <input class="form-control pickDate" placeholder="dd/mm/yyyy" id="doctors_dob" type="text" name="doctors_dob" value="<?php echo set_value('doctors_dob'); ?>">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                            <label class="error" style="display:none;" id="error-doctors_dob"> Please enter doctor's DOB</label>
                                            <label class="error" > <?php echo form_error("doctors_dob"); ?></label>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="" class="control-label col-md-4 col-sm-4">Speciality:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select  multiple="" class="bs-select form-control-select2 " data-width="100%" name="doctorSpecialities_specialitiesId[]" Id="doctorSpecialities_specialitiesId" data-size="4">
                                                    <!--<option value="">Select Speciality</option>-->
                                                   <?php foreach($speciality as $key=>$val) {?>
                                                    <option value="<?php echo $val->specialities_id;?>"><?php echo $val->specialities_name;?></option>
                                                     <?php }?>
                                                </select>
                                            <div class='setValues'></div>
                                            <label class="error" style="display:none;" id="error-doctorSpecialities_specialitiesId"> Please select speciality(s)</label>
                                            <label class="error" > <?php echo form_error("doctorSpecialities_specialitiesId"); ?></label>
                                        </div>
                                    </article>
                                    <div id="multiplePhoneNumber">
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Contact No.:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <aside class="row">
                                                <div class="col-md-12 col-sm-4 col-xs-10 m-t-xs-10 ">
                                                    <input type="text" class="form-control" name="doctors_phn" id="doctors_phn" maxlength="10" placeholder="Contact Number" onblur="checkNumber('doctors_phn',1)" onkeypress="return isNumberKey(event)" />
                                                </div>
<!--                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 m-t-xs-10"><a onclick="addPhoneNumber()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a></div>-->
                                            </aside>
                                            <label class="error" style="display:none;" id="error-doctors_phn1"> Please select your phone number</label>
                                        </div>
                                    </article>
                                    </div>    
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Address:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <aside class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <select class="selectpicker" data-width="100%" name="doctors_countryId" id="doctors_countryId">
                                                        <option value="1">India</option>
                                                    </select>
                                                </div>
                                                 <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                    <select class="selectpicker" data-width="100%" name="doctors_stateId" Id="doctors_stateId" data-size="4" onchange ="fetchCity(this.value)">
                                                    <option value="">Select State</option>
                                                   <?php foreach($allStates as $key=>$val) {?>
                                                    <option value="<?php echo $val->state_id;?>"><?php echo $val->state_statename;?></option>
                                                     <?php }?>
                                                </select>
                                                <label class="error" style="display:none;" id="error-doctors_stateId"> please select a state</label>
                                                <label class="error" > <?php echo form_error("doctors_stateId"); ?></label>
                                            </div>
                                            </aside>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <div class="col-md-8 col-md-offset-4 col-sm-4 col-sm-offset-4">
                                            <aside class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <select class="selectpicker" data-width="100%" name="doctors_cityId" id="doctors_cityId" data-size="4" >
                                                    </select>
                                                     <label class="error" style="display:none;" id="error-doctors_cityId"> please select a state</label>
                                                    <label class="error" > <?php echo form_error("doctors_cityId"); ?></label>
                                                </div>
                                                <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                    <input type="text" class="form-control" id="doctors_pinn" name="doctors_pinn" placeholder="Pin Code" maxlength="6" onkeypress="return isNumberKey(event)" value="<?php echo set_value('doctors_pinn'); ?>" />
                                                    <label class="error" style="display:none;" id="error-doctors_pinn"> Zip code should be numeric and 6 digit long</label>
                                                    <label class="error" > <?php echo form_error("doctors_pinn"); ?></label>
                                                </div>
                                            </aside>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0 m-t-10">
                                        <div class="col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4">
                                            <input type="text" class="form-control" id="geocomplete1" name="doctor_addr" placeholder="Address" value="<?php echo set_value('doctor_addr'); ?>" />
                                            <label class="error" style="display:none;" id="error-doctor_addr"> please select a pin number</label>
                                            <label class="error" > <?php echo form_error("doctor_addr"); ?></label>
                                        </div>
                                    </article>
                                    <article class="clearfix">
                                        <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                            <aside class="row">
                                            <div class="col-sm-6">
                                                <input name="lat" class="form-control" required="" type="text" value="<?php echo set_value('lat'); ?>"  id="lat" readonly="" placeholder="Latitude" onchange="latChack(this.value)" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="9"/>
                                                <label class="error" > <?php echo form_error("lat"); ?></label>
                                                <label class="error" style="display:none;" id="error-lat">Please enter the correct format for latitude</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="lng" required="" type="text" value="<?php echo set_value('lng'); ?>"  id="lng" readonly="" class="form-control" placeholder="Longitude" onChange="lngChack(this.value)" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="9"/>
                                                <label class="error" > <?php echo form_error("lng"); ?></label>
                                                <label class="error" style="display:none;" id="error-lng"> Please enter the correct format for longitude</label>
                                             </div>
                                          </aside>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="" class="control-label col-md-4 col-sm-4">Consultation Fee :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" id="doctors_consultaionFee" name="doctors_consultaionFee" type="text" onkeypress="return isNumberKey(event)" value="<?php echo set_value('doctors_consultaionFee'); ?>" maxlength="7" placeholder="Consultation Fee"/>
                                            <label class="error" style="display:none;" id="error-doctors_consultaionFee"> please enter fees</label>
                                            <label class="error" > <?php echo form_error("doctors_consultaionFee"); ?></label>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0" id="doctorService">
                                        <label for="" class="control-label col-md-4 col-sm-4">Doctor Services :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="hidden" id="totalService" name="totalService" value="1">
                                            <input class="form-control" id="doctors_service_1" name="doctors_service_1" type="text" value="<?php echo set_value('doctors_service_1'); ?>" maxlength="50"/>
                                            <label class="error" style="display:none;" id="error-doctors_service"> please enter Service</label>
                                            <label class="error" > <?php echo form_error("doctors_service_1"); ?></label>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <div class="col-md-8 col-md-offset-4">
                                            <button class="btn btn-success waves-effect waves-light m-r-20" type="button" onclick="multipleService()">Add More</button>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4"> Doctor On Call ? </label>
                                        <div class="col-md-8 col-sm-8">
                                            <aside class="radio radio-info radio-inline">
                                                <input type="radio" id="inlineRadio1" value="1" name="doctors_27Src" checked>
                                                <label for="inlineRadio1"> Yes</label>
                                            </aside>
                                            <aside class="radio radio-info radio-inline">
                                                <input type="radio" id="inlineRadio2" value="0" name="doctors_27Src">
                                                <label for="inlineRadio2"> No</label>
                                            </aside>
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
                                <!-- Degree  Start -->
                                <figure class="clearfix">
                                    <h3>Academic Detail</h3>
                                </figure>
                                <aside class="clearfix m-t-20">
                                    <article class="form-group m-lr-0">
                                        <div class="col-md-12">
                                            <div id="parentDegreeDiv">
                                                <div id="childDegreeDiv1">
                                                    <aside class="row">
                                                        <label for="cname" class="control-label col-md-4">Degree</label>
                                                        <div class="col-md-4 col-sm-4">
                                                            <select class="selectpicker" data-width="100%" data-size="4" name="doctorAcademic_degreeId[]" id="doctorAcademic_degreeId1">
                                                                 <option value="">Select Degree </option>
                                                                <?php foreach($degree as $key=>$val){?>
                                                                <option value="<?php echo $val->degree_id;?>"><?php echo $val->degree_SName;?></option>
                                                                <?php }?>
                                                            </select>
                                                            <label class="error" style="display:none;" id="error-doctorAcademic_degreeId1"> please select Degree</label>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 m-t-xs-10">
                                                            <select class="selectpicker" data-width="100%" data-size="4" name="doctorSpecialities_specialitiesCatId[]" id="doctorSpecialities_specialitiesCatId1">
                                                                  <option value="">Select Specialities </option>
                                                                <?php foreach($speciality as $key=>$val) {?>
                                                            <option value="<?php echo $val->specialities_id;?>"><?php echo $val->specialities_name;?></option>
                                                             <?php }?>
                                                            </select>
                                                            <label class="error" style="display:none;" id="error-doctorSpecialities_specialitiesCatId1"> please select Specialities</label>
                                                        </div>
                                                    </aside>
                                                    <aside class="row">
                                                        <label for="cname" class="control-label col-md-4 m-t-20">Address</label>
                                                        <div class="col-md-8 col-sm-8 m-t-20">
                                                            <textarea class="form-control" id="acdemic_addaddress1" name="acdemic_addaddress[]" required="" placeholder="Address"></textarea>
                                                            <label class="error" style="display:none;" id="error-acdemic_addaddress1"> please fill Address</label>
                                                        </div>
                                                        <label for="cname" class="control-label col-md-4">Year</label>
                                                        <div class="col-md-8 col-sm-8 m-b-20 m-t-10">
                                                            <input class="form-control" name="acdemic_addyear[]" required="" id="acdemic_addyear1" value="" onkeypress="return isNumberKey(event)" placeholder="Year" maxlength="4">
                                                            <label class="error" style="display:none;" id="error-acdemic_addyear1"> please fill Year</label>
                                                        </div>
                                                    </aside>
                                                    <br />
                                                </div>       
                                            </div>     
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <div class="col-md-8 col-md-offset-4">
                                            <button class="btn btn-success waves-effect waves-light m-r-20" type="button" onclick="multipleAcademic()">Add More</button>
                                        </div>
                                    </article>
                                    <!-- Degree End -->
                                    <!-- Experience Section Start -->
                                    <figure class="clearfix">
                                        <h3>Professional Experience</h3>
                                    </figure>
                                    <aside class="clearfix m-t-20">
                                        <div id="parentDIV"> 
                                            <div id="child1">
                                                <article class="form-group m-lr-0">
                                                <label for="cname" class="control-label col-md-4">Duration:</label>
                                                <div class="col-md-8">
                                                    <aside class="row">
                                                        <div class="col-lg-6 col-md-12 col-sm-6">
                                                            <div class="input-group">
                                                                <input class="form-control pickDate" placeholder="dd/mm/yyyy" id="professionalExp_start1" type="text" name="professionalExp_start1">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                            </div>
                                                            <label class="error" style="display:none;" id="error-professionalExp_start1"> please select Start date</label>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12 col-sm-6 m-t-md-15 m-t-xs-10">
                                                            <div class="input-group">
                                                                <input class="form-control pickDate" placeholder="dd/mm/yyyy" id="professionalExp_end1" type="text" name="professionalExp_end1">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                            </div>
                                                             <label class="error" style="display:none;" id="error-professionalExp_end1"> please select End date</label>
                                                        </div>
                                                    </aside>
                                                </div>
                                            </article>
                                                <article class="form-group m-lr-0">
                                                    <div class="col-md-8 col-md-offset-4">
                                                        <select class="select2" data-width="100%" onchange="fetchHospitalSpeciality(this.value,1)" name="professionalExp_hospitalId1" id="HospitalSpecialityId1">
                                                            <option value="">Select Hospital </option>
                                                            <?php foreach($hospital as $key=> $val){ ?>
                                                            <option value="<?php echo $val->hospital_id;?>"><?php echo $val->hospital_name;?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label class="error" style="display:none;" id="error-HospitalSpecialityId1"> please select Hospital</label>
                                                    </div>
                                                </article>
                                                <article class="form-group m-lr-0 " >

                                                    <div class="col-md-8 col-md-offset-4">
                                                        <select  multiple="" class="bs-select form-control-select2 " data-width="100%" name="doctorSpecialities_specialitiesId1[]" id="specialityDropdown1" data-size="4">
                                                                <option value="">Select Speciality </option>
                                                        </select> 
                                                        <label class="error" style="display:none;" id="error-specialityDropdown1"> please select Hospital Speciality</label>
                                                    </div>
                                                </article>
                                                <aside class="row">
                                                    <label for="cname" class="control-label col-md-4 m-t-10">Designation</label>
                                                    <div class="col-md-8 col-sm-8 m-b-20 m-t-10">
                                                        <input class="form-control" name="designation1" required="" id="designation1" placeholder="Designation" >
                                                        <label class="error" style="display:none;" id="error-designation1"> please fill Designation</label>
                                                    </div>
                                                </aside>
                                            </div>     
                                        </div>    
                                        <article class="form-group m-lr-0">
                                            <div class="col-md-8 col-md-offset-4">
                                                <button class="btn btn-success waves-effect waves-light m-r-20" type="button" onclick="multipleProfessionalExp()">Add More</button>
                                            </div>
                                        </article>

                                    </aside>
                                    <!-- Account Detail Section Start -->
                                    <figure class="clearfix">
                                        <h3>Account Detail</h3>
                                    </figure>
                                    <aside class="clearfix m-t-20 p-b-20">
                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4  col-sm-4">Registered Mobile no. :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input type="text" class="form-control" id="users_mobile" name="users_mobile" placeholder="Mobile Number" maxlength="10" value="<?php echo set_value('users_mobile'); ?>" onblur="checkNumber('users_mobile','')" onkeypress="return isNumberKey(event)"/>
                                                <label class="error" style="display:none;" id="error-users_mobile"> please enter your mobile number properly</label>
                                                <label class="error" > <?php echo form_error("users_mobile"); ?></label>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Enter Password :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input type="password" class="form-control" id="users_password" name="users_password" minlength="6"/>
                                                <label class="error" style="display:none;" id="error-users_password"> please enter password and it should be 6 chracter</label>
                                                <label class="error" > <?php echo form_error("users_password"); ?></label>
                                            </div>
                                        </article>
                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Confirm Password :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input type="password" class="form-control" id="cnfPassword" name="cnfPassword" placeholder=" " />
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
                                <div id="load_consulting" class="text-center text-success " style="display: none"><image alt="Please wait data is loading" src="<?php echo base_url('assets/images/loader/Heart_beat.gif'); ?>" /></div>
                                <button class="btn btn-danger waves-effect pull-right" type="button">Reset</button>
                                <button class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit" onclick="return validationDoctor()">Submit</button>
                            </div>
                        </section>
                        <div id="upload_modal_form">
                            <?php $this->load->view('upload_crop_modal');?>
                        </div>
                    </form>
                </div>
                <!-- consultation -->
                <!-- Right Section End -->
            </div>
            <!-- container -->
        </div>
        <!-- content -->