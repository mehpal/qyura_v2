
        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">
                    <!-- consultation -->

                    <div style="display:show;" id="consultDiv">
                        <div class="clearfix">
                            <div class="col-md-12 text-success">
                            <?php echo $this->session->flashdata('message'); ?>
                         </div>
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
                                        <article class="form-group m-lr-0 ">
                                            <label for="doctors_unqId" class="control-label col-md-4 col-sm-4">Doctor Id :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control disabled" id="doctors_unqId" name="doctors_unqId" type="disabled" required="" aria-required="true" placeholder="ACM304" readonly="readonly" value="<?php echo set_value('doctors_unqId'); ?>">
                                                 <label class="error" > <?php echo form_error("doctors_unqId"); ?></label>
                                            </div>
                                        </article>

                                        <!--<article class="form-group m-lr-0 ">
                                            <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Doctor Photo :</label>
                                            <div class="col-md-8 col-sm-8 text-right">
                                                <label for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x"></i></label>
                                                <input type="file" style="display:none;" class="no-display" id="file-input" name="doctors_img">
                                                <label class="error" > <?php echo form_error("doctors_img"); ?></label>
                                                <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                                            </div>
                                        </article>-->
                                        <article class="form-group m-lr-0 ">
                                        <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                                        <div class="col-md-8 col-sm-8 text-right">
                                            <label for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x avatar-view"></i></label>
<!--                                            <input type="file" style="display:none;" class="no-display" id="file-input" name="bloodBank_photo">-->
                                            <!-- <input type="file" style="display:none;" class="no-display avatar-view" id="file-input11" name="bloodBank_photo"> -->
                                            
                                           <!-- <label class="error" > <?php // echo form_error("bloodBank_photo"); ?></label> -->
                                            <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                                            <label class="error" > <?php echo form_error("avatar_file"); ?></label>
                                            <img src="<?php echo base_url('assets/images/noImage.png'); ?>" width="70" height="65" class="image-preview-show"/>
                                        </div>
                                    </article>

                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">First Name :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control " id="doctors_fName" type="text" name="doctors_fName" value="<?php echo set_value('doctors_fName'); ?>">
                                                 <label class="error" style="display:none;" id="error-doctors_fName"> Please enter doctor's First name</label>
                                                <label class="error" > <?php echo form_error("doctors_fName"); ?></label>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Last Name :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control " id="doctors_lName" type="text" name="doctors_lName" value="<?php echo set_value('doctors_lName'); ?>" />
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
                                                     <label class="error" style="display:none;" id="error-doctors_dob"> Please enter doctor's DOB</label>
                                                     <label class="error" > <?php echo form_error("doctors_dob"); ?></label>
                                                </div>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Speciality:</label>
                                            <div class="col-md-8 col-sm-8">
                                                <!--<input class="form-control " id="emailId" type="text" name="speciality" placeholder="Add Speciality">
                                                <ul class="ul-labeled">
                                                    <li class="label label-select">Cardiology<span class="badge"><i class="fa fa-close"></i></span></li>
                                                    <li class="label label-select">ENT<span class="badge"><i class="fa fa-close"></i></span></li>
                                                </ul> -->
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
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Landline Phone:</label>
                                             
                                            <div class="col-md-8 col-sm-8">
                                               
                                                <aside class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <select class="selectpicker" data-width="100%" name='preNumber[]' id="preNumber">
                                                            <option value='91'>+91</option>
                                                            <option value='1'>+1</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 m-t-xs-10">
                                                        <input type="text" class="form-control" name="midNumber[]" id="midNumber1" placeholder="731" maxlength="3" onblur="checkNumber('midNumber',1)" onkeypress="return isNumberKey(event)" />
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-10 m-t-xs-10 ">
                                                        <input type="text" class="form-control" name="doctors_phn[]" id="doctors_phn1" maxlength="8" placeholder="7000123" onblur="checkNumber('doctors_phn',1)" onkeypress="return isNumberKey(event)" />
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 m-t-xs-10"><a onclick="addPhoneNumber()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a></div>
                                                        
                                                </aside>
                                                <label class="error" style="display:none;" id="error-doctors_phn1"> Please select your phone number</label>
                                                     
                                            </div>
                                        </article>
                                        </div>    
                                         <div id='multipleMobile'>
                                             
                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Mobile:</label>
                                            <div class="col-md-8 col-sm-8">
                                                
                                               
                                                <aside class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <select class="selectpicker" data-width="100%" name="preMobileNumber[]" id="preMobileNumber1">
                                                            <option value="91">+91</option>
                                                            <option value="1">+1</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-10 m-t-xs-10">
                                                        <input type="text" class="form-control" name="doctors_mobile[]" id="doctors_mobile1" placeholder="9837000123" onblur="checkNumber('doctors_mobile',1)" maxlength="10" onkeypress="return isNumberKey(event)" />
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 m-t-xs-10"><a  onclick="addMobileNumber()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a></div>
                                                    
                                                   <label class="error" style="display:none;" id="error-doctors_mobile1"> Please select your mobile number</label>
                                                </aside>
                                              
                                                <aside class="checkbox checkbox-success">
                                                    <input type="checkbox" id="checkbox1" name="checkbox1" value="1">
                                                    <label for="checkbox3">
                                                        Make this number primary
                                                    </label>
                                                </aside>
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
                                                            <!--<option>Kolkata</option>
                                                            <option>Delhi</option>-->
                                                        </select>
                                                         <label class="error" style="display:none;" id="error-doctors_cityId"> please select a state</label>
                                                        <label class="error" > <?php echo form_error("doctors_cityId"); ?></label>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                        <input type="text" class="form-control" id="doctors_pinn" name="doctors_pinn" placeholder="700001" maxlength="6" onkeypress="return isNumberKey(event)" value="<?php echo set_value('doctors_pinn'); ?>" />
                                                        <label class="error" style="display:none;" id="error-doctors_pinn"> Zip code should be numeric and 6 digit long</label>
                                                        <label class="error" > <?php echo form_error("doctors_pinn"); ?></label>
                                                    </div>
                                                </aside>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <div class="col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4">
                                                <input type="text" class="form-control" id="geocomplete" name="doctor_addr" placeholder="209, ABC Road, near XYZ Building " value="<?php echo set_value('doctor_addr'); ?>" />
                                                <label class="error" style="display:none;" id="error-doctor_addr"> please select a pin number</label>
                                                  <label class="error" > <?php echo form_error("doctor_addr"); ?></label>
                                            </div>
                                        </article>
                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Consultation Fee :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control" id="doctors_consultaionFee" name="doctors_consultaionFee" type="text" onkeypress="return isNumberKey(event)" value="<?php echo set_value('doctors_consultaionFee'); ?>" maxlength="7"/>
                                                <label class="error" style="display:none;" id="error-doctors_consultaionFee"> please enter fees</label>
                                                <label class="error" > <?php echo form_error("doctors_consultaionFee"); ?></label>
                                            </div>
                                        </article>
