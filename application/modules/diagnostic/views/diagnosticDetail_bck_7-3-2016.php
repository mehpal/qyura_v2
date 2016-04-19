
        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container row">
                    <div class="clearfix">
                         <div class="col-md-12 text-success">
                            <?php echo $this->session->flashdata('message'); ?>
                         </div>
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Diagnostic Centre Detail</h3>
                            <a href="<?php echo site_url('diagnostic');?>" class="btn btn-appointment btn-back waves-effect waves-light pull-right"><i class="fa fa-angle-left"></i> Back</a>
                        </div>
                    </div>
                    <!-- Left Section Start -->
                    <section class="col-md-12 detailbox m-t-10">
                        <div class="bg-white">
                            <!-- Table Section Start -->
                            <section class="col-md-12">
                                <aside class="clearfix m-bg-pic">
                                    
                                    <div class="bg-picture text-center" style="background-image:url('<?php if(isset($diagnosticData) && !empty($diagnosticData[0]->diagnostic_background_img)): echo base_url().'assets/diagnosticsImage/'.$diagnosticData[0]->diagnostic_background_img; endif;?>')">
                                        <div class="bg-picture-overlay"></div>
                                        <div class="profile-info-name">
                                            <div class='pro-img'>
                                                <!-- image -->
                                                <?php if(!empty($diagnosticData[0]->diagnostic_img)){
                                                    ?>
                                                <img src="<?php echo base_url()?>assets/diagnosticsImage/thumb/original/<?php echo $diagnosticData[0]->diagnostic_img; ?>" alt="" class="logo-img" />
                                               <?php } else { ?>
                                                 <img src="<?php echo base_url()?>assets/images/noImage.png" alt="" class="logo-img" />
                                               <?php } ?>
                                                <article class="logo-up" style="display:none">
                                                    <div class="fileUpload btn btn-sm btn-upload logo-Upload">
                                                        <span><i class="fa fa-cloud-upload fa-3x avatar-view"></i></span>
<!--                                                        <input id="uploadBtn" type="file" class="upload" />-->
                                                         <input type="hidden" style="display:none;" class="no-display" id="file_action_url" name="file_action_url" value="<?php echo site_url('diagnostic/editUploadImage');?>">
                                                         <input type="hidden" style="display:none;" class="no-display" id="load_url" name="load_url" value="<?php echo site_url('diagnostic/getUpdateAvtar/'.$this->uri->segment(3));?>">
                                                    </div>
                                                </article>
                                                <!-- description div -->
                                                <div class='pic-edit'>
                                                    <h3><a id="picEdit" class="pull-center cl-white" title="Edit Logo"><i class="fa fa-pencil"></i></a></h3>
                                                    <h3><a id="picEditClose" class="pull-center cl-white" title="Cancel"  style="display:none;"><i class="fa fa-times"></i></a></h3>
                                                </div>

                                                <!-- end description div -->
                                            </div>
                                            <h3 class="text-white"><?php if(!empty($diagnosticData)): echo $diagnosticData[0]->diagnostic_name; endif;?></h3>
                                            <h4><?php if(!empty($diagnosticData)): echo $diagnosticData[0]->diagnostic_address; endif;?></h4>
                                        </div>
                                    </div>
                                    <!--/ meta -->
                                </aside>
                                <section class="clearfix hospitalBtn">
                                    <div class="col-md-12">
                                        <a data-toggle="modal" data-target="#changeBg" class="pull-right cl-white" title="Edit Background"><i class="fa fa-pencil"></i></a>

                                    </div>
                                </section>
                                <article class="text-center clearfix m-t-50">
                                    <ul class="nav nav-tab nav-setting">
                                        <li class="<?php if(isset($active) && $active == 'general'){echo "active";}?>">
                                            <a data-toggle="tab" href="#general">General Detail</a>
                                        </li>
                                        <li class=" <?php if(isset($active) && $active == 'diag'){echo "active";}?>">
                                            <a data-toggle="tab" href="#diagnostic">Diagnostics</a>
                                        </li>
                                        <li class=" <?php if(isset($active) && $active == 'specialities'){echo "active";}?>">
                                            <a data-toggle="tab" href="#specialities">Specialities</a>
                                        </li>
                                        <li class="<?php if(isset($active) && $active == 'gallery'){echo "active";}?>">
                                            <a data-toggle="tab" href="#gallery">Gallery</a>
                                        </li>
                                        <li class="<?php if(isset($active) && $active == 'timeslot'){echo "active";}?>">
                                            <a data-toggle="tab" href="#timeslot">Time Slot</a>
                                        </li>

                                        <li class=" <?php if(isset($active) && $active == 'doctor'){echo "active";}?>">
                                            <a data-toggle="tab" href="#doctor">Doctor</a>
                                        </li>
                                        <li class=" <?php if(isset($active) && $active == 'account'){echo "active";}?>">
                                            <a data-toggle="tab" href="#account">Account</a>
                                        </li>
                                    </ul>
                                </article>
                                <article class="tab-content m-t-50" ng-app="myApp">
                                    <!-- General Detail Starts -->
                                    <section class="tab-pane fade in <?php if(isset($active) && $active == 'general'){echo "active";}?>" id="general">
                                        <article class="detailbox">
                                            <div class="bg-white mi-form-section">
                                                <!-- Table Section End -->
                                                <aside class="clearfix m-t-20 setting">
                                                    <div class="col-md-6">
                                                        <h4>Multispeciality Diagnostic Centre
                                                <a id="editdetail" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                                             </h4>
                                                        <hr/>
                                                        <section id="detail">
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Diagnostic Centre Name:
                                                                </label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"><?php if(!empty($diagnosticData)): echo $diagnosticData[0]->diagnostic_name; endif;?></p>
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Address :</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"><?php if(!empty($diagnosticData)): echo $diagnosticData[0]->diagnostic_address; endif;?></p>
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                <aside class="col-md-8 col-sm-8 t-xs-left">
                                                                   
                                                                     <?php 
                                                                    $explode= explode('|',$diagnosticData[0]->diagnostic_phn); 
                                                                    for($i= 0; $i< count($explode)-1;$i++){?>
                                                                    <p>+<?php echo $explode[$i];?></p>
                                                                   
                                                                    <?php }?>
                                                                </aside>
                                                            </article>

