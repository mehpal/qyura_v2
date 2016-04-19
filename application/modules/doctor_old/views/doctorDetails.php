<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container row">
            <div class="clearfix">
                <div class="col-md-12">
                    <h3 class="pull-left page-title">Doctor Management</h3>
                    <a href="<?php echo site_url() ?>/doctor/" class="btn btn-appointment btn-back waves-effect waves-light pull-right"><i class="fa fa-angle-left"></i> Back</a>
                </div>
            </div>
            <!-- Left Section Start -->
            <div class="col-md-12 bg-white">
                <section class="clearfix detailbox">
                    <!-- Table Section Start -->
                    <article class="clearfix m-t-20 p-b-20 doctor-profile">
                        <aside class="col-md-2 col-sm-2 col-xs-6 p-0">
                            <?php if (!empty($doctorDetail[0]->doctors_img)) { ?>
                                <img src="<?php echo base_url() ?>assets/doctorsImages/thumb/thumb_150/<?php echo $doctorDetail[0]->doctors_img; ?>" alt="" class="img-responsive doctor-pic" />
                            <?php } else { ?>
                                <img src="<?php echo base_url() ?>assets/images/noImage.png" alt="" class="logo-img" />
                            <?php } ?>
                        </aside>
                        <aside class="col-md-5 col-sm-5 col-xs-12">
                            <h3>Dr. <?php echo $doctorDetail[0]->doctoesName; ?></h3>
                            <p><?php echo (isset($doctorAcademic) && $doctorAcademic != NULL) ? $doctorAcademic[0]->degreeSmallName : ""; ?></p>
                            <p><?php echo  (isset($doctorAcademic) && $doctorAcademic != NULL) ? $doctorAcademic[0]->degreeFullName : "";
                            ; ?></p>
                            <p><?php echo $years; ?> Years Experience</p>
                            <p><?php echo $doctorDetail[0]->speciality; ?></p>
                        </aside>
                        <aside class="col-md-5 col-sm-5 col-xs-12 text-right t-xs-left">
                            <h6><a href="">200 Ratings</a> &nbsp; <span class="label label-success waves-effect waves-light m-b-5 center-block">5.0</span></h6>
                            <h6><a href="#">12 Reviews</a> &nbsp; <i class="fa fa-commenting clg"></i></h6>
                            <h6>Doctor on Call &nbsp; <i class="fa fa-phone clg"></i></h6>
                            <h6><button class="btn btn-appointment waves-effect waves-light" type="button">View Detail</button></h6>
                        </aside>
                    </article>
                    <article class="text-center clearfix m-t-50">
                        <ul class="nav nav-tab nav-doctor">
                            <li class="active">
                                <a data-toggle="tab" href="#general">General Detail</a>
                            </li>
                            <li class=" ">
                                <a data-toggle="tab" href="#academic">Academic Detail</a>
                            </li>
                            <li class=" ">
                                <a data-toggle="tab" href="#experience">Experience</a>
                            </li>
                            <li class=" ">
                                <a data-toggle="tab" href="#award">Award & Recognition</a>
                            </li>
                            <li class=" ">
                                <a data-toggle="tab" href="#appointment">Appointment History</a>
                            </li>
                            <li class=" ">
                                <a data-toggle="tab" href="#timeslot">Time Slot</a>
                            </li>
                            <li class=" ">
                                <a data-toggle="tab" href="#account">Account</a>
                            </li>
                        </ul>
                    </article>
                    <article class="tab-content p-b-20 m-t-50">
                        <div class="alert alert-success" id="successTop" style="display: none"></div>
                        <div class="alert alert-danger" id="er_TopError" style="display: none"></div>
                        <!-- General Detail Starts -->
                        <section class="tab-pane fade in active" id="general">
                               <section class="detailbox">
                                <div class="mi-form-section">
                                    <!-- Table Section End -->
                                    <div class="m-t-20 setting doctor-description">
                                        <article class="clearfix">
                                            <aside class="col-sm-8">
                                                <h4>Doctor Detail 
                                                <?php //dump($doctorAcademic);?>
                                                    <a href="javascript:void(0)" id="edit" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                                                </h4>
                                                <hr/>
                                            </aside>
                                        </article>
                                        <section id="detail" style="display:  <?php echo $detailShow; ?>;">    
                                            <article class="form-group m-lr-0">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Doctor Id :</label>
                                                <p class="col-md-8 col-sm-8"><?php echo $doctorDetail[0]->doctors_unqId; ?></p>
                                            </article>

                                            <article class="form-group m-lr-0 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Date of Joining :</label>
                                                <p class="col-md-8 col-sm-8"><?php echo date('F j Y', $doctorDetail[0]->creationTime); ?></p>
                                            </article>
                                            <article class="form-group m-lr-0 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Date of Birth :</label>
                                                <p class="col-md-8"><?php echo date('F j Y', $doctorDetail[0]->doctors_dob); ?></p>
                                            </article>
                                            <article class="form-group m-lr-0 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Email Id:</label>
                                                <p class="col-md-8 col-sm-8"><?php echo $doctorDetail[0]->users_email; ?></p>
                                            </article>
                                            <article class="form-group m-lr-0 ">
                                                
                                                <?php
                                                $explode = explode('|', $doctorDetail[0]->doctors_phn);
                                                for ($i = 0; $i < count($explode); $i++) { ?>
                                                <label for="cemail" class="control-label col-md-4 col-sm-4"><?php if($i == 0){ ?>Landline Phone :<?php } ?></label>
                                                    <?php if ($explode[$i] != '')
                                                        
                                                        ?>
                                                    <p class="col-md-8 col-sm-8">+<?php echo $explode[$i]; ?></p>

                                                <?php } ?>
                                            </article>
                                            <article class="form-group m-lr-0 ">
                                                <?php
                                                $explode2 = explode('|', $doctorDetail[0]->doctors_mobile);
                                                for ($i = 0; $i < count($explode2); $i++) { ?>
                                                    <label for="cemail" class="control-label col-md-4 col-sm-4"><?php if($i == 0){ ?>Mobile :<?php } ?></label>
                                                    <?php $againexplode = explode('*', $explode2[$i]);
                                                    ?>
                                                    <p class="col-md-8 col-sm-8">+<?php echo $againexplode[0]; ?></p>

                                                <?php } ?>
                                            </article>
                                            <article class="form-group m-lr-0 ">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Address :</label>
                                                <p class="col-md-8 col-sm-8"><?php echo $doctorDetail[0]->doctor_addr; ?></p>
                                            </article>
                                        </section>
                                        <section id="newDetail" style="display:<?php echo $showStatus; ?>;">
                                            <!--edit-->
                                            <form name="doctorDetailForm" action="#" id="doctorDetailForm" method="post">
                                                <input type="hidden" id="StateId" name="StateId" value="<?php echo $doctorDetail[0]->doctors_stateId; ?>" />
                                                <input type="hidden" id="countryId" name="countryId" value="<?php echo $doctorDetail[0]->doctors_countryId; ?>" />
                                                <input type="hidden" id="cityId" name="cityId" value="<?php echo $doctorDetail[0]->doctors_cityId; ?>" />
                                                <input type="hidden" id="userId" name="userId" value="<?php echo $doctorDetail[0]->doctors_userId; ?>" />
                                                <input type="hidden" id="doctorAjaxId" name="doctorAjaxId" value="<?php echo $doctorDetail[0]->doctors_id; ?>" />
                                                <article class="clearfix m-t-10">
                                                    <label for="" class="control-label col-md-3 col-sm-4">First Name :</label>
                                                    <div class="col-md-4 col-sm-5">
                                                        <input class="form-control" id="doctors_fName" type="text" name="doctors_fName" value="<?php echo (set_value('doctors_fName')) ? set_value('doctors_fName') : $doctorDetail[0]->doctors_fName; ?>">
                                                        
                                                        <label class="error" id="err_doctors_fName" > <?php echo form_error("doctors_fName"); ?></label>
                                                    </div>
                                                </article>
                                                <article class="clearfix m-t-10">
                                                    <label for="" class="control-label col-md-3 col-sm-4">Last Name :</label>
                                                    <div class="col-md-4 col-sm-5">
                                                        <input class="form-control" id="doctors_lName" type="text" name="doctors_lName" value="<?php echo (set_value('doctors_lName')) ? set_value('doctors_lName') : $doctorDetail[0]->doctors_lName; ?>" />
                                                        <label class="error" id="err_doctors_lName" > <?php echo form_error("doctors_lName"); ?></label>
                                                    </div>
                                                </article>
                                                <article class="clearfix m-t-10">
                                                    <label for="" class="control-label col-md-3 col-sm-4">Date of Birth :</label>
                                                    <div class="col-md-4 col-sm-5">
                                                        <div class="input-group">
                                                            <input class="form-control pickDate" placeholder="dd/mm/yyyy" id="doctors_dob" type="text" name="doctors_dob" value="<?php echo (set_value('doctors_dob')) ? set_value('doctors_dob') : date('d/m/Y', $doctorDetail[0]->doctors_dob) ?>">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                        </div>
                                                        <label class="error" id="err_doctors_dob" > <?php echo form_error("doctors_dob"); ?></label>
                                                    </div>
                                                </article>
                                                <article class="clearfix m-t-10">
                                                    <label for="cname" class="control-label col-md-3 col-sm-4">Date of Joining :</label>
                                                    <div class="col-md-4 col-sm-5">
                                                        <div class="input-group">
                                                            <input class="form-control pickDate" placeholder="dd/mm/yyyy" id="doctors_creationTime" type="text" readonly="" name="creationTime" value="<?php echo date('d/m/Y', $doctorDetail[0]->creationTime); ?>">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                        </div>
                                                        <label class="error" id="err_creationTime" > <?php echo form_error("creationTime"); ?></label>
                                                    </div>
                                                </article>
                                                <article class="clearfix m-t-10">
                                                    <label class="control-label col-md-3 col-sm-4">Email :</label>
                                                    <div class="col-md-4 col-sm-5">
                                                        <input class="form-control" id="users_email" name="users_email" placeholder="abc@gmail.com" value="<?php echo $doctorDetail[0]->users_email; ?>" onblur="checkEmailFormat()"/>
                                                        <label class="error" id="err_users_email" > <?php echo form_error("users_email"); ?></label>
                                                    </div>
                                                </article>
                                                <div id="multiplePhoneNumber">
                                                    <article class="form-group m-lr-0 ">
                                                        <?php $count_phone = count($doctorDetail[0]->doctors_phn); ?>
                                                        <input type="hidden" name="total_phone" id="total_phone" value="<?php if(count($count_phone) != ''){ echo count($count_phone); }else{ echo "1"; } ?>" >       
                                                        <?php
                                                        if(isset($doctorDetail[0]->doctors_phn) && $doctorDetail[0]->doctors_phn != NULL){
                                                        $explode = explode('|', $doctorDetail[0]->doctors_phn); 
                                                        for ($j = 1; $j <= count($explode); $j++) { ?>
                                                        <label for="cemail" class="control-label col-md-3 col-sm-3"><?php if($j == 1){ ?>Landline Phone :<?php } ?></label>
                                                        <?php $check_prefix_p = explode(' ', $explode[$j-1]); ?>
                                                        <div class="col-md-8 col-sm-8">
                                                            <aside class="row">
                                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                                    <select class="selectpicker" data-width="100%" name='preNumber[]' id="preNumber">
                                                                        <option <?php if($check_prefix_p[0] == "91"){ echo "selected"; } ?> value="91">+91</option>
                                                                        <option <?php if($check_prefix_p[0] == "1"){ echo "selected"; } ?>  value="1">+1</option>
                                                                    </select>
                                                                    <label class="error" id="err_preNumber" > <?php echo form_error("preNumber[]"); ?></label>
                                                                </div>
                                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 m-t-xs-10">
                                                                    <input type="text" class="form-control" name="midNumber[]" id="midNumber1" placeholder="731" maxlength="3" onblur="checkNumber('midNumber', 1)" onkeypress="return isNumberKey(event)" value="<?php echo $check_prefix_p[1]; ?>" />
                                                                    <label class="error" id="err_midNumber" > <?php echo form_error("midNumber[]"); ?></label>
                                                                </div>
                                                                <div class="col-md-2 col-sm-2 col-xs-10 m-t-xs-10 ">
                                                                    <input type="text" class="form-control" name="doctors_phn[]" id="doctors_phn1" maxlength="8" placeholder="7000123" onblur="checkNumber('doctors_phn', 1)" onkeypress="return isNumberKey(event)" value="<?php echo $check_prefix_p[2]; ?>" />
                                                                    <label class="error" id="err_doctors_phn" > <?php echo form_error("doctors_phn[]"); ?></label>
                                                                </div>
                                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 m-t-xs-10"><a onclick="addPhoneNumberGen()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a></div>
                                                            </aside>
                                                        </div>
                                                        <?php } }else{ ?>
                                                        <label for="cemail" class="control-label col-md-3 col-sm-3">Landline Phone :</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <aside class="row">
                                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                                    <select class="selectpicker" data-width="100%" name='preNumber[]' id="preNumber">
                                                                        <option value='91'>+91</option>
                                                                        <option value='1'>+1</option>
                                                                    </select>
                                                                    <label class="error" id="err_preNumber" > <?php echo form_error("preNumber[]"); ?></label>
                                                                </div>
                                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 m-t-xs-10">
                                                                    <input type="text" class="form-control" name="midNumber[]" id="midNumber1" placeholder="731" maxlength="3" onblur="checkNumber('midNumber', 1)" onkeypress="return isNumberKey(event)" />
                                                                    <label class="error" id="err_midNumber" > <?php echo form_error("midNumber[]"); ?></label>
                                                                </div>
                                                                <div class="col-md-2 col-sm-2 col-xs-10 m-t-xs-10 ">
                                                                    <input type="text" class="form-control" name="doctors_phn[]" id="doctors_phn1" maxlength="8" placeholder="7000123" onblur="checkNumber('doctors_phn', 1)" onkeypress="return isNumberKey(event)" />
                                                                    <label class="error" id="err_doctors_phn" > <?php echo form_error("doctors_phn[]"); ?></label>
                                                                </div>
                                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 m-t-xs-10"><a onclick="addPhoneNumberGen()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a></div>
                                                            </aside>
                                                        </div>
                                                        <?php } ?>
                                                    </article>
                                                </div>
                                                <div id='multipleMobile'>
                                                    <article class="form-group m-lr-0 ">
                                                        <?php $count = count($doctorDetail[0]->doctors_mobile); ?>
                                                        <input type="hidden" name="total_mobile" id="total_mobile" value="<?php if(count($count) != ''){ echo count($count); }else{ echo "1"; } ?>" >       
                                                        <?php
                                                        if(isset($doctorDetail[0]->doctors_mobile) && $doctorDetail[0]->doctors_mobile != NULL){
                                                        $explode2 = explode('|', $doctorDetail[0]->doctors_mobile); 
                                                        for ($i = 1; $i <= count($explode2); $i++) { ?>
                                                        <label for="cemail" class="control-label col-md-3 col-sm-3"><?php if($i == 1){ ?>Mobile :<?php } ?></label>
                                                        <?php $check_prefix = explode(' ', $explode2[$i-1]);
                                                        $check_primary = explode('*', $explode2[$i-1]);
                                                        $check_mobile = explode(' ', $check_primary[0]); ?>
                                                        <div class="col-md-8 col-sm-8">
                                                            <aside class="row">
                                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                                    <select class="selectpicker" data-width="100%" name="preMobileNumber[]" id="preMobileNumber1">
                                                                        <option <?php if($check_prefix[0] == "91"){ echo "selected"; } ?> value="91">+91</option>
                                                                        <option <?php if($check_prefix[0] == "1"){ echo "selected"; } ?>  value="1">+1</option>
                                                                    </select>
                                                                    <label class="error" id="err_preMobileNumber" > <?php echo form_error("preMobileNumber[]"); ?></label>
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10 m-t-xs-10">
                                                                    <input type="text" class="form-control" name="doctors_mobile[]" id="doctors_mobile1" placeholder="9837000123" onblur="checkNumber('doctors_mobile', 1)" maxlength="10" onkeypress="return isNumberKey(event)" value="<?php echo $check_mobile[1]; ?>"/>
                                                                    <label class="error" id="err_doctors_mobile" > <?php echo form_error("doctors_mobile[]"); ?></label>
                                                                </div>
                                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 m-t-xs-10"><a  onclick="addMobileNumberGen()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a></div>
                                                            </aside>
                                                            <aside class="checkbox checkbox-success">
                                                                <input type="checkbox" id="checkbox<?php echo $i; ?>" name="checkbox<?php echo $i; ?>" value="1" <?php if($check_primary[1] == 1){ echo "checked"; } ?> >
                                                                <label for="checkbox3">
                                                                    Make this number primary
                                                                </label>
                                                            </aside>
                                                        </div>
                                                        <?php } }else{ ?>
                                                        <label for="cemail" class="control-label col-md-3 col-sm-3">Mobile :</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <aside class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <select class="selectpicker" data-width="100%" name="preMobileNumber[]" id="preMobileNumber1">
                                                                        <option value="91">+91</option>
                                                                        <option value="1">+1</option>
                                                                    </select>
                                                                    <label class="error" id="err_preMobileNumber" > <?php echo form_error("preMobileNumber[]"); ?></label>
                                                                </div>
                                                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-10 m-t-xs-10">
                                                                    <input type="text" class="form-control" name="doctors_mobile[]" id="doctors_mobile1" placeholder="9837000123" onblur="checkNumber('doctors_mobile', 1)" maxlength="10" onkeypress="return isNumberKey(event)" />
                                                                    <label class="error" id="err_doctors_mobile" > <?php echo form_error("doctors_mobile[]"); ?></label>
                                                                </div>
                                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 m-t-xs-10"><a  onclick="addMobileNumberGen()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a></div>
                                                            </aside>
                                                            <aside class="checkbox checkbox-success">
                                                                <input type="checkbox" id="checkbox1" name="checkbox1" value="1">
                                                                <label for="checkbox3">
                                                                    Make this number primary
                                                                </label>
                                                            </aside>
                                                        </div>
                                                        <?php } ?>
                                                    </article>
                                                </div> 
                                                <article class="clearfix m-t-10">
                                                    <label class="control-label col-md-3 col-sm-4">Address :</label>
                                                    <div class="col-md-4 col-sm-5">
                                                        <textarea type="text" id="geocomplete" class="form-control" id="doctorId" name="doctor_address"  required=""><?php echo $doctorDetail[0]->doctor_addr; ?></textarea>
                                                        <label class="error" id="er_doctor_address"><?php echo form_error("doctor_address"); ?></label>
                                                    </div>
                                                </article>
                                                <section class="clearfix ">
                                                    <div class="col-md-12 m-t-20 m-b-20 text-right">
                                                        <button type="button" class="btn btn-danger waves-effect ">Reset</button>
                                                        <button type="submit" class="btn btn-success waves-effect waves-light  m-r-20">Submit</button>
                                                    </div>
                                                </section>
                                            </form>
                                        </section>
                                    </div>
                                </div>
                            </section>
                        </section>
                        <!-- General Detail Ends -->
                        <!-- Academic Detail Starts -->
                        <section class="tab-pane fade in" id="academic">
                            <div class="clearfix m-t-20 doctor-description">
                                <article class="clearfix">
                                    <aside class="col-sm-8">
                                        <h4>
                                          <button class="btn btn-appointment waves-effect waves-light m-r-10" id="adddegree" title="Add New Degree">
                                             <i class="fa fa-plus"></i> Add  </button>
                                            <button class="btn btn-appointment waves-effect waves-light" id="editdegree" title="Edit Degree">
                                             <i class="fa fa-pencil"></i> Edit </button>
                                        </h4>
                                    </aside>
                                </article>
                                <article class="clearfix m-t-20" id="newdegree" style="display:none">
                                    <form name="addAcademicForm" action="#" id="addAcademicForm" method="post">
                                        <input type="hidden" name="total_add_academic" id="total_add_academic" value="1">
                                        <input type="hidden" id="doctorAjaxId" name="doctorAjaxId" value="<?php echo $doctorDetail[0]->doctors_id; ?>" />
                                        <div id="appendAcademicDiv">
                                            <div class="col-sm-6">
                                                <aside class="clearfix m-t-10">
                                                    <select class="selectpicker" data-width="100%" name="degree_addid_1" id="degree_addid_1">
                                                        <option value="">Select Degree</option>
                                                        <?php if(isset($qyura_degree) && $qyura_degree != NULL){
                                                            foreach ($qyura_degree as $degree){  ?>
                                                        <option value="<?php echo $degree->degree_id ?>"><?php echo $degree->degree_SName; ?></option>
                                                        <?php } } ?>
                                                    </select>
                                                    <label class="error" id="err_degree_addid_1" > <?php echo form_error("degree_addid_1"); ?></label>
                                                </aside>
                                                <aside class="clearfix m-t-10">
                                                    <textarea class="form-control" id="acdemic_addaddress_1" name="acdemic_addaddress_1" required=""></textarea>
                                                    <label class="error" id="err_acdemic_addaddress_1" > <?php echo form_error("acdemic_addaddress_1"); ?></label>
                                                </aside>
                                                <aside class="clearfix m-t-10">
                                                    <input class="form-control" name="acdemic_addyear_1" required="" id="acdemic_addyear_1" value="">
                                                    <label class="error" id="err_addacdemic_year_1" > <?php echo form_error("acdemic_addyear_1"); ?></label>
                                                </aside>

                                            </div>
                                        </div>
                                        <article class="clearfix m-t-20">
                                            <aside class="col-sm-12 " >
                                                <button type="submit" class="btn btn-appointment waves-effect waves-light m-t-10">Save</button>
                                            </aside>
                                        </article>
                                    </form>
                                    <button class="btn btn-appointment waves-effect waves-light m-t-10" onclick="addAcademicNumber()">Add New</button>
                                </article>
                                <form name="changeAcademicForm" action="#" id="changeAcademicForm" method="post">
                                <?php if(isset($doctorAcademic) && $doctorAcademic != NULL){
                                    $totalAcademic = count($doctorAcademic); 
                                    $acdemicIn = 1;?>
                                    <input type="hidden" id="totalAcademic" name="totalAcademic" value="<?php echo $totalAcademic; ?>" >
                                    <input type="hidden" id="doctorAjaxId" name="doctorAjaxId" value="<?php echo $doctorDetail[0]->doctors_id; ?>" />
                                    <?php foreach($doctorAcademic as $docAcademic){ ?>
                                    <aside class="col-md-6 col-sm-6">
                                        <article class="clearfix m-t-20 degreedetail">
                                            <h6><?php echo $docAcademic->degreeSmallName; ?></h6>
                                            <p><?php echo $docAcademic->degreeFullName; ?></p>
                                            <p><?php echo $docAcademic->degreeInsAddress; ?></p>
                                            <p><?php echo $docAcademic->degreeYear; ?></p>
                                        </article>
                                        <article class="clearfix m-t-20">
                                            <div class="col-sm-9 detailnew" style="display:none">
                                                <input type="hidden" name="academic_id_<?php echo $acdemicIn; ?>" id="academic_id_<?php echo $acdemicIn; ?>" value="<?php echo $docAcademic->academic_id; ?>" >
                                                <aside class="clearfix m-t-10">
                                                    <select class="selectpicker" data-width="100%" name="degree_id_<?php echo $acdemicIn; ?>" id="degree_id_<?php echo $acdemicIn; ?>">
                                                        <option value="">Select Degree</option>
                                                        <?php if(isset($qyura_degree) && $qyura_degree != NULL){
                                                            foreach ($qyura_degree as $degree){  ?>
                                                        <option <?php if($docAcademic->degreeId == $degree->degree_id){ echo "selected"; } ?> value="<?php echo $degree->degree_id ?>"><?php echo $degree->degree_SName; ?></option>
                                                        <?php } } ?>
                                                    </select>
                                                    <label class="error" id="err_degree_id_<?php echo $acdemicIn; ?>" > <?php echo form_error("degree_id_".$acdemicIn); ?></label>
                                                </aside>
                                                <aside class="clearfix m-t-10">
                                                    <textarea class="form-control customAddress" id="acdemic_address_<?php echo $acdemicIn; ?>" name="acdemic_address_<?php echo $acdemicIn; ?>" required=""><?php echo $docAcademic->degreeInsAddress; ?></textarea>
                                                    <label class="error" id="err_acdemic_address_<?php echo $acdemicIn; ?>" > <?php echo form_error("acdemic_address_".$acdemicIn); ?></label>
                                                </aside>
                                                <aside class="clearfix m-t-10">
                                                    <input class="form-control" name="acdemic_year_<?php echo $acdemicIn; ?>" required="" id="acdemic_year_<?php echo $acdemicIn; ?>" value="<?php echo $docAcademic->degreeYear; ?>">
                                                    <label class="error" id="err_acdemic_year_<?php echo $acdemicIn; ?>" > <?php echo form_error("acdemic_year_".$acdemicIn); ?></label>
                                                </aside>
                                            </div>
                                        </article>
                                    </aside>
                                <?php $acdemicIn++; } ?>
                                <article class="clearfix m-t-20">
                                    <aside class="col-sm-12 detailnew" style="display:none">
                                        <button type="submit" class="btn btn-appointment waves-effect waves-light">Update</button>
                                    </aside>
                                </article>
                                <?php } ?>
                                </form>
                            </div>
                        </section>
                        <!-- Academic Detail Ends -->
                        
                        <!-- Experience Starts -->
                        <section class="tab-pane fade in" id="experience">
                            <div class="clearfix m-t-20 doctor-description">
                                <article class="clearfix">
                                    <aside class="col-sm-8">
                                        <h4>
                                          <button class="btn btn-appointment waves-effect waves-light m-r-10" id="addexp" title="Add New Experience">
                                            <i class="fa fa-plus"></i> Add  </button>
                                            <button class="btn btn-appointment waves-effect waves-light" id="editexp" title="Edit Experience">
                                            <i class="fa fa-pencil"></i> Edit </button>
                                        </h4>
                                    </aside>
                                </article>
                                <section class="clearfix m-t-20">
                                    <aside class="col-md-6 col-sm-6">
                                        <article class="clearfix m-t-20">
                                            <div id="newexp" style="display:none">
                                                <form name="addExperienceForm" action="#" id="addExperienceForm" method="post">
                                                    <input type="hidden" name="total_add_exp" id="total_add_exp" value="1">
                                                    <input type="hidden" id="doctorAjaxId" name="doctorAjaxId" value="<?php echo $doctorDetail[0]->doctors_id; ?>" />
                                                    <div id="expDiv">
                                                        <aside class="clearfix m-t-10">
                                                            <select class="selectpicker" data-width="100%" name="hospital_addid_1" id="hospital_addid_1" onchange="find_speciality(1)">
                                                                <option value="">Select Hospital</option>
                                                                <?php if(isset($qyura_hospital) && $qyura_hospital != NULL){
                                                                    foreach ($qyura_hospital as $hospital){  ?>
                                                                <option value="<?php echo $hospital->hospital_id ?>"><?php echo $hospital->hospital_name; ?></option>
                                                                <?php } } ?>
                                                            </select>
                                                            <label class="error" id="err_hospital_addid_1" > <?php echo form_error("hospital_addid_1"); ?></label>
                                                        </aside>
                                                        <aside class="clearfix m-t-10">
                                                            <input class="form-control" name="designation_1" id="designation_1" required="" value="" placeholder="Designation">
                                                            <label class="error" id="err_designation_1" > <?php echo form_error("designation_1"); ?></label>
                                                        </aside>
                                                        <aside class="clearfix m-t-10">
                                                            <select class="select2" data-placeholder="Choose a Speciality" data-width="100%" multiple="" id="speciality_1" name="speciality1[]">
                                                            </select>
                                                            <label class="error" id="err_speciality_1" > <?php echo form_error("speciality_1"); ?></label>
                                                        </aside>
                                                        <aside class="row row-minus m-t-10">
                                                            <div class="col-sm-6">
                                                                <input class="form-control datepicker pickDate" name="exp_start_1" id="exp_start_1" required="" value="<?php echo date("d-m-Y"); ?>" >
                                                                <label class="error" id="err_exp_start_1" > <?php echo form_error("exp_start_1"); ?></label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input class="form-control datepicker pickDate" name="exp_end_1" id="exp_end_1" required="" value="<?php echo date("d-m-Y" , strtotime('+ 1 days')); ?>">
                                                                <label class="error" id="err_exp_end_1" > <?php echo form_error("exp_end_1"); ?></label>
                                                            </div>
                                                        </aside>
                                                    </div>
                                                    <article class="clearfix m-t-20">
                                                        <aside class="col-sm-12 m-t-10" >
                                                            <button type="submit" class="btn btn-appointment waves-effect waves-light">Save</button>
                                                        </aside>
                                                    </article>
                                                </form>
                                                <button class="btn btn-appointment waves-effect waves-light m-t-10" onclick="addExprNumberGen()" >Add New</button>
                                            </div>
                                        </article>
                                    </aside>
                                </section>
                               
                                <aside class="col-md-6 col-sm-6">
                                    <section class="clearfix m-t-20">
                                        <?php if(isset($doctor_final_array) && $doctor_final_array != NULL){
                                        foreach($doctor_final_array as $experience){ ?>
                                        <article class="clerfix m-t-20 detailexp">
                                            <h6><?php echo $experience['hospital_name']; ?></h6>
                                            <p><?php echo $experience['hospital_address']; ?></p>
                                            <p><?php echo $experience['professionalExp_designation']; ?></p>
                                            <h6><?php echo date("F Y", $experience['professionalExp_start']); ?> - <?php echo date("F Y", $experience['professionalExp_end']); ?></h6>
                                            <p>
                                                <?php foreach ($experience['category'] as $category){ ?>
                                                    <label class="label doctor-label label-specialist"><?php echo $category['specialitiesCat_name'] ?></label>
                                                <?php } ?>
                                            </p>
                                        </article>
                                        <?php } } ?>
                                        <article class="clearfix m-t-20">
                                            <div class="col-sm-9 detailexpnew" style="display:none">
                                                <form name="editExperienceForm" action="#" id="editExperienceForm" method="post">
                                                <?php if(isset($doctor_final_array) && $doctor_final_array != NULL){
                                                    $countEdit = 1; $doctor_edit_count = count($doctor_final_array); ?>
                                                <input type="hidden" name="total_edit_exp" id="total_edit_exp" value="<?php echo $doctor_edit_count; ?>">
                                                <input type="hidden" id="doctorAjaxId" name="doctorAjaxId" value="<?php echo $doctorDetail[0]->doctors_id; ?>" />
                                                <?php foreach($doctor_final_array as $experience){ ?>
                                                <input type="hidden" name="professionalExp_id_<?php echo $countEdit; ?>" id="professionalExp_id_<?php echo $countEdit; ?>" value="<?php echo $experience['professionalExp_id']; ?>">
                                                
                                                    <aside class="clearfix m-t-10">
                                                        <select class="selectpicker" data-width="100%" name="hospital_id_<?php echo $countEdit; ?>" id="hospital_id_<?php echo $countEdit; ?>" onchange="find_speciality_edit('<?php echo $countEdit; ?>')">
                                                            <option value="">Select Hospital</option>
                                                            <?php if(isset($qyura_hospital) && $qyura_hospital != NULL){
                                                                foreach ($qyura_hospital as $hospital){  ?>
                                                            <option <?php if($experience['professionalExp_hospitalId'] == $hospital->hospital_id ){ echo "selected"; } ?> value="<?php echo $hospital->hospital_id ?>"><?php echo $hospital->hospital_name; ?></option>
                                                            <?php } } ?>
                                                        </select>
                                                        <label class="error" id="err_hospital_id_<?php echo $countEdit; ?>" > <?php echo form_error("hospital_id_".$countEdit); ?></label>
                                                    </aside>
                                                    <aside class="clearfix m-t-10">
                                                        <input class="form-control" name="designation_edit_<?php echo $countEdit; ?>" id="designation_edit_<?php echo $countEdit; ?>" required="" value="<?php echo $experience['professionalExp_designation']; ?>" placeholder="Designation">
                                                        <label class="error" id="err_designation_<?php echo $countEdit; ?>" > <?php echo form_error("designation_".$countEdit); ?></label>
                                                    </aside>
                                                    <aside class="clearfix m-t-10">
                                                        <select class="select2" data-placeholder="Choose a Speciality" data-width="100%" multiple="" id="speciality_edit_<?php echo $countEdit; ?>" name="speciality_edit<?php echo $countEdit; ?>[]">
                                                            <?php if(isset($experience['category']) && $experience['category'] != NULL){
                                                                foreach($experience['category'] as $cate){ ?>
                                                            <option selected="" value="<?php echo $cate['proExpCategory_specilitycat_id'].",".$cate['proExpCategory_id'] ?>"><?php echo $cate['specialitiesCat_name']; ?></option>
                                                            <?php } }  ?>
                                                        </select>
                                                        <label class="error" id="err_speciality_edit<?php echo $countEdit; ?>[]" > <?php echo form_error("speciality_edit".$countEdit); ?></label>
                                                    </aside>
                                                    <aside class="row row-minus m-t-10">
                                                        <aside class="row row-minus m-t-10">
                                                            <div class="col-sm-6">
                                                                <input class="form-control datepicker pickDate" name="exp_edit_start_<?php echo $countEdit; ?>" id="exp_edit_start_<?php echo $countEdit; ?>" required="" value="<?php echo date("d/m/Y", $experience['professionalExp_start']); ?>" >
                                                                <label class="error" id="err_exp_edit_start_<?php echo $countEdit; ?>" > <?php echo form_error("exp_edit_start_".$countEdit); ?></label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input class="form-control datepicker pickDate" name="exp_edit_end_<?php echo $countEdit; ?>" id="exp_edit_end_<?php echo $countEdit; ?> required="" value="<?php echo date("d/m/Y", $experience['professionalExp_end']); ?>">
                                                                <label class="error" id="err_exp_edit_end_<?php echo $countEdit; ?>" > <?php echo form_error("exp_edit_end_".$countEdit); ?></label>
                                                            </div>
                                                        </aside>
                                                    </aside>
                                                <?php $countEdit++;} } ?>
                                                    <article class="clearfix m-t-20">
                                                        <aside class="col-sm-12 detailexpnew" style="display:none">
                                                            <button type="submit" class="btn btn-appointment waves-effect waves-light m-r-10">Update</button>
                                                        </aside>
                                                    </article>
                                                </form>
                                            </div>
                                        </article>
                                    </section>
                                </aside>
                            </div>
                        </section>
                        <!-- Experience Ends -->
                        
                        
                        
                        <!-- Experience Starts -->
                        <section class="tab-pane fade in" id="experience">
                            <div class="clearfix m-t-20 doctor-description">
                                <aside class="col-md-6 col-sm-6">
                                    <?php
                                    $explodeStartTime = explode(',', $doctorDetail[0]->startTime);
                                    $explodeEndTime = explode(',', $doctorDetail[0]->endTime);
                                    $explodeHospital = explode(',', $doctorDetail[0]->hospitalName);

                                    for ($i = 0; $i < count($explodeStartTime); $i++) {
                                        ?> 

                                        <article class="clerfix m-t-20">
                                            <h6><?php echo date('M-Y', $explodeStartTime[$i]); ?> - <?php echo date('M-Y', $explodeEndTime[$i]); ?></h6>
                                            <p><?php echo $explodeHospital[$i]; ?></p>

                                            <?php
                                            foreach ($exprerience as $key) {
                                                if ($key->professionalExp_start == $explodeStartTime[$i]) {
                                                    ?>
                                                    <label class="label doctor-label label-specialist"><?php echo $key->specialities_name; ?></label>
                                                    <?php
                                                }
                                            }
                                            ?>

                                                                                   <!-- <p>
                                                                                        <label class="label doctor-label label-specialist">Cardiology</label>
                                                                                        <label class="label doctor-label label-specialist">ENT</label>
                                                                                    </p>-->
                                        </article>
                                    <?php } ?>
                                    <!-- <article class="clerfix m-t-20">
                                        <h6>Oct 1987 - Jan 1995</h6>
                                        <p>ABC Medical College, New-Delhi</p>
                                        <p>Junior Surgeon, Department-Head</p>
                                        <p>
                                            <label class="label doctor-label label-specialist">Cardiology</label>
                                            <label class="label doctor-label label-specialist">ENT</label>
                                        </p>
                                    </article>
                                   <article class="clerfix m-t-20">
                                        <h6>Oct 1987 - Jan 1995</h6>
                                        <p>ABC Medical College, New-Delhi</p>
                                        <p>Junior Surgeon, Department-Head</p>
                                        <p>
                                            <label class="label doctor-label label-specialist">Cardiology</label>
                                            <label class="label doctor-label label-specialist">ENT</label>
                                        </p>
                                    </article>-->

                                </aside>
                                <!--<aside class="col-md-6 col-sm-6">
                                    <article class="clerfix m-t-20">
                                        <h6>Oct 1987 - Jan 1995</h6>
                                        <p>ABC Medical College, New-Delhi</p>
                                        <p>Junior Surgeon, Department-Head</p>
                                        <p>
                                            <label class="label doctor-label label-specialist">Cardiology</label>
                                            <label class="label doctor-label label-specialist">ENT</label>
                                        </p>
                                    </article>
                                    <article class="clerfix m-t-20">
                                        <h6>Oct 1987 - Jan 1995</h6>
                                        <p>ABC Medical College, New-Delhi</p>
                                        <p>Junior Surgeon, Department-Head</p>
                                        <p>
                                            <label class="label doctor-label label-specialist">Cardiology</label>
                                            <label class="label doctor-label label-specialist">ENT</label>
                                        </p>
                                    </article>
                                </aside> -->
                            </div>
                        </section>
                        <!-- Experience Ends -->
                        <!-- Awards Starts -->
                        <section class="tab-pane fade in" id="award">
                            <div class="doctor-description lh-25">
                                <article class="clearfix m-t-20">
                                    <aside class="col-md-6 col-sm-8">
                                        <h6>Certificate Holder of World Osteoporosis, Councle for bone Densteometry and Osteoporosis Hongcong</h6>
                                        <p>2001</p>
                                    </aside>
                                    <aside class="col-md-6 col-sm-4">
                                        <img src="assets/images/certificate.jpg" class="pull-right" />
                                    </aside>
                                </article>
                                <article class="clearfix m-t-20">
                                    <aside class="col-md-6 col-sm-8">
                                        <h6>Certificate Holder of World Osteoporosis, Councle for bone Densteometry and Osteoporosis Hongcong</h6>
                                        <p>2001</p>
                                    </aside>
                                    <aside class="col-md-6 col-sm-4">
                                        <img src="assets/images/certificate.jpg" class="pull-right" />
                                    </aside>
                                </article>
                                <article class="clearfix m-t-20">
                                    <aside class="col-md-6 col-sm-8">
                                        <h6>Certificate Holder of World Osteoporosis, Councle for bone Densteometry and Osteoporosis Hongcong</h6>
                                        <p>2001</p>
                                    </aside>
                                    <aside class="col-md-6 col-sm-4">
                                        <img src="assets/images/certificate.jpg" class="pull-right" />
                                    </aside>
                                </article>
                                <article class="clearfix m-t-20">
                                    <aside class="col-md-6 col-sm-8">
                                        <h6>Certificate Holder of World Osteoporosis, Councle for bone Densteometry and Osteoporosis Hongcong</h6>
                                        <p>2001</p>
                                    </aside>
                                    <aside class="col-md-6 col-sm-4">
                                        <img src="assets/images/certificate.jpg" class="pull-right" />
                                    </aside>
                                </article>
                            </div>
                        </section>
                        <!-- Awards Ends -->
                        <!-- Appointment History Starts -->
                        <section class="tab-pane fade in" id="appointment">
                            <aside class="table-responsive">
                                <table class="table doctor-table">
                                    <tr>
                                        <th>Appt Id</th>
                                        <th>Date & Time</th>
                                        <th>Patient</th>
                                        <th>Appointment Status</th>
                                        <th>Rating Received</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>ACH089</h6></td>
                                        <td>
                                            <h6>September 17, 2015</h6>
                                            <p>12:30 PM</p>
                                        </td>
                                        <td>
                                            <h6>Vipul Jain</h6>
                                            <p>Male | 45 Years</p>
                                        </td>
                                        <td>
                                            <h6>Completed</h6>
                                        </td>
                                        <td>
                                            <h6><span class="label label-success waves-effect waves-light m-b-5 center-block">5.0</span></h6>
                                            <h6><i class="fa fa-commenting clg"></i></h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>ACH089</h6></td>
                                        <td>
                                            <h6>September 17, 2015</h6>
                                            <p>12:30 PM</p>
                                        </td>
                                        <td>
                                            <h6>Vipul Jain</h6>
                                            <p>Male | 45 Years</p>
                                        </td>
                                        <td>
                                            <h6>Completed</h6>
                                        </td>
                                        <td>
                                            <h6><span class="label label-success waves-effect waves-light m-b-5 center-block">5.0</span></h6>
                                            <h6><i class="fa fa-commenting clg"></i></h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>ACH089</h6></td>
                                        <td>
                                            <h6>September 17, 2015</h6>
                                            <p>12:30 PM</p>
                                        </td>
                                        <td>
                                            <h6>Vipul Jain</h6>
                                            <p>Male | 45 Years</p>
                                        </td>
                                        <td>
                                            <h6>Completed</h6>
                                        </td>
                                        <td>
                                            <h6><span class="label label-success waves-effect waves-light m-b-5 center-block">5.0</span></h6>
                                            <h6><i class="fa fa-commenting clg"></i></h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>ACH089</h6></td>
                                        <td>
                                            <h6>September 17, 2015</h6>
                                            <p>12:30 PM</p>
                                        </td>
                                        <td>
                                            <h6>Vipul Jain</h6>
                                            <p>Male | 45 Years</p>
                                        </td>
                                        <td>
                                            <h6>Completed</h6>
                                        </td>
                                        <td>
                                            <h6><span class="label label-success waves-effect waves-light m-b-5 center-block">5.0</span></h6>
                                            <h6><i class="fa fa-commenting clg"></i></h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>ACH089</h6></td>
                                        <td>
                                            <h6>September 17, 2015</h6>
                                            <p>12:30 PM</p>
                                        </td>
                                        <td>
                                            <h6>Vipul Jain</h6>
                                            <p>Male | 45 Years</p>
                                        </td>
                                        <td>
                                            <h6>Completed</h6>
                                        </td>
                                        <td>
                                            <h6><span class="label label-success waves-effect waves-light m-b-5 center-block">5.0</span></h6>
                                            <h6><i class="fa fa-commenting clg"></i></h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>ACH089</h6></td>
                                        <td>
                                            <h6>September 17, 2015</h6>
                                            <p>12:30 PM</p>
                                        </td>
                                        <td>
                                            <h6>Vipul Jain</h6>
                                            <p>Male | 45 Years</p>
                                        </td>
                                        <td>
                                            <h6>Completed</h6>
                                        </td>
                                        <td>
                                            <h6><span class="label label-success waves-effect waves-light m-b-5 center-block">5.0</span></h6>
                                            <h6><i class="fa fa-commenting clg"></i></h6>
                                        </td>
                                    </tr>
                                </table>
                            </aside>
                        </section>
                        <!-- Appointment History Starts -->
                        <!-- Account Detail Starts -->
                        <section class="tab-pane fade in" id="account">
                            <div class="clearfix m-t-20 p-b-20 doctor-description">   
                                <article class="clearfix">
                                    <aside class="col-sm-8 setting">
                                        <h4>Account Detail
                                            <a id="editaccount" class="pull-right cl-pencil">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                         </h4>
                                        <hr/>
                                    </aside>
                                </article>
                                <section id="detailaccount">
                                    <article class="clearfix m-t-10">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Registered Email Id :</label>
                                        <p class="col-md-8 col-sm-8"><?php echo $doctorDetail[0]->users_email; ?></p>
                                    </article>
                                    <article class="clearfix m-t-10">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Registered Mobile Number:</label>
                                        <p class="col-md-8 col-sm-8">+91 <?php echo $doctorDetail[0]->doctors_registeredMblNo; ?></p>
                                    </article>
                                    <article class="clearfix m-t-10">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Change Password:</label>

                                        
                                    </article>
                                </section>
                                <section id="newdetailaccount" style="display:none">
                                    <form name="changePasswordForm" action="#" id="changePasswordForm" method="post">
                                        <input type="hidden" id="user_id" name="user_id" value="<?php echo $doctorDetail[0]->doctors_userId; ?>" />
                                        <input type="hidden" id="doctorAjaxId" name="doctorAjaxId" value="<?php echo $doctorDetail[0]->doctors_id; ?>" />
                                        <article class="clearfix m-t-10">
                                            <label for="cemail" class="control-label col-md-4 col-sm-4">Registered Email Id :</label>
                                            <aside class="col-md-4 col-sm-4">
                                                <input type="email" class="form-control" name="registered_email" id="registered_email" value="<?php echo $doctorDetail[0]->users_email; ?>" >
                                                <label class="error" id="err_registered_email" > <?php echo form_error("registered_email"); ?></label>
                                            </aside>
                                        </article>
                                        <article class="clearfix m-t-10">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Registered Mobile Number:</label>
                                            <aside class="col-md-4 col-sm-4">
                                                <input type="text" class="form-control" id="register_mobile" name="register_mobile" value="<?php echo $doctorDetail[0]->doctors_registeredMblNo; ?>" >
                                                <label class="error" id="err_register_mobile" > <?php echo form_error("register_mobile"); ?></label>
                                            </aside>
                                        </article>
                                        <article class="clearfix m-t-10">
                                            <label for="cemail" class="control-label col-md-4 col-sm-4">Change Password:</label>
                                            <aside class="col-md-4 col-sm-4">
                                                <input type="password" name="password" id="password" class="form-control" placeholder="New Password" />
                                                <label class="error" id="err_password" > <?php echo form_error("password"); ?></label>
                                            </aside>
                                        </article>
                                        <article class="clearfix m-t-10">
                                            <label for="cemail" class="control-label col-md-4 col-sm-4">Confirm Password:</label>
                                            <aside class="col-md-4 col-sm-4">
                                                <input type="password" name="confirm" id="confirm" class="form-control" placeholder="Confirm Password" />
                                                <label class="error" id="err_confirm" > <?php echo form_error("confirm"); ?></label>
                                            </aside>
                                        </article>
                                        <section class="clearfix ">
                                            <div class="m-t-20 m-b-20">
                                                <button type="submit" class="btn btn-success waves-effect waves-light  m-r-20">Submit</button>
                                            </div>
                                        </section>
                                    </form>
                                </section>
                            </div>
                        </section>
                        <!-- Account Detail Ends -->
                        <!-- Timeslot Starts Section -->
                        <section class="tab-pane fade in" id="timeslot">

                            <div class="bg-white mi-form-section">
                                <!-- Top Detailed Section -->
                                <!-- Time Scedule Start here-->
                                <div class="clearfix m-t-20 text-center time-span">
                                    <section class="col-md-1 col-sm-1">
                                        <h6 class="text-left">Days</h6>
                                    </section>
                                    <div class="col-md-11">
                                        <section class="col-md-3 col-sm-3">
                                            <h6 class="col-sm-12 col-xs-6">Morning Session</h6>
                                            <h6 class="col-sm-12 col-xs-6">06:00 AM-11:59 AM</h6>
                                        </section>
                                        <section class="col-md-3 col-sm-3">
                                            <h6 class="col-sm-12 col-xs-6">Afternoon Session</h6>
                                            <h6 class="col-sm-12 col-xs-6">12:00 PM-05:59 PM</h6>
                                        </section>
                                        <section class="col-md-3 col-sm-3">
                                            <h6 class="col-sm-12 col-xs-6">Evening Session</h6>
                                            <h6 class="col-sm-12 col-xs-6">06:00 PM-10:59 PM</h6>
                                        </section>  
                                        <section class="col-md-3 col-sm-3">
                                            <h6 class="col-sm-12 col-xs-6">Night Session</h6>
                                            <h6 class="col-sm-12 col-xs-6">11:00 PM-05:59 AM</h6>
                                        </section>
                                    </div>
                                </div>
                                <div class="row col-md-12" style="display: none"><span class="alert alert-success" id="successTop"></span></div>
                                <div class="row col-md-12" style="display: none"><span class="alert alert-danger" id="er_TopError"></span></div>

                                <form id="setData" name="setData" method="post" action="#" >
                                    <?php
                                    $refferalId = (isset($this->input->get_post['reffralId']) && $this->input->get_post['reffralId']) != "" ? : $doctorDetail[0]->doctors_userId;
                                    $weekIndexs = array(0, 1, 2, 3, 4, 5, 6);
                                    ?>
                                    <input type="hidden" name="doctorId" value="<?php echo $doctorDetail[0]->doctors_id; ?>" />
                                    <input type="hidden" name="doctors_userId" value="<?php echo $doctorDetail[0]->doctors_userId; ?>" />
                                    <input type="hidden" name="doctors_refferalId" value="<?php echo $refferalId; ?>" />
                                    <?php
                                    if (isset($doctorAvailability->reffreles) && $doctorAvailability->reffreles != NULL) {
                                        foreach ($doctorAvailability->reffreles as $key => $value) {
                                            if (isset($doctorAvailability->doctorAvailabilitys) && $doctorAvailability->doctorAvailabilitys != NULL) {
                                                foreach ($doctorAvailability->doctorAvailabilitys as $index => $dA) {
                                                    if ($value != $refferalId) {
                                                        ?>
                                                        <div class="col-md-12">
                                                            <section class="col-md-12 col-sm-12">
                                                                <aside class="checkbox checkbox-success text-left">
                    <?php echo $dA->refferelName[$value] . ":" ?>
                                                                </aside>
                                                            </section>
                                                        </div>
                                                        <div class="clearfix m-t-20 text-center">
                                                            <section class="col-md-1 col-sm-12">
                                                                <aside class="checkbox checkbox-success text-left">
                                                                <?php echo convertNumberToDay($index) . ":" ?>
                                                                </aside>
                                                            </section>
                                                            <div class="col-md-11">
                                                                <?php
                                                                for ($k = 0; $k <= 4; $k++) {
                                                                    if (isset($dA->session[$value][$k]) && $dA->session[$value][$k] != NULL) {
                                                                        $startTime = date("h:i A", strtotime($dA->session[$value][$k]->SessionStart));
                                                                        $endTime = date("h:i A", strtotime($dA->session[$value][$k]->SessionEnd));
                                                                        ?>
                                                                        <section class="col-md-3 col-sm-3">
                                                                            <article class="clearfix">
                                                                                <aside class="col-md-12 col-sm-12 col-xs-12 schdule-space">
                                                                                    <div class="bootstrap-timepicker input-group">
                                                                                        <span class="col-md-12 col-sm-12 col-xs-12"><strong><?php echo $startTime; ?></strong>   to  <strong><?php echo $endTime; ?></strong></span>
                                                                                    </div>
                                                                                </aside>
                                                                            </article>
                                                                        </section>
                        <?php }
                    }
                    ?>
                                                            </div>
                                                        </div>  
                <?php } else { ?>
                                                        <div class="col-md-12">
                                                            <section class="col-md-12 col-sm-1">
                                                                <aside class="checkbox checkbox-success text-left">
                                                                    <srtong> <?php echo $dA->refferelName[$value] . ":" ?></srtong>
                                                                </aside>
                                                            </section>
                                                        </div>
                                                        <div class="clearfix m-t-20 text-center">
                                                            <section class="col-md-1 col-sm-1">
                                                                <aside class="checkbox checkbox-success text-left"> 
                                                                    <input class="daycheck" name="day[]" value="<?php echo $index; ?>" checked  type="checkbox" id="checkbox3">
                                                                    <label for="checkbox3">
                                                                <?php echo convertNumberToDay($index); ?>
                                                                    </label>
                                                                </aside>
                                                            </section>

                <div class="col-md-11">
                    <?php
                    for ($k = 0; $k < 4; $k++) {
                        if (isset($dA->session[$value][$k]) && $dA->session[$value][$k] != NULL) {
                            $startTime = $dA->session[$value][$k]->SessionStart;
                            $endTime = $dA->session[$value][$k]->SessionEnd;
                            ?>
                                <section class="col-md-3 col-sm-3">
                                    <article class="clearfix">
                                        <aside class="col-md-6 col-sm-12 col-xs-6 schdule-space">
                                            <div class="bootstrap-timepicker input-group">
                                                <input type="text" onblur="removeError(this)"  id="err_<?php echo $index; ?>_session_<?php echo $k; ?>_st" name="<?php echo $index; ?>_session_<?php echo $k; ?>_st" value="<?php echo date("g:i a", strtotime($startTime)); ?>" class="form-control timepickerclock" >
                                            </div>
                                        </aside>
                                        <aside class="col-md-6 col-sm-12 col-xs-6 schdule-space">
                                            <div class="bootstrap-timepicker input-group timepicker">
                                                <input type="text" name="<?php echo $index; ?>_session_<?php echo $k; ?>_ed" value="<?php echo date("g:i a", strtotime($endTime)); ?>" class="form-control timepickerclock" onblur="removeError(this)"  id="err_<?php echo $index; ?>_session_<?php echo $k; ?>_ed" value="<?php echo date("g:i a", strtotime($endTime)); ?>">
                                            </div>
                                        </aside>
                                    </article>
                                </section>
                            <?php }
                        }
                        ?>
                            </div>
                        </div> <hr/>
                    <?php
                    }
                }
            }
        }
    }
