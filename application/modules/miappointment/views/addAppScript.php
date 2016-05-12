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
                $("#cityId").addClass('loadinggif');
            },
            success: function (datas) {

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

        var url = '<?php echo site_url(); ?>/miappointment/getMI';
        if (typeof city_id == 'string' && typeof appointment_type == 'string') {
            $.ajax({
                url: url,
                async: false,
                type: 'POST',
                data: {'city_id': city_id, 'appointment_type': appointment_type},
                beforeSend: function (xhr) {
                    $("#mi_centre").addClass('loadinggif');
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
                    $("#mi_centre").removeClass('loadinggif');
                    $('#doctorSection').hide();
                    $('#diagnosticSection').hide();
                }
            });
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
                $("#patient_email").addClass('loadinggif');
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
                        $("#speciallity").addClass('loadinggif');
                    },
                    success: function (data) {
                        console.log(data);
                        $('#speciallity').html(data);
                        $('#speciallity').selectpicker('refresh');
                        $("#speciallity").removeClass('loadinggif');
                    }
                });
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
                        $("#input28_" + total_test).addClass('loadinggif');
                    },
                    success: function (data) {
                        console.log(data);

                        $("#input28_" + total_test).html(data);
                        $("#input28_" + total_test).selectpicker('refresh');
                        $("#input28_" + total_test).removeClass('loadinggif');
                    }
                });
            }
        }

    }

    function getTimeSlot() {
        var id = $('#mi_centre').val();
        id = id.split(',');
        var h_d_id = id[1];
        var docid = $('#input12').val();

        var appdate = $('#date-3').val();

        var type = $("#centerType").val();
        var url = '<?php echo site_url(); ?>/miappointment/appoint_timeSlot';
        if (typeof h_d_id == 'string' && typeof type == 'string') {
            $.ajax({
                url: url,
                async: false,
                type: 'POST',
                data: {'h_d_id': h_d_id, 'type': type, 'docid': docid, 'appdate': appdate},
                beforeSend: function (xhr) {
                    $("#timeSlot").addClass('loadinggif');
                },
                success: function (data) {
                    
                    $('#timeSlot').html(data);
                    $('#timeSlot').selectpicker('refresh');
                    $("#timeSlot").removeClass('loadinggif');



                }
            });
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

        var htmlData = '<div id="diagnosticClon_' + newTestValue + '"><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4 cl-black">Test-' + newTestValue + ' :</label></article><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4">Diagnostic Type :</label><div class="col-md-8 col-sm-8"><select class="selectpicker" data-width="100%" name="input28_' + newTestValue + '" id="input28_' + newTestValue + '" required="" ><option value="">Select Diagnostic</option></option></select><div class="has-error " id="err_input28_' + newTestValue + '" ></div></div></article><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4">Test Name :</label><div class="col-md-8 col-sm-8"><input type="text" required="" class="form-control" name="input29_' + newTestValue + '" id="input29_' + newTestValue + '" ><div class="has-error " id="err_input29_' + newTestValue + '" ></div></div></article><article class="form-group m-lr-0"><label for="" class="control-label col-md-4 col-sm-4">Price :</label><div class="col-md-8 col-sm-8"><input class="form-control" required="" type="text" id="input30_' + newTestValue + '" name="input30_' + newTestValue + '" placeholder="770"><div class="has-error " id="err_input30_' + newTestValue + '" ></div></div></article><article class="form-group m-lr-0"><label for="" class="control-label col-md-4 col-sm-4">Instruction :</label><div class="col-md-8 col-sm-8"><textarea class="form-control" id="input31_' + newTestValue + '" name="input31_' + newTestValue + '" placeholder="" required="" ></textarea><div class="has-error " id="err_input31_' + newTestValue + '" ></div></div></article><article class="form-group m-lr-0"><div class="col-md-3 col-sm-3 col-md-offset-0 col-sm-offset-0"><button id="remove_' + newTestValue + '" class="btn btn-danger btn-block waves-effect waves-light" type="button" href="javascript:void(0);" onclick="removeTest(\'' + newTestValue + '\');" > Remove </button></div></article></div>';
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
        $("#diagnosticClon_" + div_no).slideUp(function () { });

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
        if(!oth_fee)
            oth_fee = 0;
        var tax = parseInt($('#input24').val());
        if(!tax)
            tax = 0;
        var amount = con_fee + oth_fee;
        
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
                        $("#input25").addClass('loadinggif');
                    },
                    success: function (data) {
                        $('#familyListDiv').show();
                        $("#input25").removeClass('loadinggif');
                        $('#input33').html(data);
                        $('#input33').selectpicker('refresh');
                    }
                });
            }
        } else {
            $('#familyListDiv').hide();
            $('#input33').html('');
            $('#input33').selectpicker('refresh');
        }
    }


    var urls = "<?php echo base_url() ?>";
    $(document).ready(function () {

        $('.timepicker').timepicker({showMeridian: false});
        $('#date-3, #date-4,#date-5').datepicker();
        $("#setData").validate({
            rules: {input1: {required: true},
                input2: {required: true},
                input3: {required: true},
                input5: {required: true},
                
            },
            messages: {
                input1: {required: "Please select City.", },
                input2: {required: "Please select Appointment For!", },
                input3: {required: "Please select MI!", },
                input5: {required: "Please select Appointment Type!", },
                
            }
        });
        if ($("#input5").val() == "0")
        {
            $("#setData").validate({
                rules: {
                    input10: {required: true},
                    input12: {required: true},
                    input13: {required: true},
                    input6: {required: true},
                    input4: {required: true,
                    remote: {
                    url: url + 'index.php/docappointment/check_timeslot',
                    type: "post",
                    data: {
                        timeslot_id: function () {var timeSlot = $("#timeSlot").val().split(',');return timeSlot[0];},
                        final_timing: function () {return $("#timepicker4").val();},
                    }
                }},
                    input34: {required: true,
                    },
                },
                messages: {
                    input10: {required: "Please select Speciality!", },
                    input12: {required: "Please select Doctor!", },
                    input13: {required: "Please enter Patient Remarks!", },
                    input6: {required: "Please select Date!", },
                    input4: {required: "Please select Time Slot!", },
                    input34: {required: "Please select Time Slot!", }
                }
            });

        } else
        {
            var tottest = $("#total_test").val();

            $("#setData").validate({
                rules: {
                    input7: {required: true},
                    input37: {required: true},
                },
                messages: {
                    input7: {required: "Please select Date!", },
                    input37: {required: "Please select Final Time!", },
                }
            });

            for (var j = 1; j <= tottest; j++) {


                $("#setData").validate({
                    rules: {
                        input28_j: {required: true},
                        input29_j: {required: true},
                        input30_j: {required: true},
                        input31_j: {required: true},
                    },
                    messages: {
                        input28_j: {required: "Please select Diagnostic Type " + j + "!", },
                        input29_j: {required: "Please enter Test Name " + j + "!", },
                        input30_j: {required: "Please enter Price " + j + "!", },
                        input31_j: {required: "Please enter Instruction" + j + "!", },
                    }
                });


            }
        }

        $("#setData").validate({
            rules: {
                input14: {required: true},
                input15: {required: true},
                input17: {required: true},
                input18: {required: true},
                input19: {required: true},
                input20: {required: true},
                input21: {required: true},
                input22: {required: true},
                input23: {required: true},
                input24: {required: true},
                input25: {required: true},
                input26: {required: true},
                input27: {required: true},
                input32: {required: true},
                input35: {required: true},
                input36: {required: true},
            },
            messages: {
                input14: {required: "Please enter Patient Email!"},
                input15: {required: "Please enter Mobile Number!"},
                input17: {required: "Please enter Name!"},
                input18: {required: "Please select Country!"},
                input19: {required: "Please select State!"},
                input20: {required: "Please enter Zip!"},
                input21: {required: "Please enter Address!"},
                input22: {required: "Please enter Consulation Fee!"},
                input23: {required: "Please enter Other Fee!"},
                input24: {required: "Please enter Tax!"},
                input25: {required: "Please enter Total Amount!"},
                input26: {required: "Please enter Payment Status !"},
                input27: {required: "Please select Payment Mode!"},
                input32: {required: "Please select City!"},
                input35: {required: "Please select DOB!"},
                input36: {required: "Please select Gender!"},
            }
        });


        $("#setData").submit(function (event) {

            if (!$("#setData").valid())
                return false;

            event.preventDefault();
            var url = '<?php echo site_url(); ?>/miappointment/addAppointmentSave/';
            var formData = new FormData(this);
             submitData(url, formData);
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

</script>