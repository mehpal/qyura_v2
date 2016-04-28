<style type="text/css">
    #pharmacy_datatable_filter
    {
        display:none;
    }
</style>

<link href="<?php echo base_url(); ?>assets/cropper/cropper.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/cropper/main.css" rel="stylesheet">
<?php
$check = 0;
if (isset($pharmacyId) && !empty($pharmacyId)) {
    $check = $pharmacyId;
}
?>
<script src="<?php echo base_url(); ?>assets/cropper/cropper.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js">
</script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    <!--<script type="text/javascript" src="https://www.google.com/jsapi">
    </script>-->
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->

<?php
$current = $this->router->fetch_method();
if ($current != 'detailPharmacy'):
    ?>
    <script src="<?php echo base_url(); ?>assets/cropper/main.js"></script>
<?php else: ?>
    <script src="<?php echo base_url(); ?>assets/cropper/common_cropper.js"></script>
<?php endif; ?>

<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>
<script type="text/javascript" src="http://localhost/qyura/assets/vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script type="text/javascript" src="http://localhost/qyura/assets/vendor/x-editable/jquery.xeditable.js"></script>
<script src="<?php echo base_url();?>assets/vendor/select2/select2.min.js" type="text/javascript"></script> 
<!--<script type= 'text/javascript' src="<?php echo base_url(); ?>assets/js/jquery.dataTables.js"></script>-->
<script src="<?php echo base_url(); ?>assets/js/common_js.js"></script>
<script type="text/javascript"> var pharmacyId = <?php echo $check; ?></script>
<?php
if (isset($mapData) && !empty($mapData)) {
    $lat = $mapData[0]->pharmacy_lat;
    $lang = $mapData[0]->pharmacy_long;
    $imgUrl = (!empty($mapData[0]->pharmacy_img)) ? base_url() . '/assets/pharmacyImages/thumb/thumb_50/' . $mapData[0]->pharmacy_img : base_url() . '/assets/images/pins/Contact.png';

    $templates = '<img src="' . $imgUrl . '" /><h2 class="text-success">' . ucwords($mapData[0]->pharmacy_name) . '</h2><b>' . $mapData[0]->pharmacy_address . '</b>';
    ?>

    <script type="text/javascript">
    $('#date-3').datepicker();
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
        icon: '<?php echo base_url(); ?>/assets/images/pins/qyura.png'
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

    function IsAdrManual(val) {
        if (val == 1) {
            $("#lat,#lng,.geocomplete").removeAttr('readonly')
        } else if (val == 0) {
            $("#lat,#lng,.geocomplete").attr('readonly', 'readonly');
        }

    }

    /*-- Selectpicker --*/
    $('.selectpicker').select2();


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


//    $(function () {
//        var removeLink = '<a class="remove" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false"> <i class="fa fa-minus-circle fa-2x m-t-5 label-plus"></i></a>';
//        $('a.add').relCopy({append: removeLink});
//
//
//    });

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
    var urls = "<?php echo base_url() ?>";
    var j = 1;

    function fetchCity(stateId) {

        $.ajax({
            url: urls + 'index.php/pharmacy/fetchCity',
            type: 'POST',
            data: {'stateId': stateId},
            success: function (datas) {
                // console.log(datas);
                $('#pharmacy_cityId').html(datas);
                $('#pharmacy_cityId').selectpicker('refresh');
                $('#StateId').val(stateId);
            }
        });

    }
    function countPhoneNumber() {
        if (j == 10)
            return false;
        j = parseInt(j) + parseInt(1);
        $('#countPnone').val(j);
        $('#multiPhoneNumber').append('<input type=text class=form-control name=pharmacy_phn[] placeholder=9837000123 maxlength="10" onkeypress="return isNumberKey(event)" id=pharmacy_phn' + j + ' />');
        $('#multiPreNumber').append('<select class=selectpicker data-width=100% name=pre_number[] id=multiPreNumber' + j + '><option value=91>+91</option><option value=1>+1</option></select>');
        $('#multiPreNumber' + j).selectpicker('refresh');
        //.append('<div class=col-lg-3 col-md-4 col-sm-3 col-sm-4 col-xs-12 m-t-xs-10 id=multiPreNumber><select class=selectpicker data-width=100% name=pre_number[] id=multiPreNumber><option value =91>+91</option><option value =1>+1</option></select></div><div class=col-lg-7 col-md-6 col-sm-7 col-xs-10 m-t-xs-10 id=multiPhoneNumber><nput type=text class="form-control" name=hospital_phn[] id=hospital_phn1 placeholder=9837000123 maxlength=10 /> </div>');

    }


    function validationPharmacy() {
        //$("form[name='pharmacyForm']").submit();
        // alert("here");
        var check = /^[a-zA-Z\s]+$/;
        var numcheck = /^[0-9]+$/;
        var emails = $.trim($('#users_email').val());
        var cpname = $.trim($('#pharmacy_cntPrsn').val());
        var phn = $.trim($('#pharmacy_phn').val());
        var myzip = $.trim($('#pharmacy_zip').val());
        var cityId = $.trim($('#pharmacy_cityId').val());
        var stateIds = $.trim($('#pharmacy_stateId').val());
        var status = 1;
        //debugger;

        if ($('#pharmacy_name').val() == '') {
            $('#pharmacy_name').addClass('bdr-error');
            $('#error-pharmacy_name').fadeIn().delay(3000).fadeOut('slow');
             setTimeout(function(){ $('#pharmacy_name').removeClass('bdr-error'); }, 3000);
            status = 0;
            // $('#hospital_name').focus();
        }
        if ($('#pharmacy_type').val() == '') {
            $('#pharmacy_type').addClass('bdr-error');
            $('#error-pharmacy_type').fadeIn().delay(3000).fadeOut('slow');
             setTimeout(function(){ $('#pharmacy_type').removeClass('bdr-error'); }, 3000);
            status = 0;
            // $('#hospital_type').focus();
        }
        if ($.trim($('#pharmacy_countryId').val()) == '') {
            $('#pharmacy_countryId').addClass('bdr-error');
            $('#error-pharmacy_countryId').fadeIn().delay(3000).fadeOut('slow');
             setTimeout(function(){ $('#pharmacy_countryId').removeClass('bdr-error'); }, 3000);
            status = 0;
            // $('#hospital_countryId').focus();
        }
        if (stateIds === '') {
            // console.log("in state");
            $('#pharmacy_stateId').addClass('bdr-error');
            $('#error-pharmacy_stateId').fadeIn().delay(3000).fadeOut('slow');
             setTimeout(function(){ $('#pharmacy_stateId').removeClass('bdr-error'); }, 3000);
            status = 0;
            // $('#hospital_stateId').focus();
        }
        if (cityId === '') {
            $('#pharmacy_cityId').addClass('bdr-error');
            $('#error-pharmacy_cityId').fadeIn().delay(3000).fadeOut('slow');
             setTimeout(function(){ $('#pharmacy_cityId').removeClass('bdr-error'); }, 3000);
            status = 0;
            // $('#hospital_cityId').focus();
        }

        /*if(!$.isNumeric(myzip)){
         
         $('#pharmacy_zip').addClass('bdr-error');
         $('#error-pharmacy_zip').fadeIn().delay(3000).fadeOut('slow');
         status= 0;
         // $('#hospital_zip').focus();
         } */
        if (myzip.length < 6) {

            $('#pharmacy_zip').addClass('bdr-error');
            $('#error-pharmacy_zip_long').fadeIn().delay(3000).fadeOut('slow');
             setTimeout(function(){ $('#pharmacy_zip').removeClass('bdr-error'); }, 3000);
            status = 0;
            // $('#hospital_zip').focus();
        }

        if ($("input[name='pharmacy_address']").val() == '') {
            $('#pharmacy_address').addClass('bdr-error');
            $('#error-pharmacy_address').fadeIn().delay(3000).fadeOut('slow');
             setTimeout(function(){ $('#pharmacy_address').removeClass('bdr-error'); }, 3000);
            status = 0;
            // $('#hospital_address').focus();
        }


        if (!$.isNumeric(phn)) {
            $('#pharmacy_phn').addClass('bdr-error');
            $('#error-pharmacy_phn').fadeIn().delay(3000).fadeOut('slow');
             setTimeout(function(){ $('#pharmacy_phn').removeClass('bdr-error'); }, 3000);
            status = 0;
            // $('#hospital_phn').focus();
        }

        if (!check.test(cpname)) {
            $('#pharmacy_cntPrsn').addClass('bdr-error');
            $('#error-pharmacy_cntPrsn').fadeIn().delay(3000).fadeOut('slow');
             setTimeout(function(){ $('#pharmacy_cntPrsn').removeClass('bdr-error'); }, 3000);
            status = 0;
            // $('#hospital_cntPrsn').focus();
        }

        if ($('#pharmacy_mmbrTyp').val() == '') {
            $('#pharmacy_mmbrTyp').addClass('bdr-error');
            $('#error-pharmacy_mmbrTyp').fadeIn().delay(3000).fadeOut('slow');
             setTimeout(function(){ $('#pharmacy_mmbrTyp').removeClass('bdr-error'); }, 3000);
            status = 0;
            // $('#hospital_mmbrType').focus();
        }
        if ($('#users_email').val() === '') {
            $('#users_email').addClass('bdr-error');
            $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');
             setTimeout(function(){ $('#users_email').removeClass('bdr-error'); }, 3000);
            status = 0;
            // $('#users_email').focus();
        }

        if (myzip.length < 6) {
            $('#pharmacy_zip').addClass('bdr-error');
            $('#error-pharmacy_zip').fadeIn().delay(3000).fadeOut('slow');
             setTimeout(function(){ $('#pharmacy_zip').removeClass('bdr-error'); }, 3000);
            status = 0;
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
        
         if($('#pharmacy_docatId').val()==''){
                $('#pharmacy_docatId').addClass('bdr-error');
                $('#error-pharmacy_docatId').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){ $('#pharmacy_docatId').removeClass('bdr-error'); }, 3000);
               status = 0;
            }
            
            
             if(!$.isNumeric(phn) && phn == ''){
                
                $('#pharmacy_phn').addClass('bdr-error');
                $('#error-pharmacy_phn').fadeIn().delay(3000).fadeOut('slow');
                 setTimeout(function(){ $('#pharmacy_phn').removeClass('bdr-error'); }, 3000);
                // $('#hospital_phn').focus();
                status = 0;
            }else{
                if(phn.length != 10){
                    
                     
                $('#pharmacy_phn').addClass('bdr-error');
                $('#error-pharmacy_phn').fadeIn().delay(3000).fadeOut('slow'); 
                 setTimeout(function(){ $('#pharmacy_phn').removeClass('bdr-error'); }, 3000);
                 status = 0;
                }
            }

        /* if(status == 0){
         return false;
         }else{
         return true;
         } */
        if (emails != '' && status == 1) {
            check_email(emails);
            return false;
        }
        return false;

    }
    
    function checkQapCode(qap){
           $.ajax({
            url: urls + 'index.php/pharmacy/isQapCode',
            type: 'POST',
            data: {'qap_code': qap},
            success: function (response) {
                if (response == 1) {
                    $("#error-pharmacy_qapCode").hide();
                } else {
                    $("#error-pharmacy_qapCode").show();
                }
            }
        });
        
    }


    function validationPharmacyDetail() {

        //$("form[name='bloodDetail']").submit();
        var check = /^[a-zA-Z\s]+$/;
        var numcheck = /^[0-9]+$/;
        var emails = $.trim($('#users_email').val());
        var cpname = $.trim($('#pharmacy_cntPrsn').val());
        var myzip = $.trim($('#pharmacy_zip').val());
        var phn = $.trim($('#pharmacy_phn').val());
        var myzip = $.trim($('#pharmacy_zip').val());
        var cityId = $.trim($('#pharmacy_cityId').val());
        var stateIds = $.trim($('#StateId').val());
        var status = 1;

        if ($.trim($('#pharmacy_name').val()) === '') {
            $('#pharmacy_name').addClass('bdr-error');
            $('#error-pharmacy_name').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
        }

        if ($.trim($('.geocomplete').val()) === '') {
            $(".geocomplete").addClass('bdr-error');
            status = 0;
        }
        if (!check.test(cpname)) {
            $('#pharmacy_cntPrsn').addClass('bdr-error');
            status = 0;
        }

        if (emails !== '' && checkUpdateEmailFormat(emails)) {
            status = 0;
        }

        if (myzip.length < 6) {
            $('#pharmacy_zip').addClass('bdr-error');
            $('#error-pharmacy_zip').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
        }

        if ($('#lat').val() == '') {
            $('#lat').addClass('bdr-error');
            $('#error-lat').fadeIn().delay(3000).fadeOut('slow');
            setTimeout(function () {
                $('#lat').removeClass('bdr-error');
            }, 3000);
            status = 0;
        }
        
          if($('#pharmacy_docatId').val()==''){
                $('#pharmacy_docatId').addClass('bdr-error');
                $('#error-pharmacy_docatId').fadeIn().delay(3000).fadeOut('slow');
               
               status = 0;
            }
            
            
             if(!$.isNumeric(phn) && phn == ''){
                
                $('#pharmacy_phn').addClass('bdr-error');
                $('#error-pharmacy_phn').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_phn').focus();
                status = 0;
            }else{
                if(phn.length != 10){
                    
                     
                $('#pharmacy_phn').addClass('bdr-error');
                $('#error-pharmacy_phn').fadeIn().delay(3000).fadeOut('slow'); 
                 status = 0;
                }
            }

        if ($('#lng').val() == '') {
            $('#lng').addClass('bdr-error');
            $('#error-lng').fadeIn().delay(3000).fadeOut('slow');
            setTimeout(function () {
                $('#lng').removeClass('bdr-error');
            }, 3000);
            status = 0;
        }

        if (status == 0) {
            return false;
        } else {
            return true;
        }

    }

    function checkNumber(id) {
        var phone = $.trim($('#' + 'pharmacy_phn' + id).val());
        if (!($.isNumeric(phone))) {
            $('#' + 'pharmacy_phn' + id).addClass('bdr-error');
        }
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

    function checkUpdateEmailFormat(email) {
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        var email = email;
        if (email !== '') {
            if (!filter.test(email)) {
                $('#users_email').addClass('bdr-error');
                return true;
            } else {
                return false;
            }
        }
    }

    function check_email(myEmail) {
        $.ajax({
            url: urls + 'index.php/pharmacy/check_email',
            type: 'POST',
            data: {'users_email': myEmail},
            success: function (datas) {
                if (datas == 0) {
                    $("form[name='pharmacyForm']").submit();
                    return true;
                } else if (datas == 1) {
                    $('#users_email').addClass('bdr-error');
                    $('#error-users_email_check').fadeIn().delay(3000).fadeOut('slow');
                    return false;
                } else {
                    $('#users_email_status').val(datas);
                    $("form[name='pharmacyForm']").submit();
                    return true;
                }
            }
        });
    }

    $(document).ready(function () {

        var oTable = $('#pharmacy_datatable').DataTable({
            "processing": true,
            "bServerSide": true,
            // "searching": true,
            "bLengthChange": false,
            "bProcessing": true,
            "iDisplayLength": 10,
            "bPaginate": true,
            "sPaginationType": "full_numbers",
            "columnDefs": [{
                    "targets": [0, 1, 2, 3, 4, 5, 6],
                    "orderable": false
                }],
            "columns": [
                {"data": "pharmacy_img", "searchable": false, "order": false, orderable: false, width: "8%"},
                {"data": "pharmacy_name"},
                {"data": "city_name"},
                {"data": "pharmacy_phn"},
                {"data": "pharmacy_address"},
                {"data": "status"},
                {"data": "view", "searchable": false, "order": false, orderable: false, width: "8%"},
            ],
            "ajax": {
                "url": "<?php echo site_url('pharmacy/getPharmacyDl'); ?>",
                "type": "POST",
                "data": function (d) {
                    d.cityId = $("#cityId").val();
                    d.status = $("#status").val();
                    d.name = $("#search").val();
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                }
            }
        });

        $('#cityId,#status').change(function () {
            oTable.draw();
        });
        $('#search').on('keyup', function () {
            oTable.columns( 5 ).search($(this).val()).draw();
        });

    });

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

    function createCSV() {
        var pharmacy_stateId = '';
        var pharmacy_cityId = '';
        var search = '';
        pharmacy_stateId = $('#pharmacy_stateId').val();
        pharmacy_cityId = $('#pharmacy_cityId').val();
        search = $('#search').val();

        $.ajax({
            url: urls + 'index.php/pharmacy/createCSV',
            type: 'POST',
            data: {'pharmacy_stateId': pharmacy_stateId, 'pharmacy_cityId': pharmacy_cityId, 'search': search},
            success: function (datas) {
                console.log(datas)
            }
        });
    }
    
        function changebackgroundImage(id){
           $.ajax({
            url: urls + 'index.php/pharmacy/getBackgroundImage/' + id, // Url to which the request is send
            type: "POST",            
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
              $('.bg-picture').css("background-image", "url("+data+")");   
            }
               
          });
    
    }

