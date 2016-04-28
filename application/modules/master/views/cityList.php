<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container row">
            <!-- Left Section Start -->
            <section class="col-md-12 detailbox">
                <div class="bg-white">
                    <!-- Table Section Start -->
                    <article class="tab-content m-t-20">
                        <!-- Hospital Membership Starts -->
                        <section class="tab-pane fade in" id="Hospital">
                            <!-- Left Section Start -->
                            <section class="col-md-7 detailbox m-b-20">
                                <aside class="bg-white">
                                    <div class="nicescroll mxh-400" style="overflow: hidden;" tabindex="5000">
                                        <div class="col-md-12 p-t-20 p-b-20">
                                            <form name="miHospiForm" action="#" id="miHospiForm" method="post">
                                                <?php $countHospi = 1; if(isset($miList) && $miList != NULL){
                                                foreach ($miList as $list){
                                                if($list->hospitalType_miRole == 1){ ?>
                                                <input type="hidden" id="hospitalType_miRole" name="hospitalType_miRole" value="<?php echo $list->hospitalType_miRole; ?>">
                                                <article class="clearfix degrees">
                                                    <div class="membership-plan" >
                                                        <aside class="col-md-10">
                                                            <?php if($list->hospitalType_name){ echo $list->hospitalType_name; }else{echo ''; } ?>
                                                        </aside>
                                                        <aside class="col-md-2">
                                                            <a href="#"><i class="md md-edit membership-btn"></i></a>
                                                            <button class="pull-right btn btn-outline btn-xs" onclick="deleteFn('master', 'mitypeDelete', '<?php echo $list->hospitalType_id; ?>')" type="button"><img src="<?php echo base_url(); ?>/assets/images/delete.png"></button>
                                                        </aside>
                                                    </div>
                                                    <div class="newmembership" style="display:none">
                                                        <aside class="col-md-10">
                                                            <input type="hidden" id="hospitalType_id_<?php echo $countHospi; ?>" name="hospitalType_id_<?php echo $countHospi; ?>" value="<?php echo $list->hospitalType_id; ?>" >
                                                            <input type="text" required="" name="hospitalType_name_<?php echo $countHospi; ?>" id="hospitalType_name_<?php echo $countHospi; ?>" class="form-control" value="<?php if($list->hospitalType_name){ echo $list->hospitalType_name; }else{echo ''; } ?>">
                                                            <label class="error" id="hospitalType_name_<?php echo $countHospi; ?>" > <?php echo form_error("hospitalType_name_$countHospi"); ?></label>
                                                        </aside>
                                                        <aside class="col-md-2">
                                                            <button class="" type="submit" title="Save"><i class="fa fa-floppy-o membership-btn"></i></button>
                                                            <a href="#"><i class="md md-cancel membership-btn"></i></a>
                                                        </aside>
                                                    </div>
                                                </article>
                                                <?php $countHospi++;} } } ?>
                                                <input type="hidden" id="total_count" name="total_count" value="<?php echo $countHospi; ?>" >
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
                                        <!-- Add Category -->
                                        <div class="col-sm-12">
                                            <form name="miaddHospiForm" action="#" id="miaddHospiForm" method="post" class="form-horizontal" >
                                                <article class="clearfix m-t-10">
                                                    <label for="" class="control-label">Add New MI Type:</label>
                                                    <div class="">
                                                        <input type="hidden" id="hospitalType_miRole" name="hospitalType_miRole" value="1">
                                                        <input type="text" required="" name="hospitalType_name" id="hospitalType_name" class="form-control" >
                                                        <label class="error" id="err_hospitalType_name" > <?php echo form_error("hospitalType_name"); ?></label>
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
                        </section>
                    </article>
            </section>
            <!-- Table Section End -->
            <article class="clearfix">
            </article>
        </div>
        </section>
        <!-- Left Section End -->
    </div>
    <!-- container -->
</div>
