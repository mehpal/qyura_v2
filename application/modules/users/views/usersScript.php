<style type="text/css">
    #users_datatable_filter
    {
        display:none;
    }
</style>
<link href="<?php echo base_url(); ?>assets/cropper/cropper.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/cropper/main.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js">
</script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url(); ?>assets/vendor/timepicker/bootstrap-timepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/add-doctor.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/vendor/select2/select2.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/cropper/cropper.js"></script>
<script src="<?php echo base_url(); ?>assets/cropper/main.js"></script>
<script src="<?php echo base_url(); ?>assets/js/common_js.js"></script>

<script src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js" type="text/javascript"></script> 
<script>
    var urls = "<?php echo base_url() ?>";
    function fetchCity(stateId) {

        $.ajax({
            url: urls + 'index.php/users/fetchCity',
            type: 'POST',
            data: {'stateId': stateId},
            success: function (datas) {
                // console.log(datas);
                $('#patientDetails_cityId').html(datas);
                $('#patientDetails_cityId').selectpicker('refresh');
                $('#StateId').val(stateId);
            }
        });

    }
</script>
   <script>
   
    
  var urls = "<?php echo base_url() ?>";
$(document).ready(function () {
    $("#submitForm").validate({
        rules: {
            patientDetails_patientName: {
                required: true
            },
            avatarInput:{
                required: true
            },
            patientDetails_gender: {
                required : true
            },
             patientDetails_dob: {
                required : true
            },
            users_email: {
                required: true,
                email: true,
                remote: {
                    url:  urls + 'index.php/users/checkUserExistence',
                    type: "post",
                    data: {
                            email: function(){ return $("#users_email").val(); },
                            id: function(){ return $("#users_id").val(); }
                    },
            }
            
            },
           
            patientDetails_mobileNo: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
            },
             patientDetails_stateId: {
                required: true
            },
             patientDetails_cityId: {
                required: true
            },
          
            patientDetails_pin: {
                required: true,
                number: true,
                minlength: 6,
                maxlength: 6
            },
            
              patientDetails_address: {
                required: true
            },
            
             users_password:{
            required :true,
             minlength :4,
            maxlength :24,
        },
        cnfPassword:{
            required :true,
             minlength :4,
            maxlength :24,
            equalTo :  '#users_password',
        },
      userInsurance_insuranceId:{
          required: true
      }, 
      userInsurance_insuranceNo:{
          required: true
      },
       userInsurance_expDate:{
         
           required: true
      },
       usersfamily_name:{
         
           required: true
      },
       usersfamily_gender:{
         
           required: true
      },
       usersfamily_age:{
         
           required: true,
           number:true
      },
       usersfamily_relationId:{
         
           required: true
      }
           
        },
        messages: {
            patientDetails_patientName:{
                required: "Please enter name",
            },
            avatarInput:{
                required: "Please select Image"
            },
            patientDetails_gender: {
                required : "Please select gender."
            },
              patientDetails_dob: {
                required : "Please enter date of birth."
            },
            users_email: {
                required: "Please enter email Id",
                email: "Please enter valid email Id.",
                remote: 'Email already used.'
            },
          
            patientDetails_mobileNo: {
                required: "Please enter mobile number.",
                number: "Please enter only number format."
            },
            
              patientDetails_stateId: {
                required: "Please select state."
            },
             patientDetails_cityId: {
                required: "Please select city."
            },
           
            patientDetails_pin: {
                required: "Please enter pincode.",
                number: "Please enter only number.",
            },
             patientDetails_address: {
                required: "Please enter address.",
            },
            
             users_password: {
            required: "Please enter New Password.",          
        },
            cnfPassword: {
            required: "Please enter Repeat Password.", 
            
        },
          userInsurance_insuranceId:{
          required:"Please select insurance company."
      },   
       userInsurance_insuranceNo:{
          required: "Please enter insurance card number."
      }, 
      userInsurance_expDate:{
         
           required: "Please enter expiry date."
         
      },
       usersfamily_name:{
         
           required: "Please enter name."
         
      },
       usersfamily_gender:{
         
           required: "Please select gender."
         
      },
       usersfamily_age:{
         
           required: "Please enter age."
         
      },
       usersfamily_relationId:{
         
           required: "Please select relation."
         
      }
      
           
        }

    });
    
});
function image_check(){
   var image = $("#avatarInput").val();
    if (image == '') {
        $('#image_select').addClass('bdr-error');
        $('#error-avatarInput').fadeIn().delay(3000).fadeOut('slow');
    }else{
        $('#image_select').removeClass('bdr-error');
        $('#error-avatarInput').fadeOut();
    }
}
</script>


