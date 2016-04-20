<style>
    .l-height{
        line-height: 1.6
    }
</style>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container row">
            <!-- Left Section Start -->
            <section class="col-md-12 detailbox">
                <div class="bg-white">
                    <!-- Table Section Start -->
                    <article class="text-center clearfix">
                        <ul class="nav nav-tab nav-setting">
                            <li class="<?php if($this->uri->segment(3) == '' || $this->uri->segment(3) == 1){ echo "active"; }?>">
                                <a data-toggle="tab" href="#Hospital">Hospital</a>
                            </li>
                            <li class="<?php if($this->uri->segment(3) == 3){ echo "active"; }?>">
                                <a data-toggle="tab" href="#Diagnostic">Diagnostic Centre</a>
                            </li>
<!--                            <li class=" ">
                                <a data-toggle="tab" href="#Doctor">Doctor</a>
                            </li>-->
                            <li class="<?php if($this->uri->segment(3) == 2){ echo "active"; }?>">
                                <a data-toggle="tab" href="#Bloodbank">Blood Bank</a>
                            </li>
                            <li class="<?php if($this->uri->segment(3) == 5){ echo "active"; }?>">
                                <a data-toggle="tab" href="#Pharmacy">Pharmacy</a>
                            </li>
                            <li class="<?php if($this->uri->segment(3) == 8){ echo "active"; }?>">
                                <a data-toggle="tab" href="#Ambulance">Ambulance</a>
                            </li>
                        </ul>
                    </article>
                    <article class="tab-content m-t-20">
                        <!-- Hospital Membership Starts -->
                        <section class="tab-pane fade in <?php if($this->uri->segment(3) == '' || $this->uri->segment(3) == 1){ echo "active"; }?>" id="Hospital">
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
                                                            <a href="#"><i class="md md-edit membership-btn l-height"></i></a>
                                                            <button onclick="enableFn('master', 'miTypePublish', '<?php echo $list->hospitalType_id; ?>','<?php echo $list->status; ?>')" title='<?php if($list->status == 2){ echo "Publish"; }else{ echo "Unpublish"; } ?> Mitype' type="button" class="btn"><i class="fa fa-thumbs-<?php if($list->status == 3){ echo "up"; }else{ echo "down danger"; } ?>"></i></button>
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
                        <!-- Hospital Membership Ends -->
                        <!-- Hospital Diagnostic Starts -->
                        <section class="tab-pane fade in <?php if($this->uri->segment(3) == 3){ echo "active"; }?>" id="Diagnostic">
                            <!-- Left Section Start -->
                            <section class="col-md-7 detailbox m-b-20">
                                <aside class="bg-white">
                                    <div class="nicescroll mxh-400" style="overflow: hidden;" tabindex="5000">
                                        <form name="miDigoForm" action="#" id="miDigoForm" method="post">
                                            <?php $countHospi = 1; if(isset($miList) && $miList != NULL){
                                            foreach ($miList as $list){
                                            if($list->hospitalType_miRole == 3){ ?>
                                            <input type="hidden" id="hospitalType_miRole" name="hospitalType_miRole" value="<?php echo $list->hospitalType_miRole; ?>">
                                            <article class="clearfix degrees">
                                                <div class="membership-plan" >
                                                    <aside class="col-md-10">
                                                        <?php if($list->hospitalType_name){ echo $list->hospitalType_name; }else{echo ''; } ?>
                                                    </aside>
                                                    <aside class="col-md-2">
                                                        <a href="#"><i class="md md-edit membership-btn l-height"></i></a>
                                                        <button onclick="enableFn('master', 'miTypePublish', '<?php echo $list->hospitalType_id; ?>','<?php echo $list->status; ?>')" title='<?php if($list->status == 2){ echo "Publish"; }else{ echo "Unpublish"; } ?> Mitype' type="button" class="btn"><i class="fa fa-thumbs-<?php if($list->status == 3){ echo "up"; }else{ echo "down danger"; } ?>"></i></button>
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
                                            <form name="miaddDigoForm" action="#" id="miaddDigoForm" method="post" class="form-horizontal" >
                                                <article class="clearfix m-t-10">
                                                    <label for="" class="control-label">Add New MI Type:</label>
                                                    <div class="">
                                                        <input type="hidden" id="hospitalType_miRole" name="hospitalType_miRole" value="3">
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
                        <!-- Hospital Diagnostic Ends -->
                        <!-- Hospital Doctor Starts -->
<!--                        <section class="tab-pane fade in " id="Doctor">
                             Left Section Start 
                            <section class="col-md-7 detailbox m-b-20">
                                <aside class="bg-white">
                                    <div class="nicescroll mxh-400" style="overflow: hidden;" tabindex="5000">
                                        <div class="col-md-12 p-t-20 p-b-20">
                                            <article class="clearfix degrees">
                                                <div class="membership-plan3" >
                                                    <aside class="col-md-10">
                                                        Medicinae Baccalaureus and Bachelor of Surgery
                                                    </aside>
                                                    <aside class="col-md-2">
                                                        <button class="pull-right btn btn-outline btn-xs" onclick="deleteFn('master', 'mitypeDelete', '<?php //echo $list->hospitalType_id; ?>')" type="button"><img src="<?php echo base_url(); ?>/assets/images/delete.png"></button>
                                                        <a href="#"><i class="md md-cancel"></i></a>
                                                    </aside>
                                                </div>
                                                <div class="newmembership3" style="display:none">
                                                    <aside class="col-md-10">
                                                        <form>
                                                            <input type="text" required="" name="diagnosticCenter" id="diagnosticCenter" class="form-control">
                                                        </form>
                                                    </aside>
                                                    <aside class="col-md-2">
                                                        <a href="#" title="Save"><i class="fa fa-floppy-o membership-btn3"></i></a>
                                                        <a href="#"><i class="md md-cancel membership-btn3"></i></a>
                                                    </aside>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                </aside>
                            </section>
                             Left Section End 
                             Right Section Start 
                            <section class="col-md-5 detailbox">
                                <div class="bg-white">
                                    <aside class="clearfix">
                                         Appointment Chart 
                                         Add Category 
                                        <div class="col-sm-12">
                                            <form class="form-horizontal">
                                                <article class="clearfix m-t-10">
                                                    <label for="" class="control-label">Add New MI Type:</label>
                                                    <div class="">
                                                        <input class="form-control m-t-10" id="categoryName" type="text" name="categoryName" required="" placeholder="Speciality">
                                                    </div>
                                                </article>
                                                <article class="clearfix m-t-10 m-b-20">
                                                    <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Submit</button>
                                                </article>
                                            </form>
                                        </div>
                                         Add Category 
                                    </aside>
                                </div>
                            </section>
                             Right Section End 
                        </section>-->
                        <!-- Hospital Doctor Ends -->
                        <!-- Hospital Bloodbank Starts -->
                        <section class="tab-pane fade in <?php if($this->uri->segment(3) == 2){ echo "active"; }?> " id="Bloodbank">
                            <!-- Left Section Start -->
                            <section class="col-md-7 detailbox m-b-20">
                                <aside class="bg-white">
                                    <div class="nicescroll mxh-400" style="overflow: hidden;" tabindex="5000">
                                        <form name="miBloodForm" action="#" id="miBloodForm" method="post">
                                            <?php $countHospi = 1; if(isset($miList) && $miList != NULL){
                                            foreach ($miList as $list){
                                            if($list->hospitalType_miRole == 2){ ?>
                                            <input type="hidden" id="hospitalType_miRole" name="hospitalType_miRole" value="<?php echo $list->hospitalType_miRole; ?>">
                                            <article class="clearfix degrees">
                                                <div class="membership-plan" >
                                                    <aside class="col-md-10">
                                                        <?php if($list->hospitalType_name){ echo $list->hospitalType_name; }else{echo ''; } ?>
                                                    </aside>
                                                    <aside class="col-md-2">
                                                        <a href="#"><i class="md md-edit membership-btn l-height"></i></a>
                                                        <button onclick="enableFn('master', 'miTypePublish', '<?php echo $list->hospitalType_id; ?>','<?php echo $list->status; ?>')" title='<?php if($list->status == 2){ echo "Publish"; }else{ echo "Unpublish"; } ?> Mitype' type="button" class="btn"><i class="fa fa-thumbs-<?php if($list->status == 3){ echo "up"; }else{ echo "down danger"; } ?>"></i></button>
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
                                            <form name="miaddBankForm" action="#" id="miaddBankForm" method="post" class="form-horizontal" >
                                                <article class="clearfix m-t-10">
                                                    <label for="" class="control-label">Add New MI Type:</label>
                                                    <div class="">
                                                        <input type="hidden" id="hospitalType_miRole" name="hospitalType_miRole" value="2">
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
                        <!-- Hospital Bloodbank Ends -->
                        <!-- Hospital Pharmacy Starts -->
                        <section class="tab-pane fade in <?php if($this->uri->segment(3) == 5){ echo "active"; }?>" id="Pharmacy">
                            <!-- Left Section Start -->
                            <section class="col-md-7 detailbox m-b-20">
                                <aside class="bg-white">
                                    <div class="nicescroll mxh-400" style="overflow: hidden;" tabindex="5000">
                                        <form name="miPharmacyForm" action="#" id="miPharmacyForm" method="post">
                                            <?php $countHospi = 1; if(isset($miList) && $miList != NULL){
                                            foreach ($miList as $list){
                                            if($list->hospitalType_miRole == 5){ ?>
                                            <input type="hidden" id="hospitalType_miRole" name="hospitalType_miRole" value="<?php echo $list->hospitalType_miRole; ?>">
                                            <article class="clearfix degrees">
                                                <div class="membership-plan" >
                                                    <aside class="col-md-10">
                                                        <?php if($list->hospitalType_name){ echo $list->hospitalType_name; }else{echo ''; } ?>
                                                    </aside>
                                                    <aside class="col-md-2">
                                                        <a href="#"><i class="md md-edit membership-btn l-height"></i></a>
                                                        <button onclick="enableFn('master', 'miTypePublish', '<?php echo $list->hospitalType_id; ?>','<?php echo $list->status; ?>')" title='<?php if($list->status == 2){ echo "Publish"; }else{ echo "Unpublish"; } ?> Mitype' type="button" class="btn"><i class="fa fa-thumbs-<?php if($list->status == 3){ echo "up"; }else{ echo "down danger"; } ?>"></i></button>
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
                                            <form name="miaddPharmacyForm" action="#" id="miaddPharmacyForm" method="post" class="form-horizontal" >
                                                <article class="clearfix m-t-10">
                                                    <label for="" class="control-label">Add New MI Type:</label>
                                                    <div class="">
                                                        <input type="hidden" id="hospitalType_miRole" name="hospitalType_miRole" value="5">
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
                        <!-- Hospital Pharmacy Ends -->
                        <!-- Hospital Ambulance Starts -->
                        <section class="tab-pane fade in <?php if($this->uri->segment(3) == 8){ echo "active"; }?>" id="Ambulance">
                            <!-- Left Section Start -->
                            <section class="col-md-7 detailbox m-b-20">
                                <aside class="bg-white">
                                    <div class="nicescroll mxh-400" style="overflow: hidden;" tabindex="5000">
                                        <form name="miAmbulanceForm" action="#" id="miAmbulanceForm" method="post">
                                            <?php $countHospi = 1; if(isset($miList) && $miList != NULL){
                                            foreach ($miList as $list){
                                            if($list->hospitalType_miRole == 8){ ?>
                                            <input type="hidden" id="hospitalType_miRole" name="hospitalType_miRole" value="<?php echo $list->hospitalType_miRole; ?>">
                                            <article class="clearfix degrees">
                                                <div class="membership-plan" >
                                                    <aside class="col-md-10">
                                                        <?php if($list->hospitalType_name){ echo $list->hospitalType_name; }else{echo ''; } ?>
                                                    </aside>
                                                    <aside class="col-md-2">
                                                        <a href="#"><i class="md md-edit membership-btn l-height"></i></a>
                                                        <button onclick="enableFn('master', 'miTypePublish', '<?php echo $list->hospitalType_id; ?>','<?php echo $list->status; ?>')" title='<?php if($list->status == 2){ echo "Publish"; }else{ echo "Unpublish"; } ?> Mitype' type="button" class="btn"><i class="fa fa-thumbs-<?php if($list->status == 3){ echo "up"; }else{ echo "down danger"; } ?>"></i></button>
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
                                            <form name="miaddAmbulanceForm" action="#" id="miaddAmbulanceForm" method="post" class="form-horizontal" >
                                                <article class="clearfix m-t-10">
                                                    <label for="" class="control-label">Add New MI Type:</label>
                                                    <div class="">
                                                        <input type="hidden" id="hospitalType_miRole" name="hospitalType_miRole" value="8">
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
                        <!-- Hospital Ambulance Ends -->
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
