<style type="text/css">
    #datatable_bloodbank_filter
    {
        display:none;
    }
 .select2-container {
        margin-top:5px !important;
      }
</style> 

<?php $check= 0; 
if(isset($bloodBankId) && !empty($bloodBankId)){
    $check = $bloodBankId; 
}?>
<link href="<?php echo base_url(); ?>assets/cropper_new/dist/cropper.css" rel="stylesheet">
<!--<link href="<?php echo base_url();?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />-->
<link href="<?php echo base_url();?>assets/cropper/main.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<!--<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>-->
<script src="<?php echo base_url(); ?>assets/cropper_new/dist/cropper.js"></script>

<?php $current = $this->router->fetch_method();
if($current == 'detailBloodBank'):?>
<script src="<?php echo base_url(); ?>assets/cropper/common_cropper.js"></script>
<?php else:?>
<script src="<?php echo base_url(); ?>assets/cropper/main.js"></script>
<?php endif;?>

<script src="<?php echo base_url(); ?>assets/js/reCopy.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/blood-detail.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/select2/select2.min.js" type="text/javascript"></script> 



    <script src="<?php echo base_url(); ?>assets/js/common_js.js"></script>
<?php if(isset($mapData) && !empty($mapData)){
        $lat = $mapData[0]->bloodBank_lat;
        $lang = $mapData[0]->bloodBank_long;
        $imgUrl = (!empty($mapData[0]->bloodBank_photo)) ? base_url().'/assets/BloodBank/thumb/thumb_50/'.$mapData[0]->bloodBank_photo : base_url().'/assets/images/pins/Contact.png';
           
        $templates = '<img src="'.$imgUrl.'" /><h2 class="text-success">'.ucwords($mapData[0]->bloodBank_name).'</h2><b>'.$mapData[0]->bloodBank_add.'</b>';
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
     var urls = "<?php echo base_url() ?>";
    
   function checkExisting(email){
       var email = email;
       if(email != ''){
            $.ajax({
               url : urls + 'index.php/bloodbank/checkExisting',
               type: 'POST',
               datatype: 'json',
              data: {'emailId' : email},
              success:function(data, status, xhr){
                 var obj = JSON.parse(data);
                 if(obj.status == 0){
                     $("#isValid").val(0);
                     $('#users_email').addClass('bdr-error');
                     $('#error-users_email_check').fadeIn().delay(3000).fadeOut('slow');
                     $(".checkManual").css('display', 'block');
                     
                    /* $("#geocomplete").val('');
                     $("#lat").val('');
                     $("#lng").val('');
                     $("#userId").val('');
                     $("#geocomplete,#lat,#lng").removeAttr('readonly',''); */
                     
                     $('#isValid').val(0);
                     return false;
                 }else if(obj.status == 1){
                     $("#geocomplete").val(obj.address);
//                     $("#lat").val(obj.lat);
//                     $("#lng").val(obj.lng);
                     $("#userId").val(obj.userId);
                     $("#geocomplete,#lat,#lng").attr('readonly','readonly');
                     $("#isManual").prop("checked", false);
                     $(".checkManual").css('display', 'none');
                     $('#isValid').val(1);
                     return true;
                 }else if(obj.status == 2){
                     $("#geocomplete").val('');
//                     $("#lat").val('');
//                     $("#lng").val('');
                     $("#userId").val('');
                     $("#geocomplete,#lat,#lng").removeAttr('readonly','');
                     $(".checkManual").css('display', 'block');
                     $('#isValid').val(1);
                     return true;
                 }
              }
           });
       }
   }
    
    
      function IsAdrManual(val){
        if(val == 1){
            $("#lat,#lng,.geocomplete").removeAttr('readonly')
        }else if(val == 0){
            $("#lat,#lng,.geocomplete").attr('readonly', 'readonly');
        }

    }
       
    var bloodBankId = "<?php echo $check?>";
     
      /**
     * @method datatable
     * @description get records in listing using datatables
     */
     $(document).ready(function () {
        
         $('.selectpicker').select2().change(function(){
         $(this).valid()
     });
        var oTable = $('#datatable_bloodbank').DataTable({
            "processing": true,
            "bServerSide": true,
           "columnDefs": [{
                    "targets": [0,1,2,3,4,5,6],
                    "orderable": false
                }],
            "bLengthChange": false,
            "bProcessing": true,
            "iDisplayLength": 10,
            "bPaginate": true,
            "sPaginationType": "full_numbers",
            //"sAjaxSource": "<?php echo site_url('bloodbank/getBloodBankDl'); ?>",
           
            "ajax": {
                "url": "<?php echo site_url('bloodbank/getBloodBankDl'); ?>",
                "type": "POST",
                "data": function (d) {
                    d.status = $("#status").val();
                    d.cityId = $("#cityId").val();
                    d.bloodBank_name = $("#search").val();
                    
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                }
            },
             "columns": [
                {"data": "bloodBank_photo"},
                {"data": "bloodBank_name"},
                {"data": "bloodBank_phn"},
                {"data": "city_name"},
                {"data": "bloodBank_add"},
                {"data": "status"},
                {"data": "view" ,'searchable' : false},
            ],
        });

        $('#cityId,#status').change(function () {
            oTable.draw();
        });
        $('#search').on('keyup', function () {
            oTable.columns( 5 ).search($(this).val()).draw();
        });
    });

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
    $('.selectpicker').select2();

 
    function fetchCityList(stateId) {
        $.ajax({
            url: urls + 'index.php/hospital/fetchCity',
            type: 'POST',
            data: {'stateId': stateId},
            success: function (datas) {
                $('#cityId').html(datas);
                $('#cityId').selectpicker('refresh');

            }
        });


    }

    
       $(function(){
            var removeLink = '<a class="remove" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false"> <i class="fa fa-minus-circle fa-2x m-t-5 label-plus"></i></a>';
          $('a.add').relCopy({ append: removeLink});	
          
          });
          
         //var urls = "<?php // echo base_url()?>";
         var j = 1;
         var k = 1;
         var l =1;
         var n= 1;
         var m =1;
         
   function fetchCity(stateId) {   

           $.ajax({
               url : urls + 'index.php/bloodbank/fetchCity',
               type: 'POST',
              data: {'stateId' : stateId},
              success:function(datas){
 
                  $('#cityId').html(datas);
                 // $('#cityId').selectpicker('refresh');
                  $('#StateId').val(stateId);
              }
           });
           
        }
        
     function validationBloodbank(){
       //$("form[name='bloodDetail']").submit();
        var check= /^[a-zA-Z\s]+$/;
        var numcheck=/^[0-9]+$/;
        var emails = $.trim($('#users_email').val());
        var cpname = $.trim($('#bloodBank_cntPrsn').val())
        
        var phn= $.trim($('#bloodBank_phn').val());
        var myzip = $.trim($('#bloodBank_zip').val());
        var cityId =$.trim($('#cityId').val());
        var stateIds = $.trim($('#stateId').val());
        var country = $.trim($('#countryId').val());
        var bloodBank_mblNo = $.trim($('#bloodBank_mblNo').val());
        var status = 1;
       
             if($('#bloodBank_name').val()==''){
                $('#bloodBank_name').addClass('bdr-error');
                $('#error-bloodBank_name').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){ $('#bloodBank_name').removeClass('bdr-error'); }, 3000);
                status = 0;
            }
            if($('.geocomplete').val()==''){
                $('.geocomplete').addClass('bdr-error');
                $('#error-bloodBank_add').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){ $('#geocomplete1').removeClass('bdr-error'); }, 3000);
                status = 0;
            }
            
            if(!$.isNumeric(phn) && phn == ''){
                
                $('#bloodBank_phn').addClass('bdr-error');
                $('#error-bloodBank_phn').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){ $('#bloodBank_phn').removeClass('bdr-error'); }, 3000);
                // $('#hospital_phn').focus();
                status = 0;
            }else{
                if(phn.length != 10){
                    
                     
                $('#bloodBank_phn').addClass('bdr-error');
                $('#error-bloodBank_phn').fadeIn().delay(3000).fadeOut('slow'); 
                setTimeout(function(){ $('#bloodBank_phn').removeClass('bdr-error'); }, 3000);
                }
            }
            
