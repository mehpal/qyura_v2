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
                            <li class="<?php if($this->uri->segment(3) == '' || $this->uri->segment(3) == 1){ echo "active"; }?>">
                                <a data-toggle="tab" href="#Hospital">Hospital</a>
                            </li>
                            <li class="<?php if($this->uri->segment(3) == 3){ echo "active"; }?>">
                                <a data-toggle="tab" href="#Diagnostic">Diagnostic Centre</a>
                            </li>
                            <li class="<?php if($this->uri->segment(3) == 2){ echo "active"; }?>">
                                <a data-toggle="tab" href="#Bloodbank">Blood Bank</a>
                            </li>
                            <li class="<?php if($this->uri->segment(3) == 5){ echo "active"; }?>">
                                <a data-toggle="tab" href="#Pharmacy">Pharmacy</a>
                            </li>
                            <li class="<?php if($this->uri->segment(3) == 8){ echo "active"; }?>">
                                <a data-toggle="tab" href="#Ambulance">Ambulance</a>
                            </li>
                        </ul>
                    </article>
                    <article class="tab-content m-t-20">
                        <!-- Hospital Membership Starts -->
                        <section class="tab-pane fade in <?php if($this->uri->segment(3) == '' || $this->uri->segment(3) == 1){ echo "active"; }?>" id="Hospital">
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
                                                    <a href="javascript:void(0)" onclick="enableFn('membership', 'membershipPublish', '<?php echo $membership->membership_id; ?>','<?php echo $membership->status; ?>')" title='<?php if($membership->status == 2){ echo "Publish"; }else{ echo "Unpublish"; } ?> Membership' class="pull-right m-r-10 m-t-10"><i class="fa fa-thumbs-<?php if($membership->status == 3){ echo "up"; }else{ echo "down danger"; } ?> "></i></a>
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
                                                                    'select' => 'facilities_name',
                                                                    'where' => array('qyura_membershipFacilities.membershipFacilities_deleted' => 0,'qyura_membershipFacilities.membershipFacilities_membershipId' => $membership->membership_id),
                                                                    'join' => array(
                                                                        array('qyura_facilities', 'qyura_facilities.facilities_id = qyura_membershipFacilities.	membershipFacilities_facilitiesId', 'left')
                                                                    ),
                                                                );
                                                                $facility_list =$this->common_model->customGet($option); 
                                                            ?>
                                                            <ul class="sf-list pr-list">
                                                                <?php if(isset($facility_list) && $facility_list != NULL){
                                                                    foreach($facility_list as $facility){?>
                                                                <li><?php echo $facility->facilities_name; ?></li>
                                                                <?php } }?>
                                                            </ul>
                                                        </div>
                                                        <div class="pricing-num">
                                                            <sup><i class="fa fa-inr"></i></sup><?php echo $membership->membership_totalPrice; ?>
                                                        </div>
                                                        <div class="pr-per">
                                                            <?php if($membership->membership_plan == 1){ echo "Monthly"; }elseif($membership->membership_plan == 2){ echo "Quaterly"; }elseif($membership->membership_plan == 3){ echo "Half Yearly"; }elseif($membership->membership_plan == 4){ echo "Yearly"; } ?>
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
                        <section class="tab-pane fade in <?php if($this->uri->segment(3) == 3){ echo "active"; }?>" id="Diagnostic">
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
                                                    <a href="javascript:void(0)" onclick="enableFn('membership', 'membershipPublish', '<?php echo $membership->membership_id; ?>','<?php echo $membership->status; ?>')" title='<?php if($membership->status == 2){ echo "Publish"; }else{ echo "Unpublish"; } ?> Membership' class="pull-right m-r-10 m-t-10"><i class="fa fa-thumbs-<?php if($membership->status == 3){ echo "up"; }else{ echo "down danger"; } ?> "></i></a>
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
                                                                    'select' => 'facilities_name',
                                                                    'where' => array('qyura_membershipFacilities.membershipFacilities_deleted' => 0,'qyura_membershipFacilities.membershipFacilities_membershipId' => $membership->membership_id),
                                                                    'join' => array(
                                                                        array('qyura_facilities', 'qyura_facilities.facilities_id = qyura_membershipFacilities.	membershipFacilities_facilitiesId', 'left')
                                                                    ),
                                                                );
                                                                $facility_list =$this->common_model->customGet($option); 
                                                            ?>
                                                            <ul class="sf-list pr-list">
                                                                <?php if(isset($facility_list) && $facility_list != NULL){
                                                                    foreach($facility_list as $facility){?>
                                                                <li><?php echo $facility->facilities_name; ?></li>
                                                                <?php } }?>
                                                            </ul>
                                                        </div>
                                                        <div class="pricing-num">
                                                            <sup><i class="fa fa-inr"></i></sup><?php echo $membership->membership_totalPrice; ?>
                                                        </div>
                                                        <div class="pr-per">
                                                            <?php if($membership->membership_plan == 1){ echo "Monthly"; }elseif($membership->membership_plan == 2){ echo "Quaterly"; }elseif($membership->membership_plan == 3){ echo "Half Yearly"; }elseif($membership->membership_plan == 4){ echo "Yearly"; } ?>
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
                        <!-- Hospital Diagnostic Ends -->

                        <!-- Hospital Bloodbank Starts -->
                        <section class="tab-pane fade in <?php if($this->uri->segment(3) == 2){ echo "active"; }?>" id="Bloodbank">
                            <article class="detailbox membership-plan4">
                                <aside class="col-md-12">
                                    <a href="<?php echo site_url() ?>/membership/membershipAdd/2" class="btn btn-appointment m-b-20 membership-btn waves-effect waves-light" title="Create New Membership"><i class="fa fa-plus"></i> Add</a>
                                </aside>
                                <aside class="clearfix">
                                    <?php if(isset($membership_list) && $membership_list != NULL){ 
                                        foreach($membership_list as $membership){ 
                                        if($membership->membership_type == 2){ ?>
                                        <div class=" col-md-4">
                                            <div class="pricing-item">
                                                <div class="pricing-item-inner">
                                                    <a href="<?php echo site_url() ?>/membership/membershipEditView/<?php echo $membership->membership_id; ?>" class="pull-right m-r-10 m-t-10"><i class="fa fa-pencil"></i></a>
                                                    <a href="javascript:void(0)" onclick="enableFn('membership', 'membershipPublish', '<?php echo $membership->membership_id; ?>','<?php echo $membership->status; ?>')" title='<?php if($membership->status == 2){ echo "Publish"; }else{ echo "Unpublish"; } ?> Membership' class="pull-right m-r-10 m-t-10"><i class="fa fa-thumbs-<?php if($membership->status == 3){ echo "up"; }else{ echo "down danger"; } ?> "></i></a>
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
                                                                    'select' => 'facilities_name',
                                                                    'where' => array('qyura_membershipFacilities.membershipFacilities_deleted' => 0,'qyura_membershipFacilities.membershipFacilities_membershipId' => $membership->membership_id),
                                                                    'join' => array(
                                                                        array('qyura_facilities', 'qyura_facilities.facilities_id = qyura_membershipFacilities.	membershipFacilities_facilitiesId', 'left')
                                                                    ),
                                                                );
                                                                $facility_list =$this->common_model->customGet($option); 
                                                            ?>
                                                            <ul class="sf-list pr-list">
                                                                <?php if(isset($facility_list) && $facility_list != NULL){
                                                                    foreach($facility_list as $facility){?>
                                                                <li><?php echo $facility->facilities_name; ?></li>
                                                                <?php } }?>
                                                            </ul>
                                                        </div>
                                                        <div class="pricing-num">
                                                            <sup><i class="fa fa-inr"></i></sup><?php echo $membership->membership_totalPrice; ?>
                                                        </div>
                                                        <div class="pr-per">
                                                            <?php if($membership->membership_plan == 1){ echo "Monthly"; }elseif($membership->membership_plan == 2){ echo "Quaterly"; }elseif($membership->membership_plan == 3){ echo "Half Yearly"; }elseif($membership->membership_plan == 4){ echo "Yearly"; } ?>
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
                        <!-- Hospital Bloodbank Ends -->

                        <!-- Hospital Pharmacy Starts -->
                        <section class="tab-pane fade in <?php if($this->uri->segment(3) == 5){ echo "active"; }?>" id="Pharmacy">
                            <article class="detailbox membership-plan5">
                                <aside class="col-md-12">
                                    <a href="<?php echo site_url() ?>/membership/membershipAdd/5" class="btn btn-appointment m-b-20 membership-btn waves-effect waves-light" title="Create New Membership"><i class="fa fa-plus"></i> Add</a>
                                </aside>
                                <aside class="clearfix">
                                    <?php if(isset($membership_list) && $membership_list != NULL){ 
                                        foreach($membership_list as $membership){ 
                                        if($membership->membership_type == 5){ ?>
                                        <div class=" col-md-4">
                                            <div class="pricing-item">
                                                <div class="pricing-item-inner">
                                                    <a href="<?php echo site_url() ?>/membership/membershipEditView/<?php echo $membership->membership_id; ?>" class="pull-right m-r-10 m-t-10"><i class="fa fa-pencil"></i></a>
                                                    <a href="javascript:void(0)" onclick="enableFn('membership', 'membershipPublish', '<?php echo $membership->membership_id; ?>','<?php echo $membership->status; ?>')" title='<?php if($membership->status == 2){ echo "Publish"; }else{ echo "Unpublish"; } ?> Membership' class="pull-right m-r-10 m-t-10"><i class="fa fa-thumbs-<?php if($membership->status == 3){ echo "up"; }else{ echo "down danger"; } ?> "></i></a>
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
                                                                    'select' => 'facilities_name',
                                                                    'where' => array('qyura_membershipFacilities.membershipFacilities_deleted' => 0,'qyura_membershipFacilities.membershipFacilities_membershipId' => $membership->membership_id),
                                                                    'join' => array(
                                                                        array('qyura_facilities', 'qyura_facilities.facilities_id = qyura_membershipFacilities.	membershipFacilities_facilitiesId', 'left')
                                                                    ),
                                                                );
                                                                $facility_list =$this->common_model->customGet($option); 
                                                            ?>
                                                            <ul class="sf-list pr-list">
                                                                <?php if(isset($facility_list) && $facility_list != NULL){
                                                                    foreach($facility_list as $facility){?>
                                                                <li><?php echo $facility->facilities_name; ?></li>
                                                                <?php } }?>
                                                            </ul>
                                                        </div>
                                                        <div class="pricing-num">
                                                            <sup><i class="fa fa-inr"></i></sup><?php echo $membership->membership_totalPrice; ?>
                                                        </div>
                                                        <div class="pr-per">
                                                            <?php if($membership->membership_plan == 1){ echo "Monthly"; }elseif($membership->membership_plan == 2){ echo "Quaterly"; }elseif($membership->membership_plan == 3){ echo "Half Yearly"; }elseif($membership->membership_plan == 4){ echo "Yearly"; } ?>
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
                        <!-- Hospital Pharmacy Ends -->


                        <!-- Hospital Ambulance Starts -->
                        <section class="tab-pane fade in <?php if($this->uri->segment(3) == 8){ echo "active"; }?>" id="Ambulance">
                            <article class="detailbox membership-plan6">
                                <aside class="col-md-12">
                                    <a href="<?php echo site_url() ?>/membership/membershipAdd/8" class="btn btn-appointment m-b-20 membership-btn waves-effect waves-light" title="Create New Membership"><i class="fa fa-plus"></i> Add</a>
                                </aside>
                                <aside class="clearfix">
                                    <?php if(isset($membership_list) && $membership_list != NULL){ 
                                        foreach($membership_list as $membership){ 
                                        if($membership->membership_type == 8){ ?>
                                        <div class=" col-md-4">
                                            <div class="pricing-item">
                                                <div class="pricing-item-inner">
                                                    <a href="<?php echo site_url() ?>/membership/membershipEditView/<?php echo $membership->membership_id; ?>" class="pull-right m-r-10 m-t-10"><i class="fa fa-pencil"></i></a>
                                                    <a href="javascript:void(0)" onclick="enableFn('membership', 'membershipPublish', '<?php echo $membership->membership_id; ?>','<?php echo $membership->status; ?>')" title='<?php if($membership->status == 2){ echo "Publish"; }else{ echo "Unpublish"; } ?> Membership' class="pull-right m-r-10 m-t-10"><i class="fa fa-thumbs-<?php if($membership->status == 3){ echo "up"; }else{ echo "down danger"; } ?> "></i></a>
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
                                                                    'select' => 'facilities_name',
                                                                    'where' => array('qyura_membershipFacilities.membershipFacilities_deleted' => 0,'qyura_membershipFacilities.membershipFacilities_membershipId' => $membership->membership_id),
                                                                    'join' => array(
                                                                        array('qyura_facilities', 'qyura_facilities.facilities_id = qyura_membershipFacilities.	membershipFacilities_facilitiesId', 'left')
                                                                    ),
                                                                );
                                                                $facility_list =$this->common_model->customGet($option); 
                                                            ?>
                                                            <ul class="sf-list pr-list">
                                                                <?php if(isset($facility_list) && $facility_list != NULL){
                                                                    foreach($facility_list as $facility){?>
                                                                <li><?php echo $facility->facilities_name; ?></li>
                                                                <?php } }?>
                                                            </ul>
                                                        </div>
                                                        <div class="pricing-num">
                                                            <sup><i class="fa fa-inr"></i></sup><?php echo $membership->membership_totalPrice; ?>
                                                        </div>
                                                        <div class="pr-per">
                                                            <?php if($membership->membership_plan == 1){ echo "Monthly"; }elseif($membership->membership_plan == 2){ echo "Quaterly"; }elseif($membership->membership_plan == 3){ echo "Half Yearly"; }elseif($membership->membership_plan == 4){ echo "Yearly"; } ?>
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
                        <!-- Hospital Ambulance Ends -->
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