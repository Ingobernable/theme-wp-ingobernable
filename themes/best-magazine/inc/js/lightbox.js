wdwt_lbox = {

  isPopUpOpened : false,

  init: function(link_obj, rel, width, height){
    /*add list of images*/
    var imgs = [];
    var titles = [];
    var descrs = [];
    links =jQuery("a[rel='"+rel+"']");
    var cur = 0;
    links.each(function(index){
      
    if(link_obj === links.get(index)){
       cur = index;
    }
    id= jQuery(this).prop('id');
      href = links.eq(index).prop('href');
      
    title = links.eq(index).parent().parent().parent().parent().find("[rel='"+id+"-title']").eq(0).html();
    
    if(typeof title == 'undefined'){
    title ='';
    }
      descr = links.eq(index).parent().parent().parent().parent().find("[rel='"+id+"-desc']").eq(0).html();
    if(typeof descr == 'undefined'){
    descr ='';
    }
    
      imgs.push(href);
      titles.push(title);
      descrs.push(descr);
    });


    //var cur = link_obj.getAttribute('href');
    /*ttt!!! test correct later*/
    
    //console.log(cur);
    
    var imgs_json = JSON.stringify(imgs);
    var titles_json = JSON.stringify(titles);
    var descrs_json = JSON.stringify(descrs);

    //console.log(imgs_json);
    /*data to send by AJAX*/
    var data = {
      action : 'wdwt_lightbox',
      imgs : imgs_json,
      titles : titles_json,
      descrs : descrs_json,
      cur:cur,
    };
   // console.log(data);
    /*sanitize here !!!*/
    /*security ttt!!!*/
    this.createpopup(wdwt_admin_ajax_url, data, 0, width, height,  1, 'testpopup', 5);

  },

  /*bestmagtheme_createpopup*/
  createpopup: function (url, data_send, current_view, width, height, duration, description, lifetime) {
    if (this.isPopUpOpened) { return };
    this.isPopUpOpened = true;
    if (this.hasalreadyreceivedpopup(description) || this.isunsupporteduseragent()) {
      return;
    }

    jQuery("html").attr("style", "overflow:hidden !important;");

    popup_el ='<div id="wdwt_spider_popup_loading_' + current_view + '" class="wdwt_spider_popup_loading"></div>'
              +'<div id="wdwt_spider_popup_overlay_' + current_view + '" class="wdwt_spider_popup_overlay" onclick="wdwt_lbox.destroypopup(1000)"></div>';
    //add styles for popup ttt!!!
    jQuery( "body" ).append( popup_el);

    jQuery("#wdwt_spider_popup_loading_" + current_view).css({display: "block"});
    jQuery("#wdwt_spider_popup_overlay_" + current_view).css({display: "block"});

    jQuery.post(url, data_send, function(data) {
      
      var popup = jQuery(
      '<div id="wdwt_spider_popup_wrap" class="wdwt_spider_popup_wrap" style="' + 
            ' width:' + width + 'px;' +
            ' height:' + height + 'px;' + 
            ' margin-top:-' + height / 2 + 'px;' + 
            ' margin-left: -' + width / 2 + 'px; ">' +    
      data + 
      '</div>')
        .hide()
        .appendTo("body");
      wdwt_lbox.showpopup(description, lifetime, popup, duration);
    }).success(function(jqXHR, textStatus, errorThrown) {
      jQuery("#wdwt_spider_popup_loading_" + current_view).css({display: "none !important;"});
    });
  },
  /*bestmagtheme_showpopup*/
  showpopup : function(description, lifetime, popup, duration) {
    this.isPopUpOpened = true;
    popup.show();
    this.receivedpopup(description, lifetime);
  },
  /*bestmagtheme_hasalreadyreceivedpopup*/
  hasalreadyreceivedpopup: function(description) {
    if (document.cookie.indexOf(description) > -1) {
      delete document.cookie[document.cookie.indexOf(description)];
    }
    return false; 
  },
  /*bestmagtheme_receivedpopup*/
  
  receivedpopup : function(description, lifetime) { 
    var date = new Date(); 
    date.setDate(date.getDate() + lifetime);
    document.cookie = description + "=true;expires=" + date.toUTCString() + ";path=/"; 
  },
  /*bestmagtheme_isunsupporteduseragent*/
  isunsupporteduseragent : function() {
    return (!window.XMLHttpRequest); 
  },
  /*bestmagtheme_destroypopup*/
  
  destroypopup: function(duration) {
    if (document.getElementById("wdwt_spider_popup_wrap") != null) {
      if (typeof jQuery().fullscreen !== 'undefined' && jQuery.isFunction(jQuery().fullscreen)) {
        if (jQuery.fullscreen.isFullScreen()) {
          jQuery.fullscreen.exit();
        }
      }
      setTimeout(function () {
        jQuery(".wdwt_spider_popup_wrap").remove();
        jQuery(".wdwt_spider_popup_loading").remove();
        jQuery(".wdwt_spider_popup_overlay").remove();
        jQuery(document).off("keydown");
        jQuery("html").attr("style", "");
        jQuery(window).trigger('resize');//for resizing thumbs after lightbox closing
      }, 20);
    }
    this.isPopUpOpened = false;
    var isMobile = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));
    var viewportmeta = document.querySelector('meta[name="viewport"]');
    if (isMobile && viewportmeta) {
      viewportmeta.content = 'width=device-width, initial-scale=1';
    }
    var scrrr = jQuery(document).scrollTop();
    /*window.location.hash = "";*/
    jQuery(document).scrollTop(scrrr);
    if(typeof wdwt_playInterval !== "undefined"){
      clearInterval(wdwt_playInterval);
    }
  },



}