<style type="text/css">
    #diagnostic_datatable_filter
    {
        display:none;
    }
</style>
<?php $check= 0; 
if(isset($diagnosticId) && !empty($diagnosticId)){
    $check = $diagnosticId; 
}?>
<link href="<?php echo base_url();?>assets/cropper/cropper.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/cropper/main.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/vendor/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/cropper/cropper.js"></script>

<?php $current = $this->router->fetch_method();
if($current != 'detailDiagnostic'):?>
<script src="<?php echo base_url(); ?>assets/cropper/main.js"></script>
<?php else:?>

<script src="<?php echo base_url(); ?>assets/cropper/common_cropper.js"></script>
<script src="<?php echo base_url(); ?>assets/cropper/gallery_cropper.js"></script>

<?php endif;?>

<script src="<?php echo base_url();?>assets/vendor/timepicker/bootstrap-timepicker.min.js"></script>
<!--<script src="<?php echo base_url();?>assets/js/angular.min.js"></script>-->
<script src="<?php echo base_url();?>assets/js/pages/diagdetail.js"></script>
<!--<script type= 'text/javascript' src="<?php echo base_url(); ?>assets/js/jquery.cookie.js"></script>-->
<script src="<?php echo base_url();?>assets/js/pages/blood-detail.js"></script>

   <script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/x-editable/jquery.xeditable.js"> </script>
    <!--<script src="<?php echo base_url(); ?>assets/js/angular.min.js"> </script>-->
    


<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>

    <script src="<?php echo base_url();?>assets/vendor/select2/select2.min.js" type="text/javascript"></script> 
<!--     <script src="<?php echo base_url();?>assets/js/fileUpload/fileinput.js" type="text/javascript"></script> -->
    <script src="<?php echo base_url(); ?>assets/js/common_js.js"></script>
 <?php if(isset($mapData) && !empty($mapData)){
        $lat = $mapData[0]->diagnostic_lat;
        $lang = $mapData[0]->diagnostic_long;
        $imgUrl = (!empty($mapData[0]->diagnostic_img)) ? base_url().'/assets/diagnosticsImage/thumb/thumb_50/'.$mapData[0]->diagnostic_img : base_url().'/assets/images/pins/Contact.png';
           
        $templates = '<img src="'.$imgUrl.'" /><h2 class="text-success">'.ucwords($mapData[0]->diagnostic_name).'</h2><b>'.$mapData[0]->diagnostic_address.'</b>';
    ?>
    
  <script>

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 18,
      center: new google.maps.LatLng(<?php echo $lat;?>, <?php echo $lang;?>),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var infowindow = new google.maps.InfoWindow();
    var marker, i;
    marker = new google.maps.Marker({
        position: new google.maps.LatLng(<?php echo $lat;?>, <?php echo $lang;?>),
        map: map,
        icon: '<?php echo base_url();?>/assets/images/pins/qyura.png'
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent('<?php echo $templates;?>');
          infowindow.open(map, marker);
        }
      })(marker, i));
  
 </script>
<?php } ?>   
    
<script> 
     var urls = "<?php echo base_url()?>";
     var diagnosticId = "<?php echo $check?>";
     var checkEvent = 0;
</script>
<script>
    
    
   function IsAdrManual(val){
        if(val == 1){
            $("#lat,#lng").removeAttr('readonly')
        }else if(val == 0){
            $("#lat,#lng").attr('readonly', 'readonly');
        }

    }
    
     /**
     * @project Qyura
     * @description  geo location address
     * @access public
     */
      $(function(){
        $("#geocomplete").geocomplete({
          map: ".map_canvas",
          details: "form",
          types: ["geocode", "establishment"],
        });

        $("#find").click(function(){
          $("#geocomplete").trigger("geocode");
        });
      });
      
    /**
     * @project Qyura
     * @description  city, state records
     * @access public
     */
    
      $(document).ready(function(){
          
 
          fetchStates();
          loadAwards();
          loadServices();
          loadSpeciality();
          loadDiagnostic();
          
        function fetchStates(){
            
            var countryId = $('#countryId').val();
            var stateId = $('#StateId').val();
           // alert(countryId);
            //alert(stateId);
            $.ajax({
               url : urls + 'index.php/diagnostic/fetchStates',
               type: 'POST',
              data: {'stateId' : stateId , 'countryId' : countryId},
              success:function(datas){
                //console.log(datas);
                  $('#diagnostic_stateId').html(datas);
                  $('#diagnostic_stateId').selectpicker('refresh');
                  fetchCityOnload(stateId);
                  //$('#StateId').val(stateId);
              }
           });
        }

        function fetchCityOnload(stateId) {    
           var cityId = $('#cityId').val();
           //alert(cityId);
           $.ajax({
               url : urls + 'index.php/diagnostic/fetchCityOnload',
               type: 'POST',
              data: {'stateId' : stateId , 'cityId' : cityId},
              success:function(datas){
                //console.log(datas);
                  $('#diagnostic_cityId').html(datas);
                  $('#diagnostic_cityId').selectpicker('refresh');
                  $('#StateId').val(stateId);
              }
           });
           
        }
      });
    </script>
<script>

    /**
     * @project Qyura
     * @description  datepicker
     * @access public
     */
    $('.selectpicker').selectpicker({
        style: 'btn-default',
        size: "auto",
        width: "100%"
    });

     
