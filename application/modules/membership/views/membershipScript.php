<script src="<?php echo base_url() ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script>
    //Mi Type
    $(document).ready(function (){
        $("#membershipAddForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/membership/membershipSave/';
            var formData = new FormData(this);
            submitData(url,formData);
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
            $("#paidAmount").html('00');
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
    var resizefunc = [];
</script>