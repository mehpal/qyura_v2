<!-- Start right Content here -->
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
                <div class="success"><?php echo $this->session->flashdata('message'); ?></div>
                <form class="cmxform form-horizontal tasi-form" id="QuotationForm" method="post" action="<?php echo site_url(); ?>/quotation/replyQuotationSave/<?php echo $quotationId; ?>" novalidate="novalidate">
                    <!--                         <form class="cmxform form-horizontal tasi-form" id="QuotationForm" method="post" action="#" novalidate="novalidate">-->

                    <!-- Left Section Start -->
                    <section class="col-md-6 detailbox">
                        <div class="bg-white mi-form-section p-b-20">
                            <figure class="clearfix">
                                <h3>Quotation Detail</h3>
                            </figure>
                            <!-- Table Section End -->
                            <div class="clearfix m-t-20">
                                <input type="hidden" name="quotationId" id="quotationId" value="<?php echo $quotationId; ?>" />
                                <article class="clearfix m-t-10">
                                    <label class="control-label col-md-4 col-sm-4">Select City :</label>
                                    <div class="col-md-8 col-sm-8">
<!--                                                <select class="form-control selectpicker" data-width="100%" name="city_id" onchange="getMI()" id="appointment_city">
                                              <option name="city_id" value="">Select City</option>
                                        <?php if (isset($qyura_city) && $qyura_city != NULL) {
                                            foreach ($qyura_city as $city) {
                                                ?>
                                                    <option <?php echo set_select('city_id', $city->city_id); ?> value="<?php echo $city->city_id; ?>"><?php echo $city->city_name; ?></option>
    <?php }
} ?>
                                        </select>-->
                                        <label><?php echo $qtRow->city_name ?></label>
                                        <div class="has-error " id="err_input1" ><?php echo form_error("city_id"); ?></div>
                                    </div>
                                </article>

                                <article class="clearfix m-t-10">
                                    <label class="control-label col-md-4 col-sm-4">MI Type :</label>
                                    <div class="col-md-8 col-sm-8">
<!--                                                <select class="form-control selectpicker" data-width="100%" name="miType" onchange="getMI();" id="centerType">
                                           <option <?php echo set_select('miType', '', true); ?> value="">Select Type</option>
                                           <option <?php echo set_select('miType', 0); ?> value="0">Hospitals</option>
                                           <option <?php echo set_select('miType', 1); ?> value="1">Diagnostic Center</option>
                                        </select>-->
                                        <label><?php echo $qtRow->miType ?></label>
                                        <div class="has-error " id="err_input5" ><?php echo form_error("miType"); ?></div>
                                    </div>
                                </article>

                                <article class="clearfix m-t-10 ">
                                    <label class="control-label col-md-4 col-sm-4">MI Name :</label>
                                    <div class="col-md-8 col-sm-8">
<!--                                            <select class="form-control selectpicker" data-width="100%" id="mi_centre" name="miId" onchange="getMIDoctorList();changeForm();getTimeSlot();" >
                                        <option value="">Select Hospital/Diagnostic</option>
                                    </select>-->
                                        <?php  ?>
                                        <input type="hidden" id="mi_centre_1" value="<?php echo $qtRow->miPfId.','.$qtRow->quotation_MiId; ?>" >
                                        <?php
                                        $mitytype = 1;
                                        if($qtRow->miType == 'diagnostic')
                                            $mitytype = 1;
                                        else
                                            $mitytype = 0;
                                        
                                        ?>
                                        <input type="hidden" id="centerType_1" value="<?php echo $mitytype; ?>" />
                                        <label><?php echo $qtRow->miName ?></label>
                                        <div class="has-error " id="err_input5" ><?php echo form_error("miId"); ?></div>
                                    </div>
                                </article>

