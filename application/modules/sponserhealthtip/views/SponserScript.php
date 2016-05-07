<style type="text/css">

    #loading{
        width: 100%;
        position: absolute;
        top: 100px;
        left: 100px;
        margin-top:200px;
    }
    .sponser-health aside {
        height:175px;
    }

    .ui-datepicker-inline{
        width:60em!important;
    }
    .ui-datepicker-calendar{
        font-size: 20px!important;
    }
</style>
<style type="text/css">
    #BookSponser_datatable_filter
    {
        display:none;
    }
</style>
<link href="<?php echo base_url(); ?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script  src="<?php echo base_url(); ?>assets/js/multidatepicker/js/jquery-ui-1.11.1.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/multidatepicker/jquery-ui.multidatespicker.js" type="text/javascript" ></script>
<script src="<?php echo base_url(); ?>assets/vendor/select2/select2.min.js" type="text/javascript"></script> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/multidatepicker/css/mdp.css">
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.min.js"></script>

<?php
$check = 0;
if (isset($healthtipId) && !empty($healthtipId)) {
    $check = $healthtipId;
}
?>
<script type="text/javascript">
    $(function () {
        $(".select2").select2({
            width: '100%'
        });
    });
    $('#sdate').datepicker();
    $("#sponserdate-div").hide();

    var urls = "<?php echo base_url() ?>";

    function loading_show() {
        $('#loading').html("<img src='images/loading.gif'/>").fadeIn('fast');
    }
    function loading_hide() {
        $('#loading').fadeOut('fast');
    }
    $(document).ready(function () {
        loadData(1);  // For first time page load default results

    });


