<!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container row">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Rate & Review </h3>
                        </div>
                    </div>
                    <!-- Left Section Start -->
                    <section class="col-md-8 detailbox">
                        <!-- Form Section Start -->
                        <article class="row p-b-10">
                            <form name="csvDownload" id="" action="<?php echo site_url('reviews/createCSV'); ?>" method="post">
                                <aside class="col-md-3 col-sm-3">
                                    <select class="selectpicker" data-width="100%" id="searechReviews" onChange="filterReviews(this.value)" name="filter">
                                        <option value="all">All Reviews</option>
                                        <option value="rated">Top Rated</option>

                                    </select>
                                </aside>
                                <aside class="col-md-3 col-sm-3 m-tb-xs-3">
                                    <div class="input-group">
                                        <input class="form-control pickDate" placeholder="From" id="date-1" type="text" onkeydown="return false;" name="date-1">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        
                                    </div>
                                    
                                </aside>

                                <aside class="col-md-3 col-sm-3 m-tb-xs-3">
                                    <div class="input-group">
                                        <input class="form-control pickDate" placeholder="To" id="date-2" type="text" onkeydown="return false;" name="date-2">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                   
                                </aside>
                                <aside class="col-md-3 col-sm-3 pull-right">
                                      <button class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" type="submit">Export</button>
                                </aside>
                                <div id="date_error" class="error col-md-5 col-md-offset-3"></div>
 
                            </form>
                        </article>
                        <!-- Form Section End -->

                        <div class="bg-white" id="postList">
                            <!-- Table Section Start -->
                            <?php $i=1; if(!empty($reviews)){foreach($reviews as $review){?>
                                
                                <section class="col-md-12 review-profile">
                                <article class="col-md-12 m-t-20">
                                    <section class="clearfix">
                                          <aside class="col-md-10 col-sm-10 col-xs-12 p-0">
                                            <img src="<?php if(!empty($review['patientDetails_patientImg'])): echo base_url().'assets/patientImages/'.$review['patientDetails_patientImg'];else: echo base_url().'assets/images/imgpsh_fullsize.png'; endif;?>" alt="" class="img-responsive review-pic" />
                                            <h3><?php echo ucfirst($review['reviewBy']);?></h3>
<!--                                            <p>4 Reviews</p>-->
                                            <p class="cl-dull"><?php  if(!empty($review['days']) && $review['days'] != 0){echo isConvertDays($review['days']);}else{ echo isTimeCalculate($review['times']).' ago';}?> </p>
                                        </aside>
                                        <aside class="col-md-2 col-sm-2 text-right m-t-10">
                                            <span class="label label-success waves-effect waves-light m-b-5 center-block"><?php echo $review['reviews_rating'].".0";?></span>
                                        </aside>
                                    </section>
                                </article>
                                 <!-- comment box -->   
                                <article class="col-md-12 m-t-10">
                                    <p class="text-justify"><?php echo $review['reviews_details'];?></p>
                                    <?php if(!empty($review['reviews_post_details'])){?>
                                    <h3><?php echo ucwords($review['reviewTo']);?></h3>
                                    <aside class="well clearfix m-t-10">
                                       
                                        <p class="text-justify"><?php echo $review['reviews_post_details'];?></p>
                                        
                                        <h3>Reply On Behalf of <?php echo ucwords($review['reviewTo']);?></h3>
                                        
                                        <section class="clearfix m-t-10">

                                            <div class="col-md-12 clearfix text-right m-t-5">
                                                 <span style="display:none" class="text-success" id="success-post_<?php echo $i;?>">Your post successfully update.</span>
                                                <input type="checkbox" value="1" name="statuscheck" id="statuscheck_<?php echo $i;?>" <?php if($review['publish'] == 1){echo "checked";}?>/> publish
                                                <button class="btn btn-default btn-md" onClick="postPublish('<?php echo $i;?>','<?php echo $review['MiUserId'];?>','<?php echo $review['reviews_id'];?>');">Publish</button>
                                            </div>

                                        </section>
                                        
                                    </aside>
                                    <?php }else{ ?>
                                    <div id="message_box_<?php echo $i;?>">  
                                     <h3>Reply On Behalf of <?php echo ucwords($review['reviewTo']);?></h3>
                                    <aside class="well clearfix m-t-20">
                                        <div class="col-md-12">
                                            <span style="display:none" class="error" id="error-post_<?php echo $i;?>">Comment field can not be blank.</span>
                                            <textarea class="form-control" rows="1" id="message_<?php echo $i;?>"></textarea>
                                        </div>
                                        <div class="col-md-12 clearfix text-right m-t-5">
                                              <input type="checkbox" value="1" name="statuscheck" id="statuscheck_<?php echo $i;?>"/> publish
                                                <button class="btn btn-default btn-md" onClick="postComment('<?php echo $i;?>','<?php echo $review['MiUserId'];?>','<?php echo $review['reviews_id'];?>','<?php echo $review['reviewTo'];?>');">Post</button>
                                        </div>
                                    </aside>
                                    </div>
                                     
                                    <?php }?>
                                </article>
                                 <!-- comment box -->  
                                <hr class="" />
                            </section>
                                
                                <?php  $i++;}}else{?>
                                 <section class="col-md-12"><h5 class="text-danger">Records not found.</h5></section>
                                <?php }?>

                            <!-- Table Section End -->
                            <article class="clearfix m-t-20 p-b-20">
                                 <?php echo $this->ajax_pagination->create_links(); ?>
                                
                            </article>
                            
                        </div>

                    </section>
                    <!-- Left Section End -->



                    <!-- Right Section Start -->
                    <section class="col-md-4 detailbox">
                        <div class="bg-white">
                            <figure class="clearfix">
                                <h3>Recent Rated</h3>
                            </figure>


                            <!--Recently Rated -->
                            <article class="clearfix m-t-30">

                                <div tabindex="5000" style="overflow: hidden;" class="inbox-widget nicescroll mx-box">
                                    <table class="table rating-table">
                                        <?php if(!empty($topRateds)):
                                                foreach($topRateds as $rated):
                                            if(!empty($rated->rat)):?>
                                        
                                          <tr>
                                            <td>
                                                <h6><img src="<?php if(!empty($rated->doctors_img)): echo base_url().'assets/doctorsImages/thumb/thumb_100/'.$rated->doctors_img;else: echo base_url().'assets/images/imgpsh_fullsize.png'; endif;?>" alt="" class="img-responsive" width="65" height="65"/></h6>
                                            </td>
                                            <td>
                                                <h6><?php echo ucwords($rated->name);?></h6>
                                                <p><?php //echo isConvertDays($rated->days);?>
                                                <?php  if(!empty($rated->dates)){
                                                         $currentDate = date_create(date('Y-m-d'));
                                                         $ratingDate = date_create(date('Y-m-d',$rated->dates));
                                                         $diff12 = date_diff($ratingDate, $currentDate);
                                                         if($diff12->d){
                                                             echo isConvertDays($diff12->d);
                                                         }else{
                                                                $times = date('H:i:s',$rated->time);
                                                                echo isTimeCalculate($times). ' ago';
                                                         }
                                                }?></p>
<!--                                                <p><?php //echo isTimeCalculate(date('H:i:s',strtotime($rated->time)));?></p>-->
                                                <p><?php echo ucwords($rated->cityName);?></p>
                                            </td>
                                            <td>
                                                <h6></h6>
                                                <span class="label label-success waves-effect waves-light m-b-5 center-block"><?php echo ucwords($rated->rat);?></span>
                                            </td>
                                        </tr>
                                            
                                       <?php endif;endforeach;
                                        endif; ?>
                        

                                    </table>
                                </div>
                            </article>
                            <!--Recently Rated -->
                        </div>
                    </section>
                    <!-- Right Section End -->

                </div>

                <!-- container -->
            </div>
            <!-- content -->
