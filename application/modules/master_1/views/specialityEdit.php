  <div class="content-page"> 
<div class="content">
                <div class="container row" style="width: 500px; margin: 0 auto; background:whitesmoke;">
                      
                                            <form  class="cmxform form-horizontal tasi-form avatar-form"  name="editSpecialityForm" method="post"  action="<?php echo site_url(); ?>/master/saveEditspeciality" novalidate="novalidate" enctype="multipart/form-data">
                                                <?php if(isset($specialityList) && !empty($specialityList)){
                                                                    foreach ($specialityList as $key=>$val){
                                                            ?>
                                                  <input type="hidden" name="specialityId" value="<?php echo $val->specialities_id; ?>" />
                                                <article class="clearfix m-t-10">
                                                    <label for="" class="control-label">Speciality :</label>
                                                    <div class="">
                                                        <input class="form-control m-t-5" id="specialityName" type="text" name="specialityName" required="" value="<?php echo $val->specialities_name;?>">
                                                        
                                                        <label class="error" id="err_specialityName" > <?php echo form_error("specialityName"); ?></label>
                                                    </div>
                                                </article>
                                                
                                                <article class="clearfix m-t-10">
                                                    <label for="" class="control-label">Speciality name for doctor :</label>
                                                    <div class="">
                                                        <input class="form-control m-t-5" id="specialityNamedoctor" type="text" name="specialityNamedoctor" required="" value="<?php echo $val->specialities_drName;?>">
                                                        
                                                        <label class="error" id="err_specialityNamedoctor" > <?php echo form_error("specialityNamedoctor"); ?></label>
                                                    </div>
                                                </article>
<!--                                   <div id="image_preview"> <img id="previewing" src="<?php echo base_url().'assets/specialityImages/3x/'.$val->specialities_img; ?>" class="img-responsive center-block" /></div>
                         

                                            <article class="form-group m-lr-0 ">
                                                <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Image :</label>
                                                <div class="col-md-8 col-sm-8 text-right">
                                                    <input disabled="disabled" class="showUpload" id="uploadFileDd" >
                                                    <div class="fileUpload btn btn-sm btn-upload">
                                                        <span><i class="fa fa-cloud-upload fa-3x"></i></span>
                                                        <input type="file" name="file" class="upload" id="uploadBtnDd">
                                                    </div>
                                                </div>
                                            </article>                -->
                               

                                                <article class="clearfix m-t-10">
                                                    <label for="" class="control-label">Keywords/Tags:</label>
                                                    <div class="">
                                                        <textarea class="form-control m-t-5" id="keywords" type="text" name="keywords" required=""><?php echo $val->keyword;?></textarea>
                                                        <label class="error" id="err_keywords" > <?php echo form_error("keywords"); ?></label>
                                                    </div>
                                                </article>
                                                <article class="clearfix m-t-10 m-b-20">

                                                    <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Submit</button>

                                                </article>
                                                
                                                <div id="upload_modal_form">
                           <?php echo $this->load->view('edit_upload_crop_modal');?>
                        </div>
                                                   <?php } } ?>
                                            </form>
                                        </div>
     </div>