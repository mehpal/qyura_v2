<!-- Cropping modal -->
<div class="modal fade pre avatar-modal" id="blood-avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <!--                              <form class="avatar-form" action="#" enctype="multipart/form-data" method="post">-->
            <div class="modal-body">
                <div class="avatar-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- Upload image and data -->
                    <div class="avatar-upload">
                        <input type="hidden" class="avatar-src" name="avatar_src_bloodbank">
                        <input type="hidden" class="avatar-data" name="avatar_data_bloodbank">
                        <label for="avatarInput">File upload</label>
                        <input type="file" class="avatar-input" id="avatarInput" name="bloodBank_photo">
                    </div>
                
                    <!-- Crop and preview -->
                    <div class="row">
                        <div class="col-md-9">
                            <div class="avatar-wrapper"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="avatar-preview preview-lg"></div>
                            <div class="avatar-preview preview-md"></div>
                            <div class="avatar-preview preview-sm"></div>
                        </div>
                    </div>

                    <div class="row avatar-btns">
                      
                        <div class="col-md-6 col-md-offset-9">
                            <button class="btn btn-danger" data-dismiss="modal" type="button">Close</button>
                            <button type="button" class="btn btn-primary avatar-save" id="savebtnUpload" data-dismiss="modal">Done</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
            <!--                              </form>-->
        </div>
    </div>
</div><!-- /.modal -->