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

<script>
    $(document).ready(function (){
        $("#degreeForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/master/saveDegrees/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
    });
</script>
<script>
    $(document).ready(function () {
//        var oTable = $('#degrees_datatable').DataTable({
//            "processing": true,
//            "bServerSide": true,
//            // "searching": true,
//            "bLengthChange": false,
//            "bProcessing": true,
//            "iDisplayLength": 10,
//            "bPaginate": true,
//            "sPaginationType": "full_numbers",
//            "columnDefs": [{
//                    "targets": [0, 5],
//                    "orderable": false
//                }],
//            "columns": [
//                {"data": "fullName"},
//                {"data": "smallForm"},
//                {"data": "view", "searchable": false, "order": false, orderable: false, width: "8%"},
//            ],
//            "ajax": {
//                "url": "<?php echo site_url('doctor/getDoctorDl'); ?>",
//                "type": "POST",
//                "data": function (d) {
//                    d.name = $("#search").val();
//                    if ($("#doctorSpecialities_specialitiesId").val() != ' ') {
//                        d.docSpecialitiesId = $("#doctorSpecialities_specialitiesId").val();
//                    }
//                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
//                }
//            }
//        });
//        $('#search').on('keyup', function () {
//            //oTable.draw();
//            oTable.search($(this).val()).draw();
//        });
    });
</script>    
</body>

</html>
