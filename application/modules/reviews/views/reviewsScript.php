<style type="text/css">
    #medicart_offer_datatable_filter
    {
        display:none;
    }
</style>
<?php $check= 0; 
if(isset($diagnosticId) && !empty($diagnosticId)){
    $check = $diagnosticId; 
}?>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>


<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/x-editable/jquery.xeditable.js"> </script> 
<script src="<?php echo base_url();?>assets/vendor/select2/select2.min.js" type="text/javascript"></script> 
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js" type="text/javascript"></script> 

<script src="<?php echo base_url();?>assets/vendor/toggles/toggles.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/pages/review-management.js" type="text/javascript"></script>
    
<script> 
     var urls = "<?php echo base_url()?>";
</script>

<script>


    
        function postComment(countId,miId,reviewId,miname){
            var status ="";
            if($("#statuscheck_"+countId).is(':checked')){
                status = $("#statuscheck_"+countId).val();
            }
            var text = $("#message_"+countId).val();
            
              $.ajax({
               url : urls + 'index.php/reviews/postComment',
               type: 'POST',
              data: {'miId' : miId, 'reviewId' : reviewId, 'comment' : text, 'status' : status},
              success:function(response){
                  
                  var obj = $.parseJSON(response);
                  if(obj.status == 200){
                      loadPost(countId,miId,reviewId,miname);  
                      $("#message_"+countId).val('');
                  }else{
                       $("#statuscheck_"+countId).addClass('bdr-error');
                       $('#error-post_'+countId).fadeIn().delay(3000).fadeOut('slow');
                  }
                 
              }
           });
           
        }
        
        
       function loadPost(countId,miId,reviewId,miname){
       
        $('#message_box_'+countId).load(urls + 'index.php/reviews/getPost/'+miId+'/'+reviewId+'/'+countId,{'miname': miname},function () {
        });
       }
      
      function postPublish(countId,miId,reviewId,miname){
          
            var status ="";
            if($("#statuscheck_"+countId).is(':checked')){
                status = $("#statuscheck_"+countId).val();
            } 
             $.ajax({
               url : urls + 'index.php/reviews/postPublish',
               type: 'POST',
              data: {'miId' : miId, 'reviewId' : reviewId, 'status' : status},
              success:function(response){
                  
                  if(response == 200){
                     $('#success-post_'+countId).fadeIn().delay(3000).fadeOut('slow'); 
                  }
              }
           });
            
      }
      
      
        function filterReviews(reviews) { 
            
          $.post(urls+'index.php/reviews/ajaxPaginationData', {'page': 0 ,'filter' : reviews}, function(data){ 
              $('#postList').html(data);
          }); 
          return false;
        }
        
        
         $('.pickDate').datepicker()
            .on('changeDate', function (ev) {
                $('.pickDate').datepicker('hide');
                     var sDate = $('#date-1').val();
                     var eDate = $('#date-2').val(); 
                     var d1 = new Date($('#date-1').val());
                     var d2 = new Date($('#date-2').val());
                     if(sDate != '' && eDate != ''){
                     if(d1.getTime() > d2.getTime()){
                        $("#date_error").html("<p>From date should be less then To date.</p>");
                        $('#date-1').val("");
                        $('#date-2').val("");
                     }else{
                           $.post(urls+'index.php/reviews/ajaxPaginationData', {'page': 0 ,'sDate' : sDate, 'eDate' : eDate},                           function(data){ 
                            $('#postList').html(data);
                         }); 
                            return false;
                         $("#date_error").html(""); 
                     }
                    } 
            });
        
        
  function createCSV(){
         var startDate = '';
         var endDate = '';
         var filterReview = '';
         
         var sDate = $('#date-1').val();
         var eDate = $('#date-2').val(); 
         var review = $("#searechReviews").val();
     
          if(sDate != '' && eDate != ''){
            startDate =  sDate;
            endDate = endDate;
          }
          if(review != ''){
            filterReview = review;
          }
     
         $.ajax({
              url : urls + 'index.php/reviews/createCSV',
              type: 'POST',
             data: {'sDate' : startDate ,'eDate': endDate, 'filter' : filterReview},
             success:function(datas){
                console.log(datas)
             }
          });
     } 
     
</script>

</body>
</html>

