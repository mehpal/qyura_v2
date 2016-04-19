    

<div  id="amenityEditFormModal" tabindex="-1" role="dialog" aria-labelledby="Edit-Amenity" class="modal fade bs-modal-lg" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form role="form" id="updateamenity" method="post" action="#" enctype="multipart/form-data" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><?php echo $this->lang->line('amenityTitleEdit');?></h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success" id="amenitySuccessEdit" style="display: none"></div>
                        <div class="alert alert-danger" id="er_TopError" style="display: none"></div>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="editAmenityLoad" class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 00%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("amenityNameAdd");?></label>
                                                <div class="">
                                                    <input type="hidden" name="<?php echo $this->lang->line("amenityId");?>" id="<?php echo $this->lang->line("amenityId");?>" value="<?php echo $amenity->amenityId ?>" />
                                            
                                                    <input type="text" maxlength="100"  class="form-control" placeholder="<?php echo $this->lang->line("amenityNamePh");?>" name="<?php echo $this->lang->line("amenityNameId");?>" id="<?php echo $this->lang->line("amenityNameId");?>" required=""  onkeyup="error_hide(this.id);" value="<?php echo $amenity->amenityName ?>"  />
                                                    <div id="er_<?php echo $this->lang->line("amenityNameId");?>" class="has-error help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("capacityAdd");?></label>
                                                <div class="">
                                                    <input type="number"  min="0"  class="form-control" placeholder="<?php echo $this->lang->line("capacityPh");?>" name="<?php echo $this->lang->line("capacityId");?>" id="<?php echo $this->lang->line("capacityId");?>" value="<?php echo $amenity->capacity; ?>"  />
                                                    <div id="er_<?php echo $this->lang->line("capacityId");?>" class="has-error help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("openingTimeAdd");?></label>
                                                <div class="">
                                                    <input type="text" class="form-control timepicker timepicker-no-seconds" placeholder="<?php echo $this->lang->line("openingTimePh");?>" name="<?php echo $this->lang->line("openingTimeId");?>" id="<?php echo $this->lang->line("openingTimeId");?>" required=""  onkeyup="error_hide(this.id);" value="<?php echo date('g:i A',strtotime($amenity->openingTime)) ?>"/>
                                                    <div id="er_<?php echo $this->lang->line("openingTimeId");?>" class="has-error help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("closingTimeAdd");?></label>
                                                <div class="">
                                                    <input  type="text" class="form-control timepicker timepicker-no-seconds" placeholder="<?php echo $this->lang->line("closingTimePh");?>" name="<?php echo $this->lang->line("closingTimeId");?>" id="<?php echo $this->lang->line("closingTimeId");?>" required=""  onkeyup="error_hide(this.id);" value="<?php echo date('g:i A',strtotime($amenity->closingTime)) ?>" />
                                                    <div id="er_<?php echo $this->lang->line("closingTimeId");?>" class="has-error help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("securdepoAdd");?></label>
                                                <div class="input-group">
                                                    <div class="icheck-inline">
                                                        <label>
                                                            <input type="radio" name="<?php echo $this->lang->line("securdepoId");?>" <?php echo ($amenity->securityDepositReq == 1) ? 'checked' : ''; ?> class="icheck" value="1" > Yes </label>
                                                        <label>
                                                            <input type="radio" name="<?php echo $this->lang->line("securdepoId");?>"  class="icheck deposit" value="0" <?php echo ($amenity->securityDepositReq == 0) ? 'checked' : ''; ?> > No </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="<?php echo $this->lang->line("securamtId");?>_div">
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line("securamtAdd");?></label>
                                                    <div class="">
                                                        <input  type="text" class="form-control" placeholder="<?php echo $this->lang->line("securamtPh");?>" name="<?php echo $this->lang->line("securamtId");?>" id="<?php echo $this->lang->line("securamtId");?>" required=""  onkeyup="error_hide(this.id);" value="<?php echo $amenity->securityAmount; ?>"   />
                                                        <div id="er_<?php echo $this->lang->line("securamtId");?>" class="has-error help-block"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         
                                    </div>
                                </div>
                                     
                            </div>
                            <div class="modal-footer">
                                <button type="submit"  class="btn blue">Save changes</button>
                                <button type="button" class="btn default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

<script type="text/javascript">
$(document).ready(function(){
     $('.timepicker-no-seconds').timepicker({
            autoclose: true,
            minuteStep: 5,
           showInputs: false,
          // showMeridian: false
        });
      
    $("#updateamenity").submit(function( event ) {

        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
        
            type:"POST",
            url:'<?php echo site_url(); ?>/amenity/edit',
            data:formData,//only input
            processData: false,
            contentType: false,
            xhr: function()
            {
                var xhr = new window.XMLHttpRequest();
                //Upload progress
                xhr.upload.addEventListener("progress", function(evt){
                  if (evt.lengthComputable) {
                    var percentComplete = (evt.loaded / evt.total)*100;
                    $('#editAmenityLoad .progress-bar').css('width',percentComplete+'%');
                  }
                }, false);
                //Download progress
                xhr.addEventListener("progress", function(evt){
                  if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                  }
                }, false);
                return xhr;
            },
            success: function(response, textStatus, jqXHR){
                try {
                    var data = $.parseJSON(response);
                    if(data.status == 0)
                    {
                        if(data.isAlive)
                        {
                            $('#editAmenityLoad .progress-bar').css('width','00%');
                            console.log(data.errors);
                            $.each(data.errors, function( index, value ) {
                                $('#er_'+index).html(value);
                            });
                            $('#er_TopError').show();
                            setTimeout(function(){
                                $('#er_TopError').hide(800);
                                $('#er_TopError').html('');
                            },2000);
                        }
                        else
                        {
                            $('#headLogin').html(data.loginMod);
                        }
                    }
                    else{
                        $('#amenitySuccessEdit').show();
                        $('#amenitySuccessEdit').html(data.msg);
                         setTimeout(function(){
                            $('#amenitySuccessEdit').hide(800);
                            $('#amenitySuccessEdit').html('');
                            $('.bs-select').selectpicker('deselectAll');
                            $('.bs-select').val('');
                            $('.bs-select').selectpicker('refresh');
                            $('#<?php echo $this->lang->line("emailAddI");?>').val('');
                            $('#<?php echo $this->lang->line("userNameAddI");?>').val('');
                         },2000);
                        location.reload(true); 
                    }
                }catch(e) {
                    $('#er_TopError').show();
                    $('#er_TopError').html(e);
                    setTimeout(function(){
                            $('#er_TopError').hide(800);
                            $('#er_TopError').html('');
                    },2000);
                }
                
                
            }
        });
    });

})
</script>