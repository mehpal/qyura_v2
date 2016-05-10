<!-- Cropping modal -->
<div class="modal fade" id="blood-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                </div>
                <div class="modal-body">
                    <div class="avatar-body">

                        <!-- Upload image and data -->
                        <div class="avatar-upload">
                            <input type="hidden" class="avatar-src" name="avatar_src">
                            <input type="hidden" class="avatar-data" name="bloodBank_data">
                            <input type="hidden" class="avatar_id" name="bloodBank_id" value="<?php echo $id; ?>">
                            <label for="avatarInput">Avatar upload</label>
                            <input type="file" class="avatar-input" id="avatarInput" name="avatar_file_bloodbank">
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
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary avatar-save imgUploadBtn" id="avatar-save-btn">Update Avatar</button>
                            </div>
                        </div>
                  
                </div> 
<<<<<<< HEAD
           <!-- </form>-->
=======
<!--            </form>-->
>>>>>>> 8189f1bd2b73a761d64848af2f7e3bb6ec21dd09
        </div>
    </div>
</div><!-- /.modal -->