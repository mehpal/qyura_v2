<style type="text/css">
    #healthcategory_datatable_filter
    {
        display:none;
    }
    
</style>

<link href="<?php echo base_url(); ?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

<link href="<?php echo base_url(); ?>assets/cropper/cropper.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/cropper/main.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js">
</script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url(); ?>assets/vendor/timepicker/bootstrap-timepicker.js"></script>



<script src="<?php echo base_url(); ?>assets/vendor/select2/select2.min.js" type="text/javascript"></script>


<script src="<?php echo base_url(); ?>assets/cropper/cropper.js"></script>

<script src="<?php echo base_url(); ?>assets/js/common_js.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>


<?php $current = $this->router->fetch_method();
if ($current == 'detailHealthtip'):
    ?>
    <script src="<?php echo base_url(); ?>assets/cropper/common_cropper.js"></script>
<?php else: ?>
    <script src="<?php echo base_url(); ?>assets/cropper/main.js"></script>
<?php endif; ?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script onkeypress="" onkeydown="" type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/x-editable/jquery.xeditable.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>
<?php
$check = 0;
if (isset($healthtipId) && !empty($healthtipId)) {
    $check = $healthtipId;
}
?>
<script>
    
    var urls = "<?php echo base_url() ?>";
    var healthtipid = "<?php echo $check ?>";
           
    //$('#date-3').datepicker();
    /*$('.selectpicker').selectpicker({
     style: 'btn-default',
     size: "auto",
     width: "100%"
     });*/

    $("#edit").click(function () {
        $("#detail").toggle();
        $("#editdetail").toggle();
    });
    
   
    $(function () {
        var removeLink = '<a class="remove" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false"> <i class="fa fa-minus-circle fa-2x m-t-5 label-plus"></i></a>';
       // $('a.add').relCopy({append: removeLink});

    });
    var urls = "<?php echo base_url() ?>";
    var j = 1;

    $(document).ready(function (e) {

        var oTable = $('#healthcategory_datatable').DataTable({
            "processing": true,
            "bServerSide": true,
           
            // "searching": true,
            "bLengthChange": false,
            "bProcessing": true,
            "iDisplayLength": 10,
            "bPaginate": true,
            "sPaginationType": "full_numbers",
            "columns": [
                {"data": "category_name"},
                {"data": "view","orderable":false},
                {"data": "status","orderable":false},
            ],
            "columnDefs": [{
                    "targets": [0],
                    "orderable": false
                }],
           
            
            "ajax": {
                "url": "<?php echo site_url('healthcategory/getHealthtipDl'); ?>",
                "type": "POST",
                "data": function (d) {
                    
                    d.category_name = $("#search").val();
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                }
            }
        });

        $('#search').on('keyup', function () {
            oTable.columns(0).search($(this).val()).draw();
        });
    });

    $("#savebtn").click(function () {
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


    function validationCategory() {

        var status = 1;
       
        if ($.trim($('#health_category').val()) === '') {

            $('#health_category').addClass('bdr-error');
            $('#error-health_category').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
        }
        
        if (status == 1)
        {
            $("form[name='submitForm']").submit();
            return false;
        }
        else
        {
            return false;
        }




    }


   
    function validationCategoryEdit() {
         var status = 1;
       
        if ($.trim($('#health_category').val()) === '') {

            $('#health_category').addClass('bdr-error');
            $('#error-health_category').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
        }
        
        if (status == 1)
        {
            $("form[name='healthtipDetail']").submit();
        }
        else
        {
            return false;
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

    function createCSV() {
        var stateId = '';
        var cityId = '';
        stateId = $('#ambulance_stateId').val();
        cityId = $('#ambulance_cityId').val();
        $.ajax({
            url: urls + 'index.php/ambulance/createCSV',
            type: 'POST',
            data: {'ambulance_stateId': stateId, 'ambulance_cityId': cityId},
            success: function (datas) {
                console.log(datas)
            }
        });
    }

    function changebackgroundImage(id) {
        $.ajax({
            url: urls + 'index.php/ambulance/getBackgroundImage/' + id, // Url to which the request is send
            type: "POST",
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {
                $('.bg-picture').css("background-image", "url(" + data + ")");
            }

        });

    }

    $(document).ready(function (e) {

        $("#uploadimage").on('submit', (function (e) {
            e.preventDefault();
            $("#messageErrors").empty();
            $('#loading').show();
            $.ajax({
                url: urls + 'index.php/healthtip/setBackgroundUpload/' + healthtipid, // Url to which the request is send
                type: "POST", // Type of request to be send, called as method
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function (data)   // A function to be called if request succeeds
                {
                    var obj = jQuery.parseJSON(data);
                    if (obj.status == 200) {
                        $("#messageErrors").html("<div class='alert alert-success'>" + obj.messsage + "</div>");
                        changebackgroundImage(healthtipid);
                        $("#changeBg").modal('hide');

                    } else {
                        $("#messageErrors").html("<div class='alert alert-danger'>" + obj.messsage + "</div>");
                    }

                }
            });
        }));
// Function to preview image after validation


        $("#uploadBtnDd").change(function () {

            $("#messageErrors").empty(); // To remove the previous error message
            var file = this.files[0];
            var imagefile = file.type;
            var match = ["image/jpeg", "image/png", "image/jpg"];
            if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
            {
                $('#previewing').attr('src', 'noimage.png');
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
            $("#file").css("color", "green");
            $('#image_preview').css("display", "block");
            $('#previewing').attr('src', e.target.result);
            $('#previewing').attr('width', '500px');
            $('#previewing').attr('height', '230px');
        }
    });
</script>
<script>
//healthtip starts
    var urls = "<?php echo base_url() ?>";
    $(document).ready(function () {
    $("#submitForm").validate({
        rules: {
            health_category: {
                required: true
            }
        },
        messages: {
            health_category: {
                required: "Please enter the name of category!",
            }
           
        }

    });

    
});
    //healthtip ends.
</script>
</body>

</html> 
