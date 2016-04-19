
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
                            <h3 class="pull-left page-title">CMS Detail </h3>
                            <a href="<?php echo site_url('cms');?>" class="btn btn-appointment btn-back waves-effect waves-light pull-right"><i class="fa fa-angle-left"></i> Back</a>
                               
                        </div>
                    </div>

                    <!-- Left Section Start -->
                    <section class="col-md-12 detailbox m-t-10">


                        <div class="bg-white">
                            <!-- Table Section Start -->

                            <section class="col-md-12">

                                <article class="tab-content p-b-20 m-t-50">

                                    <!-- General Detail Starts -->
                                     <div class="map_canvas"></div>
                                    
                                    <section class="tab-pane fade in active" id="general">

                                        <article class="detailbox">
                                            <div class="bg-white mi-form-section">

                                                <!-- Table Section End -->
                                                <aside class="clearfix m-t-20 setting">
                                                    <div class="col-md-8">
                                                        <h4>CMS Detail 
                                                        
                                                        </h4>
                                                        <hr/>
                                                        
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">CMS Title :</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"> <?php echo $result->cms_title;?> </p>
                                                            </article>
                                                            <article class="clearfix m-b-10">
                                                                <label for="cemail" class="control-label col-md-4 col-sm-4">Address :</label>
                                                                <p class="col-md-8 col-sm-8 t-xs-left"><?php echo $result->cms_description; ?> </p>
                                                            </article>

                                                          

                                                    </div>

                                                </aside>
                                            </div>
                                        </article>
                                    </section>
                                       
                                    <!-- General Detail Ends -->

                                 
                                  

                                