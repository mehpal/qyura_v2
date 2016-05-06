<form  class="cmxform form-horizontal tasi-form avatar-form" id="timeEditForm" name="addDoctorSlot" method="post" action="#" novalidate="novalidate">
    <article class="clearfix m-t-10">
        <label class="control-label" for="docTimeTable_stayAt">Seating Place Type:</label>
        <div class="">

            <input type="hidden" name="doctorId" id="" value="<?php echo $timeData->doctorId; ?>" />
            <input type="hidden" name="docTimeTableId" id="docTimeTableId" value="<?php echo $timeData->docTimeTableId; ?>" />
            <input type="hidden" name="MIprofileId" id="MIprofileId" value="<?php echo $timeData->MIprofileId; ?>" />
            <input type="hidden" name="hidden" id="day"  value="<?php echo $timeData->day; ?>" />
            <input type="hidden" name="docTimeDayId" id="docTimeDayId"  value="<?php echo $timeData->docTimeDayId; ?>" />
            
            <aside class="radio radio-info radio-inline">
                <input type="radio" <?php echo isset($timeData->stayAt) && $timeData->stayAt == 1 ? 'checked':''; ?>  required="" name="docTimeTable_stayAt" value="1" class="docTimeTable_stayAt" onclick="placeDetail(this.value)" >
                <label for="inlineRadio1"> MI Place</label>
            </aside>
            <aside class="radio radio-info radio-inline">
                <input type="radio" <?php echo isset($timeData->stayAt) && $timeData->stayAt == 0 ? 'checked':''; ?> required="" name="docTimeTable_stayAt" value="0" class="docTimeTable_stayAt" onclick="placeDetail(this.value)" >
                <label for="inlineRadio2"> Personal Chamber</label>
            </aside>
            <span id="err_docTimeTable_stayAt" class="error"><?php echo form_error("psChamber_name"); ?></span>
        </div>
    </article>
    <article class="clearfix m-t-10" id="div_docTimeTable_MItype"  style="display: <?php echo isset($timeData->stayAt) && $timeData->stayAt == 1 ? 'block':'none'; ?> ">
        <label class="control-label" for="docTimeTable_MItype">MI Type:</label>
        <div class="">
            <select class="m-t-5 selectpicker" data-width="100%" name="docTimeTable_MItype" id="docTimeTable_MItype">
                <option value=""> -- Select MI Type -- </option>
                <option <?php echo isset($timeData->MItype) && $timeData->MItype == 1 ? 'selected':''; ?> value="1">Hospital</option>
                <option <?php echo isset($timeData->MItype) && $timeData->MItype == 2 ? 'selected':''; ?> value="2">Diagnostic</option>
            </select>
            <span id="err_docTimeTable_MItype" class="error"><?php echo form_error("docTimeTable_MItype"); ?></span>
        </div>

    </article>
    <?php ?>
    <article class="clearfix m-t-10" style="display: <?php echo togalpsChamber($timeData) ? togalHospital($timeData) ? 'block' : 'none' : 'none'; ?>"    id="div_docTimeTable_HprofileId">
        <label class="control-label" for="docTimeTable_MIprofileId_h">Hospital Name:</label>
        <div class=""> 
            <?php $hospitals[] = (object) array('hospital_id' => 0, 'hospital_name' => 'Other') ?>
            <select class="m-t-5 select2" data-width="100%" name="docTimeTable_MIprofileId_h" id="docTimeTable_MIprofileId_h" onchange="getMIdetail(this.value)" >
                <option value="">-- Select Hospital --</option>
                <?php
                if (!empty($hospitals)) {
                    
                    foreach ($hospitals as $key => $val) {
                        ?>
                        <?php $option = isset($_POST['docTimeTable_MIprofileId_h']) ? $val->hospital_id : isset($timeData->MIprofileId) ? $timeData->MIprofileId : ''; ?>
                        <option <?php echo $val->hospital_id == $timeData->MIprofileId ? 'selected' : ''; ?> <?php echo set_select('hospital_id', $val->hospital_id); ?> value="<?php echo $val->hospital_id; ?>"> <?php echo $val->hospital_name; ?></option>
                        <?php
                    }
                }
                ?>

            </select>

            <span id="err_docTimeTable_MIprofileId_h" class="error"><?php echo form_error("docTimeTable_MIprofileId_h"); ?></span>
        </div>
    </article>
    <article class="clearfix m-t-10" style="display: <?php echo togalpsChamber($timeData) ? togalDiagnostic($timeData) ? 'block' : 'none' : 'none'; ?>"" id="div_docTimeTable_DprofileId">
        <label class="control-label" for="docTimeTable_MIprofileId_d">Diagnostic Name:</label>
        <div class="">

            <?php $diagnostics[] = (object) array('diagnostic_id' => 0, 'diagnostic_name' => 'Other') ?>
            <select class="m-t-5 select2" data-width="100%" onchange="getMIdetail(this.value)" name="docTimeTable_MIprofileId_d" id="docTimeTable_MIprofileId_d">

                <option value="">-- Select Diagnostic --</option>
                <?php
                if (!empty($diagnostics)) {

                    foreach ($diagnostics as $key => $val) {
                        ?>
                
                        <option <?php echo $val->diagnostic_id == $timeData->MIprofileId ? 'selected' : ''; ?> <?php echo set_select('docTimeTable_MIprofileId_d', $val->diagnostic_id); ?>  value="<?php echo $val->diagnostic_id; ?>"> <?php echo $val->diagnostic_name; ?></option>
                        <?php
                    }
                }
                ?>
                ?>
                <option value="0">Other</option>
            </select>
            <span id="err_docTimeTable_MIprofileId_d" class="error"><?php echo form_error("docTimeTable_MIprofileId_d"); ?></span>
        </div>
    </article>
