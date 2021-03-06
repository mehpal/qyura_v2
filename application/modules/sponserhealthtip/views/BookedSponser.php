
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
                    <h3 class="pull-left page-title">HealthTip Bookings</h3>
                </div>
            </div>

            <!-- Left Section Start -->
            <section class="col-md-12 detailbox">
             <!-- Form Section Start -->
                <article class="row p-b-10">
                    <form name="csvDownload" id="" action="<?php echo site_url('sponserhealthtip/createCSV'); ?>" method="post">
                        <aside class="col-md-3 col-sm-4 m-tb-xs-3">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" name="search" id="search" class="form-control" placeholder="Search City/Category" />
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
                            <table class="table all-bloodbank" id="BookSponser_datatable">
                                <thead>
                                    <tr class="border-a-dull">
                                        <th>Sponsored By</th>
                                        <th>Sponsor Type</th>
                                        <th>Date</th>
                                        <th>City</th>
                                        <th>Category</th>
                                        <th>Action</th>
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
