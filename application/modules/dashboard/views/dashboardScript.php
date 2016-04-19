<script src="<?php echo base_url(); ?>assets/dashboardchart/Chart.js/Chart.min.js"></script>

<!-- dashboard  -->
<script src="<?php echo base_url(); ?>assets/dashboardchart/jquery.dashboard.js"></script>
<script>
    
        var initTable1 = function () {
        var table = $('#monthorderDataTable');
        var oTable = table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing Entries _START_ to _END_ of _TOTAL_ ",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "Show Entries _MENU_ ",
                "search": "Search:",
                "zeroRecords": "No matching records found"
            },
            "order": [
                [0, 'asc']
            ],
            "lengthMenu": [
                [5, 10, 20, -1],
                [5, 10, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,
            dom: "<'row hide' <'col-md-4'l> <'col-md-4'T><'col-md-4'f>><'clear'><'row pull-right'<'col-md-4'f>>rtip",
            responsive: true,
            "bProcessing": true,
            "iDisplayLength": 50,
        });

        var tableWrapper = $('#todayAppointmentDataTable_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
    }
    
    initTable1();
            function appBookedChart()
            {
                    url = '<?php echo site_url('dashboard/bookOrderChart'); ?>';
                    $.ajax({
                    url: url,
                            type: 'POST',
                            beforeSend: function (xhr) {
                            $("#loader").show().delay(2000).fadeOut();
                            },
                            success: function (data) {

                            // chart(data);
                            respChart($("#bar"), 'Bar', data)
                            }
                    });
            }

    appBookedChart();
            function respChart(selector, type, data, options) {
            console.log(data);
                    var data = $.parseJSON(data);
                    //var data= JSON.parse(data);
                    // get selector by context
                    var ctx = selector.get(0).getContext("2d");
                    // pointing parent container to make chart js inherit its width
                    var container = $(selector).parent();
                    // enable resizing matter
                    $(window).resize(generateChart);
                    // this function produce the responsive Chart JS
                            function generateChart() {
                            // make chart width fit with its container
                            var ww = selector.attr('width', $(container).width());
                                    switch (type) {
                            case 'Pie':
                                    new Chart(ctx).Pie(data, options);
                                    break;
                                    case 'Bar':
                                    new Chart(ctx).Bar(data, options);
                                    break;
                                    break;
                            }
                            // Initiate new chart or Redraw

                            }
                    ;
                            // run function - render chart at first load
                            generateChart();
                    }
                    
                    
                    

           
</script>





