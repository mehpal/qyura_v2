<script src="<?php echo base_url(); ?>assets/vendor/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendor/select2/select2.min.js" type="text/javascript"></script>


<script type="text/javascript">


    var formValid = $("#setData");

    var url = "<?php echo base_url(); ?>";
    formValid.validate({
        rules: {
            input1: {
                required: true
            },
            input2: {
                required: true
            },
            input4: {
                required: true
            },
            input3: {
                required: true
            },
            input5: {
                required: true
            },
            input24: {
                
                remote: {
                    url: url + 'index.php/docappointment/check_timeslot',
                    type: "post",
                    data: {
                        timeslot_id: function () {var timeSlot = $("#timeSlot").val().split(',');return timeSlot[0];},
                        final_timing: function () {return $("#timepicker4").val();},
                    }
                }
            },
            input8: {
                required: true
            },
            input9: {
                    required: true,
                    email: true,
                },
            input10: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
            },
            input12: {
                required: true
            },
            input26: {
                required: true
            },
            input27: {
                required: true
            },
            input13: {
                required: true
            },
            input14: {
                required: true
            },
            input15: {
                required: true
            },
            input16: {
                required: true,
                number: true,
                minlength: 6,
                maxlength: 6
            },
            input17: {
                required: true
            },
            input18: {
                required: true,
                numberdecimalonly: true
            },
            input19: {
                required: true,
                numberdecimalonly: true
            },
            input20: {
                required: true,
                numberdecimalonly: true
            },
            input22: {
                required: true
            },
        },
        errorPlacement: function(error, element) {
        if (element.attr("name") == "input1")
        {
            error.insertAfter('.error-city');
        }
        else if (element.attr("name") == "input2")
        {
            error.insertAfter('.error-spec');
        }
        else if (element.attr("name") == "input3")
        {
            error.insertAfter('.error-doc');
        }
        else if (element.attr("name") == "input5")
        {
            error.insertAfter('.error-ts');
        }
        else if (element.attr("name") == "input27")
        {
            error.insertAfter('.error-gender');
        }
        else if (element.attr("name") == "input14")
        {
            error.insertAfter('.error-state');
        }
        else if (element.attr("name") == "input15")
        {
            error.insertAfter('.error-c');
        }
        
        else{
            error.insertAfter(element);
        }
        
        },
        messages: {
            input1: {
                required: "Please select City.",
            },
            input2: {
                required: "Please select Speciality."
            },
            input4: {
                required: "Please select Date."
            },
            
            input3: {
                required: "Please select Assign Doctor."
            },
            input5: {
                required: "Please select a time slot!."
            },
            input24: {
                
                remote: "Please select a correct time slot."
            },
            input8: {
                required: "Please enter Patient Remarks."
            },
            input9:{
                 required: "Please enter email",
            }, 
            input10: {
                required: "Please enter Patient Mobile Number."
            },
            input12: {
                required: "Please enter Patient Name."
            },
            input26: {
                required: "Please select DOB."
            },
            input27: {
                required: "Please select Gender."
            },
            input13: {
                required: "Please select Country."
            },
            input14: {
                required: "Please select State."
            },
            input15: {
                required: "Please select City."
            },
            input16: {
                required: "Please enter Zip Code."
            },
            input17: {
                required: "Please enter Address."
            },
            input18: {
                required: "Please enter Consulation Fee."
            },
            input19: {
                required: "Please enter Other Fee."
            },
            input20: {
                required: "Please enter Tax."
            },
            input22: {
                required: "Please select Payment Status."
            },
            input23: {
                required: "Please select Payment Mode."
            }
        }
    });




    function fetchCity(stateId, cityId, id) {
        $.ajax({
            url: '<?php echo site_url('docappointment/fetchCity'); ?>',
            type: 'POST',
            data: {'stateId': stateId},
            beforeSend: function (xhr) {
                qyuraLoader.startLoader();
            },
            
            success: function (datas) {
                qyuraLoader.stopLoader();
                $('#cityId').html(datas);
                $("#cityId").removeClass('loadinggif');
                $('#cityId').selectpicker('refresh');
                $('#StateId').val(stateId);
                console.log(cityId);
                console.log(id);
                if (typeof cityId == "string") {
                    console.log(id);
                    $('#' + id).val(cityId);
                    $('#' + id).selectpicker('refresh');
                }
            }
        });

    }

    var resizefunc = [];

    function getMI(option) {
        var city_id = $("#appointment_city").val();
        var appointment_type = $("#centerType").val();

        var url = '<?php echo site_url(); ?>/docappointment/getMI';
        if (typeof city_id == 'string' && typeof appointment_type == 'string') {
            $.ajax({
                url: url,
                async: false,
                type: 'POST',
                data: {'city_id': city_id, 'appointment_type': appointment_type},
                beforeSend: function (xhr) {
                    qyuraLoader.startLoader();
                },
                
                success: function (data) {
                    qyuraLoader.stopLoader();
                    console.log(data);
                    $('#mi_centre').html(data);
                    $('#mi_centre').selectpicker('refresh');
                    $('#timeSlot').html('');
                    $('#timeSlot').selectpicker('refresh');
                    $('#input5').prop('selectedIndex', '');
                    $('#input5').selectpicker('refresh');
                    $('#speciallity').prop('selectedIndex', '');
                    $('#speciallity').selectpicker('refresh');
                    $("#mi_centre").removeClass('loadinggif');
                    $('#doctorSection').hide();
                    $('#diagnosticSection').hide();
                }
            });
        }
    }
