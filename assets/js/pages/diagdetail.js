

/*diagnostic list*/



$(document).ready(function() {

  var jobCount = $('#list3 .in').length;
  $('.list-count').text(jobCount + ' items');
    
  
  $("#search-text").keyup(function () {
     //$(this).addClass('hidden');
  
    var searchTerm = $("#search-text").val();
    var listItem = $('#list3').children('li');

  
    
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
      //extends :contains to be case insensitive
  $.extend($.expr[':'], {
  'containsi': function(elem, i, match, array)
  {
    return (elem.textContent || elem.innerText || '').toLowerCase()
    .indexOf((match[3] || "").toLowerCase()) >= 0;
  }
});
    
    
    $("#list3 li").not(":containsi('" + searchSplit + "')").each(function(e)   {
      $(this).addClass('hiding out').removeClass('in');
      setTimeout(function() {
          $('.out').addClass('hidden');
        }, 300);
    });
    
    $("#list3 li:containsi('" + searchSplit + "')").each(function(e) {
      $(this).removeClass('hidden out').addClass('in');
      setTimeout(function() {
          $('.in').removeClass('hiding');
        }, 1);
    });
    
  
      var jobCount = $('#list .in').length;
    $('.list-count').text(jobCount + ' items');
    
    //shows empty state text when no jobs found
    if(jobCount == '0') {
      $('#list3').addClass('empty');
    }
    else {
      $('#list3').removeClass('empty');
    }
    
  });

  
                  
    
  
                    
});



$(document).ready(function() {

  var jobCount = $('#list2 .in').length;
  $('.list-count').text(jobCount + ' items');
    
  
  $("#search-text1").keyup(function () {
     //$(this).addClass('hidden');
  
    var searchTerm = $("#search-text1").val();
    var listItem = $('#list2').children('li');

  
    
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
      //extends :contains to be case insensitive
  $.extend($.expr[':'], {
  'containsi': function(elem, i, match, array)
  {
    return (elem.textContent || elem.innerText || '').toLowerCase()
    .indexOf((match[3] || "").toLowerCase()) >= 0;
  }
});
    
    
    $("#list2 li").not(":containsi('" + searchSplit + "')").each(function(e)   {
      $(this).addClass('hiding out').removeClass('in');
      setTimeout(function() {
          $('.out').addClass('hidden');
        }, 300);
    });
    
    $("#list2 li:containsi('" + searchSplit + "')").each(function(e) {
      $(this).removeClass('hidden out').addClass('in');
      setTimeout(function() {
          $('.in').removeClass('hiding');
        }, 1);
    });
    
  
      var jobCount = $('#list2 .in').length;
    $('.list-count').text(jobCount + ' items');
    
    //shows empty state text when no jobs found
    if(jobCount == '0') {
      $('#list2').addClass('empty');
    }
    else {
      $('#list2').removeClass('empty');
    }
    
  });

  
                  
    
  
                    
});







/*specialities list*/

$(document).ready(function() {

  var jobCount = $('#list4 .in').length;
  $('.list-count').text(jobCount + ' items');
    
  
  $("#search-text2").keyup(function () {
     //$(this).addClass('hidden');
  
    var searchTerm = $("#search-text2").val();
    var listItem = $('#list4').children('li');

  
    
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
      //extends :contains to be case insensitive
  $.extend($.expr[':'], {
  'containsi': function(elem, i, match, array)
  {
    return (elem.textContent || elem.innerText || '').toLowerCase()
    .indexOf((match[3] || "").toLowerCase()) >= 0;
  }
});
    
    
    $("#list4 li").not(":containsi('" + searchSplit + "')").each(function(e)   {
      $(this).addClass('hiding out').removeClass('in');
      setTimeout(function() {
          $('.out').addClass('hidden');
        }, 300);
    });
    
    $("#list4 li:containsi('" + searchSplit + "')").each(function(e) {
      $(this).removeClass('hidden out').addClass('in');
      setTimeout(function() {
          $('.in').removeClass('hiding');
        }, 1);
    });
    
  
      var jobCount = $('#list2 .in').length;
    $('.list-count').text(jobCount + ' items');
    
    //shows empty state text when no jobs found
    if(jobCount == '0') {
      $('#list4').addClass('empty');
    }
    else {
      $('#list4').removeClass('empty');
    }
    
  });

  
                  
    
  
                    
});