<!--                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">24x7 Emergency :</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left">Available</p>
                                                                
                                                            </article>-->


                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person:</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"><?php if(!empty($diagnosticData)): echo $diagnosticData[0]->diagnostic_cntPrsn; endif;?></p>
                                                            </article>

                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Designation:</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"><?php if(!empty($diagnosticData)): echo $diagnosticData[0]->diagnostic_dsgn; endif;?></p>
                                                            </article>
<div class="map_canvas"></div>
                                                        </section>
                                                        <section id="newDetail" style="display:none;">
                                 <form name="diagnosticForm" action="<?php echo site_url('diagnostic/saveDetailDiagnostic/'.$diagnosticData[0]->diagnostic_id);?>" method="post"> 
                                                   <input type="hidden" id="StateId" name="StateId" value="<?php echo $diagnosticData[0]->diagnostic_stateId;?>" />
                                                     <input type="hidden" id="countryId" name="countryId" value="<?php echo $diagnosticData[0]->diagnostic_countryId;?>" />
                                                     <input type="hidden" id="cityId" name="cityId" value="<?php echo $diagnosticData[0]->diagnostic_cityId;?>" />
                                                     <input type="hidden" id="diagnostic_id" name="diagnostic_id" value="<?php echo $diagnosticData[0]->diagnostic_id;?>" />
                                         <input name="lat" type="hidden" value="<?php echo $diagnosticData[0]->diagnostic_lat;?>">

                                                               <!-- <label>Longitude</label> -->
                                         <input name="lng" type="hidden" value="<?php echo $diagnosticData[0]->diagnostic_long;?>">
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Diagnostic Centre Name:</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <input class="form-control" id="diagnosticCenter" name="diagnostic_name" type="text" required="" value="<?php if(!empty($diagnosticData)): echo $diagnosticData[0]->diagnostic_name; endif;?>">
                                                                    <label class="error" style="display:none;" id="error-diagnostic_name"> please enter diagnostic name only alphabet character's!</label>
                                                                    
                                                                    <div>
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Address :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <aside class="row">
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <select class="selectpicker" data-width="100%" name="diagnostic_countryId" id="diagnostic_countryId">      
                                                                                <option>Select Country</option>
                                                                                <?php if(!empty($allCountry)):
                                                                                    foreach($allCountry as $country):?>
                                                                                
                                                                                    <option value="<?php echo $country->country_id;?>" <?php if($diagnosticData[0]->diagnostic_countryId == $country->country_id):echo"selected";endif;?>><?php echo $country->country;?></option>
                                                                                <?php endforeach;endif;?>
                                                                            </select>
                                                                             <label class="error" style="display:none;" id="error-diagnostic_countryId"> please select a country</label>
                                                    <label class="error" > <?php echo form_error("diagnostic_countryId"); ?></label>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6 m-t-xs-10">
     <select class="selectpicker" data-width="100%" name="diagnostic_stateId" onchange ="fetchCity(this.value)" id="diagnostic_stateId">
                                                                              
                                                                                
       </select>
                                                                        </div>
                                                                    </aside>
                                                                    <aside class="row m-t-10">
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <select class="selectpicker" data-width="100%" name="diagnostic_cityId" id="diagnostic_cityId">
                                                                               
                                                                            </select>
                                                                             <label class="error" style="display:none;" id="error-diagnostic_cityId"> please select a city</label>
                                                     <label class="error" > <?php echo form_error("diagnostic_cityId"); ?></label>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6 m-t-xs-10">
                                                                            <input type="text" class="form-control" id="diagnostic_zip" name="diagnostic_zip" placeholder="700001" value="<?php if(!empty($diagnosticData)): echo $diagnosticData[0]->diagnostic_zip; endif;?>" onkeypress="return isNumberKey(event)"/>
                                                                             <label class="error" style="display:none;" id="error-diagnostic_zip"> please enter a zip code</label>

                                                    <label class="error" > <?php echo form_error("diagnostic_zip"); ?></label>
                                                                        </div>
                                                                    </aside>
                                                                    <div class="clearfix m-t-10">
                                                                        <input type="text" class="form-control" id="geocomplete" name="diagnostic_address" placeholder="209, ABC Road, near XYZ Building " value="<?php if(!empty($diagnosticData)): echo $diagnosticData[0]->diagnostic_address; endif;?>"/>
                                                                        <label class="error" style="display:none;" id="error-diagnostic_address"> please enter an address</label>
                                            <label class="error" > <?php echo form_error("diagnostic_address"); ?></label>
                                                                    </div>
                                                                </div>
                                                            </article>

                                                            <article class="clearfix m-b-10 ">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Numbers :</label>
                                                                
                                                                <div class="col-md-8 col-sm-8">
                                                                     <?php 
                                                                    $explodes= explode('|',$diagnosticData[0]->diagnostic_phn); 
                                                                    for($i= 0; $i< count($explodes)-1;$i++){
                                                                    $moreExpolde = explode(' ',$explodes[$i]);?>
                                                                    <aside class="row">
                                                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                                                            <select class="selectpicker" data-width="100%" name="pre_number[]" id="multiPreNumber1">
                                                                                <option value="91" <?php if($moreExpolde[0] == '91'){ echo 'selected';}?>>+91</option>
                                                                                <option value="1" <?php if($moreExpolde[0] == '1'){ echo 'selected';}?>>+1</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-9 col-sm-9 col-xs-12 m-t-xs-10">
                                                                            <input type="text" class="form-control" name="diagnostic_phn[]" id="diagnostic_phn<?php echo ($i+1);?>" placeholder="9837000123" value="<?php echo $moreExpolde[1];?>" maxlength="10" onkeypress="return isNumberKey(event)"/>
                                                                        </div>


                                                                    </aside>
                                                                    </br>
                                                                       <?php $moreExpolde ='';}?>
                                                                      <label class="error" style="display:none;" id="error-diagnostic_phn1"> please enter a valid phone number</label>
                                                    <label class="error" > <?php echo form_error("diagnostic_phn1"); ?></label>
                                                                    <p class="m-t-10">* If it is landline, include Std code with number </p>
                                                                </div>
                                                            </article>


                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person:</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <input class="form-control" id="diagnostic_cntPrsn" name="diagnostic_cntPrsn" type="text" required="" value="<?php if(!empty($diagnosticData)): echo $diagnosticData[0]->diagnostic_cntPrsn; endif;?>">
                                                                        <label class="error" style="display:none;" id="error-diagnostic_cntPrsn"> please enter the name of a contact person</label>
                                            <label class="error" > <?php echo form_error("diagnostic_cntPrsn"); ?></label>
                                                                    <div>
                                                            </article>

                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Designation :</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <input class="form-control" id="diagnostic_dsgn" name="diagnostic_dsgn" type="text" required="" value="<?php if(!empty($diagnosticData)): echo $diagnosticData[0]->diagnostic_dsgn; endif;?>">
                                                                    <label class="error" style="display:none;" id="error-diagnostic_dsgn"> please enter the name of a contact person designations</label>
                                            <label class="error" > <?php echo form_error("diagnostic_dsgn"); ?></label>
                                                                    <div>
                                                            </article>

                                                            <article class="clearfix ">
                                                                <div class="col-md-12 m-t-20 m-b-20">

                                                                    <button type="submit" class="btn btn-success waves-effect waves-light pull-right" onclick="return validationDiagnosticEdit()">Update</button>
                                                                </div>

                                                            </article>
                                                        </form>
                                                        </section>
                                                        <div class="gap"></div>

                                                      

                                                        </div>
                                                                    
    <div class="col-md-6 p-b-20">
        <article class="clearfix">
                                                                
       <!-- Awards Recognition  -->  
            <article class="clearfix">
                <h4>Awards Recognition
