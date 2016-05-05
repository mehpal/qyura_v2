<style type="text/css">
    #doctor_datatable_filter
    {
        display:none;
    }
</style>
<style>
    .m-t-4{margin-top:4px;}
    .blue-ttl{width:120px; height:85px; border:1px solid #ddd; 
              padding:0px 2px 10px 0px; margin: 15px 10px; float: left }
    .blue-ttl aside h5
    {
        text-align: right;
        display:none;
        margin-top: 3px;
    }
    .blue-ttl aside h5 
    {
        display: none;
    }
    .blue-ttl:hover aside h5 
    {
        display:block;
    }
    .blue-ttl + .tooltip > .tooltip-inner {
        background-color: #f8f8f8;
        border: 1px solid #3FCEB2;
        padding: 0px;
        color:#333;
        text-align: left;
        padding: 0px 10px 10px;
    }
    .orange-ttl + .tooltip.left .tooltip-arrow {
        border-top-color:  #3FCEB2;
    }
    /* ============================================================
GLOBAL
============================================================ */
    .effects {
        padding-left: 15px;
    }
    .effects .img {
        position: relative;
        float: left;
        margin-bottom: 5px;
        /*  width: 25%;*/
        overflow: hidden;
    }
    .effects .img:nth-child(n) {
        margin-right: 5px;
    }
    .effects .img:first-child {
        margin-left: -15px;
    }
    .effects .img:last-child {
        margin-right: 0;
    }
    .effects .img img {
        display: block;
        margin: 0;
        padding: 0;
        max-width: 100%;
        height: auto;
    }

    .overlay1 {
        display: block;
        position: absolute;
        z-index: 20;
        background: rgba(0, 0, 0, 0.8);
        overflow: hidden;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
        -o-transition: all 0.5s;
        transition: all 0.5s;
    }

    a.close-overlay {
        display: block;
        position: absolute;
        top: 0;
        right: 0;
        z-index: 100;
        width: 45px;
        height: 45px;
        font-size: 20px;
        font-weight: 700;
        color: #fff;
        line-height: 45px;
        text-align: center;
        background-color: #000;
        cursor: pointer;
    }
    a.close-overlay.hidden {
        display: none;
    }

    a.expand {
        display: block;
        position: absolute;
        z-index: 100;
        width: 50px;
        height: 50px;
        border: solid 5px #fff;
        text-align: center;
        color: #fff;
        line-height: 35px;
        font-weight: 700;
        font-size: 20px;
        -webkit-border-radius: 25px;
        -moz-border-radius: 25px;
        -ms-border-radius: 25px;
        -o-border-radius: 25px;
        border-radius: 25px;
    }
    .overlay1 a i
    {
        margin-top: 9px;
    }
    /* ============================================================
      EFFECT 1 - SLIDE IN BOTTOM
    ============================================================ */
    .effect-1 .overlay1 {
        bottom: 0;
        left: 0;
        right: 0;
        width: 100%;
        height: 0;
    }
    .effect-1 .overlay1 a.expand {
        left: 0;
        right: 0;
        bottom: 52%;
        margin: 0 auto -30px auto;
    }
    .effect-1 .img.hover .overlay1 {
        height: 100%;
    }
</style>


<?php
$check = 0;
if (isset($doctorId) && !empty($doctorId)) {
    $check = $doctorId;
}
?>
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
<script src="<?php echo base_url(); ?>assets/js/common_js.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>
<?php
$current = $this->router->fetch_method();
if ($current != 'detailDoctor'):
    ?>
    <script src="<?php echo base_url(); ?>assets/cropper/main.js"></script>
<?php else: ?>

    <script  src="<?php echo base_url(); ?>assets/cropper/common_cropper.js"></script>
    <script src="<?php echo base_url(); ?>assets/cropper/gallery_cropper.js"></script>

