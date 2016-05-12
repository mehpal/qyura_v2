 <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Users Management</h3>

                        </div>
                    </div>

                    <!-- Left Section Start -->
                    <section class="col-md-12 detailbox">


                        <!-- Form Section Start -->
                        <article class="row p-b-10">
                            <form name="csvDownload" id="" action="<?php //echo site_url('ambulance/createCSV'); ?>" method="post">

                                 <aside class="col-lg-1 col-md-2 col-sm-2">
                                    <a href="<?php echo base_url();?>index.php/users/addUsers" class="btn btn-appointment waves-effect waves-light" title="Add New User"><i class="fa fa-plus"></i> Add</a>
                                </aside>

                                <aside class="col-md-3 col-sm-3 m-tb-xs-3 col-md-offset-2">
                                    <select type="text" name="users_cityId" class="selectpicker" data-width="100%"  placeholder="Search" id="users_cityId" data-size="4" />
                                   <option value="">Select Your City</option>
                                    <?php foreach($city as $key=>$citys) {?>
                                        <option value="<?php echo $citys->city_id;?>"><?php echo $citys->city_name;?></option>
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
                                <aside class="col-md-3 col-sm-4  m-tb-xs-3">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                        <input type="text" name="search" id="search" class="form-control" placeholder="Search" />
                                    </div>
                                </aside>
<!--                                <aside class="col-md-2 col-sm-2 pull-right">
   <button class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" type="submit" >Export</button>
                                </aside>-->

                            </form>
                        </article>
                        <!-- Form Section End -->

                        <div class="bg-white">
                            <!-- Table Section Start -->
                            <article class="clearfix m-top-40 p-b-20">
                                <aside class="table-responsive">
                                <table class="table all-bloodbank" id="users_datatable">
                                    <thead>
                                        <tr class="border-a-dull">
                                            <th>Logo</th>
                                            <th>Name</th>
                                            <th>Date of birth</th>
                                            <th>Phone</th>
                                            <th>Address</th>
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
