<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="clearfix">
                <div class="col-md-12">
                    <h3 class="pull-left page-title">Hospital</h3>
                    <a href="<?php echo site_url() ?>/master/mi_master/addHospital/" class="btn btn-appointment btn-back waves-effect waves-light pull-right m-r-10"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
            <!-- Left Section Start -->
            <section class="col-md-10 detailbox m-b-20 col-sm-offset-1">
                <aside class="bg-white">
                    <div class="nicescroll mxh-400" style="overflow: hidden;" tabindex="5000">
                        <div class="col-sm-12 p-t-20 p-b-20">
                            <?php if(isset($hospital_list) && $hospital_list != NULL){ 
                                foreach ($hospital_list as $hospital){ ?>
                                <article class="clearfix degrees membership-plan">
                                    <aside class="col-lg-9 col-sm-9 col-xs-9">
                                        <?php echo $hospital->hospital_name; ?>
                                    </aside>
                                    <aside class="col-lg-3 col-sm-3 col-xs-3">
                                        <a class="btn btn-success waves-effect waves-light m-b-5" href="<?php echo site_url('master/mi_master/editHospitalView/' . $hospital->hospital_id); ?>"><i class="fa fa-pencil"></i></a>
                                        <button onclick="enableFn('master/mi_master', 'hospitalPublish', '<?php echo $hospital->hospital_id; ?>','<?php echo $hospital->status; ?>')" title='<?php if($hospital->status == 2){ echo "Publish"; }else{ echo "Unpublish"; } ?> Hospital' type="button" class="btn btn-success waves-effect waves-light m-b-5"><i class="fa fa-thumbs-<?php if($hospital->status == 3){ echo "up"; }else{ echo "down danger"; } ?>"></i></button>
                                        
                                    </aside>
                                </article>
                            <?php } } ?>
                        </div>
                    </div>
                </aside>
            </section>
            <!-- Left Section End -->
            <!-- Right Section Start -->
<!--            <section class="col-md-5 detailbox">
                <div class="bg-white">
                    <aside class="clearfix">
                         Appointment Chart 
                        <figure class="text-center">
                            <h3>Add Hospital</h3>
                        </figure>
                         Add Category 
                        <div class="col-sm-12">
                            <form name="hospitalForm" action="#" id="hospitalForm" method="post">
                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Name:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control m-t-10" id="hospital_name" type="text" name="hospital_name" placeholder="">
                                        <label class="error" id="err_hospital_name" > <?php echo form_error("hospital_name"); ?></label>
                                    </div>
                                </article>
                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Address:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <select class="form-control selectpicker" data-width="100%" name="hospital_countryId" id="hospital_countryId" onchange ="fetchState(this.value)">
                                            <option value="">Select Country</option>
                                            <?php if (isset($country_list) && !empty($country_list)) {
                                                foreach ($country_list as $key => $val) { ?>
                                                    <option <?php echo set_select('hospital_countryId', $val->country_id); ?>  value="<?php echo $val->country_id; ?>"><?php echo $val->country; ?></option>
                                            <?php } } ?>
                                        </select>
                                        <label class="error" id="err_hospital_countryId" > <?php echo form_error("hospital_countryId"); ?></label>
                                    </div>
                                </article>
                                <article class="clearfix">
                                    <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                        <select class="selectpicker form-control" data-width="100%" name="hospital_stateId" id="stateId" data-size="4" onchange ="fetchCity(this.value)">
                                            <option value="">Select State</option>
                                            <?php if (isset($allStates) && !empty($allStates)) {
                                                foreach ($allStates as $key => $val) { ?>
                                                    <option <?php echo set_select('hospital_stateId', $val->state_id); ?> value="<?php echo $val->state_id; ?>"><?php echo $val->state_statename; ?></option>
                                                <?php } } ?>
                                        </select>
                                        <label class="error" id="err_hospital_stateId" > <?php echo form_error("hospital_stateId"); ?></label>
                                    </div>
                                </article>
                                <article class="clearfix">
                                    <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                        <select class="form-control selectpicker" data-width="100%" name="hospital_cityId" id="cityId" data-size="4">
                                            <option value="">Select City</option>
                                            <?php if (isset($allCities) && !empty($allCities)) {
                                                foreach ($allCities as $key => $val) { ?>
                                                    <option <?php echo set_select('hospital_cityId', $val->city_id); ?> value="<?php echo $val->city_id; ?>"><?php echo $val->city_name; ?></option>
                                                    <?php } }  ?>
                                        </select>
                                        <label class="error" id="err_hospital_cityId" > <?php echo form_error("hospital_cityId"); ?></label>
                                    </div>
                                </article>
                                <article class="clearfix m-t-10">
                                    <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                        <input type="text" class="form-control" id="hospital_zip" name="hospital_zip" placeholder="Zipcode" onkeypress="return isNumberKey(event)" maxlength="6" value="<?php echo set_value('hospital_zip'); ?>" />
                                        <label class="error" id="err_hospital_zip" > <?php echo form_error("hospital_zip"); ?></label>
                                    </div>
                                </article>
                                <article class="clearfix m-t-10">
                                    <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                        <input type="text" class="form-control geocomplete" id="geocomplete1" name="hospital_address" placeholder="Address" value="<?php echo set_value('hospital_address'); ?>" />
                                        <label class="error" id="err_hospital_address" > <?php echo form_error("hospital_address"); ?></label>
                                    </div>
                                </article>
                                <article class="clearfix">
                                    <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                        <aside class="row">
                                            <div class="col-sm-12">
                                                <input name="lat" onkeypress="return isNumberKey(event,'err_lat')" class="form-control" type="text" value="<?php echo set_value('lat'); ?>"  id="lat" placeholder="Latitude" min="9" max="9"/>
                                                <label class="error" id="err_lat" > <?php echo form_error("lat"); ?></label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input name="lng" onkeypress="return isNumberKey(event,'err_lng')" type="text" value="<?php echo set_value('lng'); ?>"  id="lng" class="form-control" placeholder="Longitude" min="9" max="9"/>
                                                <label class="error" id="err_lng" > <?php echo form_error("lng"); ?></label>
                                            </div>
                                        </aside>
                                    </div>
                                </article>
                                <article class="clearfix m-t-10 m-b-20">
                                    <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Update</button>
                                </article>
                            </form>
                        </div>
                         Add Category 
                    </aside>
                </div>
            </section>-->
            <!-- Right Section End -->
        </div>
        <!-- container -->
    </div>
    <!-- content -->