<?php endif; ?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script onkeypress="" onkeydown="" type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/x-editable/jquery.xeditable.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>
<script> var doctorId = '<?php echo $check; ?>';
    $("#savebtn").click(function () {
        $("#avatar-modal").modal('hide');
    });
    $('.timepickerclock').timepicker({'defaultTime': false, 'template': true});

    $('.pickDate').datepicker();

    $('.pickDate').datepicker()
            .on('changeDate', function (ev) {
                $('.pickDate').datepicker('hide');
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
</script>
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
        
    $("#editaccount").click(function () {
        $("#detailaccount").toggle();
        $("#newdetailaccount").toggle();
    });
    $("#adddegree").click(function () {
        $("#newdegree").toggle();
    });
    $("#editdegree").click(function () {
        $(".degreedetail").toggle();
        $(".detailnew").toggle();
    });
    $("#addexp").click(function () {
        $("#newexp").toggle();
    });
    $("#editexp").click(function () {
        $(".detailexp").toggle();
        $(".detailexpnew").toggle();
    });
    $(document).ready(function () {
        
        $("#doctorDetailForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/doctor/changeDetailDoctor/';
            var formData = new FormData(this);
            submitData(url,formData);
        });

        $("#addAcademicForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/doctor/addAcademic/';
            var formData = new FormData(this);
            //if (checkAcademicYear('addAcademicForm') == true) {
                submitData(url,formData);
            //}
        });

        $("#changeAcademicForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/doctor/changeAcademic/';
            var formData = new FormData(this);
            //if (checkAcademicYear('changeAcademicForm') == true) {
                submitData(url,formData);
            //}
        });
        
        $("#addServicesForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/doctor/addServices/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
        
        $("#editServiceForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/doctor/editServices/';
            var formData = new FormData(this);
            submitData(url,formData);
        });

        $("#changePasswordForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/doctor/changePassword/';
            var formData = new FormData(this);
            if (checkConfirm('password','confirm') == true) {
                submitData(url,formData);
            }
        });
    });
    
    function doctorDetail(){
        var todayDate = Date.parse(new Date());
        var currentYear = new Date().getFullYear();
        var dob = Date.parse($('#doctors_dob').val());
        if (dob > todayDate) {
            $('#doctors_dob').addClass('bdr-error');
            $("#err_doctors_dob").text("Please Select Correct DOB");
            $('#err_doctors_dob').fadeIn().delay(3000).fadeOut('slow');
            return false;
        }
        var creation = Date.parse($('#doctors_creationTime').val());
        if (creation > todayDate) {
            $('#doctors_creationTime').addClass('bdr-error');
            $("#err_creationTime").text("Please Select Correct Joining Time");
            $('#err_creationTime').fadeIn().delay(3000).fadeOut('slow');
            return false;
        }
        return true;
    }
    
    function checkAcademicYear(formId,feildId,totalCount){
        var count = 0;
        var todayDate = Date.parse(new Date());
        var currentYear = new Date().getFullYear();
        var countsAccademic = $("#"+totalCount).val();
        for(a=1; a <= countsAccademic; a++){
            var year = $('#'+formId).find('input[id="'+feildId+a+'"]').val();
            if (year > currentYear) {
                $('#'+feildId+a).addClass('bdr-error');
                $("#err_"+feildId+a).text("Please Select Correct Year");
                $('#err_'+feildId+a).fadeIn().delay(4000).fadeOut('slow');
                count++;
            }
        }
        if(count == 0){
            return true;
        }else{
            return false;
        }
    }
   
    $(function () {

        $("#setData").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/doctor/availability/';
            var formData = new FormData(this);
            submitData(url, formData);
        });

