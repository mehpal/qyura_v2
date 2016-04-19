    

<div  id="createAmenity" tabindex="-1" role="dialog" aria-labelledby="CreateLocation" class="modal fade bs-modal-lg" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form role="form" id="setAmenity" method="post" action="#" enctype="multipart/form-data" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><?php echo $this->lang->line('amenityTitleAdd');?></h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success" id="amenitySuccess" style="display: none"></div>
                        <div class="alert alert-danger" id="er_TopError" style="display: none"></div>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="amenityLoad" class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 00%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("amenityNameAdd");?></label>
                                                <div class="">
                                                    <input type="text" maxlength="50"  class="form-control" placeholder="<?php echo $this->lang->line("amenityNamePh");?>" name="<?php echo $this->lang->line("amenityNameId");?>" id="<?php echo $this->lang->line("amenityNameId");?>" required=""  />
                                                    <div id="er_<?php echo $this->lang->line("amenityNameId");?>" class="has-error help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("capacityAdd");?></label>
                                                <div class="">
                                                    <input type="number"  min="0"  class="form-control" placeholder="<?php echo $this->lang->line("capacityPh");?>" name="<?php echo $this->lang->line("capacityId");?>" id="<?php echo $this->lang->line("capacityId");?>"  />
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
                                                          foreach ($flTower as $towers) {  ?>
                                                    <option value="<?php echo $towers->towerId; ?>"><?php echo $towers->towerName; ?></option>
                                                    <?php } } ?>
                                                </select>
                                                <div class="has-error help-block" id="er_fkTowerId" ></div>
                                            </div>
                                            <!--close-->
                                            <div class="col-md-6 form-group">
                                                
                                                <label>Floor No *</label>
                                                
                                                <select required name="fkFloorId" id="fkFloorId" class="bs-select form-control" data-size="auto" data-live-search="true" title="Floor Name"  >
                                                    <option selected value="">Select Floor</option>
                                                </select>
                                                
                                                <div class="has-error help-block" id="<?php echo $this->lang->line("floorIdAddIer");?>" ></div>
                                            </div>
                                            
                                        </div> 
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <div class="form-group" >
                                                    <label><?php echo $this->lang->line("openingTimeAdd");?></label>
                                                    <div class="input-group date" id="start-time">
                                                        <input class="form-control " name="<?php echo $this->lang->line("openingTimeId");?>" id="<?php echo $this->lang->line("openingTimeId");?>" placeholder="<?php echo $this->lang->line("openingTimePh");?>" type="text" required="" >
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line("closingTimeAdd");?></label>
                                                    <div class="input-group date" id="end-time">
                                                        <input class="form-control" name="<?php echo $this->lang->line("closingTimeId");?>" id="<?php echo $this->lang->line("closingTimeId");?>" placeholder="<?php echo $this->lang->line("closingTimePh");?>" type="text" required="" >
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
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
                                                            <input type="radio" name="<?php echo $this->lang->line("securdepoId");?>" id="<?php echo $this->lang->line("securdepoId");?>" checked class="icheck" value="1" onclick="hideamt('1');"> Yes </label>
                                                        <label>
                                                            <input type="radio" name="<?php echo $this->lang->line("securdepoId");?>" id="<?php echo $this->lang->line("securdepoId");?>" class="icheck deposit" value="0" onclick="hideamt('0');"> No </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="<?php echo $this->lang->line("securamtId");?>_div">
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line("securamtAdd");?></label>
                                                    <div class="">
                                                        <input type="text"  name="<?php echo $this->lang->line("securamtId");?>" id="<?php echo $this->lang->line("securamtId");?>"  class="form-control" value="55" >
                                                    
                                                        <div id="er_<?php echo $this->lang->line("securamtId");?>" class="has-error help-block"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            
                                            <div class="col-md-6 ">
                                            
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line("amenityCostAdd");?></label>
                                                    <div>
                                                        <input id="<?php echo $this->lang->line("amenityCostId");?>" type="text" value="55" name="<?php echo $this->lang->line("amenityCostId");?>" class="form-control">
                                                    </div>
                                                </div>
<!--                                            <div class="form-group">
                                                    <label><?php echo $this->lang->line("amenityCostAdd");?></label>
                                                </div>-->
                                            <!--</div>-->
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line("amenityimgAdd");?></label>
                                                    <div class="">
                                                        <input type="file" accept="<?php echo $this->lang->line('imgTypes');?>" required=""  name="<?php echo $this->lang->line("amenityimgId");?>" id="<?php echo $this->lang->line("amenityimgId");?>" multiple />
                                                        <div id="er_<?php echo $this->lang->line("amenityimgId");?>" class="has-error help-block"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("rulesAdd");?></label>
                                                <div class="">
                                                    <textarea rows="4" class="form-control" placeholder="<?php echo $this->lang->line("rulesPh");?>" name="<?php echo $this->lang->line("rulesId");?>" id="<?php echo $this->lang->line("rulesId");?>"></textarea>
                                                    <div id="er_<?php echo $this->lang->line("rulesId");?>" class="has-error help-block"></div>
                                                </div>
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

