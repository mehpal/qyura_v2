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
<?php if ($this->router->fetch_method() == 'addUsers') { ?>
        $(document).ready(function () {
            $("#submitForm").submit(function (event) {
                event.preventDefault();
                if ($("#submitForm").valid()) {

                    var url = '<?php echo site_url(); ?>/users/saveUsers/';
                    var formData = new FormData(this);
                    submitData(url, formData);

                }
            });
        });
<?php } ?>
</script>
<script>

    function merge_options(obj1, obj2) {
        var obj3 = {};
        for (var attrname in obj1) {
            obj3[attrname] = obj1[attrname];
        }
        for (var attrname in obj2) {
            obj3[attrname] = obj2[attrname];
        }
        return obj3;
    }
    var urls = "<?php echo base_url() ?>";
    jQuery.validator.addMethod("lettersonlyqyura", function (value, element) {
        return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
    }, "Please enter letters only");

    var editformContainer = function () {
        var form = $("#editsubmitForm");
        //var results = {};
        var ruleContainer = {
            patientDetails_patientName: {
                required: true,
                lettersonlyqyura: true

            },
            avatar_file: {
                required: true
            },
            patientDetails_gender: {
                required: true
            },
            patientDetails_dob: {
                required: true
            },
//                    users_email: {
//                    required: true,
//                            email: true,
//                            remote: {
//                            url: urls + 'index.php/users/checkUserExistence',
//                                    type: "post",
//                                    data: {
//                                    email: function () {
//                                    return $("#users_email").val();
//                                    },
//                                            id: function () {
//                                            return $("#users_id").val();
//                                            }
//                                    },
//                            }
//                    },
//                    patientDetails_mobileNo: {
//                    required: true,
//                            number: true,
//                            minlength: 10,
//                            maxlength: 10
//                    },
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
            users_password: {
                minlength: 4,
                maxlength: 24,
            },
            cnfPassword: {
                minlength: 4,
                maxlength: 24,
                equalTo: '#users_password',
            },
            userInsurance_insuranceId: {
                required: true
            },
            userInsurance_insuranceNo: {
                required: true
            },
            userInsurance_expDate: {
                required: true
            },
            usersfamily_name: {
                required: true,
                lettersonlyqyura: true

            },
            usersfamily_gender: {
                required: true
            },
            usersfamily_age: {
                required: true,
                number: true
            },
            usersfamily_relationId: {
                required: true
            }

        };
        var results = {};
        $("#familyInsuranceSection input").each(function () {

            results[$(this).attr('name')] = {required: true};

        });

        var result = merge_options(ruleContainer, results);






        var resultValidate = form.validate({
            rules: result,
            messages: {
                patientDetails_patientName: {
                    required: "Please enter name.",
                },
                avatar_file: {
                    required: "Please select Image."
                },
                patientDetails_gender: {
                    required: "Please select gender."
                },
                patientDetails_dob: {
                    required: "Please enter date of birth."
                },
//                            users_email: {
//                            required: "Please enter email Id",
//                                    email: "Please enter valid email Id.",
//                                    remote: 'Email already used.'
//                            },
//                            patientDetails_mobileNo: {
//                            required: "Please enter mobile number.",
//                                    number: "Please enter only number format."
//                            },
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
                userInsurance_insuranceId: {
                    required: "Please select insurance company."
                },
                userInsurance_insuranceNo: {
                    required: "Please enter insurance card number."
                },
                userInsurance_expDate: {
                    required: "Please enter expiry date."

                },
                usersfamily_name: {
                    required: "Please enter name."

                },
                usersfamily_gender: {
                    required: "Please select gender."

                },
                usersfamily_age: {
                    required: "Please enter age."

                },
                usersfamily_relationId: {
                    required: "Please select relation."

                }
            }
        });

        return resultValidate;

    };




    var formContainer = function () {
        var form = $("#submitForm");
       
        //var results = {};
       
        var ruleContainer = {
            patientDetails_patientName: {
                required: true,
                lettersonlyqyura: true

            },
            avatar_file: {
                required: true
            },
            patientDetails_gender: {
                required: true
            },
            patientDetails_dob: {
                required: true
            },
            users_email: {
                required: true,
                email: true,
                remote: {
                            url:  urls + 'index.php/users/isEmailRegister',
                            type: "post",
                            data: {
                            email: function(){ return $("#users_email").val(); },
                           // id: function(){ return $("#user_tables_id").val(); },
                            role: function(){ return 6; }
                            }
                       }
            },
            patientDetails_mobileNo: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10,
                remote: {
                    url:  urls + 'index.php/users/isMobileRegister',
                    type: "post",
                    data: {
                            mobileNo: function(){ return $("#patientDetails_mobileNo").val(); },
                           // id: function(){ return $("#user_tables_id").val(); },
                            role: function(){ return 6; }
                    }
                  }
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
            users_password: {
                required: true,
                minlength: 4,
                maxlength: 24,
            },
            cnfPassword: {
                required: true,
                minlength: 4,
                maxlength: 24,
                equalTo: '#users_password',
            },
            userInsurance_insuranceId: {
                required: true
            },
            userInsurance_insuranceNo: {
                required: true
            },
            userInsurance_expDate: {
                required: true
            },
            usersfamily_name: {
                required: true,
                lettersonlyqyura: true

            },
            usersfamily_gender: {
                required: true
            },
            usersfamily_age: {
                required: true,
                number: true
            },
            usersfamily_relationId: {
                required: true
            }

        };
        var results = {};
        $("#familyInsuranceSection input").each(function () {

            results[$(this).attr('name')] = {required: true};

        });

        var result = merge_options(ruleContainer, results);






        var resultValidate = form.validate({
            ignore: ':hidden:not("#avatarInput")',
            errorPlacement: function (error, element) {
                if (element.attr("name") == "avatar_file")
                {
                    error.insertAfter('.error-label');
                } else if (element.attr("name") == "patientDetails_stateId") {
                    error.insertAfter('.error_patientDetails_stateId');
                }
                else if (element.attr("name") == "patientDetails_cityId") {
                    error.insertAfter('.error_patientDetails_cityId');
                }
                else if (element.attr("name") == "patientDetails_gender") {
                    error.insertAfter('.error_patientDetails_gender');
                }
                else if (element.attr("name") == "userInsurance_insuranceId") {
                    error.insertAfter('.error_userInsurance_insuranceId');
                }
                else if (element.attr("name") == "usersfamily_gender_1") {
                    error.insertAfter('.error_usersfamily_gender_1');
                }
                else if (element.attr("name") == "userInsurance_insuranceId_1") {
                    error.insertAfter('.error_userInsurance_insuranceId_1');
                }
                else if (element.attr("name") == "usersfamily_relationId_1") {
                    error.insertAfter('.error_usersfamily_relationId_1');
                }
                else {
                    error.insertAfter(element);
                }
            },
            rules: result,
            messages: {
                patientDetails_patientName: {
                    required: "Please enter name.",
                },
                avatar_file: {
                    required: "Please select Image"
                },
                patientDetails_gender: {
                    required: "Please select gender."
                },
                patientDetails_dob: {
                    required: "Please enter date of birth."
                },
                users_email: {
                    required: "Please enter email Id",
                  //  email: "Please enter valid email Id.",
                     remote: jQuery.validator.format("{0} is already exists.")
                },
                patientDetails_mobileNo: {
                    required: "Please enter mobile number.",
                    number: "Please enter only number format.",
                    remote: jQuery.validator.format("{0} is already exists.")
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
                userInsurance_insuranceId: {
                    required: "Please select insurance company."
                },
                userInsurance_insuranceNo: {
                    required: "Please enter insurance card number."
                },
                userInsurance_expDate: {
                    required: "Please enter expiry date."

                },
                usersfamily_name: {
                    required: "Please enter name."

                },
                usersfamily_gender: {
                    required: "Please select gender."

                },
                usersfamily_age: {
                    required: "Please enter age."

                },
                usersfamily_relationId: {
                    required: "Please select relation."

                }
            },
//                      submitHandler: function (form) {
//                        var checkmail = check_email();
//                          if(checkmail == true){
//                            form.submit();  
//                          }
//                
//            },
        });

        return resultValidate;

    };

    function image_check() {
        var image = $("#avatarInput").val();
        if (image == '') {
            $('#image_select').addClass('bdr-error');
            $('#error-avatarInput').fadeIn().delay(3000).fadeOut('slow');
        } else {
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
        var htmlData = '<div id="familyInsuranceClon_' + newTestValue + '"><hr><article class="form-group m-lr-0"><label for="" class="control-label col-md-4 col-sm-4">Name :</label><div class="col-md-8 col-sm-8"><input class="form-control" id="usersfamily_name_' + newTestValue + '" type="text" required="" name="usersfamily_name_' + newTestValue + '"/><label class="error" id="err_usersfamily_name_' + newTestValue + '" ></label></div></article><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4">Gender & Age:</label><div class="col-md-8 col-sm-8"><aside class="row"><div class="col-md-6 col-sm-6"><select class="select2" data-width="100%" required="" name="usersfamily_gender_' + newTestValue + '" id="usersfamily_gender_' + newTestValue + '"><option value=""> Select Gender</option><option value="1">Male</option><option value="2">Female</option><option value="3">Other</option></select><label class="error" id="err_usersfamily_gender_' + newTestValue + '" ></label></div><div class="col-md-6 col-sm-6 m-t-xs-10"><input class="form-control" onkeypress="return isNumberKey(event)" placeholder="Age" id="usersfamily_age_' + newTestValue + '" type="text" name="usersfamily_age_' + newTestValue + '" required="" placeholder=""><label class="error" id="err_usersfamily_age_' + newTestValue + '" ></label></div></aside></div></article><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4">Relationship :</label><div class="col-md-8 col-sm-8"><select class="select2" required="" data-width="100%" name="usersfamily_relationId_' + newTestValue + '" id="usersfamily_relationId_' + newTestValue + '"><option value=""> Select Relation</option><?php foreach ($familyMember as $key => $val) { ?><option value="<?php echo $val->relation_id; ?>"><?php echo $val->relation_type; ?></option><?php } ?></select><label class="error" id="err_usersfamily_relationId_' + newTestValue + '" ></label></div></article><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4">Have Health Insurance ?</label><div class="col-md-8 col-sm-8"><div class="radio radio-success radio-inline"><input type="radio" name="healthInsurance_' + newTestValue + '" value="1" id="inlineRadio3_' + newTestValue + '" onclick="insuranceShowHide(\'1\',\'insuranceDivfamily_' + newTestValue + '\')"><label for="inlineRadio3_' + newTestValue + '">Yes</label></div><div class="radio radio-success radio-inline"><input type="radio" name="healthInsurance_' + newTestValue + '" value="0" id="inlineRadio4_' + newTestValue + '" checked onclick="insuranceShowHide(\'0\',\'insuranceDivfamily_' + newTestValue + '\')"><label for="inlineRadio4_' + newTestValue + '">No</label></div></div></article><div style="display:none" id="insuranceDivfamily_' + newTestValue + '"><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4">Health Insu. Provider:</label><div class="col-md-8 col-sm-8"><select class="select2" required="" data-width="100%" name="userInsurance_insuranceId_' + newTestValue + '" id="userInsurance_insuranceId_' + newTestValue + '"><option value=""> Select Insurance</option><?php foreach ($insurance_cmpny as $key => $val) { ?><option value="<?php echo $val->insurance_id; ?>"><?php echo $val->insurance_Name; ?></option><?php } ?></select><label class="error" id="err_userInsurance_insuranceId_' + newTestValue + '" ></label></div></article><article class="form-group m-lr-0"><label  class="control-label col-md-4 col-sm-4">Health Card no. :</label><div class="col-md-8 col-sm-8"><input class="form-control" id="userInsurance_insuranceNo_' + newTestValue + '" type="text" name="userInsurance_insuranceNo_' + newTestValue + '" required /><label class="error" id="err_userInsurance_insuranceNo_' + newTestValue + '" ></label></div></article><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4">Policy Expiry Date :</label><div class="col-md-8 col-sm-8"><div class="input-group"><input class="form-control pickDate" required="" id="userInsurance_expDate_' + newTestValue + '" placeholder="mm/dd/yyyy" type="text" name="userInsurance_expDate_' + newTestValue + '" onkeydown="return false;"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span></div><label class="error" id="err_userInsurance_expDate_' + newTestValue + '" ></label></div></article></div><article class="form-group m-lr-0"><div class="col-md-3 col-sm-3 col-md-offset-0 col-sm-offset-0"><button id="remove_' + newTestValue + '" class="btn btn-danger btn-block waves-effect waves-light" type="button" href="javascript:void(0);" onclick="removeTest(\'' + newTestValue + '\');" > Remove </button></div></article></div>'
        $("#familyInsuranceSection").append(htmlData);
        if (total_test !== 1) {
            $("#remove_" + total_test).hide();
        }
        $('.select2').selectpicker();
        $('.pickDate').datepicker({autoclose: true,
            startDate: new Date(),
        }).on('changeDate', function () {
            $('.pickDate').valid();
        });

    }

    $('.pickDatePolicy').datepicker({
        autoclose: true,
        startDate: new Date()
    }).on('changeDate', function () {
        $('.pickDatePolicy').valid();
    });

    function removeTest(div_no) {
        $("#familyInsuranceClon_" + div_no).slideUp(function () {
        });
        var typeVal = parseInt(div_no) - parseInt(1);
        $("#total_test").val(typeVal);
        $("#remove_" + typeVal).show();
        $("#familyInsuranceClon_" + div_no).remove();
    }

    function addMoreFamilyMemberEdit() {
        var newTestValue = parseInt($("#total_test_edit").val());
        if (newTestValue == 0) {
            newTestValue = 1;
        }
        var total_family = parseInt($("#total_family").val());
        $("#total_test_edit").val(newTestValue);
        var htmlData = '<div id="familyInsuranceClon_' + newTestValue + '"><article class="form-group m-lr-0"><label for="" class="control-label col-md-4 col-sm-4">Name :</label><div class="col-md-8 col-sm-8"><input class="form-control" id="usersfamily_name_' + newTestValue + '" type="text" required="" name="usersfamily_name_' + newTestValue + '"/><label class="error" id="err_usersfamily_name_' + newTestValue + '" ></label></div></article><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4">Gender & Age:</label><div class="col-md-8 col-sm-8"><aside class="row"><div class="col-md-6 col-sm-6"><select class="select2" data-width="100%" required="" name="usersfamily_gender_' + newTestValue + '" id="usersfamily_gender_' + newTestValue + '"><option value=""> Select Gender</option><option value="1">Male</option><option value="2">Female</option><option value="3">Other</option></select><label class="error" id="err_usersfamily_gender_' + newTestValue + '" ></label></div><div class="col-md-6 col-sm-6 m-t-xs-10"><input class="form-control" placeholder="Age" onkeypress="return isNumberKey(event)" id="usersfamily_age_' + newTestValue + '" type="text" name="usersfamily_age_' + newTestValue + '" required=""><label class="error" id="err_usersfamily_age_' + newTestValue + '" ></label></div></aside></div></article><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4">Relationship :</label><div class="col-md-8 col-sm-8"><select class="select2" required="" data-width="100%" name="usersfamily_relationId_' + newTestValue + '" id="usersfamily_relationId_' + newTestValue + '"><option value=""> Select Relation</option><?php foreach ($familyMember as $key => $val) { ?><option value="<?php echo $val->relation_id; ?>"><?php echo $val->relation_type; ?></option><?php } ?></select><label class="error" id="err_usersfamily_relationId_' + newTestValue + '" ></label></div></article><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4">Have Health Insurance ?</label><div class="col-md-8 col-sm-8"><div class="radio radio-success radio-inline"><input type="radio" name="healthInsurance_' + newTestValue + '" value="1" id="inlineRadio3_' + newTestValue + '" onclick="insuranceShowHide(\'1\',\'insuranceDivfamily_' + newTestValue + '\')"><label for="inlineRadio3_' + newTestValue + '">Yes</label></div><div class="radio radio-success radio-inline"><input type="radio" name="healthInsurance_' + newTestValue + '" value="0" id="inlineRadio4_' + newTestValue + '" checked onclick="insuranceShowHide(\'0\',\'insuranceDivfamily_' + newTestValue + '\')"><label for="inlineRadio4_' + newTestValue + '">No</label></div></div></article><div style="display:none" id="insuranceDivfamily_' + newTestValue + '"><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4">Health Insu. Provider:</label><div class="col-md-8 col-sm-8"><select class="select2" required="" data-width="100%" name="userInsurance_insuranceId_' + newTestValue + '" id="userInsurance_insuranceId_' + newTestValue + '"><option value=""> Select Insurance</option><?php foreach ($insurance_cmpny as $key => $val) { ?><option value="<?php echo $val->insurance_id; ?>"><?php echo $val->insurance_Name; ?></option><?php } ?></select><label class="error" id="err_userInsurance_insuranceId_' + newTestValue + '" ></label></div></article><article class="form-group m-lr-0"><label  class="control-label col-md-4 col-sm-4">Health Card no. :</label><div class="col-md-8 col-sm-8"><input class="form-control" id="userInsurance_insuranceNo_' + newTestValue + '" type="text" name="userInsurance_insuranceNo_' + newTestValue + '" required /><label class="error" id="err_userInsurance_insuranceNo_' + newTestValue + '" ></label></div></article><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4">Policy Expiry Date :</label><div class="col-md-8 col-sm-8"><div class="input-group"><input class="form-control pickDate" id="userInsurance_expDate_' + newTestValue + '" placeholder="mm/dd/yyyy" type="text" name="userInsurance_expDate_' + newTestValue + '" onkeydown="return false;"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span></div><label class="error" id="err_userInsurance_expDate_' + newTestValue + '" ></label></div></article></div><article class="form-group m-lr-0"><div class="col-md-3 col-sm-3 col-md-offset-0 col-sm-offset-0"><button id="remove_' + newTestValue + '" class="btn btn-danger btn-block waves-effect waves-light" type="button" href="javascript:void(0);" onclick="removeTestEdit(\'' + newTestValue + '\');" > Remove </button></div></article><hr></div>'
        $("#familyInsuranceSection").append(htmlData);
        var remove_no = newTestValue - parseInt(1);
        if (total_family != remove_no) {
            $("#remove_" + remove_no).hide();
        }
        $('.select2').selectpicker();
        $('.pickDate').datepicker({autoclose: true,
            startDate: new Date()
        }).on('changeDate', function () {
            $('.pickDate').valid();
        });
        newTestValue = newTestValue + parseInt(1);
        $("#total_test_edit").val(newTestValue);
    }
    $('.pickDatePolicyedit').datepicker({
        autoclose: true,
        startDate: new Date()
    }).on('changeDate', function () {
        $('.pickDatePolicyedit').valid();
    });

    function removeTestEdit(div_no) {
        $("#familyInsuranceClon_" + div_no).slideUp(function () {
        });
        var typeVal = parseInt(div_no) - parseInt(1);
        $("#total_test_edit").val(typeVal);
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
                    "targets": [0, 1, 2, 3, 4, 5, 6],
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
                {"data": "view", 'searchable': false},
            ],
            "ajax": {
                "url": "<?php echo site_url('users/getUsersDl'); ?>",
                "type": "POST",
                "data": function (d) {
                    d.cityId = $("#users_cityId").val();
                    d.bloodBank_name = $("#search").val();
                    if ($("#status").val() != ' ') {
                        d.status = $("#status").val();
                    }
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                }
            }
        });
        $('#users_cityId,#status').change(function () {
            oTable.draw();
        });
        $('#search').on('keyup', function () {
            oTable.columns(5).search($(this).val()).draw();
        });
    });</script>


