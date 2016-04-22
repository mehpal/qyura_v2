  $('#date-1').datepicker(

  );
  $('#date-2').datepicker(

  );
  $('#date-3').datepicker(

  );

  $('.pickDate').datepicker()
      .on('changeDate', function (ev) {
          $('.pickDate').datepicker('hide');
      });

  $('.selectpicker').selectpicker({
      style: 'btn-default',
      size: "auto",
      width: "100%"
  });