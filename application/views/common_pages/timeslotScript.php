<script src="<?php echo base_url(); ?>assets/vendor/timepicker/bootstrap-timepicker.min.js"></script>

<script>
    
    function timeSplit(time) {
        var splitTime = time.split(":");
        var hour = parseInt(splitTime[0]);
        var min = parseInt(splitTime[1]);
        hour = hour * 60;
        var totalTime = hour + min;
        return totalTime;

    }

    function timeSlotCheck() {
        
        var i;
        var k;
        var count = 0;
        var flag = 0;
        for (i = 1; i < 11; i++) {
            var totalSlot = $("#totalSlot_" + i).val();
           // alert(totalSlot);
            for(k = 1;k <= totalSlot; k++){
                if ($("#check_" + i + "_" + k ).prop("checked") == true) {
                    var day1 = $("#openTime_" + i + "_" + k).val();
                    var day2 = $("#closeTime_" + i + "_" + k).val();
                    var min1 = timeSplit(day1);
                    var min2 = timeSplit(day2);
                    count++;
                    if (min1 < min2) {
                        flag++;
                    } else {
                    }
                }
            }
        }
        if (count == flag) {
            $("#checkDays").html("");
            return true;
        } else {
            $("#checkDays").html("Please enter valid time duration");
            return false;
        }
    }
    
    //   Fill Monday Value to all days
    function allDaysHour(checkId, valId1, valId2) {

        if ($("#" + checkId).prop("checked") == true) {
            var openHour = $("#" + valId1).val();
            var closeHour = $("#" + valId2).val();
            
            if (openHour == '' && closeHour == '') {
                alert("Monday Time is Required");
                $("#" + checkId).prop('checked', false);
            } else {
                var i;
                for (i = 2; i < 8; i++) {
                    $("#check_" + i +"_1").prop('checked', true);
                    //$("#dayDiv" + i +"_1").show();
                    $("#openTime_" + i +"_1").val(openHour);
                    $("#closeTime_" + i +"_1").val(closeHour);
                }
            }
        } else {
            var j;
            for (j = 2; j < 8; j++) {
                $("#check_" + j +"_1").prop('checked', false);
                //$("#dayDiv" + j).hide();;
                $("#openTime_" + j +"_1").val('');
                $("#closeTime_" + j +"_1").val('');
            }
        }
    }
    
    function customShow(id, textId) {
        console.log(id);
        console.log(textId);
        if ($("#" + id).prop("checked") == true) {
            //$("#" + textId).show();
            $("#" + textId + " input").prop('required', true);
        } else {
            //$("#" + textId).hide();
            $("#" + textId + " input").prop('required', false);
            //$("#" + textId + " input[type=text]").val('');
        }
    }
    
    $('.timepicker').timepicker({showMeridian:false,defaultTime: false,});
    
    function addNewSlot(dayType,value) {
        var type = parseInt(dayType); 
        
        var oldVal = $("#totalSlot_"+type).val();

        var typeVal = parseInt(oldVal) + parseInt(1);
        
        var htmlData = '<div id="div_'+type+'_'+typeVal+'" class="col-md-12 m-t-10"><div class="col-md-1"><a href="javascript:void(0)" class="add btn btn-danger btn-xs" onclick="removeMore(\'div_'+type+'_'+typeVal+'\')" ><i class="fa fa-minus"></i></a></div><div class="col-md-1"><input type="checkbox" name="check_'+type+'_'+typeVal+'" id="check_'+type+'_'+typeVal+'" value="1" onclick="customShow(\'check_'+type+'_'+typeVal+'\',\'div_'+type+'_'+typeVal+'\')" /></div><div class="col-md-3"><input type="text" name="hour_label_'+type+'_'+typeVal+'" id="hour_label_'+type+'_'+typeVal+'" value="'+value+'" class="form-control" /></div><div id="dayDiv'+typeVal+'"><div class="col-md-3" data-autoclose="true"><div class="bootstrap-timepicker input-group"><input id="openTime_'+type+'_'+typeVal+'" autocomplete="off" class="form-control timepicker" type="text" name="openTime_'+type+'_'+typeVal+'" value="" readonly=""></div></div><div class="col-md-3" data-autoclose="true"><div class="bootstrap-timepicker input-group"><input id="closeTime_'+type+'_'+typeVal+'" autocomplete="off" class="form-control timepicker" type="text" name="closeTime_'+type+'_'+typeVal+'" value="" readonly=""></div></div></div></div>';

        $("#appendDiv_" + type).append(htmlData);
        $("#totalSlot_"+type).val(typeVal);

        $('.timepicker').timepicker({
            defaultTime: false,
            showMeridian: false
        });
    }

    function removeMore(typeVal) {

        $("#" + typeVal).remove();
    }
</script>