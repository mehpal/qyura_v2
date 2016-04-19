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
<!-- <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>-->
<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>
<!--<script src="https://maps.googleapis.com/maps/api/js"></script>-->
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
        icon: '<?php echo base_url();?>/assets/images/pins/q2.png'
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
    var ambulanceId = "<?php echo $check?>";
    $('#date-3').datepicker();
    
    $('.selectpicker').selectpicker({
    style: 'btn-default',
    size: "auto",
    width: "100%"
   });

    $("#edit").click(function () {
    $("#detail").toggle();
    $("#editdetail").toggle();
    });
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
        var phn= $.trim($('#ambulance_phn1').val());
        var myzip = $.trim($('#ambulance_zip').val());
        var cityId =$.trim($('#ambulance_cityId').val());
        var stateIds = $.trim($('#StateId').val());
        var mobileNumber = $.trim($('#users_mobile').val());
        var status =1;
    //debugger;
   
            if($('#ambulance_name').val()==''){
                $('#ambulance_name').addClass('bdr-error');
                $('#error-ambulance_name').fadeIn().delay(3000).fadeOut('slow');
               status = 0;
               // $('#hospital_name').focus();
            }
           if($('#ambulance_type').val()==''){
                $('#ambulance_type').addClass('bdr-error');
                $('#error-ambulance_type').fadeIn().delay(3000).fadeOut('slow');
               status = 0;
               // $('#hospital_type').focus();
            }
            if($.trim($('#ambulance_countryId').val()) == ''){
                $('#ambulance_countryId').addClass('bdr-error');
                $('#error-ambulance_countryId').fadeIn().delay(3000).fadeOut('slow');
                //status= 0;
               // $('#hospital_countryId').focus();
            }
           if(stateIds){
               // console.log("in state");
                $('#ambulance_stateId').addClass('bdr-error');
                $('#error-ambulance_stateId').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
               // $('#hospital_stateId').focus();
            }
            if(!$.isNumeric(cityId)){
                $('#ambulance_cityId').addClass('bdr-error');
                $('#error-ambulance_cityId').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
               // $('#hospital_cityId').focus();
            }
           
            if(!$.isNumeric(myzip)){
                
                $('#ambulance_zip').addClass('bdr-error');
                $('#error-ambulance_zip').fadeIn().delay(3000).fadeOut('slow');
              status = 0;
                // $('#hospital_zip').focus();
            } 

            if($("input[name='ambulance_address']" ).val()==''){
                $('#ambulance_address').addClass('bdr-error');
                $('#error-ambulance_address').fadeIn().delay(3000).fadeOut('slow');
               status = 0;
               // $('#hospital_address').focus();
            }
            
            
            if(!$.isNumeric(phn)){
                $('#ambulance_phn1').addClass('bdr-error');
                $('#error-ambulance_phn1').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
                // $('#hospital_phn').focus();
            }
            if(!$.isNumeric(mobileNumber)){
                $('#users_mobile').addClass('bdr-error');
                $('#error-users_mobile').fadeIn().delay(3000).fadeOut('slow');
                // $('#hospital_phn').focus();
                status = 0;
            }
            if(!check.test(cpname)){
                $('#ambulance_cntPrsn').addClass('bdr-error');
                $('#error-ambulance_cntPrsn').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
                // $('#hospital_cntPrsn').focus();
            }
           
            if($('#ambulance_mmbrTyp').val()==''){
                $('#ambulance_mmbrTyp').addClass('bdr-error');
                $('#error-ambulance_mmbrTyp').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
               // $('#hospital_mmbrType').focus();
            }
            if($('#users_email').val()==''){
                $('#users_email').addClass('bdr-error');
                $('#error-users_email').fadeIn().delay(3000).fadeOut('slow');
               // $('#users_email').focus();
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
              else {
                        $('#users_email').addClass('bdr-error');
                    $('#error-users_email_check').fadeIn().delay(3000).fadeOut('slow');;
                   return false;
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
                        {"data": "view"},
                    ],
                    
                    "ajax": {
                        "url": "<?php echo site_url('ambulance/getAmbulanceDl'); ?>",
                        "type": "POST", 
                        "data": function ( d ) {
                                         d.cityId = $("#ambulance_cityId").val();
                                         d.bloodBank_name = $("#search").val();
                                         if($("#ambulance_stateId").val() != ' '){
                                         d.hosStateId = $("#ambulance_stateId").val();
                                        }
                                         d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                                    } 
                    }
                });
                
                  $('#ambulance_cityId,#ambulance_stateId').change( function() {
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
        
       //$("form[name='ambulanceDetail']").submit();
        var check= /^[a-zA-Z\s]+$/;
        var numcheck=/^[0-9]+$/;
        var users_mobile = $.trim($('#users_mobile').val());
        var cpname = $.trim($('#ambulance_cntPrsn').val());
        var status = 1;
       
            if($.trim($('#ambulance_name').val()) === ''){
                $('#ambulance_name').addClass('bdr-error');
                  $('#error-ambulance_name').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
          
            if($.trim($('#geocomplete').val()) === ''){
               $("#geocomplete").addClass('bdr-error');
                 $('#error-ambulance_address').fadeIn().delay(3000).fadeOut('slow');
               status = 0;
            }
             if(!($.isNumeric(users_mobile))){
                //alert(id);
             $('#users_mobile').addClass('bdr-error');
               $('#error-users_mobile').fadeIn().delay(3000).fadeOut('slow');
             status = 0;
            }
             if(!check.test(cpname)){
                $('#ambulance_cntPrsn').addClass('bdr-error');
                $('#error-ambulance_cntPrsn').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
            
            if(status == 1)
            {
                $("form[name='ambulanceDetail']").submit();
            }    
            else
            {
                return false;
            }
                
         
            
            
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
                      changebackgroundImage(ambulanceId);
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

</script>

</body>

</html> 