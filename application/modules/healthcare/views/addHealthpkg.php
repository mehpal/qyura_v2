<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container row">
            <!-- consultation -->

            <div style="display:show;" id="consultDiv">
                <div class="clearfix">
                <!-- <div class="col-md-12 text-success">
                            <?php // echo $this->session->flashdata('message'); ?>
                         </div>-->
                    <div class="col-md-12">
                        <h3 class="pull-left page-title">Add New Health Package</h3>

                    </div>
                </div>
                <form class="cmxform form-horizontal tasi-form" id="commentForm" name="healthcareForm" method="post" action="<?php echo site_url(); ?>/healthcare/SaveHealthcare" novalidate="novalidate" enctype="multipart/form-data">

                    <!-- Left Section Start -->
                    <section class="col-md-6 detailbox">
                        <div class="bg-white mi-form-section">
                            <figure class="clearfix">
                                <h3>General Detail</h3>
                            </figure>
                            <!-- Table Section End -->
                            <div class="clearfix m-t-20 p-b-20">
                                <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">City :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <select class="form-control selectpicker" data-width="100%" name="city" id="cityId">
                                            <?php
                                            if (isset($allCities) && !empty($allCities)) {
                                                foreach ($allCities as $key => $val) {
                                                    ?>
                                                    <option  <?php echo set_select('city', $val->city_id); ?>
 value="<?php echo $val->city_id; ?>"><?php echo $val->city_name; ?></option>
                                                <?php }
                                            }
                                            ?>
                                        </select>
                                        <label class="error" > <?php echo form_error("city"); ?></label>
                                        <label class="error" style="display:none;" id="error-cityId"> please select city name</label>
                                    </div>
                                </article>
                                <article class="clearfix m-t-10">
                                    <label class="control-label col-md-4 col-sm-4">MI/Doctor Type :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <select class="form-control selectpicker" data-width="100%" name="miType" id="miType" onchange ="fetchHos(this.value, city.value)">
                                            <option value=""> Select MI Type</option>
                                            <option <?php echo set_select('miType', 'Hospital'); ?> value="Hospital">Hospital</option>
                                            <option <?php echo set_select('miType', 'Diagnostic'); ?> value="Diagnostic">Diagnostic</option>
                                        </select>
                                        <label class="error" > <?php echo form_error("miType"); ?></label>
                                        <label class="error" style="display:none;" id="error-miType"> please select MI type</label>
                                    </div>
                                </article>

                                <article class="clearfix m-t-10">
                                    <label for="" class="control-label col-md-4 col-sm-4">MI Name:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <!--<input class="form-control" id="miName" type="text" name="miName" required="" placeholder="MI Name"> -->
                                        <select class="form-control selectpicker" data-width="100%" name="miName" id="miName">
                                            <?php
                                            if (isset($miData) && !empty($miData)) {
                                                foreach ($miData as $key => $val) {
                                                    ?>
                                                    <option  <?php echo set_select('miName', $val->miId); ?>
 value="<?php echo $val->miId; ?>"><?php echo $val->miName; ?></option>
                                                <?php }
                                            }
                                            ?>
                                        </select>
                                         <label class="error" > <?php echo form_error("miName"); ?></label>
                                         <label class="error" style="display:none;" id="error-miName"> please select MI name</label>
                                    </div>
                                </article>
