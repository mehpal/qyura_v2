   <div class="content">
            <div class="container row">
                <!--   start section 1 -->
                <section class="clearfix">
                    <!--start total booking-->
                    <aside class=" col-md-4 col-sm-4 m-b-10">
                        <h4 class="r-box-title">Total Bookings</h4>
                        <article class="clearfix  r-box">
                            <figure class="col-md-4">
                                <small>Overall Booking</small>
                                <p>1,504</p>
                            </figure>
                            <figure class="col-md-4">
                                <small>Avg Monthly</small>
                                <p>1,504</p>
                            </figure>
                            <figure class="col-md-4">
                                <small>Today's</small>
                                <p>1,504</p>
                            </figure>
                            <figcaption class="col-md-12 clearfix">
                                <div class="progress-booking progress-sm">
                                    <div style="width: 20%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-info">
                                    </div>
                                </div>
                            </figcaption>
                            <div class="col-md-12 text-left ">
                                <h6>12% Higher than last month</h6>
                            </div>
                        </article>
                    </aside>
                    <!--end total booking-->
                    <!--start total revenue-->
                    <aside class=" col-md-4 col-sm-4 m-b-10">
                        <h4 class="y-box-title">Total Revenues (INR)</h4>
                        <article class="clearfix  y-box">
                            <figure class="col-md-4">
                                <small>Overall Booking</small>
                                <p>15,56,104</p>
                            </figure>
                            <figure class="col-md-4">
                                <small>Avg Monthly</small>
                                <p>1,55,004</p>
                            </figure>
                            <figure class="col-md-4">
                                <small>Today's</small>
                                <p>5,504</p>
                            </figure>
                            <figcaption class="col-md-12 clearfix">
                                <div class="progress-revenue progress-sm">
                                    <div style="width: 40%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-info">
                                    </div>
                                </div>
                            </figcaption>
                            <div class="col-md-12 text-left ">
                                <h6>35% Higher than last month</h6>
                            </div>
                        </article>
                    </aside>
                    <!--end total revenue-->
                    <!--start profile visits-->
                    <aside class=" col-md-4 col-sm-4 m-b-10">
                        <h4 class="b-box-title">Profile Visits</h4>
                        <article class="clearfix  b-box">
                            <figure class="col-md-4">
                                <small>Overall Visits</small>
                                <p>11,504</p>
                            </figure>
                            <figure class="col-md-4">
                                <small>Avg Monthly</small>
                                <p>345</p>
                            </figure>
                            <figure class="col-md-4">
                                <small>Today's</small>
                                <p>17</p>
                            </figure>
                            <figcaption class="col-md-12 clearfix">
                                <div class="progress-profile progress-sm">
                                    <div style="width:70%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-info">
                                    </div>
                                </div>
                            </figcaption>
                            <div class="col-md-12 text-left">
                                <h6>65% Higher than last month</h6>
                            </div>
                        </article>
                    </aside>
                    <!--end profile visits-->
                </section>
                <!--   end section  1-->







                <!-- section start -->
                <section class="clearfix m-t-30">



                    <!--  start today appt -->
                    <aside class="col-md-4 detailbox">
                        <div class="bg-white">
                            <figure class="clearfix">
                                <h3 class="pull-left">Today's Appointments</h3>
                                <form class="search-form pull-right">
                                    <input type="" class="search pull-right" />
                                </form>
                            </figure>


                            <article class="text-center clearfix border-third">
                                <ul class="nav nav-tabs">
                                    <li class="active col-md-6 col-xs-6">
                                        <a data-toggle="tab" href="#consulting">Consulting</a>
                                    </li>
                                    <li class="col-md-6 col-xs-6 b-left">
                                        <a data-toggle="tab" href="#diagnostic">Diagnostics</a>
                                    </li>
                                </ul>
                            </article>



                            <article class="tab-content h435">

                                <!-- consulting -->
                                <section class="tab-pane in active" id="consulting">
                                    <table class="table table-hover table-striped m-0">
                                        <thead>
                                            <tr>
                                                <th width="30%">Appt. Detail</th>
                                                <th width="40%">Doctor</th>
                                                <th width="30%">Time</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div class="mCustomScrollbar mxh-400" style="overflow: hidden;" tabindex="5000">
                                        <table class="table">
                                            <tbody>
                                                
                                                <?php if(!empty($consultAppoinement)):
                                                foreach($consultAppoinement as $consult):?>
                                                   
                                                <tr>
                                                    <td width="30%">
                                                        <h6><?php echo smart_wordwrap($consult->orderId,10,'<br>');?></h6>
                                                        <p><?php echo $consult->userName;?></p>
                                                        <p><?php echo getGender($consult->userGender);?> | <?php echo $consult->userAge;?></p>
                                                    </td>
                                                    <td width="40%">
                                                        <h6>Dr. <?php echo ucwords($consult->title);?></h6>
                                                        <p><?php echo ucwords($consult->speciality);?></p>
                                                    </td>
                                                    <td width="30%">
                                                        <h6> <?php echo date('h:i A',$consult->finalTime);?></h6>

                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>

                                                    </td>
                                                </tr>
                                                
                                                    
                                                <?php endforeach;
                                                endif;?>

                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                                <!-- consulting -->




                                <!-- diagnostic -->
                                <section class="tab-pane in" id="diagnostic">
                                    <table class="table table-hover table-striped m-0">
                                        <thead>
                                            <tr>
                                                <th width="30%">Appt. Detail</th>
                                                <th width="40%">Hospital</th>
                                                <th width="30%">Time</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div class="mCustomScrollbar mxh-400" style="overflow: hidden;" tabindex="5000">
                                        <table class="table">
                                            <tbody>
                                                
                                                <?php if(!empty($diagnosticAppointmnt)):
                                                        foreach($diagnosticAppointmnt as $diag):?>
                                                
                                                <tr>
                                                    <td width="30%">
                                                        <h6><?php echo smart_wordwrap($diag->orderId,10,'<br>');?></h6>
                                                        <p><?php echo $diag->userName;?></p>
                                                        <p><?php echo getGender($diag->userGender);?> | <?php echo $diag->userAge;?></p>
                                                    </td>
                                                    <td width="40%">
                                                        <h6><?php echo $diag->MIname;?></h6>
                                                        <p><?php echo $diag->city;?></p>
                                                    </td>
                                                    <td width="30%">
                                                        <h6> <?php echo date('h:i A',$consult->dateTime);?></h6>
                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                                
                                                 <?php endforeach;
                                                endif;?>
                                       

                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                                <!-- diagnostic -->
                            </article>
                        </div>
                    </aside>
                    <!-- end today appt -->
                    
                    <!--  start recent health package -->
                    <aside class="col-md-4 detailbox">
                        <div class="bg-white">
                            <figure class="clearfix">
                                <h3 class="pull-left">Recent Health Package Booking</h3>
                                <form class="search-form pull-right">
                                    <input type="" class="search pull-right" />
                                </form>
                            </figure>
                            
                            <table class="table table-hover table-striped m-0">
                                <thead>
                                    <tr>
                                        <th width="30%">Booking Details</th>
                                        <th width="40%">Packages</th>
                                        <th width="30%">Payment Status</th>
                                    </tr>
                                </thead>
                            </table>

                            <div class="mCustomScrollbar mxh-430" style="overflow: hidden;" tabindex="5000">
                                <table class="table">
                                    <tbody>
                                        
                                                <?php if(!empty($helthPackageBooking)):
                                                        foreach($helthPackageBooking as $helthBook):?>
                                                        
                                        <tr>
                                            <td width="30%">
                                                <h6><?php echo strtoupper($helthBook->healthPkgBooking_orderNo);?></h6>
                                                <p><?php echo $helthBook->bookedBy;?></p>
                                                <p><?php echo date('d/m/Y',$helthBook->createdAt);?></p>
                                            </td>
                                            <td width="40%">
                                                <h6><?php echo $helthBook->healthPackage_packageTitle;?></h6>
                                                <p><?php echo smart_wordwrap($helthBook->healthPackage_packageId,10,'<br>');?></p>
                                                <p>NR <?php echo round($helthBook->price);?></p>
                                            </td>
                                            <td width="30%">
                                                <h6> <?php echo getBookStatus($helthBook->healthPkgBooking_bkStatus);?></h6>
                                                <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                            </td>
                                        </tr>
                                                
                                                 <?php endforeach;
                                                endif;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </aside>
                    <!-- recent health package -->

                    <!--  start notification -->
                    <aside class="col-md-4 detailbox">
                        <div class="bg-white">
                            <figure class="clearfix">
                                <h3>Notifications</h3>
                            </figure>

                            <div class="mCustomScrollbar mxh-430" style="overflow: hidden;" tabindex="5000">
                                <aside class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td width="80%">
                                                    <p>You have received a quotation request for diagnostic booking. View details.</p>

                                                </td>
                                                <td width="20%">
                                                    <img src="assets/images/delete.png">

                                                </td>

                                            </tr>
                                            <tr>
                                                <td width="80%">
                                                    <p>You have received a quotation request for diagnostic booking. View details.</p>

                                                </td>
                                                <td width="20%">
                                                    <img src="assets/images/delete.png">

                                                </td>

                                            </tr>
                                            <tr>
                                                <td width="80%">
                                                    <p>You have received a quotation request for diagnostic booking. View details.</p>

                                                </td>
                                                <td width="20%">
                                                    <img src="assets/images/delete.png">

                                                </td>

                                            </tr>
                                            <tr>
                                                <td width="80%">
                                                    <p>You have received a quotation request for diagnostic booking. View details.</p>

                                                </td>
                                                <td width="20%">
                                                    <img src="assets/images/delete.png">

                                                </td>

                                            </tr>
                                                <tr>
                                                <td width="80%">
                                                    <p>You have received a quotation request for diagnostic booking. View details.</p>

                                                </td>
                                                <td width="20%">
                                                    <img src="assets/images/delete.png">

                                                </td>

                                            </tr>
                                                <tr>
                                                <td width="80%">
                                                    <p>You have received a quotation request for diagnostic booking. View details.</p>

                                                </td>
                                                <td width="20%">
                                                    <img src="assets/images/delete.png">

                                                </td>

                                            </tr>
                                                <tr>
                                                <td width="80%">
                                                    <p>You have received a quotation request for diagnostic booking. View details.</p>

                                                </td>
                                                <td width="20%">
                                                    <img src="assets/images/delete.png">

                                                </td>

                                            </tr>
                                            <tr>
                                                <td width="80%">
                                                    <p>You have received a quotation request for diagnostic booking. View details.</p>

                                                </td>
                                                <td width="20%">
                                                    <img src="assets/images/delete.png">

                                                </td>

                                            </tr>
                                            <tr>
                                                <td width="80%">
                                                    <p>You have received a quotation request for diagnostic booking. View details.</p>

                                                </td>
                                                <td width="20%">
                                                    <img src="assets/images/delete.png">

                                                </td>

                                            </tr>
                            
                               

                                     

                                        </tbody>
                                    </table>
                                </aside>
                            </div>

                        </div>
                    </aside>
                    <!-- end notification -->



                </section>
                <!-- end section -->



                <!-- section start -->
                <section class="clearfix m-t-30">



                    <!--  start quotation request -->
                    <aside class="col-md-4 detailbox">
                        <div class="bg-white">
                            <figure class="clearfix">
                                <h3>Quotation Requests</h3>
                                <form class="search-form pull-right">
                                    <input type="" class="search pull-right" />
                                </form>
                            </figure>

                            <table class="table table-hover table-striped m-0">
                                <thead>
                                    <tr>
                                        <th width="40%">QR Detail</th>
                                        <th width="60%">Diagnosis</th>
                                    </tr>
                                </thead>
                            </table>

                            <div class="mCustomScrollbar mxh-430" style="overflow: hidden;" tabindex="5000">
                                <table class="table">
                                    <tbody>
                                        
                                              <?php if(!empty($quotationList)):
                                                        foreach($quotationList as $quot):?>
                                                
                                              <tr>
                                            <td width="40%">
                                                <h6><?php echo smart_wordwrap($quot->uniqueId,10,'<br>');?></h6>
                                                 <p><?php echo $quot->userName;?></p>
                                                <p><?php echo $quot->dateTime;?></p>
                                            </td>
                                            <td>
                                                <h6><?php echo $quot->diagnosticsCat_catName;?></h6>
                                                <p><?php echo $quot->miName;?></p>
                                            </td>
                                            <td>
                                                <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                            </td>
                                        </tr>
                                                
                                                 <?php endforeach;
                                                endif;?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </aside>
                    <!-- end quotation request -->




                    <!--  start medicart -->
                    <aside class="col-md-4 detailbox">
                        <div class="bg-white">
                            <figure class="clearfix">
                                <h3>Medicart</h3>
                                <form class="search-form pull-right">
                                    <input type="" class="search pull-right" />
                                </form>
                            </figure>


                            <article class="text-center clearfix border-third">
                                <ul class="nav nav-tabs">
                                    <li class="active col-md-6 col-xs-6">
                                        <a data-toggle="tab" href="#booking-detail">Booking</a>
                                    </li>
                                    <li class="col-md-6 col-xs-6 b-left">
                                        <a data-toggle="tab" href="#enquiry">Enquiry</a>
                                    </li>
                                </ul>
                            </article>



                            <article class="tab-content h418">

                                <!-- booking -->
                                <section class="tab-pane in active" id="booking-detail">
                                    <table class="table table-hover table-striped m-0">
                                        <thead>
                                            <tr>
                                                <th width="40%">Booking Details</th>
                                                <th width="60%">Promotion</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div class="mCustomScrollbar mxh-382" style="overflow: hidden;" tabindex="5000">
                                        <table class="table">
                                            <tbody>
                                                
                                             <?php if(!empty($medicartBooking)):
                                                        foreach($medicartBooking as $mbook):?>
                                                
                                               <tr>
                                                    <td width="40%">
                                                       <h6><?php echo smart_wordwrap($mbook->medicartBooking_bookId,10,'<br>');?></h6>
                                                       <p><?php echo $mbook->patientDetails_patientName;?></p>
                                                       <p><?php echo date('d/m/Y',$mbook->medicartBooking_preferredDate);?></p>
                                                    </td>
                                                    <td>
                                                        <h6><?php echo $mbook->medicartOffer_title;?></h6>
                                                        <p><?php echo $mbook->MIname;?></p>
                                                    </td>
                                                    <td>
                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                                
                                                 <?php endforeach;
                                                endif;?>
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                                <!-- booking -->




                                <!-- enquiry -->
                                <section class="tab-pane in" id="enquiry">
                                    <table class="table table-hover table-striped m-0">
                                        <thead>
                                            <tr>
                                                <th width="40%">Booking Details</th>
                                                <th width="60%">Promotion</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div class="mCustomScrollbar mxh-382" style="overflow: hidden;" tabindex="5000">
                                        <table class="table">
                                            <tbody>
                                               
                                                 <?php if(!empty($medicartEnquiry)):
                                                        foreach($medicartEnquiry as $enquiry):?>
                                                
                                                 <tr>
                                                    <td width="40%">
                                                        <h6><?php echo smart_wordwrap($enquiry->medicartContect_enquiryId,10,'<br>');?></h6>
                                                       <p><?php echo $enquiry->medicartContect_name;?></p>
                                                       <p><?php echo date('d/m/Y',$enquiry->creationTime);?></p>
                                                    </td>
                                                    <td>
                                                        <h6><?php echo $enquiry->medicartOffer_title;?></h6>
                                                        <p><?php echo $enquiry->MIname;?></p>
                                                    </td>
                                                    <td>
                                                        <h2><button class="btn btn-success waves-effect waves-light m-b-5" type="button">Detail</button></h2>
                                                    </td>
                                                </tr>
                                                
                                                 <?php endforeach;
                                                endif;?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                                <!-- enquiry -->
                            </article>


                        </div>
                    </aside>
                    <!-- end medicart -->




                    <!--  start Doctor Of The Month -->
                    <aside class="col-md-4 detailbox">
                        <div class="bg-white">
                            <figure class="clearfix">
                                <h3>Doctor Of The Month</h3>
                            </figure>

                                                    <?php if(!empty($doctorOfMonth) && !empty($doctorOfMonth[0]->imUrl)): ?>
                                  <p class="text-center"><img src="<?php echo base_url().$doctorOfMonth[0]->imUrl; ?>" class="img-responsive img-circle img-thumbnail m-t-20"></p>
                        <?php else: ?>
                                  <p class="text-center"><img src="<?php echo base_url(); ?>assets/default-images/Doctor-logo.png" class="img-responsive img-circle img-thumbnail m-t-20"></p>
                            <?php endif;
