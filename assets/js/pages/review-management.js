  $('#date-1').datepicker();

  $('#date-2').datepicker();

  $('.pickDate').datepicker()
      .on('changeDate', function (ev) {
          $('.pickDate').datepicker('hide');
      });

  /*-- Switch --*/
  $('.toggle').toggles({
      drag: false,
      on: true,
      text: {
          on: "Year",
          off: "Mon"
      }

  });


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
        ['Unanswered', 35],
        ['Answered', 65]
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

      var chart = new google.visualization.PieChart(document.getElementById('chart_review_detail'));
      chart.draw(data, options);
  }