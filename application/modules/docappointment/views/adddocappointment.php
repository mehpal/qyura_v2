<style>
    .has-error{
        color: red;
    }
</style>
<!-- Begin page -->
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
                                </figure>
                                <!-- Table Section End -->
                                <div class="clearfix m-t-20">
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Select City:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="form-control select2" onchange="findDoc()" id="appointment_city" name="input1" data-width="100%" >
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
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Specialities :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="form-control select2" name="input2" id="speciallity" data-width="100%" onchange="findDoc()">
                                                <option value="">Select Speciality</option>
                                                <?php if(isset($spOptions) && $spOptions != NULL){
                                                    foreach($spOptions as $spOption){ ?>
                                                    <option value="<?php echo $spOption->speId; ?>"><?php echo $spOption->speName; ?></option>
                                                <?php } } ?>
                                            </select>
                                            <div class="has-error " id="err_input2" ><?php echo form_error("input2"); ?></div>
                                        </div>
                                    </article>
                                    <!--date-->
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Date :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <div class="input-group">
                                                <input class="form-control pickDate" placeholder="dd/mm/yy" id="date-3" type="text"  name="input4" value="<?php echo date("m/d/Y"); ?>"/>
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                <div class="has-error " id="err_input4" ><?php echo form_error("input4"); ?></div>
                                            </div>
                                        </div>
                                    </article>
                                    <!--doctor list-->
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Assign Doctor :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="form-control select2" name="input3" id="input3" data-width="100%" onchange="getTimeSlot();">
                                                <option value="">Select Doctor</option>
                                            </select>
                                            <div class="has-error " id="err_input3" ><?php echo form_error("input3"); ?></div>
                                        </div>
                                    </article>
                                    <!--time-->
                                    <article class="form-group m-lr-0">
                                        <label for="" class="control-label col-md-4 col-sm-4">Time Slot :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="form-control select2" name="input5" id="timeSlot" data-width="100%" >
                                                <option value="">Select Time Slot</option>
                                            </select>
                                            <div class="has-error " id="err_input5" ><?php echo form_error("input5"); ?></div>
                                        </div>
                                    </article>
                                    <!-- comman START-->
                                    <article class="form-group m-lr-0">
                                        <label for="" class="control-label col-md-4 col-sm-4">Final Timing :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <div class="bootstrap-timepicker input-group w-full">
                                                <input id="timepicker4" type="text" class="form-control timepicker" name="input24" value="<?php echo date("g:i A"); ?>" />
                                                <div class="has-error " id="err_input24" ><?php echo form_error("input24"); ?></div>
                                                <div class="has-error " id="err_timepicker4" style="display: none">Please select correct final timing</div>
                                            </div>
                                        </div>
                                    </article>
<!--HMS Appointment-->
                                    <article class="form-group m-lr-0">
                                        <label for="" class="control-label col-md-4 col-sm-4">HMS Appointment ID (Optional) :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control " id="curl" type="text" name="input7" >
                                            <div class="has-error " id="err_input7" ><?php echo form_error("input7"); ?></div>
                                        </div>
                                    </article>
