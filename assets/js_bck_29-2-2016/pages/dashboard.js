/* -- Small Donut Chart --*/
Morris.Donut({
    element: 'donut-chart',
    colors: ['#FEB777', '#FF4D4E', '#6E8CD7'],
    data: [
        {
            label: "Diagnostic",
            value: 13.7
        },
        {
            label: "Health Packages",
            value: 45.3
        }
  ]
});



/* -- Pie Chart (MI Signup Distribution) -- */

google.load('visualization', '1', {
    packages: ['corechart']
});
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
        colors: ['#41CDB2', '#F7F3E7', '#ABBCE8', '#BCBCBC', '#FEB777'],
        chartArea: {
            left: 20,
            top: 20,
            width: '100%',
            height: '100%'
        },
        pieSliceTextStyle: {
            color: 'black',
        },
        sliceVisibilityThreshold: .09
    };

    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}


/* -- Pie Chart (Revenue Distribution) -- */

google.load('visualization', '1', {
    packages: ['corechart']
});
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
        chartArea: {
            left: 20,
            top: 20,
            width: '100%',
            height: '100%'
        },
        pieSliceTextStyle: {
            color: 'black',
        },
        legend: {
            textStyle: {
                color: 'gray'
            }
        },
        sliceVisibilityThreshold: .2
    };

    var chart = new google.visualization.PieChart(document.getElementById('chart_div_sec'));
    chart.draw(data, options);
}


/* -- Pie Chart (Use Transition Flow) -- */

google.load('visualization', '1', {
    packages: ['corechart']
});
google.setOnLoadCallback(drawChartTransFlow);

function drawChartTransFlow() {

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Pizza');
    data.addColumn('number', 'Populartiy');
    data.addRows([
        ['Minimum 1 Transaction', 45],
        ['No Transaction', 55]
      ]);

    var options = {
        colors: ['#41CDB2', '#F7F3E7'],
        chartArea: {
            left: 20,
            top: 20,
            width: '100%',
            height: '100%'
        },
        pieSliceTextStyle: {
            color: 'black',
        },
        legend: {
            textStyle: {
                color: 'gray'
            }
        },
        sliceVisibilityThreshold: .2
    };

    var chart = new google.visualization.PieChart(document.getElementById('chart_trans_flow'));
    chart.draw(data, options);
}

/* --  Bar Chart --*/

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
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                datasets: [
                    {
                        label: "Consultation",
                        fillColor: "#6E8CD7",
                        strokeColor: "#6E8CD7",
                        pointColor: "#6E8CD7",
                        data: [65, 59, 90, 81, 56, 55, 40, 90, 82, 44, 75, 10]
                        },
                    {
                        label: "Diagnostic",
                        fillColor: "#BCBCBC",
                        strokeColor: "#BCBCBC",
                        pointColor: "#BCBCBC",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        data: [45, 59, 70, 81, 30, 55, 40, 32, 30, 45, 32, 30]
                        }
                ]
            }
            this.respChart($("#bar-chart"), 'Bar', data3);

            //single-bar
            var data4 = {
                labels: ["January", "February", "March", "April", "May", "June"],
                datasets: [
                    {
                        label: "Consultation",
                        fillColor: "#46BFBD",
                        strokeColor: "#46BFBD",
                        data: [65, 59, 90, 81, 56, 55]
                        }
                ]
            }
            this.respChart($("#single-bar"), 'Bar', data4);

            //creating lineChart
            var data = {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                datasets: [
                    {
                        label: "Consultation",
                        fillColor: "transparent",
                        strokeColor: "#FF6060",
                        pointColor: "#FF6060",
                        pointStrokeColor: "#FF6060",
                        data: [90, 82, 44, 75, 50, 73, 55, 44, 75, 50, 33, 46]
                },

                    {
                        label: "Diagnostic",
                        fillColor: "transparent",
                        strokeColor: "#FEB777",
                        pointColor: "#FEB777",
                        pointStrokeColor: "#FEB777",
                        data: [15, 75, 40, 65, 32, 30, 45, 40, 65, 32, 30, 45]
                }

            ]
            };

            this.respChart($("#lineChart"), 'Line', data);




        },
        $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs

}(window.jQuery),

//initializing 
function ($) {
    "use strict";
    $.ChartJs.init()
}(window.jQuery);