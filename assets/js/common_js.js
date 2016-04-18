    var _URL = window.URL || window.webkitURL;
    $("#avatarInput").change(function (e) {
    var file, img;
    if ((file = this.files[0])) {
        img = new Image();
        img.onload = function () {
            //console.log(file);
            var w = this.width;
            var h = this.height;
            //alert(w + " " + h);
            if(w < 150 && h < 150){
              // console.log('error'); 
                $("#message_upload").html("<div class='alert alert-danger'>Height and Width must exceed 150px.</div>");
                $("#savebtn").attr("disabled", true);
                $("#avatar-save-btn").attr("disabled", true);
                $(".close").hide();
//                $("#avatar-modal").modal({
//                    backdrop: 'static',
//                    keyboard: false
//                });
                return false;
            }else{
               // console.log('yes');
                $("#message_upload").html("");
                $("#savebtn").attr("disabled", false);
                $("#avatar-save-btn").attr("disabled", false);
                $(".close").show();
                return true;
            }
        };
        img.src = _URL.createObjectURL(file);
    }
   });