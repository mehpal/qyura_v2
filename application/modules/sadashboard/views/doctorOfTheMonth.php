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

<!--                        <figcaption class="clearfix text-center text-black">
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
                        </figcaption>-->