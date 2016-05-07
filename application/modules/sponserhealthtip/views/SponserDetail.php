<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container row">
            <div class="col-md-12 text-success">
                <?php //echo $this->session->flashdata('message'); ?>                     
            </div>
            <div class="clearfix">
                <form id="submitForm" class="cmxform form-horizontal tasi-form avatar-form" enctype="multipart/form-data" novalidate="novalidate" action="<?php echo site_url(); ?>/sponserhealthtip/bookSponserdates" method="post" name="SponserForm">
                    <div class="col-md-12">
                        <h3 class="pull-left page-title">Sponsor Healthtip</h3>
                        <a href="<?php echo site_url() ?>/sponserhealthtip" class="btn btn-appointment btn-back waves-effect waves-light pull-right" id="backdiv"><i class="fa fa-angle-left"></i> Back</a>
                        <input type="hidden" name="HtipId" id="HtipId" value="<?php echo $sponsor_tipId; ?>">

                    </div>
                    <!-- Left Section Start -->

                    <section class="col-md-6 detailbox">
                        <div class="bg-white mi-form-section" id="sponserdetail-div">
                            <figure class="clearfix"> 
                                <h3>Sponsor Detail</h3>
                            </figure>
                            <!-- Table Section Start -->
                            <div class="clearfix m-t-20 p-b-20">

                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Broadcast Area:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <aside class="col-md-8 col-sm-8">
                                            <select class="selectpicker" data-width="100%" name="sponser_stateId" id="sponser_stateId" data-size="4" onchange ="fetchCity(this.value)">

                                                <option value=" ">Select State</option>
                                                <?php foreach ($allStates as $key => $val) { ?>
                                                    <option value="<?php echo $val->state_id; ?>"><?php echo $val->state_statename; ?></option>
                                                <?php } ?>
                                            </select>
                                        </aside>
                                        <label class="error" style="display:none;" id="error-stateId"> Please select a State</label>
                                        <label class="error" > <?php echo form_error("stateId"); ?></label>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">

                                    <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                        <aside class="col-md-8 col-sm-8">
                                            <select type="text" name="sponser_cityId" class="selectpicker" data-width="100%"  placeholder="Search" id="sponser_cityId" data-size="4" />
                                            <!-- <option>Delhi</option>
                                             <option>Kolkata</option> -->
                                            </select>
                                        </aside>
                                        <label class="error" style="display:none;" id="error-cityId"> Please select a City</label>
                                        <label class="error" > <?php echo form_error("cityId"); ?></label>
                                    </div>
                                </article>
                                <!--article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Sponsor For :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <aside class="col-md-8 col-sm-8">
                                            <select class="selectpicker" data-width="100%" onchange="getMI()" id="centerType" name="centerType" >
                                                <option value="">Select Type</option>
                                                <option value="1">Hospitals</option>
                                                <option value="3">Diagnostic Center</option>
                                                <option value="4">Doctor</option>
                                            </select>
                                            <label class="error" style="display:none;" id="error-centerType"> Please select a MI Type</label>
                                            <label class="error" > <?php echo form_error("centerType"); ?></label>
                                        </aside>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Sponsored By:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <aside class="col-md-8 col-sm-8">
                                            <select class="selectpicker" data-width="100%" id="mi_centre" name="mi_centre"  >
                                                <option value="">Select Hospital/Diagnostic</option>
                                            </select>
                                            <label class="error" style="display:none;" id="error-mi_centre"> Please select a MI</label>
                                            <label class="error" > <?php echo form_error("mi_centre"); ?></label>
                                        </aside>
                                    </div>
                                </article-->
                                <article class="form-group m-lr-0">
                                    <label for="cname" class="control-label col-md-4 col-sm-4">Sponsored By:</label>
                                    <div class="col-md-8 col-sm-8">
                                        <aside class="col-md-8 col-sm-8">
                                            <select class="selectpicker select2" data-width="100%" id="mi_centre" name="mi_centre"  >
                                            <option value=" ">Select Sponsor</option>
                                                <?php foreach ($allMIDoc as $key => $val) { ?>
                                                    <option value="<?php echo $val->user_id; ?>_<?php echo $val->roleid; ?>"><?php echo $val->sponName; ?></option>
                                                <?php } ?>
                                            </select>        
                                            <label class="error" style="display:none;" id="error-mi_centre"> Please select a MI</label>
                                            <label class="error" > <?php echo form_error("mi_centre"); ?></label>
                                        </aside>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">

                                    <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                        <aside class="col-md-3 col-sm-3">
                                            <button class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" onclick="showSponserdates()" type="button">Proceed</button>
                                            </select>
                                        </aside>

                                    </div>
                                </article>
                            </div>
                        </div>
                        <div class="bg-white mi-form-section" id="sponserdate-div">
                            <div class="col-md-12" >
                                <article class="form-group m-lr-0">

                                    <div class="">
                                        <aside class="">
                                            <div id="sponser-dates" class="box"  class="hasDatepicker"></div>
                                            <input id="bookdates" name="bookdates" type="hidden">
                                            <label class="error" style="display:none;" id="error-bookdates"> Please select Dates</label>
                                        </aside>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0">

                                    <div class="col-md-8  col-sm-8 col-sm-offset-4">
                                        <aside class="col-md-3 col-sm-3">
                                            <button class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" onclick="bookSponserdates()" type="button">Book</button>
                                            </select>
                                        </aside>

                                    </div>
                                </article>
                            </div>
                        </div>
                    </section>
                    <!--Left End-->
                    <!--Right Start-->
                    <section class="col-md-6 detailbox mi-form-section" id="healthtipdetaildiv">
                        <div class="bg-white clearfix">
                            <figure class="clearfix"> 
                                <h3>HealthTip Detail</h3>
                            </figure>
                            <aside class="clearfix m-t-20 p-b-20">
                                <article class="form-group m-lr-0 ">
                                    <aside class="clearfix m-bg-pic">
                                        <div class="text-center">
                                            <div class='pro-img'>
                                                <?php if (!empty($SponserDetail->healthTips_image)) { ?>
                                                    <img src="<?php echo base_url() ?>assets/Health_tipimages/<?php echo $SponserDetail->healthTips_image; ?>" alt="" class="logo-img" />
                                                <?php } else { ?>
                                                    <img src="<?php echo base_url() ?>assets/images/noImage.png" alt="" class="logo-img" />
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-12">
                                                <h3 class="text-black"><?php echo $SponserDetail->category_name; ?> </h3>
                                                <h4><?php echo $SponserDetail->healthTips_detail; ?></h4>
                                            </div>
                                        </div>

                                    </aside>
                                </article> 

                            </aside>
                        </div>
                    </section>  
                    <!--Right End-->

                </form>
            </div>
        </div>
    </div>
</div>    

<!-- container -->