//    function changebackgroundImage(id) {
//        $.ajax({
//            url: urls + 'index.php/pharmacy/getBackgroundImage/' + id, // Url to which the request is send
//            type: "POST",
//            contentType: false, // The content type used when sending data to the server.
//            cache: false, // To unable request pages to be cached
//            processData: false, // To send DOMDocument or non processed data file it is set to false
//            success: function (data)   // A function to be called if request succeeds
//            {
//                $('.bg-picture').css("background-image", "url(" + data + ")");
//            }
//
//        });
//
//    }

    $(document).ready(function (e) {

//        $("#uploadimage").on('submit', (function (e) {
//            e.preventDefault();
//            $("#messageErrors").empty();
//            $('#loading').show();
//            $.ajax({
//                url: urls + 'index.php/pharmacy/pharmacyBackgroundUpload/' + pharmacyId, // Url to which the request is send
//                type: "POST", // Type of request to be send, called as method
//                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
//                contentType: false, // The content type used when sending data to the server.
//                cache: false, // To unable request pages to be cached
//                processData: false, // To send DOMDocument or non processed data file it is set to false
//                success: function (data)   // A function to be called if request succeeds
//                {
//                    var obj = jQuery.parseJSON(data);
//                    if (obj.status == 200) {
//                        $("#messageErrors").html("<div class='alert alert-success'>" + obj.messsage + "</div>");
//                        setTimeout(function(){ $("#messageErrors").html(""); }, 2000);
//                        changebackgroundImage(pharmacyId);
//                        $("#changeBg").modal('hide');
//
//                    } else {
//                        $("#messageErrors").html("<div class='alert alert-danger'>" + obj.messsage + "</div>");
//                         setTimeout(function(){ $("#messageErrors").html(""); }, 2000);
//                    }
//
//                }
//            });
//        }));
        
         $("#uploadimage").on('submit',(function(e) {
            e.preventDefault();
            $("#messageErrors").empty();
            $('#loading').show();
            $.ajax({
            url: urls + 'index.php/pharmacy/pharmacyBackgroundUpload/' + pharmacyId, // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
                var obj = jQuery.parseJSON(data);
                if(obj.status == 200){
                     $("#messageErrors").html("<div class='alert alert-success'>"+obj.messsage+"</div>");
                     setTimeout(function(){ $("#messageErrors").html(""); }, 2000);
                      changebackgroundImage(pharmacyId);
                      $("#changeBg").modal('hide');
                      $("#uploadBtnDd").val("");
                    
                }else{
                    $("#messageErrors").html("<div class='alert alert-danger'>"+obj.messsage+"</div>");
                    setTimeout(function(){ $("#messageErrors").html(""); }, 2000);
                }

            }
            });
    }));
        
// Function to preview image after validation
$("#uploadBtnDd").change(function() {

$("#messageErrors").empty(); // To remove the previous error message
    var file = this.files[0];
    var imagefile = file.type;
    var match= ["image/jpeg","image/png","image/jpg"];
    if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
    {
    $('#previewing').attr('src','noimage.png');
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

//        $("#uploadBtnDd").change(function () {
//
//            $("#messageErrors").empty(); // To remove the previous error message
//            var file = this.files[0];
//            var imagefile = file.type;
//            var match = ["image/jpeg", "image/png", "image/jpg"];
//            if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
//            {
//                $('#previewing').attr('src', 'noimage.png');
//                $("#messageErrors").html("<div class='alert alert-danger'><p id='error'>Please Select A valid Image File</p><span id='error_message'>Only jpeg, jpg and png Images type allowed</span></div>");
//                return false;
//            } else
//            {
//                var reader = new FileReader();
//                reader.onload = imageIsLoaded;
//                reader.readAsDataURL(this.files[0]);
//            }
//        });

function imageIsLoaded(e) {
    $("#file").css("color","green");
    $('#image_preview').css("display", "block");
    $('#previewing').attr('src', e.target.result);
    $('#previewing').attr('width', '500px');
    $('#previewing').attr('height', '230px');
}
});

    $("#edit").click(function () {
        $("#detail").toggle();
        $("#newDetail").toggle();
    });
    $("#editdetail").click(function () {
        $("#detail").toggle();
        $("#newDetail").toggle();
    });

    function checkExisting(email) {
        var email = email;
        if (email != '') {
            $.ajax({
                url: urls + 'index.php/bloodbank/checkExisting',
                type: 'POST',
                datatype: 'json',
                data: {'emailId': email},
                success: function (data, status, xhr) {
                    var obj = JSON.parse(data);
                    if (obj.status == 0) {
                        $("#isValid").val(0);
                        $('#users_email').addClass('bdr-error');
                        $('#error-users_email_check').fadeIn().delay(3000).fadeOut('slow');
                        $(".checkManual").css('display', 'block');

                        /* $("#geocomplete").val('');
                         $("#lat").val('');
                         $("#lng").val('');
                         $("#userId").val('');
                         $("#geocomplete,#lat,#lng").removeAttr('readonly',''); */

                        $('#isValid').val(0);
                        return false;
                    } else if (obj.status == 1) {
                        $(".geocomplete").val(obj.address);
                        $("#lat").val(obj.lat);
                        $("#lng").val(obj.lng);
                        $("#userId").val(obj.userId);
                        $(".geocomplete,#lat,#lng").attr('readonly', 'readonly');
                        $("#isManual").prop("checked", false);
                        $(".checkManual").css('display', 'none');
                        $('#isValid').val(1);
                        return true;
                    } else if (obj.status == 2) {
                        $(".geocomplete").val('');
                        $("#lat").val('');
                        $("#lng").val('');
                        $("#userId").val('');
                        $(".geocomplete,#lat,#lng").removeAttr('readonly', '');
                        $(".checkManual").css('display', 'block');
                        $('#isValid').val(1);
                        return true;
                    }
                }
            });
        }
    }

    function checkValidFileUploads(urls) {

        var avatar_file = $(".avatar-data").val();
        $.ajax({
            url: urls + 'index.php/pharmacy/checkFileUploadValidation',
            type: 'POST',
            data: {'avatar_file': avatar_file},
            success: function (data) {
                var obj = $.parseJSON(data);

                if (obj.state == 400) {
                    $("#message_upload").html("<div class='alert alert-danger'>" + obj.message + "</div>");
                   // $(".close").hide();
                } else {
                    $("#avatar-modal").modal('hide');
                    $("#message_upload").html("");
                }
            }
        });
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
    

</script>   

</body>
</html>