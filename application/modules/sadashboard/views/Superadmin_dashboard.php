
<!-- Start right Content here -->
<div class="content-page ">
    <!-- Start content -->
    <div class="content si-dashboard">
        <div class="container">
            <!--   start section 1 -->
            <section class="clearfix">
                <!--start MI-->
                <aside class=" col-md-3 col-sm-6 m-b-10">
                    <article class="clearfix  r-box">
                        <h4 class="">Total Registered <br>Medical Institutions</h4>

                        <p><?php if(isset($MiList) && !empty($MiList)): echo count($MiList);else: echo '0';endif;?></p>
                    </article>
                    <article class="r-box-bottom"><a href="<?php echo site_url('hospital');?>">view all</a></article>
                </aside>
                <!--end MI-->
                <!--start total DOC-->
                <aside class="col-md-3 col-sm-6 m-b-10">
                    <article class="clearfix  y-box">
                        <h4 class="">Total Registered <br>
                            Doctors</h4>

                        <p><?php if(isset($doctorList) && !empty($doctorList)): echo count($doctorList);else: echo '0';endif;?></p>
                    </article>
                    <article class="y-box-bottom"><a href="<?php echo site_url('doctor');?>">view all</a></article>
                </aside>
                <!--end total Doc-->
                <!--start Revenue-->
                <aside class="col-md-3 col-sm-6 m-b-10">
                    <article class="clearfix  b-box">
                        <h4 class="">Total Revenue <br>
                            Generated</h4>

                        <p><i class="fa fa-inr"></i> 0</p>
                    </article>
                    <article class="b-box-bottom"><a href="#">view all</a></article>
                </aside>
                <!--end Revenue-->
                <!--start profile visits-->
                <aside class="col-md-3 col-sm-6 m-b-10">
                    <article class="clearfix  g-box">
                        <h4 class="">Total Registered <br>
                            Users</h4>

                        <p><?php if(isset($User) && !empty($User)): echo $User[0]->totalUser;else: echo '0';endif;?></p>
                    </article>
                    <article class="g-box-bottom"><a href="<?php echo site_url('users');?>">view all</a></article>
                </aside>
                <!--end profile visits-->
            </section>
            <!--   end section  1-->







            <!-- section start -->
            <section class="clearfix m-t-30">



                <!--  start today appt -->
                <aside class="col-md-8 detailbox">
                    <div class="bg-white">
                        <figure class="clearfix">
                            <h3>Today's Appointments</h3>
                            <form class="search-form">
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



                        <article class="tab-content h400">

                            <!-- consulting -->
                            <section class="tab-pane in active sa-cons" id="consulting">

                                <div class="mCustomScrollbar  mxh-400" style="overflow:hidden;" tabindex="5000">
                                    <aside class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr class="border-a-dull">
                                                    <th width="20%">
                                                        Appt. Details</th>
                                                    <th>
                                                        Patient
                                                    </th>
                                                    <th>
                                                        Doctor</th>
                                                    <th>
                                                        Hospital
                                                    </th>
                                                    <th>Detail</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td width="20%">
                                                        <h6>APPTH 20</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jain</h6>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Dr Sambit Jain</h6>
                                                        <p>Cardilogy</p>
                                                    </td>
                                                    <td>
                                                        <h6>Hospital</h6>
                                                        <p>New Delhi</p>
                                                    </td>
                                                    <td>
                                                        <h6></h6>
                                                        <button type="button" class="btn btn-success waves-effect waves-light m-b-5">Detail</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>APPTH 20</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jain</h6>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Dr Sambit Jain</h6>
                                                        <p>Cardilogy</p>
                                                    </td>
                                                    <td>
                                                        <h6>Hospital</h6>
                                                        <p>New Delhi</p>
                                                    </td>
                                                    <td>
                                                        <h6></h6>
                                                        <button type="button" class="btn btn-success waves-effect waves-light m-b-5">Detail</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>APPTH 20</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jain</h6>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Dr Sambit Jain</h6>
                                                        <p>Cardilogy</p>
                                                    </td>
                                                    <td>
                                                        <h6>Hospital</h6>
                                                        <p>New Delhi</p>
                                                    </td>
                                                    <td>
                                                        <h6></h6>
                                                        <button type="button" class="btn btn-success waves-effect waves-light m-b-5">Detail</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>APPTH 20</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jain</h6>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Dr Sambit Jain</h6>
                                                        <p>Cardilogy</p>
                                                    </td>
                                                    <td>
                                                        <h6>Hospital</h6>
                                                        <p>New Delhi</p>
                                                    </td>
                                                    <td>
                                                        <h6></h6>
                                                        <button type="button" class="btn btn-success waves-effect waves-light m-b-5">Detail</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>APPTH 20</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jain</h6>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Dr Sambit Jain</h6>
                                                        <p>Cardilogy</p>
                                                    </td>
                                                    <td>
                                                        <h6>Hospital</h6>
                                                        <p>New Delhi</p>
                                                    </td>
                                                    <td>
                                                        <h6></h6>
                                                        <button type="button" class="btn btn-success waves-effect waves-light m-b-5">Detail</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>APPTH 20</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jain</h6>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Dr Sambit Jain</h6>
                                                        <p>Cardilogy</p>
                                                    </td>
                                                    <td>
                                                        <h6>Hospital</h6>
                                                        <p>New Delhi</p>
                                                    </td>
                                                    <td>
                                                        <h6></h6>
                                                        <button type="button" class="btn btn-success waves-effect waves-light m-b-5">Detail</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>APPTH 20</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jain</h6>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Dr Sambit Jain</h6>
                                                        <p>Cardilogy</p>
                                                    </td>
                                                    <td>
                                                        <h6>Hospital</h6>
                                                        <p>New Delhi</p>
                                                    </td>
                                                    <td>
                                                        <h6></h6>
                                                        <button type="button" class="btn btn-success waves-effect waves-light m-b-5">Detail</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </aside>
                                </div>
                            </section>
                            <!-- consulting -->




                            <!-- diagnostic -->
                            <section class="tab-pane in  sa-cons" id="diagnostic">

                                <div class="mCustomScrollbar  mxh-400" style="overflow: hidden;" tabindex="5000">
                                    <aside class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr class="border-a-dull">
                                                    <th>
                                                        Appt. Details</th>
                                                    <th>
                                                        Patient
                                                    </th>
                                                    <th>
                                                        Doctor</th>
                                                    <th>
                                                        Hospital
                                                    </th>
                                                    <th>Detail</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h6>APPTH 20</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jain</h6>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Dr Sambit Jain</h6>
                                                        <p>Cardilogy</p>
                                                    </td>
                                                    <td>
                                                        <h6>Hospital</h6>
                                                        <p>New Delhi</p>
                                                    </td>
                                                    <td>
                                                        <h6></h6>
                                                        <button type="button" class="btn btn-success waves-effect waves-light m-b-5">Detail</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>APPTH 20</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jain</h6>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Dr Sambit Jain</h6>
                                                        <p>Cardilogy</p>
                                                    </td>
                                                    <td>
                                                        <h6>Hospital</h6>
                                                        <p>New Delhi</p>
                                                    </td>
                                                    <td>
                                                        <h6></h6>
                                                        <button type="button" class="btn btn-success waves-effect waves-light m-b-5">Detail</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>APPTH 20</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jain</h6>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Dr Sambit Jain</h6>
                                                        <p>Cardilogy</p>
                                                    </td>
                                                    <td>
                                                        <h6>Hospital</h6>
                                                        <p>New Delhi</p>
                                                    </td>
                                                    <td>
                                                        <h6></h6>
                                                        <button type="button" class="btn btn-success waves-effect waves-light m-b-5">Detail</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>APPTH 20</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jain</h6>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Dr Sambit Jain</h6>
                                                        <p>Cardilogy</p>
                                                    </td>
                                                    <td>
                                                        <h6>Hospital</h6>
                                                        <p>New Delhi</p>
                                                    </td>
                                                    <td>
                                                        <h6></h6>
                                                        <button type="button" class="btn btn-success waves-effect waves-light m-b-5">Detail</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>APPTH 20</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jain</h6>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Dr Sambit Jain</h6>
                                                        <p>Cardilogy</p>
                                                    </td>
                                                    <td>
                                                        <h6>Hospital</h6>
                                                        <p>New Delhi</p>
                                                    </td>
                                                    <td>
                                                        <h6></h6>
                                                        <button type="button" class="btn btn-success waves-effect waves-light m-b-5">Detail</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>APPTH 20</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jain</h6>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Dr Sambit Jain</h6>
                                                        <p>Cardilogy</p>
                                                    </td>
                                                    <td>
                                                        <h6>Hospital</h6>
                                                        <p>New Delhi</p>
                                                    </td>
                                                    <td>
                                                        <h6></h6>
                                                        <button type="button" class="btn btn-success waves-effect waves-light m-b-5">Detail</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>APPTH 20</h6>
                                                        <p>Vipul Jain</p>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Vipul Jain</h6>
                                                        <p>Mail | 45</p>
                                                    </td>
                                                    <td>
                                                        <h6>Dr Sambit Jain</h6>
                                                        <p>Cardilogy</p>
                                                    </td>
                                                    <td>
                                                        <h6>Hospital</h6>
                                                        <p>New Delhi</p>
                                                    </td>
                                                    <td>
                                                        <h6></h6>
                                                        <button type="button" class="btn btn-success waves-effect waves-light m-b-5">Detail</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </aside>
                                </div>
                            </section>
                            <!-- diagnostic -->
                        </article>


                    </div>
                </aside>
                <!-- end today appt -->




                <!--  start notification -->
                <aside class="col-md-4 detailbox">
                    <div class="bg-white">
                        <figure class="clearfix">
                            <h3>Notifications</h3>
                        </figure>

                        <div class="mCustomScrollbar mxh-450" style="overflow: hidden;" tabindex="5000">
                            <aside class="table-responsive">
                                <table class="table">
                                    <tbody id="loadNotice">
                                        <?php if(isset($notification) && !empty($notification)):
                                                foreach($notification as $notice): ?>
                                            
                                            <tr>
                                            <td width="80%">
                                                <p><?php echo ucfirst(substr($notice->qyura_cronMsg, 0,50)).'...';?></p>

                                            </td>
                                            <td width="20%">
                                                <a onclick="deleteNotice('<?php echo $notice->qyura_cronMsgId;?>')"> <img src="<?php echo base_url(); ?>assets/images/delete.png"></a>

                                            </td>

                                        </tr>
                                        <?php   endforeach;
                                        endif;