<!--
                                <article class="clearfix m-t-10 ">
                                    <label for="cemail" class="control-label col-md-4 col-sm-4">Package Id :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control disabled" id="packageId" name="packageId" type="disabled"  aria-required="true" placeholder="ACM304" readonly>
                                    </div>
                                </article>
                                -->

                                <article class="clearfix m-t-10">
                                    <label for="" class="control-label col-md-4 col-sm-4">Package Title :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control " id="packagetitle" type="text" name="packagetitle" required="" value="<?php echo set_value('packagetitle'); ?>">
                                        <label class="error" style="display:none;" id="error-packagetitle1"> please enter package title</label>
                                        <label class="error" style="display:none;" id="error-packagetitle2"> please enter characters only!</label>
                                        <label class="error" > <?php echo form_error("packagetitle"); ?></label>
                                    </div>
                                </article>

                                <!-- <article class="clearfix m-t-10">
                                     <label for="cname" class="control-label col-md-4 col-sm-4">Expiry Date</label>
                                     <div class="col-md-8 col-sm-8">
                                         <div class="radio radio-success radio-inline">
                                             <input type="radio" checked="" name="expiryDate" value="Yes" id="expiryDate1">
                                             <label for="inlineRadio1">Yes</label>
                                         </div>
                                         <div class="radio radio-success radio-inline">
                                             <input type="radio" name="expiryDate" value="No" id="expiryDate2">
                                             <label for="inlineRadio2">No</label>
                                         </div>
                                         <label class="error" > <?php // echo form_error("expiryDate");  ?></label>
                                     </div>
                                 </article> -->

                                <!--
                                 <article class="clearfix m-t-10">
                                     <label for="cname" class="control-label col-md-4 col-sm-4">Enter Date:</label>
                                     <div class="col-md-8 col-sm-8">
                                         <div class="input-group">
                                             <input class="form-control pickDate" placeholder="dd/mm/yyyy" id="date-5" type="text" name="enterDate" placeholder="Date To" onkeydown="return false;">
                                             <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                             <label class="error" > <?php // echo form_error("enterDate");  ?></label>
                                         </div>
                                     </div>
                                 </article> -->

                                <article class="clearfix m-t-10">
                                    <label for="" class="control-label col-md-4 col-sm-4">Best Price :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control " id="bestPrice" type="text" name="bestPrice" required="" onkeypress="return isNumberKey(event)" onkeyup="getDiscount(bestPrice.value, discountPercent.value)" value="<?php echo set_value('bestPrice'); ?>">
                                        <label class="error" style="display:none;" id="error-bestPrice"> please enter the best price!</label>
                                        <label class="error" > <?php echo form_error("bestPrice"); ?></label>
                                    </div>
                                </article>

                                <article class="clearfix m-t-10">
                                    <label for="" class="control-label col-md-4 col-sm-4">Discount Percent :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control " id="discountPercent" type="text" name="discountPercent" required="" maxlength="3" minlength="1" onkeypress="return isNumberKey(event)" onkeyup="getDiscount(bestPrice.value, discountPercent.value)" value="<?php  if(set_value('discountPercent') != ''){ echo set_value('discountPercent'); }else{ echo 0; } ?>">
                                        <label class="error" style="display:none;" id="error-discountPercent"> please enter the discount percent!</label>
                                         <label class="error" style="display:none;" id="error-discountPercent1">Discount should be equal or less then 100%</label>
                                        <label class="error" > <?php echo form_error("discountPercent"); ?></label>
                                    </div>
                                </article>
                                
                                
                                 <article class="clearfix m-t-10">
                                    <label for="" class="control-label col-md-4 col-sm-4">Discount Price :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control " id="discountPrice" type="text" name="discountPrice" required="" onkeypress="return isNumberKey(event)" readonly value="<?php echo set_value('discountPrice'); ?>">
                                        <label class="error" style="display:none;" id="error-discountPrice"> please enter the discounted price!</label>
                                        <label class="error" > <?php echo form_error("discountPrice"); ?></label>
                                    </div>
                                </article>

                                <!-- <article class="clearfix m-t-10">
                                     <label for="" class="control-label col-md-4 col-sm-4"> Package Description :</label>
                                     <div class="col-md-8 col-sm-8">
                                         <textarea class="form-control " id="packageDescription" type="text" name="packageDescription" required=""></textarea>
                                         <label class="error" > <?php // echo form_error("packageDescription");  ?></label>
                                     </div>
                                 </article> -->

                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4  col-sm-4">Test Includes:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <a href="javascript:void(0)" class="add pull-right" rel=".clone"><i class="fa fa-plus-circle fa-2x m-t-5 label-plus"></i></a>

                                        <aside class="row clone">

                                            <div class="col-lg-10 col-md-10 col-sm-7 col-xs-10 m-t-xs-10" id="multiserviceName">
                                                <input type="text" class="form-control" name="testIncluded[]" id="hospitalServices_serviceName1" maxlength="200" <?php echo set_value('testIncluded[0]') ?> />
                                                <input type="hidden" id="serviceName" name="serviceName" value="1" />
                                                <label class="error" style="display:none;" id="error-hospitalServices_serviceName"> 
                                                please enter the Tests properly! </label>

                                                <label class="error" > <?php echo form_error("testIncluded[0]"); ?></label>

                                            </div>


                                        </aside>

                                    </div>
                                </article>
                                
                                
                               


                            </div>
                            <!-- .form -->
                        </div>

                    </section>
                    <!-- Left Section End -->



                    <!-- Right Section Start -->
              <!--    <section class="col-md-6 detailbox mi-form-section">
                        <div class="bg-white clearfix p-b-20">
                    <!-- Package Includes Start -->

                    <!-- <figure class="clearfix">
                         <h3>Package Includes</h3>
                     </figure>
                     <aside class="clearfix m-t-20">


                         <article class="clearfix m-t-10">
                             <label for="cname" class="control-label col-md-4 col-sm-4">Diagnostic Category:</label>
                             <div class="col-md-8 col-sm-8">
                                 <select class="selectpicker" data-width="100%" name="category">
                                     <option value="">Blood Test</option>
                                     <option value=" ">Kidney and Urinary Tract</option>
                                 </select>
                             </div>
                         </article>

                         <article class="clearfix m-t-10">
                             <label for="" class="control-label col-md-4 col-sm-4">Search & Include Test :</label>
                             <div class="col-md-8 col-sm-8">
                                 <input class="form-control " id="includeTest" type="text" name="includeTest" required="">
                             </div>
                         </article>

                         <article class="clearfix m-t-10">
                             <div class="col-md-8 col-md-offset-4">
                                 <button class="btn btn-success waves-effect waves-light" type="button">Test - 1</button>
                             </div>
                         </article>

                         <article class="clearfix m-t-10">
                             <div class="col-md-8 col-md-offset-4">
                                 <button class="btn btn-appointment waves-effect waves-light" type="button">Test - 2</button>
                             </div>
                         </article>

                         <article class="clearfix m-t-10">
                             <div class="col-md-8 col-md-offset-4">
                                 <button class="btn btn-success waves-effect waves-light" type="button">Test - 3</button>
                             </div>
                         </article>

                         <article class="clearfix m-t-10">
                             <div class="col-md-8 col-md-offset-4">
                                 <button class="btn btn-appointment waves-effect waves-light" type="button">Test - 4</button>
                             </div>
                         </article>




                    <!-- Package Includes Section End -->
                    <section class="clearfix ">
                        <div class="col-md-7 m-t-20 m-b-20">
                            <button class="btn btn-danger waves-effect pull-right" type="reset">Reset</button>
                            <button class="btn btn-success waves-effect waves-light pull-right m-r-20" onclick="return validationHealthpkg()" type="submit">Submit</button>
                        </div>

                    </section>
                </form>
            </div>
        </div>

        <!-- consultation -->
        <!-- Right Section End -->

    </div>

    <!-- container -->
</div>
<!-- End Right content here -->
