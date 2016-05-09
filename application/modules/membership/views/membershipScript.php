<script src="<?php echo base_url() ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendor/select2/select2.min.js" type="text/javascript"></script>
<script>

    //Mi Type
    $(document).ready(function (){
        $("#membershipAddForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/membership/membershipSave/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
        var urls = "<?php echo base_url() ?>";
    
    $("#membershipAddForm").validate({
        rules: {
            'membership_type[]': {
                required: true
            },
            membership_name: {
                required : true
            },
            membership_price: {
                required : true
            },
            membership_tax: {
                required : true
            }
        },
        messages: {
            'membership_type[]': {
                required: "Please select a membership type!",
            },
            membership_name: {
                required : "Please enter the name of membership!"
            },
            membership_price: {
                required : "Please enter a price!"
            },
            membership_tax: {
                required : "Please enter tax percent!"
            }
           
        }

    });
    });
    
    $(document).ready(function (){
        $("#membershipEditForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/membership/membershipEdit/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
    });

    function calculateamount() {
    
        //var type = $('#input5').val();
        var amount = 0;
        var amount = parseInt($('#membership_price').val());
        
        var tax = parseInt($('#membership_tax').val());
        var tax_amount = (amount / 100) * tax;
        var total_amount = amount + tax_amount;

        if (total_amount) {
            $("#paidAmount").html(total_amount);
            $("#membership_totalPrice").val(total_amount);
        } else {
            if(amount){
                $("#paidAmount").html(amount);
                $("#membership_totalPrice").val(amount);
            }else{
                $("#paidAmount").html('00');
            }
        }
    }
    function isNumberKey(evt, id) {
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57)) {
$("#" + id).html("Please enter number key");
return false;
} else {
$("#" + id).html('');
return true;
}
}
</script>
<script>
    $(".membership-btn").click(function () {
        $(".membership-plan").toggle();
        $(".newmembership").toggle();
    });
     $(".membership-btn2").click(function () {
        $(".membership-plan2").toggle();
        $(".newmembership2").toggle();
    });
     $(".membership-btn3").click(function () {
        $(".membership-plan3").toggle();
        $(".newmembership3").toggle();
    });
     $(".membership-btn4").click(function () {
        $(".membership-plan4").toggle();
        $(".newmembership4").toggle();
    });
     $(".membership-btn5").click(function () {
        $(".membership-plan5").toggle();
        $(".newmembership5").toggle();
    });
     $(".membership-btn6").click(function () {
        $(".membership-plan6").toggle();
        $(".newmembership6").toggle();
    });
     $('.select2').select2().change(function(){
    $(this).valid()
    });
    var resizefunc = [];
</script>