?>
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

                            <h3 class="hf-14">Pending Quot. Requests (<?php if(isset($quotationList) && !empty($quotationList)):echo count($quotationList);else:echo"0";endif;?>)</h3>
                            <form class="search-form">
                                <input type="" class="search pull-right" />
                            </form>
                        </figure>

                        <table class="table table-hover table-striped m-0">
                            <thead>
                                <tr class="border-a-dull">
                                    <th width="40%">QR Details</th>
                                    <th width="60%">Diagnosis</th>
                                </tr>
                            </thead>
                        </table>

                        <div class="mCustomScrollbar mxh-450" style="overflow: hidden;" tabindex="5000">
                            <aside class="table-responsive">
                                <table class="table">
                                    <tbody>
                                       <?php if(isset($quotationList) && !empty($quotationList)):
                                                foreach($quotationList as $quot): ?>
                                            
                                          <tr>
                                            <td width="40%">
                                                <h6><?php echo $quot->uniqueId;?></h6>
                                                <p><?php echo ucwords($quot->userName);?></p>
                                                <p><?php echo $quot->dateTime;?></p>
                                            </td>
                                            <td>
                                                <h6><?php echo ucwords($quot->diagnosticsCat_catName);?></h6>
                                                <p><?php echo ucwords($quot->docName);?></p>
                                            </td>
                                            <td>
                                                <a href="<?php echo site_url('quotation/viewPrescription/'.$quot->quotation_id);?>" class="btn btn-success waves-effect waves-light m-b-5" >Detail</a>
                                            </td>
                                        </tr>
                                        
                                        <?php   endforeach;
                                        endif;