<script>
    function insuranceShowHide(radio_value, div_id) {

        if (radio_value == '1') {
            $("#" + div_id).show();
            //$("#"+div_id).find("input[type=text]").prop('required', true);
        } else {
            //$("#"+div_id).find("input[type=text]").prop('required', false);
            $("#" + div_id).hide();
        }
 
    }

</script>


<script>
    function addMoreFamilyMember() {
        var total_test = parseInt($("#total_test").val());
        var newTestValue = total_test + parseInt(1);

        $("#total_test").val(newTestValue);

        var htmlData = '<div id="familyInsuranceClon_'+newTestValue+'"><article class="form-group m-lr-0"><label for="" class="control-label col-md-4 col-sm-4">Name :</label><div class="col-md-8 col-sm-8"><input class="form-control" id="usersfamily_name_' + newTestValue+'" type="text" name="usersfamily_name_'+newTestValue+'"/></div></article><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4">Gender & Age:</label><div class="col-md-8 col-sm-8"><aside class="row"><div class="col-md-6 col-sm-6"><select class="selectpicker" data-width="100%" name="usersfamily_gender_'+newTestValue+'" id="usersfamily_gender_'+newTestValue+'"><option value="1">Male</option><option value="2">Female</option></select></div><div class="col-md-6 col-sm-6 m-t-xs-10"><input class="form-control" id="usersfamily_age_'+newTestValue+'" type="text" name="usersfamily_age_'+newTestValue+'" required="" placeholder=""></div></aside></div></article><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4">Relationship :</label><div class="col-md-8 col-sm-8"><select class="selectpicker" data-width="100%" name="usersfamily_relationId_'+newTestValue+'" id="usersfamily_relationId_'+newTestValue+'"><?php foreach ($familyMember as $key => $val) { ?><option value="<?php echo $val->relation_id; ?>"><?php echo $val->relation_type; ?></option><?php } ?></select></div></article><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4">Have Health Insurance ?</label><div class="col-md-8 col-sm-8"><div class="radio radio-success radio-inline"><input type="radio" name="healthInsurance_'+newTestValue+'" value="1" id="inlineRadio3_'+newTestValue+'" onclick="insuranceShowHide(\'1\',\'insuranceDivfamily_'+newTestValue+'\')"><label for="inlineRadio3_'+newTestValue+'">Yes</label></div><div class="radio radio-success radio-inline"><input type="radio" name="healthInsurance_'+newTestValue+'" value="0" id="inlineRadio4_'+newTestValue+'" checked onclick="insuranceShowHide(\'0\',\'insuranceDivfamily_'+newTestValue+'\')"><label for="inlineRadio4_'+newTestValue+'">No</label></div></div></article><div style="display:none" id="insuranceDivfamily_'+newTestValue+'"><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4">Health Insu. Provider:</label><div class="col-md-8 col-sm-8"><select class="selectpicker" data-width="100%" name="userInsurance_insuranceId_'+newTestValue+'" id="userInsurance_insuranceId_'+newTestValue+'"><?php foreach ($insurance_cmpny as $key => $val) { ?><option value="<?php echo $val->insurance_id; ?>"><?php echo $val->insurance_Name; ?></option><?php } ?></select></div></article><article class="form-group m-lr-0"><label  class="control-label col-md-4 col-sm-4">Health Card no. :</label><div class="col-md-8 col-sm-8"><input class="form-control" id="userInsurance_insuranceNo_'+newTestValue+'" type="text" name="userInsurance_insuranceNo_'+newTestValue+'" required placeholder="HDFC098723" /></div></article></div><article class="form-group m-lr-0"><div class="col-md-3 col-sm-3 col-md-offset-0 col-sm-offset-0"><button id="remove_'+newTestValue+'" class="btn btn-danger btn-block waves-effect waves-light" type="button" href="javascript:void(0);" onclick="removeTest(\''+newTestValue+'\');" > Remove </button></div></article></div>'
        $("#familyInsuranceSection").append(htmlData);
    }

    function removeTest(div_no) {
        $("#familyInsuranceClon_" + div_no).slideUp(function () {
        });
        var typeVal = parseInt(div_no) - parseInt(1);
        $("#total_test").val(typeVal);
        $("#remove_" + typeVal).show();
        $("#familyInsuranceClon_" + div_no).remove();
    }