?>
                            
                            <figcaption class="text-center">
                                <h3><?php if(!empty($doctorOfMonth)): echo 'Dr.'.$doctorOfMonth[0]->doctoesName; endif;?></h3>
                                <p><?php if(!empty($doctorOfMonth)): echo $doctorOfMonth[0]->degree; endif;?></p>
                                <p><?php if(!empty($doctorOfMonth)): echo $doctorOfMonth[0]->specname; endif;?></p>
                                <h3>Total Appointments: <?php if(!empty($doctorOfMonth)): echo $doctorOfMonth[0]->totalapp; endif;?></h3>
                            </figcaption>

                            <figcaption class="clearfix text-center text-black">
                                <aside class="col-md-4 col-xs-4">
                                    <div class="chart easy-pie-chart-1" data-percent="95">
                                        <span class="percent"></span>
                                    </div>
                                    <p>Conversion Rate</p>
                                </aside>
                                <aside class="col-md-4 col-xs-4">
                                    <div class="chart easy-pie-chart-2" data-percent="86">
                                        <span class="percent"></span>
                                    </div>
                                    <p>Booking Increment from Last Month</p>
                                </aside>
                                <aside class="col-md-4 col-xs-4">
                                    <div class="chart easy-pie-chart-3" data-percent="86">
                                        <span class="percent"></span>
                                    </div>
                                    <p>Conversion Increment</p>
                                </aside>
                            </figcaption>




                        </div>
                    </aside>
                    <!-- end Doctor Of The Month -->



                </section>
                <!-- end section -->



                <!-- start -->
