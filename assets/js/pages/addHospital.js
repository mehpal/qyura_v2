$('#date-3').datepicker();

$('.selectpicker').selectpicker({
    style: 'btn-default',
    size: "auto",
    width: "100%"
});


$("#pharmacy").click(function () {
    $("#pharmacyOption").fadeToggle();
});

$("#ambulance").click(function () {
    $("#ambulanceOption").fadeToggle();
});