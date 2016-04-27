<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="col-md-12">Working Hours* : </label>
        </div>
    </div>
<!--    <div class="col-md-2">
        <input type="checkbox" id="allOpenHour" onclick="allDaysHour('allOpenHour', 'openTime_1_1', 'closeTime_1_1')"/> All Days 
    </div>-->
    <label class="has-error" style="color: red" id="checkDays"><?php echo form_error("centerType"); ?></label>
    <div class="col-md-12"> 
        <div class="form-group">
            <label class="col-md-1" for="typehead"> &nbsp; </label>
            <label class="col-md-3 m-l-20" for="typehead">Days*</label>
            <label class="col-md-3" for="typehead">Opening Hours</label>
            <label class="col-md-3" for="typehead">Closing Hours</label>

            <div id="checkDaysTime">
                <?php
                $dateStart;
                $flag = 0;
                $curr = "";
                $pre = "";
                for ($i = 1; $i < 8; $i++) {
                    $j = $i - 1;
                    if ($i == 1) {
                        $dateStart = date("l", strtotime("mon"));
                    }
                    $dayVal = date('l', strtotime($dateStart . "+" . $j . " days"));
                    $days = ucfirst(convertNumberToDay($j));
                    ?>
                    <input type="hidden" id="totalSlot_<?php echo $i; ?>" name="totalSlot_<?php echo $i; ?>" value="1">
                    <div class="col-md-12 m-t-10" id="appendDiv_<?php echo $i; ?>">
                        <div id="div_<?php echo $i; ?>_1" class="col-md-12">

                            <div class="col-md-1 timeValidate">
                                <input type="hidden" name="charge_ids_<?php echo $i; ?>_1" id="charge_ids_<?php echo $i; ?>_1" value='<?php echo $dayVal; ?>' class="form-control" readonly /> 
                                
                                <input type="checkbox" name="check_<?php echo $i; ?>_1" id="check_<?php echo $i; ?>_1" onclick="customShow('check_<?php echo $i; ?>_1', 'div_<?php echo $i; ?>_1')" value="1"  <?php foreach($timeSlot as $slot): if($slot->dayNumber == $j):echo "checked";endif;endforeach;?>/>
                                
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="hour_label_<?php echo $i; ?>_1" id="hour_label_<?php echo $i; ?>_1" value='<?php echo $days; ?>' class="form-control" readonly /> 
                               
                                 <input type="hidden" name="dayNumber_<?php echo $i; ?>" id="dayNumber_<?php echo $i; ?>" value='<?php echo $j; ?>' class="form-control" readonly />
                                 
                            </div>
                            
                            <div class="" id="dayDiv1">
                                <div class="col-md-3" data-autoclose="true">
                                    <div class="bootstrap-timepicker input-group">
                              <input id="openTime_<?php echo $i; ?>_1" autocomplete="off" class="form-control timepicker " type="text" name="openTime_<?php echo $i; ?>_1" value="<?php foreach($timeSlot as $slot): if($slot->dayNumber == $j):
                                            echo $slot->openingHours;endif;endforeach;?>" readonly="">
                                    </div>
                                </div>
                                <div class="col-md-3" data-autoclose="true">
                                    <div class="bootstrap-timepicker input-group">
                                        <input id="closeTime_<?php echo $i; ?>_1" autocomplete="off" class="form-control timepicker" type="text" name="closeTime_<?php echo $i; ?>_1" value="<?php foreach($timeSlot as $slot): if($slot->dayNumber == $j):echo $slot->closingHours;endif;endforeach;?>" readonly="">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
<?php } ?>
            </div>
        </div>
    </div>
</div>