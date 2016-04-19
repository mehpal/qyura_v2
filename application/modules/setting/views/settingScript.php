<link href="<?php echo base_url();?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url();?>assets/vendor/select2/select2.min.js" type="text/javascript"></script> 
 <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
 <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js" type="text/javascript"></script> 

<link href="<?php echo base_url(); ?>assets/cropper/cropper.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/cropper/main.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/cropper/cropper.js"></script>

<?php
$current = $this->router->fetch_method();
if ($current == 'setting'):
    ?>
    <script src="<?php echo base_url(); ?>assets/cropper/common_cropper.js"></script>
<?php else: ?>
    <script src="<?php echo base_url(); ?>assets/cropper/main.js"></script>
<?php endif; ?>
<script src="<?php echo base_url(); ?>assets/js/reCopy.js"></script>
    
<script> 

    var urls = "<?php echo base_url()?>";
    
    $(function () {
        var removeLink = '<a class="remove" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false"> <i class="fa fa-minus-circle fa-2x m-t-5 label-plus"></i></a>';
        $('a.add').relCopy({append: removeLink});

    });
 function fetchCity(stateId) {    
    
           $.ajax({
               url : urls + 'index.php/setting/fetchCity/',
               type: 'POST',
              data: {'stateId' : stateId},
              success:function(datas){
               // console.log(datas);
                  $('#setting_cityId').html(datas);
                  $('#setting_cityId').selectpicker('refresh');
                  $('#StateId').val(stateId);
              }
           });
           
        }
        
        $(function(){
             $(".select2").select2({
            width: '100%'
        });
        });
        
        function isNumberKey(evt, id) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        $("#" + id).html("Please enter number key");
        return false;
    } else {
        $("#" + id).html('');
        return true;
    }
}

$('#date-3').datepicker();

$('.pickDate').datepicker()
            .on('changeDate', function (ev) {
                $('.pickDate').datepicker('hide');
            });
            
    /**
     * @project Qyura
     * @description  geo location address
     * @access public
     */
      $(function(){
        $("#geocomplete").geocomplete({
          map: ".map_canvas",
          details: "form",
          types: ["geocode", "establishment"],
        });

        $("#find").click(function(){
          $("#geocomplete").trigger("geocode");
        });
      });
      
       $(document).ready(function() {

            	$("#submitForm").validate({
			rules: {
				user_name:{
                                    required: true
                                },
                                dob:{
                                    required: true
                                },
                                users_email:{
                                    required: true,
                                    email:true
                                },
                                users_mobile:{
                                    required: true,
                                    number:true,
                                    minlength:10,
                                    maxlength:12
                                },
                                setting_countryId:{
                                    required: true
                                },
                                setting_stateId:{
                                    required: true
                                },
                                setting_cityId:{
                                    required: true
                                },
                                zip:{
                                    required: true,
                                    number:true,
                                    minlength:6,
                                    maxlength:6
                                },
                                address:{
                                    required: true
                                },
//                                users_password:{
//                                    required: true
//                                },
                                cnfPassword:{
                                    equalTo:"#users_password"
                                }
			},
			messages: {
			
				user_name: {
					required: "Please enter full name",
				},
                                dob: {
					required: "Please enter date of birth",
				},
                                users_mobile: {
					required: "Please enter mobile number",
                                        number: "Please enter only number formate",
				},
                                 setting_countryId: {
					required: "Please select country",
				},
                                 setting_stateId: {
					required: "Please select state",
				},
                                 setting_cityId: {
					required: "Please select city",
				},
                                 zip: {
					required: "Please enter zip code",
                                         number: "Please enter only number formate",
				},
                                address: {
                                    required: "Please enter address"
                                },
//                                users_password: {
//                                    required: "Please enter password"
//                                },
//                                 cnfPassword: {
//                                    required: "Please enter confirm password"
//                                }
			}
		});
        
    });
    
    function showPassword(){
        $("#changePassword").slideToggle('slow');
    }
    //Image Functions
    $("#savebtn").click(function () {
        $("#avatar-modal").modal('hide');
    });
    $("#picEdit").click(function () {
        $(".logo-img").hide();
        $(".logo-up").show();
        $("#picEdit").hide();
        $("#picEditClose").show();

    });

    $("#picEditClose").click(function () {
        $(".logo-up").hide();
        $(".logo-img").show();
        $("#picEdit").show();
        $("#picEditClose").hide();


    });
    $("#uploadBtnDd").change(function () {

            $("#messageErrors").empty(); // To remove the previous error message
            var file = this.files[0];
            var imagefile = file.type;
            var match = ["image/jpeg", "image/png", "image/jpg"];
            if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
            {
                $('#previewing').attr('src', 'noimage.png');
                $("#messageErrors").html("<div class='alert alert-danger'><p id='error'>Please Select A valid Image File</p><span id='error_message'>Only jpeg, jpg and png Images type allowed</span></div>");
                return false;
            }
            else
            {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
        function imageIsLoaded(e) {
            $("#file").css("color", "green");
            $('#image_preview').css("display", "block");
            $('#previewing').attr('src', e.target.result);
            $('#previewing').attr('width', '500px');
            $('#previewing').attr('height', '230px');
        }
        
        function checkValidFileUploads(urls){
       
           var avatar_file = $(".avatar-data").val();
            $.ajax({
              url : urls + 'index.php/setting/checkFileUploadValidation',
              type: 'POST',
              data:{'avatar_file' : avatar_file},
             success:function(data){
                var obj = $.parseJSON(data);
                
                if(obj.state == 400){
                    $("#message_upload").html("<div class='alert alert-danger'>"+obj.message+"</div>");
                    $(".close").hide();
                }else{
                    $("#avatar-modal").modal('hide');
                     $("#message_upload").html("");
                }
             }
          });
   }
    
 </script>