<!--    <article class="clearfix" style="display: <?php echo $timeData->stayAt == 0 ? 'block' : 'none' ?>" id="div_Mi_name">
        <label class="control-label" for="Mi_name">MI Name:</label>
        <div class="">
            <input type="text" name="Mi_name" id="Mi_name" class="form-control" placeholder="MI Name" value="<?php echo set_value('Mi_name'); ?>">
            <span id="err_Mi_name" class="error"><?php echo form_error("Mi_name"); ?></span>
        </div>
    </article>-->
    <article class="clearfix m-t-10" style="display: <?php echo $timeData->stayAt == 0 ? 'block' : 'none' ?>" id="div_psChamber_name">
        <label class="control-label" for="psChamber_name">Personal Chamber Name:</label>
        
        <div class="">
            
            <input type="text" name="psChamber_name" id="psChamber_name" class="form-control"  value="<?php echo $timeData->psChamberName; ?>">
            <span id="err_psChamber_name" class="error"><?php echo form_error("psChamber_name"); ?></span>
        </div>
    </article>
    <article>
        <aside class="row">
        </aside>
    </article>

    <article class="clearfix" id="div_address" >

        <div class="">
            <div id="Miname_div" style="display: none" style="display: block">
                <aside class="row clearfix  m-t-10">
                    <div class="col-md-12">

                        <label for="cname" class="control-label">MI Name:</label>
                        <input  type="text" value="" style="display:none;" placeholder="Mi Name" name="Miname" id="Miname" class="form-control" readonly="readonly">
                        <label class="error" style="display:none;" id="error-Miname"> </label>
                        <span id="err_Miname" class="error" > <?php echo form_error("Miname"); ?></span>
                    </div>

                </aside>
            </div>
            
            <aside class="row clearfix  m-t-10">
                
                <div class="col-md-6 col-sm-6">
                    <select  class="selectpicker" onchange="fetchStates()" data-width="100%" name="countryId" id="timeCountryId">
                        <option value="">Select Country</option>
                        <option selected value="1">India</option>
                    </select>
                </div>
                
                <div class="col-md-6 col-sm-6">
                    
                    <select  <?php echo $timeData->stayAt == 1 ? 'desabled="" readonly':'';  ?> class="selectpicker" data-width="100%" name="stateId" Id="stateId" data-size="4" onchange ="fetchCity(this.value)">
                        <option value="">Select State</option>
                        <?php foreach ($allStates as $key => $val) { 
                            
                            $stateId = isset($_POST['stateId']) ? $_POST['stateId'] : isset($timeData->stateId) && $timeData->stateId != '' ? $timeData->stateId :'';
                            ?>
                        <option <?php echo  $stateId == $val->state_id ?'selected':''; echo set_select('stateId',$stateId); ?> value="<?php echo $val->state_id; ?>"><?php echo $val->state_statename; ?></option>
                        <?php } ?>
                    </select>
                    <label class="error" style="display:none;" id="error-stateId"> please select a state</label>
                    <span id="err_stateId" class="error"><?php echo form_error("stateId"); ?></span>
                </div>
                
            </aside>
            
            <aside class="row clearfix  m-t-10">
                
                <div class="col-md-6 col-sm-6">
                    <select <?php echo $timeData->stayAt == 1 ? 'desabled="" readonly':'';  ?> class="selectpicker" data-width="100%" name="cityId" id="timeCityId" data-size="4" >
                        <option  value="<?php echo isset($cityInfo->city_id)? $cityInfo->city_id : '' ; ?>"><?php echo isset($cityInfo->city_name)? $cityInfo->city_name :'' ; ?></option>
                    </select>
                    <span id="err_cityId" class="error" > <?php echo form_error("cityId"); ?></span>
                </div>
                
                <div class="col-md-6 col-sm-6">
                    <input <?php echo $timeData->stayAt == 1 ? 'desabled="" readonly':'';  ?> type="text" class="form-control" id="pinn" name="pinn" placeholder="Pin Code" maxlength="6" onkeypress="return isNumberKey(event)" value="<?php echo isset($_POST['pinn'])?set_value('pinn'):isset($timeData->zip)?$timeData->zip:''; ?>" />
                    <label class="error" style="display:none;" id="error-pinn"> Zip code should be numeric and 6 digit long</label>
                    <span id="err_pinn" class="error" > <?php echo form_error("pinn"); ?></span>
                </div>

            </aside>
            
            <aside class="row  clearfix  m-t-10">
                
                <div class="col-md-12">
                    
                    <input <?php echo $timeData->stayAt == 1 ? 'desabled="" readonly':'';  ?> type="text" class="form-control" id="addr" name="addr" placeholder="Address" value="<?php echo isset($_POST['addr'])?set_value('addr'):isset($timeData->address)?$timeData->address:''; ?>" />
                    <span id="err_addr" class="error" > <?php echo form_error("addr"); ?></span>
                </div>
            </aside>

            <aside class="row clearfix  m-t-10">
                
                <div class="col-sm-6">
                    <input <?php echo $timeData->stayAt == 1 ? 'desabled="" readonly':'';  ?> name="lat" class="form-control" required="" type="text" value="<?php echo isset($_POST['lat'])?set_value('lat'):isset($timeData->lat)?$timeData->lat:''; ?>"  id="mi_lat" placeholder="Latitude" onchange="latChack(this.value)" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="9"/>
                    <span id="err_lat" class="error" > <?php echo form_error("lat"); ?></span>
                    <label class="error" style="display:none;" id="error-mi_lat">Please enter the correct format for latitude</label>
                </div>
                
                <div class="col-sm-6">
                    <input <?php echo $timeData->stayAt == 1 ? 'desabled="" readonly':'';  ?> name="lng" required="" type="text" value="<?php echo isset($_POST['lng'])?set_value('lng'):isset($timeData->lng)?$timeData->lng:''; ?>"  id="mi_lng" class="form-control" placeholder="Longitude" onChange="lngChack(this.value)" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="9"/>
                    <span id="err_lng" class="error" > <?php echo form_error("lng"); ?></span>
                    <label class="error" style="display:none;" id="error-mi_lng"> Please enter the correct format for longitude</label>
                </div>
                
            </aside>

        </div>
        
    </article>
    
    <article class="clearfix  m-t-10">
        <label class="control-label" for="docTimeDay_day">Weekdays:</label>
        <div class="">
            <select class="m-t-5 select2" data-width="100%" name="docTimeDay_day[]" id="docTimeDay_day" multiple="">
                <?php
                $days = getDay();
                $dbDays = isset($timeData->day)?$timeData->day:array();
                $dbDays = $dbDays != '' && $dbDays != null ? explode(',', $dbDays) : array();
                if (isset($days) && $days != NULL) {
                    foreach ($days as $d => $dayName) {

                        ?>
                        <option <?php echo in_array($dayName, $dbDays) ? 'selected':''; ?> value="<?php echo $dayName ?>"><?php echo $d ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
        <span id="err_docTimeDay_day" class="error" > <?php echo form_error("docTimeDay_day"); ?></span>
        
        <div class="">
            <aside class="checkbox checkbox-success m-t-5">
                <input <?php count($dbDays) == 7 ? 'checked' : '' ?> type="checkbox" id="selectAllDay" name="selectAllDay" class="" >
                <label> Select All Days</label>
            </aside>
        </div>
        <span id="err_day" class="error" > <?php echo form_error("day"); ?></span>
    </article>
    
    <article class="clearfix  m-t-10">
        <div class="">
            <aside class="row">
                <div class="col-sm-6">
                    <div class="bootstrap-timepicker input-group w-full">
                    <input name="openingHour" class="form-control timepicker" required="" type="text" value="<?php echo isset($_POST['openingHour'])?set_value('openingHour'):isset($timeData->open)?date('h:i A',strtotime($timeData->open)):''; ?>"  id="lat"   placeholder="opening Hour" />
                    </div>
                    <span id="err_openingHour" class="error" > <?php echo form_error("openingHour"); ?></span>
                </div>
                <div class="col-sm-6">
                    <div class="bootstrap-timepicker input-group w-full">
                    <input name="closeingHour" required="" type="text" value="<?php echo isset($_POST['closeingHour'])?set_value('closeingHour'):isset($timeData->close)?date('h:i A',strtotime($timeData->close)):''; ?>"  id="closeingHour"  class="form-control timepicker" placeholder="closing Hour"  maxlength="9"/>
                    </div>
                    <span id="err_closeingHour" class="error" > <?php echo form_error("closeingHour"); ?></span>
                </div>
            </aside>
        </div>
    </article>
    
    <article class="clearfix  m-t-10">
        <label class="control-label" for="fees">fees:</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i>
            </span>
            <input name="fees" required="" type="text" value="<?php echo isset($_POST['fees'])?set_value('fees'):isset($timeData->price)?$timeData->price:''; ?>"  id="fees"   class="form-control" placeholder="fees"  maxlength="9" onkeypress="return isNumberKey(event)"  />
            <span id="err_fees" class="error" > <?php echo form_error("fees"); ?></span>
        </div>
    </article>
    
    <article class="clearfix m-t-10 m-b-20">
        <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Submit</button>
    </article>

</form>
<?php
$this->load->view('timeslotEditScript');
?>
