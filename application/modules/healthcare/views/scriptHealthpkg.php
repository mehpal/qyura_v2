<link href="<?php echo base_url(); ?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendor/timepicker/bootstrap-timepicker.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/reCopy.js"></script>

<script src="<?php echo base_url(); ?>assets/vendor/select2/select2.min.js" type="text/javascript"></script>  




<script>
    
          $(function(){
            var removeLink = '<a class="remove" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false"> <i class="fa fa-minus-circle fa-2x m-t-5 label-plus"></i></a>';
          $('a.add').relCopy({ append: removeLink});  
         
          
          });
    
    function getDiscount($price, $percentage) {
               if($price != '' && $percentage != ''){
                   if($percentage <= 100){
                   var discount = $price - (($price * $percentage) / 100);
                   $("#discountPrice").val(discount);
                   $('#error-discountPercent1').fadeOut();
                 }else{
                   $('#discountPercent').addClass('bdr-error');
                   $('#error-discountPercent1').fadeIn().delay(3000).fadeOut('slow');
                 }
               }
               
    }
     
    $('#date-3').datepicker();

    $('.pickDate').datepicker()
            .on('changeDate', function (ev) {
                $('.pickDate').datepicker('hide');
            });

    var hideKeyboard = function () {
        document.activeElement.blur();
        $(".pickDate").blur();
    };
</script>


