<style>
    .datepicker{
        z-index:9999 !important;
    }
</style>
<div id="maintenance" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Amenity Maintenance</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:200px" data-always-visible="1" data-rail-visible1="1">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>When and Why</h4>
                            <?php if($amenity->amenityStatus == 0){ ?>
                            <div id="statusDate" class="form-group" id="data_5">
                                <label class="font-noraml">Select Date</label>
                                <div class="input-daterange input-group" id="datepicker">
                                    <input id="maintenance_start" type="text" class="input-sm form-control" name="start" value="2014-05-14"/>
                                    <span class="input-group-addon">to</span>
                                    <input id="maintenance_end" type="text" class="input-sm form-control" name="end" value="2014-05-25" />
                                </div>
                            </div>
                            <?php } ?>
                            <div class="form-group">
                                <label class="font-noraml">Write some Message </label>
                                <textarea rows="3" id="maintenance_mess" class="input-sm form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn default">Close</button>
                <button type="submit" class="btn btn-primary" onclick="statusFn('<?php echo $amenity->amenityId; ?>','<?php echo $amenity->amenityStatus; ?>');" style="margin-bottom: 5px">Save changes</button>
            </div>
        </div>
    </div>
</div>	
<script>
    $(document).ready(function(){
            $('#maintenance_start, #maintenance_end').datepicker({

                        todayBtn: "linked",
                        keyboardNavigation: false,
                        forceParse: false,
                        calendarWeeks: true,
                        autoclose: true,
                        startDate: '-2m',
                });
      });
</script>