
<!-- Left Sidebar End -->
<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="clearfix">
                <div class="col-md-12 text-danger">
                            <?php //echo $this->session->flashdata('message'); ?>
                 </div>
                <div class="col-md-12">
                    <h3 class="pull-left page-title">Healthtip Category Management</h43>

                </div>
            </div>
            <!-- Left Section Start -->
            <section class="col-md-12 detailbox">
                <!-- Form Section Start -->
                <article class="row p-b-10">
                    <form name="csvDownload" id="" action="<?php echo site_url('healthcategory/createCSV'); ?>" method="post">
                        <aside class="col-lg-1 col-md-2 col-sm-2">
                            
                            <a href="<?php echo base_url();?>index.php/healthcategory/addHealthCategory" class="btn btn-appointment waves-effect waves-light" title="Add New Category"><i class="fa fa-plus"></i> Add</a>
                        </aside>
                        <aside class="col-md-3 col-sm-4 m-tb-xs-3">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" name="search" id="search" class="form-control" placeholder="Search" />
                            </div>
                        </aside>
                       
                        <!--aside class="col-md-2 col-sm-2 pull-right">
                            <button class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" type="submit" onclick="createCSV()">Export</button>
                        </aside-->

                    </form>
                </article>
                <!-- Form Section End -->

                <div class="bg-white">
                    <!-- Table Section Start -->
                    <article class="clearfix m-top-40 p-b-20">
                        <aside class="table-responsive">
                            <table class="table all-bloodbank" id="healthcategory_datatable">
                                <thead>
                                    <tr class="border-a-dull">
                                        <th>Category</th>
                                        <th class="no-sort">Action</th>
                                        <th class="no-sort">Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </aside>

                    </article>
                </div>

            </section>
            
        </div>

        
    </div>
    
    <footer class="footer text-right">
        2015 © Qyura.
    </footer>
</div>
</div>