<script>



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
    var urls = "<?php echo base_url() ?>";
    var j = 1;

    function fetchCity(stateId) {

        $.ajax({
            url: urls + 'index.php/pharmacy/fetchCity',
            type: 'POST',
            data: {'stateId': stateId},
            success: function (datas) {
                // console.log(datas);
                $('#pharmacy_cityId').html(datas);
                $('#pharmacy_cityId').selectpicker('refresh');
                $('#StateId').val(stateId);
            }
        });

    }

    function fetchHos(type, cityId) {

        if (type != '' && type == "Hospital") {
            var method = 'index.php/healthcare/fetchHospital';
        } else if (type != '' && type == "Diagnostic") {
            var method = 'index.php/healthcare/fetchDiagno';
        }

        $.ajax({
            url: urls + method,
            type: 'POST',
            data: {'cityId': cityId},
            success: function (datas) {
                $('#miName').html(datas);
                $('#miName').selectpicker('refresh');
            }
        });

    }
    function validationHealthpkg() {
        //$("form[name='pharmacyForm']").submit();
        // alert("here");
        var check = /^[a-zA-Z\s]+$/;
        var alphacheck = /^[a-z0-9]+$/i;
        var cityId = $.trim($('#cityId').val());
        var miType = $.trim($('#miType').val());
        var miName = $.trim($('#miName').val());
        var packagetitle = $.trim($('#packagetitle').val());
        var hospitalservices = $.trim($('#hospitalServices_serviceName1').val());
        
        //discount
        var bestPrice = $.trim($('#bestPrice').val());
        var discountPercent = $.trim($('#discountPercent').val());
        
        var status = 1;
        //debugger;

        if (packagetitle == '') {
            $('#packagetitle').addClass('bdr-error');
            $('#error-packagetitle1').fadeIn().delay(3000).fadeOut('slow');
            status = 0;

        } else if (!check.test(packagetitle))
        {
            $('#packagetitle').addClass('bdr-error');
            $('#error-packagetitle2').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
        }
  
        if ($.trim($('#bestPrice').val()) == '') {
            $('#bestPrice').addClass('bdr-error');
            $('#error-bestPrice').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
            // $('#hospital_countryId').focus();
        }
        if ($.trim($('#discountPrice').val()) == '') {
            $('#discountPrice').addClass('bdr-error');
            $('#error-discountPrice').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
            // $('#hospital_address').focus();
        }
        if (!check.test(hospitalservices)) {
            $('#hospitalServices_serviceName1').addClass('bdr-error');
            $('#error-hospitalServices_serviceName1').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
            // $('#hospital_cntPrsn').focus();
        }
        
        if (cityId == '') {
            $('#city').addClass('bdr-error');
            $('#error-cityId').fadeIn().delay(3000).fadeOut('slow');
            status = 0;

        }
        
        if (miType == '') {
            $('#miType').addClass('bdr-error');
            $('#error-miType').fadeIn().delay(3000).fadeOut('slow');
            status = 0;

        }
        
        if (miName == '') {
            $('#miName').addClass('bdr-error');
            $('#error-miName').fadeIn().delay(3000).fadeOut('slow');
            status = 0;

        }
        
        if(discountPercent > 100){
            $('#discountPercent').addClass('bdr-error');
            $('#error-discountPercent1').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
        }else if(discountPercent == ''){
            $('#discountPercent').addClass('bdr-error');
            $('#error-discountPercent').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
        }
      

            
     if(status == 1){
         return true;
     }else{
         return false;
     }
        //debugger;
  }
  function editValidationHealthpkg() {
        //$("form[name='pharmacyForm']").submit();
        // alert("here");
        var check = /^[a-zA-Z\s]+$/;
        var alphacheck = /^[a-z0-9]+$/i;
        var cityId = $.trim($('#cityId').val());
        var miType = $.trim($('#miType').val());
        var miName = $.trim($('#miName').val());
        var packagetitle = $.trim($('#packagetitle').val());
        var hospitalservices = $.trim($('#hospitalServices_serviceName1').val());
        var status = 1;
        //debugger;

        if (packagetitle == '') {
            $('#packagetitle').addClass('bdr-error');
            $('#error-packagetitle1').fadeIn().delay(3000).fadeOut('slow');
            status = 0;

        } else if (!check.test(packagetitle))
        {
            $('#packagetitle').addClass('bdr-error');
            $('#error-packagetitle2').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
        }
        if ($.trim($('#bestPrice').val()) == '') {
            $('#bestPrice').addClass('bdr-error');
            $('#error-bestPrice').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
            // $('#hospital_countryId').focus();
        }
        if ($.trim($('#discountPrice').val()) == '') {
            $('#discountPrice').addClass('bdr-error');
            $('#error-discountPrice').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
            // $('#hospital_address').focus();
        }
        if (!check.test(hospitalservices)) {
            $('#hospitalServices_serviceName1').addClass('bdr-error');
            $('#error-hospitalServices_serviceName1').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
            // $('#hospital_cntPrsn').focus();
        }
        
        if (cityId == '') {
            $('#city').addClass('bdr-error');
            $('#error-cityId').fadeIn().delay(3000).fadeOut('slow');
            status = 0;

        }
        
        if (miType == '') {
            $('#miType').addClass('bdr-error');
            $('#error-miType').fadeIn().delay(3000).fadeOut('slow');
            status = 0;

        }
        
        if (miName == '') {
            $('#miName').addClass('bdr-error');
            $('#error-miName').fadeIn().delay(3000).fadeOut('slow');
            status = 0;

        }
        
        
       if(discountPercent > 100){
            $('#discountPercent').addClass('bdr-error');
            $('#error-discountPercent1').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
        }else if(discountPercent == ''){
            $('#discountPercent').addClass('bdr-error');
            $('#error-discountPercent').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
        }
      
      
       
            
     if(status == 1){
         return true;
     }else{
         return false;
     }
        //debugger;
  }
    $("#cityId,#miType,#miName,#helathpkg_cityId").select2();
    $(document).ready(function () {
        // alert('test');
        var oTable = $('#bookingHealthPkgTable').DataTable({
            "processing": true,
            "serverSide": true,
            "columnDefs": [{
                    "targets": [0,1,2,3,4,5],
                    "orderable": false
                }],
            "bLengthChange": false,
            "bFilter": false,
            "iDisplayStart ": 10,
            "iDisplayLength": 12,
            "columns": [
                {"data": "miName"},
                {"data": "bookingId"},
                {"data": "packageName"},
                {"data": "bookedBy"},
                {"data": "price"},
                {"data": "action", "searchable": false, "order": false},
                
            ],
            "ajax": {
                "url": "<?php echo site_url('healthcare/getBookingHealthPkgDl'); ?>",
                "type": "POST",
                "data": function (d) {
                    d.cityId = $("#helathpkg_cityId").val();
                    //d.name = $("#search").val();
                     d.mi = $("#mi").val();
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                }
            }
        });

        $('#helathpkg_cityId').change(function () {
         oTable.draw();
         });
         $('#search').on('keyup', function () {
         oTable.draw();
         });
         
         $('#mi').on('keyup', function () {
         oTable.draw();
         });
         
    });



    $(document).ready(function () {
        // alert('test');
        var oTable = $('#healthcarePkgTable').DataTable({
            "processing": true,
            "serverSide": true,
            "columnDefs": [{
                    "targets": [0,1,2,3,4,5],
                    "orderable": false
                }],
            "bLengthChange": false,
            "bFilter": false,
            "iDisplayStart ": 10,
            "iDisplayLength": 12,
            "columns": [
                {"data": "miName"},
                {"data": "healthpkgId"},
                {"data": "title"},
                {"data": "price"},
                {"data": "status"},
                {"data": "view", "searchable": false, "order": false},
            ],
            "ajax": {
                "url": "<?php echo site_url('healthcare/getHealthPkgDl'); ?>",
                "type": "POST",
                "data": function (d) {
                    d.cityId = $("#helathpkg_cityId").val();
                    d.name = $("#search").val();
                    d.mi = $("#mi").val();
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                }
            }
        });

        $('#helathpkg_cityId').change(function () {
            oTable.draw();
        });
        $('#search').on('keyup', function () {
            oTable.draw();
        });

        $('#mi').on('keyup', function () {
            oTable.draw();
        });

    });
    
    
    $("#savebtn").click(function () {
        $("#avatar-modal").modal('hide');
    });

    $("#picEdit").click(function () {
        $(".logo-img").hide();
        $(".logo-up").show();
        $("#picEdit").hide();
        $("#picEditClose").show();

    });

    $("#picEditClose").click(function () {
        $(".logo-up").hide();
        $(".logo-img").show();
        $("#picEdit").show();
        $("#picEditClose").hide();


    });

    var m = 1;
    function countserviceName() {

        if (m == 10)
            return false;
        m = parseInt(m) + parseInt(1);
        $('#serviceName').val(m);
        $('#multiserviceName').append('<div><a class="remove" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false"> <i class="fa fa-minus-circle fa-2x m-t-5 label-plus"></i></a><input type=text class=form-control name=testIncluded[] placeholder="Give Test Name" maxlength="30" id=hospitalServices_serviceName' + m + ' /> <br /></div>');
    }
    
      function createCSV(){
         var mi = '';
         var helathpkg_cityId = '';
         mi = $('#mi').val();
         helathpkg_cityId = $('#helathpkg_cityId').val();
         $.ajax({
              url : urls + 'index.php/healthace/createCSV',
              type: 'POST',
             data: {'mi' : mi ,'helathpkg_cityId': helathpkg_cityId },
             success:function(datas){
                console.log(datas)
             }
          });
     } 
     
      function createCSVForBookPkg(){
         var mi = '';
         var helathpkg_cityId = '';
         mi = $('#mi').val();
         helathpkg_cityId = $('#helathpkg_cityId').val();
         $.ajax({
              url : urls + 'index.php/healthace/createCSVForBookPkg',
              type: 'POST',
             data: {'mi' : mi ,'helathpkg_cityId': helathpkg_cityId },
             success:function(datas){
                console.log(datas)
             }
          });
     } 
     
     
     //    // enable disable row
    function enableFn(ena_id, status_value)
    {
        if (status_value == 1)
            var con_mess = "Disable";
        else
            con_mess = "Enable";
        var url = "<?php echo site_url('healthcare/status'); ?>";
        var r = window.confirm('Do you want to ' + con_mess.toLowerCase() + ' it?') 
            if (r) {
                $.ajax({
                    type: 'post',
                    data: {'enable_id': ena_id, 'status': status_value, 'table': 'qyura_healthPackage', 'id_name': 'healthPackage_id'},
                    url: url,
                    success: function (data) {
                        if (typeof data.isAlive == 'undefined') {
                            if (data)
                            {
                                location.reload(true);
                            }
                        }
                        else
                        {
                            $('#headLogin').html(data.loginMod);
                        }
                    }
                });
            }
    
    }
