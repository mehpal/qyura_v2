$('#date-3').datepicker();

$('.selectpicker').selectpicker({
    style: 'btn-default',
    size: "auto",
    width: "100%"
});

$("#bloodbank").click(function () {
    if($(this).is(':checked')){
     bootbox.confirm("Do you outsource the blood?", function(result) {
        if (result) {
            $('#isBloodBankOutsource').val(1);
            $("#bloodbankOption").fadeIn();
        }else{
            $("#bloodbankOption").fadeOut();
            $('#isBloodBankOutsource').val(0);
        }
      });
    }else{
        $("#bloodbankOption").fadeOut();
        $('#isBloodBankOutsource').val(0);
    }
});

$("#pharmacy").click(function () {
    $("#pharmacyOption").fadeToggle();
});

$("#ambulance").click(function () {
    $("#ambulanceOption").fadeToggle();
});