<!-- comman END-->
                                <!-- doctor Patient Remarks -->                                    
                                    <article class="form-group m-lr-0">
                                        <label for="" class="control-label col-md-4 col-sm-4">Patient Remarks :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <textarea class="form-control" id="patientRemark" name="input8"  aria-required="true"></textarea>
                                            <div class="has-error " id="err_input8" ><?php echo form_error("input8"); ?></div>
                                        </div>
                                    </article>
                                
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
                                            <input class="form-control" id="patient_email" name="input9" type="email"  aria-required="true" placeholder="Email" onblur="getpatientdetails()">
                                            <div class="has-error " id="err_input9" ><?php echo form_error("input9"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Patient Mobile Number :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" id="users_mobile" name="input10" type="text"  aria-required="true" placeholder="Mobile Number" >
                                            <div class="has-error " id="err_input10" ><?php echo form_error("input10"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0" id="p_unqId" style="display: none">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Patient Id:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" id="unqId" name="input11" type="text" aria-required="true" placeholder="Patient Id" readonly="">
                                            <div class="has-error " id="err_input11" ><?php echo form_error("input11"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Patient Name:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" id="users_username" name="input12" type="text"  aria-required="true" placeholder="Name" >
                                            <div class="has-error " id="err_input12" ><?php echo form_error("input12"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">DOB :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <div class="input-group">
                                                <input class="form-control pickDate" placeholder="dd/mm/yy" id="date-4" type="text"  name="input26" value="<?php echo date("m/d/Y"); ?>"/>
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                <div class="has-error " id="err_input26" ><?php echo form_error("input26"); ?></div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Gender :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="form-control select2" name="input27" id="input27" data-width="100%" >
                                                <option value="" >Select Gender</option>
                                                <option value="1" >Male</option>
                                                <option value="2" >Female</option>
                                                <option value="3" >Other</option>
                                            </select>
                                            <div class="has-error " id="err_input27" ><?php echo form_error("input27"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Address:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <aside class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <select class="form-control select2" id="countryId" name="input13" data-size="4" data-width="100%" >
                                                        <option value="1">India</option>
                                                    </select>
                                                    <div class="has-error " id="err_input13" ><?php echo form_error("input13"); ?></div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                    <select class="form-control select2" data-width="100%" name="input14" Id="stateId" data-size="4" onchange ="fetchCity(this.value)" >
                                                        <option value="">Select State</option>
                                                       <?php foreach($allStates as $key=>$val) {?>
                                                        <option value="<?php echo $val->state_id;?>"><?php echo $val->state_statename;?></option>
                                                         <?php }?>
                                                    </select>
                                                    <div class="has-error " id="err_input14" ><?php echo form_error("input14"); ?></div>
                                                </div>
                                            </aside>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0 m-t-xs-10">
                                        <div class="col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4">
                                            <aside class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <select name="input15" id="cityId" data-size="4" class="form-control select2" data-width="100%" >
                                                    </select>
                                                    <div class="has-error " id="err_input15" ><?php echo form_error("input15"); ?></div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                    <input type="text" class="form-control" id="zip" name="input16" placeholder="ZIP" />
                                                    <div class="has-error " id="err_input16" ><?php echo form_error("input16"); ?></div>
                                                </div>
                                            </aside>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0 m-t-xs-10">
                                        <div class="col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4">
                                            <input type="text" class="form-control" id="address" name="input17" placeholder="Address" />
                                            <div class="has-error " id="err_input17" ><?php echo form_error("input17"); ?></div>
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
                                            <select class="form-control select2" name="input25" id="input25" data-width="100%" >
                                                <option value="" >Select Member</option>
                                            </select>
                                            <div class="has-error " id="err_input22" ><?php echo form_error("input25"); ?></div>
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
                                            <input type="text" class="form-control" id="input18" name="input18" placeholder="Price" onblur="calculateamount()" />
                                            <div class="has-error " id="err_input18" ><?php echo form_error("input18"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Other Fee:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="text" class="form-control" id="input19" name="input19" placeholder=""  onblur="calculateamount()" />
                                            <div class="has-error " id="err_input19" ><?php echo form_error("input19"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Tax :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="text" class="form-control" name="input20" id="input20" placeholder="%"  onblur="calculateamount()">
                                            <div class="has-error " id="err_input20" ><?php echo form_error("input20"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Total Payable Amount:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="text" class="form-control" id="input21" name="input21" placeholder="Total"  readonly=""/>
                                            <div class="has-error " id="err_input21" ><?php echo form_error("input21"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Payment Status :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select class="selectpicker" name="input22" id="input22" data-width="100%" >
                                                <option value="16" >Paid</option>
                                                <option value="15" >Unpaid</option>
                                            </select>
                                            <div class="has-error " id="err_input22" ><?php echo form_error("input22"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Payment Mode:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <select type="text" class="selectpicker" id="input23" name="input23" data-width="100%" >
                                                <option value="17" >Cash</option>
                                            </select>
                                            <div class="has-error " id="err_input23" ><?php echo form_error("input23"); ?></div>
                                        </div>
                                    </article>
                                </aside>
                                <!-- Payment Section End -->
                            </div>
                        </section>
                        <section class="clearfix ">
                            <div class="col-md-12 m-t-20 m-b-20">
                                <input class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit" value="Submit">
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