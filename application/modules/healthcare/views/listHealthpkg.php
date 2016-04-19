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
                            <h3 class="pull-left page-title">Health Package</h3>

                        </div>
                    </div>

                    <!-- Left Section Start -->
                    <section class="col-md-12 detailbox">


                        <!-- Form Section Start -->
                        <article class="row p-b-10">
                            <form name="csvDownload" id="" action="<?php echo site_url('healthcare/createCSV'); ?>" method="post">
                                <aside class="col-md-2 col-sm-2">
                                    <a href="<?php echo base_url();?>index.php/healthcare/addHealthpkg" title="Add New Package" class="btn btn-appointment waves-effect waves-light"><i class="fa fa-plus"></i> Add</a>
                                </aside><?php //print_r($allCities); ?>
                                <aside class="col-md-3 col-sm-3 m-tb-xs-3">
                                    <select class="form-control selectpicker" name="helathpkg_cityId" id="helathpkg_cityId" data-width="100%" >
                                        <option  value="" >Select City</option>
                                        <?php
                                        if (isset($allCities) && !empty($allCities)) {
                                            foreach ($allCities as $key => $val) {
                                                ?>
                                                <option value="<?php echo $val->city_id; ?>"><?php echo $val->city_name; ?></option>
    <?php }
} ?>
                                    </select>
                                </aside>

                                <aside class="col-md-3 col-sm-3 m-tb-xs-3">
                                    <input type="text" name="mi" class="form-control" id="mi"  placeholder="MI Name" />
                                </aside>
                                 <!--<aside class="col-md-3 col-sm-4  m-tb-xs-3">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                        <input type="text" name="search" id="search" class="form-control" placeholder="Search" />
                                    </div>
                                </aside>-->
                                <aside class="col-md-2 col-sm-2 pull-right">
                                    <button class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" onclick="createCSV()" type="submit">Export</button>
                                </aside>

                            </form>
                        </article>
                        <!-- Form Section End -->

                        <div class="bg-white">
                            <!-- Table Section Start -->

                            <article class="clearfix m-top-40 p-b-20">
                                <aside class="table-responsive">
                                    <table class="table" id="healthcarePkgTable">

                                       <thead>
                                            <tr class="border-a-dull">
                                                <th>MI</th>
                                                <th>Package Id</th>
                                                <th>Title</th>
                                                <th>Pricing</th>
                                                <th>Status</th>
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

                <!-- container -->
            </div>
            <!-- content -->
        </div>
        <!-- End Right content here -->