</script> 
<script> 
    
            $(document).ready(function () {
          var url = "<?php echo base_url()?>";  
        $("#commentForm").validate({
           

            rules: {
               
               
                city: {
                    required: true
                },
                miType: {
                    required: true
                },
                miName: {
                    required: true
                },
                 packagetitle: {
                    required: true,
                    lettersonly: true
                },
                
                bestPrice: {
                    required: true,
                    number: true,
                  
                },
                discountPercent: {
                    required: true,
                    number: true,
                  
                },
                discountPrice: {
                    required: true,
                    number: true,
                  
                },
                'testIncluded[]':{
                   required: true,  
                }
              
            },
            messages: {
              
                
                 city: {
                    required: "Please select City.",
                },
                  miType: {
                    required: "Please select MI/Doctor Type.",
                },
                miName: {
                    required: "Please select MI Name.",
                },
                  packagetitle: {
                    required: "Please enter Package Title.",
                },
              
                bestPrice: {
                    required: "Please enter Best Price.",
                     number:  "Please enter only number."

                },
                discountPercent: {
                    required:"Please enter Discount Percent.",
                    number:  "Please enter only number."
                  
                },
                discountPrice: {
                    required:"Please enter Discount Price.",
                    number:  "Please enter only number."
                  
                },
                 'testIncluded[]':{
                   required: "Please enter Test Includes",  
                }
            },
            submitHandler: function (form) {
                form.submit();
            },
        });

    });
    </script>