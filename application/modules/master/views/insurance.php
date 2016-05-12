<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="clearfix">
                <div class="col-md-12">
                    <h3 class="pull-left page-title">Insurance</h3>
                    <div id="load_consulting" class="text-center text-success " style="display: none"><image alt="Please wait data is loading" src="<?php echo base_url('assets/images/loader/Heart_beat.gif'); ?>" /></div>
                </div>
            </div>
            <!-- Left Section Start -->
            <section class="col-md-7 detailbox m-b-20">
                <aside class="bg-white">
                <figure class="clearfix">
               <h3>Available Insurance Companies</h3>
               <article class="clearfix">
                  <div class="input-group m-b-5">
                     <span class="input-group-btn">
                     <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                     </span>
                     <input type="text" placeholder="Search" class="form-control" id="search-text">
                  </div>
               </article>
            </figure>
                    <div class="nicescroll mx-h-400" style="overflow: hidden;" tabindex="5004">
                        <div class="clearfix">
                        <ul id="list" class="list-unstyled ul-bigspace">
                            <?php if(isset($qyura_insurance) && $qyura_insurance != NULL){ 
                                foreach($qyura_insurance as $insurance){?>
                            <li class="clearfix text-center border-t  p-b-10">
                                <span class="col-md-4 m-t-10">
                                    <img class="img-responsive center-block" src="<?php echo base_url() ?>assets/insuranceImages/3x/<?php echo $insurance->insurance_img; ?>" height="100" width="100">
                                </span>
                                <span class="col-md-4 ">
                                    <h6><?php echo strip_tags(substr($insurance->insurance_Name, 0,20)); ?></h6>
                                    <?php echo strip_tags(substr($insurance->insurance_detail, 0,20)); ?>
                                </span>
                                <span class="col-md-4 text-right">
                                    <h6>
                                        <a class="btn btn-success waves-effect waves-light m-b-5" href="<?php echo site_url('master/editInsuranceView/' . $insurance->insurance_id); ?>"><i class="fa fa-pencil"></i></a>
                                        <button onclick="if((<?php echo $insurance->status; ?>)===0)enableFn('master', 'insurancePublish', '<?php echo $insurance->insurance_id; ?>','<?php echo $insurance->status; ?>')" type="button" class="btn btn-<?php if($insurance->status == 0){ echo "warning"; }else { echo "success"; }?> waves-effect waves-light m-b-5"><?php if($insurance->status == 1){ echo "Active"; }else if($insurance->status == 0){ echo "Inactive"; } ?></button>
                                        
                                    </h6>
                                </span>
                            </li>
                            <?php } } ?>
                            </ul>
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
                        <figure>
                            <h3>Add Insurance</h3>
                        </figure>
                        <!-- Add Specialities -->
                        <div class="col-sm-12">
                            <form class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" method="post" action="#" novalidate="novalidate" name="doctorForm" enctype="multipart/form-data" onsubmit="return imageValidate()">
                                <article class="clearfix m-t-10">
                                    <label for="" class="control-label">Company Name :</label>
                                    <div class="">
                                        <input class="form-control m-t-5" id="insurance_Name" type="text" name="insurance_Name" required="" onkeypress="return isAlpha(event,this.value)">
                                        <label class="error" id="err_insurance_Name" > <?php echo form_error("specialityName"); ?></label>
                                    </div>
                                </article>
                                <article class="clearfix m-t-10">
                                    <label for="" class="control-label">Insurance Detail</label>
                                    <div class="">
                                        <textarea class="form-control m-t-5" id="insurance_detail" type="text" name="insurance_detail" required=""></textarea>
                                        <label class="error" id="err_insurance_detail" > <?php echo form_error("specialityName"); ?></label>
                                    </div>
                                </article>
                                <article class="clearfix m-t-10" id="crop-avatar">
                                    <div id="upload_modal_form">
                                        <?php $this->load->view('upload_crop_modal');?>
                                    </div>
                                <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                                
                                <div class="col-md-8 col-sm-8" data-target="#modal" data-toggle="modal">
                                    <label class="col-md-4 col-sm-4" for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x avatar-view"></i></label>

                                    <div class="pre col-md-4 col-sm-4 ">
                                    <div id="preImgLogo" class="avatar-preview preview-md preImgLogo">
                                        
                                   <img src="<?php echo base_url() ?>assets/default-images/Dignostics-logo.png"  class="image-preview-show"/>
                                        
                                    </div>
                                    </div>
                                    <div id="error-label" class="error-label"></div>
                                    <label class="error" > <?php echo form_error("avatar_file"); ?></label>
                                    
                                    <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                                    
                                    
                                    
                                </div>
                                
                            </article>

                                <article class="clearfix m-t-10 m-b-20">
                                    <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Submit</button>
                                </article>
                                
                            </form>
                        </div>
                        <!-- Add Specialities -->
                    </aside>
                </div>
            </section>
            <!-- Right Section End -->
        </div>
        <!-- container -->
    </div>
    <!-- content -->
