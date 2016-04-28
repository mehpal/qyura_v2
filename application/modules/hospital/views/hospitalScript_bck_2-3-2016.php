<style type="text/css">
    #datatable_bloodbank_filter
    {
        display:none;
    }
</style>

<?php $check= 0; 
$id = $this->uri->segment(3); 
if(!empty($id)){
	$check = $this->uri->segment(3); 
}else{
	$check = 0 ;
}?>

<link href="<?php echo base_url();?>assets/cropper/cropper.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/cropper/main.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url();?>assets/vendor/timepicker/bootstrap-timepicker.min.js">  </script>
<script src="<?php echo base_url(); ?>assets/cropper/cropper.js"></script>


<?php  $current = $this->router->fetch_method();
if($current != 'detailHospital'):?>
<script src="<?php echo base_url(); ?>assets/cropper/main.js"></script>
<?php else:?>

<!--<script src="<?php echo base_url(); ?>assets/cropper/common_cropper.js"></script>-->
<script src="<?php echo base_url(); ?>assets/cropper/gallery_cropper.js"></script>

<?php endif;?>


<script src="<?php echo base_url(); ?>assets/js/reCopy.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/blood-detail.js"></script>
 <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/addHospital.js"> </script>
<script src="<?php echo base_url(); ?>assets/js/pages/hospital-detail.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/x-editable/jquery.xeditable.js"> </script>
    <!--<script src="<?php echo base_url(); ?>assets/js/angular.min.js"> </script>-->
    
    <script src="<?php echo base_url();?>assets/vendor/select2/select2.min.js" type="text/javascript"></script>  

    <script>
        var resizefunc = [];
    </script>
    <script> var hospitalId = <?php echo $check;?> </script>
<script>
             /*-- Selectpicker --*/
$('.selectpicker').selectpicker({
    style: 'btn-default',
    size: "auto",
    width: "100%"
});

        var urls = "<?php echo base_url()?>";
         var j = 1;
         var k = 1;
         var l = 1;
         var n= 1;
         var m = 1;
         var p = 1;
