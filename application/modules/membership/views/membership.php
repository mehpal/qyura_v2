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
                    <!-- Table Section Start -->
                    <article class="text-center clearfix">
                        <ul class="nav nav-tab nav-setting">
                            <?php $active_tag = $this->session->flashdata('active_tag'); ?>
                            <li class="<?php if ($active_tag == '' || $active_tag == 1) { echo "active"; } ?>">
                                <a data-toggle="tab" href="#Hospital">Hospital</a>
                            </li>
                            <li class="<?php if ($active_tag == 3) { echo "active"; } ?>">
                                <a data-toggle="tab" href="#Diagnostic">Diagnostic Centre</a>
                            </li>
                        </ul>
                    </article>
                    <article class="tab-content m-t-20">
                        <!-- Hospital Membership Starts -->
                        <section class="tab-pane fade in <?php if ($active_tag == '' || $active_tag == 1) { echo "active"; } ?>" id="Hospital">
                            <article class="detailbox membership-plan">
                                <aside class="col-md-12">
                                    <a href="<?php echo site_url() ?>/membership/membershipAdd/1" class="btn btn-appointment m-b-20 membership-btn waves-effect waves-light" title="Create New Membership"><i class="fa fa-plus"></i> Add</a>
                                </aside>
                                <aside class="clearfix">
                                    <?php if(isset($membership_list) && $membership_list != NULL){ 
                                        foreach($membership_list as $membership){ 
                                        if($membership->membership_type == 1){ ?>
                                        <div class=" col-md-4">
                                            <div class="pricing-item">
                                                <div class="pricing-item-inner">
                                                    <a href="<?php echo site_url() ?>/membership/membershipEditView/<?php echo $membership->membership_id; ?>" class="pull-right m-r-10 m-t-10"><i class="fa fa-pencil"></i></a>
                                                    <a href="javascript:void(0)" onclick="enableFn('membership', 'membershipPublish', '<?php echo $membership->membership_id; ?>','<?php echo $membership->status; ?>','1')" title='<?php if($membership->status == 0){ echo "Inactive"; }else{ echo "Active"; } ?> Membership' class="pull-right m-r-10 m-t-10"><i class="fa fa-thumbs-<?php if($membership->status == 1){ echo "up"; }else{ echo "down danger"; } ?> "></i></a>
                                                    <div class="pricing-wrap">
                                                        <!-- Pricing Title -->
                                                        <div class="pricing-title">
                                                            <?php echo $membership->membership_name; ?>
                                                        </div>
                                                        <!-- Pricing Features -->
                                                        <div class="pricing-features">
                                                            <?php
                                                                $option = array(
                                                                    'table' => 'qyura_membershipFacilities',
                                                                    'select' => 'facilities_name,membershipFacilities_quantity,membershipFacilities_duration',
                                                                    'where' => array('qyura_membershipFacilities.membershipFacilities_deleted' => 0,'qyura_facilities.facilities_deleted' => 0,'qyura_membershipFacilities.membershipFacilities_membershipId' => $membership->membership_id),
                                                                    'join' => array(
                                                                        array('qyura_facilities', 'qyura_facilities.facilities_id = qyura_membershipFacilities.	membershipFacilities_facilitiesId', 'left')
                                                                    ),
                                                                );
                                                                $facility_list =$this->common_model->customGet($option); 
                                                            ?>
                                                            <ul class="sf-list pr-list">
                                                                <?php if(isset($facility_list) && $facility_list != NULL){
                                                                    foreach($facility_list as $facility){?>
                                                                    <li><?php echo $facility->membershipFacilities_quantity; ?> <?php echo $facility->facilities_name; ?> <?php if(isset($facility->membershipFacilities_duration) && $facility->membershipFacilities_duration != 0){ echo "For ".$facility->membershipFacilities_duration." "."Weeks"; } ?></li>
                                                                <?php } }?>
                                                            </ul>
                                                        </div>
                                                        <div class="pricing-num">
                                                            <sup><i class="fa fa-inr"></i></sup><?php echo $membership->membership_totalPrice; ?>
                                                        </div>
                                                        <div class="pr-per">
                                                            <?php if($membership->membership_plan == 18){ echo "Yearly"; }else{ echo "Yearly"; } ?>
                                                        </div>
                                                        <!-- Button -->
                                                        <h4> Price : <?php echo $membership->membership_totalPrice; ?> </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } } } ?>
                                </aside>
                            </article>
                        </section>
                        <!-- Hospital Membership Ends -->

                        <!-- Hospital Diagnostic Starts -->
                        <section class="tab-pane fade in <?php if ($active_tag == 3) { echo "active"; } ?>" id="Diagnostic">
                            <article class="detailbox membership-plan2">
                                <aside class="col-md-12">
                                    <a href="<?php echo site_url() ?>/membership/membershipAdd/3" class="btn btn-appointment m-b-20 membership-btn waves-effect waves-light" title="Create New Membership"><i class="fa fa-plus"></i> Add</a>
                                </aside>
                                <aside class="clearfix">
                                    <?php if(isset($membership_list) && $membership_list != NULL){ 
                                        foreach($membership_list as $membership){ 
                                        if($membership->membership_type == 3){ ?>
                                        <div class=" col-md-4">
                                            <div class="pricing-item">
                                                <div class="pricing-item-inner">
                                                    <a href="<?php echo site_url() ?>/membership/membershipEditView/<?php echo $membership->membership_id; ?>" class="pull-right m-r-10 m-t-10"><i class="fa fa-pencil"></i></a>
                                                    <a href="javascript:void(0)" onclick="enableFn('membership', 'membershipPublish', '<?php echo $membership->membership_id; ?>','<?php echo $membership->status; ?>','3')" title='<?php if($membership->status == 1){ echo "Active"; }else{ echo "Inactive"; } ?> Membership' class="pull-right m-r-10 m-t-10"><i class="fa fa-thumbs-<?php if($membership->status == 1){ echo "up"; }else{ echo "down danger"; } ?> "></i></a>
                                                    <div class="pricing-wrap">

                                                        <!-- Pricing Title -->
                                                        <div class="pricing-title">
                                                            <?php echo $membership->membership_name; ?>
                                                        </div>
                                                        <!-- Pricing Features -->
                                                        <div class="pricing-features">
                                                            <?php
                                                                $option = array(
                                                                    'table' => 'qyura_membershipFacilities',
                                                                    'select' => 'facilities_name,membershipFacilities_quantity,membershipFacilities_duration',
                                                                    'where' => array('qyura_membershipFacilities.membershipFacilities_deleted' => 0,'qyura_facilities.facilities_deleted' => 0,'qyura_membershipFacilities.membershipFacilities_membershipId' => $membership->membership_id),
                                                                    'join' => array(
                                                                        array('qyura_facilities', 'qyura_facilities.facilities_id = qyura_membershipFacilities.	membershipFacilities_facilitiesId', 'left')
                                                                    ),
                                                                );
                                                                $facility_list =$this->common_model->customGet($option); 
                                                            ?>
                                                            <ul class="sf-list pr-list">
                                                                <?php if(isset($facility_list) && $facility_list != NULL){
                                                                    foreach($facility_list as $facility){?>
                                                                    <li><?php echo $facility->membershipFacilities_quantity; ?> <?php echo $facility->facilities_name; ?> <?php if(isset($facility->membershipFacilities_duration) && $facility->membershipFacilities_duration != 0){ echo "For ".$facility->membershipFacilities_duration." "."Weeks"; } ?></li>
                                                                <?php } }?>
                                                            </ul>
                                                        </div>
                                                        <div class="pricing-num">
                                                            <sup><i class="fa fa-inr"></i></sup><?php echo $membership->membership_totalPrice; ?>
                                                        </div>
                                                        <div class="pr-per">
                                                            <?php if($membership->membership_plan == 18){ echo "Yearly"; }else{ echo "Yearly"; } ?>
                                                        </div>
                                                        <!-- Button -->
                                                        <h4> Price : <?php echo $membership->membership_totalPrice; ?> </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } } } ?>
                                </aside>
                            </article>
                        </section>
                    </article>
                </div>
            </section>
            <!-- Table Section End -->
            <article class="clearfix"></article>
        </div>
        <!-- Left Section End -->
    </div>
    <!-- container -->
</div>
<!-- content -->