<script>





    function check_email() {
        var myEmail = $("#users_email").val();

        var emailReturn = 0;
        $.ajax({
            url: urls + 'index.php/users/check_email',
            type: 'POST',
            data: {'users_email': myEmail},
            success: function (datas) {
                if (datas == 0) {
                    $('#users_email_status').val(datas);
                     $('#erroremail_check').hide();
                    emailReturn = 1;
                } else if (datas == 1) {
                    $('#users_email').addClass('bdr-error');
                    $('#erroremail_check').fadeIn().delay(3000).fadeOut('slow');
                    $('#users_email').removeClass('bdr-error');
                    setTimeout(function () {
                        $('#users_email').removeClass('bdr-error');
                    }, 3000);
                    $('#users_email_status').val(datas);
                    emailReturn = 0;
                }
            }
        });
        return emailReturn;
    }
    
     function check_mobileNo() {
        var myMobileNo = $("#patientDetails_mobileNo").val();

        var mobileReturn = 0;
        $.ajax({
            url: urls + 'index.php/users/check_MobileNo',
            type: 'POST',
            data: {'mobile_no': myMobileNo},
            success: function (datas) {
                if (datas == 0) {
                    $('#users_mobile_status').val(datas);
                    mobileReturn = 1;
                } else if (datas == 1) {
                    $('#patientDetails_mobileNo').addClass('bdr-error');
                    $('#error-mobile_check').fadeIn().delay(3000).fadeOut('slow');
                    $('#patientDetails_mobileNo').removeClass('bdr-error');
                    setTimeout(function () {
                        $('#patientDetails_mobileNo').removeClass('bdr-error');
                    }, 3000);
                    $('#users_mobile_status').val(datas);
                    mobileReturn = 0;
                }
            }
        });
        return mobileReturn;
    }
    

</script>


<script>
    $('.dob').datepicker({
        autoclose: true,
        endDate: new Date(),
    }).on('changeDate', function () {
        $('#patientDetails_dob').valid();
    });
    
    
 
</script>


