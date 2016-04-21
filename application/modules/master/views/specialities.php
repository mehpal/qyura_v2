<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="clearfix">
                <div class="col-md-12">
                    <h3 class="pull-left page-title">MI Specialities</h3>
                    <div id="load_consulting" class="text-center text-success " style="display: none"><image alt="Please wait data is loading" src="<?php echo base_url('assets/images/loader/Heart_beat.gif'); ?>" /></div>
                </div>
            </div>
            <?php if (!empty($this->session->flashdata('message'))) { ?>
                <div class="alert alert-success" id="successmsg" ><?php echo $this->session->flashdata('message'); ?></div>
            <?php } ?>
            <?php if (!empty($this->session->flashdata('error'))) { ?>
                <div class="alert alert-danger" id="errormsg"><?php echo $this->session->flashdata('error'); ?></div>
            <?php } ?>
            <!-- Left Section Start -->
            <section class="col-md-7 detailbox m-b-20">
                <aside class="bg-white">
                    <figure class="clearfix">
                        <h3>Available MI Specialities</h3>
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
                            <?php if (isset($specialityList) && !empty($specialityList)) {
                                foreach ($specialityList as $key => $val) { ?>
                                    <li class="clearfix  border-t">
                                        <span class="col-md-4">
                                            <h6><?php echo $val->specialities_name; ?></h6>
                                        </span>
                                        <span class="col-md-4">
                                            <h6><?php echo $val->specialities_drName; ?></h6>
                                        </span>
                                        <span class="col-md-4 text-right">
                                            <h6>
                                                <a class="btn btn-success waves-effect waves-light m-b-5" href="<?php echo site_url('master/editSpecialitiesView/' . $val->specialities_id); ?>"><i class="fa fa-pencil"></i></a>
                                                <button onclick="enableFn('master', 'specialityPublish', '<?php echo $val->specialities_id; ?>','<?php echo $val->status; ?>')" title='<?php if($val->status == 2){ echo "Publish"; }else{ echo "Unpublish"; } ?> Speciality' type="button" class="btn btn-success waves-effect waves-light m-b-5"><i class="fa fa-thumbs-<?php if($val->status == 3){ echo "up"; }else{ echo "down danger"; } ?>"></i></button>
                                            </h6>
                                        </span>
                                        <span class="col-md-8">
                                            <p><?php echo $val->speciality_tag; ?></p>
                                        </span>
                                        <span> 
                                            <img height="80px;" width="80px;" src="<?php echo base_url('assets/specialityImages/3x/' . $val->specialities_img); ?>" class="img-responsive">
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
                            <h3>Add MI Specialities</h3>
                        </figure>
                        <!-- Add Specialities -->
                        <div class="col-sm-12">
                            <form  class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" name="addSpecialityForm" method="post" action="#" novalidate="novalidate" enctype="multipart/form-data">
				<input type="hidden" name="specialityType" value="0" />
                                <article class="clearfix m-t-10">
                                    <label for="" class="control-label">Scientific Name :</label>
                                    <div class="">
                                        <input class="form-control m-t-5" id="specialityName" type="text" name="specialityName" required="" value="<?php echo set_value('specialityName'); ?>">

                                        <label class="error" id="err_specialityName" > <?php echo form_error("specialityName"); ?></label>
                                    </div>
                                </article>
                                <article class="clearfix m-t-10">
                                    <label for="" class="control-label">General Name :</label>
                                    <div class="">
                                        <input class="form-control m-t-5" id="specialityNamedoctor" type="text" name="specialityNamedoctor" required="" value="<?php echo set_value('specialityNamedoctor'); ?>">

                                        <label class="error" id="err_specialityNamedoctor" > <?php echo form_error("specialityName"); ?></label>
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
                                <article class="clearfix m-t-10">
                                    <label for="" class="control-label">Keywords/Tags:</label>
                                    <div class="">
                                        <textarea class="form-control m-t-5" id="keywords" type="text" name="keywords" ><?php echo set_value('keywords'); ?></textarea>
                                        <label class="error" id="err_keywords" > <?php echo form_error("keywords"); ?></label>
                                    </div>
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