<!--                                        <article class="form-group m-lr-0" id="doctorService">
                                            <label for="" class="control-label col-md-4 col-sm-4">Doctor Services :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control" id="doctors_service" name="doctors_service[]" type="text" value="<?php echo set_value('doctors_service[]'); ?>" maxlength="50"/>
                                                <label class="error" style="display:none;" id="error-doctors_service"> please enter Service</label>
                                                <label class="error" > <?php echo form_error("doctors_service[]"); ?></label>
                                            </div>
                                        </article>-->
                                        <article class="form-group m-lr-0">
                                            <div class="col-md-8 col-md-offset-4">
                                               <!-- <button class="btn btn-danger waves-effect" type="button">Delete</button> -->
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
                                                                <textarea class="form-control" id="acdemic_addaddress1" name="acdemic_addaddress[]" required=""></textarea>
                                                                <label class="error" id="err_acdemic_addaddress1" > <?php echo form_error("acdemic_addaddress1"); ?></label>
                                                            </div>
                                                            <label for="cname" class="control-label col-md-4">Year</label>
                                                            <div class="col-md-8 col-sm-8 m-b-20">
                                                                <input class="form-control" name="acdemic_addyear[]" required="" id="acdemic_addyear1" value="" onkeypress="return isNumberKey(event)">
                                                                <label class="error" id="err_addacdemic_year1" > <?php echo form_error("acdemic_addyear1"); ?></label>
                                                            </div>
                                                        </aside>
                                                        <br />
                                                    </div>       
                                                </div>     
                                            </div>
                                        </article>
                                        <!-- this section is need to implemented -->
                                       <!-- <article class="form-group m-lr-0">
                                            <div class="col-md-8 col-md-offset-4">
                                                <a href="#">degree.certificate.png</a>
                                                <span class="fa-icon">
                                                    <a href="#"><i class="fa fa-search"></i></a>
                                                    <a href="#"><i class="fa fa-trash"></i></a>
                                                </span>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <div class="col-md-8 col-md-offset-4">
                                                <a href="#">degree.certificate.png</a>
                                                <span class="fa-icon">
                                                    <a href="#"><i class="fa fa-search"></i></a>
                                                    <a href="#"><i class="fa fa-trash"></i></a>
                                                    <a href="#"><i class="fa fa-plus"></i></a>
                                                </span>
                                            </div>
                                        </article> -->

                                        <article class="form-group m-lr-0">
                                            <div class="col-md-8 col-md-offset-4">
                                               <!-- <button class="btn btn-danger waves-effect" type="button">Delete</button> -->
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
                                                            <select class="select2" data-width="100%" onchange="fetchHospitalSpeciality(this.value,1)" name="professionalExp_hospitalId1" id="HospitalSpecialityId">
                                                                <option value="">Select Hospital </option>
                                                                <?php foreach($hospital as $key=> $val){ ?>
                                                                <option value="<?php echo $val->hospital_id;?>"><?php echo $val->hospital_name;?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <label class="error" style="display:none;" id="error-HospitalSpecialityId"> please select Hospital</label>
                                                        </div>
                                                        
                                                    </article>

                                                    <article class="form-group m-lr-0 " >

                                                        <div class="col-md-8 col-md-offset-4">
                                                           <!-- <input class="form-control " id="speciality" type="text" name="speciality" placeholder="Add Speciality" readonly="readonly">
                                                            <ul class="ul-labeled">
                                                                <li class="label label-select">Cardiology<span class="badge"><i class="fa fa-close"></i></span></li>
                                                            </ul> -->
                                                            <select  multiple="" class="bs-select form-control-select2 " data-width="100%" name="doctorSpecialities_specialitiesId1[]" id="specialityDropdown1" data-size="4">
                                                                    <option value="">Select Speciality </option>
                                                            </select> 
                                                            <label class="error" style="display:none;" id="error-specialityDropdown1"> please select Hospital Speciality</label>
                                                        </div>
                                                    </article>
                                                </div>     
                                            </div>    


                                            <article class="form-group m-lr-0">
                                                <div class="col-md-8 col-md-offset-4">
                                                    <button class="btn btn-success waves-effect waves-light m-r-20" type="button" onclick="multipleProfessionalExp()">Add More</button>
                                                </div>
                                            </article>

                                        </aside>


                                        <!-- Experience Section End -->

                                        <!-- Feature Access Section Start -->
                                        <!--<div>
                                            <figure class="clearfix">
                                                <h3>Feature Access</h3>
                                            </figure>

                                            <article class=" m-lr-0 m-t-20">
                                                <label for="cname" class="control-label col-md-6 col-xs-9">App Consultation Booking </label>
                                                <div class="col-md-6 col-xs-3">
                                                    <aside class="checkbox checkbox-success m-t-5">
                                                        <input type="checkbox" id="checkbox3">
                                                        <label>

                                                        </label>
                                                    </aside>
                                                </div>
                                            </article>

                                            <article class="form-group m-lr-0">
                                                <label for="cname" class="control-label col-md-6 col-xs-9"> Booking Management </label>
                                                <div class="col-md-6 col-xs-3">
                                                    <aside class="checkbox checkbox-success m-t-5">
                                                        <input type="checkbox" id="checkbox3">
                                                        <label>

                                                        </label>
                                                    </aside>
                                                </div>
                                            </article>

                                        </div>  -->  
                                        <!-- Feature Access Section End -->


                                        <!-- Account Detail Section Start -->
                                        <figure class="clearfix">
                                            <h3>Account Detail</h3>
                                        </figure>
                                        <aside class="clearfix m-t-20 p-b-20">
                                            <article class="form-group m-lr-0">
                                                <label for="cname" class="control-label col-md-4 col-sm-4">Registered Email Id:</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input type="email" class="form-control" id="users_email" name="users_email" placeholder="abc@gmail.com" value="<?php echo set_value('users_email'); ?>" onblur="checkEmailFormat()"/>
                                                    <label class="error" style="display:none;" id="error-users_email"> please enter Email id Properly</label>
                                                    <!--<label class="error" style="display:none;" id="error-users_email_check"> Email Already Exists!</label>-->
                                                    <label class="error" > <?php echo form_error("users_email"); ?></label>
                                                    <input type="hidden" class="form-control" id="users_email_status" name="users_email_status" value="" />
                                                </div>
                                                
                                            </article>

                                            <article class="form-group m-lr-0">
                                                <label for="cname" class="control-label col-md-4  col-sm-4">Registered Mobile no. :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input type="text" class="form-control" id="users_mobile" name="users_mobile" placeholder="8880007755" maxlength="10" value="<?php echo set_value('users_mobile'); ?>" onblur="checkNumber('users_mobile','')" onkeypress="return isNumberKey(event)"/>
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
                                    <button class="btn btn-danger waves-effect pull-right" type="button">Reset</button>
                                    <button class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit" onclick="return validationDoctor()">Submit</button>
                                </div>

                            </section>
                            <fieldset>
                           
                            <input name="lat" type="hidden" value="">

                           <!-- <label>Longitude</label> -->
                            <input name="lng" type="hidden" value="">

                          </fieldset>
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

   