//                                    dump((isset($doctorAvailability->reffreles) && $doctorAvailability->reffreles != NULL && (!in_array($index, $doctorAvailability->reffreles))));
                                    foreach ($weekIndexs as $index) {
//                                        dump($doctorAvailability->doctorAvailabilitys);
//                                        
                                        if (in_array($index, $doctorAvailability->weekIndexs)) {
                                            if(((isset($doctorAvailability->dayIndex) && $doctorAvailability->dayIndex != NULL && (!in_array($index, $doctorAvailability->dayIndex))))){
                                            ?>
                                            <div class="clearfix m-t-20 text-center">
                                                <section class="col-md-1 col-sm-1">
                                                    <aside class="checkbox checkbox-success text-left">
        <?php
        $availabilityStatus = (isset($doctorAvailability->doctorAvailabilitys[$index]->availabilityStatus)) ? $doctorAvailability->doctorAvailabilitys[$index]->availabilityStatus : '';
        ?>
                                                        <input class="daycheck" name="day[]" value="<?php echo $index; ?>" <?php echo ($availabilityStatus) ? 'checked' : ''; ?>  type="checkbox" id="checkbox3">
                                                        <label for="checkbox3">
                                                    <?php echo   convertNumberToDay($index); ?>
                                                        </label>
                                                    </aside>
                                                </section>
                                                <div class="col-md-11">
                                                    <?php
//                                                     dump($timeSlots);
                                                    for ($i = 0; $i < 4; $i++) {



                                                        if (isset($doctorAvailability->doctorAvailabilitys[$index]->session[$i]->SessionStart)) {
                                                            $startTime = $doctorAvailability->doctorAvailabilitys[$index]->session[$i]->SessionStart;
                                                            $endTime = $doctorAvailability->doctorAvailabilitys[$index]->session[$i]->SessionEnd;
                                                            ?>
                                                            <section class="col-md-3 col-sm-3">
                                                                <article class="clearfix">
                                                                    <aside class="col-md-6 col-sm-12 col-xs-6 schdule-space">
                                                                        <div class="bootstrap-timepicker input-group">
                                                                            <input type="text" onblur="removeError(this)"  id="err_<?php echo $index; ?>_session_<?php echo $i; ?>_st" name="<?php echo $index; ?>_session_<?php echo $i; ?>_st" value="<?php echo date("g:i a", strtotime($startTime)); ?>" class="form-control timepickerclock" >
                                                                        </div>
                                                                    </aside>
                                                                    <aside class="col-md-6 col-sm-12 col-xs-6 schdule-space">
                                                                        <div class="bootstrap-timepicker input-group timepicker">
                                                                            <input type="text" name="<?php echo $index; ?>_session_<?php echo $i; ?>_ed" value="<?php echo date("g:i a", strtotime($endTime)); ?>" class="form-control timepickerclock" onblur="removeError(this)"  id="err_<?php echo $index; ?>_session_<?php echo $i; ?>_ed" value="<?php echo date("g:i a", strtotime($endTime)); ?>">
                                                                        </div>
                                                                    </aside>
                                                                </article>
                                                            </section>

            <?php } else { ?>
                                                            <section class="col-md-3 col-sm-3">
                                                                <article class="clearfix">
                                                                    <aside class="col-md-6 col-sm-12 col-xs-6 schdule-space">
                                                                        <div class="bootstrap-timepicker input-group text-info timepicker">
                                                                            <input type="text" value="" class="form-control timepickerclock " onblur="removeError(this)"  id="err_<?php echo $index; ?>_session_<?php echo $i; ?>_st" name="<?php echo $index; ?>_session_<?php echo $i; ?>_st" >
                                                                        </div>
                                                                    </aside>
                                                                    <aside class="col-md-6 col-sm-12 col-xs-6 schdule-space">
                                                                        <div class="bootstrap-timepicker input-group border-bottom timepicker">
                                                                            <input type="text" value="" class="form-control timepickerclock " onblur="removeError(this)"  id="err_<?php echo $index; ?>_session_<?php echo $i; ?>_ed" name="<?php echo $index; ?>_session_<?php echo $i; ?>_ed" >
                                                                        </div>
                                                                    </aside>
                                                                </article>
                                                            </section>
                                                    <?php
                                                }
                                            }
                                            ?>
                                                </div>
                                            </div><hr/>
                                                            <?php
                                            } } else { ?>
                                            <div class="clearfix m-t-20 text-center">
                                                <section class="col-md-1 col-sm-1">
                                                    <aside class="checkbox checkbox-success text-left">
                                                        <input class="daycheck" name="day[]" value="<?php echo $index; ?>" type="checkbox" id="checkbox3">
                                                        <label for="checkbox3"><?php echo  convertNumberToDay($index); ?> </label>
                                                    </aside>
                                                </section>
                                                <div class="col-md-11">
                                                    <?php for ($i = 0; $i < 4; $i++) { ?>
                                                    <section class="col-md-3 col-sm-3">
                                                        <article class="clearfix">
                                                            <aside class="col-md-6 col-sm-12 col-xs-6 schdule-space">
                                                                <div class="bootstrap-timepicker input-group timepicker">
                                                                    <input type="text" value="" class="form-control timepickerclock" onblur="removeError(this)"  id="err_<?php echo $index; ?>_session_<?php echo $i; ?>_st" name="<?php echo $index; ?>_session_<?php echo $i; ?>_st" >
                                                                </div>
                                                            </aside>
                                                            <aside class="col-md-6 col-sm-12 col-xs-6 schdule-space">
                                                                <div class="bootstrap-timepicker input-group timepicker">
                                                                    <input type="text" value="" class="form-control timepickerclock" onblur="removeError(this)"  id="err_<?php echo $index; ?>_session_<?php echo $i; ?>_ed" name="<?php echo $index; ?>_session_<?php echo $i; ?>_ed" >
                                                                </div>
                                                            </aside>
                                                        </article>
                                                    </section>
        <?php } ?>
                                                </div>
                                            </div><hr/>
        <?php
    }
                                        }
//                                    }
?>


                                    <hr class="hr-scedule">


                                    <!--Time Schedule Ends-->
                                    <section class="clearfix ">
                                        <div class="col-md-12 m-t-20 m-b-20 text-right">
                                            <button type="button" class="btn btn-danger waves-effect ">Reset</button>
                                            <button type="submit" class="btn btn-success waves-effect waves-light  m-r-20">Submit</button>
                                        </div>

                                    </section>
                                </form>   
                            </div>


                        </section>

                    </article>


                </section>
            </div>

            <!-- Left Section End -->

        </div>

        <!-- container -->
    </div>
    <!-- content -->