$(document).ready(function() {

  var jobCount = $('#list5 .in').length;
  $('.list-count').text(jobCount + ' items');
    
  
  $("#search-text3").keyup(function () {
     //$(this).addClass('hidden');
  
    var searchTerm = $("#search-text3").val();
    var listItem = $('#list5').children('li');

  
    
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
      //extends :contains to be case insensitive
  $.extend($.expr[':'], {
  'containsi': function(elem, i, match, array)
  {
    return (elem.textContent || elem.innerText || '').toLowerCase()
    .indexOf((match[3] || "").toLowerCase()) >= 0;
  }
});
    
    
    $("#list5 li").not(":containsi('" + searchSplit + "')").each(function(e)   {
      $(this).addClass('hiding out').removeClass('in');
      setTimeout(function() {
          $('.out').addClass('hidden');
        }, 300);
    });
    
    $("#list5 li:containsi('" + searchSplit + "')").each(function(e) {
      $(this).removeClass('hidden out').addClass('in');
      setTimeout(function() {
          $('.in').removeClass('hiding');
        }, 1);
    });
    
  
      var jobCount = $('#list5 .in').length;
    $('.list-count').text(jobCount + ' items');
    
    //shows empty state text when no jobs found
    if(jobCount == '0') {
      $('#list5').addClass('empty');
    }
    else {
      $('#list5').removeClass('empty');
    }
    
  });

  
                  
    
  
                    
});








$("#editdetail").click(function () {
    $("#detail").toggle();
    $("#newDetail").toggle();
});
$("#editawards").click(function () {
    $("#detailawards").toggle();
    $("#newawards").toggle();
});


$("#editservices").click(function () {
    $("#detailservices").toggle();
    $("#newservices").toggle();
});

$("#picEdit").click(function () {
    $(".logo-img").hide();
    $(".logo-up").show();
    $("#picEdit").hide();
    $("#picEditClose").show();

});

$("#picEditClose").click(function () {
    $(".logo-up").hide();
    $(".logo-img").show();
    $("#picEdit").show();
    $("#picEditClose").hide();


});

$('.selectpicker').selectpicker({
    style: 'btn-default',
    size: "auto",
    width: "100%"
});

//$('.timepicker').timepicker();

$("#allTime").click(function () {
    $("#session").fadeToggle();
});

$("#editpharma").click(function () {
    $("#detailpharma").toggle();
    $("#newpharma").toggle();
});

$("#editbbk").click(function () {
    $("#detailbbk").toggle();
    $("#newbbk").toggle();
});

$("#editac").click(function () {
    $("#detailac").toggle();
    $("#newac").toggle();
});


/* -- Upload Button -- */

//document.getElementById("uploadBtnDd").onchange = function () {
//    document.getElementById("uploadFileDd").value = this.value;
//};

/*center modal*/

$(function () {
    function reposition() {
        var modal = $(this),
            dialog = modal.find('.modal-dialog');
        modal.css('display', 'block');

        // Dividing by two centers the modal exactly, but dividing by three 
        // or four works better for larger screens.
        dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 2));
    }
    // Reposition when a modal is shown
    $('.modal').on('show.bs.modal', reposition);
    // Reposition when the window is resized
    $(window).on('resize', function () {
        $('.modal:visible').each(reposition);
    });
});

// Select2


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



$('.thumbnail').click(function () {
    $('.modal-body').empty();
    var title = $(this).parent('a').attr("title");
    $('.modal-title').html(title);
    $($(this).parents('div').html()).appendTo('.modal-body');
    $('#img-gallery').modal({
        show: true
    });
});

$("#diagnostic_aboutUs").on("keyup",function(){
   // console.log("hiiii");
    var maxLength = "255";

    var minLength = "0";

    var length = $(this).val().length;

    length = minLength + length;
    
    if(length > 255){
        $('#error-diagnostic_aboutUs').text("Maximum length for this section is 255 characters. Kindly rewrite it.");
    }else{
        $('#error-diagnostic_aboutUs').text("");
    }
//    $('#chars').text(length);
});

//$(".select2").select2({
//    width: '100%'
//});