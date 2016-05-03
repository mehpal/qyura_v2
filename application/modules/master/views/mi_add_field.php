<article class="clearfix m-t-10">
    <label for="cname" class="control-label col-md-4 col-sm-4">Name:</label>
    <div class="col-md-8 col-sm-8">
        <input class="form-control m-t-10" id="mi_name" type="text" name="mi_name" placeholder="" value="" onkeypress="return isAlpha(event,this.value)">
        <label class="error" id="err_mi_name" > <?php echo form_error("mi_name"); ?></label>
    </div>
</article>
<article class="clearfix m-t-10">
    <label for="cname" class="control-label col-md-4 col-sm-4">Address:</label>
    <div class="col-md-8 col-sm-8">
        <select class="form-control select2" data-width="100%" name="mi_countryId" id="mi_countryId" onchange ="fetchState(this.value)">
            <option value="">Select Country</option>
            <?php if (isset($country_list) && !empty($country_list)) {
                foreach ($country_list as $key => $val) { ?>
                    <option <?php echo set_select('mi_countryId', $val->country_id); ?>  value="<?php echo $val->country_id; ?>"><?php echo $val->country; ?></option>
            <?php } } ?>
        </select>
        <label class="error" id="err_mi_countryId" > <?php echo form_error("mi_countryId"); ?></label>
    </div>
</article>
<article class="clearfix">
    <div class="col-md-8  col-sm-8 col-sm-offset-4">
        <select class="form-control select2 " data-width="100%" name="mi_stateId" id="stateId" data-size="4" onchange ="fetchCity(this.value)">
            <option value="">Select State</option>
            <?php if (isset($allStates) && !empty($allStates)) {
                foreach ($allStates as $key => $val) { ?>
                    <option <?php echo set_select('mi_stateId', $val->state_id); ?> value="<?php echo $val->state_id; ?>"><?php echo $val->state_statename; ?></option>
                <?php } } ?>
        </select>
        <label class="error" id="err_mi_stateId" > <?php echo form_error("mi_stateId"); ?></label>
    </div>
</article>
<article class="clearfix">
    <div class="col-md-8  col-sm-8 col-sm-offset-4">
        <select class="form-control select2" data-width="100%" name="mi_cityId" id="cityId" data-size="4">
            <option value="">Select City</option>
            <?php if (isset($allCities) && !empty($allCities)) {
                foreach ($allCities as $key => $val) { ?>
                    <option <?php echo set_select('mi_cityId', $val->city_id); ?> value="<?php echo $val->city_id; ?>"><?php echo $val->city_name; ?></option>
                    <?php } }  ?>
        </select>
        <label class="error" id="err_mi_cityId" > <?php echo form_error("mi_cityId"); ?></label>
    </div>
</article>
<article class="clearfix m-t-10">
    <div class="col-md-8  col-sm-8 col-sm-offset-4">
        <input type="text" class="form-control" id="mi_zip" name="mi_zip" placeholder="Zipcode" onkeypress="return isNumberKey(event)" maxlength="6" value="" />
        <label class="error" id="err_mi_zip" > <?php echo form_error("mi_zip"); ?></label>
    </div>
</article>
<article class="clearfix m-t-10">
    <div class="col-md-8  col-sm-8 col-sm-offset-4">
        <input type="text" class="form-control geocomplete" id="geocomplete1" name="mi_address" placeholder="Address" value="" />
        <label class="error" id="err_mi_address" > <?php echo form_error("mi_address"); ?></label>
    </div>
</article>
<article class="clearfix">
    <div class="col-md-8  col-sm-8 col-sm-offset-4">
        <aside class="row">
            <div class="col-sm-12">
                <input name="lat" onkeypress="return isNumberKey(event,'err_lat')" class="form-control" type="text" value=""  id="lat" placeholder="Latitude"/>
                <label class="error" id="err_lat" > <?php echo form_error("lat"); ?></label>
            </div>
            <div class="col-sm-12">
                <input name="lng" onkeypress="return isNumberKey(event,'err_lng')" type="text" value=""  id="lng" class="form-control" placeholder="Longitude"/>
                <label class="error" id="err_lng" > <?php echo form_error("lng"); ?></label>
            </div>
        </aside>
    </div>
</article>