//            if(!$.isNumeric(phn)){
//                $('#bloodBank_phn1').addClass('bdr-error');
//                $('#error-bloodBank_phn').fadeIn().delay(3000).fadeOut('slow');
//                // $('#hospital_phn').focus();
//                status = 0;
//            }
              var emailCheck =  checkEmailFormat();
             
              
            if($('#users_email').val()==''){
                $('#users_email').addClass('bdr-error');
                $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){ $('#users_email').removeClass('bdr-error'); }, 3000);
               
               status = 0;
            }
            
            if($('#bloodbank_docatId').val()==''){
                $('#bloodbank_docatId').addClass('bdr-error');
                $('#error-bloodbank_docatId').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){ $('#bloodbank_docatId').removeClass('bdr-error'); }, 3000);
               
               status = 0;
            }
            
             if(!check.test(cpname)){
                $('#bloodBank_cntPrsn').addClass('bdr-error');
                $('#error-bloodBank_cntPrsn').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){ $('#bloodBank_cntPrsn').removeClass('bdr-error'); }, 3000);
                status = 0; 
            }
            
            if(cityId == ''){
                $('#cityId').addClass('bdr-error');
                $('#error-cityId').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){ $('#cityId').removeClass('bdr-error'); }, 3000);
               
               status = 0;
            }
            
            if(stateIds == ''){
                $('#stateId').addClass('bdr-error');
                $('#error-stateId').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){ $('#stateId').removeClass('bdr-error'); }, 3000);
               
               status = 0;
            }
            
            if(country == ''){
                $('#countryId').addClass('bdr-error');
                $('#error-countryId').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){ $('#countryId').removeClass('bdr-error'); }, 3000);
               
               status = 0;
            }
            
           if(myzip == ''){
                $('#bloodBank_zip').addClass('bdr-error');
                $('#error-bloodBank_zip').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){ $('#bloodBank_zip').removeClass('bdr-error'); }, 3000);
               
               status = 0;
            }
            
            if($('#lat').val()==''){
                $('#lat').addClass('bdr-error');
                $('#error-lat').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){ $('#lat').removeClass('bdr-error'); }, 3000);
               
               status = 0;
            }
            
            if($('#lng').val()==''){
                $('#lng').addClass('bdr-error');
                $('#error-lng').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){ $('#lng').removeClass('bdr-error'); }, 3000);
               
               status = 0;
            }
           if(!emailCheck){
                    status = 0;  
              }
       
            if( emails != '' && status == 1){
                check_email_detail(emails);
               
            }
            
        
            
            return false;
            
        }
         
   function validationBloodbankEdit(){
       
       //$("form[name='bloodDetail']").submit();
        var check= /^[a-zA-Z\s]+$/;
        var numcheck=/^[0-9]+$/;
        var emails = $.trim($('#users_email').val());
        var cpname = $.trim($('#bloodBank_cntPrsn').val())
        
        var phn= $.trim($('#bloodBank_phn').val());
        var myzip = $.trim($('#bloodBank_zip').val());
        var cityId =$.trim($('#cityId').val());
        var stateIds = $.trim($('#stateId').val());
        var country = $.trim($('#countryId').val());
        var bloodBank_mblNo = $.trim($('#bloodBank_mblNo').val());
        var status = 1;
       
             if($('#bloodBank_name').val()==''){
                $('#bloodBank_name').addClass('bdr-error');
                $('#error-bloodBank_name').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
            if($('.geocomplete').val()==''){
                $('.geocomplete').addClass('bdr-error');
                $('#error-bloodBank_add').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
            
            if(!$.isNumeric(phn) && phn == ''){
                
                $('#bloodBank_phn').addClass('bdr-error');
                $('#error-bloodBank_phn').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_phn').focus();
                status = 0;
            }else{
                if(phn.length != 10){
                    
                     
                $('#bloodBank_phn').addClass('bdr-error');
                $('#error-bloodBank_phn').fadeIn().delay(3000).fadeOut('slow'); 
                }
            }
            
//            if(!$.isNumeric(phn)){
//                $('#bloodBank_phn1').addClass('bdr-error');
//                $('#error-bloodBank_phn').fadeIn().delay(3000).fadeOut('slow');
//                // $('#hospital_phn').focus();
//                status = 0;
//            }
              var emailCheck =  checkEmailFormat();
             
              
            if($('#users_email').val()==''){
                $('#users_email').addClass('bdr-error');
                $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');
               
               status = 0;
            }
            
            if($('#bloodbank_docatId').val()==''){
                $('#bloodbank_docatId').addClass('bdr-error');
                $('#error-bloodbank_docatId').fadeIn().delay(3000).fadeOut('slow');
               
               status = 0;
            }
            
             if(!check.test(cpname)){
                $('#bloodBank_cntPrsn').addClass('bdr-error');
                $('#error-bloodBank_cntPrsn').fadeIn().delay(3000).fadeOut('slow');
                status = 0; 
            }
            
            if(cityId == ''){
                $('#cityId').addClass('bdr-error');
                $('#error-cityId').fadeIn().delay(3000).fadeOut('slow');
               
               status = 0;
            }
            
            if(stateIds == ''){
                $('#stateId').addClass('bdr-error');
                $('#error-stateId').fadeIn().delay(3000).fadeOut('slow');
               
               status = 0;
            }
            
            if(country == ''){
                $('#countryId').addClass('bdr-error');
                $('#error-countryId').fadeIn().delay(3000).fadeOut('slow');
               
               status = 0;
            }
            
           if(myzip == ''){
                $('#bloodBank_zip').addClass('bdr-error');
                $('#error-bloodBank_zip').fadeIn().delay(3000).fadeOut('slow');
               
               status = 0;
            }
            
            if($('#lat').val()==''){
                $('#lat').addClass('bdr-error');
                $('#error-lat').fadeIn().delay(3000).fadeOut('slow');
               
               status = 0;
            }
            
            if($('#lng').val()==''){
                $('#lng').addClass('bdr-error');
                $('#error-lng').fadeIn().delay(3000).fadeOut('slow');
               
               status = 0;
            }
       
            if( status == 1){
              return true;
               
            }
            
        
            
            return false;
            
        }
        
    function checkEmailFormatDetail(){
                var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                var email = $('#users_email').val();
                if(email!==''){
                    if (!filter.test(email)){
                       $('#users_email').addClass('bdr-error');
                       $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');
                    }
            }
        } 
        
   function check_email(myEmail){
           $.ajax({
               url : urls + 'index.php/bloodbank/check_email',
               type: 'POST',
              data: {'users_email' : myEmail},
              success:function(datas){
                  if(datas == 0){
                   $("form[name='submitForm']").submit();
                   return true;
                }
                else if(datas == 1) {
                  $('#users_email').addClass('bdr-error');
                  $('#error-users_email_check').fadeIn().delay(3000).fadeOut('slow');
                 // $('#users_email').focus();
                 return false;
                }else{
                    $('#users_email_status').val(datas);
                    $("form[name='submitForm']").submit();
                     return true;
                }
              } 
           });
        }
     
  
   function checkNumber(inputName, ids) {

        var mobileNumber = 0;
        if (ids != '')
            mobileNumber = $('#' + inputName + ids).val();
        else
            mobileNumber = $('#' + inputName).val();
        // alert(mobileNumber);
        if (!$.isNumeric(mobileNumber)) {

            if (ids != '') {
                $('#' + inputName + ids).addClass('bdr-error');
                $('#' + inputName + ids).val('');
            }
            else {
                $('#' + inputName).addClass('bdr-error');
                $('#' + inputName).val('');
            }
            // $('#error-users_mobile').fadeIn().delay(3000).fadeOut('slow');
            // $('#hospital_phn').focus();
        }
    }
        
 function checkEmailFormat(){
                var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                var email = $('#users_email').val();
                if(email!==''){
                    if (!filter.test(email)){
                        
                       $('#users_email').addClass('bdr-error');
                         $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');;
                        // $('#users_email').focus();
                        return false;
                    }else{
                        return true;
                    }
            }
        }
        
   function check_email_blood_bank(myEmail){
            var user_table_id = $('#user_tables_id').val();
           $.ajax({
               url : urls + 'index.php/bloodbank/check_email',
               type: 'POST',
              data: {'users_email' : myEmail,'user_table_id' : user_table_id },
              success:function(datas){
                 // console.log(datas);
                  if(datas == 0){
                   $("form[name='bloodDetail']").submit();
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
        
   function updatePassword(){
          
            var pswd = $.trim($("#users_password").val());
            var cnfpswd = $.trim($("#cnfPassword").val());
            //var password = $('#myPassword').val();
            var user_tables_id = $('#user_tables_id').val();
            var status = 1;
            if(pswd.length < 6){
                $('#users_password').addClass('bdr-error');
                //$('#error-users_password').fadeIn().delay(3000).fadeOut('slow');
               // $('#users_password').focus();
               status = 0;
            }
           
           if(pswd != cnfpswd){
                $('#cnfPassword').addClass('bdr-error');
               // $('#error-cnfPassword_check').fadeIn().delay(3000).fadeOut('slow');
                
               // $('#cnfpassword').focus();
               status = 0;
            }
            if(status == 0)
                return false;
            else{
                    $.ajax({
                  url : urls + 'index.php/bloodbank/updatePassword',
                  type: 'POST',
                 //data: {'currentPassword' : pswd,'existingPassword' : password,'user_tables_id' : user_tables_id}, password updated from another user except super admin
                 data: {'currentPassword' : pswd,'user_tables_id' : user_tables_id},
                 success:function(datas){
                     //var statuss = datas.split('~');
                     //console.log(datas);
                    
                     if(datas == 0){
                   $('#error-password_email_check').fadeIn().delay(4000).fadeOut('slow');
                      return true;
                    }
                    else {
                           /*$('#myPassword').val(statuss[1]);*/
                           $('#users_password').val('');
                           $('#cnfPassword').val('');
                           $('#error-password_email_check_success').fadeIn().delay(4000).fadeOut('slow');

                           return true;
                    }
                 } 
              });
              
            }
        }
        
   function validationBloodbankAdd(){
        // $("form[name='bloodbankForm']").submit();
       
        var check= /^[a-zA-Z\s]+$/;
        var numcheck=/^[0-9]+$/;
        var emails = $.trim($('#users_email').val());
        var cpname = $.trim($('#bloodBank_cntPrsn').val());
        
        
        var pswd = $.trim($("#users_password").val());
        var cnfpswd = $.trim($("#cnfPassword").val());
        
        var isValid = $('#isValid').val();
        
        var phn= $.trim($('#bloodBank_phn').val());
        var myzip = $.trim($('#bloodBank_zip').val());
        var cityId =$.trim($('#cityId').val());
        var stateIds = $.trim($('#stateId').val());
        var bloodBank_mblNo = $.trim($('#bloodBank_mblNo').val());
        var status = 1;
 
            if($('#bloodBank_name').val()==''){
                $('#bloodBank_name').addClass('bdr-error');
                $('#error-bloodBank_name').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_name').focus();
               status = 0;
            }
           if($('#bloodBank_type').val()==''){
                $('#bloodBank_type').addClass('bdr-error');
                $('#error-bloodBank_type').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_type').focus();
               status = 0;
            }
            if($.trim($('#countryId').val()) == ''){
                $('#countryId').addClass('bdr-error');
                $('#error-countryId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_countryId').focus();
               status = 0;
            }
           if(stateIds === ''){
               // console.log("in state");
                $('#stateId').addClass('bdr-error');
                $('#error-stateId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_stateId').focus();
               status = 0;
            }
            if(cityId === ''){
                $('#cityId').addClass('bdr-error');
                $('#error-cityId').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_cityId').focus();
               status = 0;
            }
           
           /* if(!$.isNumeric(myzip)){
                
                $('#bloodBank_zip').addClass('bdr-error');
                $('#error-bloodBank_zip').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_zip').focus();
                status = 0;
            } */
            if(myzip .length < 6){
                 $('#bloodBank_zip').addClass('bdr-error');
                $('#error-bloodBank_zip').fadeIn().delay(3000).fadeOut('slow');
                 status = 0;
            }  

            if($("input[name='bloodBank_add']" ).val()==''){
                $('#bloodBank_add').addClass('bdr-error');
                $('#error-bloodBank_add').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_address').focus();
               status = 0;
            }
         
            
            if(!$.isNumeric(phn) && phn == ''){
                
                $('#bloodBank_phn').addClass('bdr-error');
                $('#error-bloodBank_phn').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_phn').focus();
                status = 0;
            }
            
            if(!check.test(cpname)){
                $('#bloodBank_cntPrsn').addClass('bdr-error');
                $('#error-bloodBank_cntPrsn').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_cntPrsn').focus();
                status = 0;
            }
           
            if($('#bloodBank_mmbrTyp').val()==''){
                $('#bloodBank_mmbrTyp').addClass('bdr-error');
                $('#error-bloodBank_mmbrTyp').fadeIn().delay(3000).fadeOut('slow');
               // $('#hospital_mmbrType').focus();
               status = 0;
            }
            if($('#users_email').val()==''){
                $('#users_email').addClass('bdr-error');
                $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');
               // $('#users_email').focus();
               status = 0;
            }
            if(!($.isNumeric(bloodBank_mblNo))){
                $('#bloodBank_mblNo').addClass('bdr-error');
                $('#error-bloodBank_mblNo').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
               // $('#hospital_mblNo').focus();
            }
            if(pswd.length < 6){
                $('#users_password').addClass('bdr-error');
                $('#error-users_password').fadeIn().delay(3000).fadeOut('slow');
               // $('#users_password').focus();
                status = 0;
            }
            if(cnfpswd == ''){
                $('#cnfPassword').addClass('bdr-error');
                $('#error-cnfPassword_check').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
               // $('#cnfpassword').focus();
            }
           
            if(pswd != cnfpswd){
                $('#cnfPassword').addClass('bdr-error');
                $('#error-cnfPassword_check').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
               // $('#cnfpassword').focus();
            }
            
            if(isValid == 0){
                $('#userexist').addClass('bdr-error');
                $('#error-userexist').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
            
            
             var emailCheck =  checkEmailFormat();
            if(!emailCheck){
                 status = 0;  
              }
            
            
            if(emails !='' && status == 1){
              check_email(emails);
              return false;
            }
               //debugger;
        
            return false;
            
        }
             


 $("#savebtn").click(function(){
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
</script>
 <script>
    
    function openBloodUnit(id){
        if($("#anve_"+id).prop("checked") == true){
                $('#anveDetail_'+id).show();
            }else{
                $('#anveDetail_'+id).hide();
            }
        
    }
    
    $("#g,#t,#a").on('click',function(){
       $(".table").find('.showUnit').each(function(){
        $(this).children().eq(0).css('display','inline');
        $(this).children().eq(1).hide();
    });
    });

    
    
    function anchorClick(id){
        $("#detailbu_"+id).toggle();
          $("#newbu_"+id).toggle();
    }
    function updateBloodUnit(id){
        var bloodUnit = $('#unit_'+id).val();
        if(bloodUnit != ''){
        $.ajax({
               url : urls + 'index.php/bloodbank/bloodUnitUpdate',
               type: 'POST',
              data: {'bloodCatBank_id' : id,'bloodCatBank_Unit' : bloodUnit},
              success:function(datas){
                  if(datas){
                   $('#unitshow_'+id).html(bloodUnit);
                   anchorClick(id);
                   return true;
              }
             
              } 
           });
       }   
    }
    
    function changebackgroundImage(id){
           $.ajax({
            url: urls + 'index.php/bloodbank/getBackgroundImage/'+id, // Url to which the request is send
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
            url: urls + 'index.php/bloodbank/bloodbankBackgroundUpload/'+bloodBankId, // Url to which the request is send
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
                     setTimeout(function(){ $("#messageErrors").html(""); }, 2000);
                      changebackgroundImage(bloodBankId);
                      $("#changeBg").modal('hide');
                      $("#uploadBtnDd").val("");
                    
                }else{
                    $("#messageErrors").html("<div class='alert alert-danger'>"+obj.messsage+"</div>");
                    setTimeout(function(){ $("#messageErrors").html(""); }, 2000);
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

    function checkValidFileUploads(urls){
       
           var avatar_file = $(".avatar-data").val();
            $.ajax({
              url : urls + 'index.php/bloodbank/checkFileUploadValidation',
              type: 'POST',
              data:{'avatar_file' : avatar_file},
             success:function(data){
                var obj = $.parseJSON(data);
                
                if(obj.state == 400){
                    $("#message_upload").html("<div class='alert alert-danger'>"+obj.message+"</div>");
                   // $(".close").hide();
                }else{
                    $("#avatar-modal").modal('hide');
                     $("#message_upload").html("");
                }
             }
          });
   }
   
    function check_email_detail(myEmail){
           var user_table_id = $('#user_tables_id').val();
           $.ajax({
               url : urls + 'index.php/bloodbank/check_email',
               type: 'POST',
              data: {'users_email' : myEmail,'user_table_id' : user_table_id },
              success:function(datas){
                 // console.log(datas);
                  if(datas == 0){
                   $("form[name='submitForm']").submit();
                   return true;
              }
              else if(datas == 1){
                $('#users_email').addClass('bdr-error');
                $('#error-users_email_check').fadeIn().delay(3000).fadeOut('slow');;
               
               return false;
              }
              else{
                  //$('#users_email_status').val(datas);
                  $("form[name='submitForm']").submit();
                  return true;
              }
              } 
           });
    }
   

   
    $(document).ready(function () {
        var url = "<?php echo base_url();?>";
        $("#submitForm").validate({
           

            rules: {
                bloodBank_name: {
                    required: true,
                    lettersonly: true
                },
                countryId: {
                    required: true
                },
                stateId: {
                    required: true
                },
                cityId: {
                    required: true
                },
                bloodBank_zip: {
                    required: true,
                    number: true,
                    minlength:6,
                    maxlength:6
                },
                bloodBank_add: {
                    required: true
                },
                lat: {
                    required: true,
                    numberdecimalonly: true
                },
                lng: {
                    required: true,
                    numberdecimalonly: true
                },
                bloodBank_phn: {
                    required: true,
                     number: true,
                    minlength:10,
                    maxlength:10
                },
                bloodBank_cntPrsn: {
                    required: true,
                    lettersonly: true
                },
                bloodBank_mbrTyp: {
                    required: true
                },
                isEmergency: {
                    required: true,
                },
                bloodbank_docatId: {
                    required: true
                },
                users_email: {
                    required: true,
                    email: true,
                    remote: {
                    url:  url + 'index.php/bloodbank/isEmailRegister',
                    type: "post",
                    data: {
                            email: function(){ return $("#users_email").val(); },
                            id: function(){ return $("#user_tables_id").val(); },
                            role: function(){ return 2; }
                    }
                  }
                },
                bloodBank_mblNo: {
                    required: true,
                    number: true,
                    minlength:10,
                    maxlength:10
                },
                  users_password: {
                    required: true, 
                },
                  cnfPassword: {
                    required: true,
                    equalTo: "#users_password"
                },
                 avatar_file: {
                    required: true,
                },
            },
            messages: {
                bloodBank_name: {
                    required: "Please enter bloodbank name",
                },
                 countryId: {
                    required: "Please select country",
                },
                cityId: {
                    required: "Please select city",
                },
                stateId: {
                    required: "Please select state",
                },
                bloodBank_zip: {
                    required: "Please enter zip",

                },
                bloodBank_add: {
                    required: "Please enter address",
                },
                lat: {
                    required: "Please enter latitude",
                },
                lng: {
                    required: "Please enter longitude",
                },
                bloodBank_phn: {
                    required: "Please enter phone number",
                },
                bloodBank_cntPrsn: {
                    required: "Please enter contact person name",
                },
                bloodBank_mbrTyp: {
                    required: "Please select member type",
                },
                isEmergency: {
                    required: "Please select 24/7 service",
                },
                bloodbank_docatId: {
                    required: "Please enter docat id",
                },
                users_email: {
                    required: "Please enter email",
                    remote: jQuery.validator.format("{0} is already exists.")
                },
                bloodBank_mblNo: {
                    required: "Please enter mobile number",
                },
                users_password: {
                    required: "Please enter password",
                },
                cnfPassword: {
                    required: "Please enter confirm password",
                }
            },
            submitHandler: function (form) {
                form.submit();
            },
        });

    });
    
         $(function () {
        //new CropAvatar($('#blood-crop-avatar'));
        $(".common-edit").click(function () {

            $(".logo-img").toggle();
            $(".logo-up").toggle();
            $(".picEdit").toggle();
            $(".picEditClose").toggle();
        }); 

    });

    </script>
