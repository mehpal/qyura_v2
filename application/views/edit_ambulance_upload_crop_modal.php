<!-- Cropping modal -->
<div class="modal fade" id="ambulance-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close cancelCrop" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                </div>
                <div class="modal-body">
                    <div class="avatar-body">

                        <!-- Upload image and data -->
                        <div class="avatar-upload">
                            <input type="hidden" class="avatar-src" name="avatar_src">
                            <input type="hidden" class="avatar-data" name="ambulance_data">
                            <input type="hidden" class="avatar_id" name="ambulance_id" value="<?php echo $id; ?>">
                            <label for="avatarInput">Avatar upload</label>
                            <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
                        </div>
<!--                        <div id="message_upload"></div>-->
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

                        
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row avatar-btns">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-danger cancelCrop" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary avatar-crop-btns avatar-save imgUploadBtn" id="avatar-save-btn">Update Avatar</button>
                            </div>
                        </div>
                  
                </div> 

        </div>
    </div>
</div><!-- /.modal -->