<a id="editawards" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
</h4>
                <hr/>
                <aside class="clearfix" id="detailawards">
                    <ul class="ul-tick" id="loadAwards">

                    </ul>
                       </aside>                                        
                <form id="newawards" style="display:none">
                    <aside class="form-group m-lr-0 p-b-20 m-b-30">
                        <label for="cname" class="control-label col-lg-3 col-sm-4">Awards:</label>
                        <div class="col-lg-9 col-sm-8">
                            <aside class="row">
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    <input type="text" class="form-control" placeholder="FICCI Healthcare Excillence Awards" id="diagnostic_awardsName" name="diagnostic_awardsName"/>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <a onclick="addAwards()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus" title="Add More"></i></a>
                                </div>


                            </aside>
                             <div id="totalAwards">
                                                                               
                             </div>

                        </div>
                    </aside>
                </form>
            </article>
         <!-- Awards Recognition  --> 
            <!-- Services  -->                            
            <aside class="clearfix">
                <h4>Services
  <a id="editservices" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
</h4>
                <hr/>
            </aside>
            <section id="detailservices">
                <ul class="ul-tick" id="loadServices">
 
                </ul>
            </section>
            <form>
                <aside class="form-group m-lr-0" id="newservices" style="display:none">
                    <label for="cname" class="control-label col-lg-3 col-sm-4">Services:</label>
                    <div class="col-lg-9 col-sm-8">
                        <aside class="row">
                              <div class="col-md-10 col-sm-10 col-xs-10">
                                    <input type="text" class="form-control" placeholder="Diagnostic Services" id="diagnostic_serviceName" name="diagnostic_serviceName"/>
                                </div>
                           

                              <div class="col-md-2 col-sm-2 col-xs-2">
                                    <a onclick="addServices()"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus" title="Add More"></i></a>
                                </div>
                           

                        </aside>
                          <div id="totalServices">
                                                                               
                             </div>

                    </div>
                </aside>
            </form>
        </article>
        <!-- Services  -->                            
    </div>
                                                                    
        </aside>
        </div>
</article>
</section>
  <!-- General Detail Ends -->
                       
     <!--diagnostic Starts -->
