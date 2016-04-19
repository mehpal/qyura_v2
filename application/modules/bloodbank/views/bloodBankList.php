 <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Bloodbank Management</h43>

                        </div>
                    </div>

                    <!-- Left Section Start -->
                    <section class="col-md-12 detailbox">
                        <!-- Form Section Start -->
                        <article class="row p-b-10">
                            <form name="csvDownload" id="" action="<?php //echo site_url('bloodbank/createCSV'); ?>" method="post">
                               <aside class="col-md-2 col-sm-2 col-xs-6 m-tb-xs-3">
                                    <a href="<?php echo base_url();?>index.php/bloodbank/Addbloodbank" class="btn btn-appointment waves-effect waves-light" title="Add New Blood Bank"><i class="fa fa-plus"></i> Add </a>
                                </aside>
                                <aside class="col-md-2 col-sm-2 col-xs-6 visible-xs m-tb-xs-3 pull-right">
                                    <button class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" type="submit">Export</button>
                                </aside>
                                <aside class="col-md-2 col-sm-3 m-tb-xs-3">
                                                    <select class="selectpicker" data-width="100%" name="stateId" id="stateId" data-size="4" onchange ="fetchCityList(this.value)">

                                                        <option value="">Select State</option>
                                                       <?php foreach($allStates as $key=>$val) {?>
                                                        <option value="<?php echo $val->state_id;?>"><?php echo $val->state_statename;?></option>
                                                         <?php }?>
                                                    </select>
                                                   
                                 </aside>
                                <aside class="col-md-3 col-sm-3 m-tb-xs-3">
                                    <select type="text" name="cityId" class="selectpicker" data-width="100%" id="cityId" data-size="4" />
                                   <option value=>Select Your City</option>
                                    <!-- <option>Delhi</option>
                                    <option>Kolkata</option> -->
                                    </select>
                                </aside>
                               <aside class="col-md-3 col-sm-4 m-tb-xs-3">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                        <input type="text" name="search" id="search" class="form-control" /> 
                                    </div>
                                </aside>
<!--                                <aside class="col-md-2 col-sm-2 m-tb-sm-3 pull-right hidden-xs">
                                    <button class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" type="submit">Export</button>
                                </aside>-->

                            </form>
                        </article>
                        <!-- Form Section End -->

                        <div class="bg-white">
                            <!-- Table Section Start -->
                            <article class="clearfix m-top-40 p-b-20">
                                <aside class="table-responsive">
                                <table class="table all-bloodbank" id="datatable_bloodbank">
                                    <thead>
                                        <tr class="border-a-dull">
                                            <th>Logo</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>City</th>
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
        <!-- content -->
 
