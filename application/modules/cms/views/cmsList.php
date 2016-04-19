<!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container row">
                    <div class="clearfix">
                        <div class="col-md-12">
                           <h3 class="pull-left page-title">All Content Management System </h3>

                        </div>
                    </div>

                    <!-- Left Section Start -->
                    <section class="col-md-12 detailbox">

  <?php if(!empty($this->session->flashdata('message'))){?>
                            <div class="alert alert-success"><?php echo $this->session->flashdata('message');?></div>
                                <?php }?>
                           <?php if(!empty($this->session->flashdata('error'))){?>
                            <div class="alert alert-danger"><?php echo $this->session->flashdata('error');?></div>
                                <?php }?>
                        <!-- Form Section Start -->
                        <article class="row p-b-10">
                                <form>
                                <aside class="col-lg-1 col-md-2 col-sm-2">
                                    <a href="<?php echo site_url('cms/addcms');?>" title="Add New" class="btn btn-appointment waves-effect waves-light"> <i class="fa fa-plus"></i> Add</a>
                                </aside>
                            </form>
                        </article>
                        <!-- Form Section End -->

                        <div class="bg-white">
                            <!-- Table Section Start -->
                            <article class="clearfix m-top-40 p-b-20">
                                 
                                <aside class="table-responsive">
                                 
                                      <table class="table all-bloodbank" id="datatable_cms">
                                    <thead>
                                        <tr class="border-a-dull">
                                           
                                            <th>CMS Title</th>
                                            <th>CMS Description</th>
                                            <th>Action</th>
                                        </tr>
                                    
                                  </thead>
                        </table>
                                </aside>
                            </article>
                            <!-- Table Section End -->
                        </div>

                    </section>
                    <!-- Left Section End -->


                </div>
                <!-- END wrapper -->

                   <!-- container -->
            </div>
