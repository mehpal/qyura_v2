<div  id="amenityGallary" tabindex="-1" role="dialog" aria-labelledby="Edit-Amenity" class="modal fade bs-modal-lg" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form role="form" id="Gallaryamenity" method="post" action="#" enctype="multipart/form-data" >
                <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                    <h4 class="modal-title"><?php echo $this->lang->line('amenityGallaryTitle');?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" name="<?php echo $this->lang->line("amenityId");?>" id="<?php echo $this->lang->line("amenityId");?>" value="<?php echo $amenityId ?>" />
                                    <input id="amenityImage" name="amenityImageUrl" type="file" multiple=true class="file-loading">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                                     
                </div>
                <div class="modal-footer">
                    
                </div>
            </form>
        </div>  <!-- /.modal-content -->
    </div>  <!-- /.modal-dialog -->
</div>
<?php 
$images = $imageProperty = "";
    if(isset($amenity) && $amenity != NULL){
        $count = 1;
        foreach($amenity as $am){
            $img = str_replace(" ","",$am->amenityImageUrl);
            $img_name = end(explode("/",$am->amenityImageUrl));
            
            $images .= " \"<img src='".$img."' class='file-preview-image' width='200px'   />\",";
            $imageProperty .= "{caption: '".$img_name."', width: '120px', url: '".site_url()."/amenity/deleteImg/".$am->amenityAttribute."', key: ".$count."},";
            $count ++;
        }
    }
?>

<!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">-->
<link href="<?php echo base_url();?>assets/global/plugins/imageGallary/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/global/plugins/imageGallary/js/fileinput.js" type="text/javascript"></script>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script>-->
<script>
	 var image = '';
	$("#amenityImage,  .fileinput-upload-button").fileinput({
	    
	    uploadUrl: "<?php echo site_url();?>/amenity/gallary/<?php echo $amenityId?>", // server upload action
	    uploadAsync: true,
	    minFileCount: 1,
	    maxFileCount: 5,
	    overwriteInitial: false,
	    
	    initialPreview: [
	       <?php echo $images; ?>
	    ],
	    initialPreviewConfig: [
	       <?php  echo $imageProperty; ?>
	    ],
	    uploadExtraData: {
		img_key: "1000",
		img_keywords: "happy, nature",
	    }
	    
	});

    $('#amenityImage,  .fileinput-upload-button').on('fileuploaded', function() {
	location.reload();
    });
</script>