//   $(".selectpicker").select2();
    
    function fetchCity(stateId) {
        $.ajax({
            url: urls + 'index.php/diagnostic/fetchCity',
            type: 'POST',
            data: {'stateId': stateId},
            success: function (datas) {
                $('#diagnostic_cityId').html(datas);
                $('#diagnostic_cityId').selectpicker('refresh');
            }
        });

    }

    /**
     * @project Qyura
     * @description  datatable listing
     * @access public
     */
    $(document).ready(function () {
        var oTable = $('#diagnostic_datatable').DataTable({
             "processing": true,
            "bServerSide": true,
             //"searching": true,
            "bLengthChange": false,
            "bProcessing": true,
            "iDisplayLength": 10,
            "bPaginate": true,
            "sPaginationType": "full_numbers",
            "columns": [
                {"data": "diagnostic_img"},
                {"data": "diagnostic_name"},
                {"data": "city_name"},
                {"data": "diagnostic_phn"},
                {"data": "diagnostic_address"},
                {"data": "view"},
            ],
            "ajax": {
                "url": "<?php echo site_url('diagnostic/getDiagnosticDl'); ?>",
                "type": "POST",
                "data": function (d) {
                    d.cityId = $("#diagnostic_cityId").val();
                    d.bloodBank_name = $("#search").val();
                    if ($("#diagnostic_stateId").val() != ' ') {
                        d.hosStateId = $("#diagnostic_stateId").val();
                    }
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                }
            }
        });
        $('#diagnostic_cityId,#diagnostic_stateId').change(function () {
            oTable.draw();
        });
        $('#search').on('keyup', function () {
            oTable.columns( 5 ).search($(this).val()).draw();
            //oTable.search($(this).val()).draw();
             //oTable.draw();
            
        });
        
          /**
            * @project Qyura
            * @description  datatable listing
            * @access public
            */
        var oTableDr = $('#diagnostic_doctors').DataTable({
             "processing": true,
            "bServerSide": false,
            "bLengthChange": false,
            "bProcessing": true,
            "iDisplayLength": 10,
            "sPaginationType": "full_numbers",
            "columns": [
                {"data": "doctors_img"},
                {"data": "name"},
                {"data": "specialityName"},
                {"data": "consFee"},
                {"data": "exp"},
                {"data": "doctors_phn"},
                {"data": "view"},
            ],
            "ajax": {
                "url": urls + 'index.php/diagnostic/getDiagnosticDoctorsDl/'+diagnosticId,
                "type": "POST",
                "data": function (d) {
                   
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                }
            }
        });
        
    });
    
    /**
     * @project Qyura
     * @description  form validation
     * @access public
     */  
     
    var urls = "<?php echo base_url()?>";
    var j = 1;
    var k = 1;
    var l =1;
    var n= 1;
    var m =1;
    function fetchCityDetails(stateId) {           
      $.ajax({
          url : urls + 'index.php/diagnostic/fetchCity',
          type: 'POST',
         data: {'stateId' : stateId},
         success:function(datas){
             $('#diagnostic_cityId').html(datas);
             $('#diagnostic_cityId').selectpicker('refresh');
             $('#StateId').val(stateId);
         }
      });

   }
    function countPhoneNumber(){
        if(j==10)
            return false;
      j = parseInt(j)+parseInt(1); 
      $('#countPnone').val(j);
      
      $("#multuple_phone_load").append('<aside class=row id=phone_list'+j + '><div class=col-lg-3 col-md-4 col-sm-3 col-sm-4 col-xs-12 m-t-xs-10 id=multiPreNumber'+j + '><select class="selectpicker" data-width=100% name=pre_number[] id=multiPreNumber'+j + '><option value ="91">+91</option></select></div><div class=col-lg-7 col-md-6 col-sm-7 col-xs-10 m-t-xs-10 id=multiPhoneNumber><input type=text class=form-control name=diagnostic_phn[] id=diagnostic_phn'+j + ' placeholder=9837000123 maxlength=10 onkeypress= "return isNumberKey(event)" /><label class=error style=display:none; id=error-diagnostic_phn'+j + '> please enter a valid phone number</label><label class=error ><?php echo form_error('diagnostic_phn1'); ?></label></div><div class=col-md-2 col-sm-2 col-xs-2 m-t-xs-10><a href=javascript:void(0) onclick="removePhoneNumber('+j + ')"><i class="fa fa-minus-circle fa-2x m-t-5 label-plus"></i></a></div></aside>');
      
      
   $('.selectpicker').selectpicker('refresh');   
      
/*     $('#multiPhoneNumber').append('<input type=text class=form-control name=diagnostic_phn[] placeholder=9837000123 maxlength="10" id=diagnostic_phn'+j + ' onkeypress="return isNumberKey(event)" />');
      
     $('#multiPreNumber').append('<select class=selectpicker data-width=100% name=pre_number[] id=multiPreNumber'+j+'><option value=91>+91</option><option value=1>+1</option></select>');
      $('#multiPreNumber'+j).selectpicker('refresh');*/
      
   }

    function removePhoneNumber(i){
        $("#phone_list"+i).remove();
    }
   
    function checkEmailFormat(){
       
                var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                var email = $('#users_email').val();
                if(email!==''){
                    if (!filter.test(email)){
                        
                       $('#users_email').addClass('bdr-error');
                         $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');;
                        return false;

                    }else{
                        return true;
                    }
            }
        }   
           
 
        
    /**
     * @project Qyura
     * @description award crud operation
     * @access public
     */   
    
    function addAwards(){
        var dialAwards_awardsName = $.trim($('#diagnostic_awardsName').val());
        var dialAwards_awardsYear = $.trim($('#diagnostic_awardsyear').val());
        if(dialAwards_awardsName != ''){
            $.ajax({
               url : urls + 'index.php/diagnostic/addDiagnosticAwards',
               type: 'POST',
              data: {'diagnosticId' : diagnosticId , 'diaAwards_awardsName' : dialAwards_awardsName, 'dialAwards_awardsYear' : dialAwards_awardsYear },
              success:function(datas){
               // console.log(datas);
                  loadAwards();
                  $('#diagnostic_awardsName').val('');
              }
           });
        }    
    }
    function editAwards(awardsId){
         var edit_awardsName = $.trim($('#'+awardsId).val());
         var edit_awardsYear = $.trim($('#year'+awardsId).val());
        
        if(edit_awardsName != ''){
            
            $.ajax({
               url : urls + 'index.php/diagnostic/editDiagnosticAwards',
               type: 'POST',
              data: {'awardsId' : awardsId , 'diaAwards_awardsName' : edit_awardsName ,'edit_awardsYear' : edit_awardsYear },
              success:function(datas){
              console.log(datas);
                  loadAwards();
              }
           });
        }  
    }
    function deleteAwards(awardsId){
        
         $.ajax({
               url : urls + 'index.php/diagnostic/deleteDiagnosticAwards',
               type: 'POST',
              data: {'awardsId' : awardsId },
              success:function(datas){
              console.log(datas);
                  loadAwards();
              }
           });
        
    }
    function loadAwards(){
       
        $('#loadAwards').load(urls + 'index.php/diagnostic/diagnosticAwards/'+diagnosticId,function () {
           // alert('callback function ');
        });
        $('#totalAwards').load(urls + 'index.php/diagnostic/detailAwards/'+diagnosticId,function () {
           // alert('callback function implementation');
        });
    }
    
    
    /**
     * @project Qyura
     * @description service crud operation
     * @access public
     */
    function addServices(){
        var diagnostic_serviceName = $.trim($('#diagnostic_serviceName').val());
        if(diagnostic_serviceName != ''){
            $.ajax({
               url : urls + 'index.php/diagnostic/addDiagnosticServices',
               type: 'POST',
              data: {'diagnosticId' : diagnosticId , 'service_name' : diagnostic_serviceName },
              success:function(datas){
               // console.log(datas);
                  loadServices();
                  $('#diagnostic_serviceName').val('');
              }
           });
        }    
    }
    function editServices(awardsId){
         var edit_awardsName = $.trim($('#'+awardsId).val());
        
        if(edit_awardsName != ''){
            
            $.ajax({
               url : urls + 'index.php/diagnostic/editDiagnosticServices',
               type: 'POST',
              data: {'awardsId' : awardsId , 'service_name' : edit_awardsName },
              success:function(datas){
              console.log(datas);
                  loadServices();
              }
           });
        }  
    }
    function deleteServices(awardsId){
        
         $.ajax({
               url : urls + 'index.php/diagnostic/deleteDiagnosticServices',
               type: 'POST',
              data: {'awardsId' : awardsId },
              success:function(datas){
              console.log(datas);
                  loadServices();
              }
           });
        
    }
    function loadServices(){
       
        $('#loadServices').load(urls + 'index.php/diagnostic/diagnosticServices/'+diagnosticId,function () {
           // alert('callback function ');
        });
        $('#totalServices').load(urls + 'index.php/diagnostic/detailServices/'+diagnosticId,function () {
           // alert('callback function implementation');
        });
    }
    function deleteGalleryImage(id){
	  if(confirm('Are you sure want to delete?')){	
    	  $.ajax({
              url : urls + 'index.php/diagnostic/deleteGalleryImage',
              type: 'POST',
             data: {'id' : id },
             success:function(datas){
                loadGallery();
             }
          });

     }
    }
    function loadGallery(){
    	$('#display_gallery').load(urls + 'index.php/diagnostic/getGalleryImage/'+diagnosticId,function () {

         });
    }
    
    
   /**
     * @project Qyura
     * @description load diagnostic
     * @access public
     */
    
    function loadDiagnostic(){
        checkEvent = 1;
        $('#list2').load(urls + 'index.php/diagnostic/diagnosticCategorys/'+diagnosticId,function () {
            checkEvent = 0;
           // alert('callback function implementation');
        });
        checkEvent = 1;
        $('#list3').load(urls + 'index.php/diagnostic/diagnosticAllocatedCategorys/'+diagnosticId,function () {
           // alert('callback function implementation');
           checkEvent = 0;
        });
    
    } 
    
    
    
     function addDiagnostic(){
         //$("#addDiagnosticeArrow").attr('onclick',);
        // console.log(checkEvent,'befor');
         if(checkEvent)
            return false;
         else
             checkEvent = 1;
         
        // console.log(checkEvent,'after');
     
         $('.diagonasticCheck').each(function() {
            if($(this).is(':checked')){
                $(this).removeClass( "diagonasticCheck diagonasticCheck1" );
                $.ajax({
                    url : urls + 'index.php/diagnostic/addDiagnosticHasCategory',
                    type: 'POST',
                   data: {'diagnosticId' : diagnosticId , 'diagnosticsHasCat_diagnosticsCatId' : $(this).val() },
                   async: false,
                   success:function(datas){
                       
                       loadDiagnostic();
                       checkEvent = 1;
                       console.log(checkEvent,'iner');
                   }
                });
            }else{
                $("#addDiagnosticeArrow").removeClass('disabled');
                checkEvent = 0;
                console.log(checkEvent,'outer');
            }
            
        });
    }
    
      function revertDiagnostic(){
         $('.diagonasticAllocCheck').each(function() {
            if($(this).is(':checked')){
                $.ajax({
                    url : urls + 'index.php/diagnostic/revertDiagnosticHasCategory',
                    type: 'POST',
                   data: {'diagnosticId' : diagnosticId , 'diagnosticsHasCat_id' : $(this).val() },
                   async: false,
                   success:function(datas){
                    
                       loadDiagnostic();
                   }
                });
            }
            
        });
    }
    
    /**
     * @project Qyura
     * @description load speciality
     * @access public
     */
    
     function loadSpeciality(){
        $('#list4').load(urls + 'index.php/diagnostic/diagnosticSpecialities/'+diagnosticId,function () {
           // alert('callback function implementation');
        });
        $('#list5').load(urls + 'index.php/diagnostic/diagnosticAllocatedSpecialities/'+diagnosticId,function () {
           // alert('callback function implementation');
        });
    
    } 
    
     function addSpeciality(){
         $('.diagonasticSpecialCheck').each(function() {
            if($(this).is(':checked')){
                $(this).removeClass( "diagonasticSpecialCheck diagonasticSpecialCheck1" );
                $.ajax({
                    url : urls + 'index.php/diagnostic/addSpeciality',
                    type: 'POST',
                   data: {'diagnosticId' : diagnosticId , 'diagnosticSpecialities_specialitiesId' : $(this).val() },
                   async: false,
                   success:function(datas){
                    
                       loadSpeciality();
                   }
                });
            }
            
        });
    }
    
     function revertSpeciality(){
         $('.diagonasticAllocSpecialCheck').each(function() {
            if($(this).is(':checked')){
                $.ajax({
                    url : urls + 'index.php/diagnostic/revertSpeciality',
                    type: 'POST',
                    
                   data: {'diagnosticId' : diagnosticId , 'diagnosticSpecialities_id' : $(this).val() },
                   async: false,
                   success:function(datas){
                    
                       loadSpeciality();
                   }
                });
            }
            
        });
    }
    
    
     function getDignosticPrize(diagnosticId,categoryId){
       
        $.ajax({
                    url : urls + 'index.php/diagnostic/getDiagnosticPrizeList',
                    type: 'POST',
                   data: {'diagnosticId' : diagnosticId , 'categoryId' : categoryId },
                   success:function(datas){
                    
                       $('#loadTestDetail').html(datas);
                   }
                });
    }
     function fetchInstruction(digTestId){
         $.ajax({
                    url : urls + 'index.php/diagnostic/detailDiagnosticInstruction',
                    type: 'POST',
                   data: {'quotationDetailTests_id' : digTestId},
                   success:function(datas){
                    
                       $('#detailInstruction').html(datas);
                       $("#quotationDetailTestsIns_id").val(digTestId);
                       $("#quotationDetailTests_instruction_name").val(datas);
                   }
                });
    }
    
    function timeSplit(time) {
        var splitTime = time.split(":");
        var hour = parseInt(splitTime[0]);
        var min = parseInt(splitTime[1]);
        hour = hour * 60;
        var totalTime = hour + min;
        return totalTime;

    }

    function editFormTestPrize(id){
     
       $("#testName_"+id).hide();
       $("#testPrize_"+id).hide();
       $("#testEdit_"+id).hide();
       
       $("#quotationDetailTests_testName_"+id).show();
       $("#quotationDetailTests_price_"+id).show();
       $("#testUpdate_"+id).show();
       
    }
    
    function FormTestPrizeSubmit(id){
         var name = $("#quotationDetailTests_testName_"+id).val();
         var prize =$("#quotationDetailTests_price_"+id).val();
         var flag = 0;
         var message ='';
         if(name =="" || prize == ""){
             flag = 1;
             message = "Field can not be blank"; 
         }
         if(!$.isNumeric(prize)){
             flag = 1;
             message = "Prize should be number formate";
         }
         if(flag){
             $(".errorMessage").html(message);
             return false;
         }else{
             $(".errorMessage").html("");
             $.ajax({
                    url : urls + 'index.php/diagnostic/editDiagnosticQuotationDetailTests',
                    type: 'POST',
                   data: {'quotationDetailTests_id' : id,'quotationDetailTests_testName':name,'quotationDetailTests_price':prize,'diagnosticId' : diagnosticId},
                   success:function(response){
                       trPrizeListReload(id);
                   }
            });
             
         }
    }
    
    function trPrizeListReload(id){
          $('#trload_'+id).load(urls + 'index.php/diagnostic/getTestPrizeReload/'+id,function () {
        });
    }
    
    function checkTImeSlotValid(name){ 

    }
    
    function updateDiagnosticTest(){

      var quotationIns_id = $("#quotationDetailTestsIns_id").val();
      var quotationDetail_Instruction = $("#quotationDetailTests_instruction_name").val();
      $.ajax({
                    url : urls + 'index.php/diagnostic/editDiagnosticQuatitationInstruction',
                    type: 'POST',
                   data: {'quotationDetailTests_id' : quotationIns_id,'quotationDetailTests_Ins':quotationDetail_Instruction},
                   success:function(response){
                          // $(".messageUpdateIns").html("<div class='alert alert-success'>"+response+"</div>");
                           trPrizeInstructionReload(quotationIns_id);
                           $("#myModal").modal('hide');
                   }
      });
       
    }
    function trPrizeInstructionReload(id){
          $('#detailInstruction').load(urls + 'index.php/diagnostic/getTestInstructionReload/'+id,function () {  
              
          });
    }
    
    $(document).ready(function (){
 
       $('#morningStartTime').timepicker({
        showMeridian: true,        
        minuteStep: 1,
        showInputs: true,        
        }).on('hide.timepicker', function(e) {   
             var h= e.time.hours;
            var m= e.time.minutes;
            var mer= e.time.meridian;
            
            if(h < 6 && mer == 'AM'){
                $('#morningStartTime').timepicker('setTime', '6:00 AM');
            }
             var morningTime =  $('#morningEndTime').val();
            //console.log(morningTime);
            morningTime = morningTime.split(":");
            //console.log(morningTime);
            var morningTimeMin =morningTime[1].split(" ");
            //console.log(morningTime[0] > h);
            //console.log(morningTime[0] == h && morningTimeMin[0] > m);
            
            if((morningTime[0] < h) || (morningTime[0] == h && morningTimeMin[0] < m))
            {
               // console.log(morningTime);
                $('#morningStartTime').timepicker('setTime', '6:00 AM');
            }
            //convert hours into minutes
            m+=h*60;
            
          });
          
          
      $('#morningEndTime').timepicker({
        showMeridian: true,        
        minuteStep: 1,
        showInputs: true,        
        }).on('hide.timepicker', function(e) {   
            var h= e.time.hours;
            var m= e.time.minutes;
            var mer= e.time.meridian;
          // console.log(h);
          // console.log(m);
           //console.log(mer);
            if(h > 11 && mer == 'PM'){
                $('#morningEndTime').timepicker('setTime', '11:59 AM');
            }
            
            var morningTime =  $('#morningStartTime').val();
            //console.log(morningTime);
            morningTime = morningTime.split(":");
            //console.log(morningTime);
            var morningTimeMin =morningTime[1].split(" ");
            //console.log(morningTime[0] > h);
            //console.log(morningTime[0] == h && morningTimeMin[0] > m);
            
            if((morningTime[0] > h) || (morningTime[0] == h && morningTimeMin[0] > m))
            {
               // console.log(morningTime);
                $('#morningEndTime').timepicker('setTime', '11:59 AM');
            }
            
            //convert hours into minutes
            m+=h*60;
            
            //10:15 = 10h*60m + 15m = 615 min
//            if( m > 719 )
//                $('#morningEndTime').timepicker('setTime', '11:59 AM');
          });
          
       $('#afternoonStartTime').timepicker({
        showMeridian: true,        
        minuteStep: 1,
        showInputs: true,        
        }).on('hide.timepicker', function(e) {   
             var h= e.time.hours;
            var m= e.time.minutes;
            var mer= e.time.meridian;
            
            if(h > 12 && mer == 'PM'){
                $('#afternoonStartTime').timepicker('setTime', '12:00 PM');
            }
             var morningTime =  $('#afternoonEndTime').val();
            //console.log(morningTime);
            morningTime = morningTime.split(":");
            //console.log(morningTime);
            var morningTimeMin =morningTime[1].split(" ");
            //console.log(morningTime[0] > h);
            //console.log(morningTime[0] == h && morningTimeMin[0] > m);
            
            if((morningTime[0] < h) || (morningTime[0] == h && morningTimeMin[0] < m))
            {
               // console.log(morningTime);
                $('#afternoonStartTime').timepicker('setTime', '12:00 PM');
            }
            //convert hours into minutes
            m+=h*60;
            
          });
          
       $('#afternoonEndTime').timepicker({
        showMeridian: true,        
        minuteStep: 1,
        showInputs: true,        
        }).on('hide.timepicker', function(e) {   
            var h= e.time.hours;
            var m= e.time.minutes;
            var mer= e.time.meridian;
          // console.log(h);
          // console.log(m);
           //console.log(mer);
            if(h > 6 && mer == 'PM'){
                $('#afternoonEndTime').timepicker('setTime', '05:59 PM');
            }
            
            var morningTime =  $('#afternoonStartTime').val();
            //console.log(morningTime);
            morningTime = morningTime.split(":");
            //console.log(morningTime);
            var morningTimeMin =morningTime[1].split(" ");
            //console.log(morningTime[0] > h);
            //console.log(morningTime[0] == h && morningTimeMin[0] > m);
            
            if((morningTime[0] > h) || (morningTime[0] == h && morningTimeMin[0] > m))
            {
               // console.log(morningTime);
                $('#afternoonEndTime').timepicker('setTime', '05:59 PM');
            }
            
            //convert hours into minutes
            m+=h*60;
            
          });
          
        $('#eveningStartTime').timepicker({
        showMeridian: true,        
        minuteStep: 1,
        showInputs: true,        
        }).on('hide.timepicker', function(e) {   
             var h= e.time.hours;
            var m= e.time.minutes;
            var mer= e.time.meridian;
            
            if(h < 6 && mer == 'PM'){
                $('#eveningStartTime').timepicker('setTime', '06:00 PM');
            }
             var morningTime =  $('#eveningEndTime').val();
            //console.log(morningTime);
            morningTime = morningTime.split(":");
            //console.log(morningTime);
            var morningTimeMin =morningTime[1].split(" ");
            //console.log(morningTime[0] > h);
            //console.log(morningTime[0] == h && morningTimeMin[0] > m);
            
            if((morningTime[0] < h) || (morningTime[0] == h && morningTimeMin[0] < m))
            {
               // console.log(morningTime);
                $('#eveningStartTime').timepicker('setTime', '06:00 PM');
            }
            //convert hours into minutes
            m+=h*60;
            
          });
          
        $('#eveningEndTime').timepicker({
        showMeridian: true,        
        minuteStep: 1,
        showInputs: true,        
        }).on('hide.timepicker', function(e) {   
            var h= e.time.hours;
            var m= e.time.minutes;
            var mer= e.time.meridian;
          // console.log(h);
          // console.log(m);
           //console.log(mer);
            if(h > 10 && mer == 'PM'){
                $('#eveningEndTime').timepicker('setTime', '10:59 PM');
            }
            
            var morningTime =  $('#eveningStartTime').val();
            //console.log(morningTime);
            morningTime = morningTime.split(":");
            //console.log(morningTime);
            var morningTimeMin =morningTime[1].split(" ");
            //console.log(morningTime[0] > h);
            //console.log(morningTime[0] == h && morningTimeMin[0] > m);
            
            if((morningTime[0] > h) || (morningTime[0] == h && morningTimeMin[0] > m))
            {
               // console.log(morningTime);
                $('#eveningEndTime').timepicker('setTime', '10:59 PM');
            }
            
            //convert hours into minutes
            m+=h*60;
            
          });
          
       $('#nightStartTime').timepicker({
        showMeridian: true,        
        minuteStep: 1,
        showInputs: true,        
        }).on('hide.timepicker', function(e) {   
             var h= e.time.hours;
            var m= e.time.minutes;
            var mer= e.time.meridian;
            
            if(h < 11 && mer == 'PM'){
                $('#nightStartTime').timepicker('setTime', '11:00 PM');
            }
             var morningTime =  $('#nightEndTime').val();
            //console.log(morningTime);
            morningTime = morningTime.split(":");
            //console.log(morningTime);
            var morningTimeMin =morningTime[1].split(" ");
            //console.log(morningTime[0] > h);
            //console.log(morningTime[0] == h && morningTimeMin[0] > m);
            
            if((morningTime[0] < h) || (morningTime[0] == h && morningTimeMin[0] < m))
            {
               // console.log(morningTime);
                $('#nightStartTime').timepicker('setTime', '11:00 PM');
            }
            //convert hours into minutes
            m+=h*60;
            
          });
          
        $('#nightEndTime').timepicker({
        showMeridian: true,        
        minuteStep: 1,
        showInputs: true,        
        }).on('hide.timepicker', function(e) {   
            var h= e.time.hours;
            var m= e.time.minutes;
            var mer= e.time.meridian;
          // console.log(h);
          // console.log(m);
           //console.log(mer);
            if(h > 5 && mer == 'AM' && h > 12 && mer == 'PM'){
                $('#nightEndTime').timepicker('setTime', '04:59 AM');
            }
            
            var morningTime =  $('#nightStartTime').val();
            //console.log(morningTime);
            morningTime = morningTime.split(":");
            //console.log(morningTime);
            var morningTimeMin =morningTime[1].split(" ");
            //console.log(morningTime[0] > h);
            //console.log(morningTime[0] == h && morningTimeMin[0] > m);
            
            if((morningTime[0] > h) || (morningTime[0] == h && morningTimeMin[0] > m))
            {
               // console.log(morningTime);
                $('#nightEndTime').timepicker('setTime', '04:59 AM');
            }
            
            //convert hours into minutes
            m+=h*60;
            
          });
      
    });
    
      function isAlphabets(letters){
        var pattern = /^[a-zA-Z ]*$/;
        if(letters.match(pattern)) {
            return 0;
        }
        else{
            return 1;
        }
     }
    
   
      function check_email(myEmail){
           $.ajax({
               url : urls + 'index.php/diagnostic/check_email',
               type: 'POST',
              data: {'users_email' : myEmail},
              success:function(datas){
                  if(datas == 0){
                   $("form[name='diagnosticForm']").submit();
                   $('#error-users_email_check').delay(1000).hide('fast');;
                   return true;
              }
              else if(datas == 1) {
                    $('#users_email').addClass('bdr-error');
                    $('#error-users_email_check').delay(1000).fadeIn('fast');
               // $('#users_email').focus();
                   return false;
              }
              else{
                    $('#users_email_status').val(datas);
                    $('#error-users_email_check').delay(1000).hide('fast');;
                    $("form[name='diagnosticForm']").submit();
                     return true;
              }
              } 
           });
        }
   
   
   function validationDiagnostic(){
       // $("form[name='diagnosticForm']").submit();
        var check= /^[a-zA-Z\s]+$/;
        var numcheck=/^[0-9]+$/;
        var RegExpression = /^[a-zA-Z\s]+$/;
        var emails = $.trim($('#users_email').val());
        var cpname = $.trim($('#diagnostic_cntPrsn').val());
        
        var pswd = $.trim($("#users_password").val());
        var cnfpswd = $.trim($("#cnfPassword").val());
        var mbl= $.trim($('#diagnostic_mblNo').val());
        var phn= $.trim($('#diagnostic_phn1').val());
        var myzip = $.trim($('#diagnostic_zip').val());
        var cityId =$.trim($('#diagnostic_cityId').val());
        var stateIds = $.trim($('#diagnostic_stateId').val());
        var diagnostic_mblNo = $.trim($('#diagnostic_mblNo').val());
        var diagName = $.trim($('#diagnostic_name').val());
        var designations = $.trim($('#diagnostic_dsgn').val());
        var status = 1;
    //debugger;
        var emailCheck =  checkEmailFormatValidation(emails);
        
            if($('#diagnostic_name').val()==''){
                $('#diagnostic_name').addClass('bdr-error');
                $('#error-diagnostic_name').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_name').focus();
              // return false;
              status = 0;
            }
            
          if($('#diagnostic_dsgn').val()==''){
                $('#diagnostic_dsgn').addClass('bdr-error');
                $('#error-diagnostic_dsgn').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_type').focus();
               status = 0;
            }
            
            if($('textarea#aboutUs').val()==''){
                //$('#aboutUs').addClass('bdr-error');
                $('#error-aboutUs').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_type').focus();
               status = 0;
            }
            
            
            if($('#diagnostic_type').val()==''){
                $('#diagnostic_type').addClass('bdr-error');
                $('#error-diagnostic_type').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_type').focus();
               status = 0;
            }
             if($.trim($('#diagnostic_countryId').val()) == ''){
                $('#diagnostic_countryId').addClass('bdr-error');
                $('#error-diagnostic_countryId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_countryId').focus();
               status = 0;
            }
           if(stateIds === ''){
               $('#diagnostic_stateId').addClass('bdr-error');
                $('#error-diagnostic_stateId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_stateId').focus();
               status = 0;
            }
            if(!$.isNumeric(cityId)){
                $('#diagnostic_cityId').addClass('bdr-error');
                $('#error-diagnostic_cityId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_cityId').focus();
               status = 0;
            }
           
            /*if(!$.isNumeric(myzip)){
                $('#diagnostic_zip').addClass('bdr-error');
                $('#error-diagnostic_zip').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_zip').focus();
                status = 0;
            } */
            if(myzip .length < 6){
                 $('#hospital_zip').addClass('bdr-error');
                $('#error-diagnostic_zip_long').fadeIn().delay(3000).fadeOut('slow');
                 status = 0;
            }  
            if($("input[name='diagnostic_address']" ).val()==''){
                $('#geocomplete').addClass('bdr-error');
                $('#error-diagnostic_address').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_address').focus();
               status = 0;
            }
            
            if(!$.isNumeric(phn)){
                $('#diagnostic_phn1').addClass('bdr-error');
                $('#error-diagnostic_phn1').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_phn').focus();
                status = 0;
            }
                     
          
            if(!RegExpression.test(cpname)){
                $('#diagnostic_cntPrsn').addClass('bdr-error');
                $('#error-diagnostic_cntPrsn').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_cntPrsn').focus();
                status = 0;
            }
            
           
            if($('#diagnostic_mbrTyp').val()==''){
                $('#diagnostic_mbrTyp').addClass('bdr-error');
                $('#error-diagnostic_mbrTyp').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_mmbrType').focus();
               status = 0;
            }
            if($('#users_email').val()==''){
                $('#users_email').addClass('bdr-error');
                $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');
               // $('#users_email').focus();
               status = 0;
            }
           
           /* else if(diagnostic_mblNo == ''){
                $('#diagnostic_mblNo').addClass('bdr-error');
                $('#error-diagnostic_mblNo').fadeIn().delay(3000).fadeOut('slow');
                
               // $('#hospital_mblNo').focus();
            }*/
            if(!($.isNumeric(diagnostic_mblNo))){
                $('#diagnostic_mblNo').addClass('bdr-error');
                $('#error-diagnostic_mblNo').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
               // $('#hospital_mblNo').focus();
            }
            if($('#users_password').val()=='' || pswd.length < 6){
                $('#users_password').addClass('bdr-error');
                $('#error-users_password').fadeIn().delay(3000).fadeOut('slow');
               // $('#users_password').focus();
               status = 0;
            }
           
            if($('#cnfPassword').val()=='' || pswd!= cnfpswd){
                $('#cnfPassword').addClass('bdr-error');
                $('#error-cnfPassword_check').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
               // $('#cnfpassword').focus();
            }
            if(isAlphabets(diagName)){
                $('#diagnostic_name').addClass('bdr-error');
                $('#error-diagnostic_name').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
            
            if(isAlphabets(designations)){
                 $('#diagnostic_dsgn').addClass('bdr-error');
                $('#error-diagnostic_dsgn').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
            if(!emailCheck){
                 status = 0;
            }
            
               //debugger;
               
//            if(!check_email){
//               status = 0; 
//            }
               
        if(emails !='' && status == 1){
              check_email(emails);
              return false;
            }
            return false;
            
        }
        
   function validationDiagnosticEdit(){
       // $("form[name='diagnosticForm']").submit();
        var check= /^[a-zA-Z\s]+$/;
        var numcheck=/^[0-9]+$/;
        var RegExpression = /^[a-zA-Z\s]+$/;
        var emails = $.trim($('#users_email').val());
        var cpname = $.trim($('#diagnostic_cntPrsn').val());
        
        var centerName = $.trim($("#diagnosticCenter").val());
       // var cnfpswd = $.trim($("#cnfpassword").val());
        //var mbl= $.trim($('#diagnostic_mblNo').val());
        var phn= $.trim($('#diagnostic_phn1').val());
        var myzip = $.trim($('#diagnostic_zip').val());
        var cityId =$.trim($('#diagnostic_cityId').val());
        var stateIds = $.trim($('#StateId').val());
        var diagnostic_mblNo = $.trim($('#diagnostic_mblNo').val());
        var emailCheck =  checkEmailFormatValidation(emails);
        var ckeck = 1;
   
            if($('#diagnosticCenter').val()==''){
  
                $('#diagnostic_name').addClass('bdr-error');
                $('#error-diagnostic_name').fadeIn().delay(3000).fadeOut('slow');
               
            }
            
            else if($.trim($('#diagnostic_countryId').val()) == ''){
                $('#diagnostic_countryId').addClass('bdr-error');
                $('#error-diagnostic_countryId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_countryId').focus();
            
            }
          else if(!$.isNumeric(stateIds)){
               // console.log("in state");
                $('#diagnostic_stateId').addClass('bdr-error');
                $('#error-diagnostic_stateId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_stateId').focus();
              
            }
           else if(!$.isNumeric(cityId)){
                $('#diagnostic_cityId').addClass('bdr-error');
                $('#error-diagnostic_cityId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_cityId').focus();
            
            }
           
            else if(!$.isNumeric(myzip)){
                $('#diagnostic_zip').addClass('bdr-error');
                $('#error-diagnostic_zip').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_zip').focus();
              
            } 

            else if($("input[name='diagnostic_address']" ).val()==''){
                $('#geocomplete').addClass('bdr-error');
                $('#error-diagnostic_address').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_address').focus();
              
            }
            
            if(!$.isNumeric(phn)){
                $('#diagnostic_phn1').addClass('bdr-error');
                $('#error-diagnostic_phn1').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_phn').focus();
              
            }
            
            else if(!RegExpression.test(cpname)){
                $('#diagnostic_cntPrsn').addClass('bdr-error');
                $('#error-diagnostic_cntPrsn').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_cntPrsn').focus();
             
            }
            
            else if($("#diagnostic_dsgn" ).val()==''){
                $('#diagnostic_dsgn').addClass('bdr-error');
                $('#error-diagnostic_dsgn').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_address').focus();
               
            }else if($("textarea#diagnostic_aboutUs" ).val()==''){
              //  $('#diagnostic_dsgn').addClass('bdr-error');
                $('#error-diagnostic_aboutUs').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_address').focus();
               
            }else if(!emailCheck){
                return false; 
            }else{
                return true;
            }
    
          return false;      
        }
        
   function checkEmailFormatValidation(email){
       
                var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                if(email!==''){
                    if (!filter.test(email)){
                        
                       $('#users_email').addClass('bdr-error');
                         $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');;
                        return false;

                    }else{
                        return true;
                    }
            }
        } 
        
  function validationDiagnosticEditAccount(){
       // $("form[name='diagnosticForm']").submit();
        var check= /^[a-zA-Z\s]+$/;
        var numcheck=/^[0-9]+$/;
        var RegExpression = /^[a-zA-Z\s]+$/;
        var emails = $.trim($('#users_email').val());
        //var cpname = $.trim($('#diagnostic_cntPrsn').val());
        
        var pswd = $.trim($("#users_password").val());
       // var cnfpswd = $.trim($("#cnfpassword").val());
       // var mbl= $.trim($('#diagnostic_mblNo').val());
        var emailCheck =  checkEmailFormatValidation(emails);
          
         if($('#users_email').val()==''){
                $('#users_email').addClass('bdr-error');
                $('#error-users_email_check').fadeIn().delay(3000).fadeOut('slow');
               // $('#users_email').focus();
            }
            else if($('#users_password').val()==''){
                $('#users_password').addClass('bdr-error');
                $('#error-users_password').fadeIn().delay(3000).fadeOut('slow');
               // $('#users_password').focus();
            }else if(!emails){
                return false;
            }else{
                return false;
            }
    
          return true;      
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
                $('#users_email').addClass('bdr-error');
                $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
            if(users_mobile === ''){
                $('#users_mobile').addClass('bdr-error');
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
                        url : urls + 'index.php/diagnostic/check_email',
                        type: 'POST',
                       data: {'users_email' : emails,'user_table_id' : user_table_id },
                       success:function(datas){
                           //console.log(datas);
                           if(datas == 0 || datas != 1){
                            
                             $.ajax({
                                    url : urls + 'index.php/diagnostic/updatePassword',
                                    type: 'POST',
                                    
                                    data: $('#acccountForm').serialize(),
                                    async: false,
                                   success:function(insertData){
                                       
                                      // console.log(insertData);

                                       if(insertData == 1){
                                     $('#users_password').val('');
                                      $('#cnfPassword').val('');
                                   
                                    setTimeout(function(){
                                      $('#users_password').removeClass('bdr-error');
                                      $('#cnfPassword').removeClass('bdr-error');
                                      $('#users_mobile').removeClass('bdr-error');
                                      $('#users_email').removeClass('bdr-error');
                                      $('#error-password_email_check_success').fadeIn().delay(1000).fadeOut(function() {
                                      window.location.reload();
                                          window.location.href = urls + 'index.php/diagnostic/detailDiagnostic/'+diagnosticId+'/account';                     
                                        });
                                       }, 3000);
                                      
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
 
    
  function changebackgroundImage(id){
           $.ajax({
            url: urls + 'index.php/diagnostic/getBackgroundImage/'+id, // Url to which the request is send
            type: "POST",            
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
              $('.bg-picture').css("background-image", "url("+data+")");   
            }
               
          });
    
    }

$(document).ready(function (e) {
    
    $("#uploadimage").on('submit',(function(e) {
            e.preventDefault();
            $("#messageErrors").empty();
            $('#loading').show();
            $.ajax({
            url: urls + 'index.php/diagnostic/diagnosticBackgroundUpload/'+diagnosticId, // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
                var obj = jQuery.parseJSON(data);
                if(obj.status == 200){
                     $("#messageErrors").html("<div class='alert alert-success'>"+obj.messsage+"</div>");
                      changebackgroundImage(diagnosticId);
                      $("#changeBg").modal('hide');
                    
                }else{
                    $("#messageErrors").html("<div class='alert alert-danger'>"+obj.messsage+"</div>");
                }

            }
            });
    }));
// Function to preview image after validation

    
$("#uploadBtnDd").change(function() {

$("#messageErrors").empty(); // To remove the previous error message
    var file = this.files[0];
    var imagefile = file.type;
    var match= ["image/jpeg","image/png","image/jpg"];
    if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
    {
    $('#previewing').attr('src','noimage.png');
    $("#messageErrors").html("<div class='alert alert-danger'><p id='error'>Please Select A valid Image File</p><span id='error_message'>Only jpeg, jpg and png Images type allowed</span></div>");
    return false;
    }
    else
    {
    var reader = new FileReader();
    reader.onload = imageIsLoaded;
    reader.readAsDataURL(this.files[0]);
    }
    });

function imageIsLoaded(e) {
    $("#file").css("color","green");
    $('#image_preview').css("display", "block");
    $('#previewing').attr('src', e.target.result);
    $('#previewing').attr('width', '500px');
    $('#previewing').attr('height', '230px');
}
});

  function createCSV(){
         var stateId = '';
         var cityId = '';
         stateId = $('#diagnostic_stateId').val();
         cityId = $('#diagnostic_cityId').val();
         $.ajax({
              url : urls + 'index.php/diagnostic/createCSV',
              type: 'POST',
             data: {'diagnostic_stateId' : stateId ,'diagnostic_cityId': cityId },
             success:function(datas){
                console.log(datas)
             }
          });
     } 


//    var _validFileExtensions = ["jpeg", "jpg", "bmp", "gif", "png"];
//    function ValidateSingleInput(oInput,count) {
//        var count_image = 10;
//        var mess = '';
//        
//        if(count == undefined){ count = 0; }else{ mess = "and you already entered "+count+" image";}
//        count_image = count_image - count;
//        
//        if (oInput.type == "file") {
//            var sFileName = oInput.value;
//
//            var countFile = oInput.files.length;
//           
//            
//            if(countFile < count_image){
//                var fileName = oInput.files;
//                var k;
//                var fileType;
//                var size = 0;
////                var file, img;
////                if ((file = oInput.files[0])) {
////                     img = new Image();
////                      console.log(oInput.width);
////                     img.onload = function() {
////                        
////                         alert(oInput.size + " " + oInput.size);  
////                    }; 
////                }
//                
//                for (k = 0; k < countFile; k++) {
//                    size = size + fileName[k].size;
//                   // console.log(fileName[k]);
//                }
//                if (size > 6291456) {
//                    alert("Sorry, total allowed file size : -  6MB ");
//                    oInput.value = "";
//                    return false;
//                } else {
//                if (sFileName.length > 0) {
//                    var blnValid = false;
//                    var m;
//                    for (m = 0; m < countFile; m++) {
//                        fileType = fileName[m].type;
//                        fileType = fileType.split('/');
//                        if ($.inArray(fileType[1], _validFileExtensions) !== -1) {
//                            blnValid = true;
//                            continue;
//                        } else {
//                            alert("Sorry,   '" + fileName[m].name + "'   is invalid, allowed extensions are : -   " + _validFileExtensions.join(", "));
//                            oInput.value = "";
//                            blnValid = false;
//                        }
//                    }
//                    return blnValid;
//                }
//            }
//            }else{
//                alert("Sorry, total allowed image count is : 9 "+mess+"");
//                oInput.value = "";
//                return false;
//            }
//        }
//        return true;
//    }
    
    
         function checkValidFileUploads(urls){
       
           var avatar_file = $(".avatar-data").val();
            $.ajax({
              url : urls + 'index.php/diagnostic/checkFileUploadValidation',
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

</body>
</html>
