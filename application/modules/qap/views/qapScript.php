<style type="text/css">
    #qap_datatable_filter
    {
        display:none;
    }
    label.error p{
        color: #ef5350 !important;
    }
</style>


<link href="<?php echo base_url(); ?>assets/cropper/cropper.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/cropper/main.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/cropper/cropper.js"></script>

<?php
$current = $this->router->fetch_method();
if ($current != 'detailDiagnostic'):
    ?>
    <script src="<?php echo base_url(); ?>assets/cropper/main.js"></script>
<?php else: ?>

    <script src="<?php echo base_url(); ?>assets/cropper/common_cropper.js"></script>

<?php endif; ?>

<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/x-editable/jquery.xeditable.js"></script> 
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/select2/select2.min.js" type="text/javascript"></script> 
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js" type="text/javascript"></script> 

<script src="<?php echo base_url(); ?>assets/js/common_js.js"></script> 

<script>
  
      var urls = "<?php echo base_url() ?>";
    $(document).ready(function () {
        $("#submitForm").validate({
            rules: {
                qap_name: {
                    required: true
                },
                qap_email: {
                    required: true,
                    email: true,
                    remote: {
			url:  urls + 'index.php/qap/checkUserExistence',
			type: "post",
			data: {
				email: function(){ return $("#qap_email").val(); },
                                id: function(){ return $("#qap_id").val(); }
			},
		}
                },
                qap_city: {
                    required: true
                },
                qap_phone: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                },
                qap_address: {
                    required: true
                },
                qap_bank_name: {
                    required: true
                },
                qap_accountNo: {
                    required: true,
                    number: true,
                    minlength: 11,
                    maxlength: 15
                },
                qap_branch: {
                    required: true
                },
                qap_ifscCode: {
                    required: true,
                    minlength: 6,
                    maxlength: 11
                   // number: true
                },
                qap_bankCity: {
                    required: true
                }
            },
            messages: {
                qap_name: {
                    required: "Please enter name",
                },
                qap_email: {
                    required: "Please enter email Id",
                    email: "Please enter valid email Id.",
                    remote: 'Email already used.'
                },
                qap_city: {
                    required: "Please select city."
                },
                qap_phone: {
                    required: "Please enter mobile number.",
                    number: "Please enter only number format."
                },
                qap_address: {
                    required: "Please enter address.",
                },
                qap_bank_name: {
                    required: "Please enter bank name."
                },
                qap_accountNo: {
                    required: "Please enter account number.",
                    number: "Please enter only number.",
                },
                qap_branch: {
                    required: "Please enter branch name."
                },
                qap_ifscCode: {
                    required: "Please enter IFSC code.",
                   // number: "Please enter only number."

                },
                qap_bankCity: {
                    required: "Please select bank city."
                }
            }

        });


  $('.selectpicker').select2();
        var oTableQap = $('#qap_datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "columnDefs": [{
                    "targets": [0, 1, 2, 3, 4, 5, 6,7],
                    "orderable": false
                }],
            "pageLength": 10,
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "dom": '<<t><"clearfix m-t-20 p-b-20" p>',
            "iDisplayStart ": 20,
            "columns": [
                {"data": "qap_name"},
                {"data": "qap_email"},
                {"data": "qap_phone"},
                {"data": "qap_code"},
                {"data": "qap_dateOfGeneration"},
                {"data": "qap_city"},
                {"data": "status"},
                {"data": "action", "searchable": false, "order": false}
            ],
            "ajax": {
                "url": "<?php echo site_url('qap/getQapDetail'); ?>",
                "type": "POST",
                "async": false,
                "data": function (d) {
                    d.search['value'] = $("#search").val();
                    d.status = $("#status").val();
                    d.cityId =$("#cityId").val();
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                },
                beforeSend: function () {
                    // setting a timeout
                    // $('#load_consulting').show();
                },
                complete: function ()
                {
                    //$('#load_consulting').hide('200');
                },
            }
        });

        $('#status').change(function () {
            oTableQap.draw();
        });
        
          $('#cityId').change(function () {
            oTableQap.draw();
        });

        $('#search').on('keyup', function () {
            oTableQap.draw();
        });
    });
</script>
