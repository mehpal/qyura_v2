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
                {"data": "bookStatus"},
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
	else if(status_value == 14)
            con_mess = "Completed";
        bootbox.confirm('Do you really want to change status to ' + con_mess + '?', function (result) {
            if (result) {

                var url = '<?php echo site_url(); ?>' + '/docappointment/changestatus';
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
               $('#doctorAppointmentTable').DataTable().ajax.reload();
            }
        });
    }
    
</script>

<script> 
    function changeDoctorStatus(myid, appfor, status_value)
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
	else if(status_value == 14)
            con_mess = "Completed";
        bootbox.confirm('Do you really want to change status to ' + con_mess + '?', function (result) {
            if (result) {

                var url = '<?php echo site_url(); ?>' + '/docappointment/changeDoctorStatus';
                $.ajax({
                    url: url,
                    async: false,
                    type: 'POST',
                    data: {'myid': myid, 'ele': appfor, 'status': status_value},
                    beforeSend: function (xhr) {
                        qyuraLoader.startLoader();
                    },
                    success: function (data) {
                        location.reload(); 
                    }
                });
            }
            else
            {
               $('#doctorAppointmentTable').DataTable().ajax.reload();
              // $('#datatable_diagnostic').DataTable().ajax.reload();
            }
        });
    }
    
    
          function getTimeSlot(docid=false,appdate=false,h_d_id=false,center_type=false) {
        
//        var h_d_id = $('#mi_centre').val();
//        var docid = $('#docid').val();

//        var appdate = $('#date-7').val();
        $('#timeSlot').selectpicker('refresh');
//        var type = $("#centerType").val();
        var url = '<?php echo site_url(); ?>/docappointment/appointDoctortimeSlot';
        
            $.ajax({
                url: url,
                async: false,
                type: 'POST',
                data: {'docid': docid, 'appdate': appdate,'h_d_id':h_d_id,'centertype':center_type},
                beforeSend: function (xhr) {
                    //qyuraLoader.startLoader();
                },
                success: function (data) {
                    
                    $('#timeSlot').html(data);
                }
            });
            //qyuraLoader.stopLoader();
            
    }
    
    
        function getDrTimeSloat(id, docId, Miid, centerType,status)
    {
       if(status=="13" || status=="14" || status=="19")
        {
            bootbox.alert({closeButton: true, message: "Access Denied..!!", callback: function () {
                    
                            }});
        }
        else
        {  
        $("#docid").val(docId);

        $("#appid").val(id);
        $("#h_d_id").val(Miid);

         $("#center_type").val(centerType);

         $('#myModal1').modal('show');
         
         <?php $date = date('m/d/Y'); ?>
          $('#date-7').datepicker({
              autoclose: true,
               startDate: '<?php echo $date; ?>',
            });
     }
    }
    

</script>

<script>
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
                    url: url + 'index.php/docappointment/check_timeslot',
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
                var url = '<?php echo site_url(); ?>' + '/docappointment/savetimeSlot';
                $.ajax({
                    url: url,
                    async: false,
                    type: 'POST',
                    data: {'appdate': appdate, 'timeSlot': timeSlot, 'finaltime': finaltime,'appid':appid},
                    beforeSend: function (xhr) {
                        qyuraLoader.startLoader();
                },
                success: function (data) {
                     qyuraLoader.stopLoader();
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
           
            //$form.submit();
            
            }
        });
</script>