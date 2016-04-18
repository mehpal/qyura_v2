<style type="text/css">
    #datatable_cms_filter
    {
        display:none;
    }
    .error p
    {
        color:#EF5350;
    }
</style>

<link href="<?php echo base_url(); ?>assets/summernote/dist/summernote.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/summernote/dist/summernote.min.js"></script>
<link href="<?php echo base_url();?>assets/cropper/cropper.min.css" rel="stylesheet">
<!--<link href="<?php echo base_url();?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />-->
<link href="<?php echo base_url();?>assets/cropper/main.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/cropper/cropper.js"></script>
<?php $current = $this->router->fetch_method();
if($current == 'detailBloodBank'):?>
<script src="<?php echo base_url(); ?>assets/cropper/common_cropper.js"></script>
<?php else:?>
<script src="<?php echo base_url(); ?>assets/cropper/main.js"></script>
<?php endif;?>


<script>
     
      /**
     * @method datatable
     * @description get records in listing using datatables
     */
    $(document).ready(function () {
        var oTable = $('#datatable_cms').DataTable({
            "processing": true,
            "bServerSide": true,
            "columnDefs": [{
                    "targets": [0,1,2],
                    "orderable": false
                }],
            "bLengthChange": false,
            "bProcessing": true,
            "iDisplayLength": 10,
            "bPaginate": true,
            "sPaginationType": "full_numbers",
            "sAjaxSource": "<?php echo site_url('cms/getcmsdetail'); ?>",
           
             "columns": [
                {"data": "cms_title"},
                {"data": "cms_description"},
                {"data": "view" ,"searchable": false, "order": false},
            ],
        });
       
    });
  
   function validationCms(){
       
       var RegExpression = /^[a-zA-Z\s]+$/;
       var status=1;
       
             if($('#cms_title').val()==''){
                $('#cms_title').addClass('bdr-error');
                $('#error-cms_title').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
            else if($('.summernote').val()==''){
                $('.summernote').addClass('bdr-error');
                $('#error-cms_description').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
                
            }else if(!RegExpression.test($('#cms_title').val())){
                $('#cms_title').addClass('bdr-error');
                $('#error-cms_title').fadeIn().delay(3000).fadeOut('slow');
                status = 0;
            }
            if(status == 1){
                return true;
            }
            return false; 
        }
    
</script>
<script>
  
     $(document).ready(function(){
               // $('.wysihtml5').wysihtml5();

                $('.summernote').summernote({
                    height: 300,                 // set editor height

                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor

                    focus: true                 // set focus to editable area after initializing summernote
                });

            });
   
    </script>

   