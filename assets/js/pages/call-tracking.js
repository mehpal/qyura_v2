 $('#date-4').datepicker();

 $('#date-3').datepicker();

 /*-- Selectpicker --*/
 $('.selectpicker').selectpicker({
     style: 'btn-default',
     size: "auto",
     width: "100%"
 });

 $('.pickDate').datepicker()
      .on('changeDate', function (ev) {
          $('.pickDate').datepicker('hide');
      });



 /* -- Call Distribution Chart -- */

 google.load('visualization', '1', {
     packages: ['corechart']
 });
 google.setOnLoadCallback(drawChartCallDistribution);

 function drawChartCallDistribution() {

     var data = new google.visualization.DataTable();
     data.addColumn('string', 'Pizza');
     data.addColumn('number', 'Populartiy');
     data.addRows([
        ['Hospital', 45],
        ['Diagonestic Center', 23],
        ['Blood Bank', 10],
        ['Ambulance', 10],
        ['Pharmacies', 15]
      ]);

     var options = {
         colors: ['#40CDB2', '#F7F3E6', '#ACBCE8', '#BCBCBC', '#FEB777'],
         backgroundColor: 'transparent',
         //                chartArea:{left:20,top:0,width:'90%',height:'90%'},
         pieSliceText: 'percentage',
         pieSliceTextStyle: {
             color: 'black',
         },
         chartArea: {
             left: 20,
             top: 10,
             width: '100%',
             height: '100%'
         },
         pointSize: 30,
         pointShape: 'square',
         legend: {
             textStyle: {
                 color: 'gray'
             },
         },
         sliceVisibilityThreshold: .09
     };

     var chart = new google.visualization.PieChart(document.getElementById('chart_call_distribution'));
     chart.draw(data, options);
 };

 /* -- Call Status Chart -- */

 google.load('visualization', '1', {
     packages: ['corechart']
 });
 google.setOnLoadCallback(drawChart1);

 function drawChart1() {

     var data = new google.visualization.DataTable();
     data.addColumn('string', 'Pizza');
     data.addColumn('number', 'Populartiy');
     data.addRows([
        ['Unanswered', 45],
        ['Unheared', 23],
        ['Answered', 32]
      ]);

     var options = {
         colors: ['#41CDB2', '#F7F3E7', '#FEB777'],
         backgroundColor: 'transparent',
         chartArea: {
             left: 20,
             top: 10,
             width: '100%',
             height: '100%'
         },
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

     var chart = new google.visualization.PieChart(document.getElementById('chart_div_sec'));
     chart.draw(data, options);
 }

 /*-- Bar Chart --*/
 ! function ($) {
     "use strict";

     var ChartJs = function () {};

     ChartJs.prototype.respChart = function respChart(selector, type, data, options) {
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
                 case 'Line':
                     new Chart(ctx).Line(data, options);
                     break;
                 case 'Doughnut':
                     new Chart(ctx).Doughnut(data, options);
                     break;
                 case 'Pie':
                     new Chart(ctx).Pie(data, options);
                     break;
                 case 'Bar':
                     new Chart(ctx).Bar(data, options);
                     break;
                 case 'Radar':
                     new Chart(ctx).Radar(data, options);
                     break;
                 case 'PolarArea':
                     new Chart(ctx).PolarArea(data, options);
                     break;
                 }
                 // Initiate new chart or Redraw

             };
             // run function - render chart at first load
             generateChart();
         },
         //init
         ChartJs.prototype.init = function () {

             //barchart
             var data3 = {
                 labels: ["January", "February", "March", "April", "May", "June", "July"],
                 datasets: [
                     {
                         fillColor: "#6F8CD8",
                         strokeColor: "#6F8CD8",
                         data: [65, 59, 90, 81, 56, 55, 40]
                        }
                    ]
             }
             this.respChart($("#call-status"), 'Bar', data3);


         },
         $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs

 }(window.jQuery),

 //initializing 
 function ($) {
     "use strict";
     $.ChartJs.init()
 }(window.jQuery);