//        $(".daycheck").click(function () {
//            console.log($(this).val());
//            console.log($(this).is(':checked'));
//            $.ajax({
//                url: '<?php echo site_url('doctor/availability'); ?>',
//                async: false,
//                type: 'POST',
//                data: {'day': $(this).val(), 'is_checked': $(this).is(':checked'), 'userId': '46'},
//                success: function (datas) {
//                    
//                 
//                }
//            });
//
//        });

        $("#geocomplete").geocomplete({
            map: ".map_canvas",
            details: "form",
            types: ["geocode", "establishment"],
        });

        $("#find").click(function () {
            $("#geocomplete").trigger("geocode");
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
<script>
    var urls = "<?php echo base_url() ?>";
    var j = 1;
    var k = 1;
    var counts = 1;
    var countsAccademic = 1;
    
    function fetchCity(stateId) {
        console.log(stateId);
        $.ajax({
            url: urls + 'index.php/doctor/fetchCity',
            type: 'POST',
            data: {'stateId': stateId},
            success: function (datas) {
                // console.log(datas);
                
                if($('#timeCityId').length > 0){
                    console.log(typeof  datas,'inner');
                    $('#timeCityId').html(datas);
                    $('#timeCityId').selectpicker('refresh');
                    
                }
                if($('#doctors_cityId').length > 0){
                    $('#doctors_cityId').html(datas);
                    $('#doctors_cityId').selectpicker('refresh');
                    $('#StateId').val(stateId);
                }
            }
        });

    }
    
    
    function fetchStates(){
            
            var countryId = $('#timeCountryId').val();
            //var stateId = $('#StateId').val();
            
            $.ajax({
               url : urls + 'index.php/doctor/fetchStates',
               type: 'POST',
              data: {'countryId' : countryId},
              success:function(datas){
               // console.log(datas);
                  $('#stateId').html(datas);
                  $('#stateId').selectpicker('refresh');
                  $('#cityId').html('');
                  $('#cityId').selectpicker('refresh');
                  $('#timeCityId').html('');
                  $('#timeCityId').selectpicker('refresh');
                  //$('#StateId').val(stateId);
              }
           });
        }
    
    function check_qap() {
        var qapId = $("#qapId").val();
        $.ajax({
            url: urls + 'index.php/doctor/check_qap',
            type: 'POST',
            async: false,
            data: {'qapId': qapId},
            success: function (datas) {
                if (datas == 0) {
                    $("#qapIdTb").val('');
                    $('#qapId').addClass('bdr-error');
                    $('#error-qapIdTb').fadeIn().delay(3000).fadeOut('slow');
                    return false;
                }else {
                    $('#qapId').removeClass('bdr-error');
                    $('#error-qapIdTb').hide();
                    $("#qapIdTb").val(datas);
                    return true;
                }
            }
        });
    }
    
    function validationDoctor() {
        $("#submitForm").find( ".bdr-error" ).each(function(){
            $(this).removeClass('bdr-error');
        });
        // $("form[name='doctorForm']").submit();
        var todayDate = Date.parse(new Date());
        var currentYear = new Date().getFullYear();
        var check = /^[a-zA-Z\s]+$/;
        var numcheck = /^[0-9]+$/;
        var doctors_fName = $.trim($('#doctors_fName').val());
        var doctors_lName = $.trim($('#doctors_lName').val());
        var emails = $.trim($('#users_email').val());
        var doctorSpecialities_specialitiesId = $.trim($('#doctorSpecialities_specialitiesId').val());
        var doctors_phn1 = $('#doctors_phn1').val();
        var doctors_pinn = $.trim($('#doctors_pinn').val());
        var doctors_cityId = $.trim($('#doctors_cityId').val());
        var doctors_stateId = $.trim($('#doctors_stateId').val());
        
        var pswd = $.trim($("#users_password").val());
        var cnfpswd = $.trim($("#cnfPassword").val());
        var users_mobile = $.trim($('#users_mobile').val());
        var image = $("#avatarInput").val();
        var exp_year = $("#exp_year").val();
        var docatId = $("#docatId").val();
        var qapId = $("#qapId").val();
        var count = 0;
        
        if (image == '') {
            $('#image_select').addClass('bdr-error');
            $('#error-avatarInput').fadeIn().delay(3000).fadeOut('slow');
            count++;
            //status= 0;
            // $('#hospital_name').focus();
        }
        
        if (doctors_fName === '') {
            $('#doctors_fName').addClass('bdr-error');
            $('#error-doctors_fName').fadeIn().delay(3000).fadeOut('slow');
            count++;
            //status= 0;
            // $('#hospital_name').focus();
        }

        if (doctors_lName === '') {
            $('#doctors_lName').addClass('bdr-error');
            $('#error-doctors_lName').fadeIn().delay(3000).fadeOut('slow');
            count++;
            // status= 0;
            // $('#hospital_type').focus();
        }
        
        if ($('#doctors_dob').val() === '') {
            $('#doctors_dob').addClass('bdr-error');
            $('#error-doctors_dob').fadeIn().delay(3000).fadeOut('slow');
            count++;
            //status= 0;
            // $('#hospital_countryId').focus();
        }
        var dob = Date.parse($('#doctors_dob').val());
        if (dob > todayDate) {
            $('#doctors_dob').addClass('bdr-error');
            $("#error-doctors_dob").text("Please Select Correct DOB");
            $('#error-doctors_dob').fadeIn().delay(3000).fadeOut('slow');
            count++;
            //status= 0;
            // $('#hospital_countryId').focus();
        }
        if (doctorSpecialities_specialitiesId === '') {
            $('#s2id_autogen1').addClass('bdr-error');
            $('#error-doctorSpecialities_specialitiesId').fadeIn().delay(3000).fadeOut('slow');
            count++;
        }

        if (doctors_stateId === '') {
            $('#doctors_stateId').addClass('bdr-error');
            $('#error-doctors_stateId').fadeIn().delay(3000).fadeOut('slow');
            count++;
            //status= 0;

        }
        if (doctors_cityId === '') {
            $('#doctors_cityId').addClass('bdr-error');
            $('#error-doctors_cityId').fadeIn().delay(3000).fadeOut('slow');
            count++;
            //status= 0;

        }
        if (doctors_pinn.length < 6) {

            $('#doctors_pinn').addClass('bdr-error');
            $('#error-doctors_pinn').fadeIn().delay(3000).fadeOut('slow');
            count++;
            //status= 0;
            // $('#hospital_zip').focus();
        }
        if ($("#geocomplete1").val() === '') {
            $('#geocomplete1').addClass('bdr-error');
            $('#error-doctor_addr').fadeIn().delay(3000).fadeOut('slow');
            count++;
            //status= 0;
            // $('#hospital_address').focus();
        }
        
        //Academic Start
        countsAccademic = parseInt(countsAccademic);
        for(a=1; a <= countsAccademic; a++){
            if ($('#doctorAcademic_degreeId'+a).val() === '') {
                $('#doctorAcademic_degreeId'+a).addClass('bdr-error');
                $('#error-doctorAcademic_degreeId'+a).fadeIn().delay(3000).fadeOut('slow');
                count++;
            }
            if ($('#doctorSpecialities_specialitiesCatId'+a).val() === '') {
                $('#doctorSpecialities_specialitiesCatId'+a).addClass('bdr-error');
                $('#error-doctorSpecialities_specialitiesCatId'+a).fadeIn().delay(4000).fadeOut('slow');
                count++;
            }
            if ($('#acdemic_addaddress'+a).val() === '') {
                $('#acdemic_addaddress'+a).addClass('bdr-error');
                $('#error-acdemic_addaddress'+a).fadeIn().delay(4000).fadeOut('slow');
                count++;
            }
            if ($('#acdemic_addyear'+a).val() === '') {
                $('#acdemic_addyear'+a).addClass('bdr-error');
                $('#error-acdemic_addyear'+a).fadeIn().delay(4000).fadeOut('slow');
                count++;
            }
            var acdemic_addyear = $('#acdemic_addyear'+a).val();
            if (acdemic_addyear > currentYear) {
                $('#acdemic_addyear'+a).addClass('bdr-error');
                $("#error-acdemic_addyear"+a).text("Please Select Correct Year");
                $('#error-acdemic_addyear'+a).fadeIn().delay(4000).fadeOut('slow');
                count++;
            }
        }
        //Academic End
        //experieans start 
        if (exp_year === '') {
            $('#exp_year').addClass('bdr-error');
            $('#error-exp_year').fadeIn().delay(4000).fadeOut('slow');
            count++;
            //$('#users_email').focus();
        }
        //Experience End
        if (docatId === '') {
            $('#docatId').addClass('bdr-error');
            $('#error-docatId').fadeIn().delay(4000).fadeOut('slow');
            count++;
            //$('#users_email').focus();
        }
        if (qapId === '') {
            $('#qapId').addClass('bdr-error');
            $('#error-qapId').fadeIn().delay(4000).fadeOut('slow');
            count++;
            //$('#users_email').focus();
        }
        if (emails === '') {
            $('#users_email').addClass('bdr-error');
            $('#error-users_email').fadeIn().delay(4000).fadeOut('slow');
            count++;
            //$('#users_email').focus();
        }
        if (!$.isNumeric(users_mobile)) {
            $('#users_mobile').addClass('bdr-error');
            $('#error-users_mobile').fadeIn().delay(3000).fadeOut('slow');
            count++;
            //status= 0;
            // $('#hospital_phn').focus();
        }

        if (pswd.length < 6) {
            $('#users_password').addClass('bdr-error');
            $('#error-users_password').fadeIn().delay(3000).fadeOut('slow');
            count++;
            // $('#users_password').focus();
        }
        if (cnfpswd == '') {
            $('#cnfPassword').addClass('bdr-error');
            $('#error-cnfPassword_check').fadeIn().delay(3000).fadeOut('slow');
            count++;

            // $('#cnfpassword').focus();
        }
        totalService = $("#totalService").val();
        for(a=1;a<=totalService;a++){
            if ($("#doctors_service_"+a).val() == '') {
                $("#doctors_service_"+a).addClass('bdr-error');
                $("#error-doctors_service_"+a).fadeIn().delay(3000).fadeOut('slow');
                count++;
            }
        }
        if (pswd != cnfpswd) {
            $('#cnfPassword').addClass('bdr-error');
            $('#error-cnfPassword_check').fadeIn().delay(3000).fadeOut('slow');
            count++;
            // $('#cnfpassword').focus();
        }
        
        

        setTimeout(function () {
            $(".bdr-error").css( "border-color", "#eee" );
        }, 3000);

        if (emails != '') {
            check_email(emails,count);
            return false;
        }
        return false;

    }

    function check_email(myEmail,count) {

        $.ajax({
            url: urls + 'index.php/doctor/check_email',
            type: 'POST',
            data: {'users_email': myEmail},
            success: function (datas) {
                if (datas == 0) {
                    $('#users_email_status').val(datas);
                    if(count == 0){
                        var erlength = $("form[name='doctorForm']").find('.bdr-error').length;
                        if(erlength > 0){
                            return false;
                        }else{
                            $("form[name='doctorForm']").submit();
                        }
                    }
                    return true;
                }else if (datas == 1) {
                    $('#users_email').addClass('bdr-error');
                    $('#error-users_email_check').fadeIn().delay(3000).fadeOut('slow');
                    ;
                    $('#users_email_status').val(datas);
                    return false;
                }else {
                    $('#users_email_status').val(datas);
                    if(count == 0){
                        $("form[name='doctorForm']").submit();
                    }
                    return true;
                }
            }
        });
    }

    function checkEmailFormat() {
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        var email = $('#users_email').val();
        if (email !== '') {
            if (!filter.test(email)) {
                $('#users_email').addClass('bdr-error');
                $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');
            }
            
            $.ajax({
                url: urls + 'index.php/doctor/check_email',
                type: 'POST',
                data: {'users_email': email},
                success: function (datas) {
                    if (datas == 1) {
                        $('#users_email').addClass('bdr-error');
                        $('#error-users_email_check').fadeIn().delay(5000).fadeOut('slow');
                        ;
                        $('#users_email_status').val(datas);
                        return false;
                    }else {
                        $('#users_email_status').val(datas);
                        $("form[name='hospitalForm']").submit();
                        return true;
                    }
                }
            });
        }
    }
    
    function fetchHospitalSpeciality(hospitalId, numbers) {
        $.ajax({
            url: urls + 'index.php/doctor/fetchHospitalSpeciality',
            type: 'POST',
            //data: {'hospitalId' : hospitalId},
            data: {'hospitalId': hospitalId},
            success: function (datas) {
                //console.log(datas);
                $('#specialityDropdown' + numbers).html(datas);
                // $('#specialityDropdown'+numbers).select2('refresh');

            }
        });
    }
    
    function multipleAcademic() {
        countsAccademic = parseInt(countsAccademic) + 1;
        var divIds = countsAccademic;
        var degreeData = $('#doctorAcademic_degreeId1').html();
        var specialitiesData = $('#doctorSpecialities_specialitiesCatId1').html();
        $('#parentDegreeDiv').append('<div id="childDegreeDiv' + divIds + '"><aside class="row"><label for="cname" class="control-label col-md-4">Degree</label><div class="col-md-4 col-sm-4"><select class="selectpicker" data-width="100%" data-size="4" name="doctorAcademic_degreeId[]" id="doctorAcademic_degreeId' + divIds + '" >' + degreeData + '</select></div><div class="col-md-4 col-sm-4 m-t-xs-10"><select class="selectpicker" data-width="100%" data-size="4" name="doctorSpecialities_specialitiesCatId[]" id="doctorSpecialities_specialitiesCatId' + divIds + '" >' + specialitiesData + '</select></div></aside><aside class="row"><label for="cname" class="control-label col-md-4 m-t-20">Address</label><div class="col-md-8 col-sm-8 m-t-20"><textarea class="form-control" id="acdemic_addaddress' + divIds + '" name="acdemic_addaddress[]" required=""></textarea><label class="error" style="display:none;" id="error-acdemic_addaddress' + divIds + '"> please fill Address</label></div><label for="cname" class="control-label col-md-4 m-t-20">Year</label><div class="col-md-8 col-sm-8 m-b-20 m-t-10"><input class="form-control" name="acdemic_addyear[]" required="" id="acdemic_addyear' + divIds + '" value="" onkeypress="return isNumberKey(event)" maxlength="4"><label class="error" style="display:none;" id="error-acdemic_addyear' + divIds + '"> please fill Year</label></div></aside></div><br />');
        $('.selectpicker').selectpicker({
            width: "100%"
        })

    }

    function multipleService() {
        var i = parseInt($("#totalService").val());
        var j = i + parseInt(1);
        $('#doctorService').append('<div id="doctors_service_div_'+j+'"><label for="" class="control-label col-md-4 col-sm-4"></label><div class="col-md-7 col-sm-7"><input class="form-control" id="doctors_service_'+j+'" name="doctors_service_'+j+'" type="text" maxlength="50"/><label class="error" style="display:none;" id="error-doctors_service_'+j+'"> please enter Service</label><label class="error" ></label></div><div class="col-md-1 col-sm-1"><button id="remove_services_'+j+'" class="btn btn-danger" type="button" href="javascript:void(0);" onclick="removeServices(\''+j+'\');" > <i class="fa fa-minus"></i> </button></div><br /></div>');
        $("#totalService").val(j);
    }
    
    function removeServices(k){
        $("#doctors_service_div_"+k).remove();
        var m = parseInt($("#totalService").val());
        var j = m - parseInt(1);
        $("#remove_services_"+j).show();
        $("#totalService").val(j);
    }
    
    $(document).ready(function () {
        var oTable = $('#doctor_datatable').DataTable({
            "processing": true,
            "bServerSide": true,
            // "searching": true,
            "bLengthChange": false,
            "bProcessing": true,
            "iDisplayLength": 10,
            "bPaginate": true,
            "sPaginationType": "full_numbers",
            "columnDefs": [{
                    "targets": [0,1,2,3,4,5,6,7],
                    "orderable": false
                }],
            "columns": [
                {"data": "doctors_img", "searchable": false, "order": false, orderable: false, width: "8%"},
                {"data": "name"},
                {"data": "doctor_addr"},
                {"data": "specialityName", "width": "8%"},
                {"data": "exp"},
                {"data": "joinDate"},
                {"data": "doctors_phn"},
                {"data": "view", "searchable": false, "order": false, orderable: false, width: "8%"},
            ],
            "ajax": {
                "url": "<?php echo site_url('doctor/getDoctorDl'); ?>",
                "type": "POST",
                "data": function (d) {
                    d.name = $("#search").val();
                    if ($("#doctorSpecialities_specialitiesId").val() != ' ') {
                        d.docSpecialitiesId = $("#doctorSpecialities_specialitiesId").val();
                    }
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                }
            }
        });
        $('#doctorSpecialities_specialitiesId').change(function () {
            oTable.draw();
        });
        $('#search').on('keyup', function () {
            oTable.draw();
        });
    });

    $("#edit").click(function () {
        $("#detail").toggle();
        $("#newDetail").toggle();
    });
</script>    
<script>
    function checkConfirm(val, val2) {

        var pass = $("#" + val).val();
        var conf = $("#" + val2).val();
        
        if (pass != conf) {
            $("#err_" + val2).text("Please enter the same value again.");
            return false;
        } else {
            $("#err_" + val2).html('');
            return true;
        }
    }
    
    function addAcademicNumber() {
        var a = parseInt($("#total_add_academic").val());
        var b = a + parseInt(1);
        $('#appendAcademicDiv').append('<div class="col-md-6" id="academicDiv' + b + '"><aside class="clearfix m-t-10"><select class="selectpicker" data-width="100%" name="degree_addid_' + b + '" id="degree_addid_' + b + '"><option value="">Select Degree</option><?php if(isset($qyura_degree) && $qyura_degree != NULL){foreach ($qyura_degree as $degree){  ?><option value="<?php echo $degree->degree_id ?>"><?php echo $degree->degree_SName; ?></option><?php } } ?></select><label class="error" id="err_degree_addid_' + b + '" ></label></aside><aside class="clearfix m-t-10"><textarea class="form-control" id="acdemic_addaddress_' + b + '" name="acdemic_addaddress_' + b + '" required="" placeholder="College Address"></textarea><label class="error" id="err_acdemic_addaddress_' + b + '" ></label></aside><aside class="clearfix "><input class="form-control" name="acdemic_addyear_' + b + '" required="" id="acdemic_addyear_' + b + '" value="" maxlength="4"><label class="error" id="err_addacdemic_year_' + b + '" placeholder="Year" ></label></aside><article class="clearfix m-t-20 col-sm-3"><button id="remove_academic_'+b+'" class="btn btn-danger btn-block waves-effect waves-light" type="button" href="javascript:void(0);" onclick="removeAcademicNumber(\''+b+'\');" > Remove </button></article></div>');
        if(a !== 1){
            $("#remove_academic_"+a).hide();
        }
        $("#degree_addid_"+b).selectpicker('refresh');
        $("#total_add_academic").val(b);
    }
    
    function removeAcademicNumber(k){
        $("#academicDiv"+k).remove();
        var m = parseInt($("#total_add_academic").val());
        var j = m - parseInt(1);
        $("#remove_academic_"+j).show();
        $("#total_add_academic").val(j);
    }

    function find_speciality (k){
        var h_id = $("#hospital_addid_"+k).val();
        var url = '<?php echo site_url(); ?>/doctor/find_specialities';
        if (typeof h_id == 'string' ){
            $.ajax({
                url: url,
                async: false,
                type: 'POST',
                data: {'h_id': h_id},
                success: function (data) {
                    console.log(data);
                    $("#speciality_"+k).html(data);
                    $("#speciality_"+k).select2({
                        allowClear: true
                    });
                }
            });
        }
    }
    
    function find_speciality_edit (k){
        var h_id = $("#hospital_id_"+k).val();
        var url = '<?php echo site_url(); ?>/doctor/find_specialities';
        if (typeof h_id == 'string' ){
            $.ajax({
                url: url,
                async: false,
                type: 'POST',
                data: {'h_id': h_id},
                success: function (data) {
                    console.log(data);
                    $("#speciality_edit"+k).html(data);
                    $("#speciality_edit"+k).select2({
                        allowClear: true
                    });
                }
            });
        }
    }
     
    function checkValidFileUploads(urls){
       
           var avatar_file = $(".avatar-data").val();
            $.ajax({
              url : urls + 'index.php/doctor/checkFileUploadValidation',
              type: 'POST',
              data:{'avatar_file' : avatar_file},
             success:function(data){
                var obj = $.parseJSON(data);
                if(obj.state == 400){
//                    if(obj.message == 'Please select avtar'){
//                      $("#closeBtn").show();  
//                    }else{
//                      $("#closeBtn").hide();  
//                    }
                    $("#message_upload").html("<div class='alert alert-danger'>"+obj.message+"</div>");
                    $(".close").hide();
                }else{
                    $("#avatar-modal").modal('hide');
                     $("#message_upload").html("");
                }
             }
          });
   }
   
    function IsAdrManual(val) {
        if (val == 1) {
            $("#lat,#lng").removeAttr('readonly')
        } else if (val == 0) {
            $("#lat,#lng").attr('readonly', 'readonly');
        }

    }
    
    function lngChack(str){
          
            
               var filter = /^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{6,14}$/;
                if(str!==''){
                    if (!filter.test(str)){
                        
                         //$('#lat').addClass('bdr-error');
                         $('#error-lng').fadeIn().delay(3000).fadeOut('slow');
                        return false;

                    }else{
                            //$('#lng').removeClass('bdr-error');
                        return true;
                    }
            }
            
        }
        
    function latChack(str){
          
            
               var filter = /^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{6,7}$/;
                if(str!==''){
                    if (!filter.test(str)){
                        
                         //$('#lat').addClass('bdr-error');
                        $('#error-lat').fadeIn().delay(3000).fadeOut('slow');
                        return false;

                    }else{
                            //$('#lng').removeClass('bdr-error');
                        return true;
                    }
            }
            
        }
    function imageChange(){
        $("#image_div").toggle();
        $("#image_btn").toggle();
    }    
</script>
<?php
$this->load->view("doctor/timeslotScript");
$current = $this->router->fetch_method();
if ($current == 'doctorDetails'){ ?>
    <script>
    $(document).ready(function () {
        $("#submitForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/doctor/changeImageDoctor/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
    });
    function validationImageDoctor (){
        var image = $("#avatarInput").val();
        if (image == '') {
            $('#image_select').addClass('bdr-error');
            $('#error-avatarInput').fadeIn().delay(3000).fadeOut('slow');
            return false;
        }else{
            return true;
        }
    }
    </script>
<?php } ?>
</body>

</html>