var stateIds = $.trim($('#StateId').val());
function fetchCity(stateId) {           
           $.ajax({
               url : urls + 'index.php/hospital/fetchCity',
               type: 'POST',
              data: {'stateId' : stateId},
              success:function(datas){
                  $('#hospital_cityId').html(datas);
                  $('#hospital_cityId').selectpicker('refresh');
              }
           });
           
        }
                         // datatable get records
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
                        {"data": "hospital_img"},
                        {"data": "hospital_name"},
                        {"data": "city_name"},
                        {"data": "hospital_phn"},
                        {"data": "hospital_address"},
                        {"data": "view"},
                    ],
                    
                    "ajax": {
                        "url": "<?php echo site_url('hospital/getHospitalDl'); ?>",
                        "type": "POST", 
                        "data": function ( d ) {
                                         d.cityId = $("#hospital_cityId").val();
                                         d.name = $("#search").val();
                                         if($("#hospital_stateId").val() != ' '){
                                         d.hosStateId = $("#hospital_stateId").val();
                                        }
                                         d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                                    } 
                    }
                });
                
                  $('#hospital_cityId,#hospital_stateId').change( function() {
                        oTable.draw();
                  } );
                     $('#search').on('keyup', function() {
                        //oTable.draw();
                         oTable.columns( 5 ).search($(this).val()).draw() ;
                        
                  } );

                  $(".bs-select").select2({ placeholder: "Select Insurance",
		          allowClear: true
		      });
		        loadAwards();
		        loadServices();
		        var pharmacy_status = '';
		        pharmacy_status = $('#pharmacy_status').val();
		        var bloodbank_status = '';
		        bloodbank_status = $('#bloodbank_status').val();
		        if(bloodbank_status != '')
		        $("#bloodbankbtn").trigger("click");
		        if(bloodbank_status != '')
		        $("#pharmacybtn").trigger("click");
		         
		         loadSpeciality();
		          loadDiagonastic();    
                $("#edit").click(function () {
                 $("#detail").toggle();
                    $("#newDetail").toggle();
                });
                $("#editdetail").click(function () {
                    $("#detail").toggle();
                    $("#newDetail").toggle();
                });
            });

 function addDiagnostic(){
         $('.diagonasticCheck').each(function() {
             
            if($(this).is(':checked')){
                //alert($(this).val());
                $.ajax({
                    url : urls + 'index.php/hospital/addDiagnostic',
                    type: 'POST',
                   data: {'hospitalId' : hospitalId , 'hospitalDiagnosticsCat_diagnosticsCatId' : $(this).val() },
                   success:function(datas){
                    
                       loadDiagonastic();
                   }
                });
            }
            
        });
    }

     function revertDiagnostic(){
         $('.diagonasticAllocCheck').each(function() {
            if($(this).is(':checked')){
                $.ajax({
                    url : urls + 'index.php/hospital/revertDiagnostic',
                    type: 'POST',
                   data: {'hospitalId' : hospitalId , 'hospitalDiagnosticsCat_id' : $(this).val() },
                   success:function(datas){
                    
                       loadDiagonastic();
                   }
                });
            }
            
        });
    }
     function showDiagonasticDetail(hospitalId,categoryId){
        $.ajax({
                    url : urls + 'index.php/hospital/detailDiagnostic',
                    type: 'POST',
                   data: {'hospitalId' : hospitalId , 'categoryId' : categoryId },
                   success:function(datas){
                    
                       $('#loadTestDetail').html(datas);
                   }
                });
    }

    function fetchInstruction(digTestId){
         $.ajax({
                    url : urls + 'index.php/hospital/detailDiagnosticInstruction',
                    type: 'POST',
                   data: {'quotationDetailTests_id' : digTestId},
                   success:function(datas){
                    
                       $('#detailInstruction').html(datas);
                       $('#detailsAll').val(datas);
                       $('#instructionId').val(digTestId);
                   }
                });
    }
    function loadDiagonastic(){
        $('#list1').load(urls + 'index.php/hospital/hospitalDiagnostics/'+hospitalId,function () {
           // alert('callback function implementation');
        });
        
        $('#list').load(urls + 'index.php/hospital/hospitalFetchDiagnostics/'+hospitalId,function () {
           // alert('callback function implementation');
        });
        $('#loadTestDetail').html('');
    }
    function sendSpeciality(){
        var specialityId = [];
        $('.specialityCheck').each(function() {
            if($(this).is(':checked')){
                $.ajax({
                    url : urls + 'index.php/hospital/addSpeciality',
                    type: 'POST',
                   data: {'hospitalId' : hospitalId , 'hospitalSpecialities_specialitiesId' : $(this).val() },
                   success:function(datas){
                    
                      loadSpeciality();
                   }
                });
            }
            
        });
    }
    
    function revertSpeciality(){
        $('.specialityAllocCheck').each(function() {
            if($(this).is(':checked')){
                //alert($(this).val());
                $.ajax({
                    url : urls + 'index.php/hospital/revertSpeciality',
                    type: 'POST',
                   data: {'hospitalId' : hospitalId , 'hospitalSpecialities_id' : $(this).val() },
                   success:function(datas){
                    
                      loadSpeciality();
                   }
                });
            }
            
        });
    }
   
    
    function loadSpeciality(){
     $('#list2').load(urls + 'index.php/hospital/hospitalSpecialities/'+hospitalId,function () {
           // alert('callback function implementation');
        });
        $('#list3').load(urls + 'index.php/hospital/hospitalAllocatedSpecialities/'+hospitalId,function () {
           // alert('callback function implementation');
        });
    
    }  
    
