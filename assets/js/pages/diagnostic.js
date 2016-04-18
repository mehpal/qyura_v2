/* -- Easy Pie Chart -- */

$('#consulation').data('easyPieChart').options.barColor = '#40CCB1';
$('#consulation').data('easyPieChart').options.width = '130px';
$('#diagnostic').data('easyPieChart').options.barColor = '#FEB777';


/*-- Date Picker  --*/
$('#date-1').datepicker();

$('#date-2').datepicker();


/*-- Pie Chart --*/

google.load('visualization', '1', {
    packages: ['corechart']
});
google.setOnLoadCallback(drawChart2);

function drawChart2() {

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Pizza');
    data.addColumn('number', 'Populartiy');
    data.addRows([
        ['Consulation', 35],
        ['Diagnostic', 65]
      ]);

    var options = {
        backgroundColor: 'transparent',
        colors: ['#41CDB2', '#F7F3E7'],
        pieSliceText: 'percentage',
        pieSliceTextStyle: {
            color: 'black',
        },
        legend: {
            textStyle: {
                color: 'gray'
            },
        },
        sliceVisibilityThreshold: .2
    };

    var chart = new google.visualization.PieChart(document.getElementById('chart_appoint_detail'));
    chart.draw(data, options);
}

/* -- Revenue Generation Chart --*/
Morris.Bar({
    element: 'revenue_trend',
    data: [
        {
            y: 'Jan',
            a: 6.0
                },
        {
            y: 'Feb',
            a: 2.0
                },
        {
            y: 'Mar',
            a: 4.0
                },
        {
            y: 'Apr',
            a: 3.0
                },
        {
            y: 'May',
            a: 5.0
                }
  ],
    xkey: 'y',
    ykeys: ['a'],
    barColors: ['#6F8CD8'],
    labels: ['Months']
});