<section class="tab-pane fade in diagdetail <?php if(isset($active) && $active == 'diag'){echo "active";}?>" id="diagnostic">
    <!-- first Section Start -->
    <aside class="clearfix">
        <section class="col-md-5 detailbox m-b-20 diag" >
            <aside class="bg-white">
                <figure class="clearfix">
                    <h3>Diagnostic Categories Available</h3>
                    <article class="clearfix">
                        <div class="input-group m-b-5">
                            <span class="input-group-btn">
                                <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                            </span>
                            <input type="text" id="search-text1" placeholder="search" class="form-control">
                        </div>
                    </article>
                </figure>
                
                <div class="nicescroll mx-h-400">
                    <div class="clearfix diag-detail">
                        <ul id="list2">
                        </ul>
                    </div>
                </div>
                
            </aside>
        </section>
        <!-- first Section End -->
        <section class="col-md-2 detailbox m-b-20 text-center">
            <div class="m-t-150">
                <a onclick="addDiagnostic()" id="addDiagnosticeArrow"><i class="fa fa-arrow-right s-add"></i></a>
            </div>
            <div class="m-t-50">
                <a onclick="revertDiagnostic()" id="revertDiagnosticeArrow"> <i class="fa fa-arrow-left s-add"></i></a>
            </div>
        </section>
        <!-- second Section Start -->
        <section class="col-md-5 detailbox m-b-20 diag">
            <aside class="bg-white">
                <figure class="clearfix">
                    <h3>Diagnostic Categories Added</h3>
                    <article class="clearfix">
                        <div class="input-group m-b-5">
                            <span class="input-group-btn">
                                <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                            </span>
                            <input type="text" id="search-text" placeholder="search" class="form-control">
                        </div>
                    </article>
                </figure>
                
                <div class="nicescroll mx-h-400">
                    <div class="clearfix diag-detail">
                        <ul id="list3">
                        </ul>
                    </div>
                </div>
                
            </aside>
        </section>
        <!-- second Section End -->
    </aside>
    <section class="clearfix detailbox m-b-20">
        <div class="col-md-8" ng-app="myApp" ng-controller="diag - c - avail">
            <figure class="clearfix">
                <h3>Diagnostic Test Pricing Setup</h3>
                <article class="clearfix">
                    <div class="input-group m-b-5">
                        <span class="input-group-btn">
                            <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                        </span>
                        <input type="text" placeholder="Search" class="form-control" name="example-input1-group2" id="example-input1-group2">
                    </div>
                </article>
            </figure>
            <aside class="table-responsive">
                <table class="table">
                    <col style="width:70%">
                    <col style="width:20%">
                    <col style="width:10%">
                    <tbody>
                        <tr class="border-a-dull">
                            <th>Test Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </tbody>
                </table>
                <article class="nicescroll mx-h-300">
                    <div class="error errorMessage"></div>
                    <div class="successMessage"></div>
                    <table class="table">
                        <col style="width:70%">
                        <col style="width:20%">
                        <col style="width:10%">
                        <tbody id="loadTestDetail">
                 
                       
                        </tbody>
                    </table>
                </article>
            </aside>
        </div>
        <div class="col-md-4">
            <figure class="clearfix">
                <h3 class="pull-left ">Test Preparation Instruction</h3>
            </figure>
            <aside class="clearfix mx-h-400">
                <article class="nicescroll">
                    <p class="p-5" id="detailInstruction">
                    </p>
                    <aside class="clearfix p-5">
                        <a href="#" class="btn btn-success waves-effect waves-light m-b-5 p-abs " data-toggle="modal" data-target="#myModal">Edit</a>
                    </aside>
                </article>
            </aside>
        </div>
    </section>
</section>
<!-- diagnostic Ends -->

<!--Specialities Starts -->
<section class="tab-pane fade in" id="specialities">
    <aside class="clearfix">
        <section class="col-md-5 detailbox m-b-20 diag" >
            <aside class="bg-white">
                <figure class="clearfix">
                    <h3>Specialities Available</h3>
                    <article class="clearfix">
                        <div class="input-group m-b-5">
                            <span class="input-group-btn">
                                <button class="b-search waves-effect waves-light btn-success " type="button"><i class="fa fa-search"></i></button>
                            </span>
                            <input type="text" id="search-text2" placeholder="search" class="form-control">
                        </div>
                    </article>
                </figure>
                <div class="nicescroll mx-h-400">
                    <div class="clearfix diag-detail">
                        <ul id="list4">
                            
                        </ul>
                    </div>
                </div>
            </aside>
        </section>
        <!-- first Section End -->
        <section class="col-md-2 detailbox m-b-20 text-center">
            <div class="m-t-150">
                <a onclick="addSpeciality()"><i class="fa fa-arrow-right s-add"></i></a>
            </div>
            <div class="m-t-50">
                <a onclick="revertSpeciality()"> <i class="fa fa-arrow-left s-add"></i></a>
            </div>
        </section>
        <!-- second Section Start -->
        <section class="col-md-5 detailbox m-b-20 diag">
            <aside class="bg-white">
                <figure class="clearfix">
                    <h3>Specialities Added</h3>
                    <article class="clearfix">
                        <div class="input-group m-b-5">
                            <span class="input-group-btn">
                                <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                            </span>
                            <input type="text" id="search-text3" placeholder="search" class="form-control">
                        </div>
                    </article>
                </figure>
                <div class="nicescroll mx-h-400">
                    <div class="clearfix diag-detail">
                        <ul id="list5">
                            
                        </ul>
                    </div>
                </div>
            </aside>
        </section>
        <!-- second Section End -->
    </aside>