<!--                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Time Slot :</label>
                                    <div class="col-md-8 col-sm-8">
                                                <select class="selectpicker" name="timeslot" id="timeSlot" data-width="100%" >
                                           <option value="">Select Time Slot</option>
                                        </select>
                                        <label><?php
                                            
                                            if (isset($qtRow->timeSlot)) {
                                                $timeSlot = explode('-', $qtRow->timeSlot);
                                                if (is_array($timeSlot) && count($timeSlot) == 3) {
                                                    switch ($timeSlot[2]) {
                                                        case 0:
                                                            $session = "Morning";
                                                            break;
                                                        case 1:
                                                            $session = "Afternoon";
                                                            break;
                                                        case 2:
                                                            $session = "Evening";
                                                            break;
                                                        case 3:
                                                            $session = "Night";
                                                            break;
                                                        default:
                                                            $session = "Session is not aloated";
                                                    }
                                                    echo $session . " | " . $timeSlot[0] . " - " . $timeSlot[1];
                                                }
                                            }
                                            ?></label>

                                        <div class="has-error " id="err_input4" ><?php echo form_error("timeslot"); ?></div>
                                    </div>
                                </article>-->
                                            
                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Time Slot :</label>
                                    <div class="col-md-8 col-sm-8">
                                        
                                        <select class="selectpicker" name="timeslot" id="timeslot" data-width="100%" >
                                            <option value="">Select Time Slot </option>
                                            <?php if($mITimeSloat){
                                                
                                                
                                                foreach ($mITimeSloat as $sloat){
                                                    
                                                ?>
                                            <option <?php echo $qtRow->quotation_timeSlotId == $sloat->id ?'selected':'';  ?> value="<?php echo $sloat->id; ?>"><?php echo getDoctorAvailibilitySession($sloat->sessionType); ?>|<?php echo date('h:i A',  strtotime($sloat->startTime)) ; ?>-<?php echo date('h:i A',strtotime($sloat->endTime)) ; ?></option>
                                                <?php
                                                }
                                            } ?>
                                        </select>
                                        <div class="has-error " id="err_input4" ><?php echo form_error("timeslot"); ?></div>
                                    </div>
                                </article>

                                
                                            
                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Ref. Doctor :</label>
                                    <div class="col-md-8 col-sm-8">

