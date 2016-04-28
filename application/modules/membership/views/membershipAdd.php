<style>
.pricing-wrap h4 {
    background: hsl(180, 58%, 57%) none repeat scroll 0 0;
    color: hsl(0, 0%, 100%);
    padding: 10px 0;
}
</style>
<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container row">
            <!-- Left Section Start -->
            <section class="col-md-12 detailbox">
                <div class="bg-white">
                    <div class="clearfix">
                        <div class="col-md-12 m-t-10">
                            <h3 class="pull-left page-title m-l-10">Add Membership</h3>
                            <a href="<?php echo site_url() ?>/membership/index/<?php echo $selectFor; ?>" class="btn btn-appointment btn-back waves-effect waves-light pull-right m-r-10"><i class="fa fa-angle-left"></i> Back</a>
                        </div>
                    </div>
                    <!-- Table Section Start -->
                    <article class="tab-content m-t-20">
                        <!-- Hospital Membership Starts -->
                        <section class="tab-pane fade in active" id="Hospital">
                            <article class="detailbox">
                                <aside class="form-group m-lr-0 newmembership">
                                    <form name="membershipAddForm" action="#" id="membershipAddForm" method="POST">
                                        <!-- Left Section Start -->
                                        <input type="hidden" name="active_tag" id="active_tag" value="<?php echo $selectFor ?>">
                                        <section class="col-md-8 detailbox">
                                            <div class="mi-form-section">
                                                <!-- Table Section End -->
                                                <div class="clearfix m-t-20 p-b-20">
                                                    <article class="form-group m-lr-0 m-t-30">
                                                        <label for="cname" class="control-label col-md-4 col-sm-4">Membership Type:</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <aside class="row">
                                                                <div class="col-md-8 col-sm-8">
                                                                    <select class="selectpicker" data-width="100%" name="membership_type[]" id="membership_type" multiple="" required="">
                                                                        <option value="">Select Type</option>
                                                                        <option <?php if($selectFor == 1){ echo "selected"; } ?> value="1">Hospital</option>
                                                                        <option <?php if($selectFor == 3){ echo "selected"; } ?> value="3">Diagnostics</option>
                                                                    </select>
                                                                    <label class="error" id="err_membership_type" > <?php echo form_error("membership_type"); ?></label>
                                                                </div>
                                                            </aside>
                                                        </div>
                                                    </article>
                                                    <article class="clearfix ">
                                                        <label for="cemail" class="control-label col-md-4 col-sm-4 m-t-10">Membership Title :</label>
                                                        <div class="col-md-8 col-sm-8 m-t-10">
                                                            <input class="form-control" id="membership_name" name="membership_name" type="text" required=""> 
                                                            <label class="error" id="err_membership_name" > <?php echo form_error("membership_name"); ?></label>
                                                        </div>
                                                    </article>
                                                    <article class="clearfix m-t-10">
                                                        <label for="cname" class="control-label col-sm-3">Facilities :</label>
                                                        <label for="cname" class="control-label col-sm-1"></label>
                                                        <label for="cname" class="control-label col-sm-4">Quantity :</label>
                                                        <label for="cname" class="control-label col-sm-4">Duration :</label>
                                                    </article>
                                                    <article class="clearfix m-t-10">
                                                        <?php $checkBocCount = 1; 
                                                        if(isset($facilities_list) && $facilities_list != NULL){ 
                                                        foreach($facilities_list as $facilities){ ?>
                                                        <label class="control-label col-md-3 col-xs-9" for="cname"><?php echo $facilities->facilities_name; ?></label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <aside class="row">
                                                                <div class="col-md-1 col-sm-1 checkbox checkbox-success">
                                                                    <input type="checkbox" value="<?php echo $facilities->facilities_id; ?>" id="checkbox_<?php echo $checkBocCount; ?>" name="checkbox_<?php echo $checkBocCount; ?>">
                                                                <label></label>
                                                                </div>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <input type="number" id="membership_quantity_<?php echo $checkBocCount; ?>" name="membership_quantity_<?php echo $checkBocCount; ?>" class="form-control" min="1" max="25" />
                                                                    <label class="error" id="err_membership_quantity_<?php echo $checkBocCount; ?>" > <?php echo form_error("membership_quantity"); ?></label>
                                                                </div>
                                                                <?php if($facilities->facilities_id == 3 || $facilities->facilities_id == 5){ ?>
                                                                <div class="col-md-5 col-sm-5 m-t-xs-10">
                                                                    <input type="number" id="membership_duration_<?php echo $checkBocCount; ?>" name="membership_duration_<?php echo $checkBocCount; ?>" class="form-control" min="1" max="25" />
                                                                    <label class="error" id="err_membership_duration_<?php echo $checkBocCount; ?>" > <?php echo form_error("membership_duration"); ?></label>
                                                                </div>
                                                                <?php } ?>
                                                            </aside>
                                                        </div>
                                                        <?php $checkBocCount++;} } ?>
                                                    </article>
                                                    <article class="form-group m-lr-0 m-t-30">
                                                        <label for="cname" class="control-label col-md-4 col-sm-4">Price:</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <aside class="row">
                                                                <div class="col-md-12 col-sm-12 m-t-xs-10">
                                                                    <input type="text" id="membership_price" name="membership_price" class="form-control" placeholder="2000" />
                                                                    <label class="error" id="err_membership_price" > <?php echo form_error("membership_price"); ?></label>
                                                                </div>
                                                            </aside>
                                                        </div>
                                                    </article>
                                                    <article class="form-group m-lr-0">
                                                        <label for="cname" class="control-label col-md-4  col-sm-4">Tax %:</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <input type="text" id="membership_tax" name="membership_tax" class="form-control" data-width="100%" onblur="calculateamount()">
                                                            <label class="error" id="err_membership_tax" > <?php echo form_error("membership_tax"); ?></label>
                                                            <input type="hidden" class="form-control" name="membership_totalPrice" id="membership_totalPrice" />
                                                            
                                                        </div>
                                                    </article>
                                                    <article class="form-group m-lr-0">
                                                        <label for="cname" class="control-label col-md-4 col-sm-4 cl-black">Total Amount :</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <label for="cname" class="control-label col-md-4 cl-black"><i class="fa fa-inr fa-2x"></i> <span id="paidAmount">00</span>.00/-</label>
                                                            <label class="error" id="err_membership_totalPrice" > <?php echo form_error("membership_totalPrice"); ?></label>
                                                        </div>
                                                    </article>
                                                </div>
                                                <!-- .form -->
                                            </div>
                                        </section>
                                        <!-- Left Section End -->
                                        <section class="clearfix ">
                                            <div class="col-md-12 m-t-20 m-b-20">
                                                <button class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit">Submit</button>
                                            </div>
                                        </section>
                                    </form>
                                </aside>
                            </article>
                        </section>
                        <!-- Hospital Membership Ends -->
                    </article>
                </div>
            </section>
            <!-- Table Section End -->
        </div>
        <!-- Left Section End -->
    </div>
    <!-- container -->
</div>
<!-- content -->
