<!-- Start right Content here -->
<?php //dump($this->miData); exit(); ?>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container row">
            <!-- consultation -->
            <div style="display:show;" id="consultDiv">
                <div class="clearfix">
                    <div class="col-md-12">
                        <h3 class="pull-left page-title">Send a Quote</h3>
                    </div>
                </div>
                <div class="success"><?php //echo $this->session->flashdata('message'); ?></div>
                <form class="cmxform form-horizontal tasi-form" id="QuotationForm" method="post" action="<?php echo site_url(); ?>/quotation/sendQuotationSave/<?php echo $quotationId; ?>" novalidate="novalidate">
                    <!-- Left Section Start -->
                    <section class="col-md-6 detailbox">
                        <div class="bg-white mi-form-section p-b-20">
                            <figure class="clearfix">
                                <h3>Quotation Detail</h3>
                            </figure>
                            <!-- Table Section End -->
                            <div class="clearfix m-t-20">
                                <article class="clearfix m-t-10">
                                    <label class="control-label col-md-4 col-sm-4">Select City :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <?php  if($this->miData){ ?>
                                        <input type="hidden" name="city_id" id="appointment_city" value="<?php echo $this->miData->cityId; ?>" />
                                        <label><?php echo $this->miData->city_name; ?></label>
                                        <?php }else { ?>
                                        <select class="form-control select2" data-width="100%" name="city_id" onchange="getMI()" id="appointment_city">
                                            <option value="">Select City</option>
                                            <?php if (isset($qyura_city) && $qyura_city != NULL) {
                                                foreach ($qyura_city as $city) { ?>
                                                    <option <?php echo set_select('city_id', $city->city_id); ?> value="<?php echo $city->city_id; ?>"><?php echo $city->city_name; ?></option>
                                                    <?php } } ?>
                                        </select>
                                        <?php } ?>
                                        
                                        
                                        
                                        <div class="has-error " id="err_city_id" ><?php echo form_error("city_id"); ?></div>
                                    </div>
                                </article>
                                <article class="clearfix m-t-10">
                                    <label class="control-label col-md-4 col-sm-4">MI Type :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <?php  if($this->miData){ ?>
                                        <input type="hidden" name="miType" id="centerType" value="<?php echo $this->miData->miOptLabel; ?>" />
                                        <label><?php echo $this->miData->label; ?></label>
                                        <?php }else { ?>
                                        
                                        <select class="form-control select2" data-width="100%" name="miType" onchange="getMI();" id="centerType">
                                            <option <?php echo set_select('miType', '', true); ?> value="">Select Type</option>
                                            <option <?php echo set_select('miType', 0); ?> value="0">Hospitals</option>
                                            <option <?php echo set_select('miType', 1); ?> value="1">Diagnostic Center</option>
                                        </select>
                                         <?php } ?>
                                        <div class="has-error " id="err_miType" ><?php echo form_error("miType"); ?></div>
                                    </div>
                                </article>
                                <article class="clearfix m-t-10 ">
                                    <label class="control-label col-md-4 col-sm-4">MI Name :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <?php  if($this->miData){ ?>
                                        <input type="hidden" name="miId" id="mi_centre" value="<?php echo $this->miData->miId.','.$this->miData->users_id; ?>" />
                                        <label><?php echo $this->miData->miName; ?></label>
                                        <?php }else { ?>
                                        <select class="form-control select2" data-width="100%" id="mi_centre" name="miId" onchange="changeForm();" >
                                            <option value="">Select Hospital/Diagnostic</option>
                                        </select>
                                        <?php } ?>
                                        <div class="has-error " id="err_miId" ><?php echo form_error("miId"); ?></div>
                                    </div>
                                </article>
                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Date :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <div class="input-group">
                                            <input class="form-control pickDate" value="<?php echo set_value('quotationDate'); ?>" placeholder="dd/mm/yyyy" id="date-3" type="text" onkeydown="return false;" name="quotationDate">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            <div class="has-error " id="err_quotationDate" ><?php echo form_error("quotationDate"); ?></div>
                                        </div>
                                    </div>
                                </article>
                                <article class="clearfix m-t-10">
                                    <label for="" class="control-label col-md-4 col-sm-4">Final Timing :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <div class="bootstrap-timepicker input-group w-full">
                                            <input id="timepicker5" type="text" class="form-control timepicker" name="quotationTime" value="<?php echo date("g:i A"); ?>"/>
                                            <div class="has-error " id="err_quotationTime" ><?php echo form_error("quotationTime"); ?></div>
                                        </div>
                                    </div>
                                </article>
                                <div id="diagnosticSectionTest">
                                    <div id="diagnosticClon_1">
                                        <article class="clearfix m-t-10">
                                            <label for="cname" class="control-label col-md-4 col-sm-4 cl-black">Test-1 :</label>
                                            <input type="hidden" id="total_test" name="total_test" value="1">
                                        </article>
                                        <article class="clearfix m-t-10">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Diagnostic Type :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <select class="form-control selectpicker" data-width="100%" name="input28_1" id="input28_1" >
                                                    <option value="">Select Hospital/Diagnostic Category</option>
                                                </select>
                                                <div class="has-error " id="err_input28_1" ><?php echo form_error("input28_1"); ?></div>
                                            </div>
                                        </article>
                                        <article class="clearfix m-t-10">
                                            <label for="cname" class="control-label col-md-4 col-sm-4">Test Name :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input type="text" class="form-control" name="input29_1" id="input29_1" >
                                                <div class="has-error " id="err_input29_1" ><?php echo form_error("input29_1"); ?></div>
                                            </div>
                                        </article>
                                        <article class="clearfix m-t-10">
                                            <label for="" class="control-label col-md-4 col-sm-4">Price :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <input class="form-control testPrice" type="text" id="input30_1" name="input30_1" onkeypress="return isNumberKey(event)" onblur="totaAmountAddQuo();">
                                                <div class="has-error " id="err_input30_1" ><?php echo form_error("input30_1"); ?></div>
                                            </div>
                                        </article>
                                        <article class="clearfix m-t-10">
                                            <label for="" class="control-label col-md-4 col-sm-4">Instruction :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <textarea class="form-control" id="input31_1" name="input31_1"></textarea>
                                                <div class="has-error " id="err_input31_1" ><?php echo form_error("input31_1"); ?></div>
                                            </div>
                                        </article>
                                    </div>    
                                    <article class="clearfix m-t-10">
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
                            <!-- Patient Detail Start -->
                            <figure class="clearfix">
                                <h3>Patient Detail :</h3>
                            </figure>

                            <aside class="clearfix m-t-20">
                                <article class="form-group m-lr-0 m-rl-o">
                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Patient Email Id :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input type="hidden" class="form-control" value="<?php echo set_value('user_id'); ?>" name="user_id" id="user_id" >
                                        <input type="hidden" class="form-control" name="email_status" id="email_status" value="<?php echo set_value('email_status'); ?>">
                                        <input class="form-control" id="patient_email" name="patient_email" type="email"  aria-required="true" value="<?php echo set_value('patient_email'); ?>" onblur="getpatientdetails()">
                                        <div class="has-error " id="err_patient_email" ><?php echo form_error("patient_email"); ?></div>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Patient Mobile Number :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" id="users_mobile" name="users_mobile" type="text"  aria-required="true" maxlength="10" min="10" value="<?php echo set_value('users_mobile'); ?>" onkeypress="return isNumberKey(event)">
                                        <div class="has-error " id="err_users_mobile" ><?php echo form_error("users_mobile"); ?></div>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">DOB :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <div class="input-group">
                                            <input class="form-control pickDate" placeholder="dd/mm/yy" id="date-4" type="text"  name="input26" />
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            <div class="has-error " id="err_input4" ><?php echo form_error("input26"); ?></div>
                                        </div>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Gender :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <select class="form-control selectpicker" name="input27" id="input27" data-width="100%" >
                                            <option value="" >Select Gender</option>
                                            <option value="1" >Male</option>
                                            <option value="2" >Female</option>
                                            <option value="3" >Other</option>
                                        </select>
                                        <div class="has-error " id="err_input27" ><?php echo form_error("input27"); ?></div>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0" id="p_unqId" style="display: none">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Patient Id:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" value="<?php echo set_value('patientunqId'); ?>" id="unqId" name="patientunqId" type="text" aria-required="true" readonly="">
                                        <div class="has-error " id="err_patientunqId" ><?php echo form_error("patientunqId"); ?></div>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Patient Name:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" id="users_username" value="<?php echo set_value('users_username'); ?>" name="users_username" type="text"  aria-required="true" >
                                        <div class="has-error " id="err_users_username" ><?php echo form_error("users_username"); ?></div>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Address:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <aside class="row">
                                            <div class="col-md-6 col-sm-6">
                                                <select class="form-control selectpicker" id="countryId" name="countryId" data-size="4" data-width="100%" >
                                                    <option value="1">India</option>
                                                </select>
                                                <div class="has-error " id="err_countryId" ><?php echo form_error("countryId"); ?></div>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <select class="form-control selectpicker" data-width="100%" name="userStateId" Id="stateId" data-size="4" onchange ="fetchCity(this.value)" >
                                                    <option value="">Select State</option>
        <?php foreach ($allStates as $key => $val) { ?>
                                                        <option <?php set_select('userStateId', $val->state_id); ?> value="<?php echo $val->state_id; ?>"><?php echo $val->state_statename; ?></option>
        <?php } ?>
                                                </select>
                                                <div class="has-error " id="err_userStateId" ><?php echo form_error("userStateId"); ?> </div>
                                            </div>
                                        </aside>
                                    </div>
                                </article>

                                <article class="form-group m-lr-0 m-t-xs-10">
                                    <div class="col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4">
                                        <aside class="row">
                                            <div class="col-md-6 col-sm-6">
                                                <select name="userCityId" id="cityId" data-size="4" class="form-control selectpicker" data-width="100%" >
                                                    <option value="">Select City</option>
                                                    <?php if (isset($cityData) && $cityData != NULL) {
                                                        foreach ($cityData as $key => $val) { ?>
                                                        <option <?php set_select('userCityId', $val->city_id); ?> value="<?php echo $val->city_id; ?>"><?php echo $val->city_name; ?></option>
                                                    <?php } } ?>
                                                </select>
                                                <div class="has-error " id="err_userCityId" ><?php echo form_error("userCityId"); ?></div>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <input type="text" class="form-control" id="zip" name="zip" value="<?php echo set_value('zip'); ?>" onkeypress="return isNumberKey(event)" placeholder="ZIP"/>
                                                <div class="has-error " id="err_zip" ><?php echo form_error("zip"); ?></div>
                                            </div>
                                        </aside>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0 m-t-xs-10">
                                    <div class="col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4">
                                        <input type="text" value="<?php echo set_value('address'); ?>" class="form-control" id="address" name="address" placeholder="Address"/>
                                        <div class="has-error "  id="err_address" ><?php echo form_error("address"); ?></div>
                                    </div>
                                </article>

                                <article class="form-group m-lr-0" id="familyDiv" style="display: none">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">For Your Family Member</label>
                                    <div class="col-md-8 col-sm-8">
                                        <div class="radio radio-success radio-inline">
                                            <input type="radio" <?php echo set_radio('family_member', 1); ?> name="family_member" value="1" id="inlineRadio1" onclick="getMember('1')" >
                                            <label for="inlineRadio1">Yes</label>
                                        </div>
                                        <div class="radio radio-success radio-inline">
                                            <input type="radio" <?php echo set_radio('family_member', 0); ?> name="family_member" value="0" id="inlineRadio2" checked="" onclick="getMember('0')" >
                                            <label for="inlineRadio2">No</label>
                                        </div>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0" id="familyListDiv" style="display: none">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Members :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <select class="select2" name="familyId" id="input33" data-width="100%" >
                                            <option value="" >Select Member</option>
                                        </select>
                                        <div class="has-error " id="err_input33" ><?php echo form_error("familyId"); ?></div>
                                    </div>
                                </article>
                                <!-- Payment Section Start -->
                                <figure class="clearfix">
                                    <h3>Payment Details</h3>
                                </figure>
                                <aside class="clearfix m-t-20">
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Total Test Fee:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="text" class="form-control" id="input22" name="consulationFee" onblur="totaAmountAddQuo()" onkeypress="return isNumberKey(event)" readonly=""/>
                                            <div class="has-error " id="err_consulationFee" ><?php echo form_error("consulationFee"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Other Fee:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="text" class="form-control" id="input23" name="otherFee" onkeypress="return isNumberKey(event)" onblur="totaAmountAddQuo()"/>
                                            <div class="has-error " id="err_otherFee" ><?php echo form_error("otherFee"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Tax :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="text" class="form-control" name="tax" id="input24" onblur="totaAmountAddQuo()" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                            <input type="hidden" class="form-control" name="paidamt" id="paidamt" />
                                            <div class="has-error " id="err_tax" ><?php echo form_error("tax"); ?></div>
                                        </div>
                                    </article>
                                </aside>
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Payment Status :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <select class="selectpicker" name="pay_status" id="pay_status" data-width="100%" >
                                            <option value="1" >Paid</option>
                                            <option value="0" >Unpaid</option>
                                        </select>
                                        <div class="has-error " id="err_pay_status" ><?php echo form_error("pay_status"); ?></div>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Payment Mode:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <select type="text" class="selectpicker" id="pay_mode" name="pay_mode" data-width="100%" >
                                            <option value="1" >Cash</option>
                                        </select>
                                        <div class="has-error " id="err_input27" ><?php echo form_error("pay_mode"); ?></div>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4 cl-black">Total Quotation Price :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <label for="cname" class="control-label col-md-4 cl-black"><i class="fa fa-inr fa-2x"></i> <span id="paidAmount">00</span>/-</label>
                                    </div>
                                </article>
                            </aside>
                            <!-- Patient Detail Section End -->
                        </div>
                    </section>
                    <section class="clearfix ">
                        <div class="col-md-12 m-t-20 m-b-20">
                            <button class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit" id="submitQuotation">Submit</button>
                        </div>
                    </section>
                </form>
            </div>
            <!-- consultation -->
            <!-- Right Section End -->
        </div>
        <!-- container -->
    </div>
    <!-- content -->
</div>
<!-- End Right content here -->
</div>
<!-- END wrapper --
