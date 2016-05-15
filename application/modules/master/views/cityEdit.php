<div class="content-page"> 
    <div class="content">
	<div class="clearfix">
            <div class="col-md-12 m-t-10">
                <h3 class="pull-left page-title m-l-10">Edit City</h3>
                <a href="<?php echo site_url() ?>/master/city_master/" class="btn btn-appointment btn-back waves-effect waves-light pull-right m-r-10"><i class="fa fa-angle-left"></i> Back</a>
            </div>
        </div>
        <div class="container row " style="width: 600px; margin: 0 auto ; background:whitesmoke;">
            <form  class="cmxform form-horizontal tasi-form avatar-form"  name="editCityForm" method="post"  action="<?php echo site_url(); ?>/master/city_master/editCity" novalidate="novalidate" enctype="multipart/form-data" id="submitFormEditCity">
                <?php if (isset($city_value) && !empty($city_value)) { ?>
                        <input type="hidden" name="city_id" value="<?php echo $city_value->city_id; ?>" />
                            <article class="clearfix m-t-20">
                                <label for="cname" class="control-label col-md-4 col-sm-4 m-t-10">Country:</label>
                                <div class="col-md-8 col-sm-8">
                                    <select class="form-control select2" data-width="100%" name="city_countryid" id="city_countryid" onchange ="fetchState(this.value)">
                                        <option value="">Select Country</option>
                                        <?php if (isset($country_list) && !empty($country_list)) {
                                            foreach ($country_list as $key => $val) { ?>
                                                <option <?php if($city_value->city_countryid == $val->country_id){ echo "selected"; } ?>  value="<?php echo $val->country_id; ?>"><?php echo $val->country; ?></option>
                                        <?php } } ?>
                                    </select>
                                    <div class="error-country"></div>
                                    <label class="error" id="err_city_countryid" > <?php echo form_error("city_countryid"); ?></label>
                                </div>
                            </article>
                            <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4 col-sm-4 m-t-10">State:</label>
                                <div class="col-md-8  col-sm-8">
                                    <select class="form-control select2" data-width="100%" name="city_stateid" id="stateId" data-size="4" onchange ="fetchCity(this.value)">
                                        <option value="">Select State</option>
                                        <?php if (isset($state_list) && !empty($state_list)) {
                                            foreach ($state_list as $key => $val) { ?>
                                                <option <?php if($city_value->city_stateid == $val->state_id){ echo "selected"; } ?> value="<?php echo $val->state_id; ?>"><?php echo $val->state_statename; ?></option>
                                            <?php } } ?>
                                    </select>
                                    <div class="error-state"></div>
                                    <label class="error" id="err_city_stateid" > <?php echo form_error("city_stateid"); ?></label>
                                </div>
                            </article>
                            <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4 col-sm-4 m-t-10">City Name:</label>
                                <div class="col-md-8 col-sm-8">
                                    <input class="form-control" id="city_name" type="text" name="city_name" placeholder="City Name" value="<?php if($city_value->city_name){ echo $city_value->city_name; }else{ echo set_value("city_name"); } ?>" onkeypress="return isAlpha(event,this.value)">
                                    <label class="error" id="err_city_name" > <?php echo form_error("city_name"); ?></label>
                                </div>
                            </article>
                            <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4 col-sm-4 m-t-10">City Center:</label>
                                <div class="col-md-8 col-sm-8">
                                    <input class="form-control" id="city_center" type="text" name="city_center" placeholder="City Center" value="<?php if($city_value->city_center){ echo $city_value->city_center; }else{ echo set_value("city_center"); } ?>" onkeypress="return isAlpha(event,this.value)">
                                    <label class="error" id="err_city_center" > <?php echo form_error("city_center"); ?></label>
                                </div>
                            </article>
                            <article class="clearfix">
                                <label for="cname" class="control-label col-md-4 col-sm-4 m-t-10">Latitude:</label>
                                <div class="col-md-8  col-sm-8">
                                    <input name="lat" onkeypress="return isNumberKey(event,'err_lat')" class="form-control" type="text" value="<?php if($city_value->city_lat){ echo $city_value->city_lat; }else{ echo set_value("lat"); } ?>"  id="lat" placeholder="Latitude"/>
                                    <label class="error" id="err_lat" > <?php echo form_error("lat"); ?></label>
                                </div>
                            </article>
                            <article class="clearfix">
                                <label for="cname" class="control-label col-md-4 col-sm-4 m-t-10">Longitude:</label>
                                <div class="col-md-8  col-sm-8 ">
                                    <input name="lng" onkeypress="return isNumberKey(event,'err_lng')" type="text" value="<?php if($city_value->city_long){ echo $city_value->city_long; }else{ echo set_value("lng"); } ?>"  id="lng" class="form-control" placeholder="Longitude"/>
                                    <label class="error" id="err_lng" > <?php echo form_error("lng"); ?></label>
                                </div>
                            </article>
                        <article class="clearfix m-t-10 m-b-20">
                            <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Update</button>
                        </article>
                    <?php } ?>
                </form>
            </div>
        </div>
