<script src="<?php echo base_url(); ?>assets/vendor/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<link href="<?php echo base_url(); ?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendor/select2/select2.min.js" type="text/javascript"></script> 



<script>
    function fetchCity(stateId, cityId, id) {
        $.ajax({
            url: '<?php echo site_url('miappointment/fetchCity'); ?>',
            type: 'POST',
            data: {'stateId': stateId},
            beforeSend: function (xhr) {
                qyuraLoader.startLoader();
            },
            success: function (datas) {

                $('#cityId').html(datas);
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
        qyuraLoader.startLoader();

    }

    var resizefunc = [];

    function getMI(option) {
        var city_id = $("#appointment_city").val();
        var appointment_type = $("#centerType").val();

        var url = '<?php echo site_url(); ?>/miappointment/getMI';
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
                    console.log(data);
                    $('#mi_centre').html(data);
                    $('#mi_centre').selectpicker('refresh');
                    $('#timeSlot').html('');
                    $('#timeSlot').selectpicker('refresh');
                    $('#input5').prop('selectedIndex', '');
                    $('#input5').selectpicker('refresh');
                    $('#speciallity').prop('selectedIndex', '');
                    $('#speciallity').selectpicker('refresh');
                    $('#doctorSection').hide();
                    $('#diagnosticSection').hide();
                }
            });
            qyuraLoader.stopLoader();
        }
    }

    function getpatientdetails() {
        var patient_email = $("#patient_email").val();
        var url = '<?php echo site_url(); ?>/miappointment/getpatient/';
        $.ajax({
            url: url,
            async: false,
            type: 'POST',
            data: {'patient_email': patient_email},
            beforeSend: function (xhr) {
                qyuraLoader.startLoader();
            },
            success: function (data) {

                if (data && data != 0) {

                    var data = JSON.parse(data);
                    if (data.email_status != 1) {
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
                        $('#input36').prop('selectedIndex', data.gender);
                        $('#input36').selectpicker('refresh');
                        $('#user_id').val(data.user_id);
                    } else {
                        $('#user_id').val(data.id);
                        $('#email_status').val(data.email_status);
                    }
                } else {
                    $('#users_mobile').val('');
                    $('#cityId').html('');
                    $('#cityId').selectpicker('refresh');
                    $('#stateId').prop('selectedIndex', '');
                    $('#stateId').selectpicker('refresh');
                    $('#users_username').val('');
                    $('#address').val('');
                    $('#unqId').val('');
                    $('#zip').val('');
                    $('#user_id').val('');
                    $('#date-4').val('');
                    $('#input36').prop('selectedIndex', '');
                    $('#input36').selectpicker('refresh');
                    $('#input33').html('');
                    $('#input33').selectpicker('refresh');
                    $('#familyDiv').hide();
                    $('#familyListDiv').hide();
                    $("#p_unqId").hide();
                }

            }
        });
        qyuraLoader.stopLoader();
    }

    function changeForm() {
        var Value = $("#input5").val();
        if (Value == 0)
        {
            $('#doctorSection').show();
            $('#diagnosticSection').hide();

            var id = $('#mi_centre').val();
            id = id.split(',');
            var h_d_id = id[0];
            var type = $('#centerType').val();

            var url = '<?php echo site_url(); ?>/miappointment/find_specialities';
            if (typeof h_d_id == 'string' && typeof type == 'string') {
                $.ajax({
                    url: url,
                    async: false,
                    type: 'POST',
                    data: {'h_d_id': h_d_id, 'type': type},
                    beforeSend: function (xhr) {
                        qyuraLoader.startLoader();
                    },
                    success: function (data) {
                        console.log(data);
                        $('#speciallity').html(data);
                        $('#speciallity').selectpicker('refresh');

                    }
                });
                qyuraLoader.stopLoader();
            }
        } else
        {
            var total_test = $("#total_test").val();

            $('#doctorSection').hide();
            $('#diagnosticSection').show();

            var id = $('#mi_centre').val();
            id = id.split(',');
            var h_d_id = id[0];
            var type = $('#centerType').val();

            var url = '<?php echo site_url(); ?>/miappointment/find_diago_test';
            if (typeof h_d_id == 'string' && typeof type == 'string') {
                $.ajax({
                    url: url,
                    async: false,
                    type: 'POST',
                    data: {'h_d_id': h_d_id, 'type': type},
                    beforeSend: function (xhr) {
                        qyuraLoader.startLoader();
                    },
                    success: function (data) {
                        console.log(data);

                        $("#input28_" + total_test).html(data);
                        $("#input28_" + total_test).selectpicker('refresh');

                    }
                });
                qyuraLoader.stopLoader();
            }
        }

    }

    function getTimeSlot() {
        var id = $('#mi_centre').val();
        id = id.split(',');
        var h_d_id = id[0];
        var docid = $('#input12').val();

        var appdate = $('#date-3').val();

        var type = $("#centerType").val();

        if (type == "0")
            var type1 = 1;
        else
            var type1 = 2;

        var url = '<?php echo site_url(); ?>/miappointment/appoint_timeSlot';
        if (typeof h_d_id == 'string' && typeof type == 'string') {
            $.ajax({
                url: url,
                async: false,
                type: 'POST',
                data: {'h_d_id': h_d_id, 'type': type, 'docid': docid, 'appdate': appdate, 'centertype': type1},
                beforeSend: function (xhr) {
                    qyuraLoader.startLoader();
                },
                success: function (data) {


                    $('#timeSlot').html(data);
                    $('#timeSlot').selectpicker('refresh');

                }
            });
            qyuraLoader.stopLoader();
        }
    }

    function findDoctor() {
        var id = $('#mi_centre').val();
        id = id.split(',');
        var h_d_id = id[1];
        var type = $('#centerType').val();
        var special_id = $('#speciallity').val();
        var url = '<?php echo site_url(); ?>/miappointment/find_doctor';
        if (typeof h_d_id == 'string' && typeof type == 'string' && typeof special_id == 'string') {
            $.ajax({
                url: url,
                async: false,
                type: 'POST',
                data: {'h_d_id': h_d_id, 'type': type, 'special_id': special_id},
                beforeSend: function (xhr) {
                    qyuraLoader.startLoader();
                },
                success: function (data) {
                    console.log(data);

                    $('#input12').html(data);
                    $('#input12').selectpicker('refresh');

                }
            });
            qyuraLoader.stopLoader();
        }
    }

    function addMoreTest() {
        var total_test = parseInt($("#total_test").val());
        var newTestValue = total_test + parseInt(1);

        $("#total_test").val(newTestValue);

        var htmlData = '<div id="diagnosticClon_' + newTestValue + '"><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4 cl-black">Test-' + newTestValue + ' :</label></article><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4">Diagnostic Type :</label><div class="col-md-8 col-sm-8"><select class="selectpicker" data-width="100%" name="input28[]" id="input28_' + newTestValue + '" required="" ><option value="">Select Diagnostic</option></option></select><div class="has-error  error-diagcat" id="err_input28_' + newTestValue + '" ></div></div></article><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4">Test Name :</label><div class="col-md-8 col-sm-8"><input type="text" required="" class="form-control" name="input29[]" id="input29_' + newTestValue + '" ><div class="has-error error-diagtest" id="err_input29_' + newTestValue + '" ></div></div></article><article class="form-group m-lr-0"><label for="" class="control-label col-md-4 col-sm-4">Price :</label><div class="col-md-8 col-sm-8"><input class="form-control" required="" type="text" id="input30_' + newTestValue + '" name="input30[]" placeholder="770"><div class="has-error error-diagprice" id="err_input30_' + newTestValue + '" ></div></div></article><article class="form-group m-lr-0"><label for="" class="control-label col-md-4 col-sm-4">Instruction :</label><div class="col-md-8 col-sm-8"><textarea class="form-control" id="input31_' + newTestValue + '" name="input31[]" placeholder="" required="" ></textarea><div class="has-error error-diagins " id="err_input31_' + newTestValue + '" ></div></div></article><article class="form-group m-lr-0"><div class="col-md-3 col-sm-3 col-md-offset-0 col-sm-offset-0"><button id="remove_' + newTestValue + '" class="btn btn-danger btn-block waves-effect waves-light" type="button" href="javascript:void(0);" onclick="removeTest(\'' + newTestValue + '\');" > Remove </button></div></article></div>';
        //$("#diagnosticSection").append(htmlData);
        $('#diagnosticSection article:last').prev().after().append(htmlData);
        if (total_test !== 1) {
            $("#remove_" + total_test).hide();
        }
        $('.selectpicker').selectpicker({
            style: 'btn-default',
            size: "auto",
            width: "100%"
        });
        changeForm();
    }

    function removeTest(div_no) {
        $("#diagnosticClon_" + div_no).slideUp(function () {
        });

        var typeVal = parseInt(div_no) - parseInt(1);
        $("#total_test").val(typeVal);
        $("#remove_" + typeVal).show();
        $("#diagnosticClon_" + div_no).remove();
    }

    function calculateamount() {
        var type = $('#input5').val();
        var amount = 0;
        var con_fee = parseInt($('#input22').val());
        var oth_fee = parseInt($('#input23').val());
        if (!oth_fee)
            oth_fee = 0;
        var tax = parseInt($('#input24').val());
        if (!tax)
            tax = 0;
        var amount = con_fee;

        if (type == 1) {
            var total_test = $("#total_test").val();
            var a;
            for (a = 1; a <= total_test; a++) {
                var test_amount = parseInt($("#input30_" + a).val());
                if (test_amount)
                    amount = amount + test_amount;
            }
        }

        var tax_amount = (amount / parseInt(100)) * tax;
        var total_amount = (amount + tax_amount).toFixed(2);
        total_amount = parseFloat(total_amount) + parseFloat(oth_fee);

        if (total_amount) {
            $("#input25").val(total_amount);
        } else if (!amount) {
            $("#input25").val(con_fee);
        } else if (amount) {
            $("#input25").val(amount);
        } else {
            $("#input25").val('');
        }
    }

    function checkMobile() {
        var patient_email = $("#patient_email").val();
        var users_mobile = $("#users_mobile").val();
        if (users_mobile != '') {
            var url = '<?php echo site_url(); ?>/miappointment/check_mobile';
            if (typeof patient_email == 'string' && typeof users_mobile == 'string') {
                $.ajax({
                    url: url,
                    async: false,
                    type: 'POST',
                    data: {'patient_email': patient_email, 'users_mobile': users_mobile},
                    success: function (data) {
                        if (data == 1) {
                            $("#users_mobile").val('');
                            bootbox.alert("This Mobile Number already used with another user");

                        }
                    }
                });
            }
        }
    }

    function getMember(obj) {
        if (obj == 1) {
            var user_id = $("#user_id").val();
            if (user_id != '') {
                var url = '<?php echo site_url(); ?>/miappointment/getMember/';
                $.ajax({
                    url: url,
                    async: false,
                    type: 'POST',
                    data: {'user_id': user_id},
                    beforeSend: function (xhr) {
                        qyuraLoader.startLoader();
                    },
                    success: function (data) {
                        $('#familyListDiv').show();
                        $('#input33').html(data);
                        $('#input33').selectpicker('refresh');
                    }
                });
                qyuraLoader.startLoader();
            }
        } else {
            $('#familyListDiv').hide();
            $('#input33').html('');
            $('#input33').selectpicker('refresh');
        }
    }

    $(document).ready(function () {
<?php $date = date('m/d/Y'); ?>
        $('.timepicker').timepicker({showMeridian: false});
        $('#date-5').datepicker({
            autoclose: true,
            startDate: '<?php echo $date; ?>',
        });
        $('#date-3').datepicker({
            autoclose: true,
            startDate: '<?php echo $date; ?>',
        }).on('changeDate', function (e) {
            getTimeSlot();
        });

        $('#date-4').datepicker({autoclose: true});

        $('.selectpicker').selectpicker().change(function () {
            $(this).valid();

        });
        $("#setData").validate({
            rules: {
                input1: {
                    required: true
                },
                input2: {
                    required: true
                },
                input3: {
                    required: true
                },
                input5: {
                    required: true
                },
                input10: {
                    required: true
                },
                input12: {
                    required: true
                },
                input13: {
                    required: true
                },
                input6: {
                    required: true
                },
                input4: {
                    required: true,
                },
                input34: {
                    required: true,
                    remote: {
                        url: '<?php echo base_url() ?>' + 'index.php/miappointment/check_timeslot',
                        type: "post",
                        data: {
                            timeslot_id: function () {
                                var timeSlot = $("#timeSlot").val().split(',');
                                return timeSlot[0];
                            },
                            final_timing: function () {
                                return $("#timepicker4").val();
                            },
                        }
                    }
                },
                input7: {
                    required: true
                },
                input37: {
                    required: true
                },
                'input28[]': {
                    required: true
                },
                'input29[]': {
                    required: true,
                    lettersonly: true,
                },
                'input30[]': {
                    required: true,
                    digits: true,
                },
                'input31[]': {
                    required: true
                },
                input14: {
                    required: true
                },
                input15: {
                    required: true,
                    digits: true,
                },
                input17: {
                    required: true,
                    lettersonly: true,
                },
                input18: {
                    required: true
                },
                input19: {
                    required: true
                },
                input20: {
                    required: true,
                    digits: true,
                },
                input21: {
                    required: true
                },
                input22: {
                    required: true,
                    digits: true,
                },
                input23: {
                    required: true,
                    digits: true,
                },
                input24: {
                    required: true,
                    digits: true,
                },
                input32: {
                    required: true
                },
                input35: {
                    required: true
                },
                input36: {
                    required: true
                }
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "input1")
                {
                    error.insertAfter('.error-city');
                }
                else if (element.attr("name") == "input2")
                {
                    error.insertAfter('.error-appt');
                }
                else if (element.attr("name") == "input3")
                {
                    error.insertAfter('.error-hosdiag');
                }
                else if (element.attr("name") == "input5")
                {
                    error.insertAfter('.error-type');
                }
                else if (element.attr("name") == "input10")
                {
                    error.insertAfter('.error-spec');
                }
                else if (element.attr("name") == "input12")
                {
                    error.insertAfter('.error-doc');
                }
                else if (element.attr("name") == "input4")
                {
                    error.insertAfter('.error-ts');
                }
                else if (element.attr("name") == "input28[]")
                {
                    error.insertAfter('.error-diagcat');
                }
                else if (element.attr("name") == "input29[]")
                {
                    error.insertAfter('.error-diagtest');
                }
                else if (element.attr("name") == "input30[]")
                {
                    error.insertAfter('.error-diagprice');
                }
                else if (element.attr("name") == "input30[]")
                {
                    error.insertAfter('.error-diagins');
                }
                else if (element.attr("name") == "input36")
                {
                    error.insertAfter('.error-gender');
                }
                else if (element.attr("name") == "input19")
                {
                    error.insertAfter('.error-state');
                }
                else if (element.attr("name") == "input32")
                {
                    error.insertAfter('.error-c');
                }

                else {
                    error.insertAfter(element);
                }

            },
            messages: {
                input1: {
                    required: "Please select a city!",
                },
                input2: {
                    required: "Please select appointment for!",
                },
                input3: {
                    required: "Please select MI!",
                },
                input5: {
                    required: "Please select appointment type!",
                },
                input10: {
                    required: "Please select a speciality!",
                },
                input12: {
                    required: "Please select a doctor!",
                },
                input13: {
                    required: "Please enter remarks!",
                },
                input6: {
                    required: "Please select a date!",
                },
                input4: {
                    required: "Please select a time slot!",
                    remote: "Please select a correct time slot!",
                },
                input34: {
                    required: "Please select a final time!",
                },
                input7: {
                    required: "Please select a date!",
                },
                input37: {
                    required: "Please select a final time!",
                },
                'input28[]': {
                    required: "Please select a diagnostic type!",
                },
                'input29[]': {
                    required: "Please enter a test name! ",
                },
                'input30[]': {
                    required: "Please enter price! ",
                },
                'input31[]': {
                    required: "Please enter instructions! ",
                },
                input14: {
                    required: "Please enter an email-id!"
                },
                input15: {
                    required: "Please enter a mobile number!",
                    digits: "Please enter digits only!"
                },
                input17: {
                    required: "Please enter a name!",
                    lettersonly: "Please enter characters only!"
                },
                input18: {
                    required: "Please select a country!"
                },
                input19: {
                    required: "Please select a state!"
                },
                input20: {
                    required: "Please enter zip code!",
                    digits: "Please enter digits only!",
                },
                input21: {
                    required: "Please enter an address!"
                },
                input22: {
                    required: "Please enter consultation fees!",
                    digits: "Please enter digits only!",
                },
                input23: {
                    required: "Please enter any other fees!",
                    digits: "Please enter digits only!",
                },
                input24: {
                    required: "Please enter tax!",
                    digits: "Please enter digits only!",
                },
                input32: {
                    required: "Please select City!"
                },
                input35: {
                    required: "Please select a DOB!"
                },
                input36: {
                    required: "Please select a gender!"
                }

            },
            submitHandler: function (form)
            {

                form.submit();

            }
        });

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
    $('#resetButton').click(function () {
        location.reload();
    });

</script>