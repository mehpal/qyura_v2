 $('#date-1').datepicker();

 $('#date-2').datepicker();
 $('.pickDate').datepicker()
     .on('changeDate', function (ev) {
         $('.pickDate').datepicker('hide');
     });