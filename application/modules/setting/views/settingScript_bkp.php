<link href="<?php echo base_url();?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url();?>assets/vendor/select2/select2.min.js" type="text/javascript"></script> 
 <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
 <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<!-- <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>-->
<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js" type="text/javascript"></script> 
<script> 
    var urls = "<?php echo base_url()?>";
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
    
 </script>
