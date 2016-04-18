<!-- Begin page -->
<style>
.has-error {
	color:red;
}
</style>
<div id="wrapper">
    <!-- Start right Content here -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container row">
                <!-- consultation -->
                <div style="display:show;" id="consultDiv">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Add Appointments</h3>
                        </div>
                    </div>
                    <form class="cmxform form-horizontal tasi-form" id="setData" method="post" action="#" >
                        <!-- Left Section Start -->
                        <section class="col-md-6 detailbox">
                            <div class="bg-white mi-form-section">
                                <figure class="clearfix">
                                    <h3>Appointment Details</h3>
                                    <div class="alert alert-success" id="successTop" style="display: none"></div>
                                    <div class="alert alert-danger" id="er_TopError" style="display: none"></div>
                                </figure>
                                <!-- Table Section End -->
                                <div class="clearfix m-t-20">
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Select City:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" onchange="getMI()" id="appointment_city" name="input1" data-width="100%" >
                                                <option value="">Select City</option>
                                                <?php if(isset($qyura_city) && $qyura_city != NULL){
                                                    foreach($qyura_city as $city){ ?>
                                                    <option value="<?php echo $city->city_id; ?>"><?php echo $city->city_name; ?></option>
                                                <?php } } ?>
                                            </select>
                                            <div class="has-error " id="err_input1" ><?php echo form_error("input1"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Appointment For :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" data-width="100%" onchange="getMI()" id="centerType" name="input2" >
                                                <option value="">Select Type</option>
                                                <option value="0">Hospitals</option>
                                                <option value="1">Diagnostic Center</option>
                                            </select>
                                            <div class="has-error " id="err_input2" ><?php echo form_error("input2"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Select Hospital/Diagnostic:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" data-width="100%" id="mi_centre" name="input3" onchange="getTimeSlot()" >
                                                <option value="">Select Hospital/Diagnostic</option>
                                            </select>
                                            <div class="has-error " id="err_input3" ><?php echo form_error("input3"); ?></div>
                                        </div>
                                    </article>
                                    <!--time-->
                                    <article class="form-group m-lr-0">
                                        <label for="" class="control-label col-md-4 col-sm-4">Time Slot :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" name="input4" id="timeSlot" data-width="100%" >
                                                <option value="">Select Time Slot</option>
                                            </select>
                                            <div class="has-error " id="err_input4" ><?php echo form_error("input4"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="" class="control-label col-md-4 col-sm-4">Final Timing :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <div class="bootstrap-timepicker input-group w-full">
                                                <input id="timepicker4" type="text" class="form-control timepicker" name="input34" value="<?php echo date("H:i"); ?>"/>
                                                <div class="has-error " id="err_input34" ><?php echo form_error("input34"); ?></div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Appointment Type :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" data-width="100%" onchange="changeForm()" id="input5" name="input5" >
                                                <option value="">Select Type</option>
                                                <option value="0">Consultation</option>
                                                <option value="1">Diagnostic</option>
                                            </select>
                                            <div class="has-error " id="err_input5" ><?php echo form_error("input5"); ?></div>
                                        </div>
                                    </article>
<!-- comman START-->
<!--date-->
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Date :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <div class="input-group">
                                                <input class="form-control pickDate" placeholder="dd/mm/yy" id="date-3" type="text" onkeydown="return false;" name="input6" />
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                            <div class="has-error " id="err_input6" ><?php echo form_error("input6"); ?></div>
                                        </div>
                                    </article>
<!--Appointment Status-->
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Appointment Status :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" name="input8" id="input8" data-width="100%" >
                                                <option value="" >Select Status</option>
                                                <option value="1" >Pending</option>
                                                <option value="2" >Confirm</option>
                                                <option value="3" >Cancle</option>
                                                <option value="4" >Completed</option>
                                            </select>
                                            <div class="has-error " id="err_input8" ><?php echo form_error("input8"); ?></div>
                                        </div>
                                    </article>
<!--HMS Appointment-->
                                    <article class="form-group m-lr-0">
                                        <label for="" class="control-label col-md-4 col-sm-4">HMS Appointment ID (Optional) :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control " id="curl" type="text" name="input9" >
                                            <div class="has-error " id="err_input9" ><?php echo form_error("input9"); ?></div>
                                        </div>
                                    </article>
<!-- comman END-->
                                <!-- doctor section start -->
                                <div id="doctorSection" style="display: none">
                                <!--doctor   spe-->
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Specialities :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" name="input10" id="speciallity" data-width="100%" onchange="findDoctor()">
                                            <option value="">Select Speciality</option>
                                           
                                            </select>
                                            <div class="has-error " id="err_input10" ><?php echo form_error("input10"); ?></div>
                                        </div>
                                    </article>
<!--doctor list-->
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Assign Doctor :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" name="input12" id="input12" data-width="100%">
                                                <option value="">Select Doctor</option>
                                            </select>
                                            <div class="has-error " id="err_input12" ><?php echo form_error("input12"); ?></div>
                                        </div>
                                    </article>
<!-- doctor Session --> 
 <!-- doctor Patient Remarks -->                                    
                                    <article class="form-group m-lr-0">
                                        <label for="" class="control-label col-md-4 col-sm-4">Patient Remarks :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <textarea class="form-control" id="patientRemark" name="input13"  aria-required="true"></textarea>
                                            <div class="has-error " id="err_input13" ><?php echo form_error("input13"); ?></div>
                                        </div>
                                    </article>
                                </div>
                                <div id="diagnosticSection" style="display: none">
                                    <div id="diagnosticClon_1">
                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4 cl-black">Test-1 :</label>
                                            <input type="hidden" id="total_test" name="total_test" value="1">
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Diagnostic Type :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <select class="selectpicker" data-width="100%" name="input28_1" id="input28_1" >
                                                    <option value="">Select Diagnostic Category</option>
                                                
                                                </select>
                                                <div class="has-error " id="err_input28_1" ><?php echo form_error("input28_1"); ?></div>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Test Name :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input type="text" class="form-control" name="input29_1" id="input29_1" >
                                                <div class="has-error " id="err_input29_1" ><?php echo form_error("input29_1"); ?></div>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Price :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control " type="text" id="input30_1" name="input30_1" placeholder="770"  >
                                                <div class="has-error " id="err_input30_1" ><?php echo form_error("input30_1"); ?></div>
                                            </div>
                                        </article>

                                        <article class="form-group m-lr-0">
                                            <label for="" class="control-label col-md-4 col-sm-4">Instruction :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <textarea class="form-control" id="input31_1" name="input31_1" placeholder="" ></textarea>
                                                <div class="has-error " id="err_input31_1" ><?php echo form_error("input31_1"); ?></div>
                                            </div>
                                        </article>
                                    </div>    
                                    <article class="form-group m-lr-0">

                                        <div class="col-md-5 col-sm-5  col-md-offset-4 col-sm-offset-4">
                                            <button type="button" href="javascript:void(0)" class="btn btn-success btn-block waves-effect waves-light" onclick="addMoreTest()" >Add More Test </button>
                                        </div>
<div class="col-md-3 col-sm-3 col-md-offset-0 col-sm-offset-0">
                                        </div>
                                    </article>
                                </div>
                                <!-- doctor section end -->
                                </div>
                                <!-- .form -->
                            </div>
                        </section>
                        <!-- Left Section End -->
                        <!-- Right Section Start -->
                        <section class="col-md-6 detailbox mi-form-section">
                            <div class="bg-white clearfix">
                                <!-- Patient Section Start -->
                                <figure class="clearfix">
                                    <h3>Patient Details</h3>
                                </figure>
                                <aside class="clearfix m-t-20">
                                    <article class="form-group m-lr-0 m-rl-o">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Patient Email Id :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="hidden" class="form-control" name="user_id" id="user_id" >
                                            <input type="hidden" class="form-control" name="email_status" id="email_status" >
                                            <input class="form-control" id="patient_email" name="input14" type="email"  aria-required="true" placeholder="Test@gmail.com" onblur="getpatientdetails()">
                                            <div class="has-error " id="err_input14" ><?php echo form_error("input14"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Patient Mobile Number :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" id="users_mobile" name="input15" type="text"  aria-required="true" placeholder="Mobile Number" >
                                            <div class="has-error " id="err_input15" ><?php echo form_error("input15"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0" id="p_unqId" style="display: none">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Patient Id:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" id="unqId" name="input16" type="text" aria-required="true" placeholder="Patient Id" readonly="">
                                            <div class="has-error " id="err_input16" ><?php echo form_error("input16"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Patient Name:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" id="users_username" name="input17" type="text"  aria-required="true" placeholder="Name" >
                                            <div class="has-error " id="err_input17" ><?php echo form_error("input17"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">DOB :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <div class="input-group">
                                                <input class="form-control pickDate" placeholder="dd/mm/yy" id="date-4" type="text"  name="input35" value="<?php echo date("m/d/Y"); ?>"/>
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                <div class="has-error " id="err_input35" ><?php echo form_error("input35"); ?></div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Gender :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" name="input36" id="input36" data-width="100%" >
                                                <option value="" >Select Gender</option>
                                                <option value="1" >Male</option>
                                                <option value="2" >Female</option>
                                                <option value="3" >Other</option>
                                            </select>
                                            <div class="has-error " id="err_input36" ><?php echo form_error("input36"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Address:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <aside class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <select class="selectpicker" id="countryId" name="input18" data-size="4" data-width="100%" >
                                                        <option value="1">India</option>
                                                    </select>
                                                    <div class="has-error " id="err_input18" ><?php echo form_error("input18"); ?></div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                    <select class="selectpicker" data-width="100%" name="input19" Id="stateId" data-size="4" onchange ="fetchCity(this.value)" >
                                                        <option value="">Select State</option>
                                                       <?php foreach($allStates as $key=>$val) {?>
                                                        <option value="<?php echo $val->state_id;?>"><?php echo $val->state_statename;?></option>
                                                         <?php }?>
                                                    </select>
                                                    <div class="has-error " id="err_input19" ><?php echo form_error("input19"); ?></div>
                                                </div>
                                            </aside>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0 m-t-xs-10">
                                        <div class="col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4">
                                            <aside class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <select name="input32" id="cityId" data-size="4" class="selectpicker" data-width="100%" >
                                                    </select>
                                                    <div class="has-error " id="err_input32" ><?php echo form_error("input32"); ?></div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                    <input type="text" class="form-control" id="zip" name="input20" placeholder="700001" />
                                                    <div class="has-error " id="err_input20" ><?php echo form_error("input20"); ?></div>
                                                </div>
                                            </aside>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0 m-t-xs-10">
                                        <div class="col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4">
                                            <input type="text" class="form-control" id="address" name="input21" placeholder="209, ABC Road, near XYZ Building " />
                                            <div class="has-error " id="err_input21" ><?php echo form_error("input21"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0" id="familyDiv" style="display: none">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">For Your Family Member</label>
                                        <div class="col-md-8 col-sm-8">
                                            <div class="radio radio-success radio-inline">
                                                <input type="radio" name="family_member" value="1" id="inlineRadio1" onclick="getMember('1')" >
                                                <label for="inlineRadio1">Yes</label>
                                            </div>
                                            <div class="radio radio-success radio-inline">
                                                <input type="radio" name="family_member" value="0" id="inlineRadio2" checked="" onclick="getMember('0')" >
                                                <label for="inlineRadio2">No</label>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0" id="familyListDiv" style="display: none">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Members :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" name="input33" id="input33" data-width="100%" >
                                                <option value="" >Select Member</option>
                                            </select>
                                            <div class="has-error " id="err_input33" ><?php echo form_error("input33"); ?></div>
                                        </div>
                                    </article>
                                </aside>
                                <!-- Payment Section Start -->
                                <figure class="clearfix">
                                    <h3>Payment Details</h3>
                                </figure>
                                <aside class="clearfix m-t-20">
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Consulation Fee:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="text" class="form-control" id="input22" name="input22" placeholder="500" />
                                            <div class="has-error " id="err_input22" ><?php echo form_error("input22"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Other Fee:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="text" class="form-control" id="input23" name="input23" placeholder="0"  />
                                            <div class="has-error " id="err_input23" ><?php echo form_error("input23"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Tax :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="text" class="form-control" name="input24" id="input24" placeholder="12.5%"  onblur="calculateamount()">
                                            <div class="has-error " id="err_input24" ><?php echo form_error("input24"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Total Payable Amount:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="text" class="form-control" id="input25" name="input25" placeholder="$$$"  readonly=""/>
                                            <div class="has-error " id="err_input25" ><?php echo form_error("input25"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Payment Status :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" name="input26" id="input26" data-width="100%" >
                                                <option value="1" >Paid</option>
                                                <option value="0" >Unpaid</option>
                                            </select>
                                            <div class="has-error " id="err_input26" ><?php echo form_error("input26"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Payment Mode:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select type="text" class="selectpicker" id="input27" name="input27" data-width="100%" >
                                                <option value="1" >Cash</option>
                                            </select>
                                            <div class="has-error " id="err_input27" ><?php echo form_error("input27"); ?></div>
                                        </div>
                                    </article>
                                </aside>
                                <!-- Payment Section End -->
                            </div>
                        </section>
                        <section class="clearfix ">
                            <div class="col-md-12 m-t-20 m-b-20">
                                <button class="btn btn-danger waves-effect pull-right" type="button">Reset</button>
                                <input class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit" value="Submit" onclick="calculateamount()">
                            </div>
                        </section>
                    </form>
                </div>
                <!-- consultation -->
            </div>
            <!-- container -->
        </div>
        <!-- content -->
        <footer class="footer text-right">
            2015 © Qyura.
        </footer>
    </div>
    <!-- End Right content here -->
</div>
<!-- END wrapper -->
