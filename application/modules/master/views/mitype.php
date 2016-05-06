<style>
   .l-height{
        line-height: 3;
   }
</style>
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
                    <li class="<?php if ($active_tag == 2) { echo "active"; } ?>">
                       <a data-toggle="tab" href="#Bloodbank">Blood Bank</a>
                    </li>
                    <li class="<?php if ($active_tag == 5) { echo "active"; } ?>">
                       <a data-toggle="tab" href="#Pharmacy">Pharmacy</a>
                    </li>
                    <li class="<?php if ($active_tag == 8) { echo "active"; } ?>">
                       <a data-toggle="tab" href="#Ambulance">Ambulance</a>
                    </li>
               </ul>
            </article>
            <article class="tab-content m-t-20">
               <!-- Hospital Membership Starts -->
               <section class="tab-pane fade in <?php if ($active_tag == '' || $active_tag == 1) { echo "active"; } ?>" id="Hospital">
                  <!-- Left Section Start -->
                  <section class="col-md-7 detailbox m-b-20">
                     <aside class="bg-white">
                        <figure class="clearfix">
                           <h3>Available Hospital Types</h3>
                           <article class="clearfix">
                              <div class="input-group m-b-5">
                                 <span class="input-group-btn">
                                 <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                                 </span>
                                 <input type="text" placeholder="Search" class="form-control" id="search-text">
                              </div>
                           </article>
                        </figure>
                        <div class="nicescroll mxh-400" style="overflow: hidden;" tabindex="5000">
                           <div class="col-md-12 p-t-20 p-b-20">
                              <form name="miHospiForm" action="#" id="miHospiForm" method="post">
                                 <ul id="list" class="list-unstyled ul-bigspace">
                                    <?php $countHospi = 1; if(isset($miList) && $miList != NULL){
                                       foreach ($miList as $list){
                                       if($list->hospitalType_miRole == 1){ ?>
                                    <input type="hidden" id="hospitalType_miRole" name="hospitalType_miRole" value="<?php echo $list->hospitalType_miRole; ?>">
                                    <li class="clearfix degrees">
                                       <div class="membership-plan" >
                                          <span class="col-md-9">
                                          <?php if($list->hospitalType_name){ echo $list->hospitalType_name; }else{echo ''; } ?>
                                          </span>
                                          <span class="col-md-3">
                                          <a href="#"><i class="md md-edit membership-btn l-height"></i></a>
                                          <button onclick="if((<?php echo $list->status; ?>)===0)enableFn('master', 'miTypePublish', '<?php echo $list->hospitalType_id; ?>','<?php echo $list->status; ?>','1')" type="button" class="btn btn-<?php if($list->status == 0){ echo "warning"; }else { echo "success"; }?> waves-effect waves-light m-b-5"><?php if($list->status == 1){ echo "Active"; }else if($list->status == 0){ echo "Inactive"; } ?></button>
                                          </span>
                                       </div>
                                    <li class="newmembership" style="display:none">
                                       <span class="col-md-10">
                                       <input type="hidden" id="hospitalType_id_<?php echo $countHospi; ?>" name="hospitalType_id_<?php echo $countHospi; ?>" value="<?php echo $list->hospitalType_id; ?>" >
                                       <input type="text" required="" name="hospitalType_name_<?php echo $countHospi; ?>" id="hospitalType_name_<?php echo $countHospi; ?>" class="form-control" value="<?php if($list->hospitalType_name){ echo $list->hospitalType_name; }else{echo ''; } ?>">
                                       <label class="error" id="hospitalType_name_<?php echo $countHospi; ?>" > <?php echo form_error("hospitalType_name_$countHospi"); ?></label>
                                       </span>
                                       <span class="col-md-2">
                                       <button class="" type="submit" title="Save"><i class="fa fa-floppy-o membership-btn"></i></button>
                                       <a href="#"><i class="md md-cancel membership-btn l-height"></i></a>
                                       </span>
                                    </li>
                                    </li>
                                    <?php $countHospi++;} } } ?>
                                    <input type="hidden" id="total_count" name="total_count" value="<?php echo $countHospi; ?>" >
                                 </ul>
                              </form>
                           </div>
                        </div>
                     </aside>
                  </section>
                  <!-- Left Section End -->
                  <!-- Right Section Start -->
                  <section class="col-md-5 detailbox">
                     <div class="bg-white">
                        <aside class="clearfix">
                           <!-- Appointment Chart -->
                           <!-- Add Category -->
                           <figure>
                              <h3>Add Hospitals</h3>
                           </figure>
                           <div class="col-sm-12">
                              <form name="miaddHospiForm" action="#" id="miaddHospiForm" method="post" class="form-horizontal" >
                                 <article class="clearfix m-t-10">
                                    <label for="" class="control-label">Add New Hospital Type:</label>
                                    <div class="">
                                       <input type="hidden" id="hospitalType_miRole" name="hospitalType_miRole" value="1">
                                       <input type="text" required="" name="hospitalType_name" id="hospitalType_name" class="form-control" onkeypress="return isAlpha(event,this.value)">
                                       <label class="error" id="err_hospitalType_name" > <?php echo form_error("hospitalType_name"); ?></label>
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
               </section>
               <!-- Hospital Membership Ends -->
               <!-- Hospital Diagnostic Starts -->
               <section class="tab-pane fade in <?php if ($active_tag == 3) { echo "active"; } ?>" id="Diagnostic">
                  <!-- Left Section Start -->
                  <section class="col-md-7 detailbox m-b-20">
                     <aside class="bg-white">
                        <figure class="clearfix">
                           <h3>Available Diagnostic Types</h3>
                           <article class="clearfix">
                              <div class="input-group m-b-5">
                                 <span class="input-group-btn">
                                 <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                                 </span>
                                 <input type="text" placeholder="Search" class="form-control" id="search-text1">
                              </div>
                           </article>
                        </figure>
                        <div class="nicescroll mxh-400" style="overflow: hidden;" tabindex="5000">
                           <div class="col-md-12 p-t-20 p-b-20">
                              <form name="miDigoForm" action="#" id="miDigoForm" method="post">
                                 <ul id="list1" class="list-unstyled ul-bigspace">
                                    <?php $countHospi = 1; if(isset($miList) && $miList != NULL){
                                       foreach ($miList as $list){
                                       if($list->hospitalType_miRole == 3){ ?>
                                    <input type="hidden" id="hospitalType_miRole" name="hospitalType_miRole" value="<?php echo $list->hospitalType_miRole; ?>">
                                    <li class="clearfix degrees">
                                       <div class="membership-plan" >
                                          <span class="col-md-9">
                                          <?php if($list->hospitalType_name){ echo $list->hospitalType_name; }else{echo ''; } ?>
                                          </span>
                                          <span class="col-md-3">
                                          <a href="#"><i class="md md-edit membership-btn l-height"></i></a>
                                          <button onclick="if((<?php echo $list->status; ?>)===0)enableFn('master', 'miTypePublish', '<?php echo $list->hospitalType_id; ?>','<?php echo $list->status; ?>','3')" type="button" class="btn btn-<?php if($list->status == 0){ echo "warning"; }else { echo "success"; }?> waves-effect waves-light m-b-5"><?php if($list->status == 0){ echo "Inactive"; }else if($list->status == 1){ echo "Active"; } ?></button>
                                          </span>
                                       </div>
                                    <li class="newmembership" style="display:none">
                                       <span class="col-md-10">
                                       <input type="hidden" id="hospitalType_id_<?php echo $countHospi; ?>" name="hospitalType_id_<?php echo $countHospi; ?>" value="<?php echo $list->hospitalType_id; ?>" >
                                       <input type="text" required="" name="hospitalType_name_<?php echo $countHospi; ?>" id="hospitalType_name_<?php echo $countHospi; ?>" class="form-control" value="<?php if($list->hospitalType_name){ echo $list->hospitalType_name; }else{echo ''; } ?>">
                                       <label class="error" id="hospitalType_name_<?php echo $countHospi; ?>" > <?php echo form_error("hospitalType_name_$countHospi"); ?></label>
                                       </span>
                                       <span class="col-md-2">
                                       <button class="" type="submit" title="Save"><i class="fa fa-floppy-o membership-btn"></i></button>
                                       <a href="#"><i class="md md-cancel membership-btn l-height"></i></a>
                                       </span>
                                    </li>
                                    </li>
                                    <?php $countHospi++;} } } ?>
                                    <input type="hidden" id="total_count" name="total_count" value="<?php echo $countHospi; ?>" >
                                 </ul>
                              </form>
                           </div>
                        </div>
                     </aside>
                  </section>
                  <!-- Left Section End -->
                  <!-- Right Section Start -->
                  <section class="col-md-5 detailbox">
                     <div class="bg-white">
                        <aside class="clearfix">
                           <!-- Appointment Chart -->
                           <!-- Add Category -->
                           <figure>
                              <h3>Add Diagnostics</h3>
                           </figure>
                           <div class="col-sm-12">
                              <form name="miaddDigoForm" action="#" id="miaddDigoForm" method="post" class="form-horizontal" >
                                 <article class="clearfix m-t-10">
                                    <label for="" class="control-label">Add New Diagnostic Type:</label>
                                    <div class="">
                                       <input type="hidden" id="hospitalType_miRole" name="hospitalType_miRole" value="3">
                                       <input type="text" required="" name="hospitalType_name" id="hospitalType_name" class="form-control" onkeypress="return isAlpha(event,this.value)">
                                       <label class="error" id="err_hospitalType_name" > <?php echo form_error("hospitalType_name"); ?></label>
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
               </section>
               <!-- Hospital Diagnostic Ends -->
               <!-- Hospital Bloodbank Starts -->
               <section class="tab-pane fade in <?php if ($active_tag == 2) { echo "active"; } ?>" id="Bloodbank">
                  <!-- Left Section Start -->
                  <section class="col-md-7 detailbox m-b-20">
                     <aside class="bg-white">
                        <figure class="clearfix">
                           <h3>Available Blood Banks</h3>
                           <article class="clearfix">
                              <div class="input-group m-b-5">
                                 <span class="input-group-btn">
                                 <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                                 </span>
                                 <input type="text" placeholder="Search" class="form-control" id="search-text2">
                              </div>
                           </article>
                        </figure>
                        <div class="nicescroll mxh-400" style="overflow: hidden;" tabindex="5000">
                           <div class="col-md-12 p-t-20 p-b-20">
                              <form name="miBloodForm" action="#" id="miBloodForm" method="post">
                                 <ul id="list2" class="list-unstyled ul-bigspace">
                                    <?php $countHospi = 1; if(isset($miList) && $miList != NULL){
                                       foreach ($miList as $list){
                                       if($list->hospitalType_miRole == 2){ ?>
                                    <input type="hidden" id="hospitalType_miRole" name="hospitalType_miRole" value="<?php echo $list->hospitalType_miRole; ?>">
                                    <li class="clearfix degrees">
                                       <div class="membership-plan" >
                                          <span class="col-md-9">
                                          <?php if($list->hospitalType_name){ echo $list->hospitalType_name; }else{echo ''; } ?>
                                          </span>
                                          <span class="col-md-3">
                                          <a href="#"><i class="md md-edit membership-btn l-height"></i></a>
                                          <button onclick="if((<?php echo $list->status; ?>)===0)enableFn('master', 'miTypePublish', '<?php echo $list->hospitalType_id; ?>','<?php echo $list->status; ?>','2')" type="button" class="btn btn-<?php if($list->status == 0){ echo "warning"; }else { echo "success"; }?> waves-effect waves-light m-b-5"><?php if($list->status == 1){ echo "Active"; }else if($list->status == 0){ echo "Inactive"; } ?></button>
                                          </span>
                                       </div>
                                    <li class="newmembership" style="display:none">
                                       <span class="col-md-10">
                                       <input type="hidden" id="hospitalType_id_<?php echo $countHospi; ?>" name="hospitalType_id_<?php echo $countHospi; ?>" value="<?php echo $list->hospitalType_id; ?>" >
                                       <input type="text" required="" name="hospitalType_name_<?php echo $countHospi; ?>" id="hospitalType_name_<?php echo $countHospi; ?>" class="form-control" value="<?php if($list->hospitalType_name){ echo $list->hospitalType_name; }else{echo ''; } ?>">
                                       <label class="error" id="hospitalType_name_<?php echo $countHospi; ?>" > <?php echo form_error("hospitalType_name_$countHospi"); ?></label>
                                       </span>
                                       <span class="col-md-2">
                                       <button class="" type="submit" title="Save"><i class="fa fa-floppy-o membership-btn"></i></button>
                                       <a href="#"><i class="md md-cancel membership-btn l-height"></i></a>
                                       </span>
                                    </li>
                                    </li>
                                    <?php $countHospi++;} } } ?>
                                    <input type="hidden" id="total_count" name="total_count" value="<?php echo $countHospi; ?>" >
                                 </ul>
                              </form>
                           </div>
                        </div>
                     </aside>
                  </section>
                  <!-- Left Section End -->
                  <!-- Right Section Start -->
                  <section class="col-md-5 detailbox">
                     <div class="bg-white">
                        <aside class="clearfix">
                           <!-- Appointment Chart -->
                           <!-- Add Category -->
                           <figure>
                              <h3>Add Blood Banks</h3>
                           </figure>
                           <div class="col-sm-12">
                              <form name="miaddBankForm" action="#" id="miaddBankForm" method="post" class="form-horizontal" >
                                 <article class="clearfix m-t-10">
                                    <label for="" class="control-label">Add New Blood Bank Type:</label>
                                    <div class="">
                                       <input type="hidden" id="hospitalType_miRole" name="hospitalType_miRole" value="2">
                                       <input type="text" required="" name="hospitalType_name" id="hospitalType_name" class="form-control" onkeypress="return isAlpha(event,this.value)">
                                       <label class="error" id="err_hospitalType_name" > <?php echo form_error("hospitalType_name"); ?></label>
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
               </section>
               <!-- Hospital Bloodbank Ends -->
               <!-- Hospital Pharmacy Starts -->
               <section class="tab-pane fade in <?php if ($active_tag == 5) { echo "active"; } ?>" id="Pharmacy">
                  <!-- Left Section Start -->
                  <section class="col-md-7 detailbox m-b-20">
                     <aside class="bg-white">
                        <figure class="clearfix">
                           <h3>Available Pharmacies</h3>
                           <article class="clearfix">
                              <div class="input-group m-b-5">
                                 <span class="input-group-btn">
                                 <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                                 </span>
                                 <input type="text" placeholder="Search" class="form-control" id="search-text3">
                              </div>
                           </article>
                        </figure>
                        <div class="nicescroll mxh-400" style="overflow: hidden;" tabindex="5000">
                           <div class="col-md-12 p-t-20 p-b-20">
                              <form name="miPharmacyForm" action="#" id="miPharmacyForm" method="post">
                                 <ul id="list3" class="list-unstyled ul-bigspace">
                                    <?php $countHospi = 1; if(isset($miList) && $miList != NULL){
                                       foreach ($miList as $list){
                                       if($list->hospitalType_miRole == 5){ ?>
                                    <input type="hidden" id="hospitalType_miRole" name="hospitalType_miRole" value="<?php echo $list->hospitalType_miRole; ?>">
                                    <li class="clearfix degrees">
                                       <div class="membership-plan" >
                                          <span class="col-md-9">
                                          <?php if($list->hospitalType_name){ echo $list->hospitalType_name; }else{echo ''; } ?>
                                          </span>
                                          <span class="col-md-3">
                                          <a href="#"><i class="md md-edit membership-btn l-height"></i></a>
                                          <button onclick="if((<?php echo $list->status; ?>)===0)enableFn('master', 'miTypePublish', '<?php echo $list->hospitalType_id; ?>','<?php echo $list->status; ?>','5')" type="button" class="btn btn-<?php if($list->status == 0){ echo "warning"; }else { echo "success"; }?> waves-effect waves-light m-b-5"><?php if($list->status == 1){ echo "Active"; }else if($list->status == 0){ echo "Inactive"; } ?></button>
                                          </span>
                                       </div>
                                    <li class="newmembership" style="display:none">
                                       <span class="col-md-10">
                                       <input type="hidden" id="hospitalType_id_<?php echo $countHospi; ?>" name="hospitalType_id_<?php echo $countHospi; ?>" value="<?php echo $list->hospitalType_id; ?>" >
                                       <input type="text" required="" name="hospitalType_name_<?php echo $countHospi; ?>" id="hospitalType_name_<?php echo $countHospi; ?>" class="form-control" value="<?php if($list->hospitalType_name){ echo $list->hospitalType_name; }else{echo ''; } ?>">
                                       <label class="error" id="hospitalType_name_<?php echo $countHospi; ?>" > <?php echo form_error("hospitalType_name_$countHospi"); ?></label>
                                       </span>
                                       <span class="col-md-2">
                                       <button class="" type="submit" title="Save"><i class="fa fa-floppy-o membership-btn"></i></button>
                                       <a href="#"><i class="md md-cancel membership-btn l-height"></i></a>
                                       </span>
                                    </li>
                                    </li>
                                    <?php $countHospi++;} } } ?>
                                    <input type="hidden" id="total_count" name="total_count" value="<?php echo $countHospi; ?>" >
                                 </ul>
                              </form>
                           </div>
                        </div>
                     </aside>
                  </section>
                  <!-- Left Section End -->
                  <!-- Right Section Start -->
                  <section class="col-md-5 detailbox">
                     <div class="bg-white">
                        <aside class="clearfix">
                           <!-- Appointment Chart -->
                           <!-- Add Category -->
                           <figure>
                              <h3>Add Pharmacies</h3>
                           </figure>
                           <div class="col-sm-12">
                              <form name="miaddPharmacyForm" action="#" id="miaddPharmacyForm" method="post" class="form-horizontal" >
                                 <article class="clearfix m-t-10">
                                    <label for="" class="control-label">Add New Pharmacy Type:</label>
                                    <div class="">
                                       <input type="hidden" id="hospitalType_miRole" name="hospitalType_miRole" value="5">
                                       <input type="text" required="" name="hospitalType_name" id="hospitalType_name" class="form-control" onkeypress="return isAlpha(event,this.value)">
                                       <label class="error" id="err_hospitalType_name" > <?php echo form_error("hospitalType_name"); ?></label>
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
               </section>
               <!-- Hospital Pharmacy Ends -->
               <!-- Hospital Ambulance Starts -->
               <section class="tab-pane fade in <?php if ($active_tag == 8) { echo "active"; } ?>" id="Ambulance">
                  <!-- Left Section Start -->
                  <section class="col-md-7 detailbox m-b-20">
                     <aside class="bg-white">
                        <figure class="clearfix">
                           <h3>Available Ambulances</h3>
                           <article class="clearfix">
                              <div class="input-group m-b-5">
                                 <span class="input-group-btn">
                                 <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                                 </span>
                                 <input type="text" placeholder="Search" class="form-control" id="search-text4">
                              </div>
                           </article>
                        </figure>
                        <div class="nicescroll mxh-400" style="overflow: hidden;" tabindex="5000">
                           <div class="col-md-12 p-t-20 p-b-20">
                              <form name="miAmbulanceForm" action="#" id="miAmbulanceForm" method="post">
                                 <ul id="list4" class="list-unstyled ul-bigspace">
                                    <?php $countHospi = 1; if(isset($miList) && $miList != NULL){
                                       foreach ($miList as $list){
                                       if($list->hospitalType_miRole == 8){ ?>
                                    <input type="hidden" id="hospitalType_miRole" name="hospitalType_miRole" value="<?php echo $list->hospitalType_miRole; ?>">
                                    <li class="clearfix degrees">
                                       <div class="membership-plan" >
                                          <span class="col-md-9">
                                          <?php if($list->hospitalType_name){ echo $list->hospitalType_name; }else{echo ''; } ?>
                                          </span>
                                          <span class="col-md-3">
                                          <a href="#"><i class="md md-edit membership-btn l-height"></i></a>
                                          <button onclick="if((<?php echo $list->status; ?>)===0)enableFn('master', 'miTypePublish', '<?php echo $list->hospitalType_id; ?>','<?php echo $list->status; ?>','8')" type="button" class="btn btn-<?php if($list->status == 0){ echo "warning"; }else { echo "success"; }?> waves-effect waves-light m-b-5"><?php if($list->status == 1){ echo "Active"; }else if($list->status == 0){ echo "Inactive"; } ?></button>
                                          </span>
                                       </div>
                                    <li class="newmembership" style="display:none">
                                       <span class="col-md-10">
                                       <input type="hidden" id="hospitalType_id_<?php echo $countHospi; ?>" name="hospitalType_id_<?php echo $countHospi; ?>" value="<?php echo $list->hospitalType_id; ?>" >
                                       <input type="text" required="" name="hospitalType_name_<?php echo $countHospi; ?>" id="hospitalType_name_<?php echo $countHospi; ?>" class="form-control" value="<?php if($list->hospitalType_name){ echo $list->hospitalType_name; }else{echo ''; } ?>">
                                       <label class="error" id="hospitalType_name_<?php echo $countHospi; ?>" > <?php echo form_error("hospitalType_name_$countHospi"); ?></label>
                                       </span>
                                       <span class="col-md-2">
                                       <button class="" type="submit" title="Save"><i class="fa fa-floppy-o membership-btn"></i></button>
                                       <a href="#"><i class="md md-cancel membership-btn l-height"></i></a>
                                       </span>
                                    </li>
                                    </li>
                                    <?php $countHospi++;} } } ?>
                                    <input type="hidden" id="total_count" name="total_count" value="<?php echo $countHospi; ?>" >
                                 </ul>
                              </form>
                           </div>
                        </div>
                     </aside>
                  </section>
                  <!-- Left Section End -->
                  <!-- Right Section Start -->
                  <section class="col-md-5 detailbox">
                     <div class="bg-white">
                        <aside class="clearfix">
                           <!-- Appointment Chart -->
                           <!-- Add Category -->
                           <figure>
                              <h3>Add Ambulances</h3>
                           </figure>
                           <div class="col-sm-12">
                              <form name="miaddAmbulanceForm" action="#" id="miaddAmbulanceForm" method="post" class="form-horizontal" >
                                 <article class="clearfix m-t-10">
                                    <label for="" class="control-label">Add New Ambulance Type:</label>
                                    <div class="">
                                       <input type="hidden" id="hospitalType_miRole" name="hospitalType_miRole" value="8">
                                       <input type="text" required="" name="hospitalType_name" id="hospitalType_name" class="form-control" onkeypress="return isAlpha(event,this.value)">
                                       <label class="error" id="err_hospitalType_name" > <?php echo form_error("hospitalType_name"); ?></label>
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
               </section>
               <!-- Hospital Ambulance Ends -->
            </article>
      </section>
      <!-- Table Section End -->
      <article class="clearfix">
      </article>
      </div>
      </section>
      <!-- Left Section End -->
   </div>
   <!-- container -->
</div>
