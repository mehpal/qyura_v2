    

<div  id="newBooking" tabindex="-1" role="dialog" aria-labelledby="CreateLocation" class="modal fade bs-modal-lg" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
                <form role="form" id="setBooking" method="post" action="#" enctype="multipart/form-data" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><?php echo $this->lang->line('bookingTitleAdd');?></h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success" id="bookingSuccess" style="display: none"></div>
                        <div class="alert alert-danger" id="er_TopError" style="display: none"></div>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="bookingLoad" class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 00%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("fkUserIdAdd");?></label>
                                                    <select required name="<?php echo $this->lang->line("fkUserIdAddN");?>" id="<?php echo $this->lang->line("fkUserIdAddI");?>" class="bs-select form-control" data-live-search="true" title="<?php echo $this->lang->line("fkUserIdAddPlcHo");?>" >
                                                    <option value="">Select User</option>
                                                    <?php 
                                                        if($userList)
                                                        { 
                                                            foreach ($userList as $ul)
                                                            {
                                                    ?>
                                                    <option class="active" value="<?php echo $ul->userId ?>"><?php echo $ul->username ?></option>
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <div class="has-error help-block" id="<?php echo $this->lang->line("fkUserIdAddIer");?>" ></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("fkAmenityIdAdd");?></label>
                                                    <select name="<?php echo $this->lang->line("fkAmenityIdAddN");?>" id="<?php echo $this->lang->line("fkAmenityIdAddI");?>" class="bs-select form-control" data-live-search="true" title="<?php echo $this->lang->line("fkAmenityIdAddPlcHo");?>">
                                                    <option value="">Select amenity</option>
                                                    <?php 
                                                        if($amenityList)
                                                        { 
                                                            foreach ($amenityList as $am)
                                                            {
                                                    ?>
                                                    <option value="<?php echo $am->amenityId ?>"><?php echo $am->amenityName ?></option>
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <div class="has-error help-block" id="<?php echo $this->lang->line("fkUserIdAddIer");?>" ></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("amenityPay");?></label>
                                                <div class="icheck-inline">
                                                    <label>
                                                        <input type="radio" name="<?php echo $this->lang->line("amenityPayOption");?>" checked class="icheck" value="1" onclick="payOption('1')" > Check </label>&nbsp;&nbsp;
                                                    <label>
                                                        <input type="radio" name="<?php echo $this->lang->line("amenityPayOption");?>"  class="icheck deposit" value="0" onclick="payOption('0')" > Online </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="<?php echo $this->lang->line("checkIdAddI");?>">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("checkIdAdd");?></label>
                                                <div class="">
                                                    <input type="text" maxlength="100"  class="form-control" placeholder="<?php echo $this->lang->line("checkIdAddPlcHo");?>" name="<?php echo $this->lang->line("checkIdAddN");?>" id="<?php echo $this->lang->line("checkIdAddI");?>" required=""/>
                                                    <div id="er_<?php echo $this->lang->line("amenityNameId");?>" class="has-error help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="<?php echo $this->lang->line("onlineIdAddI");?>" style="display: none;">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("onlineIdAdd");?></label>
                                                <div class="">
                                                    <input type="button"  class="btn btn-primary" name="<?php echo $this->lang->line("onlineIdAddN");?>" id="<?php echo $this->lang->line("onlineIdAddI");?>" value="Pay Online"/>
                                                    <div id="er_<?php echo $this->lang->line("amenityNameId");?>" class="has-error help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("amenityDate");?></label>
                                                <div id="statusDate" class="form-group" id="data_5">
                                                    <div class="input-daterange" id="datepicker">
                                                        <input placeholder="<?php echo $this->lang->line("amenityDateAddPl");?>" name="<?php echo $this->lang->line("amenityDateAddN");?>" id="<?php echo $this->lang->line("amenityDateAddI");?>" type="text" class="input-sm form-control" name="start" value="2014-05-14"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("amenityTime");?></label>
                                                <div class="">
                                                    <input type="text" class="form-control timepicker timepicker-no-seconds" placeholder="<?php echo $this->lang->line("amenityTimeAddPl");?>" name="<?php echo $this->lang->line("amenityTimeAddN");?>" id="<?php echo $this->lang->line("amenityTimeAddI");?>" required=""/>
                                                <div id="er_<?php echo $this->lang->line("openingTimeId");?>" class="has-error help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line("amenityMess");?></label>
                                                    <textarea rows="3" name="<?php echo $this->lang->line("amenityMessAddN");?>" id="<?php echo $this->lang->line("amenityMessAddI");?>" class="input-sm form-control" required=""></textarea>
                                                </div>
                                            </div>
                                        </div>     
                                    </div>
                                </div>
                                     
                            </div>
                            <div class="modal-footer">
                                <button type="submit"  class="btn btn-primary">Save changes</button>
                                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

<script>
function payOption(obj)
{
    var check = obj;
    if(check == '1')
    {
        $('#<?php echo $this->lang->line("checkIdAddI");?>').show(400);
        $('#<?php echo $this->lang->line("onlineIdAddI");?>').hide(400);
        $('#<?php echo $this->lang->line("checkIdAddI");?>').attr('required',"");
        $('#<?php echo $this->lang->line("onlineIdAddI");?>').removeAttr('required');
    }
    else if(check == '0')
    {
        $('#<?php echo $this->lang->line("checkIdAddI");?>').removeAttr('required');
        $('#<?php echo $this->lang->line("onlineIdAddI");?>').attr('required',"");
        $('#<?php echo $this->lang->line("onlineIdAddI");?>').show(400);
        $('#<?php echo $this->lang->line("checkIdAddI");?>').hide(400);
    }
}

</script>