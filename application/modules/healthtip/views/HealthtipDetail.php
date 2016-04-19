<!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container row">
                    <div class="col-md-12 text-success">
                           <?php //echo $this->session->flashdata('message'); ?>                     
                    </div>
                    <div class="clearfix">
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Healthtip Detail</h3>
                            <a href="<?php echo site_url()?>/healthtip" class="btn btn-appointment btn-back waves-effect waves-light pull-right"><i class="fa fa-angle-left"></i> Back</a>

                        </div>
                    </div>

                    <!-- Left Section Start -->
                    <section class="col-md-12 detailbox m-t-10">
                        <div class="clearfix bg-white">
                            <!-- Table Section Start -->

                            <section class="col-md-12">

                                <aside class="clearfix m-bg-pic">


                                    <div class="bg-picture text-center" style="background-image:url('<?php echo base_url().'assets/Health_tipimages/'.$healthtipData[0]->healthTips_image; ?>')">
                                        <div class="bg-picture-overlay"></div>
                                        <div class="profile-info-name">
                                       <div class='pro-img'>
                                                <!-- image -->
                                                <?php if(!empty($healthtipData[0]->healthTips_image)){
                                                    ?>
                                                <img src="<?php echo base_url()?>assets/Health_tipimages/<?php echo $healthtipData[0]->healthTips_image; ?>" alt="" class="logo-img" />
                                               <?php } else { ?>
                                                 <img src="<?php echo base_url()?>assets/images/noImage.png" alt="" class="logo-img" />
                                               <?php } ?>
                                                <article class="logo-up" style="display:none">
                                                    <div class="fileUpload btn btn-sm btn-upload logo-Upload">
                                                        <span><i class="fa fa-cloud-upload fa-3x avatar-view"></i></span>
<!--                                                        <input id="uploadBtn" type="file" class="upload" />-->
                                                         <input type="hidden" style="display:none;" class="no-display" id="file_action_url" name="file_action_url" value="<?php echo site_url('healthtip/editUploadImage');?>">
                                                         <input type="hidden" style="display:none;" class="no-display" id="load_url" name="load_url" value="<?php echo site_url('healthtip/getUpdateAvtar/'.$this->uri->segment(3));?>">
                                                    </div>
                                                </article>
                                                <!-- description div -->
                                                <div class='pic-edit'>
                                                    <h3><a id="picEditClose" class="pull-center cl-white" title="Cancel"  style="display:none;"><i class="fa fa-times"></i></a></h3>
                                                </div>

                                                <!-- end description div -->
                                            </div>

                                            <h3 class="text-white"><?php echo $healthtipData[0]->category_name;?> </h3>
                                            <h4><?php echo $healthtipData[0]->healthTips_detail;?></h4>

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
                                     <h4>HealthTip Detail
                                     <a id="edit" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                                    </h4>
                                    <hr/>
                                        </aside>


                                    <!--Ambulance Provider Detail Starts -->
                                    <div class="map_canvas"></div>
                                    <section class="tab-pane fade in active" id="detail" style="display:<?php echo $detail;?>">
                                        <div class="clearfix m-t-20 p-b-20 doctor-description">
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Category :</label>
                                                <p class="col-md-8 col-sm-8"><?php echo $healthtipData[0]->category_name;?></p>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Healthtip Detail :</label>
                                                <p class="col-md-8 col-sm-8"><?php echo $healthtipData[0]->healthTips_detail ;?></p>
                                            </article>
                                            <article class="clearfix m-b-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Amount:</label>
                                                <p class="col-md-5 col-sm-8"><?php echo $healthtipData[0]->healthTips_amount;?></p>
                                            </article>
                                        </div>
                                    </section>
                                    <!-- Ambulance Provider Detail Ends -->
                                    
                                    <!-- Ambulance Provider Detail in Edit Mode -->
                                     <form name="healthtipDetail" action="<?php echo site_url(); ?>/healthtip/saveDetailHealthtip/<?php echo $healthtipId; ?>" id="healthtipDetail" method="post">
                                    <section id="editdetail" style="display:<?php echo $editdetail;?>">
                                        <div class="clearfix m-t-20 p-b-20 doctor-description">
                                           <article class="form-group m-lr-0">
                                                <label for="cname" class="control-label col-md-4 col-sm-4">Category:</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <aside class="row">
                                                        <div class="col-md-6 col-sm-6">
                                                            <select class="selectpicker" data-width="100%" name="healthtip_category" id="healthtip_category">
                                                               <option value=''>Select Category</option>
                                                               <?php foreach ($AllCategory as $key => $val) { ?>
                                                                <option value="<?php echo $val->category_id; ?>" <?php if($val->category_id==$healthtipData[0]->healthTips_categoryId) echo "selected=selected";?>><?php echo $val->category_name; ?></option>
                                                            <?php } ?> 
                                                              
                                                            </select>
                                                            <label class="error" style="display:none;" id="error-healthtip_category"> please select a Category</label>
                                                            <label class="error" > <?php echo form_error("healthtip_category"); ?></label>
                                                        </div>
                                                    </aside>
                                                </div>
                                            </article>
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Healthtip Detail :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <textarea class="form-control" id="healthtip_detail" name="healthtip_detail" maxlength="500"><?php echo $healthtipData[0]->healthTips_detail;?></textarea>
                                            <label class="error" style="display:none;" id="error-healthtip_detail"> please enter Detail</label>
                                        </div>
                                    </article>
                                           <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4  col-sm-4">Amount:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <aside class="row clone">
                                                <div class="col-lg-7 col-md-6 col-sm-7 col-xs-10 m-t-xs-10">
                                                    <input type="text" class="form-control" name="healthtip_amount" id="healthtip_amount" maxlength="10"  onkeypress="return isNumberKey(event)" value="<?php echo $healthtipData[0]->healthTips_amount;?>"/>
                                                    <label class="error" style="display:none;" id="error-healthtip_amount"> please enter a valid Amount</label>
                                                    <label class="error" > <?php echo form_error("healthtip_amount"); ?></label>
                                                </div>
                                            </aside>
                                            
                                            
                                        </div>
                                    </article>
                                    <article class="clearfix ">
                                        <div class="col-md-12 m-t-20 m-b-20">
                                        <button type="submit" class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" onclick="return validationHealthtipEdit();">Submit</button>
                                        </div>
                                    </article>
                                        </div>
                                        
                                    </section>    
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
                                    <h3>Change Image</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-body">
                                        <div id="messageErrors"></div>
                                        <form class="form-horizontal" id="uploadimage" action="" method="post" enctype="multipart/form-data">

                         <div id="image_preview"> <img id="previewing" src="<?php echo base_url().'assets/Health_tipimages/'.$healthtipData[0]->healthTips_image; ?>" class="img-responsive center-block" /></div>
                         

                                            <article class="form-group m-lr-0 ">
                                                <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Image :</label>
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


