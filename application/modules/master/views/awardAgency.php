<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="clearfix">
                <div class="col-md-12">
                    <h3 class="pull-left page-title">Award Agency list</h3>
                    <div id="load_consulting" class="text-center text-success " style="display: none"><image alt="Please wait data is loading" src="<?php echo base_url('assets/images/loader/Heart_beat.gif'); ?>" /></div>
                </div>
            </div>
            <!-- Left Section Start -->
            <section class="col-md-7 detailbox m-b-20">
                <aside class="bg-white">
                    <div class="nicescroll mxh-400" style="overflow: hidden;" tabindex="5000">
                        <div class="col-sm-12 p-t-20 p-b-20">
                            <form name="awardAgencyEdit" action="#" id="awardAgencyEdit" method="post">
                            <?php $countAgency = 1; if(isset($awardAgency_list) && $awardAgency_list != NULL){ 
                                foreach ($awardAgency_list as $awardAgency){ ?>
                                <article class="clearfix degrees membership-plan">
                                    <aside class="col-md-10 col-sm-10 col-xs-10">
                                        <?php echo $awardAgency->agency_name; ?>
                                    </aside>
                                   
                                    <aside class="col-lg-2 col-sm-2 col-xs-2">
                                        <a href="#"><i class="md md-edit membership-btn"></i></a>
                                        <a href="javascript:void(0)" onclick="enableFn('master', 'awardAgencyPublish', '<?php echo $awardAgency->awardAgency_id; ?>','<?php echo $awardAgency->status; ?>')" title='<?php if($awardAgency->status == 2){ echo "Publish"; }else{ echo "Unpublish"; } ?> Award Agency' class="pull-right m-l-10 "><i class="fa fa-thumbs-<?php if($awardAgency->status == 3){ echo "up"; }else{ echo "down danger"; } ?>"></i></a>
                                    </aside>
                                </article>
                                <div class="newmembership" style="display:none">
                                    <aside class="col-md-10">
                                        <input type="hidden" id="awardAgency_id_<?php echo $countAgency; ?>" name="awardAgency_id_<?php echo $countAgency; ?>" value="<?php echo $awardAgency->awardAgency_id	; ?>" >
                                        <input type="text" required="" name="agency_name_<?php echo $countAgency; ?>" id="agency_name_<?php echo $countAgency; ?>" class="form-control" value="<?php if($awardAgency->agency_name){ echo $awardAgency->agency_name; }else{echo ''; } ?>">
                                        <label class="error" id="agency_name_<?php echo $countAgency; ?>" > <?php echo form_error("agency_name_$countAgency"); ?></label>
                                    </aside>
                                   
                                    <aside class="col-md-2">
                                        <button class="" type="submit" title="Save"><i class="fa fa-floppy-o membership-btn"></i></button>
                                        <a href="#" style="line-height: 2"><i class="md md-cancel membership-btn"></i></a>
                                    </aside>
                                </div>
                            <?php $countAgency++;} } ?>
                                <input type="hidden" id="total_count" name="total_count" value="<?php echo $countAgency; ?>" >
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
                            <h3>Add Award Agency</h3>
                        </figure>
                        <!-- Add Category -->
                        <div class="col-sm-12">
                            <form name="awardAgencyform" action="#" id="awardAgencyform" method="post">
                               
                                <article class="clearfix m-t-30">
                                    <label for="" class="control-label">Award Agency Name :</label>
                                    <div class="">
                                        <input class="form-control m-t-10" id="agency_name" type="text" name="agency_name" placeholder="">
                                        <label class="error" id="err_agency_name" > <?php echo form_error("agency_name"); ?></label>
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