</section>
<!-- Specialities Ends -->         
<!--Gllery Starts -->
<section class="tab-pane fade in <?php if(isset($active) && $active == 'gallery'){echo "active";}?>" id="gallery">
    <div class="fileUpload btn btn-sm btn-upload im-upload">
        <span class="btn btn-appointment avatar-view-gallery" >Add More</span>
<!--                                             <input type="file" class="upload" id="uploadBtn"> -->
    </div>
     <input type="hidden" style="display:none;" class="no-display" id="file_action_url_gallery" name="file_action_url_gallery" value="<?php echo site_url('diagnostic/galleryUploadImage');?>">
     <input type="hidden" style="display:none;" class="no-display" id="load_url_gallery" name="load_url_gallery" value="<?php echo site_url('diagnostic/getGalleryImage/'.$this->uri->segment(3));?>">
    <div class="clearfix" id="display_gallery">

      <?php if(!empty($gallerys)){foreach($gallerys as $gallery){?>
      <aside class="col-md-3 col-sm-4 col-xs-6 show-image">
            <img width="210" class="thumbnail img-responsive" src="<?php echo base_url()?>/assets/diagnosticsImage/thumb/original/<?php echo $gallery->diagonsticImages_ImagesName ?>">
            <a class="delete" onClick="deleteGalleryImage(<?php echo $gallery->diagonsticImages_id ?>)"> <i class="fa fa-times fa-2x"></i></a>
        </aside>
        <?php }}?>
    </div>
</section>
<!--Gallery Ends -->

                                 <!--Timeslot Starts -->
  <section class="tab-pane fade in <?php if(isset($active) && $active == 'timeslot'){echo "active";}?>" id="timeslot">
                                     <div class="col-md-10 p-b-20">
                                         
                                         <?php if(isset($AlltimeSlot) && !empty($AlltimeSlot)):?>
                                             
                                          <form class="form-horizontal" action="<?php echo site_url('diagnostic/UpdateDiagnosticTimeSlot/'.$this->uri->segment(3));?>" method="post" name="timeSlotForm" id="timeSlotForm">
                                             <aside id="session">
                                                 <div id="timeslotError"></div>
                                                 <div class="clearfix"></div>
                                                 <article class="clearfix m-t-10">
                                                     <label for="" class="control-label col-md-4 col-sm-4">Morning Session:</label>                               <input id="morningSession" type="hidden" name="morningSession" class="form-control" value="0" />
                                                     
                                                     <input id="diagnosticId" type="hidden" name="diagnosticId" class="form-control" value="<?php echo $this->uri->segment(3); ?>" />
                                                     <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                         <div class="bootstrap-timepicker input-group w-full">
                                                             <input id="morningStartTime" name="morningStartTime" type="text" class="form-control timepicker" value="<?php echo date('h:i A',strtotime($AlltimeSlot[0]->diagnosticCenterTimeSlot_startTime))?>" />
                                                             <label class="error"> <?php echo form_error('morningStartTime'); ?></label>
                                                         </div>
                                                     </div>
                                                     <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                         <div class="bootstrap-timepicker input-group w-full">
                                                             <input id="morningEndTime" name="morningEndTime" type="text" class="form-control timepicker" value="<?php echo date('h:i A',strtotime($AlltimeSlot[0]->diagnosticCenterTimeSlot_endTime))?>" onBlur="checkTImeSlotValid('morning');" />
                                                             <label class="error"> <?php echo form_error('morningEndTime'); ?></label>
                                                         </div>
                                                     </div>
                                                 </article>
                                                 <article class="clearfix m-t-10">
                                                     <label for="" class="control-label col-md-4 col-sm-4">Afternoon Session :</label>
                                                     <input id="afternoonSession" type="hidden" name="afternoonSession" class="form-control" value="1" />
                                                     <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                         <div class="bootstrap-timepicker input-group w-full">
                                                             <input id="afternoonStartTime" name="afternoonStartTime" type="text" class="form-control timepicker" value="<?php echo date('h:i A',strtotime($AlltimeSlot[1]->diagnosticCenterTimeSlot_startTime))?>" />
                                                             <label class="error"> <?php echo form_error('afternoonStartTime'); ?></label>
                                                         </div>
                                                     </div>
                                                     <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                         <div class="bootstrap-timepicker input-group w-full">
                                                             <input id="afternoonEndTime" name="afternoonEndTime" type="text" class="form-control timepicker" value="<?php echo date('h:i A',strtotime($AlltimeSlot[1]->diagnosticCenterTimeSlot_endTime))?>" />
                                                              <label class="error"> <?php echo form_error('afternoonEndTime'); ?></label>
                                                         </div>
                                                     </div>
                                                 </article>
                                                 <article class="clearfix m-t-10">
                                                     <label for="" class="control-label col-md-4 col-sm-4">Evening Session :</label>
                                                     <input id="eveningSession" type="hidden" name="eveningSession" class="form-control" value="2" />
                                                     <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                         <div class="bootstrap-timepicker input-group w-full">
                                                             <input id="eveningStartTime" name="eveningStartTime" type="text" class="form-control timepicker" value="<?php echo date('h:i A',strtotime($AlltimeSlot[2]->diagnosticCenterTimeSlot_startTime))?>" />
                                                             <label class="error"> <?php echo form_error('eveningStartTime'); ?></label>
                                                         </div>
                                                     </div>
                                                     <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                         <div class="bootstrap-timepicker input-group w-full">
                                                             <input id="eveningEndTime" name="eveningEndTime" type="text" class="form-control timepicker" value="<?php echo date('h:i A',strtotime($AlltimeSlot[2]->diagnosticCenterTimeSlot_endTime))?>" />
                                                             <label class="error"> <?php echo form_error('eveningEndTime'); ?></label>
                                                         </div>
                                                     </div>
                                                 </article>
                                                 <article class="clearfix m-t-10">
                                                     <label for="" class="control-label col-md-4 col-sm-4">Night Session :</label>
                                                     <input id="nightSession" type="hidden" name="nightSession" class="form-control" value="3" />
                                                     <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                         <div class="bootstrap-timepicker input-group w-full">
                                                             <input id="nightStartTime" name="nightStartTime" type="text" class="form-control timepicker" value="<?php echo date('h:i A',strtotime($AlltimeSlot[3]->diagnosticCenterTimeSlot_startTime))?>" />
                                                              <label class="error"> <?php echo form_error('nightStartTime'); ?></label>
                                                         </div>
                                                     </div>
                                                     <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                         <div class="bootstrap-timepicker input-group w-full">
                                                             <input id="nightEndTime" name="nightEndTime" type="text" class="form-control timepicker" value="<?php echo date('h:i A',strtotime($AlltimeSlot[3]->diagnosticCenterTimeSlot_endTime))?>"/>
                                                              <label class="error"> <?php echo form_error('nightEndTime'); ?></label>
                                                         </div>
                                                     </div>
                                                 </article>
                                             </aside>
                                             <article class="clearfix ">
                                                 <div class="col-md-12 m-t-20 m-b-20">
