   <div class="bg-white" id="postList">
                            <!-- Table Section Start -->
                            <?php $i=1; if(!empty($reviews)){foreach($reviews as $review){?>
                                
                                <section class="col-md-12 review-profile">
                                <article class="col-md-12 m-t-20">
                                    <section class="clearfix">
                                          <aside class="col-md-10 col-sm-10 col-xs-12 p-0">
                                            <img src="<?php if(!empty($review['patientDetails_patientImg'])): echo base_url().'assets/patientImages/'.$review['patientDetails_patientImg'];else: echo base_url().'assets/images/noImage.png'; endif;?>" alt="" class="img-responsive review-pic" />
                                            <h3><?php echo ucfirst($review['reviewBy']);?></h3>
<!--                                            <p>4 Reviews</p>-->
                                            <p class="cl-dull"><?php echo isTimeCalculate($review['times']);?> Ago</p>
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
                                        
                                        <h3>Reply Behalf of <?php echo ucwords($review['reviewTo']);?></h3>
                                        
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
                                     <h3>Reply Behalf of <?php echo ucwords($review['reviewTo']);?></h3>
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