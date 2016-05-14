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
        $('.timeslot').timepicker({showMeridian: false});
        $('#date-7').datepicker();
        
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
    function getTimeSlot() {
        
        //var h_d_id = $('#mi_centre').val();;
        var docid = $('#docid').val();

        var appdate = $('#date-7').val();
        $('#timeSlot').selectpicker('refresh');
        //var type = $("#centerType").val();
        var url = '<?php echo site_url(); ?>/miappointment/appoint_timeSlot';
        
            $.ajax({
                url: url,
                async: false,
                type: 'POST',
                data: {'docid': docid, 'appdate': appdate},
                beforeSend: function (xhr) {
                    
                },
                success: function (data) {
                    $('#timeSlot').html(data);
                }
            });
            
    }
    function check_validaton() {
        var url = '<?php echo site_url(); ?>/docappointment/check_timeslot/';
        var final_timing = $("#timepicker3").val();
        var timeslot_id = $("#timeSlot").val();
        var resultAjax = false;
        $.ajax({
            url: url,
            async: false,
            type: 'POST',
            data: {'timeslot_id': timeslot_id, 'final_timing': final_timing},
            success: function (data) {
                if (data == 1) {
                    $("#err_timepicker4").hide();
                    resultAjax = 0;
                } else {
                    $("#err_timepicker4").show();
                    resultAjax++;
                }
            }
        });
    }
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
                        location.reload(); 
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
    //consulting's timeslot update validation starts
        var url = "<?php echo base_url(); ?>";
        $("#changetimeform").validate({
            rules: {
                appdate: {
                    required: true
                },
                timeSlot: {
                    required: true,
                },
                finaltime: {
                    required: true,
                    remote: {
                    url: url + 'index.php/miappointment/check_timeslot',
                    type: "post",
                    data: {
                        timeslot_id: function () {var timeSlot = $("#timeSlot").val().split(',');return timeSlot[0];},
                        final_timing: function () {return $("#timepicker3").val();},
                    }
                }
                }
            },
            messages: {
                appdate: {
                    required: "Please select App Date",
                     },
                timeSlot: {
                    required: "Please select Time Slot!",
                     },
                finaltime: {
                    required: "Please select Final Time",
                    remote: "Please select correct time slot."
                     }
            },
            submitHandler: function(form)
             {
                var appdate = $("#date-7").val();
                var timeSlot = $("#timeSlot").val();
                var finaltime = $("#timepicker3").val();
                var appid = $("#appid").val();
                var url = '<?php echo site_url(); ?>' + '/miappointment/savetimeSlot';
                $.ajax({
                    url: url,
                    async: false,
                    type: 'POST',
                    data: {'appdate': appdate, 'timeSlot': timeSlot, 'finaltime': finaltime,'appid':appid},
                    beforeSend: function (xhr) {
                },
                success: function (data) {
                if(data==0)
                {
                    var msg = "Please select proper Date & Time";
                     bootbox.alert({closeButton: false, message: msg, callback: function () {
                                
                            }});
                }
                else
                {
                    var msg = "Appointment Rescheduled Successfully";
                     bootbox.alert({closeButton: false, message: msg, callback: function () {
                              location.reload();  
                            }});
                }
                

                }
            });
            $form.submit();
            }
        }); 
//consulting's timeslot update validation ends
//diagnostic's timeslot update validation starts
        var url = "<?php echo base_url(); ?>";
        $("#changetimeform2").validate({
            rules: {
                appdate2: {
                    required: true
                },
                finaltime2: {
                    required: true
                }
            },
            messages: {
                appdate2: {
                    required: "Please select App Date",
                },
                finaltime2: {
                    required: "Please select Final Time",
                }
            },
        
        submitHandler: function(form)
        {
        var appdate = $("#date-11").val();
        var finaltime = $("#timepicker11").val();
        var appid = $("#appid").val();
        var url = '<?php echo site_url(); ?>' + '/miappointment/savediagtimeSlot';
        $.ajax({
            url: url,
            async: false,
            type: 'POST',
            data: {'appdate': appdate,'finaltime': finaltime,'appid':appid},
            beforeSend: function (xhr) {
            },
            success: function (data) {
                
                if(data==2)
                {
                    var msg = "Please select proper Date & Time";
                     bootbox.alert({closeButton: false, message: msg, callback: function () {
                                
                            }});
                }
                else
                {
                    var msg = "Appointment Rescheduled Successfully";
                     bootbox.alert({closeButton: false, message: msg, callback: function () {
                                location.reload();
                            }});
                }
               
            }
        });
        $form.submit();
            
    }
}); 
//diagnostic's timeslot update validation ends
    /**
     * @method getTimeSloat
     * @description  SHOW MODAL WITH SLOAT
     */
    function getTimeSloat(quotation_id, miId, timeSlotId)
    {
         $('#myModal2').modal('show');
//        var url = '<?php echo site_url(); ?>' + '/miappointment' + '/get_timeSlot';
//        $.ajax({
//            url: url,
//            async: false,
//            type: 'POST',
//            data: {'quotation_id': quotation_id, 'miId': miId, 'timeSlotId': timeSlotId},
//            beforeSend: function (xhr) {
//            },
//            success: function (data) {
//                $('#changetime').html(data);
//                $('#changeTimemodel').modal('show');
//            }
//        });
    }

    function getDrTimeSloat(id, doctorUserId, doctorParentId, slotId)
    {
       
        $('#myModal1').modal('show');
        
//        var url = '<?php echo site_url(); ?>' + '/miappointment' + '/getDrTimeSlot';
//        $.ajax({
//            url: url,
//            async: false,
//            type: 'POST',
//            data: {'id': id, 'doctorUserId': doctorUserId, 'doctorParentId': doctorParentId, 'slotId': slotId},
//            beforeSend: function (xhr) {
//            },
//            success: function (data) {
//                $('#changetime').html(data);
//                $('#changeTimemodel').modal('show');
//            }
//        });
    }
</script>
