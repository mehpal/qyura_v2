<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="clearfix">
                <div class="col-md-12 text-success">
                    <?php echo $this->session->flashdata('message'); ?>
                </div>
                <div class="col-md-12">
                    <h3 class="pull-left page-title">Setting</h3>
                </div>
            </div>
            <div class="map_canvas"></div>
            <form class="cmxform form-horizontal tasi-form"  method="post" action="<?php echo site_url(); ?>/setting/config/" novalidate="novalidate" enctype="multipart/form-data" >
                <input type="hidden" id="StateId" name="StateId" value="" />
                <!-- Left Section Start -->
                    <div class="bg-white mi-form-section">
                        <button type="button" class="btn btn-primary btn-lg" data-target="#modal" data-toggle="modal">
                            Launch demo modal
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="modal" aria-labelledby="modalLabel" role="dialog" tabindex="-1">
                            <div class="modal-dialog modal-lg" role="document" >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="avatar-upload"></div>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="modalLabel">Crop the image</h4>
                                        <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                                            <input type="hidden" class="avatar-data" name="avatar_data">
                                            <input type="file" class="sr-only" id="inputImage" name="avatar_file" accept="image/*">
                                            <span class="docs-tooltip" data-toggle="tooltip" title="Import image with Blob URLs">
                                                <span class="fa fa-upload"></span>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <img id="image" src="<?php echo base_url('assets'); ?>" alt="Picture">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- .form -->
                <!-- Left Section End -->
                <section class="clearfix ">
                    <div class="col-md-12 m-t-20 m-b-20">
                        <button class="btn btn-danger waves-effect pull-right" type="button">Reset</button>
                        <div>
                            <input class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit"  value="Submit" />
                        </div>
                    </div>
                </section>
            </form>
            <!-- consultation -->
        </div>
        <!-- container -->
    </div>
    <!-- content -->