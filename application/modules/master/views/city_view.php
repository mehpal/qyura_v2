<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="clearfix">
                <div class="col-md-12">
                    <h3 class="pull-left page-title">City</h3>
                    <div id="load_consulting" class="text-center text-success " style="display: none"><image alt="Please wait data is loading" src="<?php echo base_url('assets/images/loader/Heart_beat.gif'); ?>" /></div>
                </div>
            </div>
            <!-- Left Section Start -->
            <section class="col-md-7 detailbox m-b-20">
                <aside class="bg-white">
                    <div class="nicescroll mxh-400" style="overflow: hidden;" tabindex="5000">
                        <div class="col-sm-12 p-t-20 p-b-20">
                            <?php if(isset($city_list) && $city_list != NULL){ 
                                foreach ($city_list as $city){ ?>
                                <article class="clearfix degrees membership-plan">
                                    <aside class="col-lg-9 col-sm-9 col-xs-9">
                                        <?php echo $city->city_name; ?>
                                    </aside>
                                    <aside class="col-lg-3 col-sm-3 col-xs-3">
                                        <a class="btn btn-success waves-effect waves-light m-b-5" href="<?php echo site_url('master/city_master/editCityView/' . $city->city_id); ?>"><i class="fa fa-pencil"></i></a>
                                        <button onclick="enableFn('master/city_master', 'cityPublish', '<?php echo $city->city_id; ?>','<?php echo $city->status; ?>')" title='<?php if($city->status == 2){ echo "Publish"; }else{ echo "Unpublish"; } ?> City' type="button" class="btn btn-success waves-effect waves-light m-b-5"><i class="fa fa-thumbs-<?php if($city->status == 3){ echo "up"; }else{ echo "down danger"; } ?>"></i></button>
                                    </aside>
                                </article>
                            <?php } } ?>
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
                            <h3>Add City</h3>
                        </figure>
                        <!-- Add Category -->
                        <div class="col-sm-12">
                            <form name="cityForm" action="#" id="cityForm" method="post">
                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4 m-t-10">Country:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <select class="form-control selectpicker" data-width="100%" name="city_countryid" id="city_countryid" onchange ="fetchState(this.value)">
                                            <option value="">Select Country</option>
                                            <?php if (isset($country_list) && !empty($country_list)) {
                                                foreach ($country_list as $key => $val) { ?>
                                                    <option <?php echo set_select('city_countryid', $val->country_id); ?>  value="<?php echo $val->country_id; ?>"><?php echo $val->country; ?></option>
                                            <?php } } ?>
                                        </select>
                                        <label class="error" id="err_city_countryid" > <?php echo form_error("city_countryid"); ?></label>
                                    </div>
                                </article>
                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4 m-t-10">State:</label>
                                    <div class="col-md-8  col-sm-8">
                                        <select class="selectpicker form-control" data-width="100%" name="city_stateid" id="stateId" data-size="4" >
                                            <option value="">Select State</option>
                                            <?php if (isset($allStates) && !empty($allStates)) {
                                                foreach ($allStates as $key => $val) { ?>
                                                    <option <?php echo set_select('city_stateid', $val->state_id); ?> value="<?php echo $val->state_id; ?>"><?php echo $val->state_statename; ?></option>
                                                <?php } } ?>
                                        </select>
                                        <label class="error" id="err_city_stateid" > <?php echo form_error("city_stateid"); ?></label>
                                    </div>
                                </article>
                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4 m-t-10">City Name:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" id="city_name" type="text" name="city_name" placeholder="City Name">
                                        <label class="error" id="err_city_name" > <?php echo form_error("city_name"); ?></label>
                                    </div>
                                </article>
                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4 m-t-10">City Center:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" id="city_center" type="text" name="city_center" placeholder="City Center">
                                        <label class="error" id="err_city_center" > <?php echo form_error("city_center"); ?></label>
                                    </div>
                                </article>
                                <article class="clearfix">
                                    <label for="cname" class="control-label col-md-4 col-sm-4 m-t-10">Latitude:</label>
                                    <div class="col-md-8  col-sm-8">
                                        <input name="lat" onkeypress="return isNumberKey(event,'err_lat')" class="form-control" type="text" value="<?php echo set_value('lat'); ?>"  id="lat" placeholder="Latitude" min="9" max="9"/>
                                        <label class="error" id="err_lat" > <?php echo form_error("lat"); ?></label>
                                    </div>
                                </article>
                                <article class="clearfix">
                                    <label for="cname" class="control-label col-md-4 col-sm-4 m-t-10">Longitude:</label>
                                    <div class="col-md-8  col-sm-8 ">
                                        <input name="lng" onkeypress="return isNumberKey(event,'err_lng')" type="text" value="<?php echo set_value('lng'); ?>"  id="lng" class="form-control" placeholder="Longitude" min="9" max="9"/>
                                        <label class="error" id="err_lng" > <?php echo form_error("lng"); ?></label>
                                    </div>
                                </article>
                                <article class="clearfix m-t-10 m-b-20">
                                    <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Update</button>
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