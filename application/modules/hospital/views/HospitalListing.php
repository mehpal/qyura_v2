
<!-- Left Sidebar End -->
<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="clearfix">
                <div class="col-md-12">
                    <h3 class="pull-left page-title">Hospital Management</h43>

                </div>
            </div>

            <!-- Left Section Start -->
            <section class="col-md-12 detailbox">


                <!-- Form Section Start -->
                <article class="row p-b-10">
                    <form name="csvDownload" id="" action="<?php echo site_url('hospital/createCSV'); ?>" method="post">
                        <aside class="col-lg-1 col-md-2 col-sm-2">
                            <a href="<?php echo site_url('hospital/addHospital') ?>" class="btn btn-appointment waves-effect waves-light" title="Add New Hospital"><i class="fa fa-plus"></i> Add</a>
                        </aside>
                        <aside class="col-md-2 col-sm-2 m-t-xs-2">
                            <select class="form-control selectpicker" data-width="100%" name="hospital_stateId" id="hospital_stateId" data-size="4" onchange ="fetchCity(this.value)">

                                <option value="">Select State</option>
                                <?php foreach ($allStates as $key => $val) { ?>
                                    <option value="<?php echo $val->state_id; ?>"><?php echo $val->state_statename; ?></option>
                                <?php } ?>
                            </select>

                        </aside>
                        <aside class="col-md-3 col-sm-3 m-tb-xs-3">
                            <select type="text" name="hospital_cityId" class="form-control selectpicker" data-width="100%"  placeholder="Search" id="hospital_cityId" data-size="4" />
                            <option value=>Select Your City</option>
                            <!-- <option>Delhi</option>
                             <option>Kolkata</option> -->
                            </select>
                        </aside>
                        <aside class="col-md-3 col-sm-4 m-tb-xs-3">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" name="search" id="search" class="form-control" placeholder="Search" />
                            </div>
                        </aside>
                       
                        <aside class="col-md-2 col-sm-2 pull-right">
                            <button class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" type="submit" onclick="createCSV()">Export</button>
                        </aside>

                    </form>
                </article>
                <!-- Form Section End -->

                <div class="bg-white">
                    <!-- Table Section Start -->
                    <article class="clearfix m-top-40 p-b-20">
                        <aside class="table-responsive">
                            <table class="table all-bloodbank" id="hospital_datatable">
                                <thead>
                                    <tr class="border-a-dull">
                                        <th>Logo</th>
                                        <th>Name</th>
                                        <th>City</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </aside>

                    </article>
                    <!-- Table Section End -->
                    <!--                        <article class="clearfix m-t-20 p-b-20">
                                                <ul class="list-inline list-unstyled pull-right call-pagination">
                                                    <li class="disabled"><a href="#">Prev</a></li>
                                                    <li><a href="#">1</a></li>
                                                    <li class="active"><a href="#">2</a></li>
                                                    <li><a href="#">3</a></li>
                                                    <li><a href="#">4</a></li>
                                                    <li><a href="#">Next</a></li>
                                                </ul>
                                            </article>-->
                </div>

            </section>
            <!-- Left Section End -->

        </div>

        <!-- container -->
    </div>
    <!-- content -->
    <footer class="footer text-right">
        2015 © Qyura.
    </footer>
</div>
<!-- End Right content here -->
</div>
<!-- END wrapper -->
