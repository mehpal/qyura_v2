 <div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Change Timing</h3>
                </div>
                <!--input type="hidden" id="mi_centre" name="mi_centre"  value="<?php echo $conDetail->doctorParentId;?>"-->
              <input type="hidden" id="quotid" name="quotid" value="<?php echo isset($qtnId) ? $qtnId : ''?>">
                <div class="modal-body">
                    <div class="modal-body">
                        <form class="form-horizontal" id="changetimeform2">
                            <article class="clearfix m-t-10">
                                <label for="" class="control-label col-md-4 col-sm-4">Appointment Date:</label>
                                <div class="col-md-8 col-sm-8">
                                    <div class="input-group">
                                        <input class="form-control pickDate" id="date-11" type="text" name="appdate2" onkeydown="return false;">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>
                            </article>
                            <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4 col-sm-4">Final Timing:</label>
                                <div class="col-md-8 col-sm-8">
                                    <div class="bootstrap-timepicker input-group w-100">
                                        <input id="timepicker11" name="finaltime2" type="text" class="form-control timepicker"  />
                                    </div>
                                </div>
                            </article>
                            <article class="clearfix m-t-20">
                                <button type="submit" class="btn btn-primary pull-right waves-effect waves-light">Save changes</button>
                            </article>
                        </form>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>