//bootbox.alert({closeButton: false, message:"Is this is a correct "+ data.mobile +" which is bind with your respective "+ data.users_email +" address??"});
    function getpatientdetails(option) {
        var patient_email = $("#patient_email").val();
        if(patient_email != ''){
            var url = '<?php echo site_url(); ?>/docappointment/getpatient/';
            $.ajax({
                url: url,
                async: false,
                type: 'POST',
                data: {'patient_email': patient_email},

                beforeSend: function (xhr) {
                    qyuraLoader.startLoader();
                },

                success: function (data) {
                    qyuraLoader.stopLoader();
                    $("#patient_email").removeClass('loadinggif');
                    if(data && data != 0){
                        var data = JSON.parse(data);
                        if(data.email_status != 1){
                            console.log(data.mobile);
                            $('#patient_email').val(data.users_email)
                            $('#users_mobile').val(data.mobile);
                            $('#stateId').val(data.stateId);
                            $('#stateId').selectpicker('refresh');
                            fetchCity(data.stateId, data.cityId, 'cityId');
                            $('#cityId').val(data.cityId);
                            $('#users_username').val(data.patientName);
                            $('#address').val(data.address);
                            $('#unqId').val(data.unqId);
                            $("#p_unqId").show();
                            $("#familyDiv").show();
                            $('#zip').val(data.pin);
                            $('#date-4').val(data.dob);
                            $('#input27').prop('selectedIndex',data.gender);
                            $('#input27').selectpicker('refresh');
                            $('#user_id').val(data.user_id);
                            checkMobile();
                        }else{
                            $('#user_id').val(data.id);
                            $('#email_status').val(data.email_status);
                            $('#users_mobile').val('');
                            $('#cityId').html('');
                            $('#cityId').selectpicker('refresh');
                            $('#stateId').prop('selectedIndex','');
                            $('#stateId').selectpicker('refresh');
                            $('#users_username').val('');
                            $('#address').val('');
                            $('#unqId').val('');
                            $('#zip').val('');
                            $('#date-4').val('');
                            $('#input27').prop('selectedIndex','');
                            $('#input27').selectpicker('refresh');
                            $('#input25').html('');
                            $('#input25').selectpicker('refresh');
                            $('#familyDiv').hide();
                            $('#familyListDiv').hide();
                            $("#p_unqId").hide();
                            checkMobile();
                        }
                    }else{
                        $('#cityId').html('');
                        $('#cityId').selectpicker('refresh');
                        $('#stateId').prop('selectedIndex','');
                        $('#stateId').selectpicker('refresh');
                        $('#users_username').val('');
                        $('#address').val('');
                        $('#unqId').val('');
                        $('#zip').val('');
                        $('#date-4').val('');
                        $('#input27').prop('selectedIndex','');
                        $('#input27').selectpicker('refresh');
                        $('#user_id').val('');
                        $('#input25').html('');
                        $('#input25').selectpicker('refresh');
                        $('#familyDiv').hide();
                        $('#familyListDiv').hide();
                        $("#p_unqId").hide();
                        checkMobile();
                    }
                }
            });
        }
    }

    function getTimeSlot() {

        var doc_id = $("#input3").val();
        var date = $("#date-3").val();
        var url = '<?php echo site_url(); ?>/docappointment/appoint_timeSlot';
        if (typeof doc_id == 'string' && typeof date == 'string') {
            $.ajax({
                url: url,
                async: false,
                type: 'POST',
                data: {'doc_id': doc_id, 'date': date},
                beforeSend: function (xhr) {
                    qyuraLoader.startLoader();
                },
                
                success: function (data) {
                    qyuraLoader.stopLoader();
                    console.log(data);
                    $('#timeSlot').html(data);
                    $('#timeSlot').selectpicker('refresh');
                    $("#timeSlot").removeClass('loadinggif');
                    $('#input5').prop('selectedIndex', '');
                    $('#input5').selectpicker('refresh');
                }
            });
        }
    }

    function findDoc() {
        var city_id = $("#appointment_city").val();
        var special_id = $('#speciallity').val();
        var url = '<?php echo site_url(); ?>/docappointment/find_doctor';
        if (typeof city_id == 'string' && typeof special_id == 'string' && special_id != '') {
            $.ajax({
                url: url,
                async: false,
                type: 'POST',
                data: {'city_id': city_id, 'special_id': special_id},
                beforeSend: function (xhr) {
                    qyuraLoader.startLoader();
                },
                
                success: function (data) {
                    qyuraLoader.stopLoader();
                    $('#input3').html(data);
                    $('#input3').selectpicker('refresh');
                    $("#input3").removeClass('loadinggif');
                    $('#input5').prop('selectedIndex', '');
                    $('#input5').selectpicker('refresh');
                }
            });
        }
    }

    function calculateamount() {

        var con_fee = parseInt($('#input18').val());
        var oth_fee = parseInt($('#input19').val());
        var tax = parseInt($('#input20').val());
        var amount = con_fee + oth_fee;

        var tax_amount = (amount / parseInt(100)) * tax;
        var total_amount = amount + tax_amount;

        if (total_amount) {
            $("#input21").val(total_amount);
        } else if (!amount) {
            $("#input21").val(con_fee);
        } else if (amount) {
            $("#input21").val(amount);
        } else {
            $("#input21").val('');
        }
    }

    function getMember(obj) {
        if (obj == 1) {
            var user_id = $("#user_id").val();
            if (user_id != '') {
                var url = '<?php echo site_url(); ?>/docappointment/getMember/';
                $.ajax({
                    url: url,
                    async: false,
                    type: 'POST',
                    data: {'user_id': user_id},
                    beforeSend: function (xhr) {
                        qyuraLoader.startLoader();
                    },
                    
                    success: function (data) {
                        qyuraLoader.stopLoader();
                        $('#familyListDiv').show();
                        $("#input25").removeClass('loadinggif');
                        $('#input25').html(data);
                        $('#input25').selectpicker('refresh');
                    }
                });
            }
        } else {
            $('#familyListDiv').hide();
            $('#input25').html('');
            $('#input25').selectpicker('refresh');
        }
    }

    $('#date-3, #date-4').datepicker({autoclose: true});
    $('.timepicker').timepicker({showMeridian: true});
    $(document).ready(function () {
        $('.selectpicker').selectpicker().change(function(){
            $(this).valid();
            
        });
        $("#setData").submit(function (event) {

            if (!formValid.valid())
                return false;

            event.preventDefault();
            var url = '<?php echo site_url(); ?>/docappointment/addAppointmentSave/';
            var formData = new FormData(this);
            submitData(url, formData);
        });
    });
    $(".select2").select2({
        width: '100%'
    });

    function check_validaton() {
        var url = '<?php echo site_url(); ?>/docappointment/check_timeslot/';
        var final_timing = $("#timepicker4").val();
        var timeslot_id = $("#timeSlot").val();
        var resultAjax = false;
        $.ajax({
            url: url,
            async: false,
            type: 'POST',
            data: {'timeslot_id': timeslot_id, 'final_timing': final_timing},
            success: function (data) {
                if (data == 1) {
                    $("#err_timepicker4").hide();
                    resultAjax = 0;
                } else {
                    $("#err_timepicker4").show();
                    resultAjax++;
                }
            }
        });
    }
    
    function checkMobile() {
        var patient_email = $("#patient_email").val();
        var users_mobile = $("#users_mobile").val();
        if(users_mobile != ''){
            var url = '<?php echo site_url(); ?>/docappointment/check_mobile';
            if (typeof patient_email == 'string' && typeof users_mobile == 'string') {
                $.ajax({
                    url: url,
                    async: false,
                    type: 'POST',
                    data: {'patient_email': patient_email, 'users_mobile': users_mobile},

                    success: function (data) {
                        if(data == 1){
                            $("#users_mobile").val('');
                            alert("This Mobile Number already used with another user");
                        }
                    }
                });
            }
        }
    }
</script>