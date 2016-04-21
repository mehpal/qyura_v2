<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="clearfix">
                <div class="col-md-12">
                    <h3 class="pull-left page-title">Hospitals</h3>
                    <a href="<?php echo site_url() ?>/master/mi_master/addHospital/" class="btn btn-appointment btn-back waves-effect waves-light pull-right m-r-10"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
            <!-- Left Section Start -->
            <section class="col-md-10 detailbox m-b-20">
                <aside class="bg-white">
                <figure class="clearfix">
                <h3>Available Hospitals</h3>
               <article class="clearfix">
                  <div class="input-group m-b-5">
                     <span class="input-group-btn">
                     <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                     </span>
                     <input type="text" placeholder="Search" class="form-control" id="search">
                  </div>
               </article>
            </figure>
                    <div class="bg-white">
                        <article class="clearfix m-top-40 p-b-20">
                                <aside class="table-responsive">
                <table class="table all-bloodbank" id="hospital_datatable">
                                    <thead>
                                        <tr class="border-a-dull">
                                            <th>Hospitals</th>
                                            <th>Action</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                </table>
                                </aside>
                            </article>
                    </div>
                </aside>
            </section>
            <!-- Left Section End -->
        </div>
        <!-- container -->
    </div>
    <!-- content -->