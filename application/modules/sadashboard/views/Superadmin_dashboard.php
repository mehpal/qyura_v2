
<!-- Start right Content here -->
<div class="content-page ">
    <!-- Start content -->
    <div class="content si-dashboard">
        <div class="container">
            <!--   start section 1 -->
            <section class="clearfix">
                <!--start MI-->
<!--                <aside class=" col-md-3 col-sm-6 m-b-10">
                    <article class="clearfix  r-box">
                        <h4 class="">Total Registered <br>Medical Institutions</h4>

                        <p><?php //if(isset($MI) && !empty($MI)): echo $MI[0]->t;else: echo '0';endif;?></p>
                    </article>
                    <article class="r-box-bottom"><a href="<?php //echo site_url('hospital');?>">view all</a></article>
                </aside>-->
                <!--end MI-->
                  <aside class="col-md-3 col-sm-6 m-b-10">
                    <article class="clearfix  b-box">
                        <h4 class="">Total Registered <br>
                            Ambulance</h4>

                        <p><?php if(isset($ambulance) && !empty($ambulance)): echo $ambulance[0]->t;else: echo '0';endif;?></p>
                    </article>
                    <article class="b-box-bottom"><a href="<?php echo site_url('ambulance');?>">view all</a></article>
                </aside>
                
                  <aside class="col-md-3 col-sm-6 m-b-10">
                    <article class="clearfix  y-box">
                        <h4 class="">Total Registered <br>
                            Pharmacy</h4>

                        <p><?php if(isset($pharmacy) && !empty($pharmacy)): echo $pharmacy[0]->t;else: echo '0';endif;?></p>
                    </article>
                    <article class="y-box-bottom"><a href="<?php echo site_url('pharmacy');?>">view all</a></article>
                </aside>
                
                  <aside class="col-md-3 col-sm-6 m-b-10">
                    <article class="clearfix  g-box">
                        <h4 class="">Total Registered <br>
                            BloodBank</h4>

                        <p><?php if(isset($bloodbank) && !empty($bloodbank)): echo $bloodbank[0]->t;else: echo '0';endif;?></p>
                    </article>
                    <article class="g-box-bottom"><a href="<?php echo site_url('bloodbank');?>">view all</a></article>
                </aside>
                  <aside class="col-md-3 col-sm-6 m-b-10">
                    <article class="clearfix  a-box">
                        <h4 class="">Total Registered <br>
                            Diagnostic</h4>

                        <p><?php if(isset($diagnostic) && !empty($diagnostic)): echo $diagnostic[0]->t;else: echo '0';endif;?></p>
                    </article>
                    <article class="a-box-bottom"><a href="<?php echo site_url('diagnostic');?>">view all</a></article>
                </aside>
                  <aside class="col-md-3 col-sm-6 m-b-10">
                    <article class="clearfix  c-box">
                        <h4 class="">Total Registered <br>
                            Hospital</h4>

                        <p><?php if(isset($hospital) && !empty($hospital)): echo $hospital[0]->t;else: echo '0';endif;?></p>
                    </article>
                    <article class="c-box-bottom"><a href="<?php echo site_url('hospital');?>">view all</a></article>
                </aside>
                
                <!--start total DOC-->
                <aside class="col-md-3 col-sm-6 m-b-10">
                    <article class="clearfix  d-box">
                        <h4 class="">Total Registered <br>
                            Doctors</h4>

                        <p><?php if(isset($doctorList) && !empty($doctorList)): echo count($doctorList);else: echo '0';endif;?></p>
                    </article>
                    <article class="d-box-bottom"><a href="<?php echo site_url('doctor');?>">view all</a></article>
                </aside>
                <!--end total Doc-->
                <!--start profile visits-->
                <aside class="col-md-3 col-sm-6 m-b-10">
                    <article class="clearfix  r-box">
                        <h4 class="">Total Registered <br>
                            Users</h4>

                        <p><?php if(isset($User) && !empty($User)): echo $User[0]->totalUser;else: echo '0';endif;?></p>
                    </article>
                    <article class="r-box-bottom"><a href="<?php echo site_url('users');?>">view all</a></article>
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
                                <input type="" class="search pull-right" id="search-text-appointment"/>
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
                                        <table class="table app_consult">
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
                                                <?php if(!empty($consultAppoinement)):
                                                        foreach($consultAppoinement as $consult):?>
                                                   
                                                    <tr>
                                                    <td width="20%">
                                                        <h6><?php echo $consult->orderId;?></h6>
                                                        <p><?php echo $consult->userName;?></p>
                                                        <p><?php echo getGender($consult->userGender);?> | <?php echo $consult->userAge;?></p>
                                                    </td>
                                                    <td>
                                                        <h6><?php echo $consult->userName;?></h6>
                                                        <p><?php echo getGender($consult->userGender);?> | <?php echo $consult->userAge;?></p>
                                                    </td>
                                                    <td>
                                                        <h6>Dr. <?php echo ucwords($consult->title);?></h6>
                                                        <p><?php echo ucwords($consult->speciality);?></p>
                                                    </td>
                                                    <td>
                                                        <h6><?php echo ucwords($consult->MIname);?></h6>
                                                        <p><?php echo ucwords($consult->city_name);?></p>
                                                    </td>
                                                    <td>
                                                        <h6></h6>
                                                        <a href="<?php echo site_url('miappointment/consultingDetail/'.$consult->id);?>" class="btn btn-success waves-effect waves-light m-b-5">Detail</a>
                                                    </td>
                                                </tr>
                                                
                                                    
                                                <?php endforeach;
                                                endif;
