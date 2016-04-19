<link href="<?php echo base_url();?>inspinia/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

<!-- Data picker -->
<script src="<?php echo base_url(); ?>inspinia/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<!--<script src="<?php echo base_url(); ?>js/moment.js" type='text/javascript' ></script>-->
<!--<script src="<?php echo base_url(); ?>js/daterangepicker.js" type="text/javascript" charset="utf-8"></script>-->

<link href="<?php echo base_url();?>inspinia/css/plugins/cropper/cropper.min.css" rel="stylesheet">
<script src="<?php echo base_url();?>inspinia/js/plugins/cropper/cropper.min.js"></script>
<script src="<?php echo base_url();?>inspinia/js/plugins/staps/jquery.steps.min.js"></script>
  
<script src="<?php echo base_url();?>inspinia/js/plugins/validate/jquery.validate.min.js"></script>

<!-- chosen-->
<link href="<?php echo base_url();?>inspinia/css/plugins/chosen/chosen.css" rel="stylesheet">
<script src="<?php echo base_url();?>inspinia/js/plugins/chosen/chosen.jquery.js"></script>

<style>
.datepicker{z-index:115100 !important;}

select.bs-select {
  display: block !important;
  float: left;
  overflow: hidden; 
  height: 1px;
  width: 0;
  border: 0; 
  padding: 0; 
  box-shadow: none; 
  color: white; 
}

select.bs-select:required:focus {
    width: auto;
}

</style>

<script type="text/javascript">

