<!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container row">
                    <div class="col-md-12 text-success">
                           <?php echo $this->session->flashdata('message'); ?>                     
                    </div>
                    <div class="clearfix">
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Ambulance Provider Detail</h3>
                            <a href="all-ambulance-provider.html" class="btn btn-appointment btn-back waves-effect waves-light pull-right"><i class="fa fa-angle-left"></i> Back</a>

                        </div>
                    </div>

                    <!-- Left Section Start -->
                    <section class="col-md-12 detailbox m-t-10">


                        <div class="clearfix bg-white">
                            <!-- Table Section Start -->

                            <section class="col-md-12">

                                <aside class="clearfix m-bg-pic">


                                    <div class="bg-picture text-center" style="background-image:url('<?php if(isset($backgroundImage) && !empty($backgroundImage)): echo base_url().'assets/ambulanceImages/'.$backgroundImage[0]->ambulance_background_img; endif;?>')">
                                        <div class="bg-picture-overlay"></div>
                                        <div class="profile-info-name">
                                       <div class='pro-img'>
                                                <!-- image -->
                                                <?php if(!empty($ambulanceData[0]->ambulance_img)){
                                                    ?>
                                                <img src="<?php echo base_url()?>assets/ambulanceImages/thumb/original/<?php echo $ambulanceData[0]->ambulance_img; ?>" alt="" class="logo-img" />
                                               <?php } else { ?>
                                                 <img src="<?php echo base_url()?>assets/images/noImage.png" alt="" class="logo-img" />
                                               <?php } ?>
                                                <article class="logo-up" style="display:none">
                                                    <div class="fileUpload btn btn-sm btn-upload logo-Upload">
                                                        <span><i class="fa fa-cloud-upload fa-3x avatar-view"></i></span>
