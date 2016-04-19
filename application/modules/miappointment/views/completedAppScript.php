<script>
    var urls = "<?php echo site_url() ?>";
    /**
     * @method datatable
     * @description get records in listing using datatables
     */
    $(document).ready(function () {
        $('#search').change(function () {
            if ($(this).val() != '') {
                $.post(urls + '/miappointment/ajaxUploadReportsList/', {'page': 0, 'search': $(this).val()}, function (data) {
                    $('#reportList').html(data);
                });
            }
        });
        var xhrReq;
        $(".uploadfile").change(function (event) {
            event.preventDefault();
            if (ValidateSingleInput(this, '4')) {

            }
        });

        $(".uploadimage").on('submit', (function (e) {
            e.preventDefault();
            var prdoc = $(this).attr('prdoc');
            //var docid = prdoc.split('_');
            var formData = new FormData(this);
            xhrReq = $.ajax({
                url: '<?php echo site_url('miappointment/ajaxfileUpload') ?>', // Url to which the request is send
                type: "POST",
                // Type of request to be send, called as method
                data: formData, // Data sent to server, a set of key/value pairs representing form fields and values 
                contentType: false, // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
                xhr: function ()
                {
                    var xhr = new window.XMLHttpRequest();
                    //Upload progress
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            $('#' + prdoc + ' .progress-bar').css('width', percentComplete + '%');

                        }
                    }, false);
                    //Download progress
                    xhr.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;

                        }
                    }, false);
                    return xhr;
                },
                success: function (data)  		// A function to be called if request succeeds
                {
                    var data = $.parseJSON(data);
                    console.log(data);
                    console.log(data.data.file_error);
                    if (data.data.file_error == '') {
                        var html = '<i class="fa fa-clipboard"></i>' + data.data.doc_name;
                        //$('#docname_'+docid[1]).html(html);
                    }
                    else
                    {
                        alert(data.data.file_error);
                    }
                },
                error: function ()
                {

                }

            });
        }));

        var cancel = function () {
            if (xhrReq && xhrReq.readystate != 4) {
                xhrReq.abort();
            }
        }

    });

    function ValidateSingleInput(oInput, id, option) {
        var _validFileExtensions;
        if (id == '1') {
            _validFileExtensions = [".pdf", ".doc", ".docx", ".rtf", ".text", ".html", ".ppt"];
        }
        if (id == '2') {
            _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];
        }
        if (id == '3') {
            _validFileExtensions = [".mp4", ".3gp", ".avi", ".wmi", ".mpeg", ".flv"];
        }
        if (id == '4') {
            _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png", ".pdf", ".doc", ".docx", ".rtf", ".text", ".html", ".ppt"];
        }

        if (oInput.type == "file") {
            var sFileName = oInput.value;
            var countFile = oInput.files.length;
            var fileName = oInput.files;
            var k;
            var fileSize;
            var size = 0;
            for (k = 0; k < countFile; k++) {
                size = size + fileName[k].size;
            }
            if (option == '5') {
                fileSize = 512000;
            } else {
                fileSize = 6291456;
            }
            if (size > fileSize) {
                if (option == '5') {
                    alert("Sorry, total allowed file size : -  500KB ");
                } else {
                    alert("Sorry, total allowed file size : -  6MB ");
                }
                oInput.value = "";
                return false;
            } else {
                if (sFileName.length > 0) {
                    var blnValid = false;
                    for (var j = 0; j < _validFileExtensions.length; j++) {
                        var sCurExtension = _validFileExtensions[j];
                        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                            blnValid = true;
                            break;
                        }
                    }

                    if (!blnValid) {
                        alert("Sorry,   '" + sFileName + "'   is invalid, allowed extensions are : -   " + _validFileExtensions.join(", "));
                        oInput.value = "";
                        return false;
                    }
                }
            }
        }
        return true;
    }


</script>    