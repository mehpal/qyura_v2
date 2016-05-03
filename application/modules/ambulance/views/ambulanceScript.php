<style type="text/css">
    #ambulance_datatable_filter
    {
        display:none;
    }
</style>
<link href="<?php echo base_url();?>assets/cropper/cropper.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/cropper/main.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/cropper/cropper.js"></script>

<?php $current = $this->router->fetch_method();
if($current == 'detailAmbulance'):?>
<script src="<?php echo base_url(); ?>assets/cropper/common_cropper.js"></script>
<?php else:?>
<script src="<?php echo base_url(); ?>assets/cropper/main.js"></script>
<?php endif;?>

<script src="<?php echo base_url(); ?>assets/js/reCopy.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="<?php echo base_url();?>assets/vendor/select2/select2.min.js" type="text/javascript"></script> 
<!-- <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>-->
<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>
<!--<script src="https://maps.googleapis.com/maps/api/js"></script>-->
    <script src="<?php echo base_url(); ?>assets/js/common_js.js"></script>
<?php $check= 0; 
if(isset($ambulanceId) && !empty($ambulanceId)){
    $check = $ambulanceId; 
}?>
<?php if(isset($mapData) && !empty($mapData)){
        $lat = $mapData[0]->ambulance_lat;
        $lang = $mapData[0]->ambulance_long;
        $imgUrl = (!empty($mapData[0]->ambulance_img)) ? base_url().'/assets/ambulanceImages/thumb/thumb_50/'.$mapData[0]->ambulance_img : base_url().'/assets/images/pins/Contact.png';
           
        $templates = '<img src="'.$imgUrl.'" /><h2 class="text-success">'.ucwords($mapData[0]->ambulance_name).'</h2><b>'.$mapData[0]->ambulance_address.'</b>';
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
    
    
    function IsAdrManual(val){
        if(val == 1){
            $("#lat,#lng").removeAttr('readonly')
        }else if(val == 0){
            $("#lat,#lng").attr('readonly', 'readonly');
        }

    }
    
    var urls = "<?php echo base_url()?>";
    var ambulanceId = "<?php echo $check?>";
    $('#date-3').datepicker();
    
//    $('.selectpicker').selectpicker({
//    style: 'btn-default',
//    size: "auto",
//    width: "100%"
//   });
   $('.selectpicker').select2();

    $("#edit").click(function () {
    $("#detail").toggle();
    $("#editdetail").toggle();
    });
        $(function(){

//        $("#geocomplete").geocomplete({
//           map: ".map_canvas",
//          details: "form",
//          types: ["geocode", "establishment"],
//        });

        $("#find").click(function(){
           $("#geocomplete").trigger("geocode");
        });
      });
      $(function(){
            var removeLink = '<a class="remove" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false"> <i class="fa fa-minus-circle fa-2x m-t-5 label-plus"></i></a>';
          $('a.add').relCopy({ append: removeLink});    
          
          });
        var urls = "<?php echo base_url()?>";
         var j = 1;
        function fetchCity(stateId) {    
           
           $.ajax({
               url : urls + 'index.php/ambulance/fetchCity',
               type: 'POST',
              data: {'stateId' : stateId},
              success:function(datas){
               // console.log(datas);
                  $('#ambulance_cityId').html(datas);
                  $('#ambulance_cityId').selectpicker('refresh');
                  $('#StateId').val(stateId);
              }
           });
           
        }
        function countPhoneNumber(){
        if(j==10)
            return false;
      j = parseInt(j)+parseInt(1); 
      $('#countPnone').val(j);
      $('#multiPhoneNumber').append('<input type=text class=form-control name=ambulance_phn[] placeholder=9837000123 maxlength="10" id=ambulance_phn'+j + ' />');
     $('#multiPreNumber').append('<select class=selectpicker data-width=100% name=pre_number[] id=multiPreNumber'+j+'><option value=91>+91</option><option value=1>+1</option></select>');
      $('#multiPreNumber'+j).selectpicker('refresh');
      //.append('<div class=col-lg-3 col-md-4 col-sm-3 col-sm-4 col-xs-12 m-t-xs-10 id=multiPreNumber><select class=selectpicker data-width=100% name=pre_number[] id=multiPreNumber><option value =91>+91</option><option value =1>+1</option></select></div><div class=col-lg-7 col-md-6 col-sm-7 col-xs-10 m-t-xs-10 id=multiPhoneNumber><nput type=text class="form-control" name=hospital_phn[] id=hospital_phn1 placeholder=9837000123 maxlength=10 /> </div>');

   }
        
        
        function validationAmbulance(){
             //$("form[name='ambulanceForm']").submit();
        var check= /^[a-zA-Z\s]+$/;
        var numcheck=/^[0-9]+$/;
        var emails = $.trim($('#users_email').val());
        var cpname = $.trim($('#ambulance_cntPrsn').val());        
        var phn= $.trim($('#ambulance_phn').val());
        var myzip = $.trim($('#ambulance_zip').val());
        var cityId =$.trim($('#ambulance_cityId').val());
        var stateIds = $.trim($('#ambulance_stateId').val());
        var mobileNumber = $.trim($('#users_mobile').val());
        var ambulanceName = $('#ambulance_name').val();
        
        var status =1;
    //debugger;
   
            if($('#ambulance_name').val()==''){
                $('#ambulance_name').addClass('bdr-error');
                $('#error-ambulance_name').fadeIn().delay(3000).fadeOut('slow');
               status = 0;
                 setTimeout(function(){
                    $('#ambulance_name').removeClass('bdr-error');
                 }, 3000);
            }
            
             if($('#midNumber').val()==''){
                $('#midNumber').addClass('bdr-error');
                $('#error-midNumber').fadeIn().delay(3000).fadeOut('slow');
               status = 0;
                 setTimeout(function(){
                    $('#midNumber').removeClass('bdr-error');
                 }, 3000);
            }
            
           if(!check.test(ambulanceName)){
                 $('#ambulance_name').addClass('bdr-error');
                $('#error-ambulance_name').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
                  setTimeout(function(){
                    $('#ambulance_name').removeClass('bdr-error');
                 }, 3000);
            }
            
           if($('#ambulance_type').val()==''){
                $('#ambulance_type').addClass('bdr-error');
                $('#error-ambulance_type').fadeIn().delay(3000).fadeOut('slow');
               status = 0;
                 setTimeout(function(){
                    $('#ambulance_type').removeClass('bdr-error');
                 }, 3000);
            }
            if($.trim($('#ambulance_countryId').val()) == ''){
                $('#ambulance_countryId').addClass('bdr-error');
                $('#error-ambulance_countryId').fadeIn().delay(3000).fadeOut('slow');
                status= 0;
                 setTimeout(function(){
                    $('#ambulance_countryId').removeClass('bdr-error');
                 }, 3000);
            }
           if(stateIds === ''){
               // console.log("in state");
                $('#ambulance_stateId').addClass('bdr-error');
                $('#error-ambulance_stateId').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
                setTimeout(function(){
                    $('#ambulance_stateId').removeClass('bdr-error');
                 }, 3000);
            }
            if(cityId === ''){
                $('#ambulance_cityId').addClass('bdr-error');
                $('#error-ambulance_cityId').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
                 setTimeout(function(){
                    $('#ambulance_cityId').removeClass('bdr-error');
                 }, 3000);
            }
            
            if(myzip .length < 6){
                
                $('#ambulance_zip').addClass('bdr-error');
                $('#error-ambulance_zip').fadeIn().delay(3000).fadeOut('slow');
              status = 0;
                setTimeout(function(){
                    $('#ambulance_zip').removeClass('bdr-error');
                 }, 3000);
            } 

            if($("input[name='ambulance_address']" ).val()==''){
                $('#ambulance_address').addClass('bdr-error');
                $('#error-ambulance_address').fadeIn().delay(3000).fadeOut('slow');
               status = 0;
                setTimeout(function(){
                    $('#ambulance_address').removeClass('bdr-error');
                 }, 3000);
            }
            
          
            
            if(!$.isNumeric(phn)){
                $('#ambulance_phn').addClass('bdr-error');
                $('#error-ambulance_phn').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
                  setTimeout(function(){
                    $('#ambulance_phn').removeClass('bdr-error');
                 }, 3000);
            }
            
              if(!$.isNumeric(phn) && phn == ''){
                
                $('#ambulance_phn').addClass('bdr-error');
                $('#error-ambulance_phn').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_phn').focus();
                status = 0;
            }else{
                if(phn.length != 10){
                    
                     
                $('#ambulance_phn').addClass('bdr-error');
                $('#error-ambulance_phn').fadeIn().delay(3000).fadeOut('slow'); 
                status = 0;
                }
            }
//            if(!$.isNumeric(mobileNumber)){
//                $('#users_mobile').addClass('bdr-error');
//                $('#error-users_mobile').fadeIn().delay(3000).fadeOut('slow');
//                 setTimeout(function(){
//                    $('#users_mobile').removeClass('bdr-error');
//                 }, 3000);
//                status = 0;
//            }
            if(!check.test(cpname)){
                $('#ambulance_cntPrsn').addClass('bdr-error');
                $('#error-ambulance_cntPrsn').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
                 setTimeout(function(){
                    $('#ambulance_cntPrsn').removeClass('bdr-error');
                 }, 3000);
            }
           
            if($('#ambulance_mmbrTyp').val()==''){
                $('#ambulance_mmbrTyp').addClass('bdr-error');
                $('#error-ambulance_mmbrTyp').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
                 setTimeout(function(){
                    $('#ambulance_mmbrTyp').removeClass('bdr-error');
                 }, 3000);
            }
            if($('#users_email').val()==''){
                $('#users_email').addClass('bdr-error');
                $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');
                 setTimeout(function(){
                    $('#users_email').removeClass('bdr-error');
                 }, 3000);
               status = 0;
            }
            
              if($('#lat').val()=='' && !latChack($('#lat').val())){
                $('#lat').addClass('bdr-error');
                $('#error-lat').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){
                    $('#lat').removeClass('bdr-error');
                 }, 3000);
               status = 0;
             }
            
              if($('#lng').val()=='' && !lngChack($('#lng').val())){
                $('#lng').addClass('bdr-error');
                $('#error-lng').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){
                    $('#lng').removeClass('bdr-error');
                 }, 3000);
               status = 0;
             }
             
             if(!lngChack($('#lng').val())){
                $('#lng').addClass('bdr-error');
                $('#error-lng').fadeIn().delay(3000).fadeOut('slow');
                  setTimeout(function(){
                    $('#lng').removeClass('bdr-error');
                 }, 3000);
                  status = 0;
             }
             if(!latChack($('#lat').val())){
                 $('#lat').addClass('bdr-error');
                 $('#error-lat').fadeIn().delay(3000).fadeOut('slow');
                  setTimeout(function(){
                    $('#lat').removeClass('bdr-error');
                 }, 3000);
               status = 0;
             }
            
              if($('#ambulance_docatId').val()==''){
                $('#ambulance_docatId').addClass('bdr-error');
                $('#error-ambulance_docatId').fadeIn().delay(3000).fadeOut('slow');
                  setTimeout(function(){
                    $('#ambulance_docatId').removeClass('bdr-error');
                 }, 3000);
               status = 0;
            }
            
            
            
            var checkEmail = checkEmailFormat();
            if(!checkEmail){
                status = 0;
            }
            if(emails !='' && status == 1){
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
                        return false;
                    }else{
                        return true;
                    }
            }
        }   
          function check_email(myEmail){
          
           $.ajax({
               url : urls + 'index.php/ambulance/check_email',
               type: 'POST',
              data: {'users_email' : myEmail},
              success:function(datas){
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
                    $('#users_email_status').val(datas);
                    $("form[name='submitForm']").submit();
                     return true;
              } 
              } 
           });
        }  

        //debugger;
       function fetchCity(stateId) {           
           $.ajax({
               url : urls + 'index.php/ambulance/fetchCity',
               type: 'POST',
              data: {'stateId' : stateId},
              success:function(datas){
                  $('#ambulance_cityId').html(datas);
                  $('#ambulance_cityId').selectpicker('refresh');
              }
           });
           
        }
                // datatable get records
         $(document).ready(function () {
                var oTable = $('#ambulance_datatable').DataTable({
                    "processing": true,
                    "bServerSide": true,
                     "columnDefs": [{
                    "targets": [0,1,2,3,4,5,6],
                    "orderable": false
                     }],
                   // "searching": true,
                    "bLengthChange": false,
                    "bProcessing": true,
                    "iDisplayLength": 10,
                    "bPaginate": true,
                    "sPaginationType": "full_numbers",
                    "columns": [
                        {"data": "ambulance_img"},
                        {"data": "ambulance_name"},
                        {"data": "city_name"},
                        {"data": "ambulance_phn"},
                        {"data": "ambulance_address"},
                        {"data": "status"},
                        {"data": "view" ,'searchable' : false},
                    ],
                    
                    "ajax": {
                        "url": "<?php echo site_url('ambulance/getAmbulanceDl'); ?>",
                        "type": "POST", 
                        "data": function ( d ) {
                                         d.cityId = $("#ambulance_cityId").val();
                                         d.ambulanceName = $("#search").val();
                                       
                                         d.status = $("#status").val();
                                        
                                         d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                                    } 
                    }
                });
                
                  $('#ambulance_cityId,#status').change( function() {
                        oTable.draw();
                  } );
                     $('#search').on('keyup', function() {
                         oTable.columns( 5 ).search($(this).val()).draw();
                  } );
                
            });
     $("#savebtn").click(function(){
         $("#avatar-modal").modal('hide');
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

 
        function validationAmbulanceEdit(){
        
         var check= /^[a-zA-Z\s]+$/;
        var numcheck=/^[0-9]+$/;
      
        var cpname = $.trim($('#ambulance_cntPrsn').val());        
        var phn= $.trim($('#ambulance_phn').val());
        var myzip = $.trim($('#ambulance_zip').val());
        var cityId =$.trim($('#ambulance_cityId').val());
        var stateIds = $.trim($('#ambulance_stateId').val());
        var mobileNumber = $.trim($('#users_mobile').val());
        var ambulanceName = $('#ambulance_name').val();
        var status = 1;
    //debugger;
   
            if($('#ambulance_name').val()==''){
                $('#ambulance_name').addClass('bdr-error');
                $('#error-ambulance_name').fadeIn().delay(3000).fadeOut('slow');
               status = 0;
                 setTimeout(function(){
                    $('#ambulance_name').removeClass('bdr-error');
                 }, 3000);
            }
            
           if(!check.test(ambulanceName)){
                 $('#ambulance_name').addClass('bdr-error');
                $('#error-ambulance_name').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
                  setTimeout(function(){
                    $('#ambulance_name').removeClass('bdr-error');
                 }, 3000);
            }
            
           if($('#ambulance_type').val()==''){
                $('#ambulance_type').addClass('bdr-error');
                $('#error-ambulance_type').fadeIn().delay(3000).fadeOut('slow');
               status = 0;
                 setTimeout(function(){
                    $('#ambulance_type').removeClass('bdr-error');
                 }, 3000);
            }
            if($.trim($('#ambulance_countryId').val()) == ''){
                $('#ambulance_countryId').addClass('bdr-error');
                $('#error-ambulance_countryId').fadeIn().delay(3000).fadeOut('slow');
                status= 0;
                 setTimeout(function(){
                    $('#ambulance_countryId').removeClass('bdr-error');
                 }, 3000);
            }
           if(stateIds === ''){
               // console.log("in state");
                $('#ambulance_stateId').addClass('bdr-error');
                $('#error-ambulance_stateId').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
                setTimeout(function(){
                    $('#ambulance_stateId').removeClass('bdr-error');
                 }, 3000);
            }
            if(cityId === ''){
                $('#ambulance_cityId').addClass('bdr-error');
                $('#error-ambulance_cityId').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
                 setTimeout(function(){
                    $('#ambulance_cityId').removeClass('bdr-error');
                 }, 3000);
            }
            
             if($('#midNumber').val()==''){
                $('#midNumber').addClass('bdr-error');
                $('#error-midNumber').fadeIn().delay(3000).fadeOut('slow');
               status = 0;
                 setTimeout(function(){
                    $('#midNumber').removeClass('bdr-error');
                 }, 3000);
            }
            
            if(myzip .length < 6){
                
                $('#ambulance_zip').addClass('bdr-error');
                $('#error-ambulance_zip').fadeIn().delay(3000).fadeOut('slow');
              status = 0;
                setTimeout(function(){
                    $('#ambulance_zip').removeClass('bdr-error');
                 }, 3000);
            } 

            if($("input[name='ambulance_address']" ).val()==''){
                $('#ambulance_address').addClass('bdr-error');
                $('#error-ambulance_address').fadeIn().delay(3000).fadeOut('slow');
               status = 0;
                setTimeout(function(){
                    $('#ambulance_address').removeClass('bdr-error');
                 }, 3000);
            }
            
            
          if(!$.isNumeric(phn)){
                $('#ambulance_phn').addClass('bdr-error');
                $('#error-ambulance_phn').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
                  setTimeout(function(){
                    $('#ambulance_phn').removeClass('bdr-error');
                 }, 3000);
            }
            
            
             if(!$.isNumeric(phn) && phn == ''){
                
                $('#ambulance_phn').addClass('bdr-error');
                $('#error-ambulance_phn').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_phn').focus();
                status = 0;
            }else{
                if(phn.length != 10){
                    
                     
                $('#ambulance_phn').addClass('bdr-error');
                $('#error-ambulance_phn').fadeIn().delay(3000).fadeOut('slow'); 
                 status = 0;
                }
            }
//            if(!$.isNumeric(mobileNumber)){
//                $('#users_mobile').addClass('bdr-error');
//                $('#error-users_mobile').fadeIn().delay(3000).fadeOut('slow');
//                 setTimeout(function(){
//                    $('#users_mobile').removeClass('bdr-error');
//                 }, 3000);
//                status = 0;
//               
//            }
            
            if(!check.test(cpname)){
                $('#ambulance_cntPrsn').addClass('bdr-error');
                $('#error-ambulance_cntPrsn').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
                 setTimeout(function(){
                    $('#ambulance_cntPrsn').removeClass('bdr-error');
                 }, 3000);
            }
           
            if($('#ambulance_mmbrTyp').val()==''){
                $('#ambulance_mmbrTyp').addClass('bdr-error');
                $('#error-ambulance_mmbrTyp').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
                 setTimeout(function(){
                    $('#ambulance_mmbrTyp').removeClass('bdr-error');
                 }, 3000);
            }
        
            
              if($('#lat').val()=='' && !latChack($('#lat').val())){
                $('#lat').addClass('bdr-error');
                $('#error-lat').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){
                    $('#lat').removeClass('bdr-error');
                 }, 3000);
               status = 0;
             }
            
              if($('#lng').val()=='' && !lngChack($('#lng').val())){
                $('#lng').addClass('bdr-error');
                $('#error-lng').fadeIn().delay(3000).fadeOut('slow');
                setTimeout(function(){
                    $('#lng').removeClass('bdr-error');
                 }, 3000);
               status = 0;
             }
             
             if(!lngChack($('#lng').val())){
                $('#lng').addClass('bdr-error');
                $('#error-lng').fadeIn().delay(3000).fadeOut('slow');
                  setTimeout(function(){
                    $('#lng').removeClass('bdr-error');
                 }, 3000);
                  status = 0;
             }
             if(!latChack($('#lat').val())){
                 $('#lat').addClass('bdr-error');
                 $('#error-lat').fadeIn().delay(3000).fadeOut('slow');
                  setTimeout(function(){
                    $('#lat').removeClass('bdr-error');
                 }, 3000);
               status = 0;
             }
             
              if($('#ambulance_docatId').val()==''){
                $('#ambulance_docatId').addClass('bdr-error');
                $('#error-ambulance_docatId').fadeIn().delay(3000).fadeOut('slow');
                  setTimeout(function(){
                    $('#ambulance_docatId').removeClass('bdr-error');
                 }, 3000);
               status = 0;
            }
            
            if(status == 1){
              $("form[name='ambulanceDetail']").submit();
              return true;
            }
            return false;
       
//            
//            if(status == 1)
//            {
//                $("form[name='ambulanceDetail']").submit();
//            }    
//            else
//            {
//                return false;
//            }
            
        }
        
       
       function checkNumber(id){
           
            var phone = $.trim($('#'+'ambulance_phn'+id).val());
            if(!($.isNumeric(phone))){
                //alert(id);
             $('#'+'ambulance_phn'+id).addClass('bdr-error');
         }
        }
        
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

  function createCSV(){
         var stateId = '';
         var cityId = '';
         stateId = $('#ambulance_stateId').val();
         cityId = $('#ambulance_cityId').val();
         $.ajax({
              url : urls + 'index.php/ambulance/createCSV',
              type: 'POST',
             data: {'ambulance_stateId' : stateId ,'ambulance_cityId': cityId },
             success:function(datas){
                console.log(datas)
             }
          });
     } 
     
    function changebackgroundImage(id){
           $.ajax({
            url: urls + 'index.php/ambulance/getBackgroundImage/'+id, // Url to which the request is send
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
            url: urls + 'index.php/ambulance/setBackgroundUpload/'+ambulanceId, // Url to which the request is send
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
                      changebackgroundImage(ambulanceId);
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
              url : urls + 'index.php/ambulance/checkFileUploadValidation',
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

    function latChack(str){
          
            
               var filter = /^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{6,7}$/;
                if(str!==''){
                    if (!filter.test(str)){
                        
                         //$('#lat').addClass('bdr-error');
                        $('#error-lat').fadeIn().delay(3000).fadeOut('slow');
                        return false;

                    }else{
                            //$('#lng').removeClass('bdr-error');
                        return true;
                    }
            }
            
        }
        
         function lngChack(str){
          
            
               var filter = /^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{6,14}$/;
                if(str!==''){
                    if (!filter.test(str)){
                        
                         //$('#lat').addClass('bdr-error');
                         $('#error-lng').fadeIn().delay(3000).fadeOut('slow');
                        return false;

                    }else{
                            //$('#lng').removeClass('bdr-error');
                        return true;
                    }
            }
            
        }
</script>
<script>
 $(document).ready(function () {

        $("#submitForm").validate({
           

            rules: {
                ambulance_name: {
                    required: true,
                    lettersonly: true
                },
                ambulanceType:{
                    required: true,
                },
                ambulance_countryId: {
                    required: true
                },
                stateId: {
                    required: true
                },
                cityId: {
                    required: true
                },
                ambulance_zip: {
                    required: true,
                    number: true,
                    minlength:6,
                    maxlength:6
                },
                ambulance_address: {
                    required: true
                },
                lat: {
                    required: true,
                },
                lng: {
                    required: true
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
                    url:  urls + 'index.php/bloodbank/isEmailRegister',
                    type: "post",
                    data: {
                            email: function(){ return $("#users_email").val(); },
                            id: function(){ return $("#users_id").val(); },
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
                ambulance_name: {
                    required: "Please enter ambulance name",
                },
                ambulanceType:{
                    required:"Please select ambulance type."
                },
            
                 ambulance_countryId: {
                    required: "Please select city",
                },
                cityId: {
                    required: "Please select country",
                },
                stateId: {
                    required: "Please select state",
                },
                ambulance_zip: {
                    required: "Please enter zip",

                },
                ambulance_address: {
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

    </script>

</body>

</html> 