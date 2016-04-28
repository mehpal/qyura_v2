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
                    <h3 class="pull-left page-title">Health Category Detail</h3>
                    <a href="<?php echo site_url() ?>/healthcategory" class="btn btn-appointment btn-back waves-effect waves-light pull-right"><i class="fa fa-angle-left"></i> Back</a>

                </div>
            </div>
            <!-- Left Section Start -->
            <section class="col-md-12 detailbox m-t-10">
                <div class="clearfix bg-white">
                    <!-- Table Section Start -->

                    <section class="col-md-12">                           
                        <section class="clearfix hospitalBtn">
                            <div class="col-md-12">
                                <a data-toggle="modal" data-target="#changeBg" class="pull-right cl-white" title="Edit Background"><i class="fa fa-pencil"></i></a>

                            </div>

                        </section>
                        <article class="col-md-8 m-t-50">
                            <aside class="clearfix amb-detail">
                                <a id="edit" class="pull-right cl-pencil"><i class="fa fa-pencil"></i></a>
                            </aside>
                            <!--Category Detail Starts -->
                            <div class="map_canvas"></div>
                            <section class="tab-pane fade in active" id="detail" style="display:<?php echo $detail; ?>">
                                <div class="clearfix m-t-20 p-b-20 doctor-description">
                                    <article class="clearfix m-b-10">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Category :</label>
                                        <p class="col-md-8 col-sm-8"><?php echo $CategoryData[0]->category_name; ?></p>
                                    </article>

                                </div>
                            </section>
                            <!-- Category Detail Ends -->

                            <!-- Category Detail in Edit Mode -->
                            <form name="CategoryDetail" action="<?php echo site_url(); ?>/healthcategory/saveDetailCategory/<?php echo $categoryId; ?>" id="CategoryDetail" method="post">
                                <section id="editdetail" style="display:<?php echo $editdetail; ?>">
                                    <div class="clearfix m-t-20 p-b-20 doctor-description">

                                        <article class="form-group m-lr-0">
                                            <label for="cname" class="control-label col-md-4  col-sm-4">Category :</label>
                                            <div class="col-md-8 col-sm-8">
                                                <aside class="row clone">
                                                    <div class="col-lg-7 col-md-6 col-sm-7 col-xs-10 m-t-xs-10">
                                                        <input type="text" class="form-control" name="health_category" id="health_category" value="<?php echo $CategoryData[0]->category_name; ?>"/>
                                                        <label class="error" style="display:none;" id="error-health_category"> Please enter Category</label>
                                                        <label class="error" > <?php echo form_error("category_name"); ?></label>
                                                    </div>
                                                </aside>


                                            </div>
                                        </article>
                                        <article class="clearfix ">
                                            <div class="col-md-12 m-t-20 m-b-20">
                                                <button type="submit" class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" onclick="return validationCategoryEdit();">Submit</button>
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

        </div>

        <!-- container -->
        <?php echo $this->load->view('edit_upload_crop_modal'); ?>


