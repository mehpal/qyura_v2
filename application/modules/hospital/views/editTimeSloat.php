<form  class="cmxform form-horizontal tasi-form avatar-form" id="timeEditForm" name="addDoctorSlot" method="post" action="#" novalidate="novalidate">
    <article class="clearfix m-t-10">
        <input type="hidden" name="doctorId" id="" value="<?php echo $timeData->doctorId; ?>" />
        <input type="hidden" name="docTimeTableId" id="docTimeTableId" value="<?php echo $timeData->docTimeTableId; ?>" />
        <input type="hidden" name="MIprofileId" id="MIprofileId" value="<?php echo $timeData->MIprofileId; ?>" />
        <input type="hidden"  id="day"  value="<?php echo $timeData->day; ?>" />
        <input type="hidden" name="docTimeDayId" id="docTimeDayId"  value="<?php echo $timeData->docTimeDayId; ?>" />
    </article>

    <article class="clearfix  m-t-10">
        <label class="control-label" for="docTimeDay_day">Weekdays:</label>
        <div class="">
            <select class="m-t-5 select2" data-width="100%" name="docTimeDay_day[]" id="docTimeDay_day" multiple="">
                <?php
                $days = getDay();
                $dbDays = isset($timeData->day) ? $timeData->day : array();
                $dbDays = $dbDays != '' && $dbDays != null ? explode(',', $dbDays) : array();
                if (isset($days) && $days != NULL) {
                    foreach ($days as $d => $dayName) {
                        ?>
                        <option <?php echo in_array($dayName, $dbDays) ? 'selected' : ''; ?> value="<?php echo $dayName ?>"><?php echo $d ?></option>
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
                        <input name="openingHour" class="form-control timepicker" type="text" value="<?php echo isset($_POST['openingHour']) ? set_value('openingHour') : isset($timeData->open) ? date('h:i A', strtotime($timeData->open)) : ''; ?>"  id="lat"   placeholder="opening Hour" />
                    </div>
                    <span id="err_openingHour" class="error" > <?php echo form_error("openingHour"); ?></span>
                </div>
                <div class="col-sm-6">
                    <div class="bootstrap-timepicker input-group w-full">
                        <input name="closeingHour" type="text" value="<?php echo isset($_POST['closeingHour']) ? set_value('closeingHour') : isset($timeData->close) ? date('h:i A', strtotime($timeData->close)) : ''; ?>"  id="closeingHour"  class="form-control timepicker" placeholder="closing Hour"  maxlength="9"/>
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
            <input name="fees" required="" type="text" value="<?php echo isset($_POST['fees']) ? set_value('fees') : isset($timeData->price) ? $timeData->price : ''; ?>"  id="fees"   class="form-control" placeholder="fees"  maxlength="9" onkeypress="return isNumberKey(event)"  />
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
