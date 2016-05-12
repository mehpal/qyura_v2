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

<!--<link href="<?php echo base_url(); ?>assets/cropper/cropper.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/cropper/main.css" rel="stylesheet">-->
<script src="<?php echo base_url(); ?>assets/vendor/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jsapi.js"></script>

<script src="<?php echo base_url(); ?>assets/vendor/chart.js/chart.min.js">
</script>
<script src="<?php echo base_url(); ?>assets/vendor/select2/select2.min.js" type="text/javascript"></script>
<!-- EASY PIE CHART JS -->
<script src="<?php echo base_url(); ?>assets/vendor/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js">
</script>
<script src="<?php echo base_url(); ?>assets/js/easy-pie-chart.init.js">
</script>
<script src="<?php echo base_url(); ?>assets/vendor/toggles/toggles.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>


<script>
    var urls = "<?php echo base_url() ?>";
    /**
     * @method datatable
     * @description get records in listing using datatables
     */
    $(document).ready(function () {


        var diagnosticTable = $('#datatable_diagnostic').DataTable({
            "processing": true,
            "serverSide": true,
            "columnDefs": [{
                    "targets": [0, 1, 2, 3, 4, 5],
                    "orderable": false
                }],
            "pageLength": 5,
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "dom": '<<t><"clearfix m-t-20 p-b-20" p>',
            "iDisplayStart ": 20,
            "columns": [
                {"data": "orderId"},
                {"data": "userName"},
                {"data": "diagCatName"},
                {"data": "MIname"},
                {"data": "bookStatus", "searchable": false, "order": false},
                {"data": "action", "searchable": false, "order": false}
            ],
            "ajax": {
                "url": "<?php echo site_url('miappointment/getDignostiData'); ?>",
                "type": "POST",
                "data": function (d) {
                    d.search['value'] = $("#search").val();
                    d.startDate = $("#date-1").val();
                    d.endDate = $("#date-2").val();

                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                },
                beforeSend: function () {
                    // setting a timeout
                    $('#load_diagnostic').addClass('loading').show();
                },
                complete: function ()
                {
                    $('#load_diagnostic').removeClass('loading').hide('200');
                },
            }
        });

        var consultingTable = $('#datatble_consulting').DataTable({
            "bProcessing": true,
            "serverSide": true,
            "columnDefs": [{
                    "targets": [0, 1, 2, 3, 4],
                    "orderable": false
                }],
            "pageLength": 5,
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "dom": '<<t><"clearfix m-t-20 p-b-20" p>',
            "iDisplayStart ": 20,
            "columns": [
                {"data": "orderId"},
                {"data": "userName"},
                {"data": "title"},
                {"data": "bookStatus", "searchable": false, "order": false},
                {"data": "action", "searchable": false, "order": false}
            ],
            "ajax": {
                "url": "<?php echo site_url('miappointment/getConsultingList'); ?>",
                "type": "POST",
                "data": function (d) {
                    d.search['value'] = $("#search").val();
                    d.startDate = $("#date-1").val();
                    d.endDate = $("#date-2").val();
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                },
                beforeSend: function () {
                    // setting a timeout
                    $('#load_consulting').addClass('loading').show();
                },
                complete: function ()
                {
                    $('#load_consulting').removeClass('loading').hide('200');
                },
            }
        });

        $('#search').on('keyup', function () {
            if ($('#li_consulting').hasClass('active'))
                consultingTable.draw();
            else if ($('#li_diagnostic').hasClass('active'))
                diagnosticTable.draw();
            else
                healthpkgTable.draw();
        });
        $('#date-1').datepicker().on('changeDate', function (ev) {
            if ($('#li_consulting').hasClass('active'))
                consultingTable.draw();
            else if ($('#li_diagnostic').hasClass('active'))
                diagnosticTable.draw();
            else
                healthpkgTable.draw();
        });
        $('#date-2').datepicker().on('changeDate', function (ev) {
            if ($('#li_consulting').hasClass('active'))
                consultingTable.draw();
            else if ($('#li_diagnostic').hasClass('active'))
                diagnosticTable.draw();
            else
                healthpkgTable.draw();
        });

    });

    function changestatus(myid, appfor, status_value)
    {
        //appfor 1=Consultation
        if (status_value == 11)
            var con_mess = "Pending";
        else if(status_value == 12)
            con_mess = "Confirm";
        else if(status_value == 13)
            con_mess = "Canceled";
        else if(status_value == 19)
            con_mess = "Expired";
        bootbox.confirm('Do you really want to change status to ' + con_mess + '?', function (result) {
            if (result) {

                var url = '<?php echo site_url(); ?>' + '/miappointment/changestatus';
                $.ajax({
                    url: url,
                    async: false,
                    type: 'POST',
                    data: {'myid': myid, 'ele': appfor, 'status': status_value},
                    beforeSend: function (xhr) {
                    },
                    success: function (data) {
                        alert(data);
                    }
                });
            }
            else
            {
               $('#datatble_consulting').DataTable().ajax.reload();
               $('#datatable_diagnostic').DataTable().ajax.reload();
            }
        });
    }
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

    function getDrTimeSloat(id, doctorUserId, doctorParentId, slotId)
    {
        var url = '<?php echo site_url(); ?>' + '/miappointment' + '/getDrTimeSlot';
        $.ajax({
            url: url,
            async: false,
            type: 'POST',
            data: {'id': id, 'doctorUserId': doctorUserId, 'doctorParentId': doctorParentId, 'slotId': slotId},
            beforeSend: function (xhr) {
            },
            success: function (data) {
                $('#changetime').html(data);
                $('#changeTimemodel').modal('show');
            }
        });
    }
</script>