<!--                                                     <button class="btn btn-danger waves-effect pull-right" type="button">Reset</button>-->
                                                     <button class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit">Update</button>
                                                 </div>
                                             </article>
                                         </form>
                                         
                                         <?php else: ?>
                                             
                                              <form class="form-horizontal" action="<?php echo site_url('diagnostic/diagnosticAddTimeSlot/'.$this->uri->segment(3));?>" method="post" name="timeSlotForm" id="timeSlotForm">
                                             <aside id="session">
                                                 <div id="timeslotError"></div>
                                                 <div class="clearfix"></div>
                                                 <article class="clearfix m-t-10">
                                                     <label for="" class="control-label col-md-4 col-sm-4">Morning Session:</label>                               <input id="morningSession" type="hidden" name="morningSession" class="form-control" value="0" />
                                                     
                                                     <input id="diagnosticId" type="hidden" name="diagnosticId" class="form-control" value="<?php echo $this->uri->segment(3); ?>" />
                                                     <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                         <div class="bootstrap-timepicker input-group w-full">
                                                             <input id="morningStartTime" name="morningStartTime" type="text" class="form-control timepicker" value="06:00 AM" onBlur="checkTImeSlotValid('morning');"/>
                                                             <label class="error"> <?php echo form_error('morningStartTime'); ?></label>
                                                         </div>
                                                     </div>
                                                     <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                         <div class="bootstrap-timepicker input-group w-full">
                                                             <input id="morningEndTime" name="morningEndTime" type="text" class="form-control timepicker" value="11:59 AM" onBlur="checkTImeSlotValid('morning');"/>
                                                             <label class="error"> <?php echo form_error('morningEndTime'); ?></label>
                                                         </div>
                                                     </div>
                                                 </article>
                                                 <article class="clearfix m-t-10">
                                                     <label for="" class="control-label col-md-4 col-sm-4">Afternoon Session :</label>
                                                     <input id="afternoonSession" type="hidden" name="afternoonSession" class="form-control" value="1" />
                                                     <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                         <div class="bootstrap-timepicker input-group w-full">
                                                             <input id="afternoonStartTime" name="afternoonStartTime" type="text" class="form-control timepicker" value="12:00 PM" onBlur="checkTImeSlotValid('afternoon');"/>
                                                             <label class="error"> <?php echo form_error('afternoonStartTime'); ?></label>
                                                         </div>
                                                     </div>
                                                     <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                         <div class="bootstrap-timepicker input-group w-full">
                                                             <input id="afternoonEndTime" name="afternoonEndTime" type="text" class="form-control timepicker" value="05:59 PM" onBlur="checkTImeSlotValid('afternoon');"/>
                                                              <label class="error"> <?php echo form_error('afternoonEndTime'); ?></label>
                                                         </div>
                                                     </div>
                                                 </article>
                                                 <article class="clearfix m-t-10">
                                                     <label for="" class="control-label col-md-4 col-sm-4">Evening Session :</label>
                                                     <input id="eveningSession" type="hidden" name="eveningSession" class="form-control" value="2" />
                                                     <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                         <div class="bootstrap-timepicker input-group w-full">
                                                             <input id="eveningStartTime" name="eveningStartTime" type="text" class="form-control timepicker" value="06:00 PM" onBlur="checkTImeSlotValid('evening');"/>
                                                             <label class="error"> <?php echo form_error('eveningStartTime'); ?></label>
                                                         </div>
                                                     </div>
                                                     <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                         <div class="bootstrap-timepicker input-group w-full">
                                                             <input id="eveningEndTime" name="eveningEndTime" type="text" class="form-control timepicker" value="10:59 PM" onBlur="checkTImeSlotValid('evening');"/>
                                                             <label class="error"> <?php echo form_error('eveningEndTime'); ?></label>
                                                         </div>
                                                     </div>
                                                 </article>
                                                 <article class="clearfix m-t-10">
                                                     <label for="" class="control-label col-md-4 col-sm-4">Night Session :</label>
                                                     <input id="nightSession" type="hidden" name="nightSession" class="form-control" value="3" />
                                                     <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                         <div class="bootstrap-timepicker input-group w-full">
                                                             <input id="nightStartTime" name="nightStartTime" type="text" class="form-control timepicker" value="11:00 PM" onBlur="checkTImeSlotValid('night');"/>
                                                              <label class="error"> <?php echo form_error('nightStartTime'); ?></label>
                                                         </div>
                                                     </div>
                                                     <div class="col-md-4 col-sm-4 m-tb-xs-5">
                                                         <div class="bootstrap-timepicker input-group w-full">
                                                             <input id="nightEndTime" name="nightEndTime" type="text" class="form-control timepicker" value="04:59 AM" onBlur="checkTImeSlotValid('night');"/>
                                                              <label class="error"> <?php echo form_error('nightEndTime'); ?></label>
                                                         </div>
                                                     </div>
                                                 </article>
                                             </aside>
                                             <article class="clearfix ">
                                                 <div class="col-md-12 m-t-20 m-b-20">
