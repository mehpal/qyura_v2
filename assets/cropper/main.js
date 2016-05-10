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

  var CropAvatar = function ($element,$modalId) {
    this.$container = $element;
    
    this.$avatarView = this.$container.find('.avatar-view');
    this.$avatar = this.$avatarView.find('img');
    this.$avatarModal = this.$container.find('#'+$modalId);
    this.$pre = this.$container.find('.pre');
    
    this.$loading = this.$container.find('.loading');

    //this.$uploadForm = $('#submitForm');

    this.$avatarForm = this.$container.find('.avatar-body');
    this.$avatarUpload = this.$avatarForm.find('.avatar-upload');
    this.$avatarSrc = this.$container.find('.avatar-src');
    this.$avatarData = this.$container.find('.avatar-data');
    this.$avatarUploadPreview = this.$container.find('.image-preview-show');
    this.$avatarInput = this.$avatarForm.find('.avatar-input');
    this.$avatarSave = this.$avatarForm.find('.avatar-save');
    this.$avatarBtns = this.$avatarForm.find('.avatar-btns');

    this.$avatarWrapper = this.$avatarModal.find('.avatar-wrapper');
    this.$avatarPreview = this.$pre.find('.avatar-preview');
    
    this.preImage = this.$avatarUploadPreview;
    this.preUrl = $('.preImgLogo img').attr('src');
    //console.log(this);
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
     // this.$avatarForm.on('submit', $.proxy(this.submit, this));
      this.$avatarBtns.on('click', $.proxy(this.rotate, this));
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

    initPreview: function ($container) {
      this.url = $container.find('.preImgLogo img').attr('src');
      //console.log('hi',this.$avatarUploadPreview.attr('src').length);
      this.$avatarPreview.html('<img src="' + this.url + '">');
    },

    initIframe: function () {
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
      //this.$avatarForm.attr('target', target).after($iframe.hide());
    },

    click: function () {
      this.$avatarModal.modal('show');
      
      this.initPreview(this.$container);
    },

    change: function () {
      var files;
      var file;
     console.log('change');
     console.info(this.support.datauri);
      if (this.support.datauri) {
        files = this.$avatarInput.prop('files');
console.log(files);
        if (files.length > 0) {
          file = files[0];

          if (this.isImageFile(file)) {
            if (this.url) {
              URL.revokeObjectURL(this.url); // Revoke the old one
            }

            this.readImage(file,this);
            
            if (/^image\/\w+$/.test(file.type)) {
                this.url = URL.createObjectURL(file);
                this.startCropper();
            } else {
                window.alert('Please choose an image file.');
            }
            
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
        console.log('submit');
      if (!this.$avatarSrc.val() && !this.$avatarInput.val()) {
        return false;
      }
      this.$avatarSrc.val(this.url);
      //this.$avatarUploadPreview.attr('src',this.url);
      if (this.support.formData) {
       // this.ajaxUpload();
       console.log('submit');
        this.$avatarModal.modal('hide');
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
      console.log(this.active);
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
      
//      this.closeBtnUpload.on('click',function(){
//          _this.urlUploads = $(".pre").find('.uploadImages img').attr('src');
//          _this.$avatarPreview.html('<img src="' + _this.urlUploads + '">');
//          console.log(_this.urlUploads);
//      });

//      this.$avatarModal.one('hidden.bs.modal', function () {
//        _this.preImage = _this.$avatarPreview.html();
//        //_this.$avatarPreview.empty();
//        _this.stopCropper();
//      });
      
      //this.$avatarSrc.val(this.url);
      //this.$avatarUploadPreview.attr('src',this.url);

    },

    stopCropper: function () {
         console.log('stopCropper');
      if (this.active) {
        this.$img.cropper('destroy');
        this.$img.remove();
        this.active = false;
        
      }
    },

    ajaxUpload: function () {
      //var url = this.$avatarForm.attr('action');
      var data = new FormData(this.$avatarForm[0]);
      var _this = this;

      $.ajax(url, {
        type: 'post',
        data: data,
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
   
    },

    submitStart: function () {
      this.$loading.fadeIn();
    },

    submitDone: function (data) {
      //console.log(data);

      if ($.isPlainObject(data) && data.state === 200) {
        if (data.result) {
          this.url = data.result;

          if (this.support.datauri || this.uploaded) {
            this.uploaded = false;
            this.cropDone();
          } else {
            this.uploaded = true;
            this.$avatarSrc.val(this.url);
            this.startCropper();
          }

          this.$avatarInput.val('');
        } else if (data.message) {
          this.alert(data.message);
        }
      } else {
        this.alert('Failed to response');
      }
    },

    submitFail: function (msg) {
      this.alert(msg);
    },

    submitEnd: function () {
      this.$loading.fadeOut();
    },

    cropDone: function () {
      //console.log('cropDone');
      this.$avatarForm.get(0).reset();
      //this.$avatarUploadPreview.attr('src', this.url);
      this.stopCropper();
      this.$avatarModal.modal('hide');
    },
    
    readImage:function (file,currentObj) {
            // 2.1
            // Create a new FileReader instance
            // https://developer.mozilla.org/en/docs/Web/API/FileReader
            //console.log(currentObj);
            
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

    alert: function (msg) {
      var $alert = [
            '<div class="alert alert-danger avatar-alert alert-dismissable">',
              '<button type="button" class="close" data-dismiss="alert">&times;</button>',
              msg,
            '</div>'
          ].join('');

      this.$avatarUpload.after($alert);
    }
  };

  $(function () {
    return new CropAvatar($('#crop-avatar'),'avatar-modal');
  });
  
  $(function () {
    return new CropAvatar($('#doctor-crop-avatar'),'doctor-avatar-modal');
  });
  
  $(function () {
    return new CropAvatar($('#blood-crop-avatar'),'blood-avatar-modal');
  });
  
  $(function () {
    return new CropAvatar($('#ambulance-crop-avatar'),'ambulance-avatar-modal');
  });
  
  
  
  

});


