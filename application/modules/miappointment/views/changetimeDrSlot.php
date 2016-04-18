
<style>
    .datepicker{
        z-index: 100000;
    }
</style>
<div id="changeTimemodel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Change Timing</h3>
                </div>
                
               
                <div class="modal-body">
                    <div class="modal-body">
                        <form class="form-horizontal" id="update_timeslot" method="POST">
                            <article class="clearfix m-t-10">
                                <label for="" class="control-label col-md-4 col-sm-4">Appointment Date:</label>
                                <div class="col-md-8 col-sm-8">
                                    <div class="input-group">
                                        <input class="form-control pickDate" placeholder="mm-dd-YYYY" value="<?php echo $date; ?>" id="appointmentDate" type="text" name="appointmentDate" onkeydown="return false;">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>
                            </article>
                            <article class="clearfix m-t-10">
                                <label class="control-label col-md-4 col-sm-4">Session :</label>
                                <p class="col-md-8 col-sm-8">
                                    
                                     
                                    <select class="selectpicker" data-width="100%" name="session">
                                        
                                        <?php if($timeSlots){ foreach($timeSlots as $timeSlot){?>
                                        <option <?php if(trim($timeSlot->sesId).','.trim($timeSlot->sesType) == $populate){ echo 'selected';} ?> value="<?php echo trim($timeSlot->sesId).','.trim($timeSlot->sesType); ?>"><?php 
                                        $day = '';
                                        
                                        if(isset($timeSlot->timeSlot) && $timeSlot->timeSlot != null )
                                        {
                                            $timeSlotChunk = explode('-', $timeSlot->timeSlot);
                                            $day = convertNumberToDay($timeSlotChunk[3]);
                                        }
                                        
                                        echo date('h:i A',strtotime($timeSlotChunk[0])).'-'.date('h:i A',strtotime($timeSlotChunk[1])).'-'.getSession($timeSlotChunk[2]).'-'.$day; ?></option> 
                                        <?php }}?>

                                    </select>

                                </p>
                            </article>
                            <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4 col-sm-4">Final Timing:</label>
                                <div class="col-md-8 col-sm-8">
                                    <div class="bootstrap-timepicker input-group w-100">
                                        <input id="timepicker3" type="text" class="form-control timepicker" name="finalTime" value="<?php echo $time; ?>" />
                                    </div>
                                </div>
                            </article>
                            <article class="clearfix m-t-20">
                                <button type="submit" class="btn btn-primary pull-right waves-effect waves-light">Save changes</button>
                            </article>
                            <input type="hidden" value ="<?php  echo isset($mId)?$mId:''; ?>" name="miId">
                            <input type="hidden" value ="<?php  echo isset($appointmentId)?$appointmentId:''; ?>" name="appointmentId">
                            
                        </form>
                    </div>

                </div>
                <!-- /.modal-content -->
              
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>

<!--<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js">-->
<script src="<?php echo base_url();?>assets/vendor/timepicker/bootstrap-timepicker.min.js"></script>

<script> 
    jQuery(document).ready(function (event) {
    $('.timepicker').timepicker();
    $('#appointmentDate').datepicker();
    $("#update_timeslot").submit(function () {
        $.ajax({
            type: "POST",
            url: '<?php echo site_url('miappointment/Save_DrtimeSlot'); ?>',
            data: $('form.form-horizontal').serialize(),
            success: function (data) {
                $("#changeTimemodel").modal('hide');
                location.reload(true);
            },
            error: function () {
                alert("failure");
            }
        });
        return false;
    });
});
    </script>
