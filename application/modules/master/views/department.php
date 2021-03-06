<div class="content-page">
<!-- Start content -->
<div class="content">
   <div class="container row">
      <!-- Left Section Start -->
      <section class="col-md-12 detailbox">
         <div class="bg-white">
            <!-- Table Section Start -->
            <article class="tab-content m-t-20">
               <!-- Department Addition Starts -->
               <section class="tab-pane fade in <?php if($this->uri->segment(3) == '' || $this->uri->segment(3) == 1){ echo "active"; }?>" id="Department">
                  <!-- Left Section Start -->
                  <section class="col-md-7 detailbox m-b-20">
                     <aside class="bg-white">
                     <figure class="clearfix">
                        <h3>Available Departments</h3>
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
                        
                           <form name="departmentEditForm" action="#" id="departmentEditForm" method="post">
                           <ul id="list" class="list-unstyled ul-bigspace">
                              <?php $countDepartment = 1; if(isset($departmentList) && $departmentList != NULL){
                                 foreach ($departmentList as $list){ ?>
                              <li class="clearfix  border-t membership-plan m-t-10" id="department<?php echo $countDepartment;?>">
                                 <span class="col-md-8">
                                    <h6><?php echo strip_tags(substr($list->department_name, 0,20)); ?></h6>
                                 </span>
                                 <span class="col-md-4 text-right">
                                    <h6>
                                        <a onclick="showDepartment('<?php echo $countDepartment;?>')" href="#"><i class="md md-edit membership-btn" style="line-height: 3"></i></a>
                                      <button onclick="if((<?php echo $list->status; ?>)===0)enableFn('master', 'departmentPublish', '<?php echo $list->department_id; ?>','<?php echo $list->status; ?>')" type="button" class="btn btn-<?php if($list->status == 0){ echo "warning"; }else { echo "success"; }?> waves-effect waves-light m-b-5"><?php if($list->status == 0){ echo "Inactive"; }else if($list->status == 1){ echo "Active"; } ?></button>
                                    </h6>
                                 </span>
                              </li>
                           <li class="newmembership clearfix" style="display:none" id="editDept<?php echo $countDepartment;?>">
                                <input type="hidden" id="department_id_<?php echo $countDepartment; ?>" name="department_id_<?php echo $countDepartment; ?>" value="<?php echo $list->department_id; ?>" >
                                <span class="col-md-10">
                                <input type="text" required="" name="department_name_<?php echo $countDepartment; ?>" id="department_name_<?php echo $countDepartment; ?>" class="form-control" value="<?php echo $list->department_name; ?>" onkeypress="return isAlpha(event,this.value)">
                                   <label class="error" id="err_department_name_<?php echo $countDepartment; ?>" > <?php echo form_error("department_name"); ?></label>
                                </span>
                                <span class="col-md-1">
                                   <button class="btn btn-sm btn-success" type="submit" title="Save"><i class="fa fa-floppy-o membership-btn"></i></button>
                                   </span><span class="col-md-1">
                                   <a class="text-danger pull-left" onclick="hideDepartment('<?php echo $countDepartment;?>')" href="#" style="line-height: 1.6"><i class="md md-cancel membership-btn m-t-5"></i></a>
                                </span>
                             </li>
                             <?php $countDepartment++;} } ?>
                             <input type="hidden" id="total_count" name="total_count" value="<?php echo $countDepartment; ?>" >
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
                           <!-- Add Category -->
                           <figure>
               <h3>Add Departments</h3>
               </figure>
                           <div class="col-sm-12">
                              <form name="departmentaddForm" action="#" id="departmentaddForm" method="post" class="form-horizontal" >
                                 <article class="clearfix m-t-10">
                                    <label for="" class="control-label">Add New Department:</label>
                                    <div class="">
                                       <input type="text"  name="department_name" id="department_name" class="form-control" onkeypress="return isAlpha(event,this.value)">
                                       <label class="error" id="err_department_name"> <?php echo form_error("department_name"); ?></label>
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
               <!-- Department addition Ends -->
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