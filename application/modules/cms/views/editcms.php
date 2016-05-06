
        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">

                    <div class="clearfix">
                        <div class="col-md-12 text-success">
                            <?php echo $this->session->flashdata('message'); ?>
                         </div>
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Edit New CMS</h3>
<a class="btn btn-appointment btn-back waves-effect waves-light pull-right" href="<?php echo site_url('cms');?>">
<i class="fa fa-angle-left"></i>
Back
</a>
                        </div>
                    </div>

                    <div class="map_canvas"></div>
                    <form class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" name="submitForm" method="post" action="<?php echo site_url(); ?>/cms/updatecms" novalidate="novalidate" enctype="multipart/form-data" >
                      
                      <div style="display:none"><input  name="cms_id" value="<?php echo $resultRows->cms_id; ?>" > </div>
                        <!-- Left Section Start -->
                        <section class="col-md-12 detailbox">
                            <div class="bg-white mi-form-section">
                                <figure class="clearfix">
                                    <h3>General Detail</h3>
                                </figure>
                                <!-- Table Section End -->
                                <div class="clearfix m-t-20 p-b-20">
                                    <article class="form-group m-lr-0 ">
                                        <label for="cemail" class="control-label col-md-3 col-sm-3">CMS Title :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" id="cms_title" name="cms_title" type="text" required="" maxlength="30" value="<?php echo $resultRows->cms_title; ?>" readonly="">
                                            <label class="error" style="display:none;" id="error-cms_title"> please enter CMS Title</label>
                                            <label class="error" > <?php echo form_error("cms_title"); ?></label>
                                        </div>
                                    </article>
                                </div>
                                
                                
                              <div class="clearfix m-t-20 p-b-20">
                                    <article class="form-group m-lr-0 ">
                                        <label for="cemail" class="control-label col-md-3 col-sm-3">CMS Description :</label>
                                        <div class="col-md-8 col-sm-8">
              <textarea  class="summernote form-control" rows="9" name="cms_description"><?php echo $resultRows->cms_description; ?></textarea>
                                            
                                            <label class="error" style="display:none;" id="error-cms_description"> please enter  description</label>
                                            <label class="error" > <?php echo form_error("cms_description"); ?></label>
                                        </div>
                                    </article>
                                </div>
                                <!-- .form -->
                            </div>

                        </section>
                        <!-- Left Section End -->



                        <section class="clearfix ">
 <div class="col-md-12 m-t-20 m-b-20">
                                    <input class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit" onclick="return validationCms()" value="Update" />
				
                            </div>

                        </section>

                    </form>

                </div>

                <!-- container -->
            </div>
            <!-- content -->
            