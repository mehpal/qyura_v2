<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="clearfix">
                <div class="col-md-12">
                    <h3 class="pull-left page-title">Diagnostics</h3>
                </div>
            </div>
            <?php $sMsg = $this->session->flashdata('message');
            $eMsg = $this->session->flashdata('error');
            if (!empty($sMsg)) { ?>
                <div class="alert alert-success" id="successmsg" ><?php echo $this->session->flashdata('message'); ?></div>
            <?php } ?>
            <?php if (!empty($eMsg)) { ?>
                <div class="alert alert-danger" id="errormsg"><?php echo $this->session->flashdata('error'); ?></div>
            <?php } ?>
            <!-- Left Section Start -->
            <section class="col-md-7 detailbox m-b-20">
                <aside class="bg-white">
                    <figure class="clearfix">
                        <h3>Diagnostics Available</h3>
                        <article class="clearfix">
                            <div class="input-group m-b-5">
                               <span class="input-group-btn">
                                    <button type="button" class="b-search waves-effect waves-light btn-success"><i class="fa fa-search"></i></button>
                                </span>
                             <input type="text" placeholder="Search" class="form-control" id="search-text">
                            </div>
                        </article>
                    </figure>
                    <div class="nicescroll mx-h-400" style="overflow: hidden;" tabindex="5004">
                        <div class="clearfix">
                        <ul id="list" class="list-unstyled ul-bigspace">
                            <?php if (isset($diagnosticList) && !empty($diagnosticList)) {
                                foreach ($diagnosticList as $val) { ?>
                                    <li class="clearfix  border-t">
                                        <span class="col-md-4">
                                        
                                            <h6><?php echo strip_tags(substr($val->diagnosticsCat_catName, 0,20)); ?></h6>
                                        </span>
                                        <span class="col-md-4"> 
                                            <img height="80px;" width="80px;" src="<?php echo base_url('assets/diagnosticsCatImages/' . $val->diagnosticsCat_catImage); ?>" class="img-responsive" style="border-radius: 10%">
                                        </span>
                                        <span class="col-md-4">
                                            <h6 class="pull-right">
                                                <a class="btn btn-success waves-effect waves-light m-b-5 m-r-10" href="<?php echo site_url('master/editDiagnosticsView/' . $val->diagnosticsCat_catId); ?>"><i class="fa fa-pencil"></i></a>
                                                <button onclick="enableFn('master', 'diagSpecPublish', '<?php echo $val->diagnosticsCat_catId; ?>','<?php echo $val->status; ?>')" title='<?php if($val->status == 2){ echo "Publish"; }else{ echo "Unpublish"; } ?> Diagnostic' type="button" class="btn btn-success waves-effect waves-light m-b-5"><i class="fa fa-thumbs-<?php if($val->status == 3){ echo "up"; }else{ echo "down danger"; } ?>"></i></button>
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
                            <h3>Add Diagnostic</h3>
                        </figure>
                        <!-- Add Specialities -->
                        <div class="col-sm-12">
                            <form  class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" name="addDiagnosticForm" method="post" action="#" novalidate="novalidate" enctype="multipart/form-data">
                                <article class="clearfix m-t-10">
                                    <label for="" class="control-label">Diagnostic :</label>
                                    <div class="">
                                        <input class="form-control m-t-5" id="diagnosticName" type="text" name="diagnosticName" required="" value="<?php echo set_value('diagnosticName'); ?>">
                                        <label class="error" id="err_diagnosticName" > <?php echo form_error("diagnosticName"); ?></label>
                                    </div>
                                </article>
                                <article class="form-group m-lr-0 ">
                                    <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
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
                                    <?php $this->load->view('upload_crop_modal'); ?>
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
<script> 
    setTimeout(function () {
        $("#successmsg").hide();
        $("#errormsg").hide();
    }, 3000);
</script>