<!--                                                        <input id="uploadBtn" type="file" class="upload" />-->
                                                         <input type="hidden" style="display:none;" class="no-display" id="file_action_url" name="file_action_url" value="<?php echo site_url('ambulance/editUploadImage');?>">
                                                         <input type="hidden" style="display:none;" class="no-display" id="load_url" name="load_url" value="<?php echo site_url('ambulance/getUpdateAvtar/'.$this->uri->segment(3));?>">
                                                    </div>
                                                </article>
                                                <!-- description div -->
                                                <div class='pic-edit'>
                                                    <h3><a id="picEdit" class="pull-center cl-white" title="Edit Logo"><i class="fa fa-pencil"></i></a></h3>
                                                    <h3><a id="picEditClose" class="pull-center cl-white" title="Cancel"  style="display:none;"><i class="fa fa-times"></i></a></h3>
                                                </div>

                                                <!-- end description div -->
                                            </div>

                                            <h3 class="text-white"><?php echo $ambulanceData[0]->ambulance_name;?> </h3>
                                            <h4><?php echo $ambulanceData[0]->ambulance_address;?></h4>

                                        </div>

                                    </div>
                                    <!--/ meta -->

                                </aside>
                                <section class="clearfix hospitalBtn">
                                    <div class="col-md-12">
                                        <a data-toggle="modal" data-target="#changeBg" class="pull-right cl-white" title="Edit Background"><i class="fa fa-pencil"></i></a>

                                    </div>

                                </section>
                                <article class="col-md-8 m-t-50">
                                    <aside class="clearfix amb-detail">
                                     <h4>Ambulance Provider Detail
                                     <a id="edit" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                                    </h4>
                                    <hr/>
                                        </aside>


                                    <!--Ambulance Provider Detail Starts -->
                                    <div class="map_canvas"></div>
                                    <section class="tab-pane fade in active" id="detail" style="display:<?php echo $detail;?>">
                                        <div class="clearfix m-t-20 p-b-20 doctor-description">
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Ambulance Provider Name:</label>
                                                <p class="col-md-8 col-sm-8"><?php echo $ambulanceData[0]->ambulance_name;?></p>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Provider Type :</label>
                                                <p class="col-md-8 col-sm-8"><?php if($ambulanceData[0]->ambulanceType == 1){ echo 'Trauma Medicines'; } else { echo 'General Medicines';}?></p>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Address:</label>
                                                <p class="col-md-5 col-sm-8"><?php echo $ambulanceData[0]->ambulance_address;?></p>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Number:</label>
                                                <aside class="col-md-4 col-sm-4">
                                                 <?php 
                                                    $explode= explode('|',$ambulanceData[0]->ambulance_phn); 
                                                    for($i= 0; $i< count($explode);$i++){?>
                                                    <p>+ <?php echo $explode[$i];?></p>
                                                    <?php }?>
                                                </aside>
                                                <!--<p class="col-md-8 col-sm-8">+91 731 7224401</p>-->
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Mobile Number:</label>
                                                <p class="col-md-8 col-sm-8">+91 <?php if($ambulanceData[0]->users_mobile){ echo $ambulanceData[0]->users_mobile;}?></p>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person Name:</label>
                                                <p class="col-md-8 col-sm-8"><?php echo $ambulanceData[0]->ambulance_cntPrsn;?></p>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Membership Type:</label>
                                                <p class="col-md-8 col-sm-8"><?php if($ambulanceData[0]->ambulance_mmbrTyp == 1){ echo 'Life Time'; } else { echo 'Health Club';}?></p>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">24/7 Service - Yes/No :</label>
                                                <p class="col-md-8 col-sm-8"><?php if($ambulanceData[0]->ambulance_27Src == 1){ echo 'Yes'; } else { echo 'No';}?></p>
                                            </article>

                                        </div>
                                    </section>
                                    <!-- Ambulance Provider Detail Ends -->
                                    
                                    <!-- Ambulance Provider Detail in Edit Mode -->
                                     <form name="ambulanceDetail" action="<?php echo site_url(); ?>/ambulance/saveDetailAmbulance/<?php echo $ambulanceId; ?>" id="ambulanceDetail" method="post">
                                    <section id="editdetail" style="display:<?php echo $editdetail;?>">
                                        <div class="clearfix m-t-20 p-b-20 doctor-description">
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Ambulance Provider Name:</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input class="form-control" id="ambulance_name" name="ambulance_name" type="text"  value="<?php echo $ambulanceData[0]->ambulance_name;?>">
                                                    <label class="error" > <?php echo form_error("ambulance_name"); ?></label>
                                                    <label class="error" style="display:none;" id="error-ambulance_name"> please enter ambulance name</label>
                                                           
                                                </div>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Provider Type :</label>
                                                 <div class="col-md-8 col-sm-8">
                                                    <select class="selectpicker" data-width="100%" name="ambulanceType">
                                                        <option value='1' <?php if($ambulanceData[0]->ambulanceType == 1){ echo 'selected';}?>>Trauma Medicines</option>
                                                        <option value='2' <?php if($ambulanceData[0]->ambulanceType == 2){ echo 'selected';}?>>General Medicines</option>
                                                    </select>
                                                     <label class="error" > <?php echo form_error("ambulanceType"); ?></label>
                                                </div>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Address:</label>
                                              <div class="col-md-8 col-sm-8">
                                          
                                            <div class="clearfix m-t-10">
                                           
                                            <textarea class="form-control" id="geocomplete" name="ambulance_address" type="text" ><?php if(isset($ambulanceData[0]->ambulance_address)){ echo $ambulanceData[0]->ambulance_address; }?></textarea>
                                             <label class="error" style="display:none;" id="error-ambulance_address"> please enter address</label>
                                            <label class="error" > <?php echo form_error("ambulance_address"); ?></label>
                                            </div>
                                        </div>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Phone Number:</label>
                                               <div class="col-md-8 col-sm-8">
                                                   <?php 
                                                        $explodes= explode('|',$ambulanceData[0]->ambulance_phn); 
                                                        for($i= 0; $i< count($explodes);$i++){
                                                        $moreExpolde = explode(' ',$explodes[$i]);
                                                   ?>
                                                    <aside class="row">
                                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                                            <select class="selectpicker" data-width="100%" name="pre_number[]">
                                                                <option value="91" <?php if($moreExpolde[0] == '91'){ echo 'selected';}?>>+91</option>
                                                                <option value="1" <?php if($moreExpolde[0] == '1'){ echo 'selected';}?>>+1</option>
                                                            </select>
                                                        </div>
                                                        
                                                        <div class="col-md-6 col-sm-6 col-xs-10 m-t-xs-10">
                                                            <input type="text" class="form-control" name="ambulance_phn[]" id="ambulance_phn<?php echo $i;?>" placeholder="9837000123" value="<?php echo $moreExpolde[1];?>" maxlength="10" onblur="checkNumber(<?php echo $i;?>)" onkeypress="return isNumberKey(event)"/>
                                                           <label class="error" style="display:none;" id="error-ambulance_phn"> please enter phone number</label>          
                                                        </div>

                                                    </aside>
                                                    <?php $moreExpolde ='';}?>
                                                    <br />
                                                </div>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Mobile Number:</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <aside class="row">
                                                       <!-- <div class="col-md-3 col-sm-3 col-xs-12">
                                                            <select class="selectpicker" data-width="100%">
                                                                <option selected>+91</option>
                                                                <option>+1</option>
                                                            </select>
                                                        </div> -->
                                                        <div class="col-md-9 col-sm-9 col-xs-12 m-t-xs-10">
                                                            <input type="text" class="form-control" name="users_mobile" id="users_mobile" value="<?php if(isset($ambulanceData[0]->users_mobile)){ echo $ambulanceData[0]->users_mobile;}?>" onkeypress="return isNumberKey(event)"/>
                                                            <label class="error" > <?php echo form_error("users_mobile"); ?></label>   
                                                             <label class="error" style="display:none;" id="error-users_mobile"> please enter mobile number</label>          
                                                        </div>


                                                    </aside>
                                                </div>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Contact Person Name:</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input class="form-control" id="ambulance_cntPrsn" name="ambulance_cntPrsn" type="text" required="" value="<?php echo $ambulanceData[0]->ambulance_cntPrsn;?>">
                                                    <label class="error" > <?php echo form_error("ambulance_cntPrsn"); ?></label>   <label class="error" style="display:none;" id="error-ambulance_cntPrsn"> please enter contact person name</label>          
                                                </div>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Membership Type:</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <select class="selectpicker" data-width="100%" name="ambulance_mbrTyp" id="ambulance_mbrTyp">
                                                        <option value="1" <?php if($ambulanceData[0]->ambulance_mmbrTyp == 1){ echo 'selected';}?>>Life Time</option>
                                                        <option value="2" <?php if($ambulanceData[0]->ambulance_mmbrTyp == 2){ echo 'selected';}?>>Health Club</option>
                                                    </select>
                                                </div>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">24/7 Service - Yes/No :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <aside class="radio radio-info radio-inline">
                                                        <input type="radio" id="inlineRadio1" value="1" name="ambulance_27Src" <?php if($ambulanceData[0]->ambulance_27Src == 1){ echo 'checked'; }?> />
                                                        <label for="inlineRadio1"> Yes</label>
                                                    </aside>
                                                    <aside class="radio radio-info radio-inline">
                                                        <input type="radio" id="inlineRadio2" value="0" name="ambulance_27Src" <?php if($ambulanceData[0]->ambulance_27Src == 0){ echo 'checked'; }?> >
                                                        <label for="inlineRadio2"> No</label>
                                                    </aside>
                                                </div>
                                            </article>
                                            <article class="clearfix ">
                                                <div class="col-md-12 m-t-20 m-b-20">
                                                <button type="submit" class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" onclick="return validationAmbulanceEdit();">Submit</button>
                                                </div>
                                            </article>
                                        </div>
                                    </section>
                                        <fieldset>
                                            <input name="lat" type="hidden" value="<?php echo $ambulanceData[0]->ambulance_lat;?>">
                                            <input name="lng" type="hidden" value="<?php echo $ambulanceData[0]->ambulance_long;?>">
                                            <input name="user_tables_id" id="user_tables_id" type="hidden" value="<?php echo $ambulanceData[0]->ambulance_usersId;?>">
                                       </fieldset>      
                                     </form>     
                                     <!-- Ambulance Provider Detail in Edit Mode -->

                                </article>

                            </section>
                            <!-- General Detail Ends -->


                    </div>

                    </section>
                    <!-- Left Section End -->
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

                </div>

                <!-- container -->
                <?php echo $this->load->view('edit_upload_crop_modal');?>


