<style type="text/css">
    #doctor_datatable_filter
    {
        display:none;
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
            submitData(url,formData);
        });

        $("#changeAcademicForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/doctor/changeAcademic/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
        
        $("#addExperienceForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/doctor/addExperience/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
        
        $("#editExperienceForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/doctor/editExperience/';
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

    $(".bs-select").select2({placeholder: "Select a Speciality",
        allowClear: true
    });

</script>
<script>
    var urls = "<?php echo base_url() ?>";
    var j = 1;
    var k = 1;
    var counts = 1;
    var countsAccademic = 1;
    function fetchCity(stateId) {

        $.ajax({
            url: urls + 'index.php/doctor/fetchCity',
            type: 'POST',
            data: {'stateId': stateId},
            success: function (datas) {
                // console.log(datas);
                $('#doctors_cityId').html(datas);
                $('#doctors_cityId').selectpicker('refresh');
                $('#StateId').val(stateId);
            }
        });

    }

    function addMobileNumber() {
        j = parseInt(j + 1);
        $('#multipleMobile').append('<div id=' + j + '><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4"></label><div class="col-md-8 col-sm-8"><aside class="row"> <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><select class="selectpicker" data-width="100%" name="preMobileNumber[]" id=preMobileNumber' + j + '><option value="91">+91</option><option value="1">+1</option></select></div><div class="col-lg-7 col-md-7 col-sm-7 col-xs-10 m-t-xs-10"><input type="text" class="form-control" name="doctors_mobile[]" id=doctors_mobile' + j + ' placeholder="9837000123" maxlength="10" onkeypress="return isNumberKey(event)" onblur=checkNumber("doctors_mobile",' + j + ') /></div></aside><br /> <aside class="checkbox checkbox-success"><input type="checkbox" value="1" id="checkbox' + j + '" name="checkbox' + j + '"><label for="checkbox3">Make this number primary</label></aside></div></article></div>');
        $('#preMobileNumber' + j).selectpicker('refresh');
    }
    
    function addPhoneNumber() {
        k = parseInt(k + 1);
        $('#multiplePhoneNumber').append('<div id=phoneDiv' + k + '<article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4 col-sm-4"></label><div class="col-md-8 col-sm-8"><aside class="row"><div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><select class="selectpicker" data-width="100%" name="preNumber[]" id=preNumber' + k + '><option value=91>+91</option><option value=1>+1</option> </select></div><div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 m-t-xs-10"> <input type="text" class="form-control" name="midNumber[]" id=midNumber' + k + ' placeholder="731" maxlength="3" onkeypress="return isNumberKey(event)" onblur=checkNumber("midNumber",' + k + ') /></div> <div class="col-md-4 col-sm-4 col-xs-10 m-t-xs-10 "><input type="text" class="form-control" name="doctors_phn[]" id=doctors_phn' + k + ' placeholder="7000123" maxlength="8" onkeypress="return isNumberKey(event)" onblur=checkNumber("doctors_phn",' + k + ') /></div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 m-t-xs-10"></div></aside></div></article></div>');
        $('#preNumber' + k).selectpicker('refresh');
    }

    function checkNumber(inputName, ids) {

        var mobileNumber = 0;
        if (ids != '')
            mobileNumber = $('#' + inputName + ids).val();
        else
            mobileNumber = $('#' + inputName).val();
        // alert(mobileNumber);
        if (!$.isNumeric(mobileNumber)) {

            if (ids != '') {
                $('#' + inputName + ids).addClass('bdr-error');
                $('#' + inputName + ids).val('');
            }
            else {
                $('#' + inputName).addClass('bdr-error');
                $('#' + inputName).val('');
            }
            // $('#error-users_mobile').fadeIn().delay(3000).fadeOut('slow');
            // $('#hospital_phn').focus();
        }
    }
    function validationDoctor() {
        // $("form[name='doctorForm']").submit();
        var check = /^[a-zA-Z\s]+$/;
        var numcheck = /^[0-9]+$/;
        var doctors_fName = $.trim($('#doctors_fName').val());
        var doctors_lName = $.trim($('#doctors_lName').val());
        var emails = $.trim($('#users_email').val());
        var doctorSpecialities_specialitiesId = $.trim($('#doctorSpecialities_specialitiesId').val());
        var midNumber1 = $('#midNumber1').val();
        var doctors_phn1 = $('#doctors_phn1').val();
        var doctors_mobile1 = $('#doctors_mobile1').val();
        var doctors_pinn = $.trim($('#doctors_pinn').val());
        var doctors_cityId = $.trim($('#doctors_cityId').val());
        var doctors_stateId = $.trim($('#doctors_stateId').val());
        var doctors_consultaionFee = $.trim($('#doctors_consultaionFee').val());
        var pswd = $.trim($("#users_password").val());
        var cnfpswd = $.trim($("#cnfPassword").val());
        var users_mobile = $.trim($('#users_mobile').val());


        if (doctors_fName === '') {
            $('#doctors_fName').addClass('bdr-error');
            $('#error-doctors_fName').fadeIn().delay(3000).fadeOut('slow');
            //status= 0;
            // $('#hospital_name').focus();
        }

        if (doctors_lName === '') {
            $('#doctors_lName').addClass('bdr-error');
            $('#error-doctors_lName').fadeIn().delay(3000).fadeOut('slow');
            // status= 0;
            // $('#hospital_type').focus();
        }

        if ($('#doctors_dob').val() === '') {
            $('#doctors_dob').addClass('bdr-error');
            $('#error-doctors_dob').fadeIn().delay(3000).fadeOut('slow');
            //status= 0;
            // $('#hospital_countryId').focus();
        }

        if (doctorSpecialities_specialitiesId === '') {
            // console.log("in state");
            $('#s2id_autogen1').addClass('bdr-error');
            $('#error-doctorSpecialities_specialitiesId').fadeIn().delay(3000).fadeOut('slow');
            //status= 0;
            // $('#hospital_stateId').focus();
        }

        if (!$.isNumeric(midNumber1) && !$.isNumeric(doctors_phn1)) {
            $('#doctors_phn1').addClass('bdr-error');
            $('#midNumber1').addClass('bdr-error');
            $('#error-doctors_phn1').fadeIn().delay(3000).fadeOut('slow');
            //status= 0;
            // $('#hospital_cityId').focus();
        }
        if (!$.isNumeric(doctors_mobile1)) {
            $('#doctors_mobile1').addClass('bdr-error');
            $('#error-doctors_mobile1').fadeIn().delay(3000).fadeOut('slow');
            //status= 0;
            // $('#hospital_cityId').focus();
        }
        if (doctors_stateId === '') {
            $('#doctors_stateId').addClass('bdr-error');
            $('#error-doctors_stateId').fadeIn().delay(3000).fadeOut('slow');
            //status= 0;

        }
        if (doctors_cityId === '') {
            $('#doctors_cityId').addClass('bdr-error');
            $('#error-doctors_cityId').fadeIn().delay(3000).fadeOut('slow');
            //status= 0;

        }
        if (doctors_pinn.length < 6) {

            $('#doctors_pinn').addClass('bdr-error');
            $('#error-doctors_pinn').fadeIn().delay(3000).fadeOut('slow');
            //status= 0;
            // $('#hospital_zip').focus();
        }
        if ($("#geocomplete").val() === '') {
            $('#geocomplete').addClass('bdr-error');
            $('#error-doctor_addr').fadeIn().delay(3000).fadeOut('slow');
            //status= 0;
            // $('#hospital_address').focus();
        }
        if (!$.isNumeric(doctors_consultaionFee)) {
            $('#doctors_consultaionFee').addClass('bdr-error');
            $('#error-doctors_consultaionFee').fadeIn().delay(3000).fadeOut('slow');
            //status= 0;
            // $('#hospital_phn').focus();
        }
        if ($('#doctorAcademic_degreeId1').val() === '') {
            $('#doctorAcademic_degreeId1').addClass('bdr-error');
            $('#error-doctorAcademic_degreeId1').fadeIn().delay(3000).fadeOut('slow');
        }
        if ($('#doctorSpecialities_specialitiesCatId1').val() === '') {
            $('#doctorSpecialities_specialitiesCatId1').addClass('bdr-error');
            $('#error-doctorSpecialities_specialitiesCatId1').fadeIn().delay(4000).fadeOut('slow');
        }
        if ($('#professionalExp_end1').val() === '') {
            $('#professionalExp_end1').addClass('bdr-error');
            $('#error-professionalExp_end1').fadeIn().delay(4000).fadeOut('slow');
        }
        if ($('#professionalExp_start1').val() === '') {
            $('#professionalExp_start1').addClass('bdr-error');
            $('#error-professionalExp_start1').fadeIn().delay(4000).fadeOut('slow');
        }
        if ($('#HospitalSpecialityId').val() === '') {
            $('#HospitalSpecialityId').addClass('bdr-error');
            $('#error-HospitalSpecialityId').fadeIn().delay(4000).fadeOut('slow');
        }
        if ($('#specialityDropdown1').val() === '') {
            $('#specialityDropdown1').addClass('bdr-error');
            $('#error-specialityDropdown1').fadeIn().delay(4000).fadeOut('slow');
        }
        if (emails === '') {
            $('#users_email').addClass('bdr-error');
            $('#error-users_email').fadeIn().delay(4000).fadeOut('slow');
            //$('#users_email').focus();
        }
        if (!$.isNumeric(users_mobile)) {
            $('#users_mobile').addClass('bdr-error');
            $('#error-users_mobile').fadeIn().delay(3000).fadeOut('slow');
            //status= 0;
            // $('#hospital_phn').focus();
        }

        if (pswd.length < 6) {
            $('#users_password').addClass('bdr-error');
            $('#error-users_password').fadeIn().delay(3000).fadeOut('slow');
            // $('#users_password').focus();
        }
        if (cnfpswd == '') {
            $('#cnfPassword').addClass('bdr-error');
            $('#error-cnfPassword_check').fadeIn().delay(3000).fadeOut('slow');

            // $('#cnfpassword').focus();
        }

        if (pswd != cnfpswd) {
            $('#cnfPassword').addClass('bdr-error');
            $('#error-cnfPassword_check').fadeIn().delay(3000).fadeOut('slow');

            // $('#cnfpassword').focus();
        }



        if (emails != '') {
            check_email(emails);
            return false;
        }
        return false;

    }

    function check_email(myEmail) {

        $.ajax({
            url: urls + 'index.php/doctor/check_email',
            type: 'POST',
            data: {'users_email': myEmail},
            success: function (datas) {
                if (datas == 0) {
                    $("form[name='doctorForm']").submit();
                    return true;
                }
                else if (datas == 1) {
                    $('#users_email').addClass('bdr-error');
                    $('#error-users_email_check').fadeIn().delay(3000).fadeOut('slow');
                    ;
                    // $('#users_email').focus();
                    return false;
                }
                else {
                    $('#users_email_status').val(datas);
                    $("form[name='hospitalForm']").submit();
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
                ;
                // $('#users_email').focus();

            }
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

    function multipleProfessionalExp() {
        counts = parseInt(counts) + 1;
        var ids = counts;
        var hospitalData = $('#HospitalSpecialityId').html();

        $('#parentDIV').append('<div id=child' + ids + '><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4">Duration:</label><div class="col-md-8"><aside class="row"><div class="col-lg-6 col-md-12 col-sm-6"><div class="input-group"><input class="form-control pickDate" placeholder="dd/mm/yyyy" id=professionalExp_start' + ids + ' type="text" name=professionalExp_start' + ids + '><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span></div></div><div class="col-lg-6 col-md-12 col-sm-6 m-t-md-15 m-t-xs-10"><div class="input-group"><input class="form-control pickDate" placeholder="dd/mm/yyyy" id=professionalExp_end' + ids + ' type="text" name=professionalExp_end' + ids + '><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span></div></div></aside></div></article><article class="form-group m-lr-0"><div class="col-md-8 col-md-offset-4"><select class="select2" data-width="100%" onchange="fetchHospitalSpeciality(this.value,' + ids + ')" id=professionalExp_hospitalId' + ids + ' name=professionalExp_hospitalId' + ids + '>' + hospitalData + '</select></div></article><article class="form-group m-lr-0 "><div class="col-md-8 col-md-offset-4"><select  multiple="" class="bs-select form-control-select2 " data-width="100%" name=doctorSpecialities_specialitiesId' + ids + '[] id=specialityDropdown' + ids + ' data-size="4"></select></div></article></div>');
        $('#professionalExp_hospitalId' + ids).select2({
            width: '100%'
        });

        $('#specialityDropdown' + ids).select2({placeholder: "Select a Speciality",
            allowClear: true
        });
        $('#professionalExp_start' + ids).datepicker();
        $('#professionalExp_end' + ids).datepicker();

        $('#ProfessionalExpCount').val(counts);
    }
    
    function multipleAcademic() {
        countsAccademic = parseInt(countsAccademic) + 1;
        var divIds = countsAccademic;
        var degreeData = $('#doctorAcademic_degreeId1').html();
        var specialitiesData = $('#doctorSpecialities_specialitiesCatId1').html();
        $('#parentDegreeDiv').append('<div id="childDegreeDiv' + divIds + '"><aside class="row"><label for="cname" class="control-label col-md-4">Degree</label><div class="col-md-4 col-sm-4"><select class="selectpicker" data-width="100%" data-size="4" name="doctorAcademic_degreeId[]">' + degreeData + '</select></div><div class="col-md-4 col-sm-4 m-t-xs-10"><select class="selectpicker" data-width="100%" data-size="4" name="doctorSpecialities_specialitiesCatId[]">' + specialitiesData + '</select></div></aside><aside class="row"><label for="cname" class="control-label col-md-4 m-t-20">Address</label><div class="col-md-8 col-sm-8 m-t-20"><textarea class="form-control" id="acdemic_addaddress' + divIds + '" name="acdemic_addaddress[]" required=""></textarea><label class="error" id="err_acdemic_addaddress' + divIds + '" ></label></div><label for="cname" class="control-label col-md-4">Year</label><div class="col-md-8 col-sm-8 m-b-20"><input class="form-control" name="acdemic_addyear[]" required="" id="acdemic_addyear' + divIds + '" value="" onkeypress="return isNumberKey(event)" ><label class="error" id="err_addacdemic_year' + divIds + '" ></label></div></aside></div><br />');
        $('.selectpicker').selectpicker({
            width: "100%"
        })

    }

    function multipleService() {
        $('#doctorService').append('<label for="" class="control-label col-md-4 col-sm-4"></label><div class="col-md-8 col-sm-8"><input class="form-control" name="doctors_service[]" type="text" value="<?php echo set_value('doctors_service[]'); ?>" maxlength="50"/><label class="error" style="display:none;" id="error-doctors_service"> please enter Service</label><label class="error" ></label></div><br />');
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
                    "targets": [0, 5],
                    "orderable": false
                }],
            "columns": [
                {"data": "doctors_img", "searchable": false, "order": false, orderable: false, width: "8%"},
                {"data": "name"},
                {"data": "doctor_addr"},
                {"data": "specialityName"},
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
        $('#appendAcademicDiv').append('<div class="col-md-6" id="academicDiv' + b + '"><aside class="clearfix m-t-10"><select class="selectpicker" data-width="100%" name="degree_addid_' + b + '" id="degree_addid_' + b + '"><option value="">Select Degree</option><?php if(isset($qyura_degree) && $qyura_degree != NULL){foreach ($qyura_degree as $degree){  ?><option value="<?php echo $degree->degree_id ?>"><?php echo $degree->degree_SName; ?></option><?php } } ?></select><label class="error" id="err_degree_addid_' + b + '" ></label></aside><aside class="clearfix m-t-10"><textarea class="form-control" id="acdemic_addaddress_' + b + '" name="acdemic_addaddress_' + b + '" required=""></textarea><label class="error" id="err_acdemic_addaddress_' + b + '" ></label></aside><aside class="clearfix m-t-10"><input class="form-control" name="acdemic_addyear_' + b + '" required="" id="acdemic_addyear_' + b + '" value=""><label class="error" id="err_addacdemic_year_' + b + '" ></label></aside><article class="clearfix m-t-20 col-sm-3"><button id="remove_academic_'+b+'" class="btn btn-danger btn-block waves-effect waves-light" type="button" href="javascript:void(0);" onclick="removeAcademicNumber(\''+b+'\');" > Remove </button></article></div>');
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
    function addMobileNumberGen() {
        var m = parseInt($("#total_mobile").val());
        var j = m + parseInt(1);
        $('#multipleMobile').append('<div id="mobileDiv' + j + '"><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-3 col-sm-3"></label><div class="col-md-8 col-sm-8"><aside class="row"> <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><select class="selectpicker" data-width="100%" name="preMobileNumber[]" id=preMobileNumber' + j + '><option value="91">+91</option><option value="1">+1</option></select></div><div class="col-lg-4 col-md-4 col-sm-4 col-xs-10 m-t-xs-10"><input type="text" class="form-control" name="doctors_mobile[]" id="doctors_mobile' + j + '" placeholder="9837000123" maxlength="10" onkeypress="return isNumberKey(event)" onblur=checkNumber("doctors_mobile",' + j + ') /></div><a class=" col-md-2 " onclick="removeMobileNumber('+j +')"><i class="fa fa-minus-circle fa-2x m-t-5 label-minus"></i></a></aside><br /><label class="error" style="display:none;" id="er_doctors_mobile' + j + '"> Please enter another Mobile no.</label> <aside class="checkbox checkbox-success"><input type="checkbox" value="1" id="checkbox' + j + '" name="checkbox' + j + '"><label for="checkbox3">Make this number primary</label></aside></div></article></div>');
        $('#preMobileNumber' + j).selectpicker('refresh');
        $("#total_mobile").val(j);
    }
    function removeMobileNumber(k){
        $("#mobileDiv"+k).remove();
        var m = parseInt($("#total_mobile").val());
        var j = m - parseInt(1);
        $("#total_mobile").val(j);
    }
    function addPhoneNumberGen() {
        var m = parseInt($("#total_phone").val());
        var k = m + parseInt(1);
        $('#multiplePhoneNumber').append('<div id="phoneDiv' + k + '"><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-3 col-sm-3"></label><div class="col-md-8 col-sm-8"><aside class="row"><div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><select class="selectpicker" data-width="100%" name="preNumber[]" id=preNumber' + k + '><option value=91>+91</option><option value=1>+1</option> </select></div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 m-t-xs-10"> <input type="text" class="form-control" name="midNumber[]" id=midNumber' + k + ' placeholder="731" maxlength="3" onkeypress="return isNumberKey(event)" onblur=checkNumber("midNumber",' + k + ') /></div> <div class="col-md-2 col-sm-2 col-xs-10 m-t-xs-10 "><input type="text" class="form-control" name="doctors_phn[]" id=doctors_phn' + k + ' placeholder="7000123" maxlength="8" onkeypress="return isNumberKey(event)" onblur=checkNumber("doctors_phn",' + k + ') /></div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 m-t-xs-10"><a onclick="removePhoneNumber('+k+')"><i class="fa fa-minus-circle fa-2x m-t-5 label-minus"></i></a></div></aside><label class="error" style="display:none;" id="er_doctors_phn' + k + '"> Please enter another phone no.</label></div></article></div>');
        $('#preNumber' + k).selectpicker('refresh');
        $("#total_phone").val(k);
    }
    function removePhoneNumber(k) {
        $('#phoneDiv' + k ).remove();
        var m = parseInt($("#total_phone").val());
        var j = m - parseInt(1);
        $("#total_phone").val(j);
    }
    function addExprNumberGen() {
        var m = parseInt($("#total_add_exp").val());
        var k = m + parseInt(1);
        $('#expDiv').append('<div id="expDivAdd' + k + '"><aside class="clearfix m-t-10"><select class="selectpicker" data-width="100%" name="hospital_addid_' + k + '" id="hospital_addid_' + k + '" onchange="find_speciality(' + k + ')"><option value="">Select Degree</option><?php if(isset($qyura_hospital) && $qyura_hospital != NULL){foreach ($qyura_hospital as $hospital){  ?><option value="<?php echo $hospital->hospital_id ?>"><?php echo $hospital->hospital_name; ?></option><?php } } ?></select><label class="error" id="err_hospital_addid_' + k + '" ></label></aside><aside class="clearfix m-t-10"><input class="form-control" name="designation_' + k + '" id="designation_' + k + '" required="" value="" placeholder="Designation"><label class="error" id="err_designation_' + k + '" ></label></aside><aside class="clearfix m-t-10"><select class="select2" data-placeholder="Choose a Speciality" data-width="100%" multiple="" id="speciality_' + k + '" name="speciality' + k +'[]"></select><label class="error" id="err_speciality_' + k + '" ></label></aside><aside class="row row-minus m-t-10"><div class="col-sm-6"><input class="form-control datepicker pickDate" name="exp_start_' + k + '" id="exp_start_' + k + '" required="" value="<?php echo date("d/m/Y"); ?>" ><label class="error" id="err_exp_start_' + k + '" ></label></div><div class="col-sm-6"><input class="form-control datepicker pickDate" name="exp_end_' + k + '" id="exp_end_' + k + '" required="" value="<?php echo date("d/m/Y") ?>"><label class="error" id="err_exp_end_' + k + '" ></label></div></aside><article class="clearfix m-t-10 col-sm-3"><button id="remove_exp_'+k+'" class="btn btn-danger btn-block waves-effect waves-light" type="button" href="javascript:void(0);" onclick="removeExprNumber(\''+k+'\');" > Remove </button></article></div>');
        if(m !== 1){
            $("#remove_exp_"+m).hide();
        }
        $('#hospital_addid_' + k).select2({
            allowClear: true
        });
        $('#speciality_' + k).select2({
            allowClear: true
        });
        $("#total_add_exp").val(k);
    }
    function removeExprNumber(k) {
        $("#expDivAdd"+k).remove();
        var m = parseInt($("#total_add_exp").val());
        var j = m - parseInt(1);
        $("#remove_exp_"+j).show();
        $("#total_add_exp").val(j);
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
                    $("#speciality_edit_"+k).html(data);
                    $("#speciality_edit_"+k).select2({
                        allowClear: true
                    });
                }
            });
        }
    }
</script>
</body>

</html>
