 <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">QAP</h3>

                        </div>
                    </div>

                    <!-- Left Section Start -->
                    <section class="col-md-12 detailbox">
                        <!-- Form Section Start -->
                        <article class="row p-b-10">
                            <form name="csvDownload" id="" action="<?php //echo site_url('bloodbank/createCSV'); ?>" method="post">
                               <aside class="col-md-2 col-sm-2 col-xs-6 m-tb-xs-3">
                                    <a href="<?php echo base_url();?>index.php/qap/addQap" class="btn btn-appointment waves-effect waves-light" title="Add New QAP"><i class="fa fa-plus"></i> Add </a>
                                </aside>

                                <aside class="col-md-3 col-sm-3 m-tb-xs-3 col-md-offset-1">
                                    <select type="text" name="cityId" class="selectpicker" data-width="100%" id="cityId" data-size="4" />
                                   <option value="">Select Your City</option>
                                    <?php foreach($city as $key=>$citys) {?>
                                        <option value="<?php echo $citys->qap_city;?>"><?php echo $citys->qap_city;?></option>
                                     <?php }?>
                                    </select>
                                </aside>
                              <aside class="col-md-3 col-sm-3 m-tb-xs-3">
                                    <select name="status" class="selectpicker" data-width="100%" id="status" />
                                   <option value="">Select Status</option>
                                   <option value="1">Active</option>
                                   <option value="0">Inactive</option>
                                    </select>
                                </aside>
                               <aside class="col-md-3 col-sm-4 m-tb-xs-3">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                        <input type="text" name="search" id="search" class="form-control" /> 
                                    </div>
                                </aside>


                            </form>
                        </article>
                        <!-- Form Section End -->

                        <div class="bg-white">
                            <!-- Table Section Start -->
                            <article class="clearfix m-top-40 p-b-20">
                                <aside class="table-responsive">
                                <table class="table all-bloodbank" id="qap_datatable">
                                    <thead>
                                        <tr class="border-a-dull">
                                                <th>QAP Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>QAP Code</th>
                                                <th>Date of generation</th>
                                                <th>City</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                           
                                        </tr>
                                    
                                  </thead>
                        </table>
                                    </aside>
                        </article>
                </div>

                </section>
                <!-- Left Section End -->

            </div>

            <!-- container -->
        </div>
        <!-- content -->
 

                                               