?>

                                    </tbody>
                                </table>
                            </aside>

                        </div>

                    </div>
                </aside>
                <!-- end quotation request -->




                <!--  start medicart -->
                <aside class="col-md-4 detailbox">
                    <div class="bg-white">
                        <figure class="clearfix">
                            <div class="col-md-7 col-sm-8 p-0">
                                <h3>Top 5 Hospital of 
                                    The Month (Nov 2014) </h3>
                            </div>
                            <div class="col-md-5 col-sm-4 text-right">
                                <select class="form-control selectpicker m-tb-5" data-width="100%" >
                                    <option>All City</option>
                                    <option>Feb</option>
                                </select>
                            </div>
                        </figure>

                        <article class="tab-content">

                            <!--Hospitals -->
                            <aside class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h6><i class="fa fa-image fa-2x"></i></h6></td>
                                            <td>
                                                <h6>Appolo Hospital</h6>
                                                <p>Kolkata</p>
                                            </td>
                                            <td>
                                                <h6></h6>
                                                <button class="btn btn-success waves-effect waves-light m-b-5 center-block" type="button">Detail</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h6><i class="fa fa-image fa-2x"></i></h6></td>
                                            <td>
                                                <h6>Appolo Hospital</h6>
                                                <p>Kolkata</p>
                                            </td>
                                            <td>
                                                <h6></h6>
                                                <button class="btn btn-success waves-effect waves-light m-b-5 center-block" type="button">Detail</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h6><i class="fa fa-image fa-2x"></i></h6></td>
                                            <td>
                                                <h6>Appolo Hospital</h6>
                                                <p>Kolkata</p>
                                            </td>
                                            <td>
                                                <h6></h6>
                                                <button class="btn btn-success waves-effect waves-light m-b-5 center-block" type="button">Detail</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h6><i class="fa fa-image fa-2x"></i></h6></td>
                                            <td>
                                                <h6>Appolo Hospital</h6>
                                                <p>Kolkata</p>
                                            </td>
                                            <td>
                                                <h6></h6>
                                                <button class="btn btn-success waves-effect waves-light m-b-5 center-block" type="button">Detail</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h6><i class="fa fa-image fa-2x"></i></h6></td>
                                            <td>
                                                <h6>Appolo Hospital</h6>
                                                <p>Kolkata</p>
                                            </td>
                                            <td>
                                                <h6></h6>
                                                <button class="btn btn-success waves-effect waves-light m-b-5 center-block" type="button">Detail</button>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </aside>
                            <!-- Hospitals -->
                        </article>


                    </div>
                </aside>
                <!-- end medicart -->




                <!--  start Doctor Of The Month -->
                <aside class="col-md-4 detailbox">
                    <div class="bg-white">
                        <figure class="clearfix">
                            <div class="col-md-7 col-sm-8 p-0">
                                <h3>Doctor of the Month
                                    Nov 2014</h3>
                            </div>
                            <div class="col-md-5 col-sm-4 text-right">
                                <select class="form-control selectpicker m-tb-5" data-width="100%" >
                                    <option>All City</option>
                                    <option>Feb</option>
                                </select>
                            </div>
                        </figure>

                        <p class="text-center"><img src="<?php echo base_url(); ?>assets/images/users/avatar-1.jpg" class="img-responsive img-circle img-thumbnail m-t-20"></p>
                        <figcaption class="text-center">
                            <h3>Dr. Sambit Jain</h3>
                            <p>MBBS, MD</p>
                            <p>Cardiology</p>
                            <h3>Total Appointments : 172</h3>
                        </figcaption>

                        <figcaption class="clearfix text-center text-black">
                            <aside class="col-md-4 col-sm-4">
                                <div class="chart easy-pie-chart-1" data-percent="95">
                                    <span class="percent">95</span>
                                </div>
                                <p>Conversion Rate</p>
                            </aside>
                            <aside class="col-md-4 col-sm-4">
                                <div class="chart easy-pie-chart-2" data-percent="86">
                                    <span class="percent"></span>
                                </div>
                                <p>Booking Increment from Last Month</p>
                            </aside>
                            <aside class="col-md-4 col-sm-4">
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



            <!--Section Start -->
            <section class="clearfix m-t-30">
                <aside class="col-md-8">
                    <div class="bg-white clearfix">
                        <!--Line Chart Start -->
                        <article class="chartbox">
                            <figure class="clearfix">
                                <div class="col-md-9 col-sm-9 p-0">
                                    <h3>Revenue Trend</h3>
                                </div>
                                <div class="col-md-3 col-sm-3 text-right">
                                    <select class="selectpicker form-control m-tb-5 pull-right" data-width="100%" >
                                        <option>2015</option>
                                        <option>2014</option>
                                    </select>
                                </div>
                            </figure>
                            <figcaption>
                                <h4 class="text-left">INR(Lacs)</h4>
                                <canvas id="lineChart" data-type="Line" class="revenue-t"></canvas>
                            </figcaption>

                            <div class="clearfix">
                                <aside class="col-md-3 col-sm-3 p-b-20">
                                    <div id="donut-chart" style="height:150px;"></div>
                                </aside>
                                <aside class="col-md-3 col-sm-3">
                                    <ul class="num-label">
                                        <li><span></span> Diagnostic</li>
                                        <li><span class="bg-ong-red"></span>Health Package</li>
                                    </ul>
                                </aside>
                                <aside class="col-md-6 col-sm-6">
                                    <canvas id="single-bar" data-type="Bar" class="w-full"></canvas>
                                </aside>
                            </div>

                        </article>
                        <!-- Line Chart End -->
                    </div>
                    <!--Bar Chart Start -->
                    <div class="clearfix bg-white m-t-30">
                        <article class="chartbox">
                            <figure class="clearfix">
                                <div class="col-md-9 col-sm-9 p-0">
                                    <h3>Revenue Trend</h3>
                                </div>
                                <div class="col-md-3 col-sm-3 text-right">
                                    <select class="form-control selectpicker m-tb-5 pull-right" data-width="100%" >
                                        <option>2015</option>
                                        <option>2014</option>
                                    </select>
                                </div>
                            </figure>

                            <figcaption>
                                <canvas id="bar-chart" class="h-300" data-type="Bar"></canvas>
                            </figcaption>
                        </article>
                    </div>
                    <!--Bar Chart End -->
                </aside>

                <aside class="col-md-4">

                    <div class="clearfix bg-white m-t-30">
                        <figure class="clearfix border-full ">

                            <div class="col-md-6 col-xs-8">
                                <h3>MI/Doctors</h3>
                            </div>
                            <div class="col-md-6 col-xs-4 text-right">
                                <h4><a href="">View All</a></h4>
                            </div>
                        </figure>
                        <article class="text-center clearfix border-third">
                            <ul class="nav nav-tabs">
                                <li class="active col-md-6 col-xs-6">
                                    <a data-toggle="tab" href="#mi">MI</a>
                                </li>
                                <li class="col-md-6 col-xs-6 b-left">
                                    <a data-toggle="tab" href="#doc">Doctor</a>
                                </li>
                            </ul>
                        </article>

                        <article class="tab-content h380">

                            <!-- MII Section -->
                            <section class="tab-pane in active" id="mi">

                                <div tabindex="5000" style="overflow: hidden;" class="inbox-widget mCustomScrollbar mx-box">
                                    <aside class="table-responsive">
                                        <table class="table">
                                            <?php if(isset($MiList) && !empty($MiList)):
                                                    foreach($MiList as $mi): ?>
                                                
                                            <tr>
                                                <td>
                                                    <h6><img src="<?php echo base_url().$mi->imUrl;?>"></h6>
                                                </td>
                                                <td>
                                                    <h6><?php echo ucwords($mi->name);?></h6>
                                                    <p><?php echo ucwords($mi->city);?></p>
                                                </td>
                                                <td>
                                                    <h6><?php echo ucwords($mi->memberName);?></h6>
                                                </td>
                                                
                                                <td>
                                                    <h6></h6>
                                                    <?php if($mi->type == 'hospital'):?>
                                                    <a href="<?php echo site_url('hospital/detailHospital/'.$mi->id);?>" class="btn btn-success waves-effect waves-light m-b-5 center-block" >View</a>
                                                    <?php elseif($mi->type == 'diagnostic'):?>
                                                    <a href="<?php echo site_url('diagnostic/detailDiagnostic/'.$mi->id);?>" class="btn btn-success waves-effect waves-light m-b-5 center-block" >View</a>
                                                    <?php endif;?>
                                                </td>
                                            </tr>
                                                
                                            <?php endforeach;
                                                  endif;
