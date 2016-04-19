 <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Ambulance Management</h43>

                        </div>
                    </div>

                    <!-- Left Section Start -->
                    <section class="col-md-12 detailbox">


                        <!-- Form Section Start -->
                        <article class="row p-b-10">
                            <form name="csvDownload" id="" action="<?php echo site_url('ambulance/createCSV'); ?>" method="post">

                                 <aside class="col-lg-1 col-md-2 col-sm-2">
                                    <a href="<?php echo base_url();?>index.php/ambulance/addAmbulance" class="btn btn-appointment waves-effect waves-light" title="Add New Ambulance"><i class="fa fa-plus"></i> Add</a>
                                </aside>
                                <aside class="col-md-3 col-sm-3">
                                    <select class="selectpicker" data-width="100%" name="ambulance_stateId" id="ambulance_stateId" data-size="4" onchange ="fetchCity(this.value)">

                                                        <option value="">Select State</option>
                                                       <?php foreach($allStates as $key=>$val) {?>
                                                        <option value="<?php echo $val->state_id;?>"><?php echo $val->state_statename;?></option>
                                                         <?php }?>
                                    </select>
                                </aside>
                                <aside class="col-md-3 col-sm-3 m-tb-xs-3">
                                    <select type="text" name="ambulance_cityId" class="selectpicker" data-width="100%"  placeholder="Search" id="ambulance_cityId" data-size="4" />
                                   <!-- <option>Delhi</option>
                                    <option>Kolkata</option> -->
                                    </select>
                                </aside>
                                <aside class="col-md-3 col-sm-4  m-tb-xs-3">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                        <input type="text" name="search" id="search" class="form-control" placeholder="Search" />
                                    </div>
                                </aside>
                                <aside class="col-md-2 col-sm-2 pull-right">
   <button class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" type="submit" >Export</button>
                                </aside>

                            </form>
                        </article>
                        <!-- Form Section End -->

                        <div class="bg-white">
                            <!-- Table Section Start -->
                            <article class="clearfix m-top-40 p-b-20">
                                <aside class="table-responsive">
                                <table class="table all-bloodbank" id="ambulance_datatable">
                                    <thead>
                                        <tr class="border-a-dull">
                                            <th>Logo</th>
                                            <th>Name</th>
                                             <th>City</th>
                                            <th>Phone</th>
                                            <th>Address</th>
<!--                                            <th class="text-center">Total Appointments</th>
                                            <th class="text-center">Reviews Received</th>-->
                                            <th>Action</th>
                                        </tr>
                                        
                                      <!--  <tr>
                                            <td>
                                                <h6><img src="<?php echo base_url();?>assets/images/dc-vijaya.png" alt="" class="img-responsive" /></h6>
                                            </td>
                                            <td>
                                                <h6>Vijaya ambulance</h6>
                                                 <p> <span class="label label-success waves-effect waves-light m-tb-5 center-block">5.0</span></p>
                                            </td>
                                            <td><h6>Hyderabad</h6></td>
                                             <td>
                                                <h6>9826000777</h6>
                                                <h6>0731-2349999</h6>
                                            </td>
                                            <td>
                                                <h6>3-6-16 & 17, Street No. 19, Himayatnagar, Hyderabad, Telangana 500029</h6>
                                                <a href="view-map.html" class="btn btn-info btn-xs waves-effect waves-light" target="_blank">View Map</a>
                                            </td>
                                            <td class="text-center"><h6>310</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>212</h6>
                                            </td>
                                             
                                           
                                            <td>
                                                <h6><a href="<?php echo base_url();?>index.php/ambulance/detailAmbulance/<?php echo $key->ambulance_id; ?>" class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" >View Detail</a></h6>
                                                <a href="edit-diagcenter.html" class="btn btn-success waves-effect waves-light m-b-5 applist-btn" >Edit Detail</a>
                                            </td>
                                        </tr> -->                                     
                                       
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
