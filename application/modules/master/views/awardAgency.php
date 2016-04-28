<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="clearfix">
                <div class="col-md-12">
                    <h3 class="pull-left page-title">Award Agencies</h3>
                    <div id="load_consulting" class="text-center text-success " style="display: none"><image alt="Please wait data is loading" src="<?php echo base_url('assets/images/loader/Heart_beat.gif'); ?>" /></div>
                </div>
            </div>
            <!-- Left Section Start -->
            <section class="col-md-7 detailbox m-b-20">
                <aside class="bg-white">
                <figure class="clearfix">
                        <h3>Available Award Agenices</h3>
                        <article class="clearfix">
                            <div class="input-group m-b-5">
                                <span class="input-group-btn">
                                    <button type="button" class="b-search waves-effect waves-light btn-success"><i class="fa fa-search"></i></button>
                                </span>
                                <input type="text" placeholder="Search" class="form-control" id="search-text">
                            </div>
                        </article>
                    </figure>
                    <div class="nicescroll mxh-400" style="overflow: hidden;" tabindex="5000">
                        <div class="col-sm-12 p-t-20 p-b-20">
                            <form name="awardAgencyEdit" action="#" id="awardAgencyEdit" method="post">
                            <ul id="list" class="list-unstyled ul-bigspace">
                            <?php $countAgency = 1; if(isset($awardAgency_list) && $awardAgency_list != NULL){ 
                                foreach ($awardAgency_list as $awardAgency){ ?>
                                <li class="clearfix degrees membership-plan">
                                    <span class="col-md-10 col-sm-10 col-xs-10">
                                        <?php echo $awardAgency->agency_name; ?>
                                    </span>
                                   
                                    <span class="col-lg-2 col-sm-2 col-xs-2">
                                        <a href="#"><i class="md md-edit membership-btn"></i></a>
                                        <button onclick="if((<?php echo $awardAgency->status; ?>)===2)enableFn('master', 'awardAgencyPublish', '<?php echo $awardAgency->awardAgency_id; ?>','<?php echo $awardAgency->status; ?>')" type="button" class="btn btn-<?php if($awardAgency->status == 2){ echo "danger"; }else if($awardAgency->status == 0){ echo "warning"; }else if($awardAgency->status == 1){ echo "success"; }else { echo "primary"; } ?> waves-effect waves-light m-b-5"><?php if($awardAgency->status == 3){ echo "Verified"; }else if($awardAgency->status == 2){ echo "Unverified"; }else if($awardAgency->status == 1){ echo "Active"; }else if($awardAgency->status == 0){ echo "Inactive"; } ?></button>
                                        
                                    </span>
                                </li>
                                <li class="newmembership" style="display:none">
                                    <span class="col-md-10">
                                        <input type="hidden" id="awardAgency_id_<?php echo $countAgency; ?>" name="awardAgency_id_<?php echo $countAgency; ?>" value="<?php echo $awardAgency->awardAgency_id	; ?>" >
                                        <input type="text" required="" name="agency_name_<?php echo $countAgency; ?>" id="agency_name_<?php echo $countAgency; ?>" class="form-control" value="<?php if($awardAgency->agency_name){ echo $awardAgency->agency_name; }else{echo ''; } ?>">
                                        <label class="error" id="agency_name_<?php echo $countAgency; ?>" > <?php echo form_error("agency_name_$countAgency"); ?></label>
                                    </span>
                                   
                                    <span class="col-md-2">
                                        <button class="" type="submit" title="Save"><i class="fa fa-floppy-o membership-btn"></i></button>
                                        <a href="#" style="line-height: 2"><i class="md md-cancel membership-btn"></i></a>
                                    </span>
                                </li>
                            <?php $countAgency++;} } ?>
                                <input type="hidden" id="total_count" name="total_count" value="<?php echo $countAgency; ?>" >
                                </ul>
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
