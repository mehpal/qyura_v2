<!-- Begin page -->
<div id="wrapper">
    <!-- Start right Content here -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="clearfix">
                    <div class="col-md-12">
                        <h3 class="pull-left page-title">Doctor Appointment</h3>
                    </div>
                </div>
                <!-- Left Section Start -->
                <section class="col-md-12 detailbox">
                    <!-- Form Section Start -->
                    <article class="row p-b-10">
                        <form>
                            <aside class="col-lg-1 col-md-2 col-sm-2">
                                <a href="<?php echo site_url("docappointment/add_appointment"); ?>" title="Add New Appointment" class="btn btn-appointment waves-effect waves-light"><i class="fa fa-plus"></i> Add</a>
                            </aside>
                            <aside class="col-md-3 col-sm-4 m-tb-xs-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                    <input type="text" name="search" id="search" class="form-control" placeholder="Search" />
                                </div>
                            </aside>
                            <!--<aside class="col-md-2 col-sm-2 pull-right">
                                <button class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" type="submit">Export</button>
                            </aside>-->
                        </form>
                    </article>
                    <!-- Form Section End -->
                    <div class="bg-white">
                        <!-- Table Section Start -->
                        <article class="clearfix m-top-40 p-b-20">
                            <!--<div id="load_appointment" class="text-center text-success "><image alt="Please wait data is loading" src="<?php echo base_url('assets/images/loader/Heart_beat.gif'); ?>" /></div>-->
                            <aside class="table-responsive">
                                <table class="table" id="doctorAppointmentTable">
                                    <thead>
                                        <tr class="border-a-dull">
                                            <th>ApptId</th>
                                            <th>DateTime</th>
                                            <th>PatientName</th>
                                            <th>Doctor</th>
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
