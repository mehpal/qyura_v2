<style>
    .float-e-margins .btn{
        margin-bottom: 0px !important;
    }
</style>
<div id="amenityEditNew">
<div id="wrapper">
    <div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Amenity Details</h5>
                </div>
                <div> 
                    <div class="ibox-content no-padding border-left-right">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                        <?php  $count= 0;
                            if(isset($amenityImage) && $amenityImage != NULL){
                                foreach($amenityImage as $amenityImg){?>
                                    <li data-target="#myCarousel" data-slide-to="<?php echo $count; ?>" class="<?php echo ($count == 0) ? "active" : "";?>"></li>
                        <?php      $count ++; 
                                }
                            } ?>
                        </ol>
                                <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                        <?php  $count= 0;
                            if(isset($amenityImage) && $amenityImage != NULL){
                                foreach($amenityImage as $amenityImg){?>
                            <div class="item <?php echo ($count == 0) ? "active" : "";?> img-responsive" style="width: 95%; height: 180px">
                                <img alt="image" class="img-responsive" src="<?php echo $amenityImg->amenityImageUrl; ?>">
                                    </div>
                        <?php       $count ++; 
                                }
                            }
                            ?>
                        </div>
                        <a class="carousel-control left" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="carousel-control right" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>

                    </div>

                    <div class="ibox-content profile-content">
                        <h4><strong><?php echo $amenity->amenityName; ?></strong></h4>
                        <p><i class="fa fa-users"></i> Capacity : <?php echo $amenity->capacity; ?> <i class="fa fa-clock-o" style="margin-left: 14%"></i>   
                            <?php echo date("g:i A",strtotime($amenity->openingTime));  ?> <strong> To </strong> <?php echo date("g:i A",strtotime($amenity->closingTime));  ?>
                        </p>

                        <h5>
                            Rules and Regulations
                        </h5>
                        <p>
                            <?php echo ($amenity->amenityRules);  ?>
                        </p>
                        <div class="row m-t-lg">
                            <div class="col-md-6">
                                <p><i class="fa fa-money"></i> Amenity Cost 
                                    <?php echo ($amenity->amenityCost);  ?>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><i class="fa fa-lock"></i> Security Amount 
                                    <?php echo ($amenity->securityAmount != 0) ? $amenity->securityAmount : 'N/A';  ?>
                                </p>
                            </div>
                        </div>
                        <div class="user-button">
                            <div class="row">
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-6">

                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </div>
        <div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit Information</h5>
                </div>
                <div class="ibox-content">
                    <div class="feed-activity-list">
                        <form method="post" action="#" enctype="multipart/form-data" id="updateamenity">
                            <div class="modal-body">
                                <div class="form-body">
                                    <div class="row">
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
                                            <div class="col-md-6 form-group">
                                                <label>Tower Name </label>
                                                <select required onchange="getFloorName(this.value)" name="fkTowerId" id="fkTowerId" class="bs-select form-control" data-size="auto" data-live-search="true" title="Tower Name"  >
                                                    <option selected value="">Select Tower</option>
                                                     <?php if(isset($flTower) && $flTower != NULL){
                                                           foreach ($flTower as $towers) {  
                                                               $selected = "";
                                                               if($towers->towerId ==  $amenity->fkTowerId){
                                                                   $selected = "selected";
                                                               }
                                                               ?>
                                                     <option value="<?php echo $towers->towerId; ?>" <?php echo $selected ?>><?php echo $towers->towerName; ?></option>
                                                     <?php } } ?>
                                                 </select>
                                                 <div class="has-error help-block" id="er_fkTowerId" ></div>
                                             </div>
                                            <!--close-->
                                            <div class="col-md-6 form-group">

                                                <label>Floor No *</label>

                                                <select required name="fkFloorId" id="fkFloorId" class="bs-select form-control" data-size="auto" data-live-search="true" title="Floor Name"  >
                                                    <option selected value="">Select Floor</option>
                                                    <?php if(isset($floor) && $floor != NULL){
                                                           foreach ($floor as $fl) {  
                                                               $selected = "";
                                                               if($fl->floorId ==  $amenity->fkFloorId){
                                                                   $selected = "selected";
                                                               }
                                                               ?>
                                                     <option value="<?php echo $fl->floorId; ?>" <?php echo $selected ?>><?php echo $fl->floorName; ?></option>
                                                     <?php } } ?>
                                                </select>

                                                <div class="has-error help-block" id="<?php echo $this->lang->line("floorIdAddIer");?>" ></div>
                                            </div>
                                        </div> 
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <div class="form-group" >
                                                    <label><?php echo $this->lang->line("openingTimeAdd");?></label>

                                                    <div class="input-group date" id="startTimeEdit">
                                                        <input class="form-control" name="<?php echo $this->lang->line("openingTimeId");?>" id="<?php echo $this->lang->line("openingTimeId");?>" placeholder="<?php echo $this->lang->line("openingTimePh");?>" type="text" required="" onkeyup="error_hide(this.id);" value="<?php echo date('g:i A',strtotime($amenity->openingTime)) ?>" >
                                                        <span class="input-group-addon">
                                                            <i class="glyphicon glyphicon-time"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" >
                                                    <label><?php echo $this->lang->line("closingTimeAdd");?></label>

                                                    <div class="input-group date" id="endTimeEdit">
                                                        <input class="form-control" name="<?php echo $this->lang->line("closingTimeId");?>" id="<?php echo $this->lang->line("closingTimeId");?>" placeholder="<?php echo $this->lang->line("closingTimePh");?>" type="text" required="" onkeyup="error_hide(this.id);" value="<?php echo date('g:i A',strtotime($amenity->closingTime)) ?>" >
                                                        <span class="input-group-addon">
                                                            <i class="glyphicon glyphicon-time"></i>
                                                        </span>
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
                                                        <input type="radio" name="<?php echo $this->lang->line("securdepoId");?>" id="<?php echo $this->lang->line("securdepoId");?>" class="icheck" value="1" onclick="hideamt('1');" <?php echo (isset($amenity->securityDepositReq) && $amenity->securityDepositReq == "1" ? "checked" : "")?>> Yes </label>
                                                    &nbsp;&nbsp;<label>
                                                        <input type="radio" name="<?php echo $this->lang->line("securdepoId");?>" id="<?php echo $this->lang->line("securdepoId");?>" class="icheck deposit" value="0" onclick="hideamt('0');" <?php echo (isset($amenity->securityDepositReq) && $amenity->securityDepositReq == "0" ? "checked" : "")?>> No </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="<?php echo $this->lang->line("securamtId");?>_div" <?php echo (isset($amenity->securityAmount) && $amenity->securityAmount == "0" ? " style='display: none'" : "")?>>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("securamtAdd");?></label>
                                                <div class="">
                                                    <input type="text"  name="<?php echo $this->lang->line("securamtId");?>" id="<?php echo $this->lang->line("securamtId");?>"  class="form-control" value="<?php echo $amenity->securityAmount; ?>" >

                                                    <div id="er_<?php echo $this->lang->line("securamtId");?>" class="has-error help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                        <div class="col-md-12">
                                            <div class="col-md-6" id="<?php echo $this->lang->line("amenityCostId");?>_div">
                                                    <div class="form-group">
                                                        <label>Amenity Cost</label>
                                                        <div class="">
                                                            <input  type="text" class="form-control" placeholder="<?php echo $this->lang->line("amenityCostPh");?>" name="<?php echo $this->lang->line("amenityCostId");?>" id="<?php echo $this->lang->line("amenityCostId");?>" required=""  onkeyup="error_hide(this.id);" value="<?php echo $amenity->amenityCost; ?>"   />
                                                            <div id="er_<?php echo $this->lang->line("amenityCostId");?>" class="has-error help-block"></div>
                                                        </div>
                                                    </div>
                                                </div>
