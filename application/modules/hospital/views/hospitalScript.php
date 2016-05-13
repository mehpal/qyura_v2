<style type="text/css">
    #hospital_datatable_filter
    {
        display:none;
    }
    .pointer:hover {
        cursor:pointer;
    }
</style>


<?php
$check = 0;
if (isset($hospitalId) && !empty($hospitalId)) {
    $check = $hospitalId;
}
?>
<script src="<?php echo base_url(); ?>assets/ui_1.11.4_jquery-ui.js"></script>
<link href="<?php echo base_url(); ?>assets/cropper/cropper.min.css" rel="stylesheet">
<!--<link href="<?php // echo base_url();  ?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />-->
<link href="<?php echo base_url(); ?>assets/cropper/main.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendor/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/cropper/cropper.js"></script>

<?php
//$current = $this->router->fetch_method();
//if ($current != 'detailHospital'):
    ?>
    <script src="<?php echo base_url(); ?>assets/cropper/main.js"></script>
<?php //else: ?>
    <!--    <script src="<?php echo base_url(); ?>assets/cropper/main2.js"></script>-->
    <script src="<?php echo base_url(); ?>assets/cropper/common_cropper.js"></script>


<?php //endif; ?>


<script src="<?php echo base_url(); ?>assets/js/reCopy.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/addHospital.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/hospital-detail.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/x-editable/jquery.xeditable.js"></script>
<!--<script src="<?php echo base_url(); ?>assets/js/angular.min.js"> </script>-->

<script src="<?php echo base_url(); ?>assets/vendor/select2/select2.min.js" type="text/javascript"></script>  

<script src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/common_js.js"></script>


<script src="<?php echo base_url(); ?>assets/vendor/timepicker/bootstrap-timepicker.js"></script>

<script src="<?php echo base_url(); ?>assets/js/pages/add-doctor.js" type="text/javascript"></script>


<?php
if (isset($mapData) && !empty($mapData)) {
    $lat = $mapData[0]->hospital_lat;
    $lang = $mapData[0]->hospital_long;
    $imgUrl = (!empty($mapData[0]->ambulance_img)) ? base_url() . '/assets/hospitalsImages/thumb/thumb_50/' . $mapData[0]->hospital_img : base_url() . '/assets/images/pins/Contact.png';

    $templates = '<img src="' . $imgUrl . '" /><h2 class="text-success">' . ucwords($mapData[0]->hospital_name) . '</h2><b>' . $mapData[0]->hospital_address . '</b>';
    ?>

    <script>

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 18,
            center: new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lang; ?>),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var infowindow = new google.maps.InfoWindow();
        var marker, i;
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lang; ?>),
            map: map,
            icon: '<?php echo base_url(); ?>assets/images/pins/q2.png'
        });

        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                infowindow.setContent('<?php echo $templates; ?>');
                infowindow.open(map, marker);
            }
        })(marker, i));

    </script>
<?php } ?>
<script>
    
    
    
    

    if (Modernizr.touch) {
            // show the close overlay button
            $(".close-overlay").removeClass("hidden");
            // handle the adding of hover class when clicked
            $(".img").click(function(e){
                if (!$(this).hasClass("hover")) {
                    $(this).addClass("hover");
                }
            });
            // handle the closing of the overlay
            $(".close-overlay").click(function(e){
                e.preventDefault();
                e.stopPropagation();
                if ($(this).closest(".img").hasClass("hover")) {
                    $(this).closest(".img").removeClass("hover");
                }
            });
        } else {
            // handle the mouseenter functionality
            $(".img").mouseenter(function(){
                $(this).addClass("hover");
            })
            // handle the mouseleave functionality
            .mouseleave(function(){
                $(this).removeClass("hover");
            });
        };
        
    function checkValidFileUploads(urls) {

        var avatar_file = $(".avatar-data").val();
        $.ajax({
            url: urls + 'index.php/hospital/checkFileUploadValidation',
            type: 'POST',
            data: {'avatar_file': avatar_file},
            success: function (data) {
                var obj = $.parseJSON(data);

                if (obj.state == 400) {
                    $("#message_upload").html("<div class='alert alert-danger'>" + obj.message + "</div>");
                    $(".close").hide();
                } else {
                    $("#avatar-modal").modal('hide');
                    $("#message_upload").html("");
                }
            }
        });
    }


    function deletInsurance(insuranceId) {
        var insuranceId = insuranceId;
        bootbox.confirm("Are you sure want to remove this insurance?", function (result) {
            if (result) {
                $.ajax({
                    url: urls + 'index.php/hospital/deletInsurance',
                    type: 'POST',
                    datatype: 'json',
                    data: {'insuranceId': insuranceId},
                    success: function (data, status, xhr) {
                        var obj = JSON.parse(data);
                        if (obj.status == 1) {
                            window.location.reload();
                            return true;
                        } else if (obj.status == 0) {
                            return false;
                        }
                    }
                });
            }

        });
    }


    function setSpecialityNameFormate(specialityFormate) {
        var hospitalId = <?php echo $check; ?>;
        if (hospitalId != '') {
            var specialityFormate = specialityFormate;
            $.ajax({
                url: urls + 'index.php/hospital/setSpecialityNameFormate',
                type: 'POST',
                data: {'hospitalId': hospitalId, 'specialityFormate': specialityFormate},
                success: function (data) {
                    if (data) {
                        // $('#users_email').addClass('bdr-error');
                        return false;
                    } else {

                        return true;
                    }
                }
            });
        }
    }

    function checkUserExistence(email) {
        var email = email;
        if (email != '') {
            $.ajax({
                url: urls + 'index.php/hospital/checkUserExistence',
                type: 'POST',
                datatype: 'json',
                data: {'emailId': email},
                success: function (data, status, xhr) {
                    var obj = JSON.parse(data);
                    if (obj.status == 0) {
                        $('#users_email').addClass('bdr-error');
                        $('#error-users_email_check').fadeIn().delay(3000).fadeOut('slow');
                        return false;
                    } else if (obj.status == 1) {

                        return true;
                    }
                }
            });
        }
    }

    // $(".selectpicker").select2();

    function IsAdrManual(val) {
        if (val == 1) {
            $("#lat,#lng").removeAttr('readonly')
        } else if (val == 0) {
            $("#lat,#lng").attr('readonly', 'readonly');
        }

    }

    var hospitalId = <?php echo $check; ?>


    $("#edit").click(function () {
        $("#detail").toggle();
        $("#newDetail").toggle();
    });