<?php 
echo form_radio(array('name' => 'existsDr', 'value' => '1', 'checked' => ($qtRow->quotation_docRefeId) ? TRUE : FALSE, 'id' => 'drExistsList', 'onclick' => 'showExistsBox(this.value)'));
?> Available Dr.<?php echo form_radio(array('name' => 'existsDr', 'value' => '2', 'checked' => ($qtRow->quotation_docRefeId == 0) ? TRUE : FALSE, 'onclick' => 'showExistsBox(this.value)','id'=>'drNameInput')); ?>
                                        Not Available Dr.
                                        
                                    </div>
                                </article>

                                
                                <article class="clearfix m-t-10 drList"  style="display: <?php echo ($qtRow->quotation_docRefeId == 0) ? 'none' : 'block' ?>">
                                    <div class="col-md-8 col-sm-8 col-md-offset-4">
                                        <select class="form-control selectpicker" data-width="100%" name="refDoctor" id="refDoctor" required="">
                                            <option value="">Select Dr.</option>
                                            <?php
                                            if ($mIDrs) {

                                                foreach ($mIDrs as $mIDr) {
                                                    ?>
                                                    <option <?php echo $qtRow->quotation_docRefeId == $mIDr->userId ? 'selected' : ''; ?> value="<?php echo $mIDr->userId; ?>"><?php echo $mIDr->name; ?></option>
        <?php
    }
}
?>
                                        </select>

                                        <label class="error" > <?php echo form_error("docRefeId"); ?></label>

                                    </div>
                                </article>            
                                            

                                <article class="clearfix m-t-10 drText" style="display: <?php echo ($qtRow->quotation_docRefeId == 0) ? 'block' : 'none' ?>">
                                    <div class="col-md-8 col-sm-8 col-md-offset-4">
                                        <input value="<?php echo $qtRow->quotation_docName; ?>"  class="form-control" id="drName" type="text"  name="drName" placeholder="Dr Name">
                                    </div>
                                </article>

                                <!--                                    <article class="clearfix m-t-10">
                                                                        <label for="cname" class="control-label col-md-4 col-sm-4">Quotation Type :</label>
                                                                        <div class="col-md-8 col-sm-8">
                                                                            <select class="selectpicker" data-width="100%" onchange="changeForm()" id="input5" name="quotationType" >
                                                                                <option value="">Select Type</option>
                                                                                <option value="1">Diagnostic</option>
                                                                            </select>
                                                                            <div class="has-error " id="err_input5" ><?php //echo form_error("quotationType");  ?></div>
                                                                            
                                                                        </div>
                                                                    </article>-->



                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Date :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <div class="input-group">
                                            <?php $date = isset($qtRow->quotation_dateTime) && $qtRow->quotation_dateTime != null ?date('d/m/Y',$qtRow->quotation_dateTime):''; ?>
                                            <input class="form-control" value="<?php echo $date; ?>" placeholder="dd/mm/yyyy" id="preferedDate" type="text" onkeydown="return false;" name="preferedDate">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            <div class="has-error " id="err_input5" ><?php echo form_error("preferedDate"); ?></div>
                                        </div>
                                    </div>
                                </article>


                                <article class="clearfix m-t-10">
                                    <label for="" class="control-label col-md-4 col-sm-4">Final Timing :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <div class="bootstrap-timepicker input-group w-full">
                                            <input id="timepicker5" value="<?php echo set_value('quotationTime'); ?>" type="text" class="form-control timepicker" name="quotationTime"/>
                                            <div class="has-error " id="err_input5" ><?php echo form_error("quotationTime"); ?></div>
                                        </div>
                                    </div>
                                </article>

                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Appointment Status :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <select class="form-control selectpicker" name="bookStatus" id="input8" data-width="100%" >
                                            <option <?php echo set_select('bookStatus', '', true); ?> value="" >Select Status</option>
                                            <option <?php echo set_select('bookStatus', '1'); ?> value="1" >Pending</option>
                                            <option <?php echo set_select('bookStatus', '2'); ?> value="2" >Confirm</option>
                                            <option <?php echo set_select('bookStatus', '3'); ?> value="3" >Cancel</option>
                                            <option <?php echo set_select('bookStatus', '4'); ?> value="4" >Completed</option>
                                        </select>
                                        <div class="has-error " id="err_input8" ><?php echo form_error("input8"); ?></div>
                                    </div>
                                </article>

                                <!-- doctor section start -->
                                <!--                                <div id="doctorSection" style="display: none">
                                                                doctor   spe
                                                                    <article class="clearfix m-t-10">
                                                                        <label for="cname" class="control-label col-md-4 col-sm-4">Specialities :</label>
                                                                        <div class="col-md-8 col-sm-8">
                                                                            <select class="selectpicker" name="speciality" id="speciallity" data-width="100%" onchange="findDoctor()">
                                                                            <option value="">Select Speciality</option>
                                                                           
                                                                            </select>
                                                                            <div class="has-error " id="err_input10" ><?php //echo form_error("speciality");  ?></div>
                                                                        </div>
                                                                    </article>
                                doctor list
                                                                    <article class="clearfix m-t-10">
                                                                        <label for="cname" class="control-label col-md-4 col-sm-4">Assign Doctor :</label>
                                                                        <div class="col-md-8 col-sm-8">
                                                                            <select class="selectpicker" name="doctorId" id="doctorId" data-width="100%">
                                                                                <option value="">Select Doctor</option>
                                                                            </select>
                                                                            <div class="has-error " id="err_input12" ><?php //echo form_error("doctorId");  ?></div>
                                                                        </div>
                                                                    </article>
                                 doctor Session  
                                  doctor Patient Remarks                                     
                                                                    <article class="clearfix m-t-10">
                                                                        <label for="" class="control-label col-md-4 col-sm-4">Patient Remarks :</label>
                                                                        <div class="col-md-8 col-sm-8">
                                                                            <textarea class="form-control" id="patientRemark" name="input13"  aria-required="true"></textarea>
                                                                            <div class="has-error " id="err_input13" ><?php //echo form_error("input13");  ?></div>
                                                                        </div>
                                                                    </article>
                                                                </div>-->
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
                                                    <option value="">Select Diagnostic Category</option>
                                                    <?php foreach ($dignosticCat as $key => $val) { ?>
                                                <option <?php set_select('input28_1', $qtRow->quotation_diagnosticsCatId); ?> value="<?php echo $val->catid; ?>"><?php echo $val->catName; ?></option>
                                                    <?php } ?>
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
                                                <input class="form-control testPrice" onkeyup="calculateTestPrice()" type="number" id="input30_1" name="input30_1" placeholder="770" onkeypress="return isNumberKey(event)" >
                                                <div class="has-error " id="err_input30_1" ><?php echo form_error("input30_1"); ?></div>
                                            </div>
                                        </article>

                                        <article class="clearfix m-t-10">
                                            <label for="" class="control-label col-md-4 col-sm-4">Instruction :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <textarea class="form-control" id="input31_1" name="input31_1" placeholder="" ></textarea>
                                                <div class="has-error " id="err_input31_1" ><?php echo form_error("input31_1"); ?></div>
                                            </div>
                                        </article>
                                    </div>    
                                    <article class="clearfix m-t-10">

                                        <div class="col-md-5 col-sm-5  col-md-offset-4 col-sm-offset-4">
                                            <button type="button" href="javascript:void(0)" class="btn btn-success btn-block waves-effect waves-light" onclick="addMoreTestReply()" >Add More Test </button>
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
<!--                                        <input type="hidden" class="form-control" value="<?php echo set_value('user_id'); ?>" name="user_id" id="user_id" >-->
                                        <input class="form-control" id="patient_email" name="patient_email" type="email"  aria-required="true" value="<?php echo $qtRow->users_email; ?>" disabled="" placeholder="Test@gmail.com" >
                                        <div class="has-error " id="err_input14" ><?php echo form_error("patient_email"); ?></div>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Patient Mobile Number :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" id="users_mobile" name="users_mobile" type="text"  aria-required="true" placeholder="Mobile Number"  disabled="" value="<?php echo $qtRow->users_mobile; ?>" onkeypress="return isNumberKey(event)">
                                        <div class="has-error " id="err_input15" ><?php echo form_error("users_mobile"); ?></div>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0" id="p_unqId" style="display: none">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Patient Id:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" disabled="disabled" value="<?php echo $qtRow->users_mobile; ?>"  id="unqId" name="patientunqId" type="text" aria-required="true" placeholder="Patient Id" readonly="">
                                        <div class="has-error " id="err_input16" ><?php echo form_error("patientunqId"); ?></div>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Patient Name:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" id="users_username" disabled="" value="<?php echo $qtRow->patientDetails_unqId; ?>" name="users_username" type="text"  aria-required="true" placeholder="Name" >
                                        <div class="has-error " id="err_input17" ><?php echo form_error("users_username"); ?></div>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Address:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <select class="form-control selectpicker" id="countryId" name="countryId" data-size="4" data-width="100%" >
                                            <option value="1">India</option>
                                        </select>
                                        <div class="has-error " id="err_input18" ><?php echo form_error("countryId"); ?></div>
                                    </div>
                                </article>

                                <article class="form-group m-lr-0">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <select class="form-control selectpicker" disabled="" data-width="100%" name="userStateId" Id="stateId" data-size="4" onchange ="fetchCity(this.value)" >
                                            <option value="">Select State</option>
                                            <?php foreach ($allStates as $key => $val) { ?>
                                                <option <?php set_select('userStateId', $qtRow->patientDetails_stateId); ?> value="<?php echo $val->state_id; ?>"><?php echo $val->state_statename; ?></option>
<?php } ?>
                                        </select>
                                        <div class="has-error " id="err_input19" ><?php echo form_error("userStateId"); ?> </div>

                                    </div>
                                </article>


                                <article class="form-group m-lr-0 m-t-xs-10">
                                    <div class="col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4">
                                        <select disabled="" name="userCityId" id="cityId" data-size="4" class="form-control selectpicker" data-width="100%" >
                                            <option value="">Select City</option>
                                            <?php if (isset($cityData) && $cityData != NULL) {
                                                foreach ($cityData as $key => $val) { ?>
                                                    <option <?php set_select('userCityId', $val->city_id); ?> value="<?php echo $val->city_id; ?>"><?php echo $val->city_name; ?></option>
    <?php }
} ?>

                                        </select>
                                        <div class="has-error " id="err_input32" ><?php echo form_error("userCityId"); ?></div>
                                    </div>
                                </article>

                                <article class="form-group m-lr-0 m-t-xs-10">
                                    <div class="col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4">
                                        <input type="text" disabled="" class="form-control" id="zip" name="zip" placeholder="700001" value="<?php echo $qtRow->patientDetails_pin; ?>" onkeypress="return isNumberKey(event)"/>
                                        <div class="has-error " id="err_input20" ><?php echo form_error("zip"); ?></div>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0 m-t-xs-10">
                                    <div class="col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4">
                                        <input type="text" disabled="" value="<?php echo $qtRow->patientDetails_address; ?>" class="form-control" id="address" name="address" placeholder="209, ABC Road, near XYZ Building "  />
                                        <div class="has-error "  id="err_input21" ><?php echo form_error("address"); ?></div>
                                    </div>
                                </article>

                                <article class="form-group m-lr-0" id="familyDiv" style="display: none">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">For Your Family Member</label>
                                    <div class="col-md-8 col-sm-8">
                                        <div class="radio radio-success radio-inline">
                                            <input disabled="" type="radio" <?php echo set_radio('family_member', 1); ?> name="family_member" value="1" id="inlineRadio1" onclick="getMember('1')" >
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
<!--                                        <select class="selectpicker" name="familyId" id="input33" data-width="100%" >
                                            <option value="" >Select Member</option>
                                        </select>-->
                                        <label><?php echo $qtRow->userName; ?></label>
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
                                            <input type="text" class="form-control" id="input22" name="consulationFee" placeholder="500" onblur="calculateTestPrice()" onkeypress="return isNumberKey(event)"/>
                                            <div class="has-error " id="err_input22" ><?php echo form_error("consulationFee"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Other Fee:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="number" class="form-control" id="input23" name="otherFee" placeholder="0"   onkeypress="return isNumberKey(event)" value="0"  onblur="calculateamount()" />
                                            <div class="has-error " id="err_input23" ><?php echo form_error("otherFee"); ?></div>
                                        </div>
                                    </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Tax :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="number" class="form-control" name="tax" id="input24" placeholder="12%"  onblur="calculateamount()" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                            <input type="hidden" class="form-control" name="paidamt" id="paidamt" />
                                            <div class="has-error " id="err_input24" ><?php echo form_error("tax"); ?></div>
                                        </div>
                                    </article>

                                </aside>
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
                            <button class="btn btn-danger waves-effect pull-right" type="reset">Reset</button>
                            <button class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit" onclick="calculateamount()" id="submitQuotation">Submit</button>
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
