<style>
    span .error
    {
        font: bold;
    }
</style>
<script src="<?php echo base_url(); ?>assets/vendor/timepicker/bootstrap-timepicker.min.js"></script>
<script>

    $(document).ready(function () {
        $('.timepicker').timepicker({showMeridian:false});
        $("#timeForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/doctor/addDocTime/';
            var formData = new FormData(this);
            submitData(url, formData);
            return false;
        });

        hideMI();
        $("#div_psChamber").hide();
                $("#div_Mi_name").hide();
        $("#div_address").hide();



        $("#selectAllDay").click(function () {
            if ($("#selectAllDay").is(':checked')) {
                $("#docTimeDay_day > option").prop("selected", "selected");
                $("#docTimeDay_day").trigger("change");
            } else {
                $("#docTimeDay_day > option").removeAttr("selected");
                $("#docTimeDay_day").trigger("change");
            }
        });

        $(".docTimeTable_stayAt").click(function () {

        });

        $("#docTimeTable_MItype").change(function () {

            if ($("#docTimeTable_MItype").val() == "1") {
                $("#div_docTimeTable_HprofileId").toggle();
                $("#div_docTimeTable_DprofileId").hide();
                // $("#div_address").show();
            }
            else if ($("#docTimeTable_MItype").val() == "2") {
                $("#div_docTimeTable_DprofileId").toggle();
                $("#div_docTimeTable_HprofileId").hide();
                //$("#div_address").show();
            }
        });

        $("#docTimeTable_MIprofileId_h").change(function () {
            $("#div_address").show();
        });

        $("#docTimeTable_MIprofileId_d").change(function () {
            $("#div_address").show();
        });

        $("#docTimeTable_MIprofileId").change(function () {
            var proId = $("#docTimeTable_MIprofileId").val();

            if (proId == 0) {
                $("#div_docTimeTable_HprofileId").show();
            }
            else {

                $("#div_docTimeTable_DprofileId").show();
                $("#div_address").show();
            }
        });
    });

    function hideMI() {
        $("#div_docTimeTable_MItype").hide();
        $("#div_docTimeTable_HprofileId").hide();
        $("#div_docTimeTable_DprofileId").hide();
    }

    function placeDetail(stayAtVal) {
        if (stayAtVal == "1") {
            $("#div_docTimeTable_MItype").show();
            $("#div_psChamber").hide();
            $("#div_address").hide();

        }
        else if (stayAtVal == "0") {
            $("#div_psChamber").show();
            $('#timeCityId,#stateId,#timeCountryId').selectpicker('refresh');
            $("#addr,#pinn,#mi_lat,#mi_lng").removeAttr("readonly");
            $("#timeCityId,#stateId,#timeCountryId").prop("disabled", false);

            hideMI();
            $("#div_address").show();
            $("#Miname_div").hide();

        }
    }

    function getMIdetail(Id) {
        var subUrl = '';
        if ($("#docTimeTable_MItype").val() == "1") {
            subUrl = 'index.php/doctor/getHospitaldetail';
        }
        else
        {
            subUrl = 'index.php/doctor/getDiagnosticdetail';
        }

        var Id = Id;
        if (Id != '' && Id != 0) {
            $("#Miname_div").hide();
            $("#Miname").css("display", "none");
            $.ajax({
                url: urls + subUrl,
                type: 'POST',
                data: {'Id': Id},
                success: function (data) {
                    var obj = $.parseJSON(data);
                    console.log(obj);
                    if (obj.status == 1) {
                        $("#addr").val(obj.address);
                        $("#timeCountryId").html(obj.country);
                        $("#stateId").html(obj.state);
                        $("#timeCityId").html(obj.city);
                        $('#timeCityId,#stateId,#timeCountryId').selectpicker('refresh');

                        $("#pinn").val(obj.zipCode);
                        $("#mi_lat").val(obj.lat);
                        $("#mi_lng").val(obj.lng);
                        //$("#hospital_name").val(obj.hospital_name);

                        $("#isAddressDisabled").val(1);

                        //$("#addressDiv").css("display","none");
                        $("#addr,#pinn").attr("readonly", true);
                        $("#timeCityId,#stateId,#timeCountryId").prop("disabled", true);
                    } else {
                        $("#Miname").css("display", "block");
                        $("#addr").val('');
                        $("#timeCountryId").html();
                        $("#stateId").html();
                        $("#timeCityId").html();
                        $("#zip").val('');
                        $("#Miname").val('');
                        $("#isAddressDisabled").val(0);

                        $('#timeCityId,#stateId,#timeCountryId').selectpicker('refresh');
                        $("#addr,#pinn,#mi_lat,#mi_lng").removeAttr("readonly");
                        $("#timeCityId,#stateId,#timeCountryId").prop("disabled", false);
                    }
                }
            });
        } else if (Id == 0) {
            $("#Miname_div").show();
            $("#Miname").css("display", "block");
            $("#timeCityId,#stateId,#timeCountryId").prop("disabled", false);
            $("#addr").val('');
            $("#timeCountryId").html();
            $("#timeCountryId").val('');
            $("#stateId").html();
            $("#stateId").val('');
            $("#timeCityId").html();
            $("#timeCityId").val('');
            $("#pinn").val('');

            $('#timeCityId,#stateId,#timeCountryId').selectpicker('refresh');
            $("#Miname").val('');

            $("#isAddressDisabled").val(0);

            // $('#hospital_cityId,#hospital_stateId,#hospital_countryId').selectpicker('refresh');
            $("#addr,#pinn,#Miname").removeAttr("readonly");

        }
    }

    $('#timeForm :input').on('change', function () {
        var name = $(this).attr('name');
        var isInIT = name.indexOf("[]");
        if (isInIT == -1) {
            console.log(name, 'if');
            $('#err_' + name).html('');
        }
        else {
            name = name.replace('[]', '');
            $('#err_' + name).html('');
        }
    });

    function editTimeSloatView(docTimeTableId, doctorId, docTimeDayId, day) {
        $.ajax({
            url: urls + 'index.php/doctor/editDocTimeView',
            type: 'POST',
            data: {'docTimeTableId': docTimeTableId, 'doctorId': doctorId, 'docTimeDayId': docTimeDayId, 'day': day},
            beforeSend: function (xhr) {
                qyuraLoader.startLoader();
            },
            success: function (data) {
                var obj = $.parseJSON(data);
                $('#formDabba').html(obj.data);
                qyuraLoader.stopLoader();
            }
        });
    }

</script>