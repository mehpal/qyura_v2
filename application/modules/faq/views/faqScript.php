<script src="<?php echo base_url(); ?>assets/js/reCopy.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/select2/select2.min.js" type="text/javascript"></script>
<script>
    $(function(){
        var removeLink = ' <a class="remove danger" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false">remove</a>';
      $('a.add').relCopy({ append: removeLink});	
    });
    
    $(document).ready(function (){
        $("#faqAddForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/faq/saveFaq/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
    });
    
    $(document).ready(function (){
        $("#faqEditForm").submit(function (event) {
            event.preventDefault();
            var url = '<?php echo site_url(); ?>/faq/editFaq/';
            var formData = new FormData(this);
            submitData(url,formData);
        });
    });
</script>
<script> 
       $(document).ready(function () {
        var url = "<?php echo base_url();?>";
        $("#faqAddForm").validate({
           

            rules: {
              
                "faq_question[]": {
                    required: true
                },
                "faq_answer[]": {
                    required: true
                },
            },
            messages: {
                'faq_question[]': {
                    required: "Please enter Question",
                },
                  'faq_answer[]': {
                    required: "Please enter Answer",
                },     
            },

        });

    });
    
</script>

<script> 
       $(document).ready(function () {
        var url = "<?php echo base_url();?>";
        $("#faqEditForm").validate({
           

            rules: {
              
                'faq_question[]': {
                    required: true
                },
                'faq_answer[]': {
                    required: true
                },
            },
            messages: {
                'faq_question[]': {
                    required: "Please enter Question",
                },
                  'faq_answer[]': {
                    required: "Please enter Answer",
                },     
            },

        });

    });
    
</script>