<!--                <section class="clearfix m-t-30">
                    <div class="col-lg-12">

                        <article class="clearfix chartbox">
                            <div class="bg-white">
                                <figure class="clearfix">
                                    <h3>Revenue Trend</h3>
                                </figure>
                                <figcaption>
                                    <h4 class=""><i class="md md-event"></i> 2015</h4>

                                    <canvas id="lineChart" data-type="Line" height="250"></canvas>
                                </figcaption>

                                <div class="clearfix">

                                    <aside class="col-md-6 col-sm-6">
                                        <div class="col-md-5">
                                            <div id="donut-chart" style="height:170px;"></div>
                                        </div>
                                        <div class="col-md-7 p-t-50">
                                            <ul class="num-label">
                                                <li><span></span> Diagnostic</li>
                                                <li><span class="bg-ong-red"></span>Health Package</li>
                                            </ul>
                                        </div>

                                    </aside>


                                    <aside class="col-md-6 col-sm-6">
                                        <canvas id="single-bar" data-type="Bar"></canvas>
                                    </aside>
                                </div>

                            </div>
                        </article>
                    </div>
                </section>-->
                <!-- end -->



                <!-- start -->
<!--                <section class="clearfix m-t-30">
                    <article class="col-md-12 chartbox">
                        <div class="bg-white">
                            <figure class="clearfix">
                                <h3>Revenue Trend</h3>
                            </figure>
                            <figcaption>
                                <h4 class=""><i class="md md-event"></i> 2015</h4>
                                                                    <div id="bar-chart"></div>
                                <canvas id="bar-chart" data-type="Bar" height="300"></canvas>
                            </figcaption>
                        </div>
                    </article>
                </section>-->
                <!-- end -->






                <!-- start -->
                <section class="clearfix m-t-30">

                    <article class="col-md-4 col-sm-4 chartbox">
                        <div class="bg-white">
                            <figure class="clearfix">
                                <h3>Booking Distribution</h3>
                            </figure>
                            <figcaption>
                                <h4 class=""><i class="md md-event"></i> <?php echo date('Y');?></h4>
                                <div id="chart_div"></div>
                            </figcaption>
                        </div>
                    </article>

                    <article class="col-md-4 col-sm-4 chartbox">
                        <div class="bg-white">
                            <figure class="clearfix">
                                <h3>Medicart</h3>
                            </figure>
                            <figcaption>
                                <h4 class=""><i class="md md-event"></i> <?php echo date('Y');?></h4>
                                <div id="donut-example" style="height:200px"></div>
                            </figcaption>
                        </div>
                    </article>
<!--                    <article class="col-md-4 col-sm-4 chartbox">
                        <div class="bg-white">
                            <figure class="clearfix">
                                <h3>Revenue Distribution</h3>
                            </figure>
                            <figcaption>
                                <h4 class=""><i class="md md-event"></i> 2015</h4>
                                <div id="chart_div_sec"></div>
                            </figcaption>
                        </div>
                    </article>-->


            <input type="hidden" id="urls" value="<?php echo base_url();?>" />

                </section>
                <!-- end -->


            </div>
            <!-- container -->

        </div>
        <!-- content -->