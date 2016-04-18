   /*-- Bar Chart --*/ ! function ($) {
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
               this.respChart($("#revenue_trend"), 'Bar', data3);


           },
           $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs

   }(window.jQuery),

   //initializing 
   function ($) {
       "use strict";
       $.ChartJs.init()
   }(window.jQuery);

   /*-- Date Picker --*/
   $('#date-1').datepicker();

   $('#date-2').datepicker();
   $('.pickDate').datepicker()
       .on('changeDate', function (ev) {
           $('.pickDate').datepicker('hide');
       });

 /*-- Selectpicker --*/
$('.selectpicker').selectpicker({
    style: 'btn-default',
    size: "auto",
    width: "100%"
});


   /*-- Appointment Chart (Pie Chart) --*/

   google.load('visualization', '1', {
       packages: ['corechart']
   });
   google.setOnLoadCallback(drawChart2);

   function drawChart2() {

       var data = new google.visualization.DataTable();
       data.addColumn('string', 'Pizza');
       data.addColumn('number', 'Populartiy');
       data.addRows([
        ['Consultation', 35],
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




   /*-- Easy Pie Chart --*/
   $('#consulation').data('easyPieChart').options.barColor = '#40CCB1';
   $('#consulation').data('easyPieChart').options.width = '130px';
   $('#diagnostic').data('easyPieChart').options.barColor = '#FEB777';

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
               this.respChart($("#revenue_trend"), 'Bar', data3);


           },
           $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs

   }(window.jQuery),

   //initializing 
   function ($) {
       "use strict";
       $.ChartJs.init()
   }(window.jQuery);