$('#date-1').datepicker();

$('#date-2').datepicker();



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