/*
    var cropBtns = function(){
        
        var imgSrc = '';
        
        $(".file-box" ).click(function(){
            
            imgSrc = $(this).find("img").attr("src");
            
            $("#uploadSection").addClass("hidden");
            $(".cropper-container").css("top","0px");
            $(".image-crop > img").attr("src",imgSrc);
            $('.img-preview').html('<img class=" img-responsive" src="'+imgSrc+'" >');
            $('.img-preview, .image-crop > img').addClass("iconImage"); 
            $(".otherOptions").hide();
            $(".image-crop > img").attr("val","1");
            $("#imghas-error").hide();
            
            var $image = $("#form-p-1 .image-crop > img");
            
            $($image).cropper({
                aspectRatio: 1.618,
                preview: "#imagePreview, .img-preview",
                done: function(data) {
                    // Output the result data for cropping image.
                    //alert(data);
                    $(".img-preview").cropper("replace", data);
                    $("#uploadSection").addClass("hidden");
                    $(".cropper-container").css("top","0px");
                }
            });
            
            $("#modalIcon").hide();
        });
        
        var $image = $("#form-p-1 .image-crop > img");

        $($image).cropper({
            aspectRatio: 1.618,
            preview: "#imagePreview, .img-preview",
            done: function(data) {
                // Output the result data for cropping image.
                //alert(data);
                $(".img-preview").cropper("replace", data);
                $("#uploadSection").addClass("hidden");
                $(".cropper-container").css("top","0px");
            }
            
        });
        
        var $inputImage = $("#form-p-1 #inputImage");
        if (window.FileReader) {
            $inputImage.change(function() {
                var fileReader = new FileReader(),
                        files = this.files,
                        file;

                if (!files.length) {
                    return;
                }

                file = files[0];

                if (/^image\/\w+$/.test(file.type)) {
                    fileReader.readAsDataURL(file);
                    fileReader.onload = function () {
                        $inputImage.val("");
                        $image.cropper("reset", true).cropper("replace", this.result);
                        //$("#imagePreview").cropper("reset", true).cropper("replace", data);
                        alert($image.cropper("getDataURL"));
                        $('.img-preview').html('<img class=" img-responsive" src="'+$image.cropper("getDataURL")+'" >');
                        
                    };
                } else {
                    showMessage("Please choose an image file.");
                }
            });
        } else {
            $inputImage.addClass("hide");
        }
        
        $("#download").click(function() {
            //window.open($image.cropper("getDataURL"));
            $('.img-preview').html('<img class="img-responsive" src="'+$image.cropper("getDataURL")+'" >');
        });

        $("#zoomIn").click(function() {
            $image.cropper("zoom", 0.1);
        });

        $("#zoomOut").click(function() {
            $image.cropper("zoom", -0.1);
        });

        $("#rotateLeft").click(function() {
            $image.cropper("rotate", 45);
        });

        $("#rotateRight").click(function() {
            $image.cropper("rotate", -45);
        });

        $("#setDrag").click(function() {
           
        });
    }; */
   
    var cropBtns = function(){
        
//        var imgSrc = '';
        
//        $(".file-box" ).click(function(){
            
//            imgSrc = $(this).find("img").attr("src");
            
//            $("#uploadSection").addClass("hidden");
//            $(".cropper-container").css("top","0px");
//            $(".image-crop > img").attr("src",imgSrc);
//            $('.img-preview').html('<img class=" img-responsive" src="'+imgSrc+'" >');
//            $('.img-preview, .image-crop > img').addClass("iconImage"); 
//            $(".otherOptions").hide();

//            $("#modalIcon").hide();
//        });
        
        var $image = $("#form-p-1 .image-crop > img");

        $($image).cropper({
            aspectRatio: 1.618,
            preview: "#imagePreview, .img-preview",
            done: function(data) {
                // Output the result data for cropping image.
                //alert(data);
                $(".img-preview").cropper("replace", data);
                $($image).attr("value","1");
                $("#uploadSection").addClass("hidden");
                $(".cropper-container").css("top","0px");
            }
            
        });
        
        var $inputImage = $("#form-p-1 #inputImage");
        
        if (window.FileReader) {
            $inputImage.change(function() {
                var fileReader = new FileReader(),
                        files = this.files,
                        file;

                if (!files.length) {
                    return;
                }

                file = files[0];

                if (/^image\/\w+$/.test(file.type)) {
                    
                    fileReader.readAsDataURL(file);
                    fileReader.onload = function () {
                        
                        $inputImage.val("");
                        
                        $image.cropper("reset", true).cropper("replace", this.result);
                        //$("#imagePreview").cropper("reset", true).cropper("replace", data);
                        $('.img-preview').html('<img class=" img-responsive" src="'+$image.cropper("getDataURL")+'" >');
                        
                    };
                } else {
                    showMessage("Please choose an image file.");
                }
            });
        } else {
            $inputImage.addClass("hide");
        }
        
        $("#download").click(function() {
            //window.open($image.cropper("getDataURL"));
            $('.img-preview').html('<img class="img-responsive" src="'+$image.cropper("getDataURL")+'" >');
        });

        $("#zoomIn").click(function() {
            $image.cropper("zoom", 0.1);
        });

        $("#zoomOut").click(function() {
            $image.cropper("zoom", -0.1);
        });

        $("#rotateLeft").click(function() {
            $image.cropper("rotate", 45);
        });

        $("#rotateRight").click(function() {
            $image.cropper("rotate", -45);
        });

        $("#setDrag").click(function() {
           
        });
    };
    
   
    var noticeCat = function(){
        $(".noticeCategory").click(function(){
            
            var category  = $(this).attr("id");
            $("#<?php echo $this->lang->line('noticeCategory');?>_pre").removeClass("label-warning");
            $("#<?php echo $this->lang->line('noticeCategory');?>_pre").removeClass("label-primary");
            $("#<?php echo $this->lang->line('noticeCategory');?>_pre").removeClass("label-danger");
            
            switch (category){
                
                case "NB":
                    $("#<?php echo $this->lang->line('noticeCategory');?>").val("1");
                    $("#<?php echo $this->lang->line('noticeCategory');?>").attr("display-value","Notice Board");
                    $("#<?php echo $this->lang->line('noticeCategory');?>").attr("bg-color","primary");
                    $("#"+category+' .btn').removeClass('btn-outline');
                    $("#GIN .btn").addClass('btn-outline');
                    $("#CL .btn").addClass('btn-outline');
                    break;
                case "GIN":
                    $("#<?php echo $this->lang->line('noticeCategory');?>").val("2");
                    $("#<?php echo $this->lang->line('noticeCategory');?>").attr("display-value","Generic Infraction Notice");
                    $("#<?php echo $this->lang->line('noticeCategory');?>").attr("bg-color","warning");
                    $("#"+category+' .btn').removeClass('btn-outline');
                    $("#NB .btn").addClass('btn-outline');
                    $("#CL .btn").addClass('btn-outline');
                    break;
                case 'CL':
                    $("#<?php echo $this->lang->line('noticeCategory');?>").val("0");
                    $("#<?php echo $this->lang->line('noticeCategory');?>").attr("display-value","Cancle Notice");
                    $("#<?php echo $this->lang->line('noticeCategory');?>").attr("bg-color","danger");
                    $("#"+category+' .btn').removeClass('btn-outline');
                    $("#GIN .btn").addClass('btn-outline');
                    $("#NB .btn").addClass('btn-outline');
                    $('#modalAdd').trigger('click');
                    break;
            }
        });
    }; 
    
    function toggleRadio(obj){
        var check = $('#'+obj.id).val();
        if(check == '1')
        {
            $('#div_<?php echo $this->lang->line("insideAddI");?>').show(400);
            $('#div_<?php echo $this->lang->line("outsideAddI");?>').hide(400);
            $('#div_<?php echo $this->lang->line('insideUserAddI');?>').hide(400);
            $('#<?php echo $this->lang->line('groupsAddI');?>').attr('required',"");
            $('#<?php echo $this->lang->line('emailAddI');?>').removeAttr('required');
            $('#<?php echo $this->lang->line('insideUserAddI');?>').removeAttr('required');
        }
        else if(check == '0')
        {
            $('#<?php echo $this->lang->line('groupsAddI');?>').removeAttr('required');
            $('#<?php echo $this->lang->line('insideUserAddI');?>').removeAttr('required');
            $('#<?php echo $this->lang->line('emailAddI');?>').attr('required',"");
            $('#div_<?php echo $this->lang->line("outsideAddI");?>').show(400);
            $('#div_<?php echo $this->lang->line("insideAddI");?>').hide(400);
            $('#div_<?php echo $this->lang->line('insideUserAddI');?>').hide(400);
        }
        else if(check == '4')
        {
            $('#<?php echo $this->lang->line('insideUserAddI');?>').removeAttr('required');
            $('#<?php echo $this->lang->line('insideUserAddI');?>').removeAttr('required');
            $('#<?php echo $this->lang->line('emailAddI');?>').removeAttr('required');
            $('#div_<?php echo $this->lang->line("outsideAddI");?>').hide(400);
            $('#div_<?php echo $this->lang->line("insideAddI");?>').hide(400);
            $('#div_<?php echo $this->lang->line('insideUserAddI');?>').hide(400);
        }else
        {
            $('#<?php echo $this->lang->line('insideUserAddI');?>').attr('required',"");
            $('#<?php echo $this->lang->line('insideUserAddI');?>').removeAttr('required');
            $('#<?php echo $this->lang->line('emailAddI');?>').removeAttr('required');
            $('#div_<?php echo $this->lang->line("outsideAddI");?>').hide(400);
            $('#div_<?php echo $this->lang->line("insideAddI");?>').hide(400);
            $('#div_<?php echo $this->lang->line('insideUserAddI');?>').show(400);
        }
    }
    
    var counterDown = function(){
        
        $(".alert-danger").hide();
        
        $("#<?php echo $this->lang->line("messageAddN")?>").on("keyup",function(){
            
            var maxLength = "500";
            
            var length = $(this).val().length;
         
            length = maxLength-length;
            
            $('#chars').text(length);
        });
    };
    
    var iconCapture = function(){
        $("#icon-picker").click(function(){
            $("#modalIcon").modal("show");
        });
    }
    
    function datafill(){
    
        $("#<?php echo $this->lang->line("noticeCategory")?>_pre").text($("#<?php echo $this->lang->line("noticeCategory")?>").attr("display-value"));
        
        $("#<?php echo $this->lang->line("noticeCategory")?>_pre").addClass("label-"+$("#<?php echo $this->lang->line("noticeCategory")?>").attr("bg-color"));
       
        $("#<?php echo $this->lang->line("subjectAddN")?>_pre").text($("#<?php echo $this->lang->line("subjectAddN")?>").val());
        
        $("#<?php echo $this->lang->line("messageAddN")?>_pre").text($("#<?php echo $this->lang->line("messageAddN")?>").val());
    
        $("#<?php echo $this->lang->line("noticeStartAddN")?>_pre").text($("#<?php echo $this->lang->line("noticeStartAddN")?>").val());
        
        $("#<?php echo $this->lang->line("noticeEndAddN")?>_pre").text($("#<?php echo $this->lang->line("noticeEndAddN")?>").val());
        
        if($("input[name=<?php echo $this->lang->line("userBelongstoAddN");?>]:checked").val() == 1){
          
            $("#<?php echo $this->lang->line("userBelongstoAddI")?>_pre").text(" Group : " + $("#<?php echo $this->lang->line("groupsAddI");?>  option:selected").text());
           
        }else if($("input[name=<?php echo $this->lang->line("userBelongstoAddN");?>]:checked").val() == 0){
           
            $("#<?php echo $this->lang->line("userBelongstoAddI")?>_pre").text(" Outsider : " + $("#<?php echo $this->lang->line("emailAddI");?>").val());
             
        }else if($("input[name=<?php echo $this->lang->line("userBelongstoAddN");?>]:checked").val() == 2){

            $("#<?php echo $this->lang->line("userBelongstoAddI")?>_pre").text(" User: " + $(".selectpicker option:selected").text());
        }else if($("input[name=<?php echo $this->lang->line("userBelongstoAddN");?>]:checked").val() == 4){

            $("#<?php echo $this->lang->line("userBelongstoAddI")?>_pre").text(" Send To All ");
        }
        
    }
    
    var validation = function(){
    
        if($("input[name=<?php echo $this->lang->line("userBelongstoAddN");?>]:checked").val() == 1){
          
            $("#<?php echo $this->lang->line("userBelongstoAddI")?>_pre").text(" Group : " + $("#<?php echo $this->lang->line("groupsAddI");?>  option:selected").text());
           
        }else if($("input[name=<?php echo $this->lang->line("userBelongstoAddN");?>]:checked").val() == 0){
           
            $("#<?php echo $this->lang->line("userBelongstoAddI")?>_pre").text(" Outsider : " + $("#<?php echo $this->lang->line("emailAddI");?>").val());
             
        }else if($("input[name=<?php echo $this->lang->line("userBelongstoAddN");?>]:checked").val() == 2){

            $("#<?php echo $this->lang->line("userBelongstoAddI")?>_pre").text(" User: " + $(".selectpicker option:selected").text());
        }else if($("input[name=<?php echo $this->lang->line("userBelongstoAddN");?>]:checked").val() == 4){

            $("#<?php echo $this->lang->line("userBelongstoAddI")?>_pre").text(" Send To All ");
        }
    }
    
    
    
    $(document).ready(function(){
         
        $('.bs-select').selectpicker({
            iconBase: 'fa',
            tickIcon: 'fa-check'
        });
        
        $("#form").steps({
            
            onStepChanging: function (event, currentIndex, newIndex)
            {
                //var form = $(this);
                cropBtns();
                noticeCat();
                
                $("#cathas-error").hide();
                
                if (currentIndex > newIndex){
                    return true;
                }
                
                // For Preview created Notice..
                if (newIndex === 4 ){
                    datafill();
                }
                
                if(currentIndex === 0 ){
                    $("#imghas-error").hide();
                    // form.validate().settings.ignore = ":disabled,:hidden";
                   // return form.valid();
                }
                
                if(currentIndex === 1 ){

                    var imgSrc = $("#form-p-1 .image-crop > img").attr("value");
                    alert(imgSrc);
                    if( imgSrc == 0 ){
                        $("#imghas-error").show();
                        
                        $("#icon-picker").addClass("has-error");
                        $("#img-upload").addClass("has-error");
                        return false;
                    }
                    else{
                        $("#imghas-error").hide();
                        return true;
                    }
                }
                
                if(currentIndex === 2 ){
                    
                    var category = $("#<?php echo $this->lang->line("noticeCategory")?>").val();
                    
                    if( ! category ){
                        $("#cathas-error").show();
                        return false;
                    } else{
                        return true;
                    }
                }
                
                if(currentIndex === 3){
//                   selectDelete();

                }
                
               
                // Clean up if user went backward before
//                if (currentIndex < newIndex)
//                {
//                    // To remove error styles
//                    $(".body:eq(" + newIndex + ") label.error", form).remove();
//                    $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
//                }
               
                // Disable validation on fields that are disabled or hidden.
              //  

                // Start validation; Prevent going forward if false
                
                return true;
            },
            onStepChanged: function (event, currentIndex, priorIndex){
                
            },
            onCanceled: function (event) { 
                $('#modalAdd').modal('toggle');
            },
            onFinishing: function (event, currentIndex)
            {
               
//                    var form = $(this);
//
//                    // Disable validation on fields that are disabled.
//                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
//                    form.validate().settings.ignore = ":disabled";
//
//                    // Start validation; Prevent form submission if false
//                    return form.valid();
            },
            onFinished: function (event, currentIndex)
            {
                var form = $(this);

                // Submit form input
                form.submit();
            }
        });

        $('.wizard-big #data_5 .input-daterange').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });
        
        counterDown();
        iconCapture();
        $(".chosen-select").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "95%"
        });
    });
//    var config = {
//            '.chosen-select'           : {},
//            '.chosen-select-deselect'  : {allow_single_deselect:true},
//            '.chosen-select-no-single' : {disable_search_threshold:10},
//            '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
//            '.chosen-select-width'     : {width:"95%"}
//    }
//    
</script>
