 <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">


                    <div class="clearfix">
                        <div class="col-md-12 text-success">
                            <?php //echo $this->session->flashdata('message'); ?>
                        </div>
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Add New Health Category</h3>

                        </div>
                    </div>
                    <div class="map_canvas"></div>
                     <form class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" name="submitForm" method="post" action="<?php echo site_url(); ?>/healthcategory/SaveCategory" novalidate="novalidate" enctype="multipart/form-data" >
                        <!-- Left Section Start -->
                        <section class="col-md-12 detailbox">
                            <div class="bg-white mi-form-section">
                                <article class="clearfix">
                                    <aside class="col-md-8">
                                        <div class="clearfix m-t-20 p-b-20">
                                           
                                   
                                        <article class="form-group m-lr-0">
                                        <label for="cname" class="control-label col-md-4  col-sm-4">Category:</label>
                                        <div class="col-md-8 col-sm-8">
                                            <aside class="row clone">
                                                <div class="col-lg-7 col-md-6 col-sm-7 col-xs-10 m-t-xs-10">
                                                    <input type="text" class="form-control" name="health_category" id="health_category" />
                                                    <label class="error" style="display:none;" id="error-health_category"> Please enter Category</label>
                                                    <label class="error" > <?php echo form_error("health_categoryCategory"); ?></label>
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
                                <button class="btn btn-danger waves-effect pull-right" type="reset">Reset</button>
                                <div>
                                    <input class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit" value="Submit" />
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