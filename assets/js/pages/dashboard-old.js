/* -- Morris Bar Chart --*/

Morris.Bar({
  element: 'bar-chart',
  data: [
    { y: 'Jan', a: 100, b: 90 },
    { y: 'Feb', a: 75,  b: 65 },
    { y: 'March', a: 50,  b: 40 },
    { y: 'April', a: 75,  b: 65 },
    { y: 'May', a: 50,  b: 40 },
    { y: 'June', a: 75,  b: 65 },
    { y: 'July', a: 100, b: 90 },
    { y: 'August', a: 50,  b: 40 },
    { y: 'Sept', a: 75,  b: 65 },
    { y: 'Oct', a: 50,  b: 40 },
    { y: 'Nov', a: 75,  b: 65 },
   { y: 'Dec', a: 75,  b: 65 }

  ],
  xkey: 'y',
  ykeys: ['a', 'b'],
  barColors: ['#6E8CD7', '#BCBCBC'],
  labels: ['Consultations', 'Diagnostics']
});

/* -- Small Donut Chart --*/
Morris.Donut({
  element: 'donut-chart',
  colors: ['#FEB777', '#FF4D4E', '#6E8CD7'],
  data: [
      {label: "Diagnostic", value: 13.7},
      {label: "Health Packages", value: 45.3}
  ]
});

/* -- Single Bar Chart --*/
Morris.Bar({
  element: 'single-bar',
  data: [
    { y: 'Jan', a: 100 },
    { y: 'Feb', a: 75 },
    { y: 'Mar', a: 50 },
    { y: 'Apr', a: 75 },
    { y: 'May', a: 50 },
    { y: 'Jun', a: 75 },
  ],
  xkey: 'y',
  ykeys: ['a'],
  barColors: ['#46BFBD'],
  labels: ['Months']
});


/* -- Pie Chart (MI Signup Distribution) -- */

google.load('visualization', '1', {packages: ['corechart']});
    google.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Pizza');
      data.addColumn('number', 'Populartiy');
      data.addRows([
        ['Hospitals', 45],
        ['Ambulance', 23],
        ['Diagnostics Center', 11],
           ['Pharmacies', 11],
           ['Blood Bank', 10],
      ]);

      var options = {
//        title: 'Popularity of Types of Pizza',
          colors: ['#41CDB2', '#F7F3E7', '#ABBCE8','#BCBCBC','#FEB777'],
          chartArea:{left:20,top:20, width:'100%',height:'100%'},
          pieSliceTextStyle: {
            color: 'black',
          },
        sliceVisibilityThreshold: .09
      };

      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }


/* -- Pie Chart (Revenue Distribution) -- */
 
google.load('visualization', '1', {packages: ['corechart']});
    google.setOnLoadCallback(drawChart1);

    function drawChart1() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Pizza');
      data.addColumn('number', 'Populartiy');
      data.addRows([
        ['Membership Fee', 35],
        ['Other', 30],
          ['Commission', 35]
      ]);

      var options = {
         colors: ['#41CDB2', '#F7F3E7', '#FEB777'],
          chartArea:{left:20,top:20,width:'100%',height:'100%'},
        pieSliceTextStyle: {
            color: 'black',
          },
          legend: {textStyle: {color: 'gray'}},
        sliceVisibilityThreshold: .2
      };

      var chart = new google.visualization.PieChart(document.getElementById('chart_div_sec'));
      chart.draw(data, options);
    }


/* -- Pie Chart (Use Transition Flow) -- */

google.load('visualization', '1', {packages: ['corechart']});
    google.setOnLoadCallback(drawChartTransFlow);

    function drawChartTransFlow() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Pizza');
      data.addColumn('number', 'Populartiy');
      data.addRows([
        ['Minimum 1 Transition', 45],
        ['No Transition', 55]
      ]);

      var options = {
         colors: ['#41CDB2', '#F7F3E7'],
          chartArea:{left:20,top:20,width:'100%',height:'100%'},
        pieSliceTextStyle: {
            color: 'black',
          },
          legend: {textStyle: {color: 'gray'}},
        sliceVisibilityThreshold: .2
      };

      var chart = new google.visualization.PieChart(document.getElementById('chart_trans_flow'));
      chart.draw(data, options);
    }