  <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Specialities</h3>
                            <div id="load_consulting" class="text-center text-success " style="display: none"><image alt="Please wait data is loading" src="<?php echo base_url('assets/images/loader/Heart_beat.gif'); ?>" /></div>
                        </div>
                    </div>
<?php if(!empty($this->session->flashdata('message'))){?>
                            <div class="alert alert-success" id="successmsg" ><?php echo $this->session->flashdata('message');?></div>
                                <?php }?>
                           <?php if(!empty($this->session->flashdata('error'))){?>
                            <div class="alert alert-danger" id="errormsg"><?php echo $this->session->flashdata('error');?></div>
                                <?php }?>
                    <!-- Left Section Start -->
                    <section class="col-md-7 detailbox m-b-20">

                       <aside class="bg-white">
                                                    <figure class="clearfix">

                                                        <h3>Specialities Available</h3>


                                                        <article class="clearfix">

                                                            <div class="input-group m-b-5">
                                                                <span class="input-group-btn">
                                                        <button type="button" class="b-search waves-effect waves-light btn-success"><i class="fa fa-search"></i></button>
                                                        </span>
                                                                <input type="text" ng-model="test" id="example-input1-group2" name="example-input1-group2" class="form-control ng-pristine ng-untouched ng-valid" placeholder="Search">
                                                            </div>
                                                        </article>
                                                    </figure>


                                                     
                                                    <div class="nicescroll mx-h-400" style="overflow: hidden;" tabindex="5004">
                                                        <div class="clearfix">
                                                            
                                                           <?php if(isset($specialityList) && !empty($specialityList)){
                                                                    foreach ($specialityList as $key=>$val){
                                                            ?>
                                                            <aside class="clearfix  border-t">
                                                                <article class="col-md-4">
                                                                    <h6><?php echo $val->specialities_name; ?></h6>
                                                                </article>
                                                                 <article class="col-md-4">
                                                                    <h6><?php echo $val->specialities_drName; ?></h6>
                                                                </article>

                                                                <article class="col-md-4 text-right">
                                                                    <h6>
<!--                                                                        <button class="btn btn-success waves-effect waves-light m-b-5" type="button">Edit</button>-->
<a class="btn btn-success waves-effect waves-light m-b-5" href="<?php echo site_url('master/editSpecialities/'.$val->specialities_id);?>">Edit</a>
                                                                        <button class="btn btn-danger waves-effect waves-light m-b-5" onclick="deleteFn(<?php echo $val->specialities_id; ?>)" type="button">Delete</button>
                                                                    </h6>
                                                                </article>
                                                               <article class="col-md-8">
                                                                    <p><?php echo $val->keyword; ?></p>
                                                                </article>
                                                                
                                                                <article> 
                                                                <img height="80px;" width="80px;" src="<?php echo base_url('assets/specialityImages/3x/'.$val->specialities_img); ?>" class="img-responsive">
                                                                </article>
<!--                                                                <article class="clearfix">

                                                                    <p class="col-md-12">" Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book "</p>
                                                                </article>-->
                                                            </aside>
                                                           <?php } } ?>



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
                                <h3>Add Specialities</h3>
                                </figure>
                               

                                   
                                    <!-- Add Specialities -->

                                   
                                        <div class="col-sm-12">
                                            <form  class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" name="addSpecialityForm" method="post" action="#" novalidate="novalidate" enctype="multipart/form-data">
                                               
                                                <article class="clearfix m-t-10">
                                                    <label for="" class="control-label">Speciality :</label>
                                                    <div class="">
                                                        <input class="form-control m-t-5" id="specialityName" type="text" name="specialityName" required="" value="<?php echo set_value('specialityName'); ?>">
                                                        
                                                        <label class="error" id="err_specialityName" > <?php echo form_error("specialityName"); ?></label>
                                                    </div>
                                                </article>
                                                
                                                <article class="clearfix m-t-10">
                                                    <label for="" class="control-label">Speciality name for doctor :</label>
                                                    <div class="">
                                                        <input class="form-control m-t-5" id="specialityNamedoctor" type="text" name="specialityNamedoctor" required="" value="<?php echo set_value('specialityNamedoctor'); ?>">
                                                        
                                                        <label class="error" id="err_specialityNamedoctor" > <?php echo form_error("specialityName"); ?></label>
                                                    </div>
                                                </article>
                                                
                                    <article class="form-group m-lr-0 ">
                                        <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                                        <div class="col-md-8 col-sm-8 text-right avatar-view">
                                            <label for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x "></i></label>
                                            <img src="<?php echo base_url('assets/default-images/Doctor-logo.png'); ?>" width="70" height="65" class="image-preview-show"/>
                                        </div>
                                        <label class="error" > <?php echo form_error("avatar_file"); ?></label>
                                        <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                                    </article>
                                                

                                                <article class="clearfix m-t-10">
                                                    <label for="" class="control-label">Keywords/Tags:</label>
                                                    <div class="">
                                                        <textarea class="form-control m-t-5" id="keywords" type="text" name="keywords" required=""><?php echo set_value('keywords'); ?></textarea>
                                                        <label class="error" id="err_keywords" > <?php echo form_error("keywords"); ?></label>
                                                    </div>
                                                </article>
                                                <article class="clearfix m-t-10 m-b-20">

                                                    <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Submit</button>

                                                </article>
                                                
                                                <div id="upload_modal_form">
                            <?php $this->load->view('upload_crop_modal');?>
                        </div>
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
            
        </div>
        <!-- End Right content here -->
  

<script>   setTimeout(function () {
                        $("#successmsg").hide();
                         $("#errormsg").hide();
                    }, 3000);
                                        </script>