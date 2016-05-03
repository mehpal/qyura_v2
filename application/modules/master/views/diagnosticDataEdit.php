<div class="content-page"> 
    <div class="content">
	<div class="clearfix">
            <div class="col-md-12 m-t-10">
                <h3 class="pull-left page-title m-l-10">Edit Diagnostic</h3>
                <a href="<?php echo site_url() ?>/master/mi_master/diagnosticList/" class="btn btn-appointment btn-back waves-effect waves-light pull-right m-r-10"><i class="fa fa-angle-left"></i> Back</a>
            </div>
        </div>
        <div class="container row " style="width: 600px; margin: 0 auto ; background:whitesmoke;">
            <form  class="cmxform form-horizontal tasi-form avatar-form"  name="editDiagnosticForm" method="post"  action="<?php echo site_url(); ?>/master/mi_master/editDiagnostic" novalidate="novalidate" enctype="multipart/form-data" id="submitEditForm">
                <?php if (isset($diagnostic_value) && !empty($diagnostic_value)) { ?>
                        <input type="hidden" name="diagnostic_id" value="<?php echo $diagnostic_value->diagnostic_id; ?>" />
                            <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4 col-sm-4">Name:</label>
                                <div class="col-md-8 col-sm-8">
                                    <input class="form-control m-t-10" id="diagnostic_name" type="text" name="diagnostic_name" placeholder="" value="<?php if($diagnostic_value->diagnostic_name){ echo $diagnostic_value->diagnostic_name; }else{ echo set_value("diagnostic_name"); } ?>" >
                                    <label class="error" id="err_diagnostic_name" > <?php echo form_error("diagnostic_name"); ?></label>
                                </div>
                            </article>
                            <article class="clearfix m-t-10">
                                <label for="cname" class="control-label col-md-4 col-sm-4">Address:</label>
                                <div class="col-md-8 col-sm-8">
                                    <select class="form-control select2" data-width="100%" name="diagnostic_countryId" id="diagnostic_countryId" onchange ="fetchState(this.value)">
                                        <option value="">Select Country</option>
                                        <?php if (isset($country_list) && !empty($country_list)) {
                                            foreach ($country_list as $key => $val) { ?>
                                                <option <?php if($diagnostic_value->diagnostic_countryId == $val->country_id){ echo "selected"; } ?>  value="<?php echo $val->country_id; ?>"><?php echo $val->country; ?></option>
                                        <?php } } ?>
                                    </select>
                                    <label class="error" id="err_diagnostic_countryId" > <?php echo form_error("diagnostic_countryId"); ?></label>
                                </div>
                            </article>
                            <article class="clearfix">
                                <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                    <select class="form-control select2" data-width="100%" name="diagnostic_stateId" id="stateId" data-size="4" onchange ="fetchCity(this.value)">
                                        <option value="">Select State</option>
                                        <?php if (isset($state_list) && !empty($state_list)) {
                                            foreach ($state_list as $key => $val) { ?>
                                                <option <?php if($diagnostic_value->diagnostic_stateId == $val->state_id){ echo "selected"; } ?> value="<?php echo $val->state_id; ?>"><?php echo $val->state_statename; ?></option>
                                            <?php } } ?>
                                    </select>
                                    <label class="error" id="err_diagnostic_stateId" > <?php echo form_error("diagnostic_stateId"); ?></label>
                                </div>
                            </article>
                            <article class="clearfix">
                                <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                    <select class="form-control select2" data-width="100%" name="diagnostic_cityId" id="cityId" data-size="4">
                                        <option value="">Select City</option>
                                        <?php if (isset($city_list) && !empty($city_list)) {
                                            foreach ($city_list as $key => $val) { ?>
                                                <option <?php if($diagnostic_value->diagnostic_cityId == $val->city_id){ echo "selected"; } ?> value="<?php echo $val->city_id; ?>"><?php echo $val->city_name; ?></option>
                                                <?php } }  ?>
                                    </select>
                                    <label class="error" id="err_diagnostic_cityId" > <?php echo form_error("diagnostic_cityId"); ?></label>
                                </div>
                            </article>
                            <article class="clearfix m-t-10">
                                <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                    <input type="text" class="form-control" id="diagnostic_zip" name="diagnostic_zip" placeholder="Zipcode" onkeypress="return isNumberKey(event)" maxlength="6" value="<?php if($diagnostic_value->diagnostic_zip){ echo $diagnostic_value->diagnostic_zip; }else{ echo set_value("diagnostic_zip"); } ?>" />
                                    <label class="error" id="err_diagnostic_zip" > <?php echo form_error("diagnostic_zip"); ?></label>
                                </div>
                            </article>
                            <article class="clearfix m-t-10">
                                <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                    <input type="text" class="form-control geocomplete" id="geocomplete1" name="diagnostic_address" placeholder="Address" value="<?php if($diagnostic_value->diagnostic_address){ echo $diagnostic_value->diagnostic_address; }else{ echo set_value("diagnostic_address"); } ?>" />
                                    <label class="error" id="err_diagnostic_address" > <?php echo form_error("diagnostic_address"); ?></label>
                                </div>
                            </article>
                            <article class="clearfix">
                                <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                    <aside class="row">
                                        <div class="col-sm-12">
                                            <input name="lat" onkeypress="return isNumberKey(event,'err_lat')" class="form-control" type="text" value="<?php if($diagnostic_value->diagnostic_lat){ echo $diagnostic_value->diagnostic_lat; }else{ echo set_value("lat"); } ?>"  id="lat" placeholder="Latitude"/>
                                            <label class="error" id="err_lat" > <?php echo form_error("lat"); ?></label>
                                        </div>
                                        <div class="col-sm-12">
                                            <input name="lng" onkeypress="return isNumberKey(event,'err_lng')" type="text" value="<?php if($diagnostic_value->diagnostic_long){ echo $diagnostic_value->diagnostic_long; }else{ echo set_value("lng"); } ?>"  id="lng" class="form-control" placeholder="Longitude"/>
                                            <label class="error" id="err_lng" > <?php echo form_error("lng"); ?></label>
                                        </div>
                                    </aside>
                                </div>
                            </article>
                        <article class="clearfix m-t-10 m-b-20">
                            <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Update</button>
                        </article>
                    <?php } ?>
                </form>
            </div>
        </div>
