        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container row">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Health Package</h3>
                            <a href="<?php echo site_url('/healthcare'); ?>" class="btn btn-appointment btn-back waves-effect waves-light pull-right"><i class="fa fa-angle-left"></i> Back</a>

                        </div>
                    </div>

                    <!-- Left Section Start -->
                    <section class="col-md-12 detailbox">


                        <!-- Form Section Start -->
                        <article class="row p-b-10">
                            <form>
                                <aside class="col-md-3">
                                    <a href="<?php echo site_url('healthcare/addHealthpkg'); ?>" class="btn btn-appointment waves-effect waves-light" type="submit">Add New Package</a>
                                </aside>
                    
                            </form>
                        </article>
                        <!-- Form Section End -->

                        <div class="bg-white">
                            <!-- Table Section Start -->

                            <article class="clearfix p-b-20">
                                <aside class="clearfix detail-health-package m-t-20">
                                    <div class="col-md-9 col-sm-9">
                                        <h3><?php echo $healthcareData[0]->title;?> </h3>
                                        <h4><?php echo $healthcareData[0]->healthpkgId;?> </h3></h4>
                                        <!--<h4>Date :<?php echo $healthcareData[0]->date;?></h4>-->
                                        <h4><?php echo $healthcareData[0]->miName;?></h4>
                                    </div>
                                    <div class="col-md-3 col-sm-3 text-right">
                                        <h3><i class="fa fa-inr"></i> <?php echo $healthcareData[0]->price;?></h3>
                                        <h4 class="h4-health"><i class="fa fa-inr"></i> <span class="strike"><?php echo $healthcareData[0]->bp;?></span></h4>
                                    </div>
                                </aside>
                                <hr class="hr-appt-detail" />
                                <aside class="clearfix m-t-10">
                                    <div class="col-md-12 detail-health-package">
                                        <!--<h4 class="h4-health">Description</h4>
                                        <p class="text-justify"><?php echo $healthcareData[0]->healthPackage_description;?></p>-->
                                        <h4 class="h4-health">Test Included</h4>
                                        <ul class="ul-tick">
                                        <?php if($healthcareData[0]->test != ''){
                                                 $testinclude=explode('|',$healthcareData[0]->test);
                                            if(!empty($testinclude)){
                                                foreach($testinclude as $key=>$value){
                                                   echo "<li>$value</li>";
                                                }
                                            }
                                          }  
                                   ?>
                                        </ul>
                                    </div>
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
