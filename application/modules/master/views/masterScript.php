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
<script src="<?php echo base_url(); ?>assets/js/common_js.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>
<?php
$current = $this->router->fetch_method();
if ($current != 'detailDoctor'): ?>
    <script src="<?php echo base_url(); ?>assets/cropper/main.js"></script>
<?php else: ?>
    <script  src="<?php echo base_url(); ?>assets/cropper/common_cropper.js"></script>
    <script src="<?php echo base_url(); ?>assets/cropper/gallery_cropper.js"></script>
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
    
    //Specialities
    <?php if($this->router->fetch_method() == 'specialities'){ ?>
    $(document).ready(function (){
        $("#submitForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/saveSpecialities/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
    });
    <?php } ?>

    //Diagnostic
    <?php if($this->router->fetch_method() == 'diagnostic'){ ?>
    $(document).ready(function (){
        $("#submitForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/saveDiagnostic/';
            var formData = new FormData(this);
            submitData(url,formData);
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
    });
    $(document).ready(function (){
        $("#miaddDigoForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/miTypeSave/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
    });
    $(document).ready(function (){
        $("#miaddBankForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/miTypeSave/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
    });
    $(document).ready(function (){
        $("#miaddPharmacyForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/miTypeSave/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
    });
    $(document).ready(function (){
        $("#miaddAmbulanceForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/miTypeSave/';
            var formData = new FormData(this);
            submitData(url,formData);
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
    $(".membership-btn").click(function () {
        $(".membership-plan").toggle();
        $(".newmembership").toggle();
    });
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