</script>
<script>
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
    </script>
    <script>                 // datatable get records
         $(document).ready(function () {
                var oTable = $('#users_datatable').DataTable({
                    "processing": true,
                    "bServerSide": true,
                     "columnDefs": [{
                    "targets": [0,1,2,3,4,5,6],
                    "orderable": false
                     }],
                   // "searching": true,
                    "bLengthChange": false,
                    "bProcessing": true,
                    "iDisplayLength": 10,
                    "bPaginate": true,
                    "sPaginationType": "full_numbers",
                    "columns": [
                        {"data": "patientDetails_patientImg"},
                        {"data": "patientDetails_patientName"},
                        {"data": "patientDetails_dob"},
                        {"data": "patientDetails_mobileNo"},
                        {"data": "patientDetails_address"},
                        {"data": "status"},
                        {"data": "view" ,'searchable' : false},
                    ],
                    
                    "ajax": {
                        "url": "<?php echo site_url('users/getUsersDl');?>",
                        "type": "POST", 
                        "data": function ( d ) {
                                         d.cityId = $("#users_cityId").val();
                                         d.bloodBank_name = $("#search").val();
                                         if($("#status").val() != ' '){
                                         d.status = $("#status").val();
                                        }
                                         d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                                    } 
                    }
                });
                
                  $('#users_cityId,#status').change( function() {
                        oTable.draw();
                  } );
                     $('#search').on('keyup', function() {
                         oTable.columns( 5 ).search($(this).val()).draw();
                  } );
                
            }); </script>
    
    <script>                 // datatable get records
         $(document).ready(function () {
                var oTable = $('#consultingList').DataTable({
                    "processing": true,
                    "bServerSide": true,
                     "columnDefs": [{
                    "targets": [0,1,2,3],
                    "orderable": false
                     }],
                   // "searching": true,
                    "bLengthChange": false,
                    "bProcessing": true,
                    "iDisplayLength": 10,
                    "bPaginate": true,
                    "sPaginationType": "full_numbers",
                    "columns": [
                        {"data": "doctorAppointment_date"},
                        {"data": "doctorAppointment_finalTiming"},
                        //{"data": "doctorAppointment_doctorUserId"},
                        {"data": "doctorAppointment_status"},
                        {"data": "view" ,'searchable' : false},
                    ],
                    
                    "ajax": {
                        "url": "<?php echo site_url('users/getconsultantDl');?>",
                        "type": "POST", 
                        "data": function ( d ) {
                                          d.userId = 
                                         d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                                    } 
                    }
                });
                
                 
            }); </script>
       <script>                 // datatable get records
         $(document).ready(function () {
                var oTable = $('#diagnostic').DataTable({
                    "processing": true,
                    "bServerSide": true,
                     "columnDefs": [{
                    "targets": [0,1,2,3,4,5],
                    "orderable": false
                     }],
                   // "searching": true,
                    "bLengthChange": false,
                    "bProcessing": true,
                    "iDisplayLength": 10,
                    "bPaginate": true,
                    "sPaginationType": "full_numbers",
                    "columns": [
                        {"data": "patientDetails_patientImg"},
                        {"data": "patientDetails_patientName"},
                        {"data": "patientDetails_dob"},
                        {"data": "patientDetails_mobileNo"},
                        {"data": "patientDetails_address"},
//                        {"data": "status"},
//                        {"data": "view" ,'searchable' : false},
                    ],
                    
                    "ajax": {
                        "url": "<?php echo site_url('users/getuserDiagnosticDl');?>",
                        "type": "POST", 
                        "data": function ( d ) {
                                          d.userId = 
                                         d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                                    } 
                    }
                });
                
                 
            }); </script>
       
       
       
          <script>                 // datatable get records
         $(document).ready(function () {
                var oTable = $('#consulting').DataTable({
                    "processing": true,
                    "bServerSide": true,
                     "columnDefs": [{
                    "targets": [0,1,2,3,4,5],
                    "orderable": false
                     }],
                   // "searching": true,
                    "bLengthChange": false,
                    "bProcessing": true,
                    "iDisplayLength": 10,
                    "bPaginate": true,
                    "sPaginationType": "full_numbers",
                    "columns": [
                        {"data": "patientDetails_patientImg"},
                        {"data": "patientDetails_patientName"},
                        {"data": "patientDetails_dob"},
                        {"data": "patientDetails_mobileNo"},
                        {"data": "patientDetails_address"},
//                        {"data": "status"},
//                        {"data": "view" ,'searchable' : false},
                    ],
                    
                    "ajax": {
                        "url": "<?php echo site_url('users/getconsultantDl');?>",
                        "type": "POST", 
                        "data": function ( d ) {
                                          d.userId = 
                                         d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                                    } 
                    }
                });
                
                 
            }); </script>