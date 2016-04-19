<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="clearfix">
                <div class="col-md-12">
                    <h3 class="pull-left page-title">Degrees</h3>
                    <div id="load_consulting" class="text-center text-success " style="display: none"><image alt="Please wait data is loading" src="<?php echo base_url('assets/images/loader/Heart_beat.gif'); ?>" /></div>
                </div>
            </div>
            <!-- Left Section Start -->
            <section class="col-md-7 detailbox m-b-20">
                <aside class="bg-white">
                    <div class="nicescroll mxh-400" style="overflow: hidden;" tabindex="5000">
                        <div class="col-sm-12 p-t-20 p-b-20">
                            <form name="degreeEditForm" action="#" id="degreeEditForm" method="post">
                            <?php $countDegree = 1; if(isset($degrees_list) && $degrees_list != NULL){ 
                                foreach ($degrees_list as $degrees){ ?>
                                <article class="clearfix degrees membership-plan">
                                    <aside class="col-md-3 col-sm-3 col-xs-12">
                                        <?php echo $degrees->degree_SName; ?>
                                    </aside>
                                    <aside class="col-lg-7 col-sm-7 col-xs-10">
                                        <?php echo $degrees->degree_FName; ?>
                                    </aside>
                                    <aside class="col-lg-2 col-sm-2 col-xs-2">
                                        <a href="#" style="line-height: 1.8"><i class="md md-edit membership-btn"></i></a>
                                        <button onclick="enableFn('master', 'degreePublish', '<?php echo $degrees->degree_id; ?>','<?php echo $degrees->status; ?>')" title='<?php if($degrees->status == 2){ echo "Publish"; }else{ echo "Unpublish"; } ?> Degree' type="button" class="btn"><i class="fa fa-thumbs-<?php if($degrees->status == 3){ echo "up"; }else{ echo "down danger"; } ?>"></i></button>
                                    </aside>
                                </article>
                                <div class="newmembership" style="display:none">
                                    <aside class="col-md-5">
                                        <input type="hidden" id="degree_id_<?php echo $countDegree; ?>" name="degree_id_<?php echo $countDegree; ?>" value="<?php echo $degrees->degree_id; ?>" >
                                        <input type="text" required="" name="degree_SName_<?php echo $countDegree; ?>" id="degree_SName_<?php echo $countDegree; ?>" class="form-control" value="<?php if($degrees->degree_SName){ echo $degrees->degree_SName; }else{echo ''; } ?>">
                                        <label class="error" id="degree_SName_<?php echo $countDegree; ?>" > <?php echo form_error("degree_SName_$countDegree"); ?></label>
                                    </aside>
                                    <aside class="col-md-5">
                                        <input type="text" required="" name="degree_FName_<?php echo $countDegree; ?>" id="degree_FName_<?php echo $countDegree; ?>" class="form-control" value="<?php if($degrees->degree_FName){ echo $degrees->degree_FName; }else{echo ''; } ?>">
                                        <label class="error" id="hospitalType_name_<?php echo $countDegree; ?>" > <?php echo form_error("degree_FName_$countDegree"); ?></label>
                                    </aside>
                                    <aside class="col-md-2">
                                        <button class="" type="submit" title="Save"><i class="fa fa-floppy-o membership-btn"></i></button>
                                        <a href="#"><i class="md md-cancel membership-btn"></i></a>
                                    </aside>
                                </div>
                            <?php $countDegree++;} } ?>
                                <input type="hidden" id="total_count" name="total_count" value="<?php echo $countDegree; ?>" >
                            </form>
                        </div>
                    </div>
                </aside>
            </section>
            <!-- Left Section End -->
            <!-- Right Section Start -->
            <section class="col-md-5 detailbox">
                <div class="bg-white">
                    <aside class="clearfix">
                        <!-- Appointment Chart -->
                        <figure class="text-center">
                            <h3>Add Degree</h3>
                        </figure>
                        <!-- Add Category -->
                        <div class="col-sm-12">
                            <form name="degreeForm" action="#" id="degreeForm" method="post">
                                <article class="clearfix m-t-30">
                                    <label for="" class="control-label">Full Name of Degree :</label>
                                    <div class="">
                                        <input class="form-control m-t-10" id="degree_FName" type="text" name="degree_FName" placeholder="Medicinae Baccalaureus and Bachelor of Surgery">
                                        <label class="error" id="err_degree_FName" > <?php echo form_error("doctors_fName"); ?></label>
                                    </div>
                                </article>
                                <article class="clearfix m-t-30">
                                    <label for="" class="control-label">Abbrivation :</label>
                                    <div class="">
                                        <input class="form-control m-t-10" id="degree_SName" type="text" name="degree_SName" placeholder="MBBS">
                                        <label class="error" id="err_degree_SName" > <?php echo form_error("doctors_fName"); ?></label>
                                    </div>
                                </article>
                                <article class="clearfix m-t-10 m-b-20">
                                    <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Submit</button>
                                </article>
                            </form>
                        </div>
                        <!-- Add Category -->
                    </aside>
                </div>
            </section>
            <!-- Right Section End -->
        </div>
        <!-- container -->
    </div>
    <!-- content -->