function addAwards(){
        var hospitalAwards_awardsName = $.trim($('#hospitalAwards_awardsName').val());
        if(hospitalAwards_awardsName != ''){
            
            $.ajax({
               url : urls + 'index.php/hospital/addHospitalAwards',
               type: 'POST',
              data: {'hospitalId' : hospitalId , 'hospitalAwards_awardsName' : hospitalAwards_awardsName },
              success:function(datas){
               // console.log(datas);
                  loadAwards();
                  $('#hospitalAwards_awardsName').val('');
              }
           });
        }    
    }
    function editAwards(awardsId){
         var edit_awardsName = $.trim($('#'+awardsId).val());
        
        if(edit_awardsName != ''){
            
            $.ajax({
               url : urls + 'index.php/hospital/editHospitalAwards',
               type: 'POST',
              data: {'awardsId' : awardsId , 'hospitalAwards_awardsName' : edit_awardsName },
              success:function(datas){
              console.log(datas);
                  loadAwards();
              }
           });
        }  
    }
    function deleteAwards(awardsId){
        
         $.ajax({
               url : urls + 'index.php/hospital/deleteHospitalAwards',
               type: 'POST',
              data: {'awardsId' : awardsId },
              success:function(datas){
              console.log(datas);
                  loadAwards();
              }
           });
        
    }
    function loadAwards(){
       
        $('#loadAwards').load(urls + 'index.php/hospital/hospitalAwards/'+hospitalId,function () {
           // alert('callback function ');
        });
        $('#totalAwards').load(urls + 'index.php/hospital/detailAwards/'+hospitalId,function () {
           // alert('callback function implementation');
        });
    }
    function loadServices(){
        $('#loadServices').load(urls + 'index.php/hospital/hospitalServices/'+hospitalId,function (data) {
            //alert('callback function implementation');
            
        });
        $('#totalServices').load(urls + 'index.php/hospital/detailServices/'+hospitalId,function () {
            //alert('callback function implementation');
        });
    }
    function addServices(){
        var hospitalServices_serviceName = $.trim($('#hospitalServices_serviceName').val());
        //alert(hospitalServices_serviceName);
        if(hospitalServices_serviceName != ''){
            
            $.ajax({
               url : urls + 'index.php/hospital/addHospitalService',
               type: 'POST',
              data: {'hospitalId' : hospitalId , 'hospitalServices_serviceName' : hospitalServices_serviceName },
              success:function(datas){
               // console.log(datas);
                  loadServices();
                  $('#hospitalServices_serviceName').val('');
              }
           });
        }    
    }
    
    function editServices(serviceId){
         var edit_serviceName = $.trim($('#'+serviceId).val());
        
        if(edit_serviceName != ''){
            
            $.ajax({
               url : urls + 'index.php/hospital/editHospitalService',
               type: 'POST',
              data: {'serviceId' : serviceId , 'hospitalServices_serviceName' : edit_serviceName },
              success:function(datas){
              console.log(datas);
                  loadServices();
              }
           });
        }  
    }
    
    function deleteServices(serviceId){
        
         $.ajax({
               url : urls + 'index.php/hospital/deleteHospitalService',
               type: 'POST',
              data: {'serviceId' : serviceId },
              success:function(datas){
              console.log(datas);
                  loadServices();
              }
           });
        
    }
    $('#date-3').datepicker();

    $(function () {
        $("#geocomplete").geocomplete({
            map: ".map_canvas",
            details: "form",
            types: ["geocode", "establishment"],
        });

        $("#find").click(function () {
            $("#geocomplete").trigger("geocode");
        });
    });
    /*-- Selectpicker --*/
    $('.selectpicker').selectpicker({
        style: 'btn-default',
        size: "auto",
        width: "100%"
    });

   
    function fetchCityList(stateId) {
        $.ajax({
            url: urls + 'index.php/hospital/fetchCity',
            type: 'POST',
            data: {'stateId': stateId},
            success: function (datas) {
                $('#hospital_cityId').html(datas);
                $('#hospital_cityId').selectpicker('refresh');

            }
        });


    }

        function countPhoneNumber(){
        if(j==10)
            return false;
      j = parseInt(j)+parseInt(1); 
      $('#countPnone').val(j);
      $('#multiPhoneNumber').append('<input type=text class=form-control name=hospital_phn[] placeholder=9837000123 maxlength="10" id=hospital_phn'+j + ' />');
     $('#multiPreNumber').append('<select class=selectpicker data-width=100% name=pre_number[] id=multiPreNumber'+j+'><option value=91>+91</option><option value=1>+1</option></select>');
      $('#multiPreNumber'+j).selectpicker('refresh');
      //.append('<div class=col-lg-3 col-md-4 col-sm-3 col-sm-4 col-xs-12 m-t-xs-10 id=multiPreNumber><select class=selectpicker data-width=100% name=pre_number[] id=multiPreNumber><option value =91>+91</option><option value =1>+1</option></select></div><div class=col-lg-7 col-md-6 col-sm-7 col-xs-10 m-t-xs-10 id=multiPhoneNumber><nput type=text class="form-control" name=hospital_phn[] id=hospital_phn1 placeholder=9837000123 maxlength=10 /> </div>');

   }
       function countBloodPhoneNumber(){
        if(k==10)
            return false;
      k = parseInt(k)+parseInt(1); 
      $('#countbloodBank_phn').val(k);
      $('#multiBloodbnkPhoneNumber').append('<input type=text class=form-control name=bloodBank_phn[] placeholder=9837000123 maxlength="10" id=bloodBank_phn'+k + ' />' );
     $('#multiBloodbnkPreNumber').append('<select class=selectpicker data-width=100% name=preblbankNo[] id=preblbankNo'+k+'><option value=91>+91</option><option value=1>+1</option></select>');
      $('#preblbankNo'+k).selectpicker('refresh');
      
   }

   function countPharmacyPhoneNumber(){
       if(l==10)
            return false;
      l = parseInt(l)+parseInt(1); 
      $('#countPharmacy_phn').val(l);
      $('#multipharmacyNumber').append('<input type=text class=form-control name=pharmacy_phn[] placeholder=9837000123 maxlength="10" id=pharmacy_phn'+l + ' />' );
     $('#multipharmacyPreNumber').append('<select class=selectpicker data-width=100% name=prePharmacy[] id=prePharmacy'+l+'><option value=91>+91</option><option value=1>+1</option></select>');
      $('#prePharmacy'+l).selectpicker('refresh');
   }
   
   function countAmbulancePhoneNumber(){
       if(n==10)
            return false;
      n = parseInt(n)+parseInt(1); 
      $('#countAmbulance_phn').val(n);
      $('#phoneAmbulance').append('<input type=text class=form-control name=ambulance_phn[] placeholder=9837000123 maxlength="10" id=ambulance_phn'+n + ' /> ' );
     $('#preAmbulance_name').append('<select class=selectpicker data-width=100% name=preAmbulance[] id=preAmbulance'+n+'><option value=91>+91</option><option value=1>+1</option></select> ');
     $('#preAmbulance'+n).selectpicker('refresh');
   }
   
   function countserviceName(){
        if(m==10)
            return false;
      m = parseInt(m)+parseInt(1); 
      $('#serviceName').val(m);
      $('#multiserviceName').append('<input type=text class=form-control name=hospitalServices_serviceName[] placeholder="Give Your Service Name" maxlength="30" id=hospitalServices_serviceName'+m + ' /> <br /> ' );
   }
   function bbname(){
       var bbankname = $('#bloodBank_name').val();
        var check= /^[a-zA-Z\s]+$/;
    if(!check.test(bbankname)){
    $('#bloodBank_name').addClass('bdr-error');
    $('#error-bloodBank_name').fadeIn().delay(3000).fadeOut('slow');
    // $('#bloodBank_name').focus();
    }
}
   function bbphone(){
    var bbphcheck=/^[0-9]+$/;
    var bbankphone=$.trim($('#bloodBank_phn1').val());
   if(!$.isNumeric(bbankphone)){
                
                $('#bloodBank_phn1').addClass('bdr-error');
                $('#error-bloodBank_phone').fadeIn().delay(3000).fadeOut('slow');
                // $('bloodBank_name').focus();
            } 
}
   function phname(){
        var pharname = $.trim($('#pharmacy_name').val());
          var check= /^[a-zA-Z\s]+$/;
        if(!check.test(pharname)){
        $('#pharmacy_name').addClass('bdr-error');
        $('#error-pharmacy_name').fadeIn().delay(3000).fadeOut('slow');
        // $('#pharmacy_name').focus();
}
}
   function phphone(){
    var pharname=$.trim($('#pharmacy_phn1').val());
    var phphonecheck=/^[0-9]+$/;
 if(!$.isNumeric(pharname)){
                
                $('#pharmacy_phn1').addClass('bdr-error');
                $('#error-pharmacy_phn1').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_zip').focus();
            } 
}
   function amname(){
        var amname =$.trim($('#ambulance_name').val());
        var check= /^[a-zA-Z\s]+$/;
        if(!check.test(amname)){
        $('#ambulance_name').addClass('bdr-error');
        $('#error-ambulance_name').fadeIn().delay(3000).fadeOut('slow');
        // $('#pharmacy_name').focus();
}
}
   function amphone(){
    var amname=$.trim($('#ambulance_phn1').val());
    var amphonecheck=/^[0-9]+$/;
 if(!$.isNumeric(amname)){
   $('#ambulance_phn1').addClass('bdr-error');
   $('#error-ambulance_phn1').fadeIn().delay(3000).fadeOut('slow');
  } 
}
   function validationHospital(){
         //$("form[name='hospitalForm']").submit();
       
        var check= /^[a-zA-Z\s]+$/;
        var numcheck=/^[0-9]+$/;
        var emails = $.trim($('#users_email').val());
        var cpname = $.trim($('#hospital_cntPrsn').val());
        var dsgn = $.trim($('#hospital_dsgn').val());
        var hsname =$.trim($('#hospitalServices_serviceName1').val());
        var pswd = $.trim($("#users_password").val());
        var cnfpswd = $.trim($("#cnfPassword").val());
        var mbl= $.trim($('#hospital_mblNo').val());
        var phn= $.trim($('#hospital_phn1').val());
        var myzip = $.trim($('#hospital_zip').val());
        var cityId =$.trim($('#hospital_cityId').val());
        var stateIds = $.trim($('#StateId').val());
        var hospital_mblNo = $.trim($('#hospital_mblNo').val());
        var aboutUs = $.trim($('#hospital_aboutUs').val());
  // alert(aboutUs);
            if($('#hospital_name').val()==''){
                $('#hospital_name').addClass('bdr-error');
                $('#error-hospital_name').fadeIn().delay(3000).fadeOut('slow');
                //return false;
               // $('#hospital_name').focus();
            }
          if($('#hospital_type').val()==''){
                $('#hospital_type').addClass('bdr-error');
                $('#error-hospital_type').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_type').focus();
            }
            if($.trim($('#hospital_countryId').val()) == ''){
                $('#hospital_countryId').addClass('bdr-error');
                $('#error-hospital_countryId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_countryId').focus();
            }
          if(!$.isNumeric(stateIds)){
               // console.log("in state");
                $('#hospital_stateId').addClass('bdr-error');
                $('#error-hospital_stateId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_stateId').focus();
            }
           if(!$.isNumeric(cityId)){
                $('#hospital_cityId').addClass('bdr-error');
                $('#error-hospital_cityId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_cityId').focus();
            }
           
            if(!$.isNumeric(myzip)){
                
                $('#hospital_zip').addClass('bdr-error');
                $('#error-hospital_zip').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_zip').focus();
            } 

           if($("input[name='hospital_address']" ).val()==''){
                $('#hospital_address').addClass('bdr-error');
                $('#error-hospital_address').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_address').focus();
            }
            
          if(!$.isNumeric(phn)){
                $('#hospital_phn1').addClass('bdr-error');
                $('#error-hospital_phn').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_phn').focus();
            }
            
            if(!check.test(hsname)){
                $('#hospitalServices_serviceName1').addClass('bdr-error');
                $('#error-hospitalServices_serviceName').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospitalServices_serviceName1').focus();
            }
           
           if(!check.test(cpname)){
                $('#hospital_cntPrsn').addClass('bdr-error');
                $('#error-hospital_cntPrsn').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_cntPrsn').focus();
            }
            if(!check.test(dsgn)){
                $('#hospital_dsgn').addClass('bdr-error');
                $('#error-hospital_dsgn').fadeIn().delay(3000).fadeOut('slow');
               
               // $('#hospital_dsgn').focus();
            }
            if($('#hospital_mmbrTyp').val()==''){
                $('#hospital_mmbrTyp').addClass('bdr-error');
                $('#error-hospital_mmbrTyp').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_mmbrType').focus();
            }
            if(aboutUs === ''){
                $('#hospital_aboutUs').addClass('bdr-error');
                $('#error-hospital_aboutUs').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_aboutUs').focus();
            }
            if($('#users_email').val()==''){
                $('#users_email').addClass('bdr-error');
                $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');
               // $('#users_email').focus();
            }
           
          
           if(!($.isNumeric(hospital_mblNo))){
                $('#hospital_mblNo').addClass('bdr-error');
                $('#error-hospital_mblNo').fadeIn().delay(3000).fadeOut('slow');
                
               // $('#hospital_mblNo').focus();
            }
           if($('#users_password').val()=='' || pswd.length < 6){
                $('#users_password').addClass('bdr-error');
                $('#error-users_password').fadeIn().delay(3000).fadeOut('slow');
               // $('#users_password').focus();
            }
            if($('#cnfPassword').val()=='' || pswd!= cnfpswd){
                $('#cnfPassword').addClass('bdr-error');
                $('#error-cnfPassword_check').fadeIn().delay(3000).fadeOut('slow');
                
               // $('#cnfpassword').focus();
            }
               //debugger;
        if(emails !=''){
              check_email(emails);
              return false;
            }
            return false;
            
        }
   function checkEmailFormat(){
                var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                var email = $('#users_email').val();
                if(email!==''){
                    if (!filter.test(email)){
                        
                       $('#users_email').addClass('bdr-error');
                         $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');;
                        // $('#users_email').focus();

                    }
            }
        }   
   function check_email(myEmail){
           $.ajax({
               url : urls + 'index.php/hospital/check_email',
               type: 'POST',
              data: {'users_email' : myEmail},
              success:function(datas){
                  if(datas == 0){
                   $("form[name='hospitalForm']").submit();
                   return true;
              }
              else {
                        $('#users_email').addClass('bdr-error');
                    $('#error-users_email_check').fadeIn().delay(3000).fadeOut('slow');;
                   return false;
                  }
              } 
           });
        }
   /*function addMultiserviceName(){
       if(p==10)
            return false;
      p = parseInt(p)+parseInt(1); 
      $('#countServiceName').val(p);
      $('#multiserviceName').append('<input type="text" class="form-control" name="hospitalServices_serviceName[]" id="" placeholder="Give Your Service Name" maxlength="30" />' );
   }*/
    
        $("#savebtn").click(function(){
         $("#avatar-modal").modal('hide');
     }); 
     
    </script> 
  <script>
      
       function validationHospitalDetail(){
       // alert('test');   
       //$("form[name='bloodDetail']").submit();
        var check= /^[a-zA-Z\s]+$/;
        var numcheck=/^[0-9]+$/;
        var cpname = $('#hospital_cntPrsn').val(); 
        //var emails = $.trim($('#users_email').val());
        var status = 1;
       
         if($.trim($('#hospital_name').val()) === ''){
                $('#hospital_name').addClass('bdr-error');
                status=0;
            }
          
            if($.trim($('#geocomplete').val()) === ''){
               $("#geocomplete").addClass('bdr-error');
               status=0;
            }
             if(!check.test(cpname)){
                $('#hospital_cntPrsn').addClass('bdr-error');
                status=0;
            }
            
            /*if($.trim($('#pharmacy_phn1').val()) === ''){
                $('#pharmacy_phn1').addClass('bdr-error');
                status=0;
            }
          
*/
            if(status ==0)
            return false;
        else
            $("form[name='hospitalForm']").submit();
            
            
        }
        function checkNumber(id){
            var phone = $.trim($('#'+'hospital_phn'+id).val());
            if(!($.isNumeric(phone))){
             $('#'+'hospital_phn'+id).addClass('bdr-error');
         }
        }
     
       
        function updateAccount(){
          
            var pswd = $.trim($("#users_password").val());
            var cnfpswd = $.trim($("#cnfPassword").val());
            var mobile = $('#users_mobile').val();
            var emails = $('#users_email').val();
            var user_tables_id = $('#user_tables_id').val();
            var users_mobile = $('#users_mobile').val();
            var returnValue = 0;
           
            var status = 1;
            if(emails === ''){
                $('#error-users_emailBlank').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
            if(users_mobile === ''){
                $('#error-users_mobile').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
            if(pswd != ''){
                if(pswd.length < 6){
                    $('#users_password').addClass('bdr-error');
                    $('#error-users_password').fadeIn().delay(3000).fadeOut('slow');
                   // $('#users_password').focus();
                   status = 0;
                }

               if(pswd != cnfpswd){
                    $('#cnfPassword').addClass('bdr-error');
                    $('#error-cnfPassword').fadeIn().delay(3000).fadeOut('slow');

                   // $('#cnfpassword').focus();
                   status = 0;
                }
            }
            if(status == 0)
                return false;
            else{
                    var user_table_id = $('#user_tables_id').val();
                    $.ajax({
                        url : urls + 'index.php/hospital/check_email',
                        type: 'POST',
                       data: {'users_email' : emails,'user_table_id' : user_table_id },
                       success:function(datas){
                           //console.log(datas);
                           if(datas == 0){
                            
                             $.ajax({
                                    url : urls + 'index.php/hospital/updatePassword',
                                    type: 'POST',
                                   //data: {'currentPassword' : pswd,'existingPassword' : password,'user_tables_id' : user_tables_id}, password updated from another user except super admin
                                   data: $('#acccountForm').serialize(),
                                   success:function(insertData){
                                       
                                       console.log(insertData);

                                       if(insertData == 1){
                                     $('#users_password').val('');
                                      $('#cnfPassword').val('');
                                   
                                    setTimeout(function(){
                                      $('#error-password_email_check_success').fadeIn().delay(4000).fadeOut(function() {
                                      window.location.reload();
                                                               
                                        });
                                       }, 4000);
                                      
                                        return true;
                                      }
                                     
                                   } 
                                });
                       }
                       else {
                         $('#users_email').addClass('bdr-error');
                         $('#error-users_email_check').fadeIn().delay(3000).fadeOut('slow');;

                        return false;
                       }
                       } 
                    });
                
              
            }
        }
        
        
       function deleteGalleryImage(id){
	  if(confirm('Are you sure want to delete?')){	
    	  $.ajax({
              url : urls + 'index.php/hospital/deleteGalleryImage',
              type: 'POST',
             data: {'id' : id },
             success:function(datas){
                loadGallery();
             }
          });

     }
    }
    
     function loadGallery(){
    	$('#display_gallery').load(urls + 'index.php/hospital/getGalleryImage/'+hospitalId,function () {

         });
    }
        
        
   function ValidateSingleInput(oInput,id,option) {
       //alert(oInput);
    var _validFileExtensions;
    if(id == '1'){
        _validFileExtensions = [".pdf", ".doc", ".docx", ".rtf", ".text", ".html", ".ppt"];    
    }
    if(id == '2'){
        _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];    
    }
    if(id == '3'){
        _validFileExtensions = [".mp4", ".3gp", ".avi", ".wmi", ".mpeg", ".flv"];    
    }
    if(id == '4'){
        _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png",".pdf", ".doc", ".docx", ".rtf", ".text", ".html", ".ppt"];    
    }
    
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            var countFile = oInput.files.length;
            var fileName = oInput.files;
            var k;
            var fileSize;
            var size = 0;
            for (k = 0; k < countFile; k++) {
                size = size + fileName[k].size;
            }
            if(option == '5'){
                fileSize = 500000;
            }else{
                fileSize = 6291456;
            }
            if (size > fileSize) {
                if(option == '5'){
                    alert("Sorry, total allowed file size : -  500KB ");
                }else{
                    alert("Sorry, total allowed file size : -  6MB ");
                }
                oInput.value = "";
                return false;
            } else {
             if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }

                if (!blnValid) {
                    alert("Sorry,   '" + sFileName + "'   is invalid, allowed extensions are : -   " + _validFileExtensions.join(", "));
                    oInput.value = "";
                    return false;
                }
            }
        }
        }
        return true;
    }
    
     $(document).ready(function (){
         
         // morning
       $('#timepickerMorStart').timepicker({
        showMeridian: true,        
        minuteStep: 1,
        showInputs: true,        
        }).on('hide.timepicker', function(e) {   
             var h= e.time.hours;
            var m= e.time.minutes;
            var mer= e.time.meridian;
            
            if(h < 6 && mer == 'AM')
                $('#timepickerMorStart').timepicker('setTime', '6:00 AM');
            //convert hours into minutes
            m+=h*60;
            
            //10:15 = 10h*60m + 15m = 615 min
            if( m > 718 )
                $('#timepickerMorStart').timepicker('setTime', '6:00 AM');
          });
          
          $('#timepickerMorEnd').timepicker({
        showMeridian: true,        
        minuteStep: 1,
        showInputs: true,        
        }).on('hide.timepicker', function(e) {   
             var h= e.time.hours;
            var m= e.time.minutes;
            var mer= e.time.meridian;
           
            if(h < 6 && mer == 'AM')
                $('#timepickerMorEnd').timepicker('setTime', '11:59 AM');
            //convert hours into minutes
            m+=h*60;
            
            //10:15 = 10h*60m + 15m = 615 min
            if( m > 719 )
                $('#timepickerMorEnd').timepicker('setTime', '11:59 AM');
          });
          
          // morning end
          
          $('#timepickernoonStart').timepicker({
        showMeridian: true,        
        minuteStep: 1,
        showInputs: true,        
        }).on('hide.timepicker', function(e) {   
             var h= e.time.hours;
            var m= e.time.minutes;
            var mer= e.time.meridian;
            m+=h*60;
            
            if(m < 719 && mer == 'AM'){
                $('#timepickernoonStart').timepicker('setTime', '12:00 PM');
            }   
            //convert hours into minutes
            
          // console.log(m);
            //10:15 = 10h*60m + 15m = 615 min
            if( m > 358 )
                $('#timepickernoonStart').timepicker('setTime', '12:00 PM');
          });
          
            $('#timepickernoonEnd').timepicker({
            showMeridian: true,        
            minuteStep: 1,
            showInputs: true,        
            }).on('hide.timepicker', function(e) {   
                 var h= e.time.hours;
                var m= e.time.minutes;
                var mer= e.time.meridian;
                m+=h*60;
               
                if(m < 719 && mer == 'AM'){
                    $('#timepickernoonEnd').timepicker('setTime', '05:59 PM');
                }   
            //convert hours into minutes
         
                if( m > 359 )
                    $('#timepickernoonEnd').timepicker('setTime', '05:59 PM');
          });
          
          
      // Evening start
       $('#timepickerEveStart').timepicker({
        showMeridian: true,        
        minuteStep: 1,
        showInputs: true,        
        }).on('hide.timepicker', function(e) {   
             var h= e.time.hours;
            var m= e.time.minutes;
            var mer= e.time.meridian;
            
            if(h < 6 && mer == 'PM')
                $('#timepickerEveStart').timepicker('setTime', '6:00 PM');
            //convert hours into minutes
            m+=h*60;
            
            //10:15 = 10h*60m + 15m = 615 min
            if( m > 659 )
                $('#timepickerEveStart').timepicker('setTime', '6:00 PM');
          });
          
          $('#timepickerEveEnd').timepicker({
        showMeridian: true,        
        minuteStep: 1,
        showInputs: true,        
        }).on('hide.timepicker', function(e) {   
             var h= e.time.hours;
            var m= e.time.minutes;
            var mer= e.time.meridian;
           
            if(h < 6 && mer == 'PM')
                $('#timepickerEveEnd').timepicker('setTime', '10:59 PM');
            //convert hours into minutes
            m+=h*60;
            
            //10:15 = 10h*60m + 15m = 615 min
            if( m > 659 )
                $('#timepickerEveEnd').timepicker('setTime', '10:59 PM');
          });
          
          // Evening end
          
          
           // Night start
       $('#timepickerNgtStart').timepicker({
        showMeridian: true,        
        minuteStep: 1,
        showInputs: true,        
        }).on('hide.timepicker', function(e) {   
             var h= e.time.hours;
            var m= e.time.minutes;
            var mer= e.time.meridian;
            
            if(h < 11 && mer == 'PM')
                $('#timepickerNgtStart').timepicker('setTime', '11:00 PM');
            //convert hours into minutes
            m+=h*60;
         
            if(m > 299 && mer == 'AM')
                $('#timepickerNgtStart').timepicker('setTime', '11:00 PM');
            //10:15 = 10h*60m + 15m = 615 min
           // alert(m);
            
          });
          
          
       $('#timepickerNgtEnd').timepicker({
        showMeridian: true,        
        minuteStep: 1,
        showInputs: true,        
        }).on('hide.timepicker', function(e) {   
             var h= e.time.hours;
            var m= e.time.minutes;
            var mer= e.time.meridian;
            
           //convert hours into minutes
           
            if((h > 5 && mer == 'AM') )
                $('#timepickerNgtEnd').timepicker('setTime', '05:00 AM');
            
             m+=h*60;
            //10:15 = 10h*60m + 15m = 615 min
            if( (m < 661 && mer == 'PM') )
                $('#timepickerNgtEnd').timepicker('setTime', '05:00 AM');
          });
          
        
          
          // Night end
          
        })
        
        
    function showDetail(id){
       $('#preName_'+id).hide();
       $('#actulName_'+id).show();
       $('#prePrice_'+id).hide();
       $('#actulPrice_'+id).show();
       $('#editdata').hide();
       $('#updateData').show();
       
    }
    function sendDetail(id,hospitalId,categoryId){
        var diagnosticName = $.trim($('#Names_'+id).val());
        var diagnosticPrice = $.trim($('#price_'+id).val());
        if(diagnosticName == '' || diagnosticPrice == '' )
            console.log("Please fill field");
        else
        {
            $.ajax({
              url : urls + 'index.php/hospital/updateDiagonasticTest',
              type: 'POST',
             data: {'quotationDetailTests_testName' : diagnosticName ,'quotationDetailTests_price': diagnosticPrice,'quotationDetailTests_id': id },
             success:function(datas){
                showDiagonasticDetail(hospitalId,categoryId);
             }
          });
        }
    }
    function changeInstruction(){
        $('#detailInstruction').hide();
        $('#detailsAll').show();
        $('#instructionEdit').hide();
        $('#instructionUpdate').show();
    }
    
    function updateInstruction(){
        var detailsAll = $.trim($('#detailsAll').val());
        
        var quotationDetailTests_id = $.trim($('#instructionId').val());
        if(detailsAll == '' )
            console.log("Please fill field");
        else
        {
            $.ajax({
              url : urls + 'index.php/hospital/updateDiagonasticInstruction',
              type: 'POST',
             data: {'quotationDetailTests_id' : quotationDetailTests_id ,'detailsAll': detailsAll },
             success:function(datas){
                $('#detailInstruction').show();
                    $('#detailsAll').hide();
                    $('#instructionEdit').show();
                    $('#instructionUpdate').hide();
                fetchInstruction(quotationDetailTests_id);
             }
          });
        }
    }
        
    </script>
</body>
</html>