<!--                                                <div class="col-md-6" id="<?php echo $this->lang->line("securamtId");?>_div">
                                                    <div class="form-group">
                                                        <label><?php echo $this->lang->line("securamtAdd");?></label>
                                                        <div class="">
                                                            <input  type="text" class="form-control" placeholder="<?php echo $this->lang->line("securamtPh");?>" name="<?php echo $this->lang->line("securamtId");?>" id="<?php echo $this->lang->line("securamtId");?>" required=""  onkeyup="error_hide(this.id);" value="<?php echo $amenity->securityAmount; ?>"   />
                                                            <div id="er_<?php echo $this->lang->line("securamtId");?>" class="has-error help-block"></div>
                                                        </div>
                                                    </div>
                                                </div>-->
                                            </div>
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line("rulesAdd");?></label>
                                                    <div class="">
                                                        <textarea rows="7" class="form-control" placeholder="<?php echo $this->lang->line("rulesPh");?>" name="<?php echo $this->lang->line("rulesId");?>" id="<?php echo $this->lang->line("rulesId");?>"><?php echo $amenity->amenityRules; ?></textarea>
                                                        <div id="er_<?php echo $this->lang->line("rulesId");?>" class="has-error help-block"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                                    <div class="col-md-12">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line("amenityimgAdd");?></label>
                                                    <div class="">
                                                        <input type="file" accept="<?php echo $this->lang->line('imgTypes');?>"  name="<?php echo $this->lang->line("amenityimgId");?>" id="<?php echo $this->lang->line("amenityimgId");?>" multiple />
                                                        <div id="er_<?php echo $this->lang->line("amenityimgId");?>" class="has-error help-block"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit"  class="btn btn-info" >Save changes</button>
                                <a href="javascript:location.reload()" type="button" class="btn btn-info" data-dismiss="modal">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
</div>
</div>
<script type="text/javascript">
    
    var handleBootstrapTouchSpin = function() {

        $("#<?php echo $this->lang->line("securamtId");?>").TouchSpin({
            buttondown_class: 'btn btn-primary',
           buttonup_class: 'btn btn-primary',
           min: 0,
           max: 3000,
           step: 0.1,
           decimals: 2,
           boostat: 5,
           maxboostedstep: 10,
           prefix: '$'
       });      

       $("#<?php echo $this->lang->line("amenityCostId");?>").TouchSpin({
            buttondown_class: 'btn btn-primary',
           buttonup_class: 'btn btn-primary',
           min: 0,
           max: 3000,
           step: 0.1,
           decimals: 2,
           boostat: 5,
           maxboostedstep: 10,
           prefix: '$'
       });         


   } 
    
    $(document).ready(function(){

        handleBootstrapTouchSpin();

        $('#startTimeEdit').datetimepicker({
               formatViewType:"time",
               format: "HH:ii p",
               weekStart: 1,
               startDate: "today",
               autoclose: true,
               startView: 1,
               todayHighlight: true,
               viewSelect: "day",
               pickerPosition: "bottom-left"

           });

        $('#endTimeEdit').datetimepicker({
            formatViewType:"time",
            format: "HH:ii p",
            weekStart: 1,
            startDate: "today",
            autoclose: true,
            startView: 1,
            todayHighlight: true,
            viewSelect: "day",
            pickerPosition: "bottom-left"

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
