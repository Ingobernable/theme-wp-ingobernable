jQuery('document').ready(function(){
  // Add pro banner
  if(true){  
    upgrade =  
    '<div class="WDWT_IS_PRO_banner" style="font-size:16px; margin-top:8px; text-align:left;">'
      +'<a href="'+ WDWT.homepage +'/wordpress-themes/best-magazine.html" target="_blank" style="color:red; text-decoration:none; display:block;">'
        +'<img src="'+WDWT.img_URL +'pro.png" border="0" alt="" width="215" >'
      +'</a>'
    +'</div>';
    jQuery('.preview-notice').append(upgrade);
    // Remove accordion click event
    jQuery('.WDWT_IS_PRO_banner').on('click', function(e) {
      e.stopPropagation();
    });

    jQuery("body ").on( "click",'[id^=accordion-panel-best_magazine]', function() {
      if(jQuery(this).is(":visible")){
        jQuery(this).find(".customize-panel-description").css('display', 'inline-block');
      }
    });


  }
});