?>
                                  
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
                                        <table class="table app_consult">
                                            <thead>
                                                <tr class="border-a-dull">
                                                    <th>
                                                        Appt. Details</th>
                                                    <th>
                                                        Patient
                                                    </th>
                                                 
                                                    <th>
                                                        Hospital
                                                    </th>
                                                    <th>Detail</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                   <?php if(!empty($diagnosticAppointmnt)):
                                                        foreach($diagnosticAppointmnt as $diag):?>
                                                <tr>
                                                    <td>
                                                        <h6><?php echo $diag->orderId;?></h6>
                                                        <p><?php echo $diag->userName;?></p>
                                                        <p><?php echo getGender($diag->userGender);?> | <?php echo $diag->userAge;?></p>
                                                    </td>
                                                    <td>
                                                        <h6><?php echo $diag->userName;?></h6>
                                                        <p><?php echo getGender($diag->userGender);?> | <?php echo $diag->userAge;?></p>
                                                    </td>
                                                
                                                    <td>
                                                        <h6><?php echo $diag->MIname;?></h6>
                                                        <p><?php echo $diag->city;?></p>
                                                    </td>
                                                    <td>
                                                        <h6></h6>
                                                        <a href="<?php echo site_url('miappointment/detail/'.$diag->quotation_id); ?>" class="btn btn-success waves-effect waves-light m-b-5">Detail</a>
                                                    </td>
                                                </tr>
                                                
                                                 <?php endforeach;
                                                endif;
?>
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
                                <input type="" class="search pull-right" id="search-text"/>
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
                                <table class="table" id="list">
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
                                                <a href="<?php echo site_url('quotation/viewPrescription/'.$quot->quotation_idf);?>" class="btn btn-success waves-effect waves-light m-b-5" >Detail</a>
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
                                <h3>Top 7 Hospital of 
                                    The Month ( <?php echo date('F Y');?> ) </h3>
                            </div>
                            <div class="col-md-5 col-sm-4 text-right">
                                <select class="form-control selectpicker m-tb-5" id="search-city" data-width="100%">
                                    <option>All City</option>
                                    <?php if(!empty($cityList)):
                                            foreach($cityList as $city):?>
                                            
                                            <option value="<?php echo ucwords($city->city_name);?>"><?php echo ucwords($city->city_name);?></option>
                                            
                                          <?php  endforeach;
                                          endif;
?>
                                </select>
                            </div>
                        </figure>

                        <article class="tab-content">

                            <!--Hospitals -->
                            <aside class="table-responsive" id="hospitalList">
                                <table class="table">
                                    <tbody>
                                    <?php if(isset($topHospital) && !empty($topHospital)): 
                                            foreach($topHospital as $list):?>
                                        
                                              <tr>
                                            <td>
                                                <h6><img src="<?php echo base_url().$list->imUrl;?>"></h6></td>
                                            <td>
                                                <h6><?php echo ucwords($list->name);?></h6>
                                                <p><?php echo ucwords($list->city);?></p>
                                            </td>
                                            <td>
                                                <h6></h6>
                                                <a href="<?php echo site_url('hospital/detailHospital/'.$list->id);?>" class="btn btn-success waves-effect waves-light m-b-5 center-block" >View</a>
                                            </td>
                                        </tr>
                                        
                                          <?php  endforeach;
                                        endif;?>

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
                                    <?php echo date('F Y')?></h3>
                            </div>
                            <div class="col-md-5 col-sm-4 text-right">
                                <select class="form-control selectpicker m-tb-5" id="doctorselectCity"  onchange="doctorOftheMonthByCity(this.value)" data-width="100%" >
                                    <option>All City</option>
                                                                       <?php if(!empty($cityList)):
                                            foreach($cityList as $city):?>
                                            
                                            <option value="<?php echo $city->city_id;?>"><?php echo ucwords($city->city_name);?></option>
                                            
                                          <?php  endforeach;
                                          endif;
?>
                                </select>
                            </div>
                        </figure>
                        <div id="doctorOftheMonthDiv">
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
                            <h3>Total Appointments : <?php if(!empty($doctorOfMonth)): echo $doctorOfMonth[0]->totalapp; endif;?></h3>
                        </figcaption>

           


</div>
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
                        
                  <div class="clearfix bg-white">
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
                        </article>
                    </div>
                        
                    </div>
                    
                </aside>

                <aside class="col-md-4">

                    
                         <article class=" chartbox">
                    <div class="bg-white">
                        <figure class="clearfix">
                            <div class="col-md-8 p-0">
                                <h3>MI Signup Distribution</h3>
                            </div>
                            <div class="col-md-4 text-right">
                                <select class="form-control selectpicker m-tb-5 pull-right" id="chartYear" onchange="getChartYear(this.value)" data-width="100%">
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                </select>
                                <input type="hidden" id="urls" value="<?php echo base_url();?>" />
                            </div>
                        </figure>
                        <figcaption>
                            <div id="chart_div"></div>
                        </figcaption>
                    </div>
                </article>
                    
                    
               

                </aside>
            </section>
 


            <!-- start -->
            <section class="clearfix m-t-30">

         
            <section>

                <!-- content -->
                <div class="mCustomScrollbar content2">
                </div>

            </section>






        </div>
        <!-- container -->
    </div>
    <!-- content -->



