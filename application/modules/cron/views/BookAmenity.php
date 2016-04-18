
<style>
    .wizard-big.wizard > .content {
        min-height: 206px !important;
    }
    select .bs-select  {
        display: block !important;
        float: left;
        overflow: hidden; 
        height: 1px;
        width: 0;
        border: 0; 
        padding: 0; 
        box-shadow: none; 
        color: red; 
    }
    .wizard > .content > .body ul:required:focus {
        list-style: none !important;
    }
    select.bs-select:required:focus, .wizard > .content > .body ul:required:focus {
        width: auto;
    }
    .text-left{
        text-align: left !important;
    }    
    .wizard > .steps > ul > li{
        width: 25% !important;
    }
    #rulesSection{
        height: 150px;
        margin-bottom: 5px;
        
    }
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5><?php echo $this->lang->line("bookingTitleAdd");?></h5>
            </div>
            <div class="ibox-content">
                <div class="col-md-12">
                    
                    <div class="alert alert-success" id="bookingSuccess" style="display: none"></div>
                    <div class="alert alert-danger" id="er_TopError" style="display: none"></div>
<!--                    <div id="bookingLoad" class="progress progress-striped active">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 00%"></div>
                    </div>-->
                </div>
                <form id="addNewBooking" action="#" class="wizard-big">
                    <h1><?php echo $this->lang->line("step1");?></h1>
                     <fieldset>
                        <h2><?php echo $this->lang->line("step1Detail");?></h2>
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="form-group col-md-6">
                                    <label><?php echo $this->lang->line("fkUserIdAdd");?> *</label>
                                    <select name="<?php echo $this->lang->line("fkUserIdAddN");?>" id="<?php echo $this->lang->line("fkUserIdAddN");?>" class="bs-select form-control required" data-live-search="true" title="<?php echo $this->lang->line("userIdPh");?>" data-size="2" >
                                        <option  value="" >All Users With Flats</option>
                                            <?php  if(isset($flats) && $flats != NULL){
                                                        foreach ($flats as $flat) {    ?>
                                                            <option  data-content="<span class='label label-info'><?php echo $flat->flatName; ?></span> <span class='label label-warning-light'><?php echo $flat->username; ?></span>" data-subtext="<?php echo $flat->username; ?>" value="<?php echo $flat->userId; ?>">
                                                            <?php echo $flat->flatName; ?>&nbsp;-&nbsp;<?php echo $flat->username; ?></option>
                                            <?php      }
                                                    } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 ">
                                    <label><?php echo $this->lang->line("fkAmenityIdAdd");?> *</label>
                                    <select name="<?php echo $this->lang->line("fkAmenityIdAddN");?>" id="<?php echo $this->lang->line("fkAmenityIdAddI");?>" class="bs-select form-control required " data-live-search="true" title="<?php echo $this->lang->line("fkAmenityIdAddPlcHo");?>" data-size="2" >
                                    <option value="">Select amenity</option>
                                    <?php 
                                        if($amenityList){ 
                                            foreach ($amenityList as $am){
                                    ?>
                                    <option value="<?php echo $am->amenityId ?>"><?php echo $am->amenityName ?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label><?php echo $this->lang->line("phoneAddN");?>*</label>
                                    <input id="<?php echo $this->lang->line("phone");?>" name="<?php echo $this->lang->line("phone");?>" type="text" class="form-control " required maxlength="12" placeholder="<?php echo $this->lang->line("phonePho");?>">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="text-center">
                                    <div>
                                        <i class="fa fa-sign-in" style="font-size: 150px;color: #e5e5e5 "></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </fieldset>

                  
                    <h1><?php echo $this->lang->line("step2");?></h1>
                    <fieldset>
                        <h2><?php echo $this->lang->line("step2Detail");?></h2>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group col-md-6" id="data_1">
                                    <label><?php echo $this->lang->line("amenityTime");?></label>
                                    <div id="start-time" class="input-group date">
                                        <input type="text" class="form-control" placeholder="<?php echo $this->lang->line("amenityTimeAddPI");?>" name="<?php echo $this->lang->line("amenityTimeAddN");?>" id="<?php echo $this->lang->line("amenityTimeAddI");?>" data-trigger="focus" required=""/>
                                        <!--<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>-->
                                    </div>
                                </div>
                                <div class="form-group col-md-6" id="data_2">
                                    <label><?php echo $this->lang->line("amenityEndTime");?></label>
                                    <div class="input-group date" id="end-time">
                                        <input type="text" class="form-control" placeholder="<?php echo $this->lang->line("amenityEndTimeAddPI");?>" name="<?php echo $this->lang->line("amenityEndTimeAddN");?>" id="<?php echo $this->lang->line("amenityEndTimeAddI");?>"    data-trigger="focus" required=""/>
                                        <!--<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>-->
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label><?php echo $this->lang->line("amenityDate");?></label>
                                    <div id="statusDate" class="form-group">
                                        <div class="input-daterange" id="datepicker">
                                            <input placeholder="<?php echo $this->lang->line("amenityDateAddPl");?>" name="<?php echo $this->lang->line("amenityDateAddN");?>" id="<?php echo $this->lang->line("amenityDateAddI");?>" type="date" class=" form-control text-left" value="<?php echo date("Y-m-d"); ?>" required="" />
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </fieldset>
 
                    <h1><?php echo $this->lang->line("step3");?></h1>
                    <fieldset>
                        <h2><?php echo $this->lang->line("step3Detail");?></h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line("amenityPay");?></label>
                                    <div class="icheck-inline">
                                        <label class="col-md-5 inline">
                                            <input type="radio" name="<?php echo $this->lang->line("amenityPayOption");?>" checked class="icheck inline" value="1" onclick="payOption('1')" > Check </label>&nbsp;&nbsp;&nbsp;
                                        <label class="col-md-5 inline">
                                             <input type="radio" name="<?php echo $this->lang->line("amenityPayOption");?>"  class="icheck deposit inline" value="0" onclick="payOption('0')" > Online </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" id="<?php echo $this->lang->line("checkIdAddI");?>">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line("checkIdAdd");?></label>
                                    <div class="input-group inline">
                                        <input type="text" maxlength="20" class="form-control" placeholder="<?php echo $this->lang->line("checkIdAddPlcHo");?>" name="<?php echo $this->lang->line("checkIdAddN");?>" id="<?php echo $this->lang->line("checkIdAddI");?>" />
                                        <div id="er_<?php echo $this->lang->line("checkIdAddI");?>" class="has-error help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" id="<?php echo $this->lang->line("onlineIdAddI");?>" style="display: none;">
                                <div class="form-group">
                                    <label ><?php echo $this->lang->line("onlineIdAdd");?></label>
                                    <div class="input-group inline" style="margin-top: 20px">&nbsp;&nbsp;
                                        <button  class="btn btn-primary" name="<?php echo $this->lang->line("onlineIdAddN");?>" id="<?php echo $this->lang->line("onlineIdAddI");?>" >Pay Online</button>
                                        <div id="er_<?php echo $this->lang->line("amenityNameId");?>" class="has-error help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </fieldset>

                    <h1><?php echo $this->lang->line("step4");?></h1>
                    <fieldset>
                        <h2><?php echo $this->lang->line("step4Detail");?></h2>
                        
                        <div class="row">
                            
                            <div class="col-md-12" >
                                <span id="rulesSection" class="no-borders    "></span>
                            </div>
                            
                        </div>
                        <input id="<?php echo $this->lang->line("acceptTerms");?>" name="<?php echo $this->lang->line("acceptTerms");?>" type="checkbox" class="required"> &nbsp;&nbsp;&nbsp; <label for="acceptTerms" >I agree with the Terms and Conditions.</label>
                        
                    </fieldset>
                </form>
            </div>
        </div>
        </div>

    </div>

