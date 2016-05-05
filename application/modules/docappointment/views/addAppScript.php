<script src="<?php echo base_url(); ?>assets/vendor/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendor/select2/select2.min.js" type="text/javascript"></script>


<script>
    function fetchCity(stateId, cityId, id) {
        $.ajax({
            url: '<?php echo site_url('docappointment/fetchCity'); ?>',
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
        
        var url = '<?php echo site_url(); ?>/docappointment/getMI';
        if (typeof city_id == 'string' && typeof appointment_type == 'string'){
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
                    $('#input5').prop('selectedIndex','');
                    $('#input5').selectpicker('refresh');
                    $('#speciallity').prop('selectedIndex','');
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
        var url = '<?php echo site_url(); ?>/docappointment/getpatient/';
        $.ajax({
            url: url,
            async: false,
            type: 'POST',
            data: {'patient_email': patient_email},
            beforeSend: function (xhr) {
                $("#patient_email").addClass('loadinggif');
            },
            success: function (data) {
                $("#patient_email").removeClass('loadinggif');
                if(data && data != 0){
                    var data = JSON.parse(data);
                    if(data.email_status != 1){
                        console.log(data.mobile);
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
                    }else{
                        $('#user_id').val(data.id);
                        $('#email_status').val(data.email_status);
                    }
                }else{
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
                    $('#user_id').val('');
                    
                    $('#input25').html('');
                    $('#input25').selectpicker('refresh');
                    $('#familyDiv').hide();
                    $('#familyListDiv').hide();
                    $("#p_unqId").hide();
                }
            }
        });
    }
    
    function getTimeSlot(){
        
        var doc_id = $("#input3").val();
        var date = $("#date-3").val();
        var url = '<?php echo site_url(); ?>/docappointment/appoint_timeSlot';
        if (typeof doc_id == 'string' && typeof date == 'string'){
            $.ajax({
                url: url,
                async: false,
                type: 'POST',
                data: {'doc_id': doc_id,'date': date},
                beforeSend: function (xhr) {
                    $("#timeSlot").addClass('loadinggif');
                },
                success: function (data) {
                    console.log(data);
                    $('#timeSlot').html(data);
                    $('#timeSlot').selectpicker('refresh');
                    $("#timeSlot").removeClass('loadinggif');
                    $('#input5').prop('selectedIndex','');
                    $('#input5').selectpicker('refresh');
                }
            });
        }
    }
    
    function findDoc(){
        var city_id = $("#appointment_city").val();
        var special_id = $('#speciallity').val();
        var url = '<?php echo site_url(); ?>/docappointment/find_doctor';
        if (typeof city_id == 'string' && typeof special_id == 'string' && special_id != ''){
            $.ajax({
                url: url,
                async: false,
                type: 'POST',
                data: {'city_id': city_id,'special_id':special_id},
                beforeSend: function (xhr) {},
                success: function (data) {
                    $('#input3').html(data);
                    $('#input3').selectpicker('refresh');
                    $("#input3").removeClass('loadinggif');
                    $('#input5').prop('selectedIndex','');
                    $('#input5').selectpicker('refresh');
                }
            });
        }
    }
    
    function calculateamount(){
        
        var con_fee = parseInt($('#input18').val());
        var oth_fee = parseInt($('#input19').val());
        var tax = parseInt($('#input20').val());
        var amount = con_fee + oth_fee;
        
        var tax_amount = (amount/parseInt(100))*tax;
        var total_amount = amount + tax_amount; 
        
        if(total_amount){
            $("#input21").val(total_amount);
        }else if(!amount){
            $("#input21").val(con_fee);
        }else if(amount){
            $("#input21").val(amount);
        }else{
            $("#input21").val('');
        }
    }
    
    function check_time(){
        var url = '<?php echo site_url(); ?>/docappointment/check_timeslot/';
        var final_timing = $("#timepicker4").val();
        var timeslot_id = $("#timeSlot").val();
        var resultAjax = false;
        $.ajax({
            url: url,
            async: false,
            type: 'POST',
            data: {'timeslot_id' : timeslot_id,'final_timing': final_timing},
            beforeSend: function (xhr) {
                $("#input25").addClass('loadinggif');
            },
            success: function (data) {
                if(data == 1){
                    $("#err_timepicker4").hide();
                    resultAjax = true;
                }else{
                    $("#err_timepicker4").show();
                    resultAjax = false;
                }
            }
        });
        return resultAjax;
    }
    
    function getMember(obj){
        if(obj == 1){
            var user_id = $("#user_id").val();
            if(user_id != ''){
                var url = '<?php echo site_url(); ?>/docappointment/getMember/';
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
                        $('#input25').html(data);
                        $('#input25').selectpicker('refresh');
                    }
                });
            }
        }else{
            $('#familyListDiv').hide();
            $('#input25').html('');
            $('#input25').selectpicker('refresh');
        }
    }
    
    $('#date-3, #date-4').datepicker({autoclose: true});
    $('.timepicker').timepicker({showMeridian:false});
    $(document).ready(function () {
        $("#setData").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/docappointment/addAppointmentSave/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
    });
    $(".select2").select2({
        width: '100%'
    });

    $(".bs-select").select2({
        placeholder: "Select a Speciality",
        //allowClear: true,
        tags: true
    });
</script>