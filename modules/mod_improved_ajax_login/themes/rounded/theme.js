;(function($, undefined) {

$.createOOPlugin("ialWindow", "ialWindowBase", {
  Constructor: function() {
    this.Super("Constructor", arguments);
    this.$node.addClass("ial-trans-gpu ial-effect-"+ologin.windowAnim);
  },

  open: function() {
    this.Super("open", arguments);
    var node = this.$node[0],
        ialBg = this.$bg[0];
    if (ologin.windowAnim == 17 || ologin.windowAnim == 18) {
      var $body = $(document.body),
          $fake = $('#fake-offlajn-body'),
          scroll = $(document).scrollTop();
      var paddingB = $body.css('padding-top')+' '+$body.css('padding-right')+
        ' '+$body.css('padding-bottom')+' '+$body.css('padding-left');
      var marginB = $body.css('margin-top')+' '+$body.css('margin-right')+
        ' '+$body.css('margin-bottom')+' '+$body.css('margin-left');

      $('.selectBtn').css("position", "static");
      $fake.css({
        "display": "block",
        "position": "fixed",
        "width": "100%",
        "height": "100%",
        "-webkit-box-sizing": "border-box",
        "-moz-box-sizing": "border-box",
        "box-sizing":" border-box",
        "margin": marginB,
        "padding": paddingB,
        "overflow": "hidden"
      });
      $body.css({margin: 0, padding: 0});
      $body.children().each(function() {
        if (this != node && this != $fake[0]) $(this).appendTo($fake);
      });
      $fake.addClass("go-to-back-"+ologin.windowAnim);
      $fake.scrollTop(scroll);
    }
    if (ologin.windowAnim == 19)
      $(document.body).children().each(function() {
        if ((this != node) && (this != ialBg))
          $(this).css({
            "-webkit-filter": "blur(3px)",
            "-moz-filter": "url('#blur')",
            "-ms-filter": "url('#blur')",
            "-o-filter": "url('#blur')",
            "filter": "url('#blur')"
          });
      });
    if (ologin.windowAnim == 20)
      $(document.body).children().each(function() {
        if ((this != node) && (this != ialBg))
          $(this).css({
            "-webkit-filter": "grayscale(100%)",
            "-moz-filter": "url('#grayscale')",
            "-ms-filter": "url('#grayscale')",
            "-o-filter": "url('#grayscale')",
            "filter": "url('#grayscale')"
          });
      });
  },

  close: function() {
    if (!this.$node.hasClass(this.activeClass)) return;
    this.Super("close", arguments);
    if (ologin.windowAnim == 17 || ologin.windowAnim == 18) {
      var $fake = $('#fake-offlajn-body'),
          scroll = $fake.scrollTop();

      $(document.body).css({margin:"", padding:""});
      $fake.children().each(function() {
        $(this).appendTo(document.body);
      });
      $fake.removeAttr("style").removeClass("go-to-back-"+ologin.windowAnim);
      $(document).scrollTop(scroll);
    }
    if (ologin.windowAnim == 19 || ologin.windowAnim == 20) {
      $(document.body).children().each(function() {
        $(this).css({
          "-webkit-filter": "url()",
          "-moz-filter": "none",
          "-ms-filter": "none",
          "-o-filter": "none",
          "filter": "none"
        });
      });
    }
  }
});

$.createOOPlugin("ialUsermenu", "ialWindowBase", {
  Constructor: function(params) {
    params.border = 0;
    this.Super("Constructor", arguments);
    this.$node.addClass("ial-trans-gpu ial-effect-"+ologin.windowAnim);
    $(".logout", this.node).on("click", $.proxy(this, "logout"));
  },

  logout: function() {
    $(".ial-logout:first").submit();
  }
});

var formProto = $.createOOPlugin.Class.ialForm.prototype;
formProto._initCSS = formProto.initCSS;
formProto.initCSS = function() {
  this._initCSS();
  this.$oauths.css({
    paddingLeft: ologin.border,
    paddingRight: ologin.border,
    margin: ""
  });
};

$.createOOPlugin("ialLoginForm", "ialForm", {
  min: {
    width: 215,
    margin: 13
  },

  initProps: function() {
    var $form = $(".ial-form");
    this.layout = $form.length? $form.data("ialForm").layout : this.min;
    if (this.layout.width < this.min.width)
      this.layout.width = this.min.width;
    if (this.layout.margin < this.min.margin)
      this.layout.margin = this.min.margin;
    this.layout.columns = 1;
  },

  initElems: function() {
    if ((ologin.windowAnim == 17 || ologin.windowAnim == 18) && !$('#fake-offlajn-body').length)
      $('<div id="fake-offlajn-body" />').prependTo(document.body);
    if (ologin.windowAnim == 19 && !$('#blur').length)
      $('<svg width="0" height="0" style="position:absolute">'+
          '<filter id="blur">'+
            '<feGaussianBlur in="SourceGraphic" stdDeviation="3"/>'+
          '</filter>'+
        '</svg>').prependTo(document.body);
    if (ologin.windowAnim == 20 && !$('#grayscale').length)
      $('<svg width="0" height="0" style="position:absolute">'+
          '<filter id="grayscale">'+
            '<feColorMatrix type="saturate" values="0"/>'+
          '</filter>'+
        '</svg>').prependTo(document.body);
    this.$node.find("input.ial-checkbox").ialCheckBox();
    if (this.$node.prop('name') == 'ialLogin') {
      $(window).on('load', function() {
        $([document.ialLogin.username, document.ialLogin.email]).val($('#saveduser').val());
        $(document.ialLogin.password).val($('#savedpass').val());
        $(document.saved).remove();
      });
    }
  }
});

$.createOOPlugin("ialHeader", "ialElem", {
  tmpl:
    '<h3 class="loginH3">'+
      '<span data-attr="label" />'+
      '<span data-attr="subtitle" class="smallTxt regRequired" />'+
    '</h3>'
});

$.createOOPlugin("ialTextfield", "ialTextfieldBase", {
  tmpl:
    '<label data-attr="label required" class="smallTxt" />'+
    '<div class="ial-input-wrapper">'+
      '<input data-attr="id name title placeholder pattern value" class="loginTxt regTxt" type="text" />'+
      '<svg class="correct-pipe"><use xlink:href="#svg-correct"/></svg>'+
      '<svg class="error-close"><use xlink:href="#svg-error"/></svg>'+
    '</div>'+
    '<div data-attr="error" class="hidden" />',

  Constructor: function(params) {
    this.Super("Constructor", arguments);
    this.$input.attr('value', this.$input.val());
    if (this.$load) this.$load.insertAfter(this.$input);
    this.$node.find('[data-attr*=label]').clone().insertAfter(this.$input);
    this.$input.on('input blur', function() { this.attributes.value.value = this.value });
  }
});

$.createOOPlugin("ialPassword1", "ialPassword1Base", {
  tmpl:
    '<label data-attr="label required" class="smallTxt" />'+
    '<span class="smallTxt passStrongness" />'+
    '<div class="ial-input-wrapper">'+
      '<input data-attr="id name title placeholder" class="loginTxt regTxt" type="password" autocomplete="off" />'+
      '<svg class="correct-pipe"><use xlink:href="#svg-correct"/></svg>'+
      '<svg class="error-close"><use xlink:href="#svg-error"/></svg>'+
      '<div class="strongFields">'+
        new Array(6).join('<i class="empty strongField" />')+
      '</div>'+
    '</div>'+
    '<div data-attr="error" class="hidden" />',

  Constructor: function(params) {
    this.Super("Constructor", arguments);
    this.$input.attr('value', this.$input.val());
    this.$sfs.parent().insertAfter(this.$input);
    this.$node.find('[data-attr*=label]').clone().insertAfter(this.$input);
    this.$input.on('input', function() { this.attributes.value.value = this.value });
  }
});

$.createOOPlugin("ialPassword2", "ialTextfieldBase", {
  tmpl:
    '<label data-attr="label required" class="smallTxt" />'+
    '<div class="ial-input-wrapper">'+
      '<input data-attr="id name title placeholder value" class="loginTxt regTxt" type="password" autocomplete="off" />'+
      '<svg class="correct-pipe"><use xlink:href="#svg-correct"/></svg>'+
      '<svg class="error-close"><use xlink:href="#svg-error"/></svg>'+
    '</div>'+
    '<div data-attr="error" class="hidden" />',

  Constructor: function(params) {
    this.Super("Constructor", arguments);
    this.$input.attr('value', this.$input.val());
    this.$node.find('[data-attr*=label]').clone().insertAfter(this.$input);
    this.$input.on('input', function() { this.attributes.value.value = this.value });
  }
});

$.createOOPlugin("ialTextarea", "ialTextfieldBase", {
  tmpl:
    '<label data-attr="label required" class="smallTxt" />'+
    '<textarea data-attr="name title value placeholder" class="loginTxt regTxt" />',

  Constructor: function(params) {
    this.Super("Constructor", arguments);
    this.$input.wrap('<div class="ial-input-wrapper">');
    this.$node.find('[data-attr*=label]').clone().insertAfter(this.$input);
    this.$input.on('input', function() { $(this).toggleClass('ial-not-empty', !!this.value) }).trigger('input');
  }
});

$.createOOPlugin("ialButton", "ialElem", {
  tmpl:
    '<label data-attr="subtitle" class="smallTxt" />'+
    '<button class="loginBtn ial-submit" name="submit">'+
      '<i class="ial-load"><i/></i>'+
      '<span data-attr="label" />'+
    '</button>'
});

$.createOOPlugin("ialImage", "ialFileBase", {
  tmpl:
    '<label data-attr="label required" class="smallTxt"/>'+
    '<div class="upload-wrapper">' +
      '<svg class="upload-logo"><use xlink:href="#svg-upload"/></svg>'+
      '<input data-attr="name title value size" class="loginTxt regTxt" type="file" accept="image/*" />' +
      '<input class="loginTxt regTxt" data-attr="placeholder" type="text"/>' +
    '</div>' 
});

$.createOOPlugin("ialFile", "ialFileBase", {
  tmpl:
    '<label data-attr="label required" class="smallTxt"/>'+
    '<div class="upload-wrapper">' +
      '<svg class="upload-logo"><use xlink:href="#svg-upload"/></svg>'+
      '<input data-attr="name title value accept size" class="loginTxt regTxt" type="file" />' +
      '<input class="loginTxt regTxt" data-attr="placeholder" type="text"/>' +
    '</div>' 
});

$.createOOPlugin("ialLabel", "ialElem", {
  tmpl: '<span data-attr="label" class="smallTxt" />'
});

$.createOOPlugin("ialCheckbox", "ialElem", {
  tmpl:
    '<label data-attr="title required" class="ial-check-lbl smallTxt">'+
      '<input data-attr="id name value checked" type="checkbox" class="ial-checkbox" /> '+
      '<span data-attr="label" />'+
    '</label>',

  Constructor: function() {
    this.Super("Constructor", arguments);
    this.$input.ialCheckBox();
  }
});

$.createOOPlugin("ialTos", "ialTosBase", {
  tmpl:
    '<label data-attr="title required" class="ial-check-lbl smallTxt">'+
      '<input data-attr="id name value checked" type="checkbox" class="ial-checkbox" /> '+
      '<span data-attr="label" />'+
    '</label>'+
    '<a data-attr="article" class="forgetLnk selectBtn" href="javascript:;" onclick="return false" />'+
    '<div class="ial-modal"><div class="loginWndInside"><iframe class="ial-frame" /></div><span class="ial-close" />',

  Constructor: function() {
    this.Super("Constructor", arguments);
    this.$input.ialCheckBox();
  }
});

$.createOOPlugin("ialSelect", "ialElem", {
  tmpl:
    '<label data-attr="label required" class="smallTxt" />'+
    '<label class="ial-select">'+
      '<select data-attr="id name title select" class="loginTxt" />'+
    '</label>'
});

$.createOOPlugin("ialLoad", {
  Constructor: function(params) {
    $.extend(this, params);
    if (this.autoplay) this.play();
  },

  playing: function() {
    return this.$node.hasClass('ial-active');
  },

  play: function() {
    this.$node.addClass('ial-active');
    return true;
  },

  stop: function() {
    this.$node.removeClass('ial-active');
    if (this.onEndCallback) {
      this.$node.next().attr("disabled", false);
      this.onEndCallback();
      delete this.onEndCallback;
    }
    return false;
  },

  onEnd: function(callback) {
    this.onEndCallback = callback;
  }
});

var base = ($('link[href*="/media/"],link[href*="/templates/"]').attr('href')||'/').replace(/\/(media|templates)\/.*/, '/');

$.ajax({
  url: base+'modules/mod_improved_ajax_login/themes/rounded/theme.svg',
  cache: true,
  success: function(doc) { $(doc.documentElement).appendTo(document.head) }
});

})(window.jq183 || jQuery);