?>

                                        </table>
                                    </aside>
                                </div>
                            </section>
                            <!--        MI Section -->
                            <!-- Doctor Section -->
                            <section class="tab-pane in" id="doc">
                                <div tabindex="5000" style="overflow: hidden;" class="inbox-widget mCustomScrollbar mx-box">
                                    <aside class="table-responsive">
                                        <table class="table">
                                            
                                            <?php if(isset($doctorList) && !empty($doctorList)):
                                                    foreach($doctorList as $doctor): ?>
                                                
                                           <tr>
                                                <td>
                                                    <h6><img src="<?php echo base_url().$doctor->imUrl;?>"></h6>
                                                </td>
                                                <td>
                                                    <h6><?php echo ucwords($doctor->doctoesName);?></h6>
                                                    <p><?php echo ucwords($doctor->city);?></p>
                                                </td>
                                                <td>
                                                   
                                                </td>
                                                <td>
                                                    <h6></h6>
                                                    <a href="<?php echo site_url('doctor/doctorDetails/'.$doctor->id);?>" class="btn btn-success waves-effect waves-light m-b-5 center-block">View</a>
                                                </td>
                                            </tr>
                                                
                                            <?php endforeach;
                                                  endif;
?>
                                  
                                        </table>
                                    </aside>
                                </div>
                            </section>
                            <!-- Doctor Section -->

                    </div>

                </aside>
            </section>
            <!--Section End-->


            <!-- start -->
            <section class="clearfix m-t-30">

                <article class="col-md-4 col-sm-4 chartbox">
                    <div class="bg-white">
                        <figure class="clearfix">
                            <div class="col-md-8 p-0">
                                <h3>MI Signup Distribution</h3>
                            </div>
                            <div class="col-md-4 text-right">
                                <select class="form-control selectpicker m-tb-5 pull-right" data-width="100%">
                                    <option>2015</option>
                                    <option>2014</option>
                                </select>
                            </div>
                        </figure>
                        <figcaption>
                            <div id="chart_div"></div>
                        </figcaption>
                    </div>
                </article>


                <article class="col-md-4 col-sm-4 chartbox">
                    <div class="bg-white">
                        <figure class="clearfix">
                            <div class="col-md-8 p-0">
                                <h3>Revenue Distribution</h3>
                            </div>
                            <div class="col-md-4 text-right">
                                <select class="form-control selectpicker m-tb-5 pull-right" data-width="100%">
                                    <option>2015</option>
                                    <option>2014</option>
                                </select>
                            </div>
                        </figure>
                        <figcaption>
                            <div id="chart_div_sec"></div>
                        </figcaption>
                    </div>
                </article>


                <article class="col-md-4 col-sm-4 chartbox">
                    <div class="bg-white">
                        <figure class="clearfix">
                            <div class="col-md-8 p-0">
                                <h3>Use Transaction Flow</h3>
                            </div>
                            <div class="col-md-4 text-right">
                                <select class="form-control selectpicker m-tb-5 pull-right" data-width="100%" >
                                    <option>2015</option>
                                    <option>2014</option>
                                </select>
                            </div>
                        </figure>
                        <figcaption>

                            <div id="chart_trans_flow"></div>
                        </figcaption>
                    </div>
                </article>

            </section>
            <!-- end -->




            <section>

                <!-- content -->
                <div class="mCustomScrollbar content2">
                </div>

            </section>






        </div>
        <!-- container -->
    </div>
    <!-- content -->



