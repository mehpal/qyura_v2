<!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container row">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Quotation History</h43>

                        </div>
                    </div>

                    <section class="col-md-12 detailbox">


                        <!-- Form Section Start -->
                        <article class="row p-b-10">
                            <form name="csvDownload" id="" action="<?php echo site_url('quotation/createCSV'); ?>" method="post">
                                   <aside class="col-md-2 col-sm-2">
                                        <a href="<?php echo site_url('quotation/sendQuotation'); ?>" class="btn btn-quot waves-effect waves-light" type="submit">Send Quote</a>
                                    </aside>
                                    <aside class="col-md-3 col-sm-3 m-tb-xs-3">
                                        <div class="input-group">
                                            <input class="form-control pickDate" placeholder="From" id="fromDate" name="fromDate" type="text" onkeydown="return false;">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        </div>
                                    </aside>

                                    <aside class="col-md-3 col-sm-3 m-tb-xs-3">
                                        <div class="input-group">
                                            <input class="form-control pickDate" placeholder="To" id="toDate" name="toDate" type="text" onkeydown="return false;">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        </div>
                                    </aside>
                                 <p id="date_error"></p>
                                    <aside class="col-md-2 col-sm-2 m-tb-xs-3">
                                        <input type="text" name="search" id="search" class="form-control" placeholder="Search" />
                                </aside>
                                    <aside class="col-md-2 col-sm-2">
                                        <button class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" type="submit">Export</button>
                                    </aside>

                                </form>
                        </article>
                        <!-- Form Section End -->

                        <div class="bg-white">
                            <!-- Table Section Start -->
                            <article class="clearfix m-top-40 p-b-20">
                                <aside class="table-responsive">
                                <table class="table" id="quotationHistoryTable">
                                    <thead>
                                        <tr class="border-a-dull">
                                             <th>Quote Request For</th>
                                            <th>Quote Id</th>
                                            <th>Quote Request</th>
                                            <th>Quote Amount </th>
                                            <th>Quote Date</th>
                                            <th>Status</th>
                                            <th>Booking Status</th>
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
    <!-- END wrapper -->