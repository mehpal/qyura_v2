<!-- Start right Content here -->
<style>
#city_datatable_wrapper div.row:nth-child(3) div.col-sm-6:first-child
{
    display: none;
}
#city_datatable_wrapper div.row:nth-child(3) div.col-sm-6:last-child
{
    width: 100% !important;
}
   
#city_datatable_wrapper div.row:nth-child(3) div.col-sm-6:last-child ul.pagination,
#city_datatable_paginate ul
{
   float:left !important;
}
</style>
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
                <figure class="clearfix">
                        <h3>Available Cities</h3>
                        <article class="clearfix">
                            <div class="input-group m-b-5">
                                <span class="input-group-btn">
                                    <button type="button" class="b-search waves-effect waves-light btn-success"><i class="fa fa-search"></i></button>
                                </span>
                                <input type="text" placeholder="Search" class="form-control" id="search">
                            </div>
                        </article>
                    </figure>
                    <div class="bg-white">
                        <article class="clearfix m-top-40 p-b-20">
                                <aside class="table-responsive">
                <table class="table all-bloodbank" id="city_datatable">
                                    <thead>
                                        <tr class="border-a-dull">
                                            <th>Cities</th>
                                            <th>Action</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                </table>
                                </aside>
                            </article>
                    </div>
                </aside>
            </section>
            <!-- Left Section End -->
            <!-- Right Section Start -->
            <section class="col-md-5 detailbox">
                <div class="bg-white">
                    <aside class="clearfix">
                        <!-- Appointment Chart -->
                        <figure>
                            <h3>Add City</h3>
                        </figure>
                        <!-- Add Category -->
                        <div class="col-sm-12">
                            <form name="cityForm" action="#" id="cityForm" method="post">
                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4 m-t-10">Country:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <select class="form-control select2" data-width="100%" name="city_countryid" id="city_countryid" onchange ="fetchState(this.value)">
                                            <option value="">Select Country</option>
                                            <?php if (isset($country_list) && !empty($country_list)) {
                                                foreach ($country_list as $key => $val) { ?>
                                                    <option <?php echo set_select('city_countryid', $val->country_id); ?>  value="<?php echo $val->country_id; ?>"><?php echo $val->country; ?></option>
                                            <?php } } ?>
                                        </select>
                                        <div class="error-country"></div>
                                        <label class="error" id="err_city_countryid" > <?php echo form_error("city_countryid"); ?></label>
                                    </div>
                                </article>
                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4 m-t-10">State:</label>
                                    <div class="col-md-8  col-sm-8">
                                        <select class="form-control select2" data-width="100%" name="city_stateid" id="stateId" data-size="4" >
                                            <option value="">Select State</option>
                                            <?php if (isset($allStates) && !empty($allStates)) {
                                                foreach ($allStates as $key => $val) { ?>
                                                    <option <?php echo set_select('city_stateid', $val->state_id); ?> value="<?php echo $val->state_id; ?>"><?php echo $val->state_statename; ?></option>
                                                <?php } } ?>
                                        </select>
                                        <div class="error-state"></div>
                                        <label class="error" id="err_city_stateid" > <?php echo form_error("city_stateid"); ?></label>
                                    </div>
                                </article>
                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4 m-t-10">City Name:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" id="city_name" type="text" name="city_name" placeholder="City Name" onkeypress="return isAlpha(event,this.value)">
                                        <div class="error-city"></div>
                                        <label class="error" id="err_city_name" > <?php echo form_error("city_name"); ?></label>
                                    </div>
                                </article>
                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4 m-t-10">City Center:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" id="city_center" type="text" name="city_center" placeholder="City Center" onkeypress="return isAlpha(event,this.value)"> 
                                        <label class="error" id="err_city_center" > <?php echo form_error("city_center"); ?></label>
                                    </div>
                                </article>
                                <article class="clearfix">
                                    <label for="cname" class="control-label col-md-4 col-sm-4 m-t-10">Latitude:</label>
                                    <div class="col-md-8  col-sm-8">
                                        <input name="lat" onkeypress="return isNumberKey(event,'err_lat')" class="form-control" type="text" value="<?php echo set_value('lat'); ?>"  id="lat" placeholder="Latitude" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" onchange="latChack(this.value)"/>
                                        <label class="error" id="err_lat" > <?php echo form_error("lat"); ?></label>
                                    </div>
                                </article>
                                <article class="clearfix">
                                    <label for="cname" class="control-label col-md-4 col-sm-4 m-t-10">Longitude:</label>
                                    <div class="col-md-8  col-sm-8 ">
                                        <input name="lng" onkeypress="return isNumberKey(event,'err_lng')" type="text" value="<?php echo set_value('lng'); ?>"  id="lng" class="form-control" placeholder="Longitude" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" onChange="lngChack(this.value)"/>
                                        <label class="error" id="err_lng" > <?php echo form_error("lng"); ?></label>
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