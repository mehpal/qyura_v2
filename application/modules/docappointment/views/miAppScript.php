<style type="text/css">
    #datatable_bloodbank_filter
    {
        display:none;
    }

    table.dataTable thead th {
        position: relative;
        background-image: none !important;
    }
</style>
<script src="<?php echo base_url(); ?>assets/vendor/select2/select2.min.js" type="text/javascript"></script>  
<!--<link href="<?php echo base_url(); ?>assets/cropper/cropper.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/cropper/main.css" rel="stylesheet">-->
<script src="<?php echo base_url(); ?>assets/vendor/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jsapi.js"></script>

<script src="<?php echo base_url(); ?>assets/vendor/chart.js/chart.min.js">
</script>
<!-- EASY PIE CHART JS -->
<script src="<?php echo base_url(); ?>assets/vendor/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js">
</script>
<script src="<?php echo base_url(); ?>assets/js/easy-pie-chart.init.js">
</script>
<script src="<?php echo base_url(); ?>assets/vendor/toggles/toggles.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/cropper/cropper.js"></script>
<?php
$current = $this->router->fetch_method();
if ($current == 'detailBloodBank'):
    ?>
    <script src="<?php echo base_url(); ?>assets/cropper/common_cropper.js"></script>
<?php else: ?>
    <script src="<?php echo base_url(); ?>assets/cropper/main.js"></script>
<?php endif; ?>
<!--<script src="<?php echo base_url(); ?>assets/js/pages/all-appointment.js" type="text/javascript"></script>-->

<script>
    var urls = "<?php echo base_url() ?>";
    /**
     * @method datatable
     * @description get records in listing using datatables
     */
     $(document).ready(function () {
        // alert('test');
        var appointmentTable = $('#doctorAppointmentTable').DataTable({
             "processing": true,
            "bServerSide": true,
            "columnDefs": [{
                    "targets": [0,1,2,3,4,5],
                    "orderable": false
                }],
            "searching": false,
            "bLengthChange": false,
            "bProcessing": true,
            "iDisplayLength": 10,
            "bPaginate": true,
            "sPaginationType": "full_numbers",
            "columns": [
                {"data": "ApptId"},
                {"data": "DateTime"},
                {"data": "PatientName"},
                {"data": "Doctor"},
                {"data": "Status"},
                {"data": "Action","searchable": false, "order": false},
            ],
            "ajax": {
                "url": "<?php echo site_url('docappointment/getDoctorAppointmnetDl'); ?>",
                "type": "POST",
                "data": function (d) {
                    d.name = $("#search").val();
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                }
               
            }
        });

        $('#search').on('keyup', function () {
            appointmentTable.draw();
        });
    });
    /**
     * @method getTimeSloat
     * @description  SHOW MODAL WITH SLOAT
     */
    function getTimeSloat(quotation_id, miId, timeSlotId)
    {
        var url = '<?php echo site_url(); ?>' + '/miappointment' + '/get_timeSlot';
        $.ajax({
            url: url,
            async: false,
            type: 'POST',
            data: {'quotation_id': quotation_id, 'miId': miId, 'timeSlotId': timeSlotId},
            beforeSend: function (xhr) {
            },
            success: function (data) {
                $('#changetime').html(data);
                $('#changeTimemodel').modal('show');
            }
        });
    }
</script>
