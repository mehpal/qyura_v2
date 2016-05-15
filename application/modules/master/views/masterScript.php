<style type="text/css">
    #doctor_datatable_filter
    {
        display:none;
    }
</style>
<style type="text/css">
    #hospital_datatable_filter
    {
        display:none;
    }
</style>
<style type="text/css">
    #diagnostic_datatable_filter
    {
        display:none;
    }
</style>
<style type="text/css">
    #city_datatable_filter
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
<script src="<?php echo base_url(); ?>assets/js/common_js.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>
<?php
$current = $this->router->fetch_method();
if ($current != 'detailDoctor'): ?>
    <script src="<?php echo base_url(); ?>assets/cropper/masterCrop.js"></script>
<?php else: ?>
    <script  src="<?php echo base_url(); ?>assets/cropper/common_cropper.js"></script>
<?php endif; ?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script onkeypress="" onkeydown="" type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/x-editable/jquery.xeditable.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>

<script>
    //Degree 
    $(document).ready(function (){
        $("#degreeForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/saveDegrees/';
            var formData = new FormData(this);
            submitData(url,formData);
            $("#editdegrees").click(function () {
            $("#detaildegrees").toggle();
            $("#newdegrees").toggle();
});
        });
        var urls = "<?php echo base_url() ?>";
        $("#degreeForm").validate({
        
        rules: {
            degree_FName: {
                required: true
            },
            degree_SName: {
                required : true
            }
        },
        messages: {
            degree_FName: {
                required: "Please enter full name of degree!",
            },
            degree_SName: {
                required : "Please enter abreviation for the degree!"
            }
           
        }

    });

    $('.select2').select2().change(function(){
        $(this).valid()
    });
    });

    
    $(document).ready(function (){
        $("#degreeEditForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/editDegrees/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
        
    });

    
    //Speciality starts.
    <?php if($this->router->fetch_method() == 'specialities'){ ?>
    $(document).ready(function (){
        $("#submitForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/saveSpecialities/';
            var formData = new FormData(this);
            var photo = document.getElementById("avatarInput");
            var file = photo.files[0];
            formData.append('avatar_file', file);
            submitData(url,formData);

        });

    var urls = "<?php echo base_url() ?>";
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
            specialityName: {
                required: true
            },
            specialityNamedoctor: {
                required : true
            },
            avatar_file: {
                required : true
            }
        },
       
        messages: {
            specialityName: {
                required: "Please enter scientific name!",
            },
            specialityNamedoctor: {
                required : "Please enter general name!"
            },
            avatar_file: {
                required : "Please upload an image!"
            }
           
        }

    });

    });
    <?php } ?>
    //Speciality ends.

    //Doctor Speciality starts.
    <?php if($this->router->fetch_method() == 'docspecialities'){ ?>
    $(document).ready(function (){
        $("#submitForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/docsaveSpecialities/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
        var urls = "<?php echo base_url() ?>";
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
            specialityName: {
                required: true
            },
            specialityNamedoctor: {
                required : true
            },
            avatar_file: {
                required : true
            }
        },
       
        messages: {
            specialityName: {
                required: "Please enter scientific name!",
            },
            specialityNamedoctor: {
                required : "Please enter general name!"
            },
            avatar_file: {
                required : "Please upload an image!"
            }
           
        }

    });
    });
    <?php } ?>
    //Doctor speciality ends.
    //Diagnostic
    <?php if($this->router->fetch_method() == 'diagnostic'){ ?>
    $(document).ready(function (){
        $("#submitForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/saveDiagnostic/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
        var urls = "<?php echo base_url() ?>";
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
            diagnosticName: {
                required: true
            },
            avatar_file: {
                required : true
            }
        },
       
        messages: {
            diagnosticName: {
                required: "Please enter diagnostic's name!",
            },
            avatar_file: {
                required : "Please upload an image!"
            }
           
        }

    });
    });
    <?php } ?>
        <?php if($this->router->fetch_method() == 'editDiagnosticsView'){ ?>
    $(document).ready(function (){
        var urls = "<?php echo base_url() ?>";
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
            diagnosticsCat_catName: {
                required: true
            }
        },
       
        messages: {
            diagnosticsCat_catName: {
                required: "Please enter diagnostic's name!",
            }
           
        }

    });
    });
    <?php } ?>

    //Insurance
    <?php if($this->router->fetch_method() == 'insurance'){ ?>
    $(document).ready(function (){
        $("#submitForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/saveInsurance/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
        var urls = "<?php echo base_url() ?>";
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
            insurance_Name: {
                required: true
            },
            insurance_detail: {
                required: true
            },
            avatar_file: {
                required : true
            }
        },
       
        messages: {
            insurance_Name: {
                required: "Please enter insurance name!",
            },
            insurance_detail: {
                required: "Please enter some details!"
            },
            avatar_file: {
                required : "Please upload an image!"
            }
           
        }

    });
    });
    <?php } ?>
    <?php if($this->router->fetch_method() == 'editInsuranceView'){ ?>
    $(document).ready(function (){
        var urls = "<?php echo base_url() ?>";
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
            insurance_Name: {
                required: true
            },
            insurance_detail: {
                required: true
            }
        },
       
        messages: {
            insurance_Name: {
                required: "Please enter insurance name!",
            },
            insurance_detail: {
                required: "Please enter some details!"
            }
           
        }

    });
    });
    <?php } ?>
    //Mi Type
    $(document).ready(function (){
        $("#miaddHospiForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/miTypeSave/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
        $("#miaddHospiForm").validate({
        rules: {
            hospitalType_name: {
                required: true
            }
        },
       
        messages: {
            hospitalType_name: {
                required: "Please enter hospital type!",
            }
           
        }

    });

    });
    $(document).ready(function (){
        $("#miaddDigoForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/miTypeSave/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
        $("#miaddDigoForm").validate({
        rules: {
            hospitalType_name: {
                required: true
            }
        },
       
        messages: {
            hospitalType_name: {
                required: "Please enter diagnostic type!",
            }
           
        }

    });
    });
    $(document).ready(function (){
        $("#miaddBankForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/miTypeSave/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
        $("#miaddBankForm").validate({
        rules: {
            hospitalType_name: {
                required: true
            }
        },
       
        messages: {
            hospitalType_name: {
                required: "Please enter blood bank type!",
            }
           
        }

    });
    });
    $(document).ready(function (){
        $("#miaddPharmacyForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/miTypeSave/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
        $("#miaddPharmacyForm").validate({
        rules: {
            hospitalType_name: {
                required: true
            }
        },
       
        messages: {
            hospitalType_name: {
                required: "Please enter pharmacy type!",
            }
           
        }

    });
    });
    $(document).ready(function (){
        $("#miaddAmbulanceForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/miTypeSave/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
        $("#miaddAmbulanceForm").validate({
        rules: {
            hospitalType_name: {
                required: true
            }
        },
       
        messages: {
            hospitalType_name: {
                required: "Please enter ambulance type!",
            }
           
        }

    });
    });
    
    $(document).ready(function (){
        $("#miHospiForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/miTypeEdit/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
    });
    $(document).ready(function (){
        $("#miDigoForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/miTypeEdit/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
    });
    $(document).ready(function (){
        $("#miBloodForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/miTypeEdit/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
    });
    $(document).ready(function (){
        $("#miPharmacyForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/miTypeEdit/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
    });
    $(document).ready(function (){
        $("#miAmbulanceForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/miTypeEdit/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
    });
    
</script>
<script>
    function checkValidFileUploads(urls){
        var avatar_file = $(".avatar-data").val();
         $.ajax({
           url : urls + 'index.php/master/checkFileUploadValidation',
           type: 'POST',
           data:{'avatar_file' : avatar_file},
          success:function(data){
             var obj = $.parseJSON(data);

             if(obj.state == 400){
                 $("#message_upload").html("<div class='alert alert-danger'>"+obj.message+"</div>");
                 $(".close").hide();
             }else{
                 $("#avatar-modal").modal('hide');
                  $("#message_upload").html("");
             }
          }
       });
    }

</script>
<script>

    function showDegree(id){
         
        $("#editDeg"+id).show();
        $("#editDeg"+id).removeClass('out hidden');
        $("#degree"+id).hide();
    }

   function hideDegree(id){
        $("#editDeg"+id).hide();
        $("#degree"+id).show();
    }
    function showHospitalType(id){
        $("#edit"+id).show();
        $("#edit"+id).removeClass('out hidden');
        $("#hospitalType"+id).hide();
    }

   function hideHospitalType(id){
        $("#edit"+id).hide();
        $("#hospitalType"+id).show();
    }
function showDiagnosticType(id){
        $("#editDiag"+id).show();
        $("#editDiag"+id).removeClass('out hidden');
        $("#diagnosticType"+id).hide();
    }

   function hideDiagnosticType(id){
        $("#editDiag"+id).hide();
        $("#diagnosticType"+id).show();
    }
    function showBloodBank(id){
        $("#editBlood"+id).show();
        $("#editBlood"+id).removeClass('out hidden');
        $("#bloodBank"+id).hide();
    }

   function hideBloodBank(id){
        $("#editBlood"+id).hide();
        $("#bloodBank"+id).show();
    }
    function showPharmacy(id){
        $("#editPh"+id).show();
        $("#editPh"+id).removeClass('out hidden');
        $("#pharmacy"+id).hide();
    }

   function hidePharmacy(id){
        $("#editPh"+id).hide();
        $("#pharmacy"+id).show();
    }
    function showAmbulance(id){
        $("#editAmb"+id).show();
        $("#editAmb"+id).removeClass('out hidden');
        $("#ambulance"+id).hide();
    }

   function hideAmbulance(id){
        $("#editAmb"+id).hide();
        $("#ambulance"+id).show();
    }
    function showAwardAgency(id){
        $("#editAward"+id).show();
        $("#editAward"+id).removeClass('out hidden');
        $("#awardAgency"+id).hide();
    }

   function hideAwardAgency(id){
        $("#editAward"+id).hide();
        $("#awardAgency"+id).show();
    }
    function showDepartment(id){
        $("#editDept"+id).show();
        $("#editDept"+id).removeClass('out hidden');
        $("#department"+id).hide();
    }

   function hideDepartment(id){
        $("#editDept"+id).hide();
        $("#department"+id).show();
    }
    function showDesignation(id){
        $("#editDes"+id).show();
        $("#designation"+id).hide();
    }

   function hideDesignation(id){
        $("#editDes"+id).hide();
        $("#designation"+id).show();
    }

     $(".membership-btn2").click(function () {
        $(".membership-plan2").toggle();
        $(".newmembership2").toggle();
    });
     $(".membership-btn3").click(function () {
        $(".membership-plan3").toggle();
        $(".newmembership3").toggle();
    });
     $(".membership-btn4").click(function () {
        $(".membership-plan4").toggle();
        $(".newmembership4").toggle();
    });
     $(".membership-btn5").click(function () {
        $(".membership-plan5").toggle();
        $(".newmembership5").toggle();
    });
     $(".membership-btn6").click(function () {
        $(".membership-plan6").toggle();
        $(".newmembership6").toggle();
    });
    var resizefunc = [];
</script>
<script>
    
    <?php if($this->router->fetch_method() == 'addHospital'){ ?>
    $(document).ready(function (){
        $("#miForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/mi_master/saveHospital/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
    });
    <?php } ?>
    <?php if($this->router->fetch_method() == 'addDiagnostic'){ ?>
    $(document).ready(function (){
        $("#miForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/mi_master/saveDiagnostic/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
    });
    <?php } ?>
    
    $(document).ready(function (){
        $("#cityForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/city_master/saveCity/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
    });

    //award agency
    $(document).ready(function (){
        $("#awardAgencyform").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/saveawardAgency/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
        $("#awardAgencyform").validate({
        
        rules: {
            agency_name: {
                required: true
            }
        },
       
        messages: {
            agency_name: {
                required: "Please enter the name of an agency!",
            }
           
        }

    });

    });
    
    $(document).ready(function (){
        $("#awardAgencyEdit").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/editawardAgency/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
    });    
    
    //Department
    $(document).ready(function (){
        $("#departmentaddForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/departmentSave/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
        $("#departmentaddForm").validate({
        
        rules: {
            department_name: {
                required: true
            }
        },
       
        messages: {
            department_name: {
                required: "Please enter the name of department!",
            }
           
        }

    });
    });
    $(document).ready(function (){
        $("#departmentEditForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/departmentEdit/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
    });
    //Designation
    $(document).ready(function (){
        $("#designationaddForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/designationSave/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
        $("#designationaddForm").validate({
        
        rules: {
            designation_departmentId:{
                required: true
            },
            designation_name: {
                required: true
            }
        },
       
        messages: {
            designation_departmentId:{
                required: "Please select a department!"
            },
            designation_name: {
                required: "Please enter the name of department!",
            }
           
        }

    });
    });
    $(document).ready(function (){
        $("#designationEditForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/designationEdit/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
    });

    function fetchCity(stateId) {
        $.ajax({
            url: "<?php echo site_url() ?>" + '/master/mi_master/fetchCity',
            type: 'POST',
            data: {'stateId': stateId},
            success: function (datas) {
                $('#cityId').html(datas);
                $('#cityId').selectpicker('refresh');
            }
        });

    }
    function imageValidate(){
        var image = $("#avatarInput").val();
        if (image == '') {
            $('#image_select').addClass('bdr-error');
            $('#error-avatarInput').fadeIn().delay(3000).fadeOut('slow');
            return false;
        }

    }
    

    function fetchState(countryId) {
        $.ajax({
            url: "<?php echo site_url() ?>" + '/master/mi_master/fetchStates',
            type: 'POST',
            data: {'countryId': countryId},
            success: function (datas) {
                $('#stateId').html(datas);
                $('#stateId').selectpicker('refresh');
            }
        });

    }
    
    function isNumberKey(evt, id) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode == 46 || charCode > 31 && (charCode < 48 || charCode > 57)) {
            $("#" + id).html("Please enter number key");
            return false;
        } else {
            $("#" + id).html('');
            return true;
        }
    }
    $(document).ready(function () {
        var oTable = $('#hospital_datatable').DataTable({
            "processing": true,
            "bServerSide": true,
            // "searching": true,
            "bLengthChange": false,
            "bProcessing": true,
            "iDisplayLength": 10,
            "bPaginate": true,
            "sPaginationType": "full_numbers",
            "columns": [
                {"data": "hospital_name"},
                {"data": "action", "searchable": false, "order": false, orderable: false, width: "8%"},
                {"data": "status", "searchable": false, "order": false, orderable: false, width: "8%"},


            ],
            "ajax": {
                "url": "<?php echo site_url('master/mi_master/getHospitalDl'); ?>",
                "type": "POST",
                "data": function (d) {
                    d.name = $("#search").val();
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                }
            }
        });
        $('#search').on('keyup', function () {
            oTable.search($(this).val()).draw();
        });

    });
    $(document).ready(function () {
        var oTable = $('#diagnostic_datatable').DataTable({
            "processing": true,
            "bServerSide": true,
            // "searching": true,
            "bLengthChange": false,
            "bProcessing": true,
            "iDisplayLength": 10,
            "bPaginate": true,
            "sPaginationType": "full_numbers",
            "columns": [
                {"data": "diagnostic_name"},
                {"data": "action", "searchable": false, "order": false, orderable: false, width: "8%"},
                {"data": "status", "searchable": false, "order": false, orderable: false, width: "8%"},

            ],
            "ajax": {
                "url": "<?php echo site_url('master/mi_master/getDiagnosticDl'); ?>",
                "type": "POST",
                "data": function (d) {
                    d.name = $("#search").val();
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                }
            }
        });
        $('#search').on('keyup', function () {
            oTable.search($(this).val()).draw();
        });

    });
    $(document).ready(function () {

       
        var oTable = $('#city_datatable').DataTable({
            "processing": true,
            "bServerSide": true,
            // "searching": true,
            "bLengthChange": false,
            "bInfo" : false,
            "bProcessing": true,
            "iDisplayLength": 10,
            "bPaginate": true,
            "sPaginationType": "full_numbers",
            "columns": [
                {"data": "city_name"},
                {"data": "action", "searchable": false, "order": false, orderable: false, width: "8%"},
                {"data": "status", "searchable": false, "order": false, orderable: false, width: "8%"},

            ],
            "ajax": {
                "url": "<?php echo site_url('master/city_master/getCityDl'); ?>",
                "type": "POST",
                "data": function (d) {
                    d.name = $("#search").val();
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                }
            }
        });
        $('#search').on('keyup', function () {
            oTable.search($(this).val()).draw();
        });

    });
</script>
<script type="text/javascript">
   /*diagnostic list*/
   
   
   $(document).ready(function() {
   
    var jobCount = $('#list .in').length;
    $('.list-count').text(jobCount + ' items');
    $("#search-text").keyup(function () {
    //$(this).addClass('hidden');
        var searchTerm = $("#search-text").val();
        var listItem = $('#list').children('li');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
          //extends :contains to be case insensitive
        $.extend($.expr[':'], {
        'containsi': function(elem, i, match, array)
        {
        return (elem.textContent || elem.innerText || '').toLowerCase()
        .indexOf((match[3] || "").toLowerCase()) >= 0;
        }
        });
        $("#list li").not(":containsi('" + searchSplit + "')").each(function(e)   {
          $(this).addClass('hiding out').removeClass('in');
          setTimeout(function() {
              $('.out').addClass('hidden');
            }, 300);
        });

        $("#list li:containsi('" + searchSplit + "')").each(function(e) {
          $(this).removeClass('hidden out').addClass('in');
          setTimeout(function() {
              $('.in').removeClass('hiding');
            }, 1);
        });
          var jobCount = $('#list .in').length;
        $('.list-count').text(jobCount + ' items');
        //shows empty state text when no jobs found
        if(jobCount == '0') {
          $('#list').addClass('empty');
        }
        else {
          $('#list').removeClass('empty');
        }
    }); 
    $("#search-text1").keyup(function () {
    //$(this).addClass('hidden');
        var searchTerm = $("#search-text1").val();
        var listItem = $('#list1').children('li');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
          //extends :contains to be case insensitive
        $.extend($.expr[':'], {
        'containsi': function(elem, i, match, array)
        {
        return (elem.textContent || elem.innerText || '').toLowerCase()
        .indexOf((match[3] || "").toLowerCase()) >= 0;
        }
        });
        $("#list1 li").not(":containsi('" + searchSplit + "')").each(function(e)   {
          $(this).addClass('hiding out').removeClass('in');
          setTimeout(function() {
              $('.out').addClass('hidden');
            }, 300);
        });

        $("#list1 li:containsi('" + searchSplit + "')").each(function(e) {
          $(this).removeClass('hidden out').addClass('in');
          setTimeout(function() {
              $('.in').removeClass('hiding');
            }, 1);
        });
          var jobCount = $('#list1 .in').length;
        $('.list-count').text(jobCount + ' items');
        //shows empty state text when no jobs found
        if(jobCount == '0') {
          $('#list1').addClass('empty');
        }
        else {
          $('#list1').removeClass('empty');
        }
    }); 
    $("#search-text2").keyup(function () {
    //$(this).addClass('hidden');
        var searchTerm = $("#search-text2").val();
        var listItem = $('#list2').children('li');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
          //extends :contains to be case insensitive
        $.extend($.expr[':'], {
        'containsi': function(elem, i, match, array)
        {
        return (elem.textContent || elem.innerText || '').toLowerCase()
        .indexOf((match[3] || "").toLowerCase()) >= 0;
        }
        });
        $("#list2 li").not(":containsi('" + searchSplit + "')").each(function(e)   {
          $(this).addClass('hiding out').removeClass('in');
          setTimeout(function() {
              $('.out').addClass('hidden');
            }, 300);
        });

        $("#list2 li:containsi('" + searchSplit + "')").each(function(e) {
          $(this).removeClass('hidden out').addClass('in');
          setTimeout(function() {
              $('.in').removeClass('hiding');
            }, 1);
        });
          var jobCount = $('#list2 .in').length;
        $('.list-count').text(jobCount + ' items');
        //shows empty state text when no jobs found
        if(jobCount == '0') {
          $('#list2').addClass('empty');
        }
        else {
          $('#list2').removeClass('empty');
        }
    }); 
    $("#search-text3").keyup(function () {
    //$(this).addClass('hidden');
        var searchTerm = $("#search-text3").val();
        var listItem = $('#list3').children('li');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
          //extends :contains to be case insensitive
        $.extend($.expr[':'], {
        'containsi': function(elem, i, match, array)
        {
        return (elem.textContent || elem.innerText || '').toLowerCase()
        .indexOf((match[3] || "").toLowerCase()) >= 0;
        }
        });
        $("#list3 li").not(":containsi('" + searchSplit + "')").each(function(e)   {
          $(this).addClass('hiding out').removeClass('in');
          setTimeout(function() {
              $('.out').addClass('hidden');
            }, 300);
        });

        $("#list3 li:containsi('" + searchSplit + "')").each(function(e) {
          $(this).removeClass('hidden out').addClass('in');
          setTimeout(function() {
              $('.in').removeClass('hiding');
            }, 1);
        });
          var jobCount = $('#list3 .in').length;
        $('.list-count').text(jobCount + ' items');
        //shows empty state text when no jobs found
        if(jobCount == '0') {
          $('#list3').addClass('empty');
        }
        else {
          $('#list3').removeClass('empty');
        }
    }); 
    $("#search-text4").keyup(function () {
    //$(this).addClass('hidden');
        var searchTerm = $("#search-text4").val();
        var listItem = $('#list4').children('li');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
          //extends :contains to be case insensitive
        $.extend($.expr[':'], {
        'containsi': function(elem, i, match, array)
        {
        return (elem.textContent || elem.innerText || '').toLowerCase()
        .indexOf((match[3] || "").toLowerCase()) >= 0;
        }
        });
        $("#list4 li").not(":containsi('" + searchSplit + "')").each(function(e)   {
          $(this).addClass('hiding out').removeClass('in');
          setTimeout(function() {
              $('.out').addClass('hidden');
            }, 300);
        });

        $("#list4 li:containsi('" + searchSplit + "')").each(function(e) {
          $(this).removeClass('hidden out').addClass('in');
          setTimeout(function() {
              $('.in').removeClass('hiding');
            }, 1);
        });
          var jobCount = $('#list4 .in').length;
        $('.list-count').text(jobCount + ' items');
        //shows empty state text when no jobs found
        if(jobCount == '0') {
          $('#list4').addClass('empty');
        }
        else {
          $('#list4').removeClass('empty');
        }
    }); 
    });
</script>
<script>
    var urls = "<?php echo base_url() ?>";
    $(document).ready(function () {
    $("#miForm").validate({
        rules: {
            mi_name: {
                required: true
            },
            mi_countryId: {
                required : true
            },
            mi_stateId: {
                required : true
            },
            mi_cityId: {
                required : true
            },
            mi_zip: {
                required: true,
                            
            },
            mi_address:{
         
                required: true
            },
            lat:{
         
           required: true
            },
            lng:{
         
            required: true
            }
        },
        errorPlacement: function(error, element) {
        if (element.attr("name") == "mi_countryId")
        {
            error.insertAfter('.error-country');
        }
        else if (element.attr("name") == "mi_stateId")
        {
            error.insertAfter('.error-state');
        }
        else if (element.attr("name") == "mi_cityId")
        {
            error.insertAfter('.error-city');
        }
        else{
            error.insertAfter(element);
        }

        },
        messages: {
            mi_name: {
                required: "Please enter MI name!",
            },
            mi_countryId: {
                required : "Please select a country!"
            },
            mi_stateId: {
                required : "Please select a state!"
            },
            mi_cityId: {
                required : "Please select a city!"
            },
         
            mi_zip: {
                required: "Please enter a zip code!"
            },
            mi_address: {
                required: "Please enter an address!"
            },
            lat: {
                required: "Please enter the latitude!"
            },
            lng: {
                required: "Please enter the longitude!"
            }   
           
        }

    });
    
});
</script>

<script>
    var urls = "<?php echo base_url() ?>";
    $(document).ready(function () {
    $("#submitEditForm").validate({
        rules: {
            diagnostic_name: {
                required: true
            },
            diagnostic_countryId: {
                required : true
            },
            diagnostic_stateId: {
                required : true
            },
            diagnostic_cityId: {
                required : true
            },
            diagnostic_zip: {
                required: true,
                            
            },
            diagnostic_address:{
         
                required: true
            },
            lat:{
         
           required: true
            },
            lng:{
         
            required: true
            }
        },
        errorPlacement: function(error, element) {
        if (element.attr("name") == "diagnostic_countryId")
        {
            error.insertAfter('.error-country');
        }
        else if (element.attr("name") == "diagnostic_stateId")
        {
            error.insertAfter('.error-state');
        }
        else if (element.attr("name") == "diagnostic_cityId")
        {
            error.insertAfter('.error-city');
        }
        else{
            error.insertAfter(element);
        }

        },
        messages: {
            diagnostic_name: {
                required: "Please enter MI name!",
            },
            diagnostic_countryId: {
                required : "Please select a country!"
            },
            diagnostic_stateId: {
                required : "Please select a state!"
            },
            diagnostic_cityId: {
                required : "Please select a city!"
            },
         
            diagnostic_zip: {
                required: "Please enter a zip code!"
            },
            diagnostic_address: {
                required: "Please enter an address!"
            },
            lat: {
                required: "Please enter the latitude!"
            },
            lng: {
                required: "Please enter the longitude!"
            }   
           
        }

    });
    
});
</script>
<script>
    var urls = "<?php echo base_url() ?>";
    $(document).ready(function () {
    $("#editHospitalForm").validate({
        rules: {
            hospital_name: {
                required: true
            },
            hospital_countryId: {
                required : true
            },
            hospital_stateId: {
                required : true
            },
            hospital_cityId: {
                required : true
            },
            hospital_zip: {
                required: true,
                            
            },
            hospital_address:{
         
                required: true
            },
            lat:{
         
           required: true
            },
            lng:{
         
            required: true
            }
        },
        errorPlacement: function(error, element) {
        if (element.attr("name") == "hospital_countryId")
        {
            error.insertAfter('.error-country');
        }
        else if (element.attr("name") == "hospital_stateId")
        {
            error.insertAfter('.error-state');
        }
        else if (element.attr("name") == "hospital_cityId")
        {
            error.insertAfter('.error-city');
        }
        else{
            error.insertAfter(element);
        }

        },
        messages: {
            hospital_name: {
                required: "Please enter MI name!",
            },
            hospital_countryId: {
                required : "Please select a country!"
            },
            hospital_stateId: {
                required : "Please select a state!"
            },
            hospital_cityId: {
                required : "Please select a city!"
            },
         
            hospital_zip: {
                required: "Please enter a zip code!"
            },
            hospital_address: {
                required: "Please enter an address!"
            },
            lat: {
                required: "Please enter the latitude!"
            },
            lng: {
                required: "Please enter the longitude!"
            }   
           
        }

    });
    
});
</script>

<script>
//City add starts
    var urls = "<?php echo base_url() ?>";
    $(document).ready(function () {
    $("#cityForm").validate({
        rules: {
            city_countryid: {
                required: true
            },
            city_stateid: {
                required : true
            },
            city_name: {
                required : true
            },
            city_center: {
                required : true
            },
            lat: {
                required: true,
                            
            },
            lng:{
         
                required: true
            }
        },
        errorPlacement: function(error, element) {
        if (element.attr("name") == "city_countryid")
        {
            error.insertAfter('.error-country');
        }
        else if (element.attr("name") == "city_stateid")
        {
            error.insertAfter('.error-state');
        }
        else if (element.attr("name") == "city_name")
        {
            error.insertAfter('.error-city');
        }
        else{
            error.insertAfter(element);
        }

        },
        messages: {
            city_countryid: {
                required: "Please select a country!",
            },
            city_stateid: {
                required : "Please select a state!"
            },
            city_name: {
                required : "Please select a city!"
            },
            city_center: {
                required : "Please enter the name of city center!"
            },
            lat: {
                required: "Please enter the latitude!"
            },
            lng: {
                required: "Please enter the longitude!"
            }   
           
        }

    });
    
});
    //City add ends.
</script>

<script>
//City edit starts
    var urls = "<?php echo base_url() ?>";
    $(document).ready(function () {
    $("#submitFormEditCity").validate({
        rules: {
            city_countryid: {
                required: true
            },
            city_stateid: {
                required : true
            },
            city_name: {
                required : true
            },
            city_center: {
                required : true
            },
            lat: {
                required: true,
                            
            },
            lng:{
         
                required: true
            }
        },
        errorPlacement: function(error, element) {
        if (element.attr("name") == "city_countryid")
        {
            error.insertAfter('.error-country');
        }
        else if (element.attr("name") == "city_stateid")
        {
            error.insertAfter('.error-state');
        }
        else if (element.attr("name") == "city_name")
        {
            error.insertAfter('.error-city');
        }
        else{
            error.insertAfter(element);
        }

        },
        messages: {
            city_countryid: {
                required: "Please select a country!",
            },
            city_stateid: {
                required : "Please select a state!"
            },
            city_name: {
                required : "Please select a city!"
            },
            city_center: {
                required : "Please enter the name of city center!"
            },
            lat: {
                required: "Please enter the latitude!"
            },
            lng: {
                required: "Please enter the longitude!"
            }   
           
        }

    });

    
});
    //city edit ends.
</script>

<script>
//editSpecialities starts.
 <?php if($this->router->fetch_method() == 'editSpecialitiesView'){ ?>
    $(document).ready(function (){
    var urls = "<?php echo base_url() ?>";
    $("#submitForm").validate({
        
        rules: {
            specialityName: {
                required: true
            },
            specialityNamedoctor: {
                required : true
            }
        },
       
        messages: {
            specialityName: {
                required: "Please enter scientific name!",
            },
            specialityNamedoctor: {
                required : "Please enter general name!"
            }
           
        }

    });
    });
    <?php } ?>
//editSpecialities ends.

//editDoctorSpecialities starts.
<?php if($this->router->fetch_method() == 'doceditSpecialitiesView'){ ?>

$(document).ready(function (){
     var urls = "<?php echo base_url() ?>";
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
            specialityName: {
                required: true
            },
            specialityNamedoctor: {
                required : true
            }
        },
       
        messages: {
            specialityName: {
                required: "Please enter scientific name!",
            },
            specialityNamedoctor: {
                required : "Please enter general name!"
            }
           
        }

    });
    });
    <?php } ?>
    function lngChack(str){
          
            
               var filter = /^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{2,20}$/;
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
//editDoctorSpecialities ends.

</script>

