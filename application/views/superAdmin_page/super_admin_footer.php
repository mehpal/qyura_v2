<footer class="footer text-right">
    2016 © Qyura.
</footer>
</div>
<!-- End Right content here -->
</div>
<!-- END wrapper -->
<script>
    var resizefunc = [];

</script>
<script src="<?php echo base_url(); ?>assets/jquery-1.8.2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/framework.js"></script>

<!--     <script type= 'text/javascript' src="<?php echo base_url(); ?>assets/js/jquery.dataTables.js"></script>-->
<script src="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/bootbox/bootbox.min.js"></script>
<!--     <script type= 'text/javascript' src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>-->
<?php
$msg = $this->session->flashdata('message') || $this->session->flashdata('valid_upload') || $this->session->flashdata('error');
if ($msg != "" || $msg != NULL) {
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            bootbox.alert("<?php echo $msg; ?>");
        });
    </script>
    <?php }
?>
<script>

    $('#search').bind('keypress', function (e)
    {
        if (e.keyCode == 13)
        {
            return false;
        }
    });
</script>       
<script>
    
    var qyuraLoader = {
        startLoader:function()
        {
            $('.page-loader').show();
        },
        stopLoader:function ()
        {
            $('.page-loader').fadeOut('slow');
        }
    };
    
    //Submit Data for add and edit for all
    function removeError(obj)
    {
        var id = obj.id;
        $('#' + id).removeClass('error');
    }
    function submitData(url, formData) {
        var formData = formData;

        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: formData, //only input
            processData: false,
            contentType: false,
            xhr: function ()
            {
                $("#load_consulting").show();
                var xhr = new window.XMLHttpRequest();
                //Upload progress
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        $('#addLoad .progress-bar').css('width', percentComplete + '%');
                    }
                }, false);
                //Download progress
                xhr.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                    }
                }, false);
                return xhr;
            },
            success: function (response, textStatus, jqXHR) {
                try {
                    $("#load_consulting").hide();

                    var data = $.parseJSON(response);
                    if (data.status == 0)
                    {
                        if (data.isAlive)
                        {
                            $('#addLoad .progress-bar').css('width', '00%');
                            console.log(data.errors);
                            $.each(data.errors, function (index, value) {
                                if (typeof data.custom == 'undefined') {
                                    $('#err_' + index).html(value);
                                }
                                else
                                {
                                    $('#err_' + index).addClass('error');

                                    if (index == 'TopError')
                                    {
                                        $('#er_' + index).html(value);
                                    }
                                    else {
                                        $('#er_TopError').append('<p>' + value + '</p>');
                                    }
                                }

                            });
                            $('#er_TopError').show();
                            $('#er_TopError').html(data.errors.TopError);
                            setTimeout(function () {
                                $('#er_TopError').hide(5000);
                                $('#er_TopError').html('');
                            }, 5000);
                        }
                        else
                        {
                            $('#headLogin').html(data.loginMod);
                        }
                    } else {
//                        document.getElementById("setData").reset();
                        $('#myModal').modal('hide');
                        $('#successTop').show();
                        $('#successTop').html(data.msg);
                        if (data.msg != '' && data.msg != "undefined") {
                            alert(data.msg);
                        } else {
                            alert("Success");
                        }
                        setTimeout(function () {
                            $('#successTop').hide();
                            $('#successTop').html('');
                            if (data.url) {
                                window.location.href = '<?php echo site_url() ?>' + '/' + data.url;
                            } else {
                                location.reload(true);
                            }
                        }, 1000);
                    }
                } catch (e) {
                    $('#er_TopError').show();
                    $('#er_TopError').html(e);
                    setTimeout(function () {
                        $('#er_TopError').hide(5000);
                        $('#er_TopError').html('');
                    }, 5000);
                }
            }
        });
    }

    //Load Custom delete View for all
    function deleteFn(controller, cfunction, id)
    {
        var url = '<?php echo site_url(); ?>/' + controller + '/' + cfunction;
        bootbox.confirm("Do you want to delete it?", function (result) {
            if (result)
            {
                $.ajax({
                    type: 'post',
                    data: {'id': id},
                    url: url,
                    async: false,
                    success: function (data) {
                        if (data)
                        {
                            location.reload(true);
                        }
                    }
                });
            }
        });
    }

//Load Custom enable View for all
    function enableFn(controller, cfunction, id, status)
    {
        if (status == 1)
            var con_mess = "Desable";
        else
            con_mess = "Enable";
        var url = '<?php echo site_url(); ?>/' + controller + '/' + cfunction;
        bootbox.confirm('Do you want to ' + con_mess.toLowerCase() + ' it?', function (result) {
            if (result) {
                $.ajax({
                    type: 'post',
                    data: {'id': id, 'status': status},
                    url: url,
                    async: false,
                    success: function (data) {
                        if (data)
                        {
                            location.reload(true);
                        }
                    }
                });
            }
        });
    }
    
    $(window).load(function() {
	$(".page-loader").fadeOut("slow");
    });
    
    
    //change status enable or disable funciton for all
    function statusFn(controller, table_name, table_field_name, table_field_value, status_value)
    {
        if (status_value == 1)
            var con_mess = "Inactive";
        else
            con_mess = "Active";
        var url = '<?php echo site_url();?>/'+controller+'/status';

        bootbox.confirm('Do you want to ' + con_mess.toLowerCase() + ' it?', function (result) {
            if (result) {
                $.ajax({
                    type: 'post',
                    data: {'table_field_name': table_field_name, 'status': status_value, 'table': table_name, 'field_value': table_field_value},
                    url: url,
                    success: function (response) {
                        if (response) {
                           // bootbox.alert("Successfully update records.");
                            location.reload(true);
                        }else{
                           // bootbox.alert("Failed to update records."); 
                            location.reload(true);
                        }
                    }
                });
            }
        });
        
    }
</script>

