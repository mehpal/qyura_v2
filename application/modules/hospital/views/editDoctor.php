<!-- Start content -->
        <div class="content">
            <div class="container">
                <!-- consultation -->
                <div style="display:show;" id="consultDiv">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Edit Doctor</h3>

                        </div>
                    </div>
                    <div class="map_canvas"></div>
                    <form class="cmxform form-horizontal tasi-form avatar-form-doctor-edit" id="submitFormDoctorEdit" method="post" action="<?php echo site_url('hospital/saveDoctor'); ?>" name="doctorForm" enctype="multipart/form-data">
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
                                        <label for="" class="control-label col-md-4 col-sm-4">First Name :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control doctors_fName" id="doctors_fName" type="text" name="doctors_fName" value="<?php echo set_value('doctors_fName'); ?>" placeholder="First Name" >
                                             <label class="error" style="display:none;" id="error-doctors_fName"> Please enter doctor's First name</label>
                                            <label class="error" > <?php echo form_error("doctors_fName"); ?></label>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="" class="control-label col-md-4 col-sm-4">Last Name :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control doctors_lName" id="doctors_lName" type="text" name="doctors_lName" value="<?php echo set_value('doctors_lName'); ?>" placeholder="Last Name"/>
                                            <label class="error" style="display:none;" id="error-doctors_lName"> Please enter doctor's Last name</label>
                                            <label class="error" > <?php echo form_error("doctors_lName"); ?></label>
                                        </div>
                                    </article>
                                    
                                    
                              <article class="form-group m-lr-0 ">
                                        <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>  
                                         <div class="col-md-8 col-sm-8" data-target="#modal" data-toggle="modal">
                                                <label class="col-md-4 col-sm-4" for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x avatar-view-doctor-edit"></i></label>

                                                <div class="pre-doctor-edit col-md-4 col-sm-4 ">
                                                <div id="preImgLogoDoctorEdit" class="avatar-preview preview-md">

                                               <img src="<?php echo base_url() ?>assets/default-images/Doctor-logo.png"  class="image-preview-show"/>

                                                </div>
                                                </div>

                                                <label class="error" > <?php echo form_error("avatar_file"); ?></label>
                                                <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>

                                            </div>
                                    </article>
                                    
                                   
                                    
                                    
                              
                                    
                                   
                                    <article class="form-group m-lr-0">
                                        <label for="" class="control-label col-md-4 col-sm-4">Speciality:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select  multiple="" class="bs-select form-control-select2 doctorSpecialities_specialitiesId" data-width="100%" name="doctorSpecialities_specialitiesId[]" Id="doctorSpecialities_specialitiesId" data-size="4">
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
                                    
                                    
                                          <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Email Id:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="hidden" name="referralId" id="referralId" value="<?php if($this->uri->segment(4) != NULL){ echo $this->uri->segment(4); } ?>">
                                            <input type="hidden" name="pRoleId" id="pRoleId" value="<?php if($this->uri->segment(3) != NULL){ echo $this->uri->segment(3); } ?>">
                                            
                                            <input type="email" class="form-control users_email" id="users_email" name="users_email" placeholder="Email" value="<?php  echo set_value('users_email');  ?>" onblur="checkEmailFormat()"/>
                                            
                                            <label class="error" style="display:none;" id="error-users_email"> please enter Email id Properly</label>
                                            <label class="error" style="display:none;" id="error-users_email_check"> Doctor Email Already Exists!</label>
                                            <label class="error" > <?php echo form_error("users_email"); ?></label>
                                            <input type="hidden" class="form-control" id="users_email_status" name="users_email_status" value="" />
                                        </div>
                                    </article>
                                    
                                    
                                    <div id="multiplePhoneNumber">
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Phone:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <aside class="row">
                                                <div class="col-md-12 col-sm-4 col-xs-10 m-t-xs-10 ">
                                                    <input type="text" class="form-control doctors_phn" name="doctors_phn" id="doctors_phn1" maxlength="10" placeholder="Number" onblur="checkNumber('doctors_phn',1)" onkeypress="return isNumberKey(event)" value="<?php  echo set_value('doctors_phn');  ?>" />
                                                </div>
                                            </aside>
                                            <label class="error" style="display:none;" id="error-doctors_phn1"> Please select your phone number</label>
                                        </div>
                                    </article>
                                    </div>
                                  
                               
                               
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
                                            <div id="parentDegreeDiv2">
                                                <div id="childDegreeDiv2">
                                                    <aside class="row">
                                                        <label for="cname" class="control-label col-md-4">Degree</label>
                                                        <div class="col-md-4 col-sm-4">
                                                            <select class="selectpicker" data-width="100%" data-size="4" name="doctorAcademic_degreeId[]" id="doctorAcademic_degreeId2">
                                                                 <option value="">Select Degree </option>
                                                                <?php foreach($degree as $key=>$val){?>
                                                                <option value="<?php echo $val->degree_id;?>"><?php echo $val->degree_SName;?></option>
                                                                <?php }?>
                                                            </select>
                                                            <label class="error" style="display:none;" id="error-doctorAcademic_degreeId1"> please select Degree</label>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 m-t-xs-10">
                                                            <select class="selectpicker" data-width="100%" data-size="4" name="doctorSpecialities_specialitiesCatId[]" id="doctorSpecialities_specialitiesCatId2">
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
                                                            <input class="form-control" name="acdemic_addyear[]" required="" id="acdemic_addyear1" value=""  onkeypress="return isNumberKey(event)" placeholder="Year" maxlength="4">
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
                                            <button class="btn btn-success waves-effect waves-light m-r-20" type="button" onclick="multipleAcademicForDoctor()">Add More</button>
                                        </div>
                                    </article>
                                    <!-- Degree End -->
                                    <!-- Experience Section Start -->
                                    <figure class="clearfix">
                                        <h3>Professional Experience</h3>
                                    </figure>
                                    <aside class="clearfix m-t-20">
                                        
                                        <aside class="row">
                                            <label for="cname" class="control-label col-md-4 m-t-10 m-l-10">No of Year</label>
                                            <div class="col-md-7 col-sm-7 m-b-20 m-t-10">
                                                <input type="number" class="form-control exp_year" name="exp_year" required="" id="exp_year" placeholder="Experience" min="1" max="50" value="<?php echo set_value('exp_year') ?>">
                                                <label class="error" style="display:none;" id="error-exp_year"> please fill Experience</label>
                                            </div>
                                        </aside>
                                        
                                        <aside class="row">
                                            <label for="cname" class="control-label col-md-4 m-t-10 m-l-10">Fee</label>
                                            <div class="col-md-7 col-sm-7 m-b-20 m-t-10">
                                                <input type="text" class="form-control fee" name="fee" required="" id="fee" placeholder="Fee">
                                                <label class="error" style="display:none;" id="error-fee"> please fill Fee</label>
                                            </div>
                                        </aside>
                                        
                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4"> Show experience on my profile ? </label>
                                            <div class="col-md-8 col-sm-8">
                                                <aside class="radio radio-info radio-inline">
                                                    <input type="radio" id="inlineRadio3" value="1" name="show_exp" checked>
                                                    <label for="inlineRadio3"> Yes</label>
                                                </aside>
                                                <aside class="radio radio-info radio-inline">
                                                    <input type="radio" id="inlineRadio4" value="0" name="show_exp">
                                                    <label for="inlineRadio4"> No</label>
                                                </aside>
                                            </div>
                                        </article>
                                    </aside>
                                   
                                    
                                    <!-- Account Detail Section End -->
                            </div>
                        </section>
                        <section class="clearfix ">
                            <div class="col-md-12 m-t-20 m-b-20">
                                <div id="load_consulting" class="text-center text-success " style="display: none"><image alt="Please wait data is loading" src="<?php echo base_url('assets/images/loader/Heart_beat.gif'); ?>" /></div>
                                <button class="btn btn-danger waves-effect pull-right" type="button" onclick="editDoctor()">Reset</button>
                                <button class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit">Submit</button>
                            </div>
                        </section>
                           <div id="upload_modal_form">
                            <?php  $this->load->view('edit_doctor_crop_modal');?>
                        </div>
                        
                        <input type="hidden" name="hospitalUserIdDoctor" value="<?php if(isset($hospitalData[0]->hospital_usersId)){ echo $hospitalData[0]->hospital_usersId; }?>" id="hospitalUserIdDoctor" />
                        
                    </form>
                </div>
                <!-- consultation -->
                <!-- Right Section End -->
            </div>
            <!-- container -->
        </div>
        <!-- content -->