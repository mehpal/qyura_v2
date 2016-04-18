/*diagnostic list*/



$(document).ready(function() {

  var jobCount = $('#list .in').length;
  $('.list-count').text(jobCount + ' items');
    
  
  $("#search-text").keyup(function () {
     //$(this).addClass('hidden');
  
    var searchTerm = $("#search-text").val();
    var listItem = $('#list').children('li');

  
    
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
      //extends :contains to be case insensitive
  $.extend($.expr[':'], {
  'containsi': function(elem, i, match, array)
  {
    return (elem.textContent || elem.innerText || '').toLowerCase()
    .indexOf((match[3] || "").toLowerCase()) >= 0;
  }
});
    
    
    $("#list li").not(":containsi('" + searchSplit + "')").each(function(e)   {
      $(this).addClass('hiding out').removeClass('in');
      setTimeout(function() {
          $('.out').addClass('hidden');
        }, 300);
    });
    
    $("#list li:containsi('" + searchSplit + "')").each(function(e) {
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

  
                  
    
  
                    
});



$(document).ready(function() {

  var jobCount = $('#list1 .in').length;
  $('.list-count').text(jobCount + ' items');
    
  
  $("#search-text1").keyup(function () {
     //$(this).addClass('hidden');
  
    var searchTerm = $("#search-text1").val();
    var listItem = $('#list1').children('li');

  
    
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
      //extends :contains to be case insensitive
  $.extend($.expr[':'], {
  'containsi': function(elem, i, match, array)
  {
    return (elem.textContent || elem.innerText || '').toLowerCase()
    .indexOf((match[3] || "").toLowerCase()) >= 0;
  }
});
    
    
    $("#list1 li").not(":containsi('" + searchSplit + "')").each(function(e)   {
      $(this).addClass('hiding out').removeClass('in');
      setTimeout(function() {
          $('.out').addClass('hidden');
        }, 300);
    });
    
    $("#list1 li:containsi('" + searchSplit + "')").each(function(e) {
      $(this).removeClass('hidden out').addClass('in');
      setTimeout(function() {
          $('.in').removeClass('hiding');
        }, 1);
    });
    
  
      var jobCount = $('#list1 .in').length;
    $('.list-count').text(jobCount + ' items');
    
    //shows empty state text when no jobs found
    if(jobCount == '0') {
      $('#list1').addClass('empty');
    }
    else {
      $('#list1').removeClass('empty');
    }
    
  });

  
                  
    
  
                    
});







/*specialities list*/

$(document).ready(function() {

  var jobCount = $('#list2 .in').length;
  $('.list-count').text(jobCount + ' items');
    
  
  $("#search-text2").keyup(function () {
     //$(this).addClass('hidden');
  
    var searchTerm = $("#search-text2").val();
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


$(document).ready(function() {

  var jobCount = $('#list3 .in').length;
  $('.list-count').text(jobCount + ' items');
    
  
  $("#search-text3").keyup(function () {
     //$(this).addClass('hidden');
  
    var searchTerm = $("#search-text3").val();
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
    
  
      var jobCount = $('#list3 .in').length;
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

$("#edit").click(function () {
 $("#detail").toggle();
    $("#newDetail").toggle();
});
$("#editdetail").click(function () {
    $("#detail").toggle();
    $("#newDetail").toggle();
});

$("#editcompany").click(function () {
    $("#detailcompany").toggle();
    $("#newcompany").toggle();
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

$("#pharmacybtn").click(function () {
    $("#pharmacydetail").fadeToggle();
});

$("#bloodbankbtn").click(function () {
    $("#bloodbankdetail").fadeToggle();
});

/* -- Upload Button -- */

document.getElementById("uploadBtn").onchange = function () {
    document.getElementById("uploadFile").value = this.value;
};

document.getElementById("uploadBtnBg").onchange = function () {
    document.getElementById("uploadFileBg").value = this.value;
};

document.getElementById("uploadBtnBb").onchange = function () {
    document.getElementById("uploadFileBb").value = this.value;
};

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


/* activate the carousel */
$("#modal-carousel").carousel({
    interval: false
});

/* change modal title when slide changes */
$("#modal-carousel").on("slid.bs.carousel", function () {
    $(".modal-title").html($(this).find(".active img").attr("title"));
})


