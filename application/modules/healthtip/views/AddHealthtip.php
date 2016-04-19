 <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">


                    <div class="clearfix">
                        <div class="col-md-12 text-success">
                            <?php //echo $this->session->flashdata('message'); ?>
                        </div>
                        <div class="col-md-12 text-danger">
                            <?php echo validation_errors(); ?>
                        </div>
                        
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Add New HealthTip</h3>

                        </div>
                    </div>
                    <div class="map_canvas"></div>
                     <form class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" name="submitForm" method="post" action="<?php echo site_url(); ?>/healthtip/SaveHealthtip" novalidate="novalidate" enctype="multipart/form-data" >
                        <!-- Left Section Start -->
                        <section class="col-md-12 detailbox">
                            <div class="bg-white mi-form-section">
                                <article class="clearfix">
                                    <aside class="col-md-8">
                                        <div class="clearfix m-t-20 p-b-20">
                                           
                                            <article class="form-group m-lr-0">
                                                <label for="cname" class="control-label col-md-4 col-sm-4">Category:</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <aside class="row">
                                                        <div class="col-md-6 col-sm-6">
                                                            <select class="selectpicker" data-width="100%" name="healthtip_category" id="healthtip_category">
                                                               <option value=''>Select Category</option>
                                                               <?php foreach ($AllCategory as $key => $val) { ?>
                                                                <option value="<?php echo $val->category_id; ?>"><?php echo $val->category_name; ?></option>
                                                            <?php } ?> 
                                                              
                                                            </select>
                                                            <label class="error" style="display:none;" id="error-healthtip_category"> please select a Category</label>
                                                            <label class="error" > <?php echo form_error("healthtip_category"); ?></label>
                                                        </div>
                                                    </aside>
                                                </div>
                                            </article>
                                          
                                            <article class="form-group m-lr-0 ">
                                                <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Image :</label>
                                                <div class="col-md-8 col-sm-8 text-right">
                                                        <label for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x avatar-view"></i></label>
                                                     <input type="file" style="display:none;" class="no-display avatar-view" id="healthtip_img" name="healthtip_img">
<!--                                                   <input type="file" style="display:none;" class="no-display" id="file-input" name="ambulance_img">-->     
                                                
                                              <img src="" width="70" height="65" class="image-preview-show"/>
                                            <label class="error" > <?php echo form_error("healthtip_img"); ?></label>
                                            <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                                                </div>
                                            </article>
 
                                    <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Healthtip Detail :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <textarea class="form-control" id="healthtip_detail" name="healthtip_detail" maxlength="500"></textarea>
                                            <label class="error" style="display:none;" id="error-healthtip_detail"> please enter Detail</label>
                                        </div>
                                    </article>
                                           <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4  col-sm-4">Amount:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <aside class="row clone">
                                                <div class="col-lg-7 col-md-6 col-sm-7 col-xs-10 m-t-xs-10">
                                                    <input type="text" class="form-control" name="healthtip_amount" id="healthtip_amount" maxlength="10"  onkeypress="return isNumberKey(event)"/>
                                                    <label class="error" style="display:none;" id="error-healthtip_amount"> please enter a valid Amount</label>
                                                    <label class="error" > <?php echo form_error("healthtip_amount"); ?></label>
                                                </div>
                                            </aside>
                                            
                                            
                                        </div>
                                    </article>
                                    </aside>
                                </article>
                                </div>
                                <!-- .form -->
                        

                        </section>
                        <!-- Left Section End -->


                            <section class="clearfix ">
                            <div class="col-md-12 m-t-20 m-b-20">
                                <button class="btn btn-danger waves-effect pull-right" type="button">Reset</button>
                                <div>
                                    <input class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit" onclick="return validationHealthtip()" value="Submit" />
                                </div>
                            </div>

                        </section>

                        <div id="upload_modal_form">
                            <?php $this->load->view('upload_crop_modal');?>
                        </div>
                    </form>


                    <!-- consultation -->

                </div>

                <!-- container -->
            </div>
            
            <!-- content -->
            