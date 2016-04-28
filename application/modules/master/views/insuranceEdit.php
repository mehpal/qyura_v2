<div class="content-page"> 
    <div class="content">
        <div class="clearfix">
            <div class="col-md-12 m-t-10">
                <h3 class="pull-left page-title m-l-10">Edit Insurance</h3>
                <a href="<?php echo site_url() ?>/master/insurance/" class="btn btn-appointment btn-back waves-effect waves-light pull-right m-r-10"><i class="fa fa-angle-left"></i> Back</a>
            </div>
        </div>
        <div class="container row " style="width: 500px; margin: 0 auto ; background:whitesmoke;">
            <form  class="cmxform form-horizontal tasi-form avatar-form"  name="editSpecialityForm" method="post"  action="<?php echo site_url(); ?>/master/editInsurance" novalidate="novalidate" enctype="multipart/form-data" id="submitForm">
                <?php if (isset($insuranceEdit) && !empty($insuranceEdit)) { ?>
                        <input type="hidden" name="insurance_id" value="<?php echo $insuranceEdit->insurance_id; ?>" />
                        <article class="clearfix m-t-10">
                            <label for="" class="control-label">Company Name :</label>
                            <div class="">
                                <input class="form-control m-t-5" id="insurance_Name" type="text" name="insurance_Name" required="" value="<?php echo $insuranceEdit->insurance_Name; ?>">
                                <label class="error" id="err_insurance_Name" > <?php echo form_error("insurance_Name"); ?></label>
                            </div>
                        </article>
                        <article class="clearfix m-t-10">
                            <label for="" class="control-label">Insurance Detail</label>
                            <div class="">
                                <textarea class="form-control m-t-5" id="insurance_detail" type="text" name="insurance_detail" required="" ><?php echo $insuranceEdit->insurance_detail; ?></textarea>

                                <label class="error" id="err_insurance_detail" > <?php echo form_error("insurance_detail"); ?></label>
                            </div>
                        </article>
                        <article class="form-group m-lr-0 ">
                            <label class="control-label col-md-4 col-sm-4" for="cemail"><a href="<?php echo base_url('assets/insuranceImages/3x/' . $insuranceEdit->insurance_img); ?>" target="_blank"><img height="80px;" width="80px;" src="<?php echo base_url('assets/insuranceImages/3x/' . $insuranceEdit->insurance_img); ?>" class="img-responsive"></a>
                            </label>
                            <div class="col-md-8 col-sm-8 text-right avatar-view">
                                <label for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x "></i></label>
                                <img src="<?php echo base_url('assets/default-images/Dignostics-logo.png'); ?>" width="70" height="65" class="image-preview-show"/>
                            </div>
                            <label class="error" > <?php echo form_error("avatar_file"); ?></label>
                            <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                        </article>
                        <article class="clearfix m-t-10 m-b-20">
                            <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Submit</button>
                        </article>
                        <div id="upload_modal_form">
                            <?php echo $this->load->view('upload_crop_modal'); ?>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </div>