<!--                                                     <button class="btn btn-danger waves-effect pull-right" type="button">Reset</button>-->
                                                     <button class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit" onclick="return checkTImeSlotValid()">Submit</button>
                                                 </div>
                                             </article>
                                         </form>
                                         <?php  endif;?>
                                     </div>
                                 </section>
                                 <!-- Timeslot Ends -->
                                 
                                    <!--Staff and Permission Starts -->
                                    <section class="tab-pane fade in <?php if(isset($active) && $active == 'doctor'){echo "active";}?>" id="doctor">
                                        <article class="clearfix m-top-40 p-b-20">
                                            <aside class="table-responsive">
                                                <table class="table all-doctor" id="diagnostic_doctors" style="width:100%">
                                                    <thead>
                                                        <tr class="border-a-dull">
                                                            <th>Photo</th>
                                                            <th>Name and Id</th>
                                                             <th>Speciality</th>
                                                            <th>Consulting fee</th>
                                                            <th>Experience</th>
                                                            <th>Phone</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </aside>
                                        </article>

                                    </section>
                                    <!-- Staff and Permission Ends -->

                                    <!--Account Starts -->
                                    <section class="tab-pane fade in <?php if(isset($active) && $active == 'account'){echo "active";}?>" id="account">
                                    <form method="post" name="acccountForm" id="acccountForm">
                                        <p class="text-success" style="display:none;" id="error-password_email_check_success"> Data Changed Successfully!</p>
                                        <aside class="col-md-9 setting">
                                            <h4>Account Detail
                                                <a id="editac"  class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                                            </h4>
                                            <hr/>
                                            <div class="clearfix m-t-20 p-b-20 doctor-description" id="detailac">
                                                <article class="clearfix m-b-10">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-5">Registered Email Id :</label>
                                                    <p class="col-md-8 col-sm-7"><?php if(!empty($diagnosticData)): echo $diagnosticData[0]->users_email; endif;?></p>
                                                </article>
                                                <article class="clearfix m-b-10">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-5">Registered Mobile Number:</label>
                                                    <p class="col-md-8 col-sm-7"> 
                                                              
                                                   <?php if(isset($diagnosticData[0]->users_mobile)): echo $diagnosticData[0]->users_mobile; endif;?>
                                                                   </p>
                                                </article>
                                                <article class="clearfix m-b-10">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-5">Membership Type:</label>
                                                    <p class="col-md-6 col-sm-5"><?php if(!empty($diagnosticData)){ if($diagnosticData[0]->diagnostic_mbrTyp == 1){
                                                    	echo"Life Time";
                                                    }else{echo "Health Club";}};?></p>
<!--                                                     <aside class="col-sm-2"> -->
<!--                                                         <button class="btn btn-appointment waves-effect waves-light pull-right" type="button">Upgrade</button> -->
<!--                                                     </aside> -->
                                                </article>
<!--                                                 <article class="clearfix m-b-10"> -->
<!--                                                     <label for="cemail" class="control-label col-md-4 col-sm-5">Change Password:</label> -->