//Detail Page
    function loadData(page)
    {

        loading_show();
        var src_cat = $("#src_cat").val();
        $.ajax
                ({
                    type: "POST",
                    url: "<?php echo site_url('sponserhealthtip/getHealthtipDl/'); ?>",
                    data: "page=" + page + "&src_cat=" + src_cat,
                    success: function (msg)
                    {

                        loading_hide();
                        $("#sponserdiv").html(msg);
                    }
                });
    }
    function loadme(page)
    {
        loadData(page);

    }

    //Sponser Detail
    function showSponserdates(sdate)
    {
        var status = 1;
        if ($.trim($('#sponser_stateId').val()) === '') {

            $('#sponser_stateId').addClass('bdr-error');
            $('#error-stateId').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
        }
        if ($.trim($('#sponser_cityId').val()) === '') {

            $('#sponser_cityId').addClass('bdr-error');
            $('#error-cityId').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
        }
        /*if ($.trim($('#centerType').val()) === '') {
         
         $('#centerType').addClass('bdr-error');
         $('#error-centerType').fadeIn().delay(3000).fadeOut('slow');
         status = 0;
         }*/
        if ($.trim($('#mi_centre').val()) === '') {

            $('#mi_centre').addClass('bdr-error');
            $('#error-mi_centre').fadeIn().delay(3000).fadeOut('slow');
            status = 0;
        }

        if (status == 1)
        {
            var htipid = $("#HtipId").val();
            var city_id = $("#sponser_cityId").val();
            //var centerType = $("#centerType").val();
            var mi_centre = $("#mi_centre").val();
            $.ajax
                    ({
                        type: "POST",
                        url: "<?php echo site_url('sponserhealthtip/fetchsponsorlimit'); ?>",
                        data: "mi_centre=" + mi_centre,
                        beforeSend: function (xhr) {
                            qyuraLoader.startLoader();
                        },
                        success: function (msg)
                        {
                            if (msg == 1)
                            {
                                alert("No Limit Set For this MI");
                            } else if (msg == 0)
                            {
                                alert("Exceeding Sponsor Limit");
                            } else if (msg)
                            {
                                var arr = msg.split("|");
                                var dur = arr[0];
                                var startdate = arr[1];
                                var enddate = arr[2];

                                var t2 = new Date(enddate).getTime();
                                var t1 = new Date().getTime();

                                var daydiff = parseInt((t2 - t1) / (24 * 3600 * 1000));
                                $.ajax
                                        ({
                                            type: "POST",
                                            url: "<?php echo site_url('sponserhealthtip/fetchsponserdates/'); ?>",
                                            data: "city_id=" + city_id + "&mi_centre=" + mi_centre + "&htipid=" + htipid,
                                            success: function (msg)
                                            {

                                                $('#sponser-dates').multiDatesPicker('resetDates', 'disabled');
                                                $("#bookdates").val("");
                                                var arr = msg.split(",");
                                                var arrstr = "";


                                                for (var i = 0; i < arr.length; i++)
                                                {
                                                    /*if (arrstr)
                                                     arrstr = arrstr+"," + new Date(arr[i]).getTime();
                                                     else
                                                     arrstr = new Date(arr[i]).getTime();*/

                                                    $('#sponser-dates').multiDatesPicker({
                                                        addDisabledDates: [new Date(arr[i]).getTime()],
                                                        altField: '#bookdates',
                                                        minDate: 0,
                                                        maxDate: daydiff,
                                                        numberOfMonths: 2,
                                                        mode: 'daysRange',
                                                        autoselectRange: [0, dur],
                                                    });
                                                }
                                                $("#sponserdate-div").show();
                                                $("#sponserdetail-div").hide();
                                                $("#healthtipdetaildiv").hide();
                                                $("#backdiv").attr("href", "javascript:backtrace();");

                                            }
                                        });
                            }
                             qyuraLoader.stopLoader();
                        }
                    });
            return false;
        } else
        {
            return false;
        }

    }
    function backtrace()
    {
        $("#sponserdate-div").hide();
        $("#sponserdetail-div").show();
        $("#healthtipdetaildiv").show();
        $("#backdiv").attr("href", "<?php echo site_url() ?>/sponserhealthtip");
    }

    function bookSponserdates()
    {
        if ($.trim($('#bookdates').val()) === '') {
            $('#error-bookdates').fadeIn().delay(3000).fadeOut('slow');
        } else
        {
            $("#submitForm").submit();
        }
    }

    function fetchCity(stateId) {

        $.ajax({
            url: urls + 'index.php/sponserhealthtip/fetchCity',
            type: 'POST',
            data: {'stateId': stateId},
            success: function (datas) {
                $('#sponser_cityId').html(datas);
                $('#sponser_cityId').selectpicker('refresh');
            }
        });
    }
    function getMI(option) {
        var city_id = $("#sponser_city").val();
        var mi_type = $("#centerType").val();
        var url = '<?php echo site_url(); ?>/sponserhealthtip/getMI';
        $.ajax({
            url: url,
            async: false,
            type: 'POST',
            data: {'city_id': city_id, 'mi_type': mi_type},
            beforeSend: function (xhr) {
                $("#mi_centre").addClass('loadinggif');
            },
            success: function (data) {
                console.log(data);
                $('#mi_centre').html(data);
                $('#mi_centre').selectpicker('refresh');
            }
        });
    }
    $(document).ready(function (e) {

        var oTable = $('#BookSponser_datatable').DataTable({
            "processing": true,
            "bServerSide": true,
            "bLengthChange": false,
            "bProcessing": true,
            "iDisplayLength": 10,
            "bPaginate": true,
            "sPaginationType": "full_numbers",
            "columns": [
                {"data": "miname"},
                {"data": "mitype"},
                {"data": "sponsor_date"},
                {"data": "city_name"},
                {"data": "category_name"},
                {"data": "view", "orderable": false},
            ],
            "columnDefs": [{
                    "targets": [0, 1, 2, 3, 4, 5],
                    "orderable": false
                }],
            "ajax": {
                "url": "<?php echo site_url('sponserhealthtip/getBookedSponserDl'); ?>",
                "type": "POST",
                "data": function (d) {
                    d.search_val = $("#search").val();
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                }
            }
        });
        $('#search').on('keyup', function () {
            oTable.columns(4).search($(this).val()).draw();
        });
    });
    function createCSV() {

        var search = $('#search').val();
        $.ajax({
            url: urls + 'index.php/sponserhealthtip/createCSV',
            type: 'POST',
            data: {'search': search},
            success: function (datas) {
                console.log(datas)
            }
        });
    }
    function deleteBookedSponsor(sponsorid)
    {
        $.ajax({
            url: urls + 'index.php/sponserhealthtip/deleteBookedSponsor/' + sponsorid,
            type: 'POST',
            success: function (datas) {
                if (datas == 1)
                {
                    $('#BookSponser_datatable').DataTable().ajax.reload();
                    alert("Sponsor Deleted");
                } else
                {
                    alert("Heathtip Sponsor date passed ! Could not be deleted !");
                }
            }
        });
    }
</script>
</body>
</html> 
