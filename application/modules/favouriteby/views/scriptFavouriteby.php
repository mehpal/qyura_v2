
<link href="<?php echo base_url(); ?>assets/images/fevicon-m.ico" rel="shortcut icon">
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<![endif]-->
<script src="<?php echo base_url(); ?>assets/js/modernizr.min.js"></script>


<script>
    var resizefunc = [];
</script>

<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js">
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jsapi.js">
</script>
<!-- Chart JS -->
<script src="<?php echo base_url(); ?>assets/vendor/chart.js/chart.min.js">
</script>
<script src="<?php echo base_url(); ?>assets/js/pages/favouriteby.js" type="text/javascript">
</script>

<script src="<?php echo base_url(); ?>assets/js/pages/favouriteby.js" type="text/javascript">
</script>
    
<script src="<?php echo base_url(); ?>assets/vendor/select2/select2.min.js" type="text/javascript"></script>  

<script>
  $("#mi_cityId").select2();
   var urls = "<?php echo base_url() ?>";

    
  $(document).ready(function () {   
    var oTableFav = $('#favTable').DataTable({
            "processing": true,
            "serverSide": true,
            "columnDefs": [{
                    "targets": [4],
                    "orderable": false
                }],
            "pageLength": 10,
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "dom": '<<t><"clearfix m-t-20 p-b-20" p>',
            "iDisplayStart ": 20,
            "columns": [
                {"data": "miType"},
                {"data": "miName"},
                {"data": "city"},
                {"data": "userName"},
                {"data": "userType"},
            ],
            "ajax": {
                "url": "<?php echo site_url('favouriteby/getFavbyDl'); ?>",
                "type": "POST",
                "async": false,
                "data": function (d) {
                    d.cityId = $("#mi_cityId").val();
                    //d.name = $("#search").val();
                     d.mi = $("#mi").val();
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                },
                 beforeSend: function () {
                   // setting a timeout
                    $('#load_consulting').show();
                },
                complete: function ()
                {
                   $('#load_consulting').hide('200');
                },
            }
        });

        $('#mi_cityId').change(function () {
            oTableFav.draw();
        });
       
        $('#mi').on('keyup', function () {
            oTableFav.draw();
        });
        
    });
    
 function createCSV(){
         var mi = '';
         var mi_cityId = '';
         mi = $('#mi').val();
         mi_cityId = $('#mi_cityId').val();
         $.ajax({
              url : urls + 'index.php/favouriteby/createCSV',
              type: 'POST',
             data: {'mi' : mi ,'mi_cityId': mi_cityId },
             success:function(datas){
                console.log(datas)
             }
          });
     } 
     
</script>   