<!--                                                     <aside class="col-md-5 col-sm-6"> -->
<!--                                                         <form class=""> -->
<!--                                                             <input type="password" name="password" class="form-control" placeholder="New Password" /> -->
<!--                                                         </form> -->
<!--                                                     </aside> -->
<!--                                                 </article> -->
                                            </div>
                                            <aside id="newac" style="display:none">
                                                <article class="clearfix m-b-10">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Registered Email Id :</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <input class="form-control" id="users_email" name="users_email" type="text" value="<?php if(!empty($diagnosticData)): echo $diagnosticData[0]->users_email; endif;?>" onblur="checkEmailFormat()" required="">
                                                        <label class="error" style="display:none;" id="error-users_email"> please enter Email id Properly</label>
                                            <label class="error" style="display:none;" id="error-users_email_check"> Email Already Exits!</label>
                                            <label class="error" > <?php echo form_error("users_email"); ?></label>
                                                        <div>
                                                </article>
                                                
						<input type="hidden" id="user_tables_id" name="user_table_id" value="<?php if(!empty($diagnosticData)): echo $diagnosticData[0]->diagnostic_usersId; endif;?>"/>
                                                
                                                
                                                     <article class="clearfix m-b-10 ">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Mobile Numbers :</label>
                                                    <div class="col-md-8 col-sm-8">
                                                   
                                                         
                                                <input type="teL" class="form-control" name="users_mobile" id="users_mobile" placeholder="9837000123" onkeypress="return isNumberKey(event)" value="<?php if(isset($diagnosticData[0]->users_mobile)){ echo $diagnosticData[0]->users_mobile; } ?>" />
                                                                   <label class="error" id="error-users_mobile" style="display:none;"> Enter Mobile Number</label>
                                                         
                                                            <!--<p class="m-t-10">* If it is landline, include Std code with number </p> -->
                                                       
                                                    </div>
                                                </article>
                                                
                                                
                                                
                                                
                                                <article class="clearfix m-b-10">
                                                    <label for="cname" class="control-label col-md-4 col-sm-4">Membership Type:</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <select class="selectpicker" data-width="100%" name="diagnostic_mbrTyp">
                                                            <option value="1" <?php if(!empty($diagnosticData)){ if($diagnosticData[0]->diagnostic_mbrTyp == 1){
                                                    	echo"selected";
                                                    }}?>>Life Time</option>
                                                            <option value="2" <?php if(!empty($diagnosticData)){ if($diagnosticData[0]->diagnostic_mbrTyp == 2){
                                                    	echo"selected";
                                                    }}?>>Health Club</option>

                                                        </select>
                                                    </div>
                                                </article>
                                            <article class="clearfix m-b-10">
                                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Change Password:</label>

                                                    <aside class="col-md-8 col-sm-8">
                                                      
                                                            <input type="password" name="users_password" id="users_password" class="form-control" placeholder="New Password" />
                                                             <label class="error" style="display:none;" id="error-users_password"> please enter password and should be 6 character </label>
                                                    </aside>
                                                </article>
                                               <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-5">Confirm Password:</label>

                                                <aside class="col-md-8 col-sm-8">
                                                   
                                                    <input type="password" name="cnfPassword" class="form-control" placeholder="Confirm Password" id="cnfPassword" />
                                                   
                                                    <!--<p><a class="m-t-10" href="javascript:void(0)" onclick="updatePassword()">Edit</a></p> -->
                                                     <label class="error" style="display:none;" id="error-cnfPassword"> Password and confirm password should be same </label>
                                                  
                                                   
                                                </aside>
                                            </article>


                                                <article class="clearfix ">
                                                    <div class="col-md-12 m-t-20 m-b-20">

                                                        <input type="button" name="submit" class="btn btn-success waves-effect waves-light pull-right" value="Update" onclick="updateAccount()">
                                                    </div>

                                                </article>
                                            </aside>
						</form>	
                                    </section>
                                    <!-- Account Ends -->

                                </article>
                            </section>
                            <!-- Table Section End -->
                            <article class="clearfix">
                            </article>
                            </div>
                    </section>
                    <!-- Left Section End -->
                    </div>
                    <!-- container -->
                    </div>
                    <!-- content -->
                    
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Edit Detail</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="messageUpdateIns"></div>
                                    <input type='hidden' name="quotationDetailTestsIns_id" id="quotationDetailTestsIns_id" />
                                    <label>Instruction</label>
                                    <textarea rows="6" cols="10" type="text" class="form-control" name="quotationDetailTests_instruction_name" id="quotationDetailTests_instruction_name"></textarea>
                                </div>
                                <div class="modal-footer p-t-10">
                                    <button type="button" class="btn btn-appointment" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-success" onClick="updateDiagnosticTest()">Update</button>
                                </div>
                            </div>
                     
                        </div>
                    </div>
                    <!-- end modal -->
                    <!--Change Logo-->
                    <div id="changeBg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3>Change Background</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-body">
                                        <div id="messageErrors"></div>
                                        <form class="form-horizontal" id="uploadimage" action="" method="post" enctype="multipart/form-data">

                         <div id="image_preview"> <img id="previewing" src="<?php echo base_url();?>assets/images/hospital.jpg" class="img-responsive center-block" /></div>
                         

                                            <article class="form-group m-lr-0 ">
                                                <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Background :</label>
                                                <div class="col-md-8 col-sm-8 text-right">
                                                    <input disabled="disabled" class="showUpload" id="uploadFileDd" >
                                                    <div class="fileUpload btn btn-sm btn-upload">
                                                        <span><i class="fa fa-cloud-upload fa-3x"></i></span>
                                                        <input type="file" name="file" class="upload" id="uploadBtnDd">
                                                    </div>
                                                </div>
                                            </article>
<!--<h4 id='loading' >loading..</h4>-->
                                            <article class="clearfix m-t-20">
                                                <button type="submit" name="submit" class="btn btn-primary pull-right waves-effect waves-light bg-btn m-r-20">Upload</button>
                                            </article>
                                        </form>
                                    </div>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    </div>
                    <!-- /Change Logo -->
                    <!-- END wrapper -->
                    <?php echo $this->load->view('edit_upload_crop_modal');?>
                    <?php echo $this->load->view('edit_gallery_crop_modal');?>
