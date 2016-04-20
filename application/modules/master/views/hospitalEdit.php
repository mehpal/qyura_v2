<div class="content-page"> 
    <div class="content">
	<div class="clearfix">
            <div class="col-md-12 m-t-10">
                <h3 class="pull-left page-title m-l-10">Edit Hospital</h3>
                <a href="<?php echo site_url() ?>/master/mi_master/hospital/" class="btn btn-appointment btn-back waves-effect waves-light pull-right m-r-10"><i class="fa fa-angle-left"></i> Back</a>
            </div>
        </div>
        <div class="container row " style="width: 600px; margin: 0 auto ; background:whitesmoke;">
            <form  class="cmxform form-horizontal tasi-form avatar-form"  name="editHospitalForm" method="post"  action="<?php echo site_url(); ?>/master/mi_master/editHospital" novalidate="novalidate" enctype="multipart/form-data" id="submitForm">
                <?php if (isset($hospital_value) && !empty($hospital_value)) { ?>
                        <input type="hidden" name="hospital_id" value="<?php echo $hospital_value->hospital_id; ?>" />
                            <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4 col-sm-4">Name:</label>
                                <div class="col-md-8 col-sm-8">
                                    <input class="form-control m-t-10" id="hospital_name" type="text" name="hospital_name" placeholder="" value="<?php if($hospital_value->hospital_name){ echo $hospital_value->hospital_name; }else{ echo set_value("hospital_name"); } ?>" >
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
                                                <option <?php if($hospital_value->hospital_countryId == $val->country_id){ echo "selected"; } ?>  value="<?php echo $val->country_id; ?>"><?php echo $val->country; ?></option>
                                        <?php } } ?>
                                    </select>
                                    <label class="error" id="err_hospital_countryId" > <?php echo form_error("hospital_countryId"); ?></label>
                                </div>
                            </article>
                            <article class="clearfix">
                                <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                    <select class="selectpicker form-control" data-width="100%" name="hospital_stateId" id="stateId" data-size="4" onchange ="fetchCity(this.value)">
                                        <option value="">Select State</option>
                                        <?php if (isset($state_list) && !empty($state_list)) {
                                            foreach ($state_list as $key => $val) { ?>
                                                <option <?php if($hospital_value->hospital_stateId == $val->state_id){ echo "selected"; } ?> value="<?php echo $val->state_id; ?>"><?php echo $val->state_statename; ?></option>
                                            <?php } } ?>
                                    </select>
                                    <label class="error" id="err_hospital_stateId" > <?php echo form_error("hospital_stateId"); ?></label>
                                </div>
                            </article>
                            <article class="clearfix">
                                <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                    <select class="form-control selectpicker" data-width="100%" name="hospital_cityId" id="cityId" data-size="4">
                                        <option value="">Select City</option>
                                        <?php if (isset($city_list) && !empty($city_list)) {
                                            foreach ($city_list as $key => $val) { ?>
                                                <option <?php if($hospital_value->hospital_cityId == $val->city_id){ echo "selected"; } ?> value="<?php echo $val->city_id; ?>"><?php echo $val->city_name; ?></option>
                                                <?php } }  ?>
                                    </select>
                                    <label class="error" id="err_hospital_cityId" > <?php echo form_error("hospital_cityId"); ?></label>
                                </div>
                            </article>
                            <article class="clearfix m-t-10">
                                <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                    <input type="text" class="form-control" id="hospital_zip" name="hospital_zip" placeholder="Zipcode" onkeypress="return isNumberKey(event)" maxlength="6" value="<?php if($hospital_value->hospital_zip){ echo $hospital_value->hospital_zip; }else{ echo set_value("hospital_zip"); } ?>" />
                                    <label class="error" id="err_hospital_zip" > <?php echo form_error("hospital_zip"); ?></label>
                                </div>
                            </article>
                            <article class="clearfix m-t-10">
                                <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                    <input type="text" class="form-control geocomplete" id="geocomplete1" name="hospital_address" placeholder="Address" value="<?php if($hospital_value->hospital_address){ echo $hospital_value->hospital_address; }else{ echo set_value("hospital_address"); } ?>" />
                                    <label class="error" id="err_hospital_address" > <?php echo form_error("hospital_address"); ?></label>
                                </div>
                            </article>
                            <article class="clearfix">
                                <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                    <aside class="row">
                                        <div class="col-sm-12">
                                            <input name="lat" onkeypress="return isNumberKey(event,'err_lat')" class="form-control" type="text" value="<?php if($hospital_value->hospital_lat){ echo $hospital_value->hospital_lat; }else{ echo set_value("lat"); } ?>"  id="lat" placeholder="Latitude" min="9" max="9"/>
                                            <label class="error" id="err_lat" > <?php echo form_error("lat"); ?></label>
                                        </div>
                                        <div class="col-sm-12">
                                            <input name="lng" onkeypress="return isNumberKey(event,'err_lng')" type="text" value="<?php if($hospital_value->hospital_long){ echo $hospital_value->hospital_long; }else{ echo set_value("lng"); } ?>"  id="lng" class="form-control" placeholder="Longitude" min="9" max="9"/>
                                            <label class="error" id="err_lng" > <?php echo form_error("lng"); ?></label>
                                        </div>
                                    </aside>
                                </div>
                            </article>
                        <article class="clearfix m-t-10 m-b-20">
                            <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Submit</button>
                        </article>
                    <?php } ?>
                </form>
            </div>
        </div>
