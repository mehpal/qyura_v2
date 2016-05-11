<script>
    $(document).ready(function () {
        $('.timepicker').timepicker({showMeridian: true});
        $(".select2").select2({
            width: '100%'
        });

        $("#timeEditForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/diagnostic/editDocTime/';
            var formData = new FormData(this);
            submitData(url, formData);
        });


        $("#selectAllDay").click(function () {
            if ($("#selectAllDay").is(':checked')) {
                $("#docTimeDay_day > option").prop("selected", "selected");
                $("#docTimeDay_day").trigger("change");
            } else {
                $("#docTimeDay_day > option").removeAttr("selected");
                $("#docTimeDay_day").trigger("change");
            }
        });

        $('#timeEditForm :input').on('change', function () {
            var name = $(this).attr('name');
            var isInIT = name.indexOf("[]");
            if (isInIT == -1) {
                console.log(name, 'if');
                $('#err_' + name).html('');
            }
            else {
                name = name.replace('[]', '');
                $('#err_' + name).html('');
            }
        });

    });



    
</script>