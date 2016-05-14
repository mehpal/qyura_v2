<script src="<?php echo base_url();?>assets/js/jsapi.js"></script>
<!-- Chart JS -->
<script src="<?php echo base_url();?>assets/vendor/chart.js/chart.min.js"></script>
<!-- EASY PIE CHART JS -->
<script src="<?php echo base_url();?>assets/vendor/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
<script src="<?php echo base_url();?>assets/js/easy-pie-chart.init.js"></script>
<!-- Canvas Charts -->
<script src="<?php echo base_url();?>assets/js/pages/miDashboard_js.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/vendor/js-scroll/script/scroll-2.js"></script>





<script>
    
    
    
    
   $(document).ready(function() {
   
    var jobCount = $('#consultSearch .in').length;
    $('.list-count').text(jobCount + ' items');
    $("#text-search").keyup(function () {
    //$(this).addClass('hidden');
        var searchTerm = $("#text-search").val();
        var listItem = $('#consultSearch').children('td');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
          //extends :contains to be case insensitive
        $.extend($.expr[':'], {
        'containsi': function(elem, i, match, array)
        {
        return (elem.textContent || elem.innerText || '').toLowerCase()
        .indexOf((match[3] || "").toLowerCase()) >= 0;
        }
        });
        $("#consultSearch tr").not(":containsi('" + searchSplit + "')").each(function(e)   {
          $(this).addClass('hiding out').removeClass('in');
          setTimeout(function() {
              $('.out').addClass('hidden');
            }, 300);
        });

        $("#consultSearch tr:containsi('" + searchSplit + "')").each(function(e) {
          $(this).removeClass('hidden out').addClass('in');
          setTimeout(function() {
              $('.in').removeClass('hiding');
            }, 1);
        });
          var jobCount = $('#consultSearch .in').length;
        $('.list-count').text(jobCount + ' items');
        //shows empty state text when no jobs found
        if(jobCount == '0') {
          $('#consultSearch').addClass('empty');
        }
        else {
          $('#consultSearch').removeClass('empty');
        }
    }); 
    
        var jobCount = $('#diagnosticApp .in').length;
        $('.list-count').text(jobCount + ' items');
        $("#text-search").keyup(function () {
    //$(this).addClass('hidden');
        var searchTerm = $("#text-search").val();
        var listItem = $('#diagnosticApp').children('td');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
          //extends :contains to be case insensitive
        $.extend($.expr[':'], {
        'containsi': function(elem, i, match, array)
        {
        return (elem.textContent || elem.innerText || '').toLowerCase()
        .indexOf((match[3] || "").toLowerCase()) >= 0;
        }
        });
        $("#diagnosticApp tr").not(":containsi('" + searchSplit + "')").each(function(e)   {
          $(this).addClass('hiding out').removeClass('in');
          setTimeout(function() {
              $('.out').addClass('hidden');
            }, 300);
        });

        $("#diagnosticApp tr:containsi('" + searchSplit + "')").each(function(e) {
          $(this).removeClass('hidden out').addClass('in');
          setTimeout(function() {
              $('.in').removeClass('hiding');
            }, 1);
        });
          var jobCount = $('#diagnosticApp .in').length;
        $('.list-count').text(jobCount + ' items');
        //shows empty state text when no jobs found
        if(jobCount == '0') {
          $('#diagnosticApp').addClass('empty');
        }
        else {
          $('#diagnosticApp').removeClass('empty');
        }
    }); 
    
    
     var jobCount = $('#packages .in').length;
    $('.list-count').text(jobCount + ' items');
    $("#package-search").keyup(function () {
    //$(this).addClass('hidden');
        var searchTerm = $("#package-search").val();
        var listItem = $('#packages').children('td');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
          //extends :contains to be case insensitive
        $.extend($.expr[':'], {
        'containsi': function(elem, i, match, array)
        {
        return (elem.textContent || elem.innerText || '').toLowerCase()
        .indexOf((match[3] || "").toLowerCase()) >= 0;
        }
        });
        $("#packages tr").not(":containsi('" + searchSplit + "')").each(function(e)   {
          $(this).addClass('hiding out').removeClass('in');
          setTimeout(function() {
              $('.out').addClass('hidden');
            }, 300);
        });

        $("#packages tr:containsi('" + searchSplit + "')").each(function(e) {
          $(this).removeClass('hidden out').addClass('in');
          setTimeout(function() {
              $('.in').removeClass('hiding');
            }, 1);
        });
          var jobCount = $('.app_consult .in').length;
        $('.list-count').text(jobCount + ' items');
        //shows empty state text when no jobs found
        if(jobCount == '0') {
          $('#packages').addClass('empty');
        }
        else {
          $('#packages').removeClass('empty');
        }
    }); 
    
      var jobCount = $('#packages .in').length;
    $('.list-count').text(jobCount + ' items');
    $("#quotation-search").keyup(function () {
    //$(this).addClass('hidden');
        var searchTerm = $("#quotation-search").val();
        var listItem = $('#quotation').children('td');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
          //extends :contains to be case insensitive
        $.extend($.expr[':'], {
        'containsi': function(elem, i, match, array)
        {
        return (elem.textContent || elem.innerText || '').toLowerCase()
        .indexOf((match[3] || "").toLowerCase()) >= 0;
        }
        });
        $("#quotation tr").not(":containsi('" + searchSplit + "')").each(function(e)   {
          $(this).addClass('hiding out').removeClass('in');
          setTimeout(function() {
              $('.out').addClass('hidden');
            }, 300);
        });

        $("#quotation tr:containsi('" + searchSplit + "')").each(function(e) {
          $(this).removeClass('hidden out').addClass('in');
          setTimeout(function() {
              $('.in').removeClass('hiding');
            }, 1);
        });
          var jobCount = $('.app_consult .in').length;
        $('.list-count').text(jobCount + ' items');
        //shows empty state text when no jobs found
        if(jobCount == '0') {
          $('#quotation').addClass('empty');
        }
        else {
          $('#quotation').removeClass('empty');
        }
    });
    
      var jobCount = $('#bookingS .in').length;
    $('.list-count').text(jobCount + ' items');
    $("#medicart-search").keyup(function () {
    //$(this).addClass('hidden');
        var searchTerm = $("#medicart-search").val();
        var listItem = $('#bookingS').children('td');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
          //extends :contains to be case insensitive
        $.extend($.expr[':'], {
        'containsi': function(elem, i, match, array)
        {
        return (elem.textContent || elem.innerText || '').toLowerCase()
        .indexOf((match[3] || "").toLowerCase()) >= 0;
        }
        });
        $("#bookingS tr").not(":containsi('" + searchSplit + "')").each(function(e)   {
          $(this).addClass('hiding out').removeClass('in');
          setTimeout(function() {
              $('.out').addClass('hidden');
            }, 300);
        });

        $("#bookingS tr:containsi('" + searchSplit + "')").each(function(e) {
          $(this).removeClass('hidden out').addClass('in');
          setTimeout(function() {
              $('.in').removeClass('hiding');
            }, 1);
        });
          var jobCount = $('.app_consult .in').length;
        $('.list-count').text(jobCount + ' items');
        //shows empty state text when no jobs found
        if(jobCount == '0') {
          $('#bookingS').addClass('empty');
        }
        else {
          $('#bookingS').removeClass('empty');
        }
    });
     var jobCount = $('#contactS .in').length;
    $('.list-count').text(jobCount + ' items');
    $("#medicart-search").keyup(function () {
    //$(this).addClass('hidden');
        var searchTerm = $("#medicart-search").val();
        var listItem = $('#contactS').children('td');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
          //extends :contains to be case insensitive
        $.extend($.expr[':'], {
        'containsi': function(elem, i, match, array)
        {
        return (elem.textContent || elem.innerText || '').toLowerCase()
        .indexOf((match[3] || "").toLowerCase()) >= 0;
        }
        });
        $("#contactS tr").not(":containsi('" + searchSplit + "')").each(function(e)   {
          $(this).addClass('hiding out').removeClass('in');
          setTimeout(function() {
              $('.out').addClass('hidden');
            }, 300);
        });

        $("#contactS tr:containsi('" + searchSplit + "')").each(function(e) {
          $(this).removeClass('hidden out').addClass('in');
          setTimeout(function() {
              $('.in').removeClass('hiding');
            }, 1);
        });
          var jobCount = $('.app_consult .in').length;
        $('.list-count').text(jobCount + ' items');
        //shows empty state text when no jobs found
        if(jobCount == '0') {
          $('#contactS').addClass('empty');
        }
        else {
          $('#contactS').removeClass('empty');
        }
    });
    });
</script>