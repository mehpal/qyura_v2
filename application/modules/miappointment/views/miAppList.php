<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="clearfix">
                <div class="col-md-12">
                    <h3 class="pull-left page-title">MI Appointments</h3>

                </div>
            </div>

            <!-- Left Section Start -->
            <section class="col-md-12 detailbox">


                <!-- Form Section Start -->
                <article class="row p-b-10">
                    <form>
                        <aside class="col-md-2 col-sm-2">
                            <a title="Add Appointment" href="<?php echo site_url() ?>/miappointment/add_appointment/" class="btn btn-appointment waves-effect waves-light"><i class="fa fa-plus"></i> Add</a>
                        </aside>
                        <aside class="col-md-3 col-sm-3 m-tb-xs-3">
                            <div class="input-group">
                                <input type="text"  id="date-1" placeholder="From" class="form-control pickDate">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </aside>

                        <aside class="col-md-3 col-sm-3 m-tb-xs-3">
                            <div class="input-group">
                                <input type="text"  id="date-2" placeholder="To" class="form-control pickDate">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </aside>
                        <aside class="col-md-2 col-sm-2 m-tb-xs-3">
                            <input type="text" id="search" placeholder="Search" class="form-control" name="search">
                        </aside>
                        <!--<aside class="col-md-2 col-sm-2">
                            <button type="submit" class="btn btn-appointment waves-effect waves-light m-l-10 pull-right">Export</button>
                        </aside>-->

                    </form>
                </article>
                <!-- Form Section End -->
                <div class="bg-white">
                    <figure class="clearfix">
                        <div class="col-md-10 col-xs-9 p-0">
                            <h3>Appointment</h3>
                        </div>
                        <div class="col-md-2 col-xs-3 text-right">
                            <a class="search-icon" href="#"><i class="fa fa-search"></i></a>
                        </div>
                    </figure>


                    <article class="text-center clearfix border-third">
                        <ul class="nav nav-tabs">
                            <li id="li_consulting" class="active col-md-4 col-xs-4">
                                <a href="#consulting" data-toggle="tab">Consulting</a>
                            </li>
                            <li id="li_diagnostic" class="col-md-4 col-xs-4 b-left">
                                <a href="#diagnostic" data-toggle="tab">Diagnostics</a>
                            </li>
                             
                        </ul>
                    </article>



                    <article class="tab-content">
                        
                        <!-- consulting -->
                        <section id="consulting" class="tab-pane fade in active sa-cons">
                            <!--<div id="load_consulting" class="text-center text-success "><image alt="Please wait data is loading" src="<?php echo base_url('assets/images/loader/Heart_beat.gif'); ?>" /></div>-->
                            <aside class="table-responsive">
                                <table class="table applist-table" id="datatble_consulting">
                                    <thead>
                                        <tr class="border-a-dull">
                                            <th>Appt. Detail</th>
                                            <th>Patient</th>
                                            <th>Doctor</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    <thead>
                                </table>
                            </aside>
                            <!-- Table Section End -->
                            <!--                                    <aside class="clearfix m-t-20 p-b-20">
                                                                    <ul class="list-inline list-unstyled call-pagination">
                                                                        <li class="disabled"><a href="#">Prev</a></li>
                                                                        <li><a href="#">1</a></li>
                                                                        <li class="active"><a href="#">2</a></li>
                                                                        <li><a href="#">3</a></li>
                                                                        <li><a href="#">4</a></li>
                                                                        <li><a href="#">Next</a></li>
                                                                    </ul>
                                                                </aside>-->
                        </section>
                        <!-- consulting -->

                        <!-- diagnostic -->
                        <section id="diagnostic" class="tab-pane fade in sa-cons">
                            <!--<div id="load_diagnostic" class="text-center text-success "><image alt="Please wait data is loading" src="<?php echo base_url('assets/images/loader/Heart_beat.gif'); ?>" /></div>-->
                            <aside class="table-responsive">

                                <table class="table diagnostic-table" id="datatable_diagnostic">

                                    <thead>
                                        <tr class="border-a-dull">
                                            <th>Appt. Detail</th>
                                            <th>Patient</th>
                                            <th>Diagnostics</th>
                                            <th>Diagnostics Center</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </aside>
                            <!-- Table Section End -->
                            <!--                                    <aside class="clearfix m-t-20 p-b-20">
                                                                    <ul class="list-inline list-unstyled call-pagination pull-right">
                                                                        <li class="disabled"><a href="#">Prev</a></li>
                                                                        <li><a href="#">1</a></li>
                                                                        <li class="active"><a href="#">2</a></li>
                                                                        <li><a href="#">3</a></li>
                                                                        <li><a href="#">4</a></li>
                                                                        <li><a href="#">Next</a></li>
                                                                    </ul>
                                                                </aside>-->
                        </section>
                        <!-- diagnostic -->
                        
                         <!-- healthpkg -->
                        
                        <!-- healthpkg -->
                        
                    </article>
                </div>
            </section>
            <!-- Left Section End -->



            <!-- Right Section Start -->
            <section class="col-md-4 detailbox">
                <div class="bg-white">




                    <!--                     Appointment Chart 
                    <article class="chartbox ">
                        <div class="bg-white">
                            <figure class="clearfix">
                                <aside class="col-md-9 col-xs-9 p-0">
                                    <h3>Appointment Chart</h3>
                                </aside>
                                <aside class="col-md-3 col-xs-3 m-t-8">
                                    <div class="control-label pull-right">
                                        <div class="toggle toggle-success" style="height: 20px; width: 60px;"><div class="toggle-slide active"><div class="toggle-inner" style="width: 100px; margin-left: 0px;"><div class="toggle-on active" style="height: 20px; width: 50px; text-align: center; text-indent: -10px; line-height: 20px;">Year</div><div class="toggle-blob" style="height: 20px; width: 20px; margin-left: -10px;"></div><div class="toggle-off" style="height: 20px; width: 50px; margin-left: -10px; text-align: center; text-indent: 10px; line-height: 20px;">Month</div></div></div></div>
                                    </div>
                                </aside>
                            </figure>
                            <aside>
                                <div id="chart_appoint_detail"><div style="position: relative;"><div style="position: relative; width: 319px; height: 200px;" dir="ltr"><div style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;" aria-label="A chart."><svg width="319" height="200" style="overflow: hidden;" aria-label="A chart."><defs id="defs"/><g><rect x="199" y="38" width="59" height="26" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/><g><rect x="199" y="38" width="59" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/><g><text text-anchor="start" x="213" y="46.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#808080">Consult…</text><rect x="213" y="38" width="45" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/></g><circle cx="204" cy="43" r="5" stroke="none" stroke-width="0" fill="#41cdb2"/></g><g><rect x="199" y="54" width="59" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/><g><text text-anchor="start" x="213" y="62.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#808080">Diagno…</text><rect x="213" y="54" width="45" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/></g><circle cx="204" cy="59" r="5" stroke="none" stroke-width="0" fill="#f7f3e7"/></g></g><g><path d="M122,100L122,39A61,61,0,0,1,171.3500366568718,135.85490038984085L122,100A0,0,0,0,0,122,100" stroke="#ffffff" stroke-width="1" fill="#41cdb2"/><text text-anchor="start" x="146.58206805189198" y="85.6247935066656" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#000000">35%</text></g><g><path d="M122,100L171.3500366568718,135.85490038984085A61,61,0,1,1,122,39L122,100A0,0,0,1,0,122,100" stroke="#ffffff" stroke-width="1" fill="#f7f3e7"/><text text-anchor="start" x="76.41793194810802" y="121.37520649333442" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#000000">65%</text></g><g/></svg><div aria-label="A tabular representation of the data in the chart." style="position: absolute; left: -10000px; top: auto; width: 1px; height: 1px; overflow: hidden;"><table><thead><tr><th>Pizza</th><th>Populartiy</th></tr></thead><tbody><tr><td>Consultation</td><td>35</td></tr><tr><td>Diagnostic</td><td>65</td></tr></tbody></table></div></div></div><div style="display: none; position: absolute; top: 210px; left: 329px; white-space: nowrap; font-family: Arial; font-size: 10px;" aria-hidden="true">Diagnos…</div><div></div></div></div>
                            </aside>
                        </div>
                        <form class="form-horizontal m-t-10" role="form">
                            <aside class="clearfix call-track-form text-center p-b-20">

                                <div class="col-md-5 col-md-offset-1 col-sm-4 col-sm-offset-2">
                                    <div class="btn-group bootstrap-select" style="width: 100%;"><button data-toggle="dropdown" class="btn dropdown-toggle btn-default" type="button" title="2015"><span class="filter-option pull-left">2015</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu open"><ul role="menu" class="dropdown-menu inner"><li data-original-index="0" class="selected"><a data-tokens="null" style="" class="" tabindex="0"><span class="text">2015</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a data-tokens="null" style="" class="" tabindex="0"><span class="text">2014</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a data-tokens="null" style="" class="" tabindex="0"><span class="text">2013</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="3"><a data-tokens="null" style="" class="" tabindex="0"><span class="text">2012</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="4"><a data-tokens="null" style="" class="" tabindex="0"><span class="text">2011</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div><select data-width="100%" class="selectpicker" tabindex="-98">
                                            <option>2015</option>
                                            <option>2014</option>
                                            <option>2013</option>
                                            <option>2012</option>
                                            <option>2011</option>
                                        </select></div>
                                </div>

                                <div class="col-md-5 col-sm-4 m-tb-xs-3">
                                    <div class="btn-group bootstrap-select" style="width: 100%;"><button data-toggle="dropdown" class="btn dropdown-toggle btn-default" type="button" title="Jan"><span class="filter-option pull-left">Jan</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu open"><ul role="menu" class="dropdown-menu inner"><li data-original-index="0" class="selected"><a data-tokens="null" style="" class="" tabindex="0"><span class="text">Jan</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a data-tokens="null" style="" class="" tabindex="0"><span class="text">Feb</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a data-tokens="null" style="" class="" tabindex="0"><span class="text">Mar</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="3"><a data-tokens="null" style="" class="" tabindex="0"><span class="text">Apr</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div><select data-width="100%" class="selectpicker" tabindex="-98">
                                            <option>Jan</option>
                                            <option>Feb</option>
                                            <option>Mar</option>
                                            <option>Apr</option>
                                        </select></div>
                                </div>
                            </aside>
                        </form>
                    </article>
                    Appointment Chart End 

                      start Doctor Of The Month 
                    <article>
                        <figcaption class="clearfix m-t-30">
                            <figure class="clearfix">
                                <h3 class="h3-small">Appointment Trends ( Last Month Comparison)</h3>
                            </figure>
                            <div class="clearfix m-t-30">
                                <aside class="col-md-5 col-sm-5">
                                    <div data-percent="21" class="chart easy-pie-chart-3" id="consulationChart">
                                        <span class="percent">21</span>
                                        <canvas height="110" width="110"></canvas></div>
                                    <p>Consultation</p>
                                </aside>
                                <aside class="col-md-2 col-sm-2 m-t-50">
                                    <i class="fa fa-level-up cl-light-green"></i>
                                    <i class="fa fa-level-down cl-gray"></i>
                                </aside>
                                <aside class="col-md-5 col-sm-5">
                                    <div data-percent="77" class="chart easy-pie-chart-3" id="diagnosticChart">
                                        <span class="percent">77</span>
                                        <canvas height="110" width="110"></canvas></div>
                                    <p>Diagnostic</p>
                                </aside>
                            </div>
                        </figcaption>
                    </article>
                     end Doctor Of The Month 


                    Revenue Trend bar Chart 
                    <article class="chartbox m-t-30">
                        <div class="bg-white">
                            <figure class="clearfix">
                                <h3>Appointment Chart</h3>
                            </figure>
                            <aside>
                                <canvas height="200" data-type="Bar" id="revenue_trend" class="bar-chart" width="319" style="width: 319px; height: 200px;"></canvas>

                            </aside>
                        </div>
                    </article>
                    Revenue Trend bar Chart -->

                </div>
            </section>
            <!-- Right Section End -->

        </div>
<!--        popup for chANGE TIME-->
        <div id="changetime"> </div> 
        <!-- container -->
    </div>
    <!-- content -->
    <footer class="footer text-right">
        2015 &copy; Qyura.
    </footer>
</div>
