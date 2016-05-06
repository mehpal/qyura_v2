<div class="content-page">
<!-- Start content -->
<div class="content">
   <div class="container row" onload="fetchSelectedDepartments(this.value);">
      <!-- Left Section Start -->
      <section class="col-md-12 detailbox">
         <div class="bg-white">
            <!-- Table Section Start -->
            <article class="tab-content m-t-20">
               <!-- Designation edit Starts -->
               <section class="tab-pane fade in <?php if($this->uri->segment(3) == '' || $this->uri->segment(3) == 1){ echo "active"; }?>" id="Designation">
                  <!-- Left Section Start -->
                  <section class="col-md-7 detailbox m-b-20">
                     <aside class="bg-white">
                        <figure class="clearfix">
                           <h3>Available Designations</h3>
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
                           <div class="clearfix">
                              <form name="designationEditForm" action="#" id="designationEditForm" method="post">
                              <ul id="list" class="list-unstyled ul-bigspace">
                                 <?php $countDesignation = 1; if(isset($Departments) && $Departments != NULL){
                                    foreach ($Departments as $list){
                                    ?>
                                 <li class="clearfix  border-t membership-plan m-t-10">
                                    <span class="col-md-4">
                                       <h6><?php echo $list->department_name;?> </h6>
                                    </span>
                                    <span class="col-md-4">
                                       <h6><?php echo $list->designation_name; ?></h6>
                                    </span>
                                    <span class="col-md-4 text-right">
                                       <h6>
                                           <a href="javascript:void(0)"><i class="md md-edit membership-btn" style="line-height: 3"></i></a>
                                           <button onclick="if((<?php echo $dsgnStatus->status; ?>)===0)enableFn('master', 'designationPublish', '<?php echo $dsgnStatus->designation_id; ?>','<?php echo $dsgnStatus->status; ?>')" type="button" class="btn btn-<?php if($dsgnStatus->status == 0){ echo "warning"; }else { echo "success"; }?> waves-effect waves-light m-b-5"><?php if($dsgnStatus->status == 0){ echo "Inactive"; }else if($dsgnStatus->status == 1){ echo "Active"; } ?></button>                                         
                                       </h6>
                                    </span>
                                 </li>
                                
                                 <li class="newmembership m-t-10" style="display:none">
                                    <span class="col-md-5 ">
                                       <input type="hidden" id="designation_id_<?php echo $countDesignation; ?>" name="designation_id_<?php echo $countDesignation; ?>" value="<?php echo $list->designation_id; ?>" >

                                       <select class="selectpicker" data-width="100%" name="designation_departmentId_<?php echo $countDesignation; ?>" id="designation_departmentId_<?php echo $countDesignation; ?>" style="z-index: 1000000 !important">
                                            <option>Select Department</option>
                                               <?php if (!empty($allDepartments)):
                                                  foreach ($allDepartments as $val):
                                                      ?>
                                               <option value="<?php echo $val->department_id; ?>" <?php if ($list->department_id == $val->department_id):echo"selected";
                                                  endif; ?>><?php echo $val->department_name; ?></option>
                                               <?php endforeach;
                                                  endif; ?>
                                            </select>
                                            <label class="error" id="err_designation_departmentId_<?php echo $countDesignation; ?>" > <?php echo form_error("designation_departmentId"); ?></label>
                                    </span>
                                    <span class="col-md-5">
                                        <input type="text" required="" name="designation_name_<?php echo $countDesignation; ?>" id="designation_name_<?php echo $countDesignation; ?>" class="form-control" value="<?php echo $list->designation_name; ?>" pattern="[a-zA-Z]+">
                                       <label class="error" id="err_designation_name_<?php echo $countDesignation; ?>" > <?php echo form_error("designation_name"); ?></label>
                                    </span>
                                    <span class="col-md-2">
                                       <button class="" type="submit" title="Save"><i class="fa fa-floppy-o membership-btn"></i></button>
                                       <a href="javascript:void(0)" style="line-height: 1.6"><i class="md md-cancel membership-btn"></i></a>
                                    </span>
                                 </li>
                                 <?php $countDesignation++;} } ?>
                                 <input type="hidden" id="total_count" name="total_count" value="<?php echo $countDesignation; ?>" >
                              </form>
                           </div>
                        </div>
                     </aside>
                  </section>
                  <!-- Designation edit Ends -->
                  <!-- Left Section End -->
                  <!-- Right Section Start -->
                  <section class="col-md-5 detailbox">
                     <div class="bg-white">
                        <aside class="clearfix">
                           <!-- Add Category -->
                           <figure>
                              <h3>Add Designations</h3>
                           </figure>
                           <div class="col-sm-12">
                              <form name="designationaddForm" action="#" id="designationaddForm" method="post" class="form-horizontal" >
                                 <input type="hidden" id="DepartmentId" name="DepartmentId" value="" />
                                 <article class="clearfix m-t-10">
                                    <label for="cname" class="control-label">Department:</label>
                                    <div class="">
                                       <aside class="row">
                                          <div class="col-md-12 col-sm-8">
                                             <select class="selectpicker" data-width="100%" name="designation_departmentId" id="designation_departmentId" >
                                                <option value="">Select Department</option>
                                                <?php foreach ($allDepartments as $val) { ?>
                                                <option <?php echo  set_select('department_id', $val->department_id); ?> value="<?php echo $val->department_id; ?>"><?php echo $val->department_name; ?></option>
                                                <?php } ?>
                                             </select>
                                             <label class="error" id="err_designation_departmentId" > <?php echo form_error("designation_departmentId"); ?></label>
                                          </div>
                                       </aside>
                                    </div>
                                 </article>
                                 <article class="clearfix m-t-10">
                                    <label for="" class="control-label">Add New Designation:</label>
                                    <div class="">
                                       <input type="text" required="" name="designation_name" id="designation_name" class="form-control" onkeypress="return isAlpha(event,this.value)">
                                       <label class="error" id="err_designation_name" > <?php echo form_error("designation_name"); ?></label>
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
