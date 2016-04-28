<script src="<?php echo base_url(); ?>assets/js/reCopy.js"></script>

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