</script>
<script>
    /*-- Selectpicker --*/
    $('.selectpicker').selectpicker({
        style: 'btn-default',
        size: "auto",
        width: "100%"
    });

    var urls = "<?php echo base_url() ?>";
    var j = 1;
    var k = 1;
    var l = 1;
    var n = 1;
    var m = 1;
    var p = 1;
    var stateIds = $.trim($('#StateId').val());

    function fetchCity(stateId) {
        $.ajax({
            url: urls + 'index.php/hospital/fetchCity',
            type: 'POST',
            data: {'stateId': stateId},
            success: function (datas) {
                $('#hospital_cityId').html(datas);
                $('#hospital_cityId').selectpicker('refresh');
            }
        });

    }

    function fetchState(countryId) {
        $.ajax({
            url: urls + 'index.php/hospital/fetchState',
            type: 'POST',
            data: {'countryId': countryId},
            success: function (datas) {
                $('#hospital_stateId').html(datas);
                $('#hospital_stateId').selectpicker('refresh');
            }
        });

    }
    
    // datatable get records
    $(function () {
        //new CropAvatar($('#blood-crop-avatar'));
        $(".hospital_edit").click(function () {

            $(".logo-img").toggle();
            $(".logo-up").toggle();
            $(".picEdit").toggle();
            $(".picEditClose").toggle();
        });

    });
    
    
       $(".ambulance_edit").click(function () {
           
            $(".logo-img-ambulance").toggle();
            $(".logo-up-ambulance").toggle();
            $(".picEdit-ambulance").toggle();
            $(".picEditClose-ambulance").toggle();
        });
        
         $(".bloodbank_edit").click(function () {
           
            $(".logo-img-bloodbank").toggle();
            $(".logo-up-bloodbank").toggle();
            $(".picEdit-bloodbank").toggle();
            $(".picEditClose-bloodbank").toggle();
        });
    
    
    $(".doctor_edit").click(function () {
           
            $(".logo-img-doctor").toggle();
            $(".logo-up-doctor").toggle();
            $(".picEdit-doctor").toggle();
            $(".picEditClose-doctor").toggle();
        });
    

    
    
    $(document).ready(function () {
        var oTable = $('#hospital_datatable').DataTable({
            "processing": true,
            "bServerSide": true,
            "columnDefs": [{
                    "targets": [0, 1, 2, 3, 4, 5],
                    "orderable": false
                }],
            // "searching": true,
            "bLengthChange": false,
            "bProcessing": true,
            "iDisplayLength": 10,
            "bPaginate": true,
            "sPaginationType": "full_numbers",
            "columns": [
                {"data": "hospital_img", "searchable": false, "order": false, orderable: false, width: "8%"},
                {"data": "hospital_name", "searchable": false, "order": false},
                {"data": "city_name"},
                {"data": "hospital_phn"},
                {"data": "hospital_address"},
                {"data": "status", "searchable": true},
                {"data": "view", "searchable": false, "order": false, orderable: false, width: "8%"},
            ],
            "ajax": {
                "url": "<?php echo site_url('hospital/getHospitalDl'); ?>",
                "type": "POST",
                "data": function (d) {
                    d.cityId = $("#hospital_cityId").val();
                    d.name = $("#search").val();
                    d.hosStateId = $("#hospital_stateId").val();
                    d.status = $("#status").val();
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                }
            }
        });

        $('#hospital_cityId,#status').change(function () {
            oTable.draw();
        });
        $('#search').on('keyup', function () {
            oTable.draw();
            //oTable.search($(this).val()).draw();

        });



        loadAwards();
        loadServices();
        
      //  var pharmacy_status = '';
     //   pharmacy_status = $.trim($('#pharmacy_status').val());
     //   var bloodbank_status = '';
    //    bloodbank_status = $.trim($('#bloodbank_status').val());
        
     //   if (bloodbank_status != '')
      //      $("#bloodbankbtn").trigger("click");
   //     if (pharmacy_status != '')
      //      $("#pharmacybtn").trigger("click");
    //    var ambulance_status = '';
   //     ambulance_status = $.trim($('#ambulance_status').val());
     //   if (ambulance_status != '')
   //         $("#ambulancebtn").trigger("click");

        loadSpeciality();
        loadDiagonastic();
        $("#edit").click(function () {
            $("#detail").toggle();
            $("#newDetail").toggle();
        });
        $("#editdetail").click(function () {
            $("#detail").toggle();
            $("#newDetail").toggle();
        });
    });


    /**
     * @project Qyura
     * @description  datatable listing
     * @access public
     */
    var oTableDr = $('#hospital_doctors').DataTable({
        "processing": true,
        "bServerSide": true,
        "columnDefs": [{
                "targets": [0, 1, 2, 3, 4, 5, 6],
                "orderable": false
            }],
        "searching": false,
        "bLengthChange": false,
        "bProcessing": true,
        "iDisplayLength": 10,
        "sPaginationType": "full_numbers",
        "columns": [
            {"data": "doctors_img"},
            {"data": "name"},
            {"data": "specialityName"},
            {"data": "consFee"},
            {"data": "exp"},
            {"data": "doctors_phon"},
            {"data": "view"},
            {"data": "status"},
        ],
        "ajax": {
            "url": urls + 'index.php/hospital/getHospitalDoctorsDl/' + hospitalId,
            "type": "POST",
            "data": function (d) {
                d.doctor_search = $("#search").val();
                d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
            }
        }
    });

    $('#search').on('keyup', function () {
        oTableDr.columns(5).search($(this).val()).draw();
        // oTableDr.search($(this).val()).draw();
        // oTableDr.draw();

    });


    function addDiagnostic() {

        $('.diagonasticCheck').each(function () {

            if ($(this).is(':checked')) {
                $(this).removeClass("diagonasticCheck diagonasticCheck1");
                $.ajax({
                    url: urls + 'index.php/hospital/addDiagnostic',
                    type: 'POST',
                    async: false,
                    data: {'hospitalId': hospitalId, 'hospitalDiagnosticsCat_diagnosticsCatId': $(this).val()},
                    success: function (datas) {

                        loadDiagonastic();

                    }
                });
            }

        });
    }

    function revertDiagnostic() {
        $('.diagonasticAllocCheck').each(function () {
            if ($(this).is(':checked')) {
                $.ajax({
                    url: urls + 'index.php/hospital/revertDiagnostic',
                    type: 'POST',
                    data: {'hospitalId': hospitalId, 'hospitalDiagnosticsCat_id': $(this).val()},
                    success: function (datas) {

                        loadDiagonastic();
                    }
                });
            }

        });
    }
    function showDiagonasticDetail(hospitalId, categoryId) {
        $.ajax({
            url: urls + 'index.php/hospital/detailDiagnostic',
            type: 'POST',
            data: {'hospitalId': hospitalId, 'categoryId': categoryId},
            success: function (datas) {

                $('#loadTestDetail').html(datas);
            }
        });
    }

    function fetchInstruction(digTestId) {
        $.ajax({
            url: urls + 'index.php/hospital/detailDiagnosticInstruction',
            type: 'POST',
            data: {'quotationDetailTests_id': digTestId},
            success: function (datas) {

                $('#detailInstruction').html(datas);
                $('#detailsAll').val(datas);
                $('#instructionId').val(digTestId);
            }
        });
    }
    function loadDiagonastic() {
        $('#list1').load(urls + 'index.php/hospital/hospitalDiagnostics/' + hospitalId, function () {
            // alert('callback function implementation');
        });

        $('#list').load(urls + 'index.php/hospital/hospitalFetchDiagnostics/' + hospitalId, function () {
            // alert('callback function implementation');
        });
        $('#loadTestDetail').html('');

    }
    function sendSpeciality(hospitalUserId) {
        var specialityId = [];
        var checkValues = [];

        var checkValues = $('.myCheckbox:input:checkbox:checked').map(function () {
            return this.value;
        }).get();

        // alert(checkValues.length);
        if (checkValues.length > 1) {
            var reYesNo = true;
            $.ajax({
                url: urls + 'index.php/hospital/checkSpeciality',
                type: 'POST',
                async: false, //=>>>>>>>>>>> here >>>>>>>>>>>
                data: {'hospitalId': hospitalId, 'hospitalUserId' : hospitalUserId, 'allValuers': checkValues},
                success: function (datas) {
                    if (datas == 0) {
                        reYesNo = false;
                        //  console.log(reYesNo,'andar');
                        bootbox.alert("Sorry, you can't add more than given specialities!");

                    }
                }
            });

            //  console.log(reYesNo,'bahar');
            if (!reYesNo)
                return false;

        }


        $('.specialityCheck').each(function () {

            if ($(this).is(':checked')) {
                $(this).removeClass("specialityCheck specialityCheck1");
                $.ajax({
                    url: urls + 'index.php/hospital/addSpeciality',
                    type: 'POST',
                    // async: true, //blocks window close
                    data: {'hospitalId': hospitalId, 'hospitalUserId' : hospitalUserId,  'hospitalSpecialities_specialitiesId': $(this).val()},
                    success: function (datas) {
                        if (datas == 0) {
                            bootbox.alert("Sorry, you can't add more than given specialities!");
                            return false;

                        } else {
                            loadSpeciality();
                        }
                    }
                });
            }

        });
    }

    function revertSpeciality() {
        $('.specialityAllocCheck').each(function () {
            if ($(this).is(':checked')) {
                //alert($(this).val());
                $.ajax({
                    url: urls + 'index.php/hospital/revertSpeciality',
                    type: 'POST',
                    data: {'hospitalId': hospitalId, 'hospitalSpecialities_id': $(this).val()},
                    success: function (datas) {

                        loadSpeciality();
                    }
                });
            }

        });
    }


    function loadSpeciality() {

        $('#list2').load(urls + 'index.php/hospital/hospitalSpecialities/' + hospitalId, function () {
            // alert('callback function implementation');
        });
        $('#list3').load(urls + 'index.php/hospital/hospitalAllocatedSpecialities/' + hospitalId, function () {


            $("#list3").sortable({
                stop: function (e, ui) {
                    var obj = {};
                    $.map($(this).find('li'), function (el) {
                        obj[el.id] = $(el).index();
                    });
                    var order = $(this).sortable('serialize');
                    //alert(order);
                    //console.log(obj);
                    var url = "<?php echo site_url('hospital/hospitalSpecialitiesOrder') ?>";
                    $.ajax({type: "POST", async: false, url: url, data: obj, beforeSend: function (xhr) {
                            qyuraLoader.startLoader();
                        }, success: function (data) {
                            qyuraLoader.stopLoader();
                        }});
                }
            });

        });

    }

    function addAwards() {
        var check = /^[a-zA-Z\s]+$/;
        var hospitalAwards_awardsName = $.trim($('#hospitalAwards_awardsName').val());
        var hospitalAwards_agencyName = $.trim($('#hospitalAwards_agencyName').val());
        var hospital_awardsyear = $.trim($('#hospital_awardsyear').val());
        var currentYear = new Date().getFullYear();

        if (hospitalAwards_awardsName == '') {
            if (!check.test(hospitalAwards_awardsName)) {
                $('#error-awards').fadeIn().delay(3000).fadeOut('slow');
            }
        } else if (hospitalAwards_agencyName == '') {
            if (!check.test(hospitalAwards_agencyName)) {
                $('#error-hospitalAwards_agencyName').fadeIn().delay(3000).fadeOut('slow');
            }

        } else if (hospital_awardsyear == '') {

            $('#error-years').fadeIn().delay(3000).fadeOut('slow');

        } else if (hospital_awardsyear.length != 4) {
            $('#error-years').fadeIn().delay(3000).fadeOut('slow');
        } else if (hospital_awardsyear > currentYear || hospital_awardsyear < 1920) {

            $('#hospital_awardsyear').val('');
            $("#error-years-valid").fadeIn().delay(3000).fadeOut('slow');

        } else {
            $.ajax({
                url: urls + 'index.php/hospital/addHospitalAwards',
                type: 'POST',
                data: {'hospitalId': hospitalId, 'hospitalAwards_awardsName': hospitalAwards_awardsName, 'hospitalAwards_awardYear': hospital_awardsyear, 'hospitalAwards_agencyName': hospitalAwards_agencyName},
                success: function (datas) {
                    // console.log(datas);
                    loadAwards();
                    $('#hospitalAwards_awardsName').val('');
                    $('#hospital_awardsyear').val('');

                    $('#error-awards').fadeOut().delay(3).fadeOut('slow');
                    $('#error-years').fadeOut().delay(3).fadeOut('slow');
                }
            });
        }
    }
    function editAwards(awardsId) {
        var edit_awardsName = $.trim($('#' + awardsId).val());
        var edit_awardsAgency = $.trim($('#agency' + awardsId).val());
        var edit_awardsYear = $.trim($('#year' + awardsId).val());

        if (edit_awardsName == '') {

            $('#error-awards' + awardsId).fadeIn().delay(3000).fadeOut('slow');

        } else if (edit_awardsAgency == '') {

            $('#error-agency' + awardsId).fadeIn().delay(3000).fadeOut('slow');

        } else if (edit_awardsYear == '') {

            $('#error-years' + awardsId).fadeIn().delay(3000).fadeOut('slow');

        } else if (edit_awardsYear.length != 4) {

            $('#error-years' + awardsId).fadeIn().delay(3000).fadeOut('slow');
        } else {
            $.ajax({
                url: urls + 'index.php/hospital/editHospitalAwards',
                type: 'POST',
                data: {'awardsId': awardsId, 'hospitalAwards_awardsName': edit_awardsName, 'hospitalAwards_awardYear': edit_awardsYear, 'hospitalAwards_agencyName': edit_awardsAgency},
                success: function (datas) {
                    console.log(datas);
                    bootbox.alert("Award updated successfully!");
                    loadAwards();
                }
            });
        }
    }
    function deleteAwards(awardsId) {
        bootbox.confirm("Are you sure want to remove this award?", function (result) {
            if (result) {
                $.ajax({
                    url: urls + 'index.php/hospital/deleteHospitalAwards',
                    type: 'POST',
                    data: {'awardsId': awardsId},
                    success: function (datas) {
                        console.log(datas);
                        loadAwards();
                    }
                });
            }
        });
    }
    function loadAwards() {

        $('#loadAwards').load(urls + 'index.php/hospital/hospitalAwards/' + hospitalId, function () {
            // alert('callback function ');
        });
        $('#totalAwards').load(urls + 'index.php/hospital/detailAwards/' + hospitalId, function () {
            // alert('callback function implementation');
        });

    }
    function loadServices() {
        $('#loadServices').load(urls + 'index.php/hospital/hospitalServices/' + hospitalId, function (data) {
            //alert('callback function implementation');

        });
        $('#totalServices').load(urls + 'index.php/hospital/detailServices/' + hospitalId, function () {
            //alert('callback function implementation');
        });
    }
    function addServices() {
        var hospitalServices_serviceName = $.trim($('#hospitalServices_serviceName').val());
        //alert(hospitalServices_serviceName);
        if (hospitalServices_serviceName != '') {

            $.ajax({
                url: urls + 'index.php/hospital/addHospitalService',
                type: 'POST',
                data: {'hospitalId': hospitalId, 'hospitalServices_serviceName': hospitalServices_serviceName},
                success: function (datas) {
                    // console.log(datas);
                    loadServices();
                    $('#hospitalServices_serviceName').val('');
                }
            });
        }
    }

    function editServices(serviceId) {
        var edit_serviceName = $.trim($('#' + serviceId).val());

        if (edit_serviceName != '') {

            $.ajax({
                url: urls + 'index.php/hospital/editHospitalService',
                type: 'POST',
                data: {'serviceId': serviceId, 'hospitalServices_serviceName': edit_serviceName},
                success: function (datas) {
                    console.log(datas);
                    bootbox.alert("Service updated successfully!");
                    loadServices();
                }
            });
        }
    }

    function deleteServices(serviceId) {
        bootbox.confirm("Are you sure want to remove this service?", function (result) {
            if (result) {
                $.ajax({
                    url: urls + 'index.php/hospital/deleteHospitalService',
                    type: 'POST',
                    data: {'serviceId': serviceId},
                    success: function (datas) {
                        console.log(datas);
                        loadServices();
                    }
                });
            }
        });
    }
    $('#date-3').datepicker();

    $(function () {
        $("#geocomplete").geocomplete({
            map: ".map_canvas",
            details: "form",
            types: ["geocode", "establishment"],
        });

        $("#find").click(function () {
            $("#geocomplete").trigger("geocode");
        });
    });
    /*-- Selectpicker --*/
    $('.selectpicker').selectpicker({
        style: 'btn-default',
        size: "auto",
        width: "100%"
    });


    function fetchCityList(stateId) {
        $.ajax({
            url: urls + 'index.php/hospital/fetchCity',
            type: 'POST',
            data: {'stateId': stateId},
            success: function (datas) {
                $('#hospital_cityId').html(datas);
                $('#hospital_cityId').selectpicker('refresh');

            }
        });


    }

    function countPhoneNumber() {
        if (j == 10)
            return false;
        j = parseInt(j) + parseInt(1);
        $('#countPnone').val(j);

        $("#multuple_phone_load").append('<aside class=row id=phone_list' + j + '><div class=col-lg-3 col-md-4 col-sm-3 col-sm-4 col-xs-12 m-t-xs-10 id=multiPreNumber' + j + '><select class="selectpicker" data-width=100% name=pre_number[] id=multiPreNumber' + j + '><option value ="91">+91</option></select></div><div class=col-lg-7 col-md-6 col-sm-7 col-xs-10 m-t-xs-10 id=multiPhoneNumber><input type=text class=form-control name=hospital_phn[] id=hospital_phn' + j + ' placeholder=9837000123 maxlength=10 onkeypress= "return isNumberKey(event)" /><label class=error style=display:none; id=error-hospital_phn' + j + '> please enter a valid phone number</label><label class=error ><?php echo form_error('diagnostic_phn1'); ?></label></div><div class="col-md-2 col-sm-2 col-xs-2 m-t-xs-10 text-right"><a href=javascript:void(0) onclick="removePhoneNumber(' + j + ')"><i class="fa fa-minus-circle fa-2x m-t-5 label-plus"></i></a></div></aside>');


        $('.selectpicker').selectpicker('refresh');




//      $('#multiPhoneNumber').append('<input type=text class=form-control name=hospital_phn[] placeholder=9837000123 maxlength="10" id=hospital_phn'+j + ' />');
//     $('#multiPreNumber').append('<select class=selectpicker data-width=100% name=pre_number[] id=multiPreNumber'+j+'><option value=91>+91</option><option value=1>+1</option></select>');
//      $('#multiPreNumber'+j).selectpicker('refresh');
        //.append('<div class=col-lg-3 col-md-4 col-sm-3 col-sm-4 col-xs-12 m-t-xs-10 id=multiPreNumber><select class=selectpicker data-width=100% name=pre_number[] id=multiPreNumber><option value =91>+91</option><option value =1>+1</option></select></div><div class=col-lg-7 col-md-6 col-sm-7 col-xs-10 m-t-xs-10 id=multiPhoneNumber><nput type=text class="form-control" name=hospital_phn[] id=hospital_phn1 placeholder=9837000123 maxlength=10 /> </div>');

    }

    function removePhoneNumber(i) {
        $("#phone_list" + i).remove();
    }

    function countBloodPhoneNumber() {
        if (k == 10)
            return false;
        k = parseInt(k) + parseInt(1);
        $('#countbloodBank_phn').val(k);
        $('#multiBloodbnkPhoneNumber').append('<input type=text class=form-control name=bloodBank_phn[] placeholder=9837000123 maxlength="10" id=bloodBank_phn' + k + ' />');
        $('#multiBloodbnkPreNumber').append('<select class=selectpicker data-width=100% name=preblbankNo[] id=preblbankNo' + k + '><option value=91>+91</option><option value=1>+1</option></select>');
        $('#preblbankNo' + k).selectpicker('refresh');

    }

    function countPharmacyPhoneNumber() {
        if (l == 10)
            return false;
        l = parseInt(l) + parseInt(1);
        $('#countPharmacy_phn').val(l);
        $('#multipharmacyNumber').append('<input type=text class=form-control name=pharmacy_phn[] placeholder=9837000123 maxlength="10" id=pharmacy_phn' + l + ' />');
        $('#multipharmacyPreNumber').append('<select class=selectpicker data-width=100% name=prePharmacy[] id=prePharmacy' + l + '><option value=91>+91</option><option value=1>+1</option></select>');
        $('#prePharmacy' + l).selectpicker('refresh');
    }

    function countAmbulancePhoneNumber() {
        if (n == 10)
            return false;
        n = parseInt(n) + parseInt(1);
        $('#countAmbulance_phn').val(n);
        $('#phoneAmbulance').append('<input type=text class=form-control name=ambulance_phn[] placeholder=9837000123 maxlength="10" id=ambulance_phn' + n + ' /> ');
        $('#preAmbulance_name').append('<select class=selectpicker data-width=100% name=preAmbulance[] id=preAmbulance' + n + '><option value=91>+91</option><option value=1>+1</option></select> ');
        $('#preAmbulance' + n).selectpicker('refresh');
    }

    function countserviceName() {
        if (m == 50)
            return false;
        m = parseInt(m) + parseInt(1);
        $('#serviceName').val(m);
        $('#multiserviceName').append('<article id=hospitalServices_serviceName' + m + ' class="clearfix m-t-10"><aside class="col-sm-10"><input type=text class=form-control name=hospitalServices_serviceName[] placeholder="" maxlength="30" /></aside><aside class="col-sm-2 text-right"><a class=add pull-right onclick="removeServiceName(' + m + ')" href=javascript:void(0) id=btn-service' + m + '><i class="fa fa-minus-circle fa-2x m-t-5 label-plus" ></i></a></aside></article>');
    }

    function removeServiceName(i) {
        $("#hospitalServices_serviceName" + i).remove();
        $("#btn-service" + i).remove();
    }

    function bbname() {
        var bbankname = $('#bloodBank_name').val();
        var check = /^[a-zA-Z\s]+$/;
        if (!check.test(bbankname)) {
            $('#bloodBank_name').addClass('bdr-error');
            $('#error-bloodBank_name').fadeIn().delay(3000).fadeOut('slow');
            
            $('#bloodBank_name').val('');
            
             setTimeout(function(){
                $("#bloodBank_name").removeClass('bdr-error');
                }, 3000);
        }
    }
    function bbphone() {
        var bbphcheck = /^[0-9]+$/;
        var bbankphone = $.trim($('#bloodBank_phn1').val());
        if (!$.isNumeric(bbankphone)) {

            $('#bloodBank_phn1').addClass('bdr-error');
            $('#error-bloodBank_phone').fadeIn().delay(3000).fadeOut('slow');
            
            setTimeout(function(){
                $("#bloodBank_phn1").removeClass('bdr-error');
                }, 3000);
            // $('bloodBank_name').focus();
        }
    }
    function phname() {
        var pharname = $.trim($('#pharmacy_name').val());
        var check = /^[a-zA-Z\s]+$/;
        if (!check.test(pharname)) {
            $('#pharmacy_name').addClass('bdr-error');
            $('#error-pharmacy_name').fadeIn().delay(3000).fadeOut('slow');
            $('#pharmacy_name').val('');
            
        }
    }
    function phphone() {
        var pharname = $.trim($('#pharmacy_phn1').val());
        var phphonecheck = /^[0-9]+$/;
        if (!$.isNumeric(pharname)) {

            $('#pharmacy_phn1').addClass('bdr-error');
            $('#error-pharmacy_phn1').fadeIn().delay(3000).fadeOut('slow');
            // $('#hospital_zip').focus();
        }
    }
    function amname() {
        var amname = $.trim($('#ambulance_name').val());
        var check = /^[a-zA-Z\s]+$/;
        if (!check.test(amname)) {
            $('#ambulance_name').addClass('bdr-error');
            $('#error-ambulance_name').fadeIn().delay(3000).fadeOut('slow');
            $('#pharmacy_name').val('');
             setTimeout(function(){
                $("#ambulance_name").removeClass('bdr-error');
                }, 3000);
        }
    }
    function amphone() {
        var amname = $.trim($('#ambulance_phn1').val());
        var amphonecheck = /^[0-9]+$/;
        if (!$.isNumeric(amname)) {
            $('#ambulance_phn1').addClass('bdr-error');
            $('#error-ambulance_phn1').fadeIn().delay(3000).fadeOut('slow');
             setTimeout(function(){
                $("#ambulance_phn1").removeClass('bdr-error');
                }, 3000);
        }
    }
    
    
      function fadeInOption(){
          $('#bloodbankOption,#ambulanceOption').css("display", "none");
       }

    function changeStatus() {
        
        
        //$("form[name='hospitalForm']").submit();
            var isAddressDisabled = $('#isAddressDisabled').val();
            if (isAddressDisabled == 1) {
                $("#hospital_cityId,#hospital_stateId,#hospital_countryId").prop("disabled", false);
            }
            
         var status = 1;
         
         if ($('#bloodbank').is(":checked")) {
            if ($('#bloodBank_name').val() === '') {
                $('#bloodBank_name').addClass('bdr-error');
                $('#error-bloodBank_name').text('please Check your BloodBank name');
                $('#error-bloodBank_name').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){
                $("#bloodBank_name").removeClass('bdr-error');
                }, 3000);
                status = 0;
            }
            
            if ($('#bloodBank_phn1').val() === '') {
                $('#bloodBank_phone').addClass('bdr-error');
                $('#error-bloodBank_phone').text('please Check your BloodBank Phon No.');
                $('#error-bloodBank_phone').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){
                $("#bloodBank_phone").removeClass('bdr-error');
                }, 3000);
                status = 0;
            }
            
            if ($('#avatar_data_bloodbank').val() === '') {
                $('#error-avatar_data_bloodbank').text('Blood bank Image required');
                $('#error-avatar_data_bloodbank').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){
                $("#error-avatar_data_bloodbank").removeClass('bdr-error');
                }, 3000);
                status = 0;
            }
        }
        
         if ($('#ambulance').is(":checked")) {
            if ($('#ambulance_name').val() === '') {
                $('#ambulance_name').addClass('bdr-error');
                $('#error-ambulance_name').text('please Check your Ambulance name');
                $('#error-ambulance_name').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){
                $("#ambulance_name").removeClass('bdr-error');
                }, 3000);
                status = 0;
            }
            if ($('#ambulance_phn1').val() === '') {
                $('#ambulance_phn1').addClass('bdr-error');
                $('#error-ambulance_phn1').text('please Check your Ambulance number');
                $('#error-ambulance_phn1').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){
                $("#ambulance_phn1").removeClass('bdr-error');
                }, 3000);
                status = 0;
            }
            
            if ($('#avatar_data_ambulance').val() === '') {
                $('#error-avatar_data_ambulance').text('Ambulance image required');
                $('#error-avatar_data_ambulance').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){
                $("#error-avatar_data_ambulance").removeClass('bdr-error');
                }, 3000);
                status = 0;
            }
        }
        
        if (status == 0) {
            return false;
        }else{
            return true;
        }
    }
    
    
    
    function changeStatusUpdate() {

         var status = 1;
         
         if ($('#bloodbankbtn').is(":checked")) {
            if ($('#bloodBank_name').val() === '') {
                $('#bloodBank_name').addClass('bdr-error');
                $('#error-bloodBank_name').text('please Check your BloodBank name');
                $('#error-bloodBank_name').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){
                $("#bloodBank_name").removeClass('bdr-error');
                }, 3000);
                status = 0;
            }
            
            if ($('#bloodBank_phn').val() === '') {
                $('#bloodBank_phone').addClass('bdr-error');
                $('#error-bloodBank_phone').text('please Check your BloodBank Phon No.');
                $('#error-bloodBank_phone').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){
                $("#bloodBank_phone").removeClass('bdr-error');
                }, 3000);
                status = 0;
            }
          
        }
        
         if ($('#ambulancebtn').is(":checked")) {
            if ($('#ambulance_name').val() === '') {
                $('#ambulance_name').addClass('bdr-error');
                $('#error-ambulance_name').text('please Check your Ambulance name');
                $('#error-ambulance_name').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){
                $("#ambulance_name").removeClass('bdr-error');
                }, 3000);
                status = 0;
            }
            if ($('#ambulance_phn').val() === '') {
                $('#ambulance_phn').addClass('bdr-error');
                $('#error-ambulance_phn1').text('please Check your Ambulance number');
                $('#error-ambulance_phn1').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){
                $("#error-ambulance_phn1").removeClass('bdr-error');
                }, 3000);
                status = 0;
            }
        }
        
        if (status == 0) {
            return false;
        }else{
            return true;
        }
    }
 function validationHospital() {
        var check = /^[a-zA-Z\s]+$/;
        var numcheck = /^[0-9]+$/;
        var emails = $.trim($('#users_email').val());
        var cpname = $.trim($('#hospital_cntPrsn').val());
        var dsgn = $.trim($('#hospital_dsgn').val());
        var hsname = $.trim($('#hospitalServices_serviceName1').val());
        var pswd = $.trim($("#users_password").val());
        var cnfpswd = $.trim($("#cnfPassword").val());
        var mbl = $.trim($('#hospital_mblNo').val());
        var phn = $.trim($('#hospital_phn1').val());
        var myzip = $.trim($('#hospital_zip').val());
        var cityId = $.trim($('#hospital_cityId').val());
        var stateIds = $.trim($('#hospital_stateId').val());
        var hospital_mblNo = $.trim($('#hospital_mblNo').val());
        var aboutUs = $.trim($('#hospital_aboutUs').val());
        var status = 1;

        if ($('#hospital_name').val() == '') {
            $('#hospital_name').addClass('bdr-error');
            $('#error-hospital_name').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
            //return false;
            // $('#hospital_name').focus();
        }
        if ($('#hospital_type').val() == '') {
            $('#hospital_type').addClass('bdr-error');
            $('#error-hospital_type').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
            // $('#hospital_type').focus();
        }
        if ($.trim($('#hospital_countryId').val()) == '') {
            $('#hospital_countryId').addClass('bdr-error');
            $('#error-hospital_countryId').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
            // $('#hospital_countryId').focus();
        }
        if (stateIds === '') {
            // console.log("in state");
            $('#hospital_stateId').addClass('bdr-error');
            $('#error-hospital_stateId').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
            // $('#hospital_stateId').focus();
        }
        if (cityId === '') {
            $('#hospital_cityId').addClass('bdr-error');
            $('#error-hospital_cityId').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
            // $('#hospital_cityId').focus();
        }

        /*if(!$.isNumeric(myzip)){
         
         $('#hospital_zip').addClass('bdr-error');
         $('#error-hospital_zip').fadeIn().delay(3000).fadeOut('slow');
         status = 0;
         // $('#hospital_zip').focus();
         } */
        if (myzip.length < 6) {
            $('#hospital_zip').addClass('bdr-error');
            $('#error-hospital_zip_long').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
        }
        if ($("input[name='hospital_address']").val() == '') {
            $('#hospital_address').addClass('bdr-error');
            $('#error-hospital_address').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
            // $('#hospital_address').focus();
        }

        if (!$.isNumeric(phn)) {
            $('#hospital_phn').addClass('bdr-error');
            $('#error-hospital_phn').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
            // $('#hospital_phn').focus();
        }

        if (!check.test(hsname)) {
            $('#hospitalServices_serviceName1').addClass('bdr-error');
            $('#error-hospitalServices_serviceName').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
            // $('#hospitalServices_serviceName1').focus();
        }

        if (!check.test(cpname)) {
            $('#hospital_cntPrsn').addClass('bdr-error');
            $('#error-hospital_cntPrsn').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
            // $('#hospital_cntPrsn').focus();
        }
        if (!check.test(dsgn)) {
            $('#hospital_dsgn').addClass('bdr-error');
            $('#error-hospital_dsgn').fadeIn().delay(3000).fadeOut('slow');
            status = 0;

            // $('#hospital_dsgn').focus();
        }
        if ($('#hospital_mmbrTyp').val() == '') {
            $('#hospital_mmbrTyp').addClass('bdr-error');
            $('#error-hospital_mmbrTyp').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
            // $('#hospital_mmbrType').focus();
        }
        if (aboutUs === '') {
            $('#hospital_aboutUs').addClass('bdr-error');
            $('#error-hospital_aboutUs').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
            // $('#hospital_aboutUs').focus();
        }
        if ($('#users_email').val() == '') {
            $('#users_email').addClass('bdr-error');
            $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
            // $('#users_email').focus();
        }


        if (!($.isNumeric(hospital_mblNo))) {
            $('#hospital_mblNo').addClass('bdr-error');
            $('#error-hospital_mblNo').fadeIn().delay(3000).fadeOut('slow');
            status = 0;

            // $('#hospital_mblNo').focus();
        }
        if ($('#users_password').val() == '' || pswd.length < 6) {
            $('#users_password').addClass('bdr-error');
            $('#error-users_password').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
            // $('#users_password').focus();
        }
        if ($('#cnfPassword').val() == '' || pswd != cnfpswd) {
            $('#cnfPassword').addClass('bdr-error');
            $('#error-cnfPassword_check').fadeIn().delay(3000).fadeOut('slow');
            status = 0;

            // $('#cnfpassword').focus();
        }
        if ($('#bloodbank').is(":checked")) {
            if ($('#bloodBank_name').val() === '') {
                $('#bloodBank_name').addClass('bdr-error');
                $('#error-bloodBank_name').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
            if ($('#bloodBank_phn1').val() === '') {
                $('#bloodBank_phone').addClass('bdr-error');
                $('#error-bloodBank_phone').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
        }

        if ($('#pharmacy').is(":checked")) {
            if ($('#pharmacy_name').val() === '') {
                $('#pharmacy_name').addClass('bdr-error');
                $('#error-pharmacy_name').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
            if ($('#pharmacy_phn1').val() === '') {
                $('#pharmacy_phn1').addClass('bdr-error');
                $('#error-pharmacy_phn1').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
        }
        if ($('#ambulance').is(":checked")) {
            if ($('#ambulance_name').val() === '') {
                $('#ambulance_name').addClass('bdr-error');
                $('#error-ambulance_name').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
            if ($('#ambulance_phn1').val() === '') {
                $('#ambulance_phn1').addClass('bdr-error');
                $('#error-ambulance_phn1').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
        }

        if ($('#lat').val() == '') {
            $('#lat').addClass('bdr-error');
            $('#error-lat').fadeIn().delay(3000).fadeOut('slow');
            setTimeout(function () {
                $('#lat').removeClass('bdr-error');
            }, 3000);
            status = 0;
        }

        if ($('#lng').val() == '') {
            $('#lng').addClass('bdr-error');
            $('#error-lng').fadeIn().delay(3000).fadeOut('slow');
            setTimeout(function () {
                $('#lng').removeClass('bdr-error');
            }, 3000);
            status = 0;
        }




        //debugger;
        if (emails != '' && status == 1) {
            check_email(emails);
            return false;
        }
        return false;

    }
    function checkEmailFormat() {
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        var email = $('#users_email').val();
        if (email !== '') {
            if (!filter.test(email)) {

                $('#users_email').addClass('bdr-error');
                $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');
                ;
                // $('#users_email').focus();

            }
        }
    }
    function check_email(myEmail) {
        $.ajax({
            url: urls + 'index.php/hospital/check_email',
            type: 'POST',
            data: {'users_email': myEmail},
            success: function (datas) {
                if (datas == 0) {
                    $("form[name='hospitalForm']").submit();
                    return true;
                } else if (datas == 1) {
                    $('#users_email').addClass('bdr-error');
                    $('#error-users_email_check').fadeIn().delay(3000).fadeOut('slow');
                    return false;
                } else {
                    $('#users_email_status').val(datas);
                    $("form[name='hospitalForm']").submit();
                    return true;
                }

            }
        });
    }
    /*function addMultiserviceName(){
     if(p==10)
     return false;
     p = parseInt(p)+parseInt(1); 
     $('#countServiceName').val(p);
     $('#multiserviceName').append('<input type="text" class="form-control" name="hospitalServices_serviceName[]" id="" placeholder="Give Your Service Name" maxlength="30" />' );
     }*/

    $("#savebtn").click(function () {
        $("#avatar-modal").modal('hide');
    });

</script> 
<script>

    function validationHospitalDetail() {
        // alert('test');   
        //$("form[name='bloodDetail']").submit();
        var check = /^[a-zA-Z\s]+$/;
        var numcheck = /^[0-9]+$/;
        var cpname = $('#hospital_cntPrsn').val();
        var hospital_dsgn = $.trim($('#hospital_dsgn').val());
        var status = 1;

        if ($.trim($('#hospital_name').val()) === '') {
            $('#hospital_name').addClass('bdr-error');
            $('#error-hospital_name').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
        }

        if ($.trim($('.geocomplete').val()) === '') {
            $(".geocomplete").addClass('bdr-error');
            $('#error-geocomplete').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
        }
        if (!check.test(cpname)) {
            $('#hospital_cntPrsn').addClass('bdr-error');
            $('#error-hospital_cntPrsn').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
        }
        if (!check.test(hospital_dsgn)) {
            $('#hospital_dsgn').addClass('bdr-error');
            $('#error-hospital_dsgn').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
        }

        if ($('#bloodbankbtn').is(":checked")) {
            if ($('#bloodBank_name').val() === '') {
                $('#bloodBank_name').addClass('bdr-error');
                $('#error-bloodBank_name').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
            if ($('#bloodBank_phn1').val() === '') {
                $('#bloodBank_phone').addClass('bdr-error');
                $('#error-bloodBank_phone').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
        }

        if ($('#pharmacybtn').is(":checked")) {
            if ($('#pharmacy_name').val() === '') {
                $('#pharmacy_name').addClass('bdr-error');
                $('#error-pharmacy_name').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
            if ($('#pharmacy_phn1').val() === '') {
                $('#pharmacy_phn1').addClass('bdr-error');
                $('#error-pharmacy_phn1').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
        }
        if ($('#ambulancebtn').is(":checked")) {
            if ($('#ambulance_name').val() === '') {
                $('#ambulance_name').addClass('bdr-error');
                $('#error-ambulance_name').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
            if ($('#ambulance_phn1').val() === '') {
                $('#ambulance_phn1').addClass('bdr-error');
                $('#error-ambulance_phn1').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
        }


        if ($('#lat').val() == '') {
            $('#lat').addClass('bdr-error');
            $('#error-lat').fadeIn().delay(3000).fadeOut('slow');
            setTimeout(function () {
                $('#lat').removeClass('bdr-error');
            }, 3000);
            status = 0;
        }

        if ($('#lng').val() == '') {
            $('#lng').addClass('bdr-error');
            $('#error-lng').fadeIn().delay(3000).fadeOut('slow');
            setTimeout(function () {
                $('#lng').removeClass('bdr-error');
            }, 3000);
            status = 0;
        }



        if (status == 0)
            return false;
        else
            $("form[name='hospitalForm']").submit();


    }
    function checkNumber(id) {
        var phone = $.trim($('#' + 'hospital_phn' + id).val());
        if (!($.isNumeric(phone))) {
            $('#' + 'hospital_phn' + id).addClass('bdr-error');
        }
    }


    function updateAccount() {

        var pswd = $.trim($("#users_password").val());
        var cnfpswd = $.trim($("#cnfPassword").val());
        var mobile = $('#users_mobile').val();
        // var emails = $('#users_email').val();
        var user_tables_id = $('#user_tables_id').val();
        var users_mobile = $('#users_mobile').val();
        var returnValue = 0;

        var status = 1;
        //  if (emails === '') {
        //      $('#error-users_emailBlank').fadeIn().delay(3000).fadeOut('slow');
        //     status = 0;
        //  }
        if (users_mobile === '') {
            $('#error-users_mobile').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
        }
        if (pswd === '') {
            $('#users_password').addClass('bdr-error');
            $('#error-users_password').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
        }


        if (pswd != cnfpswd) {
            $('#cnfPassword').addClass('bdr-error');
            $('#error-cnfPassword').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
        }

      

        if (status == 0)
            return false;
        else {
            $.ajax({
                url: urls + 'index.php/hospital/updatePassword',
                type: 'POST',
                //data: {'currentPassword' : pswd,'existingPassword' : password,'user_tables_id' : user_tables_id}, password updated from another user except super admin
                data: $('#acccountForm').serialize(),
                async: false,
                success: function (insertData) {

                    if (insertData == 1) {
                        $('#users_password').val('');
                        $('#cnfPassword').val('');
                        
                        bootbox.alert("Account detail update successfully!", function() {
                            window.location.href = urls + "index.php/hospital/detailHospital/" +<?php echo $check; ?> + "/account";
                             return true;

                        });

                        
                       
                    }

                }
            });
        }

    }



    function deleteGalleryImage(id) {
        bootbox.confirm("Are you sure want to remove this image?", function (result) {
            if (result) {
                $.ajax({
                    url: urls + 'index.php/hospital/deleteGalleryImage',
                    type: 'POST',
                    data: {'id': id},
                    success: function (datas) {
                        loadGallery();
                    }
                });

            }
        });
    }

    function loadGallery() {
        $('#display_gallery').load(urls + 'index.php/hospital/getGalleryImage/' + hospitalId, function () {

        });
    }


    function ValidateSingleInput(oInput, id, option) {
        //alert(oInput);
        var _validFileExtensions;
        if (id == '1') {
            _validFileExtensions = [".pdf", ".doc", ".docx", ".rtf", ".text", ".html", ".ppt"];
        }
        if (id == '2') {
            _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];
        }
        if (id == '3') {
            _validFileExtensions = [".mp4", ".3gp", ".avi", ".wmi", ".mpeg", ".flv"];
        }
        if (id == '4') {
            _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png", ".pdf", ".doc", ".docx", ".rtf", ".text", ".html", ".ppt"];
        }

        if (oInput.type == "file") {
            var sFileName = oInput.value;
            var countFile = oInput.files.length;
            var fileName = oInput.files;
            var k;
            var fileSize;
            var size = 0;
            for (k = 0; k < countFile; k++) {
                size = size + fileName[k].size;
            }
            if (option == '5') {
                fileSize = 500000;
            } else {
                fileSize = 6291456;
            }
            if (size > fileSize) {
                if (option == '5') {
                    alert("Sorry, total allowed file size : -  500KB ");
                } else {
                    alert("Sorry, total allowed file size : -  6MB ");
                }
                oInput.value = "";
                return false;
            } else {
                if (sFileName.length > 0) {
                    var blnValid = false;
                    for (var j = 0; j < _validFileExtensions.length; j++) {
                        var sCurExtension = _validFileExtensions[j];
                        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                            blnValid = true;
                            break;
                        }
                    }

                    if (!blnValid) {
                        alert("Sorry,   '" + sFileName + "'   is invalid, allowed extensions are : -   " + _validFileExtensions.join(", "));
                        oInput.value = "";
                        return false;
                    }
                }
            }
        }
        return true;
    }

    $(document).ready(function () {

        // morning
        $('#timepickerMorStart').timepicker({
            showMeridian: true,
            minuteStep: 1,
            showInputs: true,
        }).on('hide.timepicker', function (e) {
            var h = e.time.hours;
            var m = e.time.minutes;
            var mer = e.time.meridian;

            if (h < 6 && mer == 'AM')
                $('#timepickerMorStart').timepicker('setTime', '6:00 AM');
            //convert hours into minutes
            m += h * 60;

            //10:15 = 10h*60m + 15m = 615 min
            if (m > 718)
                $('#timepickerMorStart').timepicker('setTime', '6:00 AM');

            var preTime = $('#timepickerMorEnd').val();
            var splits = preTime.split(" ");
            var secondSplit = splits[0].split(":");
            var preMiutes = secondSplit[1];
            var preHours = secondSplit[0];
            var totalpreMiutes = parseInt(preHours * 60) + parseInt(preMiutes);
            if (totalpreMiutes < m) {
                $('#timepickerMorStart').timepicker('setTime', '6:00 AM');
            }
        });

        $('#timepickerMorEnd').timepicker({
            showMeridian: true,
            minuteStep: 1,
            showInputs: true,
        }).on('hide.timepicker', function (e) {
            var h = e.time.hours;
            var m = e.time.minutes;
            var mer = e.time.meridian;
            var preTime = $('#timepickerMorStart').val();
            var splits = preTime.split(" ");
            var secondSplit = splits[0].split(":");
            var preMiutes = secondSplit[1];
            var preHours = secondSplit[0];
            var totalpreMiutes = parseInt(preHours * 60) + parseInt(preMiutes);

            if (h < 6 && mer == 'AM') {
                $('#timepickerMorEnd').timepicker('setTime', '11:59 AM');
            }
            //convert hours into minutes
            m += h * 60;

            //10:15 = 10h*60m + 15m = 615 min
            if (mer == 'PM' || h > 12) {
                $('#timepickerMorEnd').timepicker('setTime', '11:59 AM');
            }
            if (totalpreMiutes > m) {
                $('#timepickerMorEnd').timepicker('setTime', '11:59 AM');
            }
        });

        // morning end

        $('#timepickernoonStart').timepicker({
            showMeridian: true,
            minuteStep: 1,
            showInputs: true,
        }).on('hide.timepicker', function (e) {
            var h = e.time.hours;
            var m = e.time.minutes;
            var mer = e.time.meridian;
            m += h * 60;

            if (m < 719 && mer == 'AM') {
                $('#timepickernoonStart').timepicker('setTime', '12:00 PM');
            }
            //convert hours into minutes

            // console.log(m);
            //10:15 = 10h*60m + 15m = 615 min
            if (m > 358)
                $('#timepickernoonStart').timepicker('setTime', '12:00 PM');

            var preTime = $('#timepickernoonEnd').val();
            var splits = preTime.split(" ");
            var secondSplit = splits[0].split(":");
            var preMiutes = secondSplit[1];
            var preHours = secondSplit[0];
            var totalpreMiutes = parseInt(preHours * 60) + parseInt(preMiutes);
            if (totalpreMiutes < m) {
                $('#timepickernoonStart').timepicker('setTime', '12:00 PM');
            }
        });

        $('#timepickernoonEnd').timepicker({
            showMeridian: true,
            minuteStep: 1,
            showInputs: true,
        }).on('hide.timepicker', function (e) {
            var h = e.time.hours;
            var m = e.time.minutes;
            var mer = e.time.meridian;
            m += h * 60;

            var preTime = $('#timepickernoonStart').val();
            var splits = preTime.split(" ");
            var secondSplit = splits[0].split(":");
            var preMiutes = secondSplit[1];
            var preHours = secondSplit[0];
            var totalpreMiutes = parseInt(preHours * 60) + parseInt(preMiutes);

            if (m < 719 && mer == 'AM') {
                $('#timepickernoonEnd').timepicker('setTime', '05:59 PM');
            }
            //convert hours into minutes

            if (m > 359)
                $('#timepickernoonEnd').timepicker('setTime', '05:59 PM');

            if (totalpreMiutes > m) {
                $('#timepickernoonEnd').timepicker('setTime', '05:59 PM');
            }
        });


        // Evening start
        $('#timepickerEveStart').timepicker({
            showMeridian: true,
            minuteStep: 1,
            showInputs: true,
        }).on('hide.timepicker', function (e) {
            var h = e.time.hours;
            var m = e.time.minutes;
            var mer = e.time.meridian;

            if (h < 6 && mer == 'PM')
                $('#timepickerEveStart').timepicker('setTime', '6:00 PM');
            //convert hours into minutes
            m += h * 60;

            //10:15 = 10h*60m + 15m = 615 min
            if (m > 659)
                $('#timepickerEveStart').timepicker('setTime', '6:00 PM');

            var preTime = $('#timepickerEveEnd').val();
            var splits = preTime.split(" ");
            var secondSplit = splits[0].split(":");
            var preMiutes = secondSplit[1];
            var preHours = secondSplit[0];
            var totalpreMiutes = parseInt(preHours * 60) + parseInt(preMiutes);
            if (totalpreMiutes < m) {
                $('#timepickerEveStart').timepicker('setTime', '6:00 PM');
            }
        });

        $('#timepickerEveEnd').timepicker({
            showMeridian: true,
            minuteStep: 1,
            showInputs: true,
        }).on('hide.timepicker', function (e) {
            var h = e.time.hours;
            var m = e.time.minutes;
            var mer = e.time.meridian;
            var preTime = $('#timepickerEveStart').val();
            var splits = preTime.split(" ");
            var secondSplit = splits[0].split(":");
            var preMiutes = secondSplit[1];
            var preHours = secondSplit[0];
            var totalpreMiutes = parseInt(preHours * 60) + parseInt(preMiutes);
            if (h < 6 && mer == 'PM')
                $('#timepickerEveEnd').timepicker('setTime', '10:59 PM');
            //convert hours into minutes
            m += h * 60;

            //10:15 = 10h*60m + 15m = 615 min
            if (m > 659)
                $('#timepickerEveEnd').timepicker('setTime', '10:59 PM');

            if (totalpreMiutes > m) {
                $('#timepickerEveEnd').timepicker('setTime', '10:59 PM');
            }
        });

        // Evening end


        // Night start
        $('#timepickerNgtStart').timepicker({
            showMeridian: true,
            minuteStep: 1,
            showInputs: true,
        }).on('hide.timepicker', function (e) {
            var h = e.time.hours;
            var m = e.time.minutes;
            var mer = e.time.meridian;

            if (h < 11 && mer == 'PM')
                $('#timepickerNgtStart').timepicker('setTime', '11:00 PM');
            //convert hours into minutes
            m += h * 60;

            if (m > 299 && mer == 'AM')
                $('#timepickerNgtEnd').timepicker('setTime', '11:00 PM');
            var preTime = $('#timepickerEveEnd').val();
            var splits = preTime.split(" ");
            var secondSplit = splits[0].split(":");
            var preMiutes = secondSplit[1];
            var preHours = secondSplit[0];
            var totalpreMiutes = parseInt(preHours * 60) + parseInt(preMiutes);
            if (mer == 'PM' && splits[1] == 'PM') {
                if (totalpreMiutes < m) {
                    $('#timepickerNgtStart').timepicker('setTime', '11:00 PM');
                }
            }
            if (mer == 'AM' && splits[1] == 'AM') {
                if (totalpreMiutes < m) {
                    $('#timepickerNgtStart').timepicker('setTime', '11:00 PM');
                }
            }

        });


        $('#timepickerNgtEnd').timepicker({
            showMeridian: true,
            minuteStep: 1,
            showInputs: true,
        }).on('hide.timepicker', function (e) {
            var h = e.time.hours;
            var m = e.time.minutes;
            var mer = e.time.meridian;

            var preTime = $('#timepickerNgtStart').val();
            var splits = preTime.split(" ");
            var secondSplit = splits[0].split(":");
            var preMiutes = secondSplit[1];
            var preHours = secondSplit[0];
            var totalpreMiutes = parseInt(preHours * 60) + parseInt(preMiutes);
            //convert hours into minutes

            if ((h > 5 && mer == 'AM'))
                $('#timepickerNgtEnd').timepicker('setTime', '05:00 AM');

            m += h * 60;
            //10:15 = 10h*60m + 15m = 615 min
            if ((m < 661 && mer == 'PM'))
                $('#timepickerNgtEnd').timepicker('setTime', '05:00 AM');
            if (mer == 'PM' && splits[1] == 'PM') {
                if (totalpreMiutes > m) {
                    $('#timepickerNgtEnd').timepicker('setTime', '05:00 AM');
                }
            }
            if (mer == 'AM' && splits[1] == 'AM') {
                if (totalpreMiutes > m) {
                    $('#timepickerNgtEnd').timepicker('setTime', '05:00 AM');
                }
            }
        });



        // Night end

    })


    function showDetail(id) {
        $('#preName_' + id).hide();
        $('#actulName_' + id).show();
        $('#prePrice_' + id).hide();
        $('#actulPrice_' + id).show();
        $('#editdata').hide();
        $('#updateData').show();

    }
    function sendDetail(id, hospitalId, categoryId) {
        var diagnosticName = $.trim($('#Names_' + id).val());
        var diagnosticPrice = $.trim($('#price_' + id).val());
        if (diagnosticName == '' || diagnosticPrice == '')
            console.log("Please fill field");
        else
        {
            $.ajax({
                url: urls + 'index.php/hospital/updateDiagonasticTest',
                type: 'POST',
                data: {'quotationDetailTests_testName': diagnosticName, 'quotationDetailTests_price': diagnosticPrice, 'quotationDetailTests_id': id},
                success: function (datas) {
                    showDiagonasticDetail(hospitalId, categoryId);
                }
            });
        }
    }
    function changeInstruction() {
        $('#detailInstruction').hide();
        $('#detailsAll').show();
        $('#instructionEdit').hide();
        $('#instructionUpdate').show();
    }

    function updateInstruction() {
        var detailsAll = $.trim($('#detailsAll').val());

        var quotationDetailTests_id = $.trim($('#instructionId').val());
        if (detailsAll == '')
            console.log("Please fill field");
        else
        {
            $.ajax({
                url: urls + 'index.php/hospital/updateDiagonasticInstruction',
                type: 'POST',
                data: {'quotationDetailTests_id': quotationDetailTests_id, 'detailsAll': detailsAll},
                success: function (datas) {
                    $('#detailInstruction').show();
                    $('#detailsAll').hide();
                    $('#instructionEdit').show();
                    $('#instructionUpdate').hide();
                    fetchInstruction(quotationDetailTests_id);
                }
            });
        }
    }

    function createCSV() {
        var hospital_stateId = '';
        var hospital_cityId = '';
        var search = '';
        hospital_stateId = $('#hospital_stateId').val();
        hospital_cityId = $('#hospital_cityId').val();
        search = $('#search').val();
        $.ajax({
            url: urls + 'index.php/hospital/createCSV',
            type: 'POST',
            data: {'hospital_stateId': hospital_stateId, 'hospital_cityId': hospital_cityId, 'search': search},
            success: function (datas) {
                console.log(datas)
            }
        });
    }

    $(document).ready(function (e) {

        $("#uploadimage").on('submit', (function (e) {
            e.preventDefault();
            $("#messageErrors").empty();
            $('#loading').show();
            $.ajax({
                url: urls + 'index.php/hospital/hospitalBackgroundUpload/' + hospitalId, // Url to which the request is send
                type: "POST", // Type of request to be send, called as method
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function (data)   // A function to be called if request succeeds
                {
                    var obj = jQuery.parseJSON(data);
                    if (obj.status == 200) {
                        $("#messageErrors").html("<div class='alert alert-success'>" + obj.messsage + "</div>");
                        changebackgroundImage(hospitalId);
                        $("#changeBg").modal('hide');

                    } else {
                        $("#messageErrors").html("<div class='alert alert-danger'>" + obj.messsage + "</div>");
                    }

                }
            });
        }));
// Function to preview image after validation


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
            } else
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
    });
    function changebackgroundImage(id) {
        $.ajax({
            url: urls + 'index.php/hospital/getBackgroundImage/' + hospitalId, // Url to which the request is send
            type: "POST",
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {
                $('.bg-picture').css("background-image", "url(" + data + ")");
            }

        });

    }

    function checkEmailExits() {

        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        var email = $('#doctorEmail').val();
        var hospiId = $("#hospiId").val();
        if (email !== '') {
            if (!filter.test(email)) {
                $('#doctorEmail').addClass('bdr-error');
                $('#error-doctorEmail').fadeIn().delay(3000).fadeOut('slow');
            }

            $.ajax({
                url: urls + 'index.php/hospital/check_email_exits',
                type: 'POST',
                data: {'users_email': email, 'hospiId': hospiId},
                success: function (datas) {

                    if (datas > 0) {
//                        $('#doctorEmail').addClass('bdr-error');
//                        $('#error-users_email_check').fadeIn().delay(5000).fadeOut('slow');
                        $("#docId").val(datas)
                        $("#checkDoctor").hide();
                        $("#AddDocHospi").show();
                        $("#AddNewDoc").hide();
                    } else if (datas == "already") {
                        $('#doctorEmail').addClass('bdr-error');
                        $('#error-users_email_check').html("doctor is already registered with you");
                        $('#error-users_email_check').fadeIn().delay(5000).fadeOut('slow');
                    } else {
                        $("#checkDoctor").hide();
                        $("#AddDocHospi").hide();
                        $("#AddNewDoc").show();
                    }
                }
            });
        }
    }
    function switchButton() {
        $("#checkDoctor").show();
        $("#AddDocHospi").hide();
        $("#AddNewDoc").hide();
    }
    $("#addHospiDocForm").submit(function (event) {
        event.preventDefault();
        var url = '<?php echo site_url(); ?>/hospital/addHospiDoc/';
        var formData = new FormData(this);
        submitData(url, formData);
    });
    function newDoctor() {
        var hospiId = $("#hospiId").val();
        var email = $('#doctorEmail').val();
        var url = encodeURIComponent(email)
        window.location.href = '<?php echo site_url() ?>/doctor/addDoctor/' + url + '/' + hospiId + '/' + 1;
    }

    function latChack(str) {


        var filter = /^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{6,7}$/;
        if (str !== '') {
            if (!filter.test(str)) {

                //$('#lat').addClass('bdr-error');
                $('#error-lat').fadeIn().delay(3000).fadeOut('slow');
                return false;

            } else {
                //$('#lng').removeClass('bdr-error');
                return true;
            }
        }

    }

    function lngChack(str) {


        var filter = /^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{6,14}$/;
        if (str !== '') {
            if (!filter.test(str)) {

                //$('#lat').addClass('bdr-error');
                $('#error-lng').fadeIn().delay(3000).fadeOut('slow');
                return false;

            } else {
                //$('#lng').removeClass('bdr-error');
                return true;
            }
        }

    }


    //Load Custom enable View for all
    function enableDisableFn(status, id)
    {
        if (status == 1)
            var con_mess = "Inactivate";
        else
            con_mess = "Activate";
        var url = '<?php echo site_url(); ?>/hospital/activeDeactive';
        bootbox.confirm('Do you want to ' + con_mess.toLowerCase() + ' this hospital?', function (result) {
            if (result) {
                $.ajax({
                    type: 'post',
                    data: {'id': id, 'status': status},
                    url: url,
                    async: false,
                    success: function (data) {
                        if (data)
                        {
                            // bootbox.alert("Successfully update");	
                            location.reload(true);
                        }
                    }
                });
            }
        });
    }



    function getHospitaldetail(hospitalId) {

        var hospitalId = hospitalId;

        if (hospitalId != '' && hospitalId != 0) {
            $("#hospitalName").css("display", "none");
            $.ajax({
                url: urls + 'index.php/hospital/getHospitaldetail',
                type: 'POST',
                data: {'hospitalId': hospitalId},
                success: function (data) {
                    var obj = $.parseJSON(data);

                    if (obj.status == 1) {
                        $("#geocomplete1").val(obj.address);
                        $("#hospital_countryId").html(obj.country);
                        $("#hospital_stateId").html(obj.state);
                        $("#hospital_cityId").html(obj.city);
                        $('#hospital_cityId,#hospital_stateId,#hospital_countryId').selectpicker('refresh');

                        $("#hospital_zip").val(obj.zipCode);
                        $("#lat").val(obj.lat);
                        $("#lng").val(obj.lng);
                        $("#hospital_name").val(obj.name);

                        $("#isAddressDisabled").val(1);

                        //$("#addressDiv").css("display","none");
                        $("#geocomplete1,#hospital_zip,#lat,#lng").attr("readonly", true);
                        $("#hospital_cityId,#hospital_stateId,#hospital_countryId").prop("disabled", true);
                        $("#hospital_zip").valid();
                        $("#hospital_countryId").valid();
                        $("#hospital_stateId").valid();
                        $("#hospital_cityId").valid();
                        $("#geocomplete1").valid();
                        $("#lat").valid();
                        $("#lng").valid();
                       

                    } else {
                        $("#hospitalName").css("display", "block");
                        $("#geocomplete1").val('');
                        $("#hospital_countryId").html();
                        $("#hospital_stateId").html();
                        $("#hospital_cityId").html();
                        $("#hospital_zip").val('');
                        $("#lat").val('');
                        $("#lng").val('');
                        $("#hospital_name").val('');

                        $("#isAddressDisabled").val(0);

                        $('#hospital_cityId,#hospital_stateId,#hospital_countryId').selectpicker('refresh');
                        $("#geocomplete1,#hospital_zip,#lat,#lng").removeAttr("readonly");
                        $("#hospital_cityId,#hospital_stateId,#hospital_countryId").prop("disabled", false);

                    }
                }
            });
        } else if (hospitalId == 0) {
            $("#hospitalName").css("display", "block");
            $("#geocomplete1").val('');
            $('#hospital_stateId').prop('selectedIndex','');
            $("#hospital_cityId").html('<option>Select City</option>');
            $("#hospital_zip").val('');
            $("#lat").val('');
            $("#lng").val('');
            $("#hospital_name").val('');

            $("#isAddressDisabled").val(0);
            $("#hospital_cityId,#hospital_stateId,#hospital_countryId").prop("disabled", false);
            $('#hospital_cityId,#hospital_stateId,#hospital_countryId').selectpicker('refresh');
            $("#geocomplete1,#hospital_zip,#lat,#lng").removeAttr("readonly");
            
        }
    }


    function addNewDoctor() {

        // alert($( "#doctorForm" ).hasClass( "myForm" ));
        if ($("#doctorForm").hasClass("myForm")) {
            $('#doctorForm').removeClass('myForm');
            $('#doctorForm').css("display", 'none');
            $('#doctorList').css("display", 'block');
            $('#editDoctorForm').css("display", 'none');
            $('#search').css("display", 'block');
            $(".addDoctorButton").html('Add New Doctor');
            $('#editDoctorTimeSlot').hide();
        } else {
            $('#doctorForm').addClass('myForm');
            $('#doctorForm').css("display", 'block');
            $('#doctorList').css("display", 'none');
             $('#search').css("display", 'none');
            $('#editDoctorForm').css("display", 'none');
            // $('#doctorList').css("display",'none');
            $(".addDoctorButton").html('Cancel Add Doctor');
            $('#editDoctorTimeSlot').hide();
        }

    }


    function editDoctor(doctorId) {
        // alert('helloo');
        // alert($( "#doctorForm" ).hasClass( "myForm" ));
        if ($("#editDoctorForm").hasClass("myForm1")) {
            // getDcotorDeatil(doctorId);
            $('#editDoctorForm').removeClass('myForm1');
            $('#editDoctorForm').css("display", 'none');
            $('#doctorList').css("display", 'block');
            $('#search').css("display", 'block');
            $(".addDoctorButton").css("display", 'block');
        } else {

            $('#editDoctorForm').addClass('myForm1');
            $('#editDoctorForm').css("display", 'block');
            $('#doctorList').css("display", 'none');
            $('#search').css("display", 'none');
            // $('#doctorList').css("display",'none');
            $(".addDoctorButton").css("display", 'none');
            getDcotorDeatil(doctorId);
        }

    }

    function getDcotorDeatil(doctorId) {

        var imgUrl = '<?php echo base_url(); ?>/assets/doctorsImages/thumb/original/';
        if (getDcotorDeatil != '') {
            $.ajax({
                url: urls + 'index.php/hospital/getDoctorDeatil',
                type: 'POST',
                async: false,
                data: {'doctorId': doctorId},
                success: function (data) {
                    var obj = $.parseJSON(data);
                    // alert(obj.status);
                    if (obj.status == 1) {
                        $(".doctors_fName").val(obj.doctors_fName);
                        $(".doctors_lName").val(obj.doctors_lName);
                        $(".users_email").val(obj.email);
                        $(".doctors_phn").val(obj.doctors_phon);
                        $(".exp_year").val(obj.exp_year);
                        $(".doctorSpecialities_specialitiesId").html(obj.doctorSpecialities_specialitiesId);
                        // $('.doctorSpecialities_specialitiesId').selectpicker('refresh');
                        // var arr = jQuery.makeArray( obj.doctorSpecialities_specialitiesId );
                        $(".fee").val(obj.fee);

                        if (obj.doctors_img != '') {
                            $(".image-preview-show").attr('src', imgUrl + obj.doctors_img);
                        } else {
                            $(".image-preview-show").attr('src', "<?php echo base_url() ?>assets/default-images/Doctor-logo.png");
                        }

                        $.each(obj.academicDeatil, function (key, value) {


                            if (key == 0) {

                                countsAccademic = parseInt(countsAccademic) + 1;
                                var divIds = countsAccademic;


                                var optionValue = value.doctorAcademic_degreeId;
                                //  alert(optionValue);



                                $("#doctorAcademic_degreeId2").val(optionValue)
                                        .find("option[value=" + optionValue + "]").attr('selected', true);

                                var degreeData = $('#doctorAcademic_degreeId2').html();


                                $('#doctorAcademic_degreeId2').selectpicker('refresh');

                                var specialitiesData = $('#doctorSpecialities_specialitiesCatId2').html();
                                $('#parentDegreeDiv2').html('<div id="childDegreeDiv2' + divIds + '"><aside class="row"><label for="cname" class="control-label col-md-4">Degree</label><div class="col-md-4 col-sm-4"><select class="selectpicker" data-width="100%" data-size="4" name="doctorAcademic_degreeId[]" id="doctorAcademic_degreeId' + divIds + '" >' + degreeData + '</select></div><div class="col-md-4 col-sm-4 m-t-xs-10"><select class="selectpicker" data-width="100%" data-size="4" name="doctorSpecialities_specialitiesCatId[]" id="doctorSpecialities_specialitiesCatId' + divIds + '" >' + specialitiesData + '</select></div></aside><aside class="row"><label for="cname" class="control-label col-md-4 m-t-20">Address</label><div class="col-md-8 col-sm-8 m-t-20"><textarea class="form-control" id="acdemic_addaddress' + divIds + '" name="acdemic_addaddress[]" required="">' + value.doctorAcademic_degreeInsAddress + '</textarea><label class="error" style="display:none;" id="error-acdemic_addaddress' + divIds + '"> please fill Address</label></div><label for="cname" class="control-label col-md-4 m-t-20">Year</label><div class="col-md-8 col-sm-8 m-b-20 m-t-10"><input class="form-control" name="acdemic_addyear[]" required="" id="acdemic_addyear' + divIds + '" value="' + value.doctorAcademic_degreeYear + '" onkeypress="return isNumberKey(event)" maxlength="4"><label class="error" style="display:none;" id="error-acdemic_addyear' + divIds + '"> please fill Year</label></div></aside></div><br />');

                            } else {
                                countsAccademic = parseInt(countsAccademic) + 1;
                                var divIds = countsAccademic;

                                $('#doctorAcademic_degreeId2').selectpicker('refresh');

                                var optionValue = value.doctorAcademic_degreeId;

                                $("#doctorAcademic_degreeId2").val(optionValue)
                                        .find("option[value=" + optionValue + "]").attr('selected', true);

                                var degreeData = $('#doctorAcademic_degreeId2').html();

                                var specialitiesData = $('#doctorSpecialities_specialitiesCatId2').html();
                                $('#parentDegreeDiv2').append('<div id="childDegreeDiv2' + divIds + '"><aside class="row"><label for="cname" class="control-label col-md-4">Degree</label><div class="col-md-4 col-sm-4"><select class="selectpicker" data-width="100%" data-size="4" name="doctorAcademic_degreeId[]" id="doctorAcademic_degreeId' + divIds + '" >' + degreeData + '</select></div><div class="col-md-4 col-sm-4 m-t-xs-10"><select class="selectpicker" data-width="100%" data-size="4" name="doctorSpecialities_specialitiesCatId[]" id="doctorSpecialities_specialitiesCatId' + divIds + '" >' + specialitiesData + '</select></div></aside><aside class="row"><label for="cname" class="control-label col-md-4 m-t-20">Address</label><div class="col-md-8 col-sm-8 m-t-20"><textarea class="form-control" id="acdemic_addaddress' + divIds + '" name="acdemic_addaddress[]" required="">' + value.doctorAcademic_degreeInsAddress + '</textarea><label class="error" style="display:none;" id="error-acdemic_addaddress' + divIds + '"> please fill Address</label></div><label for="cname" class="control-label col-md-4 m-t-20">Year</label><div class="col-md-8 col-sm-8 m-b-20 m-t-10"><input class="form-control" name="acdemic_addyear[]" required="" id="acdemic_addyear' + divIds + '" value="' + value.doctorAcademic_degreeYear + '" onkeypress="return isNumberKey(event)" maxlength="4"><label class="error" style="display:none;" id="error-acdemic_addyear' + divIds + '"> please fill Year</label></div></aside></div><br />');

                            }

                        });



                    } else {
                        $(".doctors_fName").val('');
                        $(".doctors_lName").val('');
                        $(".users_email").val('');
                        $(".doctors_phn").val('');
                        $(".exp_year").val('');
                        $(".fee").val('');
                    }
                }
            });
        }
    }


    $(".select2").select2({
        width: '100%'
    });

    $(".bs-select").select2({placeholder: "Select a Speciality",
        allowClear: true
    });


    function find_membershipdata(member_id) {

        var url = '<?php echo site_url(); ?>/hospital/find_membership';
        if (typeof member_id == 'string') {
            $.ajax({
                url: url,
                async: false,
                type: 'POST',
                data: {'member_id': member_id},
                success: function (data) {
                    var datas = $.parseJSON(data);
                    //console.log(data);
                    var i;
                    var j = 1;
                    var k = 1;
                    if (datas && datas != '') {
                        for (var datat in datas) {
                            $("#membership_quantity_" + j).val(datas[datat].membershipFacilities_quantity);
                            if (datas[datat].membershipFacilities_facilitiesId == 2 || datas[datat].membershipFacilities_facilitiesId == 4) {
                                $("#membership_duration_" + j).val(datas[datat].membershipFacilities_duration);
                            }
                            j++;
                        }
                    } else {
                        for (k = 1; k < 5; k++) {
                            $("#membership_quantity_" + k).val('');
                            $("#membership_duration_" + k).val('');
                        }
                    }
                }
            });
        }
    }


    $(document).ready(function () {
        $("#membershipForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/hospital/membershipEdit/';
            var formData = new FormData(this);
            submitData(url, formData);
        });
    });

</script>
<script>
    var urls = "<?php echo base_url() ?>";

    $(document).ready(function () {

    $("#submitForm").validate({
        ignore: "",
      errorPlacement: function(error, element) {
        if (element.attr("name") == "avatar_file")
        {
            error.insertAfter('.error-label');
        }
        else{
            error.insertAfter(element);
        }
        },
        rules: {
            hospital_id:{
                required : true,
            },
            hospital_name: {
                required : true,
               // lettersonly: true

            },
            hospital_type: {
                required: true
            },
             avatar_file: {
                required : true
            },
            
            hospital_countryId:{
         
                required: true
            },
            hospital_stateId:{
         
                required: true
            },
            hospital_cityId:{
         
                required: true
            },
            hospital_zip:{
         
                required: true,
                number: true,
                minlength:6,
                maxlength:6

            },
            hospital_address: {
                required: true,
            }, 
            lat: {
                required: true,
                

                            
            },
            lng: {
                required: true,
                 

                            
            },
            hospital_phn: {
                required: true,
                number: true,
                minlength:10,
                maxlength:10

                            
            },
            'hospitalServices_serviceName[]': {
                required: true
                            
            },
            hospital_cntPrsn: {
                required: true,
                lettersonly: true
                            
            },
            docatId: {
                required: true,
                            
            },
            hospital_dsgn: {
                required: true,
                 lettersonly: true                         
            },
            hospital_mmbrTyp: {
                required: true
            },
            hospital_aboutUs: {
                required: true
                         
            },
            users_email: {
                required: true,
                email: true,
                remote: {
                url:  urls + 'index.php/hospital/isEmailRegister',
                type: "post",
                data: {
                        email: function(){ return $("#users_email").val(); },
                        id: function(){ return $("#user_tables_id").val(); },
                        role: function(){ return 1; }
                    }
                  }

                            
            },
            hospital_mblNo: {
                required: true,
                         
            },
            users_password: {
                required: true,
                         
            },
            cnfPassword: {
                required: true,
                equalTo: "#users_password"

                         
            }
      

        },
        messages: {
            hospital_id:{
                required : "Either select a hospital or select other!",
            },
              hospital_name: {
                required : "Please enter hospital's name!",
            },
            hospital_type: {
                required : "Please select type of hospital!",
            },
            
              avatar_file: {
                required : "Please upload an image!",
            },

              hospital_countryId: {
                required: "Please select a country!",
            },
            hospital_stateId: {
                required: "Please select a state!",
            },
                    
             hospital_cityId: {
                required: "Please select country,state and a city!",
            },
            hospital_zip: {
                required: "Please enter a zip code!",
            },
            hospital_address: {
                required: "Please enter an address!",
            },
            lat: {
                required: "Please enter latitude!",
            },
            lng: {
                required: "Please enter longitude!",
            },
            hospital_phn: {
                required: "Please enter hospital's phone number!",
            },
            'hospitalServices_serviceName[]': {
                required: "Please enter one of more hospital services!",
            },
            hospital_cntPrsn: {
                required: "Please enter contact person's name!",
            },

            docatId: {
                required: "Please enter docat Id!",
            },
            hospital_dsgn: {
                required: "Please enter designation!",
            },
            hospital_mmbrTyp: {
                required: "Please select a member type!",
            },
            hospital_aboutUs: {
                required: "Please fill the about us section!",
            },
            users_email: {
                required:"Please enter an email id!",
                email: "Please enter the correct email format!",
                remote: jQuery.validator.format("{0} already exists.")
            },
            hospital_mblNo: {
                required: "Please enter a mobile no.!",
            },

            users_password: {
                required: "Please enter a password!",
            },
            cnfPassword:{
                required: "Please confirm your password!",
         
      }
      
           
        }

    });
 $('.select2').select2().change(function(){
    $(this).valid()
});
 
});
</script>
<script>
    var urls = "<?php echo base_url() ?>";

    $(document).ready(function () {

    $("#hospitalDetail").validate({
        rules: {
            hospital_id:{
                required : true,
            },
            hospital_name: {
                required : true,
             //   lettersonly: true

            },
            hospital_type: {
                required: true
            },
             avatar_file: {
                required : true
            },
            
            hospital_countryId:{
         
                required: true
            },
            hospital_stateId:{
         
                required: true
            },
            hospital_cityId:{
         
                required: true
            },
            hospital_zip:{
         
                required: true,
                number: true,
                minlength:6,
                maxlength:6

            },
            hospital_address: {
                required: true,
            }, 
            lat: {
                required: true,
                

                            
            },
            lng: {
                required: true,
                 

                            
            },
            hospital_phn: {
                required: true,
                number: true,
                minlength:10,
                maxlength:10

                            
            },
            'hospitalServices_serviceName[]': {
                required: true
                            
            },
            hospital_cntPrsn: {
                required: true,
                lettersonly: true
                            
            },
            docatId: {
                required: true,
                            
            },
            hospital_dsgn: {
                required: true,
                 lettersonly: true                         
            },
            hospital_mmbrTyp: {
                required: true
            },
            hospital_aboutUs: {
                required: true
                         
            },
            users_email: {
                required: true,
                email: true,
                remote: {
                url:  urls + 'index.php/hospital/isEmailRegister',
                type: "post",
                data: {
                        email: function(){ return $("#users_email").val(); },
                        id: function(){ return $("#user_tables_id").val(); },
                        role: function(){ return 1; }
                    }
                  }

                            
            },
            hospital_mblNo: {
                required: true,
                         
            },
            users_password: {
                required: true,
                         
            },
            cnfPassword: {
                required: true,
                equalTo: "#users_password"

                         
            }
      

        },
        messages: {
            hospital_id:{
                required : "Either select a hospital or select other!",
            },
              hospital_name: {
                required : "Please enter hospital's name!",
            },
            hospital_type: {
                required : "Please select type of hospital!",
            },
            
              avatar_file: {
                required : "Please upload an image!",
            },

              hospital_countryId: {
                required: "Please select a country!",
            },
            hospital_stateId: {
                required: "Please select a state!",
            },
                    
             hospital_cityId: {
                required: "Please select a city!",
            },
            hospital_zip: {
                required: "Please enter a zip code!",
            },
            hospital_address: {
                required: "Please enter an address!",
            },
            lat: {
                required: "Please enter latitude!",
            },
            lng: {
                required: "Please enter longitude!",
            },
            hospital_phn: {
                required: "Please enter hospital's phone number!",
            },
            'hospitalServices_serviceName[]': {
                required: "Please enter one of more hospital services!",
            },
            hospital_cntPrsn: {
                required: "Please enter contact person's name!",
            },

            docatId: {
                required: "Please enter docat Id!",
            },
            hospital_dsgn: {
                required: "Please enter designation!",
            },
            hospital_mmbrTyp: {
                required: "Please select a member type!",
            },
            hospital_aboutUs: {
                required: "Please fill the about us section!",
            },
            users_email: {
                required:"Please enter an email id!",
                email: "Please enter the correct email format!",
            },
            hospital_mblNo: {
                required: "Please enter a mobile no.!",
            },

            users_password: {
                required: "Please enter a password!",
            },
            cnfPassword:{
                required: "Please confirm your password!",
         
      }
      
           
        }

    });
});






$('.select2').select2().change(function(){
    $(this).valid()
});

$(document).ready(function () {
    $("#bloodbankbtn, #bloodbank").click(function () {
     if($(this).is(':checked')){
         bootbox.confirm({
                    message: 'Do you outsource the blood?',
                    buttons: {
                        'cancel': {
                            label: 'No',
                            className: 'btn-default pull-right'
                        },
                        'confirm': {
                            label: 'Yes',
                            className: 'btn-primary pull-right'
                        }
                    },
                    callback: function(result) {
                        if (result) {
                            $('#isBloodBankOutsource').val(1);
                            $("#bloodbankdetail,#bloodbankOption").fadeIn();
                        }else{
                            $("#bloodbankdetail,#bloodbankOption").fadeOut();
                            $('#isBloodBankOutsource').val(0);
                    }
               
              }
         });
            
        }else{
            $("#bloodbankdetail,#bloodbankOption").fadeOut();
            $('#isBloodBankOutsource').val(0);
        }
    });
    
   
 });
 

   
</script>
</body>
</html>
