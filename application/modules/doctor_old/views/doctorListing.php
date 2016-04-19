
         <!-- Start right Content here -->
         <div class="content-page">
            <!-- Start content -->
            <div class="content">
               <div class="container">
                  <div class="clearfix">
                     <div class="col-md-12">
                        <h3 class="pull-left page-title">
                        Doctor Management</h43>
                     </div>
                  </div>
                  <!-- Left Section Start -->
                  <section class="col-md-12 detailbox">
                     <!-- Form Section Start -->
                     <article class="row p-b-10">
                         <form name="csvDownload" id="" action="<?php echo site_url('doctor/createCSV'); ?>" method="post">
                           <aside class="col-lg-1 col-md-2 col-sm-2">
                              <a href="<?php echo base_url();?>index.php/doctor/addDoctor" title="Add New Doctor" class="btn btn-appointment waves-effect waves-light"> <i class="fa fa-plus"></i> Add</a>
                           </aside>
                           <aside class="col-md-3 col-sm-3 m-tb-xs-3">
                              <!--<select type="text" name="search" class="selectpicker" data-width="100%"  placeholder="Search" />-->
                                 <select class="selectpicker" data-width="100%" name="doctorSpecialities_specialitiesId" Id="doctorSpecialities_specialitiesId" data-size="4">
                                     <option value="">Please Select Speciality</option>
                                 <?php  foreach($speciality as $key=>$val) {?>
                                 <option value="<?php echo $val->specialities_id;?>"><?php echo $val->specialities_name;?></option>
                                 <?php }?>
                                 </select>
                           </aside>
                           <aside class="col-md-3 col-sm-3 m-tb-xs-3">
                              <input type="text" name="search" class="form-control" placeholder="Search" />
                           </aside>
                           <aside class="col-md-2 col-sm-2 pull-right">
                              <button class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" type="submit">Export</button>
                           </aside>
                        </form>
                     </article>
                     <!-- Form Section End -->
                     <div class="bg-white">
                        <!-- Table Section Start -->
                        <article class="clearfix m-top-40 p-b-20">
                           <aside class="table-responsive">
                              <table class="table all-doctor" id="doctor_datatable">
                                 <thead>
                                    <tr class="border-a-dull">
                                       <th>Photo</th>
                                       <th>Name and Id</th>
                                       <th>Address</th>
                                       <th>Speciality</th>
                                       <th>Experience</th>
                                       <th>Date of Joining</th>
                                       <th>Phone</th>
                                       <th>Action</th>
                                    </tr>
                                    </thead>
                                   <!-- foreach($doctorData as $key => $val){ 
                                   <!-- <tr>
                                       <td>
                                          <i class="fa fa-check-circle doc-online"></i>
                                          <?php if(!empty($val->doctors_img)){?>
                                                <h6><img src="<?php echo base_url()?>assets/doctorsImages/<?php echo $val->doctors_img; ?>" alt="" class="img-responsive" height="80px;" width="80px;" /></h6>
                                               <?php } else { ?>
                                                 <h6><img src="<?php echo base_url()?>assets/images/noImage.png" alt="" class="img-responsive" height="80px;" width="80px;" /></h6>
                                               <?php } ?>
                                       </td>
                                       <td>
                                       <h6><?php echo $val->doctors_fname.' '?><?php echo $val->doctors_lname?></h6>
                                       <p><?php echo $val->doctors_unqId ?></p>
                                       </td>
                                       <td>
                                          <h6><?php echo $val->doctor_addr ?></h6>
                                       </td>
                                       <td>
                                          <h6><?php echo $val->speciality ?></h6>
                                       </td>
                                       <td>
                                          <h6><?php echo $val->exp.' years'?></h6>
                                       </td>
                                       <td>
                                          <h6><?php $val->creationTime = date("Y-m-d",$val->creationTime); ?><?php echo $val->creationTime?></h6>
                                       </td>
                                       <td>
                                          <?php 
                                                $explode= explode('|',$val->doctors_phn); 
                                                for($i= 0; $i< count($explode);$i++){?>
                                                <h6><?php echo $explode[$i];?></h6>
                                                 <?php 
                                                $explode= explode('|',$val->doctors_mobile); 
                                                for($i= 0; $i< count($explode);$i++){?>
                                                <h6><?php echo $explode[$i];?></h6>
                                                <?php }?>
                                                <?php }?>
                                          
                                       </td>
                                       <td>

                                          <h6><a href="doctor-profile.html" class="btn btn-warning waves-effect waves-light m-b-5 applist-btn">View Detail</a></h6>
                                          
                                       </td>
                                    </tr>    -->
                  <!-- } -->
                               
                              </table>
                           </aside>
                        </article>
                     </div>
                     <!-- Table Section End -->
                     <!-- <article class="clearfix m-t-20 p-b-20">
                        <ul class="list-inline list-unstyled pull-right call-pagination">
                           <li class="disabled"><a href="#">Prev</a></li>
                           <li><a href="#">1</a></li>
                           <li class="active"><a href="#">2</a></li>
                           <li><a href="#">3</a></li>
                           <li><a href="#">4</a></li>
                           <li><a href="#">Next</a></li>
                        </ul>
                     </article> -->
               </div>
               </section>
               <!-- Left Section End -->
            </div>
            <!-- container -->
         </div>
         <!-- content -->
         