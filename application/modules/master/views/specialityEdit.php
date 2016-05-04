<div class="content-page"> 
    <div class="content">
	<div class="clearfix">
            <div class="col-md-12 m-t-10">
                <h3 class="pull-left page-title m-l-10">Edit MI Speciality</h3>
                <a href="<?php echo site_url() ?>/master/specialities/" class="btn btn-appointment btn-back waves-effect waves-light pull-right m-r-10"><i class="fa fa-angle-left"></i> Back</a>
            </div>
        </div>
        <div class="container row " style="width: 500px; margin: 0 auto ; background:whitesmoke;">
            <form  class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" name="editSpecialityForm" method="post"  action="<?php echo site_url(); ?>/master/editspeciality" novalidate="novalidate" enctype="multipart/form-data" id="submitForm">
                <?php if (isset($specialityList) && !empty($specialityList)) {
                    foreach ($specialityList as $key => $val) { ?>
                        <input type="hidden" name="specialityId" value="<?php echo $val->specialities_id; ?>" />
                        <article class="clearfix m-t-10">
                            <label for="" class="control-label">Scientific Name :</label>
                            <div class="">
                                <input class="form-control m-t-5" id="specialityName" type="text" name="specialityName" required="" value="<?php echo $val->specialities_name; ?>">
                                <label class="error" id="err_specialityName" > <?php echo form_error("specialityName"); ?></label>
                            </div>
                        </article>
                        <article class="clearfix m-t-10">
                            <label for="" class="control-label">General Name :</label>
                            <div class="">
                                <input class="form-control m-t-5" id="specialityNamedoctor" type="text" name="specialityNamedoctor" required="" value="<?php echo $val->specialities_drName; ?>">

                                <label class="error" id="err_specialityNamedoctor" > <?php echo form_error("specialityNamedoctor"); ?></label>
                            </div>
                        </article>
                        <article class="clearfix m-t-10">
                            <label for="" class="control-label">Keywords/Tags:</label>
                            <div class="">
                                <textarea class="form-control m-t-5" id="keywords" type="text" name="keywords" ><?php echo $val->speciality_tag; ?></textarea>
                                <label class="error" id="err_keywords" > <?php echo form_error("keywords"); ?></label>
                            </div>
                        </article>
                        <article class="form-group m-lr-0" id="crop-avatar">
                            <div id="upload_modal_form">
                                <?php $this->load->view('upload_crop_modal');?>
                            </div>
                            <label class="control-label col-md-4 col-sm-4" for="cemail">
                            <?php if(!empty($val->specialities_img)){  ?><a href="<?php echo base_url('assets/specialityImages/3x/' . $val->specialities_img); ?>" target="_blank"><img height="80px;" width="80px;" src="<?php echo base_url()?>assets/specialityImages/3x/<?php echo $val->specialities_img; ?>" class="img-responsive"><?php } else { ?>
                                <img src="<?php echo base_url()?>assets/default-images/Dignostics-logo.png" alt="" class="logo-img" />
                            <?php } ?></a>
                            </label>
                            <div class="col-md-8 col-sm-8 text-right avatar-view">
                                <label class="col-md-4 col-sm-4" for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x avatar-view"></i></label>
                                <div class="pre col-md-4 col-sm-4 ">
                                    <div id="preImgLogo" class="avatar-preview preview-md preImgLogo">
                                        <img src="<?php echo base_url() ?>assets/default-images/Dignostics-logo.png"  class="image-preview-show"/>
                                    </div>
                                </div>
                            </div>
                            <label class="error" > <?php echo form_error("avatar_file"); ?></label>
                            <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                        </article>
                        <article class="clearfix m-t-10 m-b-20">
                            <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Submit</button>
                        </article>
                    <?php } } ?>
                    
                </form>
            </div>
        </div>
