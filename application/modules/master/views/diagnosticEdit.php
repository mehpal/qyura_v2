<div class="content-page"> 
    <div class="content">
	<div class="clearfix">
            <div class="col-md-12 m-t-10">
                <h3 class="pull-left page-title m-l-10">Edit Diagnostic</h3>
                <a href="<?php echo site_url() ?>/master/diagnostic/" class="btn btn-appointment btn-back waves-effect waves-light pull-right m-r-10"><i class="fa fa-angle-left"></i> Back</a>
            </div>
        </div>
        <div class="container row " style="width: 500px; margin: 0 auto ; background:whitesmoke;">
            <form  class="cmxform form-horizontal tasi-form avatar-form"  name="editDiagnosticForm" method="post"  action="<?php echo site_url(); ?>/master/editDiagnostic" novalidate="novalidate" enctype="multipart/form-data" id="submitForm">
                <?php if (isset($diagnosticEdit) && !empty($diagnosticEdit)) { ?>
                        <input type="hidden" name="diagnosticsCat_catId" value="<?php echo $diagnosticEdit->diagnosticsCat_catId; ?>" />
                        <article class="clearfix m-t-10">
                            <label for="" class="control-label">Speciality :</label>
                            <div class="">
                                <input class="form-control m-t-5" id="diagnosticsCat_catName" type="text" name="diagnosticsCat_catName" required="" value="<?php echo $diagnosticEdit->diagnosticsCat_catName; ?>" onkeypress="return isAlpha(event,this.value)">
                                <label class="error" id="err_diagnosticsCat_catName" > <?php echo form_error("diagnosticsCat_catName"); ?></label>
                            </div>
                        </article>
                        <article class="form-group m-lr-0 " id="crop-avatar">
                            <div id="upload_modal_form">
                                <?php $this->load->view('upload_crop_modal');?>
                            </div>
                            <label class="control-label col-md-4 col-sm-4" for="cemail"><img height="80px;" width="80px;" src="<?php echo base_url('assets/diagnosticsCatImages/' . $diagnosticEdit->diagnosticsCat_catImage); ?>" class="img-responsive"></a>
                            </label>
                            <div class="col-md-8 col-sm-8 text-right avatar-view">
                                <label class="col-md-4 col-sm-4" for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x avatar-view"></i></label>
                                <div class="pre col-md-4 col-sm-4 ">
                                    <div id="preImgLogo" class="avatar-preview preview-md preImgLogo">
                                        <img src="<?php echo base_url() ?>assets/default-images/Dignostics-logo.png"  class="image-preview-show"/>
                                    </div>
                                </div>
                                
                                <label class="error" > <?php echo form_error("avatar_file"); ?></label>
                                <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                            </div>
                        </article>
                        <article class="clearfix m-t-10 m-b-20">
                            <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Update</button>
                        </article>
                    <?php } ?>
                </form>
            </div>
        </div>
