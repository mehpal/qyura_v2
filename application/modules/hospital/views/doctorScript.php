<style type="text/css">
    #doctor_datatable_filter
    {
        display:none;
    }
</style>



<script src="http://code.jquery.com/jquery-latest.min.js"
        type="text/javascript"></script>
        
        <script src="<?php echo base_url(); ?>assets/vendor/timepicker/bootstrap-timepicker.js"></script>
        
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js">
</script>

<script src="<?php echo base_url(); ?>assets/js/pages/add-doctor.js" type="text/javascript"></script>


<script> 
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

  

</script>
<script>
    var urls = "<?php echo base_url() ?>";
    var j = 1;
    var k = 1;
    var counts = 1;
    var countsAccademic = 1;
    function fetchCityDoctor(stateId) {

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

    function checkNumber(inputName, ids) {

        var mobileNumber = 0;
        if (ids != '')
            mobileNumber = $('#' + inputName + ids).val();
        else
            mobileNumber = $('#' + inputName).val();
        
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
        var hospitalData = $('#HospitalSpecialityId1').html();
        
        $('#parentDIV').append('<div id="child' + ids + '"><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-4">Duration:</label><div class="col-md-8"><aside class="row"><div class="col-lg-6 col-md-12 col-sm-6"><div class="input-group"><input class="form-control pickDate" placeholder="dd/mm/yyyy" id="professionalExp_start' + ids + '" type="text" name="professionalExp_start' + ids + '"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span></div></div><div class="col-lg-6 col-md-12 col-sm-6 m-t-md-15 m-t-xs-10"><div class="input-group"><input class="form-control pickDate" placeholder="dd/mm/yyyy" id="professionalExp_end' + ids + '" type="text" name="professionalExp_end' + ids + '"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span></div></div></aside></div></article><article class="form-group m-lr-0"><div class="col-md-8 col-md-offset-4"><select class="select2" data-width="100%" onchange="fetchHospitalSpeciality(this.value,' + ids + ')" id="professionalExp_hospitalId' + ids + '" name="professionalExp_hospitalId' + ids + '">' + hospitalData + '</select></div></article><article class="form-group m-lr-0 "><div class="col-md-8 col-md-offset-4"><select  multiple="" class="bs-select form-control-select2 " data-width="100%" name="doctorSpecialities_specialitiesId' + ids + '[]" id="specialityDropdown' + ids + '" data-size="4"></select></div></article><aside class="row"><label for="cname" class="control-label col-md-4 m-t-10">Designation</label><div class="col-md-8 col-sm-8 m-b-20 m-t-10"><input class="form-control" name="designation' + ids + '" required="" id="designation' + ids + '" value="" ><label class="error" style="display:none;" id="error-designation' + ids + '"> please fill Designation</label></div></aside></div>');
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
        $('#parentDegreeDiv').append('<div id="childDegreeDiv' + divIds + '"><aside class="row"><label for="cname" class="control-label col-md-4">Degree</label><div class="col-md-4 col-sm-4"><select class="select2" data-width="100%" data-size="4" name="doctorAcademic_degreeId[]" id="doctorAcademic_degreeId' + divIds + '" >' + degreeData + '</select></div><div class="col-md-4 col-sm-4 m-t-xs-10"><select class="select2" data-width="100%" data-size="4" name="doctorSpecialities_specialitiesCatId[]" id="doctorSpecialities_specialitiesCatId' + divIds + '" >' + specialitiesData + '</select></div></aside><aside class="row"><label for="cname" class="control-label col-md-4 m-t-20">Address</label><div class="col-md-8 col-sm-8 m-t-20"><textarea class="form-control" id="acdemic_addaddress' + divIds + '" name="acdemic_addaddress[]" required=""></textarea><label class="error" style="display:none;" id="error-acdemic_addaddress' + divIds + '"> please fill Address</label></div><label for="cname" class="control-label col-md-4 m-t-20">Year</label><div class="col-md-8 col-sm-8 m-b-20 m-t-10"><input class="form-control" name="acdemic_addyear[]" required="" id="acdemic_addyear' + divIds + '" value="" onkeypress="return isNumberKey(event)" maxlength="4"><label class="error" style="display:none;" id="error-acdemic_addyear' + divIds + '"> please fill Year</label></div></aside><aside class="col-sm-2 text-right"><a id="btn-service2" href="javascript:void(0)" class="gadd"><i class="fa fa-minus-circle fa-2x m-t-5 label-plus"></i></a></aside></div><br />');
        $('.select2').select2({
            width: "100%"
        })
        
         $('.gadd').on('click', function() {
            $(this).parent().parent().remove();
     });

    }


    function multipleAcademicForDoctor() {
        countsAccademic = parseInt(countsAccademic) + 1;
        var divIds = countsAccademic;
        var degreeData = $('#doctorAcademic_degreeId2').html();
        var specialitiesData = $('#doctorSpecialities_specialitiesCatId2').html();
        $('#parentDegreeDiv2').append('<div id="childDegreeDiv2' + divIds + '"><aside class="row"><label for="cname" class="control-label col-md-4">Degree</label><div class="col-md-4 col-sm-4"><select class="selectpicker" data-width="100%" data-size="4" name="doctorAcademic_degreeId[]" id="doctorAcademic_degreeId' + divIds + '" >' + degreeData + '</select></div><div class="col-md-4 col-sm-4 m-t-xs-10"><select class="selectpicker" data-width="100%" data-size="4" name="doctorSpecialities_specialitiesCatId[]" id="doctorSpecialities_specialitiesCatId' + divIds + '" >' + specialitiesData + '</select></div></aside><aside class="row"><label for="cname" class="control-label col-md-4 m-t-20">Address</label><div class="col-md-8 col-sm-8 m-t-20"><textarea class="form-control" id="acdemic_addaddress' + divIds + '" name="acdemic_addaddress[]" required=""></textarea><label class="error" style="display:none;" id="error-acdemic_addaddress' + divIds + '"> please fill Address</label></div><label for="cname" class="control-label col-md-4 m-t-20">Year</label><div class="col-md-8 col-sm-8 m-b-20 m-t-10"><input class="form-control" name="acdemic_addyear[]" required="" id="acdemic_addyear' + divIds + '" value="" onkeypress="return isNumberKey(event)" maxlength="4"><label class="error" style="display:none;" id="error-acdemic_addyear' + divIds + '"> please fill Year</label></div></aside></div><br />');
        $('.selectpicker').selectpicker({
            width: "100%"
        })

    }
    
    
        function multipleAcademicForEditDoctor() {
        countsAccademic = parseInt(countsAccademic) + 1;
        var divIds = countsAccademic;
        var degreeData = $('#doctorAcademic_degreeId2').html();
        var specialitiesData = $('#doctorSpecialities_specialitiesCatId2').html();
        $('#mostParent').last().append('<div id="parentDegreeDiv2"><div id="childDegreeDiv2' + divIds + '"><aside class="row"><label for="cname" class="control-label col-md-4">Degree</label><div class="col-md-4 col-sm-4"><select class="selectpicker" data-width="100%" data-size="4" name="doctorAcademic_degreeId[]" id="doctorAcademic_degreeId' + divIds + '" >' + degreeData + '</select></div><div class="col-md-4 col-sm-4 m-t-xs-10"><select class="selectpicker" data-width="100%" data-size="4" name="doctorSpecialities_specialitiesCatId[]" id="doctorSpecialities_specialitiesCatId' + divIds + '" >' + specialitiesData + '</select></div></aside><aside class="row"><label for="cname" class="control-label col-md-4 m-t-20">Address</label><div class="col-md-8 col-sm-8 m-t-20"><textarea class="form-control" id="acdemic_addaddress' + divIds + '" name="acdemic_addaddress[]" required=""></textarea><label class="error" style="display:none;" id="error-acdemic_addaddress' + divIds + '"> please fill Address</label></div><label for="cname" class="control-label col-md-4 m-t-10">Year</label><div class="col-md-8 col-sm-8  m-t-10"><input class="form-control" name="acdemic_addyear[]" required="" id="acdemic_addyear' + divIds + '" value="" onkeypress="return isNumberKey(event)" maxlength="4"><label class="error" style="display:none;" id="error-acdemic_addyear' + divIds + '"> please fill Year</label></div></aside><aside class="col-sm-8 pull-right text-right"><a id="btn-service2" href="javascript:void(0)" title="Remove Degree" class="gadd"><i class="fa fa-minus-circle fa-2x m-t-5 label-plus pull-right"></i></a></aside></div></div><br />');
        $('.selectpicker').selectpicker({
            width: "100%"
        })
        
         $('.gadd').on('click', function() {
            $(this).parent().parent().parent().remove();
       });

    }
    


</script>    
<script>
   
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
    function addMobileNumberGen() {
        var m = parseInt($("#total_mobile").val());
        var j = m + parseInt(1);
        $('#multipleMobile').append('<div id="mobileDiv' + j + '"><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-3 col-sm-3"></label><div class="col-md-8 col-sm-8"><aside class="row"> <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><select class="selectpicker" data-width="100%" name="preMobileNumber[]" id=preMobileNumber' + j + '><option value="91">+91</option></select></div><div class="col-lg-4 col-md-4 col-sm-4 col-xs-10 m-t-xs-10"><input type="text" class="form-control" name="doctors_mobile[]" id="doctors_mobile' + j + '" placeholder="9837000123" maxlength="10" onkeypress="return isNumberKey(event)" onblur=checkNumber("doctors_mobile",' + j + ') /></div><a class=" col-md-2 " onclick="removeMobileNumber('+j +')"><i class="fa fa-minus-circle fa-2x m-t-5 label-minus"></i></a></aside><br /><label class="error" style="display:none;" id="er_doctors_mobile' + j + '"> Please enter another Mobile no.</label> <aside class="checkbox checkbox-success"><input type="checkbox" value="1" id="checkbox' + j + '" name="checkbox' + j + '"><label for="checkbox3">Make this number primary</label></aside></div></article></div>');
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
        $('#multiplePhoneNumber').append('<div id="phoneDiv' + k + '"><article class="form-group m-lr-0"><label for="cname" class="control-label col-md-3 col-sm-3"></label><div class="col-md-8 col-sm-8"><aside class="row"><div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><select class="selectpicker" data-width="100%" name="preNumber[]" id=preNumber' + k + '><option value=91>+91</option></select></div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 m-t-xs-10"> <input type="text" class="form-control" name="midNumber[]" id=midNumber' + k + ' placeholder="731" maxlength="3" onkeypress="return isNumberKey(event)" onblur=checkNumber("midNumber",' + k + ') /></div> <div class="col-md-2 col-sm-2 col-xs-10 m-t-xs-10 "><input type="text" class="form-control" name="doctors_phn[]" id=doctors_phn' + k + ' placeholder="7000123" maxlength="8" onkeypress="return isNumberKey(event)" onblur=checkNumber("doctors_phn",' + k + ') /></div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 m-t-xs-10"><a onclick="removePhoneNumber('+k+')"><i class="fa fa-minus-circle fa-2x m-t-5 label-minus"></i></a></div></aside><label class="error" style="display:none;" id="er_doctors_phn' + k + '"> Please enter another phone no.</label></div></article></div>');
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
</script>
<?php
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
 <script>
    var urls = "<?php echo base_url() ?>";
    $(document).ready(function () {
    $("#submitFormDoctor").validate({
        
      errorPlacement: function(error, element) {
        if (element.attr("name") == "doctor_photo")
        {
            error.insertAfter('.error-label');
        }
        else{
            error.insertAfter(element);
        }
        },
        rules: {
            doctors_phn: {
                minlength: 10
            },
            doctors_fName: {
                required: true
            },
            doctors_lName: {
                required : true
            },
             doctor_photo: {
                required : true
            },
            'doctorSpecialities_specialitiesId[]': {
                required: true
            },
            
       'doctorAcademic_degreeId[]':{
         
           required: true
      },
      'doctorSpecialities_specialitiesCatId[]':{
         
           required: true
      },
      'acdemic_addaddress[]':{
         
           required: true
      },
      'acdemic_addyear[]':{
         
           required: true
      },
      exp_year: {
        required: true,
      }, 
      fee: {
        required: true,
                            
      }    
        },
        messages: {
            
            doctors_fName: {
                required: "Please enter doctor's first name!",
            },
              doctors_lName: {
                required : "Please enter doctor's last name!"
            },
              doctor_photo: {
                required : "Please upload an image!"
            },

              'doctorSpecialities_specialitiesId[]': {
                required: "Please select one or more specialities!"
            },
            
          
             'doctorAcademic_degreeId[]': {
                required: "Please select a degree!"
            },
            'doctorSpecialities_specialitiesCatId[]': {
                required: "Please select a speciality!"
            },
            'acdemic_addaddress[]': {
                required: "Please enter an address!"
            },
            'acdemic_addyear[]': {
                required: "Please enter a year!"
            },
            exp_year: {
                required: "Please enter year(s) of experience!"
            },
            fee:{
         
           required: "Please enter the consultation fees!"
         
      }
      
           
        }

    });
    
});
    var urls = "<?php echo base_url() ?>";
    $(document).ready(function () {
    $("#updateForm").validate({
        rules: {
            doctors_phn: {
                minlength: 10
            },
            doctors_fName: {
                required: true
            },
            doctors_lName: {
                required : true
            },
             avatar_file: {
                required : true
            },
            'doctorSpecialities_specialitiesId[]': {
                required: true
            },
            users_email: {
                email: true,
                            
            },
       'doctorAcademic_degreeId[]':{
         
           required: true
      },
      'doctorSpecialities_specialitiesCatId[]':{
         
           required: true
      },
      'acdemic_addaddress[]':{
         
           required: true
      },
      'acdemic_addyear[]':{
         
           required: true
      },
      exp_year: {
        required: true,
      }, 
      fee: {
        required: true,
                            
      }    
        },
        messages: {
            doctors_fName: {
                required: "Please enter doctor's first name!",
            },
              doctors_lName: {
                required : "Please enter doctor's last name!"
            },
              avatar_file: {
                required : "Please upload an image!"
            },

              'doctorSpecialities_specialitiesId[]': {
                required: "Please select one or more specialities!"
            },
            users_email: {
                email: "Please enter the correct email format!"
            },
          
             'doctorAcademic_degreeId[]': {
                required: "Please select a degree!"
            },
            'doctorSpecialities_specialitiesCatId[]': {
                required: "Please select a speciality!"
            },
            'acdemic_addaddress[]': {
                required: "Please enter an address!"
            },
            'acdemic_addyear[]': {
                required: "Please enter a year!"
            },
            exp_year: {
                required: "Please enter year(s) of experience!"
            },
            fee:{
         
           required: "Please enter the consultation fees!"
         
      }
      
           
        }

    });
    
});



function emailIsExist() {
       // alert('helloo');
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        var email = $('#users_email').val();
        var hospitalUserIdDoctor = $('#hospitalUserIdDoctor').val();
        if (email !== '') {
            if (!filter.test(email)) {
                $('#users_email').addClass('bdr-error');
                $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){
                $("#users_email").removeClass('bdr-error');
                }, 3000);
            }
            
            $.ajax({
                url: urls + 'index.php/hospital/check_email_doctor',
                type: 'POST',
                data: {'users_email': email, 'hospitalUserIdDoctor' : hospitalUserIdDoctor},
                success: function (datas) {
                    if (datas == 0) {
                        $('#users_email').addClass('bdr-error');
                        $('#error-users_email_check').fadeIn().delay(5000).fadeOut('slow');
                        setTimeout(function(){
                            $("#users_email").removeClass('bdr-error');
                        }, 3000);
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
</script>
</body>

</html>
