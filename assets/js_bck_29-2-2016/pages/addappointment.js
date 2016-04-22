$('#date-3').datepicker();
$('.pickDate').datepicker()
    .on('changeDate', function (ev) {
        $('.pickDate').datepicker('hide');
    });

function changeForm(id) {
    if (id == 1) {
        $("#diagnoDiv").show();
        $("#consultDiv").hide();
        $('.selectpicker').selectpicker('refresh');
    } else {
        $("#consultDiv").show();
        $("#diagnoDiv").hide();
        $('.selectpicker').selectpicker('deselectAll');
        $('.selectpicker').val('');
        $('.selectpicker').selectpicker('refresh');
    }
}