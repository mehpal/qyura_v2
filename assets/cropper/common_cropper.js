(function (factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as anonymous module.
    define(['jquery'], factory);
  } else if (typeof exports === 'object') {
    // Node / CommonJS
    factory(require('jquery'));
  } else {
    // Browser globals.
    factory(jQuery);
  }
})(function ($) {

  'use strict';

  var useBlob = false && window.URL; // `true` to use Blob instead of Data-URL
  var console = window.console || { log: function () {} };

  function CropAvatar($element, $modelId) {
    this.$container = $element;

    this.$avatarView = this.$container.find('.avatar-view');
    this.$avatar = this.$avatarView.find('img');
    this.$avatarModal = this.$container.find('#'+$modelId);
    this.$loading = this.$container.find('.loading');

    this.$avatarForm = this.$avatarModal.find('.avatar-form');
    console.log(this.$avatarForm);
    this.$avatarUpload = this.$avatarModal.find('.avatar-upload');
    this.$avatarMessage = this.$avatarModal.find('#message_upload_error');
    this.$avatarSrc = this.$avatarModal.find('.avatar-src');
    this.$avatarData = this.$avatarModal.find('.avatar-data');
    this.$avatarInput = this.$avatarModal.find('.avatar-input');
    this.$avatarSave = this.$avatarModal.find('.avatar-save');
    this.$avatarBtns = this.$avatarModal.find('.avatar-btns');
    this.$imgUploadBtn = this.$avatarModal.find('.imgUploadBtn');
    this.$avatarCancelCropBtns = this.$avatarForm.find('.cancelCrop');

    this.$avatarWrapper = this.$avatarModal.find('.avatar-wrapper');
    this.$avatarPreview = this.$avatarModal.find('.avatar-preview');
    this.preUrl = this.$avatar.attr('src');
    this.init();
  }

  CropAvatar.prototype = {
    constructor: CropAvatar,

    support: {
      fileList: !!$('<input type="file">').prop('files'),
      blobURLs: !!window.URL && URL.createObjectURL,
      formData: !!window.FormData
    },

    init: function () {
      this.support.datauri = this.support.fileList && this.support.blobURLs;

      if (!this.support.formData) {
        this.initIframe();
      }

      this.initTooltip();
      this.initModal();
      this.addListener();
    },

    addListener: function () {
      this.$avatarView.on('click', $.proxy(this.click, this));
      this.$avatarInput.on('change', $.proxy(this.change, this));
      this.$imgUploadBtn.on('click', $.proxy(this.submit, this));
      this.$avatarBtns.on('click', $.proxy(this.rotate, this));
      this.$avatarCancelCropBtns.on('click', $.proxy(this.cancelCrop, this));
    },

    initTooltip: function () {
      this.$avatarView.tooltip({
        placement: 'bottom'
      });
    },

    initModal: function () {
      this.$avatarModal.modal({
        show: false,
           backdrop: 'static',
       keyboard: true
      });
    },

    initPreview: function () {
      var url = this.$avatar.attr('src');

      this.$avatarPreview.html('<img src="' + url + '">');
    },

    initIframe: function () {
        console.log(this,'initIframe');
      var target = 'upload-iframe-' + (new Date()).getTime();
      var $iframe = $('<iframe>').attr({
            name: target,
            src: ''
          });
      var _this = this;

      // Ready ifrmae
      $iframe.one('load', function () {

        // respond response
        $iframe.on('load', function () {
          var data;

          try {
            data = $(this).contents().find('body').text();
            console.log(data,'data');
          } catch (e) {
            console.log(e.message);
          }

          if (data) {
            try {
              data = $.parseJSON(data);
            } catch (e) {
              console.log(e.message);
            }

            _this.submitDone(data);
          } else {
            _this.submitFail('Image upload failed!');
          }

          _this.submitEnd();

        });
      });

      this.$iframe = $iframe;
      this.$avatarModal.attr('target', target).after($iframe.hide());
    },

    click: function () {
      this.$avatarModal.modal('show');
      this.initPreview();
    },

    change: function () {
      var files;
      var file;

      if (this.support.datauri) {
        files = this.$avatarInput.prop('files');

        if (files.length > 0) {
          file = files[0];
          this.uploadFile = file;
          if (this.isImageFile(file)) {
            if (this.url) {
              URL.revokeObjectURL(this.url); // Revoke the old one
            }
            
            this.readImage(file,this);
            
//            this.url = URL.createObjectURL(file);
//            this.startCropper();

            if (/^image\/\w+$/.test(file.type)) {
                this.url = URL.createObjectURL(file);
                this.startCropper();
            } else {
                window.alert('Please choose an image file.');
            }
          }
          else{
              bootbox.alert('Please choose an image file.');
          }
        }
      } else {
        file = this.$avatarInput.val();

        if (this.isImageFile(file)) {
          this.syncUpload();
        }
      }
    },

    submit: function () {
      if (!this.$avatarSrc.val() && !this.$avatarInput.val()) {
        return false;
      }

      if (this.support.formData) {
        this.ajaxUpload();
        return false;
      }
    },

    rotate: function (e) {
      var data;

      if (this.active) {
        data = $(e.target).data();

        if (data.method) {
          this.$img.cropper(data.method, data.option);
        }
      }
    },

    isImageFile: function (file) {
      if (file.type) {
        return /^image\/\w+$/.test(file.type);
      } else {
        return /\.(jpg|jpeg|png|gif)$/.test(file);
      }
    },

    startCropper: function () {
      var _this = this;

      if (this.active) {
        this.$img.cropper('replace', this.url);
      } else {
        this.$img = $('<img src="' + this.url + '">');
        this.$avatarWrapper.empty().html(this.$img);
        this.$img.cropper({
          autoCropArea: 0.8,
          aspectRatio: 17 / 9,
          minCropBoxWidth: 425,
          minCropBoxHeight: 225,
          preview: this.$avatarPreview.selector,
          strict: false,
          crop: function (e) {
            var json = [
                  '{"x":' + e.x,
                  '"y":' + e.y,
                  '"height":' + e.height,
                  '"width":' + e.width,
                  '"rotate":' + e.rotate + '}'
                ].join();

            _this.$avatarData.val(json);
          }
        });

        this.active = true;
      }

      this.$avatarModal.one('hidden.bs.modal', function () {
        _this.$avatarPreview.empty();
        _this.stopCropper();
      });
    },
    
    cancelCrop: function () {
            this.stopCropper();
            this.$avatarInput.val("");
            this.$avatarData.val('');
            //this.$avatarPreview.html('<img src="' + this.preUrl + '">');
        },

    stopCropper: function () {
      if (this.active) {
        this.$img.cropper('destroy');
        this.$img.remove();
        this.active = false;
      }
    },

    ajaxUpload: function () {
      var url = this.$container.find('.file_action_url').val();
      
      //var data = new FormData(this.$avatarForm[0]);
    //var data = this.uploadFile;
    var form_data = new FormData();                  // Creating object of FormData class
    //form_data.append("file", data);    
    form_data.append("avatar_file", this.$avatarInput.prop("files")[0]);
    console.log(this.$avatarModal.prop("name"));
    console.log(this.$container.find('.avatar-data').val(),'avatar-data');
    form_data.append('avatar-src',this.$container.find('.avatar-src').val());
    form_data.append('avatar-data',this.$container.find('.avatar-data').val());
    form_data.append('avatar_id',this.$container.find('.avatar_id').val());
    
      var _this = this;
        console.log(form_data);
      $.ajax(url, {
        type: 'post',
        url:url,
        data: form_data,
        dataType: 'json',
        processData: false,
        contentType: false,

        beforeSend: function () {
          _this.submitStart();
        },

        success: function (data) {
          _this.submitDone(data);
        },

        error: function (XMLHttpRequest, textStatus, errorThrown) {
          _this.submitFail(textStatus || errorThrown);
        },

        complete: function () {
          _this.submitEnd();
        }
      });
    },

    syncUpload: function () {
      this.$avatarSave.click();
    },

    submitStart: function () {
      qyuraLoader.startLoader();
    },

    submitDone: function (data) {
 //console.log(data);
      if ($.isPlainObject(data) && data.state === 200) {
          
          // this.$container.find('.text-success').html(data.message);
         //  var loadUrl = this.$container.find('#load_url').val();
         //  this.$container.find('.pro-img').load(loadUrl,function () {
          // });
        //  console.log(data);
           //this.$container.find('.text-success').html(data.message);
          // alert(data.image);
           
          this.$container.find('.'+data.returnClass).attr('src',data.image);
          this.$container.find('.'+data.reset).trigger('click');
           
          if (this.support.datauri || this.uploaded) {
            this.uploaded = false;
            this.cropDone();
          } else {
            this.uploaded = true;
            this.$avatarSrc.val(this.url);
            this.startCropper();
          }

          this.$avatarInput.val('');
          this.$avatarModal.modal('hide');
          //window.location.href = loadUrl;
          this.alerttime(this);

      } else {
        this.alert(data.message);
      }
    },

    submitFail: function (msg) {
      this.alert(msg);
    },

    submitEnd: function () {
      qyuraLoader.stopLoader();
    },

    cropDone: function () {
      //this.$avatarModal.get(0).reset();
      this.$avatar.attr('src', this.url);
      this.stopCropper();
      //this.$avatarModal.modal('hide');
    },
    
        readImage:function (file,currentObj) {
            // 2.1
            // Create a new FileReader instance
            // https://developer.mozilla.org/en/docs/Web/API/FileReader
            console.log(currentObj);
            
            var reader = new FileReader();
            // 2.3
            // Once a file is successfully readed:
            reader.addEventListener("load", function () {
                // At this point `reader.result` contains already the Base64 Data-URL
                // and we've could immediately show an image using
                // `elPreview.insertAdjacentHTML("beforeend", "<img src='"+ reader.result +"'>");`
                // But we want to get that image's width and height px values!
                // Since the File Object does not hold the size of an image
                // we need to create a new image and assign it's src, so when
                // the image is loaded we can calculate it's width and height:
                var image = new Image();
                image.addEventListener("load", function () {
                    // Concatenate our HTML image info 
                    var imageInfo = file.name + ' ' + // get the value of `name` from the `file` Obj
                            image.width + '×' + // But get the width from our `image`
                            image.height + ' ' +
                            file.type + ' ' +
                            Math.round(file.size / 1024) + 'KB';

                    if (image.width < 425 || image.height < 225) {
                        //CropAvatar.stopCropper();
                        currentObj.stopCropper();
                        currentObj.$avatarInput.val("");
                        currentObj.$avatarPreview.html('<img src="' + currentObj.preUrl + '">');
                        bootbox.alert("Image dimension should be greater than 425px X 225px");
                        
                    }
                    // Finally append our created image and the HTML info string to our `#preview` 
                    //elPreview.appendChild(this);
                    //elPreview.insertAdjacentHTML("beforeend", imageInfo + '<br>');
                });
                image.src = useBlob ? window.URL.createObjectURL(file) : reader.result;
                // If we set the variable `useBlob` to true:
                // (Data-URLs can end up being really large
                // `src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAA...........etc`
                // Blobs are usually faster and the image src will hold a shorter blob name
                // src="blob:http%3A//example.com/2a303acf-c34c-4d0a-85d4-2136eef7d723"
                if (useBlob) {
                    // Free some memory for optimal performance
                    window.URL.revokeObjectURL(file);
                }
            });
            // 2.2
            // https://developer.mozilla.org/en-US/docs/Web/API/FileReader/readAsDataURL
            reader.readAsDataURL(file);
        },

    alerttime: function (obj) {
      
         setTimeout(function(){ obj.$avatarMessage.html(""); }, 3000);
        
    }, 

    alert: function (msg) {
      var $alert = [
            '<div class="alert alert-danger avatar-alert alert-dismissable">',
              '<button type="button" class="close" data-dismiss="alert">&times;</button>',
              msg,
            '</div>'
          ].join('');

      this.$avatarMessage.html($alert);
      this.alerttime(this);
     
    }
  };

  $(function () {
    return new CropAvatar($('#crop-avatar-upload'), 'avatar-modal-edit');
  });
  
 $(function () {
    return new CropAvatar($('#crop-blood'), 'blood-modal');
  });
  
  $(function () {
    return new CropAvatar($('#crop-ambulance'), 'ambulance-modal');
  });
  
  
   $(function () {
    return new CropAvatar($('#crop-doctor'), 'doctor-modal');
  });

});
