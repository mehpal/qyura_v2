<link href="<?php echo base_url(); ?>assets/vendor/dashboard/reset.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/framework.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/custom-g.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/custom-r.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/responsive-r.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/vendor/js-scroll/style/scroll-2.css" rel="stylesheet" />

<script src="<?php echo base_url(); ?>assets/vendor/dashboard/respond.min.js"></script>

<script src="<?php echo base_url(); ?>assets/vendor/raphael/raphael-min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/morris.js/morris.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jsapi.js"></script>
<!-- Chart JS -->
<script src="<?php echo base_url(); ?>assets/vendor/chart.js/chart.min.js"></script>
<!-- EASY PIE CHART JS -->
<script src="<?php echo base_url(); ?>assets/vendor/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/easy-pie-chart.init.js"></script>

<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<!-- Canvas Charts -->
<script src="<?php echo base_url(); ?>assets/js/pages/dashboard.js" type="text/javascript"></script>
<!--  js-scroll -->
<script src="<?php echo base_url(); ?>assets/vendor/js-scroll/script/scroll-2.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/select2/select2.min.js" type="text/javascript"></script> 
<script>
    var urls = "<?php echo base_url();?>";
    function deleteNotice(id) {

        bootbox.confirm("Do you want to delete it?", function (result) {
            if (result)
            {
                $.ajax({
                    url: urls + 'index.php/sadashboard/deleteNotification',
                    type: 'POST',
                    data: {'id': id},
                    success: function (response) {
                        if (response) {
                            bootbox.alert('Successfully delete notification.');
                            loadNotification();
                        } else {
                            bootbox.alert('Failed to delete notification');
                        }

                    }

                });
            }

        });
    }
    
    function loadNotification(){
         
         $('#loadNotice').load(urls + 'index.php/sadashboard/getNotificatoin/',function () {
        });
    }
    
        function doctorOftheMonthByCity(city){  

                 $.ajax({
                     url: urls + 'index.php/sadashboard/doctorOftheMonth',
                     type: 'POST',
                     data: {'city': city},
                     success: function (response) {
                         $("#doctorOftheMonthDiv").html(response);
                     }

                 });
          }
    
   $(document).ready(function() {
   
    var jobCount = $('#list .in').length;
    $('.list-count').text(jobCount + ' items');
    $("#search-text").keyup(function () {
    //$(this).addClass('hidden');
        var searchTerm = $("#search-text").val();
        var listItem = $('#list').children('td');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
          //extends :contains to be case insensitive
        $.extend($.expr[':'], {
        'containsi': function(elem, i, match, array)
        {
        return (elem.textContent || elem.innerText || '').toLowerCase()
        .indexOf((match[3] || "").toLowerCase()) >= 0;
        }
        });
        $("#list tr").not(":containsi('" + searchSplit + "')").each(function(e)   {
          $(this).addClass('hiding out').removeClass('in');
          setTimeout(function() {
              $('.out').addClass('hidden');
            }, 300);
        });

        $("#list tr:containsi('" + searchSplit + "')").each(function(e) {
          $(this).removeClass('hidden out').addClass('in');
          setTimeout(function() {
              $('.in').removeClass('hiding');
            }, 1);
        });
          var jobCount = $('#list .in').length;
        $('.list-count').text(jobCount + ' items');
        //shows empty state text when no jobs found
        if(jobCount == '0') {
          $('#list').addClass('empty');
        }
        else {
          $('#list').removeClass('empty');
        }
    }); 
    
        var jobCount = $('#hospitalList .in').length;
        $('.list-count').text(jobCount + ' items');
        $("#search-city").change(function () {
    //$(this).addClass('hidden');
        var searchTerm = $("#search-city").val();
        var listItem = $('#hospitalList').children('td');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
          //extends :contains to be case insensitive
        $.extend($.expr[':'], {
        'containsi': function(elem, i, match, array)
        {
        return (elem.textContent || elem.innerText || '').toLowerCase()
        .indexOf((match[3] || "").toLowerCase()) >= 0;
        }
        });
        $("#hospitalList tr").not(":containsi('" + searchSplit + "')").each(function(e)   {
          $(this).addClass('hiding out').removeClass('in');
          setTimeout(function() {
              $('.out').addClass('hidden');
            }, 300);
        });

        $("#hospitalList tr:containsi('" + searchSplit + "')").each(function(e) {
          $(this).removeClass('hidden out').addClass('in');
          setTimeout(function() {
              $('.in').removeClass('hiding');
            }, 1);
        });
          var jobCount = $('#hospitalList .in').length;
        $('.list-count').text(jobCount + ' items');
        //shows empty state text when no jobs found
        if(jobCount == '0') {
          $('#hospitalList').addClass('empty');
        }
        else {
          $('#hospitalList').removeClass('empty');
        }
    }); 
    
     var jobCount = $('#app_consult .in').length;
    $('.list-count').text(jobCount + ' items');
    $("#search-text-appointment").keyup(function () {
    //$(this).addClass('hidden');
        var searchTerm = $("#search-text-appointment").val();
        var listItem = $('.app_consult').children('td');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
          //extends :contains to be case insensitive
        $.extend($.expr[':'], {
        'containsi': function(elem, i, match, array)
        {
        return (elem.textContent || elem.innerText || '').toLowerCase()
        .indexOf((match[3] || "").toLowerCase()) >= 0;
        }
        });
        $(".app_consult tr").not(":containsi('" + searchSplit + "')").each(function(e)   {
          $(this).addClass('hiding out').removeClass('in');
          setTimeout(function() {
              $('.out').addClass('hidden');
            }, 300);
        });

        $(".app_consult tr:containsi('" + searchSplit + "')").each(function(e) {
          $(this).removeClass('hidden out').addClass('in');
          setTimeout(function() {
              $('.in').removeClass('hiding');
            }, 1);
        });
          var jobCount = $('.app_consult .in').length;
        $('.list-count').text(jobCount + ' items');
        //shows empty state text when no jobs found
        if(jobCount == '0') {
          $('.app_consult').addClass('empty');
        }
        else {
          $('.app_consult').removeClass('empty');
        }
    }); 
    
   
     
    
    });
</script>